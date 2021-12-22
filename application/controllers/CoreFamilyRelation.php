<?php
	Class CoreFamilyRelation extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreFamilyRelation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreFamilyRelation']	= $this->CoreFamilyRelation_model->getCoreFamilyRelation();
			$data['Main_view']['content']				= 'CoreFamilyRelation/listCoreFamilyRelation_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreFamilyRelation(){
			$data['Main_view']['content']			= 'CoreFamilyRelation/formaddCoreFamilyRelation_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreFamilyRelation(){
			$data = array(
				'family_relation_code' 				=> $this->input->post('family_relation_code',true),
				'family_relation_name' 				=> $this->input->post('family_relation_name',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('family_relation_code', 'Family Relation Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('family_relation_name', 'Family Relation Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreFamilyRelation_model->saveNewCoreFamilyRelation($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreFamilyRelation.processaddCoreFamilyRelation',$auth['username'],'Add New Family Relation');
					$msg = "<div class='alert alert-success'>                
								Add Data Family Relation Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreFamilyRelation');
					redirect('CoreFamilyRelation/addCoreFamilyRelation');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Family Relation UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreFamilyRelation',$data);
					redirect('CoreFamilyRelation/addCoreFamilyRelation');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreFamilyRelation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreFamilyRelation/addCoreFamilyRelation');
			}
		}
		
		function editCoreFamilyRelation(){
			$data['Main_view']['CoreFamilyRelation']		= $this->CoreFamilyRelation_model->getCoreFamilyRelation_Detail($this->uri->segment(3));
			$data['Main_view']['content']					= 'CoreFamilyRelation/formeditCoreFamilyRelation_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreFamilyRelation(){
			
			$data = array(
				'family_relation_id' 		=> $this->input->post('family_relation_id',true),
				'family_relation_code' 		=> $this->input->post('family_relation_code',true),
				'family_relation_name' 		=> $this->input->post('family_relation_name',true),
				'data_state'				=> 0
			);
		
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('family_relation_code', 'Family Relation Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('family_relation_name', 'Family Relation Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreFamilyRelation_model->saveEditCoreFamilyRelation($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreFamilyRelation.Edit',$auth['username'],'Edit Applicant Status');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['family_relation_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Family Relation Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreFamilyRelation/editCoreFamilyRelation/'.$data['family_relation_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Family Relation UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreFamilyRelation/editCoreFamilyRelation/'.$data['family_relation_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreFamilyRelation/editCoreFamilyRelation/'.$data['family_relation_id']);
			}
		}
		
		function deleteCoreFamilyRelation(){
			if($this->CoreFamilyRelation_model->deleteCoreFamilyRelation($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreFamilyRelation.delete',$auth['username'],'Delete Applicant Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Family Relation Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreFamilyRelation');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Family Relation UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreFamilyRelation');
			}
		}
	}
?>