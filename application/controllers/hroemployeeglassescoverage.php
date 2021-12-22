<?php
	Class hroemployeeglassescoverage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeglassescoverage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeglassescoverage');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeglassescoverage_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeglassescoverage_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeglassescoverage_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeglassescoverage_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_glassescoverage']		= $this->hroemployeeglassescoverage_model->getHROEmployeeData_GlassesCoverage($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeglassescoverage/listhroemployeeglassescoverage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeglassescoverage',$data);
			redirect('hroemployeeglassescoverage');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeglassescoverage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeglassescoverage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeglassescoverage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeglassescoverage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeglassescoverage');
			$this->session->unset_userdata('filter-hroemployeeglassescoverage');
			redirect('hroemployeeglassescoverage');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeglassescoverage-'.$sesi['unique']);	
			redirect('hroemployeeglassescoverage');
		}
		
		function addHROEmployeeGlassesCoverage(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']					= $this->hroemployeeglassescoverage_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeglassescoverage_data']	= $this->hroemployeeglassescoverage_model->getHROEmployeeGlassesCoverage_Data($employee_id);
			$data['main_view']['coreglassescoverage']				= create_double($this->hroemployeeglassescoverage_model->getCoreGlassesCoverage($employee_id),'glasses_coverage_id','glasses_coverage_name');
			$data['main_view']['monthlist']							= $this->configuration->Month;

			$data['main_view']['content']							= 'hroemployeeglassescoverage/listaddhroemployeeglassescoverage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getGlassesCoverageAmount(){
			$glasses_coverage_id = $this->input->post("glasses_coverage_id");
			// $glasses_coverage_id = "1";
			$data = $this->hroemployeeglassescoverage_model->getGlassesCoverageAmount($glasses_coverage_id);
			// print_r($data);exit;
			echo $data;
		}
		
		function processAddHROEmployeeGlassesCoverage(){
			$auth = $this->session->userdata('auth');

			$glasses_month_from				= $this->input->post('glasses_month_from',true);
			$glasses_year_from 				= $this->input->post('glasses_year_from',true);
			$glasses_coverage_period 		= $this->hroemployeeglassescoverage_model->getCompanyCurrentPeriod();

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'glasses_coverage_id' 				=> $this->input->post('glasses_coverage_id',true),
				'glasses_coverage_period' 			=> $glasses_coverage_period,
				'glasses_coverage_amount' 			=> $this->input->post('glasses_coverage_amount',true),
				'glasses_coverage_claimed' 			=> '',
				'glasses_coverage_last_balance' 	=> $this->input->post('glasses_coverage_amount',true),
				'glasses_coverage_remark' 			=> $this->input->post('glasses_coverage_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('glasses_coverage_id', 'Glasses Coverage name', 'required');
			$this->form_validation->set_rules('glasses_coverage_amount', 'Glasses Coverage Amount', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeglassescoverage_model->saveNewhroemployeeglassescoverage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.hroemployeeglassescoverage.processAddHroEmployeeGlassesCoverage',$auth['username'],'Add New Employee Glasses Coverage');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Glasses Coverage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeGlassesCoverage');
					redirect('hroemployeeglassescoverage/addHROEmployeeGlassesCoverage/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Glasses Coverage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeglassescoverage/addHROEmployeeGlassesCoverage/'.$data['employee_id']);
				}
			}else{
				$this->session->set_userdata('AddHroEmployeeGlassesCoverage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeglassescoverage/AddHroEmployeeGlassesCoverage/'.$data['employee_id']);
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
			$data['main_view']['result']		= $this->hroemployeeglassescoverage_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeglassescoverage/edithroemployeeglassescoverage_view';
			$data['main_view']['glassescoverage']		= create_double($this->hroemployeeglassescoverage_model->getglassescoverage(),'glasses_coverage_id','glasses_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeglassescoverage(){
			
			$data = array(
				'employee_glasses_coverage_id' 		=> $this->input->post('employee_glasses_coverage_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'glasses_coverage_id' 				=> $this->input->post('glasses_coverage_id',true),
				'glasses_coverage_period' 			=> $this->input->post('glasses_coverage_period',true),
				'glasses_coverage_amount' 			=> $this->input->post('glasses_coverage_amount',true),
				'glasses_coverage_claimed' 			=> $this->input->post('glasses_coverage_claimed',true),
				'glasses_coverage_last_balance' 	=> $this->input->post('glasses_coverage_last_balance',true),
				'glasses_coverage_remark' 			=> $this->input->post('glasses_coverage_remark',true),
				'data_state'						=> '0',
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('glasses_coverage_id', 'Glasses Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeeglassescoverage_model->saveEdithroemployeeglassescoverage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeglassescoverage.Edit',$auth['username'],'Edit Employee Glasses Coverage');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_glasses_coverage_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Glasses Coverage Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Glasses Coverage UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeglassescoverage/Edit/'.$data['employee_glasses_coverage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeglassescoverage/Edit/'.$data['employee_glasses_coverage_id']);
			}
		}
		
		function deleteHROEmployeeGlassesCoverage(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeglassescoverage_model->deleteHROEmployeeGlassesCoverage()){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeGlassesCoverage.delete',$auth['user_id'],'Delete HROEmployeeGlassesCoverage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Glasses Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeglassescoverage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Glasses Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeglassescoverage');
			}
		}

		function deleteHROEmployeeGlassesCoverage_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_glasses_coverage_id = $this->uri->segment(4);

			if($this->hroemployeeglassescoverage_model->deleteHROEmployeeGlassesCoverage_Data($employee_glasses_coverage_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeGlassesCoverage_Data.delete',$auth['user_id'],'Delete HROEmployeeGlassesCoverage_Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Glasses Coverage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeglassescoverage/addHROEmployeeGlassesCoverage/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Glasses Coverage UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeglassescoverage/AddHroEmployeeGlassesCoverage/'.$employee_id);
			}
		}
	}
?>