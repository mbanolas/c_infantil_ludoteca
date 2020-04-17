<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class General_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    public function nextRecord($table = '', $var='')
    {
        if(!$var || !$table ) return '';
        $sql="SELECT ".$var." FROM ".$table." ORDER BY ".$var." DESC LIMIT 1";
        if($this->db->query($sql)->num_rows()>0)
            return $this->db->query($sql)->row_array()[$var]+1;
        return 0;
    } 

    public function formatearTelefono($telefono){
        $valor=trim($telefono);
        while (strpos($valor," ")) {
            $valor=str_replace(" ","",$valor);
        }
        if(strlen($valor)==9)
            return substr($valor,0,3)." ".substr($valor,3,3)." ".substr($valor,6);
        return $valor;
    }

    public function fechaStringToDateTime($string){
        return date("Y-m-d H:i:s", strtotime($string)); 
    }

    public function fechaDateTimeToMostrar($string){
        return date("d/m/Y H:i:s", strtotime($string)); 
    }
    //numero x1000 expresado en 2 decimales con ',' decimales
    public function numero2decimales($value){
        $value /= 1000;
        $value = $value != 0 ? number_format($value, 2) : "";
        return $value;  
    }

    
	//pone 0 delante hasta completar número dógitos	
    function digitos($string,$digitos){
                while (strlen($string)<$digitos){
                    $string='0'.$string;
                }
		return $string;
    }
    
    function formato2decimales($string)
	{
		$string=  str_replace(',', '', $string);
                $numero=(float)$string;

		return number_format($numero, 2);
    }
    
    function formato3decimales($string)
	{
            $string=  str_replace(',', '', $string);
		$numero=(float)$string;

		return number_format($numero, 3);
	}


    
}