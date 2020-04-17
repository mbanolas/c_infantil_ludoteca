<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class UsuariosLudoteca_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		}

		function alta($num_actividad){
			$this->db->query("UPDATE c_actividades_infantiles SET inscripciones=inscripciones+1 WHERE num_actividad='$num_actividad'");
		}

		function baja($num_actividad){
			$this->db->query("UPDATE c_actividades_infantiles SET inscripciones=inscripciones-1 WHERE num_actividad='$num_actividad'");
		}
		
		function getUsuario($usuario){
			$sql="SELECT u.num_usuario as num_usuario,
						 u.nombre_alumno as nombre_alumno,
			   			 u.apellido1_alumno as apellido1_alumno,
			   			 u.apellido2_alumno as apellido2_alumno,
						 u.direccion_alumno,
						 u.poblacion_alumno,
						 u.provincia_alumno,		
						 u.codigo_postal_alumno,
						 u.dni_alumno,
						 u.nombre_tutor as nombre_tutor,
			   			 u.apellido1_tutor as apellido1_tutor,
			   			 u.apellido2_tutor as apellido2_tutor,
						 u.direccion_tutor,
						 u.poblacion_tutor,
						 u.provincia_tutor,
						 u.codigo_postal_tutor,
						 u.dni_tutor,
						 u.telefono1_tutor,
						 u.telefono2_tutor,
						 u.email_tutor,
						 u.profesion_padre,
						 u.profesion_madre,
						 u.fecha_nacimiento,
						 u.curso_escolar,
						 u.escuela,
						
						--  g.texto_grupo as grupo,
						 u.id_becas,
						 u.becas_desde,
						 u.becas_hasta,
						 u.id_monitora,
						 u.monitora_desde,
						 u.monitora_hasta,
						 u.id_participacion_anterior,
						 u.id_hermanos_actividad,
						 u.hermanos_actividad,
						 u.hermano_num,
						 u.id_tarjeta_t12,
						 u.id_derivado,
						 u.derivado,
						 u.id_asistencia_atencion,
						 u.asistencia_atencion,
						 u.id_alergia,
						 u.alergia,
						 u.id_respiratoria,
						 u.respiratoria,
						 u.id_vascular,
						 u.vascular,
						 u.id_cronica,
						 u.cronica,
						 u.id_hemorragia,
						 u.hemorragia,
						 u.id_medicacion,
						 u.medicacion,
						 u.id_nadar,
						 u.nadar,
						 u.id_nee,
						 u.nee,
						 u.id_presenta_dni_tutor,
						 u.id_presenta_dni_alumni,
						 u.id_presenta_libro_vacunas,
						 u.id_presenta_tarjeta_sanitaria,
						 u.id_presenta_otras,
						 u.presenta_otras,
						 u.id_comunicaciones,
						 u.id_otras_comunicaciones,
						 u.id_aut_acompanar,
						 u.id_aut_recogida,

						 u.aut_nombre,
						 u.aut_apellido1,
						 u.aut_apellido2,
						 u.aut_dni,
						 u.aut_parentesco,

						 u.aut_nombre_2,
						 u.aut_apellido1_2,
						 u.aut_apellido2_2,
						 u.aut_dni_2,
						 u.aut_parentesco_2,

						 u.aut_nombre_3,
						 u.aut_apellido1_3,
						 u.aut_apellido2_3,
						 u.aut_dni_3,
						 u.aut_parentesco_3,

						 u.aut_nombre_4,
						 u.aut_apellido1_4,
						 u.aut_apellido2_4,
						 u.aut_dni_4,
						 u.aut_parentesco_4,

						 u.id_aut_ir_solo,
						 u.id_decisiones_urgentes,
						 u.id_imagen_en_actividades,
						 u.id_imagen_divulgacion,
						 u.id_lectura_informacion,
						 u.fecha_modificacion,


						 a.num_ludoteca as num_actividad,
                         a.nombre_ludoteca as descripcion,
						--  a.descripcion as descripcion,
						 a.inscripciones as inscripciones,
						 a.num_maximo as num_maximo,	
			   			 a.horario_desde as horario_desde,
			   			 a.horario_hasta as horario_hasta,

						 a.num_ludoteca as num_ludoteca,
						 a.nombre_ludoteca,
						 a.texto_periodo,
						 a.texto_dias_semana,
						 a.texto_horario,

			   			 t.texto_trimestre as texto_trimestre,
			   			 u.pagado as pagado,
			   			 c.texto_curso,
			   			 u.precio as precio
			  FROM c_usuarios_ludoteca u 
			--   LEFT JOIN c_actividades_infantiles a ON u.id_actividad=a.num_actividad
            LEFT JOIN c_ludotecas a ON u.id_actividad=a.num_ludoteca
			  LEFT JOIN c_cursos c ON a.id_curso=c.num_curso
			--   LEFT JOIN c_grupos g ON a.id_grupo=g.num_grupo
			  LEFT JOIN c_trimestres t ON u.id_trimestre=t.id
			  WHERE  u.id='$usuario'
			" ;
			//  mensaje('$sql getUsuario '.$sql);
			$row=$this->db->query($sql)->row();
			return $row;
	}

	function getUsuarioArray($usuario){
		$sql="SELECT u.num_usuario as num_usuario,
					 u.nombre_alumno as nombre_alumno,
					 u.apellido1_alumno as apellido1_alumno,
					 u.apellido2_alumno as apellido2_alumno,
					 a.num_ludoteca as num_actividad,
					 a.nombre_ludoteca as descripcion,
					 a.texto_periodo as texto_periodo,
					 a.texto_dias_semana as texto_dias_semana,
					 a.inscripciones as inscripciones,
					 a.num_maximo as num_maximo,	
					 a.horario_desde as horario_desde,
					 a.horario_hasta as horario_hasta,
					 t.texto_trimestre as texto_trimestre,
					 u.pagado as pagado,
					 c.texto_curso,
					 u.precio as precio
			  FROM c_usuarios_ludoteca u 
			  LEFT JOIN c_ludotecas a ON u.id_actividad=a.num_ludoteca
			  LEFT JOIN c_cursos c ON a.id_curso=c.num_curso
			  LEFT JOIN c_trimestres t ON u.id_trimestre=t.id
			  WHERE  u.id='$usuario'
			" ;
		 mensaje('getUsuarioArray '.$sql);	
		$row=$this->db->query($sql)->row_array();
		return $row;
}

    

    
}