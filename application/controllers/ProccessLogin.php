<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProccessLogin extends CI_Controller {
	private $_rut;
	private $_passwd;
	public function __construct()
	{
		parent::__construct();
	}
	public function checkLogin()
	{
		$this->setFormRules();
		if($this->validateAjaxAndFields()){
			$this->getFormData();
			if($this->_rut === MASTER_RUT && $this->_passwd === MASTER_PASSWD){
				die(SUCCESS);
			}
			die(ERROR);
		}	
		die($this->print_errors());	
	}
	private function validateAjaxAndFields(){
		if($this->input->is_ajax_request()){
			return $this->form_validation->run();
		}
		return FALSE;
	}
	private function setFormRules(){
		$this->form_validation->set_rules('rut', 'Rut', 'required|trim');
		$this->form_validation->set_rules('passwd', 'Clave', 'required|trim');
	}

	private function getFormData(){	
		$this->_rut 	= 	$this->input->post('rut',TRUE);
		$this->_passwd 	= 	$this->input->post('passwd',TRUE);
	}
	private function print_errors(){
		echo validation_errors();
	}

}