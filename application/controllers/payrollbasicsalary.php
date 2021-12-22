<?php
	Class payrollbasicsalary extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollbasicsalary_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollbasicsalary');
			if(!is_array($sesi)){
				$sesi['basic_salary_period']		= '';
			}

			$data['main_view']['monthlist']				= $this->configuration->Month;
			$data['main_view']['payrollbasicsalary']	= $this->payrollbasicsalary_model->getPayrollBasicSalary($region_id, $branch_id, $location_id, $sesi['basic_salary_period']);

			$data['main_view']['content']				= 'payrollbasicsalary/listpayrollbasicsalary_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'basic_salary_period'		=> $this->input->post('basic_salary_period',true),
			);
			$this->session->set_userdata('filter-payrollbasicsalary',$data);
			redirect('payrollbasicsalary');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollbasicsalary-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollbasicsalary-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollbasicsalary-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollbasicsalary-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function addPayrollBasicSalary(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['content']			= 'payrollbasicsalary/formaddpayrollbasicsalary_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollBasicSalary(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data = array(
				'region_id'							=> $region_id,
				'branch_id'							=> $branch_id,
				'location_id'						=> $location_id,
				'basic_salary_period'				=> $this->input->post('basic_salary_period', true),
				'basic_salary_total'				=> $this->input->post('basic_salary_total', true),
				'basic_salary_amount'				=> $this->input->post('basic_salary_amount', true),
				'meal_allowance_amount'				=> $this->input->post('meal_allowance_amount', true),
				'transport_allowance_amount'		=> $this->input->post('transport_allowance_amount', true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("YmdHis"),
			);
			
			/* print_r("data ");
			print_r($data);
			exit; */
			
			$this->form_validation->set_rules('basic_salary_period', 'Basic Salary Period', 'required');
			$this->form_validation->set_rules('basic_salary_total', 'Basic Salary Total', 'required');
			$this->form_validation->set_rules('basic_salary_amount', 'Basic Salary Amount', 'required');
			$this->form_validation->set_rules('meal_allowance_amount', 'Meal Allowance Amount', 'required');
			$this->form_validation->set_rules('transport_allowance_amount', 'Transport Allowance Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollbasicsalary_model->saveNewPayrollBasicSalary($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollBasicSalary.processAddPayrollBasicSalary',$auth['user_id'],'Add New Basic Salary');
					$msg = "<div class='alert alert-success'>                
								Add Data Basic Salary Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollbasicsalary');
					redirect('payrollbasicsalary/addPayrollBasicSalary');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Basic Salary UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpayrollbasicsalary',$data);
					redirect('payrollbasicsalary/addPayrollBasicSalary');
				}
			}else{
				$this->session->set_userdata('addpayrollbasicsalary',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollbasicsalary/addPayrollBasicSalary');
			}
		}
		
		public function editPayrollBasicSalary(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['payrollbasicsalary_data']	= $this->payrollbasicsalary_model->getPayrollBasicSalary_Data($this->uri->segment(3));

			$data['main_view']['content']					= 'payrollbasicsalary/formeditpayrollbasicsalary_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditPayrollBasicSalary(){
			
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data = array(
				'basic_salary_id'					=> $this->input->post('basic_salary_id', true),
				'region_id'							=> $region_id,
				'branch_id'							=> $branch_id,
				'location_id'						=> $location_id,
				'basic_salary_period'				=> $this->input->post('basic_salary_period', true),
				'basic_salary_total'				=> $this->input->post('basic_salary_total', true),
				'basic_salary_amount'				=> $this->input->post('basic_salary_amount', true),
				'meal_allowance_amount'				=> $this->input->post('meal_allowance_amount', true),
				'transport_allowance_amount'		=> $this->input->post('transport_allowance_amount', true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("YmdHis"),
			);
			
			/* print_r("data ");
			print_r($data);
			exit; */
			
			$this->form_validation->set_rules('basic_salary_period', 'Basic Salary Period', 'required');
			$this->form_validation->set_rules('basic_salary_total', 'Basic Salary Total', 'required');
			$this->form_validation->set_rules('basic_salary_amount', 'Basic Salary Amount', 'required');
			$this->form_validation->set_rules('meal_allowance_amount', 'Meal Allowance Amount', 'required');
			$this->form_validation->set_rules('transport_allowance_amount', 'Transport Allowance Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollbasicsalary_model->saveEditPayrollBasicSalary($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollBasicSalary.processEditPayrollBasicSalary',$auth['user_id'],'Edit Payroll Basic Salary');
					$msg = "<div class='alert alert-success'>                
								Edit Data Basic Salary Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollbasicsalary');
					redirect('payrollbasicsalary/editPayrollBasicSalary/'.$data['basic_salary_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Automatic  UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpayrollbasicsalary',$data);
					redirect('payrollbasicsalary/editPayrollBasicSalary/'.$data['basic_salary_id']);
				}
			}else{
				$this->session->set_userdata('addpayrollbasicsalary',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollbasicsalary/editPayrollBasicSalary/'.$data['basic_salary_id']);
			}
		}
		
				
		function deletePayrollBasicSalary(){
			$basic_salary_id = $this->uri->segment(3);	
			if($this->payrollbasicsalary_model->deletePayrollBasicSalary($basic_salary_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollBasicSalary.deletePayrollBasicSalary',$auth['user_id'],'Delete Payroll Basic Salary');
				$msg = "<div class='alert alert-success'>                
							Delete Data Basic Salary Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollbasicsalary');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Basic Salary UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollbasicsalary');
			}
		}
	}
?>