<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class UsuariosLudoteca2 extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->load->library('grocery_CRUD');
        $this->load->model('maba_model');
    }
    public function _usuarios_output($output = null)
    {
        $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
        $this->load->view('viewsTables/usuariosLudoteca.php', (array)$output);
        $this->load->view('templates/pieGrocery');
        $this->load->view('modals/modalPago.php', (array)$output);
        $this->load->view('modals/modalInfo.php', (array)$output);
        $this->load->view('modals/modalSiNo.php', (array)$output);

    }

    function texto_callback($value = '', $primary_key = null)
    {
        return '';
    }

    function getDatosActividad($numUsuario){
        $numInscipciones=0;
        $numInscipciones=$this->db->query("SELECT count(*) as numInscipciones FROM c_recibos WHERE num_usuario='$numUsuario'")->row()->numInscipciones;
        echo json_encode($numInscipciones); 
    }

    public function eliminarUsuario($numUsuario){
        // mensaje('eliminarUsuario Usuarios 41'.$numUsuario);
        $salida=$this->db->query("DELETE FROM c_usuarios_ludoteca WHERE num_usuario='$numUsuario'");
        $siguiente=$this->db->query("SELECT max(num_usuario) as maximo FROM c_usuarios_ludoteca")->row()->maximo+1;
        $this->db->query("ALTER TABLE c_usuarios_ludoteca AUTO_INCREMENT = $siguiente");
        echo json_encode($salida);  
      }  

    public function usuarios()
    {

        $crud = new grocery_CRUD();

	
        $crud->set_language('catalan');
        $crud->set_theme('mdb'); // magic code

        $table = 'c_usuarios_ludoteca';

        $ultimoCurso=$this->maba_model->getUltimoCurso();   
        $ultimoCursoTexto=$this->maba_model->getUltimoCursoTexto();   
     
        $crud
            ->set_table($table)
            ->order_by('num_usuario','desc')
            ->set_subject('Inscripcions usuaris/usuàries Ludoteca')
            ->unset_clone()
            ->unset_read()
            // ->unset_delete()
            ;

        $crud->add_action('Fitxa', '', '', 'ui-icon-image', array($this, 'ficha'));
         $crud->add_action('Pagament', '', '', 'ui-icon-image', array($this, 'inscripcion'));



        $crud
            ->display_as('pagado', 'Pagat:')
            ->display_as('num_usuario', 'Núm inscripció')
            ->display_as('nombre_tutor', 'Nom')
            ->display_as('apellido1_tutor', 'Primer Cognom')
            ->display_as('apellido2_tutor', 'Segon Cognom')
            ->display_as('direccion_tutor', 'Direcció')
            ->display_as('poblacion_tutor', 'Població')
            ->display_as('provincia_tutor', 'Provincia')
            ->display_as('dni_tutor', 'DNI')
            ->display_as('email_tutor', 'Email')
            ->display_as('telefono1_tutor', 'Telèfon 1')
            ->display_as('telefono2_tutor', 'Telèfon 2')
            ->display_as('nombre_alumno', 'Nom')
            ->display_as('apellido1_alumno', 'Primer Cognom')
            ->display_as('apellido2_alumno', 'Segon Cognom')
            ->display_as('direccion_alumno', 'Direcció')
            ->display_as('poblacion_alumno', 'Població')
            ->display_as('provincia_alumno', 'Provincia')
            ->display_as('dni_alumno', 'DNI')
            ->display_as('fecha_nacimiento', 'Data de naixement (dd/mm/aaaa)')
            ->display_as('codigo_postal_tutor', 'CP')
            ->display_as('codigo_postal_alumno', 'CP')
            ->display_as('aut_nombre', 'Nom')
            ->display_as('aut_apellido1', 'Primer Cognom')
            ->display_as('aut_apellido2', 'Segon Cognom')
            ->display_as('direccion_tutor', 'Direcció')
            ->display_as('poblacion_tutor', 'Població')
            ->display_as('provincia_tutor', 'Provincia')
            ->display_as('aut_dni', 'DNI')
            ->display_as('aut_parentesco', 'Parentiu')
            ->display_as('precio', 'Preu. (€)')
            ->display_as('texto_id_actividad', 'Ludoteca:')
            ->display_as('texto_pagado', 'Pagat:')
            ->display_as('texto_id_curso', 'Curso:')
            ->display_as('texto_ultimo_curso', "$ultimoCursoTexto")
            // ->display_as('texto_status_pagado', "texto_status_pagado")
            ->display_as('texto_titulo_curso', "Curs")
            ->display_as('texto_titulo_pagado', "Pagat?")
            ->display_as('becas_desde', "Becas desde (dd/mm/aaaa)")
            ->display_as('becas_hasta', "Becas hasta (dd/mm/aaaa)")
            ->display_as('monitora_desde', "Monitora desde (dd/mm/aaaa)")
            ->display_as('monitora_hasta', "Monitora desde (dd/mm/aaaa)")

            
            ->display_as('texto_id_trimestre', 'Trimestres:')
            ->display_as('texto_id_participacion_anterior', 'HA PARTICIPAT ANTERIORMENT DE L´ACTIVITAT?')
            ->display_as('texto_id_becas', 'HA SOL·LICITAT BECA?')
            ->display_as('texto_id_monitora', 'HA MONITOR/A DE SUPORT?')
            ->display_as('texto_id_hermanos_actividad', 'TÉ GERMANS/ES A L´ACTIVITAT?')
            ->display_as('texto_id_tarjeta_t12', 'TÉ TARGETA DEL TRANSPORT T-12?')
            ->display_as('texto_id_asistencia_atencion', 'ASSISTEIX A ALGUN SERVEI D´ATENCIÓ A LA INFÀNCIA?')
            ->display_as('texto_id_alergia', 'TÉ ALGUNA AL·LÈRGIA I/O INTOLERÀNCIA?')
            ->display_as('texto_id_respiratoria', 'TÉ ALGUNA MALALTIA RESPIRATÒRIA?')
            ->display_as('texto_id_vascular', 'TÉ ALGUNA MALALTIA VASCULAR?')
            ->display_as('texto_id_cronica', 'TÉ ALGUNA MALALTIA CRÒNICA?')
            ->display_as('texto_id_hemorragia', 'PATEIX HEMORRÀGIES?')
            ->display_as('texto_id_medicacion', 'PREN ALGUNA MEDICACIÓ?')
            ->display_as('texto_id_nadar', 'SAP NEDAR?')
            ->display_as('texto_id_nee', 'PRESENTA ALGUNA NEE?')

            ->display_as('texto_id_presenta_dni_tutor', 'DNI MARE/PARE/TUTOR/A')
            ->display_as('texto_id_presenta_dni_alumni', 'DNI INFANT')
            ->display_as('texto_id_presenta_libro_vacunas', 'LLIBRE VACUNES')
            ->display_as('texto_id_presenta_tarjeta_sanitaria', 'TARJETA SANITÀRIA')
            ->display_as('texto_id_presenta_otras', 'ALTRES DOCUMENTACIONS')
            ->display_as('texto_id_comunicaciones', strtoupper('Vull rebre les comunicacions del Casal'))
            ->display_as('texto_id_otras_comunicaciones', strtoupper('Vull rebre altres comunicacions d’interès general'))

            ->display_as('texto_id_aut_acompanar', 'Em comprometo a acompanyar i recollir el meu fill/a a les hores establertes  ')
            ->display_as('texto_id_aut_recogida', 'Autoritzo que el meu fill/a sigui recollit/da a la sortida del casal per en/na')
            ->display_as('texto_id_aut_ir_solo', 'Autoritzo al meu fill/filla a marxar sol del casal.')
            ->display_as('texto_id_decisiones_urgentes', 'Autoritzo als educadors/es a que prenguin les decisions necessàries en cas d’urgència. Fa extensiva aquesta autorització a les decisions medicoquirúrgiques que siguin necessàries adoptar, en cas d’extrema gravetat, sota la direcció facultativa pertinent. ')
            ->display_as('texto_id_imagen_en_actividades', 'Autoritzo al CASAL INFANTIL/ LUDOTECA (NOM DEL CASAL INFANTIL/LUCOTECA) a utilitzar la imatge de l’infant en activitats internes (tallers, exposició de fotos, cd famílies etc...) durant el curs 2018-2019.')
            ->display_as('texto_id_imagen_divulgacion', 'Autoritzo al CASL INFANTIL/ LUDOTECA (NOM DEL CASAL INFANTIL/LUDOTECA) a que la imatge del meu fill/a sigui reproduïda en divulgacions lúdico-educatives, en les xarxes socials del casal i en altres medis de difusió de l’Ajuntament de Barcelona.')
            ->display_as('texto_id_lectura_informacion', 'He llegit la informació bàsica sobre protecció de dades i autoritzo el tractament de les dades')

            ->display_as('alergia', 'Quina?')
            ->display_as('respiratoria', 'Quina?')
            ->display_as('vascular', 'Quina?')
            ->display_as('cronica', 'Quina?')
            ->display_as('hemorragia', 'Quina?')
            ->display_as('medicacion', 'Quina?')
            ->display_as('nadar', 'Nivell?')
            ->display_as('nee', 'Quina?')
            ->display_as('presenta_otras', 'Quina?')
            ->display_as('id_curso','Curs')
            ->display_as('id_actividad','Ludoteca:')
            ->display_as('id_ludoteca','Ludoteca:')
            ->display_as('grupo','Grup')
            ->display_as('id_trimestre','Període:')
            ->display_as('id_alergia', '')
            ->display_as('id_respiratoria', '')
            ->display_as('id_vascular', '')
            ->display_as('id_cronica', '')
            ->display_as('id_hemorragia', '')
            ->display_as('id_medicacion', '')
            ->display_as('id_nadar', '')
            ->display_as('id_nee', '')
            ->display_as('id_participacion_anterior', '')
            ->display_as('id_becas', '')
            ->display_as('id_monitora', '')
            ->display_as('id_hermanos_actividad', '')
            ->display_as('id_tarjeta_t12', '')
            ->display_as('id_asistencia_atencion', '')
            ->display_as('id_derivado', '')

            ->display_as('id_presenta_dni_tutor', '')
            ->display_as('id_presenta_dni_alumni', '')
            ->display_as('id_presenta_libro_vacunas', '')
            ->display_as('id_presenta_tarjeta_sanitaria', '')
            ->display_as('id_presenta_otras', '')
            ->display_as('id_comunicaciones', '')
            ->display_as('id_otras_comunicaciones', '')

            ->display_as('id_aut_acompanar', '')
            ->display_as('id_aut_ir_solo', '')
            ->display_as('id_aut_recogida', '')
            ->display_as('id_decisiones_urgentes', '')
            ->display_as('id_imagen_en_actividades', '')
            ->display_as('id_imagen_divulgacion', '')
            ->display_as('id_lectura_informacion', '')


            ->display_as('hermanos_actividad', 'Total germans')
            ->display_as('hermano_num', 'German Núm')
            ->display_as('asistencia_atencion', 'Servei d´atenció a la infància')
            ->display_as('curso_escolar', 'Curso');

        

        $crud
            ->set_relation('pagado', 'c_si_no', 'valor')
            // ->set_relation_n_n('curso','c_actividades_infantiles','c_cursos','num_actividad','id_curso','{texto_curso}')
            // ->set_relation_n_n('grupo','c_actividades_infantiles','c_grupos','num_actividad','id_grupo','{texto_grupo}')
            ->set_relation('id_actividad', 'c_ludotecas', '{nombre_ludoteca}',array('id_curso'=>$ultimoCurso))
            ->set_relation('id_curso', 'c_cursos', 'texto_curso')
            ->set_relation('id_grupo', 'c_grupos', 'texto_grupo')
            ->set_relation('id_trimestre', 'c_trimestres', 'texto_trimestre')
            ->set_relation('id_participacion_anterior', 'c_si_no', 'valor')
            ->set_relation('id_becas', 'c_si_no', 'valor')
            ->set_relation('id_monitora', 'c_si_no', 'valor')
            ->set_relation('id_hermanos_actividad', 'c_si_no', 'valor')
            ->set_relation('id_tarjeta_t12', 'c_si_no', 'valor')
            ->set_relation('id_asistencia_atencion', 'c_si_no', 'valor')
            ->set_relation('id_derivado', 'c_si_no', 'valor')
            ->set_relation('id_alergia', 'c_si_no', 'valor')
            ->set_relation('id_respiratoria', 'c_si_no', 'valor')
            ->set_relation('id_vascular', 'c_si_no', 'valor')
            ->set_relation('id_cronica', 'c_si_no', 'valor')
            ->set_relation('id_hemorragia', 'c_si_no', 'valor')
            ->set_relation('id_medicacion', 'c_si_no', 'valor')
            ->set_relation('id_nadar', 'c_si_no', 'valor')
            ->set_relation('id_nee', 'c_si_no', 'valor')

            ->set_relation('id_presenta_dni_tutor', 'c_si_no', 'valor')
            ->set_relation('id_presenta_dni_alumni', 'c_si_no', 'valor')
            ->set_relation('id_presenta_libro_vacunas', 'c_si_no', 'valor')
            ->set_relation('id_presenta_tarjeta_sanitaria', 'c_si_no', 'valor')
            ->set_relation('id_presenta_otras', 'c_si_no', 'valor')
            ->set_relation('id_comunicaciones', 'c_si_no', 'valor')
            ->set_relation('id_otras_comunicaciones', 'c_si_no', 'valor')

            ->set_relation('id_aut_acompanar', 'c_si_no', 'valor')
            ->set_relation('id_aut_ir_solo', 'c_si_no', 'valor')
            ->set_relation('id_aut_recogida', 'c_si_no', 'valor')
            ->set_relation('id_decisiones_urgentes', 'c_si_no', 'valor')
            ->set_relation('id_imagen_en_actividades', 'c_si_no', 'valor')
            ->set_relation('id_imagen_divulgacion', 'c_si_no', 'valor')
            ->set_relation('id_lectura_informacion', 'c_si_no', 'valor');

        $crud
            ->callback_field('texto_id_actividad', array($this, 'texto_callback'))
            ->callback_field('texto_id_trimestre', array($this, 'texto_callback'))
            ->callback_field('texto_id_curso', array($this, 'texto_callback'))
            ->callback_field('texto_id_participacion_anterior', array($this, 'texto_callback'))
            ->callback_field('texto_id_becas', array($this, 'texto_callback'))
            ->callback_field('texto_id_monitora', array($this, 'texto_callback'))
            ->callback_field('texto_id_hermanos_actividad', array($this, 'texto_callback'))
            ->callback_field('texto_id_tarjeta_t12', array($this, 'texto_callback'))
            ->callback_field('texto_id_asistencia_atencion', array($this, 'texto_callback'))
            ->callback_field('texto_id_derivado', array($this, 'texto_callback'))

            ->callback_field('texto_id_alergia', array($this, 'texto_callback'))
            ->callback_field('texto_id_respiratoria', array($this, 'texto_callback'))
            ->callback_field('texto_id_vascular', array($this, 'texto_callback'))
            ->callback_field('texto_id_cronica', array($this, 'texto_callback'))
            ->callback_field('texto_id_hemorragia', array($this, 'texto_callback'))
            ->callback_field('texto_id_medicacion', array($this, 'texto_callback'))
            ->callback_field('texto_id_nadar', array($this, 'texto_callback'))
            ->callback_field('texto_id_nee', array($this, 'texto_callback'))

            ->callback_field('texto_id_presenta_dni_tutor', array($this, 'texto_callback'))
            ->callback_field('texto_id_presenta_dni_alumni', array($this, 'texto_callback'))
            ->callback_field('texto_id_presenta_libro_vacunas', array($this, 'texto_callback'))
            ->callback_field('texto_id_presenta_tarjeta_sanitaria', array($this, 'texto_callback'))
            ->callback_field('texto_id_presenta_otras', array($this, 'texto_callback'))
            ->callback_field('texto_id_comunicaciones', array($this, 'texto_callback'))
            ->callback_field('texto_id_otras_comunicaciones', array($this, 'texto_callback'))

            ->callback_field('texto_id_aut_acompanar', array($this, 'texto_callback'))
            ->callback_field('texto_id_aut_ir_solo', array($this, 'texto_callback'))
            ->callback_field('texto_id_aut_recogida', array($this, 'texto_callback'))
            ->callback_field('texto_id_decisiones_urgentes', array($this, 'texto_callback'))
            ->callback_field('texto_id_imagen_en_actividades', array($this, 'texto_callback'))
            ->callback_field('texto_id_imagen_divulgacion', array($this, 'texto_callback'))
            ->callback_field('texto_id_lectura_informacion', array($this, 'texto_callback'));

        
        // $crud
        //     ->field_type('pagado','hidden');

        $crud
            ->callback_before_update(array($this,'formateoDatos'))
            ->callback_before_insert(array($this,'formateoDatos'))
            // ->callback_after_insert(array($this,'afterInsert'))
            ->callback_after_update(array($this,'afterUpdate'))
        ;


        $crud->set_rules('dni_tutor', '', 'callback_validar_dni[DNI tutor]')
            ->set_rules('nombre_tutor', '', 'callback_validar_texto[Nom tutor]')
            ->set_rules('apellido1_tutor', '', 'callback_validar_texto[Primer cognom tutor]')
            ->set_rules('apellido2_tutor', '', 'callback_validar_texto[Segon cognom tutor]')
            ->set_rules('nombre_alumno', '', 'callback_validar_texto[Nom infant/jove]')
            ->set_rules('apellido1_alumno', '', 'callback_validar_texto[Primer cognom infant/jove]')
            ->set_rules('apellido2_alumno', '', 'callback_validar_texto[Segon cognom infant/jove]')

            ->set_rules('fecha_nacimiento', '', 'callback_validar_fecha[Data naixement]')
            ->set_rules('dni_alumno', '', 'callback_validar_dni[DNI infant]')
            ->set_rules('email_tutor', '', 'callback_validar_email[email tutor]')
            // ->set_rules('id_actividad', '', 'callback_validar_id_actividad[una actividad]')
            // ->set_rules('id_trimestre', '', 'callback_validar_id_actividad[un periodo (trimestre)]')
            ->set_rules('aut_dni', '', 'callback_validar_dni[DNI autorización]')
            ->set_rules('codigo_postal_tutor', 'Código Postal', 'callback_validar_codigo_postal[Código Postal tutor]')
            ->set_rules('codigo_postal_alumno', 'Código Postal', 'callback_validar_codigo_postal[Código Postal infant]')
            ->set_rules('aut_nombre', '', 'callback_validar_aut_nombre[Nombre Autorizacion recogida]')
            ->set_rules('hermano_num', '', 'callback_validar_hermano_num[Hermano núm]')
            ->set_rules('aut_apellido1', '', 'callback_validar_aut_apellido1[Apellido1 Autorizacion recogida]')
            ->set_rules('aut_apellido2', '', 'callback_validar_aut_apellido2[Apellido1 Autorizacion recogida]')
            //->set_rules('aut_dni', '', 'callback_validar_aut_dni[DNI Autorizacion recogida]')
            ->set_rules('aut_parentesco', '', 'callback_validar_aut_parentesco[Parentesco Autorizacion recogida]')
            // ->set_rules('precio', '', 'callback_validar_numero[Preu]')
            ->set_rules('id_comunicaciones', '', 'callback_validar_si_no[Comunicacions Casal]')
            ->set_rules('id_otras_comunicaciones', '', 'callback_validar_si_no[Otras Comunicacions Casal]')
            ->set_rules('id_decisiones_urgentes', '', 'callback_validar_si_no[Autorizar decisiones urgentes]')
            ->set_rules('id_imagen_en_actividades', '', 'callback_validar_si_no[Autorizar imagen en actividades]')
            ->set_rules('id_imagen_divulgacion', '', 'callback_validar_si_no[Autorizar divulgacion imagen xarxes ludoteca]')
            ->set_rules('id_lectura_informacion', '', 'callback_validar_si[Informació bàsica]')
            
            ;

     
            $camposAdicionales = array('hermanos_actividad', 'respiratoria', 'asistencia_atencion', 'derivado', 'alergia', 'vascular', 'cronica', 'hemorragia', 'medicacion', 'nadar', 'nee');
        foreach ($camposAdicionales as $k => $v) {
            $crud->set_rules($v, '', 'callback_validar_obligatorio[' . $v . ']');
        }

        $camposAddEdit = array(
            'num_usuario',
            'dni_tutor',
            'nombre_tutor',
            'apellido1_tutor',
            'apellido2_tutor',
            
            'email_tutor',
            'direccion_tutor',

            'poblacion_tutor',
            'provincia_tutor',
            'codigo_postal_tutor',
            'telefono1_tutor',
            'telefono2_tutor',

            'profesion_padre',
            'profesion_madre',

            'dni_alumno',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            'fecha_nacimiento',
            'direccion_alumno',
            'poblacion_alumno',
            'provincia_alumno',
            'codigo_postal_alumno',
            'curso_escolar',
            'escuela',
            'texto_ultimo_curso',
            'texto_titulo_curso',
            'texto_titulo_pagado',
            'texto_status_pagado',
            // 'id_curso',
            // 'texto_id_curso',
            'id_actividad',
            // 'texto_id_actividad',
            'id_trimestre',
            // 'texto_id_trimestre',
            'precio',
            'pagado',

            'texto_id_becas',
            'id_becas',
            'becas_desde',
            'becas_hasta',
            'texto_id_monitora',
            'id_monitora',
            'monitora_desde',
            'monitora_hasta',

            'texto_id_participacion_anterior',
            'id_participacion_anterior',
            'texto_id_hermanos_actividad',
            'id_hermanos_actividad',
            'hermanos_actividad',
            'hermano_num',
            'texto_id_tarjeta_t12',
            'id_tarjeta_t12',
            'texto_id_asistencia_atencion',
            'id_asistencia_atencion',
            'asistencia_atencion',
            'texto_id_derivado',
            'id_derivado',
            'derivado',


            'texto_id_alergia',
            'id_alergia',
            'alergia',
            'texto_id_respiratoria',
            'id_respiratoria',
            'texto_id_vascular',
            'id_vascular',
            'respiratoria',
            'vascular',
            'texto_id_cronica',
            'id_cronica',
            'cronica',
            'texto_id_hemorragia',
            'id_hemorragia',
            'hemorragia',
            'texto_id_medicacion',
            'id_medicacion',
            'medicacion',
            'texto_id_nadar',
            'id_nadar',
            'nadar',
            'texto_id_nee',
            'id_nee',
            'nee',

            'texto_id_presenta_dni_tutor',
            'id_presenta_dni_tutor',
            'texto_id_presenta_dni_alumni',
            'id_presenta_dni_alumni',
            'texto_id_presenta_libro_vacunas',
            'id_presenta_libro_vacunas',
            'texto_id_presenta_tarjeta_sanitaria',
            'id_presenta_tarjeta_sanitaria',
            'texto_id_presenta_otras',
            'id_presenta_otras',
            'presenta_otras',
            'texto_id_comunicaciones',
            'id_comunicaciones',
            'texto_id_otras_comunicaciones',
            'id_otras_comunicaciones',

            'texto_id_aut_acompanar',
            'id_aut_acompanar',
            'texto_id_aut_recogida',
            'aut_nombre',
            'aut_apellido1',
            'aut_apellido2',
            'aut_dni',
            'aut_parentesco',
            'id_aut_recogida',
            'texto_id_aut_ir_solo',
            'id_aut_ir_solo',
            'texto_id_decisiones_urgentes',
            'id_decisiones_urgentes',
            'texto_id_imagen_en_actividades',
            'id_imagen_en_actividades',
            'texto_id_imagen_divulgacion',
            'id_imagen_divulgacion',
            'texto_id_lectura_informacion',
            'id_lectura_informacion',



        );
        $camposColumnas = array(
            'num_usuario',
            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            // 'dni_alumno',
            'fecha_nacimiento',
             'id_curso',
            'id_actividad',
            // 'id_grupo',
            // 'titulo_actividad',
            // 'grupo',
            'precio',
            'pagado'
        );
        $camposRequiered = array(
            'num_usuario',
            'nombre_tutor',
            'apellido1_tutor',
            'apellido2_tutor',
            'dni_tutor',
            // 'email_tutor',
            'direccion_tutor',

            'poblacion_tutor',
            'provincia_tutor',
            'codigo_postal_tutor',
            'telefono1_tutor',
            // 'telefono2_tutor',

            // 'profesion_padre',
            // 'profesion_madre',

            'nombre_alumno',
            'apellido1_alumno',
            'apellido2_alumno',
            // 'dni_alumno',
            'fecha_nacimiento',
            'direccion_alumno',
            'poblacion_alumno',
            'provincia_alumno',
            'codigo_postal_alumno',
             'id_actividad',
             'id_trimestre',
            // 'curso_escolar',
            // 'escuela',
            // 'texto_id_participacion_anterior',
            // 'id_becas',
            'id_monitora',
            'id_participacion_anterior',
            // 'texto_id_hermanos_actividad',
            // 'id_hermanos_actividad',
            // 'hermanos_actividad',
            // // 'texto_id_tarjeta_t12',
            // 'id_tarjeta_t12',
            // 'texto_id_asistencia_atencion',
            'id_asistencia_atencion',
            // // 'asistencia_atencion',
            // 'texto_id_derivado',
            'id_derivado',
            // 'derivado',


            // // 'texto_id_alergia',
            'id_alergia',
            // 'alergia',
            // 'texto_id_respiratoria',
            'id_respiratoria',
            // 'texto_id_vascular',
            'id_vascular',
            // 'respiratoria',
            // 'vascular',
            // 'texto_id_cronica',
            'id_cronica',
            // 'cronica',
            // 'texto_id_hemorragia',
            'id_hemorragia',
            // 'hemorragia',
            // 'texto_id_medicacion',
            'id_medicacion',
            // 'medicacion',
            // 'texto_id_nadar',
            'id_nadar',
            // 'nadar',
            // 'texto_id_nee',
            'id_nee',
            // 'nee',

            // 'texto_id_presenta_dni_tutor',
            'id_presenta_dni_tutor',
            // 'texto_id_presenta_dni_alumni',
            'id_presenta_dni_alumni',
            // 'texto_id_presenta_libro_vacunas',
            'id_presenta_libro_vacunas',
            // 'texto_id_presenta_tarjeta_sanitaria',
            'id_presenta_tarjeta_sanitaria',
            // 'texto_id_presenta_otras',
            'id_presenta_otras',
            // 'presenta_otras',
            // 'texto_id_comunicaciones',
            'id_comunicaciones',
            // 'texto_id_otras_comunicaciones',
            'id_otras_comunicaciones',

            // 'texto_id_aut_acompanar',
            'id_aut_acompanar',
            // 'texto_id_aut_recogida',
            // 'aut_nombre',
            // 'aut_apellido1',
            // 'aut_apellido2',
            // 'aut_dni',
            // 'aut_parentesco',
            'id_aut_recogida',
            // 'texto_id_aut_ir_solo',
            'id_aut_ir_solo',
            // 'texto_id_decisiones_urgentes',
            'id_decisiones_urgentes',
            // 'texto_id_imagen_en_actividades',
            'id_imagen_en_actividades',
            // 'texto_id_imagen_divulgacion',
            'id_imagen_divulgacion',
            // 'texto_id_lectura_informacion',
            'id_lectura_informacion'
        );

        $crud
            // ->required_fields($camposRequiered)
            ->fields($camposAddEdit)
            ->columns($camposColumnas);

        $crud->callback_edit_field('texto_ultimo_curso',function($value= ''){
            return "";
          });

          $crud->callback_add_field('texto_ultimo_curso',function($value= ''){
            return "";
          });

          $crud->callback_edit_field('texto_titulo_curso',function($value= ''){
            return "";
          });
          $crud->callback_add_field('texto_titulo_curso',function($value= ''){
            return "";
          });


          $crud->callback_edit_field('texto_status_pagado',function($value= ''){
            return "";
          });

          $crud->callback_add_field('texto_status_pagado',function($value= ''){
            return "";
          });

          $crud->callback_edit_field('texto_status_pagado',function($value= ''){
            return "";
          });
          $crud->callback_add_field('texto_status_pagado',function($value= ''){
            return "";
          });


          $crud->callback_edit_field('texto_titulo_pagado',function($value= ''){
            return "";
          });

          $crud->callback_add_field('texto_titulo_pagado',function($value= ''){
            return "";
          });

          $crud->callback_edit_field('texto_titulo_pagado',function($value= ''){
            return "";
          });
          $crud->callback_add_field('texto_titulo_pagado',function($value= ''){
            return "";
          });



        $state = $crud->getState();

        if ($state == 'add') {
            $crud->required_fields($camposRequiered);
        }
        if ($state == 'edit') {
            if (($key = array_search('id_actividad', $camposRequiered)) !== false) {
                unset($camposRequiered[$key]);
            }
            if (($key = array_search('id_trimestre', $camposRequiered)) !== false) {
                unset($camposRequiered[$key]);
            }
            $crud->required_fields($camposRequiered);
         }

        $output = $crud->render();
        // $output->codes = nl2br("");

        if ($state == 'add') {
            $siguiente=$this->maba_model->getSiguiente('c_usuarios_ludoteca','num_usuario');
            $ultimoCurso=$this->maba_model->getUltimoCurso();
            
            $jsAdd =   '<script> 
                                //Valores por defecto selecciones
                                $(\'.texto_status_pagado_form_group > label\').text("No"); 
                                $(\'select[name="id_curso"] option[value="'.$ultimoCurso.'"]\').attr("selected","selected"); 
                                //solo se permiten entrdas último curso 
                                $(\'select[name="id_curso"]\').attr("disabled","disabled"); 
                                $(\'select[name="pagado"] option[value="2"]\').attr("selected","selected"); 
                                $(\'select[name="pagado"]\').attr("disabled","disabled"); 
                                $(\'select[name="id_trimestre"] option[value="1"]\').attr("selected","selected"); 
                                
                                
                                $(\'select[name="id_participacion_anterior"] option[value="2"]\').attr("selected","selected"); 
                                $(\'select[name="id_becas"] option[value="2"]\').attr("selected","selected"); 
                                $(\'select[name="id_monitora"] option[value="2"]\').attr("selected","selected"); 
                                $(\'select[name="id_hermanos_actividad"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_tarjeta_t12"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_asistencia_atencion"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_derivado"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_alergia"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_respiratoria"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_vascular"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_cronica"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_hemorragia"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_medicacion"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_nadar"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_nee"] option[value="2"]\').attr("selected","selected");
                                
                                $(\'select[name="id_presenta_dni_tutor"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_presenta_dni_alumni"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_presenta_libro_vacunas"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_presenta_tarjeta_sanitaria"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_presenta_otras"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_comunicaciones"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_otras_comunicaciones"] option[value="2"]\').attr("selected","selected");
                                
                                $(\'select[name="id_aut_acompanar"] option[value="1"]\').attr("selected","selected");
                                $(\'select[name="id_aut_ir_solo"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_aut_recogida"] option[value="2"]\').attr("selected","selected");
                                
                                $(\'select[name="id_decisiones_urgentes"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_imagen_en_actividades"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_imagen_divulgacion"] option[value="2"]\').attr("selected","selected");
                                $(\'select[name="id_lectura_informacion"] option[value="2"]\').attr("selected","selected");
                                
                                $(\'#field-poblacion_tutor\').val("Barcelona");
                                $(\'#field-provincia_tutor\').val("Barcelona");
                                $(\'#field-codigo_postal_tutor\').val("080");
                                $(\'#field-poblacion_alumno\').val("Barcelona");
                                $(\'#field-provincia_alumno\').val("Barcelona");
                                $(\'#field-codigo_postal_alumno\').val("080");

                                $(\'#field-num_usuario\').val("'.$siguiente.'");
                                
                                // $(\'#field-dni_tutor\').focus();
                                </script>';


            $data['ultimoCurso']=$ultimoCurso;
            $output->data=$data;
            $output->output .= $jsAdd;
        }

        if ($state == 'edit') {
           
            $jsEdit =   '<script> 
                                //Valores por defecto selecciones
                                //alert($(\'select[name="pagado"]\').val())
                                var pagado=$(\'select[name="pagado"]\').val()
                                var statusPagado="No"
                                if(pagado==1){
                                    statusPagado="Sí"
                                    $(\'select[name="id_actividad"]\').attr("disabled","disabled"); 
                                    $(\'select[name="id_trimestre"]\').attr("disabled","disabled"); 
                                    // $(\'select[name="id_becas"]\').attr("disabled","disabled"); 
                                    // $(\'select[name="becas_desde"]\').attr("disabled","disabled"); 
                                    // $(\'select[name="becas_dhasta"]\').attr("disabled","disabled"); 
                                    $(\'input[name="precio"]\').attr("disabled","disabled"); 
                                    $(\'input[name="precio"]\').css("border-bottom","0px"); 
                                    $(\'select[name="id_hermanos_actividad"]\').attr("disabled","disabled"); 
                                    $(\'input[name="hermanos_actividad"]\').attr("disabled","disabled"); 
                                    $(\'input[name="hermano_num"]\').attr("disabled","disabled"); 
                                    $(\'input[name="hermanos_actividad"]\').css("border-bottom","0px"); 
                                    $(\'input[name="hermano_num"]\').css("border-bottom","0px");  
                                }
                                $(\'.texto_status_pagado_form_group > label\').text(statusPagado); 
                                $(\'select[name="id_curso"]\').attr("disabled","disabled"); 
                                $(\'select[name="pagado"]\').attr("disabled","disabled"); 
                                </script>';


            $data['ultimoCurso']=$ultimoCurso;
            $output->data=$data;
            $output->output .= $jsEdit;
        }
        $this->_usuarios_output($output);
    }

    

    function ficha($primary_key, $row)
    {
        return site_url('reportes/pdfUsuarioLudoteca/' . $primary_key);
    }

    function inscripcion($primary_key, $row)
    {
        return site_url('inscripciones/reciboUsuarioLudoteca/' . $primary_key);
    }

    function validar_obligatorio($valor, $texto)
    {
        if ($this->input->post('id_' . $texto) == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_obligatorio', "El camp " . $texto . " no pot estar en blanc o ser 0");
                return false;
            }
        }
    }
    function validar_hermano_num($valor, $texto)
    {
        if ($this->input->post('id_hermanos_actividad') == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_hermano_num', "EL hermano número és obligatori");
                return false;
            }
        }
    }
    function validar_aut_nombre($valor, $texto)
    {
        if ($this->input->post('id_aut_recogida') == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_aut_nombre', "EL nom de la persona autoritzada és obligatori");
                return false;
            }
        }
    }

    function validar_texto($valor,$texto){
        $valor=trim($valor);
        if($valor==""){
            $this->form_validation->set_message('validar_texto', "EL " . $texto . " ha de contenir un valor");
            return false;
        }
        return true;
    }

    function validar_aut_apellido1($valor, $texto)
    {
        if ($this->input->post('id_aut_recogida') == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_aut_apellido1', "EL primer cognom  de la persona autoritzada és obligatori");
                return false;
            }
        }
    }
    function validar_aut_apellido2($valor, $texto)
    {
        if ($this->input->post('id_aut_recogida') == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_aut_apellido2', "EL segon cognom  de la persona autoritzada és obligatori");
                return false;
            }
        }
    }

    function validar_aut_dni($valor, $texto)
    {
        if ($this->input->post('id_aut_recogida') == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_aut_dni', "EL DNI de la persona autoritzada és obligatori");
                return false;
            }
        }
    }
    function validar_aut_parentesco($valor, $texto)
    {
        if ($this->input->post('id_aut_recogida') == 1) {
            if (!$valor) {
                $this->form_validation->set_message('validar_aut_parentesco', "EL parentiu de la persona autoritzada és obligatori");
                return false;
            }
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

    function validar_id_actividad($id_actividad,$texto){
        // mensaje('pagado '.$_POST['pagado']);
        $pagado=$_POST['pagado'];
        if($id_actividad>0) {
            return true;
       }
        $this->form_validation->set_message('validar_id_actividad', "Obligatorio seleccionar $texto.");
        return false;
    }



    function validar_dni($dni, $texto)
    {
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


    function formateoDatos($post_array, $primary_key='0'){
        $post_array['dni_alumno']=strtoupper($post_array['dni_alumno']);
        $post_array['dni_alumno']=eliminarEspacios($post_array['dni_alumno']);
        $post_array['dni_tutor']=strtoupper($post_array['dni_tutor']);
        $post_array['dni_tutor']=eliminarEspacios($post_array['dni_tutor']);
        $post_array['aut_dni']=strtoupper($post_array['aut_dni']);
        $post_array['aut_dni']=eliminarEspacios($post_array['aut_dni']);
        $post_array['telefono1_tutor']=formatearTelefono($post_array['telefono1_tutor']);
        $post_array['telefono2_tutor']=formatearTelefono($post_array['telefono2_tutor']);
        
        $post_array['nombre_tutor']=mb_ucfirst(mb_strtolower($post_array['nombre_tutor']));
        $post_array['apellido1_tutor']=mb_ucfirst(mb_strtolower($post_array['apellido1_tutor']));
        $post_array['apellido2_tutor']=mb_ucfirst(mb_strtolower($post_array['apellido2_tutor']));
        $post_array['direccion_tutor']=mb_ucfirst(mb_strtolower($post_array['direccion_tutor']));
        $post_array['provincia_tutor']=mb_ucfirst(mb_strtolower($post_array['provincia_tutor']));
        $post_array['poblacion_tutor']=mb_ucfirst(mb_strtolower($post_array['poblacion_tutor']));
        $post_array['profesion_padre']=mb_ucfirst(mb_strtolower($post_array['profesion_padre']));
        $post_array['profesion_madre']=mb_ucfirst(mb_strtolower($post_array['profesion_madre']));


        $post_array['nombre_alumno']=mb_ucfirst(mb_strtolower($post_array['nombre_alumno']));
        $post_array['apellido1_alumno']=mb_ucfirst(mb_strtolower($post_array['apellido1_alumno']));
        $post_array['apellido2_alumno']=mb_ucfirst(mb_strtolower($post_array['apellido2_alumno']));
        $post_array['direccion_alumno']=mb_ucfirst(mb_strtolower($post_array['direccion_alumno']));
        $post_array['provincia_alumno']=mb_ucfirst(mb_strtolower($post_array['provincia_alumno']));
        $post_array['poblacion_alumno']=mb_ucfirst(mb_strtolower($post_array['poblacion_alumno']));
        
        $post_array['alergia']=mb_ucfirst($post_array['alergia']);
        $post_array['respiratoria']=mb_ucfirst($post_array['respiratoria']);
        $post_array['vascular']=mb_ucfirst($post_array['vascular']);
        $post_array['cronica']=mb_ucfirst($post_array['cronica']);
        $post_array['hemorragia']=mb_ucfirst($post_array['hemorragia']);
        $post_array['medicacion']=mb_ucfirst($post_array['medicacion']);
        $post_array['nadar']=mb_ucfirst($post_array['nadar']);
        $post_array['nee']=mb_ucfirst($post_array['nee']);
        $post_array['presenta_otras']=mb_ucfirst($post_array['presenta_otras']);
        $post_array['aut_nombre']=mb_ucfirst($post_array['aut_nombre']);
        $post_array['aut_apellido1']=mb_ucfirst($post_array['aut_apellido1']);
        $post_array['aut_apellido2']=mb_ucfirst($post_array['aut_apellido2']);
        $post_array['aut_parentesco']=mb_ucfirst($post_array['aut_parentesco']);
        return $post_array;
    }

    function afterInsert($post_array, $primary_key='0'){
        $id_trimestre=$post_array['id_trimestre'];     
        $hoy=date("Y-m-d");
        $usuario=$this->session->userdata('nombre');
        $sql="SELECT c.num_curso as num_curso, g.num_grupo as num_grupo, u.nombre_tutor as nombre_tutor 
        FROM c_usuarios_ludoteca u
        -- LEFT JOIN c_actividades_infantiles a ON a.num_actividad=u.id_actividad 
        LEFT JOIN c_ludotecas a ON a.num_ludoteca=u.id_actividad 
        LEFT JOIN c_cursos c ON c.num_curso=a.id_curso
        LEFT JOIN c_grupos g ON g.num_grupo=a.id_grupo
        WHERE num_usuario='$primary_key'";
        mensaje($sql);
        $row=$this->db->query($sql)->row();
        mensaje('$row->num_curso '.$row->num_curso);
        mensaje('$row->nombre_tutor '.$row->nombre_tutor);
        $sql="UPDATE c_usuarios_ludoteca SET 
        id='$primary_key',
        pagado=2, 
        fecha_alta='$hoy',
        fecha_modificacion='$hoy',
        modificado_por='$usuario',
        id_curso='$row->num_curso',
        id_grupo='$row->num_grupo',
        id_trimestre='$id_trimestre'
        WHERE id='$primary_key'";
        // mensaje($sql);
        $this->db->query($sql);
        return true;
    }

    function afterUpdate($post_array, $primary_key='0'){
        $id_trimestre=$post_array['id_trimestre'];
       
        $hoy=date("Y-m-d");
        $usuario=$this->session->userdata('nombre');
        $query="SELECT c.num_curso as num_curso, g.num_grupo as num_grupo FROM c_usuarios_ludoteca u
        LEFT JOIN c_ludotecas a ON a.num_ludoteca=u.id_actividad 
        LEFT JOIN c_cursos c ON c.num_curso=a.id_curso
        LEFT JOIN c_grupos g ON g.num_grupo=a.id_grupo

        WHERE num_usuario='$primary_key'";
        mensaje('afterUpdate '.$query);


        $row=$this->db->query($query)->row();
        $this->db->query("UPDATE c_usuarios_ludoteca SET 
                         fecha_modificacion='$hoy',
                         modificado_por='$usuario',
                         id_curso='$row->num_curso',
                         id_trimestre='$id_trimestre',
                         id_grupo='$row->num_grupo'
                         WHERE id='$primary_key'");
        return true;
    }

    function getDatosTutor($dni_tutor){
        //obtiene los últimos datos introducidos del tutor
    
        $query="SELECT * FROM c_usuarios_ludoteca WHERE dni_tutor='$dni_tutor' ORDER by id DESC LIMIT 1";
        // mensaje($query);
        $row=$this->db->query($query)->row();
        echo json_encode($row);
    }
    function getDatosAlumno($dni_alumno){
        //obtiene los últimos datos introducidos del alumno
        $row=$this->db->query("SELECT * FROM c_usuarios_ludoteca WHERE dni_alumno='$dni_alumno' ORDER by id DESC LIMIT 1")->row();
        echo json_encode($row);
    }
    function calcularPrecio(){
        $precio=0;
        $actividad=$_POST['actividad'];
        $trimestre=$_POST['trimestre'];
        $hermanosActividad=$_POST['hermanosActividad'];
        $hermanosNum=$_POST['hermanosNum'];
        $edad=$_POST['edad'];
        $query="SELECT * FROM c_actividades_infantiles WHERE num_actividad='$actividad'";
        $row=$this->db->query($query)->row();
        if(!$actividad) echo json_encode($precio);
        else {
            if($edad>=0 && $edad<=3) $precio=1.0*$row->precio_infancia_anual;
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
            echo json_encode(number_format($precio,2));
        }
    }

    function comprobarPagado($usuario){
        $resultado=2;
        $query="SELECT pagado FROM c_usuarios_ludoteca WHERE num_usuario='$usuario'";
        if($this->db->query($query)->num_rows()==0) {
            $resultado=2 ;
        }
        else {
            $resultado=$this->db->query($query)->row()->pagado;
        }
        echo json_encode($resultado);
    }

    function getTablaInscripcionesPagadas($id_curso="",$numActividad=""){
        $this->load->model('actividades_model');
        $resultado=$this->actividades_model->getTablaInscripcionesPagadas($id_curso,$numActividad);
        echo json_encode($resultado);
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
    function validar_numero($valor,$texto){
        if(is_numeric($valor)) return true;
        $this->form_validation->set_message('validar_numero', "EL " . $texto . " Debe ser un númeoro (".$valor.")");
            return false;

    }
    function validar_si_no($valor,$texto){
        if(!$valor){
            $this->form_validation->set_message('validar_si_no', "EL " . $texto . " ha de contenir un valorr". $valor);
            return false;
        }
        return true;
    }


}

