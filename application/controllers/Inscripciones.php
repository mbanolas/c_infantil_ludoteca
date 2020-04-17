<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Inscripciones extends CI_Controller
{

   

    public function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->model('usuarios_model');
        $this->load->model('actividades_model');
    }

    // function altas(){
    //     $this->load->view('templates/cabecera');
    // 	$this->load->view('viewsBodies/inscripcionesAltas.php');
    //     $this->load->view('templates/pie');
    // }

    // function bajas(){
    //     $this->load->view('templates/cabecera');
    // 	$this->load->view('viewsBodies/inscripcionesBajas.php');
    //     $this->load->view('templates/pie');
    // }

    function getDatosInscripciones($numUsuario){
        echo json_encode($this->db->query("SELECT count(id_usuario) as inscripciones FROM c_inscripciones WHERE id_usuario='$numUsuario'")->row()->inscripciones);
    }    

    function inscripcionesEntreFechas(){
      
        $datos['casal'] = getTituloCasalCorto();
        $this->load->view('templates/cabecera', $datos);
        $this->load->view('viewsBodies/seleccionFechasInscripciones.php');
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
    }

    function cobro()
    {
        $this->load->model('inscripciones_model');
        $resultado = $this->inscripciones_model->cobro();
        echo json_encode($resultado);
    }

    function ponerDatosAsistentes($inscripcion){
           
        $sql="SELECT * FROM c_inscripciones WHERE id='$inscripcion'";
        if($this->db->query($sql)->num_rows()){
            //borramos todos los datos de c_asistentes con inscripcion =$inscripcion
            $this->db->query("DELETE FROM c_asistentes WHERE inscripcion='$inscripcion'");
            $result=$this->db->query($sql)->result();
            foreach($result as $k=>$v){
                $curso=$this->db->query("SELECT texto_curso FROM c_cursos WHERE num_curso='".$v->id_curso."'")->row()->texto_curso;
                $inscripcion=$v->id;
                $usuario=$v->nombre_alumno.' '.$v->apellido1_alumno.' '.$v->apellido2_alumno;
                $id_usuario=$v->id_usuario;
                $id_curso=$v->id_curso;
                $fecha=$v->fecha_modificacion;
                $sexo=$this->usuarios_model->getTextoSexo($v->id_usuario);
                $pagado=$v->pendiente_pago==0?"Sí":"No";
                $id_actividades=$v->id_actividades;
                $id_trimestres=$v->id_trimestres;
                $resultActividades=$this->actividades_model->resultActividades($id_actividades);
                foreach($resultActividades as $k1=>$v1){
                    $actividad=$v1->descripcion;
                    $id_actividad=$v1->num_actividad;
                    $resultTrimestres=$this->actividades_model->resultTrimestres($id_trimestres);
                    foreach($resultTrimestres as $k2=>$v2){
                        $trimestre=$v2->texto_trimestre;
                        $num_trimestre=$v2->num_trimestre;
                        $id_trimestre=($v2->id)*10+$num_trimestre;
                        // $id_trimestre=($v2->id)*10+$num_trimestre;
                        $this->db->query("INSERT INTO c_asistentes SET 
                                        curso='$curso',
                                        actividad='$actividad',
                                        id_actividad='$id_actividad',
                                        id_curso='$id_curso',
                                        id_usuario='$id_usuario',
                                        trimestre='$trimestre',
                                        id_trimestre='$id_trimestre',
                                        usuario='$usuario',
                                        inscripcion='$inscripcion',
                                        pagado='$pagado',
                                        sexo='$sexo',
                                        fecha='$fecha'
                        ");
                        // una vez insertadas los asistetes en el curso $id_curso, y la actividad $id_actividad
                        // anotamos el número de inscritos a la actividad
                        // el núm de inscritos se considera para todo el año
                        $sql="SELECT count(*) as total_inscritos FROM c_asistentes WHERE id_curso='$id_curso' AND id_actividad='$id_actividad'";
                        mensaje($sql);
                        $inscritos=$this->db->query($sql)->row()->total_inscritos;
                        $sql="UPDATE c_actividades_infantiles SET inscripciones='$inscritos' WHERE num_actividad='$id_actividad'";
                        mensaje($sql);
                        $this->db->query($sql);
                    }
                }
            }
        }


    }

    function ponerDatosListaEsperas($inscripcion){
           
        $sql="SELECT * FROM c_inscripciones WHERE id='$inscripcion'";
        if($this->db->query($sql)->num_rows()){
            //borramos todos los datos de c_asistentes con inscripcion =$inscripcion
            $this->db->query("DELETE FROM c_lista_esperas WHERE inscripcion='$inscripcion'");
            $result=$this->db->query($sql)->result();
            foreach($result as $k=>$v){
                $curso=$this->db->query("SELECT texto_curso FROM c_cursos WHERE num_curso='".$v->id_curso."'")->row()->texto_curso;
                $inscripcion=$v->id;
                $usuario=$v->nombre_alumno.' '.$v->apellido1_alumno.' '.$v->apellido2_alumno;
                $id_usuario=$v->id_usuario;
                $id_curso=$v->id_curso;
                $fecha=$v->fecha_modificacion;
                $sexo=$this->usuarios_model->getTextoSexo($v->id_usuario);
                $pagado=$v->pendiente_pago==0?"Sí":"No";
                $id_actividades=$v->id_lista_espera;
                $id_trimestres=$v->id_trimestres;
                $resultActividades=$this->actividades_model->resultActividades($id_actividades);
                foreach($resultActividades as $k1=>$v1){
                    $actividad=$v1->descripcion;
                    $id_actividad=$v1->num_actividad;
                    $resultTrimestres=$this->actividades_model->resultTrimestres($id_trimestres);
                    foreach($resultTrimestres as $k2=>$v2){
                        $trimestre=$v2->texto_trimestre;
                        $num_trimestre=$v2->num_trimestre;
                        $id_trimestre=($v2->id)*10+$num_trimestre;
                        $this->db->query("INSERT INTO c_lista_esperas SET 
                                        curso='$curso',
                                        actividad='$actividad',
                                        id_actividad='$id_actividad',
                                        id_curso='$id_curso',
                                        id_usuario='$id_usuario',
                                        trimestre='$trimestre',
                                        id_trimestre='$id_trimestre',
                                        usuario='$usuario',
                                        inscripcion='$inscripcion',
                                        pagado='$pagado',
                                        sexo='$sexo',
                                        fecha='$fecha'
                        ");
                    }
                }
            }
        }


    }

    function guardarDatos($update = 0)
    {
        $usuario = $_POST['usuario'];
        $actividades = "";
        $listaEspera = "";
        if (isset($_POST['actividades'])) $actividades = $_POST['actividades'];
        if (isset($_POST['listaEspera'])) $listaEspera = $_POST['listaEspera'];
        // mensaje('num actividad lista espera '.$actividades);
        // foreach($listaEspera as $k=>$v){
        //     mensaje('num actividad lista espera '.$v['num_actividad']);
        // }
        $trimestres = $_POST['trimestres'];
        // mensaje('trimestres '.$trimestres);
        foreach ($trimestres as $k => $v) {
            mensaje('trimestres ' . $k . ' ' . $v);
            $trimestres[$k] = (int) ($v / 10);
        }
        $numHermano = $_POST['numHermano'];
        $descuentoAyuntamiento = $_POST['descuento_ayuntamiento'];
        $descuentoServiciosSociales = $_POST['descuento_servicios_sociales'];
        $precioAcordado = $_POST['precio_acordado'];
        $id_curso = $_POST['id_curso'];
        $precioEstandard = $_POST['precio_estandard'];
        $precioAcordado = $_POST['precio_acordado'];
        $precioAPagar = $_POST['precio_a_pagar'];
        $pagado = $_POST['pagado'];
        $pendientePago = $_POST['pendiente_pago'];

        if ($actividades) $actividades = implode(', ', $actividades);
        if ($listaEspera) $listaEspera = implode(', ', $listaEspera);
        $trimestres = implode(', ', $trimestres);
        $hoy = date('Y-m-d');
        $id_quien = $this->session->userdata('id');
        $textoActividades = $this->_callback_id_actividades($actividades);
        $lowerTextoActividades=strtolower($textoActividades);
        $actividad_relacional=0;
        $actividad_navidad=0;
        $actividad_verano=0;
        $actividad_ludoteca=0;
        if (strpos($lowerTextoActividades, 'relacional') !== false) {
            $actividad_relacional=1;
        }
        if (strpos($lowerTextoActividades, 'nadal') !== false) {
            $actividad_navidad=1;
        }
        if (strpos($lowerTextoActividades, 'estiu') !== false) {
            $actividad_verano=1;
        }
        if (strpos($lowerTextoActividades, 'ludoteca') !== false) {
            $actividad_ludoteca=1;
        }
        $textoListaEspera = $this->_callback_id_actividades($listaEspera);
        $textoTrimestres = $this->_callback_id_trimestres($trimestres);
        $alumno=$this->db->query("SELECT nombre_alumno, apellido1_alumno,apellido2_alumno FROM c_usuarios WHERE num_usuario='$usuario'")->row();
        $nombre_alumno=$alumno->nombre_alumno;
        $apellido1_alumno=$alumno->apellido1_alumno;
        $apellido2_alumno=$alumno->apellido2_alumno;
        if ($update == 0) {
            $sql = "INSERT INTO c_inscripciones SET 
                    id_usuario='$usuario',
                    id_actividades='$actividades',
                    id_lista_espera='$listaEspera',
                    id_trimestres='$trimestres',
                    nombre_alumno='$nombre_alumno',
                    apellido1_alumno='$apellido1_alumno',
                    apellido2_alumno='$apellido2_alumno',
                    actividades='$textoActividades',
                    lista_espera='$textoListaEspera',
                    trimestres='$textoTrimestres',
                    numHermano='$numHermano',
                    descuento_ayuntamiento='$descuentoAyuntamiento',
                    descuento_servicios_sociales='$descuentoServiciosSociales',
                    id_curso='$id_curso',
                    precio_estandard='$precioEstandard',
                    precio_acordado='$precioAcordado',
                    precio_a_pagar='$precioAPagar',
                    pago='$pagado',
                    pendiente_pago='$pendientePago',
                    fecha_alta='$hoy',
                    fecha_modificacion='$hoy',
                    id_user_alta='$id_quien',
                    id_user_modificacion='$id_quien',
                    actividad_relacional='$actividad_relacional',
                    actividad_navidad='$actividad_navidad',
                    actividad_verano='$actividad_verano',
                    actividad_ludoteca='$actividad_ludoteca'
                    ";
        } else {
            $sql = "UPDATE c_inscripciones SET 
            
            id_usuario='$usuario',
            id_actividades='$actividades',
            id_lista_espera='$listaEspera',
            id_trimestres='$trimestres',
            nombre_alumno='$nombre_alumno',
            apellido1_alumno='$apellido1_alumno',
            apellido2_alumno='$apellido2_alumno',
            actividades='$textoActividades',
            lista_espera='$textoListaEspera',
            trimestres='$textoTrimestres',
            numHermano='$numHermano',
            descuento_ayuntamiento='$descuentoAyuntamiento',
            descuento_servicios_sociales='$descuentoServiciosSociales',
            id_curso='$id_curso',
            precio_estandard='$precioEstandard',
            precio_acordado='$precioAcordado',
            precio_a_pagar='$precioAPagar',
            pago='$pagado',
            pendiente_pago='$pendientePago',
            fecha_alta='$hoy',
            fecha_modificacion='$hoy',
            id_user_alta='$id_quien',
            id_user_modificacion='$id_quien',
            actividad_relacional='$actividad_relacional',
            actividad_navidad='$actividad_navidad',
            actividad_verano='$actividad_verano',
            actividad_ludoteca='$actividad_ludoteca'
            WHERE id='$update'";
        }
        $this->db->query($sql);
        if ($update == 0) {
            $row = $this->db->query("SELECT id,id_curso FROM c_inscripciones ORDER BY id DESC LIMIT 1")->row();
            $id=$row->id;
            $texto_curso=$this->db->query("SELECT texto_curso FROM c_cursos WHERE num_curso='".$row->id_curso."'")->row()->texto_curso;
            $this->db->query("UPDATE c_inscripciones SET num_inscripcion='$id', texto_curso='$texto_curso' WHERE id='$id'");
        } else {
            $id = $update;
        }
        //una vez inscrito se ponen los datos en asistentes y listas de espera si los hubiera

        $this->ponerDatosAsistentes($id);
        $this->ponerDatosListaEsperas($id);

        echo json_encode("$id");
    }

    function recibo($inscripcion)
    {
        $this->load->model('inscripciones_model');
        $data['resultInscripcion'] = $this->inscripciones_model->getInscripcion($inscripcion);

        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inscripcionesAltas.php', $data);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
        $this->load->view('modals/modalInfo2');
    }

    function cambios($inscripcion)
    {
        $this->load->model('inscripciones_model');
        $this->load->model('actividades_model');
        $this->load->model('maba_model');
        $datos['resultInscripcion'] = $this->inscripciones_model->getInscripcion($inscripcion);

        $datos['actividades'] = $this->actividades_model->getActividades();
        $datos['periodos'] = $this->actividades_model->getPeriodos();
        $datos['ultimoCurso'] = $this->maba_model->getUltimoCurso();
        $datos['ultimoCursoTexto'] = $this->maba_model->getUltimoCursoTexto();
        switch($_SESSION['tipo_actividad']){
            case 1:
                $datos['tipo_actividad']=" Relacionals";
            break;
            case 2:
                $datos['tipo_actividad']=" Nadal";
            break;
            case 3:
                $datos['tipo_actividad']=" Estiu";
            break;
            case 4:
                $datos['tipo_actividad']=" Ludoteca";
            break;
            default:
                $datos['tipo_actividad']="TOTES";
        }
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inscripcionesCambios.php', $datos);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
        $this->load->view('modals/modalListaEspera');
    }

    function alta($tipo_actividad = 0)
    {
        
        $this->load->model('usuarios_model');
        $this->load->model('actividades_model');
        $this->load->model('maba_model');
        $datos['usuarios'] = $this->usuarios_model->getUsuarios();
        $datos['actividades'] = $this->actividades_model->getActividades($_SESSION['tipo_actividad']);
        $datos['periodos'] = $this->actividades_model->getPeriodos();
        $datos['ultimoCurso'] = $this->maba_model->getUltimoCurso();
        $datos['ultimoCursoTexto'] = $this->maba_model->getUltimoCursoTexto();
        $datos['tipo_actividad']="TOTES";
        switch($_SESSION['tipo_actividad']){
            case 1:
                $datos['tipo_actividad']=" Relacionals";
            break;
            case 2:
                $datos['tipo_actividad']=" Nadal";
            break;
            case 3:
                $datos['tipo_actividad']=" Estiu";
            break;
            case 4:
                $datos['tipo_actividad']=" Ludoteca";
            break;
            default:
                $datos['tipo_actividad']="TOTES";
        }

        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inscripcionesAlta.php', $datos);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
        $this->load->view('modals/modalListaEspera');
    }

    function alta_nadal($usuario = 0)
    {
        $this->load->model('usuarios_model');
        $this->load->model('actividades_model');
        $this->load->model('maba_model');
        $datos['usuarios'] = $this->usuarios_model->getUsuarios();
        $datos['actividades'] = $this->actividades_model->getActividades();
        $datos['periodos'] = $this->actividades_model->getPeriodos();
        $datos['ultimoCurso'] = $this->maba_model->getUltimoCurso();
        $datos['ultimoCursoTexto'] = $this->maba_model->getUltimoCursoTexto();


        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inscripcionesAlta.php', $datos);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
        $this->load->view('modals/modalListaEspera');
    }

    function reciboLudoteca($ludoteca)
    {
        $this->load->model('ludotecas_model');
        $rowLudoteca = $this->ludotecas_model->getLudotecaArray($ludoteca);

        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inscripcionesAltasLudoteca.php', $rowLudoteca);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
    }

    function reciboUsuarioLudoteca($usuario)
    {
        $this->load->model('usuariosLudoteca_model');
        $rowUsuario = $this->usuariosLudoteca_model->getUsuarioArray($usuario);

        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsBodies/inscripcionesAltasUsuarioLudoteca.php', $rowUsuario);
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
    }

    public function _inscripciones_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/inscripciones.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
    }

    public function _inscripciones_fechas_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/inscripciones_fechas.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
    }

    public function _inscripciones_output_nadal($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/inscripciones.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
    }

    public function _inscripciones_output_estiu($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/inscripciones.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
    }

    function inscripcion($primary_key, $row)
    {
        return site_url('inscripciones/recibo/' . $primary_key);
    }

    function cambio($primary_key, $row)
    {
        return site_url('inscripciones/cambios/' . $primary_key);
    }

    public function _callback_nombre($value, $row)
    {
        $sql = "SELECT nombre_alumno FROM c_usuarios WHERE num_usuario='" . $row->id_usuario . "'";
        if (!$this->db->query($sql)->num_rows()) return $value;
        return $this->db->query($sql)->row()->nombre_alumno;
    }
    public function _callback_apellido1($value, $row)
    {
        $sql = "SELECT apellido1_alumno FROM c_usuarios WHERE num_usuario='" . $row->id_usuario . "'";
        if (!$this->db->query($sql)->num_rows()) return $value;
        return $this->db->query($sql)->row()->apellido1_alumno;
    }
    public function _callback_apellido2($value, $row)
    {
        $sql = "SELECT apellido2_alumno FROM c_usuarios WHERE num_usuario='" . $row->id_usuario . "'";
        if (!$this->db->query($sql)->num_rows()) return $value;
        return $this->db->query($sql)->row()->apellido2_alumno;
    }

    function _callback_id_actividades($value, $row = 0)
    {
        if ($value) {
            $numActividades = explode(",", $value);
            $resultados = array();
            // mensaje('$numActividades '.$numActividades);
            if ($numActividades) {
                foreach ($numActividades as $k => $v) {
                    $resultados[] = $this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row()->descripcion;
                }
                return implode(",", $resultados);
            }
        }
        return $value;
    }
    function _callback_id_actividades_relacional($value, $row = 0)
    {
        if ($value) {
            $numActividades = explode(",", $value);
            $resultados = array();
            // mensaje('$numActividades '.$numActividades);
            if ($numActividades) {
                foreach ($numActividades as $k => $v) {
                    $resultados[] = $this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row()->descripcion;
                }
                return implode(",", $resultados);
            }
        }
        return $value;
    }
    function _callback_id_actividades_nadal($value, $row = 0)
    {
        if ($value) {
            $numActividades = explode(",", $value);
            $resultados = array();
            // mensaje('$numActividades '.$numActividades);
            if ($numActividades) {
                foreach ($numActividades as $k => $v) {
                    $resultados[] = $this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row()->descripcion;
                }
                return implode(",", $resultados);
            }
        }
        return $value;
    }
    function _callback_id_actividades_estiu($value, $row = 0)
    {
        if ($value) {
            $numActividades = explode(",", $value);
            $resultados = array();
            // mensaje('$numActividades '.$numActividades);
            if ($numActividades) {
                foreach ($numActividades as $k => $v) {
                    $resultados[] = $this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE num_actividad='$v'")->row()->descripcion;
                }
                return implode(",", $resultados);
            }
        }
        return $value;
    }

    function _callback_id_trimestres($value, $row = 0)
    {
        $numTrimestres = explode(",", $value);
        $resultados = array();
        foreach ($numTrimestres as $k => $v) {
            $sql = "SELECT texto_trimestre FROM c_trimestres WHERE id='$v'";
            $resultados[] = $this->db->query($sql)->row()->texto_trimestre;
        }
        return implode(",", $resultados);
    }

   

    function inscripciones()
    {

        $tipo_actividad=0;
        $GLOBALS['tipo_actividad']=0;
        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions - TOTES')
            ->order_by('id', 'desc')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('num_inscripcion', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            // 'id',
            'num_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );

        if($this->uri->segment(3)=='export'){
            mensaje('paso por $this->uri->segment(3)');
            $crud->columns( 'fecha_modificacion');
            mensaje('paso por $this->uri->segment(3) ... terminando');
        }

        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);
        $output = $crud->render();
        $output->tipo_actividad= $tipo_actividad;
        $this->_inscripciones_output($output);
    }

    function inscripciones_relacionales()
    {

        $tipo_actividad=1;
        $_SESSION['tipo_actividad']=1;
        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions - Activitats Relacionals')
            ->order_by('id', 'desc')
            ->where('actividad_relacional','1')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('num_inscripcion', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            // 'id',
            'num_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();
        $output->tipo_actividad= $tipo_actividad;
        $this->_inscripciones_output($output);
    }

    function inscripciones_navidad()
    {

        $tipo_actividad=2;
        $_SESSION['tipo_actividad']=2;
        mensaje($this->tipo_actividad);
        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions - Activitats Nadal')
            ->order_by('id', 'desc')
            ->where('actividad_navidad','1')
            ->unset_clone()
            // ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('num_inscripcion', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            // 'id',
            'num_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();
        $output->tipo_actividad= $tipo_actividad;
        $this->_inscripciones_output($output);
    }

    function inscripciones_verano()
    {

        $tipo_actividad=3;
        $_SESSION['tipo_actividad']=3;
        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions - Activitats Estiu')
            ->order_by('id', 'desc')
            ->where('actividad_verano','1')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('num_inscripcion', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            // 'id',
            'num_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();
        $output->tipo_actividad= $tipo_actividad;
        $this->_inscripciones_output($output);
    }
    function inscripciones_ludoteca()
    {

        $tipo_actividad=4;
        $_SESSION['tipo_actividad']=4;
        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions - Activitats Ludoteca')
            ->order_by('id', 'desc')
            ->where('actividad_ludoteca','1')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('num_inscripcion', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            // 'id',
            'num_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();
        $output->tipo_actividad= $tipo_actividad;
        $this->_inscripciones_output($output);
    }

    function inscripciones_fechas_error()
    {


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions')
            ->order_by('id', 'desc')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            'id',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();

        $this->_inscripciones_output($output);
    }



    function inscripciones_fechas()
    {
        extract($_POST);


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        if(!$desde) {
            $fecha_recibo=$this->db->query("SELECT fecha_alta FROM c_inscripciones order by fecha_alta LIMIT 1")->row()->fecha_alta;
            $desde=fechaEuropea($fecha_recibo);
        }
        if(!$hasta) $hasta=date('d/m/Y');


        $crud->set_table($table)
            ->set_subject('Inscripcions des de ' . $desde . ' fins al ' . $hasta)
            ->order_by('id', 'desc')
            ->where('fecha_alta >=', fechaEuropeaToBaseDatos($desde))
            ->where('fecha_alta <=', fechaEuropeaToBaseDatos($hasta))
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        // $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        // $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('num_inscripcion', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('texto_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            // ->callback_column('id_actividades', array($this, '_callback_id_actividades'))
            // ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'))
        ;

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'texto_curso',
            // 'id_curso',
            // 'id',
            'num_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

           

        $output = $crud->render();
        $output->desde = fechaEuropeaToBaseDatos($desde);
        $output->hasta = fechaEuropeaToBaseDatos($hasta);    

        $this->_inscripciones_fechas_output($output);
    }


    function inscripciones_relacional()
    {


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions')
            ->order_by('id', 'desc')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades_relacional'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            'id',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();

        $this->_inscripciones_output($output);
    }
    function inscripciones_nadal()
    {


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions')
            ->order_by('id', 'desc')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades_relacional'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            'id',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();

        $this->_inscripciones_output_nadal($output);
    }
    function inscripciones_estiu()
    {


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code
        $table = 'c_inscripciones';    


        $crud->set_table($table)
            ->set_subject('Inscripcions')
            ->order_by('id', 'desc')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_edit()
            ->unset_add();

        $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));
        $crud->add_action('Canvis', '', '', 'ui-icon-image', array($this, 'cambio'));

        // ->unset_delete()
        $crud
            ->display_as('id', 'Ins. ')
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_usuario', 'Usuari ')
            ->display_as('id_actividades', 'Activitats ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_alumno', 'Nom nen/nena ')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena ')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena ')
            ->display_as('actividades', 'Activitats ')
            ->display_as('trimestres', 'Períodes ')
            ->display_as('precio_a_pagar', 'Preu a pagar ')
            ->display_as('pendiente_pago', 'Pendent pagament ')
            ->display_as('numHermano', 'Germà núm ')
            ->display_as('precio_estandard', 'Preu estàndard')
            ->display_as('precio_acordado', 'Preu')
            ->display_as('descuento_ayuntamiento', 'Descompte Ayuntament ')
            ->display_as('descuento_servicios_sociales', 'Descompte Serveis Socials ')
            ->display_as('pago', 'Pagat')
            ->display_as('fecha_alta', 'Data alta')
            ->display_as('fecha_modificacion', 'Data modificació')
            ->display_as('id_user_alta', 'Alta per')
            ->display_as('id_user_modificacion', 'Modificat per')

            ->display_as('nombre', 'Nom')
            ->display_as('apellido1', 'Primer cognom')
            ->display_as('apellido2', 'Segon cognom');

        $crud
            // ->callback_column('nombre', array($this, '_callback_nombre'))
            // ->callback_column('apellido1', array($this, '_callback_apellido1'))
            // ->callback_column('apellido2', array($this, '_callback_apellido2'))
        ;

        $crud
            ->callback_column('id_actividades', array($this, '_callback_id_actividades_relacional'))
            ->callback_column('id_trimestres', array($this, '_callback_id_trimestres'));

        $crud
            // ->set_relation('id_actividades', 'c_actividades_infantiles', '{descripcion}',array('id_curso'=>1))
            // ->set_relation('id_trimestres', 'c_trimestres', '{texto_trimestre}')
            // ->set_relation('nombre', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario2', 'c_usuarios', '{nombre_alumno}')
            // ->set_relation('id_usuario3', 'c_usuarios', '{nombre_alumno}')

        ;

        // ACTIVIDADES MULTIPLES
        $this->db->select('id, num_actividad, descripcion');
        $results = $this->db->get('c_actividades_infantiles')->result();
        $actividadesMultiselect = array();
        foreach ($results as $result) {
            // mensaje('$result->num_actividad ' . $result->id);
            // mensaje('$$result->descripcion ' . $result->descripcion);

            $actividadesMultiselect[$result->id] = $result->descripcion;
        }
        $crud->field_type('id_actividades', 'multiselect', $actividadesMultiselect);

        // PERIODOS MULTIPLES
        $this->db->select('id, texto_trimestre');
        $results = $this->db->get('c_trimestres')->result();
        $periodosMultiselect = array();
        foreach ($results as $result) {
            $periodosMultiselect[$result->id] = $result->texto_trimestre;
        }
        $crud->field_type('id_trimestres', 'multiselect', $periodosMultiselect);


        $crud->callback_edit_field('id', function ($value = '') {
            return "";
        });
        $crud
            ->callback_column('horario_desde', array($this, '_callback_horarios'))
            // ->callback_column('actividades', array($this, '_callback_id_actividades'))

        ;
        // $crud->change_field_type('actividades','text'); 

        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso');
        $crud->required_fields();
        $columnas = array(
            'id_curso',
            'id',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'actividades',
            'trimestres',
            // 'id_actividades',
            // 'id_trimestres',
            'precio_a_pagar',
            'pago',
            'pendiente_pago',
            // 'numHermano',
            // 'descuento_ayuntamiento',
            // 'descuento_servicios_sociales',
            // 'pagado',
            // 'fecha_alta',
            'fecha_modificacion',
            // 'id_user_alta',
            // 'id_user_modificacion',
        );
        $camposAddEdit = array(
            'id_curso',
            'id_usuario',
            'id_actividades',
            'id_trimestres',
            'numHermano',
            'descuento_ayuntamiento',
            'descuento_servicios_sociales',
            'pagado',
            'fecha_alta',
            'fecha_modificacion',
            'id_user_alta',
            'id_user_modificacion',
        );
        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $output = $crud->render();

        $this->_inscripciones_output($output);
    }


    function getTablaInscripcionesPagadas($curso)
    {
        $this->load->model('inscripciones_model');
        $resultado = $this->inscripciones_model->getTablaInscripcionesPagadas($curso);
        echo json_encode($resultado);
    }


    public function totales()
    {
        $sql = $_POST['sql'];
        $row=$this->db->query($sql)->row();

        $precio_a_pagar=$row->precio_a_pagar;
        $pagado=$row->pagado;
        $pendiente_pago=$row->pendiente_pago;
        $precio_a_pagar=is_null($precio_a_pagar)?"0.00":$precio_a_pagar;
        $pagado=is_null($pagado)?"0.00":$pagado;
        $pendiente_pago=is_null($pendiente_pago)?"0.00":$pendiente_pago;

       


        echo json_encode(array('precio_a_pagar'=>$precio_a_pagar,
                                'pagado'=>$pagado,
                                'pendiente_pago'=>$pendiente_pago
                                ));
    }
}
