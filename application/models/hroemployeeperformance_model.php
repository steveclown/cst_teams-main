<?php
	class hroemployeeperformance_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeperformance_model(){
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
			$this->db->where('hro_employee_data.location_id', $location_id);
			
			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Performance($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
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

		public function getHROEmployeeLate($start_date, $end_date, $employee_id){
			$this->db->select('hro_employee_late.employee_late_id, hro_employee_late.employee_id, hro_employee_late.late_id, core_late.late_name, hro_employee_late.employee_late_date, hro_employee_late.employee_late_description, hro_employee_late.employee_late_duration');
			$this->db->from('hro_employee_late');
			$this->db->join('core_late', 'hro_employee_late.late_id = core_late.late_id');
			$this->db->where('hro_employee_late.data_state',0);
			$this->db->where('hro_employee_late.employee_id', $employee_id);
			$this->db->where('hro_employee_late.employee_late_date >=', $start_date);
			$this->db->where('hro_employee_late.employee_late_date <=', $end_date);
			$this->db->order_by('hro_employee_late.employee_late_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeePermit($start_date, $end_date, $employee_id){
			$this->db->select('hro_employee_permit.employee_permit_id, hro_employee_permit.employee_id, hro_employee_permit.permit_id, core_permit.permit_name, hro_employee_permit.employee_permit_date, hro_employee_permit.employee_permit_start_date, hro_employee_permit.employee_permit_end_date, hro_employee_permit.employee_permit_description, hro_employee_permit.employee_permit_duration');
			$this->db->from('hro_employee_permit');
			$this->db->join('core_permit', 'hro_employee_permit.permit_id = core_permit.permit_id');
			$this->db->where('hro_employee_permit.data_state',0);
			$this->db->where('hro_employee_permit.employee_id', $employee_id);
			$this->db->where('hro_employee_permit.employee_permit_date >=', $start_date);
			$this->db->where('hro_employee_permit.employee_permit_date <=', $end_date);
			$this->db->order_by('hro_employee_permit.employee_permit_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAbsence($start_date, $end_date, $employee_id){
			$this->db->select('hro_employee_absence.employee_absence_id, hro_employee_absence.employee_id, hro_employee_absence.absence_id, core_absence.absence_name, hro_employee_absence.employee_absence_date, hro_employee_absence.employee_absence_start_date, hro_employee_absence.employee_absence_end_date, hro_employee_absence.employee_absence_description, hro_employee_absence.employee_absence_duration');
			$this->db->from('hro_employee_absence');
			$this->db->join('core_absence', 'hro_employee_absence.absence_id = core_absence.absence_id');
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->where('hro_employee_absence.employee_id', $employee_id);
			$this->db->where('hro_employee_absence.employee_absence_date >=', $start_date);
			$this->db->where('hro_employee_absence.employee_absence_date <=', $end_date);
			$this->db->order_by('hro_employee_absence.employee_absence_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeHomeEarly($start_date, $end_date, $employee_id){
			$this->db->select('hro_employee_home_early.employee_home_early_id, hro_employee_home_early.employee_id, hro_employee_home_early.home_early_id, core_home_early.home_early_name, hro_employee_home_early.employee_home_early_date, hro_employee_home_early.employee_home_early_description, hro_employee_home_early.employee_home_early_reason');
			$this->db->from('hro_employee_home_early');
			$this->db->join('core_home_early', 'hro_employee_home_early.home_early_id = core_home_early.home_early_id');
			$this->db->where('hro_employee_home_early.data_state',0);
			$this->db->where('hro_employee_home_early.employee_id', $employee_id);
			$this->db->where('hro_employee_home_early.employee_home_early_date >=', $start_date);
			$this->db->where('hro_employee_home_early.employee_home_early_date <=', $end_date);
			$this->db->order_by('hro_employee_home_early.employee_home_early_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeWorkingDayOff($start_date, $end_date, $employee_id){
			$this->db->select('hro_employee_working_dayoff.employee_working_dayoff_id, hro_employee_working_dayoff.employee_id, hro_employee_working_dayoff.dayoff_id, core_dayoff.dayoff_name, hro_employee_working_dayoff.employee_working_dayoff_date, hro_employee_working_dayoff.employee_working_dayoff_description, hro_employee_working_dayoff.employee_working_dayoff_start_date, hro_employee_working_dayoff.employee_working_dayoff_end_date');
			$this->db->from('hro_employee_working_dayoff');
			$this->db->join('core_dayoff', 'hro_employee_working_dayoff.dayoff_id = core_dayoff.dayoff_id');
			$this->db->where('hro_employee_working_dayoff.data_state',0);
			$this->db->where('hro_employee_working_dayoff.employee_id', $employee_id);
			$this->db->where('hro_employee_working_dayoff.employee_working_dayoff_date >=', $start_date);
			$this->db->where('hro_employee_working_dayoff.employee_working_dayoff_date <=', $end_date);
			$this->db->order_by('hro_employee_working_dayoff.employee_working_dayoff_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollOvertimeRequest($start_date, $end_date, $employee_id){
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.employee_id, payroll_overtime_request.overtime_type_id, core_overtime_type.overtime_type_name, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_duration');
			$this->db->from('payroll_overtime_request');
			$this->db->join('core_overtime_type', 'payroll_overtime_request.overtime_type_id = core_overtime_type.overtime_type_id');
			$this->db->where('payroll_overtime_request.data_state',0);
			$this->db->where('payroll_overtime_request.overtime_request_approved', 1);
			$this->db->where('payroll_overtime_request.employee_id', $employee_id);
			$this->db->where('payroll_overtime_request.overtime_request_date >=', $start_date);
			$this->db->where('payroll_overtime_request.overtime_request_date <=', $end_date);
			$this->db->order_by('payroll_overtime_request.overtime_request_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollLeaveRequest($start_date, $end_date, $employee_id){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, payroll_leave_request.annual_leave_id, core_annual_leave.annual_leave_name, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_reason, payroll_leave_request.leave_request_start_date, payroll_leave_request.leave_request_end_date, payroll_leave_request.leave_request_duration');
			$this->db->from('payroll_leave_request');
			$this->db->join('core_annual_leave', 'payroll_leave_request.annual_leave_id = core_annual_leave.annual_leave_id');
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->where('payroll_leave_request.leave_request_approved', 1);
			$this->db->where('payroll_leave_request.employee_id', $employee_id);
			$this->db->where('payroll_leave_request.leave_request_date >=', $start_date);
			$this->db->where('payroll_leave_request.leave_request_date <=', $end_date);
			$this->db->order_by('payroll_leave_request.leave_request_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeTransfer($employee_id){
			$this->db->select('hro_employee_transfer.employee_transfer_id, hro_employee_transfer.employee_id, hro_employee_transfer.region_id, core_region.region_name, hro_employee_transfer.branch_id, core_branch.branch_name, hro_employee_transfer.division_id, core_division.division_name, hro_employee_transfer.department_id, core_department.department_name, hro_employee_transfer.section_id, core_section.section_name, hro_employee_transfer.location_id, core_location.location_name, hro_employee_transfer.job_title_id, core_job_title.job_title_name, hro_employee_transfer.grade_id, core_grade.grade_name, hro_employee_transfer.class_id, core_class.class_name, hro_employee_transfer.employee_transfer_date');
			$this->db->from('hro_employee_transfer');
			$this->db->join('core_region', 'hro_employee_transfer.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_transfer.branch_id = core_branch.branch_id');
			$this->db->join('core_division', 'hro_employee_transfer.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_transfer.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_transfer.section_id = core_section.section_id');
			$this->db->join('core_location', 'hro_employee_transfer.location_id = core_location.location_id');
			$this->db->join('core_job_title', 'hro_employee_transfer.job_title_id = core_job_title.job_title_id');
			$this->db->join('core_grade', 'hro_employee_transfer.grade_id = core_grade.grade_id');
			$this->db->join('core_class', 'hro_employee_transfer.class_id = core_class.class_id');
			$this->db->where('hro_employee_transfer.data_state',0);
			$this->db->where('hro_employee_transfer.employee_id', $employee_id);
			$this->db->order_by('hro_employee_transfer.employee_transfer_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeMonthly($start_date, $end_date, $employee_id){
			$this->db->select('payroll_employee_monthly.employee_monthly_id, payroll_employee_monthly.employee_id, payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_working_days, payroll_employee_monthly.employee_monthly_basic_salary, payroll_employee_monthly.employee_monthly_allowance_total, payroll_employee_monthly.employee_monthly_deduction_total, payroll_employee_monthly.employee_monthly_overtime_total, payroll_employee_monthly.employee_monthly_early_total, payroll_employee_monthly.employee_monthly_bpjs_amount, payroll_employee_monthly.employee_monthly_allowance_other, payroll_employee_monthly.employee_monthly_deduction_other, payroll_employee_monthly.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly');
			$this->db->where('payroll_employee_monthly.data_state',0);
			$this->db->where('payroll_employee_monthly.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_monthly.employee_monthly_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}
	}
?>