<?php
	Class RecruitmentApplicantDataStatusFinal extends MY_Controller{
		public function __construct(){
			parent::__construct();
			
			$menu	= 'recruitment-applicant-data-status-final';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('RecruitmentApplicantData_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			// $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$data['main_view']['recruitmentapplicantdata']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantDataStatusFinal();

			$data['main_view']['educationtype']					= $this->configuration->EducationType();
			$data['main_view']['status']						= $this->configuration->Status();
			$data['main_view']['statusapplicant']				= $this->configuration->StatusApplicant();
			$data['main_view']['listeningskill']				= $this->configuration->ListeningSkill();
			$data['main_view']['readingskill']					= $this->configuration->ReadingSkill();
			$data['main_view']['writingskill']					= $this->configuration->WritingSkill();
			$data['main_view']['speakingskill']					= $this->configuration->SpeakingSkill();
			$data['main_view']['organizationtype']				= $this->configuration->OrganizationType();
			$data['main_view']['organizationstatus']			= $this->configuration->OrganizationStatus();
			$data['main_view']['separationletter']				= $this->configuration->SeparationLetter();
			$data['main_view']['sickopname']					= $this->configuration->SickOpname();
			$data['main_view']['colourblind']					= $this->configuration->ColourBlind();

			$data['main_view']['content']						= 'RecruitmentApplicantData/ListRecruitmentApplicantDataStatusFinal_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addRecruitmentApplicantData(){
			$data['main_view']['corefamilyrelation']		= create_double($this->RecruitmentApplicantData_model->getCoreFamilyRelation(),'family_relation_id','family_relation_name');

			$data['main_view']['coremaritalstatus']			= create_double($this->RecruitmentApplicantData_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');

			$data['main_view']['coreeducation']				= create_double($this->RecruitmentApplicantData_model->getCoreEducation(),'education_id','education_name');

			$data['main_view']['corelanguage']				= create_double($this->RecruitmentApplicantData_model->getCoreLanguage(),'language_id','language_name');

			$data['main_view']['coreexpertise']				= create_double($this->RecruitmentApplicantData_model->getCoreExpertise(),'expertise_id','expertise_name');

			$data['main_view']['gender']					= $this->configuration->Gender();
			$data['main_view']['bloodtype']					= $this->configuration->BloodType();
			$data['main_view']['religion']					= $this->configuration->Religion();
			$data['main_view']['residencestatus']			= $this->configuration->ResidenceStatus();
			$data['main_view']['nationality']				= $this->configuration->Nationality();
			$data['main_view']['idtype']					= $this->configuration->IDType();
			$data['main_view']['educationtype']				= $this->configuration->EducationType();
			$data['main_view']['listeningskill']			= $this->configuration->ListeningSkill();
			$data['main_view']['readingskill']				= $this->configuration->ReadingSkill();
			$data['main_view']['writingskill']				= $this->configuration->WritingSkill();
			$data['main_view']['speakingskill']				= $this->configuration->SpeakingSkill();
			$data['main_view']['subjectsstatus']			= $this->configuration->SubjectsStatus();
			$data['main_view']['workingenvironment']		= $this->configuration->WorkingEnvironment();
			$data['main_view']['organizationtype']			= $this->configuration->OrganizationType();
			$data['main_view']['organizationstatus']		= $this->configuration->OrganizationStatus();
			$data['main_view']['monthlist']					= $this->configuration->Month();
			$data['main_view']['status']					= $this->configuration->Status();
			$data['main_view']['separationletter']			= $this->configuration->SeparationLetter();
			$data['main_view']['sickopname']				= $this->configuration->SickOpname();
			$data['main_view']['colourblind']				= $this->configuration->ColourBlind();
			
			$data['main_view']['content']					= 'RecruitmentApplicantData/FormAddRecruitmentApplicantData_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addRecruitmentApplicantData-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addRecruitmentApplicantData-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addRecruitmentApplicantData-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addRecruitmentApplicantData-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addRecruitmentApplicantData-'.$unique['unique']);
			$this->session->unset_userdata('addrecruitmentapplicantfamily-'.$unique['unique']);
			$this->session->unset_userdata('addarrayrecruitmentapplicanteducation-'.$unique['unique']);
			$this->session->unset_userdata('addarrayrecruitmentapplicantexpertise-'.$unique['unique']);
			$this->session->unset_userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique']);
			$this->session->unset_userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique']);
			redirect('RecruitmentApplicantDatailufa/addRecruitmentApplicantData');
		}



		public function function_elements_add_family(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantfamily-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantfamily-'.$unique['unique'],$sessions);
		}

		public function reset_add_family(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addrecruitmentapplicantfamily-'.$unique['unique']);
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}
		
		public function processAddArrayRecruitmentApplicantFamily(){
			$data_family = array(
				'applicant_family_record_id'		=> date("YmdHis"),
				'family_relation_id'				=> $this->input->post('family_relation_id', true),
				'marital_status_id_family'			=> $this->input->post('marital_status_id_family', true),
				'applicant_family_name'				=> $this->input->post('applicant_family_name', true),
				'applicant_family_address'			=> $this->input->post('applicant_family_address', true),
				'applicant_family_city'				=> $this->input->post('applicant_family_city', true),
				'applicant_family_postal_code'		=> $this->input->post('applicant_family_postal_code', true),
				'applicant_family_rt'				=> $this->input->post('applicant_family_rt', true),
				'applicant_family_rw'				=> $this->input->post('applicant_family_rw', true),	
				'applicant_family_kelurahan'		=> $this->input->post('applicant_family_kelurahan', true),
				'applicant_family_kecamatan'		=> $this->input->post('applicant_family_kecamatan', true),
				'applicant_family_home_phone'		=> $this->input->post('applicant_family_home_phone', true),
				'applicant_family_mobile_phone'		=> $this->input->post('applicant_family_mobile_phone', true),
				'applicant_family_gender'			=> $this->input->post('applicant_family_gender', true),
				'applicant_family_date_of_birth'	=> $this->input->post('applicant_family_date_of_birth', true),
				'applicant_family_place_of_birth'	=> $this->input->post('applicant_family_place_of_birth', true),
				'applicant_family_education'		=> $this->input->post('applicant_family_education', true),
				'applicant_family_occupation'		=> $this->input->post('applicant_family_occupation', true),
				'applicant_family_remark'			=> $this->input->post('applicant_family_remark', true),
			);
			
			$this->form_validation->set_rules('family_relation_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('marital_status_id_family', 'Marital Status Name Status', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicantfamily-'.$unique['unique']);
				$dataArrayHeader[$data_family['applicant_family_record_id']] = $data_family;
								
				$this->session->set_userdata('addarrayrecruitmentapplicantfamily-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addrecruitmentapplicantfamily-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayRecruitmentApplicantFamily(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayrecruitmentapplicantfamily-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayrecruitmentapplicantfamily-'.$unique['unique'],$arrayBaru);
			
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}


		public function function_elements_add_education(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicanteducation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicanteducation-'.$unique['unique'],$sessions);
		}

		public function reset_add_education(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addrecruitmentapplicanteducation-'.$unique['unique']);
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}

		public function processAddArrayRecruitmentApplicantEducation(){
			$education_month_from			= $this->input->post('education_month_from',true);
			$education_year_from 			= $this->input->post('education_year_from',true);
			$education_month_to 			= $this->input->post('education_month_to',true);
			$education_year_to 				= $this->input->post('education_year_to',true);
			$applicant_education_from_period = $education_year_from.$education_month_from;
			$applicant_education_to_period 	= $education_year_to.$education_month_to;

			$data_education = array(
				'applicant_education_record_id'			=> date("YmdHis"),
				'education_id'							=> $this->input->post('education_id', true),
				'applicant_education_type'				=> $this->input->post('applicant_education_type', true),
				'applicant_education_name'				=> $this->input->post('applicant_education_name', true),
				'applicant_education_city'				=> $this->input->post('applicant_education_city', true),
				'applicant_education_from_period'		=> $applicant_education_from_period,
				'applicant_education_to_period'			=> $applicant_education_to_period,
				'applicant_education_duration'			=> $this->input->post('applicant_education_duration', true),
				'applicant_education_passed'			=> $this->input->post('applicant_education_passed', true),
				'applicant_education_certificate'		=> $this->input->post('applicant_education_certificate', true),
				'applicant_education_remark'			=> $this->input->post('applicant_education_remark', true),
			);
			$this->form_validation->set_rules('education_id', 'Education', 'required');
			$this->form_validation->set_rules('applicant_education_type', 'Type of Education', 'required');
			$this->form_validation->set_rules('applicant_education_name', 'Education Name', 'required');
			$this->form_validation->set_rules('applicant_education_city', 'Education City', 'required');
			$this->form_validation->set_rules('applicant_education_duration', 'Duration', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicanteducation-'.$unique['unique']);
				$dataArrayHeader[$data_education['applicant_education_record_id']] = $data_education;
				
				$this->session->set_userdata('addarrayrecruitmentapplicanteducation-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addrecruitmentapplicanteducation-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayRecruitmentApplicantEducation(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayrecruitmentapplicanteducation-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayrecruitmentapplicanteducation-'.$unique['unique'],$arrayBaru);
			
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}


		public function function_elements_add_language(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantlanguage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantlanguage-'.$unique['unique'],$sessions);
		}

		public function reset_add_language(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addrecruitmentapplicantlanguage-'.$unique['unique']);
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}

		public function processAddArrayRecruitmentApplicantLanguage(){

			$data_language = array(
				'applicant_language_record_id'		=> date("YmdHis"),
				'language_id'						=> $this->input->post('language_id', true),
				'applicant_language_listen'			=> $this->input->post('applicant_language_listen', true),
				'applicant_language_read'			=> $this->input->post('applicant_language_read', true),
				'applicant_language_write'			=> $this->input->post('applicant_language_write', true),
				'applicant_language_speak'			=> $this->input->post('applicant_language_speak', true),
			);
			
			$this->form_validation->set_rules('language_id', 'Language Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique']);
				$dataArrayHeader[$data_language['applicant_language_record_id']] = $data_language;
				
				$this->session->set_userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addrecruitmentapplicantlanguage-'.$unique['unique']);

			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayRecruitmentApplicantLanguage(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayrecruitmentapplicantlanguage-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique'],$arrayBaru);
			
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData');
		}
		
		public function function_elements_add_experience(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantexperience-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantexperience-'.$unique['unique'],$sessions);
		}

		public function reset_add_experience(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addrecruitmentapplicantexperience-'.$unique['unique']);
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}
		
		public function processAddArrayRecruitmentApplicantExperience(){
			$work_month_from 	= $this->input->post('work_month_from',true);
			$work_year_from 	= $this->input->post('work_year_from',true);
			$work_month_to 		= $this->input->post('work_month_to',true);
			$work_year_to 		= $this->input->post('work_year_to',true);
			
			$experience_from_period = $work_year_from.$work_month_from;
			$experience_to_period 	= $work_year_to.$work_month_to;
			
			$data_experience = array(
				'applicant_experience_record_id'		=> date("YmdHis"),
				'work_month_from'						=> $this->input->post('work_month_from',true),
				'work_year_from'						=> $this->input->post('work_year_from',true),
				'work_month_to'							=> $this->input->post('work_month_to',true),
				'work_year_to'							=> $this->input->post('work_year_to',true),
				'experience_from_period'				=> $experience_from_period,
				'experience_to_period'					=> $experience_to_period,
				'experience_company_name'				=> $this->input->post('experience_company_name',true),
				'experience_company_address'			=> $this->input->post('experience_company_address',true),
				'experience_job_title'					=> $this->input->post('experience_job_title',true),
				'experience_last_salary'				=> $this->input->post('experience_last_salary',true),
				'experience_separation_reason'			=> $this->input->post('experience_separation_reason',true),
				'experience_separation_letter'			=> $this->input->post('experience_separation_letter',true),
				'experience_experience_remark'			=> $this->input->post('experience_experience_remark',true),
			);
			
			$this->form_validation->set_rules('experience_company_name', 'Company Name', 'required');		
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique']);
				$dataArrayHeader[$data_experience['applicant_experience_record_id']] = $data_experience;
				
				$this->session->set_userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addrecruitmentapplicantexperience-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayRecruitmentApplicantExperience(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayrecruitmentapplicantexperience-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique'],$arrayBaru);
			
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}

		public function function_elements_add_expertise(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantexpertise-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantexpertise-'.$unique['unique'],$sessions);
		}

		public function reset_add_expertise(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addrecruitmentapplicantexpertise-'.$unique['unique']);
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}
		
		public function processAddArrayRecruitmentApplicantExpertise(){
			$auth 			= $this->session->userdata('auth');

			$expertise_month_from			= $this->input->post('expertise_month_from',true);
			$expertise_year_from 			= $this->input->post('expertise_year_from',true);
			$expertise_month_to 			= $this->input->post('expertise_month_to',true);
			$expertise_year_to 				= $this->input->post('expertise_year_to',true);
			$applicant_expertise_from_period = $expertise_year_from.$expertise_month_from;
			$applicant_expertise_to_period 	= $expertise_year_to.$expertise_month_to;

			$data_recruitmentapplicantexpertise = array(
				'record_id'							=> date("YmdHis"),
				'expertise_id' 						=> $this->input->post('expertise_id', true),
				'applicant_expertise_name'			=> $this->input->post('applicant_expertise_name', true),
				'applicant_expertise_city'			=> $this->input->post('applicant_expertise_city', true),
				'applicant_expertise_from_period'	=> $applicant_expertise_from_period,
				'applicant_expertise_to_period' 	=> $applicant_expertise_to_period,
				'applicant_expertise_duration'		=> $this->input->post('applicant_expertise_duration', true),
				'applicant_expertise_passed'		=> $this->input->post('applicant_expertise_passed', true),	
				'applicant_expertise_certificate'	=> $this->input->post('applicant_expertise_certificate', true),
				'applicant_expertise_remark'		=> $this->input->post('applicant_expertise_remark', true),
			);

			$this->form_validation->set_rules('expertise_id', 'Expertise Name', 'required');
			$this->form_validation->set_rules('applicant_expertise_name', 'Expertise Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicantexpertise-'.$unique['unique']);
				
				$dataArrayHeader[$data_recruitmentapplicantexpertise['record_id']] = $data_recruitmentapplicantexpertise;
				
				$this->session->set_userdata('addarrayrecruitmentapplicantexpertise-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addrecruitmentapplicantexpertise-'.$unique['unique']);
				
				redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message_expertise',$msg);
				redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
			}
		}

		public function deleteArrayRecruitmentApplicantExpertise(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayrecruitmentapplicantexpertise-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayrecruitmentapplicantexpertise-'.$unique['unique'],$arrayBaru);

			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}


		public function function_elements_add_expectation(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantexpectation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantexpectation-'.$unique['unique'],$sessions);
		}
		
		public function processAddRecruitmentApplicantData(){
			$auth	 	= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');
			
			$created_id = $this->RecruitmentApplicantData_model->getCreatedID($auth['username']);
			
			$session_family			= $this->session->userdata('addarrayrecruitmentapplicantfamily-'.$unique['unique']);
			$session_education		= $this->session->userdata('addarrayrecruitmentapplicanteduaction-'.$unique['unique']);
			$session_language		= $this->session->userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique']);
			$session_expertise		= $this->session->userdata('addarrayrecruitmentapplicantexpertise-'.$unique['unique']);
			$session_experience		= $this->session->userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique']);

			
			$data = array(
				'applicant_name'								=> $this->input->post('applicant_name',true),	
				'applicant_application_date'					=> tgltodb($this->input->post('applicant_application_date',true)),
				'applicant_status_date'							=> tgltodb($this->input->post('applicant_application_date',true)),
				'applicant_place_of_birth'						=> $this->input->post('applicant_place_of_birth',true),
				'applicant_date_of_birth'						=> tgltodb($this->input->post('applicant_date_of_birth',true)),
				'applicant_last_education'						=> $this->input->post('applicant_last_education',true),
				'applicant_address'								=> $this->input->post('applicant_address',true),
				'applicant_city'								=> $this->input->post('applicant_city',true),
				'applicant_postal_code'							=> $this->input->post('applicant_postal_code',true),
				'applicant_rt'									=> $this->input->post('applicant_rt',true),
				'applicant_rw'									=> $this->input->post('applicant_rw',true),
				'applicant_kecamatan'							=> $this->input->post('applicant_kecamatan',true),
				'applicant_kelurahan'							=> $this->input->post('applicant_kelurahan',true),
				'applicant_home_phone'							=> $this->input->post('applicant_home_phone',true),
				'applicant_mobile_phone'						=> $this->input->post('applicant_mobile_phone',true),
				'applicant_email_address'						=> $this->input->post('applicant_email_address',true),
				'applicant_residence_address'					=> $this->input->post('applicant_residence_address',true),
				'applicant_residence_city'						=> $this->input->post('applicant_residence_city',true),
				'applicant_residence_postal_code'				=> $this->input->post('applicant_residence_postal_code',true),
				'applicant_residence_rt'						=> $this->input->post('applicant_residence_rt',true),
				'applicant_residence_rw'						=> $this->input->post('applicant_residence_rw',true),
				'applicant_residence_kecamatan'					=> $this->input->post('applicant_residence_kecamatan',true),
				'applicant_residence_kelurahan'					=> $this->input->post('applicant_residence_kelurahan',true),
				'applicant_residence_status'					=> $this->input->post('applicant_residence_status',true),
				'applicant_gender'								=> $this->input->post('applicant_gender',true),
				'applicant_religion'							=> $this->input->post('applicant_religion',true),
				'applicant_nationality'							=> $this->input->post('applicant_nationality',true),
				'applicant_blood_type'							=> $this->input->post('applicant_blood_type',true),
				'applicant_heir_name'							=> $this->input->post('applicant_heir_name',true),
				'marital_status_id'								=> $this->input->post('marital_status_id',true),
				'applicant_id_type'								=> $this->input->post('applicant_id_type',true),
				'applicant_id_number'							=> $this->input->post('applicant_id_number',true),
				'data_state'									=> 0,
				'created_id'									=> $created_id,
				'created_on'									=> date("YmdHis")
			);
			
			/* print_r($data);
			exit; */
			$this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
			//$this->form_validation->set_rules('marital_status_id', 'Marital Status Applicant', 'required');
			$this->form_validation->set_rules('applicant_address', 'Address', 'required');
			$this->form_validation->set_rules('applicant_city', 'City', 'required');
			$this->form_validation->set_rules('applicant_postal_code', 'Postal Code', 'required');
			$this->form_validation->set_rules('applicant_rt', 'RT', 'required');
			$this->form_validation->set_rules('applicant_rw', 'RW', 'required');
			$this->form_validation->set_rules('applicant_kecamatan', 'Kecamatan', 'required');
			$this->form_validation->set_rules('applicant_kelurahan', 'Kecamatan', 'required');
			
			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->insertRecruitmentApplicantData($data)){
					$applicant_id = $this->RecruitmentApplicantData_model->getApplicantID($data['created_on'], $data['created_id']);
					
					if(!empty($session_education)){
						foreach($session_education as $key=>$val){
							$data_education = array(
								'applicant_id'						=> $applicant_id,
								'education_id'						=> $val['education_id'],
								'applicant_education_type'			=> $val['applicant_education_type'],
								'applicant_education_name'			=> $val['applicant_education_name'],
								'applicant_education_city'			=> $val['applicant_education_city'],
								'applicant_education_from_period'	=> $val['applicant_education_from_period'],
								'applicant_education_to_period'		=> $val['applicant_education_to_period'],
								'applicant_education_duration'		=> $val['applicant_education_duration'],
								'applicant_education_passed'		=> $val['applicant_education_passed'],
								'applicant_education_certificate'	=> $val['applicant_education_certificate'],
								'applicant_education_remark'		=> $val['applicant_education_remark'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->RecruitmentApplicantData_model->insertRecruitmentApplicantEducation($data_education);
						}
					}
					
					if(!empty($session_family)){
						foreach($session_family as $key=>$val){
							$data_family = array(
								'applicant_id'						=> $applicant_id,
								'family_relation_id'				=> $val['family_relation_id'],
								'marital_status_id'					=> $val['marital_status_id_family'],
								'applicant_family_name'				=> $val['applicant_family_name'],
								'applicant_family_address'			=> $val['applicant_family_address'],
								'applicant_family_city'				=> $val['applicant_family_city'],
								'applicant_family_postal_code'		=> $val['applicant_family_postal_code'],
								'applicant_family_rt'				=> $val['applicant_family_rt'],
								'applicant_family_rw'				=> $val['applicant_family_rw'],
								'applicant_family_kelurahan'		=> $val['applicant_family_kelurahan'],
								'applicant_family_kecamatan'		=> $val['applicant_family_kecamatan'],
								'applicant_family_home_phone'		=> $val['applicant_family_home_phone'],
								'applicant_family_mobile_phone'		=> $val['applicant_family_mobile_phone'],
								'applicant_family_date_of_birth'	=> $val['applicant_family_date_of_birth'],
								'applicant_family_place_of_birth'	=> $val['applicant_family_place_of_birth'],
								'applicant_family_gender'			=> $val['applicant_family_gender'],
								'applicant_family_education'		=> $val['applicant_family_education'],
								'applicant_family_occupation'		=> $val['applicant_family_occupation'],
								'applicant_family_sibling'			=> $val['applicant_family_sibling'],
								'applicant_family_remark'			=> $val['applicant_family_remark'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->RecruitmentApplicantData_model->insertRecruitmentApplicantFamily($data_family);
						}
					}
					
					if(!empty($session_language)){
						foreach($session_language as $key=>$val){
							$data_language = array(
								'applicant_id'					=> $applicant_id,
								'language_id'					=> $val['language_id'],
								'applicant_language_listen'		=> $val['applicant_language_listen'],
								'applicant_language_read'		=> $val['applicant_language_read'],
								'applicant_language_write'		=> $val['applicant_language_speak'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->RecruitmentApplicantData_model->insertRecruitmentApplicantLanguage($data_language);
						}
					}

					if(!empty($session_experience)){
						foreach($session_experience as $key=>$val){
							$data_experience = array(
								'applicant_id'					=> $applicant_id,
								'experience_from_period'		=> $val['experience_from_period'],
								'experience_to_period'			=> $val['experience_to_period'],
								'experience_company_name'		=> $val['experience_company_name'],
								'experience_company_address'	=> $val['experience_company_address'],
								'experience_job_title'			=> $val['experience_job_title'],
								'experience_last_salary'		=> $val['experience_last_salary'],
								'experience_separation_reason'	=> $val['experience_separation_reason'],
								'experience_separation_letter'	=> $val['experience_separation_letter'],
								'experience_remark'				=> $val['experience_experience_remark'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->RecruitmentApplicantData_model->insertRecruitmentApplicantExperience($data_experience);
						}
					}

					if(!empty($session_expertise)){
						foreach($session_expertise as $key=>$val){
							$data_expertise = array(
								'applicant_id'						=> $applicant_id,
								'expertise_id' 						=> $val['expertise_id'],
								'applicant_expertise_name'			=> $val['applicant_expertise_name'],
								'applicant_expertise_city'			=> $val['applicant_expertise_city'],
								'applicant_expertise_from_period'	=> $val['applicant_expertise_from_period'],
								'applicant_expertise_to_period' 	=> $val['applicant_expertise_to_period'],
								'applicant_expertise_duration'		=> $val['applicant_expertise_duration'],
								'applicant_expertise_passed'		=> $val['applicant_expertise_passed'],	
								'applicant_expertise_certificate'	=> $val['applicant_expertise_certificate'],
								'applicant_expertise_remark'		=> $val['applicant_expertise_remark'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->RecruitmentApplicantData_model->insertRecruitmentApplicantExpertise($data_expertise);
						}
					}

					if(!empty($session_expectation)){
						foreach($session_expectation as $key=>$val){
							$data_expectation = array(
								'applicant_id'								=> $applicant_id,
								'applicant_application_position' 			=> $val['applicant_application_position'],
								'applicant_expected_salary'					=> $val['applicant_expected_salary'],
								'applicant_working_out_town'				=> $val['applicant_working_out_town'],
								'applicant_working_out_town_reason'			=> $val['applicant_working_out_town_reason'],
								'applicant_working_immediately' 			=> $val['applicant_working_immediately'],
								'applicant_working_immediately_reason'		=> $val['applicant_working_immediately_reason'],
								'applicant_working_overtime'				=> $val['applicant_working_overtime'],	
								'applicant_working_overtime_reason'			=> $val['applicant_working_overtime_reason'],
								'applicant_business_trip'					=> $val['applicant_business_trip'],
								'applicant_business_trip_reason'			=> $val['applicant_business_trip_reason'],
								'applicant_working_environment'				=> $val['applicant_working_environment'],
								'applicant_working_environment_other'		=> $val['applicant_working_environment_other'],
								'applicant_working_like'					=> $val['applicant_working_like'],
								'applicant_working_dislike'					=> $val['applicant_working_dislike'],
								'data_state'								=> 0,
								'created_id'								=> $data['created_id'],
								'created_on'								=> $data['created_on']
							);
							$this->RecruitmentApplicantData_model->insertRecruitmentApplicantExpectation($data_expectation);
						}
					}
					
					print_r($session_expectation);

					// $this->fungsi->set_log($auth['username'],'1003','Application.RecruitmentApplicantData.processAddRecruitmentApplicantData',$auth['username'],'Add New Applicant Data');
					$msg = "<div class='alert alert-success'>                
								Add Applicant Data Success
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addapplicantdata-'.$unique['unique']);
					$this->session->unset_userdata('addRecruitmentApplicantData-'.$unique['unique']);
					$this->session->unset_userdata('addarrayrecruitmentapplicantfamily-'.$unique['unique']);
					$this->session->unset_userdata('addarrayrecruitmentapplicanteduaction-'.$unique['unique']);			
					$this->session->unset_userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique']);
					$this->session->unset_userdata('addarrayrecruitmentapplicantexpertise-'.$unique['unique']);			
					$this->session->unset_userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique']);
					$this->session->unset_userdata('addarrayrecruitmentapplicantexpectation-'.$unique['unique']);
					
					redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
				}else{
					$msg = "<div class='alert alert-danger'>                
							Add Applicant Data Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
					$this->session->set_userdata('message',$msg);
					redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
			}
		}

		public function deleteRecruitmentApplicantData(){
			if($this->RecruitmentApplicantData_model->deleteRecruitmentApplicantData($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.RecruitmentApplicantData.delete',$auth['username'],'Delete RecruitmentApplicantData');
				$msg = "<div class='alert alert-success'>                
							Delete Data Applicant Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentApplicantData');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Applicant UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentApplicantData');
			}
		}

		public function editRecruitmentApplicantData(){
			$unique 						= $this->session->userdata('unique');
			$this->session->unset_userdata('addarrayrecruitmentapplicanteducation-'.$unique['unique']);


			$applicant_id = $this->uri->segment(3);
			$data['main_view']['RecruitmentApplicantData']			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($applicant_id);
			$data['main_view']['recruitmentapplicanteducation']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantEducation_Detail($applicant_id);
			$data['main_view']['recruitmentapplicantfamily']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantFamily_Detail($applicant_id);
			$data['main_view']['recruitmentapplicantlanguage']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantLanguage_Detail($applicant_id);
			$data['main_view']['recruitmentapplicantexpertise']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExpertise_Detail($applicant_id);
			$data['main_view']['recruitmentapplicantexperience']	= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExperience_Detail($applicant_id);


			$data['main_view']['corefamilyrelation']		= create_double($this->RecruitmentApplicantData_model->getCoreFamilyRelation(),'family_relation_id','family_relation_name');

			$data['main_view']['coremaritalstatus']			= create_double($this->RecruitmentApplicantData_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');

			$data['main_view']['coreeducation']				= create_double($this->RecruitmentApplicantData_model->getCoreEducation(),'education_id','education_name');

			$data['main_view']['corelanguage']				= create_double($this->RecruitmentApplicantData_model->getCoreLanguage(),'language_id','language_name');

			$data['main_view']['coreexpertise']				= create_double($this->RecruitmentApplicantData_model->getCoreExpertise(),'expertise_id','expertise_name');

			$data['main_view']['gender']					= $this->configuration->Gender();
			$data['main_view']['bloodtype']					= $this->configuration->BloodType();
			$data['main_view']['religion']					= $this->configuration->Religion();
			$data['main_view']['residencestatus']			= $this->configuration->ResidenceStatus();
			$data['main_view']['nationality']				= $this->configuration->Nationality();
			$data['main_view']['idtype']					= $this->configuration->IDType();
			$data['main_view']['educationtype']				= $this->configuration->EducationType();
			$data['main_view']['listeningskill']			= $this->configuration->ListeningSkill();
			$data['main_view']['readingskill']				= $this->configuration->ReadingSkill();
			$data['main_view']['writingskill']				= $this->configuration->WritingSkill();
			$data['main_view']['speakingskill']				= $this->configuration->SpeakingSkill();
			$data['main_view']['subjectsstatus']			= $this->configuration->SubjectsStatus();
			$data['main_view']['workingenvironment']		= $this->configuration->WorkingEnvironment();
			$data['main_view']['organizationtype']			= $this->configuration->OrganizationType();
			$data['main_view']['organizationstatus']		= $this->configuration->OrganizationStatus();
			$data['main_view']['monthlist']					= $this->configuration->Month();
			$data['main_view']['status']					= $this->configuration->Status();
			$data['main_view']['separationletter']			= $this->configuration->SeparationLetter();
			$data['main_view']['sickopname']				= $this->configuration->SickOpname();
			$data['main_view']['colourblind']				= $this->configuration->ColourBlind();
			
			$data['main_view']['content']					= 'RecruitmentApplicantData/FormEditRecruitmentApplicantData_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_edit(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editRecruitmentApplicantData-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('editRecruitmentApplicantData-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editRecruitmentApplicantData-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editRecruitmentApplicantData-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editRecruitmentApplicantData-'.$unique['unique']);
			$this->session->unset_userdata('editarrayrecruitmentapplicantfamily-'.$unique['unique']);
			$this->session->unset_userdata('editarrayrecruitmentapplicanteducation-'.$unique['unique']);
			$this->session->unset_userdata('editarrayrecruitmentapplicantexpertise-'.$unique['unique']);
			$this->session->unset_userdata('editarrayrecruitmentapplicantexperience-'.$unique['unique']);
			$this->session->unset_userdata('editarrayrecruitmentapplicantlanguage-'.$unique['unique']);
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
		}

		public function processEditRecruitmentApplicantData(){
			$auth	 	= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');
		
			$data = array(
				'applicant_id'									=> $this->input->post('applicant_id',true),
				'applicant_name'								=> $this->input->post('applicant_name',true),	
				'applicant_application_date'					=> tgltodb($this->input->post('applicant_application_date',true)),
				'applicant_place_of_birth'						=> $this->input->post('applicant_place_of_birth',true),
				'applicant_date_of_birth'						=> tgltodb($this->input->post('applicant_date_of_birth',true)),
				'applicant_last_education'						=> $this->input->post('applicant_last_education',true),
				'applicant_address'								=> $this->input->post('applicant_address',true),
				'applicant_city'								=> $this->input->post('applicant_city',true),
				'applicant_postal_code'							=> $this->input->post('applicant_postal_code',true),
				'applicant_rt'									=> $this->input->post('applicant_rt',true),
				'applicant_rw'									=> $this->input->post('applicant_rw',true),
				'applicant_kecamatan'							=> $this->input->post('applicant_kecamatan',true),
				'applicant_kelurahan'							=> $this->input->post('applicant_kelurahan',true),
				'applicant_home_phone'							=> $this->input->post('applicant_home_phone',true),
				'applicant_mobile_phone'						=> $this->input->post('applicant_mobile_phone',true),
				'applicant_email_address'						=> $this->input->post('applicant_email_address',true),
				'applicant_residence_address'					=> $this->input->post('applicant_residence_address',true),
				'applicant_residence_city'						=> $this->input->post('applicant_residence_city',true),
				'applicant_residence_postal_code'				=> $this->input->post('applicant_residence_postal_code',true),
				'applicant_residence_rt'						=> $this->input->post('applicant_residence_rt',true),
				'applicant_residence_rw'						=> $this->input->post('applicant_residence_rw',true),
				'applicant_residence_kecamatan'					=> $this->input->post('applicant_residence_kecamatan',true),
				'applicant_residence_kelurahan'					=> $this->input->post('applicant_residence_kelurahan',true),
				'applicant_residence_status'					=> $this->input->post('applicant_residence_status',true),
				'applicant_gender'								=> $this->input->post('applicant_gender',true),
				'applicant_religion'							=> $this->input->post('applicant_religion',true),
				'applicant_nationality'							=> $this->input->post('applicant_nationality',true),
				'applicant_blood_type'							=> $this->input->post('applicant_blood_type',true),
				'applicant_heir_name'							=> $this->input->post('applicant_heir_name',true),
				'marital_status_id'								=> $this->input->post('marital_status_id',true),
				'applicant_id_type'								=> $this->input->post('applicant_id_type',true),
				'applicant_id_number'							=> $this->input->post('applicant_id_number',true),
			);
			
			/* print_r($data);
			exit; */
			$this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status Applicant', 'required');
			$this->form_validation->set_rules('applicant_address', 'Address', 'required');
			$this->form_validation->set_rules('applicant_city', 'City', 'required');
			$this->form_validation->set_rules('applicant_postal_code', 'Postal Code', 'required');
			$this->form_validation->set_rules('applicant_rt', 'RT', 'required');
			$this->form_validation->set_rules('applicant_rw', 'RW', 'required');
			$this->form_validation->set_rules('applicant_kecamatan', 'Kecamatan', 'required');
			$this->form_validation->set_rules('applicant_kelurahan', 'Kecamatan', 'required');
			
			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->updateRecruitmentApplicantData($data)){
					// $this->fungsi->set_log($auth['username'],'1003','Application.RecruitmentApplicantData.processAddRecruitmentApplicantData',$auth['username'],'Add New Applicant Data');
					$msg = "<div class='alert alert-success'>                
								Edit Applicant Data Success
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('editRecruitmentApplicantData-'.$unique['unique']);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
							Edit Applicant Data Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
					$this->session->set_userdata('message',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data['applicant_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data['applicant_id']);
			}
		}

		public function function_elements_edit_family(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editrecruitmentapplicantfamily-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editrecruitmentapplicantfamily-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_family(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editrecruitmentapplicantfamily-'.$unique['unique']);	
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
		}

		public function processAddRecruitmentApplicantFamily(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$data_recruitmentapplicantfamily = array(
				'family_relation_id' 					=> $this->input->post('family_relation_id',true),
				'applicant_id' 							=> $this->input->post('applicant_id',true),
				'marital_status_id' 					=> $this->input->post('marital_status_id',true),
				'applicant_family_name' 				=> $this->input->post('applicant_family_name',true),
				'applicant_family_address' 				=> $this->input->post('applicant_family_address',true),
				'applicant_family_city' 				=> $this->input->post('applicant_family_city',true),
				'applicant_family_postal_code' 			=> $this->input->post('applicant_family_postal_code',true),
				'applicant_family_rt' 					=> $this->input->post('applicant_family_rt',true),
				'applicant_family_rw' 					=> $this->input->post('applicant_family_rw',true),
				'applicant_family_kecamatan' 			=> $this->input->post('applicant_family_kecamatan',true),
				'applicant_family_kelurahan' 			=> $this->input->post('applicant_family_kelurahan',true),
				'applicant_family_home_phone' 			=> $this->input->post('applicant_family_home_phone',true),
				'applicant_family_mobile_phone' 		=> $this->input->post('applicant_family_mobile_phone',true),
				'applicant_family_gender' 				=> $this->input->post('applicant_family_gender',true),
				'applicant_family_date_of_birth' 		=> tgltodb($this->input->post('applicant_family_date_of_birth',true)),
				'applicant_family_place_of_birth' 		=> $this->input->post('applicant_family_place_of_birth',true),
				'applicant_family_education' 			=> $this->input->post('applicant_family_education',true),
				'applicant_family_remark' 				=> $this->input->post('applicant_family_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s")
			);

			// print_r($data_recruitmentapplicantfamily);exit;
			
			$this->form_validation->set_rules('family_relation_id', 'Family Relation', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			$this->form_validation->set_rules('applicant_family_name', 'Family Name', 'required');
			$this->form_validation->set_rules('applicant_family_address', 'Family Address', 'required');
			$this->form_validation->set_rules('applicant_family_city', 'Family City', 'required');
			$this->form_validation->set_rules('applicant_family_kecamatan', 'Family Kecamatan', 'required');
			$this->form_validation->set_rules('applicant_family_kelurahan', 'Family Kelurahan', 'required');
			$this->form_validation->set_rules('applicant_family_mobile_phone', 'Mobile Phone', 'required');
				
			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->insertRecruitmentApplicantFamily($data_recruitmentapplicantfamily) == true){

					$this->session->unset_userdata('editrecruitmentapplicantfamily-'.$unique['unique']);

					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.RecruitmentApplicantData.Add',$auth['username'],'Add Applicant Data');
					$msg = "<div class='alert alert-success'>                
								Add Applicant Family Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_family',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantfamily['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Applicant Family Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_family',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantfamily['applicant_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	", '</div>');
				$this->session->set_userdata('message_family',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantfamily['applicant_id']);
			}
		}

		public function deleteRecruitmentApplicantFamily(){
			$applicant_id 		= $this->uri->segment(3);
			$applicant_family_id = $this->uri->segment(4);

			$datadelete_recruitmentapplicantfamily = array (
				'applicant_family_id'	=> $applicant_family_id,
				'data_state'			=> 1,
			);

			if($this->RecruitmentApplicantData_model->deleteRecruitmentApplicantFamily($datadelete_recruitmentapplicantfamily)){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.RecruitmentApplicantData.delete',$auth['username'],'Delete RecruitmentApplicantData');
				$msg = "<div class='alert alert-success'>                
							Delete Applicant Family Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_family',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Applicant Family Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_family',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}
		}

		public function function_elements_edit_education(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editrecruitmentapplicanteducation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editrecruitmentapplicanteducation-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_education(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editrecruitmentapplicanteducation-'.$unique['unique']);	
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
		}

		public function processAddRecruitmentApplicantEducation(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$education_month_from				= $this->input->post('education_month_from',true);
			$education_year_from 				= $this->input->post('education_year_from',true);
			$education_month_to 				= $this->input->post('education_month_to',true);
			$education_year_to 					= $this->input->post('education_year_to',true);
			$applicant_education_from_period 	= $education_year_from.$education_month_from;
			$applicant_education_to_period 		= $education_year_to.$education_month_to;

			$data_recruitmentapplicanteducation = array(
				'applicant_id' 						=> $this->input->post('applicant_id',true),
				'education_id' 						=> $this->input->post('education_id',true),
				'applicant_education_type' 			=> $this->input->post('applicant_education_type',true),
				'applicant_education_name' 			=> $this->input->post('applicant_education_name',true),
				'applicant_education_city' 			=> $this->input->post('applicant_education_city',true),
				'applicant_education_from_period'	=> $applicant_education_from_period,
				'applicant_education_to_period' 	=> $applicant_education_to_period,
				'applicant_education_duration' 		=> $this->input->post('applicant_education_duration',true),
				'applicant_education_passed' 		=> $this->input->post('applicant_education_passed',true),
				'applicant_education_certificate'	=> $this->input->post('applicant_education_certificate',true),
				'applicant_education_remark'		=> $this->input->post('applicant_education_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);

			
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('applicant_education_type', 'Education Type', 'required');
			$this->form_validation->set_rules('applicant_education_from_period', 'From Period', 'numeric');
			$this->form_validation->set_rules('applicant_education_to_period', 'To Period', 'numeric');
			$this->form_validation->set_rules('applicant_education_duration', 'Duration', 'numeric');
			$this->form_validation->set_rules('applicant_education_name', 'Applicant Education Name', 'required');

			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->insertRecruitmentApplicantEducation($data_recruitmentapplicanteducation)){
					$auth = $this->session->userdata('auth');

					$this->session->unset_userdata('editrecruitmentapplicanteducation-'.$unique['unique']);

					// $this->fungsi->set_log($auth['username'],'1003','Application.RecruitmentApplicantEducation.processAddRecruitmentApplicantEducation',$auth['username'],'Add New Applicant Education');
					$msg = "<div class='alert alert-success'>                
								Add Data Applicant Education Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_education',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicanteducation['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Applicant Education UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_education',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicanteducation['applicant_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_education',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicanteducation['applicant_id']);
			}
		}

		public function deleteRecruitmentApplicantEducation(){
			$applicant_id 				= $this->uri->segment(3);
			$applicant_education_id 	= $this->uri->segment(4);

			$datadelete_recruitmentapplicanteducation = array (
				'applicant_education_id'		=> $applicant_education_id,
				'data_state'					=> 1,
			);

			if($this->RecruitmentApplicantData_model->deleteRecruitmentApplicantEducation($datadelete_recruitmentapplicanteducation)){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.RecruitmentApplicantData.delete',$auth['username'],'Delete RecruitmentApplicantData');
				$msg = "<div class='alert alert-success'>                
							Delete Applicant Education Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_education',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Applicant Education Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_education',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}
		}

		public function function_elements_edit_expertise(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editrecruitmentapplicantexpertise-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editrecruitmentapplicantexpertise-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_expertise(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editrecruitmentapplicantexpertise-'.$unique['unique']);	
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
		}

		public function processAddRecruitmentApplicantExpertise(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$expertise_month_from			= $this->input->post('expertise_month_from',true);
			$expertise_year_from 			= $this->input->post('expertise_year_from',true);
			$expertise_month_to 			= $this->input->post('expertise_month_to',true);
			$expertise_year_to 				= $this->input->post('expertise_year_to',true);
			$applicant_expertise_from_period = $expertise_year_from.$expertise_month_from;
			$applicant_expertise_to_period 	= $expertise_year_to.$expertise_month_to;

			$data_recruitmentapplicantexpertise = array(
				'applicant_id' 						=> $this->input->post('applicant_id',true),
				'expertise_id' 						=> $this->input->post('expertise_id',true),
				'applicant_expertise_name' 			=> $this->input->post('applicant_expertise_name',true),
				'applicant_expertise_city' 			=> $this->input->post('applicant_expertise_city',true),
				'applicant_expertise_from_period'	=> $applicant_expertise_from_period,
				'applicant_expertise_to_period' 	=> $applicant_expertise_to_period,
				'applicant_expertise_duration' 		=> $this->input->post('applicant_expertise_duration',true),
				'applicant_expertise_passed' 		=> $this->input->post('applicant_expertise_passed',true),
				'applicant_expertise_certificate'	=> $this->input->post('applicant_expertise_certificate',true),
				'applicant_expertise_remark'		=> $this->input->post('applicant_expertise_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('expertise_id', 'Expertise Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('applicant_expertise_from_period', 'From Period', 'numeric');
			$this->form_validation->set_rules('applicant_expertise_to_period', 'To Period', 'numeric');
			$this->form_validation->set_rules('applicant_expertise_duration', 'Duration', 'numeric');
			$this->form_validation->set_rules('applicant_expertise_name', 'Applicant Expertise Name', 'required');

			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->insertRecruitmentApplicantExpertise($data_recruitmentapplicantexpertise)){
					
					$this->session->unset_userdata('editrecruitmentapplicantexpertise-'.$unique['unique']);

					// $this->fungsi->set_log($auth['username'],'1003','Application.RecruitmentApplicantExpertise.processAddRecruitmentApplicantExpertise',$auth['username'],'Add New Applicant Expertise');
					$msg = "<div class='alert alert-success'>                
								Add Data Applicant Expertise Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_expertise',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantexpertise['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Applicant Expertise UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_expertise',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantexpertise['applicant_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_expertise',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantexpertise['applicant_id']);
			}
		}

		public function deleteRecruitmentApplicantExpertise(){
			$applicant_id 				= $this->uri->segment(3);
			$applicant_expertise_id 	= $this->uri->segment(4);

			$datadelete_recruitmentapplicantexpertise = array (
				'applicant_expertise_id'	=> $applicant_expertise_id,
				'data_state'				=> 1,
			);

			if($this->RecruitmentApplicantData_model->deleteRecruitmentApplicantExpertise($datadelete_recruitmentapplicantexpertise)){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.RecruitmentApplicantData.delete',$auth['username'],'Delete RecruitmentApplicantData');
				$msg = "<div class='alert alert-success'>                
							Delete Applicant Expertise Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_expertise',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Applicant Expertise Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_expertise',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}
		}


		public function function_elements_edit_experience(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editrecruitmentapplicantexperience-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editrecruitmentapplicantexperience-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit_experience(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editrecruitmentapplicantexperience-'.$unique['unique']);	
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
		}

		public function processAddRecruitmentApplicantExperience(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$experience_month_from 	= $this->input->post('work_month_from',true);
			$experience_year_from 	= $this->input->post('work_year_from',true);
			$experience_month_to 	= $this->input->post('work_month_to',true);
			$experience_year_to 	= $this->input->post('work_year_to',true);
			
			$experience_from_period = $experience_year_from.$experience_month_from;
			$experience_to_period 	= $experience_year_to.$experience_month_to;
			
			$data_recruitmentapplicantexperience = array(
				'applicant_id'							=> $this->input->post('applicant_id',true),
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
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');

			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->insertRecruitmentApplicantExperience($data_recruitmentapplicantexperience)){
					$this->session->unset_userdata('editrecruitmentapplicantexperience-'.$unique['unique']);

					$auth = $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1003','Application.RecruitmentApplicantWorking.processAddRecruitmentApplicantWorking',$auth['username'],'Add New Applicant Working');
					$msg = "<div class='alert alert-success'>                
								Add Data Applicant Experience Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_experience',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantexperience['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Applicant Experience UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_experience',$msg);
					$this->session->set_userdata('AddRecruitmentApplicantWorking',$data_recruitmentapplicantexperience);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantexperience['applicant_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_experience',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantexperience['applicant_id']);
			}
		}

		public function deleteRecruitmentApplicantExperience(){
			$applicant_id 			= $this->uri->segment(3);
			$applicant_experience_id	= $this->uri->segment(4);

			$datadelete_recruitmentapplicantexperience = array (
				'applicant_experience_id'	=> $applicant_experience_id,
				'data_state'				=> 1,
			);

			if($this->RecruitmentApplicantData_model->deleteRecruitmentApplicantExperience($datadelete_recruitmentapplicantexperience)){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.RecruitmentApplicantData.delete',$auth['username'],'Delete RecruitmentApplicantData');
				$msg = "<div class='alert alert-success'>                
							Delete Applicant Experience Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_experience',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Applicant Experience Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_experience',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}
		}


		public function function_elements_edit_language(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editrecruitmentapplicantlanguage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editrecruitmentapplicantlanguage-'.$unique['unique'],$sessions);
			echo $name;
		}

		public function reset_edit_language(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editrecruitmentapplicantlanguage-'.$unique['unique']);	
			redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
		}

		public function processAddRecruitmentApplicantLanguage(){
			$unique 		= $this->session->userdata('unique');
			$auth 			= $this->session->userdata('auth');

			$data_recruitmentapplicantlanguage = array(
				'applicant_id' 						=> $this->input->post('applicant_id',true),
				'language_id' 						=> $this->input->post('language_id',true),
				'applicant_language_listen' 		=> $this->input->post('applicant_language_listen',true),
				'applicant_language_read' 			=> $this->input->post('applicant_language_read',true),
				'applicant_language_write'			=> $this->input->post('applicant_language_write',true),
				'applicant_language_speak' 			=> $this->input->post('applicant_language_speak',true),
				'applicant_language_remark'			=> $this->input->post('applicant_language_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);

			
			$this->form_validation->set_rules('language_id', 'Language Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');

			if($this->form_validation->run()==true){
				if($this->RecruitmentApplicantData_model->insertRecruitmentApplicantLanguage($data_recruitmentapplicantlanguage)){
					$this->session->unset_userdata('editrecruitmentapplicantlanguage-'.$unique['unique']);					
					$auth = $this->session->userdata('auth');
					
					// $this->fungsi->set_log($auth['username'],'1003','Application.RecruitmentApplicantLanguage.processAddRecruitmentApplicantLanguage',$auth['username'],'Add New Applicant Language');
					$msg = "<div class='alert alert-success'>                
								Add Data Applicant Language Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_language',$msg);
					// $this->session->unset_userdata('AddRecruitmentApplicantLanguage');
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantlanguage['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Applicant Language Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message_language',$msg);
					redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantlanguage['applicant_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message_language',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$data_recruitmentapplicantlanguage['applicant_id']);
			}
		}

		public function deleteRecruitmentApplicantLanguage(){
			$applicant_id 			= $this->uri->segment(3);
			$applicant_language_id	= $this->uri->segment(4);

			$datadelete_recruitmentapplicantlanguage = array (
				'applicant_language_id'	=> $applicant_language_id,
				'data_state'			=> 1,
			);

			if($this->RecruitmentApplicantData_model->deleteRecruitmentApplicantLanguage($datadelete_recruitmentapplicantlanguage)){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.RecruitmentApplicantData.delete',$auth['username'],'Delete RecruitmentApplicantData');
				$msg = "<div class='alert alert-success'>                
							Delete Applicant Language Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_language',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Applicant Language Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message_language',$msg);
				redirect('RecruitmentApplicantData/editRecruitmentApplicantData/'.$applicant_id);
			}
		}

		public function function_state_recruit(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('recruitrecruitmentapplicanttab-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('recruitrecruitmentapplicanttab-'.$unique['unique'],$sessions);
		}

		public function function_elements_recruit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('recruitRecruitmentApplicantData-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('recruitRecruitmentApplicantData-'.$unique['unique'],$sessions);
		}

		public function reset_recruit(){
			$applicant_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('recruitRecruitmentApplicantData-'.$unique['unique']);
			$this->session->unset_userdata('recruitrecruitmentapplicanttab-'.$unique['unique']);
			redirect('RecruitmentApplicantData/recruitmentApplicantData/'.$applicant_id);
		}

		public function recruitmentApplicantData(){
			$applicant_id = $this->uri->segment(3);

			$data['main_view']['coreregion']						= create_double($this->RecruitmentApplicantData_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['corecompany']						= create_double($this->RecruitmentApplicantData_model->getCoreCompany(), 'company_id', 'company_name');

			$data['main_view']['coredivision']						= create_double($this->RecruitmentApplicantData_model->getCoreDivision(), 'division_id', 'division_name');

			$data['main_view']['corejobtitle']						= create_double($this->RecruitmentApplicantData_model->getCoreJobTitle(), 'job_title_id', 'job_title_name');

			$data['main_view']['coregrade']							= create_double($this->RecruitmentApplicantData_model->getCoreGrade(), 'grade_id', 'grade_name');

			$data['main_view']['coreclass']							= create_double($this->RecruitmentApplicantData_model->getCoreClass(), 'class_id', 'class_name');

			$data['main_view']['coredivision']						= create_double($this->RecruitmentApplicantData_model->getCoreDivision(), 'division_id', 'division_name');

			$data['main_view']['corebank']							= create_double($this->RecruitmentApplicantData_model->getCoreBank(), 'bank_id', 'bank_name');

			//$data['main_view']['RecruitmentApplicantData']			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($applicant_id);

			$data['main_view']['RecruitmentApplicantData']			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantfamily']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantFamily_Detail($applicant_id);

			$data['main_view']['recruitmentapplicanteducation']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantEducation_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantlanguage']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantLanguage_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantexpertise']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExpertise_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantexperience']	= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExperience_Detail($applicant_id);


			$data['main_view']['corefamilyrelation']				= create_double($this->RecruitmentApplicantData_model->getCoreFamilyRelation(),'family_relation_id','family_relation_name');

			$data['main_view']['coremaritalstatus']					= create_double($this->RecruitmentApplicantData_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');

			$data['main_view']['coreeducation']						= create_double($this->RecruitmentApplicantData_model->getCoreEducation(),'education_id','education_name');

			$data['main_view']['corelanguage']						= create_double($this->RecruitmentApplicantData_model->getCoreLanguage(),'language_id','language_name');

			$data['main_view']['coreexpertise']						= create_double($this->RecruitmentApplicantData_model->getCoreExpertise(),'expertise_id','expertise_name');

			
					


			$data['main_view']['path']								= $this->configuration->PhotoDirectory();
			$data['main_view']['gender']							= $this->configuration->Gender();
			$data['main_view']['religion']							= $this->configuration->Religion();
			$data['main_view']['bloodtype']							= $this->configuration->BloodType();
			$data['main_view']['workingstatus']						= $this->configuration->WorkingStatus();
			$data['main_view']['employeestatus']					= $this->configuration->EmployeeStatus();
			$data['main_view']['overtimestatus']					= $this->configuration->OvertimeStatus();	
			$data['main_view']['idtype']							= $this->configuration->IDType();
			$data['main_view']['payrollemployeelevel']				= $this->configuration->PayrollEmployeeLevel();
			$data['main_view']['dayoffstatus']						= $this->configuration->DayOffStatus();
			$data['main_view']['educationtype']						= $this->configuration->EducationType();
			// $data['main_view']['expertisetype']						= $this->configuration->ExpertiseType();
			$data['main_view']['separationletter']					= $this->configuration->SeparationLetter();
			// $data['main_view']['languagetype']						= $this->configuration->LanguageType();
			$data['main_view']['status']							= $this->configuration->Status();
			$data['main_view']['monthlist']							= $this->configuration->Month();
			$data['main_view']['listeningskill']					= $this->configuration->ListeningSkill();
			$data['main_view']['readingskill']						= $this->configuration->ReadingSkill();
			$data['main_view']['writingskill']						= $this->configuration->WritingSkill();
			$data['main_view']['speakingskill']						= $this->configuration->SpeakingSkill();
			
			$data['main_view']['content']							= 'RecruitmentApplicantData/FormDetailRecruitmentApplicantData_view';
			$this->load->view('MainPage_view',$data);	
		}

		public function getCoreBranch(){
			$region_id = $this->input->post('region_id');

			$item = $this->RecruitmentApplicantData_model->getCoreBranch($region_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[branch_id]'>$mp[branch_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreLocation(){
			$branch_id = $this->input->post('branch_id');

			$item = $this->RecruitmentApplicantData_model->getCoreLocation($branch_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[location_id]'>$mp[location_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->RecruitmentApplicantData_model->getCoreDepartment($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->RecruitmentApplicantData_model->getCoreSection($department_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreUnit(){
			$section_id = $this->input->post('section_id');

			$item = $this->RecruitmentApplicantData_model->getCoreUnit($section_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[unit_id]'>$mp[unit_name]</option>\n";	
			}
			echo $data;
		}

		public function processAddHROEmployeeData_Applicant(){
			$auth = $this->session->userdata('auth');
			$data = array (
				'applicant_id' 		=> $this->input->post('applicant_id'),
				'applicant_status'	=> 6,
				'data_state'		=> 1,
			);
			
			$RecruitmentApplicantData 			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($data['applicant_id']);

			$recruitmentapplicanteducation		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantEducation_Detail($data['applicant_id']);

			$recruitmentapplicantfamily			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantFamily_Detail($data['applicant_id']);

			$recruitmentapplicantlanguage		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantLanguage_Detail($data['applicant_id']);

			$recruitmentapplicantexpertise		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExpertise_Detail($data['applicant_id']);

			$recruitmentapplicantexperience		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExperience_Detail($data['applicant_id']);

			if($this->RecruitmentApplicantData_model->updateRecruitmentApplicantData($data)){
				$employeedata = array (
					'applicant_id' 							=> $this->input->post('applicant_id',true),
					'marital_status_id'						=> $this->input->post('marital_status_id',true),
					'region_id'								=> $this->input->post('region_id',true),
					'branch_id'								=> $this->input->post('branch_id',true),
					'location_id'							=> $this->input->post('location_id',true),
					'company_id'							=> $this->input->post('company_id',true),
					'division_id'							=> $this->input->post('division_id',true),
					'department_id'							=> $this->input->post('department_id',true),
					'section_id'							=> $this->input->post('section_id',true),
					'unit_id'								=> $this->input->post('unit_id',true),
					'job_title_id'							=> $this->input->post('job_title_id',true),
					'grade_id'								=> $this->input->post('grade_id',true),
					'class_id'								=> $this->input->post('class_id',true),
					'bank_id'								=> $this->input->post('bank_id'),
					'employee_name'							=> $this->input->post('applicant_name',true),		
					'employee_address'						=> $this->input->post('applicant_address',true),
					'employee_city'							=> $this->input->post('applicant_city',true),
					'employee_postal_code'					=> $this->input->post('applicant_postal_code',true),
					'employee_rt'							=> $this->input->post('applicant_rt',true),
					'employee_rw'							=> $this->input->post('applicant_rw',true),
					'employee_kelurahan'					=> $this->input->post('applicant_kelurahan',true),
					'employee_kecamatan'					=> $this->input->post('applicant_kecamatan',true),
					'employee_home_phone'					=> $this->input->post('applicant_home_phone',true),
					'employee_mobile_phone'					=> $this->input->post('applicant_mobile_phone',true),
					'employee_email_address'				=> $this->input->post('applicant_email_address',true),
					'employee_gender'						=> $this->input->post('applicant_gender',true),
					'employee_date_of_birth'				=> tgltodb($this->input->post('applicant_date_of_birth',true)),
					'employee_place_of_birth'				=> $this->input->post('applicant_place_of_birth',true),
					'employee_id_type'						=> $this->input->post('applicant_id_type',true),
					'employee_id_number'					=> $this->input->post('applicant_id_number',true),
					'employee_religion'						=> $this->input->post('applicant_religion',true),
					'employee_blood_type'					=> $this->input->post('applicant_blood_type',true),
					'employee_residential_address'			=> $this->input->post('applicant_residence_address',true),
					'employee_residential_city'				=> $this->input->post('applicant_residence_city',true),
					'employee_residential_postal_code'		=> $this->input->post('applicant_residence_postal_code',true),
					'employee_residential_rt'				=> $this->input->post('applicant_residence_rt',true),
					'employee_residential_rw'				=> $this->input->post('applicant_residence_rw',true),
					'employee_residential_kecamatan'		=> $this->input->post('applicant_residence_kecamatan',true),
					'employee_residential_kelurahan'		=> $this->input->post('applicant_residence_kelurahan',true),
					'employee_heir_name'					=> $this->input->post('applicant_heir_name',true),
					'employee_bank_acct_no'					=> $this->input->post('applicant_bank_acct_no'),
					'employee_bank_acct_name'				=> $this->input->post('applicant_bank_acct_name'),
					'employee_code'							=> $this->input->post('employee_code'),
					'employee_rfid_code'					=> $this->input->post('employee_rfid_code'),
					// 'employee_last_day_off'					=> tgltodb($this->input->post('employee_last_day_off',true)),
					// 'employee_day_off_cycle' 				=> $this->input->post('employee_day_off_cycle',true),
					// 'employee_day_off_status'				=> $this->input->post('employee_day_off_status',true),
					// 'employee_employment_working_status'	=> $this->input->post('employee_employment_working_status',true),
					'employee_employment_overtime_status'	=> $this->input->post('employee_employment_overtime_status',true),
					'employee_employment_status'			=> $this->input->post('employee_employment_status',true),
					'employee_hire_date'					=> date("Y-m-d"),
					'employee_employment_status_date'		=> date("Y-m-d"),
					'employee_employment_status_duedate'	=> tgltodb($this->input->post('employee_employment_status_duedate',true)),
					'created_id'							=> $auth['user_id'],
					'created_on'							=> date("YmdHis"),
					'data_state'							=> 0,
				);
				
				// print_r("data:");
				// print_r($employeedata);
				// exit();

				if($this->RecruitmentApplicantData_model->insertHROemployeeData($employeedata)){
					$employee_id = $this->RecruitmentApplicantData_model->getEmployeeID($employeedata['created_id']);

					if(!empty($recruitmentapplicanteducation)){
						foreach ($recruitmentapplicanteducation as $keyEdu => $valEdu) {
							$employeeeducation = array (
								'employee_id' 						=> $employee_id,
								'education_id' 						=> $valEdu['education_id'],
								'employee_education_type' 			=> $valEdu['applicant_education_type'],
								'employee_education_name' 			=> $valEdu['applicant_education_name'],
								'employee_education_city' 			=> $valEdu['applicant_education_city'],
								'employee_education_from_period'	=> $valEdu['applicant_education_from_period'],
								'employee_education_to_period' 		=> $valEdu['applicant_education_to_period'],
								'employee_education_duration' 		=> $valEdu['applicant_education_duration'],
								'employee_education_passed' 		=> $valEdu['applicant_education_passed'],
								'employee_education_certificate'	=> $valEdu['applicant_education_certificate'],
								'employee_education_remark'			=> $valEdu['applicant_education_remark'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s")
							);	

							$this->RecruitmentApplicantData_model->insertHROemployeeEducation($employeeeducation);
						}
					}

					if(!empty($recruitmentapplicantfamily)){
						foreach ($recruitmentapplicantfamily as $keyFamily => $valFamily) {
							$employeefamily = array (
								'employee_id' 							=> $employee_id,
								'family_relation_id' 					=> $valFamily['family_relation_id'],
								'marital_status_id' 					=> $valFamily['marital_status_id'],
								'employee_family_name' 					=> $valFamily['applicant_family_name'],
								'employee_family_address' 				=> $valFamily['applicant_family_address'],
								'employee_family_city' 					=> $valFamily['applicant_family_city'],
								'employee_family_postal_code' 			=> $valFamily['applicant_family_postal_code'],
								'employee_family_rt' 					=> $valFamily['applicant_family_rt'],
								'employee_family_rw' 					=> $valFamily['applicant_family_rw'],
								'employee_family_kecamatan' 			=> $valFamily['applicant_family_kecamatan'],
								'employee_family_kelurahan' 			=> $valFamily['applicant_family_kelurahan'],
								'employee_family_home_phone' 			=> $valFamily['applicant_family_home_phone'],
								'employee_family_mobile_phone' 			=> $valFamily['applicant_family_mobile_phone'],
								'employee_family_gender' 				=> $valFamily['applicant_family_gender'],
								'employee_family_date_of_birth' 		=> $valFamily['applicant_family_date_of_birth'],
								'employee_family_place_of_birth' 		=> $valFamily['applicant_family_place_of_birth'],
								'employee_family_education' 			=> $valFamily['applicant_family_education'],
								'employee_family_remark' 				=> $valFamily['applicant_family_remark'],
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s")
							);	

							$this->RecruitmentApplicantData_model->insertHROemployeeFamily($employeefamily);
						}
					}

					if(!empty($recruitmentapplicantlanguage)){
						foreach ($recruitmentapplicantlanguage as $keyLanguage => $valLanguage) {
							$employeelanguage = array (
								'employee_id' 						=> $employee_id,
								'language_id' 						=> $valLanguage['language_id'],
								'employee_language_listen' 			=> $valLanguage['applicant_language_listen'],
								'employee_language_read' 			=> $valLanguage['applicant_language_read'],
								'employee_language_write'			=> $valLanguage['applicant_language_write'],
								'employee_language_speak' 			=> $valLanguage['applicant_language_speak'],
								'employee_language_remark'			=> $valLanguage['applicant_language_reamrk'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);	

							$this->RecruitmentApplicantData_model->insertHROemployeeLanguage($employeelanguage);
						}
					}

					if(!empty($recruitmentapplicantexpertise)){
						foreach ($recruitmentapplicantexpertise as $keyExpertise => $valExpertise) {
							$employeeexpertise = array (
								'employee_id' 						=> $employee_id,
								'expertise_id' 						=> $valExpertise['expertise_id'],
								'employee_expertise_name' 			=> $valExpertise['applicant_expertise_name'],
								'employee_expertise_city' 			=> $valExpertise['applicant_expertise_city'],
								'employee_expertise_from_period'	=> $valExpertise['applicant_expertise_from_period'],
								'employee_expertise_to_period' 		=> $valExpertise['applicant_expertise_to_period'],
								'employee_expertise_duration' 		=> $valExpertise['applicant_expertise_duration'],
								'employee_expertise_passed' 		=> $valExpertise['applicant_expertise_passed'],
								'employee_expertise_certificate'	=> $valExpertise['applicant_expertise_certificate'],
								'employee_expertise_remark'			=> $valExpertise['applicant_expertise_remark'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);	

							$this->RecruitmentApplicantData_model->insertHROemployeeExpertise($employeeexpertise);
						}
					}

					if(!empty($recruitmentapplicantexperience)){
						foreach ($recruitmentapplicantexperience as $keyExperience => $valExperience) {
							$employeeexperience = array (
								'employee_id'							=> $employee_id,
								'experience_from_period'				=> $valExperience['experience_from_period'],
								'experience_to_period'					=> $valExperience['experience_to_period'],
								'experience_company_name'				=> $valExperience['experience_company_name'],
								'experience_company_address'			=> $valExperience['experience_company_address'],
								'experience_job_title'					=> $valExperience['experience_job_title'],
								'experience_last_salary'				=> $valExperience['experience_last_salary'],
								'experience_separation_reason'			=> $valExperience['experience_separation_reason'],
								'experience_separation_letter'			=> $valExperience['experience_separation_letter'],
								'experience_remark'						=> $valExperience['experience_remark'],
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s"),
							);	

							$this->RecruitmentApplicantData_model->insertHROemployeeExperience($employeeexperience);
						}
					}

					$record_to_employee = array(
						'applicant_id'						=> $this->input->post('applicant_id',true),
						'applicant_name'					=> $this->input->post('applicant_name',true),
						'applicant_application_date'		=> tgltodb($this->input->post('applicant_application_date',true)),
						'applicant_address'					=> $this->input->post('applicant_address',true),
						'applicant_status'					=> $this->input->post('applicant_status',true),
						'applicant_status_date'				=> tgltodb($this->input->post('applicant_status_date',true)),
						'applicant_status_remark'			=> $this->input->post('applicant_status_remark',true),
						'applicant_status_remark_date'		=> tgltodb($this->input->post('applicant_status_remark_date',true)),
						'applicant_status_remark_id'		=> $auth['user_id'],
						'applicant_status_remark_on'		=> date("Y-m-d H:i:s"),
						'created_id'						=> $auth['user_id'],
						'created_on'						=> date("Y-m-d H:i:s"),
					);

					// print_r("data:");
					// print_r($record_to_employee);
					// exit();
					$this->RecruitmentApplicantData_model->insertRecordToEmployee($record_to_employee);
				}				
				$msg = "<div class='alert alert-success'>                
								Recruitment Employee Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('RecruitmentApplicantDataStatusFinal/');
			} else {
				$msg = "<div class='alert alert-danger'>                
								Recruitment Employee Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('RecruitmentApplicantDataStatusFinal/recruitmentApplicantData/'.$data['applicant_id']);
			}
		}
		

		public function function_elements_add_other(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantother-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantother-'.$unique['unique'],$sessions);
		}



		public function function_elements_add_organization(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantorganization-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantorganization-'.$unique['unique'],$sessions);
		}

		public function reset_add_organization(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addrecruitmentapplicantorganization-'.$unique['unique']);
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}
		
		public function processAddArrayRecruitmentApplicantOrganization(){
			$data_organization = array(
				'applicant_organization_record_id'		=> date("YmdHis"),
				'organization_name'						=> $this->input->post('organization_name', true),
				'organization_type'						=> $this->input->post('organization_type', true),
				'organization_period'					=> $this->input->post('organization_period', true),
				'organization_title'					=> $this->input->post('organization_title', true),
				'organization_status'					=> $this->input->post('organization_status', true),
			);
			$this->form_validation->set_rules('organization_name', 'Organization Name', 'required');		
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicantorganization-'.$unique['unique']);
				$dataArrayHeader[$data_organization['applicant_organization_record_id']] = $data_organization;
				
				$this->session->set_userdata('addarrayrecruitmentapplicantorganization-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addrecruitmentapplicantorganization-'.$unique['unique']);
				$this->session->unset_userdata('addrecruitmentapplicantother-'.$unique['unique']);
				redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayRecruitmentApplicantOrganization(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayrecruitmentapplicantorganization-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayrecruitmentapplicantorganization-'.$unique['unique'],$arrayBaru);
			
			redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
		}

		public function formaddarraypersonality(){
			$data_personality = array(
				'applicant_personality_record_id'	=> date("YmdHis"),
				'applicant_strength_remark'			=> $this->input->post('applicant_strength_remark', true),
				'applicant_weakness_remark'			=> $this->input->post('applicant_weakness_remark', true),
				
			);
			
			$this->form_validation->set_rules('applicant_strength_remark', 'Kelebihan', 'required');
			$this->form_validation->set_rules('applicant_weakness_remark', 'Kelemahan', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarraypersonality-'.$unique['unique']);
				$dataArrayHeader[$data_personality['applicant_personality_record_id']] = $data_personality;
								
				$this->session->set_userdata('addarraypersonality-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addarraypersonality-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function function_elements_add_medical_detail(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addrecruitmentapplicantmedical-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addrecruitmentapplicantmedical-'.$unique['unique'],$sessions);
		}

			public function processAddArrayRecruitmentApplicantMedical(){
			$data_medical = array(
				'applicant_medical_record_id'				=> date("YmdHis"),
				'applicant_weight'							=> $this->input->post('applicant_weight', true),
				'applicant_height'							=> $this->input->post('applicant_height', true),
				'applicant_sick_opname'						=> $this->input->post('applicant_sick_opname', true),
				'applicant_sick_disease'					=> $this->input->post('applicant_sick_disease', true),
				'applicant_sick_how_long'					=> $this->input->post('applicant_sick_how_long', true),
				'applicant_sick_year'						=> $this->input->post('applicant_sick_year', true),
				'applicant_sick_hospital'					=> $this->input->post('applicant_sick_hospital', true),
				'applicant_colour_blind'					=> $this->input->post('applicant_colour_blind', true),
				'family_relation_id'						=> $this->input->post('family_relation_id', true),
				'applicant_medical_disease'					=> $this->input->post('applicant_medical_disease', true),
				'applicant_medical_name'					=> $this->input->post('applicant_medical_name', true),
			);

			$this->form_validation->set_rules('family_relation_id', 'Hubungan Keluarga', 'required');		
			$this->form_validation->set_rules('applicant_medical_name', 'Nama', 'required');		
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayrecruitmentapplicantmedical-'.$unique['unique']);
				$dataArrayHeader[$data_medical['applicant_medical_record_id']] = $data_medical;
				
				$this->session->set_userdata('addarrayrecruitmentapplicantmedical-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addarrayrecruitmentapplicantmedical-'.$unique['unique']);
				
				redirect('RecruitmentApplicantData/addRecruitmentApplicantData');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function ApplicantDataStatus(){
			$applicant_id = $this->uri->segment(3);

			$data['main_view']['coreregion']						= create_double($this->RecruitmentApplicantData_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coredivision']						= create_double($this->RecruitmentApplicantData_model->getCoreDivision(), 'division_id', 'division_name');

			$data['main_view']['corejobtitle']						= create_double($this->RecruitmentApplicantData_model->getCoreJobTitle(), 'job_title_id', 'job_title_name');

			$data['main_view']['coregrade']							= create_double($this->RecruitmentApplicantData_model->getCoreGrade(), 'grade_id', 'grade_name');

			$data['main_view']['coreclass']							= create_double($this->RecruitmentApplicantData_model->getCoreClass(), 'class_id', 'class_name');

			$data['main_view']['coredivision']						= create_double($this->RecruitmentApplicantData_model->getCoreDivision(), 'division_id', 'division_name');

			$data['main_view']['corebank']							= create_double($this->RecruitmentApplicantData_model->getCoreBank(), 'bank_id', 'bank_name');

			//$data['main_view']['RecruitmentApplicantData']			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($applicant_id);

			$data['main_view']['RecruitmentApplicantData']			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantfamily']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantFamily_Detail($applicant_id);

			$data['main_view']['recruitmentapplicanteducation']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantEducation_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantlanguage']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantLanguage_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantexpertise']		= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExpertise_Detail($applicant_id);

			$data['main_view']['recruitmentapplicantexperience']	= $this->RecruitmentApplicantData_model->getRecruitmentApplicantExperience_Detail($applicant_id);


			$data['main_view']['corefamilyrelation']				= create_double($this->RecruitmentApplicantData_model->getCoreFamilyRelation(),'family_relation_id','family_relation_name');

			$data['main_view']['coremaritalstatus']					= create_double($this->RecruitmentApplicantData_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');

			$data['main_view']['coreeducation']						= create_double($this->RecruitmentApplicantData_model->getCoreEducation(),'education_id','education_name');

			$data['main_view']['corelanguage']						= create_double($this->RecruitmentApplicantData_model->getCoreLanguage(),'language_id','language_name');

			$data['main_view']['coreexpertise']						= create_double($this->RecruitmentApplicantData_model->getCoreExpertise(),'expertise_id','expertise_name');

			
					

			$data['main_view']['statusapplicant']								= $this->configuration->StatusApplicant();
			$data['main_view']['path']								= $this->configuration->PhotoDirectory();
			$data['main_view']['gender']							= $this->configuration->Gender();
			$data['main_view']['religion']							= $this->configuration->Religion();
			$data['main_view']['bloodtype']							= $this->configuration->BloodType();
			$data['main_view']['workingstatus']						= $this->configuration->WorkingStatus();
			$data['main_view']['employeestatus']					= $this->configuration->EmployeeStatus();
			$data['main_view']['overtimestatus']					= $this->configuration->OvertimeStatus();	
			$data['main_view']['idtype']							= $this->configuration->IDType();
			$data['main_view']['payrollemployeelevel']				= $this->configuration->PayrollEmployeeLevel();
			$data['main_view']['dayoffstatus']						= $this->configuration->DayOffStatus();
			$data['main_view']['educationtype']						= $this->configuration->EducationType();
			// $data['main_view']['expertisetype']						= $this->configuration->ExpertiseType();
			$data['main_view']['separationletter']					= $this->configuration->SeparationLetter();
			// $data['main_view']['languagetype']						= $this->configuration->LanguageType();
			$data['main_view']['status']							= $this->configuration->Status();
			$data['main_view']['monthlist']							= $this->configuration->Month();
			$data['main_view']['listeningskill']					= $this->configuration->ListeningSkill();
			$data['main_view']['readingskill']						= $this->configuration->ReadingSkill();
			$data['main_view']['writingskill']						= $this->configuration->WritingSkill();
			$data['main_view']['speakingskill']						= $this->configuration->SpeakingSkill();
			
			$data['main_view']['content']							= 'RecruitmentApplicantData/FormDetailRecruitmentApplicantDataStatus_view';
			$this->load->view('MainPage_view',$data);	
		}

		public function processRecruitmentApplicantStatus(){
			$auth = $this->session->userdata('auth');
			$data = array (
				'applicant_id' 					=> $this->input->post('applicant_id'),
				'applicant_status'				=> $this->input->post('applicant_status_next'),
				'applicant_status_date'			=> tgltodb($this->input->post('applicant_status_next_date')),
				'applicant_status_next'			=> $this->input->post('applicant_status_next'),
				'applicant_status_next_date'	=> tgltodb($this->input->post('applicant_status_next_date')),
				'applicant_status_remark'		=> $this->input->post('applicant_status_remark'),
			);
			
			// print_r("data:");
			// print_r($data);
			// exit;
			$RecruitmentApplicantData 			= $this->RecruitmentApplicantData_model->getRecruitmentApplicantData_Detail($data['applicant_id']);

			if($this->RecruitmentApplicantData_model->updateRecruitmentApplicantData($data)){
				$applicantstatusdata = array (
					'applicant_id'							=> $this->input->post('applicant_id',true),
					'applicant_name'						=> $this->input->post('applicant_name',true),
					'applicant_application_date'			=> tgltodb($this->input->post('applicant_application_date',true)),
					'applicant_status'						=> $this->input->post('applicant_status',true),
					'applicant_status_date'					=> tgltodb($this->input->post('applicant_status_date',true)),
					'applicant_status_next'					=> $this->input->post('applicant_status_next',true),
					'applicant_status_next_date'			=> tgltodb($this->input->post('applicant_status_next_date',true)),
					'applicant_status_remark'				=> $this->input->post('applicant_status_remark'),
					'created_id'							=> $auth['user_id'],
					'created_on'							=> date("YmdHis"),
					'data_state'							=> 0,
				);
				// print_r("data:");
				// print_r($applicantstatusdata);
				// exit;
				$this->RecruitmentApplicantData_model->insertApplicantStatus($applicantstatusdata);
				$msg = "<div class='alert alert-success'>                
								Recruitment Status Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('RecruitmentApplicantDataStatus/');
			} else {
				$msg = "<div class='alert alert-danger'>                
								Recruitment Employee Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('RecruitmentApplicantData/ApplicantDataStatus/'.$data['applicant_id']);
			}
		}
	}
?>