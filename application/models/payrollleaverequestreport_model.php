<?php
	class payrollleaverequestreport_model extends CI_Model {
		var $table = "transaction_leave_request";
		
		public function payrollleaverequestreport_model(){
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

		public function getCoreAnnualLeave(){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getPayrollLeaveRequest_Report($region_id, $branch_id, $location_id, $payroll_employee_level, $division_id, $department_id, $section_id, $annual_leave_id, $start_date, $end_date){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, hro_employee_data.employee_name, hro_employee_data.region_id, core_region.region_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_id, hro_employee_data.section_id, core_section.section_name,    payroll_leave_request.annual_leave_id, core_annual_leave.annual_leave_name, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_duration, 
				payroll_leave_request.leave_request_start_date, payroll_leave_request.leave_request_end_date, payroll_leave_request.leave_request_reason');
			$this->db->from('payroll_leave_request');
			$this->db->join('hro_employee_data','payroll_leave_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_region','hro_employee_data.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_annual_leave', 'payroll_leave_request.annual_leave_id = core_annual_leave.annual_leave_id');
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->where('payroll_leave_request.leave_request_approved', 1);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('payroll_leave_request.leave_request_start_date >=', $start_date);
			$this->db->where('payroll_leave_request.leave_request_end_date <=', $end_date);

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

			if ($annual_leave_id != ''){
				$this->db->where('payroll_leave_request.annual_leave_id', $annual_leave_id);
			}

			$this->db->order_by('payroll_leave_request.annual_leave_id', ASC);
			$result = $this->db->get();
			return $result->result_array();
		}
	}
?>