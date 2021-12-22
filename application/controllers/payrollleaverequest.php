<?php
	Class payrollleaverequest extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollleaverequest_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollleaverequest');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollleaverequest_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollleaverequest_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollleaverequest_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollleaverequest_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_leave']		= $this->payrollleaverequest_model->getHROEmployeeData_Leave($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollleaverequest/listpayrollleaverequest_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollleaverequest',$data);
			redirect('payrollleaverequest');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollleaverequest-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollleaverequest-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollleaverequest-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollleaverequest-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollleaverequest');
			$this->session->unset_userdata('filter-payrollleaverequest');
			redirect('payrollleaverequest');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollleaverequest-'.$sesi['unique']);	
			redirect('payrollleaverequest');
		}
		
		public function addPayrollLeaveRequest(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->payrollleaverequest_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollleaverequest_data']	= $this->payrollleaverequest_model->getPayrollLeaveRequest_Data($employee_id);
			$data['main_view']['coreannualleave']			= create_double($this->payrollleaverequest_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			$data['main_view']['content']					= 'payrollleaverequest/listaddpayrollleaverequest_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollLeaveRequest(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'annual_leave_id' 					=> $this->input->post('annual_leave_id',true),
				'leave_request_description'			=> $this->input->post('leave_request_description',true),
				'leave_request_date'				=> tgltodb($this->input->post('leave_request_date',true)),
				'leave_request_start_date'			=> tgltodb($this->input->post('leave_request_start_date',true)),
				'leave_request_end_date'			=> tgltodb($this->input->post('leave_request_end_date',true)),
				'leave_request_duration' 			=> $this->input->post('leave_request_duration',true),
				'leave_request_reason'				=> $this->input->post('leave_request_reason',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_request_description', 'Leave Description', 'required');
			$this->form_validation->set_rules('annual_leave_id', 'Annual Leave', 'required');
			$this->form_validation->set_rules('leave_request_duration', 'Leave Duration', 'required');
			$this->form_validation->set_rules('leave_request_date', 'Leave Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollleaverequest_model->saveNewPayrollLeaveRequest($data)){
					$leave_request_id = $this->payrollleaverequest_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->payrollleaverequest_model->getDayOffDate($leave_request_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_leaverequestdetail = array (
						    	'leave_request_id'				=> $leave_request_id,
						    	'employee_id'					=> $data['employee_id'],
						    	'leave_request_detail_date'		=> $leave_request_detail_date,
						    );

						    $this->payrollleaverequest_model->saveNewPayrollLeaveRequest_Detail($data_leaverequestdetail);
						} 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollleaverequest');
					redirect('payrollleaverequest/addPayrollLeaveRequest/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollleaverequest',$data);
					redirect('payrollleaverequest/addPayrollLeaveRequest/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollleaverequest',$data);
				redirect('payrollleaverequest/addPayrollLeaveRequest/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollleaverequest_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollleaverequest/editpayrollleaverequest_view';
			$data['main_view']['employee']		= create_double($this->payrollleaverequest_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->payrollleaverequest_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollleaverequest(){
			
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
				if($this->payrollleaverequest_model->saveEditpayrollleaverequest($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollleaverequest.Edit',$auth['username'],'Edit Payroll Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Payroll Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollleaverequest/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Payroll Request UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollleaverequest/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequest/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deletePayrollLeaveRequest(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollleaverequest_model->deletePayrollLeaveRequest($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollLeaveRequest.delete',$auth['user_id'],'Delete Payroll Request');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Request Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequest');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Request UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequest');
			}
		}

		function deletePayrollLeaveRequest_Data(){
			$employee_id = $this->uri->segment(3);
			$leave_request_id = $this->uri->segment(4);

			if($this->payrollleaverequest_model->deletePayrollLeaveRequest_Data($leave_request_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollLeaveRequest_Data.delete',$auth['user_id'],'Delete Payroll Request');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Request Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequest/addPayrollLeaveRequest/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Request UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequest/addPayrollLeaveRequest/'.$employee_id);
			}
		}
	}
?>