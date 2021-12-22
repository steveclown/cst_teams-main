<?php
	Class payrollleaverequestreport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollleaverequestreport_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollovertimerequestreport');
			if(!is_array($sesi)){
				$sesi['start_date']				= date('d-m-Y');
				$sesi['end_date']				= date('d-m-Y');
				$sesi['division_id']			= '';
				$sesi['department_id']			= '';
				$sesi['section_id']				= '';
				$sesi['annual_leave_id']		= '';	
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$data['main_view']['coredivision']					= create_double($this->payrollleaverequestreport_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']				= create_double($this->payrollleaverequestreport_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']					= create_double($this->payrollleaverequestreport_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['coreannualleave']				= create_double($this->payrollleaverequestreport_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			$data['main_view']['payrollleaverequest_report']	= $this->payrollleaverequestreport_model->getPayrollLeaveRequest_Report($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id'], $sesi['annual_leave_id'], $start_date, $end_date);

			$data['main_view']['content']						= 'payrollleaverequestreport/listpayrollleaverequestreport_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'start_date'		=> $this->input->post('start_date',true),
				'end_date'			=> $this->input->post('end_date',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'annual_leave_id'	=> $this->input->post('annual_leave_id',true),
			);
			$this->session->set_userdata('filter-payrollleaverequestreport',$data);
			redirect('payrollleaverequestreport');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollleaverequestreport-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollleaverequestreport-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollleaverequestreport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollleaverequestreport-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollleaverequestreport');
			$this->session->unset_userdata('filter-payrollleaverequestreport');
			redirect('payrollleaverequestreport');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollleaverequestreport-'.$sesi['unique']);	
			redirect('payrollleaverequestreport');
		}
		
		public function addPayrollLeaveRequest(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->payrollleaverequestreport_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollleaverequestreport_data']	= $this->payrollleaverequestreport_model->getPayrollLeaveRequest_Data($employee_id);
			$data['main_view']['coreannualleave']			= create_double($this->payrollleaverequestreport_model->getCoreAnnualLeave(),'annual_leave_id','annual_leave_name');

			$data['main_view']['content']					= 'payrollleaverequestreport/listaddpayrollleaverequestreport_view';
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
				if($this->payrollleaverequestreport_model->saveNewPayrollLeaveRequest($data)){
					$leave_request_id = $this->payrollleaverequestreport_model->getLeaveRequestID($data['created_id']);

					$leave_request_detail_date = $data['leave_request_start_date'];
					$leave_request_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($leave_request_detail_date)));

					date_default_timezone_set('UTC');

					while (strtotime($leave_request_detail_date) < strtotime($data['leave_request_end_date'])) {
						$leave_request_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($leave_request_detail_date)));

						$day_name = date("D", strtotime($leave_request_detail_date));

						$dayoff_date = $this->payrollleaverequestreport_model->getDayOffDate($leave_request_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_leaverequestdetail = array (
						    	'leave_request_id'				=> $leave_request_id,
						    	'employee_id'					=> $data['employee_id'],
						    	'leave_request_detail_date'		=> $leave_request_detail_date,
						    );

						    $this->payrollleaverequestreport_model->saveNewPayrollLeaveRequest_Detail($data_leaverequestdetail);
						} 
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequest.processAddPayrollLeaveRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollleaverequestreport');
					redirect('payrollleaverequestreport/addPayrollLeaveRequest/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollleaverequestreport',$data);
					redirect('payrollleaverequestreport/addPayrollLeaveRequest/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollleaverequestreport',$data);
				redirect('payrollleaverequestreport/addPayrollLeaveRequest/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollleaverequestreport_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollleaverequestreport/editpayrollleaverequestreport_view';
			$data['main_view']['employee']		= create_double($this->payrollleaverequestreport_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->payrollleaverequestreport_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollleaverequestreport(){
			
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
				if($this->payrollleaverequestreport_model->saveEditpayrollleaverequestreport($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollleaverequestreport.Edit',$auth['username'],'Edit Payroll Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Payroll Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollleaverequestreport/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Payroll Request UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollleaverequestreport/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequestreport/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deletePayrollLeaveRequest(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollleaverequestreport_model->deletePayrollLeaveRequest($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollLeaveRequest.delete',$auth['user_id'],'Delete Payroll Request');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Request Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequestreport');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Request UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequestreport');
			}
		}

		function deletePayrollLeaveRequest_Data(){
			$employee_id = $this->uri->segment(3);
			$leave_request_id = $this->uri->segment(4);

			if($this->payrollleaverequestreport_model->deletePayrollLeaveRequest_Data($leave_request_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollLeaveRequest_Data.delete',$auth['user_id'],'Delete Payroll Request');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Request Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequestreport/addPayrollLeaveRequest/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Request UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollleaverequestreport/addPayrollLeaveRequest/'.$employee_id);
			}
		}
	}
?>