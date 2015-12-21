<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CloseSession extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session_manager');
		
	}
	public function index()
	{
	}
	
	public function closeSessionMaintainer(){
		$this->session_manager->closeSesionMaintainer();
	}
}
