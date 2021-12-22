<?php
	Class hroemployeelanguage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeelanguage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeelanguage');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeelanguage_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeelanguage_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeelanguage_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeelanguage_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_language']		= $this->hroemployeelanguage_model->getHROEmployeeData_Language($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeelanguage/listhroemployeelanguage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeelanguage',$data);
			redirect('hroemployeelanguage');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeelanguage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeelanguage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeelanguage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeelanguage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeelanguage');
			$this->session->unset_userdata('filter-hroemployeelanguage');
			redirect('hroemployeelanguage');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeelanguage-'.$sesi['unique']);	
			redirect('hroemployeelanguage');
		}
		
		public function addHROEmployeeLanguage(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['listeningskill']			= $this->configuration->ListeningSkill;
			$data['main_view']['readingskill']				= $this->configuration->ReadingSkill;
			$data['main_view']['writingskill']				= $this->configuration->WritingSkill;
			$data['main_view']['speakingskill']				= $this->configuration->SpeakingSkill;
			$data['main_view']['hroemployeedata']			= $this->hroemployeelanguage_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeelanguage_data']	= $this->hroemployeelanguage_model->getHROEmployeeLanguage_Data($employee_id);
			$data['main_view']['corelanguage']				= create_double($this->hroemployeelanguage_model->getCoreLanguage(),'language_id','language_name');
			$data['main_view']['languagetype']				= $this->configuration->LanguageType;
			$data['main_view']['status']					= $this->configuration->Status;
			$data['main_view']['monthlist']					= $this->configuration->Month;

			$data['main_view']['content']					= 'hroemployeelanguage/listaddhroemployeelanguage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeLanguage(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'language_id' 						=> $this->input->post('language_id',true),
				'employee_language_listen' 			=> $this->input->post('employee_language_listen',true),
				'employee_language_read' 			=> $this->input->post('employee_language_read',true),
				'employee_language_write'			=> $this->input->post('employee_language_write',true),
				'employee_language_speak' 			=> $this->input->post('employee_language_speak',true),
				'employee_language_remark'			=> $this->input->post('employee_language_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('language_id', 'Language Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeelanguage_model->saveNewHROEmployeeLanguage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeLanguage.processAddHROEmployeeLanguage',$auth['username'],'Add New Employee Language');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Language Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeLanguage');
					redirect('hroemployeelanguage/AddHROEmployeeLanguage/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Language UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeLanguage',$data);
					redirect('hroemployeelanguage/AddHROEmployeeLanguage/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('AddHroEmployeeLanguage',$data);
				redirect('hroemployeelanguage/AddHROEmployeeLanguage/'.$data['employee_id']);
			}
		}
		
		public function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['result']		= $this->hroemployeelanguage_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeelanguage/edithroemployeelanguage_view';
			$data['main_view']['language']		= create_double($this->hroemployeelanguage_model->getlanguage(),'language_id','language_name');
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEdithroemployeelanguage(){
			
			$data = array(
				'employee_language_id' 			=> $this->input->post('employee_language_id',true),
				'language_id' 						=> $this->input->post('language_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'language_type' 					=> $this->input->post('language_type',true),
				'employee_language_name' 			=> $this->input->post('employee_language_name',true),
				'employee_language_city' 			=> $this->input->post('employee_language_city',true),
				'employee_language_from_period' 	=> $this->input->post('employee_language_from_period',true),
				'employee_language_to_period' 		=> $this->input->post('employee_language_to_period',true),
				'employee_language_duration' 		=> $this->input->post('employee_language_duration',true),
				'employee_language_passed' 		=> $this->input->post('employee_language_passed',true),
				'employee_language_certificate' 	=> $this->input->post('employee_language_certificate',true),
				'employee_language_remark'		 	=> $this->input->post('employee_language_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('language_id', 'Language Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_language_name', 'Employee Language Name', 'required');
			if($this->form_validation->run()==true){
				if($this->hroemployeelanguage_model->saveEdithroemployeelanguage($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeelanguage.Edit',$auth['username'],'Edit Employee data');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_language_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Language Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					// redirect('hroemployeelanguage/Edit/'.$data['employee_language_id']);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Language UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeelanguage/Edit/'.$data['employee_language_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelanguage/Edit/'.$data['employee_language_id']);
			}
		}
		
		public function deleteHROEmployeeLanguage(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeelanguage_model->deleteHROEmployeeLanguage($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeLanguage.deleteHROEmployeeLanguage',$auth['username'],'Delete HROEmployeeLanguage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelanguage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelanguage');
			}
		}

		public function deleteHROEmployeeLanguage_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_language_id = $this->uri->segment(4);

			if($this->hroemployeelanguage_model->deleteHROEmployeeLanguage_Data($employee_language_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeLanguage.deleteHROEmployeeLanguage_Data',$auth['username'],'Delete HROEmployeeLanguage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelanguage/addHROEmployeeLanguage/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelanguage/addHROEmployeeLanguage/'.$employee_id);
			}
		}
	}
?>