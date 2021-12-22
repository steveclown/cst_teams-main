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


			$data['main_view']['content']					= 'hroemployeeincentive/listaddhroemployeeincentive_view';
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

			// print_r("data ");
			// print_r($data);
			// exit;

			
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

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeincentive-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeincentive-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeincentive-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeincentive-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeincentive');
			$this->session->unset_userdata('filter-hroemployeeincentive');
			redirect('hroemployeeincentive');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeehospitalcoverage-'.$sesi['unique']);	
			redirect('hroemployeeincentive');
		}

		
		
		// function Edit(){
		// 	$data['main_view']['result']		= $this->hroemployeeincentive_model->getDetail($this->uri->segment(3));
		// 	$data['main_view']['content']		= 'hroemployeeincentive/edithroemployeeincentive_view';
		// 	$data['main_view']['employee']		= create_double($this->hroemployeeincentive_model->getemployee(),'employee_id','employee_name');
		// 	$data['main_view']['region']		= create_double($this->hroemployeeincentive_model->getregion(),'region_id','region_name');
		// 	$data['main_view']['branch']		= create_double($this->hroemployeeincentive_model->getbranch(),'branch_id','branch_name');
		// 	$data['main_view']['division']		= create_double($this->hroemployeeincentive_model->getdivision(),'division_id','division_name');
		// 	$data['main_view']['department']	= create_double($this->hroemployeeincentive_model->getdepartment(),'department_id','department_name');
		// 	$data['main_view']['section']		= create_double($this->hroemployeeincentive_model->getsection(),'section_id','section_name');
		// 	$data['main_view']['jobtitle']		= create_double($this->hroemployeeincentive_model->getjobtitle(),'job_title_id','job_title_name');
		// 	$data['main_view']['location']		= create_double($this->hroemployeeincentive_model->getlocation(),'location_id','location_name');
		// 	$data['main_view']['grade']			= create_double($this->hroemployeeincentive_model->getgrade(),'grade_id','grade_name');
		// 	$data['main_view']['class']			= create_double($this->hroemployeeincentive_model->getclass(),'class_id','class_name');
		// 	$this->load->view('mainpage_view',$data);
		// }
		
		// function processEdithroemployeeincentive(){
			
		// 	$data = array(
		// 		'employee_transfer_id' 			=> $this->input->post('employee_transfer_id',true),
		// 		'employee_id' 					=> $this->input->post('employee_id',true),
		// 		'employee_transfer_date' 		=> $this->input->post('employee_transfer_date',true),
		// 		'region_id' 					=> $this->input->post('region_id',true),
		// 		'branch_id' 					=> $this->input->post('branch_id',true),
		// 		'division_id' 					=> $this->input->post('division_id',true),
		// 		'department_id' 				=> $this->input->post('department_id',true),
		// 		'section_id' 					=> $this->input->post('section_id',true),
		// 		'location_id' 					=> $this->input->post('location_id',true),
		// 		'job_title_id' 					=> $this->input->post('job_title_id',true),
		// 		'grade_id' 						=> $this->input->post('grade_id',true),
		// 		'class_id' 						=> $this->input->post('class_id',true),
		// 		'employee_transfer_remark' 		=> $this->input->post('employee_transfer_remark',true),
		// 		'data_state'						=> '0'
		// 	);
			
		// 	$this->session->set_userdata('Edit',$data);
		// 	$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
		// 	$this->form_validation->set_rules('employee_transfer_date', 'Incentive Date', 'required');
		// 	$this->form_validation->set_rules('region_id', 'Region Name', 'required');
		// 	$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
		// 	$this->form_validation->set_rules('division_id', 'Division Name', 'required');
		// 	$this->form_validation->set_rules('department_id', 'Department Name', 'required');
		// 	$this->form_validation->set_rules('section_id', 'Section Name', 'required');
		// 	$this->form_validation->set_rules('location_id', 'Location Name', 'required');
		// 	$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
		// 	$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
		// 	$this->form_validation->set_rules('class_id', 'Class Name', 'required');
		// 	$this->form_validation->set_rules('employee_transfer_remark', 'Remark', 'filterspecialchar');
		// 	if($this->form_validation->run()==true){
		// 		if($this->hroemployeeincentive_model->saveEdithroemployeeincentive($data)==true){
		// 			$auth 	= $this->session->userdata('auth');
		// 			$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeincentive.Edit',$auth['username'],'Edit Employee Incentive');
		// 			$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_transfer_id']);
		// 			$msg = "<div class='alert alert-success'>                
		// 						Edit Employee Incentive Successfully
		// 					</div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('hroemployeeincentive/Edit/'.$data['employee_transfer_id']);
		// 		}else{
		// 			$msg = "<div class='alert alert-danger'>                
		// 						Edit Employee Incentive UnSuccessful
		// 					</div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('hroemployeeincentive/Edit/'.$data['employee_transfer_id']);
		// 		}
		// 	}else{
		// 		$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
		// 		$this->session->set_userdata('message',$msg);
		// 		redirect('hroemployeeincentive/Edit/'.$data['employee_transfer_id']);
		// 	}
		// }
		
		function deleteHROEmployeeIncentive(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeincentive_model->deleteHROEmployeeIncentive($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeIncentive.delete',$auth['user_id'],'Delete Employee Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeincentive');
			}
		}

		function deleteHROEmployeeIncentive_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_transfer_id = $this->uri->segment(4);

			if($this->hroemployeeincentive_model->deleteHROEmployeeIncentive_Data($employee_transfer_id)){
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
		
		function getdata(){
			$employee_id = $this->input->post('employee_id');
			// $employee_id = 5;
			$data = $this->hroemployeeincentive_model->getdata($employee_id);
			// $data2 = array(
				// 'region_id' 		=> $this->hroemployeeincentive_model->getRegionName($data[region_id]),
				// 'location_id' 		=> $this->hroemployeeincentive_model->getLocationName($data[location_id]),
				// 'class_id' 			=> $this->hroemployeeincentive_model->getClassName($data[class_id]),
				// 'grade_id' 			=> $this->hroemployeeincentive_model->getGradeName($data[grade_id]),
				// 'job_title_id' 		=> $this->hroemployeeincentive_model->getJobTitleName($data[job_title_id]),
				// 'section_id' 		=> $this->hroemployeeincentive_model->getSectionName($data[section_id]),
				// 'division_id' 		=> $this->hroemployeeincentive_model->getDivisionName($data[division_id]),
			// );
			// print_r($data2);exit;
			echo json_encode($data);
		}
	}
?>