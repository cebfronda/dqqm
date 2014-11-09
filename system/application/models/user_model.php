<?php
class User_model extends model {
	public $table = "dq_users";
	public $user_status = "dq_user_status";

	function User_model(){
            parent::model();
            $this->load->database();
            $this->load->dbforge();
	}
	
	function lists(){
		$this->db->from($this->table);
		$this->db->join("dq_user_status", "$this->table.user_status_id = $this->user_status.user_status_id", "left");
		$this->db->order_by('last_name', 'ASC');
		return $this->db->get()->result();
	}
	
	function details($user_id = 0){
		$this->db->from($this->table);
		$this->db->where("user_id", $user_id);
		return $this->db->get()->row(); 
	}
	
	function user_status(){
		$this->db->from($this->user_status);
		return $this->db->get()->result();
	}
	
	function save($user_id = 0, $data = null){
		if(empty($user_id)){
			$this->db->insert($this->table, $data);
			return "User successfully created";
		}else{
			$this->db->where('user_id', $user_id);
			$this->db->update($this->table, $data);
			return "User successfully updated";
		}
	}
}