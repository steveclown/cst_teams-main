<?php
	Class transactionalemployeeappraisal extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalemployeeappraisal_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalemployeeappraisal']		= $this->transactionalemployeeappraisal_model->get_list();
			$data['main_view']['content']	= 'transactionalemployeeappraisal/listtransactionalemployeeappraisal_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalemployeeappraisal/addtransactionalemployeeappraisal_view';
			$data['main_view']['employee']	= create_double($this->transactionalemployeeappraisal_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalemployeeappraisal(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id'=> $this->input->post('employee_id',true),
				'employee_appraisal_value'=> $this->input->post('employee_appraisal_value',true),
				'employee_appraisal_date'=> $this->input->post('employee_appraisal_date',true),
				'employee_appraisal_remark'=> $this->input->post('employee_appraisal_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_appraisal_value', 'Appraisal Value', 'required');
			$this->form_validation->set_rules('employee_appraisal_date', 'Appraisal Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalemployeeappraisal_model->saveNewtransactionalemployeeappraisal($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalemployeeappraisal.processaddtransactionalemployeeappraisal',$auth['username'],'Add New Transactional Employee Appraisal');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Employee Appraisal Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalemployeeappraisal');
					redirect('transactionalemployeeappraisal/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Employee Appraisal UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalemployeeappraisal/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalemployeeappraisal',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalemployeeappraisal/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalemployeeappraisal_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalemployeeappraisal/edittransactionalemployeeappraisal_view';
			$data['main_view']['employee']	= create_double($this->transactionalemployeeappraisal_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalemployeeappraisal(){
			$data = array(
				'employee_appraisal_id'=> $this->input->post('employee_appraisal_id',true),
				'employee_id'=> $this->input->post('employee_id',true),
				'employee_appraisal_value'=> $this->input->post('employee_appraisal_value',true),
				'employee_appraisal_date'=> $this->input->post('employee_appraisal_date',true),
				'employee_appraisal_remark'=> $this->input->post('employee_appraisal_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_appraisal_value', 'Appraisal Value', 'required');
			$this->form_validation->set_rules('employee_appraisal_date', 'Appraisal Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalemployeeappraisal_model->saveEdittransactionalemployeeappraisal($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalemployeeappraisal.Edit',$auth['username'],'Edit Transactional Employee Appraisal');
					$this->fungsi->set_change_log($old_appraisal,$data,$auth['username'],$data['employee_appraisal_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Employee Appraisal Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalemployeeappraisal/Edit/'.$data['employee_appraisal_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Employee Appraisal UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalemployeeappraisal/Edit/'.$data['employee_appraisal_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalemployeeappraisal/Edit/'.$data['employee_appraisal_id']);
			}
		}
		
		function delete(){
			if($this->transactionalemployeeappraisal_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalemployeeappraisal.delete',$auth['username'],'Delete transactionalemployeeappraisal');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Employee Appraisal Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalemployeeappraisal');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Employee Appraisal UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalemployeeappraisal');
			}
		}
	}
?>