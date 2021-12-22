<?php
	Class hroemployeemedicalcoverage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeemedicalcoverage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeemedicalcoverage');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeemedicalcoverage_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeemedicalcoverage_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeemedicalcoverage_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeemedicalcoverage_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_medicalcoverage']		= $this->hroemployeemedicalcoverage_model->getHROEmployeeData_MedicalCoverage($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeemedicalcoverage/listhroemployeemedicalcoverage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeemedicalcoverage',$data);
			redirect('hroemployeemedicalcoverage');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeemedicalcoverage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeemedicalcoverage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeemedicalcoverage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeemedicalcoverage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeemedicalcoverage');
			$this->session->unset_userdata('filter-hroemployeemedicalcoverage');
			redirect('hroemployeemedicalcoverage');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeemedicalcoverage-'.$sesi['unique']);	
			redirect('hroemployeemedicalcoverage');
		}
		
		function addHROEmployeeMedicalCoverage(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->hroemployeemedicalcoverage_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeemedicalcoverage_data']	= $this->hroemployeemedicalcoverage_model->getHROEmployeeMedicalCoverage_Data($employee_id);
			$data['main_view']['coremedicalcoverage']				= create_double($this->hroemployeemedicalcoverage_model->getCoreMedicalCoverage($employee_id),'medical_coverage_id','medical_coverage_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;

			$data['main_view']['content']							= 'hroemployeemedicalcoverage/listaddhroemployeemedicalcoverage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getcoverageamount(){
			$medical_coverage_id = $this->input->post("medical_coverage_id");
			// $medical_coverage_id = "1";
			$data = $this->hroemployeemedicalcoverage_model->getcoverageamount($medical_coverage_id);
			// print_r($data);exit;
			echo $data;
		}
		
		function processAddHROEmployeeMedicalCoverage(){
			$auth = $this->session->userdata('auth');

			$medical_month_from				= $this->input->post('medical_month_from',true);
			$medical_year_from 				= $this->input->post('medical_year_from',true);
			$medical_coverage_period 		= $this->hroemployeemedicalcoverage_model->getCompanyCurrentPeriod();

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'medical_coverage_id' 				=> $this->input->post('medical_coverage_id',true),
				'medical_coverage_period' 			=> $medical_coverage_period,
				'medical_coverage_amount' 			=> $this->input->post('medical_coverage_amount',true),
				'medical_coverage_claimed' 			=> '',
				'medical_coverage_last_balance' 	=> $this->input->post('medical_coverage_amount',true),
				'medical_coverage_remark' 			=> $this->input->post('medical_coverage_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('medical_coverage_id', 'Medical Coverage name', 'required');
			$this->form_validation->set_rules('medical_coverage_amount', 'Medical Coverage Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeemedicalcoverage_model->saveNewhroemployeemedicalcoverage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.hroemployeemedicalcoverage.processAddHroEmployeeMedicalCoverage',$auth['username'],'Add New Employee Medical Coverage');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Medical Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeMedicalCoverage');
					redirect('hroemployeemedicalcoverage/addHROEmployeeMedicalCoverage/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Medical Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeemedicalcoverage/addHROEmployeeMedicalCoverage/'.$data['employee_id']);
				}
			}else{
				$this->session->set_userdata('AddHroEmployeeMedicalCoverage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeemedicalcoverage/AddHroEmployeeMedicalCoverage/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['employee_id']		= $employee_id;
			$data['main_view']['result']		= $this->hroemployeemedicalcoverage_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeemedicalcoverage/edithroemployeemedicalcoverage_view';
			$data['main_view']['medicalcoverage']		= create_double($this->hroemployeemedicalcoverage_model->getmedicalcoverage(),'medical_coverage_id','medical_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeemedicalcoverage(){
			
			$data = array(
				'employee_medical_coverage_id' 		=> $this->input->post('employee_medical_coverage_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'medical_coverage_id' 				=> $this->input->post('medical_coverage_id',true),
				'medical_coverage_period' 			=> $this->input->post('medical_coverage_period',true),
				'medical_coverage_amount' 			=> $this->input->post('medical_coverage_amount',true),
				'medical_coverage_claimed' 			=> $this->input->post('medical_coverage_claimed',true),
				'medical_coverage_last_balance' 	=> $this->input->post('medical_coverage_last_balance',true),
				'medical_coverage_remark' 			=> $this->input->post('medical_coverage_remark',true),
				'data_state'						=> '0',
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('medical_coverage_id', 'Medical Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeemedicalcoverage_model->saveEdithroemployeemedicalcoverage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeemedicalcoverage.Edit',$auth['username'],'Edit Employee Medical Coverage');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_medical_coverage_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Medical Coverage Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Medical Coverage UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeemedicalcoverage/Edit/'.$data['employee_medical_coverage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeemedicalcoverage/Edit/'.$data['employee_medical_coverage_id']);
			}
		}
		
		function deleteHROEmployeeMedicalCoverage(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeemedicalcoverage_model->deleteHROEmployeeMedicalCoverage()){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeMedicalCoverage.delete',$auth['user_id'],'Delete HROEmployeeMedicalCoverage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Medical Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeemedicalcoverage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Medical Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeemedicalcoverage');
			}
		}

		function deleteHROEmployeeMedicalCoverage_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_medical_coverage_id = $this->uri->segment(4);

			if($this->hroemployeemedicalcoverage_model->deleteHROEmployeeMedicalCoverage_Data($employee_medical_coverage_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeMedicalCoverage_Data.delete',$auth['user_id'],'Delete HROEmployeeMedicalCoverage_Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Medical Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeemedicalcoverage/addHROEmployeeMedicalCoverage/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Medical Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeemedicalcoverage/AddHroEmployeeMedicalCoverage/'.$employee_id);
			}
		}
	}
?>