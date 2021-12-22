<?php
	Class payrollemployeebonus extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeebonus_model');
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

			$sesi	= 	$this->session->userdata('filter-payrollemployeebonus');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}
 
			$systemuserbranch								= $this->payrollemployeebonus_model->getSystemUserBranch($user_id);

			$data['main_view']['corebranch']				= create_double($this->payrollemployeebonus_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['coredivision']				= create_double($this->payrollemployeebonus_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_bonus']		= $this->payrollemployeebonus_model->getHROEmployeeData_Bonus($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeebonus/listpayrollemployeebonus_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),	
			);
			$this->session->set_userdata('filter-payrollemployeebonus',$data);
			redirect('payrollemployeebonus');
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->payrollemployeebonus_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->payrollemployeebonus_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeebonus-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeebonus-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeebonus-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeebonus-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeebonus');
			$this->session->unset_userdata('filter-payrollemployeebonus');
			redirect('payrollemployeebonus');
		}

		public function reset_add(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeebonus-'.$unique['unique']);	
			redirect('payrollemployeebonus/addPayrollEmployeeBonus/'.$employee_id);
		}
		
		public function addPayrollEmployeeBonus(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']		= $this->payrollemployeebonus_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeebonus']	= $this->payrollemployeebonus_model->getPayrollEmployeeBonus_Data($employee_id);

			$data['main_view']['corebonus']				= create_double($this->payrollemployeebonus_model->getCoreBonus(),'bonus_id','bonus_name');

			$data['main_view']['monthperiod']			= $this->configuration->Month;

			$data['main_view']['content']				= 'payrollemployeebonus/formaddpayrollemployeebonus_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeBonus(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_bonus_period = $year_period.$month_period;

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'bonus_id' 						=> $this->input->post('bonus_id',true),
				'employee_bonus_period'			=> $employee_bonus_period,
				'employee_bonus_description'	=> $this->input->post('employee_bonus_description',true),
				'employee_bonus_amount'			=> $this->input->post('employee_bonus_amount',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s"),
			);

			/*print_r("month_period ");
			print_r($month_period);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('bonus_id', 'Bonus Name', 'required');
			$this->form_validation->set_rules('employee_bonus_description', 'Bonus Description', 'required');
			$this->form_validation->set_rules('employee_bonus_amount', 'Bonus Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeebonus_model->insertPayrollEmployeeBonus($data)){

					/*print_r("month_period ");
					print_r($month_period);
					print_r("<BR>");
					print_r("data ");
					print_r($data);
					exit;*/

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeBonus.processAddPayrollEmployeeBonus',$auth['user_id'],'Add New Employee Bonus');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Bonus Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeebonus-'.$unique['unique']);
					redirect('payrollemployeebonus/addPayrollEmployeeBonus/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Bonus UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeebonus',$data);
					redirect('payrollemployeebonus/addPayrollEmployeeBonus/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeebonus',$data);
				redirect('payrollemployeebonus/addPayrollEmployeeBonus/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeBonus(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeebonus_model->deletePayrollEmployeeBonus($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeBonus.delete',$auth['user_id'],'Delete Employee Bonus');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Bonus Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeebonus');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Bonus UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeebonus');
			}
		}

		public function deletePayrollEmployeeBonus_Data(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bonus_id 	= $this->uri->segment(4);

			if($this->payrollemployeebonus_model->deletePayrollEmployeeBonus_Data($employee_bonus_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeBonus_Data.delete',$auth['user_id'],'Delete Employee Bonus');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Bonus Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeebonus/addPayrollEmployeeBonus/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Bonus UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeebonus/addPayrollEmployeeBonus/'.$employee_id);
			}
		}
	}
?>