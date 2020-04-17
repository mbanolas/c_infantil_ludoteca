<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Reportes extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        define('EURO',chr(128));
    }

    

function datos($pdf,$dato,$valor){
  // mensaje($dato.'-'.$valor);
    $margen=5;
    $h=6;
    $border=0;
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($margen,$h,'',$border,0,'L',0);
    $pdf->Cell(75,$h,iconv('UTF-8', 'CP1252', $dato),$border,0,'L',0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(75,$h,utf8_decode($valor),$border,1,'L',0);
}  

function titulo($pdf,$titulo,$h=6){
  // $h=6;
  $border=0;
  $pdf->SetFont('Arial', 'BI', 10);
  $pdf->SetTextColor(0,128,255);
  $pdf->ln();
  $pdf->Cell(75,$h,utf8_decode($titulo),$border,1,'L',0);
  $pdf->SetFont('Arial', '', 10);
  $pdf->SetTextColor(0,0,0);
}

function datosSiNo($pdf,$dato,$valor="",$valor2="",$valor3=""){
  $margen=5;
  $h=6;
  $border=0;
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell($margen,$h,'',$border,0,'L',0);
  $pdf->Cell(100,$h,iconv('UTF-8', 'CP1252',$dato),$border,0,'L',0);
  $pdf->SetFont('Arial', 'B', 10);
  if($valor!="")
    $pdf->Cell(12,$h,iconv('UTF-8', 'CP1252',$valor==1?"Sí":"No"),$border,0,'L',0);
  $pdf->Cell(40,$h,iconv('UTF-8', 'CP1252',$valor2),$border,0,'L',0);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(75,$h,iconv('UTF-8', 'CP1252',$valor3),$border,1,'L',0);
  $pdf->SetFont('Arial', '', 10);
}  
function datosSiNoLinea($pdf,$dato,$ancho,$valor=""){
  $margen=5;
  $h=6;
  $border=0;
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell($margen,$h,'',$border,0,'L',0);

  $pdf->Cell(75,$h,iconv('UTF-8', 'CP1252',$dato),$border,0,'L',0);
  // $pdf->Cell($ancho,$h,utf8_decode($dato),$border,0,'L',0);
  $pdf->SetFont('Arial', 'B', 10);
  if($valor!="")
    $pdf->Cell(108,$h,iconv('UTF-8', 'CP1252',$valor==1?"Sí":"No"),$border,1,'R',0);
  // $pdf->Cell(40,$h,utf8_decode($valor2),$border,0,'L',0);
  // $pdf->SetFont('Arial', 'B', 10);
  // $pdf->Cell(75,$h,utf8_decode($valor3),$border,1,'L',0);
  $pdf->SetFont('Arial', '', 10);
} 

function datosSiNoMultiCell($pdf,$dato,$valor="",$valor2=""){
  $margen=5;
  $h=6;
  $border=0;
  $pdf->Cell($margen,$h,'',$border,0,'L',0);
  $pdf->MultiCell(100,$h,iconv('UTF-8', 'CP1252',$dato),$border,0,'L',0);
  if($valor!="")
    $pdf->Cell(12,$h,utf8_decode($valor==1?"Sí":"No"),$border,0,'L',0);
  $pdf->Cell(75,$h,iconv('UTF-8', 'CP1252',$valor2),$border,1,'L',0);
  $pdf->SetFont('Arial', '', 10);
}  

public function getNumRecibo(){
  if($this->db->query("SELECT id FROM c_recibos ORDER BY id DESC LIMIT 1")->num_rows()==0) return 1;
  return $this->db->query("SELECT id FROM c_recibos ORDER BY id DESC LIMIT 1")->row()->id+1;
}   

// public function pdfReciboUsuarioLudotecaDevolucion($usuario){
//   mensaje('$usuario '.$usuario);
//   // Se carga el modelo usuario
//   $this->load->model('usuariosLudoteca_model');
//   $this->load->model('maba_model');
//   // Se carga la libreria fpdf
//  $this->load->library('recibo');

//   // Se obtienen los datos del usuario de la base de datos
//   $resultUsuario = $this->usuariosLudoteca_model->getUsuario($usuario);
//   // mensaje('$resultUsuario->pagado '.$resultUsuario->pagado);
//   if($resultUsuario->pagado==2) {
//     $rowUsuario = $this->usuariosLudoteca_model->getUsuarioArray($usuario);
//     $this->load->view('templates/cabecera');
// 		$this->load->view('viewsBodies/inscripcionesAltasLudoteca',$rowUsuario);
//     $this->load->view('templates/pie');
//     return;
//   }

//   // Creacion del PDF
//     /*
//      * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
//      * heredó todos las variables y métodos de fpdf
//      */
//     $this->pdf = new Recibo();

//     $this->pdf->setTitulo(utf8_decode('Rebut'));
//     //$this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

//     // Agregamos una página
//     $this->pdf->AddPage();
//     // Define el alias para el número de página que se imprimirá en el pie
//     $this->pdf->AliasNbPages();


//     $mesos=array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost", "Setembre","Octubre","Novembre","Desembre"); 

//     $hoy=date('d')." de ".$mesos[date('n')-1]." de ".date('Y');
//     $pag=132;
//     $m=0;
//     for($i=0;$i<2;$i++){
//       $this->pdf->SetY(26+$i*$pag);

//     $letra=getLetraCasal();
//     $this->pdf->SetFont('Arial','B',10);
//     $numRecibo=$this->getNumRecibo();
//     $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$letra.' '.$numRecibo),$m,1,'R','0');
        
//     $this->pdf->Cell(0,1,utf8_decode('Barcelona, '.$hoy),$m,1,'R','0');

//     $this->pdf->SetY(42+$i*$pag);
   
//     $this->pdf->SetFont('Arial', '', 18);
//     $this->pdf->Cell(60,10,utf8_decode('DEVOLUCIÓ A: '),$m,0,'L','0');
    
//     $this->pdf->SetFont('Arial', 'B', 18);
//     mensaje('$resultUsuario->nombre_alumno '.$resultUsuario->nombre_alumno);
//     $this->pdf->Cell(20,10,utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno),$m,0  ,'L',0);
//     $this->pdf->SetFont('Arial', '', 12);
//     $this->pdf->Ln();
//     $this->pdf->Cell(38,8,'la quantitat de: ',$m,0,'L',0);
//     $this->pdf->SetFont('Arial','',14);

//     // $this->pdf->Cell(0,8,utf8_decode(ucfirst(($resultUsuario->precio))),$m,1,'L');
//     $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan($resultUsuario->precio))),$m,1,'L');
//     $this->pdf->Cell(0,8,utf8_decode('en concepte de BAIXA a la ludoteca: '),$m,1,'L');
//     $this->pdf->SetFont('Arial','B',14);
//     $this->pdf->Cell(0,8,utf8_decode('    Curs: '.$resultUsuario->texto_curso),$m,1,'L');
//     $this->pdf->Cell(0,8,utf8_decode('    Activitat: '.$resultUsuario->descripcion),$m,1,'L');
//     $this->pdf->Cell(0,8,utf8_decode('    Horari: '.substr($resultUsuario->horario_desde,0,5).':'.substr($resultUsuario->horario_hasta,0,5)),$m,1,'L');
//     $this->pdf->Cell(0,8,utf8_decode('    Dies setmana: '.$resultUsuario->texto_dias_semana),$m,1,'L');
//     $this->pdf->Cell(0,8,utf8_decode('    Trimestres: '.$resultUsuario->texto_trimestre),$m,1,'L');

//     $this->pdf->Ln();
//     $this->pdf->SetFont('Arial', 'BI', 18);
//     $this->pdf->Cell(40,10,utf8_decode('Euros: '.$resultUsuario->precio),'0',0  ,'L','0');

//     $this->pdf->SetY(140+$i*125);
//     $this->pdf->SetFont('Arial', '', 10);
//     if($i) $r=" - Casal"; else $r=" - Usuari/usuària";
//     $this->pdf->Cell(0,10,utf8_decode('COBRAT/INSCRIT'.$r),'$m',0  ,'R','0');

//     if(!$i) $this->pdf->Line(0,154,250,154);


//     }
 
//     /* Se define el titulo, márgenes izquierdo, derecho y
//      * el color de relleno predeterminado
//      */
//     //$this->pdf->SetTitle("Datos socio=");
//     //$this->pdf->SetLeftMargin(15);
//     //$this->pdf->SetRightMargin(15);
//     //$this->pdf->SetFillColor(200,200,200);
 
//     // Se define el formato de fuente: Arial, negritas, tamaño 9
//     $this->pdf->SetFont('Arial', 'BIU', 10);
    
//     $border=0;
//     //$this->pdf->Ln(2);
//     // La variable $x se utiliza para mostrar un número consecutivo
//     $h = 6;
//     //$this->pdf->SetFont('Arial', '', fa-rotate-180);
//     // mb_convert_encoding($str, "EUC-JP", "auto");


//     $recibo=mb_convert_encoding("Rebut ".$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.".pdf", "EUC-JP", "auto");
//     $this->pdf->Output('recibos/'."Recibo usuari ".$resultUsuario->num_usuario, 'F');

//     $this->db->query("UPDATE c_usuarios_ludoteca SET pagado='2' WHERE num_usuario='".$resultUsuario->num_usuario."'");
    
//     $numRegistro="";
//     $numRegistroPosicion=0;
//     if($resultUsuario->precio!=0){
//       $numRegistro=date("Y").getNumeroRegistroCasalDevoluciones();
//       $numRegistroPosicion=$this->maba_model->getSiguienteNumRegistro('c_recibos','num_registro_posicion',$numRegistro);
//     }
//     $hoy=date("Y-m-d");

//     $this->db->query("INSERT INTO c_recibos SET num_usuario='".$resultUsuario->num_usuario."', 
//                                                  recibo='"."Recibo usuari ".$resultUsuario->num_usuario."',
//                                                  recibo_num='".$letra.' '.$numRecibo."',
//                                                  num_registro='".$numRegistro."',
//                                                  num_registro_posicion='".$numRegistroPosicion."',
//                                                  fecha_recibo='".$hoy."',
//                                                  id_trimestre='".$resultUsuario->id_trimestre."',
//                                                  importe='".$resultUsuario->precio."'");

// $this->db->query("UPDATE c_ludotecas SET inscripciones=inscripciones-1 WHERE num_ludoteca='".$resultUsuario->num_actividad."'");                                               $this->pdf->Output($recibo, 'D');
// }


public function pdfReciboInscripcion($inscripcionId,$formaPago=1,$pago=15){

  // Se carga el modelos usuario, maba
  $this->load->model('usuarios_model');
  $this->load->model('maba_model');
  // Se carga la libreria fpdf
  $this->load->library('recibo');

  // Se obtienen los datos dela inscripcion de la base de datos 
  $this->load->model('inscripciones_model');
  
  $resultInscripcion = $this->inscripciones_model->getInscripcion($inscripcionId);
  $inscripcion=$resultInscripcion['resultInscripcion'];
  $actividades=$resultInscripcion['resultActividades'];
  $listaEspera=$resultInscripcion['resultListaEspera'];
  $trimestres=$resultInscripcion['resultTrimestres'];
  
  $id_recibo=$inscripcion->id_recibo;

  // Creacion del PDF
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Recibo();

    $this->pdf->setTitulo(utf8_decode('Rebut'));
    //$this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();

    $mesos=array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost", "Setembre","Octubre","Novembre","Desembre"); 

    $hoy=date('d')." de ".$mesos[date('n')-1]." de ".date('Y');
    // parametro para crear copia
    $pag=132;
    $m=0;
    for($i=0;$i<2;$i++){
      $this->pdf->SetY(26+$i*$pag);

    $this->pdf->SetFont('Arial','B',10);
    $numRecibo=$this->db->query("SELECT num_registro_ingreso FROM c_recibos WHERE id='".$inscripcion->id_recibo."'")->row()->num_registro_ingreso;
    // $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$letra.' '.$numRecibo),$m,1,'R','0');
    
    
    $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$numRecibo),$m,1,'R','0');
        
    $this->pdf->Cell(0,1,utf8_decode('Barcelona, '.$hoy),$m,1,'R','0');

    $this->pdf->SetFont('Arial', '', 18);
    
    if($inscripcion->pago_recibo>=0){
      $this->pdf->SetY(60+$i*$pag);
      $this->pdf->Cell(40,10,'REBUT de: ',$m,0,'L','0');
    }
    else{
        $this->pdf->SetY(60+$i*$pag);
        $this->pdf->Cell(50,10,utf8_decode('DEVOLUCIÓ de: '),$m,0,'L','0');
    }

    $this->pdf->SetFont('Arial', 'B', 18);
    $this->pdf->Cell(20,10,utf8_decode($inscripcion->nombre_alumno.' '.$inscripcion->apellido1_alumno.' '.$inscripcion->apellido2_alumno),$m,0  ,'L',0);
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->Ln();
    $this->pdf->Cell(38,8,'la quantitat de: ',$m,0,'L',0);
    $this->pdf->SetFont('Arial','',14);

    // $this->pdf->Cell(0,8,utf8_decode(ucfirst(($resultUsuario->precio))),$m,1,'L');
    if($inscripcion->pago_recibo>=0)
        $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan($inscripcion->pago_recibo))),$m,1,'L');
    else  
        $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan(-$inscripcion->pago_recibo))),$m,1,'L');

    $this->pdf->Cell(0,8,utf8_decode('en concepte de INSCRIPCIÓ a las activitats i períodes: '),$m,1,'L');
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Cell(0,5,utf8_decode('    Curs: '.$inscripcion->texto_curso),$m,1,'L');

    foreach($actividades as $k=>$v){
        $this->pdf->Cell(0,5,utf8_decode('    Activitat '.($k+1).': '.$v->descripcion." (Horari: ".substr($v->horario_desde,0,5).'-'.substr($v->horario_hasta,0,5).")"),$m,1,'L');   
    }
    foreach($trimestres as $k=>$v){
      $trimestre=$v->texto_trimestre;
      $this->pdf->Cell(0,5,utf8_decode('    Període. '.($k+1).': '.$trimestre),$m,1,'L');   
    }
    $this->pdf->SetFont('Arial','B',9);
    foreach($listaEspera as $k=>$v){
        $this->pdf->Cell(0,5,utf8_decode('    Llista Espera '.($k+1).': '.$v->descripcion),$m,1,'L');   
    }
    $this->pdf->SetFont('Arial','B',12);
    

    $this->pdf->Ln();
    $this->pdf->SetFont('Arial', 'BI', 18);
    if($inscripcion->pago_recibo>=0)
          $this->pdf->Cell(40,10,utf8_decode('Euros: '.$inscripcion->pago_recibo),$m,1  ,'L','0');
    else
          $this->pdf->Cell(40,10,utf8_decode('Euros: '.(-$inscripcion->pago_recibo)),$m,1  ,'L','0');

    $this->pdf->SetFont('Arial', '', 10);
    switch($inscripcion->forma_pago){
      case 1:
        $medioPago="Metàl·lic";
      break;
      case 2:
        $medioPago="Targeta";
      break;
      case 3:
        $medioPago="Transferencia";
      break;
      default:
      $medioPago="";
    }
    if($inscripcion->forma_pago!=1)
        $this->pdf->Cell(40,8,utf8_decode('Pagament '.$medioPago),$m,0 ,'L','0');
    if($inscripcion->pendiente_pago>0){    
        $this->pdf->Cell(40,8,'Pagament a compte - Preu '.$inscripcion->precio_a_pagar.' '.EURO.' - Resta pendent de pagar '.$inscripcion->pendiente_pago.' '.EURO,$m,0 ,'L','0');

    }

    $this->pdf->SetY(140+$i*125);
    $this->pdf->SetFont('Arial', '', 10);
    if($i) $r=" - Casal"; else $r=" - Usuari/usuària";
    $this->pdf->Cell(0,10,utf8_decode('COBRAT '.$r),'$m',0  ,'R','0');

    if(!$i) $this->pdf->Line(0,154,250,154);
    }
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'BIU', 10);
    
    $border=0;
    $h = 6;

    $recibo=mb_convert_encoding("Rebut ".$inscripcion->nombre_alumno.' '.$inscripcion->apellido1_alumno.".pdf", "EUC-JP", "auto");
    $this->pdf->Output('recibos/'.$numRecibo, 'F');
    $this->pdf->Output($recibo, 'D');

    header("Location:".base_url()."inscripciones/inscripciones");

}


public function pdfRecibo($usuario){
  // Se carga el modelo usuario
  $this->load->model('usuarios_model');
  $this->load->model('maba_model');
  // Se carga la libreria fpdf
 $this->load->library('recibo');

  // Se obtienen los datos del usuario de la base de datos
  $resultUsuario = $this->usuarios_model->getUsuario($usuario);
  // mensaje('$resultUsuario->pagado '.$resultUsuario->pagado);
  if($resultUsuario->pagado==1) {
    $rowUsuario = $this->usuarios_model->getUsuarioArray($usuario);
    $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripcionesBajas',$rowUsuario);
    $this->load->view('templates/pie');
    return;
  }

  // Creacion del PDF
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Recibo();

    $this->pdf->setTitulo(utf8_decode('Rebut'));
    //$this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();


    $mesos=array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost", "Setembre","Octubre","Novembre","Desembre"); 

    $hoy=date('d')." de ".$mesos[date('n')-1]." de ".date('Y');
    $pag=132;
    $m=0;
    for($i=0;$i<2;$i++){
      $this->pdf->SetY(26+$i*$pag);

    $letra=getLetraCasal();
    $this->pdf->SetFont('Arial','B',10);
    $numRecibo=$this->getNumRecibo();
    $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$letra.' '.$numRecibo),$m,1,'R','0');
        
    $this->pdf->Cell(0,1,utf8_decode('Barcelona, '.$hoy),$m,1,'R','0');

    $this->pdf->SetY(60+$i*$pag);
   
    $this->pdf->SetFont('Arial', '', 18);
    $this->pdf->Cell(40,10,'REBUT de: ',$m,0,'L','0');
    
    $this->pdf->SetFont('Arial', 'B', 18);
    $this->pdf->Cell(20,10,utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno),$m,0  ,'L',0);
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->Ln();
    $this->pdf->Cell(38,8,'la quantitat de: ',$m,0,'L',0);
    $this->pdf->SetFont('Arial','',14);

    // $this->pdf->Cell(0,8,utf8_decode(ucfirst(($resultUsuario->precio))),$m,1,'L');
     $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan($resultUsuario->precio))),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('en concepte de INSCRIPCIÓ a las activitats i períodes: '),$m,1,'L');
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Cell(0,5,utf8_decode('    Curs: '.$resultUsuario->texto_curso),$m,1,'L');

    
    $numerosActividades=explode(',',$resultUsuario->id_actividad);
    foreach($numerosActividades as $k=>$v){
      $row=$this->db->query("SELECT  horario_desde, horario_hasta, descripcion FROM c_actividades_infantiles WHERE id='$v'")->row();
      $actividad=$row->descripcion." (Horari: ".substr($row->horario_desde,0,5).'-'.substr($row->horario_hasta,0,5).")";
        $this->pdf->Cell(0,5,utf8_decode('    Activitat '.($k+1).': '.$actividad),$m,1,'L');   
      }
    

      $numerosTrimestres=explode(',',$resultUsuario->id_trimestre);
    foreach($numerosTrimestres as $k=>$v){
      $row=$this->db->query("SELECT  texto_trimestre FROM c_trimestres WHERE id='$v'")->row();
      $trimestre=$row->texto_trimestre;
        $this->pdf->Cell(0,5,utf8_decode('    Període '.($k+1).': '.$trimestre),$m,1,'L');   
      }




    // $this->pdf->SetFont('Arial','',14);
    // $this->pdf->Cell(0,8,utf8_decode('    Horari: '.substr($resultUsuario->horario_desde,0,5).':'.substr($resultUsuario->horario_hasta,0,5)),$m,1,'L');
    // $this->pdf->SetFont('Arial','B',14);
    // $this->pdf->Cell(0,8,utf8_decode('    Periode: '.$resultUsuario->id_trimestre),$m,1,'L');

    $this->pdf->Ln();
    $this->pdf->SetFont('Arial', 'BI', 18);
    $this->pdf->Cell(40,10,utf8_decode('Euros: '.$resultUsuario->precio),'0',0  ,'L','0');

    $this->pdf->SetY(140+$i*125);
    $this->pdf->SetFont('Arial', '', 10);
    if($i) $r=" - Casal"; else $r=" - Usuari/usuària";
    $this->pdf->Cell(0,10,utf8_decode('COBRAT/INSCRIT'.$r),'$m',0  ,'R','0');

    if(!$i) $this->pdf->Line(0,154,250,154);


    }
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    //$this->pdf->SetTitle("Datos socio=");
    //$this->pdf->SetLeftMargin(15);
    //$this->pdf->SetRightMargin(15);
    //$this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'BIU', 10);
    
    $border=0;
    //$this->pdf->Ln(2);
    // La variable $x se utiliza para mostrar un número consecutivo
    $h = 6;
    //$this->pdf->SetFont('Arial', '', fa-rotate-180);
    // mb_convert_encoding($str, "EUC-JP", "auto");


    $recibo=mb_convert_encoding("Rebut ".$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.".pdf", "EUC-JP", "auto");
    $this->pdf->Output('recibos/'."Recibo usuari ".$resultUsuario->num_usuario, 'F');

    $this->db->query("UPDATE c_usuarios SET pagado='1' WHERE num_usuario='".$resultUsuario->num_usuario."'");
    
    $numRegistro="";
    $numRegistroPosicion=0;
    if($resultUsuario->precio!=0){
      $numRegistro=date("Y").getNumeroRegistroCasalIngresos();
      $numRegistroPosicion=$this->maba_model->getSiguienteNumRegistro('c_recibos','num_registro_posicion',$numRegistro);
    }
    $hoy=date("Y-m-d");
    $this->db->query("INSERT INTO c_recibos SET num_usuario='".$resultUsuario->num_usuario."', 
                                                 recibo='"."Recibo usuari ".$resultUsuario->num_usuario."',
                                                 recibo_num='".$letra.' '.$numRecibo."',
                                                 num_registro='".$numRegistro."',
                                                 num_registro_posicion='".$numRegistroPosicion."',
                                                 fecha_recibo='".$hoy."',
                                                 id_trimestre='".$resultUsuario->id_trimestre."',
                                                 importe='".$resultUsuario->precio."'");
    $this->db->query("UPDATE c_actividades_infantiles SET inscripciones=inscripciones+1 WHERE num_actividad='".$resultUsuario->num_actividad."'");                                             


    $this->pdf->Output($recibo, 'D');

}

public function pdfReciboLudoteca($ludoteca){
  // Se carga el modelo usuario
  $this->load->model('ludotecas_model');
  $this->load->model('maba_model');
  // Se carga la libreria fpdf
 $this->load->library('recibo');

  // Se obtienen los datos del usuario de la base de datos
  $resultLudoteca = $this->ludotecas_model->getLudoteca($ludoteca);
  // mensaje('$resultUsuario->pagado '.$resultUsuario->pagado);
  if($resultLudoteca->pagado==1) {
    $rowLudoteca = $this->ludotecas_model->getLudotecaArray($ludoteca);
    $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripcionesBajasLudoteca',$rowLudoteca);
    $this->load->view('templates/pie');
    return;
  }

  // Creacion del PDF
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Recibo();

    $this->pdf->setTitulo(utf8_decode('Rebut'));
    //$this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();


    $mesos=array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost", "Setembre","Octubre","Novembre","Desembre"); 

    $hoy=date('d')." de ".$mesos[date('n')-1]." de ".date('Y');
    $pag=132;
    $m=0;
    for($i=0;$i<2;$i++){
      $this->pdf->SetY(26+$i*$pag);

    $letra=getLetraCasal();
    $this->pdf->SetFont('Arial','B',10);
    $numRecibo=$this->getNumRecibo();
    $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$letra.' '.$numRecibo),$m,1,'R','0');
        
    $this->pdf->Cell(0,1,utf8_decode('Barcelona, '.$hoy),$m,1,'R','0');

    $this->pdf->SetY(42+$i*$pag);
   
    $this->pdf->SetFont('Arial', '', 18);
    $this->pdf->Cell(40,10,'REBUT de: ',$m,0,'L','0');
    
    $this->pdf->SetFont('Arial', 'B', 18);
    $this->pdf->Cell(20,10,utf8_decode($resultLudoteca->nombre_contratante.' '.$resultLudoteca->apellido1_contratante.' '.$resultLudoteca->apellido2_contratante.' ('.$resultLudoteca->entidad_contratante.')'),$m,0  ,'L',0);
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->Ln();
    $this->pdf->Cell(38,8,'la quantitat de: ',$m,0,'L',0);
    $this->pdf->SetFont('Arial','',14);

    // $this->pdf->Cell(0,8,utf8_decode(ucfirst(($resultUsuario->precio))),$m,1,'L');
     $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan($resultLudoteca->precio))),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('en concepte de CONTRACTACIÓ a la ludoteca: '),$m,1,'L');
    $this->pdf->SetFont('Arial','B',14);
    $this->pdf->Cell(0,8,utf8_decode('    Curs: '.$resultLudoteca->texto_curso),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Ludoteca: '.$resultLudoteca->nombre_ludoteca),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Periode: '.$resultLudoteca->texto_periodo),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Lies setmana: '.$resultLudoteca->texto_dias_semana),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Horari: '.$resultLudoteca->texto_horario),$m,1,'L');

    $this->pdf->Ln();
    $this->pdf->SetFont('Arial', 'BI', 18);
    $this->pdf->Cell(40,10,utf8_decode('Euros: '.$resultLudoteca->precio),'0',0  ,'L','0');

    $this->pdf->SetY(140+$i*125);
    $this->pdf->SetFont('Arial', '', 10);
    if($i) $r=" - Casal"; else $r=" - Usuari/usuària";
    $this->pdf->Cell(0,10,utf8_decode('COBRAT/CONTRATACIO'.$r),'$m',0  ,'R','0');

    if(!$i) $this->pdf->Line(0,154,250,154);


    }
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    //$this->pdf->SetTitle("Datos socio=");
    //$this->pdf->SetLeftMargin(15);
    //$this->pdf->SetRightMargin(15);
    //$this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'BIU', 10);
    
    $border=0;
    //$this->pdf->Ln(2);
    // La variable $x se utiliza para mostrar un número consecutivo
    $h = 6;
    //$this->pdf->SetFont('Arial', '', fa-rotate-180);
    // mb_convert_encoding($str, "EUC-JP", "auto");


    $recibo=mb_convert_encoding("Rebut ".$resultLudoteca->nombre_contratante.' '.$resultLudoteca->apellido1_contratante.".pdf", "EUC-JP", "auto");
    $this->pdf->Output('recibos/'."Recibo usuari ".$resultLudoteca->num_ludoteca, 'F');

    $this->db->query("UPDATE c_ludotecas SET pagado='1' WHERE num_ludoteca='".$resultLudoteca->num_ludoteca."'");
    
    $numRegistro="";
    $numRegistroPosicion=0;
    if($resultLudoteca->precio!=0){
      $numRegistro=date("Y").getNumeroRegistroCasalIngresos();
      $numRegistroPosicion=$this->maba_model->getSiguienteNumRegistro('c_recibos','num_registro_posicion',$numRegistro);
    }
    $hoy=date("Y-m-d");
    $this->db->query("INSERT INTO c_recibos SET num_ludoteca='".$resultLudoteca->num_ludoteca."', 
                                                 recibo='"."Recibo ludoteca ".$resultLudoteca->num_ludoteca."',
                                                 recibo_num='".$letra.' '.$numRecibo."',
                                                 num_registro='".$numRegistro."',
                                                 num_registro_posicion='".$numRegistroPosicion."',
                                                 fecha_recibo='".$hoy."',
                                                 id_trimestre='---',
                                                 importe='".$resultLudoteca->precio."'");
    // $this->db->query("UPDATE c_actividades_infantiles SET inscripciones=inscripciones+1 WHERE num_actividad='".$resultLudoteca->num_actividad."'");                                             


    $this->pdf->Output($recibo, 'D');

}

public function pdfReciboDevolucion($usuario){
  mensaje('$usuario '.$usuario);
  // Se carga el modelo usuario
  $this->load->model('usuarios_model');
  $this->load->model('maba_model');
  // Se carga la libreria fpdf
 $this->load->library('recibo');

  // Se obtienen los datos del usuario de la base de datos
  $resultUsuario = $this->usuarios_model->getUsuario($usuario);
  // mensaje('$resultUsuario->pagado '.$resultUsuario->pagado);
  if($resultUsuario->pagado==2) {
    $rowUsuario = $this->usuarios_model->getUsuarioArray($usuario);
    $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripcionesAltasLudoteca',$rowUsuario);
    $this->load->view('templates/pie');
    return;
  }

  // Creacion del PDF
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Recibo();

    $this->pdf->setTitulo(utf8_decode('Rebut'));
    //$this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();


    $mesos=array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost", "Setembre","Octubre","Novembre","Desembre"); 

    $hoy=date('d')." de ".$mesos[date('n')-1]." de ".date('Y');
    $pag=132;
    $m=0;
    for($i=0;$i<2;$i++){
      $this->pdf->SetY(26+$i*$pag);

    $letra=getLetraCasal();
    $this->pdf->SetFont('Arial','B',10);
    $numRecibo=$this->getNumRecibo();
    $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$letra.' '.$numRecibo),$m,1,'R','0');
        
    $this->pdf->Cell(0,1,utf8_decode('Barcelona, '.$hoy),$m,1,'R','0');

    $this->pdf->SetY(60+$i*$pag);
   
    $this->pdf->SetFont('Arial', '', 18);
    $this->pdf->Cell(60,10,utf8_decode('DEVOLUCIÓ A: '),$m,0,'L','0');
    
    $this->pdf->SetFont('Arial', 'B', 18);
    mensaje('$resultUsuario->nombre_alumno '.$resultUsuario->nombre_alumno);
    $this->pdf->Cell(20,10,utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno),$m,0  ,'L',0);
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->Ln();
    $this->pdf->Cell(38,8,'la quantitat de: ',$m,0,'L',0);
    $this->pdf->SetFont('Arial','',14);

    // $this->pdf->Cell(0,8,utf8_decode(ucfirst(($resultUsuario->precio))),$m,1,'L');
     $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan($resultUsuario->precio))),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('en concepte de BAIXA a las activitats i períodes: '),$m,1,'L');
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Cell(0,5,utf8_decode('    Curs: '.$resultUsuario->texto_curso),$m,1,'L');

    
    $numerosActividades=explode(',',$resultUsuario->id_actividad);
    foreach($numerosActividades as $k=>$v){
      $row=$this->db->query("SELECT  horario_desde, horario_hasta, descripcion FROM c_actividades_infantiles WHERE id='$v'")->row();
      $actividad=$row->descripcion." (Horari: ".substr($row->horario_desde,0,5).'-'.substr($row->horario_hasta,0,5).")";
        $this->pdf->Cell(0,5,utf8_decode('    Activitat '.($k+1).': '.$actividad),$m,1,'L');   
      }
    

      $numerosTrimestres=explode(',',$resultUsuario->id_trimestre);
    foreach($numerosTrimestres as $k=>$v){
      $row=$this->db->query("SELECT  texto_trimestre FROM c_trimestres WHERE id='$v'")->row();
      $trimestre=$row->texto_trimestre;
        $this->pdf->Cell(0,5,utf8_decode('    Període '.($k+1).': '.$trimestre),$m,1,'L');   
      }



    $this->pdf->Ln();
    $this->pdf->SetFont('Arial', 'BI', 18);
    $this->pdf->Cell(40,10,utf8_decode('Euros: '.$resultUsuario->precio),'0',0  ,'L','0');

    $this->pdf->SetY(140+$i*125);
    $this->pdf->SetFont('Arial', '', 10);
    if($i) $r=" - Casal"; else $r=" - Usuari/usuària";
    $this->pdf->Cell(0,10,utf8_decode('COBRAT/INSCRIT'.$r),'$m',0  ,'R','0');

    if(!$i) $this->pdf->Line(0,154,250,154);


    }
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    //$this->pdf->SetTitle("Datos socio=");
    //$this->pdf->SetLeftMargin(15);
    //$this->pdf->SetRightMargin(15);
    //$this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'BIU', 10);
    
    $border=0;
    //$this->pdf->Ln(2);
    // La variable $x se utiliza para mostrar un número consecutivo
    $h = 6;
    //$this->pdf->SetFont('Arial', '', fa-rotate-180);
    // mb_convert_encoding($str, "EUC-JP", "auto");


    $recibo=mb_convert_encoding("Rebut ".$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.".pdf", "EUC-JP", "auto");
    $this->pdf->Output('recibos/'."Recibo usuari ".$resultUsuario->num_usuario, 'F');

    $this->db->query("UPDATE c_usuarios SET pagado='2' WHERE num_usuario='".$resultUsuario->num_usuario."'");
    
    $numRegistro="";
    $numRegistroPosicion=0;
    if($resultUsuario->precio!=0){
      $numRegistro=date("Y").getNumeroRegistroCasalDevoluciones();
      $numRegistroPosicion=$this->maba_model->getSiguienteNumRegistro('c_recibos','num_registro_posicion',$numRegistro);
    }
    $hoy=date("Y-m-d");

    $this->db->query("INSERT INTO c_recibos SET num_usuario='".$resultUsuario->num_usuario."', 
                                                 recibo='"."Recibo usuari ".$resultUsuario->num_usuario."',
                                                 recibo_num='".$letra.' '.$numRecibo."',
                                                 num_registro='".$numRegistro."',
                                                 num_registro_posicion='".$numRegistroPosicion."',
                                                 fecha_recibo='".$hoy."',
                                                 id_trimestre='".$resultUsuario->id_trimestre."',
                                                 importe='".$resultUsuario->precio."'");

$this->db->query("UPDATE c_actividades_infantiles SET inscripciones=inscripciones-1 WHERE num_actividad='".$resultUsuario->num_actividad."'");                                             
$this->pdf->Output($recibo, 'D');
}

public function pdfReciboDevolucionLudoteca($ludoteca){
  // Se carga el modelo usuario
  $this->load->model('ludotecas_model');
  $this->load->model('maba_model');
  // Se carga la libreria fpdf
 $this->load->library('recibo');

  // Se obtienen los datos del usuario de la base de datos
  $resultLudoteca = $this->ludotecas_model->getLudoteca($ludoteca);
  // mensaje('$resultUsuario->pagado '.$resultUsuario->pagado);
  if($resultLudoteca->pagado==2) {
    $rowLudoteca = $this->usuarios_model->getLudotecaArray($ludoteca);
    $datos['casal']=getTituloCasalCorto();
        $this->load->view('templates/cabecera',$datos);
		$this->load->view('viewsBodies/inscripcionesAltasLudoteca',$rowLudoteca);
    $this->load->view('templates/pie');
    return;
  }

  // Creacion del PDF
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Recibo();

    $this->pdf->setTitulo(utf8_decode('Rebut'));
    //$this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

    // Agregamos una página
    $this->pdf->AddPage();
    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();


    $mesos=array("Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost", "Setembre","Octubre","Novembre","Desembre"); 

    $hoy=date('d')." de ".$mesos[date('n')-1]." de ".date('Y');
    $pag=132;
    $m=0;
    for($i=0;$i<2;$i++){
      $this->pdf->SetY(26+$i*$pag);

    $letra=getLetraCasal();
    $this->pdf->SetFont('Arial','B',10);
    $numRecibo=$this->getNumRecibo();
    $this->pdf->Cell(0,7,utf8_decode('Rebut núm: '.$letra.' '.$numRecibo),$m,1,'R','0');
        
    $this->pdf->Cell(0,1,utf8_decode('Barcelona, '.$hoy),$m,1,'R','0');

    $this->pdf->SetY(42+$i*$pag);
   
    $this->pdf->SetFont('Arial', '', 18);
    $this->pdf->Cell(60,10,utf8_decode('DEVOLUCIÓ A: '),$m,0,'L','0');
    
    $this->pdf->SetFont('Arial', 'B', 18);
    $this->pdf->Cell(20,10,utf8_decode($resultLudoteca->nombre_contratante.' '.$resultLudoteca->apellido1_contratante.' '.$resultLudoteca->apellido2_contratante.' ('.$resultLudoteca->entidad_contratante.')'),$m,0  ,'L',0);
    $this->pdf->SetFont('Arial', '', 12);
    $this->pdf->Ln();
    $this->pdf->Cell(38,8,'la quantitat de: ',$m,0,'L',0);
    $this->pdf->SetFont('Arial','',14);

    // $this->pdf->Cell(0,8,utf8_decode(ucfirst(($resultUsuario->precio))),$m,1,'L');
     $this->pdf->Cell(0,8,utf8_decode(ucfirst(num2letrasCatalan($resultLudoteca->precio))),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('en concepte de BAIXA a la contractació de la ludoteca: '),$m,1,'L');
    $this->pdf->SetFont('Arial','B',14);
    $this->pdf->Cell(0,8,utf8_decode('    Curs: '.$resultLudoteca->texto_curso),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Activitat: '.$resultLudoteca->nombre_ludoteca),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Periode: '.$resultLudoteca->texto_periodo),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Dies setmana: '.$resultLudoteca->texto_dias_semana),$m,1,'L');
    $this->pdf->Cell(0,8,utf8_decode('    Horari: '.$resultLudoteca->texto_horario),$m,1,'L');

    $this->pdf->Ln();
    $this->pdf->SetFont('Arial', 'BI', 18);
    $this->pdf->Cell(40,10,utf8_decode('Euros: '.$resultLudoteca->precio),'0',0  ,'L','0');

    $this->pdf->SetY(140+$i*125);
    $this->pdf->SetFont('Arial', '', 10);
    if($i) $r=" - Casal"; else $r=" - Contractant";
    $this->pdf->Cell(0,10,utf8_decode('COBRAT/INSCRIT'.$r),'$m',0  ,'R','0');

    if(!$i) $this->pdf->Line(0,154,250,154);


    }
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    //$this->pdf->SetTitle("Datos socio=");
    //$this->pdf->SetLeftMargin(15);
    //$this->pdf->SetRightMargin(15);
    //$this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'BIU', 10);
    
    $border=0;
    //$this->pdf->Ln(2);
    // La variable $x se utiliza para mostrar un número consecutivo
    $h = 6;
    //$this->pdf->SetFont('Arial', '', fa-rotate-180);
    // mb_convert_encoding($str, "EUC-JP", "auto");


    $recibo=mb_convert_encoding("Rebut ".$resultLudoteca->nombre_contratante.' '.$resultLudoteca->apellido1_contratante.".pdf", "EUC-JP", "auto");
    $this->pdf->Output('recibos/'."Recibo contractant ".$resultLudoteca->num_ludoteca, 'F');

    $this->db->query("UPDATE c_ludotecas SET pagado='2' WHERE num_ludoteca='".$resultLudoteca->num_ludoteca."'");
    
    $numRegistro="";
    $numRegistroPosicion=0;
    if($resultLudoteca->precio!=0){
      $numRegistro=date("Y").getNumeroRegistroCasalDevoluciones();
      $numRegistroPosicion=$this->maba_model->getSiguienteNumRegistro('c_recibos','num_registro_posicion',$numRegistro);
    }
    $hoy=date("Y-m-d");

    $this->db->query("INSERT INTO c_recibos SET num_usuario='".$resultLudoteca->num_ludoteca."', 
                                                 recibo='"."Recibo usuari ".$resultLudoteca->num_ludoteca."',
                                                 recibo_num='".$letra.' '.$numRecibo."',
                                                 num_registro='".$numRegistro."',
                                                 num_registro_posicion='".$numRegistroPosicion."',
                                                 fecha_recibo='".$hoy."',
                                                --  id_trimestre='".$resultLudoteca->id_trimestre."',
                                                 id_trimestre='---',
                                                 importe='".$resultLudoteca->precio."'");

    $this->pdf->Output($recibo, 'D');

}

// ficha Ludoteca
// public function pdfLudoteca($ludoteca){
//   // Se carga el modelo usuario
//   $this->load->model('ludotecas_model');
//   // Se carga la libreria fpdf
//  $this->load->library('pdfLudoteca');

//   // Se obtienen los datos del usuario de la base de datos
//   $resultUsuario = $this->ludotecas_model->getLudoteca($ludoteca);

//   $this->pdf = new PdfLudoteca();
//   $this->pdf->setTitulo(utf8_decode('Fitxa Contratació Ludoteca.'));
//   $this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_contratante.' '.$resultUsuario->apellido1_contratante.' '.$resultUsuario->apellido2_contratante.' ('.$resultUsuario->entidad_contratante.')'));
//   // Agregamos una página
//   $this->pdf->AddPage();

//   // Define el alias para el número de página que se imprimirá en el pie
//   $this->pdf->AliasNbPages();
//   $this->pdf->SetFont('Arial', 'BIU', 10);
    
//   $border=0;
//   //$this->pdf->Ln(2);
//   // La variable $x se utiliza para mostrar un número consecutivo
//   $h = 6;
//   //$this->pdf->SetFont('Arial', '', fa-rotate-180);
//   $this->titulo($this->pdf,'NÚM INSCRIPCIÓ LUDOTECA: '.$resultUsuario->num_ludoteca);
//   $this->titulo($this->pdf,'DADES CONTRATADOR');
//   $this->datos($this->pdf,'NOM I COGNOM CONTRATADOR',$resultUsuario->nombre_contratante.' '.$resultUsuario->apellido1_contratante.' '.$resultUsuario->apellido2_contratante);
//   $this->datos($this->pdf,'ENTITAT CONTRATADORA',$resultUsuario->entidad_contratante);

//     $this->datos($this->pdf,'ADREÇA',$resultUsuario->direccion_tcontratante);
//     $this->datos($this->pdf,'CODI POSTAL - POBLACIÓ (PROVINCIA)',$resultUsuario->codigo_postal_contratante.' - '.$resultUsuario->poblacion_contratante.' ('.$resultUsuario->provincia_contratante.')');
//     $this->datos($this->pdf,'DNI/ NIE',$resultUsuario->dni_contratante);
//     $this->datos($this->pdf,'TELÈFON DE CONTACTE 1',$resultUsuario->telefono1_contratante);
//     $this->datos($this->pdf,'TELÈFON DE CONTACTE 2',$resultUsuario->telefono2_contratante);
//     $this->datos($this->pdf,'CORREU ELECTRÒNIC',$resultUsuario->email_contratante);

//     $this->titulo($this->pdf,'LUDOTECA');

//     $this->datos($this->pdf,'CURS',$resultUsuario->texto_curso);
//     $this->datos($this->pdf,'NOM LUDOTECA',$resultUsuario->nombre_ludoteca);
//     $this->datos($this->pdf,'PERIODO',$resultUsuario->texto_periodo);
//     $this->datos($this->pdf,'HORARI',$resultUsuario->texto_horario);
//     $this->datos($this->pdf,'DIES SETMANA',$resultUsuario->texto_dias_semana);
//     if($resultUsuario->id_pago_global==1){
//       $this->datos($this->pdf,'PREU GLOBAL LUDOTECA (€)',number_format($resultUsuario->precio,2));
//     }
//     if($resultUsuario->id_pago_global==2){
//       $this->datos($this->pdf,'PREU GLOBAL LUDOTECA','NO. Pagat per cada inscrit segon tarifes');
//     }

//     $this->titulo($this->pdf,'COMUNICACIONS');

//     $this->datosSiNo($this->pdf,mb_strtoupper('Vull rebre les comunicacions del Casal Infantil '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('per correu electrònic: activitats, '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('tallers, sortides, ...'),$resultUsuario->id_comunicaciones);	

//     $this->pdf->ln();
	
//     $this->datosSiNo($this->pdf,mb_strtoupper('Vull rebre altres comunicacions d´interès '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('general relacionades amb temes d’infància'));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('enviades pel Casal Infantil, respecte '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('cultura, esport, salut, ...'),$resultUsuario->id_otras_comunicaciones);		
    
//     $this->titulo($this->pdf,'AUTORITZACIONS LEGALS');

//     $this->datosSiNo($this->pdf,'Autoritzo als educadors/es a que prenguin les decisions ');		
//     $this->datosSiNo($this->pdf,'necessàries en cas d´urgència. Fa extensiva aquesta ');		
//     $this->datosSiNo($this->pdf,'autorització a les decisions medicoquirúrgiques que ');		
//     $this->datosSiNo($this->pdf,'siguin necessàries adoptar, en cas d´extrema gravetat, ');		
//     $this->datosSiNo($this->pdf,'sota la direcció facultativa pertinent. ',$resultUsuario->id_decisiones_urgentes);		
    
//     $this->pdf->ln();
    
//     $this->datosSiNo($this->pdf,'Autoritzo al '.mb_strtoupper(getNombreCasal()).' a utilitzar la imatge ');		
//     $this->datosSiNo($this->pdf,'de l´infant en activitats internes (tallers, exposició de fotos, ');		
//     $this->datosSiNo($this->pdf,'cd famílies etc...) durant el curs 2019-2020. ',$resultUsuario->id_imagen_en_actividades);		
    
    
//     $this->pdf->ln();
//     $this->datosSiNo($this->pdf,'Autoritzo al '.mb_strtoupper(getNombreCasal()).' a que la imatge del meu ');		
//     $this->datosSiNo($this->pdf,'fill/a sigui reproduïda en divulgacions lúdico-educatives, en les ');		
//     $this->datosSiNo($this->pdf,'xarxes socials del casal i en altres medis de difusió de  ');		
//     $this->datosSiNo($this->pdf,'l´Ajuntament de Barcelona.',$resultUsuario->id_imagen_divulgacion);		
    
//     $this->titulo($this->pdf,'INFORMACIÓ BÀSICA SOBRE PROTECCIÓ DE DADES');
    
//     $this->pdf->MultiCell(180,$h,utf8_decode('INFORMACIÓ BÀSICA SOBRE PROTECCIÓ DE DADES
// Responsable del tractament: INCOOP, SCCL (Mallorca 51-53 local 4, 08029  Barcelona)
// Finalitat: Tramitació i resolució del procés d´admissió del sol.licitant al servei ofert i el seguiment d´aquest en el centre.
// Legitimació: Consentiment de la persona interessada.
// Destinataris: Organitzacions o persones directament relacionades amb el responsable del tractament.
// Drets: Accedir a les dades, rectificar-les, suprimir-les, oposar-se´n al tractament i sol.licitar-ne la limitació.
// Informació addicional: Podeu consultar tota la informació detallada a https://incoop.cat/politica-privacitat/.'),$border,'L');
      
//       $this->pdf->ln();

//       $this->datosSiNo($this->pdf,'He llegit la informació bàsica sobre protecció ');		
//       $this->datosSiNo($this->pdf,'de dades i autoritzo el tractament de les dades',$resultUsuario->id_lectura_informacion);		
      
       
//     $this->pdf->ln();

//       $this->pdf->MultiCell(180,$h,utf8_decode('Us informem que és necessari indicar que heu llegit la informació bàsica sobre protecció de dades. En cas contrari, no podreu continuar amb el procés preinscripció.'),$border,'L');
          
//     $this->pdf->Cell(90,$h,'',0,0,'L');
//     $this->pdf->Cell(0,$h,'Barcelona, '.fechaDiaMesAno($resultUsuario->fecha_modificacion),0,1,'L');
    
//     $this->pdf->ln(16);
//     $this->pdf->Cell(90,$h,'',0,0,'L');
//     $this->pdf->Cell(0,$h,utf8_decode('Signat, '.$resultUsuario->nombre_contratante.' '.$resultUsuario->apellido1_contratante.' '.$resultUsuario->apellido2_contratante),0,1,'L');
    
    
//     $this->pdf->Ln(5);
    



//   $recibo=utf8_decode("Contratante ".$resultUsuario->nombre_contratante.' '.$resultUsuario->apellido1_contratante).".pdf";


//   $this->pdf->Output($recibo, 'D');

// }

// ficha usuario casal   
public function pdfUsuario($usuario)
   {
    // Se carga el modelo usuario
    $this->load->model('usuarios_model');
    // Se carga la libreria fpdf
   $this->load->library('pdf');
 
    // Se obtienen los datos del usuario de la base de datos
    $resultUsuario = $this->usuarios_model->getUsuario($usuario);

    
 
    // Creacion del PDF
    /*
     * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
     * heredó todos las variables y métodos de fpdf
     */
    $this->pdf = new Pdf();
    

    $this->pdf->setTitulo(utf8_decode('Fitxa Inscripció nen/nena'));
    $this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

    // Agregamos una página
    $this->pdf->AddPage();

    // Define el alias para el número de página que se imprimirá en el pie
    $this->pdf->AliasNbPages();
 
    /* Se define el titulo, márgenes izquierdo, derecho y
     * el color de relleno predeterminado
     */
    //$this->pdf->SetTitle("Datos socio=");
    //$this->pdf->SetLeftMargin(15);
    //$this->pdf->SetRightMargin(15);
    //$this->pdf->SetFillColor(200,200,200);
 
    // Se define el formato de fuente: Arial, negritas, tamaño 9
    $this->pdf->SetFont('Arial', 'BIU', 10);
    
    $border=0;
    //$this->pdf->Ln(2);
    // La variable $x se utiliza para mostrar un número consecutivo
    $h = 6;
    //$this->pdf->SetFont('Arial', '', fa-rotate-180);

    // $this->pdf->setY(30);
    $this->titulo($this->pdf,'NÚM INSCRIPCIÓ: '.$resultUsuario->num_usuario,4);
    $this->titulo($this->pdf,'1. DADES PERSONALS RESPONSABLE');
    $this->datos($this->pdf,'NOM I COGNOMS PARE/MARE/TUTOR/A',$resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor);
    $this->datos($this->pdf,'DNI/ NIE',$resultUsuario->dni_tutor);
    $this->datos($this->pdf,'PARENTIU',$resultUsuario->parentesco_tutor);
    $this->datos($this->pdf,'ADREÇA',$resultUsuario->direccion_tutor);
    $this->datos($this->pdf,'CODI POSTAL - POBLACIÓ (PROVINCIA)',$resultUsuario->codigo_postal_tutor.' - '.$resultUsuario->poblacion_tutor.' ('.$resultUsuario->provincia_tutor.')');
    $this->datos($this->pdf,'TELÈFON DE CONTACTE 1',$resultUsuario->telefono1_tutor);
    $this->datos($this->pdf,'TELÈFON DE CONTACTE 2',$resultUsuario->telefono2_tutor);
    $this->datos($this->pdf,'CORREU ELECTRÒNIC',$resultUsuario->email_tutor);
    // $this->datos($this->pdf,'PROFESSIÓ MARE',$resultUsuario->profesion_madre);
    // $this->datos($this->pdf,'PROFESSIÓ PARE',$resultUsuario->profesion_padre);

    $this->titulo($this->pdf,'2. DADES SEGON CONTACTE');
    $this->datos($this->pdf,'NOM I COGNOMS PARE/MARE/TUTOR/A',$resultUsuario->nombre_tutor_2);
    $this->datos($this->pdf,'DNI / NIE',$resultUsuario->dni_tutor_2);
    $this->datos($this->pdf,'PARENTIU',$resultUsuario->parentesco_tutor_2);
    // $this->datos($this->pdf,'ADREÇA',$resultUsuario->direccion_tutor_2);
    // $this->datos($this->pdf,'CODI POSTAL - POBLACIÓ (PROVINCIA)',$resultUsuario->codigo_postal_tutor_2.' - '.$resultUsuario->poblacion_tutor_2.' ('.$resultUsuario->provincia_tutor_2.')');
    $this->datos($this->pdf,'TELÈFON DE CONTACTE 1',$resultUsuario->telefono1_tutor_2);
    $this->datos($this->pdf,'TELÈFON DE CONTACTE 2',$resultUsuario->telefono2_tutor_2);
    $this->datos($this->pdf,'CORREU ELECTRÒNIC',$resultUsuario->email_tutor_2);
    // $this->datos($this->pdf,'PROFESSIÓ MARE',$resultUsuario->profesion_madre);
    // $this->datos($this->pdf,'PROFESSIÓ PARE',$resultUsuario->profesion_padre);
    
    $this->titulo($this->pdf,'3. DADES PERSONALS INFANT/ JOVE');
    
    $this->datos($this->pdf,'NOM I COGNOM',$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno);
    $this->datos($this->pdf,'DNI / NIE	',$resultUsuario->dni_alumno);
    $this->datos($this->pdf,'SEXE	',$resultUsuario->id_sexo);
    $this->datos($this->pdf,'ADREÇA',$resultUsuario->direccion_alumno.' - '.$resultUsuario->poblacion_alumno.' ('.$resultUsuario->provincia_alumno.')');
    $this->datos($this->pdf,'ES DEL DISTRICTE',$resultUsuario->id_es_del_districto);
    $this->datos($this->pdf,'DATA DE NEIXEMENT',fechaDiaMesAno($resultUsuario->fecha_nacimiento));
    $edad=getEdad($resultUsuario->fecha_nacimiento);
    $this->datos($this->pdf,'EDAD',$edad);
    $this->datos($this->pdf,'NÚM TARGETA SANITARIA',$resultUsuario->num_tarjeta_sanitaria);
    $this->datos($this->pdf,'CURS ESCOLAR',$resultUsuario->curso_escolar);
    $this->datos($this->pdf,'ESCOLA/INSTITUT',$resultUsuario->escuela);
    $this->datos($this->pdf,'NOM TUTOR CENTRE',$resultUsuario->nombre_tutor_referent_centre_educatiu);
    $this->datos($this->pdf,'TELÈFON CENTRE',$resultUsuario->telefono_tutor_referent_centre_educatiu);
    
    // $this->pdf->Ln(15);
/*
    $this->titulo($this->pdf,'4. GRUP ON REALITZA LA INSCRIPCIÓ');
    $this->datos($this->pdf,'CURS',$resultUsuario->texto_curso);

    $numerosActividades=explode(',',$resultUsuario->id_actividad);
    foreach($numerosActividades as $k=>$v){
      $actividad=$this->db->query("SELECT descripcion FROM c_actividades_infantiles WHERE id='$v'")->row()->descripcion;   
        $this->datos($this->pdf,'ACTIVITAT '.($k+1),$actividad); 
    }
    $numerosPeriodos=explode(',',$resultUsuario->id_trimestre);
    foreach($numerosPeriodos as $k=>$v){
      $trimestre=$this->db->query("SELECT texto_trimestre FROM c_trimestres WHERE id='$v'")->row()->texto_trimestre;   
        $this->datos($this->pdf,'PERÍODE '.($k+1),$trimestre); 
    }
    
    $this->datos($this->pdf,'PREU (€)',number_format($resultUsuario->precio,2));
    if(trim($resultUsuario->comentarios_precio))
         $this->datos($this->pdf,'COMENTARIS PREU',$resultUsuario->comentarios_precio);
    */
    $this->titulo($this->pdf,'4. MÉS DADES');
    if($resultUsuario->id_becas!=2)
    $this->datosSiNo($this->pdf,'HA SOL·LICITAT BECA?	',$resultUsuario->id_becas,'Ajunt.: '.$resultUsuario->becas_descuento_ayuntamiento.' %    Serv. Socials: '.$resultUsuario->becas_descuento_servicios_sociales.' %');
    else
      $this->datosSiNo($this->pdf,'HA SOL·LICITAT BECA?	',$resultUsuario->id_becas);
    if($resultUsuario->id_monitora!=2)  
      $this->datosSiNo($this->pdf,'HA MONITOR/A DE SUPORT? ',$resultUsuario->id_monitora,'Des de: '.fechaEuropea($resultUsuario->monitora_desde),'Fins: '.fechaEuropea($resultUsuario->monitora_hasta));
    else
      $this->datosSiNo($this->pdf,'HA MONITOR/A DE SUPORT? ',$resultUsuario->id_monitora);
    
    $this->datosSiNo($this->pdf,'HA PARTICIPAT ANTERIORMENT DE L´ACTIVITAT?	',$resultUsuario->id_participacion_anterior);
    if($resultUsuario->id_hermanos_actividad!=2)
      $this->datosSiNo($this->pdf,'TÉ GERMANS/ES A L´ACTIVITAT?	',$resultUsuario->id_hermanos_actividad,'Núm germans: '.$resultUsuario->hermanos_actividad, 'Ordre: '.$resultUsuario->hermano_num);
    else
      $this->datosSiNo($this->pdf,'TÉ GERMANS/ES A L´ACTIVITAT?	',$resultUsuario->id_hermanos_actividad);

    $this->datosSiNo($this->pdf,'TÉ TARGETA DEL TRANSPORT T-12?	',$resultUsuario->id_tarjeta_t12);
    $this->datosSiNo($this->pdf,mb_strtoupper('Assisteix a algun servei d´atenció a la infància?	'),$resultUsuario->id_asistencia_atencion,$resultUsuario->asistencia_atencion);
    
    

    $this->titulo($this->pdf,'5. FITXA DE SALUT');
    if($resultUsuario->id_alergia!=2)
      $this->datosSiNo($this->pdf,'TÉ ALGUNA AL·LÈRGIA?',$resultUsuario->id_alergia,$resultUsuario->alergia.'  Medicació: '.$resultUsuario->alergia_medicacion);
    else
      $this->datosSiNo($this->pdf,'TÉ ALGUNA AL·LÈRGIA?',$resultUsuario->id_alergia);
    
    $this->datosSiNo($this->pdf,'AUTORITZA ADMINISTRI MEDICACIÓ AL·LÈRGIA?',$resultUsuario->id_alergia_administracion_medicacion);
    
    if($resultUsuario->id_insuficiencia!=2)
      $this->datosSiNo($this->pdf,'TÉ ALGUNA INTOL·LERÀNCIA?',$resultUsuario->id_insuficiencia,$resultUsuario->insuficiencia.'  Medicació: '.$resultUsuario->insuficiencia_medicacion);
    else
      $this->datosSiNo($this->pdf,'TÉ ALGUNA INTOL·LERÀNCIA?',$resultUsuario->id_insuficiencia);

    $this->datosSiNo($this->pdf,'AUTORITZA ADMINISTRI MEDICACIÓ INTOL·LERÀNCIA?',$resultUsuario->id_insuficiencia_administracion_medicacion);
    
    $this->datosSiNo($this->pdf,'TÉ ALGUNA MALALTIA RESPIRATÒRIA?	',$resultUsuario->id_respiratoria,$resultUsuario->respiratoria);
    $this->datosSiNo($this->pdf,'TÉ ALGUNA MALALTIA VASCULAR?	',$resultUsuario->id_vascular,$resultUsuario->vascular);
    $this->datosSiNo($this->pdf,'TÉ ALGUNA MALALTIA CRÒNICA?	',$resultUsuario->id_cronica,$resultUsuario->cronica);
    $this->datosSiNo($this->pdf,'PATEIX HEMORRÀGIES?',$resultUsuario->id_hemorragia,$resultUsuario->hemorragia);
    $this->datosSiNo($this->pdf,'PREN ALGUNA MEDICACIÓ?',$resultUsuario->id_medicacion,$resultUsuario->medicacion);
    if($resultUsuario->id_nadar!=2)
      $this->datosSiNo($this->pdf,'SAP NEDAR?',$resultUsuario->id_nadar,'Nivell: '.$resultUsuario->nadar);
    else
      $this->datosSiNo($this->pdf,'SAP NEDAR?',$resultUsuario->id_nadar);
    $this->datosSiNo($this->pdf,'PRESENTA ALGUNA NEE?',$resultUsuario->id_nee,$resultUsuario->nee);		
    $this->datos($this->pdf,'OBSERVACIONS',"");
    $this->pdf->Cell(5,$h,'',$border,0,'L',0);
    $this->pdf->MultiCell(180,6,utf8_decode(mb_strtoupper(($resultUsuario->observacions))),$border,'L');

    $this->titulo($this->pdf,'6. DOCUMENTACIÓ A ADJUNTAR');
    
    $this->datosSiNo($this->pdf,'DNI MARE/PARE/TUTOR/A',$resultUsuario->id_presenta_dni_tutor);		
    $this->datosSiNo($this->pdf,'DNI INFANT',$resultUsuario->id_presenta_dni_alumni);		
    $this->datosSiNo($this->pdf,'LLIBRE VACUNES',$resultUsuario->id_presenta_libro_vacunas);		
    $this->datosSiNo($this->pdf,'TARGETA SANITÀRIA		',$resultUsuario->id_presenta_tarjeta_sanitaria);		
    $this->datosSiNo($this->pdf,'ALTRES DOCUMENTACIONS		',$resultUsuario->id_presenta_otras,$resultUsuario->presenta_otras);	

    $this->pdf->Ln(5);
    $this->titulo($this->pdf,'7. COMUNICACIONS');
    
    $this->datos($this->pdf,mb_strtoupper('Vull rebre les comunicacions del Casal Infantil per correu electrònic: activitats, '),"");		
    // $this->datosSiNo($this->pdf,mb_strtoupper('per correu electrònic: activitats, '));		
    $this->datosSiNoLinea($this->pdf,mb_strtoupper('tallers, sortides, ...'),40, $resultUsuario->id_comunicaciones);		
    $this->pdf->Ln();

    $this->datos($this->pdf,mb_strtoupper('Vull rebre altres comunicacions d´interès general relacionades amb temes '),"");		
    // $this->datosSiNo($this->pdf,mb_strtoupper('general relacionades amb temes d’infància'));		
    $this->datosSiNoLinea($this->pdf,mb_strtoupper("d'infància enviades pel Casal Infantil, respecte cultura, esport, salut, ..."),130,$resultUsuario->id_otras_comunicaciones);		
    // $this->datosSiNo($this->pdf,mb_strtoupper('cultura, esport, salut,...'),$resultUsuario->id_otras_comunicaciones);		
    
    $this->titulo($this->pdf,'8. AUTORITZACIONS ENTRADES I SORTIDES');

    $this->datosSiNoLinea($this->pdf,mb_strtoupper('Em comprometo a acompanyar i recollir el meu fill/a a les hores establertes'),164,$resultUsuario->id_aut_acompanar);		
    // $this->datosSiNo($this->pdf,mb_strtoupper('fill/a a les hores establertes'),$resultUsuario->id_aut_acompanar);		
    $this->datosSiNoLinea($this->pdf,mb_strtoupper('Autoritzo que el meu fill/a sigui recollit/da a la sortida del casal per en/na'),160,$resultUsuario->id_aut_recogida);		
    // $this->datosSiNo($this->pdf,mb_strtoupper('a la sortida del casal per en/na'),$resultUsuario->id_aut_recogida);	
    
    if($resultUsuario->id_aut_recogida==1){
      $this->pdf->Cell(25,$h,'',$border,0,'L',0);
      $this->datos($this->pdf,'AUTORIZO RECULLIDA A: ',$resultUsuario->aut_nombre.' '.$resultUsuario->aut_apellido1.' '.$resultUsuario->aut_apellido2);
      $this->pdf->Cell(25,$h,'',$border,0,'L',0);
      $this->datos($this->pdf,'AMB DNI (PARENTIU): ',$resultUsuario->aut_dni.' ('.$resultUsuario->aut_parentesco.')');
    }
    else{
      $this->pdf->Cell(25,$h,'',$border,0,'L',0);
      $this->datos($this->pdf,'AUTORIZO RECULLIDA A: ','----');
      $this->pdf->Cell(25,$h,'',$border,0,'L',0);
      $this->datos($this->pdf,'AMB DNI (PARENTIU): ','----');
    }
    $this->datosSiNoLinea($this->pdf,mb_strtoupper('Autoritzo al meu fill/filla a marxar sol del casal.'),120,$resultUsuario->id_aut_ir_solo);		
    // $this->datosSiNo($this->pdf,mb_strtoupper('a marxar sol del casal.'),$resultUsuario->id_aut_ir_solo);		
		
    // $this->titulo($this->pdf,'9. AUTORITZACIONS LEGALS');

    $this->titulo($this->pdf,'9. SIGNATURA LEGAL');
    
    // $this->datos($this->pdf,mb_strtoupper('Jo, '.$resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor.', amb DNI '.$resultUsuario->dni_tutor.', declaro que les dades d´aquesta fitxa són certes.'),'');
    
    $this->pdf->ln();
    $this->pdf->Cell(5,$h,'',0,0,'L',0);
    $this->pdf->MultiCell(180,6,utf8_decode(mb_strtoupper(('Jo, '.$resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor.', amb DNI '.$resultUsuario->dni_tutor.', declaro que les dades d´aquesta fitxa són certes.'))),$border,'L');

    $this->pdf->ln();
    $this->pdf->Cell(5,$h,'',0,0,'L',0);
    $this->pdf->MultiCell(180,6,utf8_decode(mb_strtoupper(('Autoritzo a l´infant/jove, '.$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno.', amb DNI '.$resultUsuario->dni_alumno.' a assistir al ' .mb_strtoupper(getNombreCasal()). ' amb les condicions establertes per l´equip d´educadors. '))),$border,'L');
    $this->pdf->ln();

    $this->pdf->Cell(5,$h,'',0,0,'L',0);
    $this->pdf->MultiCell(180,6,utf8_decode(mb_strtoupper(("AUTORITZO ALS EDUCADORS/ES A QUÈ TRASLLADIN EL MEU FILL/A  EN CAS D'URGÈNCIA.  FA EXTENSIVA AQUESTA AUTORITZACIÓ A LES DECISIONS MEDICOQUIRÚRGIQUES QUE SIGUIN NECESSÀRIES ADOPTAR, EN CAS D’EXTREMA GRAVETAT, SOTA LA DIRECCIÓ FACULTATIVA"))),$border,'L');
    $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper("")),100,$resultUsuario->id_decisiones_urgentes );		
    
    // $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper('FA EXTENSIVA AQUESTA AUTORITZACIÓ A LES DECISIONS MEDICOQUIRÚRGIQUES QUE SIGUIN ')),"");		
    // $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper('NECESSÀRIES ADOPTAR, EN CAS D’EXTREMA GRAVETAT, SOTA LA DIRECCIÓ FACULTATIVA')),"");		
    // $this->datosSiNo($this->pdf,utf8_decode(mb_strtoupper('PERTINENT.')),100,$resultUsuario->id_decisiones_urgentes_2);		
    
    $this->pdf->ln();
    $this->pdf->Cell(5,$h,'',0,0,'L',0);
    $this->pdf->MultiCell(180,6,utf8_decode(mb_strtoupper(("Autoritzo al ".getNombreCasal()." a utilitzar  la imatge de l´infant en activitats internes (tallers, exposició de fotos, cd famílies etc...) durant  el curs" ))),$border,'L');
    $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper("")),100,$resultUsuario->id_imagen_en_actividades );		


    
    // $this->datosSiNo($this->pdf,mb_strtoupper('Autoritzo al '.getNombreCasal().' a utilitzar  la imatge de l´infant en activitats '),"");		
    // // $this->datosSiNo($this->pdf,mb_strtoupper('la imatge de l´infant en activitats internes (tallers,  '));		
    // $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper('internes (tallers, exposició de fotos, cd famílies etc...) durant  el curs '.$resultUsuario->texto_curso.'.')),100,$resultUsuario->id_imagen_en_actividades);		
    // // $this->datosSiNo($this->pdf,mb_strtoupper('el curs '.$resultUsuario->texto_curso.'.',$resultUsuario->id_imagen_en_actividades));		
    
    $this->pdf->ln();
    $this->pdf->Cell(5,$h,'',0,0,'L',0);
    $this->pdf->MultiCell(180,6,utf8_decode(mb_strtoupper(('Autoritzo al '.getNombreCasal().' a que la imatge del meu fill/a sigui reproduïda en divulgacions lúdico-educatives, en les xarxes socials del casal i en altres medis de difusió de l´Ajuntament de Barcelona.' ))),$border,'L');
    $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper("")),100,$resultUsuario->id_imagen_divulgacion );		

    
    // $this->pdf->ln();
    // $this->datos($this->pdf,mb_strtoupper('Autoritzo al '.getNombreCasal().' a que la imatge del meu fill/a sigui reproduïda '),"");		
    // $this->datos($this->pdf,utf8_decode(mb_strtoupper('en divulgacions lúdico-educatives, en les xarxes socials del casal i en altres medis ')),"");		
    // $this->datosSiNoLinea($this->pdf,utf8_decode(mb_strtoupper('de difusió de l´Ajuntament de Barcelona.')),100,$resultUsuario->id_imagen_divulgacion);		
    $this->pdf->addPage();
    $this->titulo($this->pdf,mb_strtoupper('INFORMACIÓ BÀSICA SOBRE PROTECCIÓ DE DADES'));
    
    $this->pdf->MultiCell(180,$h,utf8_decode(mb_strtoupper('INFORMACIÓ BÀSICA SOBRE PROTECCIÓ DE DADES Responsable del tractament: INCOOP, SCCL (Mallorca 51-53 local 4, 08029  Barcelona) Finalitat: Tramitació i resolució del procés d´admissió del sol.licitant al servei ofert i el seguiment d´aquest en el centre. Legitimació: Consentiment de la persona interessada. Destinataris: Organitzacions o persones directament relacionades amb el responsable del tractament. Drets: Accedir a les dades, rectificar-les, suprimir-les, oposar-se´n al tractament i sol.licitar-ne la limitació. Informació addicional: Podeu consultar tota la informació detallada a')).' https://incoop.cat/politica-privacitat/.',$border,'L');
      
      $this->pdf->ln();

      $this->datosSiNo($this->pdf,mb_strtoupper('He llegit la informació bàsica sobre protecció de dades i autoritzo el tractament '));		
      $this->datosSiNoLinea($this->pdf,mb_strtoupper('de les dades'),100,$resultUsuario->id_lectura_informacion);		
      
       
    $this->pdf->ln();

      $this->pdf->MultiCell(190,$h,utf8_decode(mb_strtoupper('Us informem que és necessari indicar que heu llegit la informació bàsica sobre protecció de dades. En cas contrari, no podreu continuar amb el procés preinscripció.')),$border,'L');
          
    $this->pdf->Cell(90,$h,'',0,0,'L');
    $this->pdf->Cell(0,$h,mb_strtoupper('Barcelona, '.fechaDiaMesAno($resultUsuario->fecha_modificacion)),0,1,'L');
    
    $this->pdf->ln(16);
    $this->pdf->Cell(90,$h,'',0,0,'L');
    $this->pdf->Cell(0,$h,mb_strtoupper(utf8_decode('Signat, '.$resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor)),0,1,'L');
    
    
    $this->pdf->Ln(5);
    
    
    
     
    
    /*
     * Se manda el pdf al navegador
     *
     * $this->pdf->Output(nombredelarchivo, destino);
     *
     * I = Muestra el pdf en el navegador
     * D = Envia el pdf para descarga
     *
     */
    $ficha=utf8_decode("Usuari ".$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno).".pdf";


    $this->pdf->Output($ficha, 'D');
  }
  
//   // ficha usuario ludoteca
//   public function pdfUsuarioLudoteca($usuario)
//    {
//     // Se carga el modelo usuario
//     $this->load->model('usuarios_model');
//     // Se carga la libreria fpdf
//    $this->load->library('pdf');
 
//     // Se obtienen los datos del usuario de la base de datos
//     $resultUsuario = $this->usuarios_model->getUsuario($usuario);

    
 
//     // Creacion del PDF
//     /*
//      * Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
//      * heredó todos las variables y métodos de fpdf
//      */
//     $this->pdf = new Pdf();
    

//     $this->pdf->setTitulo(utf8_decode('Fitxa Inscripció usuari/usària.'));
//     $this->pdf->setSubtitulo(utf8_decode($resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno));

//     // Agregamos una página
//     $this->pdf->AddPage();

//     // Define el alias para el número de página que se imprimirá en el pie
//     $this->pdf->AliasNbPages();
 
//     /* Se define el titulo, márgenes izquierdo, derecho y
//      * el color de relleno predeterminado
//      */
//     //$this->pdf->SetTitle("Datos socio=");
//     //$this->pdf->SetLeftMargin(15);
//     //$this->pdf->SetRightMargin(15);
//     //$this->pdf->SetFillColor(200,200,200);
 
//     // Se define el formato de fuente: Arial, negritas, tamaño 9
//     $this->pdf->SetFont('Arial', 'BIU', 10);
    
//     $border=0;
//     //$this->pdf->Ln(2);
//     // La variable $x se utiliza para mostrar un número consecutivo
//     $h = 6;
//     //$this->pdf->SetFont('Arial', '', fa-rotate-180);


//     $this->titulo($this->pdf,'NÚM INSCRIPCIÓ: '.$resultUsuario->num_usuario);
//     $this->titulo($this->pdf,'DADES PERSONALS RESPONSABLE');
//     // mensaje($resultUsuario->nombre_tutor);
//     $this->datos($this->pdf,'NOM I COGNOM PARE/ MARE/ TUTOR/A',$resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor);
//     $this->datos($this->pdf,'ADREÇA',$resultUsuario->direccion_tutor);
//     $this->datos($this->pdf,'CODI POSTAL - POBLACIÓ (PROVINCIA)',$resultUsuario->codigo_postal_tutor.' - '.$resultUsuario->poblacion_tutor.' ('.$resultUsuario->provincia_tutor.')');
//     $this->datos($this->pdf,'DNI/ NIE',$resultUsuario->dni_tutor);
//     $this->datos($this->pdf,'TELÈFON DE CONTACTE 1',$resultUsuario->telefono1_tutor);
//     $this->datos($this->pdf,'TELÈFON DE CONTACTE 2',$resultUsuario->telefono2_tutor);
//     $this->datos($this->pdf,'CORREU ELECTRÒNIC',$resultUsuario->email_tutor);
//     $this->datos($this->pdf,'PROFESSIÓ MARE',$resultUsuario->profesion_madre);
//     $this->datos($this->pdf,'PROFESSIÓ PARE',$resultUsuario->profesion_padre);
    
//     $this->titulo($this->pdf,'DADES PERSONALS INFANT/ JOVE');
    
//     $this->datos($this->pdf,'NOM I COGNOM',$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno);
//     $this->datos($this->pdf,'ADREÇA',$resultUsuario->direccion_alumno.' - '.$resultUsuario->poblacion_alumno.' ('.$resultUsuario->provincia_alumno.')');
//     $this->datos($this->pdf,'DNI	',$resultUsuario->dni_alumno);
//     $this->datos($this->pdf,'DATA DE NEIXEMENT',fechaDiaMesAno($resultUsuario->fecha_nacimiento));
//     $this->datos($this->pdf,'CURS ESCOLAR',$resultUsuario->curso_escolar);
//     $this->datos($this->pdf,'ESCOLA/ INSTITUT',$resultUsuario->escuela);
    
//     $this->titulo($this->pdf,'GRUP ON REALITZA LA INSCRIPCIÓ');

//     $this->datos($this->pdf,'CURS',$resultUsuario->texto_curso);
//     $this->datos($this->pdf,'LUDOTECA',$resultUsuario->nombre_ludoteca);
//     $this->datos($this->pdf,'PERIODO',$resultUsuario->texto_periodo);
//     $this->datos($this->pdf,'DIES SETMANA',$resultUsuario->texto_dias_semana);
//     $this->datos($this->pdf,'HORARI',$resultUsuario->texto_horario);

//     $this->datos($this->pdf,'PREU (€)',number_format($resultUsuario->precio,2));
    
//     $this->titulo($this->pdf,'MÉS DADES');
//     if($resultUsuario->id_becas!=2)
//     $this->datosSiNo($this->pdf,'HA SOL·LICITAT BECA?	',$resultUsuario->id_becas,'Ajunt.: '.$resultUsuario->becas_descuento_ayuntamiento.' %    Serv. Socials: '.$resultUsuario->becas_descuento_servicios_sociales.' %');
//     else
//       $this->datosSiNo($this->pdf,'HA SOL·LICITAT BECA?	',$resultUsuario->id_becas);
//     if($resultUsuario->id_monitora!=2)  
//       $this->datosSiNo($this->pdf,'HA MONITOR/A DE SUPORT? ',$resultUsuario->id_monitora,'Des de: '.fechaEuropea($resultUsuario->monitora_desde),'Fins: '.fechaEuropea($resultUsuario->monitora_hasta));
//     else
//       $this->datosSiNo($this->pdf,'HA MONITOR/A DE SUPORT? ',$resultUsuario->id_monitora);
    
//     $this->datosSiNo($this->pdf,'HA PARTICIPAT ANTERIORMENT DE L´ACTIVITAT?	',$resultUsuario->id_participacion_anterior);
//     if($resultUsuario->id_hermanos_actividad!=2)
//       $this->datosSiNo($this->pdf,'TÉ GERMANS/ES A L´ACTIVITAT?	',$resultUsuario->id_hermanos_actividad,'Núm germans: '.$resultUsuario->hermanos_actividad, 'Ordre: '.$resultUsuario->hermano_num);
//     else
//       $this->datosSiNo($this->pdf,'TÉ GERMANS/ES A L´ACTIVITAT?	',$resultUsuario->id_hermanos_actividad);

//     $this->datosSiNo($this->pdf,'TÉ TARGETA DEL TRANSPORT T-12?	',$resultUsuario->id_tarjeta_t12);
//     $this->datosSiNo($this->pdf,mb_strtoupper('Assisteix a algun servei d´atenció a la infància?	'),$resultUsuario->id_asistencia_atencion,$resultUsuario->asistencia_atencion);
    
    
//     $this->titulo($this->pdf,'FITXA DE SALUT');
    
//     $this->datosSiNo($this->pdf,'TÉ ALGUNA AL·LÈRGIA I/O INTOLERÀNCIA?',$resultUsuario->id_alergia,$resultUsuario->alergia);
//     $this->datosSiNo($this->pdf,'TÉ ALGUNA MALALTIA RESPIRATÒRIA?	',$resultUsuario->id_respiratoria,$resultUsuario->respiratoria);
//     $this->datosSiNo($this->pdf,'TÉ ALGUNA MALALTIA VASCULAR?	',$resultUsuario->id_vascular,$resultUsuario->vascular);
//     $this->datosSiNo($this->pdf,'TÉ ALGUNA MALALTIA CRÒNICA?	',$resultUsuario->id_cronica,$resultUsuario->cronica);
//     $this->datosSiNo($this->pdf,'PATEIX HEMORRÀGIES?',$resultUsuario->id_hemorragia,$resultUsuario->hemorragia);
//     $this->datosSiNo($this->pdf,'PREN ALGUNA MEDICACIÓ?',$resultUsuario->id_medicacion,$resultUsuario->medicacion);
//     if($resultUsuario->id_nadar!=2)
//       $this->datosSiNo($this->pdf,'SAP NEDAR?',$resultUsuario->id_nadar,'Nivell: '.$resultUsuario->nadar);
//     else
//       $this->datosSiNo($this->pdf,'SAP NEDAR?',$resultUsuario->id_nadar);
//     $this->datosSiNo($this->pdf,'PRESENTA ALGUNA NEE?',$resultUsuario->id_nee,$resultUsuario->nee);		
    
//     $this->titulo($this->pdf,'DOCUMENTACIÓ A ADJUNTAR');
    
//     $this->datosSiNo($this->pdf,'DNI MARE/PARE/TUTOR/A',$resultUsuario->id_presenta_dni_tutor);		
//     $this->datosSiNo($this->pdf,'DNI INFANT',$resultUsuario->id_presenta_dni_alumni);		
//     $this->datosSiNo($this->pdf,'LLIBRE VACUNES',$resultUsuario->id_presenta_libro_vacunas);		
//     $this->datosSiNo($this->pdf,'TARJETA SANITÀRIA		',$resultUsuario->id_presenta_tarjeta_sanitaria);		
//     $this->datosSiNo($this->pdf,'ALTRES DOCUMENTACIONS		',$resultUsuario->id_presenta_otras,$resultUsuario->presenta_otras);	

//     $this->pdf->Ln(5);
//     $this->titulo($this->pdf,'COMUNICACIONS');
    
//     $this->datosSiNo($this->pdf,mb_strtoupper('Vull rebre les comunicacions del Casal Infantil '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('per correu electrònic: activitats, '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('tallers, sortides, ...'),$resultUsuario->id_comunicaciones);		
//     $this->datosSiNo($this->pdf,mb_strtoupper('Vull rebre altres comunicacions d´interès '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('general relacionades amb temes d’infància'));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('enviades pel Casal Infantil, respecte '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('cultura, esport, salut, ...'),$resultUsuario->id_otras_comunicaciones);		
    
//     $this->titulo($this->pdf,'AUTORITZACIONS');
    
//     $this->datosSiNo($this->pdf,mb_strtoupper('Em comprometo a acompanyar i recollir el meu  '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('fill/a a les hores establertes'),$resultUsuario->id_aut_acompanar);		
//     $this->datosSiNo($this->pdf,mb_strtoupper('Autoritzo que el meu fill/a sigui recollit/da '));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('a la sortida del casal per en/na'),$resultUsuario->id_aut_recogida);		
//     if($resultUsuario->id_aut_recogida){
//       $this->pdf->Cell(25,$h,'',$border,0,'L',0);
//       $this->datos($this->pdf,'AUTORIZO RECULLIDA A: ',$resultUsuario->aut_nombre.' '.$resultUsuario->aut_apellido1.' '.$resultUsuario->aut_apellido2);
//       $this->pdf->Cell(25,$h,'',$border,0,'L',0);
//       $this->datos($this->pdf,'AMB DNI (PARENTIU): ',$resultUsuario->aut_dni.' '.$resultUsuario->aut_parentesco);
//     }
//     $this->datosSiNo($this->pdf,mb_strtoupper('Autoritzo al meu fill/filla'));		
//     $this->datosSiNo($this->pdf,mb_strtoupper('a marxar sol del casal.'),$resultUsuario->id_aut_ir_solo);		
		
//     $this->titulo($this->pdf,'SIGNATURA LEGAL');
    
//     $this->pdf->MultiCell(180,6,mb_strtoupper('Jo, '.utf8_decode($resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor.' amb DNI '.$resultUsuario->dni_tutor.', declaro que les dades d´aquesta fitxa són certes.')),$border,'L');
//     $this->pdf->ln();
//     $this->pdf->MultiCell(180,6,utf8_decode('Autoritzo a l´infant/ jove '.$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno.' '.$resultUsuario->apellido2_alumno.' amb DNI '.$resultUsuario->dni_alumno.' a assistir al ' .mb_strtoupper(getNombreCasal()). ' amb les condicions establertes per l´equip d´educadors. '),$border,'L');
//     $this->pdf->ln();
    
//     $this->datosSiNo($this->pdf,'Autoritzo als educadors/es a que prenguin les decisions ');		
//     $this->datosSiNo($this->pdf,'necessàries en cas d´urgència. Fa extensiva aquesta ');		
//     $this->datosSiNo($this->pdf,'autorització a les decisions medicoquirúrgiques que ');		
//     $this->datosSiNo($this->pdf,'siguin necessàries adoptar, en cas d´extrema gravetat, ');		
//     $this->datosSiNo($this->pdf,'sota la direcció facultativa pertinent. ',$resultUsuario->id_decisiones_urgentes);		
    
//     $this->pdf->ln();
    
//     $this->datosSiNo($this->pdf,'Autoritzo al '.mb_strtoupper(getNombreCasal()).' a a utilitzar la imatge ');		
//     $this->datosSiNo($this->pdf,'de l´infant en activitats internes (tallers, exposició de fotos, ');		
//     $this->datosSiNo($this->pdf,'cd famílies etc...) durant el curs 2019-2020. ',$resultUsuario->id_imagen_en_actividades);		
    
    
//     $this->pdf->ln();
//     $this->datosSiNo($this->pdf,'Autoritzo al '.mb_strtoupper(getNombreCasal()).' a que la imatge del meu ');		
//     $this->datosSiNo($this->pdf,'fill/a sigui reproduïda en divulgacions lúdico-educatives, en les ');		
//     $this->datosSiNo($this->pdf,'xarxes socials del casal i en altres medis de difusió de  ');		
//     $this->datosSiNo($this->pdf,'l´Ajuntament de Barcelona.',$resultUsuario->id_imagen_divulgacion);		
    
//     $this->titulo($this->pdf,'INFORMACIÓ BÀSICA SOBRE PROTECCIÓ DE DADES');
    
//     $this->pdf->MultiCell(180,$h,mb_strtoupper(utf8_decode('INFORMACIÓ BÀSICA SOBRE PROTECCIÓ DE DADES
// Responsable del tractament: INCOOP, SCCL (Mallorca 51-53 local 4, 08029  Barcelona)
// Finalitat: Tramitació i resolució del procés d´admissió del sol.licitant al servei ofert i el seguiment d´aquest en el centre.
// Legitimació: Consentiment de la persona interessada.
// Destinataris: Organitzacions o persones directament relacionades amb el responsable del tractament.
// Drets: Accedir a les dades, rectificar-les, suprimir-les, oposar-se´n al tractament i sol.licitar-ne la limitació.
// Informació addicional: Podeu consultar tota la informació detallada').' a https://incoop.cat/politica-privacitat/.'),$border,'L');
      
//       $this->pdf->ln();

//       $this->datosSiNo($this->pdf,'He llegit la informació bàsica sobre protecció ');		
//       $this->datosSiNo($this->pdf,'de dades i autoritzo el tractament de les dades',$resultUsuario->id_lectura_informacion);		
      
       
//     $this->pdf->ln();

//       $this->pdf->MultiCell(180,$h,utf8_decode('Us informem que és necessari indicar que heu llegit la informació bàsica sobre protecció de dades. En cas contrari, no podreu continuar amb el procés preinscripció.'),$border,'L');
          
//     $this->pdf->Cell(90,$h,'',0,0,'L');
//     $this->pdf->Cell(0,$h,'Barcelona, '.fechaDiaMesAno($resultUsuario->fecha_modificacion),0,1,'L');
    
//     $this->pdf->ln(16);
//     $this->pdf->Cell(90,$h,'',0,0,'L');
//     $this->pdf->Cell(0,$h,utf8_decode('Signat, '.$resultUsuario->nombre_tutor.' '.$resultUsuario->apellido1_tutor.' '.$resultUsuario->apellido2_tutor),0,1,'L');
    
    
//     $this->pdf->Ln(5);
    
    
    
     
    
//     /*
//      * Se manda el pdf al navegador
//      *
//      * $this->pdf->Output(nombredelarchivo, destino);
//      *
//      * I = Muestra el pdf en el navegador
//      * D = Envia el pdf para descarga
//      *
//      */
//     $ficha=utf8_decode("Usuari ".$resultUsuario->nombre_alumno.' '.$resultUsuario->apellido1_alumno).".pdf";


//     $this->pdf->Output($ficha, 'D');
//   }

}