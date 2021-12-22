<?php
	Class transactionalapplicantorganizationexperience extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantorganizationexperience_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantorganizationexperience']		= $this->transactionalapplicantorganizationexperience_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantorganizationexperience/listtransactionalapplicantorganizationexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantorganizationexperience/addtransactionalapplicantorganizationexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantorganizationexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantorganizationexperience(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'organization_experience_name'=> $this->input->post('organization_experience_name',true),
				'organization_experience_scope'=> $this->input->post('organization_experience_scope',true),
				'organization_experience_period'=> $this->input->post('organization_experience_period',true),
				'organization_experience_title'=> $this->input->post('organization_experience_title',true),
				'organization_experience_status'=> $this->input->post('organization_experience_status',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantorganizationexperience_model->saveNewtransactionalapplicantorganizationexperience($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantorganizationexperience.processaddtransactionalapplicantorganizationexperience',$auth['username'],'Add New Transactional Applicant Organization Experience');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Organization Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantorganizationexperience');
					redirect('transactionalapplicantorganizationexperience/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Organization Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantorganizationexperience/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantorganizationexperience',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantorganizationexperience/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantorganizationexperience_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantorganizationexperience/edittransactionalapplicantorganizationexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantorganizationexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantorganizationexperience(){
			$data = array(
				'applicant_organization_experience_id'=> $this->input->post('applicant_organization_experience_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'organization_experience_name'=> $this->input->post('organization_experience_name',true),
				'organization_experience_scope'=> $this->input->post('organization_experience_scope',true),
				'organization_experience_period'=> $this->input->post('organization_experience_period',true),
				'organization_experience_title'=> $this->input->post('organization_experience_title',true),
				'organization_experience_status'=> $this->input->post('organization_experience_status',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantorganizationexperience_model->saveEdittransactionalapplicantorganizationexperience($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantorganizationexperience.Edit',$auth['username'],'Edit Transactional Applicant Organization Experience');
					$this->fungsi->set_change_log($old_organization_experience,$data,$auth['username'],$data['applicant_organization_experience_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Organization Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantorganizationexperience/Edit/'.$data['applicant_organization_experience_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Organization Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantorganizationexperience/Edit/'.$data['applicant_organization_experience_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantorganizationexperience/Edit/'.$data['applicant_organization_experience_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantorganizationexperience_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantorganizationexperience.delete',$auth['username'],'Delete transactionalapplicantorganizationexperience');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Organization Experience Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantorganizationexperience');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Organization Experience UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantorganizationexperience');
			}
		}
	}
?>