<?php
	Class payrollovertimeautomaticexception extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollovertimeautomaticexception_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollovertimeautomaticexception');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->payrollovertimeautomaticexception_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']					= create_double($this->payrollovertimeautomaticexception_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']						= create_double($this->payrollovertimeautomaticexception_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']					= create_double($this->payrollovertimeautomaticexception_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_overtimeexception']	= $this->payrollovertimeautomaticexception_model->getHROEmployeeData_OvertimeException($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollovertimeautomaticexception/listpayrollovertimeautomaticexception_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollovertimeautomaticexception',$data);
			redirect('payrollovertimeautomaticexception');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimeautomaticexception-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollovertimeautomaticexception-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimeautomaticexception-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollovertimeautomaticexception-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollovertimeautomaticexception');
			$this->session->unset_userdata('filter-payrollovertimeautomaticexception');
			redirect('payrollovertimeautomaticexception');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollovertimeautomaticexception-'.$sesi['unique']);	
			redirect('payrollovertimeautomaticexception');
		}
		
		public function addPayrollOvertimeAutomaticException(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']							= $this->payrollovertimeautomaticexception_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollovertimeautomaticexception_data']	= $this->payrollovertimeautomaticexception_model->getPayrollOvertimeAutomaticException_Data($employee_id);
			$data['main_view']['content']									= 'payrollovertimeautomaticexception/listaddpayrollovertimeautomaticexception_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollOvertimeAutomaticException(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'overtime_automatic_exception_date'		=> tgltodb($this->input->post('overtime_automatic_exception_date',true)),
				'overtime_automatic_exception_remark' 	=> $this->input->post('overtime_automatic_exception_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_automatic_exception_date', 'Exception Date', 'required');
			$this->form_validation->set_rules('overtime_automatic_exception_remark', 'Exception Remark', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollovertimeautomaticexception_model->saveNewPayrollOvertimeAutomaticException($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOvertimeAutomaticException.processAddPayrollOvertimeAutomaticException',$auth['user_id'],'Add New Overtime Automatic Exception');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Overtime Automatic Exception Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollovertimeautomaticexception');
					redirect('payrollovertimeautomaticexception/addPayrollOvertimeAutomaticException/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Medical Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollovertimeautomaticexception/addPayrollOvertimeAutomaticException/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addpayrollovertimeautomaticexception',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomaticexception/addPayrollOvertimeAutomaticException/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollovertimeautomaticexception_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollovertimeautomaticexception/editpayrollovertimeautomaticexception_view';
			$data['main_view']['employee']		= create_double($this->payrollovertimeautomaticexception_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['medicalcoverage']		= create_double($this->payrollovertimeautomaticexception_model->getmedicalcoverage(),'medical_coverage_id','medical_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollovertimeautomaticexception(){
			
			$data = array(
				'medical_claim_id' 					=> $this->input->post('medical_claim_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'medical_coverage_id'	 			=> $this->input->post('medical_coverage_id',true),
				'medical_claim_date' 				=> $this->input->post('medical_claim_date',true),
				'medical_claim_opening_balance' 	=> $this->input->post('medical_claim_opening_balance',true),
				'medical_claim_amount'			 	=> $this->input->post('medical_claim_amount',true),
				'medical_claim_last_balance' 		=> $this->input->post('medical_claim_last_balance',true),
				'medical_claim_remark' 				=> $this->input->post('medical_claim_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('medical_coverage_id', 'Medical Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->payrollovertimeautomaticexception_model->saveEditpayrollovertimeautomaticexception($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollovertimeautomaticexception.Edit',$auth['username'],'Edit Transactional Medical Claim');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['medical_claim_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Medical Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollovertimeautomaticexception/Edit/'.$data['medical_claim_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Medical Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollovertimeautomaticexception/Edit/'.$data['medical_claim_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomaticexception/Edit/'.$data['medical_claim_id']);
			}
		}
		
		function deletePayrollOvertimeAutomaticException_Data(){
			$employee_id = $this->uri->segment(3);
			$overtime_automatic_exception_id = $this->uri->segment(4);

			if($this->payrollovertimeautomaticexception_model->deletePayrollOvertimeAutomaticException_Data($overtime_automatic_exception_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollOvertimeAutomaticException.deletePayrollOvertimeAutomaticException_Data',$auth['user_id'],'Delete Payroll Overtime Automatic Exception');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Overtime Automatic Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomaticexception/addPayrollOvertimeAutomaticException/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Overtime Automatic UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomaticexception/addPayrollOvertimeAutomaticException/'.$employee_id);
			}
		}
	}
?>