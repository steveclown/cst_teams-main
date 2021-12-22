<?php
	class payrollemployeepayment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeepayment_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollemployeepayment');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeepayment_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeepayment_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeepayment_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeepayment_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_payment']	= $this->payrollemployeepayment_model->getHROEmployeeData_Payment($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeepayment/listpayrollemployeepayment_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeepayment',$data);
			redirect('payrollemployeepayment');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepayment-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeepayment-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepayment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeepayment-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeepayment');
			$this->session->unset_userdata('filter-payrollemployeepayment');
			redirect('payrollemployeepayment');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeepayment-'.$sesi['unique']);	
			redirect('payrollemployeepayment');
		}
		
		function addPayrollEmployeePayment(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeepayment_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeepayment_data']	= $this->payrollemployeepayment_model->getPayrollEmployeePayment_Data($employee_id);
			$data['main_view']['corebank']						= create_double($this->payrollemployeepayment_model->getCoreBank(),'bank_id','bank_name');
			$data['main_view']['homeearlystatus']				= $this->configuration->HomeEarlyStatus;
			$data['main_view']['content']						= 'payrollemployeepayment/listaddpayrollemployeepayment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollEmployeePayment(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'bank_id' 							=> $this->input->post('bank_id',true),
				'employee_payment_period'			=> $this->input->post('employee_payment_period',true),
				'payment_basic_salary'				=> $this->input->post('payment_basic_salary',true),
				'payment_basic_overtime'			=> $this->input->post('payment_basic_overtime',true),
				'payment_bank_acct_name'			=> $this->input->post('payment_bank_acct_name',true),				
				'payment_bank_acct_no'				=> $this->input->post('payment_bank_acct_no',true),
				'payment_home_early_status'			=> $this->input->post('payment_home_early_status',true),
				'payment_home_early_amount'			=> $this->input->post('payment_home_early_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('bank_id', 'Bank', 'required');
			$this->form_validation->set_rules('employee_payment_period', 'Period', 'required');
			$this->form_validation->set_rules('payment_basic_salary', 'Basic Salary', 'required');
			$this->form_validation->set_rules('payment_basic_overtime', 'Basic Overtime', 'required');
			$this->form_validation->set_rules('payment_bank_acct_no', 'Bank Acct No', 'required');
			$this->form_validation->set_rules('payment_bank_acct_name', 'Bank Acct Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollemployeepayment_model->checkPaymentBankAcctNo($data['payment_bank_acct_no']) == 0){
					if($this->payrollemployeepayment_model->saveNewPayrollEmployeePayment($data)){
						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeePayment.processAddPayrollEmployeePayment',$auth['user_id'],'Add New Employee Payment');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Payment Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('Addpayrollemployeepayment');
						redirect('payrollemployeepayment/addPayrollEmployeePayment/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Employee Payment UnSuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('Addpayrollemployeepayment',$data);
						redirect('payrollemployeepayment/addPayrollEmployeePayment/'.$data['employee_id']);
					}
				}else{
					$this->session->set_userdata('Addpayrollemployeepayment',$data);
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Bank Account No is available before
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeepayment/addPayrollEmployeePayment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeepayment',$data);
				redirect('payrollemployeepayment/addPayrollEmployeePayment/'.$data['employee_id']);
			}
		}

		function deletePayrollEmployeePayment(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeepayment_model->deletePayrollEmployeePayment($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeePayment.delete',$auth['user_id'],'Delete Employee Payment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Payment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepayment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Payment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepayment');
			}
		}

		function deletePayrollEmployeePayment_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_payment_id = $this->uri->segment(4);

			if($this->payrollemployeepayment_model->deletePayrollEmployeePayment_Data($employee_payment_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeePayment_Data.delete',$auth['user_id'],'Delete Employee Payment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Payment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepayment/addPayrollEmployeePayment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Payment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepayment/addPayrollEmployeePayment/'.$employee_id);
			}
		}
	}
?>