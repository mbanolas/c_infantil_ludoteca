<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    function __construct()
	{
        parent::__construct();
    }

    function str_replace_first($from, $to, $content)
{
    $from = '/'.preg_quote($from, '/').'/';

    return preg_replace($from, $to, $content, 1);
}



    function index(){
            $datos['casal']=getTituloCasalCorto();
            $datos['clave']=md5("DinamElGalliner");
            // $texto="Sí es totalmente cierto que nuestra mente esta capacitada para ver lo que realmente no hemos visto . No te lo habia dicho , pero con frecuencia yo ya no me entretengo en escribir las palabras correctamente ya que la gente las sabe interpretar sin problema . No obstante esta forma de escribir presenta un problema con los numeroa . Por ejemplo si digo que he nacido en 1947 , no lo puedo decir en esta forma de escritura . 
            // Por cierto , habeis estado recientemente en Azanuy ? Nosotros pasamos hace dos sabados , pero no nos llegamos a quedar . Espero hayas comprendido este mensaje . Un abrazo . Y hasta pronto .";
            // $texto="Me encanta esta forma de escribir porque asi desarrolla la mente tanto al escribir como al leer y entrenamos la memoria para que no se quede obsoleta . Pero lo Espero hayas comprendido este mensaje sin problema .  Has tratado de leer estos mensajes ? Si lo haces y la gente lo entiende  ";
            // $texto="Cierto , es bastante facil de entender lo que esta escrito . Personalmente me encanta esta forma de escribir porque asi desarrolla la mente , tanto al escribir como al leer , y entrenamos la capacidad de nuestra mente. Solo tiene el inconveniete que es bastante dificil el escribir . Me he psasadp gran parte de dia en poner estas lineas para que entiendas lo que dice . Un reto mucho mas dificil es leer en voz alta y tratar que otro lo entienda . Nuestra lengua y oido no esta suficientemente entrenado para leerlo con facilidad y menos entenderlo : es cuestion de entrenar mas . Que sigas teniendo un excelente dia";
            // $textoArray=explode(" ",$texto);
            // $nuevoTexto=array();
            // $p="";
            // $m="";
            // $u="";
            // foreach($textoArray as $k=>$v){
            //     $p=substr($v,0,1);
            //     $m=substr($v,1,strlen($v)-2);
            //     mensaje($m);
            //     $mn="";
            //     $max= strlen($m);
            //     mensaje($max);      
            //    for($x=0;$x<$max+1;$x++){
            //         mensaje("1 ".$m);
            //         $r=rand(0,strlen($m)-1);
            //         mensaje('$r '.$r);
            //         $l=substr($m,$r,1);
            //         mensaje('$l '.$l);
            //         $m=$this->str_replace_first($l,"",$m);
            //         mensaje("2 ".$m);
            //         $mn.=$l;
            //         mensaje('1 $mn '.$mn);
            //     }
            //     $mn.=$l;
            //     mensaje('2 $mn '.$mn);
            //     mensaje('////////////////');
            //     $u=substr($v,strlen($v)-1);
            //     $nuevoTexto[]=$p.$mn.$u;

            // }
            // $nuevo=implode(" ", $nuevoTexto);
            // mensaje($nuevo);

            // // $datos['texto']=iconv('UTF-8', 'CP1252',$nuevo);
            // $datos['texto']=$nuevo;
            $this->load->view('inicio', $datos);
                }

    function validarUsuario(){
        
        $username=$_POST['usuario'];
        $password=MD5($_POST['password']);
        $valido=$this->db->query("SELECT * FROM c_users WHERE username='$username' AND password='$password'")->num_rows();
        if($valido){
            $row=$this->db->query("SELECT * FROM c_users WHERE username='$username' AND password='$password'")->row();
            $row->valido=1;
            $datosSession = array(
                'id'=>$row->id,
                'username'  => $row->username,
                'nombre'     => $row->nombre,
                'logged_in' => true,
                'categoria' => $row->tipoUsuario,
                'sexo'=>$row->sexo,
            );
            
            $this->session->set_userdata($datosSession);
            echo json_encode($row);
        }       
        else echo 0;
    }

    


}
