<?php
	Class transactionalleaveunpaid extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalleaveunpaid_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalleaveunpaid']		= $this->transactionalleaveunpaid_model->get_list();
			$data['main_view']['content']	= 'transactionalleaveunpaid/listtransactionalleaveunpaid_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalleaveunpaid/addtransactionalleaveunpaid_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveunpaid_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['annualleave']		= create_double($this->transactionalleaveunpaid_model->getannualleave(),'annual_leave_id','annual_leave_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalleaveunpaid(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 				=> $this->input->post('employee_id',true),
				'annual_leave_id'			=> $this->input->post('annual_leave_id',true),
				'leave_unpaid_start_date'	=> $this->input->post('leave_unpaid_start_date',true),
				'leave_unpaid_end_date'		=> $this->input->post('leave_unpaid_end_date',true),
				'leave_unpaid_reason' 		=> $this->input->post('leave_unpaid_reason',true),
				'created_on'			 	=> $this->input->post('created_on',true),
				'data_state'				=> '0',
				'created_by'				=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_unpaid_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('leave_unpaid_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('leave_unpaid_reason', 'Reason', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleaveunpaid_model->saveNewtransactionalleaveunpaid($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalleaveunpaid.processaddtransactionalleaveunpaid',$auth['username'],'Add New Transaction Leave Unpaid');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Leave Unpaid Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalleaveunpaid');
					redirect('transactionalleaveunpaid/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Leave Unpaid Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalleaveunpaid',$data);
					redirect('transactionalleaveunpaid/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalleaveunpaid',$data);
				redirect('transactionalleaveunpaid/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalleaveunpaid_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalleaveunpaid/edittransactionalleaveunpaid_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveunpaid_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['annualleave']		= create_double($this->transactionalleaveunpaid_model->getannualleave(),'annual_leave_id','annual_leave_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalleaveunpaid(){
			
			$data = array(
				'leave_unpaid_id' 				=> $this->input->post('leave_unpaid_id',true),
				'employee_id' 				=> $this->input->post('employee_id',true),
				'annual_leave_id'			=> $this->input->post('annual_leave_id',true),
				'leave_unpaid_start_date'	=> $this->input->post('leave_unpaid_start_date',true),
				'leave_unpaid_end_date'		=> $this->input->post('leave_unpaid_end_date',true),
				'leave_unpaid_reason' 		=> $this->input->post('leave_unpaid_reason',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_unpaid_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('leave_unpaid_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('leave_unpaid_reason', 'Reason', 'required|filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->transactionalleaveunpaid_model->saveEdittransactionalleaveunpaid($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalleaveunpaid.Edit',$auth['username'],'Edit Leave Unpaid');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['leave_unpaid_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Leave Unpaid Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveunpaid/Edit/'.$data['leave_unpaid_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Leave Unpaid Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveunpaid/Edit/'.$data['leave_unpaid_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveunpaid/Edit/'.$data['leave_unpaid_id']);
			}
		}
		
		function delete(){
			if($this->transactionalleaveunpaid_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalleaveunpaid.delete',$auth['username'],'Delete transactionalleaveunpaid');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Leave Unpaid Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveunpaid');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Leave Unpaid Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveunpaid');
			}
		}
	}
?>