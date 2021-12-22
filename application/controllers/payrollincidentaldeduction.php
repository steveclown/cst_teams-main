<?php
	Class payrollincidentaldeduction extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollincidentaldeduction_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollincidentaldeduction');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollincidentaldeduction_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollincidentaldeduction_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollincidentaldeduction_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollincidentaldeduction_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_incidentaldeduction']		= $this->payrollincidentaldeduction_model->getHROEmployeeData_IncidentalDeduction($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollincidentaldeduction/listpayrollincidentaldeduction_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollincidentaldeduction',$data);
			redirect('payrollincidentaldeduction');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollincidentaldeduction-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollincidentaldeduction-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollincidentaldeduction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollincidentaldeduction-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollincidentaldeduction');
			$this->session->unset_userdata('filter-payrollincidentaldeduction');
			redirect('payrollincidentaldeduction');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollincidentaldeduction-'.$sesi['unique']);	
			redirect('payrollincidentaldeduction');
		}
		
		function addPayrollIncidentalDeduction(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollincidentaldeduction_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollincidentaldeduction_data']	= $this->payrollincidentaldeduction_model->getPayrollIncidentalDeduction_Data($employee_id);
			$data['main_view']['corededuction']						= create_double($this->payrollincidentaldeduction_model->getCoreDeduction(),'deduction_id', 'deduction_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;
			$data['main_view']['content']							= 'payrollincidentaldeduction/listaddpayrollincidentaldeduction_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollIncidentalDeduction(){
			$auth = $this->session->userdata('auth');

			$incidental_deduction_month = $this->input->post('incidental_deduction_month',true);
			$incidental_deduction_year 	= $this->input->post('incidental_deduction_year',true);
			$incidental_deduction_period = $incidental_deduction_year.$incidental_deduction_month;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'deduction_id' 						=> $this->input->post('deduction_id',true),
				'incidental_deduction_description'	=> $this->input->post('incidental_deduction_description',true),
				'incidental_deduction_period'		=> $incidental_deduction_period,
				'incidental_deduction_amount' 		=> $this->input->post('incidental_deduction_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;
			*/
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('incidental_deduction_description', 'Incidental Deduction Description', 'required');
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('incidental_deduction_amount', 'Incidental Deduction Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollincidentaldeduction_model->saveNewPayrollIncidentalDeduction($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollIncidentalDeduction.processAddPayrollIncidentalDeduction',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Incidental Deduction Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollincidentaldeduction');
					redirect('payrollincidentaldeduction/addPayrollIncidentalDeduction/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Incidental Deduction UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollincidentaldeduction',$data);
					redirect('payrollincidentaldeduction/addPayrollIncidentalDeduction/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollincidentaldeduction',$data);
				redirect('payrollincidentaldeduction/addPayrollIncidentalDeduction/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollincidentaldeduction_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollincidentaldeduction/editpayrollincidentaldeduction_view';
			$data['main_view']['employee']		= create_double($this->payrollincidentaldeduction_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->payrollincidentaldeduction_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollincidentaldeduction(){
			
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
				if($this->payrollincidentaldeduction_model->saveEditpayrollincidentaldeduction($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollincidentaldeduction.Edit',$auth['username'],'Edit Payroll Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Payroll Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollincidentaldeduction/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Payroll Request UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollincidentaldeduction/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollincidentaldeduction/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deletePayrollIncidentalDeduction(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollincidentaldeduction_model->deletePayrollIncidentalDeduction($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollIncidentalDeduction.deletePayrollIncidentalDeduction',$auth['user_id'],'Delete Payroll Incidental Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Incidental Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollincidentaldeduction');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Incidental Deduction UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollincidentaldeduction');
			}
		}

		function deletePayrollIncidentalDeduction_Data(){
			$employee_id = $this->uri->segment(3);
			$leave_request_id = $this->uri->segment(4);

			if($this->payrollincidentaldeduction_model->deletePayrollIncidentalDeduction_Data($leave_request_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollIncidentalDeduction_Data.deletePayrollIncidentalDeduction_Data',$auth['user_id'],'Delete Payroll Incidental Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Incidental Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollincidentaldeduction/addPayrollIncidentalDeduction/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Incidental Deduction UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollincidentaldeduction/addPayrollIncidentalDeduction/'.$employee_id);
			}
		}
	}
?>