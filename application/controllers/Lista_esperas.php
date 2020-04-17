<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Lista_esperas extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->model('actividades_model');
        $this->load->model('usuarios_model');
        $this->load->model('asistentes_model');


    }

    public function _lista_esperas_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/lista_esperas.php', (array)$output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array)$output);
        $this->load->view('modals/modalInfo.php', (array)$output);

    }

    
    

    public function lista_esperas(){

    

        $crud = new grocery_CRUD();
	
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_lista_esperas';

          $crud
            ->set_table($table)
            ->order_by('actividad')
            ->set_subject("Llista d'espera")
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_add()
            ->unset_edit()
            ;


            $crud
            ->display_as('curso', 'Curs')
            ->display_as('actividad', 'Activitat')
            ->display_as('trimestre', 'Període')
            ->display_as('usuario', 'Nen/nena')
            ->display_as('inscripcion', 'Inscripció')
            ->display_as('pagado', 'Pagat')
            ->display_as('sexo', 'Sexe')
            

            ;

        $camposColumnas=array(
            'curso',
            'actividad',
            'trimestre',
            'usuario',
            'sexo',
            'inscripcion',
            'pagado',
        );
        $crud
            ->columns($camposColumnas);       
        


        $output = $crud->render();
        $this->_lista_esperas_output($output);

    }


   

   


    
}