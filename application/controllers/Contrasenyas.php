<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Contrasenyas extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        // $this->load->model('general_model');


    }

    public function Contrasenyas()
    {

        $crud = new grocery_CRUD();
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_contrasenyas';

        $crud->set_table($table)
            ->set_subject('Contrasenyas usuaris/usuàries')
            ->order_by('fecha_alta', 'desc')
          
            ->unset_clone()
            // ->unset_read()
            // ->unset_add()
            // ->unset_delete()
            ;

            $crud
                ->display_as('dni_tutor', 'DNI/NIE/Pasaport')
                ->display_as('contrasenya', 'Contrasenya accés fitxa alumne/s')
                ->display_as('num_hijos', 'Nombre fills/tutoriados')
                ->display_as('fecha_alta', 'Data d´alta')
                ->display_as('fecha_ultimo_acceso', 'Data última entrada')
        ;   

        $columnas = array(   
            
        );

        $camposAddEdit = array(
            'dni_tutor',
            'contrasenya',
            'num_hijos',

        );
        $camposRequiered = array(
            'dni_tutor',
            'contrasenya',
            'num_hijos',
        );

        $crud->fields($camposAddEdit)
            ->columns($columnas)
            ->required_fields($camposRequiered)
            ->unique_fields(array('dni_tutor'))
        ;

        $crud
            ->callback_before_insert(array($this,'beforeInsert')) 
            ->callback_after_insert(array($this,'afterInsertEdit'))
            ->callback_after_update(array($this,'afterInsertEdit'))
        ;  
            
        $crud
            ->set_rules('dni_tutor', '', 'callback_validar_dni[DNI tutor]')    

        ;

        // $crud->callback_after_delete(array($this,'curso_after_delete'));

        
       



        $output = $crud->render();

        // if ($state == 'add') {
        //     $sql="SELECT num_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1";
        //     if($this->db->query($sql)->num_rows()==0) $siguiente=1;
        //     else{
        //         $siguiente=$this->db->query("SELECT num_curso FROM c_cursos ORDER by num_curso DESC LIMIT 1")->row()->num_curso+1;
        //     }
        //     $js =   '<script> 
        //             $(\'#field-num_curso\').val("'.$siguiente.'");
        //             </script>';

        //     $output->output .= $js;
        // }

        $this->_contrasenyas_output($output);
    }

    public function _contrasenyas_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/contrasenyas.php', $output);
        $this->load->view('templates/pieGrocery', $output);
        $this->load->view('modals/modalInfo', $output);
        $this->load->view('modals/modalSiNo', $output);

    }


    function beforeInsert($post_array){
        $post_array['fecha_alta']=date("Y-m-d");
        $post_array['dni_tutor']=eliminarEspacios($post_array['dni_tutor']);
        $post_array['dni_tutor'] = str_replace('-', '', $post_array['dni_tutor']);
        $post_array['dni_tutor'] = str_replace('.', '', $post_array['dni_tutor']);
        $post_array['dni_tutor'] = strtoupper($post_array['dni_tutor']);
        $post_array['dni_tutor']=trim($post_array['dni_tutor']);
        return $post_array;
    }

    function afterInsertEdit($post_array,$primary_key){
        mensaje('afterInsertEdit');
        //añadimos los nuevos nens/nenas tutoriados
        // cuantos tiene
        $dni=$post_array['dni_tutor'];
        $this->db->query("DELETE FROM c_users WHERE username='$dni'");
        $password=md5($post_array['contrasenya']);
        $nombre="Tutor/tutora ".$dni;
        $this->db->query("INSERT INTO c_users SET username='$dni', password='$password', nombre='$nombre', tipoUsuario=100 ");
        $hijosActuales=$this->db->query("SELECT dni_tutor FROM c_usuarios WHERE dni_tutor='$dni'")->num_rows();
        if($hijosActuales<$post_array['num_hijos']){
            // los añadimos
            $nuevos=$post_array['num_hijos']-$hijosActuales;
            for($i=0;$i<$nuevos;$i++){
                $sql="INSERT INTO c_usuarios SET 
                nombre_alumno='Nen/Nena ".($i+1)."', 
                dni_tutor='$dni'";
                $this->db->query($sql);
            }
        }


        return $post_array;
    }
    

    function validar_dni($dni, $texto)
    {
        if($texto=="DNI infant" && trim($dni)=="") return true;
        if($texto=='DNI autorització' && $this->input->post('id_aut_recogida') != 1) return true;
        $dni = strtoupper(trim($dni));
        $dni =  str_replace(" ", "", $dni);
        $dni = str_replace('-', '', $dni);
        $dni = str_replace('.', '', $dni);
        $dni = strtoupper($dni);

        $pas = strtolower(trim(substr($dni, -3, 3)));
        if ($pas == 'pas') return true;

        if (strlen($dni) != 9) {
            $this->form_validation->set_message('validar_dni', "EL " . $texto . " NO és vàlid. Ha de tenir 9 digits (números mes lletra)");
            return false;
        }

        $letra = substr($dni, -1, 1);

        $numero = substr($dni, 0, 8);
        $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);
        $modulo = $numero % 23;

        $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra_correcta = substr($letras_validas, $modulo, 1);

        if ($letra_correcta != $letra) {
            $this->form_validation->set_message('validar_dni', "EL " . $texto . " NO és vàlid. Nota: Si el número és un passaport, s'ha d'acabar amb PAS");
            return false;
        } else {
            return true;
        }
    }

   

    

    public function eliminarCurso($numCurso){
        // mensaje('eliminarCurso '.$numCurso);
        $salida=$this->db->query("DELETE FROM c_cursos WHERE num_curso='$numCurso'");
        $siguiente=$this->db->query("SELECT max(num_curso) as maximo FROM c_cursos")->row()->maximo+1;
        $this->db->query("ALTER TABLE c_cursos AUTO_INCREMENT = $siguiente");
        echo json_encode($salida);  
      } 



}