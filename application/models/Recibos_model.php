<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Recibos_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getExcelArqueo($desde, $hasta){

        // $tituloCasal = strtoupper(getTituloCasal());
        // $datosCabecera = array();
        // $datosCabecera['equipament'] = 'EQUIPAMENT MUNICIPAL: ' . $tituloCasal;
        // $datosCabecera['adjudicatari'] = 'ADJUDICATARI: SERVEIS A LES PERSONES INCOOP, SCCL';
        // $datosCabecera['nif'] = 'NIF ADJUDICATARI: F60137411';
        // $datosCabecera['contarcte'] = 'NÚM CONTRACTE: 18001022';
        // $datosCabecera['periodo'] = 'Periode: ' . substr($desde, 8, 2) . '/' . substr($desde, 5, 2) . '/' . substr($desde, 0, 4) . ' - ' . substr($hasta, 8, 2) . '/' . substr($hasta, 5, 2) . '/' . substr($hasta, 0, 4);
        $sql="SELECT * FROM c_recibos WHERE fecha_recibo>='$desde' AND fecha_recibo<='$hasta'";
        mensaje($sql);
        return $this->db->query($sql)->result();
    }

    function getExcelInformeAyuntamiento($desde, $hasta)
    {
        if(!$desde) {
            $fecha_recibo=$this->db->query("SELECT fecha_recibo FROM c_recibos order by fecha_recibo LIMIT 1")->row()->fecha_recibo;
            $desde=fechaEuropea($fecha_recibo);
        }
        if(!$hasta) $hasta=date('d/m/Y');

        $desde = fechaEuropeaToBaseDatos($desde);
        $hasta = fechaEuropeaToBaseDatos($hasta);

        $tituloCasal = strtoupper(getTituloCasal());
        $datosCabecera = array();
        $datosCabecera['equipament'] = 'EQUIPAMENT MUNICIPAL: ' . $tituloCasal;
        $datosCabecera['adjudicatari'] = 'ADJUDICATARI: SERVEIS A LES PERSONES INCOOP, SCCL';
        $datosCabecera['nif'] = 'NIF ADJUDICATARI: F60137411';
        $datosCabecera['contarcte'] = 'NÚM CONTRACTE: 18001022';
        $datosCabecera['periodo'] = 'Periode: ' . substr($desde, 8, 2) . '/' . substr($desde, 5, 2) . '/' . substr($desde, 0, 4) . ' - ' . substr($hasta, 8, 2) . '/' . substr($hasta, 5, 2) . '/' . substr($hasta, 0, 4);

        $letra = getLetraCasal();
        $numeroRegistroCasalIngresos = getNumeroRegistroCasalIngresos();
        $numeroRegistroCasalDevoluciones = getNumeroRegistroCasalDevoluciones();


        $sql = "SELECT id FROM c_recibos WHERE  fecha_recibo>='$desde' AND fecha_recibo<='$hasta' ORDER BY id ASC LIMIT 1";
        mensaje($sql);
        $primero = 0;
        if ($this->db->query($sql)->num_rows() > 0)
            $primero = $this->db->query($sql)->row()->id;

        $sql = "SELECT id FROM c_recibos WHERE  fecha_recibo>='$desde' AND fecha_recibo<='$hasta' ORDER BY id DESC LIMIT 1";
        $ultimo = 0;
        if ($this->db->query($sql)->num_rows() > 0)
            $ultimo = $this->db->query($sql)->row()->id;


        $sql =   "SELECT    r.fecha_recibo, 
                        u.dni_alumno as dni,
                        u.dni_tutor,
                        lu.dni_contratante as dni_contratante,
                        r.num_registro as num_registro,
                        r.num_registro_posicion as num_registro_posicion,
                        r.recibo_num as recibo,
                        a.nombre_actividad as a_nombre,
                        lu.nombre_ludoteca as lu_nombre,
                        g.texto_grupo as grupo, 
                        a.horas_actividad_T1 as a_T1,      
                        a.horas_actividad_T2 as a_T2,      
                        a.horas_actividad_T3 as a_T3,
                        lu.horas_actividad_T1 as lu_T1,      
                        lu.horas_actividad_T2 as lu_T2,      
                        lu.horas_actividad_T3 as lu_T3,   
                        r.id_trimestre as periodos,  
                        r.importe as importe    
                FROM c_recibos r
                LEFT JOIN c_usuarios u ON r.num_usuario=u.Num_usuario
                LEFT JOIN c_ludotecas lu ON r.num_ludoteca=lu.num_ludoteca
                LEFT JOIN c_grupos g ON u.id_grupo=g.num_grupo
                LEFT JOIN c_actividades_infantiles a ON a.num_actividad=u.id_actividad
                WHERE r.id>='$primero' AND r.id<='$ultimo' AND r.num_registro like '%$numeroRegistroCasalIngresos%'
                ORDER BY r.num_registro_posicion
                ";

// INGRESOS
        $sql = "SELECT * FROM c_recibos 
              WHERE id>='$primero' AND id<='$ultimo' AND num_registro like '%$numeroRegistroCasalIngresos%'
              ORDER BY num_registro_posicion  
        ";
        mensaje($sql);

        $recibos = array();
        if ($this->db->query($sql)->num_rows() > 0)
            $recibos = $this->db->query($sql)->result();
        $ingresos = array();

        $importeTotal = 0;
        foreach ($recibos as $k => $v) {
            $linea = array();
            $fecha = $v->fecha_recibo;
            $fecha = substr($fecha, 8, 2) . '/' . substr($fecha, 5, 2) . '/' . substr($fecha, 0, 4);
            $linea['fecha'] = $fecha;
            $linea['numeroRegistroCasal'] = $v->num_registro;
            $linea['dni_tutor'] = $v->dni_tutor;
            $linea['actividades'] = $v->actividades;
            $linea['num_registo'] = $v->num_registro_ingreso;
            $linea['precio_hora'] = 'inf';
            $linea['importe_base'] = $v->importe_base;
            $linea['iva'] = $v->iva;
            $linea['importe_total'] = $v->importe_total;
            $tipo_ingreso = $v->tipo_ingreso;
            switch ($tipo_ingreso) {
                case 1:
                    $tipologia_ingreso = 'Efectiu';
                    break;

                case 2:
                    $tipologia_ingreso = 'Tarjeta';
                    break;
                case 3:
                    $tipologia_ingreso = 'Transferencia';
                    break;
                default:
                    $tipologia_ingreso = 'Transferencia';
            }
            $linea['tipologia'] = $tipologia_ingreso;
            $importeTotal+=$v->importe_total;
            $ingresos[] = $linea;
        }


        // $sql =   "SELECT    r.fecha_recibo, 
        //                 u.dni_alumno as dni,
        //                 u.dni_tutor,
        //                 lu.dni_contratante as dni_contratante,
        //                 r.num_registro as num_registro,
        //                 r.num_registro_posicion as num_registro_posicion,
        //                 r.recibo_num as recibo,
        //                 a.nombre_actividad as a_nombre,
        //                 lu.nombre_ludoteca as lu_nombre,
        //                 g.texto_grupo as grupo, 
        //                 a.horas_actividad_T1 as a_T1,      
        //                 a.horas_actividad_T2 as a_T2,      
        //                 a.horas_actividad_T3 as a_T3,
        //                 lu.horas_actividad_T1 as lu_T1,      
        //                 lu.horas_actividad_T2 as lu_T2,      
        //                 lu.horas_actividad_T3 as lu_T3,   
        //                 r.id_trimestre as periodos,  
        //                 r.importe as importe    
        //         FROM c_recibos r
        //         LEFT JOIN c_usuarios u ON r.num_usuario=u.Num_usuario
        //         LEFT JOIN c_ludotecas lu ON r.num_ludoteca=lu.num_ludoteca
        //         LEFT JOIN c_grupos g ON u.id_grupo=g.num_grupo
        //         LEFT JOIN c_actividades_infantiles a ON a.num_actividad=u.id_actividad
        // WHERE r.id>='$primero' AND r.id<='$ultimo' AND r.num_registro like '%$numeroRegistroCasalDevoluciones%'
        // ORDER BY r.num_registro_posicion
        // ";

$sql = "SELECT * FROM c_recibos 
WHERE id>='$primero' AND id<='$ultimo' AND num_registro like '%$numeroRegistroCasalDevoluciones%'
ORDER BY num_registro_posicion  
";

mensaje($sql);

        $recibos = array();
        if ($this->db->query($sql)->num_rows() > 0)
            $recibos = $this->db->query($sql)->result();

        $devoluciones = array();

        $importeTotalDevoluciones = 0;
        foreach ($recibos as $k => $v) {
            $linea = array();
            $fecha = $v->fecha_recibo;
            $fecha = substr($fecha, 8, 2) . '/' . substr($fecha, 5, 2) . '/' . substr($fecha, 0, 4);
            $linea['fecha'] = $fecha;
            $linea['numeroRegistroCasal'] = $v->num_registro;
            $linea['dni_tutor'] = $v->dni_tutor;
            $linea['actividades'] = $v->actividades;
            $linea['num_registo'] = $v->num_registro_ingreso;
            $linea['precio_hora'] = 'inf';
            $linea['importe_base'] = $v->importe_base;
            $linea['iva'] = $v->iva;
            $linea['importe_total'] = $v->importe_total;
            $tipo_ingreso = $v->tipo_ingreso;
            switch ($tipo_ingreso) {
                case 1:
                    $tipologia_ingreso = 'Efectiu';
                    break;

                case 2:
                    $tipologia_ingreso = 'Tarjeta';
                    break;
                case 3:
                    $tipologia_ingreso = 'Transferencia';
                    break;
                default:
                    $tipologia_ingreso = 'Transferencia';
            }
            $linea['tipologia'] = $tipologia_ingreso;
            $importeTotalDevoluciones+=$v->importe_total;
            $devoluciones[] = $linea;
        }
        $total = $importeTotal + $importeTotalDevoluciones;

        return array('datosCabecera' => $datosCabecera, 'ingresos' => $ingresos, 'devoluciones' => $devoluciones, 'importeTotal' => $importeTotal, 'importeTotalDevoluciones' => $importeTotalDevoluciones);
    }
}
