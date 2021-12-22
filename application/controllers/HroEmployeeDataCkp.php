<?php
	class HroEmployeeDataCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeDataCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}

		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$sesi	= 	$this->session->userdata('filter-HroEmployeeDataCkp');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['unit_id']			= '';
			}

			$data['Main_view']['coredivision']			= create_double($this->HroEmployeeDataCkp_model->getCoreDivision(),'division_id','division_name');

			$data['Main_view']['coredepartment']		= create_double($this->HroEmployeeDataCkp_model->getCoreDepartment(),'department_id','department_name');

			$data['Main_view']['coresection']			= create_double($this->HroEmployeeDataCkp_model->getCoreSection(),'section_id','section_name');

			$data['Main_view']['coreunit']				= create_double($this->HroEmployeeDataCkp_model->getCoreUnit(),'unit_id','unit_name');

			$data['Main_view']['HroEmployeeDataCkp']	= $this->HroEmployeeDataCkp_model->getHROEmployeeData($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['division_id'], $sesi['department_id'], $sesi['section_id'],  $sesi['unit_id']);

			$data['Main_view']['gender']				= $this->configuration->Gender();
			$data['Main_view']['educationtype']			= $this->configuration->EducationType();
			$data['Main_view']['separationletter']		= $this->configuration->SeparationLetter();
			// $data['Main_view']['languagetype']			= $this->configuration->LanguageType();
			$data['Main_view']['status']				= $this->configuration->Status();
			$data['Main_view']['monthlist']				= $this->configuration->Month();
			$data['Main_view']['listeningskill']		= $this->configuration->ListeningSkill();
			$data['Main_view']['readingskill']			= $this->configuration->ReadingSkill();
			$data['Main_view']['writingskill']			= $this->configuration->WritingSkill();
			$data['Main_view']['speakingskill']			= $this->configuration->SpeakingSkill();
			$data['Main_view']['idtype']				= $this->configuration->IDType();
			$data['Main_view']['religion']				= $this->configuration->Religion();
			$data['Main_view']['bloodtype']				= $this->configuration->BloodType();

			$data['Main_view']['content']				= 'HroEmployeeDataCkp/listHroEmployeeDataCkp_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'unit_id'			=> $this->input->post('unit_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeDataCkp',$data);
			redirect('HroEmployeeDataCkp');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeDataCkp');
			$this->session->unset_userdata('filter-HroEmployeeDataCkp');
			redirect('HroEmployeeDataCkp');
		}

		public function addHROEmployeeData(){
			$data['Main_view']['coremaritalstatus']		= create_double($this->HroEmployeeDataCkp_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');

			$data['Main_view']['coredivision']			= create_double($this->HroEmployeeDataCkp_model->getCoreDivision(),'division_id','division_name');

			$data['Main_view']['coredepartment']		= create_double($this->HroEmployeeDataCkp_model->getCoreDepartment(),'department_id','department_name');

			$data['Main_view']['coresection']			= create_double($this->HroEmployeeDataCkp_model->getCoreSection(),'section_id','section_name');

			$data['Main_view']['corejobtitle']			= create_double($this->HroEmployeeDataCkp_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['Main_view']['coregrade']				= create_double($this->HroEmployeeDataCkp_model->getCoreGrade(),'grade_id','grade_name');

			$data['Main_view']['coreclass']				= create_double($this->HroEmployeeDataCkp_model->getCoreClass(),'class_id','class_name');

			$data['Main_view']['coreunit']				= create_double($this->HroEmployeeDataCkp_model->getCoreUnit(),'unit_id','unit_name');			

			$data['Main_view']['corefamilyrelation']	= create_double($this->HroEmployeeDataCkp_model->getCoreFamilyRelation(), 'family_relation_id', 'family_relation_name');	

			$data['Main_view']['coreeducation']			= create_double($this->HroEmployeeDataCkp_model->getCoreEducation(),'education_id','education_name');		

			$data['Main_view']['coreexpertise']			= create_double($this->HroEmployeeDataCkp_model->getCoreExpertise(),'expertise_id','expertise_name');
			
			$data['Main_view']['corelanguage']			= create_double($this->HroEmployeeDataCkp_model->getCoreLanguage(),'language_id','language_name');

			$data['Main_view']['corebank']				= create_double($this->HroEmployeeDataCkp_model->getCoreBank(), 'bank_id', 'bank_name');

			$data['Main_view']['path']					= $this->configuration->PhotoDirectory();
			$data['Main_view']['gender']				= $this->configuration->Gender();
			$data['Main_view']['religion']				= $this->configuration->Religion();
			$data['Main_view']['bloodtype']				= $this->configuration->BloodType();
			$data['Main_view']['workingstatus']			= $this->configuration->WorkingStatus();
			$data['Main_view']['employeestatus']		= $this->configuration->EmployeeStatus();
			$data['Main_view']['overtimestatus']		= $this->configuration->OvertimeStatus();	
			$data['Main_view']['idtype']				= $this->configuration->IDType();
			$data['Main_view']['payrollemployeelevel']	= $this->configuration->PayrollEmployeeLevel();
			$data['Main_view']['dayoffstatus']			= $this->configuration->DayOffStatus();
			$data['Main_view']['educationtype']			= $this->configuration->EducationType();
			// $data['Main_view']['expertisetype']			= $this->configuration->ExpertiseType();
			$data['Main_view']['separationletter']		= $this->configuration->SeparationLetter();
			// $data['Main_view']['languagetype']			= $this->configuration->LanguageType();
			$data['Main_view']['status']				= $this->configuration->Status();
			$data['Main_view']['monthlist']				= $this->configuration->Month();
			$data['Main_view']['listeningskill']		= $this->configuration->ListeningSkill();
			$data['Main_view']['readingskill']			= $this->configuration->ReadingSkill();
			$data['Main_view']['writingskill']			= $this->configuration->WritingSkill();
			$data['Main_view']['speakingskill']			= $this->configuration->SpeakingSkill();

			$data['Main_view']['content']				= 'HroEmployeeDataCkp/formaddHroEmployeeDataCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeDataCkp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeDataCkp-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeDataCkp-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeDataCkp-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addHroEmployeeDataCkp-'.$unique['unique']);
			$this->session->unset_userdata('addarrayhroemployeefamily-'.$unique['unique']);
			$this->session->unset_userdata('addarrayhroemployeeeducation-'.$unique['unique']);
			$this->session->unset_userdata('addarrayhroemployeeexpertise-'.$unique['unique']);
			$this->session->unset_userdata('addarrayhroemployeeexperience-'.$unique['unique']);
			$this->session->unset_userdata('addarrayhroemployeelanguage-'.$unique['unique']);
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function function_elements_add_family(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeefamily-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeefamily-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_family(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeefamily-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function processAddArrayHROEmployeeFamily(){
			$auth 			= $this->session->userdata('auth');

			$data_hroemployeefamily = array(
				'record_id'							=> date("YmdHis"),
				'family_relation_id' 				=> $this->input->post('family_relation_id', true),
				'employee_family_name'				=> $this->input->post('employee_family_name', true),
				'employee_family_address'			=> $this->input->post('employee_family_address', true),
				'employee_family_city'				=> $this->input->post('employee_family_city', true),
				'employee_family_postal_code'		=> $this->input->post('employee_family_postal_code', true),
				'employee_family_rt'				=> $this->input->post('employee_family_rt', true),
				'employee_family_rw'				=> $this->input->post('employee_family_rw', true),	
				'employee_family_kelurahan'			=> $this->input->post('employee_family_kelurahan', true),
				'employee_family_kecamatan'			=> $this->input->post('employee_family_kecamatan', true),
				'employee_family_home_phone'		=> $this->input->post('employee_family_home_phone', true),
				'employee_family_mobile_phone'		=> $this->input->post('employee_family_mobile_phone', true),
				'employee_family_gender'			=> $this->input->post('employee_family_gender', true),	
				'marital_status_id'					=> $this->input->post('marital_status_id', true),
				'employee_family_date_of_birth'		=> $this->input->post('employee_family_date_of_birth', true),	
				'employee_family_place_of_birth'	=> $this->input->post('employee_family_place_of_birth', true),
				'employee_family_education'			=> $this->input->post('employee_family_education', true),	
				'employee_family_remark'			=> $this->input->post('employee_family_remark', true),
			);

			$this->form_validation->set_rules('family_relation_id', 'Family Relation Name', 'required');
			$this->form_validation->set_rules('employee_family_name', 'Family Name', 'required');
			$this->form_validation->set_rules('employee_family_address', 'Family Address', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayhroemployeefamily-'.$unique['unique']);
				
				$dataArrayHeader[$data_hroemployeefamily['record_id']] = $data_hroemployeefamily;
				
				$this->session->set_userdata('addarrayhroemployeefamily-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addhroemployeefamily-'.$unique['unique']);
				
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_family',$msg);
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}
		}

		public function deleteArrayHROEmployeeFamily(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayhroemployeefamily-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayhroemployeefamily-'.$unique['unique'],$arrayBaru);
			
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function function_elements_add_education(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeeducation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeeducation-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_education(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeeducation-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function processAddArrayHROEmployeeEducation(){
			$auth 			= $this->session->userdata('auth');

			$education_month_from			= $this->input->post('education_month_from',true);
			$education_year_from 			= $this->input->post('education_year_from',true);
			$education_month_to 			= $this->input->post('education_month_to',true);
			$education_year_to 				= $this->input->post('education_year_to',true);
			$employee_education_from_period = $education_year_from.$education_month_from;
			$employee_education_to_period 	= $education_year_to.$education_month_to;

			$data_hroemployeeeducation = array(
				'record_id'							=> date("YmdHis"),
				'education_id' 						=> $this->input->post('education_id', true),
				'employee_education_type'			=> $this->input->post('employee_education_type', true),	
				'employee_education_name'			=> $this->input->post('employee_education_name', true),
				'employee_education_city'			=> $this->input->post('employee_education_city', true),
				'employee_education_from_period'	=> $employee_education_from_period,
				'employee_education_to_period' 		=> $employee_education_to_period,
				'employee_education_duration'		=> $this->input->post('employee_education_duration', true),
				'employee_education_passed'			=> $this->input->post('employee_education_passed', true),	
				'employee_education_certificate'	=> $this->input->post('employee_education_certificate', true),
				'employee_education_remark'			=> $this->input->post('employee_education_remark', true),
			);

			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('employee_education_name', 'Education Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeeducation-'.$unique['unique']);
				
				$dataArrayHeader[$data_hroemployeeeducation['record_id']] = $data_hroemployeeeducation;
				
				$this->session->set_userdata('addarrayhroemployeeeducation-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addhroemployeeeducation-'.$unique['unique']);
				
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_education',$msg);
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}
		}

		public function deleteArrayHROEmployeeEducation(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayhroemployeeeducation-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayhroemployeeeducation-'.$unique['unique'],$arrayBaru);
			
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function function_elements_add_expertise(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeexpertise-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeexpertise-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_expertise(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeexpertise-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function processAddArrayHROEmployeeExpertise(){
			$auth 			= $this->session->userdata('auth');

			$expertise_month_from			= $this->input->post('expertise_month_from',true);
			$expertise_year_from 			= $this->input->post('expertise_year_from',true);
			$expertise_month_to 			= $this->input->post('expertise_month_to',true);
			$expertise_year_to 				= $this->input->post('expertise_year_to',true);
			$employee_expertise_from_period = $expertise_year_from.$expertise_month_from;
			$employee_expertise_to_period 	= $expertise_year_to.$expertise_month_to;

			$data_hroemployeeexpertise = array(
				'record_id'							=> date("YmdHis"),
				'expertise_id' 						=> $this->input->post('expertise_id', true),
				'employee_expertise_name'			=> $this->input->post('employee_expertise_name', true),
				'employee_expertise_city'			=> $this->input->post('employee_expertise_city', true),
				'employee_expertise_from_period'	=> $employee_expertise_from_period,
				'employee_expertise_to_period' 		=> $employee_expertise_to_period,
				'employee_expertise_duration'		=> $this->input->post('employee_expertise_duration', true),
				'employee_expertise_passed'			=> $this->input->post('employee_expertise_passed', true),	
				'employee_expertise_certificate'	=> $this->input->post('employee_expertise_certificate', true),
				'employee_expertise_remark'			=> $this->input->post('employee_expertise_remark', true),
			);

			$this->form_validation->set_rules('expertise_id', 'Expertise Name', 'required');
			$this->form_validation->set_rules('employee_expertise_name', 'Expertise Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeexpertise-'.$unique['unique']);
				
				$dataArrayHeader[$data_hroemployeeexpertise['record_id']] = $data_hroemployeeexpertise;
				
				$this->session->set_userdata('addarrayhroemployeeexpertise-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addhroemployeeexpertise-'.$unique['unique']);
				
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_expertise',$msg);
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}
		}

		public function deleteArrayHROEmployeeExpertise(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayhroemployeeexpertise-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayhroemployeeexpertise-'.$unique['unique'],$arrayBaru);

			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}
			

		public function function_elements_add_experience(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeexperience-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeexperience-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_experience(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeexperience-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function processAddArrayHROEmployeeExperience(){
			$auth 			= $this->session->userdata('auth');

			$experience_month_from 	= $this->input->post('experience_month_from',true);
			$experience_year_from 	= $this->input->post('experience_year_from',true);
			$experience_month_to 	= $this->input->post('experience_month_to',true);
			$experience_year_to 	= $this->input->post('experience_year_to',true);
			
			$experience_from_period = $experience_year_from.$experience_month_from;
			$experience_to_period 	= $experience_year_to.$experience_month_to;
			
			$data_hroemployeeexperience = array(
				'record_id'							=> date("YmdHis"),
				'experience_from_period'			=> $experience_from_period,
				'experience_to_period'				=> $experience_to_period,
				'experience_company_name'			=> $this->input->post('experience_company_name',true),
				'experience_company_address'		=> $this->input->post('experience_company_address',true),
				'experience_job_title'				=> $this->input->post('experience_job_title',true),
				'experience_last_salary'			=> $this->input->post('experience_last_salary',true),
				'experience_separation_reason'		=> $this->input->post('experience_separation_reason',true),
				'experience_separation_letter'		=> $this->input->post('experience_separation_letter',true),
				'experience_remark'					=> $this->input->post('experience_remark',true),
			);

			$this->form_validation->set_rules('experience_company_name', 'Company Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeexperience-'.$unique['unique']);
				
				$dataArrayHeader[$data_hroemployeeexperience['record_id']] = $data_hroemployeeexperience;
				
				$this->session->set_userdata('addarrayhroemployeeexperience-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addhroemployeeexperience-'.$unique['unique']);
				
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_experience',$msg);
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}
		}

		public function deleteArrayHROEmployeeExperience(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayhroemployeeexperience-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayhroemployeeexperience-'.$unique['unique'],$arrayBaru);
			
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}


		public function function_elements_add_language(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeelanguage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeelanguage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add_language(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeelanguage-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function processAddArrayHROEmployeeLanguage(){
			$auth 			= $this->session->userdata('auth');
			
			$data_hroemployeelanguage = array(
				'record_id'							=> date("YmdHis"),
				'language_id' 						=> $this->input->post('language_id',true),
				'employee_language_listen' 			=> $this->input->post('employee_language_listen',true),
				'employee_language_read' 			=> $this->input->post('employee_language_read',true),
				'employee_language_write'			=> $this->input->post('employee_language_write',true),
				'employee_language_speak' 			=> $this->input->post('employee_language_speak',true),
				'employee_language_remark'			=> $this->input->post('employee_language_remark',true),
			);

			$this->form_validation->set_rules('language_id', 'Language Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayhroemployeelanguage-'.$unique['unique']);
				
				$dataArrayHeader[$data_hroemployeelanguage['record_id']] = $data_hroemployeelanguage;
				
				$this->session->set_userdata('addarrayhroemployeelanguage-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addhroemployeelanguage-'.$unique['unique']);
				
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_language',$msg);
				redirect('HroEmployeeDataCkp/addHROEmployeeData');
			}
		}

		public function deleteArrayHROEmployeeLanguage(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayhroemployeelanguage-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayhroemployeelanguage-'.$unique['unique'],$arrayBaru);
			
			redirect('HroEmployeeDataCkp/addHROEmployeeData');
		}

		public function processAddHROEmployeeData(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id	= $auth['location_id'];
			$created_id 	= $auth['user_id'];

			$session_hroemployeefamily 		= $this->session->userdata('addarrayhroemployeefamily-'.$unique['unique']);
			$session_hroemployeeeducation 	= $this->session->userdata('addarrayhroemployeeeducation-'.$unique['unique']);
			$session_hroemployeeexpertise	= $this->session->userdata('addarrayhroemployeeexpertise-'.$unique['unique']);
			$session_hroemployeeexperience 	= $this->session->userdata('addarrayhroemployeeexperience-'.$unique['unique']);
			$session_hroemployeelanguage 	= $this->session->userdata('addarrayhroemployeelanguage-'.$unique['unique']);

			$data = array(
				'region_id'								=> $region_id,
				'branch_id'								=> $branch_id,
				'location_id'							=> $location_id,
				'division_id'							=> $this->input->post('division_id',true),
				'department_id'							=> $this->input->post('department_id',true),
				'section_id'							=> $this->input->post('section_id',true),
				'job_title_id'							=> $this->input->post('job_title_id',true),
				'grade_id'								=> $this->input->post('grade_id',true),
				'class_id'								=> $this->input->post('class_id',true),
				'unit_id'								=> $this->input->post('unit_id',true),
				'bank_id'								=> $this->input->post('bank_id',true),
				'employee_bank_acct_no'					=> $this->input->post('employee_bank_acct_no',true),
				'employee_bank_acct_name'				=> $this->input->post('employee_bank_acct_name',true),
				'employee_code'							=> $this->input->post('employee_code',true),	
				'employee_name'							=> $this->input->post('employee_name',true),		
				'employee_address'						=> $this->input->post('employee_address',true),
				'employee_city'							=> $this->input->post('employee_city',true),
				'employee_postal_code'					=> $this->input->post('employee_postal_code',true),
				'employee_rt'							=> $this->input->post('employee_rt',true),
				'employee_rw'							=> $this->input->post('employee_rw',true),
				'employee_kelurahan'					=> $this->input->post('employee_kelurahan',true),
				'employee_kecamatan'					=> $this->input->post('employee_kecamatan',true),
				'employee_home_phone'					=> $this->input->post('employee_home_phone',true),
				'employee_mobile_phone'					=> $this->input->post('employee_mobile_phone',true),
				'employee_email_address'				=> $this->input->post('employee_email_address',true),
				'employee_gender'						=> $this->input->post('employee_gender',true),
				'employee_date_of_birth'				=> tgltodb($this->input->post('employee_date_of_birth',true)),
				'employee_place_of_birth'				=> $this->input->post('employee_place_of_birth',true),
				'employee_id_type'						=> $this->input->post('employee_id_type',true),
				'employee_id_number'					=> $this->input->post('employee_id_number',true),
				'employee_religion'						=> $this->input->post('employee_religion',true),
				'employee_blood_type'					=> $this->input->post('employee_blood_type',true),
				'employee_last_day_off'					=> tgltodb($this->input->post('employee_last_day_off',true)),
				'employee_day_off_cycle'				=> $this->input->post('employee_day_off_cycle',true),
				'employee_day_off_status'				=> $this->input->post('employee_day_off_status',true),
				'employee_rfid_code'					=> $this->input->post('employee_rfid_code',true),
				'employee_residential_address'			=> $this->input->post('employee_residential_address',true),
				'employee_residential_city'				=> $this->input->post('employee_residential_city',true),
				'employee_residential_postal_code'		=> $this->input->post('employee_residential_postal_code',true),
				'employee_residential_rt'				=> $this->input->post('employee_residential_rt',true),
				'employee_residential_rw'				=> $this->input->post('employee_residential_rw',true),
				'employee_residential_kecamatan'		=> $this->input->post('employee_residential_kecamatan',true),
				'employee_residential_kelurahan'		=> $this->input->post('employee_residential_kelurahan',true),
				'marital_status_id'						=> $this->input->post('marital_status_id',true),
				'employee_heir_name'					=> $this->input->post('employee_heir_name',true),
				'employee_employment_working_status'	=> $this->input->post('employee_employment_working_status',true),
				'employee_employment_overtime_status'	=> $this->input->post('employee_employment_overtime_status',true),
				'employee_employment_status'			=> $this->input->post('employee_employment_status',true),
				'employee_hire_date'					=> tgltodb($this->input->post('employee_hire_date',true)),
				'employee_employment_status_date'		=> tgltodb($this->input->post('employee_employment_status_date',true)),
				'employee_employment_status_duedate'	=> tgltodb($this->input->post('employee_employment_status_duedate',true)),
				'payroll_employee_level'				=> $this->input->post('payroll_employee_level',true),
				'employee_last_day_off'					=> tgltodb($this->input->post('employee_last_day_off',true)),
				'employee_day_off_status'				=> $this->input->post('employee_day_off_status',true),
				'employee_day_off_cycle'				=> $this->input->post('employee_day_off_cycle',true),
				'employee_remark'						=> $this->input->post('employee_remark',true),
				'created_id'							=> $created_id,
				'created_on'							=> date("YmdHis"),
				'data_state'							=> 0,
			);
			
			$this->form_validation->set_rules('employee_code', 'Employee Code', 'required');
			$this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status Name', 'required');
			$this->form_validation->set_rules('unit_id', 'Unit Name', 'required');
			//print_r($data);exit;
			if($this->form_validation->run()==true){
				if($this->HroEmployeeDataCkp_model->insertHROEmployeeData($data) == true){
					$employee_id = $this->HroEmployeeDataCkp_model->getEmployeeID($data['created_id']);

					if(!empty($session_hroemployeefamily)){
						foreach($session_hroemployeefamily as $key => $val){
							$data_hroemployeefamily = array(
								'employee_id'						=> $employee_id,
								'family_relation_id'				=> $val['family_relation_id'],
								'employee_family_name'				=> $val['employee_family_name'],
								'employee_family_address'			=> $val['employee_family_address'],
								'employee_family_city'				=> $val['employee_family_city'],
								'employee_family_postal_code'		=> $val['employee_family_postal_code'],
								'employee_family_rt'				=> $val['employee_family_rt'],
								'employee_family_rw'				=> $val['employee_family_rw'],		
								'employee_family_kelurahan'			=> $val['employee_family_kelurahan'],		
								'employee_family_kecamatan'			=> $val['employee_family_kecamatan'],
								'employee_family_home_phone'		=> $val['employee_family_home_phone'],
								'employee_family_mobile_phone'		=> $val['employee_family_mobile_phone'],
								'employee_family_gender'			=> $val['employee_family_gender'],
								'marital_status_id'					=> $val['marital_status_id'],
								'employee_family_date_of_birth'		=> tgltodb($val['employee_family_date_of_birth']),
								'employee_family_place_of_birth'	=> $val['employee_family_place_of_birth'],
								'employee_family_education'			=> $val['employee_family_education'],
								'employee_family_remark'			=> $val['employee_family_remark'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->HroEmployeeDataCkp_model->insertHROEmployeeFamily($data_hroemployeefamily);
						}
					}

					if(!empty($session_hroemployeeeducation)){
						foreach($session_hroemployeeeducation as $key => $val){
							$data_hroemployeeeducation = array(
								'employee_id'						=> $employee_id,
								'education_id'						=> $val['education_id'],
								'employee_education_type'			=> $val['employee_education_type'],
								'employee_education_name'			=> $val['employee_education_name'],
								'employee_education_city'			=> $val['employee_education_city'],
								'employee_education_from_period'	=> $val['employee_education_from_period'],
								'employee_education_to_period'		=> $val['employee_education_to_period'],
								'employee_education_duration'		=> $val['employee_education_duration'],		
								'employee_education_passed'			=> $val['employee_education_passed'],		
								'employee_education_certificate'	=> $val['employee_education_certificate'],
								'employee_education_remark'			=> $val['employee_education_remark'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->HroEmployeeDataCkp_model->insertHROEmployeeEducation($data_hroemployeeeducation);
						}
					}

					if(!empty($session_hroemployeeexpertise)){
						foreach($session_hroemployeeexpertise as $key => $val){
							$data_hroemployeeexpertise = array(
								'employee_id'						=> $employee_id,
								'expertise_id'						=> $val['expertise_id'],
								'employee_expertise_name'			=> $val['employee_expertise_name'],
								'employee_expertise_city'			=> $val['employee_expertise_city'],
								'employee_expertise_from_period'	=> $val['employee_expertise_from_period'],
								'employee_expertise_to_period'		=> $val['employee_expertise_to_period'],
								'employee_expertise_duration'		=> $val['employee_expertise_duration'],
								'employee_expertise_passed'			=> $val['employee_expertise_passed'],		
								'employee_expertise_certificate'	=> $val['employee_expertise_certificate'],		
								'employee_expertise_remark'			=> $val['employee_expertise_remark'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->HroEmployeeDataCkp_model->insertHROEmployeeExpertise($data_hroemployeeexpertise);
						}
					}

					if(!empty($session_hroemployeeexperience)){
						foreach($session_hroemployeeexperience as $key => $val){
							$data_hroemployeeexperience = array(
								'employee_id'						=> $employee_id,
								'experience_from_period'			=> $val['experience_from_period'],
								'experience_to_period'				=> $val['experience_to_period'],
								'experience_company_name'			=> $val['experience_company_name'],
								'experience_company_address'		=> $val['experience_company_address'],
								'experience_job_title'				=> $val['experience_job_title'],
								'experience_last_salary'			=> $val['experience_last_salary'],
								'experience_separation_reason'		=> $val['experience_separation_reason'],		
								'experience_separation_letter'		=> $val['experience_separation_letter'],		
								'experience_remark'					=> $val['experience_remark'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->HroEmployeeDataCkp_model->insertHROEmployeeExperience($data_hroemployeeexperience);
						}
					}

					if(!empty($session_hroemployeelanguage)){
						foreach($session_hroemployeelanguage as $key => $val){
							$data_hroemployeelanguage = array(
								'employee_id'					=> $employee_id,
								'language_id'					=> $val['language_id'],
								'employee_language_listen'		=> $val['employee_language_listen'],
								'employee_language_read'		=> $val['employee_language_read'],
								'employee_language_write'		=> $val['employee_language_write'],
								'employee_language_speak'		=> $val['employee_language_speak'],
								'employee_language_remark'		=> $val['employee_language_remark'],
								'data_state'					=> 0,
								'created_id'					=> $auth['user_id'],
								'created_on'					=> date("Y-m-d H:i:s"),
							);

							$this->HroEmployeeDataCkp_model->insertHROEmployeeLanguage($data_hroemployeelanguage);
						}
					}

					$this->session->unset_userdata('addHroEmployeeDataCkp-'.$unique['unique']);
					$this->session->unset_userdata('addhroemployeefamily-'.$unique['unique']);
					$this->session->unset_userdata('addhroemployeeeducation-'.$unique['unique']);
					$this->session->unset_userdata('addhroemployeeexpertise-'.$unique['unique']);
					$this->session->unset_userdata('addhroemployeeexperience-'.$unique['unique']);
					$this->session->unset_userdata('addhroemployeelanguage-'.$unique['unique']);

					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeData.Add',$auth['username'],'Add Employee Data');
					$msg = "<div class='alert alert-success'>                
								Add Employee Data Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeDataCkp/AddHROEmployeeData');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Employee Data UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeDataCkp/AddHROEmployeeData');
				}
			}
			else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeDataCkp/AddHROEmployeeData');
			}
		}

		public function function_state_edit(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editHroEmployeeDataCkp-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('editHroEmployeeDataCkp-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editHroEmployeeDataCkp-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editHroEmployeeDataCkp-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editHroEmployeeDataCkp-'.$unique['unique']);
			$this->session->unset_userdata('editarrayhroemployeefamily-'.$unique['unique']);
			$this->session->unset_userdata('editarrayhroemployeeeducation-'.$unique['unique']);
			$this->session->unset_userdata('editarrayhroemployeeexpertise-'.$unique['unique']);
			$this->session->unset_userdata('editarrayhroemployeeexperience-'.$unique['unique']);
			$this->session->unset_userdata('editarrayhroemployeelanguage-'.$unique['unique']);
			redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
		}

		public function editHROEmployeeData(){
			$employee_id 								= $this->uri->segment(3);

			$data['Main_view']['HroEmployeeDataCkp']	= $this->HroEmployeeDataCkp_model->getHROEmployeeData_Detail($employee_id);

			$data['Main_view']['hroemployeefamily']		= $this->HroEmployeeDataCkp_model->getHROEmployeeFamily_Detail($employee_id);			

			$data['Main_view']['hroemployeeeducation']	= $this->HroEmployeeDataCkp_model->getHROEmployeeEducation_Detail($employee_id);			

			$data['Main_view']['hroemployeeexpertise']	= $this->HroEmployeeDataCkp_model->getHROEmployeeExpertise_Detail($employee_id);			

			$data['Main_view']['hroemployeeexperience']	= $this->HroEmployeeDataCkp_model->getHROEmployeeExperience_Detail($employee_id);			

			$data['Main_view']['hroemployeelanguage']	= $this->HroEmployeeDataCkp_model->getHROEmployeeLanguage_Detail($employee_id);			

			$data['Main_view']['coremaritalstatus']		= create_double($this->HroEmployeeDataCkp_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');

			$data['Main_view']['corefamilyrelation']	= create_double($this->HroEmployeeDataCkp_model->getCoreFamilyRelation(), 'family_relation_id', 'family_relation_name');	

			$data['Main_view']['coreeducation']			= create_double($this->HroEmployeeDataCkp_model->getCoreEducation(),'education_id','education_name');		

			$data['Main_view']['coreexpertise']			= create_double($this->HroEmployeeDataCkp_model->getCoreExpertise(),'expertise_id','expertise_name');
			
			$data['Main_view']['corelanguage']			= create_double($this->HroEmployeeDataCkp_model->getCoreLanguage(),'language_id','language_name');

			$data['Main_view']['corebank']				= create_double($this->HroEmployeeDataCkp_model->getCoreBank(), 'bank_id', 'bank_name');


			$data['Main_view']['path']					= $this->configuration->PhotoDirectory();
			$data['Main_view']['gender']				= $this->configuration->Gender();
			$data['Main_view']['religion']				= $this->configuration->Religion();
			$data['Main_view']['bloodtype']				= $this->configuration->BloodType();
			$data['Main_view']['workingstatus']			= $this->configuration->WorkingStatus();
			$data['Main_view']['employeestatus']		= $this->configuration->EmployeeStatus();
			$data['Main_view']['overtimestatus']		= $this->configuration->OvertimeStatus();	
			$data['Main_view']['idtype']				= $this->configuration->IDType();
			$data['Main_view']['payrollemployeelevel']	= $this->configuration->PayrollEmployeeLevel();
			$data['Main_view']['dayoffstatus']			= $this->configuration->DayOffStatus();
			$data['Main_view']['educationtype']			= $this->configuration->EducationType();
			// $data['Main_view']['expertisetype']			= $this->configuration->ExpertiseType();
			$data['Main_view']['separationletter']		= $this->configuration->SeparationLetter();
			// $data['Main_view']['languagetype']			= $this->configuration->LanguageType();
			$data['Main_view']['status']				= $this->configuration->Status();
			$data['Main_view']['monthlist']				= $this->configuration->Month();
			$data['Main_view']['listeningskill']		= $this->configuration->ListeningSkill();
			$data['Main_view']['readingskill']			= $this->configuration->ReadingSkill();
			$data['Main_view']['writingskill']			= $this->configuration->WritingSkill();
			$data['Main_view']['speakingskill']			= $this->configuration->SpeakingSkill();

			$data['Main_view']['content']				= 'HroEmployeeDataCkp/formeditHroEmployeeDataCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_edit_family(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeefamily-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeefamily-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_family(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('edithroemployeefamily-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
		}

		public function processAddHROEmployeeFamily(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$data_hroemployeefamily = array(
				'family_relation_id' 					=> $this->input->post('family_relation_id',true),
				'employee_id' 							=> $this->input->post('employee_id',true),
				'marital_status_id' 					=> $this->input->post('family_marital_status_id',true),
				'employee_family_name' 					=> $this->input->post('employee_family_name',true),
				'employee_family_address' 				=> $this->input->post('employee_family_address',true),
				'employee_family_city' 					=> $this->input->post('employee_family_city',true),
				'employee_family_postal_code' 			=> $this->input->post('employee_family_postal_code',true),
				'employee_family_rt' 					=> $this->input->post('employee_family_rt',true),
				'employee_family_rw' 					=> $this->input->post('employee_family_rw',true),
				'employee_family_kecamatan' 			=> $this->input->post('employee_family_kecamatan',true),
				'employee_family_kelurahan' 			=> $this->input->post('employee_family_kelurahan',true),
				'employee_family_home_phone' 			=> $this->input->post('employee_family_home_phone',true),
				'employee_family_mobile_phone' 			=> $this->input->post('employee_family_mobile_phone',true),
				'employee_family_gender' 				=> $this->input->post('employee_family_gender',true),
				'employee_family_date_of_birth' 		=> tgltodb($this->input->post('employee_family_date_of_birth',true)),
				'employee_family_place_of_birth' 		=> $this->input->post('employee_family_place_of_birth',true),
				'employee_family_education' 			=> $this->input->post('employee_family_education',true),
				'employee_family_remark' 				=> $this->input->post('employee_family_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('family_relation_id', 'Family Relation', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			$this->form_validation->set_rules('employee_family_name', 'Family Name', 'required');
			$this->form_validation->set_rules('employee_family_address', 'Family Address', 'required');
			$this->form_validation->set_rules('employee_family_city', 'Family City', 'required');
			$this->form_validation->set_rules('employee_family_kecamatan', 'Family Kecamatan', 'required');
			$this->form_validation->set_rules('employee_family_kelurahan', 'Family Kelurahan', 'required');
			$this->form_validation->set_rules('employee_family_mobile_phone', 'Mobile Phone', 'required');
				
			if($this->form_validation->run()==true){
				if($this->HroEmployeeDataCkp_model->insertHROEmployeeFamily($data_hroemployeefamily)){
					$auth = $this->session->userdata('auth');
					$this->session->unset_userdata('edithroemployeefamily-'.$unique['unique']);
					$this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeData.Add',$auth['username'],'Add Employee Data');

					$msg = "<div class='alert alert-success'>                
								Tambah Keluarga berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_family',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeefamily['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Tambah keluarga gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_family',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeefamily['employee_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	", '</div>');
				$this->session->set_userdata('message_family',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeefamily['employee_id']);
			}
		}

		public function deleteHROEmployeeFamily(){
			$employee_id 		= $this->uri->segment(3);
			$employee_family_id = $this->uri->segment(4);

			$datadelete_hroemployeefamily = array (
				'employee_family_id'	=> $employee_family_id,
				'data_state'			=> 1,
			);

			if($this->HroEmployeeDataCkp_model->deleteHROEmployeeFamily($datadelete_hroemployeefamily)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeData.delete',$auth['username'],'Delete HROEmployeeData');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Family Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_family',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Family Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_family',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}
		}



		public function function_elements_edit_education(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeeeducation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeeeducation-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_education(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('edithroemployeeeducation-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
		}

		public function processAddHROEmployeeEducation(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$education_month_from			= $this->input->post('education_month_from',true);
			$education_year_from 			= $this->input->post('education_year_from',true);
			$education_month_to 			= $this->input->post('education_month_to',true);
			$education_year_to 				= $this->input->post('education_year_to',true);
			$employee_education_from_period = $education_year_from.$education_month_from;
			$employee_education_to_period 	= $education_year_to.$education_month_to;

			$data_hroemployeeeducation = array(
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
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_education_type', 'Education Type', 'required');
			$this->form_validation->set_rules('employee_education_from_period', 'From Period', 'numeric');
			$this->form_validation->set_rules('employee_education_to_period', 'To Period', 'numeric');
			$this->form_validation->set_rules('employee_education_duration', 'Duration', 'numeric');
			$this->form_validation->set_rules('employee_education_name', 'Employee Education Name', 'required');

			if($this->form_validation->run()==true){
				if($this->HroEmployeeDataCkp_model->insertHROEmployeeEducation($data_hroemployeeeducation)){
					$auth = $this->session->userdata('auth');
					$this->session->unset_userdata('edithroemployeeeducation-'.$unique['unique']);
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeEducation.processAddHROEmployeeEducation',$auth['username'],'Add New Employee Education');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Education Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_education',$msg);
					
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeeducation['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Education UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_education',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeeducation['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_education',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeeducation['employee_id']);
			}
		}

		public function deleteHROEmployeeEducation(){
			$employee_id 			= $this->uri->segment(3);
			$employee_education_id 	= $this->uri->segment(4);

			$datadelete_hroemployeeeducation = array (
				'employee_education_id'		=> $employee_education_id,
				'data_state'				=> 1,
			);

			if($this->HroEmployeeDataCkp_model->deleteHROEmployeeEducation($datadelete_hroemployeeeducation)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeData.delete',$auth['username'],'Delete HROEmployeeData');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Education Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_education',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Education Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_education',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}
		}


		public function function_elements_edit_expertise(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeeexpertise-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeeexpertise-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_expertise(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('edithroemployeeexpertise-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
		}

		public function processAddHROEmployeeExpertise(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$expertise_month_from			= $this->input->post('expertise_month_from',true);
			$expertise_year_from 			= $this->input->post('expertise_year_from',true);
			$expertise_month_to 			= $this->input->post('expertise_month_to',true);
			$expertise_year_to 				= $this->input->post('expertise_year_to',true);
			$employee_expertise_from_period = $expertise_year_from.$expertise_month_from;
			$employee_expertise_to_period 	= $expertise_year_to.$expertise_month_to;

			$data_hroemployeeexpertise = array(
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
				if($this->HroEmployeeDataCkp_model->insertHROEmployeeExpertise($data_hroemployeeexpertise)){
					
					$this->session->unset_userdata('edithroemployeeexpertise-'.$unique['unique']);

					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeExpertise.processAddHROEmployeeExpertise',$auth['username'],'Add New Employee Expertise');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Expertise Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_expertise',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeexpertise['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Expertise UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_expertise',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeexpertise['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_expertise',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeexpertise['employee_id']);
			}
		}

		public function deleteHROEmployeeExpertise(){
			$employee_id 			= $this->uri->segment(3);
			$employee_expertise_id 	= $this->uri->segment(4);

			$datadelete_hroemployeeexpertise = array (
				'employee_expertise_id'		=> $employee_expertise_id,
				'data_state'				=> 1,
			);

			if($this->HroEmployeeDataCkp_model->deleteHROEmployeeExpertise($datadelete_hroemployeeexpertise)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeData.delete',$auth['username'],'Delete HROEmployeeData');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Expertise Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_expertise',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Expertise Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_expertise',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}
		}


		public function function_elements_edit_experience(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeeexperience-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeeexperience-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_experience(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('edithroemployeeexperience-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
		}

		public function processAddHROEmployeeExperience(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$experience_month_from 	= $this->input->post('experience_month_from',true);
			$experience_year_from 	= $this->input->post('experience_year_from',true);
			$experience_month_to 	= $this->input->post('experience_month_to',true);
			$experience_year_to 	= $this->input->post('experience_year_to',true);
			
			$experience_from_period = $experience_year_from.$experience_month_from;
			$experience_to_period 	= $experience_year_to.$experience_month_to;
			
			$data_hroemployeeexperience = array(
				'employee_id'							=> $this->input->post('employee_id',true),
				'experience_from_period'				=> $experience_from_period,
				'experience_to_period'					=> $experience_to_period,
				'experience_company_name'				=> $this->input->post('experience_company_name',true),
				'experience_company_address'			=> $this->input->post('experience_company_address',true),
				'experience_job_title'					=> $this->input->post('experience_job_title',true),
				'experience_last_salary'				=> $this->input->post('experience_last_salary',true),
				'experience_separation_reason'			=> $this->input->post('experience_separation_reason',true),
				'experience_separation_letter'			=> $this->input->post('experience_separation_letter',true),
				'experience_remark'						=> $this->input->post('experience_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('experience_company_name', 'Company Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->HroEmployeeDataCkp_model->insertHROEmployeeExperience($data_hroemployeeexperience)){
					$this->session->unset_userdata('edithroemployeeexperience-'.$unique['unique']);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeWorking.processAddHROEmployeeWorking',$auth['username'],'Add New Employee Working');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Experience Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_experience',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeexperience['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Experience UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_experience',$msg);
					$this->session->set_userdata('AddHroEmployeeWorking',$data_hroemployeeexperience);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeexperience['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_experience',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeeexperience['employee_id']);
			}
		}

		public function deleteHROEmployeeExperience(){
			$employee_id 			= $this->uri->segment(3);
			$employee_experience_id	= $this->uri->segment(4);

			$datadelete_hroemployeeexperience = array (
				'employee_experience_id'	=> $employee_experience_id,
				'data_state'				=> 1,
			);

			if($this->HroEmployeeDataCkp_model->deleteHROEmployeeExperience($datadelete_hroemployeeexperience)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeData.delete',$auth['username'],'Delete HROEmployeeData');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Experience Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_experience',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Experience Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_experience',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}
		}


		public function function_elements_edit_language(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('edithroemployeelanguage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('edithroemployeelanguage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_language(){
			$employee_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('edithroemployeelanguage-'.$unique['unique']);	
			redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
		}

		public function processAddHROEmployeeLanguage(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$data_hroemployeelanguage = array(
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
				if($this->HroEmployeeDataCkp_model->insertHROEmployeeLanguage($data_hroemployeelanguage)){
					$this->session->unset_userdata('edithroemployeelanguage-'.$unique['unique']);

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeLanguage.processAddHROEmployeeLanguage',$auth['username'],'Add New Employee Language');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Language Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_language',$msg);
					$this->session->unset_userdata('AddHroEmployeeLanguage');
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeelanguage['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Language Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_language',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeelanguage['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_language',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data_hroemployeelanguage['employee_id']);
			}
		}

		public function deleteHROEmployeeLanguage(){
			$employee_id 			= $this->uri->segment(3);
			$employee_language_id	= $this->uri->segment(4);

			$datadelete_hroemployeelanguage = array (
				'employee_language_id'	=> $employee_language_id,
				'data_state'			=> 1,
			);

			if($this->HroEmployeeDataCkp_model->deleteHROEmployeeLanguage($datadelete_hroemployeelanguage)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeData.delete',$auth['username'],'Delete HROEmployeeData');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Language Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_language',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Language Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_language',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$employee_id);
			}
		}


		
		

		

		function lookup_core_division(){
			$division_id = $this->input->post('division_id');
			$item = $this->HroEmployeeDataCkp_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		
		
		public function processEditHROEmployeeData(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];			
						
			$data = array(
				'employee_id'							=> $this->input->post('employee_id',true),	
				'bank_id'								=> $this->input->post('bank_id',true),
				'employee_bank_acct_no'					=> $this->input->post('employee_bank_acct_no',true),
				'employee_bank_acct_name'				=> $this->input->post('employee_bank_acct_name',true),
				'employee_code'							=> $this->input->post('employee_code',true),	
				'employee_name'							=> $this->input->post('employee_name',true),		
				'employee_address'						=> $this->input->post('employee_address',true),
				'employee_city'							=> $this->input->post('employee_city',true),
				'employee_postal_code'					=> $this->input->post('employee_postal_code',true),
				'employee_rt'							=> $this->input->post('employee_rt',true),
				'employee_rw'							=> $this->input->post('employee_rw',true),
				'employee_kelurahan'					=> $this->input->post('employee_kelurahan',true),
				'employee_kecamatan'					=> $this->input->post('employee_kecamatan',true),
				'employee_home_phone'					=> $this->input->post('employee_home_phone',true),
				'employee_mobile_phone'					=> $this->input->post('employee_mobile_phone',true),
				'employee_email_address'				=> $this->input->post('employee_email_address',true),
				'employee_gender'						=> $this->input->post('employee_gender',true),
				'employee_date_of_birth'				=> tgltodb($this->input->post('employee_date_of_birth',true)),
				'employee_place_of_birth'				=> $this->input->post('employee_place_of_birth',true),
				'employee_id_type'						=> $this->input->post('employee_id_type',true),
				'employee_id_number'					=> $this->input->post('employee_id_number',true),
				'employee_religion'						=> $this->input->post('employee_religion',true),
				'employee_blood_type'					=> $this->input->post('employee_blood_type',true),
				'employee_residential_address'			=> $this->input->post('employee_residential_address',true),
				'employee_residential_city'				=> $this->input->post('employee_residential_city',true),
				'employee_residential_postal_code'		=> $this->input->post('employee_residential_postal_code',true),
				'employee_residential_rt'				=> $this->input->post('employee_residential_rt',true),
				'employee_residential_rw'				=> $this->input->post('employee_residential_rw',true),
				'employee_residential_kecamatan'		=> $this->input->post('employee_residential_kecamatan',true),
				'employee_residential_kelurahan'		=> $this->input->post('employee_residential_kelurahan',true),
				'marital_status_id'						=> $this->input->post('marital_status_id',true),
				'employee_heir_name'					=> $this->input->post('employee_heir_name',true),
				'employee_remark'						=> $this->input->post('employee_remark',true),
				'employee_hire_date'					=> tgltodb($this->input->post('employee_hire_date',true)),
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("YmdHis"),
				'data_state'							=> 0,
			);
			
			
			$this->form_validation->set_rules('employee_code', 'Employee Code', 'required');
			$this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status Name', 'required');
			// print_r($data);exit;
			if($this->form_validation->run()==true){
				if($this->HroEmployeeDataCkp_model->updateHROEmployeeData($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeData.Edit',$auth['username'],'Edit Employee Data');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Data Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Data UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data['employee_id']);
				}
			}
			else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeDataCkp/editHROEmployeeData/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeData(){
			$employee_id 								= $this->uri->segment(3);

			$data['Main_view']['HroEmployeeDataCkp']	= $this->HroEmployeeDataCkp_model->getHROEmployeeData_Detail($employee_id);
			$data['Main_view']['gender']				= $this->configuration->Gender();
			$data['Main_view']['religion']				= $this->configuration->Religion();
			$data['Main_view']['bloodtype']				= $this->configuration->BloodType();
			$data['Main_view']['idtype']				= $this->configuration->IDType();
			
			$data['Main_view']['content']				= 'HroEmployeeDataCkp/formdeleteHroEmployeeDataCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function processDeleteHROEmployeeData(){
			$auth = $this->session->userdata('auth');
			
			$data = array(
				'employee_id'							=> $this->input->post('employee_id',true),	
				'employee_data_deleted_date'			=> date("Y-m-d"),	
				'employee_data_deleted_on'				=> date("Y-m-d H:i:s"),	
				'employee_data_deleted_id'				=> $auth['user_id'],	
				'employee_data_deleted_remark'			=> $this->input->post('employee_data_deleted_remark',true),	
				'data_state'							=> 2,
			);
			
			
			$this->form_validation->set_rules('employee_id', 'Employee Code', 'required');
			$this->form_validation->set_rules('employee_data_deleted_remark', 'Delete Remark', 'required');

			if($this->form_validation->run()==true){
				if($this->HroEmployeeDataCkp_model->updateHROEmployeeData($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeData.Edit',$auth['username'],'Edit Employee Data');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_id']);
					$msg = "<div class='alert alert-success'>                
								Delete Employee Data Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeDataCkp');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Delete Employee Data UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeDataCkp');
				}
			}
			else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeDataCkp');
			}
		}
		
		/* function uploadgambar(){
			$tempat = $this->configuration->PhotoDirectory;
			if( !is_dir($tempat) ) {
			mkdir($tempat, DIR_WRITE_MODE);
			}
			if($_FILES['employee_picture']['error'] == 0 && $_FILES['employee_picture']['size']>0){
				if($_POST[old_employee_picture]!=""){
					$gambarlama=$this->configuration->PhotoDirectory.$_POST[old_employee_picture];
					// print_r($gambarlama);exit;
					unlink($gambarlama);
				}
				$config['upload_path'] = $tempat;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$this->load->library('upload', $config);
				if( $_POST AND $this->upload->do_upload('employee_picture') ) {
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 60;
					$config['height'] = 60;
					$this->load->library('image_lib', $config);
					if ( ! $this->image_lib->resize()){
						$msg = "<div class='alert alert-danger'>                
							".$this->upload->display_errors('', '')."
						</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeDataCkp');
					} else {
						$data['employee_picture'] = $this->upload->file_name;
					}
				}
				// print_r($data['employee_picture']);exit;
				// return $this->upload->file_name;
			}else{
				return false;
			}
		} */


/*
	boros
 		function renamefile(){
			//fungsi file renaming
			$pathdirectory=$this->configuration->PhotoDirectory;
			
			$filenamelawas		= $this->input->post('old_employee_picture',true);
			$filenamebaru 		= $_FILES['employee_picture']['name'];
			
			if($filenamelawas!="" && $filenamebaru!=""){
				$filenamelawas=$filenamebaru;
			}
			if($filenamelawas=="" && $filenamebaru!=""){
				$filenamelawas=$filenamebaru;
			}
			if($filenamelawas!="" && $filenamebaru==""){
				$filenamelawas=$filenamebaru;
			}
			if($filenamelawas=="" && $filenamebaru==""){
				// $filenamelawas=$filenamebaru;
			}
			
			$breaker=explode('.',$filenamelawas);
			$ekstensifile=$breaker[1];

			$kode=$this->input->post('employee_code',true);
			$filenameanyar=$kode.".".$ekstensifile;

			$namafilelama=$pathdirectory.$filenamelawas;
			$namafilebaru=$pathdirectory.$filenameanyar;
			
			rename($namafilelama, $namafilebaru);

			return $filenameanyar;
		}
		
		function gambaredit(){
				// fungsi upload gambar
				$fileName 			= $_FILES['employee_picture']['name'];
				$fileSize 			= $_FILES['employee_picture']['size'];
				$fileError 			= $_FILES['employee_picture']['error'];
				
				if($fileSize > 0){
					$parse		= explode('.',$fileName);
					$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe', 'bmp', 'JPG');
					if (!in_array($parse[count($parse)-1], $image_types)){
						$message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('main');
					}
				}
				
				if (round($fileSize/1024,2) > 1024){
					$message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							filesize not allowed, max file 1024 Kb!!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('main');
				}
				if($fileSize > 0 || $fileError == 0){
					try {
						$employee_code=$this->input->post('employee_code',true);
						$newfilename=$employee_code.".".$parse[1];
						
						$config['upload_path'] 		= $this->configuration->PhotoDirectory;
						$config['allowed_types'] 	= 'gif|jpg|png|jpeg|JPG|bmp|jpe';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;
						
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('employee_picture')){
							$msg = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('main');
						}
					}catch (Exception $msg){
						$message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('main');
					}
				}
				return $newfilename;
			}
		
		function determine(){
			//fungsi untuk kondisi pengeditan
			$fileName 			= $_FILES['employee_picture']['name'];
			$fileError 			= $_FILES['employee_picture']['error'];
			// print_r($fileName);exit;
			if($fileName==''){
				$retur=$this->renamefile();
				return $retur;
			}else{
				$retur=$this->renamefile();
				$photodir=$this->configuration->PhotoDirectory;
				$kill=$photodir.$retur;
				unlink($kill);
				$baru=$this->gambaredit();
				return $baru;
			}
		}
		
// For those whom having hard time reading mine algorithm, read this :
// untuk gambar, file naming menggunakan kode karyawan
// setting path di application/libraries/configuration
// kondisi update gambar 

// --> kode employee tidak ganti / gambar tidak ganti
// --> kode employee ganti / gambar tidak ganti
// --> kode employee tidak ganti / gambar ganti
// --> kode employee ganti / gambar ganti


// ------------------------------------|
    // Code        |    Gambar         |
// ------------------------------------|
    // No Change   |    No Change      | -> rename file,
    // Change      |    No Change      | -> rename file,
    // No Change   |    Change         | -> rename file, hapus gambar, simpan gambar
    // Change      |    Change         | -> rename file, hapus gambar, simpan gambar
// ------------------------------------|

// The Approach :

// if gambar = null
// then rename file dengan kode

// if gambar = ada
// then delete file lawas, upload file baru

// kode ganti / tidak ganti tetap
// rename file gambar lawas dengan kode baru
		
		function gambar(){
				$data = array(
				'employee_code'					=> $this->input->post('employee_code',true),
				'employee_name'					=> $this->input->post('employee_name',true),
				'employee_nick_name'			=> $this->input->post('employee_nick_name',true),
				'employee_address'				=> $this->input->post('employee_address',true),
				'employee_city'					=> $this->input->post('employee_city',true),
				'employee_zip_code'				=> $this->input->post('employee_zip_code',true),
				'employee_rt'					=> $this->input->post('employee_rt',true),
				'employee_rw'					=> $this->input->post('employee_rw',true),
				'employee_kecamatan'			=> $this->input->post('employee_kecamatan',true),
				'employee_kelurahan'			=> $this->input->post('employee_kelurahan',true),
				'employee_home_phone'			=> $this->input->post('employee_home_phone',true),
				'employee_mobile_phone'			=> $this->input->post('employee_mobile_phone',true),
				'employee_email_address'		=> $this->input->post('employee_email_address',true),
				'employee_gender'				=> $this->input->post('employee_gender',true),
				'date_of_birth'					=> $this->input->post('date_of_birth',true),
				'place_of_birth'				=> $this->input->post('place_of_birth',true),
				'employee_religion'				=> $this->input->post('employee_religion',true),
				'employee_id_number'			=> $this->input->post('employee_id_number',true),
				'employee_residence_address'	=> $this->input->post('employee_residence_address',true),
				'employee_residence_city'		=> $this->input->post('employee_residence_city',true),
				'employee_residence_zip_code'	=> $this->input->post('employee_residence_zip_code',true),
				'employee_residence_rt'			=> $this->input->post('employee_residence_rt',true),
				'employee_residence_rw'			=> $this->input->post('employee_residence_rw',true),
				'employee_residence_kecamatan'	=> $this->input->post('employee_residence_kecamatan',true),
				'employee_residence_kelurahan'	=> $this->input->post('employee_residence_kelurahan',true),
				'employee_bank_name'			=> $this->input->post('employee_bank_name',true),
				'employee_bank_acct_no'			=> $this->input->post('employee_residence_acct_no',true),
				'employee_bank_acct_name'		=> $this->input->post('employee_residence_acct_name',true),
				'marital_status_id'				=> $this->input->post('marital_status_id',true),
				'number_of_children'			=> $this->input->post('number_of_children',true),
				'employee_heir_name'			=> $this->input->post('employee_heir_name',true),
				'employee_heir_occupation'		=> $this->input->post('employee_heir_occupation',true),
				'employee_blood_type'			=> $this->input->post('employee_blood_type',true),
				'employee_driving_licenseA'		=> $this->input->post('employee_driving_licenseA',true),
				'employee_driving_licenseB'		=> $this->input->post('employee_driving_licenseB',true),
				'employee_driving_licenseB1'	=> $this->input->post('employee_driving_licenseB1',true),
				'data_state'					=> '0'
				);
				
				
				$fileName 			= $_FILES['employee_picture']['name'];
				$fileSize 			= $_FILES['employee_picture']['size'];
				$fileError 			= $_FILES['employee_picture']['error'];
				
				if($fileSize > 0){
					$parse		= explode('.',$fileName);
					$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe', 'bmp', 'JPG');
					if (!in_array($parse[count($parse)-1], $image_types)){
						$message = "<div class='alert alert-danger'>                
								filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
							</div> ";
						$this->session->set_userdata('message',$message);
						$this->session->set_userdata('AddHroEmployeeDataCkp',$data);
						redirect('HroEmployeeDataCkp/Add');
					}
				}
				
				if (round($fileSize/1024,2) > 1024){
					$message = "<div class='alert alert-danger'>                
							filesize not allowed, max file 1024 Kb!!!
						</div> ";
					$this->session->set_userdata('message',$message);
					$this->session->set_userdata('AddHroEmployeeDataCkp',$data);
					redirect('HroEmployeeDataCkp/Add');
				}
				if($fileSize > 0 || $fileError == 0){
					try {
						$employee_code=$this->input->post('employee_code',true);
						$newfilename=$employee_code.".".$parse[1];
						
						$config['upload_path'] 		= $this->configuration->PhotoDirectory;
						$config['allowed_types'] 	= 'gif|jpg|png|jpeg|JPG|bmp|jpe';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;
						
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('employee_picture')){
							$msg = "<div class='alert alert-danger'>                
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->set_userdata('AddHroEmployeeDataCkp',$data);
							redirect('HroEmployeeDataCkp/Add');
						}
					}catch (Exception $msg){
						$message = "<div class='alert alert-danger'>                
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						$this->session->set_userdata('AddHroEmployeeDataCkp',$data);
						redirect('HroEmployeeDataCkp/Add');
					}
				}
				return $newfilename;
			} */
	}
?>