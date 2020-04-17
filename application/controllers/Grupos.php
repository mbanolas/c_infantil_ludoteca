<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Grupos extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        // $this->load->model('general_model');


    }

    public function grupos()
    {

        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_grupos';

        $crud->set_table($table)
            ->set_subject('Grups')
            ->unset_clone()
            ->unset_read()
            ->unset_delete();

        $crud
            ->display_as('texto_grupo', 'Text grup')
            ->display_as('num_grupo', 'Núm grup')
            
        ;   
        $state = $crud->getState();

        $output = $crud->render();

        if ($state == 'add') {
            $sql="SELECT num_grupo FROM c_grupos ORDER by num_grupo DESC LIMIT 1";
            if($this->db->query($sql)->num_rows()==0) $siguiente=1;
            else{
                $siguiente=$this->db->query("SELECT num_grupo FROM c_grupos ORDER by num_grupo DESC LIMIT 1")->row()->num_grupo+1;
            }
            $js =   '<script> 
                    $(\'#field-num_grupo\').val("'.$siguiente.'");
                    </script>';

            $output->output .= $js;
        }

        $this->_grupos_output($output);
    }

    public function _grupos_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/grupos.php', (array)$output);
        $this->load->view('templates/pieGrocery');
    }


}