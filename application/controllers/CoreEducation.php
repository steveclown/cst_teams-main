<?php
	Class CoreEducation extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreEducation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreEducation']		= $this->CoreEducation_model->getCoreEducation();
			$data['Main_view']['CoreEducationtype']	= $this->configuration->EducationType();
			$data['Main_view']['content']			= 'CoreEducation/listCoreEducation_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreEducation(){
			$data['Main_view']['content']				= 'CoreEducation/formaddCoreEducation_view';
			$data['Main_view']['CoreEducationtype']		= $this->configuration->EducationType();
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreEducation(){
			$data = array(
				'education_code' 			=> $this->input->post('education_code',true),
				'education_name' 			=> $this->input->post('education_name',true),
				'education_type' 			=> $this->input->post('education_type',true),
				'education_remark' 			=> $this->input->post('education_remark',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('education_code', 'Education Code', 'required');
			$this->form_validation->set_rules('education_name', 'Education Name', 'required');
			$this->form_validation->set_rules('education_name', 'Education Type', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreEducation_model->saveNewCoreEducation($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreEducation.processAddlanguage',$auth['username'],'Add New CoreEducation');
					$msg = "<div class='alert alert-success'>                
								Add Data Education Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreEducation');
					redirect('CoreEducation/addCoreEducation');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Education UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreEducation/addCoreEducation');
				}
			}else{
				$this->session->set_userdata('addCoreEducation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreEducation/addCoreEducation');
			}
		}
		
		function editCoreEducation(){
			$data['Main_view']['CoreEducation']		= $this->CoreEducation_model->getCoreEducation_Detail($this->uri->segment(3));
			$data['Main_view']['content']			= 'CoreEducation/formeditCoreEducation_view';
			$data['Main_view']['CoreEducationtype']	= $this->configuration->EducationType();
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreEducation(){
			
			$data = array(
				'education_id' 			=> $this->input->post('education_id',true),
				'education_code' 		=> $this->input->post('education_code',true),
				'education_name' 		=> $this->input->post('education_name',true),
				'education_type' 		=> $this->input->post('education_type',true),
				'education_remark' 		=> $this->input->post('education_remark',true),
				'data_state'			=> 0
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('education_code', 'Education Code', 'required');
			$this->form_validation->set_rules('education_name', 'Education Name', 'required');
			$this->form_validation->set_rules('education_name', 'Education Type', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreEducation_model->saveEditCoreEducation($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreEducation.Edit',$auth['username'],'Edit CoreEducation');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreEducation_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Education Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreEducation/editCoreEducation/'.$data['education_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Education UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreEducation/editCoreEducation/'.$data['education_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreEducation/editCoreEducation/'.$data['education_id']);
			}
		}
		
				
		function deleteCoreEducation(){
			if($this->CoreEducation_model->deleteCoreEducation($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreEducation.delete',$auth['username'],'Delete CoreEducation');
				$msg = "<div class='alert alert-success'>                
							Delete Data Education Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreEducation');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Education UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreEducation');
			}
		}
	}
?>