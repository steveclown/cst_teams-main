<?php
	Class payrollemployeedata extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeedata_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];
			$branch_status 				= $auth['branch_status'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeedata');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}

			$systemuserbranch								= $this->payrollemployeedata_model->getSystemUserBranch($user_id);

			$data['main_view']['coredivision']				= create_double($this->payrollemployeedata_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['corebranch']				= create_double($this->payrollemployeedata_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['hroemployeedata_daily']		= $this->payrollemployeedata_model->getHROEmployeeData_Daily($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			/*$data['main_view']['hroemployeedatailufa']	= $this->hroemployeedatailufa_model->getHROEmployeeData($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'], $sesi['section_id']);
*/
			$data['main_view']['content']					= 'payrollemployeedata/listpayrollemployeedata_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeedata', $data);
			redirect('payrollemployeedata');
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->payrollemployeedata_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->payrollemployeedata_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeedata');
			$this->session->unset_userdata('filter-payrollemployeedata');
			redirect('payrollemployeedata');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeedata-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeedata-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeedata-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeedata-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeedata-'.$unique['unique']);	
			redirect('payrollemployeedata');
		}
		
		public function addPayrollEmployeeData(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollemployeedata_model->getHROEmployeeData_Detail($employee_id);

			$data['main_view']['corebank']							= create_double($this->payrollemployeedata_model->getCoreBank(),'bank_id','bank_name');

			$data['main_view']['coreallowance']						= create_double($this->payrollemployeedata_model->getCoreAllowance(),'allowance_id', 'allowance_name');

			$data['main_view']['corededuction']						= create_double($this->payrollemployeedata_model->getCoreDeduction(),'deduction_id','deduction_name');

			$data['main_view']['corepremiattendance']				= create_double($this->payrollemployeedata_model->getCorePremiAttendance(),'premi_attendance_id','premi_attendance_name');

			$data['main_view']['bpjsstatus']						= $this->configuration->BPJSStatus;

			$data['main_view']['coreloantype']						= create_double($this->payrollemployeedata_model->getCoreLoanType(),'loan_type_id','loan_type_name');

			$data['main_view']['monthlist']							= $this->configuration->Month;

			$data['main_view']['payrollemployeepayment']			= $this->payrollemployeedata_model->getPayrollEmployeePayment_Detail($employee_id);

			$data['main_view']['payrollemployeeallowance']			= $this->payrollemployeedata_model->getPayrollEmployeeAllowance_Detail($employee_id);

			$data['main_view']['payrollemployeededuction']			= $this->payrollemployeedata_model->getPayrollEmployeeDeduction_Detail($employee_id);

			$data['main_view']['payrollemployeepremiattendance']	= $this->payrollemployeedata_model->getPayrollEmployeePremiAttendance_Detail($employee_id);

			$data['main_view']['payrollemployeebpjs']				= $this->payrollemployeedata_model->getPayrollEmployeeBPJS_Detail($employee_id);

			$data['main_view']['payrollemployeeloan']				= $this->payrollemployeedata_model->getPayrollEmployeeLoan_Detail($employee_id);

			$data['main_view']['content']							= 'payrollemployeedata/formaddpayrollemployeedata_view';
			$this->load->view('mainpage_view',$data);
		}


		public function function_elements_add_payment(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepayment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeepayment-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_payment(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeepayment-'.$unique['unique']);	
			redirect('payrollemployeedata/addPayrollEmployeeData/'.$employee_id);
		}

		public function processAddPayrollEmployeePayment(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'bank_id' 							=> $this->input->post('bank_id',true),
				'employee_payment_period'			=> $this->input->post('employee_payment_period',true),
				'payment_basic_salary'				=> $this->input->post('payment_basic_salary',true),
				'payment_basic_overtime'			=> $this->input->post('payment_basic_overtime',true),
				'payment_bank_acct_name'			=> $this->input->post('payment_bank_acct_name',true),				
				'payment_bank_acct_no'				=> $this->input->post('payment_bank_acct_no',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('bank_id', 'Bank', 'required');
			$this->form_validation->set_rules('employee_payment_period', 'Period', 'required');
			$this->form_validation->set_rules('payment_basic_salary', 'Basic Salary', 'required');
			$this->form_validation->set_rules('payment_basic_overtime', 'Basic Overtime', 'required');
			$this->form_validation->set_rules('payment_bank_acct_no', 'Bank Acct No', 'required');
			$this->form_validation->set_rules('payment_bank_acct_name', 'Bank Acct Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollemployeedata_model->checkPaymentBankAcctNo($data['payment_bank_acct_no'])){
					if($this->payrollemployeedata_model->insertPayrollEmployeePayment($data)){
						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeePayment.processAddPayrollEmployeePayment',$auth['user_id'],'Add New Employee Payment');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Payment Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addpayrollemployeepayment-'.$unique['unique']);	
						redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Employee Payment Fail
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('Addpayrollemployeepayment',$data);
						redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
					}
				}else{
					$this->session->set_userdata('Addpayrollemployeepayment',$data);
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Bank Account No Already Exist
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeepayment',$data);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeePayment(){
			$employee_id 			= $this->uri->segment(3);
			$employee_payment_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'			=> $employee_id,
				'employee_payment_id'	=> $employee_payment_id,
				'data_state'			=> 1
			);

			if($this->payrollemployeedata_model->deletePayrollEmployeePayment($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeePayment_Data.delete',$auth['user_id'],'Delete Employee Payment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Payment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Payment Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}


		public function function_elements_add_allowance(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeallowance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeallowance-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_allowance(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeallowance-'.$unique['unique']);	
			redirect('payrollemployeedata/addPayrollEmployeeData/'.$employee_id);
		}

		public function processAddPayrollEmployeeAllowance(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');
			
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'allowance_id' 						=> $this->input->post('allowance_id',true),
				'employee_allowance_period'			=> $this->input->post('employee_allowance_period',true),
				'employee_allowance_description'	=> $this->input->post('employee_allowance_description',true),
				'employee_allowance_amount'			=> $this->input->post('employee_allowance_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allowance', 'required');
			$this->form_validation->set_rules('employee_allowance_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_allowance_amount', 'Allowance Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeedata_model->insertPayrollEmployeeAllowance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeAllowance.processAddPayrollEmployeeAllowance',$auth['user_id'],'Add New Employee Allowance');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeeallowance-'.$unique['unique']);	
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Allowance Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeeallowance',$data);
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeeallowance',$data);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeAllowance(){
			$employee_id 			= $this->uri->segment(3);
			$employee_allowance_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'				=> $employee_id,
				'employee_allowance_id'		=> $employee_allowance_id,
				'data_state'				=> 1
			);

			if($this->payrollemployeedata_model->deletePayrollEmployeeAllowance($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeAllowance_Data.delete',$auth['user_id'],'Delete Employee Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}


		public function function_elements_add_deduction(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeededuction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeededuction-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_deduction(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeededuction-'.$unique['unique']);	
			redirect('payrollemployeedata/addPayrollEmployeeData/'.$employee_id);
		}

		public function processAddPayrollEmployeeDeduction(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'deduction_id' 						=> $this->input->post('deduction_id',true),
				'employee_deduction_period'			=> $this->input->post('employee_deduction_period',true),
				'employee_deduction_description'	=> $this->input->post('employee_deduction_description',true),
				'employee_deduction_amount'			=> $this->input->post('employee_deduction_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('deduction_id', 'Deduction', 'required');
			$this->form_validation->set_rules('employee_deduction_period', 'Period', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeedata_model->insertPayrollEmployeeDeduction($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDeduction.processAddPayrollEmployeeDeduction',$auth['user_id'],'Add New Employee Deduction');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Deduction Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeededuction-'.$unique['unique']);	
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Deduction Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeededuction',$data);
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeededuction',$data);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeDeduction(){
			$employee_id 			= $this->uri->segment(3);
			$employee_deduction_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'				=> $employee_id,
				'employee_deduction_id'		=> $employee_deduction_id,
				'data_state'				=> 1
			);

			if($this->payrollemployeedata_model->deletePayrollEmployeeDeduction($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeduction_Data.delete',$auth['user_id'],'Delete Employee Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Deduction Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}


		public function function_elements_add_premi(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepremi-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeepremi-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_premi(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeepremi-'.$unique['unique']);	
			redirect('payrollemployeedata/addPayrollEmployeeData/'.$employee_id);
		}

		public function processAddPayrollEmployeePremiAttendance(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'premi_attendance_id' 					=> $this->input->post('premi_attendance_id',true),
				'employee_premi_attendance_period'		=> $this->input->post('employee_premi_attendance_period',true),
				'employee_premi_attendance_description'	=> $this->input->post('employee_premi_attendance_description',true),
				'employee_premi_attendance_amount'		=> $this->input->post('employee_premi_attendance_amount',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('premi_attendance_id', 'Premi Attendance Name', 'required');
			$this->form_validation->set_rules('employee_premi_attendance_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_premi_attendance_description', 'Premi Attendance Description', 'required');
			$this->form_validation->set_rules('employee_premi_attendance_amount', 'Premi Attendance Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeedata_model->insertPayrollEmployeePremiAttendance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeePremiAttendance.processAddPayrollEmployeePremiAttendance',$auth['user_id'],'Add New Employee Premi Attendance');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Premi Attendance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeepremi-'.$unique['unique']);	
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Premi Attendance Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeepremiattendance',$data);
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeepremiattendance',$data);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeePremiAttendance(){
			$employee_id 					= $this->uri->segment(3);
			$employee_premi_attendance_id 	= $this->uri->segment(4);

			$data = array(
				'employee_id'					=> $employee_id,
				'employee_premi_attendance_id'	=> $employee_premi_attendance_id,
				'data_state'					=> 1
			);

			if($this->payrollemployeedata_model->deletePayrollEmployeePremiAttendance($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeePremiAttendance_Data.delete',$auth['user_id'],'Delete Employee Premi Attendance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Premi Attendance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Premi Attendance Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}


		public function function_elements_add_bpjs(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeebpjs-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeebpjs-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_bpjs(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeebpjs-'.$unique['unique']);	
			redirect('payrollemployeedata/addPayrollEmployeeData/'.$employee_id);
		}

		public function processAddPayrollEmployeeBPJS(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'bpjs_in_date' 						=> tgltodb($this->input->post('bpjs_in_date',true)),
				'bpjs_reported_salary'		 		=> $this->input->post('bpjs_reported_salary',true),
				'bpjs_total_amount' 				=> $this->input->post('bpjs_total_amount',true),
				'bpjs_kesehatan_status'			 	=> $this->input->post('bpjs_kesehatan_status',true),
				'bpjs_kesehatan_no' 				=> $this->input->post('bpjs_kesehatan_no',true),
				'bpjs_kesehatan_percentage' 		=> $this->input->post('bpjs_kesehatan_percentage',true),
				'bpjs_kesehatan_amount' 			=> $this->input->post('bpjs_kesehatan_amount',true),
				'bpjs_tenagakerja_status'			=> $this->input->post('bpjs_tenagakerja_status',true),
				'bpjs_tenagakerja_no' 				=> $this->input->post('bpjs_tenagakerja_no',true),
				'bpjs_tenagakerja_percentage' 		=> $this->input->post('bpjs_tenagakerja_percentage',true),
				'bpjs_tenagakerja_amount' 			=> $this->input->post('bpjs_tenagakerja_amount',true),
				'bpjs_remark'			 			=> $this->input->post('bpjs_remark',true),
				'bpjs_out_status'		 			=> $this->input->post('bpjs_out_status',true),
				'bpjs_out_date' 					=> tgltodb($this->input->post('bpjs_tenagakerja_amount',true)),
				'bpjs_out_id' 						=> $auth['user_id'],
				'bpjs_out_on'						=> date("Y-m-d H:i:s"),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('bpjs_reported_salary', 'Reportd Salary', 'required');
			$this->form_validation->set_rules('bpjs_total_amount', 'BPJS Total Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollonoutbpjs_model->insertPayrollEmployeeBPJS($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOnOutBPJS.processAddPayrollOnOutBPJS',$auth['user_id'],'Add New Payroll On Out BPJS');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Employee BPJS Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeebpjs-'.$unique['unique']);	
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Employee BPJS Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addpayrollonoutbpjs',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeBPJS(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bpjs_id 	= $this->uri->segment(4);

			$data = array(
				'employee_id'		=> $employee_id,
				'employee_bpjs_id'	=> $employee_bpjs_id,
				'data_state'		=> 1
			);

			if($this->payrollonoutbpjs_model->deletePayrollEmployeeBPJS($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.payrollonoutbpjs.deletePayrollOnOutBPJS_Data',$auth['user_id'],'Delete Payroll On Out BPJS');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee BPJS Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrolleemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee BPJS Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrolleemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}


		public function function_elements_add_loan(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeloan-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeloan-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_loan(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeloan-'.$unique['unique']);	
			redirect('payrollemployeedata/addPayrollEmployeeData/'.$employee_id);
		}

		public function processAddPayrollEmployeeLoan(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$loan_month_start 			= $this->input->post('loan_month_start',true);
			$loan_year_start 			= $this->input->post('loan_year_start',true);
			$employee_loan_amount_total = $this->input->post('employee_loan_amount_total',true);
			$employee_loan_amount 		= $this->input->post('employee_loan_amount',true);
			
			$employee_loan_start_period = $loan_year_start.$loan_month_start;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'loan_type_id' 						=> $this->input->post('loan_type_id',true),
				'employee_loan_date'				=> tgltodb($this->input->post('employee_loan_date',true)),
				'employee_loan_description'			=> $this->input->post('employee_loan_description',true),
				'employee_loan_start_period'		=> $employee_loan_start_period,
				'employee_loan_amount_total'		=> $employee_loan_amount_total,
				'employee_loan_amount'				=> $employee_loan_amount,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('loan_type_id', 'Loan Type', 'required');
			$this->form_validation->set_rules('employee_loan_date', 'Employee Loan Date', 'required');
			$this->form_validation->set_rules('employee_loan_description', 'Employee Loan Description', 'required');
			$this->form_validation->set_rules('employee_loan_amount_total', 'Employee Loan Amount Total', 'required');
			$this->form_validation->set_rules('employee_loan_amount', 'Employee Loan Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeedata_model->insertPayrollEmployeeLoan($data)){
					$auth = $this->session->userdata('auth');

					$employee_loan_id = $this->payrollemployeedata_model->getEmployeeLoanID($data['created_id']);

					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeLoan.processAddPayrollEmployeeLoan',$employee_loan_id,'Add New Employee Loan');

					$mod 			= $employee_loan_amount_total % $employee_loan_amount;
					$count 			= floor($employee_loan_amount_total / $employee_loan_amount);
					$startmonthstr 	= $loan_month_start;
					$startmonth 	= (int)$startmonthstr;

					$startmonth 	= $startmonth - 1;
					$startyear 		= $loan_year_start;

					for($i=1; $i<=$count; $i++){
						$data_item = array();

						$startmonth = $startmonth + 1;

						if ($startmonth == 13){
							$startmonth = 1;
							$startyear 	= $startyear + 1;
						}

						$startmonthstr 	= substr('0'.(string)$startmonth, -2, 2);
						$startyearstr 	= (string)$startyear;
						$period 		= $startyearstr.$startmonthstr;

						$data_item = array(
							'employee_loan_id'				=> $employee_loan_id,
							'employee_loan_item_period'		=> $period,
							'employee_loan_item_amount'		=> $employee_loan_amount,
							'employee_loan_item_balance'	=> $employee_loan_amount,
						);

						$this->payrollemployeedata_model->insertPayrollEmployeeLoanItem($data_item);
					}

					if ($mod == 0){
						
					}else{
						$data_item = array();
						
						$startmonth = $startmonth + 1;

						if ($startmonth == 13){
							$startmonth = 1;
							$startyear 	= $startyear + 1;
						}

						$startmonthstr 	= substr('0'.(string)$startmonth, -2, 2);
						$startyearstr 	= (string)$startyear;
						$period 		= $startyearstr.$startmonthstr;

						$data_item = array(
							'employee_loan_id'				=> $employee_loan_id,
							'employee_loan_item_period'		=> $period,
							'employee_loan_item_amount'		=> $mod,
							'employee_loan_item_balance'	=> $mod,
						);

						$this->payrollemployeeloan_model->insertPayrollEmployeeLoanItem($data_item);
					}

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeeloan-'.$unique['unique']);	
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Allowance Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpayrollemployeeloan',$data);
					redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addpayrollemployeeloan',$data);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeLoan(){
			$employee_id 		= $this->uri->segment(3);
			$employee_loan_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'		=> $employee_id, 
				'employee_loan_id'	=> $employee_loan_id,
				'data_state'		=> 1
			);

			if($this->payrollemployeedata_model->deletePayrollEmployeeLoan($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeAllowance_Data.delete',$auth['user_id'],'Delete Employee Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Loan Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Loan Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedata/addPayrollEmployeeData/'.$data['employee_id']);
			}
		}


		public function processPrinting(){
			/*$auth 						= $this->session->userdata('auth');*/

			/*print_r("salesdeliveryorder ");
			print_r($salesdeliveryorder);
			print_r("<BR> ");*/

			/*print_r("salesdeliveryorderitem ");
			print_r($salesdeliveryorderitem);
			print_r("<BR> ");*/

			require_once('TCPDF/config/tcpdf_config.php');
			require_once('TCPDF/tcpdf.php');
			// create new PDF document
			$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
			// Check the example n. 29 for viewer preferences

			// set document information
			/*$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('');
			$pdf->SetSubject('');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');*/

			// set default header data
			/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE);
			$pdf->SetSubHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);*/

			// set header and footer fonts
			/*$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));*/

			// set default monospaced font
			/*$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);*/

			// set margins
			/*$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);*/

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);

			$pdf->SetMargins(6, 6, 6, 6); // put space of 10 on top
			/*$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);*/
			/*$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);*/

			// set auto page breaks
			/*$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);*/

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', 'B', 20);

			// add a page
			

			/*$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);*/

			$pdf->SetFont('helvetica', '', 8);

			// -----------------------------------------------------------------------------
			
			$pdf->AddPage();
			$pdf->resetColumns();
			$pdf->setEqualColumns(2, 84);  // KEY PART -  number of cols and width
			$pdf->selectColumn();               
			$content =' loop content here';
			$pdf->writeHTML($content, true, false, true, false);
			$pdf->resetColumns();
			
			//Close and output PDF document
			
			$filename = 'Bukti_Serah_Terima_Barang_'.$salesreturnpickup['delivery_pickup_return_no'].'.pdf';
			$pdf->Output($filename, 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}
	}
?>