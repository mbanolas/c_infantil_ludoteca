<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Ludotecas extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->model('maba_model');
        $this->load->model('ludotecas_model');
    }
    public function _ludotecas_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/ludotecas.php', (array)$output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array)$output);
        $this->load->view('modals/modalInfo.php', (array)$output);
        $this->load->view('modals/modalSiNo.php', (array)$output);

    }

    function getDatosContratante($dni_contratante){    
        $query="SELECT * FROM c_ludotecas WHERE dni_contratante='$dni_contratante' ORDER by id DESC LIMIT 1";
        // mensaje($query);
        $row=$this->db->query($query)->row();
        echo json_encode($row);
    }

    function prepararDatos($post_array, $primary_key='0'){
        $post_array['id_curso']=1;
        //calcula id_dias_semana
        $id_dias_semana=0;
        if($post_array['dl']) $id_dias_semana=$id_dias_semana + 1;
        if($post_array['dm']) $id_dias_semana=$id_dias_semana + 2;
        if($post_array['dc']) $id_dias_semana=$id_dias_semana + 4;
        if($post_array['dj']) $id_dias_semana=$id_dias_semana + 8;
        if($post_array['dv']) $id_dias_semana=$id_dias_semana + 16;
        if($post_array['ds']) $id_dias_semana=$id_dias_semana + 32;
        if($post_array['dg']) $id_dias_semana=$id_dias_semana + 64;
        $post_array['id_dias_semana']=$id_dias_semana;

        $post_array['dni_contratante']=strtoupper($post_array['dni_contratante']);
        $post_array['dni_contratante']=eliminarEspacios($post_array['dni_contratante']);
        $post_array['telefono1_contratante']=formatearTelefono($post_array['telefono1_contratante']);
        $post_array['telefono2_contratante']=formatearTelefono($post_array['telefono2_contratante']);
        $post_array['nombre_contratante']=mb_ucfirst(mb_strtolower($post_array['nombre_contratante']));
        $post_array['apellido1_contratante']=mb_ucfirst(mb_strtolower($post_array['apellido1_contratante']));
        $post_array['apellido2_contratante']=mb_ucfirst(mb_strtolower($post_array['apellido2_contratante']));
        $post_array['direccion_contratante']=mb_ucfirst(mb_strtolower($post_array['direccion_contratante']));
        $post_array['provincia_contratante']=mb_ucfirst(mb_strtolower($post_array['provincia_contratante']));
       
        return $post_array;
    }

    function validar_dni($dni, $texto)
    {
        $dni = strtoupper(trim($dni));
        if($texto=='DNI autorización' && $this->input->post('id_aut_recogida') != 1) return true;
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
            //$this->get_form_validation()->set_message('validar_dni',"EL DNI, NIE o Pasaporte NO es válido. Nota Para entrar núm pasaporte, se debe terminar con '_'");
            return true;
        }
    }

    function validar_email($email,$texto){
        if(!$email) return true;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
       }
        $this->form_validation->set_message('validar_email', "EL " . $texto . " NO és vàlid.");
        return false;
    }

    function validar_numero($valor,$texto){
        if(!$valor) return true;
        if(is_numeric($valor)) return true;
        $this->form_validation->set_message('validar_numero', "EL " . $texto . " Debe ser un númeoro ");
            return false;

    }

    


    function validar_si_no($valor,$texto){
        if(!$valor){
            $this->form_validation->set_message('validar_si_no', "EL " . $texto . " ha de contenir un valor". $valor);
            return false;
        }
        return true;
    }
    function validar_si($valor,$texto){
        // mensaje('validar_si '.$valor);
        if(!$valor){
            $this->form_validation->set_message('validar_si', "EL " . $texto . " ha de contenir un valor". $valor);
            return false;
        }
        if($valor==2){
            $this->form_validation->set_message('validar_si', "EL " . $texto . " ha de respondre Sí");
            return false;
        }
        return true;
    }

    function validar_fecha($fecha,$texto){
        // #dd/MM/yyyy with leap years 100% integrated Valid years : from 1600 to 9999
        if(!preg_match(
            '~^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~',
            $fecha
            )){
            $this->form_validation->set_message('validar_fecha', "La " . $texto . " No es válida");
            return false;
            }
        return true;
    }



    function validar_texto($valor,$texto){
        $valor=trim($valor);
        if($valor==""){
            $this->form_validation->set_message('validar_texto', "EL " . $texto . " ha de contenir un valor");
            return false;
        }
        return true;
    }
    
    function validar_codigo_postal($codigoPostal, $texto)
    {
        //Esun DNI?
        $codigoPostal = strtoupper(trim($codigoPostal));
        $codigoPostal = str_replace(" ", "", $codigoPostal);

        if (substr($codigoPostal, -1, 1) == '_')
            return true;

        $check = true;
        for ($i = 0; $i < strlen($codigoPostal); $i++) {
            $n = substr($codigoPostal, $i, 1);
            if (!is_numeric($n))
                $check = false;
        }

        if (!$check) {
            $this->form_validation->set_message('validar_codigo_postal', "EL " . $texto . " DEBE contener sólo números. Nota: para evitar que se haga esta comprobación, se debe terminar con '_'");
            return false;
        }

        if (strlen($codigoPostal) != 5) {
            $this->form_validation->set_message('validar_codigo_postal', "EL " . $texto . " NO es válido, debe tener 5 números. Nota: para evitar que se haga esta comprobación, se debe terminar con '_'");
            return false;
        } else {
            //$this->get_form_validation()->set_message('validar_dni',"EL DNI, NIE o Pasaporte NO es válido. Nota Para entrar núm pasaporte, se debe terminar con '_'");
            return true;
        }
    }

    function validar_horario($horario,$texto){
        // if(!$horario) return true;
        if(preg_match('#([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?#', $horario)) return true;
        $this->form_validation->set_message('validar_horario', "EL " . $texto . " NO és vàlid.");
        return false;
    }

    // dejar en blanco
    function texto_callback($value = '', $primary_key = null){
        return '';
    }
   

    function horarioDesde($value = '', $primary_key = null){
        $value=substr($value,0,5);
        return '<input id="field-horario_desde" class="form-control" name="horario_desde" type="text" value="'.$value.'">';
    }
    function horarioHasta($value = '', $primary_key = null){
        $value=substr($value,0,5);
        return '<input id="field-horario_hasta" class="form-control" name="horario_hasta" type="text" value="'.$value.'">';
    }

    function textoDias($id_dias_semana){
        if(!$id_dias_semana) return "";
        if($id_dias_semana==31) return "De Dl à Dv";
        if($id_dias_semana==63) return "De Dl à Ds";
        if($id_dias_semana==127) return "De Dl à Dg";
        $texto="";
        if($id_dias_semana % 2 ==1) $texto.="Dl ";
        $id_dias_semana/=2;
        if($id_dias_semana % 2 ==1) $texto.="Dm ";
        $id_dias_semana/=2;
        if($id_dias_semana % 2 ==1) $texto.="Dc ";
        $id_dias_semana/=2;
        if($id_dias_semana % 2 ==1) $texto.="Dj ";
        $id_dias_semana/=2;
        if($id_dias_semana % 2 ==1) $texto.="Dv ";
        $id_dias_semana/=2;
        if($id_dias_semana % 2 ==1) $texto.="Ds ";
        $id_dias_semana/=2;
        if($id_dias_semana % 2 ==1) $texto.="Dg ";
        return $texto;
    }


    function afterInsert($post_array, $primary_key='0'){
        $hoy=date("Y-m-d");
        $usuario=$this->session->userdata('nombre');
        $sql="SELECT lu.horario_desde as horario_desde,
                     lu.num_ludoteca as num_ludoteca,
                     lu.horario_hasta as horario_hasta,
                     lu.nombre_contratante as nombre_contratante,
                     lu.apellido1_contratante as apellido1_contratante,
                     lu.entidad_contratante as entidad_contratante,
                     lu.fecha_desde as fecha_desde,
                     lu.fecha_hasta as fecha_hasta,
                     lu.id_dias_semana as id_dias_semana
                     FROM c_ludotecas lu
                     LEFT JOIN c_cursos c ON c.num_curso=lu.id_curso
                     WHERE num_ludoteca='$primary_key'";
          mensaje($sql);
         $row=$this->db->query($sql)->row();

        mensaje('$row->nombre_contratante '.$row->nombre_contratante);
         $texto_contratante=$row->nombre_contratante." ".$row->apellido1_contratante." (".$row->entidad_contratante.")";
        mensaje('texto contratante '.$texto_contratante);
         $texto_periodo=fechaDiaMesAno($row->fecha_desde).' - '.fechaDiaMesAno($row->fecha_hasta);
         $texto_horario=substr($row->horario_desde,0,5).' - '.substr($row->horario_hasta,0,5);
         $texto_dias_semana=$this->textoDias($row->id_dias_semana);
         $sql="UPDATE c_ludotecas SET 
                    -- id=$primary_key,
                    texto_periodo='$texto_periodo',
                    texto_contratante='$texto_contratante',
                    texto_horario='$texto_horario',
                    modificado_por='$usuario',
                    fecha_alta='$hoy',
                    fecha_modificacion='$hoy',
                    pagado=2,
                    texto_dias_semana='$texto_dias_semana'
                    WHERE num_ludoteca='$primary_key'";
        $this->db->query($sql);
     return true;
    }

    function afterUpdate($post_array, $primary_key='0'){
        $hoy=date("Y-m-d");
        $usuario=$this->session->userdata('nombre');
        $sql="SELECT lu.horario_desde as horario_desde,
                     lu.num_ludoteca as num_ludoteca,
                     lu.horario_hasta as horario_hasta,
                     lu.nombre_contratante as nombre_contratante,
                     lu.apellido1_contratante as apellido1_contratante,
                     lu.entidad_contratante as entidad_contratante,
                     lu.fecha_desde as fecha_desde,
                     lu.fecha_hasta as fecha_hasta,
                     lu.id_dias_semana as id_dias_semana
                     FROM c_ludotecas lu
                     LEFT JOIN c_cursos c ON c.num_curso=lu.id_curso
                     WHERE num_ludoteca='$primary_key'";
        mensaje('afterUpdate '.$sql);
         $row=$this->db->query($sql)->row();

         $texto_contratante=$row->nombre_contratante." ".$row->apellido1_contratante." (".$row->entidad_contratante.")";
         $texto_periodo=fechaDiaMesAno($row->fecha_desde).' - '.fechaDiaMesAno($row->fecha_hasta);
         $texto_horario=substr($row->horario_desde,0,5).' - '.substr($row->horario_hasta,0,5);
         $texto_dias_semana=$this->textoDias($row->id_dias_semana);

         $sql="UPDATE c_ludotecas SET 
                    num_ludoteca=$primary_key,
                    texto_periodo='$texto_periodo',
                    texto_contratante='$texto_contratante',
                    texto_horario='$texto_horario',
                    modificado_por='$usuario',
                    -- fecha_alta='$hoy',
                    fecha_modificacion='$hoy',
                    texto_dias_semana='$texto_dias_semana'
                    WHERE num_ludoteca='$primary_key'";
        // mensaje($sql);
        $this->db->query($sql);
     return true;
    }


    public function ludotecas()
    {

        $crud = new grocery_CRUD();

	
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_ludotecas';

        $ultimoCurso=$this->maba_model->getUltimoCurso();   
        $ultimoCursoTexto=$this->maba_model->getUltimoCursoTexto();   
     
        $crud
            ->set_table($table)
            ->order_by('num_ludoteca','desc')
            ->set_subject('Dades Contractació Ludoteca.')
            ->unset_clone()
            ->unset_read()
            // ->unset_delete()
            ;

        $crud->add_action('Fitxa', '', '', 'ui-icon-image', array($this, 'ficha'));
        $crud->add_action('Contratació', '', '', 'ui-icon-image', array($this, 'inscripcion'));

        $crud
            ->display_as('id_curso', 'Curs')
            ->display_as('horario_desde', 'Hora inici (hh:mm) ')
            ->display_as('horario_hasta', 'Hora final (hh:mm) ')
            ->display_as('fecha_desde', 'Data inici (dd/mm/aaaa)')
            ->display_as('fecha_hasta', 'Data finatl (dd/mm/aaaa)')
            ->display_as('texto_contratante', 'Contratant')
            ->display_as('texto_periodo', 'Periodos:')
            ->display_as('texto_horario', 'Horari')
            ->display_as('texto_dias_semana', 'Dies')
            ->display_as('precio', 'Preu global(€)')
            ->display_as('texto_horario', 'Hores')
            ->display_as('texto_ultimo_curso', "$ultimoCursoTexto")
            ->display_as('nombre_contratante', "Nom")
            ->display_as('apellido1_contratante', "Primer cognom")
            ->display_as('apellido2_contratante', "Segon cognom")
            ->display_as('entidad_contratante', "Entitat")
            ->display_as('email_contratante', "Email")
            ->display_as('telefono1_contratante', "Telèfon 1")
            ->display_as('telefono2_contratante', "Telèfon 2")
            ->display_as('direccion_contratante', "Adreça")
            ->display_as('poblacion_contratante', "Població")
            ->display_as('provincia_contratante', "Provincia")
            ->display_as('codigo_postal_contratante', "CP")
            ->display_as('dni_contratante', "DNI")
            ->display_as('id_dias_semana', "Dias setmana")
            // ->display_as('precio', "Preu (€)")
            ->display_as('pagado', "Contractat i Pagat ?")
            ->display_as('texto_id_decisiones_urgentes', 'Autoritzo als educadors/es a que prenguin les decisions necessàries en cas d’urgència. Fa extensiva aquesta autorització a les decisions medicoquirúrgiques que siguin necessàries adoptar, en cas d’extrema gravetat, sota la direcció facultativa pertinent. ')
            ->display_as('texto_id_imagen_en_actividades', 'Autoritzo al CASAL INFANTIL/ LUDOTECA (NOM DEL CASAL INFANTIL/LUCOTECA) a a utilitzar la imatge de l’infant en activitats internes (tallers, exposició de fotos, cd famílies etc...) durant el curs 2018-2019.')
            ->display_as('texto_id_imagen_divulgacion', 'Autoritzo al CASL INFANTIL/ LUDOTECA (NOM DEL CASAL INFANTIL/LUDOTECA) a que la imatge del meu fill/a sigui reproduïda en divulgacions lúdico-educatives, en les xarxes socials del casal i en altres medis de difusió de l’Ajuntament de Barcelona.')
            ->display_as('texto_id_lectura_informacion', 'He llegit la informació bàsica sobre protecció de dades i autoritzo el tractament de les dades')
            ->display_as('texto_id_pago_global', 'Pagament unic per contractant')
            ->display_as('texto_id_comunicaciones', strtoupper('Vull rebre les comunicacions del Casal'))
            ->display_as('texto_id_otras_comunicaciones', strtoupper('Vull rebre altres comunicacions d’interès general'))
            ->display_as('id_comunicaciones', '')
            ->display_as('id_otras_comunicaciones', '')
            ->display_as('id_decisiones_urgentes', '')
            ->display_as('id_imagen_en_actividades', '')
            ->display_as('id_imagen_divulgacion', '')
            ->display_as('id_lectura_informacion', '')
            ->display_as('id_pago_global', '')
            ->display_as('precio_general_anual', 'Preu general anual (€) ')
            ->display_as('precio_infancia_anual', 'Preu infans anual (€) ')
            ->display_as('precio_general_trimestre', 'Preu general trim. (€) ')
            ->display_as('descuento_primer_hermano', 'Dto. primer germá (%) ')
            ->display_as('descuento_siguientes_hermanos', 'Dto. seg. germans (%) ')
            ->display_as('num_maximo', 'Num màxim')
            ->display_as('iva', 'Iva (%)')
       

            ;

            $crud
                ->set_rules('dni_contratante', '', 'callback_validar_dni[DNI contratante]')
                ->set_rules('email_contratante', '', 'callback_validar_email[email contratante]')
                ->set_rules('horario_desde', '', 'callback_validar_horario[hora inici]')
                ->set_rules('horario_hasta', '', 'callback_validar_horario[hora final]')
                ->set_rules('fecha_desde', '', 'callback_validar_fecha[Data inici]')
                ->set_rules('fecha_hasta', '', 'callback_validar_fecha[Data final]')
                ->set_rules('codigo_postal_contratante', 'Código Postal', 'callback_validar_codigo_postal[Código Postal contratante]')
                ->set_rules('nombre_contratante', 'Nom Contratant', 'callback_validar_texto[Nom contratant]')
                ->set_rules('apellido1_contratante', '', 'callback_validar_texto[Primer Cognom Contratant]')
                ->set_rules('apellido2_contratante', '', 'callback_validar_texto[Segon Cognom Contratant]')
                ->set_rules('telefono1_contratante', '', 'callback_validar_texto[Telèfon1 Contratant]')
                ->set_rules('poblacion_contratante', '', 'callback_validar_texto[Població Contratant]')
                ->set_rules('provincia_contratante', '', 'callback_validar_texto[Provincia Contratant]')
                ->set_rules('nombre_ludoteca', '', 'callback_validar_texto[Nom Ludoteca]')
                ->set_rules('precio', '', 'callback_validar_numero[Preu global]')
                ->set_rules('id_pago_global', '', 'callback_validar_si_no[Seleccionar tipo Preu global]')
                ->set_rules('horas_actividad_T1', '', 'callback_validar_numero[Hores ludoteca T1]')
                ->set_rules('horas_actividad_T2', '', 'callback_validar_numero[Hores ludoteca T2]')
                ->set_rules('horas_actividad_T3', '', 'callback_validar_numero[Hores ludoteca T3]')
                ->set_rules('id_comunicaciones', '', 'callback_validar_si_no[Comunicacions Casal]')
                ->set_rules('id_otras_comunicaciones', '', 'callback_validar_si_no[Otras Comunicacions Casal]')
                ->set_rules('id_decisiones_urgentes', '', 'callback_validar_si_no[Autorizar decisiones urgentes]')
                ->set_rules('id_imagen_en_actividades', '', 'callback_validar_si_no[Autorizar imagen en actividades]')
                ->set_rules('id_imagen_divulgacion', '', 'callback_validar_si_no[Autorizar divulgacion imagen xarxes ludoteca]')
                ->set_rules('id_lectura_informacion', '', 'callback_validar_si[Informació bàsica]')

            ;
        
            $crud
                ->callback_field('horario_desde', array($this, 'horarioDesde'))
                ->callback_field('horario_hasta', array($this, 'horarioHasta'))

                ->callback_field('texto_id_decisiones_urgentes', array($this, 'texto_callback'))
                ->callback_field('texto_id_imagen_en_actividades', array($this, 'texto_callback'))
                ->callback_field('texto_id_imagen_divulgacion', array($this, 'texto_callback'))
                ->callback_field('texto_id_lectura_informacion', array($this, 'texto_callback'))
                ->callback_field('texto_id_pago_global', array($this, 'texto_callback'))
                ->callback_field('texto_id_comunicaciones', array($this, 'texto_callback'))
                ->callback_field('texto_id_otras_comunicaciones', array($this, 'texto_callback'))

                ->callback_column('precio',array($this,'_callback_precio'));


            ;   

        $crud->callback_edit_field('texto_ultimo_curso',function($value= ''){
            return "Curs";
          });

          $crud->callback_add_field('texto_ultimo_curso',function($value= ''){
            return "Curs ";
          });  
          
        //   $crud->callback_edit_field('texto_dias_semana',function($value= ''){
        //     return "Dies setmana";
        //   });
        //   $crud->callback_add_field('texto_dias_semana',function($value= ''){
        //     return "Dies setmana";
        //   });  
          
        
        $crud
            ->set_relation('id_curso', 'c_cursos', 'texto_curso')

            ->set_relation('id_comunicaciones', 'c_si_no', 'valor')
            ->set_relation('id_otras_comunicaciones', 'c_si_no', 'valor')
            ->set_relation('id_decisiones_urgentes', 'c_si_no', 'valor')
            ->set_relation('id_imagen_en_actividades', 'c_si_no', 'valor')
            ->set_relation('id_imagen_divulgacion', 'c_si_no', 'valor')
            ->set_relation('id_lectura_informacion', 'c_si_no', 'valor')
            ->set_relation('id_pago_global', 'c_si_no', 'valor')
            ->set_relation('pagado', 'c_si_no', 'valor')

            ;

        $camposColumnas = array(
                'num_ludoteca',
                'id_curso',
                'nombre_ludoteca',
                'texto_contratante',
                'texto_periodo',
                'texto_horario',
                'texto_dias_semana',
                
                'horas',
                'precio',
                'pagado'
            );


            $camposAddEdit= array(
                'num_ludoteca',
                'id_curso',
                'dni_contratante',
                'nombre_contratante',
                'apellido1_contratante',
                'apellido2_contratante',
                'entidad_contratante',
                'email_contratante',
                'telefono1_contratante',
                'telefono2_contratante',
                'direccion_contratante',
                'poblacion_contratante',
                'provincia_contratante',
                'codigo_postal_contratante',
                'nombre_ludoteca',
                'fecha_desde',
                'fecha_hasta',
                'horario_desde',
                'horario_hasta',
                'precio',
                'texto_ultimo_curso',
                // 'texto_dias_semana',
                'id_dias_semana',

                'texto_id_comunicaciones',
                'id_comunicaciones',
                'texto_id_otras_comunicaciones',
                'id_otras_comunicaciones',   
                'texto_id_decisiones_urgentes',
                'id_decisiones_urgentes',
                'texto_id_imagen_en_actividades',
                'id_imagen_en_actividades',
                'texto_id_imagen_divulgacion',
                'id_imagen_divulgacion',
                'texto_id_lectura_informacion',
                'id_lectura_informacion',

                'precio_general_anual',
                'precio_infancia_anual',
                'precio_general_trimestre',
                'descuento_primer_hermano',
                'descuento_siguientes_hermanos',
                'iva',
                'num_maximo',
                'horas_actividad_T1',
                'horas_actividad_T2',
                'horas_actividad_T3',
                'texto_id_pago_global',
                'id_pago_global',

                
                
            

            );

        $camposRequiered = array(
            'dni_contratante',
            'telefono1_contratante',
            'direccion_contratante',
            'poblacion_contratante',
            'provincia_contratante',
            'codigo_postal_contratante',

            'nombre_ludoteca',
            'fecha_desde',
            'fecha_hasta',
            'horario_desde',
            'horario_hasta',
            'precio',

            'id_comunicaciones',
            'id_otras_comunicaciones',

            'id_decisiones_urgentes',
            'id_imagen_en_actividades',
            'id_imagen_divulgacion',
            'id_lectura_informacion',
            'horas_actividad_T1',
                'horas_actividad_T2',
                'horas_actividad_T3',


        );

        $crud
            ->fields($camposAddEdit)
            ->columns($camposColumnas)
        ;

        $crud
            ->callback_before_update(array($this,'prepararDatos'))
            ->callback_before_insert(array($this,'prepararDatos'))
            ->callback_after_insert(array($this,'afterInsert'))
            ->callback_after_update(array($this,'afterUpdate'))
        ;

        $state = $crud->getState();

        // mensaje('$state '.$state);

        if ($state == 'add') {
            $crud->required_fields($camposRequiered);
        }

        $output = $crud->render();

        if ($state == 'add') {
            $siguiente=$this->maba_model->getSiguiente('c_ludotecas','num_ludoteca');
            $ultimoCurso=$this->maba_model->getUltimoCurso();
            // mensaje('$soguiente '.$siguiente);
            
            $jsAdd =   '<script> 
                                //Valores por defecto selecciones
                                $(\'.texto_status_pagado_form_group > label\').text("No"); 
                                $(\'select[name="id_curso"] option[value="'.$ultimoCurso.'"]\').attr("selected","selected"); 
                                //solo se permiten entrdas último curso 
                                // $(\'select[name="id_curso"]\').attr("disabled","disabled"); 
                                $(\'select[name="pagado"] option[value="2"]\').attr("selected","selected"); 
                                //$(\'select[name="id_pago_global"] option[value="2"]\').attr("selected","selected"); 
                                $(\'select[name="pagado"]\').attr("disabled","disabled"); 

                                $(\'#field-descuento_primer_hermano\').val("25");
                                $(\'#field-descuento_siguientes_hermanos\').val("50");

                                $(\'#field-poblacion_contratante\').val("Barcelona");
                                $(\'#field-provincia_contratante\').val("Barcelona");
                                $(\'#field-codigo_postal_contratante\').val("080");
                                
                                $(\'#field-num_ludoteca\').val("'.$siguiente.'");
                                
                                // $(\'#field-dni_contratante\').focus();
                                $(\'<div class="form-check dl"><input type="checkbox" name="dl" class="form-check-input" id="dl" ><label class="form-check-label" for="dl">Dl</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                $(\'<div class="form-check dm"><input type="checkbox" name="dm" class="form-check-input" id="dm" ><label class="form-check-label" for="dm">Dm</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                $(\'<div class="form-check dc"><input type="checkbox" name="dc" class="form-check-input" id="dc" ><label class="form-check-label" for="dc">Dc</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                $(\'<div class="form-check dj"><input type="checkbox" name="dj" class="form-check-input" id="dj" ><label class="form-check-label" for="dj">Dj</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                $(\'<div class="form-check dv"><input type="checkbox" name="dv" class="form-check-input" id="dv" ><label class="form-check-label" for="dv">Dv</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                $(\'<div class="form-check ds"><input type="checkbox" name="ds" class="form-check-input" id="ds" ><label class="form-check-label" for="ds">Ds</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                $(\'<div class="form-check dg"><input type="checkbox" name="dg" class="form-check-input" id="dg" ><label class="form-check-label" for="dg">Dg</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");

                                $(\'select[name="id_comunicaciones"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_otras_comunicaciones"] option[value="2"]\').attr("selected","selected");
                               
                                $(\'select[name="id_decisiones_urgentes"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_imagen_en_actividades"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_imagen_divulgacion"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_lectura_informacion"] option[value="2"]\').attr("selected","selected");
                           
                                </script>';


            $data['ultimoCurso']=$ultimoCurso;
            $output->data=$data;
            $output->output .= $jsAdd;
        }

        if ($state == 'edit') {
            $jsEdit =   '<script> 
                                //Valores por defecto selecciones
                                //alert($(\'select[name="pagado"]\').val())

                                var idDiasSemana=$(\'input[name="id_dias_semana"]\').val()                                  
                                if(idDiasSemana % 2 == 1) $(\'<div class="form-check dl"><input checked type="checkbox" name="dl" class="form-check-input" id="dl" ><label class="form-check-label" for="dl">Dl</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check dl"><input type="checkbox" name="dl" class="form-check-input" id="dl" ><label class="form-check-label" for="dl">Dl</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                idDiasSemana/=2
                                idDiasSemana=Math.floor(idDiasSemana)
                                if(idDiasSemana % 2 == 1) $(\'<div class="form-check dm"><input checked type="checkbox" name="dm" class="form-check-input" id="dm" ><label class="form-check-label" for="dm">Dm</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check dm"><input type="checkbox" name="dm" class="form-check-input" id="dm" ><label class="form-check-label" for="dm">Dm</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                idDiasSemana/=2
                                idDiasSemana=Math.floor(idDiasSemana)
                                if(idDiasSemana % 2 == 1) $(\'<div class="form-check dc"><input checked type="checkbox" name="dc" class="form-check-input" id="dc" ><label class="form-check-label" for="dc">Dc</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check dc"><input type="checkbox" name="dc" class="form-check-input" id="dc" ><label class="form-check-label" for="dc">Dc</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                idDiasSemana/=2
                                idDiasSemana=Math.floor(idDiasSemana)
                                if(idDiasSemana % 2 == 1) $(\'<div class="form-check dj"><input checked type="checkbox" name="dj" class="form-check-input" id="dj" ><label class="form-check-label" for="dj">Dj</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check dj"><input type="checkbox" name="dj" class="form-check-input" id="dj" ><label class="form-check-label" for="dj">Dj</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                idDiasSemana/=2
                                idDiasSemana=Math.floor(idDiasSemana)
                                if(idDiasSemana % 2== 1) $(\'<div class="form-check dv"><input checked type="checkbox" name="dv" class="form-check-input" id="dv" ><label class="form-check-label" for="dv">Dv</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check dv"><input type="checkbox" name="dv" class="form-check-input" id="dv" ><label class="form-check-label" for="dv">Dv</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                idDiasSemana/=2
                                idDiasSemana=Math.floor(idDiasSemana)
                                if(idDiasSemana % 2 == 1) $(\'<div class="form-check ds"><input checked type="checkbox" name="ds" class="form-check-input" id="ds" ><label class="form-check-label" for="ds">Ds</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check ds"><input type="checkbox" name="ds" class="form-check-input" id="ds" ><label class="form-check-label" for="ds">Ds</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                idDiasSemana/=2
                                idDiasSemana=Math.floor(idDiasSemana)
                                if(idDiasSemana % 2 == 1) $(\'<div class="form-check dg"><input checked type="checkbox" name="dg" class="form-check-input" id="dg" ><label class="form-check-label" for="dg">Dg</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");
                                else $(\'<div class="form-check dg"><input type="checkbox" name="dg" class="form-check-input" id="dg" ><label class="form-check-label" for="dg">Dg</label></div>\').insertAfter("#crudForm > div > div.card-body > div.md-form.horario_hasta_form_group");



                                // var statusPagado="No"
                                // if(pagado==1){
                                //     statusPagado="Sí"
                                //     $(\'select[name="id_actividad"]\').attr("disabled","disabled"); 
                                //     $(\'select[name="id_trimestre"]\').attr("disabled","disabled"); 
                                //     // $(\'select[name="id_becas"]\').attr("disabled","disabled"); 
                                //     // $(\'select[name="becas_desde"]\').attr("disabled","disabled"); 
                                //     // $(\'select[name="becas_dhasta"]\').attr("disabled","disabled"); 
                                //     $(\'input[name="precio"]\').attr("disabled","disabled"); 
                                //     $(\'input[name="precio"]\').css("border-bottom","0px"); 
                                //     $(\'select[name="id_hermanos_actividad"]\').attr("disabled","disabled"); 
                                //     $(\'input[name="hermanos_actividad"]\').attr("disabled","disabled"); 
                                //     $(\'input[name="hermano_num"]\').attr("disabled","disabled"); 
                                //     $(\'input[name="hermanos_actividad"]\').css("border-bottom","0px"); 
                                //     $(\'input[name="hermano_num"]\').css("border-bottom","0px");  
                                // }
                                // $(\'.texto_status_pagado_form_group > label\').text(statusPagado); 
                                // $(\'select[name="id_curso"]\').attr("disabled","disabled"); 
                                // $(\'select[name="pagado"]\').attr("disabled","disabled"); 
                                </script>';


            $data['ultimoCurso']=$ultimoCurso;
            $output->data=$data;
            $output->output .= $jsEdit;
        }

        $data['ultimoCurso']=$ultimoCurso;
        $output->data=$data;

        $this->_ludotecas_output($output);

    }

    function ficha($primary_key, $row){
        return site_url('reportes/pdfLudoteca/' . $primary_key);
    }

    function inscripcion($primary_key, $row){
        return site_url('inscripciones/reciboLudoteca/' . $primary_key);
    }

    function comprobarInscripcionLudoteca(){
        $resultado="";
        $num_ludoteca=$_POST['actividad'];
        mensaje('comprobarInscripcionLudoteca $num_ludoteca '.$num_ludoteca);
        //  $this->load->model('ludotecas_model');
         $resultado=$this->ludotecas_model->comprobarInscripcionLudoteca($num_ludoteca);
        echo json_encode($resultado);
    }
   
    public function _callback_precio($value, $row){
        if($value=="0.00") return "No";
    return $value;
    }





 public function calcularPrecio(){     
        $precio=$this->ludotecas_model->calcularPrecio();
        echo json_encode(number_format($precio,2));
    }

    
    



}