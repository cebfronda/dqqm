<?php
class qm_model extends model {
	public $account_verification = "dq_account_verifications";
	public $survey = "dq_survey_questions";
	public $status = "dq_survey_question_status";
	public $options = "dq_survey_question_options";
	public $optionlink = "dq_option_link";
	public $logic = "dq_logic";
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
		$this->db->join($this->status,"$this->status.status_id = $this->survey.status_id", "LEFT");
		$this->db->where("type", $this->main);
		$this->db->order_by('order', 'ASC');
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
		$dep = $this->get_survey_dependents($id);
		foreach($dep as $d){
			$this->delete_survey_option($d->survey_question_id);	
		}
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
	
	function get_logic_questions_selection($logic_id = 0, $survey_question_id=0){
		$this->db->select(array('inclusion'));
		$this->db->from($this->logic);
		$this->db->where("logic_id", $logic_id);
		$this->db->where("survey_question_id", $survey_question_id);
		return $this->db->get()->row(); ;	
	}
	
	function save_survey($id = 0, $data = null){
		if(empty($id)){
			$id = $this->new_save_survey($data);
			//echo  "Survey Question successfully created";
			return $id;
		}else{
			$this->db->where('survey_question_id', $id);
			$this->db->update($this->survey, $data);
			//echo "Survey Question successfully updated";
			return $id;
		}
	}
	
	function delete_survey($id = 0){
		$this->db->where("survey_question_id", $id);
		$this->db->delete($this->survey);
		$this->delete_dependents($id);
	}
	
	function get_survey_options($id = 0){
		$this->db->from($this->options);
		$this->db->where('survey_question_id', $id);
		return $this->db->get()->result();	
	}
	
	function move($data){
		$this->db->insert($this->options, $data);	
	}
	
	function save_logic($data = ""){
		$this->db->insert($this->logic, $data);	
	}
	
	function delete_option_link($data){
		if(!empty($data)){
			foreach($data as $f => $val){
				$this->db->where($f, $val);	
			}
			$this->db->delete($this->optionlink);
		}
	}
	
	function save_option_link($data = ""){
		$this->delete_option_link($data);
		$this->db->insert($this->optionlink, $data);	
	}
	
	function get_option_link($id =0){
		$this->db->from($this->optionlink);
		$this->db->where('link', $id);
		return $this->db->get()->result();
	}
	
	function delete_survey_option($id = 0){
		$this->db->where("survey_question_id", $id);
		$this->db->delete($this->options);
	}
	
	function delete_logic_conditions($id){
		$this->db->where("survey_question_id", $id);
		$this->db->delete($this->logic);
	}
	
	function move_survey_options(){
		$basic = $this->basic_survey_lists();
		if(!empty($basic)){
			foreach($basic as $s){
				$data = array();
				$data['survey_question_id'] = $s->survey_question_id;
				$options = json_decode($s->options);
				if(!empty($options)){
					foreach($options as $o){
						$positive = 'f';
						if(strpos($o,'+') !== false){
						    $positive = 't';
						}
						$data['option'] = str_replace("+", "", $o);
						$data['positive'] = $positive;
						$this->move($data);
					}
				}
			}
		}
		$main = $this->main_survey_lists();
		if(!empty($main)){
			foreach($main as $s){
				$data = array();
				$data['survey_question_id'] = $s->survey_question_id;
				$options = json_decode($s->options);
				if(!empty($options)){
					foreach($options as $o){
						$positive = 'f';
						if(strpos($o,'+') !== false){
						    $positive = 't';
						}
						$data['option'] = str_replace("+", "", $o);
						$data['positive'] = $positive;
						$this->move($data);
					}
				}
			}
		}
	}
}