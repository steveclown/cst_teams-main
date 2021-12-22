<?php
	class hroemployeeexpertise_model extends CI_Model {
		var $table = "hro_employee_expertise";
		
		public function hroemployeeexpertise_model(){
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

		public function getHROEmployeeData_Expertise($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
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

		public function getCoreExpertise(){
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getExpertiseName($expertise_id){
			$this->db->select('core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_id',$expertise_id);
			$result = $this->db->get()->row_array();
			return $result['expertise_name'];
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
		
		public function saveNewHROEmployeeExpertise($data){
			return $this->db->insert('hro_employee_expertise',$data);
		}

		public function getHROEmployeeExpertise_Data($employee_id){
			$this->db->select('hro_employee_expertise.employee_expertise_id, hro_employee_expertise.employee_id, hro_employee_expertise.expertise_id, hro_employee_expertise.employee_expertise_name, hro_employee_expertise.employee_expertise_city, hro_employee_expertise.employee_expertise_from_period, hro_employee_expertise.employee_expertise_to_period, hro_employee_expertise.employee_expertise_duration, hro_employee_expertise.employee_expertise_passed, hro_employee_expertise.employee_expertise_certificate, hro_employee_expertise.employee_expertise_remark');
			$this->db->from('hro_employee_expertise');
			$this->db->where('hro_employee_expertise.data_state',0);
			$this->db->where('hro_employee_expertise.employee_id', $employee_id);
			$this->db->order_by('hro_employee_expertise.employee_expertise_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_expertise_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeeexpertise($data){
			$this->db->where('employee_expertise_id',$data['employee_expertise_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteHROEmployeeExpertise($employee_id){
			$this->db->where("employee_id",$employee_id);
			$query = $this->db->update('hro_employee_expertise', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeExpertise_Data($employee_expertise_id){
			$this->db->where("employee_expertise_id",$employee_expertise_id);
			$query = $this->db->update('hro_employee_expertise', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>