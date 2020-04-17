<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportExcel extends CI_Controller {

    function __construct()
	{
        parent::__construct();
    }

    function inscripciones(){
        mensaje('desde exportar. Ahora puedo generar todo el EXCEL desde aquí');
        $this->load->library('excel');
        $datos['display']=array(
            'id'=> 'Ins. ',
            'num_inscripcion'=> 'Ins. ',
            'id_curso'=> 'Curs ',
            'id_usuario'=> 'Usuari ',
            'id_actividades'=> 'Activitats ',
            'id_trimestres'=> 'Períodes ',
            'nombre_alumno'=> 'Nom nen/nena ',
            'apellido1_alumno'=> 'Primer cognom nen/nena ',
            'apellido2_alumno'=> 'Segon cognom nen/nena ',
            'actividades'=> 'Activitats ',
            'trimestres'=> 'Períodes ',
            'precio_a_pagar'=> 'Preu a pagar ',
            'pendiente_pago'=> 'Pendent pagament ',
            'numHermano'=> 'Germà núm ',
            'precio_estandard'=> 'Preu estàndard',
            'precio_acordado'=> 'Preu',
            'descuento_ayuntamiento'=> 'Descompte Ayuntament ',
            'descuento_servicios_sociales'=> 'Descompte Serveis Socials ',
            'pago'=> 'Pagat',
            'fecha_alta'=> 'Data alta',
            'fecha_modificacion'=> 'Data modificació',
            'id_user_alta'=> 'Alta per',
            'id_user_modificacion'=> 'Modificat per',
            'nombre'=> 'Nom',
            'apellido1'=> 'Primer cognom',
            'apellido2'=> 'Segon cognom',
        );
        $datos['result']=$this->db->query("SELECT * FROM c_inscripciones")->result();
        $sql="SELECT `COLUMN_NAME`,`DATA_TYPE`  
                        FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                        WHERE `TABLE_SCHEMA`='".$this->db->database."' 
                        AND `TABLE_NAME`='c_inscripciones'";
        mensaje($sql) ;               
        $result=$this->db->query($sql)->result_array();
        $datos['campos']=array_column($result, 'COLUMN_NAME');
        $datos['tipo']=array_column($result, 'DATA_TYPE');

        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/seleccionarDatosInscripciones', $datos);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
        // $this->load->view('viewsTables/excelInscripciones', $datos);  
  }

    function excelInscripciones(){
        mensaje('desde exportar. Ahora puedo generar todo el EXCEL desde aquí');
        
        $this->load->library('excel');
        $datos['display']=array(
            'id'=> 'Ins. ',
            'num_inscripcion'=> 'Ins. ',
            'id_curso'=> 'Curs ',
            'id_usuario'=> 'Usuari ',
            'id_actividades'=> 'Activitats ',
            'id_trimestres'=> 'Períodes ',
            'nombre_alumno'=> 'Nom nen/nena ',
            'apellido1_alumno'=> 'Primer cognom nen/nena ',
            'apellido2_alumno'=> 'Segon cognom nen/nena ',
            'actividades'=> 'Activitats ',
            'trimestres'=> 'Períodes ',
            'precio_a_pagar'=> 'Preu a pagar ',
            'pendiente_pago'=> 'Pendent pagament ',
            'numHermano'=> 'Germà núm ',
            'precio_estandard'=> 'Preu estàndard',
            'precio_acordado'=> 'Preu',
            'descuento_ayuntamiento'=> 'Descompte Ayuntament ',
            'descuento_servicios_sociales'=> 'Descompte Serveis Socials ',
            'pago'=> 'Pagat',
            'fecha_alta'=> 'Data alta',
            'fecha_modificacion'=> 'Data modificació',
            'id_user_alta'=> 'Alta per',
            'id_user_modificacion'=> 'Modificat per',
            'nombre'=> 'Nom',
            'apellido1'=> 'Primer cognom',
            'apellido2'=> 'Segon cognom',
        );
        $sql="SELECT i.*, u.nombre as id_user_modificacion FROM c_inscripciones i
                LEFT JOIN c_users u ON i.id_user_modificacion=u.id
        ";
        $datos['result']=$this->db->query($sql)->result();
        
        $datos['campos']=array();
        foreach($_POST as $k=>$v){
            $datos['campos'][]=$k;
        }

         $this->load->view('viewsTables/excelInscripciones', $datos);  
    }

}