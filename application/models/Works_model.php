<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Works_model extends CI_Model {
//SELECT * FROM `works` WHERE `work_name` LIKE '%soyut%' ESCAPE '!' AND `status` LIKE '%modern%' ESCAPE '!' ORDER BY `work_name` ASC LIMIT 54
	var $table = 'works';
	var $column_order = array('id', 'photo','artist','work_name','years','category','status','document',null); //set column field database for datatable orderable
	var $column_search = array('id','artist','work_name','years','category','status','document'); //set column field database for datatable searchable
	var $order = array('work_name' => 'ASC'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{

		$this->db->from($this->table);
		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}


		if(isset($_POST['columns'])) // here order processing
		{

			$i = 0;
			    foreach($_POST['columns'] as $s_column){
			    	if($s_column['searchable'] == 'true' && !empty($s_column['search']['value'])){

						if($i===0) // önceden arama varsa
						{
							$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
							$this->db->like($s_column['name'], $s_column['search']['value']);
						}
						else
						{
							$this->db->like($s_column['name'], $s_column['search']['value']);
						}

						if(count($_POST['columns']) - 1 == $i) //last loop
							$this->db->group_end(); //close bracket
			    	}
			    	$i++;
			    }

		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}

	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_records()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->result();
	}

	function get_all_artist_count($aid)
	{
		$this->db->from($this->table);
		$this->db->where('artist',$aid);
		$this->db->order_by('work_name', 'ASC');
		$this->db->order_by('id', 'ASC');

		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_works($limit=null)
	{

		$this->db->from($this->table);
		$this->db->order_by('work_name', 'ASC');
		$this->db->order_by('artist', 'ASC');
		$this->db->order_by('id', 'ASC');

		if($limit != '')
		$this->db->limit(1, $limit);

		$query = $this->db->get();
		return $query->result();
	}

	function get_all_artist_records($aid,$limit=null)
	{

		$this->db->from($this->table);
		$this->db->where('artist',$aid);
		$this->db->order_by('work_name', 'ASC');
		$this->db->order_by('id', 'ASC');

		if($limit != '')
		$this->db->limit(1, $limit);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_all_cat(){

		$this->db->from('categories');
		$this->db->order_by('category', 'asc');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_materials(){

		$this->db->from('materials');
		$this->db->order_by('material_name', 'asc');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_how(){

		$this->db->from('how');
		$this->db->order_by('how', 'asc');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_library(){

		$this->db->from('library');
		$this->db->order_by('publication', 'asc');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_contacts(){

		$this->db->from('contacts');
		$this->db->order_by('contact', 'asc');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_artist(){

		$this->db->from('artist');
		$this->db->order_by('artist_name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}
