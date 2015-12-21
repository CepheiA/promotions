<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoadViewHome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$dots = getDotsFromRoot($this->uri->total_segments());
		
		$include["body_class"] 		  = "hold-transition skin-blue sidebar-mini";
		
		$include["include_js"] 		  =	array("home.js");
		$include["dots"] 			  = $dots;
		$variables["dots"] 			  = $dots;
		$variables["active"] 		  = "home";
		$variables["footer_visibility"] = "";
		$this->smarty->view("base/header.tpl",$include);
		$this->smarty->view("base/menuHorizontal.tpl",$variables);
		$this->smarty->view("base/menuVertical.tpl",$variables);
		$this->smarty->view("home.tpl",$variables);
		$this->smarty->view("base/footer.tpl");
		die;
	}

}