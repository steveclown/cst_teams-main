<?php
	Class payrollemployeeincentive extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeincentive_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];
			$branch_status 				= $auth['branch_status'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeeincentive');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}
 
			$systemuserbranch								= $this->payrollemployeeincentive_model->getSystemUserBranch($user_id);

			$data['main_view']['corebranch']				= create_double($this->payrollemployeeincentive_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['coredivision']				= create_double($this->payrollemployeeincentive_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_incentive']	= $this->payrollemployeeincentive_model->getHROEmployeeData_Incentive($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeeincentive/listpayrollemployeeincentive_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeincentive',$data);
			redirect('payrollemployeeincentive');
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->payrollemployeeincentive_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->payrollemployeeincentive_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeincentive-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeeincentive-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeincentive-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeincentive-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeeincentive');
			$this->session->unset_userdata('filter-payrollemployeeincentive');
			redirect('payrollemployeeincentive');
		}

		public function reset_add(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			
			$this->session->unset_userdata('addpayrollemployeeincentive-'.$unique['unique']);	
			redirect('payrollemployeeincentive/addPayrollEmployeeIncentive/'.$employee_id);
		}
		
		public function addPayrollEmployeeIncentive(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeeincentive_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeeincentive_data']	= $this->payrollemployeeincentive_model->getPayrollEmployeeIncentive_Data($employee_id);

			$data['main_view']['coreincentive']					= create_double($this->payrollemployeeincentive_model->getCoreIncentive(),'incentive_id','incentive_name');

			$data['main_view']['monthperiod']					= $this->configuration->Month;

			$data['main_view']['content']						= 'payrollemployeeincentive/formaddpayrollemployeeincentive_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeIncentive(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_incentive_period = $year_period.$month_period;


			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'incentive_id' 						=> $this->input->post('incentive_id',true),
				'employee_incentive_period'			=> $employee_incentive_period,
				'employee_incentive_description'	=> $this->input->post('employee_incentive_description',true),
				'employee_incentive_amount'			=> $this->input->post('employee_incentive_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('incentive_id', 'Incentive', 'required');
			$this->form_validation->set_rules('employee_incentive_description', 'Incentive Description', 'required');
			$this->form_validation->set_rules('employee_incentive_amount', 'Incentive Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeincentive_model->insertPayrollEmployeeIncentive($data)){
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeIncentive.processAddPayrollEmployeeIncentive',$auth['user_id'],'Add New Employee Incentive');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Incentive Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeeincentive-'.$unique['unique']);

					redirect('payrollemployeeincentive/addPayrollEmployeeIncentive/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Incentive UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeeincentive',$data);
					redirect('payrollemployeeincentive/addPayrollEmployeeIncentive/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeeincentive',$data);
				redirect('payrollemployeeincentive/addPayrollEmployeeIncentive/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeIncentive(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeincentive_model->deletePayrollEmployeeIncentive($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeIncentive.delete',$auth['user_id'],'Delete Employee Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincentive');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincentive');
			}
		}

		public function deletePayrollEmployeeIncentive_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_incentive_id = $this->uri->segment(4);

			if($this->payrollemployeeincentive_model->deletePayrollEmployeeIncentive_Data($employee_incentive_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeIncentive_Data.delete',$auth['user_id'],'Delete Employee Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincentive/addPayrollEmployeeIncentive/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincentive/addPayrollEmployeeIncentive/'.$employee_id);
			}
		}
	}
?>