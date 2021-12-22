<?php
	Class transactionalapplicantworkingexperience extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantworkingexperience_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			// $this->lists();
			$this->Add();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantworkingexperience']		= $this->transactionalapplicantworkingexperience_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantworkingexperience/listtransactionalapplicantworkingexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantworkingexperience/addtransactionalapplicantworkingexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantworkingexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddtransactionalapplicantworkingexperience(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'company_name'=> $this->input->post('company_name',true),
							'company_address'=> $this->input->post('company_address',true),
							'working_experience_job_title'=> $this->input->post('working_experience_job_title',true),
							'working_experience_from_period'=> $this->input->post('working_experience_from_period',true),
							'working_experience_to_period'=> $this->input->post('working_experience_to_period',true),
							'working_experience_last_salary'=> $this->input->post('working_experience_last_salary',true),
							'working_experience_resign_reason'=> $this->input->post('working_experience_resign_reason',true),
							'working_experience_resign_letter'=> $this->input->post('working_experience_resign_letter',true),
							'working_experience_remark'=> $this->input->post('working_experience_remark',true),
							'data_state'							=> '0',
							'created_by'							=> $auth['username'],
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('company_name', 'Company Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('company_address', 'Address', 'filterspecialchar');
			$this->form_validation->set_rules('working_experience_job_title', 'Job Title', 'required|filterspecialchar');
			$this->form_validation->set_rules('working_experience_from_period', 'From Period', 'required');
			$this->form_validation->set_rules('working_experience_to_period', 'To Period', 'required');
			$this->form_validation->set_rules('working_experience_last_salary', 'Last Salary', 'required|numeric');
			$this->form_validation->set_rules('working_experience_resign_reason', 'Resign Reason', 'required|filterspecialchar');
			$this->form_validation->set_rules('working_experience_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique']);
				$this->session->set_userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddtransactionalapplicantworkingexperience-".$data_header['created_on']);
				
				// $dataArray[$data_item['workingexperience_id'].$data_item['workingexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddtransactionalapplicantworkingexperience-".$data_header['created_on'],$dataArray);
				$this->session->unset_userdata('addtransactionalapplicantworkingexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkingexperience');
			}else{
				$this->session->set_userdata('addtransactionalapplicantworkingexperience',$data_item);
				$this->session->set_userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkingexperience');
			}
			
		}
		
		public function resetapplicantworkingexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddtransactionalapplicantworkingexperience-".$header['created_on']);
			$this->session->unset_userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique']);
			redirect('transactionalapplicantworkingexperience');
		}
		
		public function deletearrayapplicantworkingexperienceitem(){
			$arrayBaru		=array();
			$created_on				= $this->uri->segment(3);
			$keyZ 			= $this->uri->segment(4);
			$transactionalapplicantworkingexperience				= $this->session->userdata("dataitemaddtransactionalapplicantworkingexperience-".$created_on);
			// print_r($transactionalapplicantworkingexperience); exit;
			foreach($transactionalapplicantworkingexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddtransactionalapplicantworkingexperience-'.$created_on,$arrayBaru);
			redirect('transactionalapplicantworkingexperience');
		}
		
		function processaddtransactionalapplicantworkingexperience(){
			redirect('transactionalapplicantinterviewexperience');
		}
/* 		
		function processaddtransactionalapplicantworkingexperience(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'company_name'=> $this->input->post('company_name',true),
				'company_address'=> $this->input->post('company_address',true),
				'working_experience_job_title'=> $this->input->post('working_experience_job_title',true),
				'working_experience_from_period'=> $this->input->post('working_experience_from_period',true),
				'working_experience_to_period'=> $this->input->post('working_experience_to_period',true),
				'working_experience_last_salary'=> $this->input->post('working_experience_last_salary',true),
				'working_experience_resign_reason'=> $this->input->post('working_experience_resign_reason',true),
				'working_experience_resign_letter'=> $this->input->post('working_experience_resign_letter',true),
				'working_experience_remark'=> $this->input->post('working_experience_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantworkingexperience_model->saveNewtransactionalapplicantworkingexperience($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantworkingexperience.processaddtransactionalapplicantworkingexperience',$auth['username'],'Add New Transactional Applicant Working Experience');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Working Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantworkingexperience');
					redirect('transactionalapplicantworkingexperience/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Working Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantworkingexperience/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantworkingexperience',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkingexperience/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantworkingexperience_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantworkingexperience/edittransactionalapplicantworkingexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantworkingexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantworkingexperience(){
			$data = array(
				'applicant_working_experience_id'=> $this->input->post('applicant_working_experience_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'company_name'=> $this->input->post('company_name',true),
				'company_address'=> $this->input->post('company_address',true),
				'working_experience_job_title'=> $this->input->post('working_experience_job_title',true),
				'working_experience_from_period'=> $this->input->post('working_experience_from_period',true),
				'working_experience_to_period'=> $this->input->post('working_experience_to_period',true),
				'working_experience_last_salary'=> $this->input->post('working_experience_last_salary',true),
				'working_experience_resign_reason'=> $this->input->post('working_experience_resign_reason',true),
				'working_experience_resign_letter'=> $this->input->post('working_experience_resign_letter',true),
				'working_experience_remark'=> $this->input->post('working_experience_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantworkingexperience_model->saveEdittransactionalapplicantworkingexperience($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantworkingexperience.Edit',$auth['username'],'Edit Transactional Applicant Working Experience');
					$this->fungsi->set_change_log($old_working_experience,$data,$auth['username'],$data['applicant_working_experience_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Working Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantworkingexperience/Edit/'.$data['applicant_working_experience_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Working Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantworkingexperience/Edit/'.$data['applicant_working_experience_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkingexperience/Edit/'.$data['applicant_working_experience_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantworkingexperience_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantworkingexperience.delete',$auth['username'],'Delete transactionalapplicantworkingexperience');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Working Experience Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkingexperience');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Working Experience UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantworkingexperience');
			}
		} */
	}
?>