<?php
	Class hroemployeeworkingdayoff extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeworkingdayoff_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeeworkingdayoff');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeworkingdayoff_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeworkingdayoff_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeworkingdayoff_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeworkingdayoff_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_workingdayoff']		= $this->hroemployeeworkingdayoff_model->getHROEmployeeData_WorkingDayOff($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'hroemployeeworkingdayoff/listhroemployeeworkingdayoff_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeworkingdayoff',$data);
			redirect('hroemployeeworkingdayoff');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeworkingdayoff-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeworkingdayoff-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeworkingdayoff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeworkingdayoff-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeworkingdayoff');
			$this->session->unset_userdata('filter-hroemployeeworkingdayoff');
			redirect('hroemployeeworkingdayoff');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeworkingdayoff-'.$sesi['unique']);	
			redirect('hroemployeeworkingdayoff');
		}
		
		public function addHROEmployeeWorkingDayOff(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->hroemployeeworkingdayoff_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeworkingdayoff_data']		= $this->hroemployeeworkingdayoff_model->getHROEmployeeWorkingDayOff_Data($employee_id);
			$data['main_view']['coredayoff']						= create_double($this->hroemployeeworkingdayoff_model->getCoreDayOff(),'dayoff_id','dayoff_name');
			$data['main_view']['content']							= 'hroemployeeworkingdayoff/listaddhroemployeeworkingdayoff_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeWorkingDayOff(){
			$auth = $this->session->userdata('auth');
			$employee_id = $this->input->post('employee_id',true);

			$data_employee = $this->hroemployeeworkingdayoff_model->getHROEmployeeData($employee_id);

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'region_id' 							=> $auth['region_id'],
				'branch_id' 							=> $auth['branch_id'],
				'location_id' 							=> $auth['location_id'],
				'division_id' 							=> $data_employee['division_id'],
				'department_id'							=> $data_employee['department_id'],
				'section_id' 							=> $data_employee['section_id'],
				'job_title_id' 							=> $data_employee['job_title_id'],
				'dayoff_id' 							=> $this->input->post('dayoff_id',true),
				'employee_working_dayoff_date'			=> tgltodb($this->input->post('employee_working_dayoff_date',true)),
				'employee_working_dayoff_start_date'	=> tgltodb($this->input->post('employee_working_dayoff_start_date',true)),
				'employee_working_dayoff_end_date'		=> tgltodb($this->input->post('employee_working_dayoff_end_date',true)),
				'employee_working_dayoff_description'	=> $this->input->post('employee_working_dayoff_description',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_working_dayoff_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_working_dayoff_description', 'Hour', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeworkingdayoff_model->saveNewHROEmployeeWorkingDayOff($data)){
					$employee_working_dayoff_id = $this->hroemployeeworkingdayoff_model->getEmployeeWorkingDayOffID($data['created_id']);

					/*print_r("data ");
					print_r($data);
					print_r("employee_working_dayoff_id ");
					print_r($employee_working_dayoff_id);
					exit;
*/
					$working_dayoff_detail_date = $data['employee_working_dayoff_start_date'];
					$working_dayoff_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($working_dayoff_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($working_dayoff_detail_date) < strtotime($data['employee_working_dayoff_end_date'])) {
						$working_dayoff_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($working_dayoff_detail_date)));

						$day_name = date("D", strtotime($working_dayoff_detail_date));

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_workingdayoffdetail = array (
						    	'employee_working_dayoff_id'	=> $employee_working_dayoff_id,
						    	'employee_id'					=> $data['employee_id'],
						    	'working_dayoff_detail_date'	=> $working_dayoff_detail_date,
						    );

						    $this->hroemployeeworkingdayoff_model->saveNewHROEmployeeWorkingDayOff_Detail($data_workingdayoffdetail);
						}

						$working_dayoff_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($working_dayoff_detail_date)));
					} 		

							

					/*$leave_request_id = $this->payrollleaverequest_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->payrollleaverequest_model->getDayOffDate($leave_request_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_leaverequestdetail = array (
						    	'leave_request_id'				=> $leave_request_id,
						    	'employee_id'					=> $data['employee_id'],
						    	'leave_request_detail_date'		=> $leave_request_detail_date,
						    );

						    $this->payrollleaverequest_model->saveNewPayrollLeaveRequest_Detail($data_leaverequestdetail);
						} 
					} */


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeWorkingDayOff.processAddHROEmployeeWorkingDayOff',$auth['user_id'],'Add New Employee Working Day Off');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Working Day Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addhroemployeeworkingdayoff');
					redirect('hroemployeeworkingdayoff/addHROEmployeeWorkingDayOff/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Working Day Off UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeeworkingdayoff',$data);
					redirect('hroemployeeworkingdayoff/addHROEmployeeWorkingDayOff/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeeworkingdayoff',$data);
				redirect('hroemployeeworkingdayoff/addHROEmployeeWorkingDayOff/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeeworkingdayoff_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeworkingdayoff/edithroemployeeworkingdayoff_view';
			$data['main_view']['employee']		= create_double($this->hroemployeeworkingdayoff_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['absence']			= create_double($this->hroemployeeworkingdayoff_model->getabsence(),'absence_id','absence_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeworkingdayoff(){
			
			$data = array(
				'employee_absence_id' 				=> $this->input->post('employee_absence_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'absence_id' 							=> $this->input->post('absence_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeworkingdayoff_model->saveEdithroemployeeworkingdayoff($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeworkingdayoff.Edit',$auth['username'],'Edit Employee Absence');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_absence_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Absence Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeworkingdayoff/Edit/'.$data['employee_absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Absence UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeworkingdayoff/Edit/'.$data['employee_absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworkingdayoff/Edit/'.$data['employee_absence_id']);
			}
		}
		
		function deleteHROEmployeeWorkingDayOff(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeworkingdayoff_model->deleteHROEmployeeWorkingDayOff($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeWorkingDayOff.deleteHROEmployeeWorkingDayOff',$auth['user_id'],'Delete Employee Working Day Off');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Working Day Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworkingdayoff');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Working Day Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworkingdayoff');
			}
		}

		function deleteHROEmployeeWorkingDayOff_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_home_early_daily_id = $this->uri->segment(4);

			if($this->hroemployeeworkingdayoff_model->deleteHROEmployeeWorkingDayOff_Data($employee_home_early_daily_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeWorkingDayOff_Data.deleteHROEmployeeWorkingDayOff_Data',$auth['user_id'],'Delete Employee Working Day Off Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Working Day Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworkingdayoff/addHROEmployeeWorkingDayOff/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Working Day Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworkingdayoff/addHROEmployeeWorkingDayOff/'.$employee_id);
			}
		}
	}
?>