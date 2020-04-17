<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function pruebaA(){
		$this->db->query("UPDATE pe_lineas_packs SET id='0' WHERE 1");
		$id=1;
		while($this->db->query("SELECT * FROM pe_lineas_packs WHERE id=0 ")->num_rows()>0){
			$this->db->query("UPDATE pe_lineas_packs SET id='$id' WHERE id=0 limit 1");
			$id++;
		}
		echo'fin';
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

	public function offices_management()
	{

			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);
			$this->config->set_item('grocery_crud_dialog_color','elegant-color');
			$this->config->set_item('grocery_crud_dialog_text_color','white');

		try{
			$crud = new grocery_CRUD();
            $crud->set_theme('mdb'); // magic code
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');

			$output = $crud->render();

			$output->codes = nl2br("
			public function offices_management()
			{

			\$this->config->load('grocery_crud');
			\$this->config->set_item('grocery_crud_dialog_forms',true);
			\$this->config->set_item('grocery_crud_dialog_color','elegant-color');
			\$this->config->set_item('grocery_crud_dialog_text_color','white');

				try{
					\$crud = new grocery_CRUD();
                    \$crud->set_theme('mdb'); // magic code
					\$crud->set_table('offices');
					\$crud->set_subject('Office');
					\$crud->required_fields('city');
					\$crud->columns('city','country','phone','addressLine1','postalCode');

					\$output = \$crud->render();

					\$this->_example_output(\$output);

				}catch(Exception \$e){
					show_error(\$e->getMessage().' --- '.\$e->getTraceAsString());
				}
			}");

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function employees_management()
	{
			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);
			$this->config->set_item('grocery_crud_dialog_color','unique-color');
			$this->config->set_item('grocery_crud_dialog_text_color','white');

			$crud = new grocery_CRUD();

			$crud->set_theme('mdb'); // magic code
			$crud->set_table('employees')
				->set_subject('Employee')
				->columns('employeeNumber','firstName','lastName','email','officeCode','jobTitle')
				->set_relation('officeCode','offices','city');

			$crud->display_as('email','E-Mail')
				 ->display_as('employeeNumber','ID')
				 ->display_as('firstName','Name')
				 ->display_as('lastName','Last Name');

			$crud->required_fields('firstName','lastName');

			$crud->add_fields('firstName','lastName','email','jobTitle', 'officeCode');


            $crud->unset_bootstrap();
            //$crud->unset_delete();

			$output = $crud->render();

			$output->codes = nl2br("
			public function employees_management()
			{
			\$this->config->load('grocery_crud');
			\$this->config->set_item('grocery_crud_dialog_forms',true);
			\$this->config->set_item('grocery_crud_dialog_color','unique-color');
			\$this->config->set_item('grocery_crud_dialog_text_color','white');

				\$crud = new grocery_CRUD();

				\$crud->set_theme('mdb'); // magic code
				\$crud->set_table('employees')
					->set_subject('Employee')
					->columns('employeeNumber','firstName','lastName','email','officeCode','jobTitle')
					->set_relation('officeCode','offices','city');

				\$crud->display_as('email','E-Mail')
					 ->display_as('employeeNumber','ID')
					 ->display_as('firstName','Name')
					 ->display_as('lastName','Last Name');

				\$crud->required_fields('firstName','lastName');

				\$crud->add_fields('firstName','lastName','email','jobTitle', 'officeCode');

	            \$crud->unset_bootstrap();

				\$output = \$crud->render();

				\$this->_example_output(\$output);
			}
			");

			$this->_example_output($output);
	}

	public function customers_management()
	{

			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);
			$this->config->set_item('grocery_crud_dialog_color','pink darken-4');
			$this->config->set_item('grocery_crud_dialog_text_color','white');

			$crud = new grocery_CRUD();
			$crud->set_theme('mdb'); // magic code
			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

			$output = $crud->render();

            $output->codes = nl2br("
            public function customers_management()
			{

			\$this->config->load('grocery_crud');
			\$this->config->set_item('grocery_crud_dialog_forms',true);
			\$this->config->set_item('grocery_crud_dialog_color','pink darken-4');
			\$this->config->set_item('grocery_crud_dialog_text_color','white');

					\$crud = new grocery_CRUD();
                    \$crud->set_theme('mdb'); // magic code
					\$crud->set_table('customers');
					\$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
					\$crud->display_as('salesRepEmployeeNumber','from Employeer')
						 ->display_as('customerName','Name')
						 ->display_as('contactLastName','Last Name');
					\$crud->set_subject('Customer');
					\$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

					\$output = \$crud->render();

					\$this->_example_output(\$output);
			}");

			$this->_example_output($output);
	}

	public function orders_management()
	{

			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);
			$this->config->set_item('grocery_crud_dialog_color','deep-purple darken-3');
			$this->config->set_item('grocery_crud_dialog_text_color','white');

			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);

			$crud = new grocery_CRUD();
            $crud->set_theme('mdb'); // magic code
			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');

			$crud->unset_add();
			$crud->unset_delete();

			$output = $crud->render();

            $output->codes = nl2br("
			public function orders_management()
			{

			\$this->config->load('grocery_crud');
			\$this->config->set_item('grocery_crud_dialog_forms',true);
			\$this->config->set_item('grocery_crud_dialog_color','deep-purple darken-3');
			\$this->config->set_item('grocery_crud_dialog_text_color','white');

					\$crud = new grocery_CRUD();

					\$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
					\$crud->display_as('customerNumber','Customer');
					\$crud->set_table('orders');
					\$crud->set_subject('Order');

					\$crud->unset_add();
					\$crud->unset_delete();

					\$output = \$crud->render();

					\$this->_example_output(\$output);
			}");

			$this->_example_output($output);
	}

	public function products_management()
	{

			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);
			$this->config->set_item('grocery_crud_dialog_color','green lighten-3');
			$this->config->set_item('grocery_crud_dialog_text_color','black');

			$crud = new grocery_CRUD();
            $crud->set_theme('mdb'); // magic code
			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));

			$output = $crud->render();

			$output->codes = nl2br("
			public function products_management()
			{

			\$this->config->load('grocery_crud');
			\$this->config->set_item('grocery_crud_dialog_forms',true);
			\$this->config->set_item('grocery_crud_dialog_color','green lighten-3');
			\$this->config->set_item('grocery_crud_dialog_text_color','black');

					\$crud = new grocery_CRUD();
		            \$crud->set_theme('mdb'); // magic code
					\$crud->set_table('products');
					\$crud->set_subject('Product');
					\$crud->unset_columns('productDescription');
					\$crud->callback_column('buyPrice',array(\$this,'valueToEuro'));

					\$output = \$crud->render();

					\$this->_example_output(\$output);
			}");

			$this->_example_output($output);
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	public function film_management()
	{

			$this->config->load('grocery_crud');
			$this->config->set_item('grocery_crud_dialog_forms',true);
			$this->config->set_item('grocery_crud_dialog_color','orange darken-1');
			$this->config->set_item('grocery_crud_dialog_text_color','white');

		$crud = new grocery_CRUD();
        $crud->set_theme('mdb'); // magic code
		$crud->set_table('film');
		$crud->set_subject('Film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');

		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

		$output = $crud->render();

        $output->codes = nl2br("
		public function film_management()
		{

			\$this->config->load('grocery_crud');
			\$this->config->set_item('grocery_crud_dialog_forms',true);
			\$this->config->set_item('grocery_crud_dialog_color','orange darken-1');
			\$this->config->set_item('grocery_crud_dialog_text_color','white');

			\$crud = new grocery_CRUD();
	        \$crud->set_theme('mdb'); // magic code
			\$crud->set_table('film');
			\$crud->set_subject('Film');
			\$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			\$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			\$crud->unset_columns('special_features','description','actors');

			\$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

			\$output = \$crud->render();

			\$this->_example_output(\$output);
		}");

		$this->_example_output($output);
	}

	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$this->_example_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}

	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('mdb'); // magic code
		$crud->set_table('offices');
		$crud->set_subject('Office');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function employees_management2()
	{
		$crud = new grocery_CRUD();
        $crud->set_theme('mdb'); // magic code
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');

		$crud->required_fields('lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

	public function customers_management2()
	{
		$crud = new grocery_CRUD();
        $crud->set_theme('mdb'); // magic code
		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');

		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));

		$output = $crud->render();

		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}

}