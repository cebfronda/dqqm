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
		$data['options'] = $this->qm_model->get_survey_options($id);
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
		$data['options'] = $this->qm_model->get_survey_options($id);
		$data['logic'] = $this->qm_model->basic_survey_lists();
		$data['id'] = $id;
		$data['type'] = "main";
		$this->load->view('template_main', $data); 
	}
	
	function qm_child($id = 0){
		$data['survey'] = $this->qm_model->survey_question($id);
		$data['options'] = $this->qm_model->get_survey_options($id);
		$data['status'] = $this->qm_model->survey_question_status();
		$data['id'] = $id;
		$data['type'] = "main";
		$data['form'] = rand(10000000000, 99999999999);
		$this->load->view('questionnaires_child', $data);
	}
	
	function save($type=null, $id = 0){
		//echo "<pre>";
		//exit(print_r($_POST));
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
			$id = $this->qm_model->save_survey($id, $_POST['survey']);
			$options = array();
			$this->qm_model->delete_survey_option($id);
			if(!empty($_POST['option'])){
				foreach($_POST['option'] as $key => $val){
					$data = array();
					$data['survey_question_id'] = $id;
					$data['option'] = $val['option'];
					if(!empty($val['positive'])){
						$data['positive'] = "t";	
					}
					$this->qm_model->move($data);
				}	
			}
		}else if($type == "main"){
			$_POST['survey']['effectivity_date'] = date("Y-m-d",strtotime($_POST['survey']['effectivity_date']));
			if(empty($id)){
				$id = $this->qm_model->new_save_survey($_POST['survey']);
				$options = array();
				if(!empty($_POST['option'])){
					foreach($_POST['option'] as $key => $val){
						$data = array();
						$data['survey_question_id'] = $id;
						$data['option'] = $val['option'];
						if(!empty($val['positive'])){
							$data['positive'] = "t";	
						}
						$this->qm_model->move($data);
					}	
				}
				//Saving Logic question
				if(!empty($_POST['logic'])){
					$this->qm_model->delete_logic_conditions($id);
					foreach($_POST['logic'] as $lid => $val ){
						$datalogic = array();
						$datalogic['logic_id'] = $lid;
						$datalogic['survey_question_id'] = $id;
						$datalogic['inclusion'] = json_encode($val);
						$this->qm_model->save_logic($datalogic);
					}
				}
				//Saving Child
				if(!empty($_POST['child'])){
					foreach($_POST['child'] as $key => $val){
						$childdata = array();
						$childoptions = array();
						foreach($val as $k => $v){				
							if(is_numeric($k)){
								$c = array();
								$c['option'] = $v['option'];
								if(!empty($v['positive'])){
									$c['positive'] = "t";	
								}
								array_push($childoptions, $c);
									
							}else{
								$childdata[$k] = $v;	
							}
						}
						
						$childdata['dependent'] = $id;
						$childdata['effectivity_date'] = date("Y-m-d",strtotime($childdata['effectivity_date']));
						$cid = $this->qm_model->new_save_survey($childdata);
						foreach($childoptions as $ckey => $cval){
							
							$cdata = array();
							$cdata['survey_question_id'] = $cid;
							$cdata['option'] = $cval['option'];
							if(!empty($cval['positive'])){
								$cdata['positive'] = "t";	
							}
							$this->qm_model->move($cdata);
						}	
					}
				}
				echo "Survey question successfully created.";
			}else{
				$options = array();
				$this->qm_model->save_survey($id, $_POST['survey']);
				if(!empty($_POST['option'])){
					$this->qm_model->delete_survey_option($id);
					foreach($_POST['option'] as $key => $val){
						$data = array();
						$data['survey_question_id'] = $id;
						$data['option'] = $val['option'];
						if(!empty($val['positive'])){
							$data['positive'] = "t";	
						}
						$this->qm_model->move($data);
					}	
				}
				//Saving Logic question
				if(!empty($_POST['logic'])){
					$this->qm_model->delete_logic_conditions($id);
					foreach($_POST['logic'] as $lid => $val ){
						$datalogic = array();
						$datalogic['logic_id'] = $lid;
						$datalogic['survey_question_id'] = $id;
						$datalogic['inclusion'] = json_encode($val);
						$this->qm_model->save_logic($datalogic);
					}
				}
				//Saving Child
				$this->qm_model->delete_dependents($id);
				if(!empty($_POST['child'])){
					foreach($_POST['child'] as $key => $val){
						$childdata = array();
						$childoptions = array();
						foreach($val as $k => $v){				
							if(is_numeric($k)){
								$c = array();
								$c['option'] = $v['option'];
								if(!empty($v['positive'])){
									$c['positive'] = "t";	
								}
								array_push($childoptions, $c);
									
							}else{
								$childdata[$k] = $v;	
							}
						}
						
						$childdata['dependent'] = $id;
						$childdata['effectivity_date'] = date("Y-m-d",strtotime($childdata['effectivity_date']));
						$cid = $this->qm_model->new_save_survey($childdata);
						foreach($childoptions as $ckey => $cval){

							$cdata = array();
							$cdata['survey_question_id'] = $cid;
							$cdata['option'] = $cval['option'];
							if(!empty($cval['positive'])){
								$cdata['positive'] = "t";	
							}
							$this->qm_model->move($cdata);
						}	
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
	
	function move_options(){
		$this->qm_model->move_survey_options();	
	}
	
	function view_survey($id = 0){
		if(!empty($id)){
			$data = $this->qm_model->survey_question($id);
			$opt = $this->qm_model->get_survey_options($id);
			$options = array();
			foreach($opt as $d){
				$options[] = $d->option;	
			}
			echo "<div style = 'float:left; width: 50%'><b>QUESTION : </b><br>$data->question</div><div style = 'float:left; width: 50%'> <b>RESPONSES : </b><br>".implode("\n",$options)."</div>";
		}
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */