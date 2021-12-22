<?php
	Class payrollemployeeloan extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeloan_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeeloan');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeeloan_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeeloan_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeeloan_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeeloan_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_loan']		= $this->payrollemployeeloan_model->getHROEmployeeData_Loan($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeeloan/listpayrollemployeeloan_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeloan',$data);
			redirect('payrollemployeeloan');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeloan-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeeloan-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeloan-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeloan-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeeloan');
			$this->session->unset_userdata('filter-payrollemployeeloan');
			redirect('payrollemployeeloan');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeloan-'.$sesi['unique']);	
			redirect('payrollemployeeloan');
		}
		
		public function addPayrollEmployeeLoan(){
			$employee_id = $this->uri->segment(3);

			$data['main_view']['hroemployeedata']				= $this->payrollemployeeloan_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeeloan_data']		= $this->payrollemployeeloan_model->getPayrollEmployeeLoan_Data($employee_id);
			$data['main_view']['coreloantype']					= create_double($this->payrollemployeeloan_model->getCoreLoanType(),'loan_type_id','loan_type_name');
			$data['main_view']['monthlist']						= $this->configuration->Month;
			$data['main_view']['content']						= 'payrollemployeeloan/listaddpayrollemployeeloan_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeLoan(){
			$auth = $this->session->userdata('auth');

			$loan_month_start = $this->input->post('loan_month_start',true);
			$loan_year_start = $this->input->post('loan_year_start',true);
			$employee_loan_amount_total = $this->input->post('employee_loan_amount_total',true);
			$employee_loan_amount = $this->input->post('employee_loan_amount',true);
			
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

			/*print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('loan_type_id', 'Loan Type', 'required');
			$this->form_validation->set_rules('employee_loan_date', 'Employee Loan Date', 'required');
			$this->form_validation->set_rules('employee_loan_description', 'Employee Loan Description', 'required');
			$this->form_validation->set_rules('employee_loan_amount_total', 'Employee Loan Amount Total', 'required');
			$this->form_validation->set_rules('employee_loan_amount', 'Employee Loan Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeloan_model->saveNewPayrollEmployeeLoan($data)){
					$auth = $this->session->userdata('auth');
					$employee_loan_id = $this->payrollemployeeloan_model->getEmployeeLoanID($data['created_id']);

					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeLoan.processAddPayrollEmployeeLoan',$employee_loan_id,'Add New Employee Loan');

					$mod = $employee_loan_amount_total % $employee_loan_amount;
					$count = floor($employee_loan_amount_total / $employee_loan_amount);
					$startmonthstr = $loan_month_start;
					$startmonth = (int)$startmonthstr;

					/*print_r("startmonthstr ");
					print_r($startmonthstr);
					print_r("<BR>");
					print_r("startmonth ");
					print_r($startmonth);
					print_r("<BR>");*/

					$startmonth = $startmonth - 1;
					$startyear = $loan_year_start;

					for($i=1; $i<=$count; $i++){
						$data_item = array();

						/*print_r($i);*/
						$startmonth = $startmonth + 1;

						if ($startmonth == 13){
							$startmonth = 1;
							$startyear = $startyear + 1;
						}

						$startmonthstr = substr('0'.(string)$startmonth, -2, 2);
						$startyearstr = (string)$startyear;
						$period = $startyearstr.$startmonthstr;

						/*print_r(" period ");
						print_r($period);
						print_r(" ");
						print_r($employee_loan_amount);
						print_r("<BR>");*/

						$data_item = array(
							'employee_loan_id'				=> $employee_loan_id,
							'employee_loan_item_period'		=> $period,
							'employee_loan_item_amount'		=> $employee_loan_amount,
							'employee_loan_item_balance'	=> $employee_loan_amount,
						);

						$this->payrollemployeeloan_model->saveNewPayrollEmployeeLoanItem($data_item);
					}

					if ($mod == 0){
						
					}else{
						$data_item = array();
						/*print_r($i);*/
						$startmonth = $startmonth + 1;

						if ($startmonth == 13){
							$startmonth = 1;
							$startyear = $startyear + 1;
						}

						$startmonthstr = substr('0'.(string)$startmonth, -2, 2);
						$startyearstr = (string)$startyear;
						$period = $startyearstr.$startmonthstr;

						/*print_r(" period ");
						print_r($period);
						print_r(" ");
						print_r($mod);
						print_r("<BR>");*/

						$data_item = array(
							'employee_loan_id'				=> $employee_loan_id,
							'employee_loan_item_period'		=> $period,
							'employee_loan_item_amount'		=> $mod,
							'employee_loan_item_balance'	=> $mod,
						);

						$this->payrollemployeeloan_model->saveNewPayrollEmployeeLoanItem($data_item);
					}

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeeloan');
					redirect('payrollemployeeloan/addPayrollEmployeeLoan/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Allowance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpayrollemployeeloan',$data);
					redirect('payrollemployeeloan/addPayrollEmployeeLoan/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addpayrollemployeeloan',$data);
				redirect('payrollemployeeloan/addPayrollEmployeeLoan/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeAllowance(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeallowance_model->deletePayrollEmployeeAllowance($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeAllowance.delete',$auth['user_id'],'Delete Employee Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeallowance');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeallowance');
			}
		}

		public function deletePayrollEmployeeLoan_Data(){
			$employee_id 		= $this->uri->segment(3);
			$employee_loan_id 	= $this->uri->segment(4);

			if($this->payrollemployeeloan_model->deletePayrollEmployeeLoan_Data($employee_loan_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeAllowance_Data.delete',$auth['user_id'],'Delete Employee Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Loan Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloan/addPayrollEmployeeLoan/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Loan UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloan/addPayrollEmployeeLoan/'.$employee_id);
			}
		}
		
		
		
		function arrayaddpayrollemployeeloanitem(){
			$sesi 	= $this->session->userdata('unique');
			$auth		= $this->session->userdata('auth');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$sesi 	= $this->session->userdata('unique');
			
			$data_header = array(
				'employee_id'					=> $this->input->post('employee_id',true),
				'employee_code'					=> $this->input->post('employee_code', true),
				'employee_loan_description'		=> $this->input->post('employee_loan_description', true),
				'installment_payment_period'	=> $this->input->post('installment_payment_period', true),
				'installment_payment_total'		=> $this->input->post('installment_payment_total', true),
				'employee_loan_amount_total'	=> $this->input->post('employee_loan_amount_total', true),
				'employee_loan_amount'			=> $this->input->post('employee_loan_amount', true),
				'created_on'					=> $this->input->post('created_on',true),
				'data_state'					=> '0'
			);
			$this->form_validation->set_rules('employee_id', 'Employee', 'required');
			$this->form_validation->set_rules('employee_code', 'Employee Code', 'required');
			$this->form_validation->set_rules('employee_loan_description', 'Loan Description', 'required');
			$this->form_validation->set_rules('installment_payment_period', 'Installment Payment Period', 'required');
			$this->form_validation->set_rules('installment_payment_total', 'Installment Payment Total', 'required');
			$this->form_validation->set_rules('employee_loan_amount', 'Loan Amount', 'required');
			$this->form_validation->set_rules('employee_loan_amount_total', 'Loan Amount Total', 'required');
			
			$data_item = array(
				'period'		=> $this->input->post('period', true),
				'installment_payment'	=> $this->input->post('installment_payment', true),
				'employee_loan_amount'	=> $this->input->post('employee_loan_amount', true),
				'employee_loan_payment' => $this->input->post('employee_loan_payment', true),
				'employee_loan_balance'	=> $this->input->post('employee_loan_balance', true),
				'payment_date'			=> tgltodb($this->input->post('payment_date', true)),
				'created_on'			=> $data_header['created_on'],
				'data_state'			=> '0'
			);
			
			$this->form_validation->set_rules('period', 'Period', 'required');
			$this->form_validation->set_rules('installment_payment', 'Installment Payment', 'required');
			$this->form_validation->set_rules('employee_loan_amount', 'Loan Amount', 'required');
			$this->form_validation->set_rules('employee_loan_payment', 'Loan Payment', 'required');
			$this->form_validation->set_rules('employee_loan_balance', 'Loan Balance', 'required');
			$this->form_validation->set_rules('payment_date', 'Payment Date', 'required');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('payrollemployeeloan-'.$sesi['unique']);
				$this->session->set_userdata('payrollemployeeloan-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('payrollemployeeloan-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata($data_header['created_on']);
				
				$dataArray[$data_item['employee_loan_id']] = $data_item;
				$this->session->set_userdata($data_header['created_on'],$dataArray);
				$this->session->unset_userdata('item');
				redirect('payrollemployeeloan/add');
			}else{
				$this->session->set_userdata('item',$data_item);
				$this->session->set_userdata('payrollemployeeloan-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloan/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->payrollemployeeloan_model->getdetail($this->uri->segment(3));
			$data['main_view']['loan_item']	= $this->payrollemployeeloan_model->getloanitem($this->uri->segment(3));
			$data['main_view']['employee']		= create_double($this->payrollemployeeloan_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['employeecode']		= create_double($this->payrollemployeeloan_model->getemployeecode(),'employee_code','employee_code');
			$data['main_view']['content']	= 'payrollemployeeloan/listeditpayrollemployeeloan_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function arrayupdateemployeeloanitem(){
			$data_item = array(
				'period'				=> $this->input->post('period', true),
				'installment_payment'	=> $this->input->post('installment_payment', true),
				'employee_loan_amount'	=> $this->input->post('employee_loan_amount', true),
				'employee_loan_payment' => $this->input->post('employee_loan_payment', true),
				'employee_loan_balance'	=> $this->input->post('employee_loan_balance', true),
				'payment_date'			=> tgltodb($this->input->post('payment_date', true)),
				'created_on'			=> $data_header['created_on'],
				'data_state'			=> '0'
			);
			
			$this->session->set_userdata('payrollemployeeloanedit',$data_item);
			$this->form_validation->set_rules('period', 'Period', 'required');
			$this->form_validation->set_rules('installment_payment', 'Installment Payment', 'required');
			$this->form_validation->set_rules('employee_loan_amount', 'Loan Amount', 'required');
			$this->form_validation->set_rules('employee_loan_payment', 'Loan Payment', 'required');
			$this->form_validation->set_rules('employee_loan_balance', 'Loan Balance', 'required');		
			$this->form_validation->set_rules('payment_date', 'Payment Date', 'required');	
			
			if($this->form_validation->run()==true){
				if($this->payrollemployeeloan_model->updateemployeeloanitem($data_item)){
					$auth = $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1055','Application.projectbill.workorderinsertprocess',$auth['username'],'Save Work Order');
					$msg = "<div class='alert alert-success'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Update Loan Item Successfully
							</div> ";
					$this->session->unset_userdata('payrollemployeeloanedit');
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeloan/edit/'.$employee_loan_id);
				}else{
					$msg = "<div class='alert alert-danger'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Save Loan Item UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('payrollemployeeloanedit',$data_item);
					redirect('payrollemployeeloan/edit/'.$employee_loan_id);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('payrollemployeeloanedit',$data_item);
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloan/edit/'.$employee_loan_id);
			}
		}
		
		function processupdateemployeloan(){
			redirect('payrollemployeeloan');
		}
		
		function delete(){
			if($this->payrollemployeeloan_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				//$this->fungsi->set_log($auth['username'],'1005','Application.trainingprovider.delete',$auth['username'],'Delete Training Provider');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Loan Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloan');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Loan Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloan');
			}
		}
	}
?>