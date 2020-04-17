<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Cursos extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        // $this->load->model('general_model');


    }

    public function cursos()
    {

        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_cursos';

        $crud->set_table($table)
            ->set_subject('Cursos')
            ->unset_clone()
            ->unset_read()
            // ->unset_delete()
            ;

        // $crud->columns(array('dni_tutor','contrasenya','fecha_alta'));    
        // $crud->callback_after_delete(array($this,'curso_after_delete'));

        $crud->display_as('texto_curso', 'Text curs')
             ->display_as('num_curso', 'Núm curs')
        ;   
        $state = $crud->getState();

        $output = $crud->render();

        if ($state == 'add') {
            $sql="SELECT num_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1";
            if($this->db->query($sql)->num_rows()==0) $siguiente=1;
            else{
                $siguiente=$this->db->query("SELECT num_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->row()->num_curso+1;
            }
            $js =   '<script> 
                    $(\'#field-num_curso\').val("'.$siguiente.'");
                    </script>';

            $output->output .= $js;
        }

        $this->_cursos_output($output);
    }

    public function _cursos_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/contrasenyas.php', (array)$output);
        $this->load->view('templates/pieGrocery', (array)$output);
        $this->load->view('modals/modalInfo', (array)$output);
        $this->load->view('modals/modalSiNo', (array)$output);

    }


    function getDatosActividad($numCurso){
        $numInscipciones=0;
        $numInscipciones=$this->db->query("SELECT count(*) as numInscipciones FROM c_actividades_infantiles WHERE id_curso='$numCurso'")->row()->numInscipciones;
        echo json_encode($numInscipciones); 
    }

    

    public function eliminarCurso($numCurso){
        // mensaje('eliminarCurso '.$numCurso);
        $salida=$this->db->query("DELETE FROM c_cursos WHERE num_curso='$numCurso'");
        $siguiente=$this->db->query("SELECT max(num_curso) as maximo FROM c_cursos")->row()->maximo+1;
        $this->db->query("ALTER TABLE c_cursos AUTO_INCREMENT = $siguiente");
        echo json_encode($salida);  
      } 



}