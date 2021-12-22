<?php
	Class hroemployeeincentive extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeincentive_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeeincentive');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeincentive_model->getCoreDivision(),'division_id','division_name');
			
			$data['main_view']['hroemployeedata_incentive']	= $this->hroemployeeincentive_model->getHROEmployeeData_Incentive($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'hroemployeeincentive/listhroemployeeincentive_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeincentive',$data);
			redirect('hroemployeeincentive');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeincentive');
			$this->session->unset_userdata('filter-hroemployeeincentive');
			redirect('hroemployeeincentive');
		}

		public function getCoreBranch(){
			$region_id = $this->input->post('region_id');
			
			$item = $this->hroemployeeincentive_model->getCoreBranch($region_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[branch_id]'>$mp[branch_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreLocation(){
			$branch_id = $this->input->post('branch_id');
			
			$item = $this->hroemployeeincentive_model->getCoreLocation($branch_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[location_id]'>$mp[location_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->hroemployeeincentive_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->hroemployeeincentive_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHroEmployeeData(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];
			$division_id 	= $this->input->post('division_id');
			$department_id	= $this->input->post('department_id');
			$section_id		= $this->input->post('section_id');
			
			$item = $this->hroemployeeincentive_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeincentive-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeincentive-'.$unique['unique'],$sessions);
		}
		
		public function addHROEmployeeIncentive(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeincentive_model->getHROEmployeeData($employee_id);

			$data['main_view']['hroemployeeincentive_data']	= $this->hroemployeeincentive_model->getHROEmployeeIncentive_Data($employee_id);

			$data['main_view']['hroemployeeincentive_last']	= $this->hroemployeeincentive_model->getHROEmployeeIncentive_Last($employee_id);
;
			$data['main_view']['coreregion']				= create_double($this->hroemployeeincentive_model->getCoreRegion(),'region_id','region_name');

			$data['main_view']['coredivision']				= create_double($this->hroemployeeincentive_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['corejobtitle']				= create_double($this->hroemployeeincentive_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['coregrade']					= create_double($this->hroemployeeincentive_model->getCoreGrade(),'grade_id','grade_name');

			$data['main_view']['coreclass']					= create_double($this->hroemployeeincentive_model->getCoreClass(),'class_id','class_name');

			$data['main_view']['corebonus']					= create_double($this->hroemployeeincentive_model->getCoreBonus(),'bonus_id','bonus_name');

			$data['main_view']['corelostitem']				= create_double($this->hroemployeeincentive_model->getCoreLostItem(),'lost_item_id','lost_item_name');

			$data['main_view']['payrollemployeelostitem']	= $this->hroemployeeincentive_model->getPayrollEmployeeLostItem_Data($employee_id);

			$data['main_view']['payrollemployeebonus']		= $this->hroemployeeincentive_model->getPayrollEmployeeBonus_Data($employee_id);

			$data['main_view']['payrollemployeecommission']	= $this->hroemployeeincentive_model->getPayrollEmployeeCommission_Data($employee_id);

			$data['main_view']['monthperiod']				= $this->configuration->Month;

			$data['main_view']['content']					= 'hroemployeeincentive/formaddhroemployeeincentive_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeIncentive(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_incentive_date'		=> tgltodb($this->input->post('employee_incentive_date', true)),
				'region_id' 					=> $this->input->post('region_id',true),
				'branch_id' 					=> $this->input->post('branch_id',true),
				'division_id' 					=> $this->input->post('division_id',true),
				'department_id' 				=> $this->input->post('department_id',true),
				'section_id' 					=> $this->input->post('section_id',true),
				'location_id' 					=> $this->input->post('location_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_id' 						=> $this->input->post('class_id',true),
				'employee_incentive_remark'		=> $this->input->post('employee_incentive_remark', true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date('Y-m-d H:i:s'),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('region_id', 'Region Name', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeincentive_model->insertHROEmployeeIncentive($data)){

					$this->hroemployeeincentive_model->updateHROEmployeeIncentive($data);

						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeTransfr.processAddHROEmployeeIncentive',$auth['user_id'],'Add New Employee Incentive');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Incentive Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addhroemployeeincentive');
						redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Incentive UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";;
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addhroemployeeincentive',$data);
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addhroemployeeincentive',$data);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
			}
		}
		
		public function function_elements_add_incentive(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeorganization-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeorganization-'.$unique['unique'],$sessions);
		}

		public function reset_add_incentive(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeorganization-'.$unique['unique']);	
			redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
		}

		public function deleteHROEmployeeIncentive(){
			$employee_id 			= $this->uri->segment(3);
			$employee_transfer_id 	= $this->uri->segment(4);

			$data_delete = array (
				'employee_transfer_id'	=> $employee_transfer_id,
				'data_state'			=> 1
			);

			if($this->hroemployeeincentive_model->deleteHROEmployeeIncentive($data_delete)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeIncentive_Data.delete',$auth['user_id'],'Delete Employee Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}
		}

		public function function_elements_add_lostitem(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeelostitem-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeelostitem-'.$unique['unique'],$sessions);
		}

		public function reset_add_lostitem(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeelostitem-'.$unique['unique']);	
			redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
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

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('lost_item_id', 'Lost Item Name', 'required');
			$this->form_validation->set_rules('employee_lost_item_description', 'Lost Item Description', 'required');
			$this->form_validation->set_rules('employee_lost_item_amount', 'Lost Item Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeincentive_model->insertPayrollEmployeeLostItem($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeLostItem.processAddPayrollEmployeeLostItem',$auth['user_id'],'Add New Employee Lost Item');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Lost Item Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeelostitem-'.$unique['unique']);	
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Lost Item UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeLostItem(){
			$employee_id 			= $this->uri->segment(3);
			$employee_lost_item_id 	= $this->uri->segment(4);

			$data_delete = array (
				'employee_lost_item_id'		=> $employee_lost_item_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeincentive_model->deletePayrollEmployeeLostItem($data_delete)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLostItem_Data.delete',$auth['user_id'],'Delete Employee Lost Item');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Lost Item Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Lost Item UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}
		}

		public function function_elements_add_bonus(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeebonus-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeebonus-'.$unique['unique'],$sessions);
		}

		public function reset_add_bonus(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeebonus-'.$unique['unique']);	
			redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
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
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('bonus_id', 'Bonus Name', 'required');
			$this->form_validation->set_rules('employee_bonus_description', 'Bonus Description', 'required');
			$this->form_validation->set_rules('employee_bonus_amount', 'Bonus Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeincentive_model->insertPayrollEmployeeBonus($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeBonus.processAddPayrollEmployeeBonus',$auth['user_id'],'Add New Employee Bonus');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Bonus Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeebonus-'.$unique['unique']);	
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Bonus UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeBonus(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bonus_id 	= $this->uri->segment(4);

			$data_delete = array (
				'employee_bonus_id'		=> $employee_bonus_id,
				'data_state'			=> 1
			);

			if($this->hroemployeeincentive_model->deletePayrollEmployeeBonus($data_delete)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeBonus_Data.delete',$auth['user_id'],'Delete Employee Bonus');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Bonus Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Bonus UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}
		}

		public function function_elements_add_commission(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeecommission-'.$unique['unique'],$sessions);
		}

		public function reset_add_commission(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);	
			redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
		}

		public function processAddPayrollEmployeeCommission(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

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

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeincentive_model->insertPayrollEmployeeCommission($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeCommission.processAddPayrollEmployeeCommission',$auth['user_id'],'Add New Employee Commission');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Commission Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);	
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Commission UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeCommission(){
			$employee_id 			= $this->uri->segment(3);
			$employee_commission_id = $this->uri->segment(4);

			$data_delete = array (
				'employee_commission_id'	=> $employee_commission_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeincentive_model->deletePayrollEmployeeCommission($data_delete)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommission_Data.delete',$auth['user_id'],'Delete Employee Commission');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Commission Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Commission UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive/addHROEmployeeIncentive/'.$employee_id);
			}
		}
	}
?>