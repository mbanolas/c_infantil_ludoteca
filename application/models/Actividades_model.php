<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Actividades_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function resultTrimestres($id_trimestres){
            if ($id_trimestres) {
                $numTrimestres = explode(",", $id_trimestres);
                $result = array();
                // mensaje('$numActividades '.$numActividades);
                if ($numTrimestres) {
                    foreach ($numTrimestres as $k => $v) {
                        $result[] = $this->db->query("SELECT id,num_trimestre,texto_trimestre FROM c_trimestres WHERE id='$v'")->row();
                    }
                    return $result;
                }
            }
            return $result;
    }
    function resultActividades($id_actividades){
            if ($id_actividades) {
                $numActividades = explode(",", $id_actividades);
                $resultados = array();
                // mensaje('$numActividades '.$numActividades);
                if ($numActividades) {
                    foreach ($numActividades as $k => $v) {
                        $resultados[] = $this->db->query("SELECT num_actividad,descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row();
                    }
                    return $resultados;
                }
            }
            return $resultados;
    }
    

    function getActividad($num_actividad){
        $result = $this->db->query("SELECT id,num_actividad,descripcion FROM c_actividades_infantiles WHERE id_curso='1'")->row();
        return $result;
    }

    function getActividades($tipo_actividad=0)
    {
        switch($_SESSION['tipo_actividad']){
            case 0:
                $whereActividades=" 1 ";
            break;
            case 1:
                $whereActividades=" nombre_actividad like '%relacional%' ";
            break;
            case 2:
                $whereActividades=" nombre_actividad like '%nadal%' ";
            break;
            case 3:
                $whereActividades=" nombre_actividad like '%estiu%' ";
            break;
            case 4:
                $whereActividades=" nombre_actividad like '%ludoteca%' ";
            break;
            default:
            $whereActividades=" 1 ";
        }
        $sql="SELECT id,num_actividad,descripcion, inscripciones>=num_maximo as completa FROM c_actividades_infantiles WHERE id_curso='1' AND $whereActividades ";
        mensaje($sql);
        $result = $this->db->query($sql)->result();
        return $result;
    }
    function getPeriodos()
    {
        $result = $this->db->query("SELECT id,num_trimestre,texto_trimestre FROM c_trimestres ")->result();
        return $result;
    }
    function putDatos()
    {
        $precioAnual = $_POST['precioAnual'];
        $precioTrimestral = $_POST['precioTrimestral'];
        $precioMensual = $_POST['precioMensual'];
        $horarioDesde = $_POST['horarioDesde'];
        $horarioHasta = $_POST['horarioHasta'];
        $actividades = explode(',', $_POST['actividadesAplicar']);
        mensaje('actividadesAplicar ' . $_POST['actividadesAplicar']);
        $sql = "UPDATE c_actividades_infantiles SET 
        ";
        $sql .= $precioAnual ? "precio_general_anual='$precioAnual'," : "";
        $sql .= $precioTrimestral ? "precio_general_trimestre='$precioTrimestral'," : "";
        $sql .= $precioMensual ? "precio_general_mes='$precioMensual'," : "";
        $sql .= $horarioDesde ? "horario_desde='$horarioDesde'," : "";
        $sql .= $horarioHasta ? "horario_hasta='$horarioHasta'," : "";
        $sql = rtrim($sql, ',');
        $sql .= " WHERE ";
        foreach ($_POST['actividadesAplicar'] as $k => $v) {
            $sql .= "num_actividad='$v' or ";
        }
        $sql = rtrim($sql, ' or ');
        mensaje($sql);
        if(!$_POST['actividadesAplicar']) return 0;
        if(!$precioAnual && !$precioTrimestral && !$precioMensual && !$horarioDesde && !$horarioHasta) return 0;
        $this->db->query($sql);
        return 1;
    }

    function comprobarInscripcion($actividades)
    {
        // mensaje('comprobar actividades '.$actividades);
        if (is_null($actividades)) return "No se ha introducido ninguna actividad";
        return "";
        // $actividadesArray=explode(",",$actividades);
        // // mensaje('num_actividad '+$num_actividad);
        // if(empty( $actividadesArray )) return "No se ha introducido ninguna actividad"; 
        // return "";



        //lo que sigue no se utiliza. Viene de la gestion de actividades anterior, siguiente y lista espera
        $resultado = "";
        $query = "SELECT a.num_maximo, 
                            a.grupo_anterior, 
                            a.grupo_siguiente,
                            a.lista_espera,
                            a.inscripciones,
                            a.nombre_actividad,
                            g.texto_grupo,
                            a.descripcion
                           FROM c_actividades_infantiles a 
                           LEFT JOIN c_grupos g ON g.num_grupo=a.id_grupo 
                           WHERE a.id='0'";
        if ($this->db->query($query)->num_rows()) $row = $this->db->query($query)->row();

        $anterior = $row->grupo_anterior;
        $query = "SELECT a.num_maximo, 
                            a.grupo_anterior, 
                            a.grupo_siguiente,
                            a.lista_espera,
                            a.inscripciones,
                            a.nombre_actividad,
                            g.texto_grupo,
                            a.descripcion       
                            FROM c_actividades_infantiles a 
                           LEFT JOIN c_grupos g ON g.num_grupo=a.id_grupo 
                           WHERE a.id='$anterior'";
        if ($this->db->query($query)->num_rows()) $row_anterior = $this->db->query($query)->row();

        $siguiente = $row->grupo_siguiente;
        $query = "SELECT a.num_maximo, 
                            a.grupo_anterior, 
                            a.grupo_siguiente,
                            a.lista_espera,
                            a.inscripciones,
                            a.nombre_actividad,
                            g.texto_grupo,
                            a.descripcion
                            FROM c_actividades_infantiles a 
                           LEFT JOIN c_grupos g ON g.num_grupo=a.id_grupo 
                           WHERE a.id='$siguiente'";
        if ($this->db->query($query)->num_rows()) $row_siguiente = $this->db->query($query)->row();

        $listaEspera = $row->lista_espera;
        $query = "SELECT a.num_maximo, 
                            a.grupo_anterior, 
                            a.grupo_siguiente,
                            a.lista_espera,
                            a.inscripciones,
                            a.nombre_actividad,
                            g.texto_grupo,
                            a.descripcion 
                            FROM c_actividades_infantiles a 
                            LEFT JOIN c_grupos g ON g.num_grupo=a.id_grupo 
                            WHERE a.id='$listaEspera'";
        if ($this->db->query($query)->num_rows()) $row_listaEspera = $this->db->query($query)->row();

        //comprobando si existen en lista de espera
        if (isset($row_listaEspera) && $row_listaEspera->inscripciones > 0) {
            $resultado = "No se puede realizar la inscripción porque existen " . $row_listaEspera->inscripciones . " usuarios en lista de espera. ";
            return $resultado;
        }

        //comprobando si anterior grupo esta completo
        if (isset($row_anterior) && $row_anterior->inscripciones < $row_anterior->num_maximo) {
            $resultado = "El anterior grupo NO está completo. Realice la inscripción en: <br><strong>" . $row_anterior->descripcion . '</strong>';
            return $resultado;
        }
        //comprobando si está lleno y proponiendo siguiente grupo
        if (isset($row) && $row->inscripciones >= $row->num_maximo) {
            $resultado = "Este grupo grupo está completo. <br>";
            if (isset($row_siguiente)) $resultado .= "Probar realizarla en: <br><strong>" . $row_siguiente->descripcion . '</strong>';
            else $resultado .= "El grupo y la llista d'espera están complets";
            return $resultado;
        }

        return $resultado;
    }

    function getDatosActividades($id_curso = "", $numActividad = "")
    {
        $result = array();
        if (!$id_curso) return $result;
        $where = "1";
        if (!$numActividad) $where = "1";
        else $where = " u.id_actividad='$numActividad'";
        $query = "SELECT u.nombre_alumno as nombre_alumno,
                           u.apellido1_alumno as apellido1_alumno,
                           u.apellido2_alumno as apellido2_alumno,
                           u.precio as precio,
                           u.id_actividad as id_actividad,
                           a.descripcion as descripcion,
                           a.horario_desde as desde,
                           a.horario_hasta as hasta,
                           a.nombre_actividad as nombre_actividad,
                           g.texto_grupo as grupo,
                           t.texto_trimestre as periodo,
                           c.texto_curso as texto_curso
                    FROM c_usuarios u 
                    LEFT JOIN c_actividades_infantiles a ON u.id_actividad=a.id 
                    LEFT JOIN c_trimestres t ON u.id_trimestre=t.num_trimestre
                    LEFT JOIN c_grupos g ON u.id_grupo=g.num_grupo
                    LEFT JOIN c_cursos c ON u.id_curso=c.num_curso
                    WHERE u.id_curso='$id_curso' AND u.pagado='1' AND $where
                    ORDER BY u.id_actividad ";

        // mensaje('getInscripcionesPagadas '.$query);            
        $queryTotales = "SELECT count(*) as num, sum(u.precio) as total
                        FROM c_usuarios u 
                        WHERE u.id_curso='$id_curso' AND u.pagado='1' AND $where";
        $textoCurso = $this->db->query("SELECT texto_curso FROM c_cursos WHERE num_curso='$id_curso'")->row()->texto_curso;
        $actividad = $numActividad == "" ? "Totes les activitats" : $this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$numActividad'")->row()->descripcion;
        $desde = $numActividad == "" ? "" : $this->db->query("SELECT horario_desde FROM c_actividades_infantiles WHERE num_actividad='$numActividad'")->row()->horario_desde;
        $hasta = $numActividad == "" ? "" : $this->db->query("SELECT horario_hasta FROM c_actividades_infantiles WHERE num_actividad='$numActividad'")->row()->horario_hasta;
        // mensaje('getInscripcionesPagadas totales'.$queryTotales);
        $result = $this->db->query($query)->result();
        $resultTotal = $this->db->query($queryTotales)->row();
        return array('result' => $result, 'resultTotal' => $resultTotal, 'textoCurso' => $textoCurso, 'actividad' => $actividad, 'desde' => substr($desde, 0, 5), 'hasta' => substr($hasta, 0, 5));
    }




    function getTablaInscripcionesPagadas($id_curso = "", $numActividad = "")
    {
        $datos = $this->getDatosActividades($id_curso, $numActividad);
        extract($datos);

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

        foreach ($result as $k => $v) {
            $p = $k + 1;
            $tabla .= "<tr>
                <td scope='row'>$p</td>
                <td>" . $v->nombre_actividad . "  - " . $v->grupo . "</td>
                <td>" . $v->nombre_alumno . " " . $v->apellido1_alumno . ' ' . $v->apellido2_alumno . "</td>
                <td>" . $v->periodo . "</td>
                <td class='numero'>" . $v->precio . "</td>
                </tr>";
        }
        $total = $resultTotal->total == "" ? 0 : $resultTotal->total;
        $tabla .= " </tbody>
            <tfood>
            <th>" . $resultTotal->num . "</th>
            <th></th>
            <th></th>
            <th></th>
            <th class='numero'>" . $total . "</th>
            </tfood>
            </table>";
        return $tabla;
    }

    function getCursosOptions()
    {
        $result = $this->db->query("SELECT * FROM c_cursos ORDER BY texto_curso DESC")->result();
        $options = '<option value="" disabled selected>Escollir un curs</option>';
        foreach ($result as $k => $v) {
            $options .= "<option value='" . $v->num_curso . "'>" . $v->texto_curso . "</option>";
        }
        return $options;
    }

    function getActividadesOptions($curso)
    {
        $result = $this->db->query("SELECT * FROM c_actividades_infantiles
                                WHERE id_curso='$curso'
                                ORDER BY nombre_actividad 
                                ")->result();
        $options = '<option value="" disabled selected>Escollir una activitat</option>';
        foreach ($result as $k => $v) {
            $options .= "<option value='" . $v->num_actividad . "'>" . $v->descripcion . "</option>";
        }
        return $options;
    }

    function getPreciosActividades()
    {
        foreach($_POST['actividades'] as $k=>$v){
                mensaje('$actividades post getPreciosActividades '.$k.' '.$v);
        }
        foreach($_POST['trimestres'] as $k=>$v){
                mensaje('$trimestres post getPreciosActividades '.$k.' '.$v);
        }
        $actividades = $_POST['actividades'];
        $trimestres = $_POST['trimestres'];
        
        $numHermano = $_POST['numHermano'];
        $usuario = $_POST['usuario'];
        $descuentoAyuntamiento = $_POST['descuentoAyuntamiento'];
        $descuentoServiciosSociales = $_POST['descuentoServiciosSociales'];
        $idBecas=2;
        if($descuentoAyuntamiento!=0 || $descuentoServiciosSociales!=0) $idBecas=1;
        $idHermanosActividad=2;
        if($numHermano!=0 ) $idHermanosActividad=1;

        $precioAcordado = $_POST['precioAcordado'];
        mensaje('precioAcordado '.$precioAcordado);

        // grabamos los datos introducidos en inscripcion en c_usuarios
        $sql="UPDATE c_usuarios SET 
            hermano_num='$numHermano', 
            becas_descuento_ayuntamiento='$descuentoAyuntamiento',
            becas_descuento_servicios_sociales='$descuentoServiciosSociales',
            id_becas='$idBecas',
            id_hermanos_actividad='$idHermanosActividad'
            WHERE num_usuario='$usuario'";
        mensaje($sql);
        $this->db->query($sql);


        $precio = 0;
        mensaje('$actividades '.$actividades[0]);
        $listaEspera=array();
        foreach ($actividades as $k => $v) {
            
            switch ($trimestres[0] % 10) {
                case 0:

                case 7:
                    $campoPrecio = 'precio_general_anual';
                    break;
                case 3:
                    $campoPrecio = 'precio_general_trimestre';
                    break;
                case 1:
                    $campoPrecio = 'precio_general_mes';
                    break;
                
                default:
                    $campoPrecio = 'precio_general_trimestre';;
            }
            $row=$this->db->query("SELECT $campoPrecio,iva,descuento_primer_hermano,descuento_siguientes_hermanos FROM c_actividades_infantiles WHERE num_actividad='$v'")->row_array();
            mensaje('$row[$campoPrecio] '.$row[$campoPrecio]);
            mensaje('$row[descuento_primer_hermano] '.$row['descuento_primer_hermano']);
            mensaje('$row[descuento_siguientes_hermanos] '.$row['descuento_siguientes_hermanos']);
            mensaje('$numHermano '.$numHermano);
            mensaje('$row[iva] '.$row['iva']);
           
            //comprobamos si la actividad esta completa si sí el precio es 0
            $rowVacantes=$this->db->query("SELECT num_maximo-inscripciones as vacantes, descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row();
            if($rowVacantes->vacantes<=0){
                $row[$campoPrecio]=0;
                $listaEspera[]=array('num_actividad'=>$v,'descripcion'=>$rowVacantes->descripcion);
            }

            $precio+=$row[$campoPrecio]
                      *(1+$row['iva']/100)*(1-$row['descuento_primer_hermano']*($numHermano==1?1:0)/100)
                      *(1-$row['descuento_siguientes_hermanos']*($numHermano>1?1:0)/100)
                      ;
             mensaje('precio '.$precio);         
            }
            $numPeriodos=count($trimestres);
            mensaje('numPeriodos '.$numPeriodos);         
            
            $precio*=$numPeriodos;
            mensaje('precio con mum periodos '.$precio);         
        $precio=$precio*(1-$descuentoAyuntamiento/100)*(1-$descuentoServiciosSociales/100);
        $precioAPagar=$precioAcordado!=0?1*$precioAcordado:$precio;
        
        mensaje('$actividades ' . $actividades);
        mensaje('$trimestres ' . $trimestres);
        mensaje('$numHermano ' . $numHermano);
        mensaje('$usuario ' . $usuario);
        mensaje('$descuentoAyuntamiento ' . $descuentoAyuntamiento);
        mensaje('$descuentoServiciosSociales ' . $descuentoServiciosSociales);
        
        return array('precioEstandard'=>$precio, 'precioAPagar'=>$precioAPagar,'actividadesListaEspera'=>$listaEspera);
    }
}
