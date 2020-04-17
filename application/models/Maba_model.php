<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Maba_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    function getSiguiente($table,$field)
	{
        $vacio=$this->db->query("SELECT $field FROM $table ORDER by $field DESC LIMIT 1")->num_rows()==0?true:false;
        if($vacio) $siguiente=1;
        else $siguiente=$this->db->query("SELECT $field FROM $table ORDER by $field DESC LIMIT 1")->row()->$field+1;
        return $siguiente;
    }

    function getSiguienteNumRegistro($table,$field,$numRegistro)
	{
        $vacio=$this->db->query("SELECT $field FROM $table WHERE $field>0 AND num_registro='$numRegistro' ORDER by $field DESC LIMIT 1")->num_rows()==0?true:false;
        if($vacio) $siguiente=1;
        else $siguiente=$this->db->query("SELECT $field FROM $table WHERE $field>0 AND num_registro='$numRegistro' ORDER by $field DESC LIMIT 1")->row()->$field+1;
        return $siguiente;
    }

    function getUltimoCurso()
	{
        $vacio=$this->db->query("SELECT texto_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->num_rows()==0?true:false;
        if($vacio) $ultimoCurso=0;
        else $ultimoCurso=$this->db->query("SELECT num_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->row()->num_curso;
        return $ultimoCurso;
    }
    function getUltimoCursoTexto()
	{
        $vacio=$this->db->query("SELECT texto_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->num_rows()==0?true:false;
        if($vacio) $ultimoCurso=0;
        else $ultimoCurso=$this->db->query("SELECT texto_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->row()->texto_curso;
        return $ultimoCurso;
    }
    function getStatusPagadoTexo()
	{
        $vacio=$this->db->query("SELECT texto_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->num_rows()==0?true:false;
        if($vacio) $ultimoCurso=0;
        else $ultimoCurso=$this->db->query("SELECT texto_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->row()->texto_curso;
        return $ultimoCurso;
    }

    function sendEmail($to='mbanolas@gmail.com',$subject="",$message="vacío"){
            //$host = $_SERVER['HTTP_HOST'];
        $this->load->library('email');
        $this->email->from('info@gestiocggsantmarti.com', getTituloCasal());
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }




}