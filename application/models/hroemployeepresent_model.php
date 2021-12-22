<?php
	class hroemployeepresent_model extends CI_Model {
		var $table = "core_document_book";
		
		public function hroemployeepresent_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDivision(){
			$this->db->select('division_id, division_name');
			$this->db->from('core_division');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDivisionName($division_id)
		{
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getCoreDepartmentData()
		{
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id)
		{
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartmentName($department_id)
		{
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getCoreSection($department_id)
		{
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSectionName($section_id)
		{
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getHroEmployeeData($division_id, $department_id, $section_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHroEmployeeDataName($employee_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getHROEmployeeDataPresent($region_id, $branch_id, $location_id, $employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($employee_id != ''){
				$this->db->where('hro_employee_data.employee_id', $employee_id);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHroEmployeeCode($employee_id){
			$this->db->select('employee_id, employee_code, employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleEmployeeScheduleItem($employee_id, $employee_present_date){
			// print_r($employee_id);
			// exit;
			$this->db->select('schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.employee_schedule_item_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_present_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_status !=', 0);
			// $this->db->where('schedule_employee_schedule_item.employee_schedule_item_status', 2);
			return $this->db->get()->result_array();
		}

		public function insertHroEmployeePresent($data){
			return $this->db->insert('hro_employee_present',$data);
		}
	}
?>