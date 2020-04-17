<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Actividades extends CI_Controller {

    

    public function __construct()
	{
		parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->load->model('maba_model');
        $this->load->model('actividades_model');

        $this->db->query("TRUNCATE TABLE c_actividades_infantiles_copy");
        $this->db->query("INSERT INTO c_actividades_infantiles_copy SELECT id,num_actividad,descripcion FROM c_actividades_infantiles");

    }

    function ponerDatosComunes(){
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/ponerDatosComunes.php');
        $this->load->view('templates/pie');
    }
    function putDatos(){        
        $resultado=$this->actividades_model->putDatos();
        echo json_encode($resultado);
    }

    function altas(){
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/actividadesAltas.php');
        $this->load->view('templates/pie');
    }

    function bajas(){
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/actividadesBajas.php');
        $this->load->view('templates/pie');
    }

    function comprobarInscripcion($actividades=0){
        $actividades=$_POST['actividades'];
        $resultado=$this->actividades_model->comprobarInscripcion($actividades);
        echo json_encode($resultado);
    }

    function getActividadesOptions($curso){
        $resultado=$this->actividades_model->getActividadesOptions($curso);
        echo json_encode($resultado);
    }

    public function _actividades_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
 $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/actividades.php', (array)$output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array)$output);

    }

    function beforeUpdate($post_array){
        $post_array['nombre_actividad']=trim($post_array['nombre_actividad']);
        
        return $post_array;
    }
    function beforeInsert($post_array){
        $post_array['nombre_actividad']=trim($post_array['nombre_actividad']);
        
        return $post_array;
    }

    function afterUpdate($post_array, $primary_key='0'){
        /*se debe calcular el identificador porque no se puede obtener el ya existente con un SELECT */
        $identificador=$primary_key;
        while(strlen($identificador)<4) $identificador="0".$identificador;
        $id=$post_array['id_grupo'];
        $texto_grupo=$this->db->query("SELECT texto_grupo FROM c_grupos WHERE id='$id'")->row()->texto_grupo;
        $descripcion=$identificador.'-'.$post_array['nombre_actividad'];
        if($texto_grupo) $descripcion.='-'.$texto_grupo;
        $this->db->query("UPDATE c_actividades_infantiles SET  descripcion='$descripcion' WHERE id='$primary_key'");
    }

    function afterInsert($post_array, $primary_key='0'){
        $identificador=$primary_key;
        while(strlen($identificador)<4) $identificador="0".$identificador;
        $id=$post_array['id_grupo'];
        $texto_grupo=$this->db->query("SELECT texto_grupo FROM c_grupos WHERE id='$id'")->row()->texto_grupo;
        $descripcion=$identificador.'-'.$post_array['nombre_actividad'];
        if($texto_grupo) $descripcion.='-'.$texto_grupo;
        $this->db->query("UPDATE c_actividades_infantiles SET identificador='$identificador', descripcion='$descripcion' WHERE id='$primary_key'");
    }

    public function _callback_horarios($value, $row){
        return substr($value,0,5);
    }

    public function _callback_horarios_desde($value, $row){
        $value=substr($value,0,5);
        return "<input id='field-horario_desde' class='form-control' name='horario_desde' type='text' value='$value'>";
    }
    public function _callback_horarios_hasta($value, $row){
        $value=substr($value,0,5);
        return "<input id='field-horario_hasta' class='form-control' name='horario_hasta' type='text' value='$value'>";
    }

    public function _callback_inscriptos($value, $row){
        return $row->inscripciones."/".$row->num_maximo;
    }

    public function comprobarInscripciones($primary_key){
        // mensaje('comprobarInscripciones Actividades 83');
        return false;
    }
    public function getDatosActividad($numActividad){
        $row=$this->db->query("SELECT * FROM c_actividades_infantiles WHERE num_actividad='$numActividad'")->row();
        echo json_encode($row);  
      }
    
      public function eliminarActividad($numActividad){
          mensaje('eliminarActividad Actividades 91 '.$numActividad);
        $salida=$this->db->query("DELETE FROM c_actividades_infantiles WHERE num_actividad='$numActividad'");
        $siguiente=$this->db->query("SELECT max(num_actividad) as maximo FROM c_actividades_infantiles")->row()->maximo+1;
        $this->db->query("ALTER TABLE c_actividades_infantiles AUTO_INCREMENT = $siguiente");
        echo json_encode($salida);  
      }  



    function actividades(){

        // $result=$this->db->query("SELECT * FROM c_actividades_infantiles")->result();
        // foreach($result as $k=>$v){
        //     $id=$v->id;
        //     $identificador=$v->num_actividad;
        //     while(strlen($identificador)<4) {
        //         $identificador="0".$identificador;
        //         mensaje($identificador);
        //     }
        //     $this->db->query("UPDATE c_actividades_infantiles SET identificador='$identificador' WHERE id='$id'");
        // }

        $result=$this->db->query("SELECT * FROM c_actividades_infantiles")->result();
        foreach($result as $k=>$v){
            $id=$v->id;
            $id_grupo=$v->id_grupo;
            $texto_grupo=$this->db->query("SELECT * FROM c_grupos WHERE id='$id_grupo'")->row()->texto_grupo;
            $descripcion=$v->nombre_actividad.'-'.$texto_grupo;
            $this->db->query("UPDATE c_actividades_infantiles SET descripcion='$descripcion' WHERE id='$id'");
        }


        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_actividades_infantiles';

        $crud->set_table($table)
            ->set_subject('Activitats infantils')
            ->order_by('descripcion','asc')
            ->unset_clone()
            ->unset_read()
            // ->unset_delete()
            ;

        $crud
            ->display_as('id_curso', 'Curs ')
            ->display_as('id_trimestres', 'Períodes ')
            ->display_as('nombre_actividad', 'Nom activitat ')
            ->display_as('horario_desde', 'Hora inici (hh:mm) ')
            ->display_as('horario_hasta', 'Hora finalització (hh:mm) ')
            ->display_as('id_grupo', 'Grup ')
            ->display_as('grupo_anterior', 'Grup anterior ')
            ->display_as('grupo_siguiente', 'Grup seguent ')
            ->display_as('precio_general_anual', 'Preu general anual (€): ')
            ->display_as('precio_infancia_anual', 'Preu infans anual (€): ')
            ->display_as('precio_general_trimestre', 'Preu general trimestre (€) ')
            ->display_as('precio_general_mes', 'Preu general mensual (€) ')
            ->display_as('descuento_primer_hermano', 'Descompte primer germá (%) ')
            ->display_as('descuento_siguientes_hermanos', 'Descompte seguents germans (%) ')
            ->display_as('num_maximo', 'Nombre màxim inscripcions')
            ->display_as('inscriptos', 'Ins/máx')
            ->display_as('iva', 'IVA (%): ')
            ->display_as('lista_espera', "Llista d'espera")
        ;

        $crud->callback_edit_field('id',function($value= ''){
            return "";
          });
        $crud
            ->callback_column('horario_desde',array($this,'_callback_horarios'))
            ->callback_column('horario_hasta',array($this,'_callback_horarios'))
            ->callback_column('inscriptos',array($this,'_callback_inscriptos'))
            ->callback_field('horario_desde',array($this,'_callback_horarios_desde'))
            ->callback_field('horario_hasta',array($this,'_callback_horarios_hasta'))

        ;
  
        $crud->callback_before_delete(array($this,'comprobarInscripciones'));
        
        $crud
        ->set_relation('id_curso', 'c_cursos', 'texto_curso')
        // ->set_relation('id_trimestres', 'c_trimestres', 'texto_trimestre')
        ->set_relation('id_grupo', 'c_grupos', 'texto_grupo')
        ->set_relation('grupo_anterior', 'c_actividades_infantiles_copy', 'descripcion')
        ->set_relation('grupo_siguiente', 'c_actividades_infantiles_copy', '{descripcion}')
        ->set_relation('lista_espera',      'c_actividades_infantiles_copy', '{descripcion}')
        
        ;
        $crud->required_fields(
            'num_actividad',
            'id_curso',
            'nombre_actividad',
            // 'id_trimestres',
            'precio_general_anual',
            'precio_infancia_anual',
            'descuento_primer_hermano',
            'descuento_siguientes_hermanos',
            'precio_general_trimestre',
            'precio_general_mes',
            'iva'
            // 'horas_actividad_T1',
            // 'horas_actividad_T2',
            // 'horas_actividad_T3'
        );
        $columnas=array(
            // 'num_actividad',
            'id_curso',
            'nombre_actividad',
            'id_grupo',
            'id_trimestres',
            'horario_desde',
            'horario_hasta',
            // 'horas_actividad_T1',
            // 'horas_actividad_T2',
            // 'horas_actividad_T3',
            'precio_general_anual',
            'precio_general_trimestre',
            'precio_general_mes',
            // 'precio_infancia_anual',
            // 'descuento_primer_hermano',
            // 'descuento_siguientes_hermanos',
            // 'iva',
            // 'inscripciones',
            // 'num_maximo',
            'inscriptos',
            // 'grupo_anterior',
            // 'grupo_siguiente',
            // 'lista_espera',
        );
       
        $trimestres=array('1'=>'Gener','2'=> 'Febrer', '3'=>'Març', '4'=>'Abril','5'=> 'Maig', '6'=>'Juny', '7'=>'Juliol','8'=> 'Agost','9'=> 'Setembre','10'=> 'Octubre',
        '11'=>'Novembre','12'=> 'Desembre','13'=>'Trimestre Tardor','14'=> 'Trimestre Hivern','15' =>'Trimestre Primavera','16'=> 'Tot el curs');
        // $crud->field_type('id_trimestres','multiselect', $trimestres);

        $crud->change_field_type('id_trimestres', 'dropdown', $trimestres);

        $camposAddEdit = array(
           
            'num_actividad',
            'id_curso',
            'nombre_actividad',
            'id_grupo', 
            'id_trimestres',
            'horario_desde',
            'horario_hasta',
            // 'horas_actividad_T1',
            // 'horas_actividad_T2',
            // 'horas_actividad_T3',
            'precio_general_anual',
            'precio_general_trimestre',
            'precio_general_mes',
            // 'precio_infancia_anual',
            'descuento_primer_hermano',
            'descuento_siguientes_hermanos',
            'iva',
            'num_maximo',
            // 'grupo_anterior',
            // 'grupo_siguiente',
            // 'lista_espera',
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

        if ($crud->getState() == 'add') {
            $siguiente=$this->maba_model->getSiguiente('c_actividades_infantiles','num_actividad');
            $ultimoCurso=$this->maba_model->getUltimoCurso();

            while(strlen($siguiente)<4) $siguiente='0'.$siguiente;
            $js =   '<script> 
                    $(\'#field-num_actividad\').val("'.$siguiente.'");
                    $(\'select[name="id_curso"] option[value="'.$ultimoCurso.'"]\').attr("selected","selected"); 
                    $(\'#field-iva\').val("0");
                    $(\'#field-descuento_primer_hermano\').val("25");
                    $(\'#field-descuento_siguientes_hermanos\').val("50");
                    $(\'#field-nombre_actividad\').val(" ");
                    // $(\'#field_id_trimestres_chosen > div > ul > li:nth-child(5)\').click();
                    $(\'#field-nombre_actividad\').focus();
                    </script>';
            $output->output .= $js;
        }
        




        $this->_actividades_output($output);


    }

    function  getPreciosActividades(){
        mensaje('$actividades post '.$_POST['actividades']);
        mensaje('$actividades post 0 '.$_POST['actividades'][0]);
        $resultado=$this->actividades_model->getPreciosActividades();
        echo json_encode($resultado);
    }




}