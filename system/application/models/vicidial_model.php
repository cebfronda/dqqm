<?php
class Vicidial_model extends model {
	public $account = "dq_account_verifications";
	public $survey = "dq_survey_questions";
	public $status = "dq_survey_question_status";
	public $options = "dq_survey_question_options";
	public $optionlink = "dq_option_link";
	public $logic = "dq_logic";
	public $main = "main";
	public $basic = "basic";
	public $customer = "dq_customers";

	function Vicidial_model(){
            parent::model();
            $this->load->database();
            $this->load->dbforge();
	}
	
	function get_account_verification_scripts(){
		$this->db->from($this->account);
		return $this->db->get()->result();
	}
	
	function get_logic_scripts(){
		$this->db->from($this->survey);
		$this->db->where("type", $this->basic);
		$this->db->order_by('order', 'ASC');
		return $this->db->get()->result();
	}
	
	function get_main_scripts(){
		$this->db->from($this->survey);
		$this->db->where("type", $this->main);
		$this->db->order_by('order', 'ASC');
		return $this->db->get()->result();
	}
	
	function get_survey_options($id = 0){
		$this->db->from($this->options);
		$this->db->where('survey_question_id', $id);
		return $this->db->get()->result();	
	}
	
	
	function get_agent_info($id = 0){
		$vicidial = $this->load->database('vicidial', TRUE);
		$vicidial->from('vicidial_agent_log');
		$vicidial->limit('10');
		return $this->db->get()->result();
	}
	
	
}