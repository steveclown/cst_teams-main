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
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeecommission');
			if(!is_array($sesi)){
				$sesi['division_id']					= '';
				$sesi['department_id']					= '';
				$sesi['section_id']						= '';
				$sesi['employee_id']					= '';	
				$sesi['employee_commission_period']		= '';
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeecommission_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']			= create_double($this->payrollemployeecommission_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']				= create_double($this->payrollemployeecommission_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeecommission_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['payrollemployeecommission']	= $this->payrollemployeecommission_model->getPayrollEmployeeCommission($region_id, $branch_id, $location_id, $sesi['division_id'], $sesi['department_id'], $sesi['section_id'], $sesi['employee_id'], $sesi['employee_commission_period']);

			$data['main_view']['content']					= 'payrollemployeecommission/listpayrollemployeecommission_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeecommission',$data);
			redirect('payrollemployeecommission');
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
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeecommission-'.$unique['unique']);	
			$this->session->unset_userdata('addarraypayrollemployeecommission-'.$unique['unique']);	
			redirect('payrollemployeecommission/addPayrollEmployeeCommission');
		}
		
		public function addPayrollEmployeeCommission(){
			$data['main_view']['coredivision']			= create_double($this->payrollemployeecommission_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['payrollmonthlyperiod']	= create_double($this->payrollemployeecommission_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period');

			$data['main_view']['employeecommissionnonmmc']	= $this->configuration->EmployeeCommissionNonMMC;

			$data['main_view']['employeecommissionsales']	= $this->configuration->EmployeeCommissionSales;

			$data['main_view']['content']				= 'payrollemployeecommission/formaddpayrollemployeecommission_view';

			$this->load->view('mainpage_view',$data);
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
			$department_id 	= $this->input->post('department_id');
			
			$item = $this->payrollemployeecommission_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData(){
			$division_id 	= $this->input->post('division_id');
			$department_id 	= $this->input->post('department_id');
			$section_id 	= $this->input->post('section_id');
			
			$item = $this->payrollemployeecommission_model->getHROEmployeeData($division_id, $department_id, $section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function processAddArrayPayrollEmployeeCommission(){
			$employee_commission_omzet_mmc = $this->input->post('employee_commission_omzet_mmc', true);
			$employee_commission_omzet_acc = $this->input->post('employee_commission_omzet_acc', true);

			$employee_commission_total_omzet = $employee_commission_omzet_mmc + $employee_commission_omzet_acc;

			$data_payrollemployeecommissionitem = array(
				'division_id'						=> $this->input->post('division_id', true),
				'department_id'						=> $this->input->post('department_id', true),
				'section_id'						=> $this->input->post('section_id', true),
				'employee_id'						=> $this->input->post('employee_id', true),
				'employee_commission_omzet_mmc'		=> $this->input->post('employee_commission_omzet_mmc', true),
				'employee_commission_quantity_mmc'	=> $this->input->post('employee_commission_quantity_mmc', true),
				'employee_commission_omzet_acc'		=> $this->input->post('employee_commission_omzet_acc', true),
				'employee_commission_total_omzet'	=> $employee_commission_total_omzet,
				'employee_commission_non_mmc'		=> $this->input->post('employee_commission_non_mmc', true),
				'employee_commission_sales'			=> $this->input->post('employee_commission_sales', true),
			);

			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypayrollemployeecommission-'.$unique['unique']);
				
				$dataArrayHeader[$data_payrollemployeecommissionitem['employee_id']] = $data_payrollemployeecommissionitem;
				
				$this->session->set_userdata('addarraypayrollemployeecommission-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeecommissionitem = $this->session->userdata('addpayrollemployeecommission-'.$sesi['unique']);
				
				$data_payrollemployeecommissionitem['division_id'] 						= '';
				$data_payrollemployeecommissionitem['department_id'] 					= '';
				$data_payrollemployeecommissionitem['section_id'] 						= '';
				$data_payrollemployeecommissionitem['employee_id'] 						= '';
				$data_payrollemployeecommissionitem['employee_commission_omzet_mmc'] 	= '';
				$data_payrollemployeecommissionitem['employee_commission_quantity_mmc'] = '';
				$data_payrollemployeecommissionitem['employee_commission_omzet_acc'] 	= '';
				$data_payrollemployeecommissionitem['employee_commission_non_mmc'] 		= '';
				$data_payrollemployeecommissionitem['employee_commission_sales'] 		= '';
				
				$this->session->set_userdata('addpayrollemployeecommission-'.$sesi['unique'],$data_payrollemployeecommissionitem);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deletePayrollEmployeeCommission(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarraypayrollemployeecommission-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarraypayrollemployeecommission-'.$unique['unique'],$arrayBaru);
			
			redirect('payrollemployeecommission/addPayrollEmployeeCommission/');
		}

		public function processAddPayrollEmployeeCommission(){
			$auth = $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_commission_period'	=> $this->input->post('employee_commission_period',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s"),
			);

			$session_payrollemployeecommission		= $this->session->userdata('addarraypayrollemployeecommission-'.$unique['unique']);
			
			$this->form_validation->set_rules('employee_commission_period', 'Commission Period', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeecommission_model->insertPayrollEmployeeCommission($data)){
					$employee_commission_id = $this->payrollemployeecommission_model->getEmployeeCommissionID($data['created_id']);

					if (!empty($session_payrollemployeecommission)){
						$total_quantity_mmc = 0;
						foreach ($session_payrollemployeecommission as $key => $val) {
							$total_quantity_mmc = $total_quantity_mmc + $val['employee_commission_quantity_mmc'];	
							$data_payrollemployeecommissionitem = array (

							);
						}
					}


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeCommissionMMC.processAddPayrollEmployeeCommissionMMC',$auth['user_id'],'Add New Employee CommissionMMC');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee CommissionMMC Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeecommission');
					redirect('payrollemployeecommission/addPayrollEmployeeCommissionMMC/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee CommissionMMC UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeecommission',$data);
					redirect('payrollemployeecommission/addPayrollEmployeeCommissionMMC/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeecommission',$data);
				redirect('payrollemployeecommission/addPayrollEmployeeCommissionMMC/'.$data['employee_id']);
			}
		}









		
		

		public function deletePayrollEmployeeCommissionMMC(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeecommission_model->deletePayrollEmployeeCommissionMMC($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommissionMMC.delete',$auth['user_id'],'Delete Employee CommissionMMC');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee CommissionMMC Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee CommissionMMC UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission');
			}
		}

		public function deletePayrollEmployeeCommissionMMC_Data(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bonus_id 	= $this->uri->segment(4);

			if($this->payrollemployeecommission_model->deletePayrollEmployeeCommissionMMC_Data($employee_bonus_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommissionMMC_Data.delete',$auth['user_id'],'Delete Employee CommissionMMC');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee CommissionMMC Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission/addPayrollEmployeeCommissionMMC/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee CommissionMMC UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommission/addPayrollEmployeeCommissionMMC/'.$employee_id);
			}
		}
	}
?>