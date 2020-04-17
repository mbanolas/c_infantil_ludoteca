<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Recibos extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        // $this->load->model('general_model');


    }

    public function _cobros_output($output = null)
    {
        $datos['casal'] = getTituloCasalCorto();
        $this->load->view('templates/cabecera', $datos);
        $this->load->view('viewsTables/recibosCobros.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
        $this->load->view('modals/modalInfo.php', (array) $output);
    }

    public function _arqueo_output($output = null)
    {
        $datos['casal'] = getTituloCasalCorto();
        $this->load->view('templates/cabecera', $datos);
        $this->load->view('viewsTables/recibosArqueo.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
        $this->load->view('modals/modalInfo.php', (array) $output);
    }

    public function _devoluciones_output($output = null)
    {
        $datos['casal'] = getTituloCasalCorto();
        $this->load->view('templates/cabecera', $datos);
        $this->load->view('viewsTables/recibosDevoluciones.php', (array) $output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array) $output);
        $this->load->view('modals/modalInfo.php', (array) $output);
    }




    public function arqueo($desde="",$hasta="")
    {
        $crud = new grocery_CRUD();

        if(!$desde) {
            $fecha_recibo=$this->db->query("SELECT fecha_recibo FROM c_recibos order by fecha_recibo LIMIT 1")->row()->fecha_recibo;
            $desde=$fecha_recibo;
        }
        if(!$hasta) $hasta=date('Y-m-d');

        
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_recibos';

        $crud
            ->set_table($table)
            ->order_by('fecha_recibo', 'desc');


        $where=" (fecha_recibo >= '$desde' AND fecha_recibo <= '$hasta') ";    
        $crud ->where($where);
        // mensaje($where);

        $crud    ->set_subject('Rebuts cobraments / devolucions des de ' . fechaEuropea($desde) . ' fins al ' . fechaEuropea($hasta))

            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_add()
            ->unset_edit();


        $crud
            ->display_as('importe', 'Import (€)')
            ->display_as('metalico', 'Metàl·lic (€)')
            ->display_as('tarjeta', 'Targeta (€)')
            ->display_as('transferencia', 'Transferencia (€)')
            ->display_as('id_inscripcion', 'Núm inscripció')
            ->display_as('nombre_alumno', 'Nom nen/nena')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena')
            ->display_as('num_registro', 'Núm registre')
            ->display_as('recibo', 'Rebut')
            ->display_as('num_registro_ingreso', 'Núm rebut')
            ->display_as('fecha_recibo', 'Data rebut');

        $camposColumnas = array(
            'fecha_recibo',
            'num_registro_ingreso',
            'id_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            // 'num_registro',
            'importe_total',
            'metalico',
            'tarjeta',
            'transferencia'

        );
        $crud
            ->columns($camposColumnas);
        $crud
            ->set_field_upload('num_registro_ingreso', 'recibos');

        $crud
            ->callback_column('metalico', array($this, '_callback_metalico'))
            ->callback_column('tarjeta', array($this, '_callback_tarjeta'))
            ->callback_column('transferencia', array($this, '_callback_transferencia'));

        

        $output = $crud->render();
        $output->desde = $desde;
        $output->hasta = $hasta;

        $this->_arqueo_output($output);
    }


    public function cobros()
    {

        $crud = new grocery_CRUD();

        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_recibos';

        $crud
            ->set_table($table)
            ->order_by('fecha_recibo', 'desc')
            ->like('num_registro', getNumeroRegistroCasalIngresos())
            ->set_subject('Rebuts cobrats')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_add()
            ->unset_edit();


        $crud
            ->display_as('importe', 'Import (€)')
            ->display_as('id_inscripcion', 'Núm inscripció')
            ->display_as('nombre_alumno', 'Nom nen/nena')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena')
            ->display_as('num_registro', 'Núm registre')
            ->display_as('recibo', 'Rebut')
            ->display_as('num_registro_ingreso', 'Núm rebut')
            ->display_as('fecha_recibo', 'Data rebut');

        $camposColumnas = array(
            'id_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'num_registro_ingreso',
            'num_registro',
            'importe',
            'fecha_recibo',

        );
        $crud
            ->columns($camposColumnas);
        $crud
            ->set_field_upload('num_registro_ingreso', 'recibos');


        $output = $crud->render();
        $this->_cobros_output($output);
    }


    public function totales()
    {
        $sql = $_POST['sql'];
        $importe_total=$this->db->query($sql)->row()->total;
        $metalico=$this->db->query($sql.' AND tipo_ingreso=1')->row()->total;
        $tarjeta=$this->db->query($sql.' AND tipo_ingreso=2')->row()->total;
        $transferencia=$this->db->query($sql.' AND tipo_ingreso=3')->row()->total;
        $importe_total=is_null($importe_total)?"0.00":$importe_total;
        $metalico=is_null($metalico)?"0.00":$metalico;
        $tarjeta=is_null($tarjeta)?"0.00":$tarjeta;
        $transferencia=is_null($transferencia)?"0.00":$transferencia;

        echo json_encode(array('importe_total'=>$importe_total,
                                'metalico'=>$metalico,
                                'tarjeta'=>$tarjeta,
                                'transferencia'=>$transferencia
                                ));
    }

    public function devoluciones()
    {


        $crud = new grocery_CRUD();


        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_recibos';

        $crud
            ->set_table($table)
            ->order_by('fecha_recibo', 'desc')
            ->like('num_registro', getNumeroRegistroCasalDevoluciones())
            ->set_subject('Rebuts devolucions')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_add()
            ->unset_edit();
        $crud
            ->display_as('id_trimestre', 'Períodes')
            ->display_as('id_inscripcion', 'Inscripció')
            ->display_as('importe', 'Import (€)')
            ->display_as('nombre_alumno', 'Nom nen/nena')
            ->display_as('apellido1_alumno', 'Primer cognom nen/nena')
            ->display_as('apellido2_alumno', 'Segon cognom nen/nena')
            ->display_as('num_usuario', 'Núm usuari/usuària')
            ->display_as('num_ludoteca', 'Núm ludoteca')
            ->display_as('num_registro', 'Núm registre')
            ->display_as('num_registro_ingreso', 'Núm registre ingrés')
            ->display_as('recibo', 'Rebut')
            ->display_as('num_registro_posicion', 'Posició')
            ->display_as('fecha_recibo', 'Data rebut');

        $camposColumnas = array(
            'id_inscripcion',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'num_registro_ingreso',
            'num_registro',
            'importe',
            'fecha_recibo',

        );
        $crud
            ->columns($camposColumnas);
        $crud
            ->set_field_upload('num_registro_ingreso', 'recibos');

        $output = $crud->render();
        $this->_devoluciones_output($output);
    }

    public function cero()
    {

        $crud = new grocery_CRUD();

        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_recibos';

        $crud
            ->set_table($table)
            ->order_by('fecha_recibo', 'desc')
            ->where('importe', 0)
            ->set_subject('Rebuts import 0')
            ->unset_clone()
            ->unset_read()
            ->unset_delete()
            ->unset_add()
            ->unset_edit();


        $crud
            ->display_as('id_trimestre', 'Trimestres')
            ->display_as('importe', 'Import (€)')
            ->display_as('num_usuario', 'Núm usuari/usuària')
            ->display_as('num_ludoteca', 'Núm ludoteca')
            ->display_as('num_registro', 'Núm registe')
            ->display_as('recibo', 'Rebut')
            ->display_as('num_registro_posicion', 'Posició')
            ->display_as('fecha_recibo', 'Data rebut');

        $camposColumnas = array(
            'num_usuario',
            'num_ludoteca',
            'recibo',
            'num_registro',
            'num_registro_posicion',
            'importe',
            // 'id_trimestre',
            'fecha_recibo',

        );
        $crud
            ->columns($camposColumnas);
        $crud
            ->set_field_upload('recibo', 'recibos');



        $output = $crud->render();
        $this->_cobros_output($output);
    }

    public function informeAyuntamiento()
    {
        $datos['casal'] = getTituloCasalCorto();
        $this->load->view('templates/cabecera', $datos);
        $this->load->view('viewsBodies/seleccionFechas.php');
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
    }

    public function caja()
    {
        $datos['casal'] = getTituloCasalCorto();
        $this->load->view('templates/cabecera', $datos);
        $this->load->view('viewsBodies/seleccionFechasCaja.php');
        $this->load->view('templates/pie');
        $this->load->view('modals/modalInfo');
    }

    public function _callback_metalico($value, $row){
        if($row->tipo_ingreso==1) return $row->importe_total;   
    }
    public function _callback_tarjeta($value, $row){
        if($row->tipo_ingreso==2) return $row->importe_total;   
    }
    public function _callback_transferencia($value, $row){
        if($row->tipo_ingreso==3) return $row->importe_total;   
    }

    public function arqueo_caja()
    {
        extract($_POST);
        if (!$desde) $desde = date("d/m/Y");
        if (!$hasta) $hasta = date("d/m/Y");
        $this->arqueo($desde, $hasta);
    }

    function excel_arqueo($desde, $hasta)
    {
        $this->load->model('recibos_model');
        $datos['desde']=$desde;
        $datos['hasta']=$hasta;
        $datos['result'] = $this->recibos_model->getExcelArqueo($desde, $hasta);
        $this->load->library('excel');

        // $this->load->library('drawing');

        $this->load->view('excelArqueo', $datos);
    }

    function excelInformeAyuntamiento()
    {
        extract($_POST);
        

        

        $this->load->model('recibos_model');
        $datos = $this->recibos_model->getExcelInformeAyuntamiento($desde, $hasta);

        $this->load->library('excel');

        $this->load->library('drawing');

        $hoja = 0;

        $this->load->view('excelInformeAyuntamiento', $datos);
    }
}
