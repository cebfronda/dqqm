<?php

class Reports extends Controller {

	function Reports()
	{
		parent::Controller();
		session_start();
		//helpers
		$this->load->helper('url');
		
		//Models
		$this->load->model('crm_model');
		$this->crm_model->check_login();
	}
	
	function index(){
		$data['page_view'] = "soon";
		$data['reports'] = "active";
		$this->load->view('template_main', $data); 
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */