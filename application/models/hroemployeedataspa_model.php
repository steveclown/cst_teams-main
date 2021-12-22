<?php
	class hroemployeedataspa_model extends CI_Model {
		var $table = "hro_employee_data";
		
		public function hroemployeedataspa_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getHROEmployeeData($region_id, $branch_id, $location_id, $payroll_employee_level, $division_id, $department_id, $section_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.region_id, hro_employee_data.branch_id, hro_employee_data.location_id, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);

			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.location_id', $location_id);
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

			$this->db->where('data_state', 0);
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

		public function saveNewHROEmployeeData($data){
			return $this->db->insert('hro_employee_data', $data);
		}
		
		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.grade_id, hro_employee_data.class_id, hro_employee_data.job_title_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.employee_address, hro_employee_data.employee_city, hro_employee_data.employee_postal_code, hro_employee_data.employee_rt, hro_employee_data.employee_rw, hro_employee_data.employee_kelurahan, hro_employee_data.employee_kecamatan, hro_employee_data.employee_home_phone, hro_employee_data.employee_mobile_phone, hro_employee_data.employee_email_address, hro_employee_data.employee_gender, hro_employee_data.employee_date_of_birth, hro_employee_data.employee_place_of_birth, hro_employee_data.employee_id_type, hro_employee_data.employee_id_number, hro_employee_data.employee_religion, hro_employee_data.employee_blood_type, hro_employee_data.employee_residential_address, hro_employee_data.employee_residential_city, hro_employee_data.employee_residential_postal_code, hro_employee_data.employee_residential_rt, hro_employee_data.employee_residential_rw, hro_employee_data.employee_residential_kelurahan, hro_employee_data.employee_residential_kecamatan, hro_employee_data.marital_status_id, hro_employee_data.employee_heir_name, hro_employee_data.employee_employment_working_status, hro_employee_data.employee_hire_date, hro_employee_data.employee_employment_status, hro_employee_data.employee_employment_status_date, hro_employee_data.employee_employment_status_duedate, hro_employee_data.employee_employment_overtime_status, hro_employee_data.employee_remark');
			$this->db->from('hro_employee_data');
			$this->db->where('employee_id', $employee_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditHROEmployeeData($data){
			$this->db->where('employee_id',$data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
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
		
		public function deleteHROEmployeeData($id){
			$this->db->where("employee_id",$id);
			$query = $this->db->update('hro_employee_data', array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
		}
		}
	}
?>