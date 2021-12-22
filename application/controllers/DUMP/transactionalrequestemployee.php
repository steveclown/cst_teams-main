<?php
	Class transactionalrequestemployee extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalrequestemployee_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->void();
		}

		public function void(){
			$data['main_view']['transactionalrequestemployee']		= $this->transactionalrequestemployee_model->get_listvoid();
			$data['main_view']['content']	= 'transactionalrequestemployee/listvoidrequestemployee_view';
			$this->load->view('mainpage_view',$data);
		}




		
		public function daftar(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= 	$this->session->userdata('filter-transactionalrequestemployee');
			if(!is_array($sesi)){
					$sesi['education_id']						='';
					$sesi['working_experience_job_title']		='';
					$sesi['applicant_city']						='';
					$sesi['applicant_application_position']						='';
			}
			$data['main_view']['content']		= 'transactionalrequestemployee/formaddrequestemployee_view';
			$data['main_view']['education']	= create_double($this->transactionalrequestemployee_model->geteducation(),'education_id','education_name');
			$data['main_view']['applicant']		= create_double($this->transactionalrequestemployee_model->get_list($sesi['education_id'],$sesi['working_experience_job_title'],$sesi['applicant_city'],$sesi['applicant_application_position']),'applicant_id','applicant_name');
			
			$data['main_view']['region']		= create_double($this->transactionalrequestemployee_model->getregion(),'region_id','region_name');
			$data['main_view']['branch']		= create_double($this->transactionalrequestemployee_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['division']		= create_double($this->transactionalrequestemployee_model->getdivision(),'division_id','division_name');
			$data['main_view']['department']	= create_double($this->transactionalrequestemployee_model->getdepartment(),'department_id','department_name');
			$data['main_view']['section']		= create_double($this->transactionalrequestemployee_model->getsection(),'section_id','section_name');
			$data['main_view']['location']		= create_double($this->transactionalrequestemployee_model->getlocation(),'location_id','location_name');$data['main_view']['jobtitle']		= create_double($this->transactionalrequestemployee_model->getjobtitle(),'job_title_id','job_title_name');
			$data['main_view']['grade']			= create_double($this->transactionalrequestemployee_model->getgrades(),'grade_id','grade_name');
			$data['main_view']['class']			= create_double($this->transactionalrequestemployee_model->getclasss(),'class_id','class_name');
			
			
			$data['main_view']['requeststatus']		= $this->configuration->RequestStatus;
			$this->load->view('mainpage_view',$data);
		}
		
		

		


		public function resetall(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addrequestemployee-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddrequestemployee-".$header['created_by']);
			$this->session->unset_userdata('addrequestemployee-'.$sesi['unique']);
		}
		
		public function deletearrayrequestemployeeitem(){
			$arrayBaru			= array();
			$keyZ 				= $this->uri->segment(3);
			$sesi 				= $this->session->userdata('unique');
			$header				= $this->session->userdata('addrequestemployee-'.$sesi['unique']);
			$requestemployee	= $this->session->userdata("dataitemaddrequestemployee-".$header[created_by]);
			// print_r($requestemployee); exit;
			foreach($requestemployee as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addrequestemployee-'.$sesi['unique']);
				$this->session->unset_userdata('addrequestemployee-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddrequestemployee-'.$header[created_by],$arrayBaru);
			redirect('transactionalrequestemployee/daftar');
		}
		
		function arrayaddrequestemployee(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
								'region_id'						=> $this->input->post('region_id',true),
								'branch_id'						=> $this->input->post('branch_id',true),
								'division_id'					=> $this->input->post('division_id',true),
								'department_id'					=> $this->input->post('department_id',true),
								'section_id'					=> $this->input->post('section_id',true),
								'location_id'					=> $this->input->post('location_id',true),
								'applicant_request_date'		=> $this->input->post('applicant_request_date',true),
								'applicant_request_due_date'	=> $this->input->post('applicant_request_due_date',true),
								'applicant_request_title'		=> $this->input->post('applicant_request_title',true),
								'applicant_request_remark'		=> $this->input->post('applicant_request_remark',true),
								'created_on'					=> $this->input->post('created_on',true),
								'created_by'					=> $this->input->post('created_by',true),
			);
			$this->form_validation->set_rules('region_id', 'Region', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');
			$this->form_validation->set_rules('division_id', 'Division', 'required');
			$this->form_validation->set_rules('department_id', 'Department', 'required');
			$this->form_validation->set_rules('section_id', 'Section', 'required');
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('applicant_request_date', 'Request Date', 'required');
			$this->form_validation->set_rules('applicant_request_due_date', 'Due Date', 'required');
			$this->form_validation->set_rules('applicant_request_title', 'Title', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_request_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
				'applicant_id'		=> $this->input->post('applicant_id',true),
				'applicant_name'	=> $this->input->post('applicant_name',true),
				'created_by'		=> $this->input->post('created_by',true),
				'created_on'		=> $this->input->post('created_on',true),
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			// print_r($data_item);exit;
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addrequestemployee-'.$sesi['unique']);
				$this->session->set_userdata('addrequestemployee-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addrequestemployee-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddrequestemployee-".$data_header['created_by']);
				
				// $dataArray[$data_item['education_id'].$data_item['education_type']] = $data_item;
				$dataArray[$data_item['applicant_id']] = $data_item;
				$this->session->set_userdata("dataitemaddrequestemployee-".$data_header['created_by'],$dataArray);
				// $this->session->unset_userdata('addrequestemployee');
				$this->session->set_userdata('addrequestemployee',$data_header);				
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalrequestemployee/daftar');
			}else{
				$this->session->set_userdata('addrequestemployee',$data_item);
				$this->session->set_userdata('addrequestemployee-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalrequestemployee/daftar');
			}
		}
		
		public function processaddtransactionalrequestemployee(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			
			$headerrequestemployee = $this->session->userdata('addrequestemployee-'.$sesi['unique']);
			$arrayerequestemployee = $this->session->userdata("dataitemaddrequestemployee-".$headerrequestemployee['created_by']);
			
			if($this->transactionalrequestemployee_model->saverequestemployee($headerrequestemployee)){
				$request_id = $this->transactionalrequestemployee_model->getrequestid($headerrequestemployee[created_on],$headerrequestemployee[created_by]);
				foreach($arrayerequestemployee as $key=>$val){
					$data_item = array(
										'applicant_request_id'			=> $request_id,
										'applicant_id'					=> $val[applicant_id],
										'applicant_request_status' 		=> '0',
					);
					if($this->transactionalrequestemployee_model->saverequestemployeeitem($data_item)){
						$msg = "<div class='alert alert-success'>                
									Save Data Applicant Successful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						continue;
					}else{
						$msg = "<div class='alert alert-danger'>                
									Save Data Request Applicant Unsuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalrequestemployee/daftar');
					}
				}
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.requestemployee.add',$auth['username'],'Add Request Employee');
				$msg = "<div class='alert alert-success'>
							Save Data Applicant Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				// $this->reset_search();
				$this->resetall();
				redirect('transactionalrequestemployee');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Save Data Request Applicant Unsuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalrequestemployee/daftar');
			}
		}
		
}
?>