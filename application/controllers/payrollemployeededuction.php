<?php
	Class payrollemployeededuction extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeededuction_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollemployeededuction');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeededuction_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeededuction_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeededuction_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeededuction_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_deduction']	= $this->payrollemployeededuction_model->getHROEmployeeData_Deduction($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeededuction/listpayrollemployeededuction_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeededuction',$data);
			redirect('payrollemployeededuction');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeededuction-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeededuction-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeededuction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeededuction-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeededuction');
			$this->session->unset_userdata('filter-payrollemployeededuction');
			redirect('payrollemployeededuction');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeededuction-'.$sesi['unique']);	
			redirect('payrollemployeededuction');
		}
		
		public function addPayrollEmployeeDeduction(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeededuction_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeededuction_data']	= $this->payrollemployeededuction_model->getPayrollEmployeeDeduction_Data($employee_id);
			$data['main_view']['corededuction']					= create_double($this->payrollemployeededuction_model->getCoreDeduction(),'deduction_id','deduction_name');

			$data['main_view']['content']						= 'payrollemployeededuction/listaddpayrollemployeededuction_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollEmployeeDeduction(){
			$auth = $this->session->userdata('auth');
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

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('deduction_id', 'Deduction', 'required');
			$this->form_validation->set_rules('employee_deduction_period', 'Period', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeededuction_model->saveNewPayrollEmployeeDeduction($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDeduction.processAddPayrollEmployeeDeduction',$auth['user_id'],'Add New Employee Deduction');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Deduction Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeededuction');
					redirect('payrollemployeededuction/addPayrollEmployeeDeduction/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Deduction UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeededuction',$data);
					redirect('payrollemployeededuction/addPayrollEmployeeDeduction/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeededuction',$data);
				redirect('payrollemployeededuction/addPayrollEmployeeDeduction/'.$data['employee_id']);
			}
		}

		function deletePayrollEmployeeDeduction(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeededuction_model->deletePayrollEmployeeDeduction($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeduction.delete',$auth['user_id'],'Delete Employee Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeededuction');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Deduction UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeededuction');
			}
		}

		function deletePayrollEmployeeDeduction_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_deduction_id = $this->uri->segment(4);

			if($this->payrollemployeededuction_model->deletePayrollEmployeeDeduction_Data($employee_deduction_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeduction_Data.delete',$auth['user_id'],'Delete Employee Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeededuction/addPayrollEmployeeDeduction/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Deduction UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeededuction/addPayrollEmployeeDeduction/'.$employee_id);
			}
		}
	}
?>