<?php
	Class CoreHospitalCoverage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreHospitalCoverage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreHospitalCoverage']		= $this->CoreHospitalCoverage_model->getCoreHospitalCoverage();
			$data['main_view']['content']					= 'CoreHospitalCoverage/listCoreHospitalCoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreHospitalCoverage(){
			$data['main_view']['content']			= 'CoreHospitalCoverage/formaddCoreHospitalCoverage_view';
			$data['main_view']['coregrade']			= create_double($this->CoreHospitalCoverage_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']			= create_double($this->CoreHospitalCoverage_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['corejobtitle']		= create_double($this->CoreHospitalCoverage_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreHospitalCoverage(){
			$data = array(
				'hospital_coverage_code' 			=> $this->input->post('hospital_coverage_code',true),
				'grade_id' 							=> $this->input->post('grade_id',true),
				'class_id' 							=> $this->input->post('class_id',true),
				'job_title_id' 						=> $this->input->post('job_title_id',true),
				'hospital_coverage_name' 			=> $this->input->post('hospital_coverage_name',true),
				'hospital_coverage_medicine_ratio' 	=> $this->input->post('hospital_coverage_medicine_ratio',true),
				'hospital_coverage_medicine_amount' => $this->input->post('hospital_coverage_medicine_amount',true),
				'hospital_coverage_room_ratio' 		=> $this->input->post('hospital_coverage_room_ratio',true),
				'hospital_coverage_room_amount' 	=> $this->input->post('hospital_coverage_room_amount',true),
				'hospital_coverage_remark' 			=> $this->input->post('hospital_coverage_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('hospital_coverage_code', 'Hospital Coverage Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('grade_id', 'Grade ID', 'required');
			$this->form_validation->set_rules('class_id', 'Class ID', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title ID', 'required');
			$this->form_validation->set_rules('hospital_coverage_medicine_ratio', 'Hospital Coverage Medicine Ratio', 'required|numeric');
			$this->form_validation->set_rules('hospital_coverage_medicine_amount', 'Hospital Coverage Medicine Amount', 'required|numeric');
			$this->form_validation->set_rules('hospital_coverage_room_ratio', 'Hospital Coverage Room Ratio', 'required|numeric');
			$this->form_validation->set_rules('hospital_coverage_room_amount', 'Hospital Coverage Room Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreHospitalCoverage_model->saveNewCoreHospitalCoverage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreHospitalCoverage.processAddCoreHospitalCoverage',$auth['username'],'Add New Hospital Coverage');
					$msg = "<div class='alert alert-success'>                
								Add Data Hospital Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHospitalCoverage');
					redirect('CoreHospitalCoverage/addCoreHospitalCoverage');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Hospital Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHospitalCoverage',$data);
					redirect('CoreHospitalCoverage/addCoreHospitalCoverage');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddHospitalCoverage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreHospitalCoverage/addCoreHospitalCoverage');
			}
		}
		
		function editCoreHospitalCoverage(){
			$data['main_view']['CoreHospitalCoverage']	= $this->CoreHospitalCoverage_model->getCoreHospitalCoverage_Detail($this->uri->segment(3));
			$data['main_view']['coregrade']				= create_double($this->CoreHospitalCoverage_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']				= create_double($this->CoreHospitalCoverage_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['corejobtitle']			= create_double($this->CoreHospitalCoverage_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['content']	= 'CoreHospitalCoverage/formeditCoreHospitalCoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreHospitalCoverage(){
			$data = array(
				'hospital_coverage_id' 				=> $this->input->post('hospital_coverage_id',true),
				'hospital_coverage_code' 			=> $this->input->post('hospital_coverage_code',true),
				'grade_id' 							=> $this->input->post('grade_id',true),
				'class_id' 							=> $this->input->post('class_id',true),
				'job_title_id' 						=> $this->input->post('job_title_id',true),
				'hospital_coverage_name' 			=> $this->input->post('hospital_coverage_name',true),
				'hospital_coverage_medicine_ratio' 	=> $this->input->post('hospital_coverage_medicine_ratio',true),
				'hospital_coverage_medicine_amount' => $this->input->post('hospital_coverage_medicine_amount',true),
				'hospital_coverage_room_ratio' 		=> $this->input->post('hospital_coverage_room_ratio',true),
				'hospital_coverage_room_amount' 	=> $this->input->post('hospital_coverage_room_amount',true),
				'hospital_coverage_remark' 			=> $this->input->post('hospital_coverage_remark',true),
				'data_state'						=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('hospital_coverage_code', 'Hospital Coverage Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('grade_id', 'Grade ID', 'required');
			$this->form_validation->set_rules('class_id', 'Class ID', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title ID', 'required');
			$this->form_validation->set_rules('hospital_coverage_medicine_ratio', 'Hospital Coverage Medicine Ratio', 'required|numeric');
			$this->form_validation->set_rules('hospital_coverage_medicine_amount', 'Hospital Coverage Medicine Amount', 'required|numeric');
			$this->form_validation->set_rules('hospital_coverage_room_ratio', 'Hospital Coverage Room Ratio', 'required|numeric');
			$this->form_validation->set_rules('hospital_coverage_room_amount', 'Hospital Coverage Room Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreHospitalCoverage_model->saveEditCoreHospitalCoverage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreHospitalCoverage.processEditCoreHospitalCoverage',$auth['username'],'Edit Grade Premi');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['hospital_coverage_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Hospital Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreHospitalCoverage/editCoreHospitalCoverage/'.$data['hospital_coverage_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Hospital Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreHospitalCoverage/editCoreHospitalCoverage/'.$data['hospital_coverage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>",  "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreHospitalCoverage/editCoreHospitalCoverage/'.$data['hospital_coverage_id']);
			}
		}
		
		function deleteCoreHospitalCoverage(){
			if($this->CoreHospitalCoverage_model->deleteCoreHospitalCoverage($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreHospitalCoverage.deleteCoreHospitalCoverage',$auth['username'],'Delete Hospital Coverage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Hospital Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('CoreHospitalCoverage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Hospital Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('CoreHospitalCoverage');
			}
		}
	}
?>