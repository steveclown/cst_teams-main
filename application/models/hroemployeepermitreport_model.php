<?php
	class hroemployeepermitreport_model extends CI_Model {
		var $table = "transaction_employee_permit";
		
		public function hroemployeepermitreport_model(){
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

		public function getCorePermit(){
			$this->db->select('core_permit.permit_id, core_permit.permit_name');
			$this->db->from('core_permit');
			$this->db->where('core_permit.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeePermit_Report($region_id, $branch_id, $location_id, $payroll_employee_level, $division_id, $department_id, $section_id, $permit_id, $start_date, $end_date){
			$this->db->select('hro_employee_permit.employee_permit_id, hro_employee_permit.employee_id, hro_employee_data.employee_name, hro_employee_data.region_id, core_region.region_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name,  hro_employee_permit.permit_id, core_permit.permit_name, hro_employee_permit.employee_permit_date, hro_employee_permit.employee_permit_start_date, hro_employee_permit.employee_permit_end_date, hro_employee_permit.employee_permit_duration, hro_employee_permit.employee_permit_description, hro_employee_permit.employee_permit_remark');
			$this->db->from('hro_employee_permit');
			$this->db->join('hro_employee_data','hro_employee_permit.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_region','hro_employee_data.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_permit', 'hro_employee_permit.permit_id = core_permit.permit_id');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('hro_employee_permit.employee_permit_start_date >=', $start_date);
			$this->db->where('hro_employee_permit.employee_permit_end_date <=', $end_date);

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

			if ($permit_id != ''){
				$this->db->where('hro_employee_permit.permit_id', $permit_id);
			}

			$this->db->order_by('hro_employee_permit.employee_permit_id', ASC);
			$result = $this->db->get();
			return $result->result_array();
		}
	}
?>