<?php
	class HroEmployeeEmployment_model extends CI_Model {
		var $table = "hro_employee_data";
		
		public function hroemployeeemployment_model(){
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

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			

			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.location_id', $location_id);
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_employment_working_status, hro_employee_data.employee_employment_overtime_status, hro_employee_data.employee_employment_status, hro_employee_data.employee_hire_date, hro_employee_data.employee_employment_status_date, hro_employee_data.employee_employment_status_duedate');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getHROEmployeeEmployment($employee_id){
			$this->db->select('*');
			$this->db->from('hro_employee_employment');
			$this->db->where('hro_employee_employment.data_state',0);
			$this->db->where('hro_employee_employment.employee_id', $employee_id);
			$this->db->order_by('hro_employee_employment.employee_employment_id', 'DESC');
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Employment($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			
			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.location_id', $location_id);
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
		
		public function getDetail($id){
			$this->db->select('employee_id,employee_overtime_status')->from($this->table);
			$this->db->where('employee_id',$id);
			return $this->db->get()->row_array();
		}

		public function getHroEmployeeEmploymentToken($employee_employment_token)
		{	
			$this->db->select('hro_employee_employment.employee_employment_token');
			$this->db->from('hro_employee_employment');
			$this->db->where('hro_employee_employment.employee_employment_token', $employee_employment_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getHroEmployeeEmploymentID($created_id){
			$this->db->select('hro_employee_employment.employee_employment_id');
			$this->db->from('hro_employee_employment');
			$this->db->where('hro_employee_employment.created_id', $created_id);
			$this->db->order_by('hro_employee_employment.employee_employment_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_employment_id'];
		}

		public function saveNewHROEmployeeEmployment($data){
			return $this->db->insert('hro_employee_employment', $data);
		}

		public function updateHROEmployeeData($data){
			$this->db->where("hro_employee_data.employee_id", $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id',$employee_id);
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

		public function getHROEmployeeEmployment_Last($employee_id){
			$this->db->select('*');
			$this->db->from('hro_employee_employment');
			$this->db->where('hro_employee_employment.data_state',0);
			$this->db->where('hro_employee_employment.employee_id', $employee_id);
			$this->db->order_by('hro_employee_employment.employee_employment_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function deleteHROEmployeeEmployment($data){
			$this->db->where("employee_employment_id", $data['employee_employment_id']);
			$query = $this->db->update('hro_employee_employment', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateHROEmployeeDataFromDelete($update_employee){
			$this->db->where('employee_id', $update_employee['employee_id']);
			$query = $this->db->update("hro_employee_data", $update_employee);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>