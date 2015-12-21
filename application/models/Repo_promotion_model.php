<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Repo_promotion_model extends CI_Model {
	private $table = "promotions";
	private $_id;
	private $_name;
	private $_type;
	private $_description;
	private $_startDate;
	private $_endDate;
	private $_status;


	private $ID 		= 	"ID_PROMOTION";
	private $NAME 		= 	"NAME";
	private $TYPE 		= 	"TYPE";
	private $DESCRIPTION= 	"DESCRIPTION";
	private $STARTDATE 	= 	"STARTDATE";
	private $ENDDATE 	= 	"ENDDATE";
	private $STATUS 	= 	"STATUS";

	public function __construct()
	{
		parent::__construct();
	}

	public function insert(){
		$bool			=	$this->db->insert($this->table, $this->getDataArray());
		$this->_id 		= $this->db->insert_id();
		return $bool;
	}

	public function update(){
		$this->db->where($this->ID, $this->_id,TRUE);
		$bool= $this->db->update($this->table, $this->getDataArray());
		return $bool;
	}

	public function delete(){
		$this->db->where($this->ID, $this->_id,TRUE);
		$bool =	$this->db->update($this->table, $this->getDataArrayDelete());
		return $bool;
	}

	public function deleteForEver(){
		$this->db->where($this->ID, $this->_id,TRUE);
		$bool = $this->db->delete($this->table);
		return $bool;
	}
	
	private function getDataArray(){
		return array(
			$this->ID  			=> $this->_id,
			$this->NAME  		=> $this->_name,
			$this->TYPE  		=> $this->_type,
			$this->DESCRIPTION  => $this->_description,
			$this->STARTDATE  	=> $this->_startDate,
			$this->ENDDATE  	=> $this->_endDate,
			$this->STATUS  		=> $this->_status
			);
	}
	private function getDataArrayDelete(){
		return array(
			$this->STATUS 	 => $this->_status
			);
	}

	public function getId(){
		return $this->_id;
	}
	public function getName(){
		return $this->_name;
	}
	public function getType(){
		return $this->_type;
	}
	public function getDescription(){
		return $this->_description;
	}
	public function getStartDate(){
		return $this->_startDate;
	}
	public function getEndDate(){
		return $this->_endDate;
	}
	public function getStatus(){
		return $this->_status;
	}

	public function setId($id){
		$this->_id = $id;
	}
	public function setName($name){
		$this->_name = $name;
	}
	public function setType($type){
		$this->_type = $type;
	}
	public function setDescription($description){
		$this->_description = $description;
	}
	public function setStartDate($startDate){
		$this->_startDate = $startDate;
	}
	public function setEndDate($endDate){
		$this->_endDate = $endDate;
	}
	public function setStatus($status){
		$this->_status = $status;
	}
}
/* End of file Repo_promotion_model.model.php */
/* Location: ./application/models/Repo_promotion_model.model.php */