<?php
	Class hroemployeeleave extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeleave_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeeleave');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeleave_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeleave_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeleave_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeleave_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');
			$data['main_view']['hroemployeedata_leave']		= $this->hroemployeeleave_model->getHROEmployeeData_Leave($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeleave/listhroemployeeleave_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeleave',$data);
			redirect('hroemployeeleave');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeleave-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeleave-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeleave-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeleave-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeleave');
			$this->session->unset_userdata('filter-hroemployeeleave');
			redirect('hroemployeeleave');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeleave-'.$sesi['unique']);	
			redirect('hroemployeeleave');
		}
		
		function addHROEmployeeLeave(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']		= $this->hroemployeeleave_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeleave_data']	= $this->hroemployeeleave_model->getHROEmployeeLeave_Data($employee_id);
			$data['main_view']['coreannualleave']		= create_double($this->hroemployeeleave_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');
			$data['main_view']['content']				= 'hroemployeeleave/listaddhroemployeeleave_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeLeave(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'annual_leave_id' 				=> $this->input->post('annual_leave_id',true),
				'employee_leave_period' 		=> $this->input->post('employee_leave_period',true),
				'employee_leave_description' 	=> $this->input->post('employee_leave_description',true),
				'employee_leave_balance' 		=> $this->input->post('employee_leave_balance',true),
				'employee_leave_last_balance' 	=> $this->input->post('employee_leave_balance',true),
				'employee_leave_due_date' 		=> tgltodb($this->input->post('employee_leave_due_date',true)),
				'employee_leave_remark' 		=> $this->input->post('employee_leave_remark',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s"),
			);

	/*		print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave Name', 'required');
			$this->form_validation->set_rules('employee_leave_period', 'Leave Period', 'required');
			$this->form_validation->set_rules('employee_leave_description', 'Leave Description', 'required');
			$this->form_validation->set_rules('employee_leave_balance', 'Leave Balance', 'required');
			$this->form_validation->set_rules('employee_leave_due_date', 'Leave Due Date', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeleave_model->saveNewHROEmployeeLeave($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeLeave.processAddHROEmployeeLeave',$auth['username'],'Add New Employee Leave');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Leave Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeLeave');
					redirect('hroemployeeleave/addHROEmployeeLeave/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Leave UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeLeave',$data);
					redirect('hroemployeeleave/addHROEmployeeLeave/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddHroEmployeeLeave',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeleave/AddHroEmployeeLeave/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeeleave_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeleave/edithroemployeeleave_view';
			$data['main_view']['employee']		= create_double($this->hroemployeeleave_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['annualleave']		= create_double($this->hroemployeeleave_model->getannualleave(),'annual_leave_id','annual_leave_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeleave(){
			
			$data = array(
				'employee_leave_id' 			=> $this->input->post('employee_leave_id',true),
				'employee_id' 					=> $this->input->post('employee_id',true),
				'annual_leave_id' 				=> $this->input->post('annual_leave_id',true),
				'employee_leave_period' 		=> $this->input->post('employee_leave_period',true),
				'employee_leave_days' 			=> $this->input->post('employee_leave_days',true),
				'employee_leave_taken' 			=> $this->input->post('employee_leave_taken',true),
				'employee_leave_last_balance' 	=> $this->input->post('employee_leave_last_balance',true),
				'employee_leave_remark' 		=> $this->input->post('employee_leave_remark',true),
				'data_state'					=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeeleave_model->saveEdithroemployeeleave($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeleave.Edit',$auth['username'],'Edit Employee Leave');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_leave_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Leave Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeleave/Edit/'.$data['employee_leave_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Leave UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeleave/Edit/'.$data['employee_leave_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeleave/Edit/'.$data['employee_leave_id']);
			}
		}
		
		function deleteHROEmployeeLeave(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeleave_model->deleteHROEmployeeLeave($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeLeave.delete',$auth['username'],'Delete HROEmployeeLeave');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Leave Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeleave');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Leave UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeleave');
			}
		}

		function deleteHROEmployeeLeave_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_leave_id = $this->uri->segment(4);

			if($this->hroemployeeleave_model->deleteHROEmployeeLeave_Data($employee_leave_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeLeave_Data.delete',$auth['username'],'Delete HROEmployeeLeave_Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Leave Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeleave/addHROEmployeeLeave/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Leave UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeleave/addHROEmployeeLeave/'.$employee_id);
			}
		}
	}
?>