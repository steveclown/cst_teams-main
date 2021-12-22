<?php
	Class PayrollPeriodData extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('PayrollPeriodData_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');

			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperioddata-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodpayment-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodallowance-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperioddeduction-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodattendance-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodbpjs-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodhomeearly-'.$unique['unique']);	

			$data['Main_view']['payrollperiod']		= $this->PayrollPeriodData_model->getPayrollPeriod();

			$data['Main_view']['content']			= 'PayrollPeriodData/ListPayrollPeriodData_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperioddata-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollperioddata-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperioddata-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperioddata-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperioddata-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodpayment-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodallowance-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperioddeduction-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodattendance-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodbpjs-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollperiodhomeearly-'.$unique['unique']);	
			redirect('PayrollPeriodData');
		}
		
		public function addPayrollPeriodData(){
			$data['Main_view']['corejobtitle']						= create_double($this->PayrollPeriodData_model->getCoreJobTitle(), 'job_title_id', 'job_title_name');

			$data['Main_view']['coreallowance']						= create_double($this->PayrollPeriodData_model->getCoreAllowance(), 'allowance_id', 'allowance_name');

			$data['Main_view']['corededuction']						= create_double($this->PayrollPeriodData_model->getCoreDeduction(), 'deduction_id','deduction_name');

			$data['Main_view']['corepremiattendance']				= create_double($this->PayrollPeriodData_model->getCorePremiAttendance(), 'premi_attendance_id','premi_attendance_name');

			$data['Main_view']['bpjsstatus']						= $this->configuration->BPJSStatus();

			$data['Main_view']['employeeemploymentstatus']			= $this->configuration->EmployeeStatus();

			$data['Main_view']['monthlist']							= $this->configuration->Month();

			$data['Main_view']['employeeattendanceincentivestatus']	= $this->configuration->EmployeeAttendanceIncentiveStatus();

			$data['Main_view']['content']							= 'PayrollPeriodData/FormAddPayrollPeriodData_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add_payment(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperiodpayment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperiodpayment-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_payment(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperiodpayment-'.$unique['unique']);	
			redirect('PayrollPeriodData/addPayrollPeriodData/'.$employee_id);
		}

		public function processAddArrayPayrollPeriodPayment(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodpayment = array(
				'record_id'							=> date("YmdHis"),
				'period_payment_working_start'		=> $this->input->post('period_payment_working_start', true),
				'period_payment_working_end'		=> $this->input->post('period_payment_working_end', true),
				'basic_salary_monthly'				=> $this->input->post('basic_salary_monthly', true),
				'basic_salary_daily'				=> $this->input->post('basic_salary_daily', true),
				'basic_overtime'					=> $this->input->post('basic_overtime', true),
				'meal_subvention_monthly'			=> $this->input->post('meal_subvention_monthly', true),
				'meal_subvention_daily'				=> $this->input->post('meal_subvention_daily', true),	
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),	
			);

			$this->form_validation->set_rules('period_payment_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_payment_working_end', 'Working End', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollperiodpayment-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodpayment['record_id']] = $data_payrollperiodpayment;
				
				$this->session->set_userdata('addarraypayrollperiodpayment-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addpayrollperiodpayment-'.$unique['unique']);
				
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function deleteArrayPayrollPeriodPayment(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollperiodpayment-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollperiodpayment-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/addPayrollPeriodData');
		}


		public function function_elements_add_allowance(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperiodallowance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperiodallowance-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_allowance(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperiodallowance-'.$unique['unique']);	
			redirect('PayrollPeriodData/addPayrollPeriodData/'.$employee_id);
		}

		public function processAddArrayPayrollPeriodAllowance(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodallowance = array(
				'record_id'							=> date("YmdHis"),
				'allowance_id' 						=> $this->input->post('allowance_id', true),
				'period_allowance_working_start'	=> $this->input->post('period_allowance_working_start', true),
				'period_allowance_working_end'		=> $this->input->post('period_allowance_working_end', true),
				'period_allowance_amount_monthly'	=> $this->input->post('period_allowance_amount_monthly', true),
				'period_allowance_amount_daily'		=> $this->input->post('period_allowance_amount_daily', true),
				'period_allowance_description'		=> $this->input->post('period_allowance_description', true),
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),
			);

			$this->form_validation->set_rules('period_allowance_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_allowance_working_end', 'Working End', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allowance Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollperiodallowance-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodallowance['record_id']] = $data_payrollperiodallowance;
				
				$this->session->set_userdata('addarraypayrollperiodallowance-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addpayrollperiodallowance-'.$unique['unique']);
				
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function deleteArrayPayrollPeriodAllowance(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollperiodallowance-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollperiodallowance-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/addPayrollPeriodData');
		}

		public function function_elements_add_deduction(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperioddeduction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperioddeduction-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_deduction(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperioddeduction-'.$unique['unique']);	
			redirect('PayrollPeriodData/addPayrollPeriodData/'.$employee_id);
		}

		public function processAddArrayPayrollPeriodDeduction(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperioddeduction = array(
				'deduction_id' 						=> $this->input->post('deduction_id', true),
				'period_deduction_working_start'	=> $this->input->post('period_deduction_working_start', true),
				'period_deduction_working_end'		=> $this->input->post('period_deduction_working_end', true),
				'period_deduction_amount_monthly'	=> $this->input->post('period_deduction_amount_monthly', true),
				'period_deduction_amount_daily'		=> $this->input->post('period_deduction_amount_daily', true),
				'period_deduction_description'		=> $this->input->post('period_deduction_description', true),
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),
			);

			$this->form_validation->set_rules('period_deduction_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_deduction_working_end', 'Working End', 'required');
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollperioddeduction-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperioddeduction['deduction_id']] = $data_payrollperioddeduction;
				
				$this->session->set_userdata('addarraypayrollperioddeduction-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addpayrollperioddeduction-'.$unique['unique']);
				
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function deleteArrayPayrollPeriodDeduction(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollperioddeduction-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollperioddeduction-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/addPayrollPeriodData');
		}



		public function function_elements_add_attendance(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperiodattendance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperiodattendance-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_attendance(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperiodattendance-'.$unique['unique']);	
			redirect('PayrollPeriodData/addPayrollPeriodData/'.$employee_id);
		}

		public function processAddArrayPayrollPeriodAttendance(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodattendance = array(
				'record_id'							=> date("YmdHis"),
				'premi_attendance_id' 				=> $this->input->post('premi_attendance_id', true),
				'period_attendance_working_start'	=> $this->input->post('period_attendance_working_start', true),
				'period_attendance_working_end'		=> $this->input->post('period_attendance_working_end', true),
				'period_attendance_amount_monthly'	=> $this->input->post('period_attendance_amount_monthly', true),
				'period_attendance_amount_daily'	=> $this->input->post('period_attendance_amount_daily', true),
				'period_attendance_description'		=> $this->input->post('period_attendance_description', true),
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),
			);

			$this->form_validation->set_rules('period_attendance_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_attendance_working_end', 'Working End', 'required');
			$this->form_validation->set_rules('premi_attendance_id', 'Attendance Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollperiodattendance-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodattendance['record_id']] = $data_payrollperiodattendance;
				
				$this->session->set_userdata('addarraypayrollperiodattendance-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addpayrollperiodattendance-'.$unique['unique']);
				
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function deleteArrayPayrollPeriodAttendance(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollperiodattendance-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollperiodattendance-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/addPayrollPeriodData');
		}



		public function function_elements_add_bpjs(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperiodbpjs-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperiodbpjs-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_bpjs(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperiodbpjs-'.$unique['unique']);	
			redirect('PayrollPeriodData/addPayrollPeriodData/'.$employee_id);
		}

		public function processAddArrayPayrollPeriodBPJS(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodbpjs = array(
				'record_id'								=> date("YmdHis"),
				'period_bpjs_working_start'				=> $this->input->post('period_bpjs_working_start', true),
				'period_bpjs_working_end'				=> $this->input->post('period_bpjs_working_end', true),
				'period_bpjs_kesehatan_amount'			=> $this->input->post('period_bpjs_kesehatan_amount', true),
				'period_bpjs_tenagakerja_amount'		=> $this->input->post('period_bpjs_tenagakerja_amount', true),
				'bpjs_tenagakerja_subvention_monthly'	=> $this->input->post('bpjs_tenagakerja_subvention_monthly', true),
				'bpjs_tenagakerja_subvention_daily'		=> $this->input->post('bpjs_tenagakerja_subvention_daily', true),
				'employee_employment_status'			=> $this->input->post('employee_employment_status', true),
			);

			$this->form_validation->set_rules('period_bpjs_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_bpjs_working_end', 'Working End', 'required');

			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollperiodbpjs-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodbpjs['record_id']] = $data_payrollperiodbpjs;
				
				$this->session->set_userdata('addarraypayrollperiodbpjs-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addpayrollperiodbpjs-'.$unique['unique']);
				
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function deleteArrayPayrollPeriodBPJS(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollperiodbpjs-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollperiodbpjs-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/addPayrollPeriodData');
		}

		public function function_elements_add_home_early(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollperiodhomeearly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollperiodhomeearly-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_home_early(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollperiodhomeearly-'.$unique['unique']);	
			redirect('PayrollPeriodData/addPayrollPeriodData/'.$employee_id);
		}

		public function processAddArrayPayrollPeriodHomeEarly(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodhomeearly = array(
				'record_id'								=> date("YmdHis"),
				'period_home_early_hour_start'			=> $this->input->post('period_home_early_hour_start', true),
				'period_home_early_hour_end'			=> $this->input->post('period_home_early_hour_end', true),
				'employee_attendance_incentive_status'	=> $this->input->post('employee_attendance_incentive_status', true),	
				'employee_employment_status'			=> $this->input->post('employee_employment_status', true),	
			);

			$this->form_validation->set_rules('period_home_early_hour_start', 'Hour Start', 'required');
			$this->form_validation->set_rules('period_home_early_hour_end', 'Hour End', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollperiodhomeearly-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodhomeearly['record_id']] = $data_payrollperiodhomeearly;
				
				$this->session->set_userdata('addarraypayrollperiodhomeearly-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addpayrollperiodhomeearly-'.$unique['unique']);
				
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function deleteArrayPayrollPeriodHomeEarly(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollperiodhomeearly-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollperiodhomeearly-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/addPayrollPeriodData');
		}

		public function processAddPayrollPeriodData(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$payroll_period						= $this->input->post('payroll_period', true);

			$session_payrollperiodpayment 		= $this->session->userdata('addarraypayrollperiodpayment-'.$unique['unique']);

			$session_payrollperiodallowance 	= $this->session->userdata('addarraypayrollperiodallowance-'.$unique['unique']);

			$session_payrollperioddeduction		= $this->session->userdata('addarraypayrollperioddeduction-'.$unique['unique']);

			$session_payrollperiodattendance 	= $this->session->userdata('addarraypayrollperiodattendance-'.$unique['unique']);

			$session_payrollperiodbpjs 			= $this->session->userdata('addarraypayrollperiodbpjs-'.$unique['unique']);

			$session_payrollperiodhomeearly		= $this->session->userdata('addarraypayrollperiodhomeearly-'.$unique['unique']);

			$data = array (
				'payroll_period'		=> $payroll_period,
				'data_state'			=> 0,
				'created_id'			=> $auth['user_id'],
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			if ($this->PayrollPeriodData_model->getPayrollPeriod_Period($data['payroll_period'])){
				if ($this->PayrollPeriodData_model->insertPayrollPeriod($data)){
					$payroll_period_id = $this->PayrollPeriodData_model->getPayrollPeriodID($data['created_id']);

					if(!empty($session_payrollperiodpayment)){
						foreach($session_payrollperiodpayment as $key => $val){
							$data_payrollperiodpayment = array(
								'payroll_period_id'					=> $payroll_period_id,
								'job_title_id' 						=> $val['job_title_id'],
								'period_payment_period' 			=> $payroll_period,
								'period_payment_working_start'		=> $val['period_payment_working_start'],
								'period_payment_working_end'		=> $val['period_payment_working_end'],
								'basic_salary_monthly'				=> $val['basic_salary_monthly'],
								'basic_salary_daily'				=> $val['basic_salary_daily'],
								'meal_subvention_monthly'			=> $val['meal_subvention_monthly'],
								'meal_subvention_daily'				=> $val['meal_subvention_daily'],
								'basic_overtime'					=> $val['basic_overtime'],
								'employee_employment_status'		=> $val['employee_employment_status'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->PayrollPeriodData_model->insertPayrollPeriodPayment($data_payrollperiodpayment);
						}
					}


					if(!empty($session_payrollperiodallowance)){
						foreach($session_payrollperiodallowance as $key => $val){
							$data_payrollperiodallowance = array(
								'payroll_period_id'					=> $payroll_period_id,
								'period_allowance_period' 			=> $payroll_period,
								'allowance_id' 						=> $val['allowance_id'],
								'period_allowance_working_start'	=> $val['period_allowance_working_start'],
								'period_allowance_working_end'		=> $val['period_allowance_working_end'],
								'period_allowance_amount_monthly'	=> $val['period_allowance_amount_monthly'],
								'period_allowance_amount_daily'		=> $val['period_allowance_amount_daily'],
								'period_allowance_description'		=> $val['period_allowance_description'],
								'employee_employment_status'		=> $val['employee_employment_status'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->PayrollPeriodData_model->insertPayrollPeriodAllowance($data_payrollperiodallowance);
						}
					}


					if(!empty($session_payrollperioddeduction)){
						foreach($session_payrollperioddeduction as $key => $val){
							$data_payrollperioddeduction = array(
								'payroll_period_id'					=> $payroll_period_id,
								'period_deduction_period' 			=> $payroll_period,
								'deduction_id' 						=> $val['deduction_id'],
								'period_deduction_working_start'	=> $val['period_deduction_working_start'],
								'period_deduction_working_end'		=> $val['period_deduction_working_end'],
								'period_deduction_amount_monthly'	=> $val['period_deduction_amount_monthly'],
								'period_deduction_amount_daily'		=> $val['period_deduction_amount_daily'],
								'period_deduction_description'		=> $val['period_deduction_description'],
								'employee_employment_status'		=> $val['employee_employment_status'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->PayrollPeriodData_model->insertPayrollPeriodDeduction($data_payrollperioddeduction);
						}
					}


					if(!empty($session_payrollperiodattendance)){
						foreach($session_payrollperiodattendance as $key => $val){
							$data_payrollperiodattendance = array(
								'payroll_period_id'					=> $payroll_period_id,
								'period_attendance_period' 			=> $payroll_period,
								'premi_attendance_id'				=> $val['premi_attendance_id'],
								'period_attendance_working_start'	=> $val['period_attendance_working_start'],
								'period_attendance_working_end'		=> $val['period_attendance_working_end'],
								'period_attendance_amount_monthly'	=> $val['period_attendance_amount_monthly'],
								'period_attendance_amount_daily'	=> $val['period_attendance_amount_daily'],
								'period_attendance_description'		=> $val['period_attendance_description'],
								'employee_employment_status'		=> $val['employee_employment_status'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->PayrollPeriodData_model->insertPayrollPeriodAttendance($data_payrollperiodattendance);
						}
					}


					if(!empty($session_payrollperiodbpjs)){
						foreach($session_payrollperiodbpjs as $key => $val){
							$data_payrollperiodbpjs = array(
								'payroll_period_id'						=> $payroll_period_id,
								'period_bpjs_period' 					=> $payroll_period,
								'period_bpjs_working_start'				=> $val['period_bpjs_working_start'],
								'period_bpjs_working_end'				=> $val['period_bpjs_working_end'],
								'period_bpjs_kesehatan_amount'			=> $val['period_bpjs_kesehatan_amount'],
								'period_bpjs_tenagakerja_amount'		=> $val['period_bpjs_tenagakerja_amount'],
								'bpjs_tenagakerja_subvention_monthly'	=> $val['bpjs_tenagakerja_subvention_monthly'],
								'bpjs_tenagakerja_subvention_daily'		=> $val['bpjs_tenagakerja_subvention_daily'],
								'employee_employment_status'			=> $val['employee_employment_status'],
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s"),
							);

							$this->PayrollPeriodData_model->insertPayrollPeriodBPJS($data_payrollperiodbpjs);
						}
					}

					if(!empty($session_payrollperiodhomeearly)){
						foreach($session_payrollperiodhomeearly as $key => $val){
							$data_payrollperiodhomeearly = array(
								'payroll_period_id'						=> $payroll_period_id,
								'period_home_early_period' 				=> $payroll_period,
								'period_home_early_hour_start'			=> $val['period_home_early_hour_start'],
								'period_home_early_hour_end'			=> $val['period_home_early_hour_end'],
								'employee_attendance_incentive_status'	=> $val['employee_attendance_incentive_status'],
								'employee_employment_status'			=> $val['employee_employment_status'],
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s"),
							);

							$this->PayrollPeriodData_model->insertPayrollPeriodHomeEarly($data_payrollperiodhomeearly);
						}
					}

					
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollPeriodPayment.processAddPayrollPeriodPayment',$auth['user_id'],'Add New Employee Payment');
					$msg = "<div class='alert alert-success'>                
								Add Payroll Period Data Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollperioddata-'.$unique['unique']);	
					$this->session->unset_userdata('addarraypayrollperiodpayment-'.$unique['unique']);	
					$this->session->unset_userdata('addarraypayrollperiodallowance-'.$unique['unique']);	
					$this->session->unset_userdata('addarraypayrollperioddeduction-'.$unique['unique']);	
					$this->session->unset_userdata('addarraypayrollperiodattendance-'.$unique['unique']);	
					$this->session->unset_userdata('addarraypayrollperiodbpjs-'.$unique['unique']);	
					$this->session->unset_userdata('addarraypayrollperiodhomeearly-'.$unique['unique']);	

					redirect('PayrollPeriodData/addPayrollPeriodData');
				} else {
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollPeriodPayment.processAddPayrollPeriodPayment',$auth['user_id'],'Add New Employee Payment');
					$msg = "<div class='alert alert-success'>                
								Add Payroll Period Data Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('PayrollPeriodData/addPayrollPeriodData');
				}	
			} else {
				$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollPeriodPayment.processAddPayrollPeriodPayment',$auth['user_id'],'Add New Employee Payment');
				$msg = "<div class='alert alert-success'>                
							Payroll Period Already Exist
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('PayrollPeriodData/addPayrollPeriodData');
			}
		}

		public function showdetail(){
			$payroll_period_id = $this->uri->segment(3);

			$data['Main_view']['payrollperiodpayment']		= $this->PayrollPeriodData_model->getPayrollPeriodPayment_Detail($payroll_period_id);

			$data['Main_view']['payrollperiodattendance']	= $this->PayrollPeriodData_model->getPayrollPeriodAttendance_Detail($payroll_period_id);

			$data['Main_view']['payrollperiodallowance']	= $this->PayrollPeriodData_model->getPayrollPeriodAllowance_Detail($payroll_period_id);

			$data['Main_view']['payrollperioddeduction']	= $this->PayrollPeriodData_model->getPayrollPeriodDeduction_Detail($payroll_period_id);

			$data['Main_view']['payrollperiodbpjs']			= $this->PayrollPeriodData_model->getPayrollPeriodBPJS_Detail($payroll_period_id);

			$data['Main_view']['payrollperiodhomeearly']	= $this->PayrollPeriodData_model->getPayrollPeriodHomeEarly_Detail($payroll_period_id);

			$data['Main_view']['bpjsstatus']						= $this->configuration->BPJSStatus();

			$data['Main_view']['employeeemploymentstatus']			= $this->configuration->EmployeeStatus();

			$data['Main_view']['monthlist']							= $this->configuration->Month();

			$data['Main_view']['employeeattendanceincentivestatus']	= $this->configuration->EmployeeAttendanceIncentiveStatus();

			$data['Main_view']['content']					= 'PayrollPeriodData/formdetailpayrollperioddata_view';
			$this->load->view('MainPage_view',$data);
		}



		public function function_state_edit(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperioddata-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('editpayrollperioddata-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperioddata-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperioddata-'.$unique['unique'],$sessions);
		}

		public function reset_edit(){
			$payroll_period_id 	= $this->uri->segment(3);
			$unique 			= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperioddata-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodpayment-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodpaymentfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodallowance-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodallowancefirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperioddeduction-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperioddeductionfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodattendance-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodattendancefirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodbpjs-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodbpjsfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodhomeearly-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodhomeearlyfirst-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}
		
		public function editPayrollPeriodData(){
			$payroll_period_id 										= $this->uri->segment(3);
			$unique 												= $this->session->userdata('unique');

			$data['Main_view']['coreallowance']						= create_double($this->PayrollPeriodData_model->getCoreAllowance(), 'allowance_id', 'allowance_name');

			$data['Main_view']['corededuction']						= create_double($this->PayrollPeriodData_model->getCoreDeduction(), 'deduction_id','deduction_name');

			$data['Main_view']['corepremiattendance']				= create_double($this->PayrollPeriodData_model->getCorePremiAttendance(), 'premi_attendance_id','premi_attendance_name');

			$data['Main_view']['payrollperiod']						= $this->PayrollPeriodData_model->getPayrollPeriod_Detail($payroll_period_id);

			$data['Main_view']['bpjsstatus']						= $this->configuration->BPJSStatus();

			$data['Main_view']['employeeemploymentstatus']			= $this->configuration->EmployeeStatus();

			$data['Main_view']['monthlist']							= $this->configuration->Month();

			$data['Main_view']['employeeattendanceincentivestatus']	= $this->configuration->EmployeeAttendanceIncentiveStatus();

			$edit_payment			= $this->session->userdata('editarraypayrollperiodpaymentfirst-'.$unique['unique']);

			if (empty($edit_payment)){
				$payrollperiodpayment = $this->PayrollPeriodData_model->getPayrollPeriodPayment_Detail($payroll_period_id);

				foreach ($payrollperiodpayment  as $key => $val) {
					$data_payrollperiodpayment = array (
						'record_id'						=> $val['period_payment_id'],
						'payroll_period_id'				=> $val['payroll_period_id'],
						'period_payment_period'			=> $val['period_payment_period'],
						'period_payment_working_start'	=> $val['period_payment_working_start'],
						'period_payment_working_end'	=> $val['period_payment_working_end'],
						'basic_salary_monthly'			=> $val['basic_salary_monthly'],
						'basic_salary_daily'			=> $val['basic_salary_daily'],
						'basic_overtime'				=> $val['basic_overtime'],
						'meal_subvention_monthly'		=> $val['meal_subvention_monthly'],
						'meal_subvention_daily'			=> $val['meal_subvention_daily'],
						'employee_employment_status'	=> $val['employee_employment_status'],
						'item_status'					=> 9
					);

					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodpayment-'.$unique['unique']);

					$dataArrayHeader[$data_payrollperiodpayment['record_id']] = $data_payrollperiodpayment;
					
					$this->session->set_userdata('editarraypayrollperiodpayment-'.$unique['unique'],$dataArrayHeader);
					$this->session->set_userdata('editarraypayrollperiodpaymentfirst-'.$unique['unique'],$dataArrayHeader);
				}
			}

			$edit_allowance			= $this->session->userdata('editarraypayrollperiodallowancefirst-'.$unique['unique']);

			if (empty($edit_allowance)){
				$payrollperiodallowance = $this->PayrollPeriodData_model->getPayrollPeriodAllowance_Detail($payroll_period_id);

				foreach ($payrollperiodallowance  as $key => $val) {
					$data_payrollperiodallowance = array (
						'record_id'							=> $val['period_allowance_id'],
						'payroll_period_id'					=> $val['payroll_period_id'],
						'allowance_id'						=> $val['allowance_id'],
						'period_allowance_period'			=> $val['period_allowance_period'],
						'period_allowance_working_start'	=> $val['period_allowance_working_start'],
						'period_allowance_working_end'		=> $val['period_allowance_working_end'],
						'period_allowance_description'		=> $val['period_allowance_description'],
						'period_allowance_amount_daily'		=> $val['period_allowance_amount_daily'],
						'period_allowance_amount_monthly'	=> $val['period_allowance_amount_monthly'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'item_status'						=> 9
					);

					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodallowance-'.$unique['unique']);

					$dataArrayHeader[$data_payrollperiodallowance['record_id']] = $data_payrollperiodallowance;
					
					$this->session->set_userdata('editarraypayrollperiodallowance-'.$unique['unique'],$dataArrayHeader);
					$this->session->set_userdata('editarraypayrollperiodallowancefirst-'.$unique['unique'],$dataArrayHeader);
				}
			}

			$edit_deduction			= $this->session->userdata('editarraypayrollperioddeductionfirst-'.$unique['unique']);

			if (empty($edit_deduction)){
				$payrollperioddeduction = $this->PayrollPeriodData_model->getPayrollPeriodDeduction_Detail($payroll_period_id);

				foreach ($payrollperioddeduction  as $key => $val) {
					$data_payrollperioddeduction = array (
						'record_id'							=> $val['period_deduction_id'],
						'payroll_period_id'					=> $val['payroll_period_id'],
						'deduction_id'						=> $val['deduction_id'],
						'period_deduction_period'			=> $val['period_deduction_period'],
						'period_deduction_working_start'	=> $val['period_deduction_working_start'],
						'period_deduction_working_end'		=> $val['period_deduction_working_end'],
						'period_deduction_description'		=> $val['period_deduction_description'],
						'period_deduction_amount_daily'		=> $val['period_deduction_amount_daily'],
						'period_deduction_amount_monthly'	=> $val['period_deduction_amount_monthly'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'item_status'						=> 9
					);

					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarraypayrollperioddeduction-'.$unique['unique']);

					$dataArrayHeader[$data_payrollperioddeduction['record_id']] = $data_payrollperioddeduction;
					
					$this->session->set_userdata('editarraypayrollperioddeduction-'.$unique['unique'],$dataArrayHeader);
					$this->session->set_userdata('editarraypayrollperioddeductionfirst-'.$unique['unique'],$dataArrayHeader);
				}
			}

			$edit_attendance			= $this->session->userdata('editarraypayrollperiodattendancefirst-'.$unique['unique']);

			if (empty($edit_attendance)){
				$payrollperiodattendance = $this->PayrollPeriodData_model->getPayrollPeriodAttendance_Detail($payroll_period_id);

				foreach ($payrollperiodattendance  as $key => $val) {
					$data_payrollperiodattendance = array (
						'record_id'							=> $val['period_attendance_id'],
						'payroll_period_id'					=> $val['payroll_period_id'],
						'premi_attendance_id'				=> $val['premi_attendance_id'],
						'period_attendance_period'			=> $val['period_attendance_period'],
						'period_attendance_working_start'	=> $val['period_attendance_working_start'],
						'period_attendance_working_end'		=> $val['period_attendance_working_end'],
						'period_attendance_description'		=> $val['period_attendance_description'],
						'period_attendance_amount_daily'	=> $val['period_attendance_amount_daily'],
						'period_attendance_amount_monthly'	=> $val['period_attendance_amount_monthly'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'item_status'						=> 9
					);

					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodattendance-'.$unique['unique']);

					$dataArrayHeader[$data_payrollperiodattendance['record_id']] = $data_payrollperiodattendance;
					
					$this->session->set_userdata('editarraypayrollperiodattendance-'.$unique['unique'],$dataArrayHeader);
					$this->session->set_userdata('editarraypayrollperiodattendancefirst-'.$unique['unique'],$dataArrayHeader);
				}
			}

			$edit_bpjs			= $this->session->userdata('editarraypayrollperiodbpjsfirst-'.$unique['unique']);

			if (empty($edit_bpjs)){
				$payrollperiodbpjs = $this->PayrollPeriodData_model->getPayrollPeriodBPJS_Detail($payroll_period_id);

				foreach ($payrollperiodbpjs  as $key => $val) {
					$data_payrollperiodbpjs = array (
						'record_id'								=> $val['period_bpjs_id'],
						'payroll_period_id'						=> $val['payroll_period_id'],
						'period_bpjs_period'					=> $val['period_bpjs_period'],
						'period_bpjs_working_start'				=> $val['period_bpjs_working_start'],
						'period_bpjs_working_end'				=> $val['period_bpjs_working_end'],
						'period_bpjs_kesehatan_amount'			=> $val['period_bpjs_kesehatan_amount'],
						'period_bpjs_tenagakerja_amount'		=> $val['period_bpjs_tenagakerja_amount'],
						'bpjs_tenagakerja_subvention_monthly'	=> $val['bpjs_tenagakerja_subvention_monthly'],
						'bpjs_tenagakerja_subvention_daily'		=> $val['bpjs_tenagakerja_subvention_daily'],
						'employee_employment_status'			=> $val['employee_employment_status'],
						
						'item_status'							=> 9
					);

					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodbpjs-'.$unique['unique']);

					$dataArrayHeader[$data_payrollperiodbpjs['record_id']] = $data_payrollperiodbpjs;
					
					$this->session->set_userdata('editarraypayrollperiodbpjs-'.$unique['unique'],$dataArrayHeader);
					$this->session->set_userdata('editarraypayrollperiodbpjsfirst-'.$unique['unique'],$dataArrayHeader);
				}
			}

			$edit_home_early			= $this->session->userdata('editarraypayrollperiodhomeearlyfirst-'.$unique['unique']);

			if (empty($edit_home_early)){
				$payrollperiodhomeearly = $this->PayrollPeriodData_model->getPayrollPeriodHomeEarly_Detail($payroll_period_id);

				foreach ($payrollperiodhomeearly  as $key => $val) {
					$data_payrollperiodhomeearly = array (
						'record_id'									=> $val['period_home_early_id'],
						'payroll_period_id'							=> $val['payroll_period_id'],
						'period_home_early_period'					=> $val['period_home_early_period'],
						'period_home_early_hour_start'				=> $val['period_home_early_hour_start'],
						'period_home_early_hour_end'				=> $val['period_home_early_hour_end'],
						'employee_attendance_incentive_status'		=> $val['employee_attendance_incentive_status'],
						'employee_employment_status'				=> $val['employee_employment_status'],
						'item_status'								=> 9
					);

					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodhomeearly-'.$unique['unique']);

					$dataArrayHeader[$data_payrollperiodhomeearly['record_id']] = $data_payrollperiodhomeearly;
					
					$this->session->set_userdata('editarraypayrollperiodhomeearly-'.$unique['unique'],$dataArrayHeader);
					$this->session->set_userdata('editarraypayrollperiodhomeearlyfirst-'.$unique['unique'],$dataArrayHeader);
				}
			}

			$data['Main_view']['content']					= 'PayrollPeriodData/formeditpayrollperioddata_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_edit_payment(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperiodpayment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperiodpayment-'.$unique['unique'],$sessions);
		}
		
		public function reset_edit_payment(){
			$payroll_period_id 	= $this->uri->segment(3);	
			$unique 			= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperiodpayment-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}

		public function processEditArrayPayrollPeriodPayment(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodpayment = array(
				'record_id'							=> date("YmdHis"),
				'period_payment_working_start'		=> $this->input->post('period_payment_working_start', true),
				'period_payment_working_end'		=> $this->input->post('period_payment_working_end', true),
				'basic_salary_monthly'				=> $this->input->post('basic_salary_monthly', true),
				'basic_salary_daily'				=> $this->input->post('basic_salary_daily', true),
				'basic_overtime'					=> $this->input->post('basic_overtime', true),
				'meal_subvention_monthly'			=> $this->input->post('meal_subvention_monthly', true),
				'meal_subvention_daily'				=> $this->input->post('meal_subvention_daily', true),	
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),	
				'item_status'						=> 1,	
			);

			$this->form_validation->set_rules('period_payment_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_payment_working_end', 'Working End', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodpayment-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodpayment['record_id']] = $data_payrollperiodpayment;
				
				$this->session->set_userdata('editarraypayrollperiodpayment-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('editpayrollperiodpayment-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
			}
		}

		public function deleteEditArrayPayrollPeriodPayment(){
			$arrayBaru				= array();
			$record_id				= $this->uri->segment(3);
			$payroll_period_id		= $this->uri->segment(4);
			$session_name			= "editarraypayrollperiodpayment-";
			$unique 				= $this->session->userdata('unique');
			$dataArrayHeader		= $this->session->userdata($session_name.$unique['unique']);
			$unique 				= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key => $val){
				if($key == $record_id){
					$arrayBaru[$key] 				= $val;
					$arrayBaru[$key]['item_status'] = 2;
				} else {
					$arrayBaru[$key] 				= $val;
				}
			}
			
			$this->session->set_userdata('editarraypayrollperiodpayment-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}

		public function function_elements_edit_allowance(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperiodallowance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperiodallowance-'.$unique['unique'],$sessions);
		}
		
		public function reset_edit_allowance(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperiodallowance-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$employee_id);
		}

		public function processEditArrayPayrollPeriodAllowance(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodallowance = array(
				'record_id'							=> date("YmdHis"),
				'allowance_id' 						=> $this->input->post('allowance_id', true),
				'period_allowance_working_start'	=> $this->input->post('period_allowance_working_start', true),
				'period_allowance_working_end'		=> $this->input->post('period_allowance_working_end', true),
				'period_allowance_amount_monthly'	=> $this->input->post('period_allowance_amount_monthly', true),
				'period_allowance_amount_daily'		=> $this->input->post('period_allowance_amount_daily', true),
				'period_allowance_description'		=> $this->input->post('period_allowance_description', true),
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),
				'item_status'						=> 1,
			);

			$this->form_validation->set_rules('period_allowance_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_allowance_working_end', 'Working End', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allowance Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodallowance-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodallowance['record_id']] = $data_payrollperiodallowance;
				
				$this->session->set_userdata('editarraypayrollperiodallowance-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('editpayrollperiodallowance-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
			}
		}

		public function deleteEditArrayPayrollPeriodAllowance(){
			$arrayBaru				= array();
			$record_id				= $this->uri->segment(3);
			$payroll_period_id		= $this->uri->segment(4);
			$session_name			= "editarraypayrollperiodallowance-";
			$unique 				= $this->session->userdata('unique');
			$dataArrayHeader		= $this->session->userdata($session_name.$unique['unique']);
			$unique 				= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key => $val){
				if($key == $record_id){
					$arrayBaru[$key] 				= $val;
					$arrayBaru[$key]['item_status'] = 2;
				} else {
					$arrayBaru[$key] 				= $val;
				}
			}
			
			$this->session->set_userdata('editarraypayrollperiodallowance-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}

		public function function_elements_edit_deduction(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperioddeduction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperioddeduction-'.$unique['unique'],$sessions);
		}
		
		public function reset_edit_deduction(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperioddeduction-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$employee_id);
		}

		public function processEditArrayPayrollPeriodDeduction(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperioddeduction = array(
				'deduction_id' 						=> $this->input->post('deduction_id', true),
				'period_deduction_working_start'	=> $this->input->post('period_deduction_working_start', true),
				'period_deduction_working_end'		=> $this->input->post('period_deduction_working_end', true),
				'period_deduction_amount_monthly'	=> $this->input->post('period_deduction_amount_monthly', true),
				'period_deduction_amount_daily'		=> $this->input->post('period_deduction_amount_daily', true),
				'period_deduction_description'		=> $this->input->post('period_deduction_description', true),
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),
				'item_status'						=> 1,
			);

			$this->form_validation->set_rules('period_deduction_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_deduction_working_end', 'Working End', 'required');
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarraypayrollperioddeduction-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperioddeduction['deduction_id']] = $data_payrollperioddeduction;
				
				$this->session->set_userdata('editarraypayrollperioddeduction-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('editpayrollperioddeduction-'.$unique['unique']);

			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);

			}
		}

		public function deleteEditArrayPayrollPeriodDeduction(){
			$arrayBaru				= array();
			$record_id				= $this->uri->segment(3);
			$payroll_period_id		= $this->uri->segment(4);
			$session_name			= "editarraypayrollperioddeduction-";
			$unique 				= $this->session->userdata('unique');
			$dataArrayHeader		= $this->session->userdata($session_name.$unique['unique']);
			$unique 				= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key => $val){
				if($key == $record_id){
					$arrayBaru[$key] 				= $val;
					$arrayBaru[$key]['item_status'] = 2;
				} else {
					$arrayBaru[$key] 				= $val;
				}
			}
			
			$this->session->set_userdata('editarraypayrollperioddeduction-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}



		public function function_elements_edit_attendance(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperiodattendance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperiodattendance-'.$unique['unique'],$sessions);
		}
		
		public function reset_edit_attendance(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperiodattendance-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$employee_id);
		}

		public function processEditArrayPayrollPeriodAttendance(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodattendance = array(
				'record_id'							=> date("YmdHis"),
				'premi_attendance_id' 				=> $this->input->post('premi_attendance_id', true),
				'period_attendance_working_start'	=> $this->input->post('period_attendance_working_start', true),
				'period_attendance_working_end'		=> $this->input->post('period_attendance_working_end', true),
				'period_attendance_amount_monthly'	=> $this->input->post('period_attendance_amount_monthly', true),
				'period_attendance_amount_daily'	=> $this->input->post('period_attendance_amount_daily', true),
				'period_attendance_description'		=> $this->input->post('period_attendance_description', true),
				'employee_employment_status'		=> $this->input->post('employee_employment_status', true),
				'item_status'						=> 1,
			);

			$this->form_validation->set_rules('period_attendance_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_attendance_working_end', 'Working End', 'required');
			$this->form_validation->set_rules('premi_attendance_id', 'Attendance Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodattendance-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodattendance['record_id']] = $data_payrollperiodattendance;
				
				$this->session->set_userdata('editarraypayrollperiodattendance-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('editpayrollperiodattendance-'.$unique['unique']);

			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
			}
		}

		public function deleteEditArrayPayrollPeriodAttendance(){
			$arrayBaru				= array();
			$record_id				= $this->uri->segment(3);
			$payroll_period_id		= $this->uri->segment(4);
			$session_name			= "editarraypayrollperiodattendance-";
			$unique 				= $this->session->userdata('unique');
			$dataArrayHeader		= $this->session->userdata($session_name.$unique['unique']);
			$unique 				= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key => $val){
				if($key == $record_id){
					$arrayBaru[$key] 				= $val;
					$arrayBaru[$key]['item_status'] = 2;
				} else {
					$arrayBaru[$key] 				= $val;
				}
			}
			
			$this->session->set_userdata('editarraypayrollperiodattendance-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}



		public function function_elements_edit_bpjs(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperiodbpjs-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperiodbpjs-'.$unique['unique'],$sessions);
		}
		
		public function reset_edit_bpjs(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperiodbpjs-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$employee_id);
		}

		public function processEditArrayPayrollPeriodBPJS(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodbpjs = array(
				'record_id'								=> date("YmdHis"),
				'period_bpjs_working_start'				=> $this->input->post('period_bpjs_working_start', true),
				'period_bpjs_working_end'				=> $this->input->post('period_bpjs_working_end', true),
				'period_bpjs_kesehatan_amount'			=> $this->input->post('period_bpjs_kesehatan_amount', true),
				'period_bpjs_tenagakerja_amount'		=> $this->input->post('period_bpjs_tenagakerja_amount', true),
				'bpjs_tenagakerja_subvention_monthly'	=> $this->input->post('bpjs_tenagakerja_subvention_monthly', true),
				'bpjs_tenagakerja_subvention_daily'		=> $this->input->post('bpjs_tenagakerja_subvention_daily', true),
				'employee_employment_status'			=> $this->input->post('employee_employment_status', true),
				'item_status'							=> 1,	
			);

			$this->form_validation->set_rules('period_bpjs_working_start', 'Working Start', 'required');
			$this->form_validation->set_rules('period_bpjs_working_end', 'Working End', 'required');

			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodbpjs-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodbpjs['record_id']] = $data_payrollperiodbpjs;
				
				$this->session->set_userdata('editarraypayrollperiodbpjs-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('editpayrollperiodbpjs-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
			}
		}

		public function deleteEditArrayPayrollPeriodBPJS(){
			$arrayBaru				= array();
			$record_id				= $this->uri->segment(3);
			$payroll_period_id		= $this->uri->segment(4);
			$session_name			= "editarraypayrollperiodbpjs-";
			$unique 				= $this->session->userdata('unique');
			$dataArrayHeader		= $this->session->userdata($session_name.$unique['unique']);
			$unique 				= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key => $val){
				if($key == $record_id){
					$arrayBaru[$key] 				= $val;
					$arrayBaru[$key]['item_status'] = 2;
				} else {
					$arrayBaru[$key] 				= $val;
				}
			}
			
			$this->session->set_userdata('editarraypayrollperiodbpjs-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}

		public function function_elements_edit_home_early(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editpayrollperiodhomeearly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editpayrollperiodhomeearly-'.$unique['unique'],$sessions);
		}
		
		public function reset_edit_home_early(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editpayrollperiodhomeearly-'.$unique['unique']);	
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$employee_id);
		}

		public function processEditArrayPayrollPeriodHomeEarly(){
			$auth 			= $this->session->userdata('auth');

			$data_payrollperiodhomeearly = array(
				'record_id'								=> date("YmdHis"),
				'period_home_early_hour_start'			=> $this->input->post('period_home_early_hour_start', true),
				'period_home_early_hour_end'			=> $this->input->post('period_home_early_hour_end', true),
				'employee_attendance_incentive_status'	=> $this->input->post('employee_attendance_incentive_status', true),
				'employee_employment_status'			=> $this->input->post('employee_employment_status', true),	
				'item_status'							=> 1,	
			);

			$this->form_validation->set_rules('period_home_early_hour_start', 'Hour Start', 'required');
			$this->form_validation->set_rules('period_home_early_hour_end', 'Hour End', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarraypayrollperiodhomeearly-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollperiodhomeearly['record_id']] = $data_payrollperiodhomeearly;
				
				$this->session->set_userdata('editarraypayrollperiodhomeearly-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('editpayrollperiodhomeearly-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
			}
		}

		public function deleteEditArrayPayrollPeriodHomeEarly(){
			$arrayBaru				= array();
			$record_id				= $this->uri->segment(3);
			$payroll_period_id		= $this->uri->segment(4);
			$session_name			= "editarraypayrollperiodhomeearly-";
			$unique 				= $this->session->userdata('unique');
			$dataArrayHeader		= $this->session->userdata($session_name.$unique['unique']);
			$unique 				= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key => $val){
				if($key == $record_id){
					$arrayBaru[$key] 				= $val;
					$arrayBaru[$key]['item_status'] = 2;
				} else {
					$arrayBaru[$key] 				= $val;
				}
			}
			
			$this->session->set_userdata('editarraypayrollperiodhomeearly-'.$unique['unique'],$arrayBaru);
			
			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}

		public function processEditPayrollPeriodData(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$payroll_period						= $this->input->post('payroll_period', true);

			$payroll_period_id					= $this->input->post('payroll_period_id', true);

			$session_payrollperiodpayment 		= $this->session->userdata('editarraypayrollperiodpayment-'.$unique['unique']);

			$session_payrollperiodallowance 	= $this->session->userdata('editarraypayrollperiodallowance-'.$unique['unique']);

			$session_payrollperioddeduction		= $this->session->userdata('editarraypayrollperioddeduction-'.$unique['unique']);

			$session_payrollperiodattendance 	= $this->session->userdata('editarraypayrollperiodattendance-'.$unique['unique']);

			$session_payrollperiodbpjs 			= $this->session->userdata('editarraypayrollperiodbpjs-'.$unique['unique']);

			$session_payrollperiodhomeearly		= $this->session->userdata('editarraypayrollperiodhomeearly-'.$unique['unique']);

			

			if(!empty($session_payrollperiodpayment)){
				foreach($session_payrollperiodpayment as $key => $val){
					$data_payrollperiodpayment = array(
						'payroll_period_id'					=> $payroll_period_id,
						'job_title_id' 						=> $val['job_title_id'],
						'period_payment_period' 			=> $payroll_period,
						'period_payment_working_start'		=> $val['period_payment_working_start'],
						'period_payment_working_end'		=> $val['period_payment_working_end'],
						'basic_salary_monthly'				=> $val['basic_salary_monthly'],
						'basic_salary_daily'				=> $val['basic_salary_daily'],
						'meal_subvention_monthly'			=> $val['meal_subvention_monthly'],
						'meal_subvention_daily'				=> $val['meal_subvention_daily'],
						'basic_overtime'					=> $val['basic_overtime'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'data_state'						=> 0,
						'created_id'						=> $auth['user_id'],
						'created_on'						=> date("Y-m-d H:i:s"),
					);

					if ($val['item_status'] == 1){
						$this->PayrollPeriodData_model->insertPayrollPeriodPayment($data_payrollperiodpayment);
					} else if ($val['item_status'] == 2){
						$data_delete = array (
							'period_payment_id'			=> $val['record_id'],
							'data_state'				=> 2
						);

						$this->PayrollPeriodData_model->deletePayrollPeriodPayment($data_delete);
					}
				}
			}


			if(!empty($session_payrollperiodallowance)){
				foreach($session_payrollperiodallowance as $key => $val){
					$data_payrollperiodallowance = array(
						'payroll_period_id'					=> $payroll_period_id,
						'period_allowance_period' 			=> $payroll_period,
						'allowance_id' 						=> $val['allowance_id'],
						'period_allowance_working_start'	=> $val['period_allowance_working_start'],
						'period_allowance_working_end'		=> $val['period_allowance_working_end'],
						'period_allowance_amount_monthly'	=> $val['period_allowance_amount_monthly'],
						'period_allowance_amount_daily'		=> $val['period_allowance_amount_daily'],
						'period_allowance_description'		=> $val['period_allowance_description'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'data_state'						=> 0,
						'created_id'						=> $auth['user_id'],
						'created_on'						=> date("Y-m-d H:i:s"),
					);

					

					if ($val['item_status'] == 1){
						$this->PayrollPeriodData_model->insertPayrollPeriodAllowance($data_payrollperiodallowance);
					} else if ($val['item_status'] == 2){
						$data_delete = array (
							'period_allowance_id'		=> $val['record_id'],
							'data_state'				=> 2
						);

						$this->PayrollPeriodData_model->deletePayrollPeriodAllowance($data_delete);
					}
				}
			}


			if(!empty($session_payrollperioddeduction)){
				foreach($session_payrollperioddeduction as $key => $val){
					$data_payrollperioddeduction = array(
						'payroll_period_id'					=> $payroll_period_id,
						'period_deduction_period' 			=> $payroll_period,
						'deduction_id' 						=> $val['deduction_id'],
						'period_deduction_working_start'	=> $val['period_deduction_working_start'],
						'period_deduction_working_end'		=> $val['period_deduction_working_end'],
						'period_deduction_amount_monthly'	=> $val['period_deduction_amount_monthly'],
						'period_deduction_amount_daily'		=> $val['period_deduction_amount_daily'],
						'period_deduction_description'		=> $val['period_deduction_description'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'data_state'						=> 0,
						'created_id'						=> $auth['user_id'],
						'created_on'						=> date("Y-m-d H:i:s"),
					);

					if ($val['item_status'] == 1){
						$this->PayrollPeriodData_model->insertPayrollPeriodDeduction($data_payrollperioddeduction);
					} else if ($val['item_status'] == 2){
						$data_delete = array (
							'period_deduction_id'		=> $val['record_id'],
							'data_state'				=> 2
						);

						$this->PayrollPeriodData_model->deletePayrollPeriodDeduction($data_delete);
					}
				}
			}


			if(!empty($session_payrollperiodattendance)){
				foreach($session_payrollperiodattendance as $key => $val){
					$data_payrollperiodattendance = array(
						'payroll_period_id'					=> $payroll_period_id,
						'period_attendance_period' 			=> $payroll_period,
						'premi_attendance_id'				=> $val['premi_attendance_id'],
						'period_attendance_working_start'	=> $val['period_attendance_working_start'],
						'period_attendance_working_end'		=> $val['period_attendance_working_end'],
						'period_attendance_amount_monthly'	=> $val['period_attendance_amount_monthly'],
						'period_attendance_amount_daily'	=> $val['period_attendance_amount_daily'],
						'period_attendance_description'		=> $val['period_attendance_description'],
						'employee_employment_status'		=> $val['employee_employment_status'],
						'data_state'						=> 0,
						'created_id'						=> $auth['user_id'],
						'created_on'						=> date("Y-m-d H:i:s"),
					);

					if ($val['item_status'] == 1){
						$this->PayrollPeriodData_model->insertPayrollPeriodAttendance($data_payrollperiodattendance);
					} else if ($val['item_status'] == 2){
						$data_delete = array (
							'period_attendance_id'		=> $val['record_id'],
							'data_state'				=> 2
						);

						$this->PayrollPeriodData_model->deletePayrollPeriodAttendance($data_delete);
					}
				}
			}


			if(!empty($session_payrollperiodbpjs)){
				foreach($session_payrollperiodbpjs as $key => $val){
					$data_payrollperiodbpjs = array(
						'payroll_period_id'						=> $payroll_period_id,
						'period_bpjs_period' 					=> $payroll_period,
						'period_bpjs_working_start'				=> $val['period_bpjs_working_start'],
						'period_bpjs_working_end'				=> $val['period_bpjs_working_end'],
						'period_bpjs_kesehatan_amount'			=> $val['period_bpjs_kesehatan_amount'],
						'period_bpjs_tenagakerja_amount'		=> $val['period_bpjs_tenagakerja_amount'],
						'bpjs_tenagakerja_subvention_monthly'	=> $val['bpjs_tenagakerja_subvention_monthly'],
						'bpjs_tenagakerja_subvention_daily'		=> $val['bpjs_tenagakerja_subvention_daily'],
						'employee_employment_status'			=> $val['employee_employment_status'],
						'data_state'							=> 0,
						'created_id'							=> $auth['user_id'],
						'created_on'							=> date("Y-m-d H:i:s"),
					);

					if ($val['item_status'] == 1){
						$this->PayrollPeriodData_model->insertPayrollPeriodBPJS($data_payrollperiodbpjs);
					} else if ($val['item_status'] == 2){
						$data_delete = array (
							'period_bpjs_id'		=> $val['record_id'],
							'data_state'			=> 2
						);

						$this->PayrollPeriodData_model->deletePayrollPeriodBPJS($data_delete);
					}
				}
			}

			if(!empty($session_payrollperiodhomeearly)){
				foreach($session_payrollperiodhomeearly as $key => $val){
					$data_payrollperiodhomeearly = array(
						'payroll_period_id'						=> $payroll_period_id,
						'period_home_early_period' 				=> $payroll_period,
						'period_home_early_hour_start'			=> $val['period_home_early_hour_start'],
						'period_home_early_hour_end'			=> $val['period_home_early_hour_end'],
						'employee_attendance_incentive_status'	=> $val['employee_attendance_incentive_status'],
						'employee_employment_status'			=> $val['employee_employment_status'],
						'data_state'							=> 0,
						'created_id'							=> $auth['user_id'],
						'created_on'							=> date("Y-m-d H:i:s"),
					);

					$this->PayrollPeriodData_model->insertPayrollPeriodHomeEarly($data_payrollperiodhomeearly);

					if ($val['item_status'] == 1){
						$this->PayrollPeriodData_model->insertPayrollPeriodHomeEarly($data_payrollperiodhomeearly);
					} else if ($val['item_status'] == 2){
						$data_delete = array (
							'period_home_early_id'		=> $val['record_id'],
							'data_state'				=> 2
						);

						$this->PayrollPeriodData_model->deletePayrollPeriodHomeEarly($data_delete);
					}
				}
			}

			
			$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollPeriodPayment.processAddPayrollPeriodPayment',$auth['user_id'],'Add New Employee Payment');
			$msg = "<div class='alert alert-success'>                
						Edit Payroll Period Data Successfully
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message',$msg);
			$this->session->unset_userdata('editpayrollperioddata-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodpayment-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodpaymentfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodallowance-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodallowancefirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperioddeduction-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperioddeductionfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodattendance-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodattendancefirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodbpjs-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodbpjsfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodhomeearly-'.$unique['unique']);	
			$this->session->unset_userdata('editarraypayrollperiodhomeearlyfirst-'.$unique['unique']);	

			redirect('PayrollPeriodData/editPayrollPeriodData/'.$payroll_period_id);
		}
	}
?>