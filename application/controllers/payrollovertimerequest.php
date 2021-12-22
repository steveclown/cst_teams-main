<?php
	Class payrollovertimerequest extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollovertimerequest_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollovertimerequest');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollovertimerequest_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollovertimerequest_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollovertimerequest_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollovertimerequest_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_overtime']		= $this->payrollovertimerequest_model->getHROEmployeeData_Overtime($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollovertimerequest/listpayrollovertimerequest_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollovertimerequest',$data);
			redirect('payrollovertimerequest');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimerequest-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollovertimerequest-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimerequest-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollovertimerequest-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollovertimerequest');
			$this->session->unset_userdata('filter-payrollovertimerequest');
			redirect('payrollovertimerequest');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollovertimerequest-'.$sesi['unique']);	
			redirect('payrollovertimerequest');
		}
		
		function addPayrollOvertimeRequest(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->payrollovertimerequest_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollovertimerequest_data']	= $this->payrollovertimerequest_model->getPayrollOvertimeRequest_Data($employee_id);
			$data['main_view']['coreovertimetype']				= create_double($this->payrollovertimerequest_model->getCoreOvertimeType(),'overtime_type_id','overtime_type_name');

			$data['main_view']['content']					= 'payrollovertimerequest/listaddpayrollovertimerequest_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollOvertimeRequest(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'overtime_type_id' 					=> $this->input->post('overtime_type_id',true),
				'overtime_request_description'		=> $this->input->post('overtime_request_description',true),
				'overtime_request_date'				=> tgltodb($this->input->post('overtime_request_date',true)),
				'overtime_request_duration' 		=> $this->input->post('overtime_request_duration',true),
				'overtime_request_remark'			=> $this->input->post('overtime_request_remark',true),
				'overtime_request_approved' 		=> 1,
				'overtime_request_approved_id'		=> $auth['user_id'],
				'overtime_request_approved_on'		=> date("Y-m-d H:i:s"),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_request_description', 'Overtime Description', 'required');
			$this->form_validation->set_rules('overtime_type_id', 'Overtime Type', 'required');
			$this->form_validation->set_rules('overtime_request_duration', 'Overtime Duration', 'required');
			$this->form_validation->set_rules('overtime_request_date', 'Overtime Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollovertimerequest_model->saveNewPayrollOvertimeRequest($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOvertimeRequest.processAddPayrollOvertimeRequest',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Request Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollovertimerequest');
					redirect('payrollovertimerequest/addPayrollOvertimeRequest/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollovertimerequest',$data);
					redirect('payrollovertimerequest/addPayrollOvertimeRequest/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollovertimerequest',$data);
				redirect('payrollovertimerequest/addPayrollOvertimeRequest/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollovertimerequest_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollovertimerequest/editpayrollovertimerequest_view';
			$data['main_view']['employee']		= create_double($this->payrollovertimerequest_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->payrollovertimerequest_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollovertimerequest(){
			
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
				if($this->payrollovertimerequest_model->saveEditpayrollovertimerequest($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollovertimerequest.Edit',$auth['username'],'Edit Payroll Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Payroll Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollovertimerequest/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Payroll Request UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollovertimerequest/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimerequest/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deletePayrollOvertimeRequest(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollovertimerequest_model->deletePayrollOvertimeRequest($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollOvertimeRequest.delete',$auth['user_id'],'Delete Payroll Request');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Request Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimerequest');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Request UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimerequest');
			}
		}

		function deletePayrollOvertimeRequest_Data(){
			$employee_id = $this->uri->segment(3);
			$overtime_request_id = $this->uri->segment(4);

			if($this->payrollovertimerequest_model->deletePayrollOvertimeRequest_Data($overtime_request_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollOvertimeRequest_Data.delete',$auth['user_id'],'Delete Payroll Request');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Request Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimerequest/addPayrollOvertimeRequest/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Request UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimerequest/addPayrollOvertimeRequest/'.$employee_id);
			}
		}
	}
?>