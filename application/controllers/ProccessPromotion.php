<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProccessPromotion extends CI_Controller {
	private $_id;
	private $_name;
	private $_type;
	private $_description;
	private $_startDate;
	private $_endDate;
	private $_status;

	public function __construct()
	{
		parent::__construct();
	}
	public function insert()
	{
		$this->setFormRules();
		if($this->validateAjaxAndFields()){
			$this->getFormData();
			
			$this->load->model("Repo_promotion_model","repoPromotion");
			$this->repoPromotion->setName($this->_name);
			$this->repoPromotion->setType($this->_type);
			$this->repoPromotion->setDescription($this->_description);
			$this->repoPromotion->setStartDate($this->_startDate);
			$this->repoPromotion->setEndDate($this->_endDate);
			$this->repoPromotion->setStatus(1);

			if($this->repoPromotion->insert()){
				die(SUCCESS);
			}else{
				die(ERROR);
			}
		}	
		die($this->print_errors());	
	}
	public function update()
	{
		$this->setFormRules();
		if($this->validateAjaxAndFields()){
			$this->getFormData();
			
			$this->load->model("Repo_promotion_model","repoPromotion");
			$this->repoPromotion->setId($this->_id);
			$this->repoPromotion->setName($this->_name);
			$this->repoPromotion->setType($this->_type);
			$this->repoPromotion->setDescription($this->_description);
			$this->repoPromotion->setStartDate($this->_startDate);
			$this->repoPromotion->setEndDate($this->_endDate);
			$this->repoPromotion->setStatus(1);

			if($this->repoPromotion->update()){
				die(SUCCESS);
			}else{
				die(ERROR);
			}
		}	
		die($this->print_errors());	
	}
	public function delete(){
		$this->setIdRule();
		if($this->validateAjaxAndFields()){
			$this->getId();
			
			$this->load->model("Repo_promotion_model","repoPromotion");
			$this->repoPromotion->setId($this->_id);
			$this->repoPromotion->setStatus(0);

			if($this->repoPromotion->delete()){
				die(SUCCESS);
			}else{
				die(ERROR);
			}
		}	
		die($this->print_errors());	
	}
	private function validateAjaxAndFields(){
		if($this->input->is_ajax_request()){
			return $this->form_validation->run();
		}
		return FALSE;
	}
	private function setIdRule(){
		$this->form_validation->set_rules('id', 'Id', 'required|trim|is_natural');
	}	
	private function setFormRules(){
		$this->form_validation->set_rules('id', 'Id', 'required|trim|is_natural');
		$this->form_validation->set_rules('name', 'Nombre promoción', 'required|trim');
		$this->form_validation->set_rules('type', 'Tipo', 'required|trim');
		$this->form_validation->set_rules('description', 'Descripción', 'trim');
		$this->form_validation->set_rules('startDate', 'Fecha Inicio', 'required|trim');
		$this->form_validation->set_rules('endDate', 'Fecha termino', 'required|trim');
	}
	private function getFormData(){	
		$this->_id 			= $this->input->post("id",TRUE);
		$this->_name 		= $this->input->post("name",TRUE);
		$this->_type 		= $this->input->post("type",TRUE);
		$this->_description = ($this->_type == "SPECIES")?$this->input->post("description",TRUE):null;
		$this->_startDate 	= $this->input->post("startDate",TRUE);
		$this->_endDate 	= $this->input->post("endDate",TRUE);
	}
	private function getId(){	
		$this->_id 			= $this->input->post("id",TRUE);
	}
	private function print_errors(){
		echo validation_errors();
	}

}