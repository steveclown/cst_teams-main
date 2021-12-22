<?php
	Class payrollemployeecommissionacc extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeecommissionacc_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeecommissionacc');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']						= create_double($this->payrollemployeecommissionacc_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']					= create_double($this->payrollemployeecommissionacc_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']						= create_double($this->payrollemployeecommissionacc_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['hroemployeedata']					= create_double($this->payrollemployeecommissionacc_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_commissionacc']		= $this->payrollemployeecommissionacc_model->getHROEmployeeData_CommissionAcc($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']							= 'payrollemployeecommissionacc/listpayrollemployeecommissionacc_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeecommissionacc',$data);
			redirect('payrollemployeecommissionacc');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommissionacc-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeecommissionacc-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeecommissionacc-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeecommissionacc-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeecommissionacc');
			$this->session->unset_userdata('filter-payrollemployeecommissionacc');
			redirect('payrollemployeecommissionacc');
		}

		public function reset_session(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeecommissionacc-'.$unique['unique']);	
			redirect('payrollemployeecommissionacc');
		}
		
		public function addPayrollEmployeeCommissionAcc(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeecommissionacc_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeecommissionacc']	= $this->payrollemployeecommissionacc_model->getPayrollEmployeeCommissionAcc_Data($employee_id);

			$data['main_view']['monthperiod']					= $this->configuration->Month;

			$data['main_view']['content']						= 'payrollemployeecommissionacc/formaddpayrollemployeecommissionacc_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeCommissionAcc(){
			$auth = $this->session->userdata('auth');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_commission_acc_period = $year_period.$month_period;

			$job_title_id 					= $this->input->post('job_title_id',true);
			$employee_commission_acc_omzet 	= $this->input->post('employee_commission_acc_omzet',true);

			$corecommissionacc = $this->payrollemployeecommissionacc_model->getCoreCommissionAcc($job_title_id, $employee_commission_acc_omzet);

			if (!empty($corecommissionacc)){
				if ($commission_acc_status == 0){
					$employee_commission_acc_amount = $corecommissionacc['commission_acc_percentage'] * $employee_commission_acc_omzet / 100;
				} else {
					$employee_commission_acc_amount = 0;
				}
			} else {
				$employee_commission_acc_amount = 0;
			}

			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'job_title_id' 							=> $this->input->post('job_title_id',true),
				'employee_commission_acc_period'		=> $employee_commission_acc_period,
				'employee_commission_acc_omzet'			=> $employee_commission_acc_omzet,
				'employee_commission_acc_percentage'	=> $corecommissionacc['commission_acc_percentage'],
				'employee_commission_acc_amount'		=> $employee_commission_acc_amount,
				'commission_acc_status'					=> $corecommissionacc['commission_acc_status'],
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
			$this->form_validation->set_rules('employee_commission_acc_omzet', 'Commission Acc Omzet', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeecommissionacc_model->insertPayrollEmployeeCommissionAcc($data)){


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeCommissionAcc.processAddPayrollEmployeeCommissionAcc',$auth['user_id'],'Add New Employee CommissionAcc');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee CommissionAcc Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeecommissionacc');
					redirect('payrollemployeecommissionacc/addPayrollEmployeeCommissionAcc/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee CommissionAcc UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeecommissionacc',$data);
					redirect('payrollemployeecommissionacc/addPayrollEmployeeCommissionAcc/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeecommissionacc',$data);
				redirect('payrollemployeecommissionacc/addPayrollEmployeeCommissionAcc/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeCommissionAcc(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeecommissionacc_model->deletePayrollEmployeeCommissionAcc($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommissionAcc.delete',$auth['user_id'],'Delete Employee CommissionAcc');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee CommissionAcc Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionacc');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee CommissionAcc UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionacc');
			}
		}

		public function deletePayrollEmployeeCommissionAcc_Data(){
			$employee_id 		= $this->uri->segment(3);
			$employee_bonus_id 	= $this->uri->segment(4);

			if($this->payrollemployeecommissionacc_model->deletePayrollEmployeeCommissionAcc_Data($employee_bonus_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeCommissionAcc_Data.delete',$auth['user_id'],'Delete Employee CommissionAcc');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee CommissionAcc Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionacc/addPayrollEmployeeCommissionAcc/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee CommissionAcc UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeecommissionacc/addPayrollEmployeeCommissionAcc/'.$employee_id);
			}
		}
	}
?>