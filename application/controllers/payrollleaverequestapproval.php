<?php
	Class payrollleaverequestapproval extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollleaverequestapproval_model');
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


			$sesi	= 	$this->session->userdata('filter-payrollleaverequestapproval');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->payrollleaverequestapproval_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']				= create_double($this->payrollleaverequestapproval_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']					= create_double($this->payrollleaverequestapproval_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']				= create_double($this->payrollleaverequestapproval_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_leaveapproval']	= $this->payrollleaverequestapproval_model->getHROEmployeeData_LeaveApproval($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['leaverequestapproved']			= $this->configuration->LeaveRequestApproved;

			$data['main_view']['content']						= 'payrollleaverequestapproval/listpayrollleaverequestapproval_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollleaverequestapproval',$data);
			redirect('payrollleaverequestapproval');
		}
		
		public function editPayrollLeaveRequestApproval(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->payrollleaverequestapproval_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollleaverequestapproval_data']	= $this->payrollleaverequestapproval_model->getPayrollLeaveRequestApproval_Data($employee_id);
			$data['main_view']['leaverequestapproved']				= $this->configuration->LeaveRequestApproved;

			$data['main_view']['content']							= 'payrollleaverequestapproval/listeditpayrollleaverequestapproval_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditPayrollLeaveRequestApproval(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 					=> $this->input->post('employee_id',true),
				'leave_request_id' 				=> $this->input->post('leave_request_id',true),
				'leave_request_approved' 		=> $this->input->post('leave_request_approved',true),
				'leave_request_approved_id'		=> $auth['user_id'],
				'leave_request_approved_on'		=> date("Y-m-d H:i:s"),
				'leave_request_approved_remark' => $this->input->post('leave_request_approved_remark',true),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('leave_request_approved', 'Leave Approved', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollleaverequestapproval_model->saveEditPayrollLeaveRequestApproval($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollLeaveRequestApproval.processEditPayrollLeaveRequestApproval',$auth['user_id'],'Edit New Payroll Request Approval');
					$msg = "<div class='alert alert-success'>                
								Edit Data Payroll Request Approval Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollleaverequestapproval');
					redirect('payrollleaverequestapproval/');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Request UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollleaverequestapproval',$data);
					redirect('payrollleaverequestapproval/');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollleaverequestapproval',$data);
				redirect('payrollleaverequestapproval/');
			}
		}

	}
?>