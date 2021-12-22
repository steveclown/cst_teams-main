<?php
	Class payrollemployeeadditionalilufa extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeadditionalilufa_model');
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

			$sesi	= 	$this->session->userdata('filter-payrollemployeeadditionalilufa');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}

			$systemuserbranch									= $this->payrollemployeeadditionalilufa_model->getSystemUserBranch($user_id);

			$data['main_view']['corebranch']					= create_double($this->payrollemployeeadditionalilufa_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['coredivision']					= create_double($this->payrollemployeeadditionalilufa_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_additional']	= $this->payrollemployeeadditionalilufa_model->getHROEmployeeData_Additional($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'payrollemployeeadditionalilufa/listpayrollemployeeadditionalilufa_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeadditionalilufa', $data);
			redirect('payrollemployeeadditionalilufa');
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->payrollemployeeadditionalilufa_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->payrollemployeeadditionalilufa_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeeadditionalilufa');
			$this->session->unset_userdata('filter-payrollemployeeadditionalilufa');
			redirect('payrollemployeeadditionalilufa');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeadditionalilufa-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeeadditionalilufa-'.$unique['unique'],$sessions);
		}
		
		public function addPayrollEmployeeAdditional(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeeadditionalilufa_model->getHROEmployeeData_Detail($employee_id);

			$data['main_view']['payrollemployeebonus']			= $this->payrollemployeeadditionalilufa_model->getPayrollEmployeeBonus_Data($employee_id);

			$data['main_view']['corebonus']						= create_double($this->payrollemployeeadditionalilufa_model->getCoreBonus(),'bonus_id','bonus_name');

			$data['main_view']['monthperiod']					= $this->configuration->Month;

			$data['main_view']['payrollemployeecommission']		= $this->payrollemployeeadditionalilufa_model->getPayrollEmployeeCommission_Data($employee_id);

			$data['main_view']['payrollemployeeincentive']		= $this->payrollemployeeadditionalilufa_model->getPayrollEmployeeIncentive_Data($employee_id);

			$data['main_view']['coreincentive']					= create_double($this->payrollemployeeadditionalilufa_model->getCoreIncentive(),'incentive_id','incentive_name');

			$data['main_view']['payrollemployeelostitem']		= $this->payrollemployeeadditionalilufa_model->getPayrollEmployeeLostItem_Data($employee_id);

			$data['main_view']['corelostitem']					= create_double($this->payrollemployeeadditionalilufa_model->getCoreLostItem(),'lost_item_id','lost_item_name');

			$data['main_view']['payrollemployeedeductionpremi']	= $this->payrollemployeeadditionalilufa_model->getPayrollEmployeeDeductionPremi_Data($employee_id);

			$data['main_view']['corepremiattendance']			= create_double($this->payrollemployeeadditionalilufa_model->getCorePremiAttendance(), 'premi_attendance_id', 'premi_attendance_name');


			$data['main_view']['content']						= 'payrollemployeeadditionalilufa/formaddpayrollemployeeadditionalilufa_view';

			$this->load->view('mainpage_view',$data);
		}


		public function function_elements_add_bonus(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeebonus-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeebonus-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_bonus(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeebonus-'.$unique['unique']);	
			redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
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
				if($this->payrollemployeeadditionalilufa_model->insertPayrollEmployeeBonus($data)){

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
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Bonus UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeebonus',$data);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeebonus',$data);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeBonus(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeBonus($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeBonus.delete',$auth['user_id'],'Delete Employee Bonus');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Bonus Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Bonus UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}
		}

		public function deletePayrollEmployeeBonus_Data(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bonus_id 	= $this->uri->segment(4);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeBonus_Data($employee_bonus_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeBonus_Data.delete',$auth['user_id'],'Delete Employee Bonus');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Bonus Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Bonus UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}
		}


		public function function_elements_add_commission(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeecommission-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_commission(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);	
			redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
		}
		
		public function processAddPayrollEmployeeCommission(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_commission_period = $year_period.$month_period;

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'employee_commission_period'			=> $employee_commission_period,
				'employee_commission_omzet_mmc'			=> $this->input->post('employee_commission_omzet_mmc',true),
				'employee_commission_quantity_mmc'		=> $this->input->post('employee_commission_quantity_mmc',true),
				'employee_commission_omzet_acc'			=> $this->input->post('employee_commission_omzet_acc',true),
				'employee_commission_total_omzet'		=> $this->input->post('employee_commission_total_omzet',true),
				'employee_commission_amount_mmc'		=> $this->input->post('employee_commission_amount_mmc',true),
				'employee_commission_amount_acc'		=> $this->input->post('employee_commission_amount_acc',true),
				'employee_commission_total_amount'		=> $this->input->post('employee_commission_total_amount',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

			/*print_r("month_period ");
			print_r($month_period);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeadditionalilufa_model->insertPayrollEmployeeCommission($data)){


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeCommission.processAddPayrollEmployeeCommission',$auth['user_id'],'Add New Employee Commission');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Commission Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Commission UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeecommission',$data);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeecommission',$data);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeCommission(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeCommission($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommission.delete',$auth['user_id'],'Delete Employee Commission');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Commission Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Commission UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}
		}

		public function deletePayrollEmployeeCommission_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_commission_id = $this->uri->segment(4);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeCommission_Data($employee_commission_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommission_Data.delete',$auth['user_id'],'Delete Employee Commission');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Commission Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Commission UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}
		}



		public function function_elements_add_incentive(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeincentive-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeincentive-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_incentive(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			
			$this->session->unset_userdata('addpayrollemployeeincentive-'.$unique['unique']);	
			redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
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
				if($this->payrollemployeeadditionalilufa_model->insertPayrollEmployeeIncentive($data)){
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeIncentive.processAddPayrollEmployeeIncentive',$auth['user_id'],'Add New Employee Incentive');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Incentive Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeeincentive-'.$unique['unique']);

					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Incentive UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeeincentive',$data);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeeincentive',$data);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeIncentive(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeIncentive($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeIncentive.delete',$auth['user_id'],'Delete Employee Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}
		}

		public function deletePayrollEmployeeIncentive_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_incentive_id = $this->uri->segment(4);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeIncentive_Data($employee_incentive_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeIncentive_Data.delete',$auth['user_id'],'Delete Employee Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}
		}




		public function function_elements_add_lostitem(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeelostitem-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeelostitem-'.$unique['unique'],$sessions);
			// echo $name;
		}


		public function reset_add_lostitem(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeelostitem-'.$unique['unique']);	
			redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
		}

		
		public function processAddPayrollEmployeeLostItem(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_lost_item_period = $year_period.$month_period;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'lost_item_id' 						=> $this->input->post('lost_item_id',true),
				'employee_lost_item_period'			=> $employee_lost_item_period,
				'employee_lost_item_description'	=> $this->input->post('employee_lost_item_description',true),
				'employee_lost_item_amount'			=> $this->input->post('employee_lost_item_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r("month_period ");
			print_r($month_period);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('lost_item_id', 'Lost Item Name', 'required');
			$this->form_validation->set_rules('employee_lost_item_description', 'Lost Item Description', 'required');
			$this->form_validation->set_rules('employee_lost_item_amount', 'Lost Item Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeadditionalilufa_model->insertPayrollEmployeeLostItem($data)){

					/*print_r("month_period ");
					print_r($month_period);
					print_r("<BR>");
					print_r("data ");
					print_r($data);
					exit;*/

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeLostItem.processAddPayrollEmployeeLostItem',$auth['user_id'],'Add New Employee Lost Item');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Lost Item Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addpayrollemployeelostitem-'.$unique['unique']);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Lost Item UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeelostitem',$data);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeelostitem',$data);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeLostItem(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeLostItem($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLostItem.delete',$auth['user_id'],'Delete Employee Lost Item');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Lost Item Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Lost Item UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}
		}

		public function deletePayrollEmployeeLostItem_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_lost_item_id 	= $this->uri->segment(4);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeLostItem_Data($employee_lost_item_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLostItem_Data.delete',$auth['user_id'],'Delete Employee Lost Item');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Lost Item Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Lost Item UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}
		}


		public function function_elements_add_premi(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepremi-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeepremi-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_premi(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeepremi-'.$unique['unique']);	
			redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
		}

		
		public function processAddPayrollEmployeeDeductionPremi(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_deduction_premi_period = $year_period.$month_period;

			$data = array(
				'employee_id'	 						=> $this->input->post('employee_id',true),
				'premi_attendance_id' 					=> $this->input->post('premi_attendance_id',true),
				'employee_deduction_premi_period'		=> $employee_deduction_premi_period,
				'employee_deduction_premi_description'	=> $this->input->post('employee_deduction_premi_description',true),
				'employee_deduction_premi_amount'		=> $this->input->post('employee_deduction_premi_amount',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

			/*print_r("month_period ");
			print_r($month_period);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('premi_attendance_id', 'Lost Item Name', 'required');
			$this->form_validation->set_rules('employee_deduction_premi_description', 'Deduction Premi Description', 'required');
			$this->form_validation->set_rules('employee_deduction_premi_amount', 'Deduction Premi Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeadditionalilufa_model->insertPayrollEmployeeDeductionPremi($data)){

					/*print_r("month_period ");
					print_r($month_period);
					print_r("<BR>");
					print_r("data ");
					print_r($data);
					exit;*/

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDeductionPremi.processAddPayrollEmployeeDeductionPremi',$auth['user_id'],'Add New Employee Deduction Premi');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Deduction Premi Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addpayrollemployeedeductionpremi-'.$unique['unique']);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Deduction Premi UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeelostitem',$data);
					redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeelostitem',$data);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeDeductionPremi(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeDeductionPremi($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeductionPremi.delete',$auth['user_id'],'Delete Employee Deduction Premi');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Deduction Premi Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Deduction Premi UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa');
			}
		}

		public function deletePayrollEmployeeDeductionPremi_Data(){
			$employee_id 					= $this->uri->segment(3);
			$employee_deduction_premi_id 	= $this->uri->segment(4);

			if($this->payrollemployeeadditionalilufa_model->deletePayrollEmployeeDeductionPremi_Data($employee_deduction_premi_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeductionPremi_Data.delete',$auth['user_id'],'Delete Employee Deduction Premi');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Deduction Premi Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Deduction Premi UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/'.$employee_id);
			}
		}
		
	}
?>