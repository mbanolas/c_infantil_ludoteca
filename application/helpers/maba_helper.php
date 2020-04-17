<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




if ( ! function_exists('nextRecord'))
{
    function nextRecord($table = '', $var='')
    {
        if(!$var || !$table ) return '';
        $sql="SELECT ".$var." FROM ".$table." ORDER BY ".$var." DESC LIMIT 1";
        if($this->db->query($sql)->num_rows()>0)
            return $this->db->query($sql)->row_array()[$var];
        return 0;
    }    
}

if ( ! function_exists('mensaje'))
{
    function mensaje($mensaje="",$previo="----------------------------")
    {
        if(!$mensaje) return;
        else log_message('INFO', $previo.' '.$mensaje);
    }    
}


if ( ! function_exists('eliminarEspacios'))
{
    function eliminarEspacios($string="")
    {
        if(!$string) return $string;
        $string=trim($string);
        while(strpos($string," ")){
           $string=str_replace (" " , "" , $string );
         }
         return $string; 
    }    
}

if ( ! function_exists('formatearTelefono'))
{
    function formatearTelefono($telefono="")
    {
        if(!$telefono) return $telefono;
        $telefono=trim($telefono);
        while(strpos($telefono," ")){
           $telefono=str_replace (" " , "" , $telefono );
         }
         if(strlen($telefono)==9){
            $telefono=substr($telefono,0,3).' '.substr($telefono,3,3).' '.substr($telefono,6,3);
         }else{
            $prefijo=substr($telefono, 0, strlen($telefono)-9);
            $telefono=substr($telefono, strlen($telefono)-9); 
            $telefono=$prefijo." ".substr($telefono,0,3).' '.substr($telefono,3,3).' '.substr($telefono,6,3);
         }
         return $telefono; 
    }    
}

// if ( ! function_exists('isDate'))
// {
// function isDate($date){
//    return 1 === preg_match(
//      '~^[0-9]{1,2)/[0-9]{1,2)/[0-9]{4)~',
//      $date
//    );
//  }
// }


  if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
      $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
      $str_end = "";
      if ($lower_str_end) {
        $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
      }
      else {
        $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
      }
      $str = $first_letter . $str_end;
      return $str;
    }
  }



if ( ! function_exists('fechaEuropeaToBaseDatos'))
{
    function fechaEuropeaToBaseDatos($fecha="")
    {
        if(!$fecha) $fecha=date("Y-m-d");
        return substr($fecha,6,4).'-'.substr($fecha,3,2).'-'.substr($fecha,0,2);
    }    
}

if ( ! function_exists('fechaEuropea'))
{
    function fechaEuropea($fecha="")
    {
        if(!$fecha) $fecha=date("Y-m-d");
        return date("d/m/Y", strtotime($fecha));
    }    
}

//verifica si una url existe
//https://stackoverflow.com/questions/1122845/what-is-the-fastest-way-to-determine-if-a-url-exists-in-php
if ( ! function_exists('urlOK'))
{
    function urlOK($url)
        {

            $url_data = parse_url ($url);
            if (!$url_data) return FALSE;

        $errno="";
        $errstr="";
        $fp=0;

        $fp=fsockopen($url_data['host'],80,$errno,$errstr,30);

        if($fp===0) return FALSE;
        $path ='';
        if  (isset( $url_data['path'])) $path .=  $url_data['path'];
        if  (isset( $url_data['query'])) $path .=  '?' .$url_data['query'];

        $out="GET /$path HTTP/1.1\r\n";
        $out.="Host: {$url_data['host']}\r\n";
        $out.="Connection: Close\r\n\r\n";

        fwrite($fp,$out);
        $content=fgets($fp);
        $code=trim(substr($content,9,4)); //get http code
        fclose($fp);
        // if http code is 2xx or 3xx url should work
        return  ($code[0] == 2 || $code[0] == 3) ? TRUE : FALSE;
    }
}

if ( ! function_exists('enviarEmail'))
{
    function enviarEmail($email,$subject,$from,$mensaje,$destinatarios=1) {
        //$email=$this->load->library('email');
        $email->clear();
        $host = host();
        mensaje($host);
        if (strpos($host,'localhost:8888')===0) {
            // mensaje('es host local');
            $email->bcc('mbanolas@gmail.com');
            $email->to('mbanolas@gmail.com');
        } else {
            switch($destinatarios){
                case 1:
                    //$this->email->bcc('mbanolas@gmail.com');
                    //$this->email->bcc('mbanolas@gmail.com');
                    //$this->email->to('carlos@jamonarium.com');
                    $email->to('carlos@jamonarium.com');
                    $email->bcc('mbanolas@gmail.com');
                    break;
                case 2:
                    //$this->email->bcc('mbanolas@gmail.com');
                    //$this->email->bcc('mbanolas@gmail.com');
                    //$this->email->to('carlos@jamonarium.com');
                    $email->to('carlos@jamonarium.com');
                    $email->bcc('mbanolas@gmail.com');
                break;
                default:
                    $email->to('mbanolas@gmail.com');
            }
        }

        

        $email->subject($subject);
        $email->from('info@lolivaret.com',$from);
        $email->message($mensaje);
        
        if ($email->send()) {
            // echo "Mail Sent!";
        } else {
            echo "Error al enviar $subject";
        }
    }
}

if ( ! function_exists('host'))
{
	function host()
	{
                $host=isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

		//$host=  $_SERVER['HTTP_HOST'];
 		return $host;
	}
}






if ( ! function_exists('fechaDiaMesAno'))
{
	function fechaDiaMesAno($fecha)
	{
 		return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
	}
}
if (!function_exists('getEdad')) {
    function getEdad($dateOfBirth)
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    }
}

if ( ! function_exists('num2letrasCatalan'))
{
function num2letrasCatalan($num, $fem = false, $dec = true) { 
// mensaje('$num '.$num);
// mensaje('$fem '.$fem);
// mensaje('$dec '.$dec);

$matuni[2]  = "dos"; 
$matuni[3]  = "tres"; 
$matuni[4]  = "quatre"; 
$matuni[5]  = "cinc"; 
$matuni[6]  = "sis"; 
$matuni[7]  = "set"; 
$matuni[8]  = "vuit"; 
$matuni[9]  = "nou"; 

$matuni[10] = "deu"; 
$matuni[11] = "onze"; 
$matuni[12] = "dotze"; 
$matuni[13] = "tretze"; 
$matuni[14] = "catorze"; 
$matuni[15] = "quinze"; 
$matuni[16] = "setze"; 
$matuni[17] = "disset"; 
$matuni[18] = "divuit"; 
$matuni[19] = "dinou"; 
$matuni[20] = "vint"; 

$matunisub[2] = "dos"; 
$matunisub[3] = "tres"; 
$matunisub[4] = "quatre"; 
$matunisub[5] = "cinc"; 
$matunisub[6] = "sis"; 
$matunisub[7] = "set"; 
$matunisub[8] = "vuit"; 
$matunisub[9] = "nou"; 

$matdec[2] = "vint"; 
$matdec[3] = "trenta"; 
$matdec[4] = "quaranta"; 
$matdec[5] = "cinquanta"; 
$matdec[6] = "seixanta"; 
$matdec[7] = "setanta"; 
$matdec[8] = "vuitanta"; 
$matdec[9] = "noranta"; 

$matsub[3]  = 'mill'; 
$matsub[5]  = 'bill'; 
$matsub[7]  = 'mill'; 
$matsub[9]  = 'trill'; 
$matsub[11] = 'mill'; 
$matsub[13] = 'bill'; 
$matsub[15] = 'mill'; 
$matmil[4]  = 'millions'; 
$matmil[6]  = 'billions'; 
$matmil[7]  = 'de billions'; 
$matmil[8]  = 'millios de billions'; 
$matmil[10] = 'trillions'; 
$matmil[11] = 'de trillions'; 
$matmil[12] = 'millions de trillions'; 
$matmil[13] = 'de billions'; 
$matmil[14] = 'billions de billions'; 
$matmil[15] = 'de billions de trillions'; 
$matmil[16] = 'millions de billions de trillions'; 

//Zi hack

$inicial=$num;
if(strpos($num,'.')){
    $float=explode('.',(string)$num);
    $int=explode('.',(string)$num);
  
}
else{
    $float[0]=$num;
}

$num=$float[0];
// if(isset($float[1])){
//    $float[1]=(int)$inicial*100-(int)$num*100;  //obtenemos los dos primeros digitos decimales
// }
$num = trim((string)$num); 

if ($num[0] == '-') { 
  $neg = 'menos '; 
  $num = substr($num, 1); 
}else 
  $neg = ''; 
while (isset($num[0]) && $num[0] == '0') $num = substr($num, 1); 
if (isset($num[0]) && ($num[0] < '1' or $num[0] > 9)) $num = '0' . $num; 
$zeros = true; 
$punt = false; 
$ent = ''; 
$fra = ''; 
for ($c = 0; $c < strlen($num); $c++) { 
  $n = $num[$c]; 
  if (! (strpos(".,'''", $n) === false)) { 
     if ($punt) break; 
     else{ 
        $punt = true; 
        continue; 
     } 

  }elseif (! (strpos('0123456789', $n) === false)) { 
     if ($punt) { 
        if ($n != '0') $zeros = false; 
        $fra .= $n; 
     }else 

        $ent .= $n; 
  }else 

     break; 

} 
$ent = '     ' . $ent; 
if ($dec and $fra and ! $zeros) { 
  $fin = ' coma'; 
  for ($n = 0; $n < strlen($fra); $n++) { 
     if (($s = $fra[$n]) == '0') 
        $fin .= ' zero'; 
     elseif ($s == '1') 
        $fin .= $fem ? ' una' : ' un'; 
     else 
        $fin .= ' ' . $matuni[$s]; 
  } 
}else 
  $fin = ''; 
if ((int)$ent === 0) return 'zero ' . $fin; 
$tex = ''; 
$sub = 0; 
$mils = 0; 
$neutro = false; 
while ( ($num = substr($ent, -3)) != '   ') { 
  $ent = substr($ent, 0, -3); 
  if (++$sub < 3 and $fem) { 
     $matuni[1] = 'una'; 
     $subcent = 'as'; 
  }else{ 
     $matuni[1] = $neutro ? 'un' : 'un'; 
     $subcent = 's'; 
  } 
  $t = ''; 
  $n2 = substr($num, 1); 
  if ($n2 == '00') { 
  }elseif ($n2 < 21) 
     $t = ' ' . $matuni[(int)$n2]; 
  elseif ($n2 < 30) { 
     $n3 = $num[2]; 
     if ($n3 != 0) $t = '-i-' . $matuni[$n3]; 
     $n2 = $num[1]; 
     $t = ' ' . $matdec[$n2] . $t; 
  }else{ 
     $n3 = $num[2]; 
     if ($n3 != 0) $t = '-' . $matuni[$n3]; 
     $n2 = $num[1]; 
     $t = ' ' . $matdec[$n2] . $t; 
  } 
  $n = $num[0]; 
  if ($n == 1) { 
     $t = ' cent' . $t; 
  }elseif ($n == 5){ 
     $t = ' ' . $matunisub[$n] . '-cent' . $subcent . $t; 
  }elseif ($n != 0){ 
     $t = ' ' . $matunisub[$n] . '-cent' . $subcent . $t; 
  } 
  if ($sub == 1) { 
  }elseif (! isset($matsub[$sub])) { 
     if ($num == 1) { 
        $t = ' mil'; 
     }elseif ($num > 1){ 
        $t .= ' mil'; 
     } 
  }elseif ($num == 1) { 
     $t .= ' ' . $matsub[$sub] . 'ó'; 
  }elseif ($num > 1){ 
     $t .= ' ' . $matsub[$sub] . 'ons'; 
  }   
  if ($num == '000') $mils ++; 
  elseif ($mils != 0) { 
     if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
     $mils = 0; 
  } 
  $neutro = true; 
  $tex = $t . $tex; 
} 
$tex = $neg . substr($tex, 1) . $fin; 
//Zi hack --> return ucfirst($tex);
//echo $float[1];
$parteDecimal=isset($float[1])?$float[1]:0;
if($parteDecimal>0) {
   
   $parteDecimal=num2letrasCatalan($parteDecimal); 
}
   else 
       $parteDecimal='';


//$end_num=ucfirst($tex);
if ($parteDecimal!='') {
   $tex=$tex.' Euros, '.substr($parteDecimal,0,  strlen($parteDecimal)-6).' cèntims';
}
else $tex=$tex.' Euros';

return ($tex);
} 
}

//datos propios del CASAL

 
 if (!function_exists('getNumeroRegistroCasalIngresos')) {
    function getNumeroRegistroCasalIngresos() {
        return "00-CINF-00-01";
       }
 }
 
 if (!function_exists('getNumeroRegistroCasalDevoluciones')) {
    function getNumeroRegistroCasalDevoluciones() {
         return "00-CINF-00-99";
    }
 }

 if ( ! function_exists('getLetraCasal'))
 {
     function getLetraCasal()
     {
          return "P";
     }
 }
 
 if ( ! function_exists('getNombreCasal'))
 {
     function getNombreCasal()
     {

          return "Casal Infantil PRUEBAS ";
     }
 }

 if (!function_exists('getTituloCasal')) {
    function getTituloCasal() {
        return "Casal Infantil PRUEBAS ";
    }
 }
 
 if (!function_exists('getTituloCasalCorto')) {
    function getTituloCasalCorto() {
        return "Pruebas";
    }
 }


