<?php
	Class transactionalapplicantpersonality extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantpersonality_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantpersonality']		= $this->transactionalapplicantpersonality_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantpersonality/listtransactionalapplicantpersonality_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantpersonality/addtransactionalapplicantpersonality_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantpersonality_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantpersonality(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_strength_remark'=> $this->input->post('applicant_strength_remark',true),
				'applicant_weakness_remark'=> $this->input->post('applicant_weakness_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantpersonality_model->saveNewtransactionalapplicantpersonality($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantpersonality.processaddtransactionalapplicantpersonality',$auth['username'],'Add New Transactional Applicant Personality');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Personality Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantpersonality');
					redirect('transactionalapplicantpersonality/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Personality UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantpersonality/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantpersonality',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantpersonality/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantpersonality_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantpersonality/edittransactionalapplicantpersonality_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantpersonality_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantpersonality(){
			$data = array(
				'applicant_personality_id'=> $this->input->post('applicant_personality_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_strength_remark'=> $this->input->post('applicant_strength_remark',true),
				'applicant_weakness_remark'=> $this->input->post('applicant_weakness_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantpersonality_model->saveEdittransactionalapplicantpersonality($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantpersonality.Edit',$auth['username'],'Edit Transactional Applicant Personality');
					$this->fungsi->set_change_log($old_personality,$data,$auth['username'],$data['applicant_personality_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Personality Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantpersonality/Edit/'.$data['applicant_personality_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Personality UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantpersonality/Edit/'.$data['applicant_personality_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantpersonality/Edit/'.$data['applicant_personality_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantpersonality_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantpersonality.delete',$auth['username'],'Delete transactionalapplicantpersonality');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Personality Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantpersonality');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Personality UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantpersonality');
			}
		}
	}
?>