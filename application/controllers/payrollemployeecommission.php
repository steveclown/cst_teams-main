<?php
	Class payrollemployeecommission extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeecommission_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];
			$branch_status 				= $auth['branch_status'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeecommission');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}
 
			$systemuserbranch									= $this->payrollemployeecommission_model->getSystemUserBranch($user_id);

			$data['main_view']['corebranch']					= create_double($this->payrollemployeecommission_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['coredivision']						= create_double($this->payrollemployeecommission_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_commission']		= $this->payrollemployeecommission_model->getHROEmployeeData_Commission($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']							= 'payrollemployeecommission/listpayrollemployeecommission_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),	
			);
			$this->session->set_userdata('filter-payrollemployeecommission',$data);
			redirect('payrollemployeecommission');
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->payrollemployeecommission_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->payrollemployeecommission_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeecommission-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeecommission-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeecommission');
			$this->session->unset_userdata('filter-payrollemployeecommission');
			redirect('payrollemployeecommission');
		}

		public function reset_add(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);	
			redirect('payrollemployeecommission/addPayrollEmployeeCommission/'.$employee_id);
		}
		
		public function addPayrollEmployeeCommission(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeecommission_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeecommission']	= $this->payrollemployeecommission_model->getPayrollEmployeeCommission_Data($employee_id);

			$data['main_view']['monthperiod']					= $this->configuration->Month;

			$data['main_view']['content']						= 'payrollemployeecommission/formaddpayrollemployeecommission_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeCommission(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_commission_period = $year_period.$month_period;

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'employee_commission_period'			=> $employee_commission_period,
				'employee_commission_omzet_mmc'			=> $this->input->post('employee_commission_omzet_mmc',true),
				'employee_commission_quantity_mmc'		=> $this->input->post('employee_commission_quantity_mmc',true),
				'employee_commission_omzet_acc'			=> $this->input->post('employee_commission_omzet_acc',true),
				'employee_commission_total_omzet'		=> $this->input->post('employee_commission_total_omzet',true),
				'employee_commission_amount_mmc'		=> $this->input->post('employee_commission_amount_mmc',true),
				'employee_commission_amount_acc'		=> $this->input->post('employee_commission_amount_acc',true),
				'employee_commission_total_amount'		=> $this->input->post('employee_commission_total_amount',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

			/*print_r("month_period ");
			print_r($month_period);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeecommission_model->insertPayrollEmployeeCommission($data)){


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeCommission.processAddPayrollEmployeeCommission',$auth['user_id'],'Add New Employee Commission');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Commission Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);
					redirect('payrollemployeecommission/addPayrollEmployeeCommission/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Commission UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeecommission',$data);
					redirect('payrollemployeecommission/addPayrollEmployeeCommission/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeecommission',$data);
				redirect('payrollemployeecommission/addPayrollEmployeeCommission/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeCommission(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeecommission_model->deletePayrollEmployeeCommission($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommission.delete',$auth['user_id'],'Delete Employee Commission');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Commission Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Commission UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission');
			}
		}

		public function deletePayrollEmployeeCommission_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_commission_id = $this->uri->segment(4);

			if($this->payrollemployeecommission_model->deletePayrollEmployeeCommission_Data($employee_commission_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommission_Data.delete',$auth['user_id'],'Delete Employee Commission');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Commission Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission/addPayrollEmployeeCommission/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Commission UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission/addPayrollEmployeeCommission/'.$employee_id);
			}
		}
	}
?>