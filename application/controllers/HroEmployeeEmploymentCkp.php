<?php
	Class HroEmployeeEmploymentCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeEmploymentCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];

			$sesi	= 	$this->session->userdata('filter-HroEmployeeEmploymentCkp');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
			}

			$data['Main_view']['coredivision']					= create_double($this->HroEmployeeEmploymentCkp_model->getCoreDivision(),'division_id','division_name');

			$data['Main_view']['hroemployeedata_employment']	= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeData_Employment($region_id, $branch_id, $location_id, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['Main_view']['content']						= 'HroEmployeeEmploymentCkp/listHroEmployeeEmploymentCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->HroEmployeeEmploymentCkp_model->getCoreDepartment($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->HroEmployeeEmploymentCkp_model->getCoreSection($department_id);
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
			);
			$this->session->set_userdata('filter-HroEmployeeEmploymentCkp',$data);
			redirect('HroEmployeeEmploymentCkp');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeEmploymentCkp');
			$this->session->unset_userdata('filter-HroEmployeeEmploymentCkp');
			redirect('HroEmployeeEmploymentCkp');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeEmploymentCkp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeEmploymentCkp-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeEmploymentCkp-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeEmploymentCkp-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addHroEmployeeEmploymentCkp-'.$unique['unique']);	
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeLate/'.$employee_id);
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
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
		}

		public function function_elements_add_accident(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeworkaccident-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeworkaccident-'.$unique['unique'],$sessions);
		}

		public function reset_add_accident(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeworkaccident-'.$unique['unique']);	
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
			redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
		}
		
		public function addHROEmployeeEmployment(){
			$employee_id = $this->uri->segment(3);	

			$data['Main_view']['hroemployeedata']			= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeData_Detail($employee_id);

			$data['Main_view']['coreaward']					= create_double($this->HroEmployeeEmploymentCkp_model->getCoreAward(), 'award_id', 'award_name');

			$data['Main_view']['corewarning']				= create_double($this->HroEmployeeEmploymentCkp_model->getCoreWarning(), 'warning_id', 'warning_name');

			$data['Main_view']['coresuspend']				= create_double($this->HroEmployeeEmploymentCkp_model->getCoreSuspend(), 'suspend_id', 'suspend_name');

			$data['Main_view']['coreannualleave']			= create_double($this->HroEmployeeEmploymentCkp_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			//$data['Main_view']['coreworkaccident']			= create_double($this->HroEmployeeEmploymentCkp_model->getCoreWorkAccident(), 'work_accident_id', 'work_accident_name');

			$data['Main_view']['coreseparationreason']		= create_double($this->HroEmployeeEmploymentCkp_model->getCoreSeparationReason(), 'separation_reason_id', 'separation_reason_name');

			$data['Main_view']['hroemployeeaward']			= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeAward($employee_id);

			$data['Main_view']['hroemployeewarning']		= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeWarning($employee_id);

			$data['Main_view']['hroemployeesuspend']		= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeSuspend($employee_id);

			$data['Main_view']['payrollleaverequest']		= $this->HroEmployeeEmploymentCkp_model->getPayrollLeaveRequest($employee_id);

			//$data['Main_view']['hroemployeeworkaccident']	= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeWorkAccident($employee_id); 

			$data['Main_view']['hroemployeeseparation']		= $this->HroEmployeeEmploymentCkp_model->getHROEmployeeSeparation($employee_id);

			$data['Main_view']['content']					= 'HroEmployeeEmploymentCkp/formaddHroEmployeeEmploymentCkp_view';

			$this->load->view('MainPage_view',$data);
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
				if($this->HroEmployeeEmploymentCkp_model->insertHROEmployeeAward($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAward.processAddHROEmployeeAward',$auth['user_id'],'Add New Employee Award');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Award Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeaward-'.$unique['unique']);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Award UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeEmploymentCkp/HroEmployeeEmploymentCkp/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/HroEmployeeEmploymentCkp/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeAward(){
			$employee_id 		= $this->uri->segment(3);
			$employee_award_id 	= $this->uri->segment(4);

			$data = array (
				'employee_award_id'		=> $employee_award_id,
				'data_state'			=> 1
			);

			if($this->HroEmployeeEmploymentCkp_model->deleteHROEmployeeAward($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.deleteHROEmployeeLate',$auth['user_id'],'Delete Employee Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Late Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Late Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
				if($this->HroEmployeeEmploymentCkp_model->insertHROEmployeeWarning($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeWarning.processAddHROEmployeeWarning',$auth['user_id'],'Add New Employee Warning');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Warning Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeewarning-'.$unique['unique']);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Warning UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}
		
		public function deleteHROEmployeeWarning(){
			$employee_id 			= $this->uri->segment(3);
			$employee_warning_id 	= $this->uri->segment(4);

			$data = array (
				'employee_warning_id'	=> $employee_warning_id,
				'data_state'			=> 1
			);

			if($this->HroEmployeeEmploymentCkp_model->deleteHROEmployeeWarning($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeWarning.delete',$auth['user_id'],'Delete Employee Warning');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Warning Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Warning UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
				if($this->HroEmployeeEmploymentCkp_model->checkEmployeeSuspendStatus($data)){
					if ($this->HroEmployeeEmploymentCkp_model->insertHROEmployeeSuspend($data)){

						$data_update = array (
							'employee_id'		=> $data['employee_id'],
							'employee_status'	=> 2
						);

						$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeData($data_update);

						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeSuspend.processAddHROEmployeeSuspend',$auth['user_id'],'Add New Employee Suspend');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Suspend Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addhroemployeesuspend-'.$unique['unique']);
						redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Employee Suspend Fail
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
								Employee Suspend Status Still Active
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}
		
		public function deleteHROEmployeeSuspend(){
			$employee_id 			= $this->uri->segment(3);
			$employee_suspend_id 	= $this->uri->segment(4);


			$data = array (
				'employee_suspend_id'	=> $employee_suspend_id,
				'data_state'			=> 1
			);

			if($this->HroEmployeeEmploymentCkp_model->deleteHROEmployeeSuspend($data)){

				$data_update = array (
					'employee_id'		=> $employee_id, 
					'employee_status'	=> 1
				);

				$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeData($data_update);

				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeSuspend.delete',$auth['user_id'],'Delete Employee Suspend');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Suspend Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Suspend Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
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
				if($this->HroEmployeeEmploymentCkp_model->unsuspendHROEmployeeSuspend($data)){
					$data_update = array (
						'employee_id'		=> $data['employee_id'],
						'employee_status'	=> 1
					);

					$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeData($data_update);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeSuspend.processAddHROEmployeeSuspend',$auth['user_id'],'Add New Employee Suspend');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Suspend Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeesuspend-'.$unique['unique']);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Suspend Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}
		}


		public function processAddPayrollLeaveRequest(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$employee_absence_date					= $this->input->post('employee_absence_date',true);
			$employee_schedule_item_id				= $this->input->post('employee_schedule_item_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_id' 					=> $this->input->post('annual_leave_id',true),
				'leave_request_description'			=> $this->input->post('leave_request_description',true),
				'leave_request_date'				=> tgltodb($this->input->post('leave_request_date',true)),
				'leave_request_start_date'			=> tgltodb($this->input->post('leave_request_start_date',true)),
				'leave_request_end_date'			=> tgltodb($this->input->post('leave_request_end_date',true)),
				'leave_request_duration'			=> $this->input->post('leave_request_duration',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_request_description', 'Leave Description', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_date', 'Leave Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeEmploymentCkp_model->insertPayrollLeaveRequest($data)){
					$leave_request_id = $this->HroEmployeeEmploymentCkp_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->HroEmployeeEmploymentCkp_model->getDayOffDate($leave_request_detail_date);

						
						$data_leaverequestdetail = array (
					    	'leave_request_id'				=> $leave_request_id,
					    	'employee_id'					=> $data['employee_id'],
					    	'leave_request_detail_date'		=> $leave_request_detail_date,
					    );

					    if ($this->HroEmployeeEmploymentCkp_model->insertPayrollLeaveRequest_Detail($data_leaverequestdetail)){

					    	$data_updatescheduleitem = array(
					    		'employee_schedule_item_id'		=> $employee_schedule_item_id,
					    		'employee_id'					=> $data['employee_id'],
					    		'employee_schedule_item_status'	=> 5,
					    	);

					    	$this->HroEmployeeEmploymentCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);

					    	$dataupdate_attendancedata = array(
					    		'employee_attendance_date'			=> $leave_request_detail_date,
					    		'employee_id'						=> $data['employee_id'],
					    		'employee_attendance_date_status'	=> 5,
					    	);

					    	if ($this->HroEmployeeEmploymentCkp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

					    		$employee_attendance_log_period 	= date("Ym", strtotime($leave_request_detail_date));
					    		$day_log 							= "day_".date("d", strtotime($leave_request_detail_date));

					    		$dataupdate_attendancelog = array (
					    			'employee_id'						=> $data['employee_id'],
					    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
					    			$day_log 							=> 5
					    		);

					    		$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
					    	}
					    }
						 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->unset_userdata('addhroemployeeleave-'.$unique['unique']);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_leave',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		public function deletePayrollLeaveRequest(){
			$employee_id 				= $this->uri->segment(3);
			$leave_request_id 			= $this->uri->segment(4);

			if($this->HroEmployeeEmploymentCkp_model->deletePayrollLeaveRequest($leave_request_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = $this->HroEmployeeEmploymentCkp_model->getEmployeeScheduleItemStatusDefault($employee_schedule_item_id);

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeEmploymentCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}
		}


		public function processAddHROEmployeeWorkAccident(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'work_accident_id' 						=> $this->input->post('work_accident_id',true),
				'employee_work_accident_description'	=> $this->input->post('employee_work_accident_description',true),
				'employee_work_accident_date'			=> tgltodb($this->input->post('employee_work_accident_date',true)),
				'employee_work_accident_start_date'		=> tgltodb($this->input->post('employee_work_accident_start_date',true)),
				'employee_work_accident_end_date'		=> tgltodb($this->input->post('employee_work_accident_end_date',true)),
				'employee_work_accident_duration'		=> $this->input->post('employee_work_accident_duration',true),
				'employee_work_accident_reason'			=> $this->input->post('employee_work_accident_reason',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_work_accident_description', 'Work Accident Description', 'required');
			$this->form_validation->set_rules('work_accident_id', 'Work Accident', 'required');
			$this->form_validation->set_rules('employee_work_accident_date', 'Work Accident Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeEmploymentCkp_model->insertHROEmployeeWorkAccident($data)){
					$employee_work_accident_id = $this->HroEmployeeEmploymentCkp_model->getEmployeeWorkAccidentID($data['created_id']);

					$employee_work_accident_detail_date = $data['employee_work_accident_start_date'];
					$employee_work_accident_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($employee_work_accident_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($employee_work_accident_detail_date) < strtotime($data['employee_work_accident_end_date'])) {
						$employee_work_accident_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_work_accident_detail_date)));

						$day_name = date("D", strtotime($employee_work_accident_detail_date));

						$dayoff_date = $this->HroEmployeeEmploymentCkp_model->getDayOffDate($employee_work_accident_detail_date);

						
						$data_workaccidentdetail = array (
					    	'employee_work_accident_id'				=> $employee_work_accident_id,
					    	'employee_id'							=> $data['employee_id'],
					    	'employee_work_accident_detail_date'	=> $employee_work_accident_detail_date,
					    );

					    if ($this->HroEmployeeEmploymentCkp_model->insertHROEmployeeWOrkAccident_Detail($data_workaccidentdetail)){

					    	$data_updatescheduleitem = array(
					    		'employee_schedule_item_date'		=> $employee_work_accident_detail_date,
					    		'employee_id'						=> $data['employee_id'],
					    		'employee_schedule_item_status'		=> 7,
					    	);

					    	$this->HroEmployeeEmploymentCkp_model->updateScheduleEmployeeScheduleItem($data_updatescheduleitem);

					    	$dataupdate_attendancedata = array(
					    		'employee_attendance_date'			=> $employee_work_accident_detail_date,
					    		'employee_id'						=> $data['employee_id'],
					    		'employee_attendance_date_status'	=> 7,
					    	);

					    	if ($this->HroEmployeeEmploymentCkp_model->updateHROEmployeeAttendanceData_Status($dataupdate_attendancedata)){

					    		$employee_attendance_log_period 	= date("Ym", strtotime($employee_work_accident_detail_date));
					    		$day_log 							= "day_".date("d", strtotime($employee_work_accident_detail_date));

					    		$dataupdate_attendancelog = array (
					    			'employee_id'						=> $data['employee_id'],
					    			'employee_attendance_log_period'	=> $employee_attendance_log_period,
					    			$day_log 							=> 7
					    		);

					    		$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeAttendanceLog($dataupdate_attendancelog);
					    	}
					    }
						 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Work Accident Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->unset_userdata('addhroemployeeworkaccident-'.$unique['unique']);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Work Accident UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_leave',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_leave',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeWorkAccident(){
			$employee_id 				= $this->uri->segment(3);
			$leave_request_id 			= $this->uri->segment(4);
			$employee_absence_date 		= $this->uri->segment(5);
			$employee_schedule_item_id 	= $this->uri->segment(6);

			if($this->HroEmployeeEmploymentCkp_model->deletePayrollLeaveRequest($leave_request_id)){
				$auth = $this->session->userdata('auth');

				$employee_schedule_item_status = $this->HroEmployeeEmploymentCkp_model->getEmployeeScheduleItemStatusDefault($employee_schedule_item_id);

				$data_updateitemstatus = array (
					'employee_schedule_item_id'		=> $employee_schedule_item_id,
					'employee_schedule_item_status'	=> $employee_schedule_item_status,
				);

				$this->HroEmployeeEmploymentCkp_model->updateScheduleEmployeeScheduleItem_Status($data_updateitemstatus);

				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.deleteHROEmployeeAbsence',$auth['user_id'],'Delete Employee Absence');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('hroemployeeadministrationckp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_leave',$msg);
				redirect('hroemployeeadministrationckp/addHROEmployeeAdministration/'.$employee_id.'/'.$employee_absence_date.'/'.$employee_schedule_item_id);
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
				if($this->HroEmployeeEmploymentCkp_model->insertHROEmployeeSeparation($data)){

					$data_update = array (
						'employee_id'		=> $data['employee_id'],
						'employee_status'	=> 9
					);

					$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeData($data_update);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAward.processAddHROEmployeeSeparation',$auth['user_id'],'Add New Employee Separation');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Separation Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeseparation-'.$unique['unique']);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Separation Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeSeparation(){
			$employee_id 			= $this->uri->segment(3);
			$employee_separation_id = $this->uri->segment(4);

			$data = array (
				'employee_separation_id'	=> $employee_separation_id,
				'data_state'				=> 1
			);

			if($this->HroEmployeeEmploymentCkp_model->deleteHROEmployeeSeparation($data)){

				$data_update = array (
					'employee_id'		=> $employee_id, 
					'employee_status'	=> 1
				);

				$this->HroEmployeeEmploymentCkp_model->updateHROEmployeeData($data_update);

				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.deleteHROEmployeeSeparation',$auth['user_id'],'Delete Employee Separation');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Separation Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Separation Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeEmploymentCkp/addHROEmployeeEmployment/'.$employee_id);
			}
		}
		
	}
?>