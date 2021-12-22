<?php
	Class addnewapplicant extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('addnewapplicant_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			// $this->lists();
			$this->applicantdata();
		}
		
		function applicantdata(){
			$data['main_view']['content']		= 'addnewapplicant/applicantdata_view';
			$data['main_view']['maritalstatus']	= create_double($this->addnewapplicant_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddapplicantdata(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			
			$auth = $this->session->userdata('auth');
			$data = array(
				'applicant_name'	=> $this->input->post('applicant_name',true),	
				'applicant_application_date'	=> $this->input->post('applicant_application_date',true),
				'applicant_address'	=> $this->input->post('applicant_address',true),
				'applicant_city'	=> $this->input->post('applicant_city',true),
				'applicant_zip_code'	=> $this->input->post('applicant_zip_code',true),
				'applicant_rt'	=> $this->input->post('applicant_rt',true),
				'applicant_rw'	=> $this->input->post('applicant_rw',true),
				'applicant_kecamatan'	=> $this->input->post('applicant_kecamatan',true),
				'applicant_kelurahan'	=> $this->input->post('applicant_kelurahan',true),
				'applicant_home_phone'	=> $this->input->post('applicant_home_phone',true),
				'applicant_mobile_phone'	=> $this->input->post('applicant_mobile_phone',true),
				'applicant_email_address'	=> $this->input->post('applicant_email_address',true),
				'applicant_residence_address'	=> $this->input->post('applicant_residence_address',true),
				'applicant_residence_city'	=> $this->input->post('applicant_residence_city',true),
				'applicant_residence_zip_code'	=> $this->input->post('applicant_residence_zip_code',true),
				'applicant_residence_rt'	=> $this->input->post('applicant_residence_rt',true),
				'applicant_residence_rw'	=> $this->input->post('applicant_residence_rw',true),
				'applicant_residence_kecamatan'	=> $this->input->post('applicant_residence_kecamatan',true),
				'applicant_residence_kelurahan'	=> $this->input->post('applicant_residence_kelurahan',true),
				'applicant_residence_status'	=> $this->input->post('applicant_residence_status',true),
				'applicant_religion'	=> $this->input->post('applicant_religion',true),
				'applicant_nationality'	=> $this->input->post('applicant_nationality',true),
				'marital_status_id'	=> $this->input->post('marital_status_id',true),
				'applicant_id_number'	=> $this->input->post('applicant_id_number',true),
				'applicant_education_cost'	=> $this->input->post('applicant_education_cost',true),
				'applicant_winner_status'	=> $this->input->post('applicant_winner_status',true),
				'applicant_winner_remark'	=> $this->input->post('applicant_winner_remark',true),
				'applicant_grade_fail'	=> $this->input->post('applicant_grade_fail',true),
				'applicant_grade_fail_remark'	=> $this->input->post('applicant_grade_fail_remark',true),
				'applicant_grade_fail_reason'	=> $this->input->post('applicant_grade_fail_reason',true),
				'applicant_further_study'	=> $this->input->post('applicant_further_study',true),
				'applicant_further_study_field'	=> $this->input->post('applicant_further_study_field',true),
				'applicant_further_study_period'	=> $this->input->post('applicant_further_study_period',true),
				'applicant_has_team_member'	=> $this->input->post('applicant_has_team_member',true),
				'applicant_team_member'	=> $this->input->post('applicant_team_member',true),
				'applicant_how_manage_team_member'	=> $this->input->post('applicant_how_manage_team_member',true),
				'applicant_head_expectation'	=> $this->input->post('applicant_head_expectation',true),
				'applicant_new_ideas'	=> $this->input->post('applicant_new_ideas',true),
				'applicant_achievement'	=> $this->input->post('applicant_achievement',true),
				'applicant_achievement_satisfaction'	=> $this->input->post('applicant_achievement_satisfaction',true),
				'applicant_application_position'	=> $this->input->post('applicant_application_position',true),
				'applicant_expected_salary'	=> $this->input->post('applicant_expected_salary',true),
				'applicant_out_of_town'	=> $this->input->post('applicant_out_of_town',true),
				'applicant_out_of_town_remark'	=> $this->input->post('applicant_out_of_town_remark',true),
				'applicant_immediately_work'	=> $this->input->post('applicant_immediately_work',true),
				'applicant_immediately_work_remark'	=> $this->input->post('applicant_immediately_work_remark',true),
				'applicant_overtime_ready'	=> $this->input->post('applicant_overtime_ready',true),
				'applicant_overtime_ready_remark'	=> $this->input->post('applicant_overtime_ready_remark',true),
				'applicant_business_trip'	=> $this->input->post('applicant_business_trip',true),
				'applicant_business_trip_remark'	=> $this->input->post('applicant_business_trip_remark',true),
				'applicant_work_environment'	=> $this->input->post('applicant_work_environment',true),
				'applicant_work_environment_other'	=> $this->input->post('applicant_work_environment_other',true),
				'applicant_most_like_work'	=> $this->input->post('applicant_most_like_work',true),
				'applicant_most_dislike_work'	=> $this->input->post('applicant_most_dislike_work',true),
				'applicant_hobby'	=> $this->input->post('applicant_hobby',true),
				'applicant_hobby_active'	=> $this->input->post('applicant_hobby_active',true),
				'applicant_interest_other_work'	=> $this->input->post('applicant_interest_other_work',true),
				'applicant_good_book'	=> $this->input->post('applicant_good_book',true),
				'applicant_dream_of_life'	=> $this->input->post('applicant_dream_of_life',true),
				'applicant_dream_achieve'	=> $this->input->post('applicant_dream_achieve',true),
				'applicant_weight'	=> $this->input->post('applicant_weight',true),
				'applicant_height'	=> $this->input->post('applicant_height',true),
				'applicant_sick_opname'	=> $this->input->post('applicant_sick_opname',true),
				'applicant_sick_disease'	=> $this->input->post('applicant_sick_disease',true),
				'applicant_sick_duration'	=> $this->input->post('applicant_sick_duration',true),
				'applicant_sick_year'	=> $this->input->post('applicant_sick_year',true),
				'applicant_sick_hospital'	=> $this->input->post('applicant_sick_hospital',true),
				'applicant_colour_blind'	=> $this->input->post('applicant_colour_blind',true),
				'applicant_work_friend_name1'	=> $this->input->post('applicant_work_friend_name1',true),
				'applicant_work_friend_section1'	=> $this->input->post('applicant_work_friend_section1',true),
				'applicant_work_friend_relationship1'	=> $this->input->post('applicant_work_friend_relationship1',true),
				'applicant_work_friend_name2'	=> $this->input->post('applicant_work_friend_name2',true),
				'applicant_work_friend_section2'	=> $this->input->post('applicant_work_friend_section2',true),
				'applicant_work_friend_relationship2'	=> $this->input->post('applicant_work_friend_relationship2',true),
				'applicant_emergency_name'	=> $this->input->post('applicant_emergency_name',true),
				'applicant_emergency_address'	=> $this->input->post('applicant_emergency_address',true),
				'applicant_emergency_mobile_phone'	=> $this->input->post('applicant_emergency_mobile_phone',true),
				'applicant_emergency_home_phone'	=> $this->input->post('applicant_emergency_home_phone',true),
				'applicant_emergency_relationship'	=> $this->input->post('applicant_emergency_relationship',true),
				'applicant_daily_transportation_name1'	=> $this->input->post('applicant_daily_transportation_name1',true),
				'applicant_daily_transportation_year1'	=> $this->input->post('applicant_daily_transportation_year1',true),
				'applicant_daily_transportation_owned1'	=> $this->input->post('applicant_daily_transportation_owned1',true),
				'applicant_daily_transportation_name2'	=> $this->input->post('applicant_daily_transportation_name2',true),
				'applicant_daily_transportation_year2'	=> $this->input->post('applicant_daily_transportation_year2',true),
				'applicant_daily_transportation_owned2'	=> $this->input->post('applicant_daily_transportation_owned2',true),
				'applicant_ready_no_married'	=> $this->input->post('applicant_ready_no_married',true),
				'data_state'						=> '0',
				'created_by'						=> $this->input->post('created_by',true),
				'created_on'						=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			if($this->form_validation->run()==true){
				$this->session->unset_userdata('addnewapplicant-'.$sesi['unique'],$data);
				$this->session->set_userdata('addnewapplicant-'.$sesi['unique'],$data);
				redirect('addnewapplicant/applicanteducation');
			}else{
				$this->session->unset_userdata('addnewapplicant-'.$sesi['unique'],$data);
				$this->session->set_userdata('addnewapplicant-'.$sesi['unique'],$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant');
			}
		}
//-----------------------------------------------------------------------------------------------------------------------------------------------		
//------------------------------Education--------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------		
		function applicanteducation(){
			$data['main_view']['content']		= 'addnewapplicant/applicanteducation_view';
			$data['main_view']['education']	= create_double($this->addnewapplicant_model->geteducation(),'education_id','education_name');
			$this->load->view('mainpage_view',$data);
		}

		function arrayaddapplicanteducation(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
				'education_id'=> $this->input->post('education_id',true),
				'education_type'=> $this->input->post('education_type',true),
				'applicant_education_name'=> $this->input->post('applicant_education_name',true),
				'applicant_education_city'=> $this->input->post('applicant_education_city',true),
				'applicant_education_from_period'=> $this->input->post('applicant_education_from_period',true),
				'applicant_education_to_period'=> $this->input->post('applicant_education_to_period',true),
				'applicant_education_duration'=> $this->input->post('applicant_education_duration',true),
				'applicant_education_passed'=> $this->input->post('applicant_education_passed',true),
				'applicant_education_certificate'=> $this->input->post('applicant_education_certificate',true),
				'applicant_education_remark'=> $this->input->post('applicant_education_remark',true),
				'data_state'							=> '0',
				'created_by'						=> $this->input->post('created_by',true),
				'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('education_id', 'Education', 'required');
			$this->form_validation->set_rules('education_type', 'Type', 'required');
			$this->form_validation->set_rules('applicant_education_name', 'Name', 'required|alpha-numeric');
			$this->form_validation->set_rules('applicant_education_city', 'City', 'required|alpha-numeric');
			$this->form_validation->set_rules('applicant_education_from_period', 'From', 'required|numeric');
			$this->form_validation->set_rules('applicant_education_to_period', 'To', 'required|numeric');
			$this->form_validation->set_rules('applicant_education_duration', 'Duration', 'required|numeric');
			$this->form_validation->set_rules('applicant_education_passed', 'Passed', 'required');
			$this->form_validation->set_rules('applicant_education_certificate', 'Certification', 'required');
			$this->form_validation->set_rules('applicant_education_remark', 'Certification', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicanteducation-'.$sesi['unique']);
				$this->session->set_userdata('addapplicanteducation-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicanteducation-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicanteducation-".$data_header['created_by']);
				
				// $dataArray[$data_item['education_id'].$data_item['education_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicanteducation-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicanteducation');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicanteducation');
			}else{
				$this->session->set_userdata('addapplicanteducation',$data_item);
				$this->session->set_userdata('addapplicanteducation-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicanteducation');
			}
		}
		
		public function resetapplicanteducation(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicanteducation-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicanteducation-".$header['created_by']);
			$this->session->unset_userdata('addapplicanteducation-'.$sesi['unique']);
			redirect('addnewapplicant/applicanteducation');
		}
		
		public function deletearrayapplicanteducationitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicanteducation				= $this->session->userdata("dataitemaddapplicanteducation-".$created_by);
			print_r($applicanteducation); exit;
			foreach($applicanteducation as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicanteducation-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicanteducation-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicanteducation-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicanteducation');
		}
		
		function processaddapplicanteducation(){
			redirect('addnewapplicant/applicantfamily');
		}
		
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Family-----------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
		function applicantfamily(){
			$data['main_view']['content']		= 'addnewapplicant/applicantfamily_view';
			$data['main_view']['maritalstatus']	= create_double($this->addnewapplicant_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$data['main_view']['familystatus']	= create_double($this->addnewapplicant_model->getfamilystatus(),'family_status_id','family_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
		
 		function arrayaddapplicantfamily(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'family_status_id'						=> $this->input->post('family_status_id',true),
							'applicant_family_name'					=> $this->input->post('applicant_family_name',true),
							'applicant_family_address'				=> $this->input->post('applicant_family_address',true),
							'applicant_family_city'					=> $this->input->post('applicant_family_city',true),
							'applicant_family_zip_code'				=> $this->input->post('applicant_family_zip_code',true),
							'applicant_family_rt'					=> $this->input->post('applicant_family_rt',true),
							'applicant_family_rw'					=> $this->input->post('applicant_family_rw',true),
							'applicant_family_kecamatan'			=> $this->input->post('applicant_family_kecamatan',true),
							'applicant_family_kelurahan'			=> $this->input->post('applicant_family_kelurahan',true),
							'applicant_family_home_phone'			=> $this->input->post('applicant_family_home_phone',true),
							'applicant_family_mobile_phone1'		=> $this->input->post('applicant_family_mobile_phone1',true),
							'applicant_family_mobile_phone2'		=> $this->input->post('applicant_family_mobile_phone2',true),
							'applicant_family_gender'				=> $this->input->post('applicant_family_gender',true),
							'applicant_family_date_of_birth'		=> $this->input->post('applicant_family_date_of_birth',true),
							'applicant_family_place_of_birth'		=> $this->input->post('applicant_family_place_of_birth',true),
							'applicant_family_education'			=> $this->input->post('applicant_family_education',true),
							'applicant_family_occupation'			=> $this->input->post('applicant_family_occupation',true),
							'marital_status_id'						=> $this->input->post('marital_status_id',true),
							'applicant_family_remark'				=> $this->input->post('applicant_family_remark',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			$this->form_validation->set_rules('applicant_family_name', 'Name', 'required|alpha-numeric');
			$this->form_validation->set_rules('applicant_family_address', 'Address', 'filterspecialchar');
			$this->form_validation->set_rules('applicant_family_city', 'City', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_zip_code', 'Zip Code', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_rt', 'RT', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_rw', 'RW', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_kecamatan', 'Kecamatan', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_kelurahan', 'Kelurahan', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_home_phone', 'Home Phone', 'numeric');
			$this->form_validation->set_rules('applicant_family_mobile_phone1', 'Mobile Phone 1', 'required|numeric');
			$this->form_validation->set_rules('applicant_family_mobile_phone2', 'Mobile Phone 2', 'numeric');
			$this->form_validation->set_rules('applicant_family_gender', 'Gender', 'required');
			$this->form_validation->set_rules('applicant_family_date_of_birth', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('applicant_family_place_of_birth', 'Place Of Birth', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_education', 'Education', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_occupation', 'Occupation', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantfamily-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantfamily-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantfamily-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantfamily-".$data_header['created_by']);
				
				// $dataArray[$data_item['family_id'].$data_item['family_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantfamily-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantfamily');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantfamily');
			}else{
				$this->session->set_userdata('addapplicantfamily',$data_item);
				$this->session->set_userdata('addapplicantfamily-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantfamily');
			}
			
		}
		
		public function resetapplicantfamily(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantfamily-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantfamily-".$header['created_by']);
			$this->session->unset_userdata('addapplicantfamily-'.$sesi['unique']);
			redirect('addnewapplicant/applicantfamily');
		}
		
		public function deletearrayapplicantfamilyitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantfamily				= $this->session->userdata("dataitemaddapplicantfamily-".$created_by);
			// print_r($applicantfamily); exit;
			foreach($applicantfamily as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantfamily-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantfamily-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantfamily-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantfamily');
		}
		
 		function processaddapplicantfamily(){
			redirect('addnewapplicant/applicantaccidentexperience');
		}
		
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Accident Experience----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
		
		function applicantaccidentexperience(){
			$data['main_view']['content']		= 'addnewapplicant/applicantaccidentexperience_view';
			$this->load->view('mainpage_view',$data);
		}

 		function arrayaddapplicantaccidentexperience(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'accident_experience_period'=> $this->input->post('accident_experience_period',true),
							'accident_experience_remark'=> $this->input->post('accident_experience_remark',true),
							'accident_experience_consequence'=> $this->input->post('accident_experience_consequence',true),
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('accident_experience_period', 'Period', 'required|numeric');
			$this->form_validation->set_rules('accident_experience_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('accident_experience_consequence', 'Consequence', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantaccidentexperience-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantaccidentexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantaccidentexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantaccidentexperience-".$data_header['created_by']);
				
				// $dataArray[$data_item['accidentexperience_id'].$data_item['accidentexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantaccidentexperience-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantaccidentexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantaccidentexperience');
			}else{
				$this->session->set_userdata('addapplicantaccidentexperience',$data_item);
				$this->session->set_userdata('addapplicantaccidentexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantaccidentexperience');
			}
			
		}
		
		public function resetapplicantaccidentexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantaccidentexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			redirect('addnewapplicant/applicantaccidentexperience');
		}
		
		public function deletearrayapplicantaccidentexperienceitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantaccidentexperience				= $this->session->userdata("dataitemaddapplicantaccidentexperience-".$created_by);
			// print_r($applicantaccidentexperience); exit;
			foreach($applicantaccidentexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantaccidentexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantaccidentexperience-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantaccidentexperience');
		}
		
 		function processaddapplicantaccidentexperience(){
			redirect('addnewapplicant/applicantworkingexperience');
		}

//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Working Experience-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
		
		function applicantworkingexperience(){
			$data['main_view']['content']		= 'addnewapplicant/applicantworkingexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantworkingexperience(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'company_name'=> $this->input->post('company_name',true),
							'company_address'=> $this->input->post('company_address',true),
							'working_experience_job_title'=> $this->input->post('working_experience_job_title',true),
							'working_experience_from_period'=> $this->input->post('working_experience_from_period',true),
							'working_experience_to_period'=> $this->input->post('working_experience_to_period',true),
							'working_experience_last_salary'=> $this->input->post('working_experience_last_salary',true),
							'working_experience_resign_reason'=> $this->input->post('working_experience_resign_reason',true),
							'working_experience_resign_letter'=> $this->input->post('working_experience_resign_letter',true),
							'working_experience_remark'=> $this->input->post('working_experience_remark',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('company_name', 'Company Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('company_address', 'Address', 'filterspecialchar');
			$this->form_validation->set_rules('working_experience_job_title', 'Job Title', 'required|filterspecialchar');
			$this->form_validation->set_rules('working_experience_from_period', 'From Period', 'required');
			$this->form_validation->set_rules('working_experience_to_period', 'To Period', 'required');
			$this->form_validation->set_rules('working_experience_last_salary', 'Last Salary', 'required|numeric');
			$this->form_validation->set_rules('working_experience_resign_reason', 'Resign Reason', 'required|filterspecialchar');
			$this->form_validation->set_rules('working_experience_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantworkingexperience-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantworkingexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantworkingexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantworkingexperience-".$data_header['created_by']);
				
				// $dataArray[$data_item['workingexperience_id'].$data_item['workingexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantworkingexperience-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantworkingexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantworkingexperience');
			}else{
				$this->session->set_userdata('addapplicantworkingexperience',$data_item);
				$this->session->set_userdata('addapplicantworkingexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantworkingexperience');
			}
			
		}
		
		public function resetapplicantworkingexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantworkingexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantworkingexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantworkingexperience-'.$sesi['unique']);
			redirect('addnewapplicant/applicantworkingexperience');
		}
		
		public function deletearrayapplicantworkingexperienceitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantworkingexperience				= $this->session->userdata("dataitemaddapplicantworkingexperience-".$created_by);
			// print_r($applicantworkingexperience); exit;
			foreach($applicantworkingexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantworkingexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantworkingexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantworkingexperience-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantworkingexperience');
		}
		
		function processaddapplicantworkingexperience(){
			redirect('addnewapplicant/applicantinterviewexperience');
		}
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Interview Experience---------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
	
		function applicantinterviewexperience(){
			$data['main_view']['content']		= 'addnewapplicant/applicantinterviewexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantinterviewexperience(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'applicant_interview_experience_period'=> $this->input->post('applicant_interview_experience_period',true),
							'applicant_interview_location'=> $this->input->post('applicant_interview_location',true),
							'applicant_interview_remark'=> $this->input->post('applicant_interview_remark',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('applicant_interview_experience_period', 'Period', 'required|numeric');
			$this->form_validation->set_rules('applicant_interview_location', 'Location', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_interview_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantinterviewexperience-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantinterviewexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantinterviewexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantinterviewexperience-".$data_header['created_by']);
				
				// $dataArray[$data_item['interviewexperience_id'].$data_item['interviewexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantinterviewexperience-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantinterviewexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantinterviewexperience');
			}else{
				$this->session->set_userdata('addapplicantinterviewexperience',$data_item);
				$this->session->set_userdata('addapplicantinterviewexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantinterviewexperience');
			}
			
		}
		
		public function resetapplicantinterviewexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantinterviewexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			redirect('addnewapplicant/applicantinterviewexperience');
		}
		
		public function deletearrayapplicantinterviewexperienceitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantinterviewexperience				= $this->session->userdata("dataitemaddapplicantinterviewexperience-".$created_by);
			// print_r($applicantinterviewexperience); exit;
			foreach($applicantinterviewexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantinterviewexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantinterviewexperience-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantinterviewexperience');
		}
		
		function processaddapplicantinterviewexperience(){
			redirect('addnewapplicant/applicantlawexperience');
		}
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Law Experience---------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------

		function applicantlawexperience(){
			$data['main_view']['content']		= 'addnewapplicant/applicantlawexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantlawexperience(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'applicant_law_experience_period'=> $this->input->post('applicant_law_experience_period',true),
							'applicant_law_location'=> $this->input->post('applicant_law_location',true),
							'applicant_law_remark'=> $this->input->post('applicant_law_remark',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('applicant_law_experience_period', 'Period', 'required|numeric');
			$this->form_validation->set_rules('applicant_law_location', 'Location', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_law_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantlawexperience-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantlawexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantlawexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantlawexperience-".$data_header['created_by']);
				
				// $dataArray[$data_item['lawexperience_id'].$data_item['lawexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantlawexperience-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantlawexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantlawexperience');
			}else{
				$this->session->set_userdata('addapplicantlawexperience',$data_item);
				$this->session->set_userdata('addapplicantlawexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantlawexperience');
			}
			
		}
		
		public function resetapplicantlawexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantlawexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantlawexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantlawexperience-'.$sesi['unique']);
			redirect('addnewapplicant/applicantlawexperience');
		}
		
		public function deletearrayapplicantlawexperienceitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantlawexperience				= $this->session->userdata("dataitemaddapplicantlawexperience-".$created_by);
			// print_r($applicantlawexperience); exit;
			foreach($applicantlawexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantlawexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantlawexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantlawexperience-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantlawexperience');
		}
		
		function processaddapplicantlawexperience(){
			redirect('addnewapplicant/applicantorganizationexperience');
		}
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Organization Experience-----------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------

		function applicantorganizationexperience(){
			$data['main_view']['content']		= 'addnewapplicant/applicantorganizationexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantorganizationexperience(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'organization_experience_name'=> $this->input->post('organization_experience_name',true),
							'organization_experience_scope'=> $this->input->post('organization_experience_scope',true),
							'organization_experience_period'=> $this->input->post('organization_experience_period',true),
							'organization_experience_title'=> $this->input->post('organization_experience_title',true),
							'organization_experience_status'=> $this->input->post('organization_experience_status',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('organization_experience_name', 'Name', 'required|alpha-numeric');
			$this->form_validation->set_rules('organization_experience_scope', 'Scope', 'required|alpha-numeric');
			$this->form_validation->set_rules('organization_experience_period', 'Period', 'required|numeric');
			$this->form_validation->set_rules('organization_experience_title', 'Title', 'required|alpha-numeric');
			$this->form_validation->set_rules('organization_experience_status', 'Status', 'required|alpha-numeric');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantorganizationexperience-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantorganizationexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantorganizationexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantorganizationexperience-".$data_header['created_by']);
				
				// $dataArray[$data_item['organizationexperience_id'].$data_item['organizationexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantorganizationexperience-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantorganizationexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantorganizationexperience');
			}else{
				$this->session->set_userdata('addapplicantorganizationexperience',$data_item);
				$this->session->set_userdata('addapplicantorganizationexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantorganizationexperience');
			}
			
		}
		
		public function resetapplicantorganizationexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantorganizationexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			redirect('addnewapplicant/applicantorganizationexperience');
		}
		
		public function deletearrayapplicantorganizationexperienceitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantorganizationexperience				= $this->session->userdata("dataitemaddapplicantorganizationexperience-".$created_by);
			// print_r($applicantorganizationexperience); exit;
			foreach($applicantorganizationexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantorganizationexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantorganizationexperience-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantorganizationexperience');
		}
		
		function processaddapplicantorganizationexperience(){
			redirect('addnewapplicant/applicantmedicalrecord');
		}
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Medical Record---------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------

		function applicantmedicalrecord(){
			$data['main_view']['content']		= 'addnewapplicant/applicantmedicalrecord_view';
			$data['main_view']['familystatus']	= create_double($this->addnewapplicant_model->getfamilystatus(),'family_status_id','family_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantmedicalrecord(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'family_status_id'=> $this->input->post('family_status_id',true),
							'applicant_medical_disease'=> $this->input->post('applicant_medical_disease',true),
							'applicant_medical_name'=> $this->input->post('applicant_medical_name',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status', 'required');
			$this->form_validation->set_rules('applicant_medical_disease', 'Medical Disease', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_medical_name', 'Medical Name', 'required|filterspecialchar');

			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantmedicalrecord-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantmedicalrecord-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantmedicalrecord-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantmedicalrecord-".$data_header['created_by']);
				
				// $dataArray[$data_item['medicalrecord_id'].$data_item['medicalrecord_type']] = $data_item;
				$dataArray[$data_item['family_status_id']] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantmedicalrecord-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantmedicalrecord');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantmedicalrecord');
			}else{
				$this->session->set_userdata('addapplicantmedicalrecord',$data_item);
				$this->session->set_userdata('addapplicantmedicalrecord-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantmedicalrecord');
			}
			
		}
		
		public function resetapplicantmedicalrecord(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantmedicalrecord-".$header['created_by']);
			$this->session->unset_userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			redirect('addnewapplicant/applicantmedicalrecord');
		}
		
		public function deletearrayapplicantmedicalrecorditem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantmedicalrecord				= $this->session->userdata("dataitemaddapplicantmedicalrecord-".$created_by);
			// print_r($applicantmedicalrecord); exit;
			foreach($applicantmedicalrecord as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantmedicalrecord-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantmedicalrecord-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantmedicalrecord');
		}
		
		function processaddapplicantmedicalrecord(){
			redirect('addnewapplicant/applicantpersonality');
		}
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Personality------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
	
		function applicantpersonality(){
			$data['main_view']['content']		= 'addnewapplicant/applicantpersonality_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddapplicantpersonality(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}

			$auth = $this->session->userdata('auth');
			$data = array(
				'applicant_strength_remark'			=> $this->input->post('applicant_strength_remark',true),
				'applicant_weakness_remark'			=> $this->input->post('applicant_weakness_remark',true),
				'data_state'						=> '0',
				'created_by'						=> $this->input->post('created_by',true),
				'created_on'						=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('applicant_strength_remark', 'Strength Remark', 'filterspecialchar');
			$this->form_validation->set_rules('applicant_weakness_remark', 'Weakness Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$this->session->unset_userdata('addapplicantpersonality-'.$sesi['unique'],$data);
				$this->session->set_userdata('addapplicantpersonality-'.$sesi['unique'],$data);
				redirect('addnewapplicant/applicantsubjects');
			}else{
				$this->session->unset_userdata('addapplicantpersonality-'.$sesi['unique'],$data);
				$this->session->set_userdata('addapplicantpersonality-'.$sesi['unique'],$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantpersonality');
			}
		}

//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Subjects---------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
	
		function applicantsubjects(){
			$data['main_view']['content']		= 'addnewapplicant/applicantsubjects_view';
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantsubjects(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'applicant_subjects_status'				=> $this->input->post('applicant_subjects_status',true),
							'applicant_subjects_name'				=> $this->input->post('applicant_subjects_name',true),
							'applicant_subjects_remark'				=> $this->input->post('applicant_subjects_remark',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('applicant_subjects_status', 'Status', 'required');
			$this->form_validation->set_rules('applicant_subjects_name', 'Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_subjects_remark', 'Remark', 'filterspecialchar');

			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantsubjects-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantsubjects-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantsubjects-".$data_header['created_by']);
				
				// $dataArray[$data_item['subjects_id'].$data_item['subjects_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantsubjects-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantsubjects');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantsubjects');
			}else{
				$this->session->set_userdata('addapplicantsubjects',$data_item);
				$this->session->set_userdata('addapplicantsubjects-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantsubjects');
			}
			
		}
		
		public function resetapplicantsubjects(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantsubjects-".$header['created_by']);
			$this->session->unset_userdata('addapplicantsubjects-'.$sesi['unique']);
			redirect('addnewapplicant/applicantsubjects');
		}
		
		public function deletearrayapplicantsubjectsitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantsubjects				= $this->session->userdata("dataitemaddapplicantsubjects-".$created_by);
			// print_r($applicantsubjects); exit;
			foreach($applicantsubjects as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantsubjects-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantsubjects-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantsubjects');
		}
		
		function processaddapplicantsubjects(){
			redirect('addnewapplicant/applicantworkcolleagues');
		}
		
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Working Colleagues-----------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
	
		function applicantworkcolleagues(){
			$data['main_view']['content']		= 'addnewapplicant/applicantworkcolleagues_view';
			$this->load->view('mainpage_view',$data);
		}
		
 		function arrayaddapplicantworkcolleagues(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'applicant_work_colleagues_name'=> $this->input->post('applicant_work_colleagues_name',true),
							'applicant_work_colleagues_section'=> $this->input->post('applicant_work_colleagues_section',true),
							'applicant_work_colleagues_relatioship'=> $this->input->post('applicant_work_colleagues_relatioship',true),
							'data_state'							=> '0',
							'created_by'						=> $this->input->post('created_by',true),
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('applicant_work_colleagues_name', 'Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_work_colleagues_section', 'Section', 'required|filterspecialchar');
			$this->form_validation->set_rules('applicant_work_colleagues_relatioship', 'Remark', 'filterspecialchar');

			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addapplicantworkcolleagues-'.$sesi['unique']);
				$this->session->set_userdata('addapplicantworkcolleagues-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addapplicantworkcolleagues-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddapplicantworkcolleagues-".$data_header['created_by']);
				
				// $dataArray[$data_item['workcolleagues_id'].$data_item['workcolleagues_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddapplicantworkcolleagues-".$data_header['created_by'],$dataArray);
				$this->session->unset_userdata('addapplicantworkcolleagues');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantworkcolleagues');
			}else{
				$this->session->set_userdata('addapplicantworkcolleagues',$data_item);
				$this->session->set_userdata('addapplicantworkcolleagues-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant/applicantworkcolleagues');
			}
			
		}
		
		public function resetapplicantworkcolleagues(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addapplicantworkcolleagues-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantworkcolleagues-".$header['created_by']);
			$this->session->unset_userdata('addapplicantworkcolleagues-'.$sesi['unique']);
			redirect('addnewapplicant/applicantworkcolleagues');
		}
		
		public function deletearrayapplicantworkcolleaguesitem(){
			$arrayBaru		=array();

			$keyZ 			= $this->uri->segment(3);
			$applicantworkcolleagues				= $this->session->userdata("dataitemaddapplicantworkcolleagues-".$created_by);
			// print_r($applicantworkcolleagues); exit;
			foreach($applicantworkcolleagues as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addapplicantworkcolleagues-'.$sesi['unique']);
				$this->session->unset_userdata('addapplicantworkcolleagues-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddapplicantworkcolleagues-'.$created_by,$arrayBaru);
			redirect('addnewapplicant/applicantworkcolleagues');
		}
		
		function processaddapplicantworkcolleagues(){
			redirect('addnewapplicant/confirm');
		}
	
//-----------------------------------------------------------------------------------------------------------------------------------------------
//------------------------------Confirm----------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------
	
		function confirm(){
			$data['main_view']['content']		= 'addnewapplicant/applicantconfirm_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddapplicantconfirm(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth = $this->session->userdata('auth');
			$personaldata = $this->session->userdata('addnewapplicant-'.$sesi['unique']);
			if(!is_array($personaldata)){
				$msg = "<div class='alert alert-danger'>
							Please Input Data First !!!
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('addnewapplicant');
			}else{
				if($this->addnewapplicant_model->savepersonaldata($personaldata)){
					$applicant_id=$this->addnewapplicant_model->getapplicantid($personaldata[created_by],$personaldata[created_on]);
					if($applicant_id!=false){
						$headereducation = $this->session->userdata('addapplicanteducation-'.$sesi['unique']);
						$arrayeducation = $this->session->userdata("dataitemaddapplicanteducation-".$headereducation['created_by']);
						if(is_array($arrayeducation)){
							foreach($arrayeducation as $key=>$val){
								if($this->addnewapplicant_model->saveeducation($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headerfamily = $this->session->userdata('addapplicantfamily-'.$sesi['unique']);
						$arrayfamily = $this->session->userdata("dataitemaddapplicantfamily-".$headerfamily['created_by']);
						if(is_array($arrayfamily)){
							foreach($arrayfamily as $key=>$val){
								if($this->addnewapplicant_model->savefamily($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headeraccidentexperience = $this->session->userdata('addapplicantaccidentexperience-'.$sesi['unique']);
						$arrayaccidentexperience = $this->session->userdata("dataitemaddapplicantaccidentexperience-".$headeraccidentexperience['created_by']);
						if(is_array($arrayaccidentexperience)){
							foreach($arrayaccidentexperience as $key=>$val){
								if($this->addnewapplicant_model->saveaccidentexperience($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headerworkingexperience = $this->session->userdata('addapplicantworkingexperience-'.$sesi['unique']);
						$arrayworkingexperience = $this->session->userdata("dataitemaddapplicantworkingexperience-".$headerworkingexperience['created_by']);
						if(is_array($arrayworkingexperience)){
							foreach($arrayworkingexperience as $key=>$val){
								if($this->addnewapplicant_model->saveworkingexperience($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headerinterviewexperience = $this->session->userdata('addapplicantinterviewexperience-'.$sesi['unique']);
						$arrayinterviewexperience = $this->session->userdata("dataitemaddapplicantinterviewexperience-".$headerinterviewexperience['created_by']);
						if(is_array($arrayinterviewexperience)){
							foreach($arrayinterviewexperience as $key=>$val){
								if($this->addnewapplicant_model->saveinterviewexperience($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headerlawexperience = $this->session->userdata('addapplicantlawexperience-'.$sesi['unique']);
						$arraylawexperience = $this->session->userdata("dataitemaddapplicantlawexperience-".$headerlawexperience['created_by']);
						if(is_array($arraylawexperience)){
							foreach($arraylawexperience as $key=>$val){
								if($this->addnewapplicant_model->savelawexperience($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headerorganizationexperience = $this->session->userdata('addapplicantorganizationexperience-'.$sesi['unique']);
						$arrayorganizationexperience = $this->session->userdata("dataitemaddapplicantorganizationexperience-".$headerorganizationexperience['created_by']);
						if(is_array($arrayorganizationexperience)){
							foreach($arrayorganizationexperience as $key=>$val){
								if($this->addnewapplicant_model->saveorganizationexperience($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headermedicalrecord = $this->session->userdata('addapplicantmedicalrecord-'.$sesi['unique']);
						$arraymedicalrecord = $this->session->userdata("dataitemaddapplicantmedicalrecord-".$headermedicalrecord['created_by']);
						if(is_array($arraymedicalrecord)){
							foreach($arraymedicalrecord as $key=>$val){
								if($this->addnewapplicant_model->savemedicalrecord($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$personality = $this->session->userdata('addapplicantpersonality-'.$sesi['unique']);
						if(is_array($personality)){
							if($this->addnewapplicant_model->savepersonality($personality,$applicant_id)){
								
							}else{
							$this->erreur();
							}
						}
						$headersubjects = $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
						$arraysubjects = $this->session->userdata("dataitemaddapplicantsubjects-".$headersubjects['created_by']);
						if(is_array($arraysubjects)){
							foreach($arraysubjects as $key=>$val){
								if($this->addnewapplicant_model->savesubjects($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}
						$headerworkcolleagues = $this->session->userdata('addapplicantworkcolleagues-'.$sesi['unique']);
						$arrayworkcolleagues = $this->session->userdata("dataitemaddapplicantworkcolleagues-".$headerworkcolleagues['created_by']);
						if(is_array($arrayworkcolleagues)){
							foreach($arrayworkcolleagues as $key=>$val){
								if($this->addnewapplicant_model->saveworkcolleagues($val,$applicant_id)){
									
								}else{
								$this->erreur();
								}
							}
						}

					}else{
						$this->erreur();
					}
					$msg = "<div class='alert alert-success'>                
								Save Data Applicant Successful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->resetall();
					redirect('main');
				}else{
					$this->erreur();
				}
			}
		}
		
		function erreur(){
			$msg = "<div class='alert alert-danger'>                
						Save Data Applicant Unsuccessful
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message',$msg);
			redirect('addnewapplicant/confirm');
		}
		
		function resetall(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth = $this->session->userdata('auth');
			//personaldata
			$this->session->unset_userdata('addnewapplicant-'.$sesi['unique'],$data);
			//education
			$header = $this->session->userdata('addapplicanteducation-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicanteducation-".$header['created_by']);
			$this->session->unset_userdata('addapplicanteducation-'.$sesi['unique']);
			//family
			$header = $this->session->userdata('addapplicantfamily-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantfamily-".$header['created_by']);
			$this->session->unset_userdata('addapplicantfamily-'.$sesi['unique']);
			//accidentexperience
			$header = $this->session->userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantaccidentexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			//workingexperience
			$header = $this->session->userdata('addapplicantworkingexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantworkingexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantworkingexperience-'.$sesi['unique']);
			//interviewexperience
			$header = $this->session->userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantinterviewexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			//lawexperience
			$header = $this->session->userdata('addapplicantlawexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantlawexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantlawexperience-'.$sesi['unique']);
			//organizationexperience
			$header = $this->session->userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantorganizationexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			//medicalrecord
			$header = $this->session->userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantmedicalrecord-".$header['created_by']);
			$this->session->unset_userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			//Personality
			$this->session->unset_userdata('addapplicantpersonality-'.$sesi['unique']);
			//subjects
			$header = $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantsubjects-".$header['created_by']);
			$this->session->unset_userdata('addapplicantsubjects-'.$sesi['unique']);
			//workcolleagues
			$header = $this->session->userdata('addapplicantworkcolleagues-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantworkcolleagues-".$header['created_by']);
			$this->session->unset_userdata('addapplicantworkcolleagues-'.$sesi['unique']);
		}

		function resetalldata(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth = $this->session->userdata('auth');
			//personaldata
			$this->session->unset_userdata('addnewapplicant-'.$sesi['unique'],$data);
			//education
			$header = $this->session->userdata('addapplicanteducation-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicanteducation-".$header['created_by']);
			$this->session->unset_userdata('addapplicanteducation-'.$sesi['unique']);
			//family
			$header = $this->session->userdata('addapplicantfamily-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantfamily-".$header['created_by']);
			$this->session->unset_userdata('addapplicantfamily-'.$sesi['unique']);
			//accidentexperience
			$header = $this->session->userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantaccidentexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantaccidentexperience-'.$sesi['unique']);
			//workingexperience
			$header = $this->session->userdata('addapplicantworkingexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantworkingexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantworkingexperience-'.$sesi['unique']);
			//interviewexperience
			$header = $this->session->userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantinterviewexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantinterviewexperience-'.$sesi['unique']);
			//lawexperience
			$header = $this->session->userdata('addapplicantlawexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantlawexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantlawexperience-'.$sesi['unique']);
			//organizationexperience
			$header = $this->session->userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantorganizationexperience-".$header['created_by']);
			$this->session->unset_userdata('addapplicantorganizationexperience-'.$sesi['unique']);
			//medicalrecord
			$header = $this->session->userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantmedicalrecord-".$header['created_by']);
			$this->session->unset_userdata('addapplicantmedicalrecord-'.$sesi['unique']);
			//Personality
			$this->session->unset_userdata('addapplicantpersonality-'.$sesi['unique']);
			//subjects
			$header = $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantsubjects-".$header['created_by']);
			$this->session->unset_userdata('addapplicantsubjects-'.$sesi['unique']);
			//workcolleagues
			$header = $this->session->userdata('addapplicantworkcolleagues-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddapplicantworkcolleagues-".$header['created_by']);
			$this->session->unset_userdata('addapplicantworkcolleagues-'.$sesi['unique']);
			redirect('addnewapplicant');
		}
	}
?>