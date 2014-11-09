<?php

class Admin extends Controller {
	function Admin()
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
		$data['page_view'] = "admin_home";
		$data['page_side'] = "side/account_info";
		$data['home'] = "active";
		$this->load->view('template_main', $data); 
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */