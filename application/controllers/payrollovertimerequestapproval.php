<?php
	Class payrollovertimerequestapproval extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollovertimerequestapproval_model');
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



			$sesi	= 	$this->session->userdata('filter-payrollovertimerequestapproval');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollovertimerequestapproval_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollovertimerequestapproval_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollovertimerequestapproval_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollovertimerequestapproval_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_overtimeapproval']		= $this->payrollovertimerequestapproval_model->getHROEmployeeData_OvertimeApproval($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['overtimerequestapproved']	= $this->configuration->OvertimeRequestApproved;

			$data['main_view']['content']	= 'payrollovertimerequestapproval/listpayrollovertimerequestapproval_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollovertimerequestapproval',$data);
			redirect('payrollovertimerequestapproval');
		}
		
		public function editPayrollOvertimeRequestApproval(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']						= $this->payrollovertimerequestapproval_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollovertimerequestapproval_data']	= $this->payrollovertimerequestapproval_model->getPayrollOvertimeRequestApproval_Data($employee_id);
			$data['main_view']['approved']								= $this->configuration->Approved;

			$data['main_view']['content']								= 'payrollovertimerequestapproval/listeditpayrollovertimerequestapproval_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditPayrollOvertimeRequestApproval(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'overtime_request_id' 				=> $this->input->post('overtime_request_id',true),
				'overtime_request_approved' 		=> $this->input->post('overtime_request_approved',true),
				'overtime_request_approved_id'		=> $auth['user_id'],
				'overtime_request_approved_on'		=> date("Y-m-d H:i:s"),
				'overtime_request_approved_remark' 	=> $this->input->post('overtime_request_approved_remark',true),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('overtime_request_approved', 'Overtime Approved', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollovertimerequestapproval_model->saveEditPayrollOvertimeRequestApproval($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOvertimeRequestApproval.processEditPayrollOvertimeRequestApproval',$auth['user_id'],'Edit New Payroll Request Approval');
					$msg = "<div class='alert alert-success'>                
								Edit Data Payroll Request Approval Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollovertimerequestapproval');
					redirect('payrollovertimerequestapproval/');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollovertimerequestapproval',$data);
					redirect('payrollovertimerequestapproval/');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollovertimerequestapproval',$data);
				redirect('payrollovertimerequestapproval/');
			}
		}

	}
?>