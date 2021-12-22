<?php
	Class payrollemployeeinsurance extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeeinsurance_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeeinsurance');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeeinsurance_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeeinsurance_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeeinsurance_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeeinsurance_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_insurance']	= $this->payrollemployeeinsurance_model->getHROEmployeeData_Insurance($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeeinsurance/listpayrollemployeeinsurance_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeeinsurance',$data);
			redirect('payrollemployeeinsurance');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeinsurance-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeeinsurance-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeinsurance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeinsurance-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeeinsurance');
			$this->session->unset_userdata('filter-payrollemployeeinsurance');
			redirect('payrollemployeeinsurance');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeinsurance-'.$sesi['unique']);	
			redirect('payrollemployeeinsurance');
		}
		
		public function addPayrollEmployeeInsurance(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeeinsurance_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeeinsurance_data']	= $this->payrollemployeeinsurance_model->getPayrollEmployeeInsurance_Data($employee_id);
			$data['main_view']['coreinsurance']					= create_double($this->payrollemployeeinsurance_model->getCoreInsurance(),'insurance_id','insurance_name');
			$data['main_view']['coreinsurancepremi']			= create_double($this->payrollemployeeinsurance_model->getCoreInsurancePremi(),'insurance_premi_id','insurance_premi_code');

			$data['main_view']['content']						= 'payrollemployeeinsurance/listaddpayrollemployeeinsurance_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollEmployeeInsurance(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'insurance_id' 						=> $this->input->post('insurance_id',true),
				'insurance_premi_id' 				=> $this->input->post('insurance_premi_id',true),
				'employee_insurance_period'			=> $this->input->post('employee_insurance_period',true),
				'employee_insurance_description'	=> $this->input->post('employee_insurance_description',true),
				'employee_insurance_amount'			=> $this->input->post('employee_insurance_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('insurance_id', 'Insurance', 'required');
			$this->form_validation->set_rules('insurance_premi_id', 'Insurance Premi', 'required');
			$this->form_validation->set_rules('employee_insurance_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_insurance_description', 'Insurance Description', 'required');
			$this->form_validation->set_rules('employee_insurance_amount', 'Insurance Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeeinsurance_model->saveNewPayrollEmployeeInsurance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeInsurance.processAddPayrollEmployeeInsurance',$auth['user_id'],'Add New Employee Insurance');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Insurance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeeinsurance');
					redirect('payrollemployeeinsurance/addPayrollEmployeeInsurance/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Insurance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeeinsurance',$data);
					redirect('payrollemployeeinsurance/addPayrollEmployeeInsurance/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeeinsurance',$data);
				redirect('payrollemployeeinsurance/addPayrollEmployeeInsurance/'.$data['employee_id']);
			}
		}

		function deletePayrollEmployeeInsurance(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeeinsurance_model->deletePayrollEmployeeInsurance($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeInsurance.delete',$auth['user_id'],'Delete Employee Insurance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Insurance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeinsurance');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Insurance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeinsurance');
			}
		}

		function deletePayrollEmployeeInsurance_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_insurance_id = $this->uri->segment(4);

			if($this->payrollemployeeinsurance_model->deletePayrollEmployeeInsurance_Data($employee_insurance_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeInsurance_Data.delete',$auth['user_id'],'Delete Employee Insurance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Insurance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeinsurance/addPayrollEmployeeInsurance/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Insurance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeeinsurance/addPayrollEmployeeInsurance/'.$employee_id);
			}
		}
	}
?>