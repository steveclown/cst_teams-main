<?php
	Class HroEmployeeTransferCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeTransferCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-HroEmployeeTransferCkp');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['Main_view']['coredivision']				= create_double($this->HroEmployeeTransferCkp_model->getCoreDivision(),'division_id','division_name');
			$data['Main_view']['coredepartment']			= create_double($this->HroEmployeeTransferCkp_model->getCoreDepartment(),'department_id','department_name');
			$data['Main_view']['coresection']				= create_double($this->HroEmployeeTransferCkp_model->getCoreSection(),'section_id','section_name');
			$data['Main_view']['hroemployeedata']			= create_double($this->HroEmployeeTransferCkp_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['Main_view']['hroemployeedata_transfer']	= $this->HroEmployeeTransferCkp_model->getHROEmployeeData_Transfer($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['Main_view']['content']					= 'HroEmployeeTransferCkp/listHroEmployeeTransferCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeTransferCkp',$data);
			redirect('HroEmployeeTransferCkp');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeTransferCkp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeTransferCkp-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeTransferCkp-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeTransferCkp-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeTransferCkp');
			$this->session->unset_userdata('filter-HroEmployeeTransferCkp');
			redirect('HroEmployeeTransferCkp');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeehospitalcoverage-'.$sesi['unique']);	
			redirect('HroEmployeeTransferCkp');
		}
		
		function addHROEmployeeTransfer(){
			$employee_id = $this->uri->segment(3);	

			$data['Main_view']['hroemployeedata']				= $this->HroEmployeeTransferCkp_model->getHROEmployeeData($employee_id);
			$data['Main_view']['HroEmployeeTransferCkp_data']	= $this->HroEmployeeTransferCkp_model->getHROEmployeeTransfer_Data($employee_id);
			$data['Main_view']['HroEmployeeTransferCkp_last']	= $this->HroEmployeeTransferCkp_model->getHROEmployeeTransfer_Last($employee_id);
;
			$data['Main_view']['coreregion']				= create_double($this->HroEmployeeTransferCkp_model->getCoreRegion(),'region_id','region_name');
			$data['Main_view']['corebranch']				= create_double($this->HroEmployeeTransferCkp_model->getCoreBranch(),'branch_id','branch_name');
			$data['Main_view']['coredivision']				= create_double($this->HroEmployeeTransferCkp_model->getCoreDivision(),'division_id','division_name');
			$data['Main_view']['coredepartment']			= create_double($this->HroEmployeeTransferCkp_model->getCoreDepartment(),'department_id','department_name');
			$data['Main_view']['coresection']				= create_double($this->HroEmployeeTransferCkp_model->getCoreSection(),'section_id','section_name');
			$data['Main_view']['corejobtitle']				= create_double($this->HroEmployeeTransferCkp_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['Main_view']['corelocation']				= create_double($this->HroEmployeeTransferCkp_model->getCoreLocation(),'location_id','location_name');
			$data['Main_view']['coreunit']					= create_double($this->HroEmployeeTransferCkp_model->getCoreUnit(),'unit_id','unit_name');
			$data['Main_view']['coregrade']					= create_double($this->HroEmployeeTransferCkp_model->getCoreGrade(),'grade_id','grade_name');
			$data['Main_view']['coreclass']					= create_double($this->HroEmployeeTransferCkp_model->getCoreClass(),'class_id','class_name');


			$data['Main_view']['content']					= 'HroEmployeeTransferCkp/listaddHroEmployeeTransferCkp_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddHROEmployeeTransfer(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_transfer_date' 		=> tgltodb($this->input->post('employee_transfer_date',true)),
				'region_id' 					=> $this->input->post('region_id',true),
				'branch_id' 					=> $this->input->post('branch_id',true),
				'division_id' 					=> $this->input->post('division_id',true),
				'department_id' 				=> $this->input->post('department_id',true),
				'section_id' 					=> $this->input->post('section_id',true),
				'location_id' 					=> $this->input->post('location_id',true),
				'unit_id'	 					=> $this->input->post('unit_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_id' 						=> $this->input->post('class_id',true),
				'employee_transfer_remark' 		=> $this->input->post('employee_transfer_remark',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s"),
			);


			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_transfer_date', 'Transfer Date', 'required');
			$this->form_validation->set_rules('region_id', 'Region Name', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('unit_id', 'Unit Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeTransferCkp_model->saveNewHROEmployeeTransfer($data)){
					if($this->HroEmployeeTransferCkp_model->updateHROEmployeeData($data)){

						$dataupdate_schedule = array (	
							'employee_id'					=> $data['employee_id'],
							'region_id'						=> $data['region_id'],
							'branch_id'						=> $data['branch_id'],
							'location_id'					=> $data['location_id'],
							'division_id'					=> $data['division_id'],
							'department_id'					=> $data['department_id'],
							'section_id'					=> $data['section_id'],
							'unit_id'						=> $data['unit_id'],
						);

						$update_date = date("Y-m-d");

						$this->HroEmployeeTransferCkp_model->updateScheduleEmployeeScheduleItem($dataupdate_schedule, $update_date);

						$dataupdate_shift = array (	
							'employee_id'					=> $data['employee_id'],
							'region_id'						=> $data['region_id'],
							'branch_id'						=> $data['branch_id'],
							'location_id'					=> $data['location_id'],
							'division_id'					=> $data['division_id'],
							'department_id'					=> $data['department_id'],
							'section_id'					=> $data['section_id'],
							'unit_id'						=> $data['unit_id'],
						);

						$this->HroEmployeeTransferCkp_model->updateScheduleEmployeeScheduleShift($dataupdate_shift, $update_date);


						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeTransfr.processAddHROEmployeeTransfer',$auth['user_id'],'Add New Employee Transfer');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Transfer Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addHroEmployeeTransferCkp');
						redirect('HroEmployeeTransferCkp/addHROEmployeeTransfer/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
								Add Data Employee Transfer UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";;
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addHroEmployeeTransferCkp',$data);
						redirect('HroEmployeeTransferCkp/addHROEmployeeTransfer/'.$data['employee_id']);
					}
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Transfer UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";;
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addHroEmployeeTransferCkp',$data);
					redirect('HroEmployeeTransferCkp/addHROEmployeeTransfer/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addHroEmployeeTransferCkp',$data);
				redirect('HroEmployeeTransferCkp/addHROEmployeeTransfer/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['Main_view']['result']		= $this->HroEmployeeTransferCkp_model->getDetail($this->uri->segment(3));
			$data['Main_view']['content']		= 'HroEmployeeTransferCkp/editHroEmployeeTransferCkp_view';
			$data['Main_view']['employee']		= create_double($this->HroEmployeeTransferCkp_model->getemployee(),'employee_id','employee_name');
			$data['Main_view']['region']		= create_double($this->HroEmployeeTransferCkp_model->getregion(),'region_id','region_name');
			$data['Main_view']['branch']		= create_double($this->HroEmployeeTransferCkp_model->getbranch(),'branch_id','branch_name');
			$data['Main_view']['division']		= create_double($this->HroEmployeeTransferCkp_model->getdivision(),'division_id','division_name');
			$data['Main_view']['department']	= create_double($this->HroEmployeeTransferCkp_model->getdepartment(),'department_id','department_name');
			$data['Main_view']['section']		= create_double($this->HroEmployeeTransferCkp_model->getsection(),'section_id','section_name');
			$data['Main_view']['jobtitle']		= create_double($this->HroEmployeeTransferCkp_model->getjobtitle(),'job_title_id','job_title_name');
			$data['Main_view']['location']		= create_double($this->HroEmployeeTransferCkp_model->getlocation(),'location_id','location_name');
			$data['Main_view']['grade']			= create_double($this->HroEmployeeTransferCkp_model->getgrade(),'grade_id','grade_name');
			$data['Main_view']['class']			= create_double($this->HroEmployeeTransferCkp_model->getclass(),'class_id','class_name');
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditHroEmployeeTransferCkp(){
			
			$data = array(
				'employee_transfer_id' 			=> $this->input->post('employee_transfer_id',true),
				'employee_id' 					=> $this->input->post('employee_id',true),
				'employee_transfer_date' 		=> $this->input->post('employee_transfer_date',true),
				'region_id' 					=> $this->input->post('region_id',true),
				'branch_id' 					=> $this->input->post('branch_id',true),
				'division_id' 					=> $this->input->post('division_id',true),
				'department_id' 				=> $this->input->post('department_id',true),
				'section_id' 					=> $this->input->post('section_id',true),
				'location_id' 					=> $this->input->post('location_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_id' 						=> $this->input->post('class_id',true),
				'employee_transfer_remark' 		=> $this->input->post('employee_transfer_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_transfer_date', 'Transfer Date', 'required');
			$this->form_validation->set_rules('region_id', 'Region Name', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			$this->form_validation->set_rules('employee_transfer_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->HroEmployeeTransferCkp_model->saveEditHroEmployeeTransferCkp($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HroEmployeeTransferCkp.Edit',$auth['username'],'Edit Employee Transfer');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_transfer_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Transfer Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeTransferCkp/Edit/'.$data['employee_transfer_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Transfer UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeTransferCkp/Edit/'.$data['employee_transfer_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeTransferCkp/Edit/'.$data['employee_transfer_id']);
			}
		}
		
		function deleteHROEmployeeTransfer(){
			$employee_id = $this->uri->segment(3);

			if($this->HroEmployeeTransferCkp_model->deleteHROEmployeeTransfer($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeTransfer.delete',$auth['user_id'],'Delete Employee Transfer');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Transfer Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeTransferCkp');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Transfer UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeTransferCkp');
			}
		}

		function deleteHROEmployeeTransfer_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_transfer_id = $this->uri->segment(4);

			if($this->HroEmployeeTransferCkp_model->deleteHROEmployeeTransfer_Data($employee_transfer_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeTransfer_Data.delete',$auth['user_id'],'Delete Employee Transfer');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Transfer Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeTransferCkp/addHROEmployeeTransfer/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Transfer UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeTransferCkp/addHROEmployeeTransfer/'.$employee_id);
			}
		}
		
		function getdata(){
			$employee_id = $this->input->post('employee_id');
			// $employee_id = 5;
			$data = $this->HroEmployeeTransferCkp_model->getdata($employee_id);
			// $data2 = array(
				// 'region_id' 		=> $this->HroEmployeeTransferCkp_model->getRegionName($data[region_id]),
				// 'location_id' 		=> $this->HroEmployeeTransferCkp_model->getLocationName($data[location_id]),
				// 'class_id' 			=> $this->HroEmployeeTransferCkp_model->getClassName($data[class_id]),
				// 'grade_id' 			=> $this->HroEmployeeTransferCkp_model->getGradeName($data[grade_id]),
				// 'job_title_id' 		=> $this->HroEmployeeTransferCkp_model->getJobTitleName($data[job_title_id]),
				// 'section_id' 		=> $this->HroEmployeeTransferCkp_model->getSectionName($data[section_id]),
				// 'division_id' 		=> $this->HroEmployeeTransferCkp_model->getDivisionName($data[division_id]),
			// );
			// print_r($data2);exit;
			echo json_encode($data);
		}
	}
?>