<?php
	class hroemployeeworkingdayoffreport_model extends CI_Model {
		var $table = "transaction_employee_absence";
		
		public function hroemployeeworkingdayoffreport_model(){
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

		public function getCoreDayOff(){
			$this->db->select('core_dayoff.dayoff_id, core_dayoff.dayoff_name');
			$this->db->from('core_dayoff');
			$this->db->where('core_dayoff.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeWorkingDayOff_Report($region_id, $branch_id, $location_id, $payroll_employee_level, $division_id, $department_id, $section_id, $dayoff_id, $start_date, $end_date){
			$this->db->select('hro_employee_working_dayoff.employee_working_dayoff_id, hro_employee_working_dayoff.employee_id, hro_employee_data.employee_name, hro_employee_data.region_id, core_region.region_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_working_dayoff.dayoff_id, core_dayoff.dayoff_name, hro_employee_working_dayoff.employee_working_dayoff_start_date, hro_employee_working_dayoff.employee_working_dayoff_end_date, hro_employee_working_dayoff.employee_working_dayoff_date, hro_employee_working_dayoff.employee_working_dayoff_description');
			$this->db->from('hro_employee_working_dayoff');
			$this->db->join('hro_employee_data','hro_employee_working_dayoff.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_region','hro_employee_data.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_dayoff', 'hro_employee_working_dayoff.dayoff_id = core_dayoff.dayoff_id');
			$this->db->where('hro_employee_working_dayoff.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('hro_employee_working_dayoff.employee_working_dayoff_start_date >=', $start_date);
			$this->db->where('hro_employee_working_dayoff.employee_working_dayoff_end_date <=', $end_date);

			if ($payroll_employee_level != 9){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
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

			if ($dayoff_id != ''){
				$this->db->where('hro_employee_working_dayoff.dayoff_id', $dayoff_id);
			}

			$this->db->order_by('hro_employee_working_dayoff.employee_working_dayoff_id', ASC);
			$result = $this->db->get();
			return $result->result_array();
		}
	}
?>