<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

Class Read_promotion_model extends CI_Model {
	private $_table = "promotions";

	public function __construct()
	{
		parent::__construct();
	}

	public function readAll(){
		$this->db->select("*");
		$this->db->from($this->_table);
		$this->db->where("STATUS",1);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function readTypes(){
		return array('MONEY' => 'Dinero','SPECIES' => 'Especies');
	}
	public function checkName($name){
		
	}

}
/* End of file Repo_promotion_model.model.php */
/* Location: ./application/models/Repo_promotion_model.model.php */