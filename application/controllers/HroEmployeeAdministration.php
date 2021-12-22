<?php
	Class HroEmployeeAdministration extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeAdministration_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];
			//$branch_status 				= $auth['branch_status'];

			$systemuserbranch									= $this->HroEmployeeAdministration_model->getSystemUserBranch($user_id);


			$sesi	= 	$this->session->userdata('filter-HroEmployeeAdministration');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->HroEmployeeAdministration_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['corebranch']						= create_double($this->HroEmployeeAdministration_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['hroemployeedata_administration']	= $this->HroEmployeeAdministration_model->getHROEmployeeData_Administration($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']							= 'HroEmployeeAdministration/ListHroEmployeeAdministration_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->HroEmployeeAdministration_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->HroEmployeeAdministration_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'branch_id'			=> $this->input->post('branch_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeAdministration',$data);
			redirect('HroEmployeeAdministration');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAdministrationtab-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeAdministrationtab-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAdministration-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeAdministration-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeAdministration');
			$this->session->unset_userdata('filter-HroEmployeeAdministration');
			redirect('HroEmployeeAdministration');
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addHroEmployeeAdministration-'.$unique['unique']);	
			redirect('HroEmployeeAdministration/addHROEmployeeLate/'.$employee_id);
		}

		public function function_elements_add_late(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeelate-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeelate-'.$unique['unique'],$sessions);
		}

		public function reset_add_late(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeelate-'.$unique['unique']);	
			redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
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
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
			redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
		}
		
		public function addHroEmployeeAdministration(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->HroEmployeeAdministration_model->getHROEmployeeData_Detail($employee_id);

			$data['main_view']['corelate']					= create_double($this->HroEmployeeAdministration_model->getCoreLate(),'late_id','late_name');

			$data['main_view']['hroemployeelate']			= $this->HroEmployeeAdministration_model->getHROEmployeeLate($employee_id);

			$data['main_view']['corepermit']				= create_double($this->HroEmployeeAdministration_model->getCorePermit(),'permit_id','permit_name');

			$data['main_view']['hroemployeepermit']			= $this->HroEmployeeAdministration_model->getHROEmployeePermit($employee_id);

			$data['main_view']['coreabsence']				= create_double($this->HroEmployeeAdministration_model->getCoreAbsence(),'absence_id','absence_name');

			$data['main_view']['hroemployeeabsence']		= $this->HroEmployeeAdministration_model->getHROEmployeeAbsence($employee_id);

			$data['main_view']['coreovertimetype']			= create_double($this->HroEmployeeAdministration_model->getCoreOvertimeType(),'overtime_type_id','overtime_type_name');

			$data['main_view']['payrollovertimerequest']	= $this->HroEmployeeAdministration_model->getPayrollOvertimeRequest($employee_id);			

			$data['main_view']['coreannualleave']			= create_double($this->HroEmployeeAdministration_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			$data['main_view']['payrollleaverequest']		= $this->HroEmployeeAdministration_model->getPayrollLeaveRequest($employee_id);

			$data['main_view']['content']					= 'HroEmployeeAdministration/FormAddHroEmployeeAdministration_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeLate(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'late_id' 							=> $this->input->post('late_id',true),
				'employee_late_date'				=> tgltodb($this->input->post('employee_late_date',true)),
				'employee_late_description'			=> $this->input->post('employee_late_description',true),
				'employee_late_duration'			=> $this->input->post('employee_late_duration',true),
				'employee_late_remark' 				=> $this->input->post('employee_late_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_late_date', 'Date', 'required');
			$this->form_validation->set_rules('late_id', 'Late', 'required');
			$this->form_validation->set_rules('employee_late_description', 'Late Description', 'required');
			$this->form_validation->set_rules('employee_late_duration', 'Late Duration', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministration_model->insertHROEmployeeLate($data)){
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HroEmployeeAdministration.processAddHROEmployeeLate',$auth['user_id'],'Add New Employee Late');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Late Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeelate-'.$unique['unique']);	
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Late UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('AddHroEmployeeAdministration',$data);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeLate(){
			$employee_id = $this->uri->segment(3);
			$employee_late_id = $this->uri->segment(4);

			if($this->HroEmployeeAdministration_model->deleteHROEmployeeLate($employee_late_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.deleteHROEmployeeLate',$auth['user_id'],'Delete Employee Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Late Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Late UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
			}
		}

		public function processAddHROEmployeePermit(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$permit_id 			= $this->input->post('permit_id',true);

			$permit_type 		= $this->HroEmployeeAdministration_model->getPermitType($permit_id);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'permit_id' 						=> $permit_id,
				'permit_type' 						=> $permit_type,
				'employee_permit_date'				=> tgltodb($this->input->post('employee_permit_date',true)),
				'employee_permit_description'		=> $this->input->post('employee_permit_description',true),
				'employee_permit_start_date'		=> tgltodb($this->input->post('employee_permit_start_date',true)),
				'employee_permit_end_date'			=> tgltodb($this->input->post('employee_permit_end_date',true)),
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
				if($this->HroEmployeeAdministration_model->insertHROEmployeePermit($data)){
					$employee_permit_id = $this->HroEmployeeAdministration_model->getEmployeePermitID($data['created_id']);

					$employee_permit_detail_date = $data['employee_permit_start_date'];

					date_default_timezone_set('UTC');

					while (strtotime($employee_permit_detail_date) <= strtotime($data['employee_permit_end_date'])) {
						$day_name = date("D", strtotime($employee_permit_detail_date));

						$dayoff_date = $this->HroEmployeeAdministration_model->getDayOffDate($employee_permit_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_employeepermitdetail = array (
						    	'employee_permit_id'				=> $employee_permit_id,
						    	'employee_id'						=> $data['employee_id'],
						    	'employee_permit_detail_date'		=> $employee_permit_detail_date,
						    );

						    $this->HroEmployeeAdministration_model->insertHROEmployeePermit_Detail($data_employeepermitdetail);
						} 

						$employee_permit_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_permit_detail_date)));
					} 

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HroEmployeeAdministration.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Permit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeepermit-'.$unique['unique']);	
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Permit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeePermit(){
			$employee_id 		= $this->uri->segment(3);
			$employee_permit_id = $this->uri->segment(4);

			if($this->HroEmployeeAdministration_model->deleteHROEmployeePermit($employee_permit_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.deleteHROEmployeePermit',$auth['user_id'],'Delete Employee Permit');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Permit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Permit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
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
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeabsence-'.$unique['unique']);	
			redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
		}

		public function processAddHROEmployeeAbsence(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'absence_id' 						=> $this->input->post('absence_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_start_date'		=> tgltodb($this->input->post('employee_absence_start_date',true)),
				'employee_absence_end_date'			=> tgltodb($this->input->post('employee_absence_end_date',true)),
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
				if($this->HroEmployeeAdministration_model->insertHROEmployeeAbsence($data)){
					$employee_absence_id = $this->HroEmployeeAdministration_model->getEmployeeAbsenceID($data['created_id']);

					$employee_absence_detail_date = $data['employee_absence_start_date'];

					date_default_timezone_set('UTC');

					while (strtotime($employee_absence_detail_date) <= strtotime($data['employee_absence_end_date'])) {
						

						$day_name = date("D", strtotime($employee_absence_detail_date));

						$dayoff_date = $this->HroEmployeeAdministration_model->getDayOffDate($employee_absence_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_employeeabsencedetail = array (
						    	'employee_absence_id'				=> $employee_absence_id,
						    	'employee_id'						=> $data['employee_id'],
						    	'employee_absence_detail_date'		=> $employee_absence_detail_date,
						    );

						    $this->HroEmployeeAdministration_model->insertHROEmployeeAbsence_Detail($data_employeeabsencedetail);
						} 

						$employee_absence_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_absence_detail_date)));
					} 

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HroEmployeeAdministration.processAddHROEmployeeAbsence',$auth['user_id'],'Add New Employee Absence');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Absence Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeabsence-'.$unique['unique']);	
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Absence UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeeabsence',$data);
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeeabsence',$data);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeAbsence(){
			$employee_id 			= $this->uri->segment(3);
			$employee_absence_id 	= $this->uri->segment(4);

			if($this->HroEmployeeAdministration_model->deleteHROEmployeeAbsence($employee_absence_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
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
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollovertimerequest-'.$unique['unique']);	
			redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
		}

		public function processAddPayrollOvertimeRequest(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'overtime_type_id' 					=> $this->input->post('overtime_type_id',true),
				'overtime_request_description'		=> $this->input->post('overtime_request_description',true),
				'overtime_request_date'				=> tgltodb($this->input->post('overtime_request_date',true)),
				'overtime_request_duration' 		=> $this->input->post('overtime_request_duration',true),
				'overtime_request_remark'			=> $this->input->post('overtime_request_remark',true),
				'overtime_request_approved' 		=> 0,
				'overtime_request_approved_id'		=> $auth['user_id'],
				'overtime_request_approved_on'		=> date("Y-m-d H:i:s"),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_request_description', 'Overtime Description', 'required');
			$this->form_validation->set_rules('overtime_type_id', 'Overtime Type', 'required');
			$this->form_validation->set_rules('overtime_request_duration', 'Overtime Duration', 'required');
			$this->form_validation->set_rules('overtime_request_date', 'Overtime Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministration_model->insertPayrollOvertimeRequest($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HroEmployeeAdministration.processAddPayrollOvertimeRequest',$auth['user_id'],'Add New Overtime Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Overtime Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollovertimerequest-'.$unique['unique']);	
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollovertimerequest',$data);
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollovertimerequest',$data);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
			}
		}

		public function deletePayrollOvertimeRequest(){
			$employee_id 			= $this->uri->segment(3);
			$overtime_request_id 	= $this->uri->segment(4);

			if($this->HroEmployeeAdministration_model->deletePayrollOvertimeRequest($overtime_request_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
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
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollleaverequest-'.$unique['unique']);	
			redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$employee_id);
		}

		public function processAddPayrollLeaveRequest(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_id' 					=> $this->input->post('annual_leave_id',true),
				'leave_request_description'			=> $this->input->post('leave_request_description',true),
				'leave_request_date'				=> tgltodb($this->input->post('leave_request_date',true)),
				'leave_request_start_date'			=> tgltodb($this->input->post('leave_request_start_date',true)),
				'leave_request_end_date'			=> tgltodb($this->input->post('leave_request_end_date',true)),
				'leave_request_duration' 			=> $this->input->post('leave_request_duration',true),
				'leave_request_reason'				=> $this->input->post('leave_request_reason',true),
				'leave_request_approved'			=> 1,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_request_description', 'Leave Description', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_duration', 'Leave Duration', 'required');
			$this->form_validation->set_rules('leave_request_date', 'Leave Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAdministration_model->insertPayrollLeaveRequest($data)){
					$leave_request_id = $this->HroEmployeeAdministration_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->HroEmployeeAdministration_model->getDayOffDate($leave_request_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_leaverequestdetail = array (
						    	'leave_request_id'				=> $leave_request_id,
						    	'employee_id'					=> $data['employee_id'],
						    	'leave_request_detail_date'		=> $leave_request_detail_date,
						    );

						    $this->HroEmployeeAdministration_model->insertPayrollLeaveRequest_Detail($data_leaverequestdetail);
						} 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollleaverequest-'.$unique['unique']);	
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('HroEmployeeAdministration/addHroEmployeeAdministration/'.$data['employee_id']);
			}
		}
		


		
		
		public function Edit(){
			$data['main_view']['result']		= $this->HroEmployeeAdministration_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'HroEmployeeAdministration/editHroEmployeeAdministration_view';
			$data['main_view']['employee']		= create_double($this->HroEmployeeAdministration_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['late']			= create_double($this->HroEmployeeAdministration_model->getlate(),'late_id','late_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditHroEmployeeAdministration(){
			
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
				if($this->HroEmployeeAdministration_model->saveEditHroEmployeeAdministration($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HroEmployeeAdministration.Edit',$auth['username'],'Edit Employee Late');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_late_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Late Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAdministration/Edit/'.$data['employee_late_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Late UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAdministration/Edit/'.$data['employee_late_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAdministration/Edit/'.$data['employee_late_id']);
			}
		}


		
	}
?>