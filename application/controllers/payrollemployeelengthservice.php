<?php
	Class payrollemployeelengthservice extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeelengthservice_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeelengthservice');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeelengthservice_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeelengthservice_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeelengthservice_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeelengthservice_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_lengthservice']	= $this->payrollemployeelengthservice_model->getHROEmployeeData_LengthService($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeelengthservice/listpayrollemployeelengthservice_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeelengthservice',$data);
			redirect('payrollemployeelengthservice');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeelengthservice-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeelengthservice-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeelengthservice-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeelengthservice-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeelengthservice');
			$this->session->unset_userdata('filter-payrollemployeelengthservice');
			redirect('payrollemployeelengthservice');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeelengthservice-'.$sesi['unique']);	
			redirect('payrollemployeelengthservice');
		}
		
		public function addPayrollEmployeeLengthService(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']				= $this->payrollemployeelengthservice_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeelengthservice_data']	= $this->payrollemployeelengthservice_model->getPayrollEmployeeLengthService_Data($employee_id);
			$data['main_view']['corelengthservice']					= create_double($this->payrollemployeelengthservice_model->getCoreLengthService(),'length_service_id','length_service_name');

			$data['main_view']['content']						= 'payrollemployeelengthservice/listaddpayrollemployeelengthservice_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddPayrollEmployeeLengthService(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 							=> $this->input->post('employee_id',true),
				'length_service_id' 					=> $this->input->post('length_service_id',true),
				'employee_length_service_period'		=> $this->input->post('employee_length_service_period',true),
				'employee_length_service_description'	=> $this->input->post('employee_length_service_description',true),
				'employee_length_service_amount'		=> $this->input->post('employee_length_service_amount',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

		/*	print_r("data ");
			print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('length_service_id', 'Length Service Name', 'required');
			$this->form_validation->set_rules('employee_length_service_period', 'Period', 'required');
			$this->form_validation->set_rules('employee_length_service_description', 'Length Service Description', 'required');
			$this->form_validation->set_rules('employee_length_service_amount', 'Length Service Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeelengthservice_model->saveNewPayrollEmployeeLengthService($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeLengthService.processAddPayrollEmployeeLengthService',$auth['user_id'],'Add New Employee Length Service');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Length Service Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeelengthservice');
					redirect('payrollemployeelengthservice/addPayrollEmployeeLengthService/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Length Service UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeelengthservice',$data);
					redirect('payrollemployeelengthservice/addPayrollEmployeeLengthService/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeelengthservice',$data);
				redirect('payrollemployeelengthservice/addPayrollEmployeeLengthService/'.$data['employee_id']);
			}
		}

		function deletePayrollEmployeeLengthService(){
			$employee_id = $this->uri->segment(3);

			if($this->payrollemployeelengthservice_model->deletePayrollEmployeeLengthService($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLengthService.delete',$auth['user_id'],'Delete Employee Length Service');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Length Service Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelengthservice');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Length Service UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelengthservice');
			}
		}

		function deletePayrollEmployeeLengthService_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_payment_id = $this->uri->segment(4);

			if($this->payrollemployeelengthservice_model->deletePayrollEmployeeLengthService_Data($employee_payment_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeLengthService_Data.delete',$auth['user_id'],'Delete Employee Length Service');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Length Service Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelengthservice/addPayrollEmployeeLengthService/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Length Service UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeelengthservice/addPayrollEmployeeLengthService/'.$employee_id);
			}
		}
	}
?>