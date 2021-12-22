<?php
	Class hroemployeehomeearly extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeehomeearly_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeehomeearly');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeehomeearly_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeehomeearly_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeehomeearly_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeehomeearly_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_homeearly']	= $this->hroemployeehomeearly_model->getHROEmployeeData_HomeEarly($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'hroemployeehomeearly/listhroemployeehomeearly_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeehomeearly',$data);
			redirect('hroemployeehomeearly');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeehomeearly-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeehomeearly-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeehomeearly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeehomeearly-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeehomeearly');
			$this->session->unset_userdata('filter-hroemployeehomeearly');
			redirect('hroemployeehomeearly');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeehomeearly-'.$sesi['unique']);	
			redirect('hroemployeehomeearly');
		}
		
		public function addHROEmployeeHomeEarly(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['corehomeearly']					= create_double($this->hroemployeehomeearly_model->getCoreHomeEarly(),'home_early_id','home_early_name');
			$data['main_view']['hroemployeedata']				= $this->hroemployeehomeearly_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeehomeearly_data']		= $this->hroemployeehomeearly_model->getHROEmployeeHomeEarly_Data($employee_id);

			$data['main_view']['content']						= 'hroemployeehomeearly/listaddhroemployeehomeearly_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeHomeEarly(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'home_early_id'						=> $this->input->post('home_early_id',true),
				'employee_home_early_date'			=> tgltodb($this->input->post('employee_home_early_date',true)),
				'employee_home_early_hour'			=> $this->input->post('employee_home_early_hour',true),
				'employee_home_early_description'	=> $this->input->post('employee_home_early_description',true),
				'employee_home_early_reason' 		=> $this->input->post('employee_home_early_reason',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('home_early_id', 'Home Early Name', 'required');
			$this->form_validation->set_rules('employee_home_early_date', 'Date', 'required');
			$this->form_validation->set_rules('employee_home_early_hour', 'Hour', 'required');
			$this->form_validation->set_rules('employee_home_early_description', 'Home Early Description', 'required');
			$this->form_validation->set_rules('employee_home_early_reason', 'Home Early Reason', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeehomeearly_model->saveNewHROEmployeeHomeEarly($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeHomeEarly.processAddHROEmployeeHomeEarly',$auth['user_id'],'Add New Employee Home Early ');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Home Early  Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addhroemployeehomeearly');
					redirect('hroemployeehomeearly/addHROEmployeeHomeEarly/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Home Early  UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeehomeearly',$data);
					redirect('hroemployeehomeearly/addHROEmployeeHomeEarly/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeehomeearly',$data);
				redirect('hroemployeehomeearly/addHROEmployeeHomeEarly/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeHomeEarly(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeehomeearly_model->deleteHROEmployeeHomeEarly($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeHomeEarly.deleteHROEmployeeHomeEarly',$auth['user_id'],'Delete Employee Home Early ');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Home Early  Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehomeearly');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Home Early  UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehomeearly');
			}
		}

		public function deleteHROEmployeeHomeEarly_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_home_early_id = $this->uri->segment(4);

			if($this->hroemployeehomeearly_model->deleteHROEmployeeHomeEarly_Data($employee_home_early_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeHomeEarly_Data.deleteHROEmployeeHomeEarly_Data',$auth['user_id'],'Delete Employee Home Early  Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Home Early  Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehomeearly/addHROEmployeeHomeEarly/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Home Early  UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehomeearly/addHROEmployeeHomeEarly/'.$employee_id);
			}
		}


		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeehomeearly_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeehomeearly/edithroemployeehomeearly_view';
			$data['main_view']['employee']		= create_double($this->hroemployeehomeearly_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['absence']			= create_double($this->hroemployeehomeearly_model->getabsence(),'absence_id','absence_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeehomeearly(){
			
			$data = array(
				'employee_absence_id' 				=> $this->input->post('employee_absence_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'absence_id' 							=> $this->input->post('absence_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeehomeearly_model->saveEdithroemployeehomeearly($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeehomeearly.Edit',$auth['username'],'Edit Employee Absence');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_absence_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Absence Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeehomeearly/Edit/'.$data['employee_absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Absence UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeehomeearly/Edit/'.$data['employee_absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehomeearly/Edit/'.$data['employee_absence_id']);
			}
		}
	}
?>