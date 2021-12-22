<?php
	Class CoreGlassesCoverage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreGlassesCoverage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreGlassesCoverage']		= $this->CoreGlassesCoverage_model->getCoreGlassesCoverage();
			$data['main_view']['content']					= 'CoreGlassesCoverage/listCoreGlassesCoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreGlassesCoverage(){
			$data['main_view']['content']				= 'CoreGlassesCoverage/formaddCoreGlassesCoverage_view';
			$data['main_view']['coregrade']				= create_double($this->CoreGlassesCoverage_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']				= create_double($this->CoreGlassesCoverage_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['corejobtitle']			= create_double($this->CoreGlassesCoverage_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['glassescoveragetype']	= $this->configuration->GlassesCoverageType();
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreGlassesCoverage(){
			$data = array(
				'glasses_coverage_code' 		=> $this->input->post('glasses_coverage_code',true),
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_id' 						=> $this->input->post('class_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'glasses_coverage_name' 		=> $this->input->post('glasses_coverage_name',true),
				'glasses_coverage_type' 		=> $this->input->post('glasses_coverage_type',true),
				'glasses_coverage_ratio' 		=> $this->input->post('glasses_coverage_ratio',true),
				'glasses_coverage_amount' 		=> $this->input->post('glasses_coverage_amount',true),
				'glasses_coverage_remark' 		=> $this->input->post('glasses_coverage_remark',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('glasses_coverage_code', 'Glasses Coverage Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('glasses_coverage_name', 'Glasses Coverage Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade ID', 'required');
			$this->form_validation->set_rules('class_id', 'Class ID', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title ID', 'required');
			$this->form_validation->set_rules('glasses_coverage_ratio', 'Glasses Coverage Ratio', 'required|numeric');
			$this->form_validation->set_rules('glasses_coverage_amount', 'Glasses Coverage Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreGlassesCoverage_model->saveNewCoreGlassesCoverage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreGlassesCoverage.processAddCoreGlassesCoverage',$auth['username'],'Add New Glasses Coverage');
					$msg = "<div class='alert alert-success'>                
								Add Data Glasses Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddGlassesCoverage');
					redirect('CoreGlassesCoverage/addCoreGlassesCoverage');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Glasses Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddGlassesCoverage',$data);
					redirect('CoreGlassesCoverage/addCoreGlassesCoverage');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddGlassesCoverage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreGlassesCoverage/addCoreGlassesCoverage');
			}
		}
		
		function editCoreGlassesCoverage(){
			$data['main_view']['CoreGlassesCoverage']	= $this->CoreGlassesCoverage_model->getCoreGlassesCoverage_Detail($this->uri->segment(3));
			$data['main_view']['coregrade']				= create_double($this->CoreGlassesCoverage_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']				= create_double($this->CoreGlassesCoverage_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['corejobtitle']			= create_double($this->CoreGlassesCoverage_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['glassescoveragetype']	= $this->configuration->GlassesCoverageType();
			$data['main_view']['content']	= 'CoreGlassesCoverage/formeditCoreGlassesCoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreGlassesCoverage(){
			$data = array(
				'glasses_coverage_id' 			=> $this->input->post('glasses_coverage_id',true),
				'glasses_coverage_code' 		=> $this->input->post('glasses_coverage_code',true),
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_id' 						=> $this->input->post('class_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'glasses_coverage_name' 		=> $this->input->post('glasses_coverage_name',true),
				'glasses_coverage_type' 		=> $this->input->post('glasses_coverage_type',true),
				'glasses_coverage_ratio' 		=> $this->input->post('glasses_coverage_ratio',true),
				'glasses_coverage_amount' 		=> $this->input->post('glasses_coverage_amount',true),
				'glasses_coverage_remark' 		=> $this->input->post('glasses_coverage_remark',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('glasses_coverage_code', 'Glasses Coverage Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('glasses_coverage_name', 'Glasses Coverage Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade ID', 'required');
			$this->form_validation->set_rules('class_id', 'Class ID', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title ID', 'required');
			$this->form_validation->set_rules('glasses_coverage_ratio', 'Glasses Coverage Ratio', 'required|numeric');
			$this->form_validation->set_rules('glasses_coverage_amount', 'Glasses Coverage Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreGlassesCoverage_model->saveEditCoreGlassesCoverage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreGlassesCoverage.processEditCoreGlassesCoverage',$auth['username'],'Edit Grade Premi');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['glasses_coverage_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Glasses Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreGlassesCoverage/editCoreGlassesCoverage/'.$data['glasses_coverage_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Glasses Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreGlassesCoverage/editCoreGlassesCoverage/'.$data['glasses_coverage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreGlassesCoverage/editCoreGlassesCoverage/'.$data['glasses_coverage_id']);
			}
		}

		
		function deleteCoreGlassesCoverage(){
			if($this->CoreGlassesCoverage_model->deleteCoreGlassesCoverage($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreGlassesCoverage.deleteCoreGlassesCoverage',$auth['username'],'Delete Glasses Coverage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Glasses Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreGlassesCoverage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Glasses Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreGlassesCoverage');
			}
		}
	}
?>