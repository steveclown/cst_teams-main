<?php
	Class transactionalapplicantmedicalrecord extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantmedicalrecord_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantmedicalrecord']		= $this->transactionalapplicantmedicalrecord_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantmedicalrecord/listtransactionalapplicantmedicalrecord_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantmedicalrecord/addtransactionalapplicantmedicalrecord_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantmedicalrecord_model->getapplicant(),'applicant_id','applicant_name');
			$data['main_view']['familystatus']	= create_double($this->transactionalapplicantmedicalrecord_model->getfamilystatus(),'family_status_id','family_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantmedicalrecord(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'family_status_id'=> $this->input->post('family_status_id',true),
				'applicant_medical_disease'=> $this->input->post('applicant_medical_disease',true),
				'applicant_medical_name'=> $this->input->post('applicant_medical_name',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantmedicalrecord_model->saveNewtransactionalapplicantmedicalrecord($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantmedicalrecord.processaddtransactionalapplicantmedicalrecord',$auth['username'],'Add New Transactional Applicant Medical Record');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Medical Record Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantmedicalrecord');
					redirect('transactionalapplicantmedicalrecord/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Medical Record UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantmedicalrecord/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantmedicalrecord',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantmedicalrecord/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantmedicalrecord_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantmedicalrecord/edittransactionalapplicantmedicalrecord_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantmedicalrecord_model->getapplicant(),'applicant_id','applicant_name');
			$data['main_view']['familystatus']	= create_double($this->transactionalapplicantmedicalrecord_model->getfamilystatus(),'family_status_id','family_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantmedicalrecord(){
			$data = array(
				'applicant_medical_record_id'=> $this->input->post('applicant_medical_record_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'family_status_id'=> $this->input->post('family_status_id',true),
				'applicant_medical_disease'=> $this->input->post('applicant_medical_disease',true),
				'applicant_medical_name'=> $this->input->post('applicant_medical_name',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantmedicalrecord_model->saveEdittransactionalapplicantmedicalrecord($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantmedicalrecord.Edit',$auth['username'],'Edit Transactional Applicant Medical Record');
					$this->fungsi->set_change_log($old_medical_record,$data,$auth['username'],$data['applicant_medical_record_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Medical Record Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantmedicalrecord/Edit/'.$data['applicant_medical_record_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Medical Record UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantmedicalrecord/Edit/'.$data['applicant_medical_record_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantmedicalrecord/Edit/'.$data['applicant_medical_record_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantmedicalrecord_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantmedicalrecord.delete',$auth['username'],'Delete transactionalapplicantmedicalrecord');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Medical Record Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantmedicalrecord');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Medical Record UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantmedicalrecord');
			}
		}
	}
?>