<?php
	Class HroEmployeeAdministrationCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeAdministrationCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-HroEmployeeAdministrationCkp');
			if(!is_array($sesi)){
				$sesi['location_id']			= '';
				$sesi['employee_shift_id']		= '';
			}

			$data['Main_view']['corelocation']					= create_double($this->HroEmployeeAdministrationCkp_model->getCoreLocation(),'location_id','location_name');

			$data['Main_view']['hroemployeedata_attendance']	= $this->HroEmployeeAdministrationCkp_model->getScheduleEmployeeShiftItem($sesi['location_id'], $sesi['employee_shift_id']);

			$data['Main_view']['content']						= 'HroEmployeeAdministrationCkp/listHroEmployeeAdministrationCkp_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getScheduleEmployeeShift(){
			$location_id = $this->input->post('location_id');
			$item = $this->HroEmployeeAdministrationCkp_model->getScheduleEmployeeShift_Location($location_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_shift_id]'>$mp[employee_shift_code]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'location_id'			=> $this->input->post('location_id',true),	
				'employee_shift_id'		=> $this->input->post('employee_shift_id',true),	
			);
			$this->session->set_userdata('filter-HroEmployeeAdministrationCkp',$data);
			redirect('HroEmployeeAdministrationCkp');
		}

		public function addHROEmployeeAdministration(){
			$employee_id = $this->uri->segment(3);	

			$data['Main_view']['hroemployeedata']			= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_Detail($employee_id);

			$data['Main_view']['hroemployeepermit']			= $this->HroEmployeeAdministrationCkp_model->getHROEmployeePermit($employee_id);

			$data['Main_view']['corepermit']				= create_double($this->HroEmployeeAdministrationCkp_model->getCorePermit(),'permit_id','permit_name');

			$data['Main_view']['hroemployeeabsence']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeAbsence($employee_id);

			$data['Main_view']['coreabsence']				= create_double($this->HroEmployeeAdministrationCkp_model->getCoreAbsence(),'absence_id','absence_name');

			$data['Main_view']['hroemployeeabsence']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeAbsence($employee_id);

			$data['Main_view']['coreannualleave']			= create_double($this->HroEmployeeAdministrationCkp_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			$data['Main_view']['payrollleaverequest']		= $this->HroEmployeeAdministrationCkp_model->getPayrollLeaveRequest($employee_id);

			$data['Main_view']['hroemployeecanceloff']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeCancelOff($employee_id);

			$data['Main_view']['hroemployeeswapoff']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeSwapOff($employee_id);

			$data['Main_view']['content']					= 'HroEmployeeAdministrationCkp/formaddHroEmployeeAdministrationCkp_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAdministrationCkp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeAdministrationCkp-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAdministrationCkp-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeAdministrationCkp-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeAdministrationCkp');
			$this->session->unset_userdata('filter-HroEmployeeAdministrationCkp');
			redirect('HroEmployeeAdministrationCkp');
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	

			$this->session->unset_userdata('addHroEmployeeAdministrationCkp-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/addHROEmployeeLate/'.$employee_id);
		}

		public function searchScheduleEmployeeScheduleItem(){
			$employee_id = $this->uri->segment(3);	

			$sesiSchedule	= $this->session->userdata('filter-scheduleemployeescheduleitem');
			if(!is_array($sesiSchedule)){
				$sesiSchedule['start_date']		= date("d-m-Y");
				$sesiSchedule['end_date']		= date("d-m-Y");
			}

			$start_date = tgltodb($sesiSchedule['start_date']);
			$end_date 	= tgltodb($sesiSchedule['end_date']);

			$data['Main_view']['scheduleemployeescheduleitem']	= $this->HroEmployeeAdministrationCkp_model->getScheduleEmployeeScheduleItem($employee_id, $start_date, $end_date);

			$data['Main_view']['employee_id']					= $employee_id;

			$data['Main_view']['content']						= 'HroEmployeeAdministrationCkp/formsearchscheduleemployeescheduleitem_view';

			$this->load->view('mainpage_view',$data);
		}

		public function filterScheduleItem(){
			$data = array (
				'employee_id'	=> $this->input->post('employee_id',true),	
				'start_date'	=> $this->input->post('start_date',true),	
				'end_date'		=> $this->input->post('end_date',true),
			);
			$this->session->set_userdata('filter-scheduleemployeescheduleitem',$data);
			redirect('HroEmployeeAdministrationCkp/searchScheduleEmployeeScheduleItem/'.$data['employee_id']);
		}

		public function reset_search_schedule(){
			$sesi= $this->session->userdata('filter-scheduleemployeescheduleitem');
			$this->session->unset_userdata('filter-scheduleemployeescheduleitem');
			redirect('HroEmployeeAdministrationCkp');
		}

		public function function_elements_add_permit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeepermit-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeepermit-'.$unique['unique'],$sessions);
		}

		public function reset_add_permit(){
			$employee_id 				= $this->uri->segment(3);	
			$employee_absence_date 		= $this->uri->segment(4);	
			$employee_schedule_item_id 	= $this->uri->segment(5);	
			$unique 		= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
		}
		
		public function processAddHROEmployeePermit(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$permit_id 					= $this->input->post('permit_id',true);
			$employee_id 				= $this->input->post('employee_id',true);
			$employee_absence_date 		= $this->input->post('employee_absence_date',true);
			$employee_schedule_item_id 	= $this->input->post('employee_schedule_item_id',true);

			$permit_type 				= $this->HroEmployeeAdministrationCkp_model->getPermitType($permit_id);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'permit_id' 						=> $permit_id,
				'permit_type' 						=> $permit_type,
				'employee_permit_date'				=> tgltodb($this->input->post('employee_permit_date',true)),
				'employee_permit_description'		=> $this->input->post('employee_permit_description',true),
				'employee_permit_start_date'		=> tgltodb($this->input->post('employee_permit_date',true)),
				'employee_permit_end_date'			=> tgltodb($this->input->post('employee_permit_date',true)),
				'employee_permit_remark' 			=> $this->input->post('employee_permit_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_permit_date', 'Date', 'required');
			$this->form_validation->set_rules('permit_id', 'Permit', 'required');
			$this->form_validation->set_rules('employee_permit_description', 'Permit Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeePermit($data)){
					$employee_permit_id = $this->HroEmployeeAdministrationCkp_model->getEmployeePermitID($data['created_id']);

					$employee_permit_detail_date = $data['employee_permit_start_date'];

					date_default_timezone_set('UTC');

					while (strtotime($employee_permit_detail_date) <= strtotime($data['employee_permit_end_date'])) {
						$day_name = date("D", strtotime($employee_permit_detail_date));

						$dayoff_date = $this->HroEmployeeAdministrationCkp_model->getDayOffDate($employee_permit_detail_date);


						$data_employeepermitdetail = array (
					    	'employee_permit_id'				=> $employee_permit_id,
					    	'employee_id'						=> $data['employee_id'],
					    	'employee_permit_detail_date'		=> $employee_permit_detail_date,
					    );

					    $this->HroEmployeeAdministrationCkp_model->insertHROEmployeePermit_Detail($data_employeepermitdetail);

					    if ($this->HroEmployeeAdministrationCkp_model->insertHROEmployeePermit_Detail($data_employeepermitdetail)){

					    	$data_updatescheduleitem = array(
					    		'employee_schedule_item_id'		=> $employee_schedule_item_id,
					    		'employee_id'					=> $data['employee_id'],
					    		'employee_schedule_item_status'	=> 3,
					    	);

					    	$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);
					    }
						

						$employee_permit_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_permit_detail_date)));
					} 

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Permit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_permit',$msg);
					$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Permit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_permit',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_permit',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function deleteHROEmployeePermit(){
			$employee_id 				= $this->uri->segment(3);
			$employee_permit_id 		= $this->uri->segment(4);
			$employee_absence_date 		= $this->uri->segment(5);
			$employee_schedule_item_id 	= $this->uri->segment(6);

			if($this->HroEmployeeAdministrationCkp_model->deleteHROEmployeePermit($employee_permit_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleItemStatusDefault($employee_schedule_item_id);

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Permit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_permit',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Permit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_permit',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function function_elements_add_absence(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeabsence-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeabsence-'.$unique['unique'],$sessions);
		}

		public function reset_add_absence(){
			$employee_id 				= $this->uri->segment(3);	
			$employee_absence_date 		= $this->uri->segment(4);	
			$employee_schedule_item_id 	= $this->uri->segment(5);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeabsence-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
		}

		public function processAddHROEmployeeAbsence(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_absence_date					= $this->input->post('employee_absence_date',true);
			$employee_schedule_item_id				= $this->input->post('employee_schedule_item_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'absence_id' 						=> $this->input->post('absence_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_start_date'		=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_end_date'			=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_description'		=> $this->input->post('employee_absence_description',true),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			$this->form_validation->set_rules('employee_absence_description', 'Absence Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeAbsence($data)){
					$employee_absence_id = $this->HroEmployeeAdministrationCkp_model->getEmployeeAbsenceID($data['created_id']);

					$employee_absence_detail_date = $data['employee_absence_start_date'];

					date_default_timezone_set('UTC');

					while (strtotime($employee_absence_detail_date) <= strtotime($data['employee_absence_end_date'])) {
						

						$day_name = date("D", strtotime($employee_absence_detail_date));

						$dayoff_date = $this->HroEmployeeAdministrationCkp_model->getDayOffDate($employee_absence_detail_date);

					
						$data_employeeabsencedetail = array (
					    	'employee_absence_id'				=> $employee_absence_id,
					    	'employee_id'						=> $data['employee_id'],
					    	'employee_absence_detail_date'		=> $employee_absence_detail_date,
					    );

					    if ($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeAbsence_Detail($data_employeeabsencedetail)){

					    	$data_updatescheduleitem = array(
					    		'employee_schedule_item_id'		=> $employee_schedule_item_id,
					    		'employee_id'					=> $data['employee_id'],
					    		'employee_schedule_item_status'	=> 2,
					    	);

					    	$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);
					    }
						 
						$employee_absence_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_absence_detail_date)));
					} 

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeeAbsence',$auth['user_id'],'Add New Employee Absence');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Absence Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_absence',$msg);
					$this->session->unset_userdata('addhroemployeeabsence-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Absence UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_absence',$msg);
					$this->session->set_userdata('Addhroemployeeabsence',$data);
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_absence',$msg);
				$this->session->set_userdata('Addhroemployeeabsence',$data);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function deleteHROEmployeeAbsence(){
			$employee_id 				= $this->uri->segment(3);
			$employee_absence_id 		= $this->uri->segment(4);
			$employee_absence_date 		= $this->uri->segment(5);
			$employee_schedule_item_id 	= $this->uri->segment(6);

			if($this->HroEmployeeAdministrationCkp_model->deleteHROEmployeeAbsence($employee_absence_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleItemStatusDefault($employee_schedule_item_id);

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_absence',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_absence',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function function_elements_add_leave(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollleaverequest-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollleaverequest-'.$unique['unique'],$sessions);
		}

		public function reset_add_leave(){
			$employee_id 				= $this->uri->segment(3);	
			$employee_absence_date 		= $this->uri->segment(4);	
			$employee_schedule_item_id 	= $this->uri->segment(5);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollleaverequest-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
		}

		public function processAddPayrollLeaveRequest(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_absence_date					= $this->input->post('employee_absence_date',true);
			$employee_schedule_item_id				= $this->input->post('employee_schedule_item_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_id' 					=> $this->input->post('annual_leave_id',true),
				'leave_request_description'			=> $this->input->post('leave_request_description',true),
				'leave_request_date'				=> tgltodb($this->input->post('leave_request_date',true)),
				'leave_request_start_date'			=> tgltodb($this->input->post('leave_request_date',true)),
				'leave_request_end_date'			=> tgltodb($this->input->post('leave_request_date',true)),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_request_description', 'Leave Description', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_date', 'Leave Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertPayrollLeaveRequest($data)){
					$leave_request_id = $this->HroEmployeeAdministrationCkp_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->HroEmployeeAdministrationCkp_model->getDayOffDate($leave_request_detail_date);

						
						$data_leaverequestdetail = array (
					    	'leave_request_id'				=> $leave_request_id,
					    	'employee_id'					=> $data['employee_id'],
					    	'leave_request_detail_date'		=> $leave_request_detail_date,
					    );

					    if ($this->HroEmployeeAdministrationCkp_model->insertPayrollLeaveRequest_Detail($data_leaverequestdetail)){

					    	$data_updatescheduleitem = array(
					    		'employee_schedule_item_id'		=> $employee_schedule_item_id,
					    		'employee_id'					=> $data['employee_id'],
					    		'employee_schedule_item_status'	=> 4,
					    	);

					    	$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);
					    }
						 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->unset_userdata('Addpayrollleaverequest');
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_leave',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function deletePayrollLeaveRequest(){
			$employee_id 				= $this->uri->segment(3);
			$leave_request_id 			= $this->uri->segment(4);
			$employee_absence_date 		= $this->uri->segment(5);
			$employee_schedule_item_id 	= $this->uri->segment(6);

			if($this->HroEmployeeAdministrationCkp_model->deletePayrollLeaveRequest($leave_request_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleItemStatusDefault($employee_schedule_item_id);

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function function_elements_add_canceloff(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeecanceloff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeecanceloff-'.$unique['unique'],$sessions);
		}

		public function reset_add_canceloff(){
			$employee_id 				= $this->uri->segment(3);	
			$employee_absence_date 		= $this->uri->segment(4);	
			$employee_schedule_item_id 	= $this->uri->segment(5);	
			$unique 					= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeecanceloff-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
		}
		
		public function processAddHROEmployeeCancelOff(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 				= $this->input->post('employee_id',true);
			$employee_absence_date 		= $this->input->post('employee_absence_date',true);
			$employee_schedule_item_id 	= $this->input->post('employee_schedule_item_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_cancel_off_date'			=> tgltodb($this->input->post('employee_cancel_off_date',true)),
				'employee_cancel_off_description'	=> $this->input->post('employee_cancel_off_description',true),
				'employee_cancel_off_remark' 		=> $this->input->post('employee_cancel_off_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_cancel_off_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_cancel_off_description', 'Cancel Off Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeCancelOff($data)){
					$data_updatescheduleitem = array(
					    'employee_schedule_item_id'		=> $employee_schedule_item_id,
					    'employee_id'					=> $data['employee_id'],
					    'employee_schedule_item_status'	=> 9,
					);

					$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Cancel Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_canceloff',$msg);
					$this->session->unset_userdata('addhroemployeecanceloff-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Cancel Off UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_canceloff',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_canceloff',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function deleteHROEmployeeCancelOff(){
			$employee_id 				= $this->uri->segment(3);
			$employee_cancel_off_id		= $this->uri->segment(4);
			$employee_absence_date 		= $this->uri->segment(5);
			$employee_schedule_item_id 	= $this->uri->segment(6);

			if($this->HroEmployeeAdministrationCkp_model->deleteHROEmployeeCancelOff($employee_cancel_off_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = 0;

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Cancel Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_canceloff',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Cancel Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_canceloff',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function function_elements_add_swapoff(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeswapoff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeswapoff-'.$unique['unique'],$sessions);
		}

		public function reset_add_swapoff(){
			$employee_id 				= $this->uri->segment(3);	
			$employee_absence_date 		= $this->uri->segment(4);	
			$employee_schedule_item_id 	= $this->uri->segment(5);	
			$unique 					= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
		}
		
		public function processAddHROEmployeeSwapOff(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 				= $this->input->post('employee_id',true);
			$employee_absence_date 		= $this->input->post('employee_absence_date',true);
			$employee_schedule_item_id 	= $this->input->post('employee_schedule_item_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_swap_off_date'			=> tgltodb($this->input->post('employee_swap_off_date',true)),
				'employee_swap_off_to_date'			=> tgltodb($this->input->post('employee_swap_off_to_date',true)),
				'employee_swap_off_description'		=> $this->input->post('employee_swap_off_description',true),
				'employee_swap_off_remark'	 		=> $this->input->post('employee_swap_off_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r("data ");
			print_r($data);*/
			/*exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_swap_off_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_swap_off_to_date', 'To Date', 'required');
			$this->form_validation->set_rules('employee_swap_off_description', 'Swap Off Description', 'required');
			
			if($this->form_validation->run()==true){
				$data_scheduleitemstatus_todate = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleItemStatus_ToDate($data['employee_id'], $data['employee_swap_off_to_date']);

				if (!empty($data_scheduleitemstatus_todate)){
					if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeSwapOff($data)){
						/*print_r("data_scheduleitemstatus_todate ");
						print_r($data_scheduleitemstatus_todate);
						exit;*/

						$data_updatescheduleitem = array(
						    'employee_schedule_item_id'		=> $employee_schedule_item_id,
						    'employee_id'					=> $data['employee_id'],
						    'employee_schedule_item_status'	=> $data_scheduleitemstatus_todate['employee_schedule_item_status'],
						);

						$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);

						$data_updatescheduleitem = array(
						    'employee_schedule_item_id'		=> $data_scheduleitemstatus_todate['employee_schedule_item_id'],
						    'employee_id'					=> $data['employee_id'],
						    'employee_schedule_item_status'	=> 0,
						);

						$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);

						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Swap Off Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

						$this->session->set_userdata('message_swapoff',$msg);
						$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
						redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Employee Swap Off UnSuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message_swapoff',$msg);
						$this->session->set_userdata('Addhroemployeepermit',$data);
						redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
								Data Swap To Date Empty
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_swapoff',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_swapoff',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$data['employee_id'].'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function deleteHROEmployeeSwapOff(){
			$employee_id 				= $this->uri->segment(3);
			$employee_swap_off_id		= $this->uri->segment(4);
			$employee_absence_date 		= $this->uri->segment(5);
			$employee_schedule_item_id 	= $this->uri->segment(6);
			$employee_swap_off_to_date 	= $this->uri->segment(7);

			$data_scheduleitemstatus_date = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleItemStatus_ToDate($employee_id, $employee_absence_date);

			$data_scheduleitemstatus_todate = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleItemStatus_ToDate($employee_id, $employee_swap_off_to_date);

			/*print_r("data_scheduleitemstatus_date ");
			print_r($data_scheduleitemstatus_date);
			print_r("<BR>");
			print_r("data_scheduleitemstatus_todate ");
			print_r($data_scheduleitemstatus_todate);
			exit;*/

			if($this->HroEmployeeAdministrationCkp_model->deleteHROEmployeeSwapOff($employee_swap_off_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = 0;

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $data_scheduleitemstatus_todate['employee_schedule_item_id'],
					'employee_schedule_item_status'	=> $data_scheduleitemstatus_date['employee_schedule_item_status'],
				);

				$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Swap Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_swapoff',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Swap Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_swapoff',$msg);
				redirect('HroEmployeeAdministrationCkp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}
		}

		public function editHROEmployeeAdministration(){
			$employee_id = $this->uri->segment(3);	

			$data['Main_view']['hroemployeedata']				= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_Detail($employee_id);

			$data['Main_view']['hroemployeedata_lastdayoff']	= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_LastDayOff($employee_id);

			$data['Main_view']['hroemployeedata_rfidcode']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_RFIDCode($employee_id);

			$data['Main_view']['hroemployeechangerfid']			= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeChangeRFID($employee_id);

			$data['Main_view']['hroemployeeupdatedayoff']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeUpdateDayOff($employee_id);

			$data['Main_view']['dayoffstatus']					= $this->configuration->DayOffStatus();

			$data['Main_view']['corelocation']					= create_double($this->HroEmployeeAdministrationCkp_model->getCoreLocation(),'location_id','location_name');

			$data['Main_view']['hroemployeedata_shiftgroup']	= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_ShiftGroup($employee_id);

			$data['Main_view']['hroemployeechangegroup']		= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeChangeGroup($employee_id);

			$data['Main_view']['scheduleshiftpattern']			= create_double($this->HroEmployeeAdministrationCkp_model->getScheduleShiftPattern(),'shift_pattern_id','shift_pattern_name');

			$data['Main_view']['content']						= 'HroEmployeeAdministrationCkp/formeditHroEmployeeAdministrationCkp_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_edit_lastdayoff(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeelastdayoff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeelastdayoff-'.$unique['unique'],$sessions);
		}

		public function reset_edit_lastdayoff(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');

			$this->session->unset_userdata('edithroemployeelastdayoff-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$employee_id);
		}

		public function processEditHROEmployeeData_LastDayOff(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 				= $this->input->post('employee_id',true);

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_last_day_off'			=> tgltodb($this->input->post('employee_last_day_off',true)),
				'employee_day_off_cycle'		=> $this->input->post('employee_day_off_cycle',true),
				'employee_day_off_status'		=> $this->input->post('employee_day_off_status',true),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_last_day_off', 'Last Day Off Date', 'required');
			$this->form_validation->set_rules('employee_day_off_cycle', 'Day Off Cycle', 'required');
			$this->form_validation->set_rules('employee_day_off_status', 'Day Off Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->updateHROEmployeeData_LastDayOff($data)){
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Edit Data Employee Last Day Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_swapoff',$msg);
					$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Employee Last Day Off Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_swapoff',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_swapoff',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function processAddHROEmployeeChangeRFID(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 				= $this->input->post('employee_id',true);

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_rfid_code_old'		=> $this->input->post('employee_rfid_code_old',true),
				'employee_rfid_code'			=> $this->input->post('employee_rfid_code',true),
				'employee_change_rfid_reason'	=> $this->input->post('employee_change_rfid_reason',true),
				'employee_change_rfid_date'		=> date("Y-m-d"),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_rfid_code', 'RFID Code', 'required');
			$this->form_validation->set_rules('employee_change_rfid_reason', 'Change RFID Code Reason', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeChangeRFID($data)){

					$data_updateemployeedata = array (
						'employee_id'			=> $data['employee_id'],
						'employee_rfid_code'	=> $data['employee_rfid_code'],
					);

					$this->HroEmployeeAdministrationCkp_model->updateHROEmployeeData_RFIDCode($data_updateemployeedata);

					$data_updatescheduleitem = array (
						'employee_id'					=> $data['employee_id'],
						'employee_rfid_code'			=> $data['employee_rfid_code'],
					);

					$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeScheduleItem_RFIDCode($data_updatescheduleitem, $data['employee_change_rfid_date']);

					$data_updateemployeeshift = array (
						'employee_id'					=> $data['employee_id'],
						'employee_rfid_code'			=> $data['employee_rfid_code'],
					);

					$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeShiftItem_RFIDCode($data_updateemployeeshift);

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Change Group Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_changerfid',$msg);
					$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Change Group Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_changerfid',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_changerfid',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function processAddHROEmployeeChangeGroup(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 				= $this->input->post('employee_id',true);

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'location_id_old'				=> $this->input->post('location_id_old',true),
				'employee_shift_id_old'			=> $this->input->post('employee_shift_id_old',true),
				'location_id'					=> $this->input->post('location_id',true),
				'employee_shift_id'				=> $this->input->post('employee_shift_id',true),
				'employee_change_group_reason'	=> $this->input->post('employee_change_group_reason',true),
				'employee_change_group_date'	=> date("Y-m-d"),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('employee_shift_id', 'Employee Shift Code', 'required');
			$this->form_validation->set_rules('employee_change_group_reason', 'Employee Change Group Reason', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeChangeGroup($data)){

					$data_updateemployeedata = array (
						'employee_id'			=> $data['employee_id'],
						'employee_shift_id'		=> $data['employee_shift_id'],
					);

					$this->HroEmployeeAdministrationCkp_model->updateHROEmployeeData_ShiftGroup($data_updateemployeedata);

					$data_updatescheduleitem = array (
						'employee_id'					=> $data['employee_id'],
						'employee_rfid_code'			=> $data['employee_rfid_code'],
					);

					$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeScheduleItem_RFIDCode($data_updatescheduleitem, $data['employee_change_rfid_date']);

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Change RFID Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_changegroup',$msg);
					$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Change RFID Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_changegroup',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_changegroup',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function function_elements_add_shiftassignment(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addscheduleshiftassignment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addscheduleshiftassignment-'.$unique['unique'],$sessions);
		}

		public function reset_add_shiftassignment(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');

			$this->session->unset_userdata('addscheduleshiftassignment-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$employee_id);
		}

		public function processAddScheduleShiftAssignment(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 			= $this->input->post('employee_id',true);
			$shift_assignment_cycle	= $this->input->post('shift_assignment_cycle',true);

			$hroemployeedata 	= $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_Detail($employee_id);
			
			$data = array(
				'region_id' 					=> $hroemployeedata['region_id'],
				'branch_id'						=> $hroemployeedata['branch_id'],
				'location_id'					=> $hroemployeedata['location_id'],
				'division_id'					=> $hroemployeedata['division_id'],
				'employee_id'					=> $employee_id,
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date('Y-m-d H:i:s'),	
			);

			$employeeworkingminute 	= $this->HroEmployeeAdministrationCkp_model->getEmployeeWorkingMinute();
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertScheduleShiftAssignment($data)){
					$unique 	= $this->session->userdata('unique');
					$auth 		= $this->session->userdata('auth');

					$shift_assignment_id = $this->HroEmployeeAdministrationCkp_model->getShiftAssignmentID($data['created_id']);

					$data_scheduleshiftassignmentitem = array (
						'shift_assignment_id'			=> $shift_assignment_id,
						'shift_pattern_id'				=> $this->input->post('shift_pattern_id',true),
						'shift_assignment_start_date'	=> tgltodb($this->input->post('shift_assignment_start_date',true)),
					);

					$this->HroEmployeeAdministrationCkp_model->insertScheduleShiftAssignmentItem($data_scheduleshiftassignmentitem);

					$data_scheduleshiftpattern 		= $this->HroEmployeeAdministrationCkp_model->getScheduleShiftPattern_Detail($data_scheduleshiftassignmentitem['shift_pattern_id']);

					$data_scheduleshiftpatternitem	= $this->HroEmployeeAdministrationCkp_model->getScheduleShiftPatternItem_Detail($data_scheduleshiftassignmentitem['shift_pattern_id']);

					/*print_r("data_scheduleshiftpatternitem ");
					print_r($data_scheduleshiftpatternitem);
					exit;*/

					$i 						= 1;
					$shift_pattern_weekly 	= $data_scheduleshiftpattern['shift_pattern_weekly'];
					$shift_pattern_cycle 	= $data_scheduleshiftpattern['shift_pattern_cycle'];
					$shift_pattern_day 		= $data_scheduleshiftpattern['shift_pattern_day'];
					$date 					= $data_scheduleshiftassignmentitem['shift_assignment_start_date'];
					$startdate 				= strtotime('-1 day', strtotime($date));
					$startdate 				= date("Y-m-d", $startdate);
					$shift_cycle 			= 1;

					$schedule_day 			= $this->configuration->ShiftPatternDayShift($shift_pattern_day);




					$data_scheduleemployeeschedule = array(
						'shift_assignment_id'		=> $shift_assignment_id,
						'shift_pattern_id'			=> $data_scheduleshiftassignmentitem['shift_pattern_id'],
						'data_state'				=> 0,
						'created_id'				=> $auth['user_id'],
						'created_on'				=> date('Y-m-d H:i:s'),
					);

					/*print_r("startdate awal ");
					print_r($startdate);

					print_r("date ");
					print_r($date);
					print_r("<BR>");
					print_r("startdate ");
					print_r($startdate);
					exit;*/

					$this->HroEmployeeAdministrationCkp_model->insertScheduleEmployeeSchedule($data_scheduleemployeeschedule);

					$employee_schedule_id = $this->HroEmployeeAdministrationCkp_model->getEmployeeScheduleID($data_scheduleemployeeschedule['created_id']);

					$j 			= 1;
					$day_off 	= 0;

					for ($j = 1; $j<=$shift_assignment_cycle; $j++){
						foreach ($data_scheduleshiftpatternitem as $key => $val) {
							$scheduleemployeeshiftitem = $this->HroEmployeeAdministrationCkp_model->getScheduleEmployeeShiftItem_Detail($val['employee_shift_id'], $employee_id);

							for($a=1; $a<=$shift_pattern_cycle; $a++){
								$from 	= mktime(0,0,0,date("m",strtotime($startdate)),date("d",strtotime($startdate))+$a,date("Y",strtotime($startdate)));

								$from 	= date("Y-m-d", $from);
								$day 	= date("D", strtotime($from));

								if ($shift_pattern_day == 0){
									## Start Working 
									$employee_schedule_item_date = $from." ".$val['start_working_hour'];

									$employee_schedule_item_in_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

									$employee_schedule_item_in_end_date1 	= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

									$employee_schedule_item_in_start_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_start_date1);

									$employee_schedule_item_in_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_end_date1);

									## End Working

									if ($val['shift_next_day'] == 0){
										$employee_schedule_item_date = $from." ".$val['end_working_hour'];	
									} else {
										$date 		= date_create($from);
										date_add($date, date_interval_create_from_date_string("1 days"));
										$start_from	= date_format($date, "Y-m-d");

										$employee_schedule_item_date = $start_from." ".$val['end_working_hour'];	
									}
									

									$employee_schedule_item_out_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

									$employee_schedule_item_out_end_date1 		= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

									$employee_schedule_item_out_start_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_start_date1);

									$employee_schedule_item_out_end_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_end_date1);										
									
									foreach ($scheduleemployeeshiftitem as $key2 => $val2) {
										$data_scheduleemployeescheduleitem = array (
											'employee_schedule_id'						=> $employee_schedule_id,
											'shift_assignment_id'						=> $shift_assignment_id,
											'employee_shift_id'							=> $val['employee_shift_id'],
											'shift_id'									=> $val['shift_id'],
											'region_id'									=> $val2['region_id'],
											'branch_id'									=> $val2['branch_id'],
											'location_id'								=> $val2['location_id'],
											'division_id'								=> $val2['division_id'],
											'department_id'								=> $val2['department_id'],
											'section_id'								=> $val2['section_id'],
											'unit_id'									=> $val2['unit_id'],
											'employee_id'								=> $val2['employee_id'],
											'employee_rfid_code'						=> $val2['employee_rfid_code'],
											'employee_schedule_item_date'				=> $from,
											'employee_schedule_item_in_start_date'		=> $employee_schedule_item_in_start_date,
											'employee_schedule_item_in_end_date'		=> $employee_schedule_item_in_end_date,
											'employee_schedule_item_out_start_date'		=> $employee_schedule_item_out_start_date,
											'employee_schedule_item_out_end_date'		=> $employee_schedule_item_out_end_date,
											'employee_schedule_item_status'				=> 9,
											'employee_schedule_item_status_default'		=> 9,
										);
										
										$this->HroEmployeeAdministrationCkp_model->insertScheduleEmployeeScheduleItem($data_scheduleemployeescheduleitem);

										if ($val['shift_next_day'] == 1){
											$data_scheduleemployeescheduleshift = array (
												'employee_schedule_id'						=> $employee_schedule_id,
												'shift_assignment_id'						=> $shift_assignment_id,
												'employee_shift_id'							=> $val['employee_shift_id'],
												'shift_id'									=> $val['shift_id'],
												'region_id'									=> $val2['region_id'],
												'branch_id'									=> $val2['branch_id'],
												'location_id'								=> $val2['location_id'],
												'division_id'								=> $val2['division_id'],
												'department_id'								=> $val2['department_id'],
												'section_id'								=> $val2['section_id'],
												'unit_id'									=> $val2['unit_id'],
												'employee_id'								=> $val2['employee_id'],
												'employee_rfid_code'						=> $val2['employee_rfid_code'],
												'employee_schedule_shift_date'				=> $from,
											);

											$this->HroEmployeeAdministrationCkp_model->insertScheduleEmployeeScheduleShift($data_scheduleemployeescheduleshift);
										}
									}	
								} else {
									if ($schedule_day == $day){
										## Start Working 
										$employee_schedule_item_date = $from." ".$val['start_working_hour'];

										$employee_schedule_item_in_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

										$employee_schedule_item_in_end_date1 	= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

										$employee_schedule_item_in_start_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_start_date1);

										$employee_schedule_item_in_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_end_date1);

										## End Working

										if ($val['shift_next_day'] == 0){
											$employee_schedule_item_date = $from." ".$val['end_working_hour'];	
										} else {
											$date 		= date_create($from);
											date_add($date, date_interval_create_from_date_string("1 days"));
											$start_from	= date_format($date, "Y-m-d");

											$employee_schedule_item_date = $start_from." ".$val['end_working_hour'];	
										}
										

										$employee_schedule_item_out_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

										$employee_schedule_item_out_end_date1 		= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

										$employee_schedule_item_out_start_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_start_date1);

										$employee_schedule_item_out_end_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_end_date1);										
										
										foreach ($scheduleemployeeshiftitem as $key2 => $val2) {
											$data_scheduleemployeescheduleitem = array (
												'employee_schedule_id'						=> $employee_schedule_id,
												'shift_assignment_id'						=> $shift_assignment_id,
												'employee_shift_id'							=> $val['employee_shift_id'],
												'shift_id'									=> $val['shift_id'],
												'region_id'									=> $val2['region_id'],
												'branch_id'									=> $val2['branch_id'],
												'location_id'								=> $val2['location_id'],
												'division_id'								=> $val2['division_id'],
												'department_id'								=> $val2['department_id'],
												'section_id'								=> $val2['section_id'],
												'unit_id'									=> $val2['unit_id'],
												'employee_id'								=> $val2['employee_id'],
												'employee_rfid_code'						=> $val2['employee_rfid_code'],
												'employee_schedule_item_date'				=> $from,
												'employee_schedule_item_in_start_date'		=> $employee_schedule_item_in_start_date,
												'employee_schedule_item_in_end_date'		=> $employee_schedule_item_in_end_date,
												'employee_schedule_item_out_start_date'		=> $employee_schedule_item_out_start_date,
												'employee_schedule_item_out_end_date'		=> $employee_schedule_item_out_end_date,
												'employee_schedule_item_status'				=> 9,
												'employee_schedule_item_status_default'		=> 9,
											);
											
											$this->HroEmployeeAdministrationCkp_model->insertScheduleEmployeeScheduleItem($data_scheduleemployeescheduleitem);

											if ($val['shift_next_day'] == 1){
												$data_scheduleemployeescheduleshift = array (
													'employee_schedule_id'						=> $employee_schedule_id,
													'shift_assignment_id'						=> $shift_assignment_id,
													'employee_shift_id'							=> $val['employee_shift_id'],
													'shift_id'									=> $val['shift_id'],
													'region_id'									=> $val2['region_id'],
													'branch_id'									=> $val2['branch_id'],
													'location_id'								=> $val2['location_id'],
													'division_id'								=> $val2['division_id'],
													'department_id'								=> $val2['department_id'],
													'section_id'								=> $val2['section_id'],
													'unit_id'									=> $val2['unit_id'],
													'employee_id'								=> $val2['employee_id'],
													'employee_rfid_code'						=> $val2['employee_rfid_code'],
													'employee_schedule_shift_date'				=> $from,
												);

												$this->HroEmployeeAdministrationCkp_model->insertScheduleEmployeeScheduleShift($data_scheduleemployeescheduleshift);
											}
										}
									}
								}
							}

							if ($i % $shift_pattern_weekly == 0){
								$shift_cycle++;

								$date 		= date_create($startdate);
								date_add($date, date_interval_create_from_date_string("7 days"));
								$startdate 	= date_format($date, "Y-m-d");

							} else {

							}
							$i++;
						}
					}
					

					## UPDATE DAY OFF

					$data_employeeid_schedule = $this->HroEmployeeAdministrationCkp_model->getEmployeeID_Schedule($shift_assignment_id, $employee_id);

					$last_employee_schedule_item_date = date("Y-m-d", strtotime($this->HroEmployeeAdministrationCkp_model->getLastEmployeeScheduleItemDate($shift_assignment_id)));

					foreach ($data_employeeid_schedule as $keyEmployeeSchedule => $valEmployeeSchedule) {
						$employee_id 	= $valEmployeeSchedule['employee_id'];

						$status_dayoff 	= true;
						$day_off 		= 0;

						while ($status_dayoff == true){
							$data_employee_dayoff = $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_DayOff($employee_id);

							$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

							if ($employee_day_off_cycle > 0){
								$employee_last_day_off1 = $data_employee_dayoff['employee_last_day_off'];

								$employee_schedule_item_id = $this->HroEmployeeAdministrationCkp_model->getScheduleEmployeeItemDate($shift_assignment_id, $employee_id, tgltodb($employee_last_day_off1), tgltodb($last_employee_schedule_item_date));

								

								if (!empty($employee_schedule_item_id)){
									$data_update_schedule_item = array(
										'employee_schedule_item_id'				=> $employee_schedule_item_id,
										'employee_schedule_item_status' 		=> 0,
										'employee_schedule_item_status_default' => 0
									);

									$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_update_schedule_item);

									$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

									$day_off_cycle 			= explode("#", $employee_day_off_cycle);
									$count_day_off 			= count($day_off_cycle);

									$employee_last_day_off2 = date_create($employee_last_day_off1);

									if ($count_day_off == 1){
										date_add($employee_last_day_off2, date_interval_create_from_date_string("".$day_off_cycle[$day_off]." days"));
									} else {
										date_add($employee_last_day_off2, date_interval_create_from_date_string("".$day_off_cycle[$day_off]." days"));

										$day_off++;

										$last_day_off = $count_day_off - 1;

										if ($day_off == $last_day_off){
											$day_off = 0;
										} else {
											
										}
									}

									$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

									$data_update_hro_employee_data = array(
										'employee_id'			=> $employee_id,
										'employee_last_day_off'	=> $employee_last_day_off,
									);	

									$this->HroEmployeeAdministrationCkp_model->updateHROEmployeeData_DayOff($data_update_hro_employee_data);
								} else {
									$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

									$day_off_cycle 			= explode("#", $employee_day_off_cycle);
									$count_day_off 			= count($day_off_cycle);

									$employee_last_day_off2 = date_create($employee_last_day_off1);

									if ($count_day_off == 1){
										date_add($employee_last_day_off2, date_interval_create_from_date_string("".$day_off_cycle[$day_off]." days"));
									} else {
										date_add($employee_last_day_off2, date_interval_create_from_date_string("".$day_off_cycle[$day_off]." days"));

										$day_off++;

										$last_day_off = $count_day_off - 1;

										if ($day_off == $last_day_off){
											$day_off = 0;
										} else {
											
										}
									}

									$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

									$data_update_hro_employee_data = array(
										'employee_id'			=> $employee_id,
										'employee_last_day_off'	=> $employee_last_day_off
									);	

									$this->HroEmployeeAdministrationCkp_model->updateHROEmployeeData_DayOff($data_update_hro_employee_data);

									$data_update_schedule_item = array(
										'employee_schedule_item_id'				=> $employee_schedule_item_id,
										'employee_schedule_item_status' 		=> 0,
										'employee_schedule_item_status_default' => 0
									);

									$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem($data_update_schedule_item);
								}

								if ($employee_last_day_off > $last_employee_schedule_item_date){
									$status_dayoff = false;
								}
							} else {
								$status_dayoff = false;
							}
						}
					}

					## UPDATE DAY OFF FROM SCHEDULE DAY OFF
					$data_employeeid_status = $this->HroEmployeeAdministrationCkp_model->getHROEmployeeData_DayOffStatus($employee_id);

					$scheduledayoffitem 	= $this->HroEmployeeAdministrationCkp_model->getScheduleDayOffItem();

					foreach ($data_employeeid_status as $keyDayOffStatus => $valDayOffStatus) {
						$employee_id 	= $valDayOffStatus['employee_id'];

						foreach ($scheduledayoffitem as $keyDayOffItem => $valDayOffItem) {
							$data_updatedayoff = array(
								'employee_id'							=> $employee_id,
								'employee_schedule_item_date'			=> tgltodb($valDayOffItem['day_off_item_date']),
								'employee_schedule_item_status'			=> 0,
								'employee_schedule_item_status_default'	=> 0,
							);

							$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_DayOff($data_updatedayoff);
						}
					}	

					$this->fungsi->set_log($auth['username'],'1003','Application.coreshift.processaddcoreshift',$auth['username'],'Add New coreshift');
					$msg = "<div class='alert alert-success'>                
								Add Data Shift Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";


					$this->session->unset_userdata('addscheduleshiftassignment-'.$unique['unique']);
					$this->session->unset_userdata('addarrayscheduleshiftassignmentitem-'.$unique['unique']);
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addcoreshift');
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$employee_id);
				}else{
					$msg = "<div class='alert alert-danger'>
								Add Data Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$employee_id);
				}
			}else{
				$this->session->set_userdata('addcoreshift',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$employee_id);
			}
		}

		public function function_elements_edit_updatedayoff(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeeupdatedayoff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeeupdatedayoff-'.$unique['unique'],$sessions);
		}

		public function reset_edit_updatedayoff(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');

			$this->session->unset_userdata('edithroemployeeupdatedayoff-'.$unique['unique']);	
			redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$employee_id);
		}

		public function processEditHROEmployeeData_UpdateDayOff(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 				= $this->input->post('employee_id',true);

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_update_dayoff_date'	=> date("Y-m-d"),
				'employee_last_day_off'			=> tgltodb($this->input->post('employee_last_day_off',true)),
				'employee_day_off_cycle'		=> $this->input->post('employee_day_off_cycle',true),
				'employee_update_dayoff_reason'	=> $this->input->post('employee_update_dayoff_reason',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s"),
			);

			/*print_r("data ");
			print_r($data);
			exit;*/

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_last_day_off', 'Last Day Off Date', 'required');
			$this->form_validation->set_rules('employee_day_off_cycle', 'Day Off Cycle', 'required');
			$this->form_validation->set_rules('employee_update_dayoff_reason', 'Update Day Off Reason', 'required');
	
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->insertHROEmployeeUpdateDayOff($data)){
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeeUpdateDayOff', $data['employee_id'], 'Update HRO Employee Day Off');

					$data_updatescheduleitem = array (
						'employee_id'							=> $data['employee_id'],
						'employee_schedule_item_date'			=> $data['employee_last_day_off'],
						'employee_schedule_item_status_default'	=> 9,
						'employee_schedule_item_status'			=> 9
					);

					if ($this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_UpdateDayOff($data_updatescheduleitem)){
						$last_employee_schedule_item_date 	= $this->HroEmployeeAdministrationCkp_model->getLastEmployeeScheduleItemDate_Employee($data['employee_id']);

						$employee_schedule_item_date 		= $data['employee_last_day_off'];
						$employee_day_off_cycle 			= $data['employee_day_off_cycle'];

						while ($employee_schedule_item_date <= $last_employee_schedule_item_date){
							$data_updatedayoff = array (
								'employee_id'							=> $data['employee_id'],
								'employee_schedule_item_date'			=> $employee_schedule_item_date,
								'employee_schedule_item_status'			=> 0,
								'employee_schedule_item_status_default'	=> 0,
							);

							$this->HroEmployeeAdministrationCkp_model->updateScheduleEmployeeScheduleItem_UpdateDayOffEdit($data_updatedayoff);

							$employee_schedule_item_date2 				= date_create($employee_schedule_item_date);

							date_add($employee_schedule_item_date2, date_interval_create_from_date_string("".$employee_day_off_cycle." days"));

							$employee_schedule_item_date 	= date_format($employee_schedule_item_date2, "Y-m-d");
						}	
					}

					$msg = "<div class='alert alert-success'>                
								Edit Data Employee Day Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_updatedayoff',$msg);
					$this->session->unset_userdata('edithroemployeeupdatedayoff-'.$unique['unique']);	
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Employee Day Off Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_updatedayoff',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_updatedayoff',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$data['employee_id']);
			}
		}




		
		
		public function Edit(){
			$data['Main_view']['result']		= $this->HroEmployeeAdministrationCkp_model->getDetail($this->uri->segment(3));
			$data['Main_view']['content']		= 'HroEmployeeAdministrationCkp/editHroEmployeeAdministrationCkp_view';
			$data['Main_view']['employee']		= create_double($this->HroEmployeeAdministrationCkp_model->getemployee(),'employee_id','employee_name');
			$data['Main_view']['late']			= create_double($this->HroEmployeeAdministrationCkp_model->getlate(),'late_id','late_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditHroEmployeeAdministrationCkp(){
			
			$data = array(
				'employee_late_id' 				=> $this->input->post('employee_late_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_late_date'				=> tgltodb($this->input->post('employee_late_date',true)),
				'employee_late_remark' 			=> $this->input->post('employee_late_remark',true),
				'late_id' 							=> $this->input->post('late_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_late_date', 'Date', 'required');
			$this->form_validation->set_rules('late_id', 'Late', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministrationCkp_model->saveEditHroEmployeeAdministrationCkp($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HroEmployeeAdministrationCkp.Edit',$auth['username'],'Edit Employee Late');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_late_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Late Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAdministrationCkp/Edit/'.$data['employee_late_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Late UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAdministrationCkp/Edit/'.$data['employee_late_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministrationCkp/Edit/'.$data['employee_late_id']);
			}
		}


		
	}
?>