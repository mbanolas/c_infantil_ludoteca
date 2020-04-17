<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Basesdatos extends CI_Controller {

    

    public function __construct()
	{
		parent::__construct();
        // $this->load->library('grocery_CRUD');
    }

    

    function ponerdatos(){
        mensaje('desde Basesdatos ponerdatoscomunes');
        $this->load->model('usuarios_model');
        $this->load->model('actividades_model');
        $datos['usuarios'] = $this->usuarios_model->getUsuarios();
        $datos['actividades'] = $this->actividades_model->getActividades();
        $datos['periodos'] = $this->actividades_model->getPeriodos();
        
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/ponerdatos.php',$datos);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
    }

    function recibo($usuario=0){
        $this->load->model('usuarios_model');
        $this->load->model('actividades_model');
        $datos['usuarios'] = $this->usuarios_model->getUsuarios();
        $datos['actividades'] = $this->actividades_model->getActividades();
        $datos['periodos'] = $this->actividades_model->getPeriodos();
        
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripciones.php',$datos);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');

    }

    function reciboLudoteca($ludoteca){
        $this->load->model('ludotecas_model');
        $rowLudoteca = $this->ludotecas_model->getLudotecaArray($ludoteca);
        
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripcionesAltasLudoteca.php',$rowLudoteca);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');

    }

    function reciboUsuarioLudoteca($usuario){
        $this->load->model('usuariosLudoteca_model');
        $rowUsuario = $this->usuariosLudoteca_model->getUsuarioArray($usuario);
        
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripcionesAltasUsuarioLudoteca.php',$rowUsuario);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');

    }

    


}