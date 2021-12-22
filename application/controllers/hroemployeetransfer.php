<?php
	Class hroemployeetransfer extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeetransfer_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeetransfer');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeetransfer_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']			= create_double($this->hroemployeetransfer_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']				= create_double($this->hroemployeetransfer_model->getCoreSection(),'section_id','section_name');
			
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeetransfer_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_transfer']	= $this->hroemployeetransfer_model->getHROEmployeeData_Transfer($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'hroemployeetransfer/listhroemployeetransfer_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeetransfer',$data);
			redirect('hroemployeetransfer');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeetransfer-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeetransfer-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeetransfer-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeetransfer-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeetransfer');
			$this->session->unset_userdata('filter-hroemployeetransfer');
			redirect('hroemployeetransfer');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeehospitalcoverage-'.$sesi['unique']);	
			redirect('hroemployeetransfer');
		}
		
		function addHROEmployeeTransfer(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeetransfer_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeetransfer_data']	= $this->hroemployeetransfer_model->getHROEmployeeTransfer_Data($employee_id);
			$data['main_view']['hroemployeetransfer_last']	= $this->hroemployeetransfer_model->getHROEmployeeTransfer_Last($employee_id);
;
			$data['main_view']['coreregion']				= create_double($this->hroemployeetransfer_model->getCoreRegion(),'region_id','region_name');
			$data['main_view']['corebranch']				= create_double($this->hroemployeetransfer_model->getCoreBranch(),'branch_id','branch_name');
			$data['main_view']['coredivision']				= create_double($this->hroemployeetransfer_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeetransfer_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeetransfer_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['corejobtitle']				= create_double($this->hroemployeetransfer_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['corelocation']				= create_double($this->hroemployeetransfer_model->getCoreLocation(),'location_id','location_name');
			$data['main_view']['coregrade']					= create_double($this->hroemployeetransfer_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']					= create_double($this->hroemployeetransfer_model->getCoreClass(),'class_id','class_name');


			$data['main_view']['content']					= 'hroemployeetransfer/listaddhroemployeetransfer_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeTransfer(){
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
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeetransfer_model->saveNewHROEmployeeTransfer($data)){
					if($this->hroemployeetransfer_model->updateHROEmployeeData($data)){
						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeTransfr.processAddHROEmployeeTransfer',$auth['user_id'],'Add New Employee Transfer');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Transfer Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addhroemployeetransfer');
						redirect('hroemployeetransfer/addHROEmployeeTransfer/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
								Add Data Employee Transfer UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";;
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addhroemployeetransfer',$data);
						redirect('hroemployeetransfer/addHROEmployeeTransfer/'.$data['employee_id']);
					}
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Transfer UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";;
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addhroemployeetransfer',$data);
					redirect('hroemployeetransfer/addHROEmployeeTransfer/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('addhroemployeetransfer',$data);
				redirect('hroemployeetransfer/addHROEmployeeTransfer/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeetransfer_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeetransfer/edithroemployeetransfer_view';
			$data['main_view']['employee']		= create_double($this->hroemployeetransfer_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['region']		= create_double($this->hroemployeetransfer_model->getregion(),'region_id','region_name');
			$data['main_view']['branch']		= create_double($this->hroemployeetransfer_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['division']		= create_double($this->hroemployeetransfer_model->getdivision(),'division_id','division_name');
			$data['main_view']['department']	= create_double($this->hroemployeetransfer_model->getdepartment(),'department_id','department_name');
			$data['main_view']['section']		= create_double($this->hroemployeetransfer_model->getsection(),'section_id','section_name');
			$data['main_view']['jobtitle']		= create_double($this->hroemployeetransfer_model->getjobtitle(),'job_title_id','job_title_name');
			$data['main_view']['location']		= create_double($this->hroemployeetransfer_model->getlocation(),'location_id','location_name');
			$data['main_view']['grade']			= create_double($this->hroemployeetransfer_model->getgrade(),'grade_id','grade_name');
			$data['main_view']['class']			= create_double($this->hroemployeetransfer_model->getclass(),'class_id','class_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeetransfer(){
			
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
				if($this->hroemployeetransfer_model->saveEdithroemployeetransfer($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeetransfer.Edit',$auth['username'],'Edit Employee Transfer');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_transfer_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Transfer Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeetransfer/Edit/'.$data['employee_transfer_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Transfer UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeetransfer/Edit/'.$data['employee_transfer_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeetransfer/Edit/'.$data['employee_transfer_id']);
			}
		}
		
		function deleteHROEmployeeTransfer(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeetransfer_model->deleteHROEmployeeTransfer($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeTransfer.delete',$auth['user_id'],'Delete Employee Transfer');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Transfer Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeetransfer');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Transfer UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeetransfer');
			}
		}

		function deleteHROEmployeeTransfer_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_transfer_id = $this->uri->segment(4);

			if($this->hroemployeetransfer_model->deleteHROEmployeeTransfer_Data($employee_transfer_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeTransfer_Data.delete',$auth['user_id'],'Delete Employee Transfer');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Transfer Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeetransfer/addHROEmployeeTransfer/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Transfer UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeetransfer/addHROEmployeeTransfer/'.$employee_id);
			}
		}
		
		function getdata(){
			$employee_id = $this->input->post('employee_id');
			// $employee_id = 5;
			$data = $this->hroemployeetransfer_model->getdata($employee_id);
			// $data2 = array(
				// 'region_id' 		=> $this->hroemployeetransfer_model->getRegionName($data[region_id]),
				// 'location_id' 		=> $this->hroemployeetransfer_model->getLocationName($data[location_id]),
				// 'class_id' 			=> $this->hroemployeetransfer_model->getClassName($data[class_id]),
				// 'grade_id' 			=> $this->hroemployeetransfer_model->getGradeName($data[grade_id]),
				// 'job_title_id' 		=> $this->hroemployeetransfer_model->getJobTitleName($data[job_title_id]),
				// 'section_id' 		=> $this->hroemployeetransfer_model->getSectionName($data[section_id]),
				// 'division_id' 		=> $this->hroemployeetransfer_model->getDivisionName($data[division_id]),
			// );
			// print_r($data2);exit;
			echo json_encode($data);
		}
	}
?>