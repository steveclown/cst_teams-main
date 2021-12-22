<?php
	Class CoreMedicalCoverage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreMedicalCoverage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreMedicalCoverage']		= $this->CoreMedicalCoverage_model->getCoreMedicalCoverage();
			$data['main_view']['content']					= 'CoreMedicalCoverage/listCoreMedicalCoverage_view';
			$this->load->view('mainpage_view',$data);

		}
		
		function addCoreMedicalCoverage(){
			$data['main_view']['content']			= 'CoreMedicalCoverage/formaddCoreMedicalCoverage_view';
			$data['main_view']['coregrade']			= create_double($this->CoreMedicalCoverage_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']			= create_double($this->CoreMedicalCoverage_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['corejobtitle']		= create_double($this->CoreMedicalCoverage_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreMedicalCoverage(){
			$data = array(
				'medical_coverage_code' 			=> $this->input->post('medical_coverage_code',true),
				'grade_id' 							=> $this->input->post('grade_id',true),
				'class_id' 							=> $this->input->post('class_id',true),
				'job_title_id' 						=> $this->input->post('job_title_id',true),
				'medical_coverage_name' 			=> $this->input->post('medical_coverage_name',true),
				'medical_coverage_ratio' 			=> $this->input->post('medical_coverage_ratio',true),
				'medical_coverage_amount' 			=> $this->input->post('medical_coverage_amount',true),
				'medical_coverage_remark' 			=> $this->input->post('medical_coverage_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('medical_coverage_code', 'Medical Coverage Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('medical_coverage_name', 'Medical Coverage Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade ID', 'required');
			$this->form_validation->set_rules('class_id', 'Class ID', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title ID', 'required');
			$this->form_validation->set_rules('medical_coverage_ratio', 'Medical Coverage Ratio', 'required|numeric');
			$this->form_validation->set_rules('medical_coverage_amount', 'Medical Coverage Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreMedicalCoverage_model->saveNewCoreMedicalCoverage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreMedicalCoverahe.processAddCoreMedicalCoverage',$auth['username'],'Add New Medical Coverage');
					$msg = "<div class='alert alert-success'>                
								Add Data Medical Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddMedicalCoverage');
					redirect('CoreMedicalCoverage/addCoreMedicalCoverage');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Medical Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddMedicalCoverage',$data);
					redirect('CoreMedicalCoverage/addCoreMedicalCoverage');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddMedicalCoverage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreMedicalCoverage/addCoreMedicalCoverage');
			}
		}
		
		function editCoreMedicalCoverage(){
			$data['main_view']['CoreMedicalCoverage']	= $this->CoreMedicalCoverage_model->getCoreMedicalCoverage_Detail($this->uri->segment(3));
			$data['main_view']['coregrade']				= create_double($this->CoreMedicalCoverage_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']				= create_double($this->CoreMedicalCoverage_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['corejobtitle']			= create_double($this->CoreMedicalCoverage_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['content']				= 'CoreMedicalCoverage/formeditCoreMedicalCoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreMedicalCoverage(){
			$data = array(
				'medical_coverage_id' 				=> $this->input->post('medical_coverage_id',true),
				'medical_coverage_code' 			=> $this->input->post('medical_coverage_code',true),
				'grade_id' 							=> $this->input->post('grade_id',true),
				'class_id' 							=> $this->input->post('class_id',true),
				'job_title_id' 						=> $this->input->post('job_title_id',true),
				'medical_coverage_name' 			=> $this->input->post('medical_coverage_name',true),
				'medical_coverage_ratio' 			=> $this->input->post('medical_coverage_ratio',true),
				'medical_coverage_amount' 			=> $this->input->post('medical_coverage_amount',true),
				'medical_coverage_remark' 			=> $this->input->post('medical_coverage_remark',true),
				'data_state'						=> 0
			);	
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('medical_coverage_code', 'Medical Coverage Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('medical_coverage_name', 'Medical Coverage Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade ID', 'required');
			$this->form_validation->set_rules('class_id', 'Class ID', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title ID', 'required');
			$this->form_validation->set_rules('medical_coverage_ratio', 'Medical Coverage Ratio', 'required|numeric');
			$this->form_validation->set_rules('medical_coverage_amount', 'Medical Coverage Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreMedicalCoverage_model->saveEditCoreMedicalCoverage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreMedicalCoverahe.processEditCoreMedicalCoverage',$auth['username'],'Edit Grade Premi');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['medical_coverage_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Medical Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreMedicalCoverage/editCoreMedicalCoverage/'.$data['medical_coverage_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Medical Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreMedicalCoverage/editCoreMedicalCoverage/'.$data['medical_coverage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreMedicalCoverage/editCoreMedicalCoverage/'.$data['medical_coverage_id']);
			}
		}
		
		function deleteCoreMedicalCoverage(){
			if($this->CoreMedicalCoverage_model->deleteCoreMedicalCoverage($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreMedicalCoverahe.deleteCoreMedicalCoverage',$auth['username'],'Delete Medical Coverage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Medical Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreMedicalCoverage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Medical Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreMedicalCoverage');
			}
		}
	}
?>