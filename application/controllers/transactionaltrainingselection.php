<?php
	Class transactionaltrainingselection extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionaltrainingselection_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionaltrainingselection']		= $this->transactionaltrainingselection_model->get_list();
			$data['main_view']['content']	= 'transactionaltrainingselection/listtransactionaltrainingselection_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			
			$data['main_view']['content']	= 'transactionaltrainingselection/addtransactionaltrainingselection_view';
			$data['main_view']['schedule']	= create_double($this->transactionaltrainingselection_model->getschedule(),'training_schedule_id','training_schedule_name');
			$data['main_view']['employee']	= create_double($this->transactionaltrainingselection_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionaltrainingselection(){
			$auth = $this->session->userdata('auth');
			
			$training_selection_period = tgltodb($this->input->post('training_selection_period',true));
			$period1 = explode('-', $training_selection_period);
			$period = $period1[0].''.$period1[1];
			
			$data = array(				
				'training_schedule_id'		=> $this->input->post('training_schedule_id',true),
				'training_selection_period'	=> $period,
				'employee_id'				=> $this->input->post('employee_id',true),
				'training_selection_date'	=> tgltodb($this->input->post('training_selection_date',true)),
				'data_state'				=> '0',
				'created_by'				=> $auth['username'],
				'created_on'				=> date("Y-m-d H:i:s")	
			);
			
			//print_r($data);exit;
			
			$this->form_validation->set_rules('training_schedule_id', 'Training Schedule', 'required');
			$this->form_validation->set_rules('training_selection_period', 'Selection Period', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('training_selection_date', 'Selection Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingselection_model->inserttrainingselection($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionaltrainingselection.processaddtransactionaltrainingselection',$auth['username'],'Add New Transactional Training Schedule');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Training Selection Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionaltrainingselection');
					redirect('transactionaltrainingselection/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Training Selection UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingselection/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionaltrainingselection',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingselection/add');
			}
		}
		
		function edit(){
			$data['main_view']['result']		= $this->transactionaltrainingselection_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionaltrainingselection/edittransactionaltrainingselection_view';
			$data['main_view']['schedule']	= create_double($this->transactionaltrainingselection_model->getschedule(),'training_schedule_id','training_schedule_name');
			$data['main_view']['employee']	= create_double($this->transactionaltrainingselection_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processedittransactionaltrainingselection(){
			$training_selection_period = tgltodb($this->input->post('training_selection_period',true));
			$period1 = explode('-', $training_selection_period);
			$period = $period1[0].''.$period1[1];
		
			$data = array(				
				'training_selection_id'		=> $this->input->post('training_selection_id',true),
				'training_schedule_id'		=> $this->input->post('training_schedule_id',true),
				'training_selection_period'	=> $period,
				'employee_id'				=> $this->input->post('employee_id',true),
				'training_selection_date'	=> tgltodb($this->input->post('training_selection_date',true)),
				'data_state'				=> '0',
				'created_by'				=> $auth['username'],
				'created_on'				=> date("Y-m-d H:i:s")	
			);
			
			$this->form_validation->set_rules('training_schedule_id', 'Training Schedule', 'required');
			$this->form_validation->set_rules('training_selection_period', 'Selection Period', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('training_selection_date', 'Selection Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingselection_model->updatetrainingselection($data)==true){
				//print_r($data);exit;
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionaltrainingselection.Edit',$auth['username'],'Edit Transactional Training Selection');
					$this->fungsi->set_change_log($old_schedule,$data,$auth['username'],$data['training_selection_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Training Selection Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingselection/edit/'.$data['training_selection_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Training Selection UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingselection/edit/'.$data['training_selection_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingselection/edit/'.$data['training_selection_id']);
			}
		}
		
		function delete(){
			if($this->transactionaltrainingselection_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionaltrainingselection.delete',$auth['username'],'Delete transactionaltrainingselection');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Training Selection Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingselection');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Training Selection UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingselection');
			}
		}
	}
?>