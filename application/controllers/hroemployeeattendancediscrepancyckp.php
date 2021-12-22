<?php
	class hroemployeeattendancediscrepancyckp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancediscrepancyckp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 			= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$sesi	= 	$this->session->userdata('filter-hroemployeeattendancediscrepancyckp');
			if(!is_array($sesi)){
				$sesi['start_date']								= date("Y-m-d");
				$sesi['end_date']								= date("Y-m-d");
				$sesi['location_id']							= '';
				$sesi['employee_shift_id']						= '';
				$sesi['employee_id']							= '';
				$sesi['unit_id']								= '';
				$sesi['employee_attendance_date_status'] 		= '';
				$sesi['employee_attendance_late_status'] 		= '';
				$sesi['employee_attendance_overtime_status'] 	= '';
				$sesi['employee_attendance_homeearly_status'] 	= '';
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$data['main_view']['corelocation']						= create_double($this->hroemployeeattendancediscrepancyckp_model->getCoreLocation(), 'location_id', 'location_name');

			$data['main_view']['coreunit']							= create_double($this->hroemployeeattendancediscrepancyckp_model->getCoreUnit(), 'unit_id', 'unit_name');

			$data['main_view']['hroemployeeattendancedata']			= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAttendanceData($region_id, $branch_id, $sesi['location_id'], $start_date, $end_date, $sesi['employee_shift_id'], $sesi['employee_id'], $sesi['unit_id'], $sesi['employee_attendance_date_status'], $sesi['employee_attendance_late_status'], $sesi['employee_attendance_overtime_status'], $sesi['employee_attendance_homeearly_status']);

			$data['main_view']['employeeattendancedatestatus']		= $this->configuration->EmployeeAttendanceDateStatus;

			$data['main_view']['employeeattendancelatestatus']		= $this->configuration->EmployeeAttendanceLateStatus;

			$data['main_view']['employeeattendanceovertimestatus']	= $this->configuration->EmployeeAttendanceOvertimeStatus;

			$data['main_view']['employeeattendancehomeearlystatus']	= $this->configuration->EmployeeAttendanceHomeEarlyStatus;

			$data['main_view']['content']							= 'hroemployeeattendancediscrepancyckp/listhroemployeeattendancediscrepancyckp_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getScheduleEmployeeShift(){
			$location_id = $this->input->post('location_id');
			$item = $this->hroemployeeattendancediscrepancyckp_model->getScheduleEmployeeShift_Location($location_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_shift_id]'>$mp[employee_shift_code]</option>\n";	
			}
			echo $data;
		}

		public function getScheduleEmployeeShiftItem(){
			$employee_shift_id = $this->input->post('employee_shift_id');
			$item = $this->hroemployeeattendancediscrepancyckp_model->getScheduleEmployeeShiftItem($employee_shift_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'start_date'							=> $this->input->post('start_date',true),	
				'end_date'								=> $this->input->post('end_date',true),	
				'location_id'							=> $this->input->post('location_id',true),	
				'employee_shift_id'						=> $this->input->post('employee_shift_id',true),	
				'employee_id'							=> $this->input->post('employee_id',true),	
				'unit_id'								=> $this->input->post('unit_id',true),	
				'employee_attendance_date_status'		=> $this->input->post('employee_attendance_date_status',true),	
				'employee_attendance_late_status'		=> $this->input->post('employee_attendance_late_status',true),	
				'employee_attendance_overtime_status'	=> $this->input->post('employee_attendance_overtime_status',true),	
				'employee_attendance_homeearly_status'	=> $this->input->post('employee_attendance_homeearly_status',true),	
			);
			$this->session->set_userdata('filter-hroemployeeattendancediscrepancyckp',$data);
			redirect('hroemployeeattendancediscrepancyckp');
		}

		public function reset_search(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeedatadiscrepancy-'.$unique['unique']);
			$this->session->unset_userdata('filter-hroemployeeattendancediscrepancyckp');
			redirect('hroemployeeattendancediscrepancyckp');
		}

		public function addHROEmployeeAttendanceDiscrepancy(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeData_Detail($employee_id);

			$data['main_view']['hroemployeepermit']				= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeePermit($employee_id);

			$data['main_view']['corepermit']					= create_double($this->hroemployeeattendancediscrepancyckp_model->getCorePermit(),'permit_id','permit_name');

			$data['main_view']['hroemployeeabsence']			= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAbsence($employee_id);

			$data['main_view']['coreabsence']					= create_double($this->hroemployeeattendancediscrepancyckp_model->getCoreAbsence(),'absence_id','absence_name');

			$data['main_view']['hroemployeeabsence']			= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAbsence($employee_id);

			$data['main_view']['coreovertimetype']				= create_double($this->hroemployeeattendancediscrepancyckp_model->getCoreOvertimeType(),'overtime_type_id','overtime_type_name');

			$data['main_view']['payrollovertimerequest']		= $this->hroemployeeattendancediscrepancyckp_model->getPayrollOvertimeRequest($employee_id);

			$data['main_view']['corehomeearly']					= create_double($this->hroemployeeattendancediscrepancyckp_model->getCoreHomeEarly(), 'home_early_id','home_early_name');

			$data['main_view']['hroemployeehomeearly']			= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeHomeEarly($employee_id);

			$data['main_view']['hroemployeecanceloff']			= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeCancelOff($employee_id);

			$data['main_view']['hroemployeeswapoff']			= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeSwapOff($employee_id);

			$data['main_view']['hroemployeeattendancestatus']	= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAttendanceStatus($employee_id);

			$data['main_view']['employeeattendancedatestatus']	= $this->configuration->EmployeeAttendanceDateStatus;

			$data['main_view']['content']						= 'hroemployeeattendancediscrepancyckp/formaddhroemployeeattendancediscrepancyckp_view';

			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeattendancediscrepancyckp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeattendancediscrepancyckp-'.$unique['unique'],$sessions);
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
			$employee_id 					= $this->uri->segment(3);	
			$employee_attendance_date 		= $this->uri->segment(4);	
			$employee_attendance_data_id 	= $this->uri->segment(5);	
			$unique 						= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
			redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
		}
		
		public function processAddHROEmployeePermit(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$permit_id 						= $this->input->post('permit_id',true);
			$employee_id 					= $this->input->post('employee_id',true);
			$employee_attendance_date 		= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id 	= $this->input->post('employee_attendance_data_id',true);

			$corepermit						= $this->hroemployeeattendancediscrepancyckp_model->getCorePermit_Detail($permit_id);

			$employee_attendance_date_status = $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatus($employee_attendance_data_id);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'permit_id' 						=> $permit_id,
				'employee_attendance_data_id'		=> $employee_attendance_data_id,
				'permit_type' 						=> $corepermit['permit_type'],
				'employee_permit_date'				=> tgltodb($employee_attendance_date),
				'employee_permit_description'		=> $this->input->post('employee_permit_description',true),
				'employee_permit_start_date'		=> tgltodb($employee_attendance_date),
				'employee_permit_end_date'			=> tgltodb($employee_attendance_date),
				'employee_attendance_date_status'	=> $employee_attendance_date_status,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_permit_date', 'Date', 'required');
			$this->form_validation->set_rules('permit_id', 'Permit', 'required');
			$this->form_validation->set_rules('employee_permit_description', 'Permit Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeePermit($data)){
					$employee_permit_id = $this->hroemployeeattendancediscrepancyckp_model->getEmployeePermitID($data['created_id']);

					$data_employeepermitdetail = array (
				    	'employee_permit_id'				=> $employee_permit_id,
				    	'employee_id'						=> $data['employee_id'],
				    	'employee_permit_detail_date'		=> $employee_attendance_date,
				    );

				    if ($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeePermit_Detail($data_employeepermitdetail)){

				    	$dataupdate_attendancedata = array(
					    	'employee_attendance_data_id'		=> $employee_attendance_data_id,
					    	'employee_id'						=> $data['employee_id'],
					    	'employee_attendance_date_status'	=> $corepermit['permit_status'],
					    );

				    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

				    		$employee_attendance_log_period = date("Ym", strtotime($employee_attendance_date));
				    		$day_log 						= "day_".date("d", strtotime($employee_attendance_date));

				    		$dataupdate_attendancelog = array (
				    			'employee_id'						=> $data['employee_id'],
				    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
				    			$day_log 							=> $corepermit['permit_status'],
				    		);

				    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				    	}
				    }

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Permit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_permit',$msg);
					$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Permit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_permit',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_permit',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeePermit(){
			$employee_id 					= $this->uri->segment(3);
			$employee_permit_id 			= $this->uri->segment(4);
			$employee_attendance_date 		= $this->uri->segment(5);
			$employee_attendance_data_id 	= $this->uri->segment(6);

			$data_delete = array (
				'employee_permit_id' 		=> $employee_permit_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeePermit($data_delete)){
				$auth = $this->session->userdata('auth');

				$hroemployeepermit_detail = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeePermit_Detail($employee_permit_id);

				$dataupdate_attendancedata = array (
					'employee_id'							=> $employee_id,
					'employee_attendance_data_id'			=> $hroemployeepermit_detail['employee_attendance_data_id'],
					'employee_attendance_date_status'		=> $hroemployeepermit_detail['employee_attendance_date_status'],
				);

				if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){
					$employee_attendance_log_period = date("Ym", strtotime($hroemployeepermit_detail['employee_permit_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeepermit_detail['employee_permit_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $employee_id,
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeepermit_detail['employee_attendance_date_status']
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				}

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Permit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_permit',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Permit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_permit',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
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
			$employee_id 					= $this->uri->segment(3);	
			$employee_attendance_date 		= $this->uri->segment(4);	
			$employee_attendance_data_id 	= $this->uri->segment(5);	
			$unique 						= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeabsence-'.$unique['unique']);	
			redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
		}

		public function processAddHROEmployeeAbsence(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_attendance_date				= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id			= $this->input->post('employee_attendance_data_id',true);

			$employee_attendance_date_status 		= $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatus($employee_attendance_data_id);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'absence_id' 						=> $this->input->post('absence_id',true),
				'employee_attendance_data_id'		=> $employee_attendance_data_id,
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_start_date'		=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_end_date'			=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_description'		=> $this->input->post('employee_absence_description',true),
				'employee_attendance_date_status'	=> $employee_attendance_date_status,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Absence Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence Name', 'required');
			$this->form_validation->set_rules('employee_absence_description', 'Absence Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeeAbsence($data)){
					$employee_absence_id = $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAbsenceID($data['created_id']);

					$data_employeeabsencedetail = array (
				    	'employee_absence_id'				=> $employee_absence_id,
				    	'employee_id'						=> $data['employee_id'],
				    	'employee_absence_detail_date'		=> $employee_attendance_date,
				    );

				    if ($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeeAbsence_Detail($data_employeeabsencedetail)){

				    	$dataupdate_attendancedata = array(
				    		'employee_attendance_data_id'		=> $employee_attendance_data_id,
				    		'employee_id'						=> $data['employee_id'],
				    		'employee_attendance_date_status'	=> 2,
				    	);

				    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

				    		$employee_attendance_log_period = date("Ym", strtotime($data['employee_absence_date']));
				    		$day_log 						= "day_".date("d", strtotime($data['employee_absence_date']));

				    		$dataupdate_attendancelog = array (
				    			'employee_id'						=> $data['employee_id'],
				    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
				    			$day_log 							=> 2
				    		);

				    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				    	}
				    }

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeeAbsence',$auth['user_id'],'Add New Employee Absence');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Absence Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_absence',$msg);
					$this->session->unset_userdata('addhroemployeeabsence-'.$unique['unique']);	
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Absence UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_absence',$msg);
					$this->session->set_userdata('Addhroemployeeabsence',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_absence',$msg);
				$this->session->set_userdata('Addhroemployeeabsence',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeeAbsence(){
			$employee_id 					= $this->uri->segment(3);
			$employee_absence_id 			= $this->uri->segment(4);
			$employee_attendance_date 		= $this->uri->segment(5);
			$employee_attendance_data_id 	= $this->uri->segment(6);

			$data_delete = array (
				'employee_absence_id'		=> $employee_absence_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeeAbsence($data_delete)){
				$auth = $this->session->userdata('auth');

				$hroemployeeabsence_detail = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAbsence_Detail($employee_absence_id);

				$dataupdate_attendancedata = array (
					'employee_id'						=> $employee_id,
					'employee_attendance_data_id'		=> $hroemployeeabsence_detail['employee_attendance_data_id'],
					'employee_attendance_date_status'	=> $hroemployeeabsence_detail['employee_attendance_date_status'],
				);

				if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){
					$employee_attendance_log_period = date("Ym", strtotime($hroemployeeabsence_detail['employee_absence_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeeabsence_detail['employee_absence_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $employee_id,
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeeabsence_detail['employee_attendance_date_status'],
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				}

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_absence',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_absence',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function function_elements_add_overtime(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimerequest-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollovertimerequest-'.$unique['unique'],$sessions);
		}

		public function reset_add_overtime(){
			$employee_id 				= $this->uri->segment(3);	
			$employee_attendance_date 		= $this->uri->segment(4);	
			$employee_attendance_data_id 	= $this->uri->segment(5);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollovertimerequest-'.$unique['unique']);	
			redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
		}

		public function processAddPayrollOvertimeRequest(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_attendance_date					= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id				= $this->input->post('employee_attendance_data_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'overtime_type_id' 					=> $this->input->post('overtime_type_id',true),
				'overtime_request_description'		=> $this->input->post('overtime_request_description',true),
				'overtime_request_date'				=> tgltodb($this->input->post('overtime_request_date',true)),
				'overtime_request_hours'	 		=> $this->input->post('overtime_request_hours',true),
				'overtime_request_minutes'	 		=> $this->input->post('overtime_request_minutes',true),
				'overtime_request_dayoff_status'	=> $this->input->post('employee_attendance_overtime_dayoff',true),
				'overtime_request_approved' 		=> 1,
				'overtime_request_approved_id'		=> $auth['user_id'],
				'overtime_request_approved_on'		=> date("Y-m-d H:i:s"),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_request_description', 'Overtime Request Description', 'required');
			$this->form_validation->set_rules('overtime_type_id', 'Overtime type', 'required');
			$this->form_validation->set_rules('overtime_request_date', 'Overtime Request Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancediscrepancyckp_model->insertPayrollOvertimeRequest($data)){

					$dataupdate_attendancedata = array(
			    		'employee_attendance_data_id'			=> $employee_attendance_data_id,
			    		'employee_id'							=> $data['employee_id'],
			    		'employee_attendance_overtime_dayoff'	=> $data['overtime_request_dayoff_status'],
			    		'employee_attendance_overtime_status'	=> 2
			    	);

			    	$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOvertimeRequest.processAddPayrollOvertimeRequest',$auth['user_id'],'Add New Payroll Overtime Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Overtime Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->unset_userdata('Addpayrollleaverequest');
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Overtime Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_leave',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deletePayrollOvertimeRequest(){
			$employee_id 					= $this->uri->segment(3);
			$overtime_request_id 			= $this->uri->segment(4);
			$employee_attendance_date 		= $this->uri->segment(5);
			$employee_attendance_data_id 	= $this->uri->segment(6);

			$data_delete = array (
				'overtime_request_id'		=> $overtime_request_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeattendancediscrepancyckp_model->deletePayrollOvertimeRequest($data_delete)){
				$auth = $this->session->userdata('auth');

				$dataupdate_attendancedata = array (
					'employee_id'							=> $employee_id,
					'employee_attendance_data_id'			=> $hroemployeeabsence_detail['employee_attendance_data_id'],
					'employee_attendance_overtime_dayoff'	=> 0,
				);

				$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata);
					
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function function_elements_add_homeearly(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeehomeearly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeehomeearly-'.$unique['unique'],$sessions);
		}

		public function reset_add_homeearly(){
			$employee_id 					= $this->uri->segment(3);	
			$employee_attendance_date 		= $this->uri->segment(4);	
			$employee_attendance_data_id 	= $this->uri->segment(5);	
			$unique 						= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeehomeearly-'.$unique['unique']);	
			redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
		}
		
		public function processAddHROEmployeeHomeEarly(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 					= $this->input->post('employee_id',true);
			$employee_attendance_date 		= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id 	= $this->input->post('employee_attendance_data_id',true);

			$employee_attendance_date_status 		= $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatus($employee_attendance_data_id);

			$employee_attendance_date_status_new 	= $this->input->post('employee_attendance_date_status',true);			

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'home_early_id'						=> $this->input->post('home_early_id',true),
				'employee_attendance_data_id'		=> $employee_attendance_data_id,
				'employee_home_early_date'			=> tgltodb($this->input->post('employee_home_early_date',true)),
				'employee_home_early_hours'			=> $this->input->post('employee_home_early_hours',true),
				'employee_home_early_minutes'		=> $this->input->post('employee_home_early_minutes',true),
				'employee_home_early_description'	=> $this->input->post('employee_home_early_description',true),
				'employee_attendance_date_status'	=> $employee_attendance_date_status,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_home_early_date', 'Date', 'required');
			$this->form_validation->set_rules('home_early_id', 'Home Early', 'required');
			$this->form_validation->set_rules('employee_home_early_description', 'Home Early Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeeHomeEarly($data)){

					$dataupdate_attendancedata = array (
						'employee_attendance_data_id'			=> $employee_attendance_data_id,
						'employee_attendance_date_status'		=> $employee_attendance_date_status_new,
						'employee_id'							=> $data['employee_id'],
						'employee_attendance_homeearly_status'	=> 2
					);

					if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

			    		$employee_attendance_log_period = date("Ym", strtotime($data['employee_absence_date']));
			    		$day_log 						= "day_".date("d", strtotime($data['employee_absence_date']));

			    		$dataupdate_attendancelog = array (
			    			'employee_id'						=> $data['employee_id'],
			    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
			    			$day_log 							=> $employee_attendance_date_status_new,
			    		);

			    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
			    	}

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeeHomeEarly',$auth['user_id'],'Add New Employee Home Early');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Home Early Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_permit',$msg);
					$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Home Early UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_permit',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_permit',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeeHomeEarly(){
			$employee_id 					= $this->uri->segment(3);
			$employee_home_early_id 		= $this->uri->segment(4);
			$employee_attendance_date 		= $this->uri->segment(5);
			$employee_attendance_data_id 	= $this->uri->segment(6);

			$data_delete = array (
				'employee_home_early_id'	=> $employee_home_early_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeeHomeEarly($data_delete)){
				$auth = $this->session->userdata('auth');

				$hroemployeehomeearly_detail = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeHomeEarly_Detail($employee_home_early_id);

				$dataupdate_attendancedata = array (
					'employee_id'							=> $employee_id,
					'employee_attendance_data_id'			=> $hroemployeehomeearly_detail['employee_attendance_data_id'],
					'employee_attendance_date_status'		=> $hroemployeehomeearly_detail['employee_attendance_date_status'],
					'employee_attendance_homeearly_status'	=> 0
				);

				if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){
					$employee_attendance_log_period = date("Ym", strtotime($hroemployeehomeearly_detail['employee_home_early_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeehomeearly_detail['employee_home_early_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $employee_id,
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeehomeearly_detail['employee_attendance_date_status'],
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				}

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeHomeEarly.deleteHROEmployeeHomeEarly',$auth['user_id'],'Delete Employee Home Early');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Home Early Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_permit',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Home Early UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_permit',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
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
			$employee_id 					= $this->uri->segment(3);	
			$employee_absence_date 			= $this->uri->segment(4);	
			$employee_attendance_data_id 	= $this->uri->segment(5);	
			$unique 						= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeecanceloff-'.$unique['unique']);	
			redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_attendance_data_id);
		}
		
		public function processAddHROEmployeeCancelOff(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 					= $this->input->post('employee_id',true);
			$employee_attendance_date 		= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id 	= $this->input->post('employee_attendance_data_id',true);

			$employee_attendance_date_status = $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatus($employee_attendance_data_id);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_attendance_data_id'		=> $employee_attendance_data_id,
				'employee_cancel_off_date'			=> tgltodb($this->input->post('employee_cancel_off_date',true)),
				'employee_cancel_off_description'	=> $this->input->post('employee_cancel_off_description',true),
				'employee_cancel_off_remark' 		=> $this->input->post('employee_cancel_off_remark',true),
				'employee_attendance_date_status'	=> $employee_attendance_date_status,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_cancel_off_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_cancel_off_description', 'Cancel Off Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeeCancelOff($data)){
					$dataupdate_attendancedata = array(
			    		'employee_attendance_data_id'		=> $employee_attendance_data_id,
			    		'employee_id'						=> $data['employee_id'],
			    		'employee_attendance_date_status'	=> 6,
			    	);

			    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

			    		$employee_attendance_log_period = date("Ym", strtotime($data['employee_absence_date']));
			    		$day_log 						= "day_".date("d", strtotime($data['employee_absence_date']));

			    		$dataupdate_attendancelog = array (
			    			'employee_id'						=> $data['employee_id'],
			    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
			    			$day_log 							=> 6
			    		);

			    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
			    	}

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Cancel Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_canceloff',$msg);
					$this->session->unset_userdata('addhroemployeecanceloff-'.$unique['unique']);	
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Cancel Off UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_canceloff',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_canceloff',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeeCancelOff(){
			$employee_id 					= $this->uri->segment(3);
			$employee_cancel_off_id			= $this->uri->segment(4);
			$employee_attendance_date 		= $this->uri->segment(5);
			$employee_attendance_data_id 	= $this->uri->segment(6);

			$data_delete = array (
				'employee_cancel_off_id'	=> $employee_cancel_off_id,
				'data_state'				=> 1
			);

			$hroemployeecanceloff_detail = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeCancelOff_Detail($employee_cancel_off_id);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeeCancelOff($data_delete)){
				$auth = $this->session->userdata('auth');

				$dataupdate_attendancedata = array(
		    		'employee_attendance_data_id'		=> $hroemployeecanceloff_detail['employee_attendance_data_id'],
		    		'employee_id'						=> $data['employee_id'],
		    		'employee_attendance_date_status'	=> $hroemployeecanceloff_detail['employee_attendance_date_status'],
		    	);

		    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

		    		$employee_attendance_log_period = date("Ym", strtotime($hroemployeecanceloff_detail['employee_cancel_off_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeecanceloff_detail['employee_cancel_off_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $data['employee_id'],
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeecanceloff_detail['employee_attendance_date_status']
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
		    	}

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Cancel Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_canceloff',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Cancel Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_canceloff',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
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
			$employee_id 					= $this->uri->segment(3);	
			$employee_absence_date 			= $this->uri->segment(4);	
			$employee_attendance_data_id 	= $this->uri->segment(5);	
			$unique 						= $this->session->userdata('unique');

			$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
			redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_attendance_data_id);
		}
		
		public function processAddHROEmployeeSwapOff(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 					= $this->input->post('employee_id',true);
			$employee_attendance_date 		= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id 	= $this->input->post('employee_attendance_data_id',true);
			$employee_swap_off_to_date 		= tgltodb($this->input->post('employee_swap_off_to_date',true));

			$employee_attendance_date_status = $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatus($employee_attendance_data_id);

			$data_attendancedate_todate = $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatus_ToDate($employee_id, $employee_swap_off_to_date);

			$data = array(
				'employee_id' 								=> $this->input->post('employee_id',true),
				'employee_attendance_data_id'				=> $employee_attendance_data_id,
				'employee_attendance_data_id_todate'		=> $data_attendancedate_todate['employee_attendance_data_id'],
				'employee_swap_off_date'					=> tgltodb($this->input->post('employee_swap_off_date',true)),
				'employee_swap_off_to_date'					=> tgltodb($this->input->post('employee_swap_off_to_date',true)),
				'employee_swap_off_description'				=> $this->input->post('employee_swap_off_description',true),
				'employee_swap_off_remark'	 				=> $this->input->post('employee_swap_off_remark',true),	
				'employee_attendance_date_status'			=> $employee_attendance_date_status,
				'employee_attendance_date_status_todate'	=> 7,
				'data_state'								=> 0,
				'created_id'								=> $auth['user_id'],
				'created_on'								=> date("Y-m-d H:i:s"),
			);

			/*print_r("employee_id ");
			print_r($employee_id);
			print_r("<BR>");
			print_r("employee_swap_off_to_date ");
			print_r($employee_swap_off_to_date);
			print_r("<BR>");
			print_r("data_attendancedate_todate ");
			print_r($data_attendancedate_todate);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			print_r("<BR>");
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_swap_off_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_swap_off_to_date', 'To Date', 'required');
			$this->form_validation->set_rules('employee_swap_off_description', 'Swap Off Description', 'required');
			
			if($this->form_validation->run()==true){
				if (!empty($data_attendancedate_todate)){
					
					if($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeeSwapOff($data)){
						$dataupdate_attendancedata = array(
				    		'employee_attendance_data_id'		=> $employee_attendance_data_id,
				    		'employee_id'						=> $data['employee_id'],
				    		'employee_attendance_date_status'	=> 7
				    	);

				    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

				    		$employee_attendance_log_period = date("Ym", strtotime($employee_attendance_date));
				    		$day_log 						= "day_".date("d", strtotime($employee_attendance_date));

				    		$dataupdate_attendancelog = array (
				    			'employee_id'						=> $data['employee_id'],
				    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
				    			$day_log 							=> $data_attendancedate_todate['employee_attendance_date_status'],
				    		);

				    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				    	}


				    	$dataupdate_attendancedata = array(
				    		'employee_attendance_data_id'		=> $data_attendancedate_todate['employee_attendance_data_id'],
				    		'employee_id'						=> $data['employee_id'],
				    		'employee_attendance_date_status'	=> $employee_attendance_date_status
				    	);

				    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

				    		$employee_attendance_log_period = date("Ym", strtotime($data['employee_swap_off_to_date']));
				    		$day_log 						= "day_".date("d", strtotime($data['employee_swap_off_to_date']));

				    		$dataupdate_attendancelog = array (
				    			'employee_id'						=> $data['employee_id'],
				    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
				    			$day_log 							=> $employee_attendance_date_status
				    		);

				    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
				    	}

						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Swap Off Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

						$this->session->set_userdata('message_swapoff',$msg);
						$this->session->unset_userdata('addhroemployeeswapoff-'.$unique['unique']);	
						redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Employee Swap Off UnSuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message_swapoff',$msg);
						$this->session->set_userdata('Addhroemployeepermit',$data);
						redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
								Data Swap To Date Empty
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_swapoff',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_swapoff',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeeSwapOff(){
			$employee_id 					= $this->uri->segment(3);
			$employee_swap_off_id			= $this->uri->segment(4);
			$employee_attendance_date 		= $this->uri->segment(5);
			$employee_attendance_data_id 	= $this->uri->segment(6);

			$hroemployeeswapoff_detail = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeSwapOff_Detail($employee_swap_off_id);

			$data_delete = array(
				'employee_swap_off_id'	 	=> $employee_swap_off_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeeSwapOff($data_delete)){
				$auth = $this->session->userdata('auth');

				$dataupdate_attendancedata = array(
		    		'employee_attendance_data_id'		=> $hroemployeeswapoff_detail['employee_attendance_data_id'],
		    		'employee_id'						=> $data['employee_id'],
		    		'employee_attendance_date_status'	=> $hroemployeeswapoff_detail['employee_attendance_date_status']
		    	);

		    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

		    		$employee_attendance_log_period = date("Ym", strtotime($hroemployeeswapoff_detail['employee_swap_off_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeeswapoff_detail['employee_swap_off_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $data['employee_id'],
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeeswapoff_detail['employee_attendance_date_status']
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
		    	}


		    	$dataupdate_attendancedata = array(
		    		'employee_attendance_data_id'		=> $data_attendancedate_todate['employee_attendance_data_id_todate'],
		    		'employee_id'						=> $data['employee_id'],
		    		'employee_attendance_date_status'	=> $data_attendancedate_todate['employee_attendance_date_status_todate'],
		    	);

		    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

		    		$employee_attendance_log_period = date("Ym", strtotime($hroemployeeswapoff_detail['employee_swap_off_to_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeeswapoff_detail['employee_swap_off_to_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $data['employee_id'],
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeeswapoff_detail['employee_attendance_date_status_todate'],
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
		    	}

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Swap Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_swapoff',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Swap Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_swapoff',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function processAddHROEmployeeAttendanceStatus(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_id 					= $this->input->post('employee_id',true);
			$employee_attendance_date 		= $this->input->post('employee_attendance_date',true);
			$employee_attendance_data_id 	= $this->input->post('employee_attendance_data_id',true);

			$data = array(
				'employee_id' 								=> $this->input->post('employee_id',true),
				'employee_attendance_data_id'				=> $employee_attendance_data_id,
				'employee_attendance_date'					=> tgltodb($this->input->post('employee_attendance_date',true)),
				'employee_attendance_date_status_old'		=> $this->input->post('employee_attendance_date_status_old',true),
				'employee_attendance_date_status'			=> $this->input->post('employee_attendance_date_status',true),
				'employee_attendance_status_description'	=> $this->input->post('employee_attendance_status_description',true),
				'data_state'								=> 0,
				'created_id'								=> $auth['user_id'],
				'created_on'								=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_attendance_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_attendance_status_description', 'Attendance Status Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancediscrepancyckp_model->insertHROEmployeeAttendanceStatus($data)){
					$dataupdate_attendancedata = array(
			    		'employee_attendance_data_id'		=> $employee_attendance_data_id,
			    		'employee_id'						=> $data['employee_id'],
			    		'employee_attendance_date_status'	=> $data['employee_attendance_date_status']
			    	);

			    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

			    		$employee_attendance_log_period = date("Ym", strtotime($employee_attendance_date));
			    		$day_log 						= "day_".date("d", strtotime($employee_attendance_date));

			    		$dataupdate_attendancelog = array (
			    			'employee_id'						=> $data['employee_id'],
			    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
			    			$day_log 							=> $data['employee_attendance_date_status']
			    		);

			    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
			    	}

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Cancel Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message_attendance',$msg);
					$this->session->unset_userdata('addhroemployeecanceloff-'.$unique['unique']);	
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Cancel Off UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_attendance',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_attendance',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$data['employee_id'].'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeeAttendanceStatus(){
			$employee_id 							= $this->uri->segment(3);
			$employee_attendance_status_id			= $this->uri->segment(4);
			$employee_attendance_date 				= $this->uri->segment(5);
			$employee_attendance_data_id			= $this->uri->segment(6);

			$data_delete = array(
				'employee_attendance_status_id' 	=> $employee_attendance_status_id,
				'data_state'						=> 1
			);

			$hroemployeeattendancestatus_detail = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAttendanceStatus_Detail($employee_attendance_status_id);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeeAttendanceStatus($data_delete)){
				$auth = $this->session->userdata('auth');

				$dataupdate_attendancedata = array(
		    		'employee_attendance_data_id'		=> $hroemployeeattendancestatus_detail['employee_attendance_data_id'],
		    		'employee_id'						=> $data['employee_id'],
		    		'employee_attendance_date_status'	=> $hroemployeeattendancestatus_detail['employee_attendance_date_status_old']
		    	);

		    	if ($this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

		    		$employee_attendance_log_period = date("Ym", strtotime($hroemployeeattendancestatus_detail['employee_attendance_date']));
		    		$day_log 						= "day_".date("d", strtotime($hroemployeeattendancestatus_detail['employee_attendance_date']));

		    		$dataupdate_attendancelog = array (
		    			'employee_id'						=> $data['employee_id'],
		    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
		    			$day_log 							=> $hroemployeeattendancestatus_detail['employee_attendance_date_status_old']
		    		);

		    		$this->hroemployeeattendancediscrepancyckp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
		    	}

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Cancel Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_canceloff',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Cancel Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_canceloff',$msg);
				redirect('hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$employee_id.'/'.$employee_attendance_date.'/'.$employee_attendance_data_id);
			}
		}

		public function deleteHROEmployeeAttendanceData(){
			$auth = $this->session->userdata('auth');

			$employee_attendance_data_id	= $this->input->post("employee_attendance_data_id_delete", true);

			$data_attendancedata = array (
				'employee_attendance_data_id'		=> $employee_attendance_data_id,
				'employee_attendance_delete_remark'	=> $this->input->post("employee_attendance_delete_remark", true),
				'data_state'						=> 1,
				'employee_attendance_delete_id'		=> $auth['user_id'],
				'employee_attendance_delete_on'		=> date("Y-m-d H:i:s"),
			);

			if($this->hroemployeeattendancediscrepancyckp_model->deleteHROEmployeeAttendanceData($data_attendancedata)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Attendance Data');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_absence',$msg);
				redirect('hroemployeeattendancediscrepancyckp/');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_absence',$msg);
				redirect('hroemployeeattendancediscrepancyckp/');
			}
		}










		
	}
?>