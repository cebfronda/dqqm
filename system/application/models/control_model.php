<?php
class Control_model extends model {

	function control_model(){
            parent::model();
            $this->load->database();
            $this->load->dbforge();
	}
	
	function PasswordHash($value, $revert = false){
		if($revert){
			return base64_decode(urldecode($value));		
		}else{
			return md5($value);
		}
	}
	
	function user($username = null){
		$this->db->where('username',  $username);
		$this->db->from('dq_users');
		return $this->db->get()->row();  
	}
	
	function tokens($token = null){
		$this->db->where('token',  $token);
		$this->db->from('users');
		return $this->db->get()->row();  
	}
	

}
?>
