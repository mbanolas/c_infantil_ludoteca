<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Ludotecas_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
        }
      
        function getLudotecaArray($ludoteca){
            $sql="SELECT * FROM c_ludotecas u 
                  LEFT JOIN c_cursos c ON u.id_curso=c.num_curso
                  WHERE  u.id='$ludoteca'
                " ;
            // mensaje($sql);	
            $row=$this->db->query($sql)->row_array();
            return $row;
    }

    function getLudoteca($ludoteca){
        $sql="SELECT *
          FROM c_ludotecas lu 
          LEFT JOIN c_cursos c ON lu.id_curso=c.num_curso
          WHERE  lu.id='$ludoteca'
        " ;
         mensaje('$sql getLudoteca '.$sql);
        $row=$this->db->query($sql)->row();
        return $row;
}

function comprobarInscripcionLudoteca($num_ludoteca=0)
{   
    mensaje('comprobarInscripcionLudoteca num_ludoteca '+$num_ludoteca);
    if(!$num_ludoteca) return "No se ha introducido ninguna ludoteca"; 
    $resultado = "";
    $query = "SELECT lu.num_maximo, 
                        lu.inscripciones,
                        lu.nombre_ludoteca
                       FROM c_ludotecas lu 
                       WHERE lu.id='$num_ludoteca'";

    mensaje('$query '.$query);                   
    if ($this->db->query($query)->num_rows()) 
        $row = $this->db->query($query)->row();

    //comprobando si está lleno y proponiendo siguiente grupo
    if (isset($row) && $row->inscripciones >= $row->num_maximo) {
        $resultado = "Esta ludoteca esta completo. <br>";
        return $resultado;
    }

    return $resultado;
}

function calcularPrecio(){
    extract($_POST);
    mensaje('$trimestre '.$trimestre);
    $sql="SELECT * FROM c_ludotecas WHERE num_ludoteca='$actividad'";
    mensaje('calcularPrecioLudoteca $sql '.$sql);
    if($this->db->query($sql)->num_rows()==0) {
        $precio=0;
        return $precio;
    }
    else{
        $resultadoLudoteca=$this->db->query($sql)->row();
        if($resultadoLudoteca->id_pago_global==1){
            $precio=0;
        }
        else{
            $precio=0;
    // $actividad=$_POST['actividad'];
    // $trimestre=$_POST['trimestre'];
    // $hermanosActividad=$_POST['hermanosActividad'];
    // $hermanosNum=$_POST['hermanosNum'];
    // $edad=$_POST['edad'];
    // $query="SELECT * FROM c_actividades_infantiles WHERE num_actividad='$actividad'";
    $query="SELECT * FROM c_ludotecas WHERE num_ludoteca='$actividad'";
    $row=$this->db->query($query)->row();
    if(!$actividad) {
        return $precio;
    }
    else {
        mensaje('$trimestre '+$trimestre);
        if($edad>=0 && $edad<=3) {
            $precio=1.0*$row->precio_infancia_anual;
        }
        else{
            if($trimestre==1) $precio=1.0*$row->precio_general_anual;
            if($trimestre==2) $precio=1.0*$row->precio_general_trimestre;
            if($trimestre==3) $precio=1.0*($row->precio_general_trimestre);
            if($trimestre==4) $precio=1*$row->precio_general_trimestre;
            if($trimestre==5) $precio=2.0*$row->precio_general_trimestre;
            if($trimestre==6) $precio=2.0*$row->precio_general_trimestre;
            if($trimestre==7) $precio=2.0*$row->precio_general_trimestre;

            if($hermanosActividad>0 && $hermanosNum==1) $precio=$precio*(100-$row->descuento_primer_hermano)/100;
            if($hermanosActividad>0 && $hermanosNum>1) $precio=$precio*(100-$row->descuento_siguientes_hermanos)/100;
        }
        $precio=$precio*(100+$row->iva)/100;
        return $precio;
    }











        }
        
        return $precio;

    }

}



}
		