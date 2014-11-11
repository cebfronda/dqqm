<?php
class qm_model extends model {
	public $account_verification = "dq_account_verifications";
	public $survey = "dq_survey_questions";
	public $status = "dq_survey_question_status";
	public $main = "main";
	public $basic = "basic";
	public $customer = "dq_customers";

	function qm_model(){
            parent::model();
            $this->load->database();
            $this->load->dbforge();
	}
	
	function account_verification_lists(){
		$this->db->from($this->account_verification);
		$this->db->order_by('reference', 'ASC');
		return $this->db->get()->result();
	}
	
	function survey_question_status(){
		$this->db->from($this->status);
		$this->db->order_by('status_id', 'ASC');
		return $this->db->get()->result();
	}
	
	function main_survey_lists(){
		$this->db->from($this->survey);
		$this->db->where("type", $this->main);
		$this->db->where("dependent", 0);
		$this->db->order_by('qcode', 'ASC');
		return $this->db->get()->result();
	}
	
	function get_survey_dependents($id = null){
		$this->db->from($this->survey);
		$this->db->where("type", $this->main);
		$this->db->where("dependent", $id);
		$this->db->where("dependent !=", 0);
		return $this->db->get()->result();
	}
	
	function delete_dependents($id = 0){
		$this->db->where("dependent", $id);
		$this->db->delete($this->survey); 
	}
	
	function basic_survey_lists(){
		$this->db->from($this->survey);
		$this->db->where("type", $this->basic);
		$this->db->order_by('qcode', 'ASC');
		return $this->db->get()->result();
	}
	
	function account_verification($id = 0){
		$this->db->from($this->account_verification);
		$this->db->where("account_verification_id", $id);
		return $this->db->get()->row(); 
	}
	
	function survey_question($id = 0){
		$this->db->from($this->survey);
		$this->db->where("survey_question_id", $id);
		return $this->db->get()->row(); 
	}
	
	function customer_column(){
		$cols = $this->db->query("SHOW COLUMNS FROM $this->customer")->result();
		$columns = array();
		foreach($cols as $vals){
			if($vals->Field != "customer_id" && $vals->Field != "modified" && $vals->Field != "created"){
				$columns[] = $vals->Field;	
			}
		}
		return $columns;
	}
	
	function save_av($id = 0, $data = null){
		if(empty($id)){
			$this->db->insert($this->account_verification, $data);
			return "Account Verification script successfully created";
		}else{
			$this->db->where('account_verification_id', $id);
			$this->db->update($this->account_verification, $data);
			return "Account Verification script successfully updated";
		}
	}
	
	function new_save_survey($data = null){
		$this->db->insert($this->survey, $data);
		return mysql_insert_id();
	}
	
	function save_survey($id = 0, $data = null){
		if(empty($id)){
			$this->new_save_survey($data);
			return "Survey Question successfully created";
		}else{
			$this->db->where('survey_question_id', $id);
			$this->db->update($this->survey, $data);
			return "Survey Question successfully updated";
		}
	}
	
	function delete_survey($id = 0){
		$this->db->where("survey_question_id", $id);
		$this->db->delete($this->survey);
		$this->delete_dependents($id);
	}
}