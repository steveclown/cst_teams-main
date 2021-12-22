<?php
	class transactionalapplicantdata_model extends CI_Model {
		var $table = "transaction_applicant_data";
		
		public function transactionalapplicantdata_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_applicant_data";
			
			//Build contents query
			$this->db->select('applicant_id, applicant_name, applicant_application_date, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalapplicantdata($data){
			return $this->db->insert('transaction_applicant_data',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('applicant_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalapplicantdata($data){
			$this->db->where('applicant_id',$data['applicant_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getmaritalstatusname($id){
			$this->db->select('marital_status_name')->from('core_marital_status');
			$this->db->where('marital_status_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['marital_status_name'])){
				return '-';
			}else{
				return $result['marital_status_name'];
			}
		}
		
		function getmaritalstatus(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_marital_status');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function delete($id){
			$this->db->where("applicant_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		 }
	}
	// last_update, applicant_name, applicant_application_date, applicant_address, applicant_city, applicant_zip_code, applicant_rt, applicant_rw, applicant_kecamatan, applicant_kelurahan, applicant_home_phone, applicant_mobile_phone, applicant_email_address, applicant_residence_address, applicant_residence_city, applicant_residence_zip_code, applicant_residence_rt, applicant_residence_rw, applicant_residence_kecamatan, applicant_residence_kelurahan, applicant_residence_status, applicant_religion, applicant_nationality, marital_status_id, applicant_id_number, applicant_education_cost, applicant_winner_status, applicant_winner_remark, applicant_grade_fail, applicant_grade_fail_remark, applicant_grade_fail_reason, applicant_further_study, applicant_further_study_field, applicant_further_study_period, applicant_has_team_member, applicant_team_member, applicant_how_manage_team_member, applicant_head_expectation, applicant_new_ideas, applicant_achievement, applicant_achievement_satisfaction, applicant_application_position, applicant_expected_salary, applicant_out_of_town, applicant_out_of_town_remark, applicant_immediately_work, applicant_immediately_work_remark, applicant_overtime_ready, applicant_overtime_ready_remark, applicant_business_trip, applicant_business_trip_remark, applicant_work_environment, applicant_work_environment_other, applicant_most_like_work, applicant_most_dislike_work, applicant_hobby, applicant_hobby_active, applicant_interest_other_work, applicant_good_book, applicant_dream_of_life, applicant_dream_achieve, applicant_weight, applicant_height, applicant_sick_opname, applicant_sick_disease, applicant_sick_duration, applicant_sick_year, applicant_sick_hospital, applicant_colour_blind, applicant_work_friend_name1, applicant_work_friend_section1, applicant_work_friend_relationship1, applicant_work_friend_name2, applicant_work_friend_section2, applicant_work_friend_relationship2, applicant_emergency_name, applicant_emergency_address, applicant_emergency_mobile_phone, applicant_emergency_home_phone, applicant_emergency_relationship, applicant_daily_transportation_name1, applicant_daily_transportation_year1, applicant_daily_transportation_owned1, applicant_daily_transportation_name2, applicant_daily_transportation_year2, applicant_daily_transportation_owned2, applicant_ready_no_married, data_state, created_by, created_on, applicant_id,
?>