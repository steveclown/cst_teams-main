<?php
	class hroemployeeattendancedata_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeattendancedata_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getScheduleEmployeeScheduleItem($employee_schedule_item_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.shift_id, schedule_employee_schedule_item.region_id, schedule_employee_schedule_item.branch_id, schedule_employee_schedule_item.location_id, schedule_employee_schedule_item.division_id, schedule_employee_schedule_item.department_id, schedule_employee_schedule_item.section_id, schedule_employee_schedule_item.unit_id, schedule_employee_schedule_item.employee_shift_id, schedule_employee_schedule_item.employee_rfid_code, schedule_employee_schedule_item.employee_schedule_item_status, schedule_employee_schedule_item.employee_schedule_item_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_schedule_item_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAttendance($start_date, $employee_id){
			$query = $this->db->query("SELECT region_id, branch_id, location_id, division_id, department_id, section_id, unit_id, employee_shift_id, shift_id, employee_shift_id, employee_id, employee_rfid_code, employee_attendance_date, MIN(employee_attendance_log_date) employee_attendance_in_date, MAX(employee_attendance_log_date) employee_attendance_out_date
				FROM hro_employee_attendance
				WHERE employee_attendance_date = '".$start_date."'
				AND employee_id = '".$employee_id."'
				GROUP BY employee_id, employee_attendance_date");
			$result = $query->result_array();
			return $result;
		}

		public function getCoreShift_Detail($shift_id){
			$this->db->select('core_shift.shift_next_day, core_shift.start_working_hour, core_shift.end_working_hour, core_shift.total_working_hour, core_shift.working_hours_start, core_shift.working_hours_end');
			$this->db->from('core_shift');
			$this->db->where('core_shift.shift_id', $shift_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getEmployeeAttendanceOutDate($employee_id, $employee_attendance_date){
			$query = $this->db->query("SELECT MIN(employee_attendance_log_date) employee_attendance_out_date
				FROM hro_employee_attendance
				WHERE '".$employee_attendance_date."' = employee_attendance_date
				AND employee_attendance_date = '".$employee_attendance_date."'
				AND employee_id = '".$employee_id."'
				GROUP BY employee_id, employee_attendance_date");
			$result = $query->row_array();
			return $result['employee_attendance_out_date'];
		}

		public function insertHROEmployeeAttendanceData($data){
			return $this->db->insert('hro_employee_attendance_data',$data);
		}







		public function getPayrollMonthlyPeriod(){
			$this->db->select('payroll_monthly_period.monthly_period_id, payroll_monthly_period.monthly_period');
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}		

		public function getHROEmployeeAttendanceDataLog($region_id, $branch_id, $location_id, $monthly_period_id){
			$this->db->select('hro_employee_attendance_data_log.employee_attendance_data_log_id, hro_employee_attendance_data_log.region_id, hro_employee_attendance_data_log.branch_id, hro_employee_attendance_data_log.location_id, hro_employee_attendance_data_log.monthly_period_id, payroll_monthly_period.monthly_period, payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date');
			$this->db->from('hro_employee_attendance_data_log');
			$this->db->join('payroll_monthly_period', 'hro_employee_attendance_data_log.monthly_period_id = payroll_monthly_period.monthly_period_id');
			$this->db->where('hro_employee_attendance_data_log.region_id', $region_id);
			$this->db->where('hro_employee_attendance_data_log.branch_id', $branch_id);
			$this->db->where('hro_employee_attendance_data_log.location_id', $location_id);

			if (!empty($monthly_period_id)){
				$this->db->where('hro_employee_attendance_data_log.monthly_period_id', $monthly_period_id);				
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod_Detail($monthly_period_id){
			$this->db->select('payroll_monthly_period.monthly_period_id, payroll_monthly_period.monthly_period, payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date');
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->where('payroll_monthly_period.monthly_period_id', $monthly_period_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getMonthlyPeriodID($monthly_period_id){
			$this->db->select('hro_employee_attendance_data_log.monthly_period_id');
			$this->db->from('hro_employee_attendance_data_log');
			$this->db->where('hro_employee_attendance_data_log.monthly_period_id', $monthly_period_id);
			$result = $this->db->get()->row_array();
			if(empty($result)){
				return true;
			}else{
				return false;
			}
		}

		

		public function getEmployeeAttendanceDataLogID($created_id){
			$this->db->select('hro_employee_attendance_data_log.employee_attendance_data_log_id');
			$this->db->from('hro_employee_attendance_data_log');
			$this->db->where('hro_employee_attendance_data_log.created_id', $created_id);
			$this->db->order_by('hro_employee_attendance_data_log.employee_attendance_data_log_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_attendance_data_log_id'];
		}

		

		public function getWorkingHoursStatusID($employee_attendance_working_hours){
			$this->db->select('core_working_hours_status.working_hours_status_id');
			$this->db->from('core_working_hours_status');
			$this->db->where('core_working_hours_status.working_hours_start <=', $employee_attendance_working_hours);
			$this->db->where('core_working_hours_status.working_hours_end >', $employee_attendance_working_hours);
			$result = $this->db->get()->row_array();
			return $result['working_hours_status_id'];
		}

				

		

		

		public function getRegionName($region_id){
			$this->db->select('core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.region_id', $region_id);
			$result = $this->db->get()->row_array();
			return $result['region_name'];
		}

		public function getBranchName($branch_id){
			$this->db->select('core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_id', $branch_id);
			$result = $this->db->get()->row_array();
			return $result['branch_name'];
		}		

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$result = $this->db->get()->row_array();
			return $result['location_name'];
		}		

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}		

		public function getDepartmentName($deparment_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.deparment_id', $deparment_id);
			$result = $this->db->get()->row_array();
			return $result['deparment_name'];
		}		

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}				

		public function getUnitName($unit_id){
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$result = $this->db->get()->row_array();
			return $result['unit_name'];
		}		

		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}		

		
	}
?>