<?php
	Class PayrollEmployeeAdditionalCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('PayrollEmployeeAdditionalCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');

		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
		
			$sesi	= 	$this->session->userdata('filter-PayrollEmployeeAdditionalCkp');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
			}

			$data['Main_view']['coredivision']				= create_double($this->PayrollEmployeeAdditionalCkp_model->getCoreDivision(),'division_id','division_name');

			$data['Main_view']['hroemployeedata_daily']		= $this->PayrollEmployeeAdditionalCkp_model->getHROEmployeeData_Daily($region_id, $branch_id, $location_id, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['Main_view']['content']					= 'PayrollEmployeeAdditionalCkp/ListPayrollEmployeeAdditionalCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
			);
			$this->session->set_userdata('filter-PayrollEmployeeAdditionalCkp', $data);
			redirect('PayrollEmployeeAdditionalCkp');
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->PayrollEmployeeAdditionalCkp_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->PayrollEmployeeAdditionalCkp_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-PayrollEmployeeAdditionalCkp');
			$this->session->unset_userdata('filter-PayrollEmployeeAdditionalCkp');
			redirect('PayrollEmployeeAdditionalCkp');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addPayrollEmployeeAdditionalCkp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addPayrollEmployeeAdditionalCkp-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addPayrollEmployeeAdditionalCkp-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addPayrollEmployeeAdditionalCkp-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addPayrollEmployeeAdditionalCkp-'.$unique['unique']);	
			redirect('PayrollEmployeeAdditionalCkp');
		}
		
		public function addPayrollEmployeeAdditional(){
			$employee_id = $this->uri->segment(3);	

			$data['Main_view']['hroemployeedata']						= $this->PayrollEmployeeAdditionalCkp_model->getHROEmployeeData_Detail($employee_id);

			$data['Main_view']['corededuction']							= create_double($this->PayrollEmployeeAdditionalCkp_model->getCoreDeduction(),'deduction_id','deduction_name');

			$data['Main_view']['payrollemployeedelivery']				= $this->PayrollEmployeeAdditionalCkp_model->getPayrollEmployeeDelivery_Detail($employee_id);

			$data['Main_view']['payrollemployeeadditionaldeduction']	= $this->PayrollEmployeeAdditionalCkp_model->getPayrollEmployeeAdditionalDeduction_Detail($employee_id);

			$data['Main_view']['employeedeliverystatus']				= $this->configuration->DeliveryStatus();

			$data['Main_view']['coreovertimetype']						= create_double($this->PayrollEmployeeAdditionalCkp_model->getCoreOvertimeType(), 'overtime_type_id', 'overtime_type_name');

			$data['Main_view']['payrollemployeeadditionalovertime']		= $this->PayrollEmployeeAdditionalCkp_model->getPayrollEmployeeAdditionalOvertime_Detail($employee_id);

			$data['Main_view']['deliverydays']							= $this->configuration->DeliveryDays();

			$data['Main_view']['content']								= 'PayrollEmployeeAdditionalCkp/FormAddPayrollEmployeeAdditionalCkp_view';

			$this->load->view('MainPage_view',$data);
		}


		public function function_elements_add_delivery(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeedelivery-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeedelivery-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_delivery(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeedelivery-'.$unique['unique']);	
			redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$employee_id);
		}

		public function processAddPayrollEmployeeDelivery(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$employee_id 	= $this->input->post('employee_id',true);

			$job_title_id 	= $this->PayrollEmployeeAdditionalCkp_model->getJobTitleID($employee_id);
			
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'job_title_id' 						=> $job_title_id,
				'employee_delivery_date'			=> tgltodb($this->input->post('employee_delivery_date',true)),
				'employee_delivery_days'			=> $this->input->post('employee_delivery_days',true),
				'employee_delivery_description'		=> $this->input->post('employee_delivery_description',true),
				'employee_delivery_status'			=> $this->input->post('employee_delivery_status',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_delivery_days', 'Delivery Days', 'required');
			$this->form_validation->set_rules('employee_delivery_date', 'Delivery Date', 'required');
			$this->form_validation->set_rules('employee_delivery_description', 'Delivery Description', 'required');

			if($this->form_validation->run()==true){
				if($this->PayrollEmployeeAdditionalCkp_model->insertPayrollEmployeeDelivery($data)){
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDelivery.processAddPayrollEmployeeDelivery',$auth['user_id'],'Add New Employee Delivery');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Delivery Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_delivery',$msg);
					$this->session->unset_userdata('addpayrollemployeedelivery-'.$unique['unique']);	
					redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Delivery Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_delivery',$msg);
					$this->session->set_userdata('Addpayrollemployeedelivery',$data);
					redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_delivery',$msg);
				$this->session->set_userdata('Addpayrollemployeedelivery',$data);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeDelivery(){
			$employee_id 			= $this->uri->segment(3);
			$employee_delivery_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'				=> $employee_id,
				'employee_delivery_id'		=> $employee_delivery_id,
				'data_state'				=> 1
			);

			if($this->PayrollEmployeeAdditionalCkp_model->deletePayrollEmployeeDelivery($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDelivery_Data.delete',$auth['user_id'],'Delete Employee Delivery');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Delivery Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_delivery',$msg);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Delivery UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_delivery',$msg);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}


		public function function_elements_add_deduction(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeadditionaldeduction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeadditionaldeduction-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_deduction(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeadditionaldeduction-'.$unique['unique']);	
			redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$employee_id);
		}

		public function processAddPayrollEmployeeAdditionalDeduction(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 								=> $this->input->post('employee_id',true),
				'deduction_id' 								=> $this->input->post('deduction_id',true),
				'employee_additional_deduction_date'		=> tgltodb($this->input->post('employee_additional_deduction_date',true)),
				'employee_additional_deduction_description'	=> $this->input->post('employee_additional_deduction_description',true),
				'employee_additional_deduction_amount'		=> $this->input->post('employee_additional_deduction_amount',true),
				'data_state'								=> 0,
				'created_id'								=> $auth['user_id'],
				'created_on'								=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('deduction_id', 'Deduction', 'required');
			$this->form_validation->set_rules('employee_additional_deduction_date', 'Additional Deduction Date', 'required');
			$this->form_validation->set_rules('employee_additional_deduction_amount', 'Additional Deduction Amount', 'required');
			$this->form_validation->set_rules('employee_additional_deduction_description', 'Additional Deduction Description', 'required');

			if($this->form_validation->run()==true){
				if($this->PayrollEmployeeAdditionalCkp_model->insertPayrollEmployeeAdditionalDeduction($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDeduction.processAddPayrollEmployeeDeduction',$auth['user_id'],'Add New Employee Deduction');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Additional Deduction Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_deduction',$msg);
					$this->session->unset_userdata('addpayrollemployeeadditionaldeduction-'.$unique['unique']);	
					redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Additional Deduction Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_deduction',$msg);
					$this->session->set_userdata('Addpayrollemployeededuction',$data);
					redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_deduction',$msg);
				$this->session->set_userdata('Addpayrollemployeededuction',$data);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeAdditionalDeduction(){
			$employee_id 						= $this->uri->segment(3);
			$employee_additional_deduction_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'						=> $employee_id,
				'employee_additional_deduction_id'	=> $employee_additional_deduction_id,
				'data_state'						=> 1
			);

			if($this->PayrollEmployeeAdditionalCkp_model->deletePayrollEmployeeAdditionalDeduction($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeduction_Data.delete',$auth['user_id'],'Delete Employee Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Additional Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_deduction',$msg);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Additional Deduction Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_deduction',$msg);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function function_elements_add_overtime(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeeadditionalovertime-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeeadditionalovertime-'.$unique['unique'],$sessions);
		}
		
		public function reset_add_overtime(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeeadditionalovertime-'.$unique['unique']);	
			redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$employee_id);
		}

		public function processAddPayrollEmployeeAdditionalOvertime(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 								=> $this->input->post('employee_id',true),
				'overtime_type_id' 							=> $this->input->post('overtime_type_id',true),
				'employee_additional_overtime_date'			=> tgltodb($this->input->post('employee_additional_overtime_date',true)),
				'employee_additional_overtime_description'	=> $this->input->post('employee_additional_overtime_description',true),
				'employee_additional_overtime_amount'		=> $this->input->post('employee_additional_overtime_amount',true),
				'data_state'								=> 0,
				'created_id'								=> $auth['user_id'],
				'created_on'								=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_type_id', 'Overtime Type', 'required');
			$this->form_validation->set_rules('employee_additional_overtime_date', 'Additional Overtime Date', 'required');
			$this->form_validation->set_rules('employee_additional_overtime_amount', 'Additional Overtime Amount', 'required');
			$this->form_validation->set_rules('employee_additional_overtime_description', 'Additional Overtime Description', 'required');

			if($this->form_validation->run()==true){
				if($this->PayrollEmployeeAdditionalCkp_model->insertPayrollEmployeeAdditionalOvertime($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDeduction.processAddPayrollEmployeeDeduction',$auth['user_id'],'Add New Employee Overtime');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Additional Overtime Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_overtime',$msg);
					$this->session->unset_userdata('addpayrollemployeeadditionalovertime-'.$unique['unique']);	
					redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Additional Overtime Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_overtime',$msg);
					$this->session->set_userdata('Addpayrollemployeeovertime',$data);
					redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_overtime',$msg);
				$this->session->set_userdata('Addpayrollemployeeovertime',$data);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeAdditionalOvertime(){
			$employee_id 						= $this->uri->segment(3);
			$employee_additional_overtime_id 	= $this->uri->segment(4);

			$data = array (
				'employee_id'						=> $employee_id,
				'employee_additional_overtime_id'	=> $employee_additional_overtime_id,
				'data_state'						=> 1
			);

			if($this->PayrollEmployeeAdditionalCkp_model->deletePayrollEmployeeAdditionalOvertime($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeDeduction_Data.delete',$auth['user_id'],'Delete Employee Overtime');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Additional Overtime Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_overtime',$msg);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Additional Overtime Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_overtime',$msg);
				redirect('PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/'.$data['employee_id']);
			}
		}
		
	}
?>