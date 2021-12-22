<?php
	class hroemployeeadministrationckpreport_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeadministrationckpreport_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreUnit($section_id){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.section_id', $section_id);
			$this->db->where('core_unit.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod(){
			$this->db->select("payroll_monthly_period.monthly_period_id, CONCAT(payroll_monthly_period.monthly_period_start_date, ' s/d ', payroll_monthly_period.monthly_period_end_date) AS monthly_period_date", FALSE);
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->order_by('payroll_monthly_period.monthly_period', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod_Detail($monthly_period_id){
			$this->db->select("payroll_monthly_period.monthly_period_id, payroll_monthly_period.monthly_period_start_date,  payroll_monthly_period.monthly_period_end_date");
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->where('payroll_monthly_period.monthly_period_id', $monthly_period_id);
			$this->db->order_by('payroll_monthly_period.monthly_period');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleEmployeeShift($location_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeShiftCode($employee_shift_id){
			$this->db->select('schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.employee_shift_id', $employee_shift_id);
			$result = $this->db->get()->row_array();
			return $result['employee_shift_code'];
		}

		public function getPayrollMonthlyPeriod_Dashboard($monthly_period_id){
			$this->db->select("payroll_monthly_period.monthly_period_id, payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date");
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->where('payroll_monthly_period.monthly_period_id <=', $monthly_period_id);
			$this->db->order_by('payroll_monthly_period.monthly_period_id', 'DESC');
			$this->db->limit(2);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAdministrationCKP($start_date, $end_date, $employee_shift_id, $division_id, $department_id, $section_id, $unit_id){

			$query = $this->db->query("
					SELECT unit_id, employee_attendance_date,  
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_attendance_total, 
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 2
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_absence_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 3
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_sick_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 4
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_permit_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 0
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_off_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status <> 0
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_attend_total
					FROM hro_employee_attendance_data
					WHERE employee_shift_id = ".$employee_shift_id."
					AND employee_attendance_date >= '".$start_date."'
					AND employee_attendance_date <= '".$end_date."'
					AND division_id = ".$division_id."
					AND department_id = ".$department_id."
					AND section_id = ".$section_id." 
					AND unit_id = ".$unit_id." 
					GROUP BY unit_id, employee_attendance_date
					ORDER BY unit_id
					");
			$result = $query->result_array();
			return $result;
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getUnitName($unit_id){
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$this->db->where('core_unit.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['unit_name'];
		}		


		public function getHROEmployeeAdministrationCKP_Dashboard($start_date, $end_date, $employee_shift_id, $division_id, $department_id, $section_id, $unit_id){

			$query = $this->db->query("
					SELECT unit_id, employee_attendance_date,  
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_attendance_total, 
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 2
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_absence_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 3
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_sick_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 4
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_permit_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status = 0
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_off_total,
					(
						SELECT COUNT(employee_id) 
						FROM hro_employee_attendance_data b
						WHERE b.employee_shift_id = hro_employee_attendance_data.employee_shift_id
						AND b.unit_id = hro_employee_attendance_data.unit_id
						AND b.employee_attendance_date = hro_employee_attendance_data.employee_attendance_date
						AND employee_attendance_date_status <> 0
						GROUP BY b.unit_id, b.employee_attendance_date
					) AS employee_attend_total
					FROM hro_employee_attendance_data
					WHERE employee_shift_id = ".$employee_shift_id."
					AND employee_attendance_date >= '".$start_date."'
					AND employee_attendance_date <= '".$end_date."'
					AND division_id = ".$division_id."
					AND department_id = ".$department_id."
					AND section_id = ".$section_id." 
					AND unit_id = ".$unit_id." 
					ORDER BY unit_id
					");
			$result = $query->result_array();
			return $result;
		}
	}
?>