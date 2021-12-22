<?php
	Class transactionalleaveemergelong extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalleaveemergelong_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalleaveemergelong']		= $this->transactionalleaveemergelong_model->get_list();
			$data['main_view']['content']	= 'transactionalleaveemergelong/listtransactionalleaveemergelong_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalleaveemergelong/addtransactionalleaveemergelong_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveemergelong_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalleaveemergelong(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'leave_emerge_long_date'			=> $this->input->post('leave_emerge_long_date',true),
				'leave_emerge_long_start_date'		=> $this->input->post('leave_emerge_long_start_date',true),
				'leave_emerge_long_end_date'		=> $this->input->post('leave_emerge_long_end_date',true),
				'leave_emerge_long_remark' 			=> $this->input->post('leave_emerge_long_remark',true),
				'leave_emerge_long_status' 			=> $this->input->post('leave_emerge_long_status',true),
				'created_on'			 			=> $this->input->post('created_on',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_emerge_long_date', 'Date', 'required|numeric');
			$this->form_validation->set_rules('leave_emerge_long_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('leave_emerge_long_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('leave_emerge_long_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('leave_emerge_long_status', 'Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleaveemergelong_model->saveNewtransactionalleaveemergelong($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalleaveemergelong.processaddtransactionalleaveemergelong',$auth['username'],'Add New Transaction Leave Emerge Long');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Leave Emerge Long Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalleaveemergelong');
					redirect('transactionalleaveemergelong/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Leave Emerge Long Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalleaveemergelong',$data);
					redirect('transactionalleaveemergelong/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalleaveemergelong',$data);
				redirect('transactionalleaveemergelong/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalleaveemergelong_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalleaveemergelong/edittransactionalleaveemergelong_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveemergelong_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalleaveemergelong(){
			
			$data = array(
				'leave_emerge_long_id' 				=> $this->input->post('leave_emerge_long_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'leave_emerge_long_date'			=> $this->input->post('leave_emerge_long_date',true),
				'leave_emerge_long_start_date'		=> $this->input->post('leave_emerge_long_start_date',true),
				'leave_emerge_long_end_date'		=> $this->input->post('leave_emerge_long_end_date',true),
				'leave_emerge_long_remark' 			=> $this->input->post('leave_emerge_long_remark',true),
				'leave_emerge_long_status' 			=> $this->input->post('leave_emerge_long_status',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_emerge_long_date', 'Date', 'required|numeric');
			$this->form_validation->set_rules('leave_emerge_long_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('leave_emerge_long_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('leave_emerge_long_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('leave_emerge_long_status', 'Status', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalleaveemergelong_model->saveEdittransactionalleaveemergelong($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalleaveemergelong.Edit',$auth['username'],'Edit Leave Emerge Long');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['leave_emerge_long_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Leave Emerge Long Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveemergelong/Edit/'.$data['leave_emerge_long_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Leave Emerge Long Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveemergelong/Edit/'.$data['leave_emerge_long_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveemergelong/Edit/'.$data['leave_emerge_long_id']);
			}
		}
		
		function delete(){
			if($this->transactionalleaveemergelong_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalleaveemergelong.delete',$auth['username'],'Delete transactionalleaveemergelong');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Leave Emerge Long Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveemergelong');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Leave Emerge Long Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveemergelong');
			}
		}
	}
?>