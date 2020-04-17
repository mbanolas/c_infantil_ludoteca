<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($GLOBALS['_SERVER']['HTTP_REFERER'])) exit("<h2>No está permitido el acceso directo a esta URL</h2>");


class Maba extends CI_Controller {

    

    public function __construct()
	{
		parent::__construct();
    }

    
}