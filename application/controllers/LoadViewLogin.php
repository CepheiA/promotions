<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoadViewLogin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		
		$dots = getDotsFromRoot($this->uri->total_segments());
		
		$include["body_class"] 			= 	"hold-transition login-page";
		$variables["footer_visibility"] = 	"hidden";		
		$include["dots"] 				=	$dots;
		$include["include_js"] 			=	array("login.js");

		$this->smarty->view("base/header.tpl",$include);
		$this->smarty->view("login.tpl",$variables);
		$this->smarty->view("base/footer.tpl",$variables);
		die;
	}

}