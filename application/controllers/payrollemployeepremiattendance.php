<?php
	Class payrollemployeepremiattendance extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeepremiattendance_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollemployeepremiattendance');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeepremiattendance_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeepremiattendance_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeepremiattendance_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeepremiattendance_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_premiattendance']	= $this->payrollemployeepremiattendance_model->getHROEmployeeData_PremiAttendance($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeepremiattendance/listpayrollemployeepremiattendance_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeepremiattendance',$data);
			redirect('payrollemployeepremiattendance');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepremiattendance-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeepremiattendance-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeepremiattendance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeepremiattendance-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeepremiattendance');
			$this->session->unset_userdata('filter-payrollemployeepremiattendance');
			redirect('payrollemployeepremiattendance');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeepremiattendance-'.$sesi['unique']);	
			redirect('payrollemployeepremiattendance');
		}
		
		public function addPayrollEmployeePremiAttendance(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeepremiattendance_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeepremiattendance_data']	= $this->payrollemployeepremiattendance_model->getPayrollEmployeePremiAttendance_Data($employee_id);
			$data['main_view']['corepremiattendance']					= create_double($this->payrollemployeepremiattendance_model->getCorePremiAttendance(),'premi_attendance_id','premi_attendance_name');

			$data['main_view']['content']						= 'payrollemployeepremiattendance/listaddpayrollemployeepremiattendance_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollEmployeePremiAttendance(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'premi_attendance_id' 					=> $this->input->post('premi_attendance_id',true),
				'employee_premi_attendance_period'		=> $this->input->post('employee_premi_attendance_period',true),
				'employee_premi_attendance_description'	=> $this->input->post('employee_premi_attendance_description',true),
				'employee_premi_attendance_amount'		=> $this->input->post('employee_premi_attendance_amount',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('premi_attendance_id', 'Premi Attendance Name', 'required');
			$this->form_validation->set_rules('employee_premi_attendance_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_premi_attendance_description', 'Premi Attendance Description', 'required');
			$this->form_validation->set_rules('employee_premi_attendance_amount', 'Premi Attendance Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeepremiattendance_model->saveNewPayrollEmployeePremiAttendance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeePremiAttendance.processAddPayrollEmployeePremiAttendance',$auth['user_id'],'Add New Employee Premi Attendance');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Premi Attendance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeepremiattendance');
					redirect('payrollemployeepremiattendance/addPayrollEmployeePremiAttendance/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Premi Attendance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeepremiattendance',$data);
					redirect('payrollemployeepremiattendance/addPayrollEmployeePremiAttendance/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeepremiattendance',$data);
				redirect('payrollemployeepremiattendance/addPayrollEmployeePremiAttendance/'.$data['employee_id']);
			}
		}

		function deletePayrollEmployeePremiAttendance(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeepremiattendance_model->deletePayrollEmployeePremiAttendance($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeePremiAttendance.delete',$auth['user_id'],'Delete Employee Premi Attendance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Premi Attendance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepremiattendance');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Premi Attendance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepremiattendance');
			}
		}

		function deletePayrollEmployeePremiAttendance_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_payment_id = $this->uri->segment(4);

			if($this->payrollemployeepremiattendance_model->deletePayrollEmployeePremiAttendance_Data($employee_payment_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeePremiAttendance_Data.delete',$auth['user_id'],'Delete Employee Premi Attendance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Premi Attendance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepremiattendance/addPayrollEmployeePremiAttendance/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Premi Attendance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeepremiattendance/addPayrollEmployeePremiAttendance/'.$employee_id);
			}
		}
	}
?>