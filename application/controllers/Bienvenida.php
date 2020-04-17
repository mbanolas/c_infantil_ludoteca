<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Bienvenida extends CI_Controller {

    function __construct()
	{
        parent::__construct();
        $this->load->model('maba_model');
    }

    function index(){ 
        $datos['bienvenida']=$this->session->userdata('sexo')?"Benvinguda":"Benvingut";  
        $datos['usuario']=$this->session->userdata('nombre');
        switch($this->session->userdata('categoria')){
            case 0:
                $datos['categoria']='Administrador Tienda';
                break;
            case 1:
                $datos['categoria']='Administrador Sistema Informàtic';
                break;
            case 2:
                $datos['categoria']='Coordinadora';
                break;
            case 3:
                $datos['categoria']='Dinamitzadora';
                break;
            case 4:
                $datos['categoria']='Administración';
                break;
            default:
                $datos['categoria']='Sin Catalogar';
        }
        $ahora=date('d/m/Y h:i:s');
        if(!$this->session->userdata('categoria')) {
            $this->load->view('inicio.php',$datos);
            return;
        }
        if($this->session->userdata('categoria')!=1)
            $this->maba_model->sendEmail('mbanolas@gmail.com','Entrada aplicación ',getTituloCasal().'<br><br>Ha iniciado la aplicación<br>Usuario: <strong>'.$this->session->nombre.'</strong><br>Fecha: <strong>'.$ahora.'</strong>' );

        //echo  $datos['bienvenida']; 
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
	 	$this->load->view('bienvenida.php',$datos);
        $this->load->view('templates/pie');
    }

    function sizePantallaEmail(){
        $ancho=$_POST['ancho'];
        $alto=$_POST['alto'];
        $ahora=date('d/m/Y H:i:s');
        // if($this->session->categoria!=1){
        if(true){
            $this->maba_model->sendEmail('mbanolas@gmail.com','Entrada aplicación ',getTituloCasal().'<br><br>Ha iniciado la aplicación<br>Usuario: <strong>'.$this->session->nombre.'</strong><br>Fecha: <strong>'.$ahora.'</strong>'."<br>Pantalla: <strong>$ancho x $alto</strong>" );
            // enviarEmail($this->email, 'Entrada aplicación',host().' - Pernil181','Sesión iniciada por: <br>Usuario: '.$this->session->nombre.'<br>Fecha: '.$ahora."<br>Ancho pantalla: $ancho <br>Alto: $alto",3);
        }
        echo  json_encode(0);
    }


}