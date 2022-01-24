<?php

	Class HroEmployeeStatusAlteration extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'hro-employee-status-alteration';

			$this->cekLogin();
			$this->accessMenu($menu);
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeStatusAlteration_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-HroEmployeeStatusAlteration');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coreregion']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreRegion(),'region_id','region_name');

			$data['main_view']['corebranch']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreBranch(),'branch_id','branch_name');

			$data['main_view']['corecompany']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreCompany(),'company_id','company_name');

			$data['main_view']['coredivision']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']					= create_double($this->HroEmployeeStatusAlteration_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['coreunit']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreUnit(),'unit_id','unit_name');

			$data['main_view']['corejobtitle']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['coregrade']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreGrade(),'grade_id','grade_name');

			$data['main_view']['coreclass']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreClass(),'class_id','class_name');

			$data['main_view']['corelocation']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreLocation(),'location_id','location_name');




			
			$data['main_view']['hroemployeedata']					= create_double($this->HroEmployeeStatusAlteration_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_statusalteration']	= $this->HroEmployeeStatusAlteration_model->getHROEmployeeData_StatusAlteration($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);
			
			$data['main_view']['employeeemploymentstatus']			= $this->configuration->EmployeeStatus();

			$data['main_view']['content']							= 'HroEmployeeStatusAlteration/listHroEmployeeStatusAlteration_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeStatusAlteration',$data);
			redirect('hro-employee-status-alteration');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeStatusAlteration-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeStatusAlteration-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeStatusAlteration-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeStatusAlteration-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeStatusAlteration');
			$this->session->unset_userdata('filter-HroEmployeeStatusAlteration');
			redirect('hro-employee-status-alteration');
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addHroEmployeeStatusAlteration-'.$unique['unique']);	
			redirect('hro-employee-status-alteration/add/'.$employee_id);
		}
		
		public function addHROEmployeeStatusAlteration(){
			$employee_id = $this->uri->segment(3);


			$data['main_view']['coreregion']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['corebranch']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreBranch(), 'branch_id', 'branch_name');

			$data['main_view']['corecompany']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreCompany(),'company_id','company_name');

			$data['main_view']['coredivision']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']					= create_double($this->HroEmployeeStatusAlteration_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['coreunit']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreUnit(),'unit_id','unit_name');

			$data['main_view']['corejobtitle']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['coregrade']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreGrade(),'grade_id','grade_name');

			$data['main_view']['coreclass']							= create_double($this->HroEmployeeStatusAlteration_model->getCoreClass(),'class_id','class_name');

			$data['main_view']['corelocation']						= create_double($this->HroEmployeeStatusAlteration_model->getCoreLocation(),'location_id','location_name');




			$data['main_view']['hroemployeedata']				= $this->HroEmployeeStatusAlteration_model->getHROEmployeeData($employee_id);

			$data['main_view']['employeeemploymentstatus']		= $this->configuration->EmployeeStatus();
			$data['main_view']['hroemployeestatusalteration']	= $this->HroEmployeeStatusAlteration_model->getHROEmployeeStatusAlteration($employee_id);
			$data['main_view']['hroemployeestatusalteration_last']	= $this->HroEmployeeStatusAlteration_model->getHROEmployeeStatusAlteration_Last($employee_id);

			$data['main_view']['content']						= 'HroEmployeeStatusAlteration/FormAddHroEmployeeStatusAlteration_view';

			$this->load->view('MainPage_view',$data);
		}

		public function getCoreBranch(){
			$region_id = $this->input->post('region_id');

			$item = $this->HroEmployeeStatusAlteration_model->getCoreBranchDD($region_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[branch_id]'>$mp[branch_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreLocation(){
			$branch_id = $this->input->post('branch_id');

			$item = $this->HroEmployeeStatusAlteration_model->getCoreLocationDD($branch_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[location_id]'>$mp[location_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->HroEmployeeStatusAlteration_model->getCoreDepartmentDD($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->HroEmployeeStatusAlteration_model->getCoreSectionDD($department_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreUnit(){
			$section_id = $this->input->post('section_id');

			$item = $this->HroEmployeeStatusAlteration_model->getCoreUnitDD($section_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[unit_id]'>$mp[unit_name]</option>\n";	
			}
			echo $data;
		}
		
		public function processAddHROEmployeeStatusAlteration(){
			$auth = $this->session->userdata('auth');
			$employee_name = 
			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'applicant_id' 					=> $this->input->post('applicant_id',true),
				'marital_status_id' 			=> $this->input->post('marital_status_id',true),
				'region_id' 					=> $this->input->post('region_id',true),
				'branch_id' 					=> $this->input->post('branch_id',true),
				'company_id' 					=> $this->input->post('company_id',true),
				'division_id' 					=> $this->input->post('division_id',true),
				'department_id' 				=> $this->input->post('department_id',true),
				'section_id' 					=> $this->input->post('section_id',true),
				'unit_id' 						=> $this->input->post('unit_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_id' 						=> $this->input->post('class_id',true),
				'location_id' 					=> $this->input->post('location_id',true),
				'bank_id' 						=> $this->input->post('bank_id',true),
				'status_alteration_date' 		=> tgltodb($this->input->post('status_alteration_date',true)),
				'status_alteration_last_date' 	=> tgltodb($this->input->post('status_alteration_last_date',true)),
				'status_alteration_description' => $this->input->post('status_alteration_description',true),
				'employee_employment_status'	=> $this->input->post('employee_employment_status',true),
				'status_alteration_remark' 		=> $this->input->post('status_alteration_remark',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s")
			);
			// print_r("Data:");
			// print_r($data);
			// exit();
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('status_alteration_date', 'Status Alteration Date', 'required');
			$this->form_validation->set_rules('status_alteration_last_date', 'Status Alteration Last Date', 'required');
			$this->form_validation->set_rules('employee_employment_status', 'Employee Employment Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeStatusAlteration_model->insertHROEmployeeStatusAlteration($data)){
					$data_update = array (
						'employee_id'							=> $data['employee_id'],
						'applicant_id' 							=> $this->input->post('applicant_id',true),
						'marital_status_id' 					=> $this->input->post('marital_status_id',true),
						'region_id' 							=> $this->input->post('region_id',true),
						'branch_id' 							=> $this->input->post('branch_id',true),
						'company_id' 							=> $this->input->post('company_id',true),
						'division_id' 							=> $this->input->post('division_id',true),
						'department_id' 						=> $this->input->post('department_id',true),
						'section_id' 							=> $this->input->post('section_id',true),
						'unit_id' 								=> $this->input->post('unit_id',true),
						'job_title_id' 							=> $this->input->post('job_title_id',true),
						'grade_id' 								=> $this->input->post('grade_id',true),
						'class_id' 								=> $this->input->post('class_id',true),
						'location_id' 							=> $this->input->post('location_id',true),
						'bank_id' 								=> $this->input->post('bank_id',true),
						'bank_id' 								=> $this->input->post('bank_id',true),
						'employee_status'						=> $data['employee_employment_status'],
						'employee_employment_status'			=> $data['employee_employment_status'],
						'employee_employment_status_date'		=> $data['status_alteration_date'],
						'employee_employment_status_duedate'	=> $data['status_alteration_last_date'],
					);

					$this->HroEmployeeStatusAlteration_model->updateHROEmployeeData($data_update);
					// $auth = $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeStatusAlteration.processAddHROEmployeeStatusAlteration',$auth['user_id'],'Add New Status Alteration');
					$msg = "<div class='alert alert-success'>                
								Add Data Status Alteration Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addHroEmployeeStatusAlteration');
					redirect('hroemployeestatusalteration/addHROEmployeeStatusAlteration/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Status Alteration UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addHroEmployeeStatusAlteration',$data);
					redirect('hroemployeestatusalteration/addHROEmployeeStatusAlteration/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addHroEmployeeStatusAlteration',$data);
				redirect('hroemployeestatusalteration/addHROEmployeeStatusAlterations');
			}
		}
		
		function Edit(){
			$data['Main_view']['result']		= $this->HroEmployeeStatusAlteration_model->getDetail($this->uri->segment(3));
			$data['Main_view']['content']		= 'HroEmployeeStatusAlteration/editHroEmployeeStatusAlteration_view';
			$data['Main_view']['employee']		= create_double($this->HroEmployeeStatusAlteration_model->getemployee(),'employee_id','employee_name');
			// $data['Main_view']['employeestatus']		= create_double($this->HroEmployeeStatusAlteration_model->getemployeestatus(),'employee_status_id','employee_status_name');
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditHroEmployeeStatusAlteration(){
			
			$data = array(
				'status_alteration_id' 			=> $this->input->post('status_alteration_id',true),
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_status_id' 			=> "2",
				'employee_status_id' 			=> $this->input->post('employee_status_id',true),
				'status_alteration_due_date' 	=> $this->input->post('status_alteration_due_date',true),
				'status_alteration_remark' 		=> $this->input->post('status_alteration_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('status_alteration_date', 'Status Alteration Date', 'required');
			// $this->form_validation->set_rules('employee_status_id', 'Employee Status ID', 'required');
			$this->form_validation->set_rules('status_alteration_due_date', 'Status Alteration Due Date', 'required');
			$this->form_validation->set_rules('status_alteration_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeStatusAlteration_model->saveEditHroEmployeeStatusAlteration($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HroEmployeeStatusAlteration.Edit',$auth['username'],'Edit Status Alteration');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['status_alteration_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Status Alteration Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hro-employee-status-alteration/Edit/'.$data['status_alteration_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Status Alteration UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hro-employee-status-alteration/Edit/'.$data['status_alteration_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hro-employee-status-alteration/Edit/'.$data['status_alteration_id']);
			}
		}
		
		function deleteHROEmployeeStatusAlteration(){
			$auth 						= $this->session->userdata('auth');
			$status_alteration_id 		= $this->uri->segment(3);
			$employee_employment_status = $this->uri->segment(4);
			$employee_id 				= $this->uri->segment(5);


			$data = array(
				'status_alteration_id' 			=> $status_alteration_id,
				'deleted_id' 					=> $auth['user_id'],
				'deleted_on' 					=> date("Y-m-d H:i:s"),
				'data_state'					=> 1
			);

			if($this->HroEmployeeStatusAlteration_model->deleteHROEmployeeStatusAlteration($data)){
				// $data = array (
				// 'employee_id'							=> $employee_id,
				// 	'employee_employment_status'			=> $employee_employment_status
				// );

				// // print_r("data update :");
				// // print_r($data);
				// // exit;

				// $this->HroEmployeeStatusAlteration_model->updateHROEmployeeDataFromDelete($data);

				$data_last = $this->HroEmployeeStatusAlteration_model->getHROEmployeeStatusAlteration_Last($employee_id);

				$data_update = array (
					'employee_id'							=> $data_last['employee_id'],
					'marital_status_id'						=> $data_last['marital_status_id'],
					'region_id'								=> $data_last['region_id'],
					'branch_id'								=> $data_last['branch_id'],
					'company_id'							=> $data_last['company_id'],
					'division_id'							=> $data_last['division_id'],
					'department_id'							=> $data_last['department_id'],
					'section_id'							=> $data_last['section_id'],
					'unit_id'								=> $data_last['unit_id'],
					'job_title_id'							=> $data_last['job_title_id'],
					'grade_id'								=> $data_last['grade_id'],
					'class_id'								=> $data_last['class_id'],
					'location_id'							=> $data_last['location_id'],
					'bank_id'								=> $data_last['bank_id'],
					'employee_status'						=> $data_last['employee_employment_status'],
					'employee_employment_status'			=> $data_last['employee_employment_status'],
					'employee_employment_status_date'		=> $data_last['status_alteration_date'],
					'employee_employment_status_duedate'	=> $data_last['status_alteration_last_date']
				);
				
				// print_r("data update :");
				// print_r($data_update);
				// exit;
				
				$this->HroEmployeeStatusAlteration_model->updateHROEmployeeDataFromDelete($data_update);

				$this->fungsi->set_log($auth['user_id'], $data['status_alteration_id'], '3122', 'Application.HroEmployeeStatusAlteration.deleteHROEmployeeStatusAlteration', $data['status_alteration_id'], 'Delete HRO Employee Status Alteration');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Status Alteration Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hro-employee-status-alteration');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Status Alteration Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hro-employee-status-alteration');
			}
		}
	}
?>