<?php
	Class payrollhospitalclaim extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollhospitalclaim_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollhospitalclaim');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->payrollhospitalclaim_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']					= create_double($this->payrollhospitalclaim_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']						= create_double($this->payrollhospitalclaim_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']					= create_double($this->payrollhospitalclaim_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_hospitalclaim']		= $this->payrollhospitalclaim_model->getHROEmployeeData_HospitalClaim($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollhospitalclaim/listpayrollhospitalclaim_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollhospitalclaim',$data);
			redirect('payrollhospitalclaim');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollhospitalclaim-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollhospitalclaim-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollhospitalclaim-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollhospitalclaim-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollhospitalclaim');
			$this->session->unset_userdata('filter-payrollhospitalclaim');
			redirect('payrollhospitalclaim');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollhospitalclaim-'.$sesi['unique']);	
			redirect('payrollhospitalclaim');
		}
		
		function addPayrollHospitalClaim(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollhospitalclaim_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollhospitalclaim_data']			= $this->payrollhospitalclaim_model->getPayrollHospitalClaim_Data($employee_id);
			$data['main_view']['hroemployeehospitalcoverage']		= create_double($this->payrollhospitalclaim_model->getHROEmployeeHospitalCoverage($employee_id),'employee_hospital_coverage_id', 'hospital_coverage_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;
			$data['main_view']['content']							= 'payrollhospitalclaim/listaddpayrollhospitalclaim_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getHospitalCoverageLastBalance(){
			$employee_hospital_coverage_id = $this->input->post("employee_hospital_coverage_id");
			/*$employee_hospital_coverage_id = "11";*/
			$data = $this->payrollhospitalclaim_model->getHospitalCoverageLastBalance($employee_hospital_coverage_id);
			/*print_r($data);exit;*/
			echo $data;
		}

		
		function processAddPayrollHospitalClaim(){
			$auth = $this->session->userdata('auth');
			$employee_hospital_coverage_id = $this->input->post('employee_hospital_coverage_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_hospital_coverage_id'	 	=> $employee_hospital_coverage_id,
				'hospital_coverage_id'	 			=> $this->payrollhospitalclaim_model->getHospitalCoverageID($employee_hospital_coverage_id),
				'hospital_claim_period' 				=> $this->payrollhospitalclaim_model->getCompanyCurrentPeriod(),
				'hospital_claim_date' 				=> tgltodb($this->input->post('hospital_claim_date',true)),
				'hospital_claim_description' 		=> $this->input->post('hospital_claim_description',true),
				'hospital_claim_opening_balance' 	=> $this->input->post('hospital_claim_opening_balance',true),
				'hospital_claim_amount'			 	=> $this->input->post('hospital_claim_amount',true),
				'hospital_claim_last_balance' 		=> $this->input->post('hospital_claim_last_balance',true),
				'hospital_claim_remark' 				=> $this->input->post('hospital_claim_remark',true),
				'data_state'						=> '0',
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('hospital_claim_date', 'Hospital Claim Date', 'required');
			$this->form_validation->set_rules('employee_hospital_coverage_id', 'Hospital Coverage Name', 'required');
			$this->form_validation->set_rules('hospital_claim_amount', 'Hospital Claim Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollhospitalclaim_model->saveNewPayrollHospitalClaim($data)){
					$this->payrollhospitalclaim_model->updateNewHROEmployeeHospitalCoverage($data, $employee_hospital_coverage_id);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollHospitalClaim.processAddPayrollHospitalClaim',$auth['user_id'],'Add New Payroll Hospital Claim');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Hospital Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollhospitalclaim');
					redirect('payrollhospitalclaim/addPayrollHospitalClaim/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Hospital Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollhospitalclaim/addPayrollHospitalClaim/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addpayrollhospitalclaim',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollhospitalclaim/addPayrollHospitalClaim/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollhospitalclaim_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollhospitalclaim/editpayrollhospitalclaim_view';
			$data['main_view']['employee']		= create_double($this->payrollhospitalclaim_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['hospitalcoverage']		= create_double($this->payrollhospitalclaim_model->gethospitalcoverage(),'hospital_coverage_id','hospital_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollhospitalclaim(){
			
			$data = array(
				'hospital_claim_id' 					=> $this->input->post('hospital_claim_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'hospital_coverage_id'	 			=> $this->input->post('hospital_coverage_id',true),
				'hospital_claim_date' 				=> $this->input->post('hospital_claim_date',true),
				'hospital_claim_opening_balance' 	=> $this->input->post('hospital_claim_opening_balance',true),
				'hospital_claim_amount'			 	=> $this->input->post('hospital_claim_amount',true),
				'hospital_claim_last_balance' 		=> $this->input->post('hospital_claim_last_balance',true),
				'hospital_claim_remark' 				=> $this->input->post('hospital_claim_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('hospital_coverage_id', 'Hospital Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->payrollhospitalclaim_model->saveEditpayrollhospitalclaim($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollhospitalclaim.Edit',$auth['username'],'Edit Transactional Hospital Claim');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['hospital_claim_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Hospital Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollhospitalclaim/Edit/'.$data['hospital_claim_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Hospital Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollhospitalclaim/Edit/'.$data['hospital_claim_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollhospitalclaim/Edit/'.$data['hospital_claim_id']);
			}
		}
		
		function deletePayrollHospitalClaim_Data(){
			$employee_id = $this->uri->segment(3);
			$hospital_claim_id = $this->uri->segment(4);

			if($this->payrollhospitalclaim_model->deletePayrollHospitalClaim_Data($hospital_claim_id)){
				$this->payrollhospitalclaim_model->updateDeleteHROEmployeeHospitalCoverage($hospital_claim_id);
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.payrollhospitalclaim.delete',$auth['username'],'Delete payrollhospitalclaim');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Hospital Claim Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollhospitalclaim/addPayrollHospitalClaim/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Hospital Claim UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollhospitalclaim/addPayrollHospitalClaim/'.$employee_id);
			}
		}
	}
?>