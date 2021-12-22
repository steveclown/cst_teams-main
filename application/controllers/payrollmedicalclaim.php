<?php
	Class payrollmedicalclaim extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollmedicalclaim_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollmedicalclaim');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->payrollmedicalclaim_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']					= create_double($this->payrollmedicalclaim_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']						= create_double($this->payrollmedicalclaim_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']					= create_double($this->payrollmedicalclaim_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_medicalclaim']		= $this->payrollmedicalclaim_model->getHROEmployeeData_MedicalClaim($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollmedicalclaim/listpayrollmedicalclaim_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollmedicalclaim',$data);
			redirect('payrollmedicalclaim');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollmedicalclaim-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollmedicalclaim-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollmedicalclaim-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollmedicalclaim-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollmedicalclaim');
			$this->session->unset_userdata('filter-payrollmedicalclaim');
			redirect('payrollmedicalclaim');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollmedicalclaim-'.$sesi['unique']);	
			redirect('payrollmedicalclaim');
		}
		
		function addPayrollMedicalClaim(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollmedicalclaim_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollmedicalclaim_data']			= $this->payrollmedicalclaim_model->getPayrollMedicalClaim_Data($employee_id);
			$data['main_view']['hroemployeemedicalcoverage']		= create_double($this->payrollmedicalclaim_model->getHROEmployeeMedicalCoverage($employee_id),'employee_medical_coverage_id', 'medical_coverage_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;
			$data['main_view']['content']							= 'payrollmedicalclaim/listaddpayrollmedicalclaim_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getMedicalCoverageLastBalance(){
			$employee_medical_coverage_id = $this->input->post("employee_medical_coverage_id");
			/*$employee_medical_coverage_id = "11";*/
			$data = $this->payrollmedicalclaim_model->getMedicalCoverageLastBalance($employee_medical_coverage_id);
			/*print_r($data);exit;*/
			echo $data;
		}

		
		function processAddPayrollMedicalClaim(){
			$auth = $this->session->userdata('auth');
			$employee_medical_coverage_id = $this->input->post('employee_medical_coverage_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_medical_coverage_id'	 	=> $employee_medical_coverage_id,
				'medical_coverage_id'	 			=> $this->payrollmedicalclaim_model->getMedicalCoverageID($employee_medical_coverage_id),
				'medical_claim_period' 				=> $this->payrollmedicalclaim_model->getCompanyCurrentPeriod(),
				'medical_claim_date' 				=> tgltodb($this->input->post('medical_claim_date',true)),
				'medical_claim_description' 		=> $this->input->post('medical_claim_description',true),
				'medical_claim_opening_balance' 	=> $this->input->post('medical_claim_opening_balance',true),
				'medical_claim_amount'			 	=> $this->input->post('medical_claim_amount',true),
				'medical_claim_last_balance' 		=> $this->input->post('medical_claim_last_balance',true),
				'medical_claim_remark' 				=> $this->input->post('medical_claim_remark',true),
				'data_state'						=> '0',
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('medical_claim_date', 'Medical Claim Date', 'required');
			$this->form_validation->set_rules('employee_medical_coverage_id', 'Medical Coverage Name', 'required');
			$this->form_validation->set_rules('medical_claim_amount', 'Medical Claim Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollmedicalclaim_model->saveNewPayrollMedicalClaim($data)){
					$this->payrollmedicalclaim_model->updateNewHROEmployeeMedicalCoverage($data, $employee_medical_coverage_id);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollMedicalClaim.processAddPayrollMedicalClaim',$auth['user_id'],'Add New Payroll Medical Claim');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Medical Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollmedicalclaim');
					redirect('payrollmedicalclaim/addPayrollMedicalClaim/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Medical Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollmedicalclaim/addPayrollMedicalClaim/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addpayrollmedicalclaim',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollmedicalclaim/addPayrollMedicalClaim/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollmedicalclaim_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollmedicalclaim/editpayrollmedicalclaim_view';
			$data['main_view']['employee']		= create_double($this->payrollmedicalclaim_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['medicalcoverage']		= create_double($this->payrollmedicalclaim_model->getmedicalcoverage(),'medical_coverage_id','medical_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollmedicalclaim(){
			
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
				if($this->payrollmedicalclaim_model->saveEditpayrollmedicalclaim($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollmedicalclaim.Edit',$auth['username'],'Edit Transactional Medical Claim');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['medical_claim_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Medical Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollmedicalclaim/Edit/'.$data['medical_claim_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Medical Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollmedicalclaim/Edit/'.$data['medical_claim_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollmedicalclaim/Edit/'.$data['medical_claim_id']);
			}
		}
		
		function deletePayrollMedicalClaim_Data(){
			$employee_id = $this->uri->segment(3);
			$medical_claim_id = $this->uri->segment(4);

			if($this->payrollmedicalclaim_model->deletePayrollMedicalClaim_Data($medical_claim_id)){
				$this->payrollmedicalclaim_model->updateDeleteHROEmployeeMedicalCoverage($medical_claim_id);
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.payrollmedicalclaim.delete',$auth['username'],'Delete payrollmedicalclaim');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Medical Claim Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollmedicalclaim/addPayrollMedicalClaim/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Medical Claim UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollmedicalclaim/addPayrollMedicalClaim/'.$employee_id);
			}
		}
	}
?>