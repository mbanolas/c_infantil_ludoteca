<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Listados extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->model('maba_model');
    }
    public function todas($id_curso="")
    {
        $this->load->model('actividades_model');
        $datos['options']=$this->actividades_model->getCursosOptions();
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/listadosTodas',$datos) ;
        $this->load->view('templates/pie');
        $this->load->view('modals/modalPago.php');
        $this->load->view('modals/modalInfo.php');
        
    }
    
    public function una()
    {
        $this->load->model('actividades_model');
        $datos['options']=$this->actividades_model->getCursosOptions();
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/listadosUna',$datos) ;
        $this->load->view('templates/pie');
        $this->load->view('modals/modalPago.php');
        $this->load->view('modals/modalInfo.php');

    }

    public function exportar(){
        extract($_POST);
        $this->load->model('actividades_model');
        $datos=$this->actividades_model->getDatosActividades($id_curso, $numActividad);
       
        $this->load->library('excel');

        $this->load->library('drawing');
        
        $hoja = 0;
        
        $this->load->view('excelListadoActividades',$datos);
    }

    public function exportarTodas(){
        extract($_POST);
        $this->load->model('actividades_model');
        $datos=$this->actividades_model->getDatosActividades($id_curso, $numActividad);
       
        $this->load->library('excel');

        $this->load->library('drawing');
        
        $hoja = 0;
        
        $this->load->view('excelListadoActividadesTodas',$datos);
    }


}