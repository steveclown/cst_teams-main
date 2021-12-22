<?php
	Class transactionalapplicantaccidentexperience extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantaccidentexperience_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantaccidentexperience']		= $this->transactionalapplicantaccidentexperience_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantaccidentexperience/listtransactionalapplicantaccidentexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantaccidentexperience/addtransactionalapplicantaccidentexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantaccidentexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantaccidentexperience(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'accident_experience_period'=> $this->input->post('accident_experience_period',true),
				'accident_experience_remark'=> $this->input->post('accident_experience_remark',true),
				'accident_experience_consequence'=> $this->input->post('accident_experience_consequence',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantaccidentexperience_model->saveNewtransactionalapplicantaccidentexperience($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantaccidentexperience.processaddtransactionalapplicantaccidentexperience',$auth['username'],'Add New Transactional Applicant Accident Experience');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Accident Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantaccidentexperience');
					redirect('transactionalapplicantaccidentexperience/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Accident Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantaccidentexperience/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantaccidentexperience',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantaccidentexperience_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantaccidentexperience/edittransactionalapplicantaccidentexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantaccidentexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantaccidentexperience(){
			$data = array(
				'applicant_accident_experience_id'=> $this->input->post('applicant_accident_experience_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'accident_experience_period'=> $this->input->post('accident_experience_period',true),
				'accident_experience_remark'=> $this->input->post('accident_experience_remark',true),
				'accident_experience_consequence'=> $this->input->post('accident_experience_consequence',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantaccidentexperience_model->saveEdittransactionalapplicantaccidentexperience($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantaccidentexperience.Edit',$auth['username'],'Edit Transactional Applicant Accident Experience');
					$this->fungsi->set_change_log($old_accident_experience,$data,$auth['username'],$data['applicant_accident_experience_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Accident Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantaccidentexperience/Edit/'.$data['applicant_accident_experience_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Accident Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantaccidentexperience/Edit/'.$data['applicant_accident_experience_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience/Edit/'.$data['applicant_accident_experience_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantaccidentexperience_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantaccidentexperience.delete',$auth['username'],'Delete transactionalapplicantaccidentexperience');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Accident Experience Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Accident Experience UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience');
			}
		}
	}
?>