<?php
	Class transactionalapplicantlawexperience extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantlawexperience_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantlawexperience']		= $this->transactionalapplicantlawexperience_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantlawexperience/listtransactionalapplicantlawexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantlawexperience/addtransactionalapplicantlawexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantlawexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantlawexperience(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_law_experience_period'=> $this->input->post('applicant_law_experience_period',true),
				'applicant_law_location'=> $this->input->post('applicant_law_location',true),
				'applicant_law_remark'=> $this->input->post('applicant_law_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantlawexperience_model->saveNewtransactionalapplicantlawexperience($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantlawexperience.processaddtransactionalapplicantlawexperience',$auth['username'],'Add New Transactional Applicant Law Experience');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Law Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantlawexperience');
					redirect('transactionalapplicantlawexperience/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Law Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantlawexperience/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantlawexperience',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantlawexperience/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantlawexperience_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantlawexperience/edittransactionalapplicantlawexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantlawexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantlawexperience(){
			$data = array(
				'applicant_law_experience_id'=> $this->input->post('applicant_law_experience_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_law_experience_period'=> $this->input->post('applicant_law_experience_period',true),
				'applicant_law_location'=> $this->input->post('applicant_law_location',true),
				'applicant_law_remark'=> $this->input->post('applicant_law_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantlawexperience_model->saveEdittransactionalapplicantlawexperience($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantlawexperience.Edit',$auth['username'],'Edit Transactional Applicant Law Experience');
					$this->fungsi->set_change_log($old_law_experience,$data,$auth['username'],$data['applicant_law_experience_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Law Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantlawexperience/Edit/'.$data['applicant_law_experience_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Law Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantlawexperience/Edit/'.$data['applicant_law_experience_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantlawexperience/Edit/'.$data['applicant_law_experience_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantlawexperience_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantlawexperience.delete',$auth['username'],'Delete transactionalapplicantlawexperience');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Law Experience Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantlawexperience');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Law Experience UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantlawexperience');
			}
		}
	}
?>