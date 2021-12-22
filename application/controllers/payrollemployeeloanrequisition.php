<?php
	Class payrollemployeeloanrequisition extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeloanrequisition_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeeloanrequisition');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['status']				= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeeloanrequisition_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeeloanrequisition_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeeloanrequisition_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['payrollemployeeloanrequisition']	= $this->payrollemployeeloanrequisition_model->getPayrollEmployeeLoanRequisition($sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id'], $sesi['status']);
			$data['main_view']['content']							= 'payrollemployeeloanrequisition/listpayrollemployeeloanrequisition_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'status'			=> $this->input->post('status',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeloanrequisition',$data);
			redirect('payrollemployeeloanrequisition');
		}

		public function searchHroEmployeeData(){
			$data['main_view']['hroemployeedata']		= $this->payrollemployeeloanrequisition_model->getHroEmployeeData();
			$data['main_view']['content']				= 'payrollemployeeloanrequisition/listhroemployeedata_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addPayrollEmployeeLoanRequisition(){
			$employee_id = $this->uri->segment(3);

			$data['main_view']['hroemployeedata']		= $this->payrollemployeeloanrequisition_model->getHroEmployeeData_Detail($employee_id);
			$data['main_view']['coreloantype']			= create_double($this->payrollemployeeloanrequisition_model->getCoreLoanType(), 'loan_type_id', 'loan_type_name');
			$data['main_view']['employeestatus']		= $this->configuration->EmployeeStatus;
			$data['main_view']['employeeallowance']		= $this->payrollemployeeloanrequisition_model->getEmployeeAllowance($employee_id);
			$data['main_view']['payrollemployeeloanrequisition'] = $this->payrollemployeeloanrequisition_model->getPayrollEmployeeLoanRequisitionData($employee_id);
			$data['main_view']['content']				= 'payrollemployeeloanrequisition/listaddpayrollemployeeloanrequisition_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddPayrollEmployeeLoanRequisition(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'loan_type_id' 						=> $this->input->post('loan_type_id',true),
				'employee_loan_requisition_date'	=> tgltodb($this->input->post('employee_loan_requisition_date',true)),
				'employee_employment_status'		=> $this->input->post('employee_employment_status',true),
				'employee_total_salary_amount'		=> $this->input->post('employee_total_salary_amount',true),
				'employee_total_period'				=> $this->input->post('employee_total_period',true),
				'employee_loan_amount_total'		=> $this->input->post('employee_loan_amount_total',true),
				'employee_loan_amount'				=> $this->input->post('employee_loan_amount',true),
				'employee_loan_requisition_status'	=> 0,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date('Y-m-d- H:i:s')
				
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
			$this->form_validation->set_rules('employee_employment_status', 'Employment Status', 'required');
			$this->form_validation->set_rules('employee_total_period', 'Total Period', 'required');
			if($this->form_validation->run()==true){
				if($this->payrollemployeeloanrequisition_model->saveNewPayrollEmployeeLoanRequisition($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.payrollemployeeloanrequisition.processaddpayrollemployeeloanrequisition',$auth['username'],'Add New payrollemployeeloanrequisition');
					$msg = "<div class='alert alert-success'>                
								Add Employee Loan Requisition Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeloanrequisition/addPayrollEmployeeLoanRequisition/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Add Employee Loan Requisition
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeloanrequisition/addPayrollEmployeeLoanRequisition/'.$data['employee_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloanrequisition/addPayrollEmployeeLoanRequisition/'.$data['employee_id']);
			}
		}
		
		public function approvedPayrollEmployeeLoanRequisition(){
			$employee_loan_requisition_id = $this->uri->segment(3);

			$data['main_view']['payrollemployeeloanrequisition']	= $this->payrollemployeeloanrequisition_model->getPayrollEmployeeLoanRequisition_Detail($employee_loan_requisition_id);
			$data['main_view']['employeestatus']		= $this->configuration->EmployeeStatus;
			$data['main_view']['content']				= 'payrollemployeeloanrequisition/formapprovedpayrollemployeeloanrequisition_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processApprovedPayrollEmployeeLoanRequisition(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_loan_requisition_id' 		=> $this->input->post('employee_loan_requisition_id',true),
				'employee_loan_requisition_status'	=> $this->input->post('employee_loan_requisition_status', true),
				'approved_id'						=> $auth['user_id'],
				'approved_on'						=> date('Y-m-d- H:i:s')
			);
			
			$this->form_validation->set_rules('employee_loan_requisition_id', 'Employee Loan Requisition ID', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollemployeeloanrequisition_model->updatePayrollEmployeeLoanRequisition($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.coreshift.edit',$auth['username'],'Edit coreshift');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_id']);
					$msg = "<div class='alert alert-success'>                
								Approved Employee Loan Requisition Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeloanrequisition/');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Approved Employee Loan Requisition UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeloanrequisition/');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeloanrequisition/');
			}
		}
	}
?>