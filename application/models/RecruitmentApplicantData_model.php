<?php
	class RecruitmentApplicantData_model extends CI_Model {
		var $table = "transaction_applicant_data";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getRecruitmentApplicantData(){			
			$this->db->select('recruitment_applicant_data.applicant_id, recruitment_applicant_data.applicant_name, recruitment_applicant_data.applicant_application_date, recruitment_applicant_data.applicant_date_of_birth, recruitment_applicant_data.applicant_place_of_birth, recruitment_applicant_data.applicant_mobile_phone,recruitment_applicant_data.applicant_last_education, recruitment_applicant_data.applicant_address, recruitment_applicant_data.applicant_city, recruitment_applicant_data.education_id');
			$this->db->from('recruitment_applicant_data');
			$this->db->where('recruitment_applicant_data.data_state', 0);
			$this->db->order_by('recruitment_applicant_data.applicant_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreRegion(){
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreBranch($region_id){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state', 0);
			$this->db->where('core_branch.region_id', $region_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreLocation($branch_id){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			$this->db->where('core_location.branch_id', $branch_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreCompany(){
			$this->db->select('core_company.company_id, core_company.company_name');
			$this->db->from('core_company');
			$this->db->where('core_company.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$this->db->where('core_department.division_id', $division_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			$this->db->where('core_section.department_id', $department_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreUnit($section_id){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.data_state', 0);
			$this->db->where('core_unit.section_id', $section_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreGrade(){
			$this->db->select('core_grade.grade_id, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreClass(){
			$this->db->select('core_class.class_id, core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreBank(){
			$this->db->select('core_bank.bank_id, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getdetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('applicant_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function insertRecruitmentApplicantData($data){
			return $this->db->insert('recruitment_applicant_data',$data);
		}
		
		public function insertRecruitmentApplicantEducation($data_education){
			return $this->db->insert('recruitment_applicant_education',$data_education);
		}
		
		public function insertRecruitmentApplicantFamily($data_family){
			return $this->db->insert('recruitment_applicant_family',$data_family);
		}
		
		public function insertRecruitmentApplicantLanguage($data_language){
			return $this->db->insert('recruitment_applicant_language',$data_language);
		}

		public function insertRecruitmentApplicantExpertise($data_expertise){
			return $this->db->insert('recruitment_applicant_expertise',$data_expertise);
		}

		public function insertRecruitmentApplicantExperience($data_experience){
			return $this->db->insert('recruitment_applicant_experience',$data_experience);
		}

		public function insertRecruitmentApplicantExpectation($data_expectation){
			return $this->db->insert('recruitment_applicant_expectation',$data_expectation);
		}
		
		
		public function getCoreFamilyRelation(){
			$this->db->select('family_relation_id, family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getFamilyRelationName($family_relation_id){
			$this->db->select('family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('family_relation_id', $family_relation_id);
			$result = $this->db->get()->row_array();
			return $result['family_relation_name'];
		}
		
		public function getCoreMaritalStatus(){
			$this->db->select('marital_status_id, marital_status_name');
			$this->db->from('core_marital_status');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getCoreEducation(){
			$this->db->select('education_id, education_name');
			$this->db->from('core_education');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getMaritalStatusName($marital_status_id){
			$this->db->select('marital_status_name');
			$this->db->from('core_marital_status');
			$this->db->where('marital_status_id', $marital_status_id);
			$result = $this->db->get()->row_array();
			return $result['marital_status_name'];
		}
		
		public function getEducationName($education_id){
			$this->db->select('education_name');
			$this->db->from('core_education');
			$this->db->where('education_id', $education_id);
			$result = $this->db->get()->row_array();
			return $result['education_name'];
		}
		
		public function getApplicantID($created_on, $created_id){
			$this->db->select('recruitment_applicant_data.applicant_id');
			$this->db->from('recruitment_applicant_data');
			$this->db->where('recruitment_applicant_data.created_on', $created_on);
			$this->db->where('recruitment_applicant_data.created_id', $created_id);
			$result = $this->db->get()->row_array();
			return $result['applicant_id'];
		}	
		
		public function getCoreLanguage(){
			$this->db->select('language_id, language_name');
			$this->db->from('core_language');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getLanguageName($language_id){
			$this->db->select('language_name');
			$this->db->from('core_language');
			$this->db->where('language_id', $language_id);
			$result = $this->db->get()->row_array();
			return $result['language_name'];
		}

		public function getCoreExpertise(){
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getExpertiseName($expertise_id){
			$this->db->select('core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_id', $expertise_id);
			$result = $this->db->get()->row_array();
			return $result['expertise_name'];
		}
		
		public function getCreatedID($username){
			$this->db->select('user_id');
			$this->db->from('system_user');
			$this->db->where('username', $username);
			$result = $this->db->get()->row_array();
			if(!isset($result['user_id'])){
				return '-';
			}else{
				return $result['user_id'];
			}
		}
		
		public function deleteRecruitmentApplicantData($ApplicantID){
			$this->db->where("recruitment_applicant_data.applicant_id", $ApplicantID);
			$query = $this->db->update('recruitment_applicant_data', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getRecruitmentApplicantData_Detail($applicant_id){			
			$this->db->select('recruitment_applicant_data.applicant_id, recruitment_applicant_data.marital_status_id, recruitment_applicant_data.education_id, recruitment_applicant_data.applicant_name, recruitment_applicant_data.applicant_application_date, recruitment_applicant_data.applicant_date_of_birth, recruitment_applicant_data.applicant_place_of_birth, recruitment_applicant_data.applicant_last_education, recruitment_applicant_data.applicant_address, recruitment_applicant_data.applicant_city, recruitment_applicant_data.applicant_postal_code, recruitment_applicant_data.applicant_rt, recruitment_applicant_data.applicant_rw, recruitment_applicant_data.applicant_kecamatan, recruitment_applicant_data.applicant_kelurahan, recruitment_applicant_data.applicant_home_phone, recruitment_applicant_data.applicant_mobile_phone, recruitment_applicant_data.applicant_email_address, recruitment_applicant_data.applicant_residence_address, recruitment_applicant_data.applicant_residence_city, recruitment_applicant_data.applicant_residence_postal_code, recruitment_applicant_data.applicant_residence_rt, recruitment_applicant_data.applicant_residence_rw, recruitment_applicant_data.applicant_residence_kecamatan, recruitment_applicant_data.applicant_residence_kelurahan, recruitment_applicant_data.applicant_residence_status, recruitment_applicant_data.applicant_gender, recruitment_applicant_data.applicant_religion, recruitment_applicant_data.applicant_nationality, recruitment_applicant_data.applicant_blood_type,  recruitment_applicant_data.applicant_heir_name, recruitment_applicant_data.applicant_id_type,  recruitment_applicant_data.applicant_id_number');
			$this->db->from('recruitment_applicant_data');
			$this->db->where('recruitment_applicant_data.data_state', 0);
			$this->db->where('recruitment_applicant_data.applicant_id', $applicant_id);
			$this->db->order_by('recruitment_applicant_data.applicant_id', 'DESC');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getRecruitmentApplicantEducation_Detail($applicant_id){			
			$this->db->select('recruitment_applicant_education.applicant_education_id, recruitment_applicant_education.applicant_id, recruitment_applicant_education.education_id, core_education.education_name, recruitment_applicant_education.applicant_education_type, recruitment_applicant_education.applicant_education_name, recruitment_applicant_education.applicant_education_city, recruitment_applicant_education.applicant_education_from_period, recruitment_applicant_education.applicant_education_to_period, recruitment_applicant_education.applicant_education_duration, recruitment_applicant_education.applicant_education_passed, recruitment_applicant_education.applicant_education_certificate, recruitment_applicant_education.applicant_education_remark');
			$this->db->from('recruitment_applicant_education');
			$this->db->join('core_education', 'recruitment_applicant_education.education_id = core_education.education_id');
			$this->db->where('recruitment_applicant_education.data_state', 0);
			$this->db->where('recruitment_applicant_education.applicant_id', $applicant_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getRecruitmentApplicantFamily_Detail($applicant_id){			
			$this->db->select('recruitment_applicant_family.applicant_family_id, recruitment_applicant_family.applicant_id, recruitment_applicant_family.family_relation_id, core_family_relation.family_relation_name, recruitment_applicant_family.marital_status_id, recruitment_applicant_family.applicant_family_name, recruitment_applicant_family.applicant_family_address, recruitment_applicant_family.applicant_family_city, recruitment_applicant_family.applicant_family_postal_code, recruitment_applicant_family.applicant_family_rt, recruitment_applicant_family.applicant_family_rw, recruitment_applicant_family.applicant_family_kelurahan, recruitment_applicant_family.applicant_family_kecamatan, recruitment_applicant_family.applicant_family_home_phone, recruitment_applicant_family.applicant_family_mobile_phone, recruitment_applicant_family.applicant_family_gender, recruitment_applicant_family.applicant_family_date_of_birth, recruitment_applicant_family.applicant_family_place_of_birth, recruitment_applicant_family.applicant_family_education, recruitment_applicant_family.applicant_family_occupation, recruitment_applicant_family.applicant_family_remark');
			$this->db->from('recruitment_applicant_family');
			$this->db->join('core_family_relation', 'recruitment_applicant_family.family_relation_id = core_family_relation.family_relation_id');
			$this->db->where('recruitment_applicant_family.data_state', 0);
			$this->db->where('recruitment_applicant_family.applicant_id', $applicant_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getRecruitmentApplicantLanguage_Detail($applicant_id){			
			$this->db->select('recruitment_applicant_language.applicant_language_id, recruitment_applicant_language.applicant_id, recruitment_applicant_language.language_id, core_language.language_name, recruitment_applicant_language.applicant_language_listen, recruitment_applicant_language.applicant_language_read, recruitment_applicant_language.applicant_language_write, recruitment_applicant_language.applicant_language_speak');
			$this->db->from('recruitment_applicant_language');
			$this->db->join('core_language', 'recruitment_applicant_language.language_id = core_language.language_id');
			$this->db->where('recruitment_applicant_language.data_state', 0);
			$this->db->where('recruitment_applicant_language.applicant_id', $applicant_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getRecruitmentApplicantExpertise_Detail($applicant_id){			
			$this->db->select('recruitment_applicant_expertise.applicant_expertise_id, recruitment_applicant_expertise.applicant_id, recruitment_applicant_expertise.expertise_id, core_expertise.expertise_name, recruitment_applicant_expertise.applicant_expertise_name, recruitment_applicant_expertise.applicant_expertise_city, recruitment_applicant_expertise.applicant_expertise_from_period, recruitment_applicant_expertise.applicant_expertise_to_period, recruitment_applicant_expertise.applicant_expertise_duration, recruitment_applicant_expertise.applicant_expertise_passed, recruitment_applicant_expertise.applicant_expertise_certificate, recruitment_applicant_expertise.applicant_expertise_remark');
			$this->db->from('recruitment_applicant_expertise');
			$this->db->join('core_expertise', 'recruitment_applicant_expertise.expertise_id = core_expertise.expertise_id');
			$this->db->where('recruitment_applicant_expertise.data_state', 0);
			$this->db->where('recruitment_applicant_expertise.applicant_id', $applicant_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getRecruitmentApplicantExperience_Detail($applicant_id){			
			$this->db->select('recruitment_applicant_experience.applicant_experience_id, recruitment_applicant_experience.applicant_id, recruitment_applicant_experience.experience_company_name, recruitment_applicant_experience.experience_company_address, recruitment_applicant_experience.experience_job_title, recruitment_applicant_experience.experience_from_period, recruitment_applicant_experience.experience_to_period, recruitment_applicant_experience.experience_last_salary, recruitment_applicant_experience.experience_separation_reason, recruitment_applicant_experience.experience_separation_letter, recruitment_applicant_experience.experience_remark');
			$this->db->from('recruitment_applicant_experience');
			$this->db->where('recruitment_applicant_experience.data_state', 0);
			$this->db->where('recruitment_applicant_experience.applicant_id', $applicant_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateRecruitmentApplicantData($data){
			$this->db->where('recruitment_applicant_data.applicant_id', $data['applicant_id']);
			if($this->db->update('recruitment_applicant_data', $data)){
				return true;
			} else {
				return false;
			}
		}

		public function deleteRecruitmentApplicantFamily($data_family){
			$this->db->where('recruitment_applicant_family.applicant_family_id', $data_family['applicant_family_id']);
			if($this->db->update('recruitment_applicant_family', $data_family)){
				return true;
			} else {
				return false;
			}
		}

		public function deleteRecruitmentApplicantEducation($data_education){
			$this->db->where('recruitment_applicant_education.applicant_education_id', $data_education['applicant_education_id']);
			if($this->db->update('recruitment_applicant_education', $data_education)){
				return true;
			} else {
				return false;
			}
		}

		public function deleteRecruitmentApplicantExpertise($data_expertise){
			$this->db->where('recruitment_applicant_expertise.applicant_expertise_id', $data_expertise['applicant_expertise_id']);
			if($this->db->update('recruitment_applicant_expertise', $data_expertise)){
				return true;
			} else {
				return false;
			}
		}

		public function deleteRecruitmentApplicantExperience($data_experience){
			$this->db->where('recruitment_applicant_experience.applicant_experience_id', $data_experience['applicant_experience_id']);
			if($this->db->update('recruitment_applicant_experience', $data_experience)){
				return true;
			} else {
				return false;
			}
		}

		public function deleteRecruitmentApplicantLanguage($data_language){
			$this->db->where('recruitment_applicant_language.applicant_language_id', $data_language['applicant_language_id']);
			if($this->db->update('recruitment_applicant_language', $data_language)){
				return true;
			} else {
				return false;
			}
		}

		public function insertHROemployeeData($data){
			return $this->db->insert('hro_employee_data',$data);
		}

		public function getEmployeeID($created_id){
			$this->db->select('hro_employee_data.employee_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.created_id', $created_id);
			$this->db->order_by('hro_employee_data.employee_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_id'];
		}	
		
		public function insertHROemployeeEducation($data_education){
			return $this->db->insert('hro_employee_education',$data_education);
		}
		
		public function insertHROemployeeFamily($data_family){
			return $this->db->insert('hro_employee_family',$data_family);
		}
		
		public function insertHROemployeeLanguage($data_language){
			return $this->db->insert('hro_employee_language',$data_language);
		}

		public function insertHROemployeeExpertise($data_expertise){
			return $this->db->insert('hro_employee_expertise',$data_expertise);
		}

		public function insertHROemployeeExperience($data_experience){
			return $this->db->insert('hro_employee_experience',$data_experience);
		}
		
	}
?>