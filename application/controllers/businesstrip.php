<?php
	Class businesstrip extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('businesstrip_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['businesstrip']		= $this->businesstrip_model->get_list();
			$data['main_view']['content']	= 'businesstrip/listbusinesstrip_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']	= 'businesstrip/addbusinesstrip_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddbusinesstrip(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'expense_business_trip_name'			=> $this->input->post('expense_business_trip_name',true),
				'data_state'							=> '0'
			);
			
			$this->form_validation->set_rules('expense_business_trip_name', 'Business Trip Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->businesstrip_model->insertbusinesstrip($data)){
					$auth = $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1003','Application.transactionaltrainingschedule.processaddtransactionaltrainingschedule',$auth['username'],'Add New Transactional Training Schedule');
					$msg = "<div class='alert alert-success'>                
								Add Data Business Trip Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addbusinesstrip');
					redirect('businesstrip/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Business Trip UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('businesstrip/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addbusinesstrip',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('businesstrip/add');
			}
		}
		
		function edit(){
			$data['main_view']['result']		= $this->businesstrip_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']		= 'businesstrip/editbusinesstrip_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processupdatebusinesstrip(){
			$data = array(
				'expense_business_trip_id'				=> $this->input->post('expense_business_trip_id',true),
				'expense_business_trip_name'			=> $this->input->post('expense_business_trip_name',true),
				'data_state'							=> '0'
			);
			
			$this->session->set_userdata('edit',$data);
			$this->form_validation->set_rules('expense_business_trip_name', 'Business Trip Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->businesstrip_model->updatebusinesstrip($data)==true){
					$auth 	= $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1077','Application.transactionaltrainingschedule.Edit',$auth['username'],'Edit Transactional Training Schedule');
					//$this->fungsi->set_change_log($old_schedule,$data,$auth['username'],$data['training_schedule_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Business Trip Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('businesstrip/edit/'.$data['expense_business_trip_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Business Trip UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('businesstrip/edit/'.$data['expense_business_trip_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('businesstrip/edit/'.$data['expense_business_trip_id']);
			}
		}
		
		function delete(){
			if($this->businesstrip_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				//$this->fungsi->set_log($auth['username'],'1005','Application.transactionaltrainingschedule.delete',$auth['username'],'Delete transactionaltrainingschedule');
				$msg = "<div class='alert alert-success'>                
							Delete Data Business Trip Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('businesstrip');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Business Trip UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('businesstrip');
			}
		}
	}
?>