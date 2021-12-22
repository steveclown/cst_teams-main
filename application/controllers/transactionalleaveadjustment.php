<?php
	Class transactionalleaveadjustment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalleaveadjustment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalleaveadjustment']		= $this->transactionalleaveadjustment_model->get_list();
			$data['main_view']['content']	= 'transactionalleaveadjustment/listtransactionalleaveadjustment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalleaveadjustment/addtransactionalleaveadjustment_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveadjustment_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalleaveadjustment(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'leave_adjustment_annual_days' 		=> $this->input->post('leave_adjustment_annual_days',true),
				'leave_adjustment_date'				=> $this->input->post('leave_adjustment_date',true),
				'leave_adjustment_extra_days'		=> $this->input->post('leave_adjustment_extra_days',true),
				'leave_adjustment_remark' 			=> $this->input->post('leave_adjustment_remark',true),
				'created_on'			 			=> $this->input->post('created_on',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_adjustment_annual_days', 'Annual Days', 'required|numeric');
			$this->form_validation->set_rules('leave_adjustment_extra_days', 'Extra Days', 'required|numeric');
			$this->form_validation->set_rules('leave_adjustment_date', 'Date', 'required');
			$this->form_validation->set_rules('leave_adjustment_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->transactionalleaveadjustment_model->saveNewtransactionalleaveadjustment($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalleaveadjustment.processaddtransactionalleaveadjustment',$auth['username'],'Add New Transaction Leave Adjustment');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Leave Adjustment Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalleaveadjustment');
					redirect('transactionalleaveadjustment/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Leave Adjustment Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addtransactionalleaveadjustment',$data);
					redirect('transactionalleaveadjustment/add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addtransactionalleaveadjustment',$data);
				redirect('transactionalleaveadjustment/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalleaveadjustment_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalleaveadjustment/edittransactionalleaveadjustment_view';
			$data['main_view']['employee']		= create_double($this->transactionalleaveadjustment_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalleaveadjustment(){
			
			$data = array(
				'leave_adjustment_id' 				=> $this->input->post('leave_adjustment_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'leave_adjustment_annual_days' 		=> $this->input->post('leave_adjustment_annual_days',true),
				'leave_adjustment_date'				=> $this->input->post('leave_adjustment_date',true),
				'leave_adjustment_extra_days'		=> $this->input->post('leave_adjustment_extra_days',true),
				'leave_adjustment_remark' 			=> $this->input->post('leave_adjustment_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_adjustment_annual_days', 'Annual Days', 'required|numeric');
			$this->form_validation->set_rules('leave_adjustment_extra_days', 'Extra Days', 'required|numeric');
			$this->form_validation->set_rules('leave_adjustment_date', 'Date', 'required');
			$this->form_validation->set_rules('leave_adjustment_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->transactionalleaveadjustment_model->saveEdittransactionalleaveadjustment($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalleaveadjustment.Edit',$auth['username'],'Edit Adjusment Leave');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['leave_adjustment_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Data Transactional Leave Adjustment Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveadjustment/Edit/'.$data['leave_adjustment_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Transactional Leave Adjustment Unsuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalleaveadjustment/Edit/'.$data['leave_adjustment_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveadjustment/Edit/'.$data['leave_adjustment_id']);
			}
		}
		
		function delete(){
			if($this->transactionalleaveadjustment_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalleaveadjustment.delete',$auth['username'],'Delete transactionalleaveadjustment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Leave Adjustment Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveadjustment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Leave Adjustment Unsuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalleaveadjustment');
			}
		}
	}
?>