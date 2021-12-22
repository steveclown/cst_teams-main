<?php
	Class payrollonoutbpjs extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollonoutbpjs_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollonoutbpjs');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->payrollonoutbpjs_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']				= create_double($this->payrollonoutbpjs_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']					= create_double($this->payrollonoutbpjs_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']				= create_double($this->payrollonoutbpjs_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_onoutbpjs']		= $this->payrollonoutbpjs_model->getHROEmployeeData_OnOutBPJS($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'payrollonoutbpjs/listpayrollonoutbpjs_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollonoutbpjs',$data);
			redirect('payrollonoutbpjs');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollonoutbpjs-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollonoutbpjs-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollonoutbpjs-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollonoutbpjs-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollonoutbpjs');
			$this->session->unset_userdata('filter-payrollonoutbpjs');
			redirect('payrollonoutbpjs');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollonoutbpjs-'.$sesi['unique']);	
			redirect('payrollonoutbpjs');
		}
		
		public function addPayrollOnOutBPJS(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollonoutbpjs_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollonoutbpjs_data']			= $this->payrollonoutbpjs_model->getPayrollOnOutBPJS_Data($employee_id);
			$data['main_view']['bpjsstatus']					= $this->configuration->BPJSStatus;
			$data['main_view']['content']						= 'payrollonoutbpjs/listaddpayrollonoutbpjs_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddPayrollOnOutBPJS(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'bpjs_in_date' 						=> tgltodb($this->input->post('bpjs_in_date',true)),
				'bpjs_reported_salary'		 		=> $this->input->post('bpjs_reported_salary',true),
				'bpjs_total_amount' 				=> $this->input->post('bpjs_total_amount',true),
				'bpjs_kesehatan_status'			 	=> $this->input->post('bpjs_kesehatan_status',true),
				'bpjs_kesehatan_no' 				=> $this->input->post('bpjs_kesehatan_no',true),
				'bpjs_kesehatan_percentage' 		=> $this->input->post('bpjs_kesehatan_percentage',true),
				'bpjs_kesehatan_amount' 			=> $this->input->post('bpjs_kesehatan_amount',true),
				'bpjs_tenagakerja_status'			=> $this->input->post('bpjs_tenagakerja_status',true),
				'bpjs_tenagakerja_no' 				=> $this->input->post('bpjs_tenagakerja_no',true),
				'bpjs_tenagakerja_percentage' 		=> $this->input->post('bpjs_tenagakerja_percentage',true),
				'bpjs_tenagakerja_amount' 			=> $this->input->post('bpjs_tenagakerja_amount',true),
				'bpjs_remark'			 			=> $this->input->post('bpjs_remark',true),
				'bpjs_out_status'		 			=> $this->input->post('bpjs_out_status',true),
				'bpjs_out_date' 					=> tgltodb($this->input->post('bpjs_tenagakerja_amount',true)),
				'bpjs_out_id' 						=> $auth['user_id'],
				'bpjs_out_on'						=> date("Y-m-d H:i:s"),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('bpjs_reported_salary', 'Reportd Salary', 'required');
			$this->form_validation->set_rules('bpjs_total_amount', 'BPJS Total Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollonoutbpjs_model->saveNewPayrollOnOutBPJS($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOnOutBPJS.processAddPayrollOnOutBPJS',$auth['user_id'],'Add New Payroll On Out BPJS');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll On Out BPJS Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollonoutbpjs');
					redirect('payrollonoutbpjs/addPayrollOnOutBPJS/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll On Out BPJS UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollonoutbpjs/addPayrollOnOutBPJS/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addpayrollonoutbpjs',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollonoutbpjs/addPayrollOnOutBPJS/'.$data['employee_id']);
			}
		}
		
		public function Edit(){
			$data['main_view']['result']		= $this->payrollonoutbpjs_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'payrollonoutbpjs/editpayrollonoutbpjs_view';
			$data['main_view']['employee']		= create_double($this->payrollonoutbpjs_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['medicalcoverage']		= create_double($this->payrollonoutbpjs_model->getmedicalcoverage(),'medical_coverage_id','medical_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditpayrollonoutbpjs(){
			
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
				if($this->payrollonoutbpjs_model->saveEditpayrollonoutbpjs($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.payrollonoutbpjs.Edit',$auth['username'],'Edit Transactional Medical Claim');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['medical_claim_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Medical Claim Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollonoutbpjs/Edit/'.$data['medical_claim_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Medical Claim UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollonoutbpjs/Edit/'.$data['medical_claim_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('payrollonoutbpjs/Edit/'.$data['medical_claim_id']);
			}
		}
		
		public function deletePayrollOnOutBPJS_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_bpjs_id = $this->uri->segment(4);

			if($this->payrollonoutbpjs_model->deletePayrollOnOutBPJS_Data($employee_bpjs_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.payrollonoutbpjs.deletePayrollOnOutBPJS_Data',$auth['user_id'],'Delete Payroll On Out BPJS');
				$msg = "<div class='alert alert-success'>                
							Delete Data On Out BPJS Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollonoutbpjs/addPayrollOnOutBPJS/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data On Out BPJS UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollonoutbpjs/addPayrollOnOutBPJS/'.$employee_id);
			}
		}
	}
?>