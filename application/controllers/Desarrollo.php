<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Desarrollo extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->model('maba_model');
    }

    public function inicializarArchivos(){
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inicializarArchivos.php');
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalSiNo.php');
        $this->load->view('modals/modalInfo.php');
    }

    public function borrarArchivos(){
        $resultado=array();
        // $resultado[]=$this->db->query("DELETE FROM c_usuarios WHERE 1");
        $resultado[]=$this->db->query("DELETE FROM c_recibos WHERE 1");
        $resultado[]=$this->db->query("DELETE FROM c_inscripciones WHERE 1");
        $resultado[]=$this->db->query("DELETE FROM c_asistentes WHERE 1");
        $resultado[]=$this->db->query("DELETE FROM c_lista_esperas WHERE 1");
        $resultado[]=$this->db->query("UPDATE c_actividades_infantiles SET inscripciones=0 WHERE 1");
        $resultado[]=$this->db->query("UPDATE c_actividades_infantiles SET num_maximo=1, inscripciones=1 WHERE id=10");
        $resultado[]=$this->db->query("UPDATE c_actividades_infantiles SET num_maximo=2, inscripciones=2 WHERE id=11");
        // mensaje('borrarArchivos Desarrollo 30');
        // $resultado[]=$this->db->query("DELETE FROM c_actividades_infantiles WHERE 1");
        // $resultado[]=$this->db->query("DELETE FROM c_cursos WHERE 1");
        // $resultado[]=$this->db->query("DELETE FROM c_grupos WHERE 1");
        // $resultado[]=$this->db->query("ALTER TABLE c_usuarios AUTO_INCREMENT = 1");
        $resultado[]=$this->db->query("ALTER TABLE c_recibos AUTO_INCREMENT = 1");
        $resultado[]=$this->db->query("ALTER TABLE c_inscripciones AUTO_INCREMENT = 1");
        $resultado[]=$this->db->query("ALTER TABLE c_asistentes AUTO_INCREMENT = 1");
        $resultado[]=$this->db->query("ALTER TABLE c_lista_esperas AUTO_INCREMENT = 1");
        // $resultado[]=$this->db->query("ALTER TABLE c_actividades_infantiles AUTO_INCREMENT = 1");
        // $resultado[]=$this->db->query("ALTER TABLE c_cursos AUTO_INCREMENT = 1");
        // $resultado[]=$this->db->query("ALTER TABLE c_grupos AUTO_INCREMENT = 1");
        echo json_encode($resultado);
    }

}