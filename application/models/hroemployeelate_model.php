<?php
	class hroemployeelate_model extends CI_Model {
		var $table = "transaction_employee_late";
		
		public function hroemployeelate_model(){
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
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
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
			
			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Late($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			
			if($payroll_employee_level != 9 ){
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

		public function getCoreLate(){
			$this->db->select('core_late.late_id, core_late.late_name');
			$this->db->from('core_late');
			$this->db->where('core_late.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getLateName($late_id){
			$this->db->select('core_late.late_name');
			$this->db->from('core_late');
			$this->db->where('core_late.late_id', $late_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['late_name'];
		}
		
		public function saveNewHROEmployeeLate($data){
			return $this->db->insert('hro_employee_late',$data);
		}

		public function getHROEmployeeLate_Data($employee_id){
			$this->db->select('hro_employee_late.employee_late_id, hro_employee_late.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_late.late_id, core_late.late_name, hro_employee_late.employee_late_date, hro_employee_late.employee_late_duration, hro_employee_late.employee_late_description, hro_employee_late.employee_late_remark');
			$this->db->from('hro_employee_late');
			$this->db->join('hro_employee_data', 'hro_employee_late.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_late', 'hro_employee_late.late_id = core_late.late_id');
			$this->db->where('hro_employee_late.data_state',0);
			$this->db->where('hro_employee_late.employee_id', $employee_id);
			$this->db->order_by('hro_employee_late.employee_late_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_late_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeelate($data){
			$this->db->where('employee_late_id',$data['employee_late_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeLate($employee_id){
			$this->db->where("hro_employee_late.employee_id", $employee_id);
			$query = $this->db->update('hro_employee_late', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeLate_Data($employee_late_id){
			$this->db->where("hro_employee_late.employee_late_id", $employee_late_id);
			$query = $this->db->update('hro_employee_late', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>