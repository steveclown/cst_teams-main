<?php
	Class transactionalleaverequestbybranch extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalleaverequestbybranch_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalleaverequestbybranch']		= $this->transactionalleaverequestbybranch_model->get_list();
			$data['main_view']['content']	= 'transactionalleaverequestbybranch/listtransactionalleaverequestbybranch_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalleaverequestbybranch/addtransactionalleaverequestbybranch_view';
			$data['main_view']['branch']		= create_double($this->transactionalleaverequestbybranch_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['employee']		= create_double($this->transactionalleaverequestbybranch_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['annualleave']		= create_double($this->transactionalleaverequestbybranch_model->getannualleave(),'annual_leave_id','annual_leave_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalleaverequestbybranch(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'branch_id' 				=> $this->input->post('branch_id',true),
				'employee_id' 				=> $this->input->post('employee_id',true),
				'annual_leave_id'			=> $this->input->post('annual_leave_id',true),
				'leave_request_start_date'	=> $this->input->post('leave_request_start_date',true),
				'leave_request_end_date'		=> $this->input->post('leave_request_end_date',true),
				'leave_request_reason' 		=> $this->input->post('leave_request_reason',true),
				'created_on'			 	=> $this->input->post('created_on',true),
				'data_state'				=> '0',
				'created_by'				=> $auth['username'],
				'created_on'				=> date("Y-m-d h:i:s")
			);
			
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('leave_request_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('leave_request_reason', 'Reason', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleaverequestbybranch_model->saveNewtransactionalleaverequestbybranch($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalleaverequestbybranch.processaddtransactionalleaverequestbybranch',$auth['username'],'Add New Transaction Leave Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Leave Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalleaverequestbybranch');
					redirect('transactionalleaverequestbybranch/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Leave Request Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalleaverequestbybranch',$data);
					redirect('transactionalleaverequestbybranch/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalleaverequestbybranch',$data);
				redirect('transactionalleaverequestbybranch/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalleaverequestbybranch_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalleaverequestbybranch/edittransactionalleaverequestbybranch_view';
			$data['main_view']['branch']		= create_double($this->transactionalleaverequestbybranch_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['employee']		= create_double($this->transactionalleaverequestbybranch_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['annualleave']		= create_double($this->transactionalleaverequestbybranch_model->getannualleave(),'annual_leave_id','annual_leave_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalleaverequestbybranch(){
			
			$data = array(
				'leave_request_id' 				=> $this->input->post('leave_request_id',true),
				'employee_id' 				=> $this->input->post('employee_id',true),
				'annual_leave_id'			=> $this->input->post('annual_leave_id',true),
				'leave_request_start_date'	=> $this->input->post('leave_request_start_date',true),
				'leave_request_end_date'		=> $this->input->post('leave_request_end_date',true),
				'leave_request_reason' 		=> $this->input->post('leave_request_reason',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('leave_request_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('leave_request_reason', 'Reason', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleaverequestbybranch_model->saveEdittransactionalleaverequestbybranch($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalleaverequestbybranch.Edit',$auth['username'],'Edit Leave Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['leave_request_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Leave Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaverequestbybranch/Edit/'.$data['leave_request_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Leave Request Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaverequestbybranch/Edit/'.$data['leave_request_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaverequestbybranch/Edit/'.$data['leave_request_id']);
			}
		}
		
		function delete(){
			if($this->transactionalleaverequestbybranch_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalleaverequestbybranch.delete',$auth['username'],'Delete transactionalleaverequestbybranch');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Leave Request Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaverequestbybranch');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Leave Request Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaverequestbybranch');
			}
		}
	}
?>