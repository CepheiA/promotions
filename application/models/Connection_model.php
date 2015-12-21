<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Connection_model extends CI_Model {
	private $nombreBD;
	function __construct()
	{
        // Call the Model constructor
		parent::__construct();

	}
	function getDbObject($nameDB){
		$this->nombreBD=$nameDB;
		
		include(APPPATH.'config/database.php');

		if(isCloudServer()) {
			$db['servidorDedicadoColegio']['database'] =$this->nombreBD;
			return $this->load->database($db['servidorDedicadoColegio'], TRUE);
		}else{
			$db['pcLocalColegio']['database'] = $this->nombreBD;
			return $this->load->database($db['pcLocalColegio'], TRUE);	
		}
	}
	function getDBColegio(){
		return $this->nombreBD;
	}
	function getDBGeneral(){
		include(APPPATH.'config/database.php');
		if (isCloudServer()) {
			return $db['servidorDedicadoGeneral']['database'];
		}else{
			return $db['pcLocalGeneral']['database'];
		}
	}
	

}