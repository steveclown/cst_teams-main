<?php
	Class hroemployeeemploymentilufa extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeemploymentilufa_model');
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

			$systemuserbranch									= $this->hroemployeeemploymentilufa_model->getSystemUserBranch($user_id);


			$sesi	= 	$this->session->userdata('filter-hroemployeeemploymentilufa');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->hroemployeeemploymentilufa_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['corebranch']					= create_double($this->hroemployeeemploymentilufa_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['hroemployeedata_employment']	= $this->hroemployeeemploymentilufa_model->getHROEmployeeData_Employment($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'hroemployeeemploymentilufa/listhroemployeeemploymentilufa_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->hroemployeeemploymentilufa_model->getCoreDepartment($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->hroemployeeemploymentilufa_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),	
			);
			$this->session->set_userdata('filter-hroemployeeemploymentilufa',$data);
			redirect('hroemployeeemploymentilufa');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeemploymentilufa');
			$this->session->unset_userdata('filter-hroemployeeemploymentilufa');
			redirect('hroemployeeemploymentilufa');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeemploymentilufa-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeemploymentilufa-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeemploymentilufa-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeemploymentilufa-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeemploymentilufa-'.$unique['unique']);	
			redirect('hroemployeeemploymentilufa/addHROEmployeeLate/'.$employee_id);
		}

		public function function_elements_add_award(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeaward-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeaward-'.$unique['unique'],$sessions);
		}

		public function reset_add_award(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeaward-'.$unique['unique']);	
			redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
		}

		public function function_elements_add_warning(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeewarning-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeewarning-'.$unique['unique'],$sessions);
		}

		public function reset_add_warning(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeewarning-'.$unique['unique']);	
			redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
		}

		public function function_elements_add_suspend(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeesuspend-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeesuspend-'.$unique['unique'],$sessions);
		}

		public function reset_add_suspend(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeesuspend-'.$unique['unique']);	
			redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
		}

		public function function_elements_add_leave(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeleave-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeleave-'.$unique['unique'],$sessions);
		}

		public function reset_add_leave(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeleave-'.$unique['unique']);	
			redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
		}

		public function function_elements_add_separation(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeseparation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeseparation-'.$unique['unique'],$sessions);
		}

		public function reset_add_separation(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeseparation-'.$unique['unique']);	
			redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
		}
		
		public function addHROEmployeeEmployment(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeemploymentilufa_model->getHROEmployeeData_Detail($employee_id);

			$data['main_view']['coreaward']					= create_double($this->hroemployeeemploymentilufa_model->getCoreAward(), 'award_id', 'award_name');

			$data['main_view']['corewarning']				= create_double($this->hroemployeeemploymentilufa_model->getCoreWarning(), 'warning_id', 'warning_name');

			$data['main_view']['coresuspend']				= create_double($this->hroemployeeemploymentilufa_model->getCoreSuspend(), 'suspend_id', 'suspend_name');

			$data['main_view']['coreannualleave']			= create_double($this->hroemployeeemploymentilufa_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			$data['main_view']['coreseparationreason']		= create_double($this->hroemployeeemploymentilufa_model->getCoreSeparationReason(), 'separation_reason_id', 'separation_reason_name');

			$data['main_view']['hroemployeeaward']			= $this->hroemployeeemploymentilufa_model->getHROEmployeeAward($employee_id);

			$data['main_view']['hroemployeewarning']		= $this->hroemployeeemploymentilufa_model->getHROEmployeeWarning($employee_id);

			$data['main_view']['hroemployeesuspend']		= $this->hroemployeeemploymentilufa_model->getHROEmployeeSuspend($employee_id);

			$data['main_view']['payrollleaverequest']		= $this->hroemployeeemploymentilufa_model->getPayrollLeaveRequest($employee_id);

			$data['main_view']['hroemployeeseparation']		= $this->hroemployeeemploymentilufa_model->getHROEmployeeSeparation($employee_id);

			$data['main_view']['content']					= 'hroemployeeemploymentilufa/formaddhroemployeeemploymentilufa_view';

			$this->load->view('mainpage_view',$data);
		}

		public function processAddHROEmployeeAward(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'award_id' 							=> $this->input->post('award_id',true),
				'employee_award_date'				=> tgltodb($this->input->post('employee_award_date',true)),
				'employee_award_description'		=> $this->input->post('employee_award_description',true),
				'employee_award_remark' 			=> $this->input->post('employee_award_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_award_date', 'Date', 'required');
			$this->form_validation->set_rules('award_id', 'Award', 'required');
			$this->form_validation->set_rules('employee_award_description', 'Award Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemploymentilufa_model->insertHROEmployeeAward($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAward.processAddHROEmployeeAward',$auth['user_id'],'Add New Employee Award');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Award Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeaward-'.$unique['unique']);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Award UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemploymentilufa/hroemployeeemploymentilufa/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/hroemployeeemploymentilufa/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeAward(){
			$employee_id 		= $this->uri->segment(3);
			$employee_award_id 	= $this->uri->segment(4);

			$data = array (
				'employee_award_id'		=> $employee_award_id,
				'data_state'			=> 1
			);

			if($this->hroemployeeemploymentilufa_model->deleteHROEmployeeAward($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.deleteHROEmployeeLate',$auth['user_id'],'Delete Employee Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Late Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Late Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}
		}

		public function processAddHROEmployeeWarning(){
			$auth 	= $this->session->userdata('auth');
			$unique = $this->session->userdata('unique');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'warning_id' 						=> $this->input->post('warning_id',true),
				'employee_warning_date'				=> tgltodb($this->input->post('employee_warning_date',true)),
				'employee_warning_description'		=> $this->input->post('employee_warning_description',true),
				'employee_warning_remark' 			=> $this->input->post('employee_warning_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_warning_date', 'Date', 'required');
			$this->form_validation->set_rules('warning_id', 'Warning', 'required');
			$this->form_validation->set_rules('employee_warning_description', 'Warning Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemploymentilufa_model->insertHROEmployeeWarning($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeWarning.processAddHROEmployeeWarning',$auth['user_id'],'Add New Employee Warning');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Warning Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeewarning-'.$unique['unique']);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Warning UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}
		
		public function deleteHROEmployeeWarning(){
			$employee_id 			= $this->uri->segment(3);
			$employee_warning_id 	= $this->uri->segment(4);

			$data = array (
				'employee_warning_id'	=> $employee_warning_id,
				'data_state'			=> 1
			);

			if($this->hroemployeeemploymentilufa_model->deleteHROEmployeeWarning($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeWarning.delete',$auth['user_id'],'Delete Employee Warning');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Warning Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Warning UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}
		}

		public function processAddHROEmployeeSuspend(){
			$auth 	= $this->session->userdata('auth');
			$unique = $this->session->userdata('unique');

			$employee_suspend_date 	= tgltodb($this->input->post('employee_suspend_date',true));
			$employee_suspend_days 	= $this->input->post('employee_suspend_days',true);

			$date 		= date_create($employee_suspend_date);
			date_add($date, date_interval_create_from_date_string("".$employee_suspend_days." days"));
			$employee_suspend_status_date 	= date_format($date, "Y-m-d");

			$employee_suspend_salary_percentage	= $this->input->post('employee_suspend_salary_percentage',true);

			if (empty($employee_suspend_salary_percentage)){
				$employee_suspend_salary_percentage = 100;
			}

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'suspend_id' 							=> $this->input->post('suspend_id',true),
				'employee_suspend_date'					=> $employee_suspend_date,
				'employee_suspend_status_date'			=> $employee_suspend_status_date,
				'employee_suspend_days'					=> $employee_suspend_days,
				'employee_suspend_salary_percentage'	=> $employee_suspend_salary_percentage,
				'employee_suspend_description'			=> $this->input->post('employee_suspend_description',true),
				'employee_suspend_remark' 				=> $this->input->post('employee_suspend_remark',true),
				'employee_suspend_status' 				=> 1,
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_suspend_date', 'Suspend Date', 'required');
			$this->form_validation->set_rules('employee_suspend_days', 'Suspend Days', 'required');
			$this->form_validation->set_rules('suspend_id', 'Suspend', 'required');
			$this->form_validation->set_rules('employee_suspend_description', 'Suspend Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemploymentilufa_model->checkEmployeeSuspendStatus($data)){
					if ($this->hroemployeeemploymentilufa_model->insertHROEmployeeSuspend($data)){

						$data_update = array (
							'employee_id'		=> $data['employee_id'],
							'employee_status'	=> 2
						);

						$this->hroemployeeemploymentilufa_model->updateHROEmployeeData($data_update);

						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeSuspend.processAddHROEmployeeSuspend',$auth['user_id'],'Add New Employee Suspend');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Suspend Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addhroemployeesuspend-'.$unique['unique']);
						redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Employee Suspend Fail
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
								Employee Suspend Status Still Active
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}
		
		public function deleteHROEmployeeSuspend(){
			$employee_id 			= $this->uri->segment(3);
			$employee_suspend_id 	= $this->uri->segment(4);


			$data = array (
				'employee_suspend_id'	=> $employee_suspend_id,
				'data_state'			=> 1
			);

			if($this->hroemployeeemploymentilufa_model->deleteHROEmployeeSuspend($data)){

				$data_update = array (
					'employee_id'		=> $employee_id, 
					'employee_status'	=> 1
				);

				$this->hroemployeeemploymentilufa_model->updateHROEmployeeData($data_update);

				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeSuspend.delete',$auth['user_id'],'Delete Employee Suspend');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Suspend Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Suspend Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}
		}

		public function processUnsuspendHROEmployeeSuspend(){
			$auth 	= $this->session->userdata('auth');
			$unique = $this->session->userdata('unique');

			$employee_suspend_id	= $this->input->post("employee_suspend_id_status", true);
			$employee_id			= $this->input->post("employee_id_status", true);

			$data = array(
				'employee_suspend_id' 					=> $employee_suspend_id,
				'employee_id' 							=> $employee_id,
				'employee_suspend_status_date'			=> date("Y-m-d"),
				'employee_suspend_status_remark' 		=> $this->input->post('employee_suspend_status_remark',true),
				'employee_suspend_status' 				=> 0,
			);
			
			$this->form_validation->set_rules('employee_suspend_status_remark', 'Suspend Status Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemploymentilufa_model->unsuspendHROEmployeeSuspend($data)){
					$data_update = array (
						'employee_id'		=> $data['employee_id'],
						'employee_status'	=> 1
					);

					$this->hroemployeeemploymentilufa_model->updateHROEmployeeData($data_update);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeSuspend.processAddHROEmployeeSuspend',$auth['user_id'],'Add New Employee Suspend');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Suspend Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeesuspend-'.$unique['unique']);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Suspend Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}
		}


		public function processAddPayrollLeaveRequest(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_id' 					=> $this->input->post('annual_leave_id',true),
				'leave_request_description'			=> $this->input->post('leave_request_description',true),
				'leave_request_date'				=> tgltodb($this->input->post('leave_request_date',true)),
				'leave_request_start_date'			=> tgltodb($this->input->post('leave_request_start_date',true)),
				'leave_request_end_date'			=> tgltodb($this->input->post('leave_request_end_date',true)),
				'leave_request_duration' 			=> $this->input->post('leave_request_duration',true),
				'leave_request_reason'				=> $this->input->post('leave_request_reason',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_request_description', 'Leave Description', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_duration', 'Leave Duration', 'required');
			$this->form_validation->set_rules('leave_request_date', 'Leave Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemploymentilufa_model->insertPayrollLeaveRequest($data)){
					$leave_request_id = $this->hroemployeeemploymentilufa_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->hroemployeeemploymentilufa_model->getDayOffDate($leave_request_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_leaverequestdetail = array (
						    	'leave_request_id'				=> $leave_request_id,
						    	'employee_id'					=> $data['employee_id'],
						    	'leave_request_detail_date'		=> $leave_request_detail_date,
						    );

						    $this->hroemployeeemploymentilufa_model->insertPayrollLeaveRequest_Detail($data_leaverequestdetail);
						} 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollleaverequest-'.$unique['unique']);	
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		public function processAddHROEmployeeSeparation(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'separation_reason_id'				=> $this->input->post('separation_reason_id',true),
				'employee_separation_date'			=> tgltodb($this->input->post('employee_separation_date',true)),
				'employee_separation_description'	=> $this->input->post('employee_separation_description',true),
				'employee_separation_remark' 		=> $this->input->post('employee_separation_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_separation_date', 'Date', 'required');
			$this->form_validation->set_rules('separation_reason_id', 'Separation Reason', 'required');
			$this->form_validation->set_rules('employee_separation_description', 'Separation Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemploymentilufa_model->insertHROEmployeeSeparation($data)){

					$data_update = array (
						'employee_id'		=> $data['employee_id'],
						'employee_status'	=> 9
					);

					$this->hroemployeeemploymentilufa_model->updateHROEmployeeData($data_update);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAward.processAddHROEmployeeSeparation',$auth['user_id'],'Add New Employee Separation');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Separation Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeseparation-'.$unique['unique']);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Separation Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeSeparation(){
			$employee_id 			= $this->uri->segment(3);
			$employee_separation_id = $this->uri->segment(4);

			$data = array (
				'employee_separation_id'	=> $employee_separation_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeemploymentilufa_model->deleteHROEmployeeSeparation($data)){

				$data_update = array (
					'employee_id'		=> $employee_id, 
					'employee_status'	=> 1
				);

				$this->hroemployeeemploymentilufa_model->updateHROEmployeeData($data_update);

				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.deleteHROEmployeeSeparation',$auth['user_id'],'Delete Employee Separation');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Separation Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Separation Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemploymentilufa/addHROEmployeeEmployment/'.$employee_id);
			}
		}
		
	}
?>