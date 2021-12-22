<?php
	Class hroemployeehospitalcoverage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeehospitalcoverage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeehospitalcoverage');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeehospitalcoverage_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeehospitalcoverage_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeehospitalcoverage_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeehospitalcoverage_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_hospitalcoverage']		= $this->hroemployeehospitalcoverage_model->getHROEmployeeData_HospitalCoverage($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeehospitalcoverage/listhroemployeehospitalcoverage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeehospitalcoverage',$data);
			redirect('hroemployeehospitalcoverage');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeehospitalcoverage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeehospitalcoverage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeehospitalcoverage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeehospitalcoverage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeehospitalcoverage');
			$this->session->unset_userdata('filter-hroemployeehospitalcoverage');
			redirect('hroemployeehospitalcoverage');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeehospitalcoverage-'.$sesi['unique']);	
			redirect('hroemployeehospitalcoverage');
		}
		
		function addHROEmployeeHospitalCoverage(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->hroemployeehospitalcoverage_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeehospitalcoverage_data']	= $this->hroemployeehospitalcoverage_model->getHROEmployeeHospitalCoverage_Data($employee_id);
			$data['main_view']['corehospitalcoverage']				= create_double($this->hroemployeehospitalcoverage_model->getCoreHospitalCoverage($employee_id),'hospital_coverage_id','hospital_coverage_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;

			$data['main_view']['content']							= 'hroemployeehospitalcoverage/listaddhroemployeehospitalcoverage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getHospitalCoverageAmount(){
			$hospital_coverage_id = $this->input->post("hospital_coverage_id");
			// $hospital_coverage_id = "1";
			$data = $this->hroemployeehospitalcoverage_model->getHospitalCoverageAmount($hospital_coverage_id);
			// print_r($data);exit;
			echo $data;
		}
		
		function processAddHROEmployeeHospitalCoverage(){
			$auth = $this->session->userdata('auth');

			$hospital_month_from				= $this->input->post('hospital_month_from',true);
			$hospital_year_from 				= $this->input->post('hospital_year_from',true);
			$hospital_coverage_period 			= $this->hroemployeehospitalcoverage_model->getCompanyCurrentPeriod();

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'hospital_coverage_id' 				=> $this->input->post('hospital_coverage_id',true),
				'hospital_coverage_period' 			=> $hospital_coverage_period,
				'hospital_coverage_amount' 			=> $this->input->post('hospital_coverage_amount',true),
				'hospital_coverage_claimed' 			=> '',
				'hospital_coverage_last_balance' 	=> $this->input->post('hospital_coverage_amount',true),
				'hospital_coverage_remark' 			=> $this->input->post('hospital_coverage_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('hospital_coverage_id', 'Hospital Coverage name', 'required');
			$this->form_validation->set_rules('hospital_coverage_amount', 'Hospital Coverage Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeehospitalcoverage_model->saveNewhroemployeehospitalcoverage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.hroemployeehospitalcoverage.processAddHroEmployeeHospitalCoverage',$auth['username'],'Add New Employee Hospital Coverage');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Hospital Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeHospitalCoverage');
					redirect('hroemployeehospitalcoverage/addHROEmployeeHospitalCoverage/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Hospital Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeehospitalcoverage/addHROEmployeeHospitalCoverage/'.$data['employee_id']);
				}
			}else{
				$this->session->set_userdata('AddHroEmployeeHospitalCoverage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehospitalcoverage/AddHroEmployeeHospitalCoverage/'.$data['employee_id']);
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
			$data['main_view']['result']		= $this->hroemployeehospitalcoverage_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeehospitalcoverage/edithroemployeehospitalcoverage_view';
			$data['main_view']['hospitalcoverage']		= create_double($this->hroemployeehospitalcoverage_model->gethospitalcoverage(),'hospital_coverage_id','hospital_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeehospitalcoverage(){
			
			$data = array(
				'employee_hospital_coverage_id' 		=> $this->input->post('employee_hospital_coverage_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'hospital_coverage_id' 				=> $this->input->post('hospital_coverage_id',true),
				'hospital_coverage_period' 			=> $this->input->post('hospital_coverage_period',true),
				'hospital_coverage_amount' 			=> $this->input->post('hospital_coverage_amount',true),
				'hospital_coverage_claimed' 			=> $this->input->post('hospital_coverage_claimed',true),
				'hospital_coverage_last_balance' 	=> $this->input->post('hospital_coverage_last_balance',true),
				'hospital_coverage_remark' 			=> $this->input->post('hospital_coverage_remark',true),
				'data_state'						=> '0',
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('hospital_coverage_id', 'Hospital Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeehospitalcoverage_model->saveEdithroemployeehospitalcoverage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeehospitalcoverage.Edit',$auth['username'],'Edit Employee Hospital Coverage');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_hospital_coverage_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Hospital Coverage Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Hospital Coverage UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeehospitalcoverage/Edit/'.$data['employee_hospital_coverage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehospitalcoverage/Edit/'.$data['employee_hospital_coverage_id']);
			}
		}
		
		function deleteHROEmployeeHospitalCoverage(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeehospitalcoverage_model->deleteHROEmployeeHospitalCoverage()){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeHospitalCoverage.delete',$auth['user_id'],'Delete HROEmployeeHospitalCoverage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Hospital Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehospitalcoverage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Hospital Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehospitalcoverage');
			}
		}

		function deleteHROEmployeeHospitalCoverage_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_hospital_coverage_id = $this->uri->segment(4);

			if($this->hroemployeehospitalcoverage_model->deleteHROEmployeeHospitalCoverage_Data($employee_hospital_coverage_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeHospitalCoverage_Data.delete',$auth['user_id'],'Delete HROEmployeeHospitalCoverage_Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Hospital Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehospitalcoverage/addHROEmployeeHospitalCoverage/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Hospital Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeehospitalcoverage/AddHroEmployeeHospitalCoverage/'.$employee_id);
			}
		}
	}
?>