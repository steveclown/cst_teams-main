<?php
	Class transactionalleaveblanklong extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalleaveblanklong_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalleaveblanklong']		= $this->transactionalleaveblanklong_model->get_list();
			$data['main_view']['content']	= 'transactionalleaveblanklong/listtransactionalleaveblanklong_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalleaveblanklong/addtransactionalleaveblanklong_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveblanklong_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['leaveemergelong']		= create_double($this->transactionalleaveblanklong_model->getleaveemergelong(),'leave_emerge_long_id','leave_emerge_long_date');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalleaveblanklong(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'leave_emerge_long_id'			=> $this->input->post('leave_emerge_long_id',true),
				'leave_blank_long_date'			=> $this->input->post('leave_blank_long_date',true),
				'leave_blank_long_remark' 		=> $this->input->post('leave_blank_long_remark',true),
				'created_on'			 		=> $this->input->post('created_on',true),
				'data_state'					=> '0',
				'created_by'					=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_emerge_long_id', 'Emerge Long Date', 'required');
			$this->form_validation->set_rules('leave_blank_long_date', 'Date', 'required');
			$this->form_validation->set_rules('leave_blank_long_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleaveblanklong_model->saveNewtransactionalleaveblanklong($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalleaveblanklong.processaddtransactionalleaveblanklong',$auth['username'],'Add New Transaction Leave Blank Long');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Leave Blank Long Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalleaveblanklong');
					redirect('transactionalleaveblanklong/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Leave Blank Long Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalleaveblanklong',$data);
					redirect('transactionalleaveblanklong/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalleaveblanklong',$data);
				redirect('transactionalleaveblanklong/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalleaveblanklong_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalleaveblanklong/edittransactionalleaveblanklong_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveblanklong_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalleaveblanklong(){
			
			$data = array(
				'leave_blank_long_id' 				=> $this->input->post('leave_blank_long_id',true),
				'employee_id' 					=> $this->input->post('employee_id',true),
				'leave_emerge_long_id'			=> $this->input->post('leave_emerge_long_id',true),
				'leave_blank_long_date'			=> $this->input->post('leave_blank_long_date',true),
				'leave_blank_long_remark' 		=> $this->input->post('leave_blank_long_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_emerge_long_id', 'Emerge Long Date', 'required');
			$this->form_validation->set_rules('leave_blank_long_date', 'Date', 'required');
			$this->form_validation->set_rules('leave_blank_long_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalleaveblanklong_model->saveEdittransactionalleaveblanklong($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalleaveblanklong.Edit',$auth['username'],'Edit Leave Blank Long');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['leave_blank_long_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Leave Blank Long Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveblanklong/Edit/'.$data['leave_blank_long_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Leave Blank Long Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveblanklong/Edit/'.$data['leave_blank_long_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveblanklong/Edit/'.$data['leave_blank_long_id']);
			}
		}
		
		function delete(){
			if($this->transactionalleaveblanklong_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalleaveblanklong.delete',$auth['username'],'Delete transactionalleaveblanklong');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Leave Blank Long Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveblanklong');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Leave Blank Long Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveblanklong');
			}
		}
	}
?>