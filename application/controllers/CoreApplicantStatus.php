<?php
	Class CoreApplicantStatus extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreApplicantStatus_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			$this->load->helper('url'); 
		}
		
		public function index(){
			$data['Main_view']['CoreApplicantStatus']		= $this->CoreApplicantStatus_model->getCoreApplicantStatus();
			$data['Main_view']['content']					= 'CoreApplicantStatus/listCoreApplicantStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreApplicantStatus-'.$unique['unique']);			
			redirect('CoreApplicantStatus/addCoreApplicantStatus');
		}
		function addCoreApplicantStatus(){
			$data['Main_view']['content']					= 'CoreApplicantStatus/formaddCoreApplicantStatus_view';
			$this->load->view('MainPage_view',$data);
			
		}
		
		function processAddCoreApplicantStatus(){
			$data = array(
				'applicant_status_code' 		=> $this->input->post('applicant_status_code',true),
				'applicant_status_name' 		=> $this->input->post('applicant_status_name',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('applicant_status_code', 'Applicant Status Code', 'required');
			$this->form_validation->set_rules('applicant_status_name', 'Applicant Status Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreApplicantStatus_model->saveNewCoreApplicantStatus($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreApplicantStatus.processaddCoreApplicantStatus',$auth['username'],'Add New Applicant Status');
					$msg = "<div class='alert alert-success'>                
								Add Data Applicant Status Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreApplicantStatus');
					redirect('CoreApplicantStatus/addCoreApplicantStatus');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Applicant Status UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreApplicantStatus',$data);
					redirect('CoreApplicantStatus/addCoreApplicantStatus');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreApplicantStatus',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreApplicantStatus/addCoreApplicantStatus');
			}
		}
		
		public function reset_edit(){
			$unique 				= $this->session->userdata('unique');
			$applicant_status_id 	= $this->uri->segment(3);
			
			$this->session->unset_userdata('addCoreApplicantStatus-'.$unique['unique']);
			redirect('CoreApplicantStatus/editCoreApplicantStatus/'.$applicant_status_id);
		}

		function editCoreApplicantStatus(){
			$data['Main_view']['CoreApplicantStatus']		= $this->CoreApplicantStatus_model->getCoreApplicantStatus_Detail($this->uri->segment(3));
			$data['Main_view']['content']					= 'CoreApplicantStatus/formeditCoreApplicantStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreApplicantStatus(){
			
			$data = array(
				'applicant_status_id' 		=> $this->input->post('applicant_status_id',true),
				'applicant_status_code' 	=> $this->input->post('applicant_status_code',true),
				'applicant_status_name' 	=> $this->input->post('applicant_status_name',true),
				'data_state'				=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('applicant_status_code', 'Applicant Status Code', 'required');
			$this->form_validation->set_rules('applicant_status_name', 'Applicant Status Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreApplicantStatus_model->saveEditCoreApplicantStatus($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreApplicantStatus.Edit',$auth['username'],'Edit Applicant Status');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['applicant_status_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Applicant Status Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreApplicantStatus/editCoreApplicantStatus/'.$data['applicant_status_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Applicant Status UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreApplicantStatus/editCoreApplicantStatus/'.$data['applicant_status_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreApplicantStatus/editCoreApplicantStatus/'.$data['applicant_status_id']);
			}
		}
		
		function deleteCoreApplicantStatus(){
			if($this->CoreApplicantStatus_model->deleteCoreApplicantStatus($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreApplicantStatus.delete',$auth['username'],'Delete Applicant Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Applicant Status Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreApplicantStatus');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Applicant Status UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreApplicantStatus');
			}
		}
	}
?>