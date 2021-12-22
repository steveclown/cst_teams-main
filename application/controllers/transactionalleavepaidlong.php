<?php
	Class transactionalleavepaidlong extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalleavepaidlong_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalleavepaidlong']		= $this->transactionalleavepaidlong_model->get_list();
			$data['main_view']['content']	= 'transactionalleavepaidlong/listtransactionalleavepaidlong_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalleavepaidlong/addtransactionalleavepaidlong_view';
			$data['main_view']['employee']		= create_double($this->transactionalleavepaidlong_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalleavepaidlong(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'annual_leave_balance'			=> $this->input->post('annual_leave_balance',true),
				'leave_paid_long_total'			=> $this->input->post('leave_paid_long_total',true),
				'leave_paid_long_date'			=> $this->input->post('leave_paid_long_date',true),
				'leave_paid_long_remark' 		=> $this->input->post('leave_paid_long_remark',true),
				'created_on'			 		=> $this->input->post('created_on',true),
				'data_state'					=> '0',
				'created_by'					=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_balance', 'Annual Leave Balance', 'numeric');
			$this->form_validation->set_rules('leave_paid_long_total', 'Total', 'numeric');
			$this->form_validation->set_rules('leave_paid_long_date', 'Date', 'required');
			$this->form_validation->set_rules('leave_paid_long_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleavepaidlong_model->saveNewtransactionalleavepaidlong($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalleavepaidlong.processaddtransactionalleavepaidlong',$auth['username'],'Add New Transaction Leave Paid Long');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Leave Paid Long Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalleavepaidlong');
					redirect('transactionalleavepaidlong/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Leave Paid Long Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalleavepaidlong',$data);
					redirect('transactionalleavepaidlong/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalleavepaidlong',$data);
				redirect('transactionalleavepaidlong/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalleavepaidlong_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalleavepaidlong/edittransactionalleavepaidlong_view';
			$data['main_view']['employee']		= create_double($this->transactionalleavepaidlong_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalleavepaidlong(){
			
			$data = array(
				'leave_paid_long_id' 				=> $this->input->post('leave_paid_long_id',true),
				'employee_id' 					=> $this->input->post('employee_id',true),
				'annual_leave_balance'			=> $this->input->post('annual_leave_balance',true),
				'leave_paid_long_total'			=> $this->input->post('leave_paid_long_total',true),
				'leave_paid_long_date'			=> $this->input->post('leave_paid_long_date',true),
				'leave_paid_long_remark' 		=> $this->input->post('leave_paid_long_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_balance', 'Annual Leave Balance', 'numeric');
			$this->form_validation->set_rules('leave_paid_long_total', 'Total', 'numeric');
			$this->form_validation->set_rules('leave_paid_long_date', 'Date', 'required');
			$this->form_validation->set_rules('leave_paid_long_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->transactionalleavepaidlong_model->saveEdittransactionalleavepaidlong($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalleavepaidlong.Edit',$auth['username'],'Edit Leave Paid Long');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['leave_paid_long_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Leave Paid Long Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleavepaidlong/Edit/'.$data['leave_paid_long_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Leave Paid Long Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleavepaidlong/Edit/'.$data['leave_paid_long_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleavepaidlong/Edit/'.$data['leave_paid_long_id']);
			}
		}
		
		function delete(){
			if($this->transactionalleavepaidlong_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalleavepaidlong.delete',$auth['username'],'Delete transactionalleavepaidlong');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Leave Paid Long Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleavepaidlong');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Leave Paid Long Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleavepaidlong');
			}
		}
	}
?>