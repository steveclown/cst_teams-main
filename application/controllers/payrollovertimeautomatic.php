<?php
	Class payrollovertimeautomatic extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollovertimeautomatic_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollovertimeautomatic');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
			}

			$data['main_view']['coredivision']				= create_double($this->payrollovertimeautomatic_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollovertimeautomatic_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollovertimeautomatic_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['payrollovertimeautomatic']	= $this->payrollovertimeautomatic_model->getPayrollOvertimeAutomatic($region_id, $branch_id, $location_id, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollovertimeautomatic/listpayrollovertimeautomatic_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollovertimeautomatic',$data);
			redirect('payrollovertimeautomatic');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimeautomatic-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollovertimeautomatic-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollovertimeautomatic-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollovertimeautomatic-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function addPayrollOvertimeAutomatic(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['coredivision']				= create_double($this->payrollovertimeautomatic_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollovertimeautomatic_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollovertimeautomatic_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['dailyname']					= $this->configuration->DailyName;

			$data['main_view']['content']	= 'payrollovertimeautomatic/formaddpayrollovertimeautomatic_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollOvertimeAutomatic(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data = array(
				'payroll_overtime_automatic_id'		=> date("YmdHis"),
				'region_id'							=> $region_id,
				'branch_id'							=> $branch_id,
				'location_id'						=> $location_id,
				'division_id'						=> $this->input->post('division_id', true),
				'department_id'						=> $this->input->post('department_id', true),
				'section_id'						=> $this->input->post('section_id', true),
				'overtime_automatic_start_date'		=> tgltodb($this->input->post('overtime_automatic_start_date', true)),
				'overtime_automatic_end_date'		=> tgltodb($this->input->post('overtime_automatic_end_date', true)),
				'overtime_automatic_duration'		=> $this->input->post('overtime_automatic_duration', true),
				'overtime_automatic_daily_name'		=> $this->input->post('overtime_automatic_daily_name', true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("YmdHis"),
			);
			
			/* print_r("data ");
			print_r($data);
			exit; */
			
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('overtime_automatic_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('overtime_automatic_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('overtime_automatic_daily_name', 'Daily Name', 'required');
			$this->form_validation->set_rules('overtime_automatic_duration', 'Duration', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollovertimeautomatic_model->saveNewPayrollOvertimeAutomatic($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOvertimeAutomatic.processAddPayrollOvertimeAutomatic',$auth['user_id'],'Add New Overtime Automatic');
					$msg = "<div class='alert alert-success'>                
								Add Data Overtime Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollovertimeautomatic');
					redirect('payrollovertimeautomatic/addPayrollOvertimeAutomatic');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Automatic  UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpayrollovertimeautomatic',$data);
					redirect('payrollovertimeautomatic/addPayrollOvertimeAutomatic');
				}
			}else{
				$this->session->set_userdata('addpayrollovertimeautomatic',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomatic/addPayrollOvertimeAutomatic');
			}
		}
		
		public function editPayrollOvertimeAutomatic(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['coredivision']				= create_double($this->payrollovertimeautomatic_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollovertimeautomatic_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollovertimeautomatic_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['dailyname']					= $this->configuration->DailyName;

			$data['main_view']['payrollovertimeautomatic_data']	= $this->payrollovertimeautomatic_model->getPayrollOvertimeAutomatic_Data($this->uri->segment(3));

			$data['main_view']['content']					= 'payrollovertimeautomatic/formeditpayrollovertimeautomatic_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditPayrollOvertimeAutomatic(){
			
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data = array(
				'overtime_automatic_id'				=> $this->input->post('overtime_automatic_id', true),
				'region_id'							=> $region_id,
				'branch_id'							=> $branch_id,
				'location_id'						=> $location_id,
				'division_id'						=> $this->input->post('division_id', true),
				'department_id'						=> $this->input->post('department_id', true),
				'section_id'						=> $this->input->post('section_id', true),
				'overtime_automatic_start_date'		=> tgltodb($this->input->post('overtime_automatic_start_date', true)),
				'overtime_automatic_end_date'		=> tgltodb($this->input->post('overtime_automatic_end_date', true)),
				'overtime_automatic_duration'		=> $this->input->post('overtime_automatic_duration', true),
				'overtime_automatic_daily_name'		=> $this->input->post('overtime_automatic_daily_name', true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("YmdHis"),
			);
			
			/* print_r("data ");
			print_r($data);
			exit; */
			
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('overtime_automatic_start_date', 'Start Date', 'required');
			$this->form_validation->set_rules('overtime_automatic_end_date', 'End Date', 'required');
			$this->form_validation->set_rules('overtime_automatic_daily_name', 'Daily Name', 'required');
			$this->form_validation->set_rules('overtime_automatic_duration', 'Duration', 'required');
			
			if($this->form_validation->run()==true){
				if($this->payrollovertimeautomatic_model->saveEditPayrollOvertimeAutomatic($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollOvertimeAutomatic.processEditPayrollOvertimeAutomatic',$auth['user_id'],'Edit Overtime Automatic');
					$msg = "<div class='alert alert-success'>                
								Edit Data Overtime Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrollovertimeautomatic');
					redirect('payrollovertimeautomatic/editPayrollOvertimeAutomatic/'.$data['overtime_automatic_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Automatic  UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpayrollovertimeautomatic',$data);
					redirect('payrollovertimeautomatic/editPayrollOvertimeAutomatic/'.$data['overtime_automatic_id']);
				}
			}else{
				$this->session->set_userdata('addpayrollovertimeautomatic',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomatic/editPayrollOvertimeAutomatic/'.$data['overtime_automatic_id']);
			}
		}
		
				
		function deletePayrollOvertimeAutomatic(){
			$overtime_automatic_id = $this->uri->segment(3);	
			if($this->payrollovertimeautomatic_model->deletePayrollOvertimeAutomatic($overtime_automatic_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollOvertimeAutomatic.deletePayrollOvertimeAutomatic',$auth['user_id'],'Delete PayrollOvertimeAutomatic');
				$msg = "<div class='alert alert-success'>                
							Delete Data Overtime Automatic Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomatic');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Overtime Automatic UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollovertimeautomatic');
			}
		}
	}
?>