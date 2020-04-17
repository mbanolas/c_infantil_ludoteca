<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Number Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/number_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('numero'))
{
	
        // elimina en un string las ',' separadores de miles
	function numero($string)
	{
		$string=  str_replace(',', '', $string);
                $numero=(float)$string;

		return $numero;
	}
}

if ( ! function_exists('arrayNumero'))
{
	
        // elimina en un string las ',' separadores de miles de los elementos de un array
	function arrayNumero($strings)
	{
            $stringSalida=array();
            foreach($strings as $k=>$v){
		$v=  str_replace(',', '', $v);
                $stringSalida[]=(float)$v;
            }
		return $stringSalida;
	}
}


if ( ! function_exists('formato2decimales'))
{
	
	function formato2decimales($string)
	{
		$string=  str_replace(',', '', $string);
                $numero=(float)$string;

		return number_format($numero, 2);
	}
}



if ( ! function_exists('formato0decimales'))
{
	
	function formato0decimales($string)
	{
            $string=  str_replace(',', '', $string);
		$numero=(float)$string;

		return number_format($numero, 0);
	}
}

if ( ! function_exists('formato3decimales'))
{
	
	function formato3decimales($string)
	{
            $string=  str_replace(',', '', $string);
		$numero=(float)$string;

		return number_format($numero, 3);
	}
}


if ( ! function_exists('fechaEuropea'))
{
	
	function fechaEuropea($string)
	{
		$time=  strtotime($string);
                if($time<0) return '---';
		return date('d/m/Y H:i:s',$time);
	}
}

if ( ! function_exists('fechaEuropeaSinHora'))
{
	
	function fechaEuropeaSinHora($string)
	{
		$time=  strtotime($string);
                if($time<=0) return date('d/m/Y',0);
		return date('d/m/Y',$time);
	}
}

if ( ! function_exists('fechaEuropeaToBaseDatos'))
{
	
	function fechaEuropeaToBaseDatos($string)
	{
                $dia=substr($string,0,2);
                $mes=substr($string,3,2);
                $año=substr($string,6,4);
                $resto=substr($string,10);
                
		return "$año-$mes-$dia$resto";
	}
}

if ( ! function_exists('digitos'))
{
	
	function digitos($string,$digitos)
	{
		
                while (strlen($string)<6){
                    $string='0'.$string;
                }

		return $string;
	}
}

if ( ! function_exists('calculaFecha'))
{
        function calculaFecha($modo,$valor,$fecha_inicio=false){
 
   if($fecha_inicio!=false) {
          $fecha_base = strtotime($fecha_inicio);
   }else {
          $time=time();
          $fecha_actual=date("Y-m-d",$time);
          $fecha_base=strtotime($fecha_actual);
   }
 
   $calculo = strtotime("$valor $modo","$fecha_base");
 
   return date("Y-m-d", $calculo);
 
}
}

if ( ! function_exists('diaSiguiente')){
    //$fecha formato 'Y-m-d'
    //devuelve dia siguiente en formato 'Y-m-s'
    function diaSuiguiente($fecha){
        return date("Y-m-d",strtotime('+1 day',$fecha));
    }
    
}