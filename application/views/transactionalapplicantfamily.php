<?php
	Class transactionalapplicantfamily extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantfamily_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantfamily']		= $this->transactionalapplicantfamily_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantfamily/listtransactionalapplicantfamily_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantfamily/addtransactionalapplicantfamily_view';
			$data['main_view']['maritalstatus']	= create_double($this->transactionalapplicantfamily_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$data['main_view']['familystatus']	= create_double($this->transactionalapplicantfamily_model->getfamilystatus(),'family_status_id','family_status_name');
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantfamily_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantfamily(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'								=> $this->input->post('status',true),
				'family_status_id'						=> $this->input->post('family_status_id',true),
				'applicant_id'							=> $this->input->post('applicant_id',true),
				'applicant_family_name'					=> $this->input->post('applicant_family_name',true),
				'applicant_family_address'				=> $this->input->post('applicant_family_address',true),
				'applicant_family_city'					=> $this->input->post('applicant_family_city',true),
				'applicant_family_zip_code'				=> $this->input->post('applicant_family_zip_code',true),
				'applicant_family_rt'					=> $this->input->post('applicant_family_rt',true),
				'applicant_family_rw'					=> $this->input->post('applicant_family_rw',true),
				'applicant_family_kecamatan'			=> $this->input->post('applicant_family_kecamatan',true),
				'applicant_family_kelurahan'			=> $this->input->post('applicant_family_kelurahan',true),
				'applicant_family_home_phone'			=> $this->input->post('applicant_family_home_phone',true),
				'applicant_family_mobile_phone1'		=> $this->input->post('applicant_family_mobile_phone1',true),
				'applicant_family_mobile_phone2'		=> $this->input->post('applicant_family_mobile_phone2',true),
				'applicant_family_gender'				=> $this->input->post('applicant_family_gender',true),
				'applicant_family_date_of_birth'		=> $this->input->post('applicant_family_date_of_birth',true),
				'applicant_family_place_of_birth'		=> $this->input->post('applicant_family_place_of_birth',true),
				'applicant_family_education'			=> $this->input->post('applicant_family_education',true),
				'applicant_family_occupation'			=> $this->input->post('applicant_family_occupation',true),
				'marital_status_id'						=> $this->input->post('marital_status_id',true),
				'applicant_family_remark'				=> $this->input->post('applicant_family_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantfamily_model->saveNewtransactionalapplicantfamily($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantfamily.processaddtransactionalapplicantfamily',$auth['username'],'Add New Transactional Applicant Family');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Family Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantfamily');
					redirect('transactionalapplicantfamily/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Family UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantfamily/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantfamily',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantfamily_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantfamily/edittransactionalapplicantfamily_view';
			$data['main_view']['maritalstatus']		= create_double($this->transactionalapplicantfamily_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$data['main_view']['familystatus']	= create_double($this->transactionalapplicantfamily_model->getfamilystatus(),'family_status_id','family_status_name');
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantfamily_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantfamily(){
			$data = array(
				'applicant_family_id'					=> $this->input->post('applicant_family_id',true),
				'status'								=> $this->input->post('status',true),
				'family_status_id'						=> $this->input->post('family_status_id',true),
				'applicant_id'							=> $this->input->post('applicant_id',true),
				'applicant_family_name'					=> $this->input->post('applicant_family_name',true),
				'applicant_family_address'				=> $this->input->post('applicant_family_address',true),
				'applicant_family_city'					=> $this->input->post('applicant_family_city',true),
				'applicant_family_zip_code'				=> $this->input->post('applicant_family_zip_code',true),
				'applicant_family_rt'					=> $this->input->post('applicant_family_rt',true),
				'applicant_family_rw'					=> $this->input->post('applicant_family_rw',true),
				'applicant_family_kecamatan'			=> $this->input->post('applicant_family_kecamatan',true),
				'applicant_family_kelurahan'			=> $this->input->post('applicant_family_kelurahan',true),
				'applicant_family_home_phone'			=> $this->input->post('applicant_family_home_phone',true),
				'applicant_family_mobile_phone1'		=> $this->input->post('applicant_family_mobile_phone1',true),
				'applicant_family_mobile_phone2'		=> $this->input->post('applicant_family_mobile_phone2',true),
				'applicant_family_gender'				=> $this->input->post('applicant_family_gender',true),
				'applicant_family_date_of_birth'		=> $this->input->post('applicant_family_date_of_birth',true),
				'applicant_family_place_of_birth'		=> $this->input->post('applicant_family_place_of_birth',true),
				'applicant_family_education'			=> $this->input->post('applicant_family_education',true),
				'applicant_family_occupation'			=> $this->input->post('applicant_family_occupation',true),
				'marital_status_id'						=> $this->input->post('marital_status_id',true),
				'applicant_family_remark'				=> $this->input->post('applicant_family_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantfamily_model->saveEdittransactionalapplicantfamily($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantfamily.Edit',$auth['username'],'Edit Transactional Applicant Family');
					$this->fungsi->set_change_log($old_family,$data,$auth['username'],$data['applicant_family_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Family Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantfamily/Edit/'.$data['applicant_family_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Family UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantfamily/Edit/'.$data['applicant_family_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily/Edit/'.$data['applicant_family_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantfamily_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantfamily.delete',$auth['username'],'Delete transactionalapplicantfamily');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Family Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Family UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily');
			}
		}
	}
?>