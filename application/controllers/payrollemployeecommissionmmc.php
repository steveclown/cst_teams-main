<?php
	Class payrollemployeecommissionmmc extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeecommissionmmc_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeecommissionmmc');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->payrollemployeecommissionmmc_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']					= create_double($this->payrollemployeecommissionmmc_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']						= create_double($this->payrollemployeecommissionmmc_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['hroemployeedata']					= create_double($this->payrollemployeecommissionmmc_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_commissionmmc']		= $this->payrollemployeecommissionmmc_model->getHROEmployeeData_CommissionMMC($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']							= 'payrollemployeecommissionmmc/listpayrollemployeecommissionmmc_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeecommissionmmc',$data);
			redirect('payrollemployeecommissionmmc');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommissionmmc-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeecommissionmmc-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommissionmmc-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeecommissionmmc-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeecommissionmmc');
			$this->session->unset_userdata('filter-payrollemployeecommissionmmc');
			redirect('payrollemployeecommissionmmc');
		}

		public function reset_session(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeecommissionmmc-'.$unique['unique']);	
			redirect('payrollemployeecommissionmmc');
		}
		
		public function addPayrollEmployeeCommissionMMC(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeecommissionmmc_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeecommissionmmc']	= $this->payrollemployeecommissionmmc_model->getPayrollEmployeeCommissionMMC_Data($employee_id);

			$data['main_view']['monthperiod']					= $this->configuration->Month;

			$data['main_view']['content']						= 'payrollemployeecommissionmmc/formaddpayrollemployeecommissionmmc_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeCommissionMMC(){
			$auth = $this->session->userdata('auth');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_commission_mmc_period = $year_period.$month_period;

			$job_title_id 					= $this->input->post('job_title_id',true);
			$employee_commission_mmc_omzet 	= $this->input->post('employee_commission_mmc_omzet',true);

			$corecommissionmmc = $this->payrollemployeecommissionmmc_model->getCoreCommissionMMC($job_title_id, $employee_commission_mmc_omzet);

			if (!empty($corecommissionmmc)){
				if ($commission_mmc_status == 0){
					$employee_commission_mmc_amount = $corecommissionmmc['commission_mmc_unit'] * $employee_commission_mmc_omzet / 100;
				} else {
					$employee_commission_mmc_amount = 0;
				}
			} else {
				$employee_commission_mmc_amount = 0;
			}

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'job_title_id' 							=> $this->input->post('job_title_id',true),
				'employee_commission_mmc_period'		=> $employee_commission_mmc_period,
				'employee_commission_mmc_omzet'			=> $employee_commission_mmc_omzet,
				'employee_commission_mmc_unit'			=> $corecommissionmmc['commission_mmc_unit'],
				'employee_commission_mmc_amount'		=> $employee_commission_mmc_amount,
				'commission_mmc_status'					=> $corecommissionmmc['commission_mmc_status'],
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
			$this->form_validation->set_rules('employee_commission_mmc_omzet', 'Commission MMC Omzet', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeecommissionmmc_model->insertPayrollEmployeeCommissionMMC($data)){


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeCommissionMMC.processAddPayrollEmployeeCommissionMMC',$auth['user_id'],'Add New Employee CommissionMMC');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee CommissionMMC Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeecommissionmmc');
					redirect('payrollemployeecommissionmmc/addPayrollEmployeeCommissionMMC/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee CommissionMMC UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeecommissionmmc',$data);
					redirect('payrollemployeecommissionmmc/addPayrollEmployeeCommissionMMC/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeecommissionmmc',$data);
				redirect('payrollemployeecommissionmmc/addPayrollEmployeeCommissionMMC/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeCommissionMMC(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeecommissionmmc_model->deletePayrollEmployeeCommissionMMC($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommissionMMC.delete',$auth['user_id'],'Delete Employee CommissionMMC');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee CommissionMMC Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionmmc');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee CommissionMMC UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionmmc');
			}
		}

		public function deletePayrollEmployeeCommissionMMC_Data(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bonus_id 	= $this->uri->segment(4);

			if($this->payrollemployeecommissionmmc_model->deletePayrollEmployeeCommissionMMC_Data($employee_bonus_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommissionMMC_Data.delete',$auth['user_id'],'Delete Employee CommissionMMC');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee CommissionMMC Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionmmc/addPayrollEmployeeCommissionMMC/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee CommissionMMC UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionmmc/addPayrollEmployeeCommissionMMC/'.$employee_id);
			}
		}
	}
?>