<?php
	class hroemployeeattendancetotalsse_model extends CI_Model {
		var $table = "hro_employee_allowance";
		
		public function hroemployeeattendancetotalsse_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getScheduleEmployeeShift($region_id, $branch_id, $location_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.region_id', $region_id);
			$this->db->where('schedule_employee_shift.branch_id', $branch_id);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			$this->db->order_by('schedule_employee_shift.employee_shift_code', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod(){
			$this->db->select("payroll_monthly_period.monthly_period, CONCAT(payroll_monthly_period.monthly_period_start_date, ' s/d ', payroll_monthly_period.monthly_period_end_date) AS monthly_period_date", FALSE);
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAttendanceTotal($region_id, $branch_id, $location_id, $employee_shift_id, $employee_monthly_period){
			$this->db->select('hro_employee_attendance_total.employee_attendance_total_id, hro_employee_attendance_total.employee_shift_id, schedule_employee_shift.employee_shift_code, hro_employee_attendance_total.employee_monthly_period, hro_employee_attendance_total.employee_monthly_start_date, hro_employee_attendance_total.employee_monthly_end_date');
			$this->db->from('hro_employee_attendance_total');
			$this->db->join('schedule_employee_shift', 'hro_employee_attendance_total.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('hro_employee_attendance_total.data_state', 0);
			$this->db->where('hro_employee_attendance_total.region_id', $region_id);
			$this->db->where('hro_employee_attendance_total.branch_id', $branch_id);
			$this->db->where('hro_employee_attendance_total.location_id', $location_id);

			if ($employee_shift_id != ''){
				$this->db->where('hro_employee_attendance_total.employee_shift_id', $employee_shift_id);
			}

			if ($employee_monthly_period != ''){
				$this->db->where('hro_employee_attendance_total.employee_monthly_period', $employee_monthly_period);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod_Detail($monthly_period){
			$this->db->select('payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date, payroll_monthly_period.monthly_period_working_days, payroll_monthly_period.monthly_period');
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->where('payroll_monthly_period.monthly_period', $monthly_period);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleEmployeeShiftItem_Detail($region_id, $branch_id, $location_id, $employee_shift_id){
			$this->db->select('schedule_employee_shift_item.employee_shift_id, schedule_employee_shift_item.region_id, schedule_employee_shift_item.branch_id, schedule_employee_shift_item.location_id, schedule_employee_shift_item.division_id, schedule_employee_shift_item.department_id, schedule_employee_shift_item.section_id, schedule_employee_shift_item.unit_id, schedule_employee_shift_item.employee_id, hro_employee_data.job_title_id, hro_employee_data.employee_employment_status, hro_employee_data.bank_id, hro_employee_data.employee_bank_acct_no, hro_employee_data.employee_bank_acct_name, hro_employee_data.employee_hire_date');
			$this->db->from('schedule_employee_shift_item');
			$this->db->join('hro_employee_data', 'schedule_employee_shift_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('schedule_employee_shift_item.region_id', $region_id);
			$this->db->where('schedule_employee_shift_item.branch_id', $branch_id);
			$this->db->where('schedule_employee_shift_item.location_id', $location_id);
			$this->db->where('schedule_employee_shift_item.employee_shift_id', $employee_shift_id);
			$this->db->order_by('schedule_employee_shift_item.employee_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAttendanceTotal_EmployeeShift($employee_shift_id, $employee_monthly_period){
			$this->db->select('hro_employee_attendance_total.employee_attendance_total_id');
			$this->db->from('hro_employee_attendance_total');
			$this->db->where('hro_employee_attendance_total.employee_shift_id', $employee_shift_id);
			$this->db->where('hro_employee_attendance_total.employee_monthly_period', $employee_monthly_period);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.region_id, hro_employee_data.branch_id, hro_employee_data.location_id, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.unit_id, hro_employee_data.job_title_id, hro_employee_data.bank_id, hro_employee_data.employee_employment_status, hro_employee_data.employee_hire_date, hro_employee_data.employee_bank_acct_no, hro_employee_data.employee_bank_acct_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeAttendanceData_Detail($employee_id, $employee_monthly_start_date, $employee_monthly_end_date){
			$this->db->select('hro_employee_attendance_data.region_id, hro_employee_attendance_data.branch_id, hro_employee_attendance_data.location_id, hro_employee_attendance_data.division_id, hro_employee_attendance_data.department_id, hro_employee_attendance_data.section_id, hro_employee_attendance_data.unit_id, hro_employee_data.job_title_id, hro_employee_attendance_data.employee_attendance_date, hro_employee_attendance_data.employee_attendance_date_status, hro_employee_attendance_data.employee_attendance_late_status,  hro_employee_attendance_data.employee_attendance_late_hours, hro_employee_attendance_data.employee_attendance_late_minutes, hro_employee_attendance_data.employee_attendance_overtime_status, hro_employee_attendance_data.employee_attendance_overtime_hours, hro_employee_attendance_data.employee_attendance_overtime_minutes, hro_employee_attendance_data.employee_attendance_overtime_dayoff, hro_employee_attendance_data.employee_attendance_homeearly_status, hro_employee_attendance_data.employee_attendance_homeearly_hours, hro_employee_attendance_data.employee_attendance_homeearly_minutes, hro_employee_data.employee_employment_status, hro_employee_data.employee_hire_date');
			$this->db->from('hro_employee_attendance_data');
			$this->db->join('hro_employee_data', 'hro_employee_attendance_data.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_attendance_data.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date >=', $employee_monthly_start_date);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date <=', $employee_monthly_end_date);
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

		public function getUnitName($unit_id){
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$result = $this->db->get()->row_array();
			return $result['unit_name'];
		}

		public function getJobTitleName($job_title_id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $job_title_id);
			$result = $this->db->get()->row_array();
			return $result['job_title_name'];
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

		public function getEmployeeShiftCode($employee_shift_id){
			$this->db->select('schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.employee_shift_id', $employee_shift_id);
			$result = $this->db->get()->row_array();
			return $result['employee_shift_code'];
		}	

		public function insertHROEmployeeAttendanceTotal($data){
			return $this->db->insert('hro_employee_attendance_total',$data);
		}	

		public function getEmployeeAttendanceTotalID($created_id){
			$this->db->select('hro_employee_attendance_total.employee_attendance_total_id');
			$this->db->from('hro_employee_attendance_total');
			$this->db->where('hro_employee_attendance_total.created_id', $created_id);
			$this->db->order_by('hro_employee_attendance_total.employee_attendance_total_id', DESC);
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_attendance_total_id'];
		}	

		public function insertHROEmployeeAttendanceTotalItem($data){
			return $this->db->insert('hro_employee_attendance_total_item',$data);
		}

		public function getHROEmployeeAttendanceTotal_Detail($employee_attendance_total_id){
			$this->db->select('hro_employee_attendance_total.region_id, hro_employee_attendance_total.branch_id, hro_employee_attendance_total.location_id, hro_employee_attendance_total.employee_attendance_total_id, hro_employee_attendance_total.employee_shift_id, schedule_employee_shift.employee_shift_code, hro_employee_attendance_total.employee_monthly_period, hro_employee_attendance_total.employee_monthly_start_date, hro_employee_attendance_total.employee_monthly_end_date');
			$this->db->from('hro_employee_attendance_total');
			$this->db->join('schedule_employee_shift', 'hro_employee_attendance_total.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('hro_employee_attendance_total.employee_attendance_total_id', $employee_attendance_total_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeAttendanceTotalItem_Detail($employee_attendance_total_id){
			$this->db->select('hro_employee_attendance_total_item.employee_id, hro_employee_data.employee_name, hro_employee_attendance_total_item.division_id, core_division.division_name, hro_employee_attendance_total_item.department_id, core_department.department_name, hro_employee_attendance_total_item.section_id, core_section.section_name, hro_employee_attendance_total_item.unit_id, core_unit.unit_name, hro_employee_attendance_total_item.job_title_id, core_job_title.job_title_name, hro_employee_attendance_total_item.employee_monthly_period, hro_employee_attendance_total_item.employee_monthly_start_date, hro_employee_attendance_total_item.employee_monthly_end_date, hro_employee_attendance_total_item.employee_employment_status, hro_employee_attendance_total_item.employee_hire_date, hro_employee_attendance_total_item.employee_working_months, hro_employee_attendance_total_item.total_working_days, hro_employee_attendance_total_item.total_working_payroll_days, hro_employee_attendance_total_item.total_working_off_payroll_days, hro_employee_attendance_total_item.total_default_payroll_days, hro_employee_attendance_total_item.total_permit_with_doctor_days, hro_employee_attendance_total_item.total_permit_with_doctor_payroll_days, hro_employee_attendance_total_item.total_permit_no_doctor_days, hro_employee_attendance_total_item.total_permit_no_doctor_payroll_days, hro_employee_attendance_total_item.total_permit_no_tapping_in, hro_employee_attendance_total_item.total_permit_no_tapping_out, hro_employee_attendance_total_item.total_absence_payroll_days, hro_employee_attendance_total_item.total_cancel_off_payrol_days, hro_employee_attendance_total_item.total_swap_off_payroll_days, hro_employee_attendance_total_item.total_early_days, hro_employee_attendance_total_item.total_early_payroll_less_1_days, hro_employee_attendance_total_item.total_early_payroll_less_5_days, hro_employee_attendance_total_item.total_early_payroll_more_5_days, hro_employee_attendance_total_item.total_early_hours_list, hro_employee_attendance_total_item.total_late_days, hro_employee_attendance_total_item.total_late_hours, hro_employee_attendance_total_item.total_late_minutes, hro_employee_attendance_total_item.total_overtime_days, hro_employee_attendance_total_item.total_overtime_hours, hro_employee_attendance_total_item.total_overtime_minutes, hro_employee_attendance_total_item.total_overtime_hours_list');
			$this->db->from('hro_employee_attendance_total_item');
			$this->db->join('hro_employee_data', 'hro_employee_attendance_total_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_division', 'hro_employee_attendance_total_item.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_attendance_total_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_attendance_total_item.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_attendance_total_item.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'hro_employee_attendance_total_item.job_title_id = core_job_title.job_title_id');
			$this->db->where('hro_employee_attendance_total_item.employee_attendance_total_id', $employee_attendance_total_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
	}
?>