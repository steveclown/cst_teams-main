<?php
	Class transactionalapplicantdata extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantdata_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			// $this->lists();
			$this->Add();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantdata']		= $this->transactionalapplicantdata_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantdata/listtransactionalapplicantdata_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantdata/addtransactionalapplicantdata_view';
			$data['main_view']['maritalstatus']	= create_double($this->transactionalapplicantdata_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionalapplicantdata(){
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
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			if($this->form_validation->run()==true){
				$this->session->unset_userdata('addtransactionalapplicantdata-'.$sesi['unique'],$data);
				$this->session->set_userdata('addtransactionalapplicantdata-'.$sesi['unique'],$data);
				redirect('transactionalapplicanteducation');
				// if($this->transactionalapplicantdata_model->saveNewtransactionalapplicantdata($data)){
					// $auth = $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantdata.processaddtransactionalapplicantdata',$auth['username'],'Add New Transactional Applicant Data');
					// $msg = "<div class='alert alert-success'>                
								// Add Data Transactional Applicant Data Successfully
							// </div> ";
					// $this->session->set_userdata('message',$msg);
					// $this->session->unset_userdata('addtransactionalapplicantdata');
					// redirect('transactionalapplicantdata/add');
				// }else{
					// $msg = "<div class='alert alert-danger'>                
								// Add Data Transactional Applicant Data UnSuccessful
							// </div> ";
					// $this->session->set_userdata('message',$msg);
					// redirect('transactionalapplicantdata/add');
				// }
			}else{
				$this->session->unset_userdata('addtransactionalapplicantdata-'.$sesi['unique'],$data);
				$this->session->set_userdata('addtransactionalapplicantdata-'.$sesi['unique'],$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantdata');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantdata_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantdata/edittransactionalapplicantdata_view';
			$data['main_view']['maritalstatus']		= create_double($this->transactionalapplicantdata_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantdata(){
			$data = array(
				'applicant_id' 					=> $this->input->post('applicant_id',true),
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
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('applicant_name', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantdata_model->saveEdittransactionalapplicantdata($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantdata.Edit',$auth['username'],'Edit Transactional Applicant Data');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['applicant_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Data Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantdata/Edit/'.$data['applicant_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Data UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantdata/Edit/'.$data['applicant_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantdata/Edit/'.$data['applicant_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantdata_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantdata.delete',$auth['username'],'Delete transactionalapplicantdata');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Data Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantdata');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Data UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantdata');
			}
		}
	}
?>