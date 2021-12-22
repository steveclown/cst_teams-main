<?php
	Class transactionaltrainingschedule extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionaltrainingschedule_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionaltrainingschedule']		= $this->transactionaltrainingschedule_model->get_list();
			$data['main_view']['content']	= 'transactionaltrainingschedule/listtransactionaltrainingschedule_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']	= 'transactionaltrainingschedule/addtransactionaltrainingschedule_view';
			//$data['main_view']['training']	= create_double($this->transactionaltrainingschedule_model->gettraining(),'training_id','training_name');
			$data['main_view']['jobtitle']	= create_double($this->transactionaltrainingschedule_model->gettrainingjobtitle(),'training_job_title_id','training_job_title_name');
			$data['main_view']['title']	= create_double($this->transactionaltrainingschedule_model->gettrainingtitle(),'training_title_id','training_title_name');
			$data['main_view']['provider']	= create_double($this->transactionaltrainingschedule_model->gettrainingprovider(),'training_provider_id','training_provider_name');
			$data['main_view']['provideritem']	= create_double($this->transactionaltrainingschedule_model->gettrainingprovideritem(),'training_provider_item_id','training_provider_item_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionaltrainingschedule(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'training_job_title_id'					=> $this->input->post('training_job_title_id',true),
				'training_title_id'						=> $this->input->post('training_title_id',true),
				'training_provider_id'					=> $this->input->post('training_provider_id',true),
				'training_provider_item_id'				=> $this->input->post('training_provider_item_id',true),
				'training_schedule_start_date'			=> tgltodb($this->input->post('training_schedule_start_date',true)),
				'training_schedule_end_date'			=> tgltodb($this->input->post('training_schedule_end_date',true)),
				'training_schedule_name'				=> $this->input->post('training_schedule_name',true),
				'training_schedule_capacity'			=> $this->input->post('training_schedule_capacity',true),
				'training_schedule_duration'			=> $this->input->post('training_schedule_duration',true),
				'training_schedule_location'			=> $this->input->post('training_schedule_location',true),
				'training_schedule_remark'				=> $this->input->post('training_schedule_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")	
			);
			
			$this->form_validation->set_rules('training_job_title_id', 'Training Job Title', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title', 'required');
			$this->form_validation->set_rules('training_provider_id', 'Training Provider', 'required');
			$this->form_validation->set_rules('training_provider_item_id', 'Training Provider Item', 'required');
			$this->form_validation->set_rules('training_schedule_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('training_schedule_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('training_schedule_name', 'Schedule Name', 'required');
			$this->form_validation->set_rules('training_schedule_capacity', 'Schedule Capacity', 'required');
			$this->form_validation->set_rules('training_schedule_duration', 'Schedule Duration', 'required');
			$this->form_validation->set_rules('training_schedule_location', 'Schedule Location', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingschedule_model->saveNewtransactionaltrainingschedule($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionaltrainingschedule.processaddtransactionaltrainingschedule',$auth['username'],'Add New Transactional Training Schedule');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Training Schedule Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionaltrainingschedule');
					redirect('transactionaltrainingschedule/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Training Schedule UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingschedule/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionaltrainingschedule',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingschedule/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionaltrainingschedule_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionaltrainingschedule/edittransactionaltrainingschedule_view';
			//$data['main_view']['training']		= create_double($this->transactionaltrainingschedule_model->gettraining(),'training_id','training_name');
			$data['main_view']['jobtitle']		= create_double($this->transactionaltrainingschedule_model->gettrainingjobtitle(),'training_job_title_id','training_job_title_name');
			$data['main_view']['title']			= create_double($this->transactionaltrainingschedule_model->gettrainingtitle(),'training_title_id','training_title_name');
			$data['main_view']['provider']		= create_double($this->transactionaltrainingschedule_model->gettrainingprovider(),'training_provider_id','training_provider_name');
			$data['main_view']['provideritem']	= create_double($this->transactionaltrainingschedule_model->gettrainingprovideritem(),'training_provider_item_id','training_provider_item_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionaltrainingschedule(){
			$data = array(
				'training_schedule_id'					=> $this->input->post('training_schedule_id',true),
				'training_job_title_id'					=> $this->input->post('training_job_title_id',true),
				'training_title_id'						=> $this->input->post('training_title_id',true),
				'training_provider_id'					=> $this->input->post('training_provider_id',true),
				'training_provider_item_id'				=> $this->input->post('training_provider_item_id',true),
				'training_schedule_start_date'			=> tgltodb($this->input->post('training_schedule_start_date',true)),
				'training_schedule_end_date'			=> tgltodb($this->input->post('training_schedule_end_date',true)),
				'training_schedule_name'				=> $this->input->post('training_schedule_name',true),
				'training_schedule_capacity'			=> $this->input->post('training_schedule_capacity',true),
				'training_schedule_duration'			=> $this->input->post('training_schedule_duration',true),
				'training_schedule_location'			=> $this->input->post('training_schedule_location',true),
				'training_schedule_remark'				=> $this->input->post('training_schedule_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")	
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('training_job_title_id', 'Training Job Title', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title', 'required');
			$this->form_validation->set_rules('training_provider_id', 'Training Provider', 'required');
			$this->form_validation->set_rules('training_provider_item_id', 'Training Provider Item', 'required');
			$this->form_validation->set_rules('training_schedule_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('training_schedule_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('training_schedule_name', 'Schedule Name', 'required');
			$this->form_validation->set_rules('training_schedule_capacity', 'Schedule Capacity', 'required');
			$this->form_validation->set_rules('training_schedule_duration', 'Schedule Duration', 'required');
			$this->form_validation->set_rules('training_schedule_location', 'Schedule Location', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingschedule_model->saveEdittransactionaltrainingschedule($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionaltrainingschedule.Edit',$auth['username'],'Edit Transactional Training Schedule');
					$this->fungsi->set_change_log($old_schedule,$data,$auth['username'],$data['training_schedule_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Training Schedule Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingschedule/Edit/'.$data['training_schedule_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Training Schedule UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingschedule/Edit/'.$data['training_schedule_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingschedule/Edit/'.$data['training_schedule_id']);
			}
		}
		
		function delete(){
			if($this->transactionaltrainingschedule_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionaltrainingschedule.delete',$auth['username'],'Delete transactionaltrainingschedule');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Training Schedule Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingschedule');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Training Schedule UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingschedule');
			}
		}
	}
?>