<?php
	class hroemployeehomeearly_model extends CI_Model {
		var $table = "transaction_employee_absence";
		
		public function hroemployeehomeearly_model(){
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

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($payroll_employee_level != ''){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_HomeEarly($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($payroll_employee_level != 9){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

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

		public function getCoreHomeEarlyDaily(){
			$this->db->select('core_absence.absence_id, core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHomeEarlyDailyName($absence_id){
			$this->db->select('core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.absence_id', $absence_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['absence_name'];
		}
		
		public function saveNewHROEmployeeHomeEarly($data){
			return $this->db->insert('hro_employee_home_early',$data);
		}

		public function getHROEmployeeHomeEarly_Data($employee_id){
			$this->db->select('hro_employee_home_early.employee_home_early_id, hro_employee_home_early.employee_id, hro_employee_home_early.home_early_id, core_home_early.home_early_name, hro_employee_home_early.employee_home_early_date, hro_employee_home_early.employee_home_early_hour, hro_employee_home_early.employee_home_early_description, hro_employee_home_early.employee_home_early_reason');
			$this->db->from('hro_employee_home_early');
			$this->db->join('core_home_early', 'hro_employee_home_early.home_early_id = core_home_early.home_early_id');
			$this->db->where('hro_employee_home_early.data_state',0);
			$this->db->where('hro_employee_home_early.employee_id', $employee_id);
			$this->db->order_by('hro_employee_home_early.employee_home_early_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_absence_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeehomeearly($data){
			$this->db->where('employee_absence_id',$data['employee_absence_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeHomeEarly($employee_id){
			$this->db->where("hro_employee_home_early.employee_id", $employee_id);
			$query = $this->db->update('hro_employee_home_early', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeHomeEarly_Data($employee_home_early_id){
			$this->db->where("hro_employee_home_early.employee_home_early_id", $employee_home_early_id);
			$query = $this->db->update('hro_employee_home_early', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getCoreHomeEarly(){
			$this->db->select('core_home_early.home_early_id, core_home_early.home_early_name');
			$this->db->from('core_home_early');
			$this->db->where('core_home_early.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
	}
?>