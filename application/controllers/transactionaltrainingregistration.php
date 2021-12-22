<?php
	Class transactionaltrainingregistration extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionaltrainingregistration_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionaltrainingregistration']		= $this->transactionaltrainingregistration_model->get_list();
			$data['main_view']['content']	= 'transactionaltrainingregistration/listtransactionaltrainingregistration_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']	= 'transactionaltrainingregistration/addtransactionaltrainingregistration_view';
			$data['main_view']['schedule']	= create_double($this->transactionaltrainingregistration_model->getschedule(),'training_schedule_id','training_schedule_name');
			$data['main_view']['employee']	= create_double($this->transactionaltrainingregistration_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionaltrainingregistration(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'training_schedule_id'	=> $this->input->post('training_schedule_id',true),
				'employee_id'			=> $this->input->post('employee_id',true),
				'data_state'			=> '0',
				'created_by'			=> $auth['username'],
				'created_on'			=> date("Y-m-d H:i:s")	
			);
			
			$this->form_validation->set_rules('training_schedule_id', 'Training Schedule', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingregistration_model->inserttrainingregistration($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionaltrainingregistration.processaddtransactionaltrainingregistration',$auth['username'],'Add New Transactional Training Schedule');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Training Registration Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionaltrainingregistration');
					redirect('transactionaltrainingregistration/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Training Registration UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingregistration/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionaltrainingregistration',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingregistration/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionaltrainingregistration_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionaltrainingregistration/edittransactionaltrainingregistration_view';
			$data['main_view']['schedule']	= create_double($this->transactionaltrainingregistration_model->getschedule(),'training_schedule_id','training_schedule_name');
			$data['main_view']['employee']	= create_double($this->transactionaltrainingregistration_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionaltrainingregistration(){
			$data = array(
				'training_registration_id'	=> $this->input->post('training_registration_id',true),
				'employee_id'			=> $this->input->post('employee_id',true),
				'data_state'			=> '0',
				'created_by'			=> $auth['username'],
				'created_on'			=> date("Y-m-d H:i:s")	
			);
			//$this->session->set_userdata('edit',$data);
			
			$this->form_validation->set_rules('training_schedule_id', 'Training Schedule', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingregistration_model->updatetrainingregistration($data)==true){
				//print_r($data);exit;
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionaltrainingregistration.Edit',$auth['username'],'Edit Transactional Training Registration');
					$this->fungsi->set_change_log($old_schedule,$data,$auth['username'],$data['training_registration_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Training Registration Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingregistration/edit/'.$data['training_registration_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Training Registration UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingregistration/edit/'.$data['training_registration_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingregistration/edit/'.$data['training_registration_id']);
			}
		}
		
		function delete(){
			if($this->transactionaltrainingregistration_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionaltrainingregistration.delete',$auth['username'],'Delete transactionaltrainingregistration');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Training Registration Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingregistration');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Training Registration UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingregistration');
			}
		}
	}
?>