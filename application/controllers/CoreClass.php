<?php
	Class CoreClass extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreClass_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreClass']		= $this->CoreClass_model->getCoreClass();
			$data['Main_view']['content']		= 'CoreClass/listCoreClass_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreClass(){
			$data['Main_view']['content']		= 'CoreClass/formaddCoreClass_view';
			$data['Main_view']['coregrade']		= create_double($this->CoreClass_model->getCoreGrade(),'grade_id','grade_name');
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreClass(){
			$data = array(
				'class_code' 				=> $this->input->post('class_code',true),
				'class_name' 				=> $this->input->post('class_name',true),
				'grade_id' 					=> $this->input->post('grade_id',true),
				'standard_salary_range1' 	=> $this->input->post('standard_salary_range1',true),
				'standard_salary_range2' 	=> $this->input->post('standard_salary_range2',true),
				'class_remark' 				=> $this->input->post('class_remark',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('class_code', 'Class Code', 'required');
			$this->form_validation->set_rules('class_name', 'Class Name', 'required');
			$this->form_validation->set_rules('standard_salary_range1', 'Standard Salary Range 1', 'required');
			$this->form_validation->set_rules('standard_salary_range2', 'Standard Salary Range 2', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreClass_model->saveNewCoreClass($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreClass.processaddCoreClass',$auth['username'],'Add New CoreClass');
					$msg = "<div class='alert alert-success'>                
								Add Data Class Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreClass');
					redirect('CoreClass/addCoreClass');
				}else{
					$msg = "<div CoreClass='alert alert-danger'>                
								Add Data Class UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreClass',$data);
					redirect('CoreClass/addCoreClass');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreClass',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreClass/addCoreClass');
			}
		}
		
		function editCoreClass(){
			$data['Main_view']['CoreClass']		= $this->CoreClass_model->getCoreClass_Detail($this->uri->segment(3));
			$data['Main_view']['coregrade']		= create_double($this->CoreClass_model->getCoreGrade(),'grade_id','grade_name');
			$data['Main_view']['content']		= 'CoreClass/formeditCoreClass_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreClass(){
			$data = array(
				'class_id' 					=> $this->input->post('class_id',true),
				'class_code' 				=> $this->input->post('class_code',true),
				'class_name' 				=> $this->input->post('class_name',true),
				'grade_id' 					=> $this->input->post('grade_id',true),
				'standard_salary_range1' 	=> $this->input->post('standard_salary_range1',true),
				'standard_salary_range2' 	=> $this->input->post('standard_salary_range2',true),
				'class_remark' 				=> $this->input->post('class_remark',true),
				'data_state'				=> 0
			);
			
			$this->session->set_userdata('edit',$data);
			$this->form_validation->set_rules('class_code', 'Class Code', 'required');
			$this->form_validation->set_rules('class_name', 'Class Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreClass_model->saveEditCoreClass($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreClass.edit',$auth['username'],'Edit CoreClass');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreClass_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Class Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreClass/editCoreClass/'.$data['class_id']);
				}else{
					$msg = "<div CoreClass='alert alert-danger'>                
								Edit Class UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreClass/editCoreClass/'.$data['class_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreClass/editCoreClass/'.$data['class_id']);
			}
		}
		
		function deleteCoreClass(){
			if($this->CoreClass_model->deleteCoreClass($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreClass.delete',$auth['username'],'Delete CoreClass');
				$msg = "<div class='alert alert-success'>                
							Delete Data Class Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreClass');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Class UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreClass');
			}
		}
	}
?>