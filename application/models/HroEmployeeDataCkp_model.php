<?php
	class HroEmployeeDataCkp_model extends CI_Model {
		var $table = "hro_employee_data";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getHROEmployeeData($region_id, $branch_id, $location_id, $payroll_employee_level, $division_id, $department_id, $section_id, $unit_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.region_id, core_region.region_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_region', 'hro_employee_data.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			if($region_id != '' ){			
			$this->db->where('hro_employee_data.region_id', $region_id);
			}
			if($branch_id != '' ){
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			}
			if($location_id != '' ){
			$this->db->where('hro_employee_data.location_id', $location_id);
			}
			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			if($division_id != '' ){
				$this->db->where('hro_employee_data.division_id',$division_id);
			}

			if($department_id != '' ){
				$this->db->where('hro_employee_data.department_id',$department_id);
			}

			if($section_id != '' ){
				$this->db->where('hro_employee_data.section_id',$section_id);
			}

			if($unit_id != '' ){
				$this->db->where('hro_employee_data.unit_id',$unit_id);
			}

			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreUnit(){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreMaritalStatus(){
			$this->db->select('core_marital_status.marital_status_id, core_marital_status.marital_status_name');
			$this->db->from('core_marital_status');
			$this->db->where('core_marital_status.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreGrade(){
			$this->db->select('core_grade.grade_id, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreClass(){
			$this->db->select('core_class.class_id, core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreFamilyRelation(){
			$this->db->select('core_family_relation.family_relation_id, core_family_relation.family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('core_family_relation.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreEducation(){
			$this->db->select('core_education.education_id, core_education.education_name');
			$this->db->from('core_education');
			$this->db->where('core_education.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreExpertise(){
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreLanguage(){
			$this->db->select('core_language.language_id, core_language.language_name');
			$this->db->from('core_language');
			$this->db->where('core_language.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreBank(){
			$this->db->select('core_bank.bank_id, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getFamilyRelationName($family_relation_id){
			$this->db->select('core_family_relation.family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('core_family_relation.family_relation_id', $family_relation_id);
			$result = $this->db->get()->row_array();
			return $result['family_relation_name'];
		}

		public function getEducationName($education_id){
			$this->db->select('core_education.education_name');
			$this->db->from('core_education');
			$this->db->where('core_education.education_id', $education_id);
			$result = $this->db->get()->row_array();
			return $result['education_name'];
		}

		public function getExpertiseName($expertise_id){
			$this->db->select('core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_id', $expertise_id);
			$result = $this->db->get()->row_array();
			return $result['expertise_name'];
		}

		public function getLanguageName($language_id){
			$this->db->select('core_language.language_name');
			$this->db->from('core_language');
			$this->db->where('core_language.language_id', $language_id);
			$result = $this->db->get()->row_array();
			return $result['language_name'];
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			if(!isset($result['division_name'])){
				return '-';
			}else{
				return $result['division_name'];
			}
		}

		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			if(!isset($result['department_name'])){
				return '-';
			}else{
				return $result['department_name'];
			}
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			if(!isset($result['section_name'])){
				return '-';
			}else{
				return $result['section_name'];
			}
		}

		public function insertHROEmployeeData($data){
			return $this->db->insert('hro_employee_data', $data);
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

		public function insertHROEmployeeFamily($data){
			return $this->db->insert('hro_employee_family', $data);
		}

		public function insertHROEmployeeEducation($data){
			return $this->db->insert('hro_employee_education', $data);
		}

		public function insertHROEmployeeExpertise($data){
			return $this->db->insert('hro_employee_expertise', $data);
		}

		public function insertHROEmployeeExperience($data){
			return $this->db->insert('hro_employee_experience', $data);
		}

		public function insertHROEmployeeLanguage($data){
			return $this->db->insert('hro_employee_language', $data);
		}
		
		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name, hro_employee_data.grade_id, core_grade.grade_name, hro_employee_data.class_id, core_class.class_name, hro_employee_data.job_title_id, core_job_title.job_title_name, hro_employee_data.bank_id, core_bank.bank_name, hro_employee_data.employee_bank_acct_no, hro_employee_data.employee_bank_acct_name, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.employee_address, hro_employee_data.employee_city, hro_employee_data.employee_postal_code, hro_employee_data.employee_rt, hro_employee_data.employee_rw, hro_employee_data.employee_kelurahan, hro_employee_data.employee_kecamatan, hro_employee_data.employee_home_phone, hro_employee_data.employee_mobile_phone, hro_employee_data.employee_email_address, hro_employee_data.employee_gender, hro_employee_data.employee_date_of_birth, hro_employee_data.employee_place_of_birth, hro_employee_data.employee_id_type, hro_employee_data.employee_id_number, hro_employee_data.employee_religion, hro_employee_data.employee_blood_type, hro_employee_data.employee_residential_address, hro_employee_data.employee_residential_city, hro_employee_data.employee_residential_postal_code, hro_employee_data.employee_residential_rt, hro_employee_data.employee_residential_rw, hro_employee_data.employee_residential_kelurahan, hro_employee_data.employee_residential_kecamatan, hro_employee_data.marital_status_id, core_marital_status.marital_status_name, hro_employee_data.employee_heir_name, hro_employee_data.employee_employment_working_status, hro_employee_data.employee_hire_date, hro_employee_data.employee_employment_status, hro_employee_data.employee_employment_status_date, hro_employee_data.employee_employment_status_duedate, hro_employee_data.employee_employment_overtime_status, hro_employee_data.employee_remark, hro_employee_data.employee_rfid_code, hro_employee_data.employee_last_day_off, hro_employee_data.employee_day_off_cycle, hro_employee_data.employee_day_off_status');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			$this->db->join('core_grade', 'hro_employee_data.grade_id = core_grade.grade_id');
			$this->db->join('core_class', 'hro_employee_data.class_id = core_class.class_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
			$this->db->join('core_marital_status', 'hro_employee_data.marital_status_id = core_marital_status.marital_status_id');
			$this->db->join('core_bank', 'hro_employee_data.bank_id = core_bank.bank_id');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			return $this->db->get()->row_array();
		}

		public function getHROEmployeeFamily_Detail($employee_id){
			$this->db->select('hro_employee_family.employee_family_id, hro_employee_family.family_relation_id, core_family_relation.family_relation_name, hro_employee_family.marital_status_id, core_marital_status.marital_status_name, hro_employee_family.employee_family_name, hro_employee_family.employee_family_address, hro_employee_family.employee_family_city, hro_employee_family.employee_family_postal_code, hro_employee_family.employee_family_rt, hro_employee_family.employee_family_rw, hro_employee_family.employee_family_kecamatan, hro_employee_family.employee_family_kelurahan, hro_employee_family.employee_family_home_phone, hro_employee_family.employee_family_mobile_phone, hro_employee_family.employee_family_education, hro_employee_family.employee_family_remark');
			$this->db->from('hro_employee_family');
			$this->db->join('core_family_relation', 'hro_employee_family.family_relation_id = core_family_relation.family_relation_id');
			$this->db->join('core_marital_status', 'hro_employee_family.marital_status_id = core_marital_status.marital_status_id');
			$this->db->where('hro_employee_family.employee_id', $employee_id);
			$this->db->where('hro_employee_family.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeEducation_Detail($employee_id){
			$this->db->select('hro_employee_education.employee_education_id, hro_employee_education.education_id, core_education.education_name, hro_employee_education.employee_education_type, hro_employee_education.employee_education_name, hro_employee_education.employee_education_city, hro_employee_education.employee_education_from_period, hro_employee_education.employee_education_to_period, hro_employee_education.employee_education_duration, hro_employee_education.employee_education_passed, hro_employee_education.employee_education_certificate, hro_employee_education.employee_education_remark');
			$this->db->from('hro_employee_education');
			$this->db->join('core_education', 'hro_employee_education.education_id = core_education.education_id');
			$this->db->where('hro_employee_education.employee_id', $employee_id);
			$this->db->where('hro_employee_education.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeExpertise_Detail($employee_id){
			$this->db->select('hro_employee_expertise.employee_expertise_id, hro_employee_expertise.expertise_id, core_expertise.expertise_name, hro_employee_expertise.employee_expertise_name, hro_employee_expertise.employee_expertise_city, hro_employee_expertise.employee_expertise_from_period, hro_employee_expertise.employee_expertise_to_period, hro_employee_expertise.employee_expertise_duration, hro_employee_expertise.employee_expertise_passed, hro_employee_expertise.employee_expertise_certificate, hro_employee_expertise.employee_expertise_remark');
			$this->db->from('hro_employee_expertise');
			$this->db->join('core_expertise', 'hro_employee_expertise.expertise_id = core_expertise.expertise_id');
			$this->db->where('hro_employee_expertise.employee_id', $employee_id);
			$this->db->where('hro_employee_expertise.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeExperience_Detail($employee_id){
			$this->db->select('hro_employee_experience.employee_experience_id, hro_employee_experience.experience_company_name, hro_employee_experience.experience_company_address, hro_employee_experience.experience_job_title, hro_employee_experience.experience_from_period, hro_employee_experience.experience_to_period, hro_employee_experience.experience_last_salary, hro_employee_experience.experience_separation_reason, hro_employee_experience.experience_separation_letter, hro_employee_experience.experience_remark');
			$this->db->from('hro_employee_experience');
			$this->db->where('hro_employee_experience.employee_id', $employee_id);
			$this->db->where('hro_employee_experience.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeLanguage_Detail($employee_id){
			$this->db->select('hro_employee_language.employee_language_id, hro_employee_language.language_id, core_language.language_name, hro_employee_language.employee_language_listen, hro_employee_language.employee_language_read, hro_employee_language.employee_language_write, hro_employee_language.employee_language_speak, hro_employee_language.employee_language_remark');
			$this->db->from('hro_employee_language');
			$this->db->join('core_language', 'hro_employee_language.language_id = core_language.language_id');
			$this->db->where('hro_employee_language.employee_id', $employee_id);
			$this->db->where('hro_employee_language.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function deleteHROEmployeeFamily($data){
			$this->db->where("hro_employee_family.employee_family_id", $data['employee_family_id']);
			$query = $this->db->update('hro_employee_family', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeEducation($data){
			$this->db->where("hro_employee_education.employee_education_id", $data['employee_education_id']);
			$query = $this->db->update('hro_employee_education', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeExpertise($data){
			$this->db->where("hro_employee_expertise.employee_expertise_id", $data['employee_expertise_id']);
			$query = $this->db->update('hro_employee_expertise', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeExperience($data){
			$this->db->where("hro_employee_experience.employee_experience_id", $data['employee_experience_id']);
			$query = $this->db->update('hro_employee_experience', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeLanguage($data){
			$this->db->where("hro_employee_language.employee_language_id", $data['employee_language_id']);
			$query = $this->db->update('hro_employee_language', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		
		public function updateHROEmployeeData($data){
			$this->db->where('employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeData($id){
			$this->db->where("employee_id",$id);
			$query = $this->db->update('hro_employee_data', array("data_state"=>1));
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
		
	}
?>