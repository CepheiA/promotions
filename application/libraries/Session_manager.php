<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session_manager {
	function validaSesionMaintainer($rolesPermitidos = array('administrador','asesor')){
		$objetoCI =& get_instance();
		$userType=$objetoCI->session->userdata('tipoUsuario');
		$boolRolPermitido = FALSE;
		foreach ($rolesPermitidos as $rol) {
			if($rol == $userType){
				$boolRolPermitido = TRUE;
			}
		}
		if($boolRolPermitido === FALSE){
			$this->closeSesionMaintainer();	
		}
		if($userType!=''){
			if($userType===ROLADMINISTRADOR || $userType===ROLASESOR){
				$userId=$objetoCI->session->userdata('idUsuarioSO');
				$userType=$objetoCI->session->userdata('idTipoSO');
				$userIsMaintainer=$objetoCI->session->userdata('isMaintainer');
				$userNombre=$objetoCI->session->userdata('nombreSO');
				$userImagen=$objetoCI->session->userdata('imagenSO');
				$userUltimaSesion=$objetoCI->session->userdata('ultimaSessionSO');
				$userLog=$objetoCI->session->userdata('logged_in');
			}
			if(!($userLog==TRUE 
				and isset($userType) and $userType<>''
				and isset($userNombre) and $userNombre<>''
				and isset($userId) and is_numeric($userId)
				and isset($userImagen)
				)){
				$this->closeSesionMaintainer();	
				}else{
					return true;
				}
		}else{
			$this->closeSesionMaintainer();
		}	
    }
    function validaSesionTeacher($rolesPermitidos = array('administrador','asesor')){
		$objetoCI =& get_instance();
		$userType=$objetoCI->session->userdata('tipoUsuario');
		$boolRolPermitido = FALSE;
		foreach ($rolesPermitidos as $rol) {
			if($rol == $userType){
				$boolRolPermitido = TRUE;
			}
		}
		if($boolRolPermitido === FALSE){
			$this->closeSesionMaintainer();	
		}
		if($userType!=''){
			if($userType===ROLADMINISTRADOR || $userType===ROLASESOR){
				$userId=$objetoCI->session->userdata('idUsuarioSO');
				$userType=$objetoCI->session->userdata('idTipoSO');
				$userIsMaintainer=$objetoCI->session->userdata('isMaintainer');
				$userNombre=$objetoCI->session->userdata('nombreSO');
				$userImagen=$objetoCI->session->userdata('imagenSO');
				$userUltimaSesion=$objetoCI->session->userdata('ultimaSessionSO');
				$userLog=$objetoCI->session->userdata('logged_in');
			}
			if(!($userLog==TRUE 
				and isset($userType) and $userType<>''
				and isset($userNombre) and $userNombre<>''
				and isset($userId) and is_numeric($userId)
				and isset($userImagen)
				)){
				$this->closeSesionMaintainer();	
				}else{
					return true;
				}
		}else{
			$this->closeSesionMaintainer();
		}	
    }
	function closeSesionMaintainer(){
		$objetoCI =& get_instance();
		$userType=$objetoCI->session->userdata('idTipoSO');
		if($userType!==''){
			$objetoCI->session->sess_destroy();
		}
		$dots = getDotsFromRoot($objetoCI->uri->total_segments());
		$objetoCI->load->helper('url');
		header("Location: ".$dots."ingreso/mantenedores/");
	} 	
}
/*
END  SESSION_MANAGER CLASS
*/