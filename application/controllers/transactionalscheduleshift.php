<?php
	Class transactionalscheduleshift extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalscheduleshift_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalscheduleshift']		= $this->transactionalscheduleshift_model->get_list();
			$data['main_view']['content']	= 'transactionalscheduleshift/listtransactionalscheduleshift_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalscheduleshift/addtransactionalscheduleshift_view';
			$data['main_view']['employee']		= create_double($this->transactionalscheduleshift_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['shift']		= create_double($this->transactionalscheduleshift_model->getshift(),'shift_id','shift_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalscheduleshift(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'shift_id'	 						=> $this->input->post('shift_id',true),
				'schedule_shift_start_date' 		=> tgltodb($this->input->post('schedule_shift_start_date',true)),
				'schedule_shift_end_date' 			=> tgltodb($this->input->post('schedule_shift_end_date',true)),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('shift_id', 'Shift name', 'required');
			$this->form_validation->set_rules('schedule_shift_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('schedule_shift_end_date', 'End Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalscheduleshift_model->saveNewtransactionalscheduleshift($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalscheduleshift.processaddtransactionalscheduleshift',$auth['username'],'Add New Transactional Schedule Shift');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Schedule Shift Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalscheduleshift');
					redirect('transactionalscheduleshift/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Schedule Shift UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalscheduleshift/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalscheduleshift',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalscheduleshift/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalscheduleshift_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalscheduleshift/edittransactionalscheduleshift_view';
			$data['main_view']['employee']		= create_double($this->transactionalscheduleshift_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['shift']		= create_double($this->transactionalscheduleshift_model->getshift(),'shift_id','shift_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalscheduleshift(){
			
			$data = array(
				'schedule_shift_id' 				=> $this->input->post('schedule_shift_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'shift_id'	 						=> $this->input->post('shift_id',true),
				'schedule_shift_start_date' 		=> tgltodb($this->input->post('schedule_shift_start_date',true)),
				'schedule_shift_end_date' 			=> tgltodb($this->input->post('schedule_shift_end_date',true)),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('shift_id', 'Shift name', 'required');
			$this->form_validation->set_rules('schedule_shift_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('schedule_shift_end_date', 'End Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalscheduleshift_model->saveEdittransactionalscheduleshift($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalscheduleshift.Edit',$auth['username'],'Edit Transactional Schedule Shift');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['schedule_shift_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Schedule Shift Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalscheduleshift/Edit/'.$data['schedule_shift_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Schedule Shift UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalscheduleshift/Edit/'.$data['schedule_shift_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalscheduleshift/Edit/'.$data['schedule_shift_id']);
			}
		}
		
		function delete(){
			if($this->transactionalscheduleshift_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalscheduleshift.delete',$auth['username'],'Delete transactionalscheduleshift');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Schedule Shift Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalscheduleshift');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Schedule Shift UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalscheduleshift');
			}
		}
	}
?>