<?php
	class hroemployeewarning_model extends CI_Model {
		var $table = "transaction_employee_warning";
		
		public function hroemployeewarning_model(){
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

		public function getHROEmployeeData_Warning($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
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

		public function getCoreWarning(){
			$this->db->select('core_warning.warning_id, core_warning.warning_name');
			$this->db->from('core_warning');
			$this->db->where('core_warning.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getWarningName($warning_id){
			$this->db->select('core_warning.warning_name');
			$this->db->from('core_warning');
			$this->db->where('core_warning.warning_id', $warning_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['warning_name'];
		}
		
		public function saveNewHROEmployeeWarning($data){
			return $this->db->insert('hro_employee_warning',$data);
		}

		public function getHROEmployeeWarning_Data($employee_id){
			$this->db->select('hro_employee_warning.employee_warning_id, hro_employee_warning.employee_id, hro_employee_warning.warning_id, hro_employee_warning.employee_warning_date, hro_employee_warning.employee_warning_description, hro_employee_warning.employee_warning_remark');
			$this->db->from('hro_employee_warning');
			$this->db->where('hro_employee_warning.data_state',0);
			$this->db->where('hro_employee_warning.employee_id', $employee_id);
			$this->db->order_by('hro_employee_warning.employee_warning_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_warning_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeewarning($data){
			$this->db->where('employee_warning_id',$data['employee_warning_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeWarning($employee_id){
			$this->db->where("hro_employee_warning.employee_id", $employee_id);
			$query = $this->db->update('hro_employee_warning', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeWarning_Data($employee_warning_id){
			$this->db->where("hro_employee_warning.employee_warning_id", $employee_warning_id);
			$query = $this->db->update('hro_employee_warning', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>