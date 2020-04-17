<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Asistentes_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getAsistencias($usuario,$curso,$actividades,$trimestres){
        foreach($actividades as $k=>$v){
            $actividadesArray[$k]=" id_actividad='$v' ";
        }
        $actividades=implode(' OR ',$actividadesArray);
        foreach($trimestres as $k=>$v){
            $trimestresArray[$k]=" id_trimestre='$v' ";
        }
        $trimestres=implode(' OR ',$trimestresArray);
        
        
        $sql="SELECT * FROM c_asistentes WHERE id_usuario='$usuario' AND id_curso='$curso' AND ($actividades) AND ($trimestres)";
        $result=$this->db->query($sql)->result;

        return $sql;
    }
}
