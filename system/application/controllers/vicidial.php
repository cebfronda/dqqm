<?php

class Vicidial extends Controller {

	function Vicidial()
	{
		parent::Controller();
		session_start();
		//helpers
		$this->load->helper('url');
		
		//Models
		$this->load->model('vicidial_model');
	}
	
	function index(){
		$data = array();
		$this->load->view('vicidial', $data); 	
	}
	
	function intro(){
		$data = array();
		$this->load->view('vicidial/agent', $data); 
	}
	
	function intro2(){
		$data = array();
		$this->load->view('vicidial/agent2', $data); 
	}
	
	function close(){
		$data = array();
		$this->load->view('vicidial/agent3', $data); 
	}
	
	function account_verification($id = 0){
		$data['scripts'] = $this->vicidial_model->get_account_verification_scripts();
		$this->load->view("vicidial/account_verification", $data);
	}
	
	function logic($id = 0){
		$data['scripts'] = $this->vicidial_model->get_logic_scripts();
		$this->load->view("vicidial/logic", $data);
	}
	
	function survey($id = 0){
		if($_POST){
			$data['userdata'] = $_SESSION['userdata'] = $_POST;
		}
		$data['scripts'] = $this->vicidial_model->get_main_scripts();
		$this->load->view("vicidial/survey", $data);
	}
	
	function test(){
		echo "<pre>";
		print_r($this->vicidial_model->get_agent_info());
	}
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */