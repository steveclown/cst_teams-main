<?php
	Class transactionalapplicantinterviewexperience extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantinterviewexperience_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantinterviewexperience']		= $this->transactionalapplicantinterviewexperience_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantinterviewexperience/listtransactionalapplicantinterviewexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantinterviewexperience/addtransactionalapplicantinterviewexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantinterviewexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantinterviewexperience(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_interview_experience_period'=> $this->input->post('applicant_interview_experience_period',true),
				'applicant_interview_location'=> $this->input->post('applicant_interview_location',true),
				'applicant_interview_remark'=> $this->input->post('applicant_interview_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantinterviewexperience_model->saveNewtransactionalapplicantinterviewexperience($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantinterviewexperience.processaddtransactionalapplicantinterviewexperience',$auth['username'],'Add New Transactional Applicant Interview Experience');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Interview Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantinterviewexperience');
					redirect('transactionalapplicantinterviewexperience/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Interview Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantinterviewexperience/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantinterviewexperience',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantinterviewexperience/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantinterviewexperience_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantinterviewexperience/edittransactionalapplicantinterviewexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantinterviewexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantinterviewexperience(){
			$data = array(
				'applicant_interview_experience_id'=> $this->input->post('applicant_interview_experience_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_interview_experience_period'=> $this->input->post('applicant_interview_experience_period',true),
				'applicant_interview_location'=> $this->input->post('applicant_interview_location',true),
				'applicant_interview_remark'=> $this->input->post('applicant_interview_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantinterviewexperience_model->saveEdittransactionalapplicantinterviewexperience($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantinterviewexperience.Edit',$auth['username'],'Edit Transactional Applicant Interview Experience');
					$this->fungsi->set_change_log($old_interview_experience,$data,$auth['username'],$data['applicant_interview_experience_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Interview Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantinterviewexperience/Edit/'.$data['applicant_interview_experience_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Interview Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantinterviewexperience/Edit/'.$data['applicant_interview_experience_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantinterviewexperience/Edit/'.$data['applicant_interview_experience_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantinterviewexperience_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantinterviewexperience.delete',$auth['username'],'Delete transactionalapplicantinterviewexperience');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Interview Experience Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantinterviewexperience');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Interview Experience UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantinterviewexperience');
			}
		}
	}
?>