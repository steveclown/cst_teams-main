<?php
	Class assignmentbusinesstripilufa extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('assignmentbusinesstripilufa_model');
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


			$sesi	= 	$this->session->userdata('filter-assignmentbusinesstripilufa');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->assignmentbusinesstripilufa_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']				= create_double($this->assignmentbusinesstripilufa_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']					= create_double($this->assignmentbusinesstripilufa_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['hroemployeedata']				= create_double($this->assignmentbusinesstripilufa_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_businesstrip']	= $this->assignmentbusinesstripilufa_model->getHROEmployeeData_BusinessTrip($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'assignmentbusinesstripilufa/listassignmentbusinesstripilufa_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-assignmentbusinesstripilufa',$data);
			redirect('assignmentbusinesstripilufa');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-assignmentbusinesstripilufa');
			$this->session->unset_userdata('filter-assignmentbusinesstripilufa');
			redirect('assignmentbusinesstripilufa');
		}
		
		public function addAssignmentBusinessTrip(){
			$employee_id 	= $this->uri->segment(3);	
			$job_title_id 	= $this->uri->segment(4);	

			$data['main_view']['hroemployeedata']					= $this->assignmentbusinesstripilufa_model->getHROEmployeeData($employee_id);

			$data['main_view']['assignmentbusinesstripilufa_data']	= $this->assignmentbusinesstripilufa_model->getAssignmentBusinessTrip_Data($employee_id);

			$data['main_view']['assignmentovertimerate']			= $this->assignmentbusinesstripilufa_model->getAssignmentOvertimeRate($job_title_id);

			$data['main_view']['stayovernight']						= $this->configuration->StayOverNight;

			$data['main_view']['content']							= 'assignmentbusinesstripilufa/formaddassignmentbusinesstripilufa_view';

			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addassignmentbusinesstripilufa-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addassignmentbusinesstripilufa-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addassignmentbusinesstripilufa-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addassignmentbusinesstripilufa-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_session(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addassignmentbusinesstripilufa-'.$unique['unique']);	
			redirect('assignmentbusinesstripilufa');
		}

		public function getOvertimeRateAmount(){
			$overtime_rate_id 	= $this->input->post("overtime_rate_id");
			$job_title_id 		= $this->input->post("job_title_id");

			$data = $this->assignmentbusinesstripilufa_model->getOvertimeRateAmount($overtime_rate_id, $job_title_id);
			echo $data;
		}

		public function processAddAssignmentBusinessTrip(){
			$auth = $this->session->userdata('auth');

			$employee_id 					= $this->input->post('employee_id_assign', true);	
			$job_title_id 					= $this->input->post('job_title_id', true);
			$overtime_rate_days 			= $this->input->post('overtime_rate_days', true);
			$business_trip_stay_overnight 	= $this->input->post('business_trip_stay_overnight', true);
			$business_trip_days 			= $this->input->post('business_trip_days', true);
			$business_trip_amount 			= $this->input->post('business_trip_amount', true);
			$business_trip_trip_amount 		= $this->input->post('business_trip_trip_amount', true);

			$business_trip_subtotal_amount 	= $business_trip_days * $business_trip_amount;
			
			if ($business_trip_stay_overnight == 1){
				if ($business_trip_days >= $overtime_rate_days){
					$business_trip_trip_count = floor($business_trip_days / $overtime_rate_days); 
				} else {
					$business_trip_trip_count = 0;
				}
			} else {
				$business_trip_trip_count = 0;
			}

			$business_trip_subtotal_trip_amount = $business_trip_trip_count * $business_trip_trip_amount;

			$business_trip_total_amount = $business_trip_subtotal_amount + $business_trip_subtotal_trip_amount;

			/*print_r("overtime_rate_days ");
			print_r($overtime_rate_days);
			print_r("<BR>");
			print_r("business_trip_stay_overnight ");
			print_r($business_trip_stay_overnight);
			print_r("<BR>");
			print_r("business_trip_days ");
			print_r($business_trip_days);
			print_r("<BR>");
			print_r("business_trip_trip_count ");
			print_r($business_trip_trip_count);
			print_r("<BR>");
			exit;*/

			$data = array(
				'employee_id'							=> $this->input->post('employee_id_assign',true),
				'overtime_rate_id'						=> $this->input->post('overtime_rate_id',true),
				'job_title_id'							=> $this->input->post('job_title_id',true),
				'business_trip_date'					=> tgltodb($this->input->post('business_trip_date',true)),
				'business_trip_start_date'				=> tgltodb($this->input->post('business_trip_start_date',true)),
				'business_trip_end_date'				=> tgltodb($this->input->post('business_trip_end_date',true)),
				'business_trip_destination'				=> $this->input->post('business_trip_destination',true),
				'business_trip_amount'					=> $this->input->post('business_trip_amount',true),
				'business_trip_days'					=> $this->input->post('business_trip_days',true),
				'business_trip_trip_amount'				=> $this->input->post('business_trip_trip_amount',true),
				'business_trip_subtotal_amount'			=> $business_trip_subtotal_amount,
				'business_trip_stay_overnight'			=> $this->input->post('business_trip_stay_overnight',true),
				'business_trip_trip_count'				=> $business_trip_trip_count,
				'business_trip_subtotal_trip_amount'	=> $business_trip_subtotal_trip_amount,
				'business_trip_total_amount'			=> $business_trip_total_amount,
				'business_trip_remark'					=> $this->input->post('business_trip_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s")	
			);
			
			/*print_r($data);exit;*/
			
			
			$this->form_validation->set_rules('business_trip_date', 'Business Trip Date', 'required');
			$this->form_validation->set_rules('business_trip_destination', 'Business Trip Destination', 'required');
			$this->form_validation->set_rules('overtime_rate_id', 'Overtime Rate', 'required');
			$this->form_validation->set_rules('business_trip_amount', 'Business Trip Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->assignmentbusinesstripilufa_model->insertAssignmentBusinessTrip($data)){

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8302','Application.assignmentBusinessTrip.processAddAssignmentBusinessTrip',$business_trip_id,'Add New Assignment Business Trip');

					$msg = "<div class='alert alert-success'>                
								Add Data Business Trip Successfully
							</div> ";

					$msg = "<div class='alert alert-success'>                
								Add Data Bonus Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$unique 	= $this->session->userdata('unique');
					
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addassignmentbusinesstripilufa-'.$unique['unique']);
					$this->session->unset_userdata('addarraybusinesstripemployee-'.$unique['unique']);
					$this->session->unset_userdata('addarraybusinesstripallowance-'.$unique['unique']);
					redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$data['employee_id'].'/'.$data['job_title_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Business Trip UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$data['employee_id'].'/'.$data['job_title_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addassignmentbusinesstripilufa',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$data['employee_id'].'/'.$data['job_title_id']);
			}
		}

		public function getCostBudgetAmount(){
			$cost_budget_id = $this->input->post("cost_budget_id");
			$data = $this->assignmentbusinesstripilufa_model->getCostBudgetAmount($cost_budget_id);
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
			redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip');
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
			
			redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$employee_id);
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
			
			redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$employee_id);
		}

		public function unApprovedAssignmentBusinessTrip(){
			$auth = $this->session->userdata('auth');

			$data['main_view']['unapprovedassignmentbusinesstripilufa']	= $this->assignmentbusinesstripilufa_model->getAssignmentBusinessTrip_UnApproved();
			/*print_r("unapprovedassignmentbusinesstripilufa ");
			print_r($unapprovedassignmentbusinesstripilufa);
			exit;*/
			$data['main_view']['content']							= 'assignmentbusinesstripilufa/listassignmentbusinesstripilufaunapproved_view';
			$this->load->view('mainpage_view',$data);
		}

		public function approvalAssignmentBusinessTrip(){
			$business_trip_id = $this->uri->segment(3);
			$data['main_view']['assignmentbusinesstripilufa']				= $this->assignmentbusinesstripilufa_model->getAssignmentBusinessTrip_Detail($business_trip_id);
			$data['main_view']['assignmentbusinesstripilufaemployee']		= $this->assignmentbusinesstripilufa_model->getAssignmentBusinessTripEmployee_Detail($business_trip_id);
			$data['main_view']['assignmentbusinesstripilufaallowance']		= $this->assignmentbusinesstripilufa_model->getAssignmentBusinessTripAllowance_Detail($business_trip_id);
			$data['main_view']['content']								= 'assignmentbusinesstripilufa/formapprovalassignmentbusinesstripilufa_view';
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
				if($this->assignmentbusinesstripilufa_model->approvedAssignmentBusinessTrip($newdata)){
					$auth	= $this->session->userdata('auth');
				
					$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	      
								Approval Business Trip Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstripilufa/unApprovedAssignmentBusinessTrip');
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	      
								Approval Business Trip Unsuccessfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstripilufa/unApprovedAssignmentBusinessTrip');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstripilufa/unApprovedAssignmentBusinessTrip');
			}
		}

		
		function edit(){
			$data['main_view']['result']		= $this->assignmentbusinesstripilufa_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']		= 'assignmentbusinesstripilufa/editassignmentbusinesstripilufa_view';
			$data['main_view']['approved']		= $this->configuration->Approved;
			$data['main_view']['employee']		= create_double($this->assignmentbusinesstripilufa_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditassignmentbusinesstripilufa(){
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
				if($this->assignmentbusinesstripilufa_model->updateassignmentbusinesstripilufa($data)==true){
					$auth 	= $this->session->userdata('auth');
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Letter of Business Trip Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstripilufa/edit/'.$data['business_trip_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Letter of Business Trip UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentbusinesstripilufa/edit/'.$data['business_trip_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstripilufa/Edit/'.$data['business_trip_id']);
			}
		}

		
		
		public function deleteAssignmentBusinessTrip_Data(){
			$employee_id 		= $this->uri->segment(3);
			$business_trip_id 	= $this->uri->segment(4);

			if($this->assignmentbusinesstripilufa_model->deleteAssignmentBusinessTrip_Data($business_trip_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.assignmentBusinessTrip.deleteAssignmentBusinessTrip_Data',$auth['user_id'],'Delete Assignment Business Trip');
				$msg = "<div class='alert alert-success'>                
							Delete Data Business Trip Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentbusinesstripilufa/addAssignmentBusinessTrip/'.$employee_id);
			}
		}
	}
?>