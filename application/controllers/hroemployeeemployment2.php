<?php
	Class hroemployeeemployment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeemployment_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeeemployment');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->hroemployeeemployment_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']				= create_double($this->hroemployeeemployment_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']					= create_double($this->hroemployeeemployment_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']				= create_double($this->hroemployeeemployment_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_employment']	= $this->hroemployeeemployment_model->getHROEmployeeData_Employment($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);



			$data['main_view']['content']						= 'hroemployeeemployment/listhroemployeeemployment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeemployment',$data);
			redirect('hroemployeeemployment');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeemployment');
			$this->session->unset_userdata('filter-hroemployeeemployment');
			redirect('hroemployeeemployment');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('hroemployeeemployment-'.$sesi['unique']);	
			redirect('hroemployeeemployment');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeemployment-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeemployment-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeemployment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeemployment-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function addHROEmployeeEmployment(){
			$employee_id = $this->uri->segment(3);	

			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['workingstatus']					= $this->configuration->WorkingStatus;

			$data['main_view']['employeestatus']				= $this->configuration->EmployeeStatus;
			$data['main_view']['overtimestatus']				= $this->configuration->OvertimeStatus;	
			$data['main_view']['hroemployeedata']				= $this->hroemployeeemployment_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeemployment_data']	= $this->hroemployeeemployment_model->getHROEmployeeEmployment($employee_id);
			$data['main_view']['content']						= 'hroemployeeemployment/listaddhroemployeeemployment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeEmployment(){
			$auth = $this->session->userdata('auth');
			$created_id = $auth['user_id'];
			
			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'employee_employment_working_status'	=> $this->input->post('employee_employment_working_status',true),
				'employee_employment_overtime_status'	=> $this->input->post('employee_employment_overtime_status',true),
				'employee_employment_status'			=> $this->input->post('employee_employment_status',true),
				'employee_hire_date'					=> tgltodb($this->input->post('employee_hire_date',true)),
				'employee_employment_status_date'		=> tgltodb($this->input->post('employee_employment_status_date',true)),
				'employee_employment_status_duedate'	=> tgltodb($this->input->post('employee_employment_status_duedate',true)),
				'created_id'							=> $created_id,
				'created_on'							=> date("YmdHis"),
				'data_state'							=> 0,
			);

			

			$this->form_validation->set_rules('employee_employment_working_status', 'Working Status', 'required');
			$this->form_validation->set_rules('employee_employment_overtime_status', 'Overtime Status', 'required');
		
			$this->form_validation->set_rules('employee_employment_status', 'Employee Status', 'required');
			$this->form_validation->set_rules('employee_hire_date', 'Employee Hire Date', 'required');
			$this->form_validation->set_rules('employee_employment_status_date', 'Employment Status Date', 'required');
			$this->form_validation->set_rules('employee_employment_status_duedate', 'Employment Status Due Date', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeemployment_model->saveNewHROEmployeeEmployment($data)==true){

					$data_update = array(
						'employee_id'							=> $data['employee_id'],
						'employee_employment_working_status' 	=> $data['employee_employment_working_status']
					);

					$this->hroemployeeemployment_model->updateHROEmployeeData($data_update);
					
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeEmployment.edit',$auth['username'],'Add Employee Employment');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_id']);
					$msg = "<div class='alert alert-success'>                
								Add Employee Employment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Employment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		function deleteHROEmployeeEmployment(){
			$employee_id = $this->uri->segment(3);	
			/*print_r("employee_family_id ".$employee_family_id);
			exit;*/
			if($this->hroemployeeemployment_model->deleteHROEmployeeEmployment($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeEmployment.deleteHROEmployeeEmployment',$auth['username'],'Delete HROEmployeeEmployment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Employment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Employment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment');
			}
		}


		function deleteHROEmployeeEmployment_Data(){
			$employee_employment_id = $this->uri->segment(3);	
			/*print_r("employee_family_id ".$employee_family_id);
			exit;*/
			if($this->hroemployeeemployment_model->deleteHROEmployeeEmployment_Data($employee_employment_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeEmployment.deleteHROEmployeeEmployment',$auth['username'],'Delete HROEmployeeEmployment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Employment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Employment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment');
			}
		}

		
	}
?>