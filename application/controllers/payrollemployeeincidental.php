<?php
	Class payrollemployeeincidental extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeincidental_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollemployeeincidental');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->payrollemployeeincidental_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_incidental']	= $this->payrollemployeeincidental_model->getHROEmployeeData_Incidental($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'payrollemployeeincidental/listpayrollemployeeincidental_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->payrollemployeeincidental_model->getCoreDepartment($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->payrollemployeeincidental_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$division_id 				= $this->input->post('division_id');
			$department_id 				= $this->input->post('department_id');
			$section_id 				= $this->input->post('section_id');
			
			$item = $this->payrollemployeeincidental_model->getHROEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $payroll_employee_level);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeincidental',$data);
			redirect('payrollemployeeincidental');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeincidental-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeeincidental-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeincidental-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeincidental-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeeincidental');
			$this->session->unset_userdata('filter-payrollemployeeincidental');
			redirect('payrollemployeeincidental');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeincidental-'.$sesi['unique']);	
			redirect('payrollemployeeincidental');
		}
		
		function addPayrollEmployeeIncidental(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollemployeeincidental_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeeincidental_data']	= $this->payrollemployeeincidental_model->getPayrollIncidentalAllowance_Data($employee_id);
			$data['main_view']['coreallowance']						= create_double($this->payrollemployeeincidental_model->getCoreAllowance(),'allowance_id', 'allowance_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;
			$data['main_view']['content']							= 'payrollemployeeincidental/formaddpayrollemployeeincidental_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollIncidentalAllowance(){
			$auth = $this->session->userdata('auth');

			$incidental_allowance_month = $this->input->post('incidental_allowance_month',true);
			$incidental_allowance_year 	= $this->input->post('incidental_allowance_year',true);
			$incidental_allowance_period = $incidental_allowance_year.$incidental_allowance_month;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'allowance_id' 						=> $this->input->post('allowance_id',true),
				'incidental_allowance_description'	=> $this->input->post('incidental_allowance_description',true),
				'incidental_allowance_period'		=> $incidental_allowance_period,
				'incidental_allowance_amount' 		=> $this->input->post('incidental_allowance_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;
			*/
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('incidental_allowance_description', 'Incidental Allowance Description', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allowance Name', 'required');
			$this->form_validation->set_rules('incidental_allowance_amount', 'Incidental Allowance Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollemployeeincidental_model->saveNewPayrollIncidentalAllowance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollIncidentalAllowance.processAddPayrollIncidentalAllowance',$auth['user_id'],'Add New Payroll Request');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Incidental Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeeincidental');
					redirect('payrollemployeeincidental/addPayrollIncidentalAllowance/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Incidental Allowance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeeincidental',$data);
					redirect('payrollemployeeincidental/addPayrollIncidentalAllowance/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeeincidental',$data);
				redirect('payrollemployeeincidental/addPayrollIncidentalAllowance/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollemployeeincidental_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollemployeeincidental/editpayrollemployeeincidental_view';
			$data['main_view']['employee']		= create_double($this->payrollemployeeincidental_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->payrollemployeeincidental_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollemployeeincidental(){
			
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
				if($this->payrollemployeeincidental_model->saveEditpayrollemployeeincidental($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollemployeeincidental.Edit',$auth['username'],'Edit Payroll Request');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Payroll Request Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeincidental/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Payroll Request UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollemployeeincidental/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincidental/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deletePayrollIncidentalAllowance(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeincidental_model->deletePayrollIncidentalAllowance($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollIncidentalAllowance.deletePayrollIncidentalAllowance',$auth['user_id'],'Delete Payroll Incidental Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Incidental Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincidental');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Incidental Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincidental');
			}
		}

		function deletePayrollIncidentalAllowance_Data(){
			$employee_id = $this->uri->segment(3);
			$leave_request_id = $this->uri->segment(4);

			if($this->payrollemployeeincidental_model->deletePayrollIncidentalAllowance_Data($leave_request_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollIncidentalAllowance_Data.deletePayrollIncidentalAllowance_Data',$auth['user_id'],'Delete Payroll Incidental Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Incidental Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincidental/addPayrollIncidentalAllowance/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Incidental Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeincidental/addPayrollIncidentalAllowance/'.$employee_id);
			}
		}
	}
?>