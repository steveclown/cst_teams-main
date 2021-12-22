<?php
	Class assignmentbusinesstrip extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('assignmentbusinesstrip_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-assignmentbusinesstrip');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->assignmentbusinesstrip_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']				= create_double($this->assignmentbusinesstrip_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']					= create_double($this->assignmentbusinesstrip_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['hroemployeedata']				= create_double($this->assignmentbusinesstrip_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_businesstrip']	= $this->assignmentbusinesstrip_model->getHROEmployeeData_BusinessTrip($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'assignmentbusinesstrip/listassignmentbusinesstrip_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-assignmentbusinesstrip',$data);
			redirect('assignmentbusinesstrip');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-assignmentbusinesstrip');
			$this->session->unset_userdata('filter-assignmentbusinesstrip');
			redirect('assignmentbusinesstrip');
		}
		
		public function addAssignmentBusinessTrip(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->assignmentbusinesstrip_model->getHROEmployeeData($employee_id);
			$data['main_view']['assignmentbusinesstrip_data']	= $this->assignmentbusinesstrip_model->getAssignmentBusinessTrip_Data($employee_id);
			$data['main_view']['assignmentovertimerate']		= create_double($this->assignmentbusinesstrip_model->getAssignmentOvertimeRate(),'overtime_rate_id','overtime_rate_description');
			$data['main_view']['coredivision']					= create_double($this->assignmentbusinesstrip_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['corejobtitle']					= create_double($this->assignmentbusinesstrip_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['content']						= 'assignmentbusinesstrip/listaddassignmentbusinesstrip_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addassignmentbusinesstrip-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addassignmentbusinesstrip-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addassignmentbusinesstrip-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addassignmentbusinesstrip-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addassignmentbusinesstrip-'.$sesi['unique']);	
			redirect('assignmentbusinesstrip');
		}

		public function getAssignmentOvertimeRateTitle(){
			$overtime_rate_id = $this->input->post('overtime_rate_id');

			$item = $this->assignmentbusinesstrip_model->getAssignmentOvertimeRateTitle($overtime_rate_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[job_title_id]'>$mp[job_title_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreDepartment_Detail(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->assignmentbusinesstrip_model->getCoreDepartment_Detail($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection_Detail(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->assignmentbusinesstrip_model->getCoreSection_Detail($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData_Detail(){
			$auth = $this->session->userdata('auth');

			$data_employee = array (
				'region_id'		=> $auth['region_id'],
				'branch_id'		=> $auth['branch_id'],
				'location_id'	=> $auth['location_id'],
				'division_id'	=> $this->input->post('division_id'),
				'department_id'	=> $this->input->post('department_id'),
				'section_id'	=> $this->input->post('section_id'),
				'job_title_id'	=> $this->input->post('job_title_id')
			);	
			
			$item = $this->assignmentbusinesstrip_model->getHROEmployeeData_Detail($data_employee);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function getAssignmentOvertimeRateTitle_Allowance(){
			$overtime_rate_id 	= $this->input->post('overtime_rate_id');
			$job_title_id 		= $this->input->post('job_title_id');
			
			$item = $this->assignmentbusinesstrip_model->getAssignmentOvertimeRateTitle_Allowance($overtime_rate_id, $job_title_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[allowance_id]'>$mp[allowance_name]</option>\n";	
			}
			echo $data;
		}

		public function getOvertimeRateAllowanceAmount(){
			$overtime_rate_id 	= $this->input->post("overtime_rate_id");
			$job_title_id 		= $this->input->post("job_title_id");
			$allowance_id 		= $this->input->post("allowance_id");

			/*$employee_medical_coverage_id = "11";*/
			$data = $this->assignmentbusinesstrip_model->getOvertimeRateAllowanceAmount($overtime_rate_id, $job_title_id, $allowance_id);
			/*print_r($data);exit;*/
			echo $data;
		}

		public function processAddArrayBusinessTripAllowance(){

			$data_businesstripallowance = array(
				'business_trip_allowance_id'		=> date("YmdHis"),
				'job_title_id'						=> $this->input->post('job_title_id', true),
				'allowance_id'						=> $this->input->post('allowance_id', true),
				'business_trip_allowance_amount'	=> $this->input->post('business_trip_allowance_amount', true),
			);

			/*print_r($data_businesstripallowance);
			exit;*/

			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allownace Name', 'required');
			$this->form_validation->set_rules('business_trip_allowance_amount', 'Allownace Amount', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraybusinesstripallowance-'.$unique['unique']);
				// $dataArrayHeader[$data['item_id'].'-'.$data['quantity'].'-'.$data['item_unit_id']] = $data;
				$dataArrayHeader[$data_businesstripallowance['business_trip_allowance_id']] = $data_businesstripallowance;
				
				$this->session->set_userdata('addarraybusinesstripallowance-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_businesstripallowance = $this->session->userdata('addassignmentbusinesstrip-'.$sesi['unique']);
				
				$data_businesstripallowance['job_title_id'] = '';
				$data_businesstripallowance['allowance_id'] = '';
				$data_businesstripallowance['business_trip_allowance_amount'] = '';
				
				$this->session->set_userdata('addassignmentbusinesstrip-'.$sesi['unique'],$data_businesstripallowance);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function processAddArrayBusinessTripEmployee(){
			$auth = $this->session->userdata('auth');
			$employee_id = $this->input->post('employee_id', true);
			$employee_id_assign = $this->input->post('employee_id_assign', true);

			$data_employee = $this->assignmentbusinesstrip_model->getHROEmployeeData($employee_id);

			$data_businesstripemployee = array(
				'business_trip_employee_id'			=> date("YmdHis"),
				'employee_id'						=> $this->input->post('employee_id', true),
				'region_id' 						=> $auth['region_id'],
				'branch_id' 						=> $auth['branch_id'],
				'location_id' 						=> $auth['location_id'],
				'division_id' 						=> $this->input->post('division_id', true),
				'department_id'						=> $this->input->post('department_id', true),
				'section_id' 						=> $this->input->post('section_id', true),
				'job_title_id' 						=> $this->input->post('job_title_id', true),
			);

			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraybusinesstripemployee-'.$unique['unique']);
				// $dataArrayHeader[$data['item_id'].'-'.$data['quantity'].'-'.$data['item_unit_id']] = $data;
				$dataArrayHeader[$data_businesstripemployee['business_trip_employee_id']] = $data_businesstripemployee;
				
				$this->session->set_userdata('addarraybusinesstripemployee-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_businesstripemployee = $this->session->userdata('addassignmentbusinesstrip-'.$sesi['unique']);
				
				$data_businesstripemployee['employee_id'] = '';
				
				$this->session->set_userdata('data_businesstripemployee-'.$sesi['unique'],$data_businesstripemployee);

			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function processAddAssignmentBusinessTrip(){
			$auth = $this->session->userdata('auth');

			$session_businesstripallowance		= $this->session->userdata('addarraybusinesstripallowance-'.$unique['unique']);
			$session_businesstripemployee		= $this->session->userdata('addarraybusinesstripemployee-'.$unique['unique']);	

			$employee_id 	= $this->input->post('employee_id_assign', true);	
			$data_employee 	= $this->assignmentbusinesstrip_model->getHROEmployeeData($employee_id);
			
			$data = array(
				'employee_id'					=> $this->input->post('employee_id_assign',true),
				'region_id' 					=> $auth['region_id'],
				'branch_id' 					=> $auth['branch_id'],
				'location_id' 					=> $auth['location_id'],
				'division_id' 					=> $data_employee['division_id'],
				'department_id'					=> $data_employee['department_id'],
				'section_id' 					=> $data_employee['section_id'],
				'job_title_id' 					=> $data_employee['job_title_id'],
				'overtime_rate_id'				=> $this->input->post('overtime_rate_id',true),
				'business_trip_date'			=> tgltodb($this->input->post('business_trip_date',true)),
				'business_trip_start_date'		=> tgltodb($this->input->post('business_trip_start_date',true)),
				'business_trip_end_date'		=> tgltodb($this->input->post('business_trip_end_date',true)),
				'business_trip_purpose'			=> $this->input->post('business_trip_purpose',true),
				'business_trip_remark'			=> $this->input->post('business_trip_remark',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s")	
			);
			
			/*print_r($data);exit;*/
			
			
			$this->form_validation->set_rules('business_trip_date', 'Business Trip Date', 'required');
			$this->form_validation->set_rules('business_trip_start_date', 'Business Trip Start Date', 'required');
			$this->form_validation->set_rules('business_trip_purpose', 'Business Trip Purpose', 'required');
			$this->form_validation->set_rules('overtime_rate_id', 'Overtime Rate', 'required');
			
			if($this->form_validation->run()==true){
				if($this->assignmentbusinesstrip_model->saveNewAssignmentBusinessTrip($data)){
					$business_trip_id = $this->assignmentbusinesstrip_model->getBusinessTripID($data['created_on'], $data['created_id']);
					
					if(!empty($session_businesstripemployee)){
						foreach($session_businesstripemployee as $key=>$val){
							$data_businesstrip_employee = array(
								'business_trip_id'	=> $business_trip_id,
								'employee_id'		=> $val['employee_id'],
								'region_id'			=> $val['region_id'],
								'branch_id'			=> $val['branch_id'],
								'location_id'		=> $val['location_id'],
								'division_id'		=> $val['division_id'],
								'department_id'		=> $val['department_id'],
								'division_id'		=> $val['division_id'],
								'department_id'		=> $val['department_id'],
								'section_id'		=> $val['section_id'],
								'job_title_id'		=> $val['job_title_id']
							);
							$this->assignmentbusinesstrip_model->saveNewAssignmentBusinessTripEmployee($data_businesstrip_employee);
						}
					}

					if(!empty($session_businesstripallowance)){
						foreach($session_businesstripallowance as $key=>$val){
							$data_businesstrip_allowance = array(
								'business_trip_id'					=> $business_trip_id,
								'overtime_rate_id'					=> $data['overtime_rate_id'],
								'job_title_id'						=> $val['job_title_id'],
								'allowance_id'						=> $val['allowance_id'],
								'business_trip_allowance_amount'	=> $val['business_trip_allowance_amount']
							);
							$this->assignmentbusinesstrip_model->saveNewAssignmentBusinessTripAllowance($data_businesstrip_allowance);
						}
					}

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8302','Application.assignmentBusinessTrip.processAddAssignmentBusinessTrip',$business_trip_id,'Add New Assignment Business Trip');

					$msg = "<div class='alert alert-success'>                
								Add Data Business Trip Successfully
							</div> ";

					$unique 	= $this->session->userdata('unique');
					
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addassignmentbusinesstrip-'.$unique['unique']);
					$this->session->unset_userdata('addarraybusinesstripemployee-'.$unique['unique']);
					$this->session->unset_userdata('addarraybusinesstripallowance-'.$unique['unique']);
					redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Business Trip UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addassignmentbusinesstrip',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$data['employee_id']);
			}
		}

		public function getCostBudgetAmount(){
			$cost_budget_id = $this->input->post("cost_budget_id");
			$data = $this->assignmentbusinesstrip_model->getCostBudgetAmount($cost_budget_id);
			echo $data;
		}

		public function deleteBusinessTripCost(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraybusinesstripcost-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				print_r("key ");
				print_r($key);
				print_r("<BR>");
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata($session_name.$unique['unique'],$arrayBaru);
			redirect('assignmentbusinesstrip/addAssignmentBusinessTrip');
		}

		public function deleteArrayBusinessTripEmployee(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(4);
			$employee_id 		= $this->uri->segment(3);
			$session_name		= "addarraybusinesstripemployee-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				/*print_r("key ");
				print_r($key);
				print_r("<BR>");*/
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}

			/*print_r("arrayBaru ");
			print_r($arrayBaru);
			exit;*/
			
			$this->session->set_userdata('addarraybusinesstripemployee-'.$unique['unique'],$arrayBaru);
			
			redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$employee_id);
		}

		public function deleteArrayBusinessTripAllowance(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(4);
			$employee_id 		= $this->uri->segment(3);
			$session_name		= "addarraybusinesstripallowance-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				/*print_r("key ");
				print_r($key);
				print_r("<BR>");*/
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}

			/*print_r("arrayBaru ");
			print_r($arrayBaru);
			exit;*/
			
			$this->session->set_userdata('addarraybusinesstripallowance-'.$unique['unique'],$arrayBaru);
			
			redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$employee_id);
		}

		public function unApprovedAssignmentBusinessTrip(){
			$auth = $this->session->userdata('auth');

			$data['main_view']['unapprovedassignmentbusinesstrip']	= $this->assignmentbusinesstrip_model->getAssignmentBusinessTrip_UnApproved();
			/*print_r("unapprovedassignmentbusinesstrip ");
			print_r($unapprovedassignmentbusinesstrip);
			exit;*/
			$data['main_view']['content']							= 'assignmentbusinesstrip/listassignmentbusinesstripunapproved_view';
			$this->load->view('mainpage_view',$data);
		}

		public function approvalAssignmentBusinessTrip(){
			$business_trip_id = $this->uri->segment(3);
			$data['main_view']['assignmentbusinesstrip']				= $this->assignmentbusinesstrip_model->getAssignmentBusinessTrip_Detail($business_trip_id);
			$data['main_view']['assignmentbusinesstripemployee']		= $this->assignmentbusinesstrip_model->getAssignmentBusinessTripEmployee_Detail($business_trip_id);
			$data['main_view']['assignmentbusinesstripallowance']		= $this->assignmentbusinesstrip_model->getAssignmentBusinessTripAllowance_Detail($business_trip_id);
			$data['main_view']['content']								= 'assignmentbusinesstrip/formapprovalassignmentbusinesstrip_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processApprovedAssignmentBusinessTrip(){
			$page 	= $this->uri->segment(3);
			$auth	= $this->session->userdata('auth');
			
			$newdata = array (
				"business_trip_id"			=> $this->input->post('business_trip_id',true),
				'approved'					=> $this->input->post('approved',true),
				"approved_on"				=> date('Y-m-d H:i:s'),
				"approved_id"				=> $auth['user_id'],
				"approved_remark" 			=> $this->input->post('approved_remark',true),
			);

			/*print_r("newdata ");
			print_r($newdata);
			exit;*/
			
			$this->form_validation->set_rules('approved_remark', 'Remark', 'required');
			
			if($this->form_validation->run()==true){				
				if($this->assignmentbusinesstrip_model->approvedAssignmentBusinessTrip($newdata)){
					$auth	= $this->session->userdata('auth');
				
					$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	      
								Approval Business Trip Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstrip/unApprovedAssignmentBusinessTrip');
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	      
								Approval Business Trip Unsuccessfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstrip/unApprovedAssignmentBusinessTrip');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstrip/unApprovedAssignmentBusinessTrip');
			}
		}

		
		function edit(){
			$data['main_view']['result']		= $this->assignmentbusinesstrip_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']		= 'assignmentbusinesstrip/editassignmentbusinesstrip_view';
			$data['main_view']['approved']		= $this->configuration->Approved;
			$data['main_view']['employee']		= create_double($this->assignmentbusinesstrip_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditassignmentbusinesstrip(){
			$data = array(
				'business_trip_id'				=> $this->input->post('business_trip_id',true),
				'employee_id'					=> $this->input->post('employee_id',true),
				'business_trip_date'			=> tgltodb($this->input->post('business_trip_date',true)),
				'business_trip_start_date'		=> tgltodb($this->input->post('business_trip_start_date',true)),
				'business_trip_end_date'		=> tgltodb($this->input->post('business_trip_end_date',true)),
				'business_trip_purpose'			=> $this->input->post('business_trip_purpose',true),
				'business_trip_target'			=> $this->input->post('business_trip_target',true),
				'business_trip_total_expense'	=> $this->input->post('business_trip_total_expense',true),
				'business_trip_approved'		=> $this->input->post('business_trip_approved',true),
				'business_trip_approved_on'		=> tgltodb($this->input->post('business_trip_approved_on',true)),
				'business_trip_approved_by'		=> $this->input->post('business_trip_approved_by',true),
				'business_trip_approved_remark'	=> $this->input->post('business_trip_approved_remark',true),
				'data_state'					=> '0',
				'created_by'					=> $auth['username'],
				'created_on'					=> date("Y-m-d H:i:s")	
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('business_trip_date', 'Business Trip Date', 'required');
			$this->form_validation->set_rules('business_trip_start_date', 'Business Trip Start Date', 'required');
			$this->form_validation->set_rules('business_trip_end_date', 'Business Trip End Date', 'required');
			$this->form_validation->set_rules('business_trip_purpose', 'Purpose', 'required');
			$this->form_validation->set_rules('business_trip_target', 'Target', 'required');
			$this->form_validation->set_rules('business_trip_total_expense', 'Total Expense', 'required');
			$this->form_validation->set_rules('business_trip_approved_on', 'Approved On', 'required');
			$this->form_validation->set_rules('business_trip_approved_by', 'Approved By', 'required');
			
			if($this->form_validation->run()==true){
				if($this->assignmentbusinesstrip_model->updateassignmentbusinesstrip($data)==true){
					$auth 	= $this->session->userdata('auth');
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Letter of Business Trip Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstrip/edit/'.$data['business_trip_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Letter of Business Trip UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstrip/edit/'.$data['business_trip_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstrip/Edit/'.$data['business_trip_id']);
			}
		}

		
		
		public function deleteAssignmentBusinessTrip_Data(){
			$employee_id 		= $this->uri->segment(3);
			$business_trip_id 	= $this->uri->segment(4);

			if($this->assignmentbusinesstrip_model->deleteAssignmentBusinessTrip_Data($business_trip_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.assignmentBusinessTrip.deleteAssignmentBusinessTrip_Data',$auth['user_id'],'Delete Assignment Business Trip');
				$msg = "<div class='alert alert-success'>                
							Delete Data Business Trip Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstrip/addAssignmentBusinessTrip/'.$employee_id);
			}
		}
	}
?>