<?php
	Class RecruitmentEmployeeRequest extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('RecruitmentEmployeeRequest_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['RecruitmentEmployeeRequest']	= $this->RecruitmentEmployeeRequest_model->getRecruitmentEmployeeRequest();
			$data['Main_view']['content']						= 'RecruitmentEmployeeRequest/listRecruitmentEmployeeRequest_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'education_id'						=> $this->input->post('education_id',true),
				'working_experience_job_title'		=> $this->input->post('working_experience_job_title',true),
				'employee_city'						=> $this->input->post('employee_city',true),
				'employee_application_position'		=> $this->input->post('employee_application_position',true),
			);
			$this->session->set_userdata('filter-RecruitmentEmployeeRequest',$data);
			redirect('RecruitmentEmployeeRequest/add');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addRecruitmentEmployeeRequest-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addRecruitmentEmployeeRequest-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addRecruitmentEmployeeRequest-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addRecruitmentEmployeeRequest-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-RecruitmentEmployeeRequest');
			$this->session->unset_userdata('filter-hroemployeelate');
			redirect('RecruitmentEmployeeRequest');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addRecruitmentEmployeeRequest-'.$sesi['unique']);	
			redirect('RecruitmentEmployeeRequest');
		}

		public function addRecruitmentEmployeeRequest(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-RecruitmentEmployeeRequest');

			$data['Main_view']['coreregion']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreRegion(),'region_id','region_name');

			$data['Main_view']['corebranch']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreBranch(),'branch_id','branch_name');

			$data['Main_view']['corelocation']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreLocation(),'location_id','location_name');

			$data['Main_view']['coredivision']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreDivision(),'division_id','division_name');

			$data['Main_view']['coredepartment']	= create_double($this->RecruitmentEmployeeRequest_model->getCoreDepartment(),'department_id','department_name');

			$data['Main_view']['coresection']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreSection(),'section_id','section_name');

			$data['Main_view']['corejobtitle']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['Main_view']['coreeducation']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreEducation(),'education_id','education_name');

			$data['Main_view']['coreexpertise']		= create_double($this->RecruitmentEmployeeRequest_model->getCoreExpertise(),'expertise_id','expertise_name');

			$data['Main_view']['content']			= 'RecruitmentEmployeeRequest/FormAddRecruitmentEmployeeRequest_view';

			$this->load->view('MainPage_view',$data);
		}

		public function processAddArrayRecruitmentEmployeeRequest(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = 
					array(
						'user_id'						=> $auth['user_id'],
						'employee_id'					=> $auth['employee_id'],
						'employee_request_title'		=> $this->input->post('employee_request_title',true),
						'employee_request_date'			=> $this->input->post('employee_request_date',true),
						'employee_request_due_date'		=> $this->input->post('employee_request_due_date',true),
						'employee_request_remark'		=> $this->input->post('employee_request_remark',true),
						'created_on'					=> date("Y-m-d H:i:s"),
						'created_id'					=> $auth['user_id'],
					);

			// print_r("data_header ");
			// print_r($data_header);		

			$this->form_validation->set_rules('employee_request_title', 'Employee Request Title', 'required');
			$this->form_validation->set_rules('employee_request_date', 'Employee Request Date', 'required');
			$this->form_validation->set_rules('employee_request_due_date', 'Employee Due Date', 'required');
			
			$data_item = 
					array(
						'record_id'								=> date("YmdHis"),
						'region_id'								=> $this->input->post('region_id',true),
						'branch_id'								=> $this->input->post('branch_id',true),
						'location_id'							=> $this->input->post('location_id',true),
						'division_id'							=> $this->input->post('division_id',true),
						'department_id'							=> $this->input->post('department_id',true),
						'section_id'							=> $this->input->post('section_id',true),
						'job_title_id'							=> $this->input->post('job_title_id',true),
						'education_id'							=> $this->input->post('education_id',true),
						'expertise_id'							=> $this->input->post('expertise_id',true),
						'employee_request_item_total'			=> $this->input->post('employee_request_item_total',true),
						'employee_request_item_description'		=> $this->input->post('employee_request_item_description',true),
						'employee_request_item_remark'			=> $this->input->post('employee_request_item_remark',true),
					);

				/*print_r($data_item); exit;*/
			$this->form_validation->set_rules('region_id', 'Region Name', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('expertise_id', 'Expertise Name', 'required');


			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addRecruitmentEmployeeRequest-'.$sesi['unique']);
				if(!is_array($header) || empty($header)){
					$this->session->set_userdata('addRecruitmentEmployeeRequest-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataRecruitmentEmployeeRequestitem-".$data_header['created_id']);
				
				$dataArray[$data_item['record_id']] = $data_item;
				$this->session->set_userdata("dataRecruitmentEmployeeRequestitem-".$data_header['created_id'],$dataArray);
				// $this->session->unset_userdata('addrequestemployee');
				$this->session->set_userdata('addRecruitmentEmployeeRequest',$data_header);	

				/*print_r($header);exit;*/
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentEmployeeRequest/addRecruitmentEmployeeRequest');
			}else{
				$this->session->set_userdata('addRecruitmentEmployeeRequest',$data_item);
				$this->session->set_userdata('addRecruitmentEmployeeRequest-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentEmployeeRequest/addRecruitmentEmployeeRequest');
			}
		}
		
		public function processAddRecruitmentEmployeeRequest(){
			$sesi 	= $this->session->userdata('unique');
			$auth	= $this->session->userdata('auth');

			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			
			$RecruitmentEmployeeRequest = $this->session->userdata('addRecruitmentEmployeeRequest-'.$sesi['unique']);

			$RecruitmentEmployeeRequestitem = $this->session->userdata("dataRecruitmentEmployeeRequestitem-".$RecruitmentEmployeeRequest['created_id']);
						
			$data_header=array(
						'user_id'									=> $auth['user_id'],
						'employee_id'								=> $auth['employee_id'],
						'employee_request_title'					=> $RecruitmentEmployeeRequest['employee_request_title'],
						'employee_request_date'						=> tgltodb($RecruitmentEmployeeRequest['employee_request_date']),
						'employee_request_due_date'					=> tgltodb($RecruitmentEmployeeRequest['employee_request_due_date']),
						'employee_request_status'					=> 0,
						'employee_request_remark'					=> $RecruitmentEmployeeRequest['employee_request_remark'],
						'created_on'								=> $RecruitmentEmployeeRequest['created_on'],
						'created_id'								=> $RecruitmentEmployeeRequest['created_id'],
					);		

			/*print_r("data_header ");
			print_r($data_header);
			exit;	*/
			if($this->RecruitmentEmployeeRequest_model->saveRecruitmentEmployeeRequest($data_header)){
				$employee_request_id = $this->RecruitmentEmployeeRequest_model->getEmployeeRequestID($data_header[created_id]);
				
				foreach($RecruitmentEmployeeRequestitem as $key=>$val){
					$data_item = array(
						'employee_request_id'					=> $employee_request_id,
						'region_id'								=> $val['region_id'],
						'branch_id'								=> $val['branch_id'],
						'location_id'							=> $val['location_id'],
						'division_id'							=> $val['division_id'],
						'department_id'							=> $val['department_id'],
						'section_id'							=> $val['section_id'],
						'job_title_id'							=> $val['job_title_id'],
						'education_id'							=> $val['education_id'],
						'expertise_id'							=> $val['expertise_id'],
						'employee_request_item_total'			=> $val['employee_request_item_total'],
						'employee_request_item_description'		=> $val['employee_request_item_description'],
						'employee_request_item_remark'			=> $val['employee_request_item_remark']
					);


					if($this->RecruitmentEmployeeRequest_model->saveRecruitmentEmployeeRequestItem($data_item)){
						$msg = "<div class='alert alert-success'>                
									Save Data Request Employee Successful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						continue;
					}else{
						$msg = "<div class='alert alert-danger'>                
									Save Data Request Employee Unsuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('RecruitmentEmployeeRequest/add');
					}
				}
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.requestemployee.add',$auth['username'],'Add Request Employee');
				$msg = "<div class='alert alert-success'>
							Save Data Request Employee Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				$sesi 		= $this->session->userdata('unique');
				$header = $this->session->userdata('addrequestemployee-'.$sesi['unique']);
				$this->session->unset_userdata("dataitemaddrequestemployee-".$header['created_by']);
				$this->session->unset_userdata('addrequestemployee-'.$sesi['unique']);
				redirect('RecruitmentEmployeeRequest');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Save Data Request Employee Unsuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentEmployeeRequest/add');
			}
		}
		
		public function resetrequestemployee(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addRecruitmentEmployeeRequest-'.$sesi['unique']);
			$this->session->unset_userdata("dataRecruitmentEmployeeRequestitem-".$header['created_id']);
			$this->session->unset_userdata('addRecruitmentEmployeeRequest-'.$sesi['unique']);
			redirect('RecruitmentEmployeeRequest/addRecruitmentEmployeeRequest');
		}
		
		public function showdetail(){
			$employee_request_id 									= $this->uri->segment(3);
			$data['Main_view']['RecruitmentEmployeeRequest']		= $this->RecruitmentEmployeeRequest_model->getRecruitmentEmployeeRequest_Detail($employee_request_id);
			$data['Main_view']['RecruitmentEmployeeRequestitem']	= $this->RecruitmentEmployeeRequest_model->getRecruitmentEmployeeRequestItem_Detail($employee_request_id);
			$data['Main_view']['employeerequeststatus']				= $this->configuration->EmployeeRequestStatus();
			$data['Main_view']['headerrequeststatus']				= $this->configuration->HeaderRequestStatus();
			$data['Main_view']['content']							= 'RecruitmentEmployeeRequest/formdetailRecruitmentEmployeeRequest_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function approval(){
			$data['Main_view']['RecruitmentEmployeeRequest_approval']	= $this->RecruitmentEmployeeRequest_model->getRecruitmentEmployeeRequest_Approval();
			$data['Main_view']['content']								= 'RecruitmentEmployeeRequest/ListRecruitmentEmployeeRequestApproval_view';
			$this->load->view('MainPage_view',$data);
		}

		public function approvalEmployeeRequest(){
			$employee_request_id 									= $this->uri->segment(3);
			$data['Main_view']['RecruitmentEmployeeRequest']		= $this->RecruitmentEmployeeRequest_model->getRecruitmentEmployeeRequest_Detail($employee_request_id);
			$data['Main_view']['RecruitmentEmployeeRequestitem']	= $this->RecruitmentEmployeeRequest_model->getRecruitmentEmployeeRequestItem_Detail($employee_request_id);
			$data['Main_view']['employeerequeststatus']				= $this->configuration->EmployeeRequestStatus();
			$data['Main_view']['headerrequeststatus']				= $this->configuration->HeaderRequestStatus();
			$data['Main_view']['content']							= 'RecruitmentEmployeeRequest/FormApprovalRecruitmentEmployeeRequest_view';
			$this->load->view('MainPage_view',$data);
		}

		public function processApprovalRecruitmentEmployeeRequest(){
			$auth					= $this->session->userdata('auth');
			$sesi 					= $this->session->userdata('unique');
			$employee_request_id  	= $this->input->post('employee_request_id');
			
			$data_approval = array(
				'employee_request_id'  				=> $this->input->post('employee_request_id'),
				'approved'							=> '1',
				'approved_id'						=> $auth['user_id'],
				'approved_on'						=> date('Ymdhis'),
				'approved_remark' 					=> $this->input->post('approved_remark'),
				'employee_request_status_remark' 	=> $this->input->post('employee_request_status_remark'),

			);
			
			if($this->RecruitmentEmployeeRequest_model->approvedRecruitmentEmployeeRequest($data_approval)){
				$auth = $this->session->userdata('auth');
				$msg = "<div class='alert alert-success alert-dismissable'>   
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
								Approve Data Canvas Order Requisition Success
							</div> ";
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>  
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>            
							Approve Data Canvas Order Requisition UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentEmployeeRequest/approvalEmployeeRequest/'.$employee_request_id);
				break;
			}

			$auth = $this->session->userdata('auth');
			$this->fungsi->set_log($auth['username'],'1005','Application.requestemployee.add',$auth['username'],'Add Request Employee');
			$msg = "<div class='alert alert-success'>
						Approve Data Canvas Order Requisition Success
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message',$msg);
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addrequestemployee-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddrequestemployee-".$header['created_by']);
			$this->session->unset_userdata('addrequestemployee-'.$sesi['unique']);
			redirect('RecruitmentEmployeeRequest/approval');
		}



		

		
		
		
		function delete(){
			$id = $this->input->post('employee_request_id',true);
			if($this->RecruitmentEmployeeRequest_model->delete($id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.requestemployee.delete',$auth['username'],'Delete Request Employee');
				$msg = "<div class='alert alert-success'>                
							Delete Data Request Employee Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentEmployeeRequest');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Request Employee UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentEmployeeRequest');
			}
		}
	}
?>