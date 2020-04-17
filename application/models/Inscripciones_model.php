<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Inscripciones_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function cobro(){
        $id=$_POST['id'];
        $formaPago=$_POST['forma_pago'];
        $pago=floatval(number_format($_POST['pago'],2));
        $pago_recibo=floatval(number_format($_POST['pago'],2));
        // ponemos el cobro en la inscripcion
        $resultado=$this->db->query("UPDATE c_inscripciones SET pago_recibo='$pago_recibo',  pago=FORMAT(pago+$pago,2), pendiente_pago=FORMAT(pendiente_pago-$pago,2), forma_pago=$formaPago WHERE id='$id'");
        // registrar pago en Recibos
        if(!$resultado) return $resultado;
        $hoy=date("Y-m-d");
        $year=date("Y");
        $quien=$this->session->userdata('id');
        $datos=$this->db->query("SELECT pago, pago_recibo,precio_a_pagar,dni_tutor,i.nombre_alumno, i.apellido1_alumno, i.apellido2_alumno,id_actividades,id_lista_espera,id_trimestres,id_actividades FROM c_inscripciones i
                                LEFT JOIN c_usuarios u ON u.num_usuario=i.id_usuario
                                WHERE i.id='$id'")->row(); 
        $dni_tutor=$datos->dni_tutor;
        $nombre_alumno=$datos->nombre_alumno;
        $apellido1_alumno=$datos->apellido1_alumno;
        $apellido2_alumno=$datos->apellido2_alumno;
        $importe_actividades=$datos->precio_a_pagar;
        $id_actividades=explode(",",$datos->id_actividades);
        $id_listaEspera=explode(",",$datos->id_lista_espera);
        $actividades=array();
        $listaEspera=array();
        foreach($id_actividades as $k=>$v){
            $actividades[]=$this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row()->descripcion;
        }
        foreach($id_listaEspera as $k=>$v){
            $listaEspera[]=$this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row()->descripcion;
        }
        $actividades=implode(", ",$actividades);
        $listaEspera=implode(", ",$listaEspera);

        $siguiente=$this->db->query("SELECT id FROM c_recibos ORDER BY id DESC LIMIT 1")->row()->id +1;
       

        $num_registro="";
        if($pago_recibo>0){
            $posicion=$this->db->query("SELECT posicion FROM c_recibos WHERE importe_total>0 ORDER BY id DESC LIMIT 1")->row()->posicion +1;
            $posicion=strval($posicion);
            while(strlen($posicion)<6){$posicion="0".$posicion;}
            $num_registro=$year.'-'.getNumeroRegistroCasalIngresos().'-'.$posicion;
        }
        if($pago_recibo<0){
            $posicion=$this->db->query("SELECT posicion FROM c_recibos WHERE importe_total<0 ORDER BY id DESC LIMIT 1")->row()->posicion +1;
            $posicion=strval($posicion);
            while(strlen($posicion)<6){$posicion="0".$posicion;}
            $num_registro=$year.'-'.getNumeroRegistroCasalDevoluciones().'-'.$posicion;
        }
        $num_registro_ingreso=getLetraCasal().$siguiente;
        $resultado=$this->db->query("INSERT INTO c_recibos SET
                        id_inscripcion='$id',
                        fecha_recibo='$hoy',
                        num_registro='$num_registro',
                        actividades='$actividades',
                        lista_espera='$listaEspera',
                        num_registro_ingreso='$num_registro_ingreso',
                        importe_base='$pago',
                        iva='0',
                        importe_total='$pago',
                        importe='$pago',
                        quien='$quien',
                        tipo_ingreso='$formaPago',
                        dni_tutor='$dni_tutor',
                        nombre_alumno='$nombre_alumno',
                        apellido1_alumno='$apellido1_alumno',
                        apellido2_alumno='$apellido2_alumno',
                        importe_actividades='$importe_actividades',
                        posicion='$posicion'
                    ");
                
           $id_recibo=$this->db->query("SELECT id FROM c_recibos ORDER BY id DESC LIMIT 1")->row()->id; 
        //    switch($formaPago){
        //        case 1:
        //         $this->db->query("UPDATE c_recibos SET metalico='$pago' WHERE id='$id_recibo'");
        //        break;
        //        case 2:
        //         $this->db->query("UPDATE c_recibos SET tarjeta='$pago' WHERE id='$id_recibo'");
        //        break;
        //        case 3:
        //         $this->db->query("UPDATE c_recibos SET transferencia='$pago' WHERE id='$id_recibo'");
        //        break;
        //    }
           $this->db->query("UPDATE c_inscripciones SET id_recibo='$id_recibo' WHERE id='$id'");

                                
        

    //     //poner datos en c_recibos_nuevo
    //     $resultado=$this->db->query("INSERT INTO c_recibos SET
    //     id_inscripcion='$id',
    //     fecha_recibo='$hoy',
    //     importe='$pago',
    //     tipo_ingreso='$formaPago'
        
    // ");            

        return $id_recibo;
    }

    function getInscripcion($inscripcion)
    {
        $sql="SELECT i.id as id, 
                     i.id_actividades,
                     i.id_lista_espera,
                     i.id_curso,
                     i.id_trimestres,
                     i.precio_a_pagar,
                     i.pendiente_pago,
                     i.precio_acordado,
                     i.pago,
                     i.pago_recibo,
                     i.id_recibo,
                     i.forma_pago,
                     u.id as usuarioId,
                     u.num_usuario,
                     u.nombre_alumno,
                     u.apellido1_alumno,
                     u.apellido2_alumno,
                     u.hermano_num as hermano_num,
                     u.becas_descuento_ayuntamiento descuento_ayuntamiento,
                     u.becas_descuento_servicios_sociales as descuento_servicios_sociales,
                     c.texto_curso 

                      FROM c_inscripciones i
            LEFT JOIN c_cursos c ON c.id=i.id_curso
            LEFT JOIN c_usuarios u ON u.num_usuario=i.id_usuario 
            WHERE i.id='$inscripcion'
        ";
        mensaje($sql);
        $resultInscripcion = $this->db->query($sql)->row();
        $actividadesArray=array();
        $listaEsperaArray=array();
        if(trim($resultInscripcion->id_actividades)) $actividadesArray=explode(",",$resultInscripcion->id_actividades);
        if(trim($resultInscripcion->id_lista_espera)) $listaEsperaArray=explode(",",$resultInscripcion->id_lista_espera);
        $resultActividades=array();
        $resultListaEspera=array();
        foreach($actividadesArray as $k=>$v){
            $resultActividades[]=$this->db->query("SELECT * FROM c_actividades_infantiles WHERE num_actividad='$v'")->row();
        }
        foreach($listaEsperaArray as $k=>$v){
            $resultListaEspera[]=$this->db->query("SELECT * FROM c_actividades_infantiles WHERE num_actividad='$v'")->row();
        }
        $trimestreArray=explode(",",$resultInscripcion->id_trimestres);
        $resultTrimestres=array();
        foreach($trimestreArray as $k=>$v){
            $resultTrimestres[]=$this->db->query("SELECT * FROM c_trimestres WHERE id='$v'")->row();
        }

        return array('resultInscripcion'=>$resultInscripcion,
                     'resultActividades'=>$resultActividades,
                     'resultListaEspera'=>$resultListaEspera,
                     'resultTrimestres'=>$resultTrimestres
                    );
    }

function getTablaInscripcionesPagadas($curso){

    $sql="SELECT i.id_actividades,
            concat(u.nombre_alumno,' ',u.apellido1_alumno,' ',u.apellido2_alumno) as nombre
            FROM c_inscripciones i
            LEFT JOIN c_usuarios u ON u.num_usuario=i.id_usuario
            WHERE i.id_curso='$curso'";
    $result=$this->db->query($sql)->result();  
    $datos=array();
    foreach($result as $k=>$v){
        $actividades=explode(", ",$v->id_actividades);
        
        foreach($actividades as $k1 => $v1){
            $row=$this->db->query("SELECT * FROM c_actividades_infantiles WHERE num_actividad='$v1'")->row();
            mensaje($row->descripcion);
            $datos[]=array('actividad'=>$v1, 'descripcion'=>$row->descripcion, 'alumno'=>$v->nombre);
        }
    }  
    usort($datos, function($a, $b) {
        return $a['descripcion'] <=> $b['descripcion'];
    });
    // return $datos;
    $tabla = "<table class='table table-bordered table-striped'>
            <thead>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Activitat</th>
                <th scope='col'>Nen/nena</th>
                <th scope='col'>Període</th>
                <th scope='col' class='numero'>Import pagat</th>
              </tr>
            </thead>
            <tbody>";
            $p=0;
            foreach($datos as $k=>$v){
               
                $p++;
            $tabla.="<tr>
            <td scope='row'>" . ($p) . "</td>
            <td>" . $v['actividad'].'-'.$v['descripcion'] . "</td>
            <td>" . $v['alumno'] . "</td>
            <td>" . $v->id_trimestres . "</td>
            <td class='numero'>" . ''. "</td>
            </tr>";
            }   
        
        $tabla .= " </tbody>
            <tfood>
            <th>" . '' . "</th>
            <th></th>
            <th></th>
            <th></th>
            <th class='numero'>" . '' . "</th>
            </tfood>
            </table>";
        return $tabla;


}

    }
