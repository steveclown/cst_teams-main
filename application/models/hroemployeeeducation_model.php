<?php
	class hroemployeeeducation_model extends CI_Model {
		var $table = "hro_employee_education";
		
		public function hroemployeeeducation_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Education($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($employee_id != ''){
				$this->db->where('hro_employee_data.employee_id', $employee_id);
			}

			if ($division_id != ''){
				$this->db->where('hro_employee_data.division_id', $division_id);
			}

			if ($department_id != ''){
				$this->db->where('hro_employee_data.department_id', $department_id);
			}

			if ($section_id != ''){
				$this->db->where('hro_employee_data.section_id', $section_id);
			}


			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreEducation(){
			$this->db->select('core_education.education_id, core_education.education_name');
			$this->db->from('core_education');
			$this->db->where('core_education.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getEducationName($education_id){
			$this->db->select('core_education.education_name');
			$this->db->from('core_education');
			$this->db->where('core_education.education_id',$education_id);
			$result = $this->db->get()->row_array();
			return $result['education_name'];
		}

		public function getEmployeeName($id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
			}
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}


		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['section_name'];
		}
		
		public function saveNewHROEmployeeEducation($data){
			return $this->db->insert('hro_employee_education',$data);
		}

		public function getHROEmployeeEducation_Data($employee_id){
			$this->db->select('hro_employee_education.employee_education_id, hro_employee_education.employee_id, hro_employee_education.education_id, hro_employee_education.employee_education_type, hro_employee_education.employee_education_name, hro_employee_education.employee_education_city, hro_employee_education.employee_education_from_period, hro_employee_education.employee_education_to_period, hro_employee_education.employee_education_duration, hro_employee_education.employee_education_passed, hro_employee_education.employee_education_certificate, hro_employee_education.employee_education_remark');
			$this->db->from('hro_employee_education');
			$this->db->where('hro_employee_education.data_state',0);
			$this->db->where('hro_employee_education.employee_id', $employee_id);
			$this->db->order_by('hro_employee_education.employee_education_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_education_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeeeducation($data){
			$this->db->where('employee_education_id',$data['employee_education_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteHROEmployeeEducation($employee_id){
			$this->db->where("employee_id",$employee_id);
			$query = $this->db->update('hro_employee_education', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeEducation_Data($employee_education_id){
			$this->db->where("employee_education_id",$employee_education_id);
			$query = $this->db->update('hro_employee_education', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>