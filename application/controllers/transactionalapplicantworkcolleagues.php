<?php
	Class transactionalapplicantworkcolleagues extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantworkcolleagues_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantworkcolleagues']		= $this->transactionalapplicantworkcolleagues_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantworkcolleagues/listtransactionalapplicantworkcolleagues_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantworkcolleagues/addtransactionalapplicantworkcolleagues_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantworkcolleagues_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantworkcolleagues(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_work_colleagues_name'=> $this->input->post('applicant_work_colleagues_name',true),
				'applicant_work_colleagues_section'=> $this->input->post('applicant_work_colleagues_section',true),
				'applicant_work_colleagues_relatioship'=> $this->input->post('applicant_work_colleagues_relatioship',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantworkcolleagues_model->saveNewtransactionalapplicantworkcolleagues($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantworkcolleagues.processaddtransactionalapplicantworkcolleagues',$auth['username'],'Add New Transactional Applicant Work Colleagues');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Work Colleagues Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantworkcolleagues');
					redirect('transactionalapplicantworkcolleagues/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Work Colleagues UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantworkcolleagues/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantworkcolleagues',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkcolleagues/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantworkcolleagues_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantworkcolleagues/edittransactionalapplicantworkcolleagues_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantworkcolleagues_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantworkcolleagues(){
			$data = array(
				'applicant_work_colleagues_id'=> $this->input->post('applicant_work_colleagues_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'applicant_work_colleagues_name'=> $this->input->post('applicant_work_colleagues_name',true),
				'applicant_work_colleagues_section'=> $this->input->post('applicant_work_colleagues_section',true),
				'applicant_work_colleagues_relatioship'=> $this->input->post('applicant_work_colleagues_relatioship',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantworkcolleagues_model->saveEdittransactionalapplicantworkcolleagues($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantworkcolleagues.Edit',$auth['username'],'Edit Transactional Applicant Work Colleagues');
					$this->fungsi->set_change_log($old_work_colleagues,$data,$auth['username'],$data['applicant_work_colleagues_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Work Colleagues Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantworkcolleagues/Edit/'.$data['applicant_work_colleagues_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Work Colleagues UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantworkcolleagues/Edit/'.$data['applicant_work_colleagues_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkcolleagues/Edit/'.$data['applicant_work_colleagues_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantworkcolleagues_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantworkcolleagues.delete',$auth['username'],'Delete transactionalapplicantworkcolleagues');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Work Colleagues Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkcolleagues');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Work Colleagues UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkcolleagues');
			}
		}
	}
?>