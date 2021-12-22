<?php
	Class hroemployeesuspend extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeesuspend_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeesuspend');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeesuspend_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeesuspend_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeesuspend_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeesuspend_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_suspend']		= $this->hroemployeesuspend_model->getHROEmployeeData_Suspend($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeesuspend/listhroemployeesuspend_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeesuspend',$data);
			redirect('hroemployeesuspend');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeesuspend-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeesuspend-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeesuspend-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeesuspend-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeesuspend');
			$this->session->unset_userdata('filter-hroemployeesuspend');
			redirect('hroemployeesuspend');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeesuspend-'.$sesi['unique']);	
			redirect('hroemployeesuspend');
		}
		
		function addHROEmployeeSuspend(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeesuspend_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeesuspend_data']	= $this->hroemployeesuspend_model->getHROEmployeeSuspend_Data($employee_id);
			$data['main_view']['coresuspend']				= create_double($this->hroemployeesuspend_model->getCoreSuspend(),'suspend_id','suspend_name');

			$data['main_view']['content']					= 'hroemployeesuspend/listaddhroemployeesuspend_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeSuspend(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'warning_id' 							=> $this->input->post('warning_id',true),
				'employee_warning_date'				=> tgltodb($this->input->post('employee_warning_date',true)),
				'employee_warning_description'		=> $this->input->post('employee_warning_description',true),
				'employee_warning_remark' 			=> $this->input->post('employee_warning_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_warning_date', 'Date', 'required');
			$this->form_validation->set_rules('warning_id', 'Suspend', 'required');
			$this->form_validation->set_rules('employee_warning_description', 'Suspend Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeesuspend_model->saveNewHROEmployeeSuspend($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeSuspend.processAddHROEmployeeSuspend',$auth['user_id'],'Add New Employee Suspend');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Suspend Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addhroemployeesuspend');
					redirect('hroemployeesuspend/addHROEmployeeSuspend/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Suspend UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeesuspend',$data);
					redirect('hroemployeesuspend/addHROEmployeeSuspend/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeesuspend',$data);
				redirect('hroemployeesuspend/addHROEmployeeSuspend/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeesuspend_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeesuspend/edithroemployeesuspend_view';
			$data['main_view']['employee']		= create_double($this->hroemployeesuspend_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->hroemployeesuspend_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeesuspend(){
			
			$data = array(
				'employee_warning_id' 				=> $this->input->post('employee_warning_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_warning_date'				=> tgltodb($this->input->post('employee_warning_date',true)),
				'employee_warning_remark' 			=> $this->input->post('employee_warning_remark',true),
				'warning_id' 							=> $this->input->post('warning_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_warning_date', 'Date', 'required');
			$this->form_validation->set_rules('warning_id', 'Suspend', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeesuspend_model->saveEdithroemployeesuspend($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeesuspend.Edit',$auth['username'],'Edit Employee Suspend');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Suspend Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeesuspend/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Suspend UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeesuspend/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeesuspend/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deleteHROEmployeeSuspend(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeesuspend_model->deleteHROEmployeeSuspend($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeSuspend.delete',$auth['user_id'],'Delete Employee Suspend');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Suspend Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeesuspend');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Suspend UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeesuspend');
			}
		}

		function deleteHROEmployeeSuspend_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_warning_id = $this->uri->segment(4);

			if($this->hroemployeesuspend_model->deleteHROEmployeeSuspend_Data($employee_warning_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeSuspend_Data.delete',$auth['user_id'],'Delete Employee Suspend');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Suspend Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeesuspend/addHROEmployeeSuspend/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Suspend UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeesuspend/addHROEmployeeSuspend/'.$employee_id);
			}
		}
	}
?>