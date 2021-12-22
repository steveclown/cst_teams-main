<?php
	class payrollemployeesaving extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeesaving_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollemployeesaving');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeesaving_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']			= create_double($this->payrollemployeesaving_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']				= create_double($this->payrollemployeesaving_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeesaving_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_saving']	= $this->payrollemployeesaving_model->getHROEmployeeData_Saving($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeesaving/listpayrollemployeesaving_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeesaving',$data);
			redirect('payrollemployeesaving');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeesaving-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeesaving-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeesaving-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeesaving-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeesaving');
			$this->session->unset_userdata('filter-payrollemployeesaving');
			redirect('payrollemployeesaving');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeesaving-'.$sesi['unique']);	
			redirect('payrollemployeesaving');
		}
		
		public function addPayrollEmployeeSaving(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeesaving_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeesaving_data']	= $this->payrollemployeesaving_model->getPayrollEmployeeSaving_Data($employee_id);

			$data['main_view']['coresaving']					= create_double($this->payrollemployeesaving_model->getCoreSaving(),'saving_id','saving_name');

			$data['main_view']['content']						= 'payrollemployeesaving/listaddpayrollemployeesaving_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeSaving(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'saving_id' 						=> $this->input->post('saving_id',true),
				'employee_saving_period'			=> $this->input->post('employee_saving_period',true),
				'employee_saving_description'		=> $this->input->post('employee_saving_description',true),
				'employee_saving_amount'			=> $this->input->post('employee_saving_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_saving_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_saving_amount', 'Saving Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollemployeesaving_model->insertPayrollEmployeeSaving($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeSaving.processAddPayrollEmployeeSaving',$auth['user_id'],'Add New Employee Saving');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Saving Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$unique 	= $this->session->userdata('unique');
			
					$this->session->userdata('addpayrollemployeesaving-'.$unique['unique']);

					redirect('payrollemployeesaving/addPayrollEmployeeSaving/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Saving UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeesaving',$data);
					redirect('payrollemployeesaving/addPayrollEmployeeSaving/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeesaving',$data);
				redirect('payrollemployeesaving/addPayrollEmployeeSaving/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeSaving(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeesaving_model->deletePayrollEmployeeSaving($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeSaving.delete',$auth['user_id'],'Delete Employee Saving');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Saving Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeesaving');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Saving UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeesaving');
			}
		}

		public function deletePayrollEmployeeSaving_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_payment_id = $this->uri->segment(4);

			if($this->payrollemployeesaving_model->deletePayrollEmployeeSaving_Data($employee_payment_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeSaving_Data.delete',$auth['user_id'],'Delete Employee Saving');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Saving Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeesaving/addPayrollEmployeeSaving/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Saving UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeesaving/addPayrollEmployeeSaving/'.$employee_id);
			}
		}
	}
?>