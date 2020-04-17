<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Cursos_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    

}