<?php
	class hroemployeeattendancedatareport_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeattendancedatareport_model(){
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

		public function getScheduleEmployeeShiftItem($employee_shift_id){
			$this->db->select('schedule_employee_shift_item.employee_id, hro_employee_data.employee_name');
			$this->db->from('schedule_employee_shift_item');
			$this->db->join('hro_employee_data', 'schedule_employee_shift_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('schedule_employee_shift_item.employee_shift_id', $employee_shift_id);
			$this->db->order_by('hro_employee_data.employee_name', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod_Detail($monthly_period){
			$this->db->select("payroll_monthly_period.monthly_period, payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date");
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->where('payroll_monthly_period.monthly_period', $monthly_period);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeAttendanceData_Detail($start_date, $end_date, $employee_shift_id, $employee_id){
			$this->db->select('hro_employee_attendance_data.region_id, hro_employee_attendance_data.branch_id, hro_employee_attendance_data.location_id, hro_employee_attendance_data.division_id, core_division.division_name, hro_employee_attendance_data.department_id, core_department.department_name, hro_employee_attendance_data.section_id, core_section.section_name, hro_employee_attendance_data.unit_id, hro_employee_data.job_title_id, core_job_title.job_title_name, hro_employee_attendance_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_attendance_data.employee_shift_id, schedule_employee_shift.employee_shift_code, hro_employee_attendance_data.employee_attendance_date, hro_employee_attendance_data.employee_attendance_in_date, hro_employee_attendance_data.employee_attendance_out_date, hro_employee_attendance_data.employee_attendance_date_status, hro_employee_attendance_data.employee_attendance_late_status,  hro_employee_attendance_data.employee_attendance_late_hours, hro_employee_attendance_data.employee_attendance_late_minutes, hro_employee_attendance_data.employee_attendance_overtime_status, hro_employee_attendance_data.employee_attendance_overtime_hours, hro_employee_attendance_data.employee_attendance_overtime_minutes, hro_employee_attendance_data.employee_attendance_overtime_dayoff, hro_employee_attendance_data.employee_attendance_homeearly_status, hro_employee_attendance_data.employee_attendance_homeearly_hours, hro_employee_attendance_data.employee_attendance_homeearly_minutes, hro_employee_data.employee_employment_status, hro_employee_data.employee_hire_date');
			$this->db->from('hro_employee_attendance_data');
			$this->db->join('core_division', 'hro_employee_attendance_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_attendance_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_attendance_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_attendance_data.unit_id = core_unit.unit_id');
			$this->db->join('hro_employee_data', 'hro_employee_attendance_data.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
			$this->db->join('schedule_employee_shift', 'hro_employee_attendance_data.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('hro_employee_attendance_data.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_data.employee_shift_id', $employee_shift_id);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date >=', $start_date);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date <=', $end_date);
			$result = $this->db->get()->result_array();
			return $result;
		}
	}
?>