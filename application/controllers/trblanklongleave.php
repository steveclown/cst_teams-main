<?php
	Class trblanklongleave extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('trblanklongleave_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['trblanklongleave']		= $this->trblanklongleave_model->get_list();
			$data['main_view']['content']	= 'trblanklongleave/listtrblanklongleave_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'trblanklongleave/Addtrblanklongleave_view';
			$data['main_view']['employee']		= create_double($this->trblanklongleave_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddtrblanklongleave(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'blank_long_leave_total' 					=> $this->input->post('blank_long_leave_total',true),
				'blank_long_leave_date'		=> $this->input->post('blank_long_leave_date',true),
				'blank_long_leave_remark' 		=> $this->input->post('blank_long_leave_remark',true),
				'created_on'			 			=> $this->input->post('created_on',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username']
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('blank_long_leave_total', 'Total', 'required');
			$this->form_validation->set_rules('blank_long_leave_date', 'Date', 'required');
			if($this->form_validation->run()==true){
				if($this->trblanklongleave_model->saveNewtrblanklongleave($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.trblanklongleave.processAddtrblanklongleave',$auth['username'],'Add New Blank Long Leave');
					$msg = "<div class='alert alert-success'>                
								Add Data Blank Long Leave Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtrblanklongleave');
					redirect('trblanklongleave/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Blank Long Leave UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addtrblanklongleave',$data);
					redirect('trblanklongleave/Add');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addtrblanklongleave',$data);
				redirect('trblanklongleave/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->trblanklongleave_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'trblanklongleave/edittrblanklongleave_view';
			$data['main_view']['employee']		= create_double($this->trblanklongleave_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittrblanklongleave(){
			
			$data = array(
				'blank_long_leave_id' 						=> $this->input->post('blank_long_leave_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'blank_long_leave_total' 					=> $this->input->post('blank_long_leave_total',true),
				'blank_long_leave_date'		=> $this->input->post('blank_long_leave_date',true),
				'blank_long_leave_remark' 		=> $this->input->post('blank_long_leave_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('blank_long_leave_total', 'Total', 'required');
			$this->form_validation->set_rules('blank_long_leave_date', 'Date', 'required');
			if($this->form_validation->run()==true){
				if($this->trblanklongleave_model->saveEdittrblanklongleave($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.trblanklongleave.Edit',$auth['username'],'Edit Blank Long Leave');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['blank_long_leave_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Blank Long Leave Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('trblanklongleave/Edit/'.$data['blank_long_leave_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Blank Long Leave UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('trblanklongleave/Edit/'.$data['blank_long_leave_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('trblanklongleave/Edit/'.$data['blank_long_leave_id']);
			}
		}
		
		function delete(){
			if($this->trblanklongleave_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.trblanklongleave.delete',$auth['username'],'Delete Blank Long Leave');
				$msg = "<div class='alert alert-success'>                
							Delete Data Blank Long Leave Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('trblanklongleave');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Blank Long Leave UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('trblanklongleave');
			}
		}
	}
?>