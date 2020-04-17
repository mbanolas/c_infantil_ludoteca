<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Contrataciones extends CI_Controller {

    

    public function __construct()
	{
		parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->model('maba_model');
        $this->load->model('actividades_model');

    }

    // function ponerDatosComunes(){
    //     $datos['casal']=getTituloCasalCorto();
    //     $this->load->view('templates/cabecera',$datos);
	// 	$this->load->view('viewsBodies/ponerDatosComunes.php');
    //     $this->load->view('templates/pie');
    // }
    // function putDatos(){        
    //     $resultado=$this->actividades_model->putDatos();
    //     echo json_encode($resultado);
    // }

    // function altas(){
    //     $datos['casal']=getTituloCasalCorto();
    //     $this->load->view('templates/cabecera',$datos);
	// 	$this->load->view('viewsBodies/actividadesAltas.php');
    //     $this->load->view('templates/pie');
    // }

    // function bajas(){
    //     $datos['casal']=getTituloCasalCorto();
    //     $this->load->view('templates/cabecera',$datos);
	// 	$this->load->view('viewsBodies/actividadesBajas.php');
    //     $this->load->view('templates/pie');
    // }

    // function comprobarInscripcion($actividades=0){
    //     $actividades=$_POST['actividades'];
    //     $resultado=$this->actividades_model->comprobarInscripcion($actividades);
    //     echo json_encode($resultado);
    // }

    // function getActividadesOptions($curso){
    //     $resultado=$this->actividades_model->getActividadesOptions($curso);
    //     echo json_encode($resultado);
    // }

    public function _contrataciones_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/contrataciones.php', (array)$output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array)$output);

    }

    function beforeUpdate($post_array){
        // $post_array['nombre_actividad']=trim($post_array['nombre_actividad']);      
        return $post_array;
    }
    function beforeInsert($post_array){
        // $post_array['nombre_actividad']=trim($post_array['nombre_actividad']);      
        return $post_array;
    }

    function afterUpdate($post_array, $primary_key='0'){
        /*se debe calcular el identificador porque no se puede obtener el ya existente con un SELECT */
        // $identificador=$primary_key;
        // while(strlen($identificador)<4) $identificador="0".$identificador;
        // $id=$post_array['id_grupo'];
        // $texto_grupo=$this->db->query("SELECT texto_grupo FROM c_grupos WHERE id='$id'")->row()->texto_grupo;
        // $descripcion=$identificador.'-'.$post_array['nombre_actividad'];
        // if($texto_grupo) $descripcion.='-'.$texto_grupo;
        // $this->db->query("UPDATE c_actividades_infantiles SET  descripcion='$descripcion' WHERE id='$primary_key'");
    }

    function afterInsert($post_array, $primary_key='0'){
        // $identificador=$primary_key;
        // while(strlen($identificador)<4) $identificador="0".$identificador;
        // $id=$post_array['id_grupo'];
        // $texto_grupo=$this->db->query("SELECT texto_grupo FROM c_grupos WHERE id='$id'")->row()->texto_grupo;
        // $descripcion=$identificador.'-'.$post_array['nombre_actividad'];
        // if($texto_grupo) $descripcion.='-'.$texto_grupo;
        // $this->db->query("UPDATE c_actividades_infantiles SET identificador='$identificador', descripcion='$descripcion' WHERE id='$primary_key'");
    }

    public function _callback_horarios($value, $row){
    
        return substr($value,8,2).'/'.substr($value,5,2).'/'.substr($value,0,4).substr($value,10,6);
    }

    public function totales(){
        $sql=$_POST['sql'];
        $row=$this->db->query($sql)->row();
        echo json_encode(array('total_alumnos'=>$row->total_alumnos, 'total_adultos'=>$row->total_adultos));
    }
    

    // public function _callback_horarios_desde($value, $row){
    //     $value=substr($value,0,16);
    //     return "<input id='field-horario_desde' class='form-control' name='horario_desde' type='text' value='$value'>";
    // }
    // public function _callback_horarios_hasta($value, $row){
    //     $value=substr($value,0,16);
    //     return "<input id='field-horario_hasta' class='form-control' name='horario_hasta' type='text' value='$value'>";
    // }

    public function _callback_inscriptos($value, $row){
        return $row->inscripciones."/".$row->num_maximo;
    }

    public function comprobarInscripciones($primary_key){
        // mensaje('comprobarInscripciones Actividades 83');
        return false;
    }
    // public function getDatosActividad($numActividad){
    //     $row=$this->db->query("SELECT * FROM c_actividades_infantiles WHERE num_actividad='$numActividad'")->row();
    //     echo json_encode($row);  
    //   }
    
      public function eliminarActividad($numActividad){
          mensaje('eliminarActividad Actividades 91 '.$numActividad);
        $salida=$this->db->query("DELETE FROM c_actividades_infantiles WHERE num_actividad='$numActividad'");
        $siguiente=$this->db->query("SELECT max(num_actividad) as maximo FROM c_actividades_infantiles")->row()->maximo+1;
        $this->db->query("ALTER TABLE c_actividades_infantiles AUTO_INCREMENT = $siguiente");
        echo json_encode($salida);  
      }  



    function contrataciones(){

        

       
        


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_contrataciones';

        $crud->set_table($table)
            ->set_subject('Contrataciones Ludoteca')
            ->order_by('fecha','asc')
            ->unset_clone()
            ->unset_read()
            // ->unset_delete()
            ;

        $crud
            ->display_as('nombre_contacion', 'Nom de la contratació')
            ->display_as('contratante', 'Persona que fa la contratació ')
            ->display_as('fecha', 'Data en què s´efectua la contracció (dd/mm/aaaa)')
            ->display_as('desde', 'Data i hora inici (dd/mm/aaaa hh:mm)')
            ->display_as('hasta', 'Data i hora finalització (dd/mm/aaaa hh:mm)')
            ->display_as('curso', 'Curs que fan els nens / nenes')
            ->display_as('total_alumnos', 'Nombre de nens / nenes que assisteixen')
            ->display_as('total_adultos', 'Nombre de persones acompanyants')

            
        ;

        $crud->callback_edit_field('id',function($value= ''){
            return "";
          });
        $crud
            ->callback_column('desde',array($this,'_callback_horarios'))
            ->callback_column('hasta',array($this,'_callback_horarios'))
            

        ;
  
        $crud->callback_before_delete(array($this,'comprobarInscripciones'));
        
        $crud
        // ->set_relation('id_curso', 'c_cursos', 'texto_curso')
        
        
        ;
        $crud->required_fields(
            'nombre_contratacion',
            'contratante',
            'fecha',
            'desde',
            'hasta',
            'curso',
            'total_alumnos',
            'total_adultos'
        );
        $columnas=array(
            'nombre_contratacion',
            'contratante',
            'fecha',
            'desde',
            'hasta',
            'curso',
            'total_alumnos',
            'total_adultos'
        );
       
        
        $camposAddEdit = array(
            'nombre_contratacion',
            'contratante',
            'fecha',
            'desde',
            'hasta',
            'curso',
            'total_alumnos',
            'total_adultos'
        );

        $crud->fields($camposAddEdit)
            ->columns($columnas);

        $crud
            ->callback_before_insert(array($this,'beforeInsert'))
            ->callback_before_update(array($this,'beforeUpdate'))    
            ->callback_after_insert(array($this,'afterInsert'))
            ->callback_after_update(array($this,'afterUpdate'))    
        ;

        $output = $crud->render();

        // if ($crud->getState() == 'add') {

            
            $js =   '<script> 
                        $(\'#field-desde\').removeClass(\'datetime-input\')
                        $(\'#field-hasta\').removeClass(\'datetime-input\')
                    </script>';

            $output->output .= $js;
        // }
        




        $this->_contrataciones_output($output);


    }

    function  getPreciosActividades(){
        // mensaje('$actividades post '.$_POST['actividades']);
        // mensaje('$actividades post 0 '.$_POST['actividades'][0]);
        // $resultado=$this->actividades_model->getPreciosActividades();
        // echo json_encode($resultado);
    }




}