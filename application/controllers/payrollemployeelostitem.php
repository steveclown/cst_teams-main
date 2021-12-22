<?php
	Class payrollemployeelostitem extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeelostitem_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		 
		public function index(){
			$auth = $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];
			$branch_status 				= $auth['branch_status'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeelostitem');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}

			$systemuserbranch								= $this->payrollemployeelostitem_model->getSystemUserBranch($user_id);

			$data['main_view']['corebranch']				= create_double($this->payrollemployeelostitem_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['coredivision']				= create_double($this->payrollemployeelostitem_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_lostitem']	= $this->payrollemployeelostitem_model->getHROEmployeeData_LostItem($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeelostitem/listpayrollemployeelostitem_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),	
			);
			$this->session->set_userdata('filter-payrollemployeelostitem',$data);
			redirect('payrollemployeelostitem');
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->payrollemployeelostitem_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->payrollemployeelostitem_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeelostitem-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeelostitem-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeelostitem-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeelostitem-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeelostitem');
			$this->session->unset_userdata('filter-payrollemployeelostitem');
			redirect('payrollemployeelostitem');
		}

		public function reset_add(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addpayrollemployeelostitem-'.$unique['unique']);	
			redirect('payrollemployeelostitem/addPayrollEmployeeLostItem/'.$employee_id);
		}
		
		public function addPayrollEmployeeLostItem(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeelostitem_model->getHROEmployeeData($employee_id);

			$data['main_view']['payrollemployeelostitem']	= $this->payrollemployeelostitem_model->getPayrollEmployeeLostItem_Data($employee_id);

			$data['main_view']['corelostitem']					= create_double($this->payrollemployeelostitem_model->getCoreLostItem(),'lost_item_id','lost_item_name');

			$data['main_view']['monthperiod']					= $this->configuration->Month;

			$data['main_view']['content']						= 'payrollemployeelostitem/formaddpayrollemployeelostitem_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeLostItem(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$year_period 	= $this->input->post('year_period',true);
			$month_period 	= $this->input->post('month_period',true);

			$employee_lost_item_period = $year_period.$month_period;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'lost_item_id' 						=> $this->input->post('lost_item_id',true),
				'employee_lost_item_period'			=> $employee_lost_item_period,
				'employee_lost_item_description'	=> $this->input->post('employee_lost_item_description',true),
				'employee_lost_item_amount'			=> $this->input->post('employee_lost_item_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r("month_period ");
			print_r($month_period);
			print_r("<BR>");
			print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('lost_item_id', 'Lost Item Name', 'required');
			$this->form_validation->set_rules('employee_lost_item_description', 'Lost Item Description', 'required');
			$this->form_validation->set_rules('employee_lost_item_amount', 'Lost Item Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeelostitem_model->insertPayrollEmployeeLostItem($data)){

					/*print_r("month_period ");
					print_r($month_period);
					print_r("<BR>");
					print_r("data ");
					print_r($data);
					exit;*/

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeLostItem.processAddPayrollEmployeeLostItem',$auth['user_id'],'Add New Employee Lost Item');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Lost Item Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addpayrollemployeelostitem-'.$unique['unique']);
					redirect('payrollemployeelostitem/addPayrollEmployeeLostItem/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Lost Item UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeelostitem',$data);
					redirect('payrollemployeelostitem/addPayrollEmployeeLostItem/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeelostitem',$data);
				redirect('payrollemployeelostitem/addPayrollEmployeeLostItem/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeLostItem(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeelostitem_model->deletePayrollEmployeeLostItem($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLostItem.delete',$auth['user_id'],'Delete Employee Lost Item');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Lost Item Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelostitem');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Lost Item UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelostitem');
			}
		}

		public function deletePayrollEmployeeLostItem_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_lost_item_id 	= $this->uri->segment(4);

			if($this->payrollemployeelostitem_model->deletePayrollEmployeeLostItem_Data($employee_lost_item_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLostItem_Data.delete',$auth['user_id'],'Delete Employee Lost Item');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Lost Item Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelostitem/addPayrollEmployeeLostItem/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Lost Item UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelostitem/addPayrollEmployeeLostItem/'.$employee_id);
			}
		}
	}
?>