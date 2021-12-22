<?php
	Class payrollemployeeallowance extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeallowance_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollemployeeallowance');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeeallowance_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeeallowance_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeeallowance_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeeallowance_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_allowance']	= $this->payrollemployeeallowance_model->getHROEmployeeData_Allowance($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeeallowance/listpayrollemployeeallowance_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeallowance',$data);
			redirect('payrollemployeeallowance');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeallowance-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeeallowance-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeallowance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeallowance-'.$unique['unique'],$sessions);
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeeallowance');
			$this->session->unset_userdata('filter-payrollemployeeallowance');
			redirect('payrollemployeeallowance');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeallowance-'.$sesi['unique']);	
			redirect('payrollemployeeallowance');
		}
		
		public function addPayrollEmployeeAllowance(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeeallowance_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeeallowance_data']	= $this->payrollemployeeallowance_model->getPayrollEmployeeAllowance_Data($employee_id);
			$data['main_view']['coreallowance']					= create_double($this->payrollemployeeallowance_model->getCoreAllowance(),'allowance_id','allowance_name');

			$data['main_view']['content']						= 'payrollemployeeallowance/listaddpayrollemployeeallowance_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeAllowance(){
			$auth = $this->session->userdata('auth');

			

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

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allowance', 'required');
			$this->form_validation->set_rules('employee_allowance_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_allowance_amount', 'Allowance Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeallowance_model->saveNewPayrollEmployeeAllowance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeAllowance.processAddPayrollEmployeeAllowance',$auth['user_id'],'Add New Employee Allowance');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeeallowance');
					redirect('payrollemployeeallowance/addPayrollEmployeeAllowance/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Allowance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeeallowance',$data);
					redirect('payrollemployeeallowance/addPayrollEmployeeAllowance/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeeallowance',$data);
				redirect('payrollemployeeallowance/addPayrollEmployeeAllowance/'.$data['employee_id']);
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

		public function deletePayrollEmployeeAllowance_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_payment_id = $this->uri->segment(4);

			if($this->payrollemployeeallowance_model->deletePayrollEmployeeAllowance_Data($employee_payment_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeAllowance_Data.delete',$auth['user_id'],'Delete Employee Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeallowance/addPayrollEmployeeAllowance/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeallowance/addPayrollEmployeeAllowance/'.$employee_id);
			}
		}
	}
?>