<?php

class Questionnaires extends Controller {

	function Questionnaires()
	{
		parent::Controller();
		session_start();
		//helpers
		$this->load->helper('url');
		
		//Models
		$this->load->model('crm_model');
		$this->load->model('qm_model');
		$this->crm_model->check_login();
	}
	
	function index(){
		$this->av_lists();	
	}
	
	function av_lists(){
		$data['page_side'] = "side/questionnaires";
		$data['page_view'] = "questionnaires_av_lists";
		$data['questionnaires'] = "active";
		$data['lists'] = $this->qm_model->account_verification_lists();
		$this->load->view('template_main', $data); 
	}
	
	function av($id = 0){
		$data['page_side'] = "side/questionnaires";
		$data['page_view'] = "questionnaires_av";
		$data['questionnaires'] = "active";
		$data['av'] = $this->qm_model->account_verification($id);
		$data['reference'] = $this->qm_model->customer_column();
		$data['id'] = $id;
		$this->load->view('template_main', $data); 	
	}
	
	function qm_basic_lists(){
		$data['page_side'] = "side/questionnaires";
		$data['page_view'] = "questionnaires_basic_lists";
		$data['questionnaires'] = "active";
		$data['lists'] = $this->qm_model->basic_survey_lists();
		$this->load->view('template_main', $data); 
	}
	
	function qm_basic($id = 0){
		$data['page_side'] = "side/questionnaires";
		$data['page_view'] = "questionnaires_basic";
		$data['questionnaires'] = "active";
		$data['survey'] = $this->qm_model->survey_question($id);
		$data['id'] = $id;
		$data['type'] = "basic";
		$this->load->view('template_main', $data); 
	}
	
	function qm_main_lists(){
		$data['page_side'] = "side/questionnaires";
		$data['page_view'] = "Questionnaires_main_lists";
		$data['questionnaires'] = "active";
		$data['lists'] = $this->qm_model->main_survey_lists();
		$this->load->view('template_main', $data); 
	}
	
	function qm_main($id = 0){
		$data['page_side'] = "side/questionnaires";
		$data['page_view'] = "questionnaires_main";
		$data['questionnaires'] = "active";
		$data['survey'] = $this->qm_model->survey_question($id);
		$data['dependents'] = $this->qm_model->get_survey_dependents($id);
		$data['status'] = $this->qm_model->survey_question_status();
		$data['id'] = $id;
		$data['type'] = "main";
		$this->load->view('template_main', $data); 
	}
	
	function qm_child($id = 0){
		$data['survey'] = $this->qm_model->survey_question($id);
		$data['id'] = $id;
		$data['type'] = "main";
		$data['form'] = rand(10000000000, 99999999999);
		$this->load->view('questionnaires_child', $data);
	}
	
	function save($type=null, $id = 0){
		if($type == "av"){
			echo $this->qm_model->save_av($id, $_POST['av']);	
		}else if($type == "basic"){
			$options = array();
			if(!empty($_POST['option'])){
				foreach($_POST['option'] as $key => $val){
					array_push($options, implode($val));
				}	
			}
			$_POST['survey']['options'] = json_encode($options);
			echo $this->qm_model->save_survey($id, $_POST['survey']);	
		}else if($type == "main"){
			$_POST['survey']['effectivity_date'] = date("Y-m-d",strtotime($_POST['survey']['effectivity_date']));
			if(empty($id)){
				$options = array();
				if(!empty($_POST['option'])){
					foreach($_POST['option'] as $key => $val){
						array_push($options, implode($val));
					}	
				}
				$_POST['survey']['options'] = json_encode($options);
				$id = $this->qm_model->new_save_survey($_POST['survey']);
				if(!empty($_POST['child'])){
					foreach($_POST['child'] as $key => $val){
						$childdata = array();
						$childoptions = array();
						foreach($val as $k => $v){				
							if(is_numeric($k)){
								array_push($childoptions, implode($v));
									
							}else{
								$childdata[$k] = $v;	
							}
						}
						$childdata['options'] = json_encode($childoptions);
						$childdata['dependent'] = $id;
						$this->qm_model->new_save_survey($childdata);
					}
				}
				echo "Survey question successfully created.";
			}else{
				$options = array();
				if(!empty($_POST['option'])){
					foreach($_POST['option'] as $key => $val){
						array_push($options, implode($val));
					}	
				}
				$_POST['survey']['options'] = json_encode($options);
				$this->qm_model->save_survey($id, $_POST['survey']);
				$this->qm_model->delete_dependents($id);
				if(!empty($_POST['child'])){
					foreach($_POST['child'] as $key => $val){
						$childdata = array();
						$childoptions = array();
						foreach($val as $k => $v){				
							if(is_numeric($k)){
								array_push($childoptions, implode($v));
									
							}else{
								$childdata[$k] = $v;	
							}
						}
						$childdata['options'] = json_encode($childoptions);
						$childdata['dependent'] = $id;
						$this->qm_model->new_save_survey($childdata);
					}
				}
				echo "Survey question successfully updated";
				
			}
		}
			
	}
	
	function qm_basic_delete($id = 0){
		$this->qm_model->delete_survey($id);		
	}
	
	function qm_main_delete($id = 0){
		$this->qm_model->delete_survey($id);		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */