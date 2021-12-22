<?php
	Class trpaidlongleave extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('trpaidlongleave_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['trpaidlongleave']		= $this->trpaidlongleave_model->get_list();
			$data['main_view']['content']	= 'trpaidlongleave/listtrpaidlongleave_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'trpaidlongleave/Addtrpaidlongleave_view';
			$data['main_view']['employee']		= create_double($this->trpaidlongleave_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddtrpaidlongleave(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_balance' 					=> $this->input->post('annual_leave_balance',true),
				'paid_long_leave_total' 					=> $this->input->post('paid_long_leave_total',true),
				'paid_long_leave_date'		=> $this->input->post('paid_long_leave_date',true),
				'paid_long_leave_remark' 		=> $this->input->post('paid_long_leave_remark',true),
				'created_on'			 			=> $this->input->post('created_on',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_balance', 'Balance', 'required');
			$this->form_validation->set_rules('paid_long_leave_total', 'Total', 'required');
			$this->form_validation->set_rules('paid_long_leave_date', 'Date', 'required');
			if($this->form_validation->run()==true){
				if($this->trpaidlongleave_model->saveNewtrpaidlongleave($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.trpaidlongleave.processAddtrpaidlongleave',$auth['username'],'Add New Paid Long Leave');
					$msg = "<div class='alert alert-success'>                
								Add Data Paid Long Leave Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtrpaidlongleave');
					redirect('trpaidlongleave/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Paid Long Leave UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addtrpaidlongleave',$data);
					redirect('trpaidlongleave/Add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addtrpaidlongleave',$data);
				redirect('trpaidlongleave/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->trpaidlongleave_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'trpaidlongleave/edittrpaidlongleave_view';
			$data['main_view']['employee']		= create_double($this->trpaidlongleave_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittrpaidlongleave(){
			
			$data = array(
				'paid_long_leave_id' 						=> $this->input->post('paid_long_leave_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_balance' 					=> $this->input->post('annual_leave_balance',true),
				'paid_long_leave_total' 					=> $this->input->post('paid_long_leave_total',true),
				'paid_long_leave_date'		=> $this->input->post('paid_long_leave_date',true),
				'paid_long_leave_remark' 		=> $this->input->post('paid_long_leave_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_balance', 'Balance', 'required');
			$this->form_validation->set_rules('paid_long_leave_total', 'Total', 'required');
			$this->form_validation->set_rules('paid_long_leave_date', 'Date', 'required');
			if($this->form_validation->run()==true){
				if($this->trpaidlongleave_model->saveEdittrpaidlongleave($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.trpaidlongleave.Edit',$auth['username'],'Edit Paid Long Leave');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['paid_long_leave_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Paid Long Leave Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('trpaidlongleave/Edit/'.$data['paid_long_leave_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Paid Long Leave UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('trpaidlongleave/Edit/'.$data['paid_long_leave_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('trpaidlongleave/Edit/'.$data['paid_long_leave_id']);
			}
		}
		
		function delete(){
			if($this->trpaidlongleave_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.trpaidlongleave.delete',$auth['username'],'Delete Paid Long Leave');
				$msg = "<div class='alert alert-success'>                
							Delete Data Paid Long Leave Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('trpaidlongleave');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Paid Long Leave UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('trpaidlongleave');
			}
		}
	}
?>