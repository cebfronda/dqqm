<?php

class Users extends Controller {

	function Users()
	{
		parent::Controller();
		session_start();
		//helpers
		$this->load->helper('url');
		
		//Models
		$this->load->model('crm_model');
		$this->crm_model->check_login();
		$this->load->model("user_model");
	}
	
	function index(){
		$data['page_side'] = "side/users";
		$data['page_view'] = "users_home";
		$data['users'] = "active";
		$data['lists'] = $this->user_model->lists();
		$this->load->view('template_main', $data); 
	}
	
	function user($user_id = 0){
		$data['user'] = $this->user_model->details($user_id);
		$data['user_status'] = $this->user_model->user_status();
		$data['page_side'] = "side/users";
		$data['page_view'] = "user";
		$data['users'] = "active";
		$data['user_id'] = $user_id;
		$this->load->view('template_main', $data); 
	}
	
	function save($user_id = 0){
		$data = $_POST['users'];
		echo $this->user_model->save($user_id, $data);
	}
	
	function user_delete($user_id){
		$this->crm_model->delete("dq_users", array("user_id"=>$user_id));
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */