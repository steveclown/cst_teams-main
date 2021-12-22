<?php
	Class payrollglassesclaim extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollglassesclaim_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollglassesclaim');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->payrollglassesclaim_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']					= create_double($this->payrollglassesclaim_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']						= create_double($this->payrollglassesclaim_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']					= create_double($this->payrollglassesclaim_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_glassesclaim']		= $this->payrollglassesclaim_model->getHROEmployeeData_GlassesClaim($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'payrollglassesclaim/listpayrollglassesclaim_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollglassesclaim',$data);
			redirect('payrollglassesclaim');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollglassesclaim-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollglassesclaim-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollglassesclaim-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollglassesclaim-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollglassesclaim');
			$this->session->unset_userdata('filter-payrollglassesclaim');
			redirect('payrollglassesclaim');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollglassesclaim-'.$sesi['unique']);	
			redirect('payrollglassesclaim');
		}
		
		function addPayrollGlassesClaim(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollglassesclaim_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollglassesclaim_data']			= $this->payrollglassesclaim_model->getPayrollGlassesClaim_Data($employee_id);
			$data['main_view']['hroemployeeglassescoverage']		= create_double($this->payrollglassesclaim_model->getHROEmployeeGlassesCoverage($employee_id),'employee_glasses_coverage_id', 'glasses_coverage_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;
			$data['main_view']['content']							= 'payrollglassesclaim/listaddpayrollglassesclaim_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getGlassesCoverageLastBalance(){
			$employee_glasses_coverage_id = $this->input->post("employee_glasses_coverage_id");
			/*$employee_glasses_coverage_id = "11";*/
			$data = $this->payrollglassesclaim_model->getGlassesCoverageLastBalance($employee_glasses_coverage_id);
			/*print_r($data);exit;*/
			echo $data;
		}

		
		function processAddPayrollGlassesClaim(){
			$auth = $this->session->userdata('auth');
			$employee_glasses_coverage_id = $this->input->post('employee_glasses_coverage_id',true);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_glasses_coverage_id'	 	=> $employee_glasses_coverage_id,
				'glasses_coverage_id'	 			=> $this->payrollglassesclaim_model->getGlassesCoverageID($employee_glasses_coverage_id),
				'glasses_claim_period' 				=> $this->payrollglassesclaim_model->getCompanyCurrentPeriod(),
				'glasses_claim_date' 				=> tgltodb($this->input->post('glasses_claim_date',true)),
				'glasses_claim_description' 		=> $this->input->post('glasses_claim_description',true),
				'glasses_claim_opening_balance' 	=> $this->input->post('glasses_claim_opening_balance',true),
				'glasses_claim_amount'			 	=> $this->input->post('glasses_claim_amount',true),
				'glasses_claim_last_balance' 		=> $this->input->post('glasses_claim_last_balance',true),
				'glasses_claim_remark' 				=> $this->input->post('glasses_claim_remark',true),
				'data_state'						=> '0',
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('glasses_claim_date', 'Glasses Claim Date', 'required');
			$this->form_validation->set_rules('employee_glasses_coverage_id', 'Glasses Coverage Name', 'required');
			$this->form_validation->set_rules('glasses_claim_amount', 'Glasses Claim Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollglassesclaim_model->saveNewPayrollGlassesClaim($data)){
					$this->payrollglassesclaim_model->updateNewHROEmployeeGlassesCoverage($data, $employee_glasses_coverage_id);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollGlassesClaim.processAddPayrollGlassesClaim',$auth['user_id'],'Add New Payroll Glasses Claim');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Glasses Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollglassesclaim');
					redirect('payrollglassesclaim/addPayrollGlassesClaim/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Glasses Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollglassesclaim/addPayrollGlassesClaim/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addpayrollglassesclaim',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollglassesclaim/addPayrollGlassesClaim/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->payrollglassesclaim_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollglassesclaim/editpayrollglassesclaim_view';
			$data['main_view']['employee']		= create_double($this->payrollglassesclaim_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['glassescoverage']		= create_double($this->payrollglassesclaim_model->getglassescoverage(),'glasses_coverage_id','glasses_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditpayrollglassesclaim(){
			
			$data = array(
				'glasses_claim_id' 					=> $this->input->post('glasses_claim_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'glasses_coverage_id'	 			=> $this->input->post('glasses_coverage_id',true),
				'glasses_claim_date' 				=> $this->input->post('glasses_claim_date',true),
				'glasses_claim_opening_balance' 	=> $this->input->post('glasses_claim_opening_balance',true),
				'glasses_claim_amount'			 	=> $this->input->post('glasses_claim_amount',true),
				'glasses_claim_last_balance' 		=> $this->input->post('glasses_claim_last_balance',true),
				'glasses_claim_remark' 				=> $this->input->post('glasses_claim_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('glasses_coverage_id', 'Glasses Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->payrollglassesclaim_model->saveEditpayrollglassesclaim($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollglassesclaim.Edit',$auth['username'],'Edit Transactional Glasses Claim');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['glasses_claim_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Glasses Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollglassesclaim/Edit/'.$data['glasses_claim_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Glasses Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollglassesclaim/Edit/'.$data['glasses_claim_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollglassesclaim/Edit/'.$data['glasses_claim_id']);
			}
		}
		
		function deletePayrollGlassesClaim_Data(){
			$employee_id = $this->uri->segment(3);
			$glasses_claim_id = $this->uri->segment(4);

			if($this->payrollglassesclaim_model->deletePayrollGlassesClaim_Data($glasses_claim_id)){
				$this->payrollglassesclaim_model->updateDeleteHROEmployeeGlassesCoverage($glasses_claim_id);
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.payrollglassesclaim.delete',$auth['username'],'Delete payrollglassesclaim');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Glasses Claim Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollglassesclaim/addPayrollGlassesClaim/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Glasses Claim UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollglassesclaim/addPayrollGlassesClaim/'.$employee_id);
			}
		}
	}
?>