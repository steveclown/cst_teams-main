<?php
	Class hroemployeeeducation extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeeducation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeeducation');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeeducation_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeeducation_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeeducation_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeeducation_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_education']		= $this->hroemployeeeducation_model->getHROEmployeeData_Education($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeeducation/listhroemployeeeducation_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeeducation',$data);
			redirect('hroemployeeeducation');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeeducation-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeeducation-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeeducation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeeducation-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeeducation');
			$this->session->unset_userdata('filter-hroemployeeeducation');
			redirect('hroemployeeeducation');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeeducation-'.$sesi['unique']);	
			redirect('hroemployeeeducation');
		}
		
		public function addHROEmployeeEducation(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeeducation_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeeducation_data']	= $this->hroemployeeeducation_model->getHROEmployeeEducation_Data($employee_id);
			$data['main_view']['coreeducation']				= create_double($this->hroemployeeeducation_model->getCoreEducation(),'education_id','education_name');
			$data['main_view']['educationtype']				= $this->configuration->EducationType;
			$data['main_view']['status']					= $this->configuration->Status;
			$data['main_view']['monthlist']					= $this->configuration->Month;

			$data['main_view']['content']					= 'hroemployeeeducation/listaddhroemployeeeducation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeEducation(){
			$auth = $this->session->userdata('auth');

			$education_month_from			= $this->input->post('education_month_from',true);
			$education_year_from 			= $this->input->post('education_year_from',true);
			$education_month_to 			= $this->input->post('education_month_to',true);
			$education_year_to 				= $this->input->post('education_year_to',true);
			$employee_education_from_period = $education_year_from.$education_month_from;
			$employee_education_to_period 	= $education_year_to.$education_month_to;

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'education_id' 						=> $this->input->post('education_id',true),
				'employee_education_type' 			=> $this->input->post('employee_education_type',true),
				'employee_education_name' 			=> $this->input->post('employee_education_name',true),
				'employee_education_city' 			=> $this->input->post('employee_education_city',true),
				'employee_education_from_period'	=> $employee_education_from_period,
				'employee_education_to_period' 		=> $employee_education_to_period,
				'employee_education_duration' 		=> $this->input->post('employee_education_duration',true),
				'employee_education_passed' 		=> $this->input->post('employee_education_passed',true),
				'employee_education_certificate'	=> $this->input->post('employee_education_certificate',true),
				'employee_education_remark'			=> $this->input->post('employee_education_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_education_type', 'Education Type', 'required');
			$this->form_validation->set_rules('employee_education_from_period', 'From Period', 'numeric');
			$this->form_validation->set_rules('employee_education_to_period', 'To Period', 'numeric');
			$this->form_validation->set_rules('employee_education_duration', 'Duration', 'numeric');
			$this->form_validation->set_rules('employee_education_name', 'Employee Education Name', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeeducation_model->saveNewHROEmployeeEducation($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeEducation.processAddHROEmployeeEducation',$auth['username'],'Add New Employee Education');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Education Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeEducation');
					redirect('hroemployeeeducation/AddHROEmployeeEducation/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Education UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeEducation',$data);
					redirect('hroemployeeeducation/AddHROEmployeeEducation/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('AddHroEmployeeEducation',$data);
				redirect('hroemployeeeducation/AddHROEmployeeEducation/'.$data['employee_id']);
			}
		}
		
		public function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['result']		= $this->hroemployeeeducation_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeeducation/edithroemployeeeducation_view';
			$data['main_view']['education']		= create_double($this->hroemployeeeducation_model->geteducation(),'education_id','education_name');
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEdithroemployeeeducation(){
			
			$data = array(
				'employee_education_id' 			=> $this->input->post('employee_education_id',true),
				'education_id' 						=> $this->input->post('education_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'education_type' 					=> $this->input->post('education_type',true),
				'employee_education_name' 			=> $this->input->post('employee_education_name',true),
				'employee_education_city' 			=> $this->input->post('employee_education_city',true),
				'employee_education_from_period' 	=> $this->input->post('employee_education_from_period',true),
				'employee_education_to_period' 		=> $this->input->post('employee_education_to_period',true),
				'employee_education_duration' 		=> $this->input->post('employee_education_duration',true),
				'employee_education_passed' 		=> $this->input->post('employee_education_passed',true),
				'employee_education_certificate' 	=> $this->input->post('employee_education_certificate',true),
				'employee_education_remark'		 	=> $this->input->post('employee_education_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_education_name', 'Employee Education Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeeeducation_model->saveEdithroemployeeeducation($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeeducation.Edit',$auth['username'],'Edit Employee data');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_education_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Education Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					// redirect('hroemployeeeducation/Edit/'.$data['employee_education_id']);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Education UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeeducation/Edit/'.$data['employee_education_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeeducation/Edit/'.$data['employee_education_id']);
			}
		}
		
		public function deleteHROEmployeeEducation(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeeducation_model->deleteHROEmployeeEducation($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeEducation.deleteHROEmployeeEducation',$auth['username'],'Delete HROEmployeeEducation');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeeducation');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeeducation');
			}
		}

		public function deleteHROEmployeeEducation_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_education_id = $this->uri->segment(4);

			if($this->hroemployeeeducation_model->deleteHROEmployeeEducation_Data($employee_education_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeEducation.deleteHROEmployeeEducation_Data',$auth['username'],'Delete HROEmployeeEducation');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeeducation/addHROEmployeeEducation/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeeducation/addHROEmployeeEducation/'.$employee_id);
			}
		}

	}
?>