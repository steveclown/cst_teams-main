<?php
	Class CoreAnnualLeave extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreAnnualLeave_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreAnnualLeave']		= $this->CoreAnnualLeave_model->getCoreAnnualLeave();
			$data['Main_view']['annualleavetype']		= $this->configuration->AnnualLeaveType();	
			$data['Main_view']['content']				= 'CoreAnnualLeave/listCoreAnnualLeave_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreAnnualLeave(){
			$data['Main_view']['content']				= 'CoreAnnualLeave/formaddCoreAnnualLeave_view';

			$data['Main_view']['annualleavetype']		= $this->configuration->AnnualLeaveType();			

			$data['Main_view']['includedayoff']			= $this->configuration->IncludeDayOff();			

			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddCoreAnnualLeave(){
			$data = array(
				'annual_leave_code' 		=> $this->input->post('annual_leave_code',true),
				'annual_leave_name' 		=> $this->input->post('annual_leave_name',true),
				'annual_leave_days' 		=> $this->input->post('annual_leave_days',true),
				'annual_leave_type' 		=> $this->input->post('annual_leave_type',true),
				'annual_leave_remark' 		=> $this->input->post('annual_leave_remark',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('annual_leave_code', 'Annual Leave Code', 'required');
			$this->form_validation->set_rules('annual_leave_name', 'Annual Leave Name', 'required');
			$this->form_validation->set_rules('annual_leave_days', 'Annual Leave Days', 'required');
			$this->form_validation->set_rules('annual_leave_type', 'Annual Leave Type', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreAnnualLeave_model->saveNewCoreAnnualleave($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreAnnualLeave.processAddCoreAnnualLeave',$auth['username'],'Add New Annual Leave');
					$msg = "<div class='alert alert-success'>                
								Add Data Annual Leave Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddAnnualLeave');
					redirect('CoreAnnualLeave/addCoreAnnualLeave');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Annual Leave UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddAnnualLeave',$data);
					redirect('CoreAnnualLeave/addCoreAnnualLeave');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddAnnualLeave',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreAnnualLeave/addCoreAnnualLeave');
			}
		}
		
		public function editCoreAnnualLeave(){
			$annual_leave_id = $this->uri->segment(3);

			$data['Main_view']['CoreAnnualLeave']		= $this->CoreAnnualLeave_model->getCoreAnnualLeave_Detail($annual_leave_id);

			$data['Main_view']['annualleavetype']		= $this->configuration->AnnualLeaveType();			

			$data['Main_view']['includedayoff']			= $this->configuration->IncludeDayOff();			

			$data['Main_view']['content']				= 'CoreAnnualLeave/formeditCoreAnnualLeave_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreAnnualleave(){
			$data = array(
				'annual_leave_id' 			=> $this->input->post('annual_leave_id',true),
				'annual_leave_code' 		=> $this->input->post('annual_leave_code',true),
				'annual_leave_name' 		=> $this->input->post('annual_leave_name',true),
				'annual_leave_days' 		=> $this->input->post('annual_leave_days',true),
				'annual_leave_type' 		=> $this->input->post('annual_leave_type',true),
				'annual_leave_remark' 		=> $this->input->post('annual_leave_remark',true),
				'data_state'				=> 0
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('annual_leave_code', 'Annual Leave Code', 'required');
			$this->form_validation->set_rules('annual_leave_name', 'Annual Leave Name', 'required');
			$this->form_validation->set_rules('annual_leave_days', 'Annual Leave Days', 'required');
			$this->form_validation->set_rules('annual_leave_type', 'Annual Leave Type', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreAnnualLeave_model->saveEditCoreAnnualleave($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreAnnualLeave.processEditCoreAnnualleave',$auth['username'],'Edit Annual Leave');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['annual_leave_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Annual Leave Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAnnualLeave/editCoreAnnualLeave/'.$data['annual_leave_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Annual Leave UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAnnualLeave/editCoreAnnualLeave/'.$data['annual_leave_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreAnnualLeave/editCoreAnnualLeave/'.$data['annual_leave_id']);
			}
		}
				
		function deleteCoreAnnualLeave(){
			if($this->CoreAnnualLeave_model->deleteCoreAnnualLeave($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreAnnualLeave.deleteCoreAnnualLeave',$auth['username'],'Delete Annual Leave');
				$msg = "<div class='alert alert-success'>                
							Delete Data Annual Leave Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAnnualLeave');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Annual Leave UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAnnualLeave');
			}
		}
	}
?>