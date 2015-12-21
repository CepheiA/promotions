<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoadViewPromotion extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{	

		$this->load->model('Read_promotion_model','readPromotion');
		$dots = getDotsFromRoot($this->uri->total_segments());
		$include["body_class"] 		  = "hold-transition skin-blue sidebar-mini";
		
		$include["include_js"] 		  =	array("promotion.js");
		$include["dots"] 			  = $dots;
		$variables["dots"] 			  = $dots;
		$variables["active"] 		  = "promotion";
		$variables["footer_visibility"] = "";
		$variables["types"] 			= $this->readPromotion->readTypes();
		$this->smarty->view("base/header.tpl",$include);
		$this->smarty->view("base/menuHorizontal.tpl",$variables);
		$this->smarty->view("base/menuVertical.tpl",$variables);
		$this->smarty->view("promotion.tpl",$variables);
		$this->smarty->view("base/footer.tpl");
		die;
	}
	public function loadTable(){
		if($this->input->is_ajax_request()){
			$this->load->model('Read_promotion_model','readPromotion');
			$variables["promotions"] = $this->readPromotion->readAll();
			$this->smarty->view("promotion_table.tpl",$variables);
			die;
		}
	}

}