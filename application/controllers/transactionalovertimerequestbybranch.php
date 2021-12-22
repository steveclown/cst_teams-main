<?php
	Class transactionalovertimerequestbybranch extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalovertimerequestbybranch_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalovertimerequestbybranch']		= $this->transactionalovertimerequestbybranch_model->get_list();
			$data['main_view']['content']	= 'transactionalovertimerequestbybranch/listtransactionalovertimerequestbybranch_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalovertimerequestbybranch/addtransactionalovertimerequestbybranch_view';
			$data['main_view']['branch']		= create_double($this->transactionalovertimerequestbybranch_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['employee']		= create_double($this->transactionalovertimerequestbybranch_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['overtimetype']		= create_double($this->transactionalovertimerequestbybranch_model->getovertimetype(),'overtime_type_id','overtime_type_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalovertimerequestbybranch(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'branch_id' 				=> $this->input->post('branch_id',true),
				'employee_id' 				=> $this->input->post('employee_id',true),
				'overtime_type_id'			=> $this->input->post('overtime_type_id',true),
				'overtime_request_start_date'	=> $this->input->post('overtime_request_start_date',true)." ".$this->input->post('overtime_request_start_hours',true),
				'overtime_request_end_date'		=> $this->input->post('overtime_request_end_date',true)." ".$this->input->post('overtime_request_end_hours',true),
				'overtime_request_total'		=> $this->input->post('overtime_request_total',true),
				'overtime_request_remark' 		=> $this->input->post('overtime_request_remark',true),
				'created_on'			 	=> $this->input->post('created_on',true),
				'data_state'				=> '0',
				'created_by'				=> $auth['username'],
				'created_on'				=> date("Y-m-d h:i:s")
			);
			
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_type_id', 'Annual Overtime', 'required');
			$this->form_validation->set_rules('overtime_request_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('overtime_request_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('overtime_request_total', 'Total', 'required|numeric');
			$this->form_validation->set_rules('overtime_request_remark', 'Remark', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalovertimerequestbybranch_model->saveNewtransactionalovertimerequestbybranch($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalovertimerequestbybranch.processaddtransactionalovertimerequestbybranch',$auth['username'],'Add New Transaction Overtime Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Overtime Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalovertimerequestbybranch');
					redirect('transactionalovertimerequestbybranch/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Overtime Request Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalovertimerequestbybranch',$data);
					redirect('transactionalovertimerequestbybranch/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalovertimerequestbybranch',$data);
				redirect('transactionalovertimerequestbybranch/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalovertimerequestbybranch_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalovertimerequestbybranch/edittransactionalovertimerequestbybranch_view';
			$data['main_view']['branch']		= create_double($this->transactionalovertimerequestbybranch_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['employee']		= create_double($this->transactionalovertimerequestbybranch_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['overtimetype']		= create_double($this->transactionalovertimerequestbybranch_model->getovertimetype(),'overtime_type_id','overtime_type_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalovertimerequestbybranch(){
			
			$data = array(
				'overtime_request_id' 			=> $this->input->post('overtime_request_id',true),
				'employee_id' 					=> $this->input->post('employee_id',true),
				'overtime_type_id'				=> $this->input->post('overtime_type_id',true),
				'overtime_request_start_date'	=> $this->input->post('overtime_request_start_date',true)." ".$this->input->post('overtime_request_start_hours',true),
				'overtime_request_end_date'		=> $this->input->post('overtime_request_end_date',true)." ".$this->input->post('overtime_request_end_hours',true),
				'overtime_request_total'		=> $this->input->post('overtime_request_total',true),
				'overtime_request_remark' 		=> $this->input->post('overtime_request_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_type_id', 'Annual Overtime', 'required');
			$this->form_validation->set_rules('overtime_request_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('overtime_request_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('overtime_request_total', 'Total', 'required|numeric');
			$this->form_validation->set_rules('overtime_request_remark', 'Remark', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->transactionalovertimerequestbybranch_model->saveEdittransactionalovertimerequestbybranch($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalovertimerequestbybranch.Edit',$auth['username'],'Edit Overtime Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['overtime_request_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Overtime Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalovertimerequestbybranch/Edit/'.$data['overtime_request_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Overtime Request Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalovertimerequestbybranch/Edit/'.$data['overtime_request_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalovertimerequestbybranch/Edit/'.$data['overtime_request_id']);
			}
		}
		
		function delete(){
			if($this->transactionalovertimerequestbybranch_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalovertimerequestbybranch.delete',$auth['username'],'Delete transactionalovertimerequestbybranch');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Overtime Request Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalovertimerequestbybranch');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Overtime Request Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalovertimerequestbybranch');
			}
		}
	}
?>