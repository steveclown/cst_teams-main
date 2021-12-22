<?php
	Class hroemployeeexpertise extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeexpertise_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeexpertise');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeexpertise_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeexpertise_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeexpertise_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeexpertise_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_expertise']		= $this->hroemployeeexpertise_model->getHROEmployeeData_Expertise($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeexpertise/listhroemployeeexpertise_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeexpertise',$data);
			redirect('hroemployeeexpertise');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeexpertise-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeexpertise-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeexpertise-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeexpertise-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeexpertise');
			$this->session->unset_userdata('filter-hroemployeeexpertise');
			redirect('hroemployeeexpertise');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeexpertise-'.$sesi['unique']);	
			redirect('hroemployeeexpertise');
		}
		
		public function addHROEmployeeExpertise(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeexpertise_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeexpertise_data']	= $this->hroemployeeexpertise_model->getHROEmployeeExpertise_Data($employee_id);
			$data['main_view']['coreexpertise']				= create_double($this->hroemployeeexpertise_model->getCoreExpertise(),'expertise_id','expertise_name');
			$data['main_view']['expertisetype']				= $this->configuration->ExpertiseType;
			$data['main_view']['status']					= $this->configuration->Status;
			$data['main_view']['monthlist']					= $this->configuration->Month;

			$data['main_view']['content']					= 'hroemployeeexpertise/listaddhroemployeeexpertise_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeExpertise(){
			$auth = $this->session->userdata('auth');

			$expertise_month_from			= $this->input->post('expertise_month_from',true);
			$expertise_year_from 			= $this->input->post('expertise_year_from',true);
			$expertise_month_to 			= $this->input->post('expertise_month_to',true);
			$expertise_year_to 				= $this->input->post('expertise_year_to',true);
			$employee_expertise_from_period = $expertise_year_from.$expertise_month_from;
			$employee_expertise_to_period 	= $expertise_year_to.$expertise_month_to;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'expertise_id' 						=> $this->input->post('expertise_id',true),
				'employee_expertise_name' 			=> $this->input->post('employee_expertise_name',true),
				'employee_expertise_city' 			=> $this->input->post('employee_expertise_city',true),
				'employee_expertise_from_period'	=> $employee_expertise_from_period,
				'employee_expertise_to_period' 		=> $employee_expertise_to_period,
				'employee_expertise_duration' 		=> $this->input->post('employee_expertise_duration',true),
				'employee_expertise_passed' 		=> $this->input->post('employee_expertise_passed',true),
				'employee_expertise_certificate'	=> $this->input->post('employee_expertise_certificate',true),
				'employee_expertise_remark'			=> $this->input->post('employee_expertise_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('expertise_id', 'Expertise Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_expertise_from_period', 'From Period', 'numeric');
			$this->form_validation->set_rules('employee_expertise_to_period', 'To Period', 'numeric');
			$this->form_validation->set_rules('employee_expertise_duration', 'Duration', 'numeric');
			$this->form_validation->set_rules('employee_expertise_name', 'Employee Expertise Name', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeexpertise_model->saveNewHROEmployeeExpertise($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeExpertise.processAddHROEmployeeExpertise',$auth['username'],'Add New Employee Expertise');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Expertise Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeExpertise');
					redirect('hroemployeeexpertise/AddHROEmployeeExpertise/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Expertise UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeExpertise',$data);
					redirect('hroemployeeexpertise/AddHROEmployeeExpertise/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('AddHroEmployeeExpertise',$data);
				redirect('hroemployeeexpertise/AddHROEmployeeExpertise/'.$data['employee_id']);
			}
		}
		
		public function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['result']		= $this->hroemployeeexpertise_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeexpertise/edithroemployeeexpertise_view';
			$data['main_view']['expertise']		= create_double($this->hroemployeeexpertise_model->getexpertise(),'expertise_id','expertise_name');
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEdithroemployeeexpertise(){
			
			$data = array(
				'employee_expertise_id' 			=> $this->input->post('employee_expertise_id',true),
				'expertise_id' 						=> $this->input->post('expertise_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'expertise_type' 					=> $this->input->post('expertise_type',true),
				'employee_expertise_name' 			=> $this->input->post('employee_expertise_name',true),
				'employee_expertise_city' 			=> $this->input->post('employee_expertise_city',true),
				'employee_expertise_from_period' 	=> $this->input->post('employee_expertise_from_period',true),
				'employee_expertise_to_period' 		=> $this->input->post('employee_expertise_to_period',true),
				'employee_expertise_duration' 		=> $this->input->post('employee_expertise_duration',true),
				'employee_expertise_passed' 		=> $this->input->post('employee_expertise_passed',true),
				'employee_expertise_certificate' 	=> $this->input->post('employee_expertise_certificate',true),
				'employee_expertise_remark'		 	=> $this->input->post('employee_expertise_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('expertise_id', 'Expertise Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_expertise_name', 'Employee Expertise Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeeexpertise_model->saveEdithroemployeeexpertise($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeexpertise.Edit',$auth['username'],'Edit Employee data');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_expertise_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Expertise Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					// redirect('hroemployeeexpertise/Edit/'.$data['employee_expertise_id']);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Expertise UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeexpertise/Edit/'.$data['employee_expertise_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeexpertise/Edit/'.$data['employee_expertise_id']);
			}
		}
		
		public function deleteHROEmployeeExpertise(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeexpertise_model->deleteHROEmployeeExpertise($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeExpertise.deleteHROEmployeeExpertise',$auth['username'],'Delete HROEmployeeExpertise');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeexpertise');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeexpertise');
			}
		}

		public function deleteHROEmployeeExpertise_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_expertise_id = $this->uri->segment(4);

			if($this->hroemployeeexpertise_model->deleteHROEmployeeExpertise_Data($employee_expertise_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeExpertise.deleteHROEmployeeExpertise_Data',$auth['username'],'Delete HROEmployeeExpertise');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeexpertise/addHROEmployeeExpertise/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeexpertise/addHROEmployeeExpertise/'.$employee_id);
			}
		}
	}
?>