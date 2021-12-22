<?php
	Class CoreWorkAccident extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreWorkAccident_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreWorkAccident']		= $this->CoreWorkAccident_model->getCoreWorkAccident();
			$data['main_view']['content']				= 'CoreWorkAccident/listCoreWorkAccident_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreWorkAccident(){
			$data['main_view']['content']				= 'CoreWorkAccident/formaddCoreWorkAccident_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddCoreWorkAccident(){
			$data = array(
				'work_accident_name' 		=> $this->input->post('work_accident_name',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('work_accident_name', 'Work Accident Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreWorkAccident_model->insertCoreWorkAccident($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreWorkAccident.processAddCoreWorkAccident',$auth['username'],'Add New Work Accident');
					$msg = "<div class='alert alert-success'>                
								Add Data Work Accident Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddAnnualLeave');
					redirect('CoreWorkAccident/addCoreWorkAccident');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Annual Leave UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddAnnualLeave',$data);
					redirect('CoreWorkAccident/addCoreWorkAccident');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddAnnualLeave',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreWorkAccident/addCoreWorkAccident');
			}
		}
		
		public function editCoreWorkAccident(){
			$work_accident_id = $this->uri->segment(3);

			$data['main_view']['CoreWorkAccident']		= $this->CoreWorkAccident_model->getCoreWorkAccident_Detail($work_accident_id);

			$data['main_view']['content']				= 'CoreWorkAccident/formeditCoreWorkAccident_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreWorkAccident(){
			$data = array(
				'work_accident_id'	 		=> $this->input->post('work_accident_id',true),
				'work_accident_name' 		=> $this->input->post('work_accident_name',true),
				'data_state'				=> 0
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('work_accident_name', 'Work Order Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreWorkAccident_model->updateCoreWorkAccident($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreWorkAccident.processEditCoreWorkAccident',$auth['username'],'Edit Work Accident');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['work_accident_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Work Accident Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreWorkAccident/editCoreWorkAccident/'.$data['work_accident_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Annual Leave UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreWorkAccident/editCoreWorkAccident/'.$data['work_accident_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreWorkAccident/editCoreWorkAccident/'.$data['work_accident_id']);
			}
		}
				
		public function deleteCoreWorkAccident(){
			$work_accident_id = $this->uri->segment(3);

			$data_delete = array (
				'work_accident_id'		=> $work_accident_id,
				'data_state'			=> 1
			);
			if($this->CoreWorkAccident_model->deleteCoreWorkAccident($data_delete)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreWorkAccident.deleteCoreWorkAccident',$auth['username'],'Delete Work Accident');
				$msg = "<div class='alert alert-success'>                
							Delete Data Work Accident Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreWorkAccident');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Work Accident UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreWorkAccident');
			}
		}
	}
?>