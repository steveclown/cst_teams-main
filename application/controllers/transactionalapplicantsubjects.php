<?php
	Class transactionalapplicantsubjects extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantsubjects_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantsubjects']		= $this->transactionalapplicantsubjects_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantsubjects/listtransactionalapplicantsubjects_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantsubjects/addtransactionalapplicantsubjects_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantsubjects_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantsubjects(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'								=> $this->input->post('status',true),
				'applicant_id'							=> $this->input->post('applicant_id',true),
				'applicant_subjects_status'				=> $this->input->post('applicant_subjects_status',true),
				'applicant_subjects_name'				=> $this->input->post('applicant_subjects_name',true),
				'applicant_subjects_remark'				=> $this->input->post('applicant_subjects_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantsubjects_model->saveNewtransactionalapplicantsubjects($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantsubjects.processaddtransactionalapplicantsubjects',$auth['username'],'Add New Transactional Applicant Subjects');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Subjects Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantsubjects');
					redirect('transactionalapplicantsubjects/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Subjects UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantsubjects/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantsubjects',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantsubjects/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantsubjects_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantsubjects/edittransactionalapplicantsubjects_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantsubjects_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantsubjects(){
			$data = array(
				'applicant_subjects_id'=> $this->input->post('applicant_subjects_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_subjects_status'=> $this->input->post('applicant_subjects_status',true),
				'applicant_subjects_name'=> $this->input->post('applicant_subjects_name',true),
				'applicant_subjects_remark'=> $this->input->post('applicant_subjects_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantsubjects_model->saveEdittransactionalapplicantsubjects($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantsubjects.Edit',$auth['username'],'Edit Transactional Applicant Subjects');
					$this->fungsi->set_change_log($old_subjects,$data,$auth['username'],$data['applicant_subjects_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Subjects Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantsubjects/Edit/'.$data['applicant_subjects_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Subjects UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantsubjects/Edit/'.$data['applicant_subjects_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantsubjects/Edit/'.$data['applicant_subjects_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantsubjects_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantsubjects.delete',$auth['username'],'Delete transactionalapplicantsubjects');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Subjects Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantsubjects');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Subjects UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantsubjects');
			}
		}
	}
?>