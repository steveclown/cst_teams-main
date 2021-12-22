<?php
	Class hroemployeeworking extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeworking_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeworking');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeworking_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeworking_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeworking_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeworking_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_working']		= $this->hroemployeeworking_model->getHROEmployeeData_Working($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeworking/listhroemployeeworking_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeworking',$data);
			redirect('hroemployeeworking');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeworking-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeworking-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeworking-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeworking-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeworking');
			$this->session->unset_userdata('filter-hroemployeeworking');
			redirect('hroemployeeworking');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeworking-'.$sesi['unique']);	
			redirect('hroemployeeworking');
		}
		
		public function addHROEmployeeWorking(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeworking_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeworking_data']	= $this->hroemployeeworking_model->getHROEmployeeWorking_Data($employee_id);
			$data['main_view']['status']					= $this->configuration->Status;
			$data['main_view']['monthlist']					= $this->configuration->Month;
			$data['main_view']['separationletter']			= $this->configuration->SeparationLetter;

			$data['main_view']['content']					= 'hroemployeeworking/listaddhroemployeeworking_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeWorking(){
			$work_month_from = $this->input->post('work_month_from',true);
			$work_year_from = $this->input->post('work_year_from',true);
			$work_month_to = $this->input->post('work_month_to',true);
			$work_year_to = $this->input->post('work_year_to',true);
			
			/* $nMonthForm = $this->configuration->MonthName[$work_month_from];
			$nMonthTo = $this->configuration->MonthName[$work_month_to]; */
			
			$working_from_period = $work_year_from.$work_month_from;
			$working_to_period = $work_year_to.$work_month_to;
			
			$data = array(
				'employee_id'							=> $this->input->post('employee_id',true),
				'working_from_period'					=> $working_from_period,
				'working_to_period'						=> $working_to_period,
				'working_company_name'					=> $this->input->post('working_company_name',true),
				'working_company_address'				=> $this->input->post('working_company_address',true),
				'working_job_title'						=> $this->input->post('working_job_title',true),
				'working_last_salary'					=> $this->input->post('working_last_salary',true),
				'working_separation_reason'				=> $this->input->post('working_separation_reason',true),
				'working_separation_letter'				=> $this->input->post('working_separation_letter',true),
				'working_experience_remark'				=> $this->input->post('working_experience_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('working_company_name', 'Company Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeworking_model->saveNewHROEmployeeWorking($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeWorking.processAddHROEmployeeWorking',$auth['username'],'Add New Employee Working');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Working Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeWorking');
					redirect('hroemployeeworking/AddHROEmployeeWorking/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Working UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeWorking',$data);
					redirect('hroemployeeworking/AddHROEmployeeWorking/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('AddHroEmployeeWorking',$data);
				redirect('hroemployeeworking/AddHROEmployeeWorking/'.$data['employee_id']);
			}
		}
		
		public function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['result']		= $this->hroemployeeworking_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeworking/edithroemployeeworking_view';
			$data['main_view']['working']		= create_double($this->hroemployeeworking_model->getworking(),'working_id','working_name');
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEdithroemployeeworking(){
			
			$data = array(
				'employee_working_id' 			=> $this->input->post('employee_working_id',true),
				'working_id' 						=> $this->input->post('working_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'working_type' 					=> $this->input->post('working_type',true),
				'employee_working_name' 			=> $this->input->post('employee_working_name',true),
				'employee_working_city' 			=> $this->input->post('employee_working_city',true),
				'employee_working_from_period' 	=> $this->input->post('employee_working_from_period',true),
				'employee_working_to_period' 		=> $this->input->post('employee_working_to_period',true),
				'employee_working_duration' 		=> $this->input->post('employee_working_duration',true),
				'employee_working_passed' 		=> $this->input->post('employee_working_passed',true),
				'employee_working_certificate' 	=> $this->input->post('employee_working_certificate',true),
				'employee_working_remark'		 	=> $this->input->post('employee_working_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('working_id', 'Working Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_working_name', 'Employee Working Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeeworking_model->saveEdithroemployeeworking($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeworking.Edit',$auth['username'],'Edit Employee data');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_working_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Working Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					// redirect('hroemployeeworking/Edit/'.$data['employee_working_id']);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Working UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeworking/Edit/'.$data['employee_working_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworking/Edit/'.$data['employee_working_id']);
			}
		}
		
		public function deleteHROEmployeeWorking(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeworking_model->deleteHROEmployeeWorking($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeWorking.deleteHROEmployeeWorking',$auth['username'],'Delete HROEmployeeWorking');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworking');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworking');
			}
		}

		public function deleteHROEmployeeWorking_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_working_id = $this->uri->segment(4);

			if($this->hroemployeeworking_model->deleteHROEmployeeWorking_Data($employee_working_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeWorking.deleteHROEmployeeWorking_Data',$auth['username'],'Delete HROEmployeeWorking');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworking/addHROEmployeeWorking/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeworking/addHROEmployeeWorking/'.$employee_id);
			}
		}
	}
?>