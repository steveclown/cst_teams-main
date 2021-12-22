<?php
	class hroemployeeattendancedatadownload_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeattendancedatadownload_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getScheduleEmployeeScheduleItem($start_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_schedule_id, schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.employee_schedule_item_status, schedule_employee_schedule_item.employee_schedule_item_status_default');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $start_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeOvertimeMinimumMinutes(){
			$this->db->select('preference_company.employee_overtime_minimum_minutes');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result['employee_overtime_minimum_minutes'];
		}

		public function getHROEmployeeAttendance($start_date, $employee_id){
			$this->db->select('hro_employee_attendance_data.employee_attendance_data_id, hro_employee_attendance_data.employee_attendance_in_date, hro_employee_attendance_data.employee_attendance_out_date, hro_employee_attendance_data.employee_attendance_date, hro_employee_attendance_data.shift_id, hro_employee_attendance_data.region_id, hro_employee_attendance_data.branch_id, hro_employee_attendance_data.location_id, hro_employee_attendance_data.division_id, hro_employee_attendance_data.department_id, hro_employee_attendance_data.section_id, hro_employee_attendance_data.employee_id, hro_employee_attendance_data.employee_shift_id, hro_employee_attendance_data.employee_rfid_code');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_attendance_date', $start_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreShift_Detail($shift_id){
			$this->db->select('core_shift.shift_id, core_shift.start_working_hour, core_shift.end_working_hour, core_shift.total_working_hour, core_shift.working_hours_start, core_shift.working_hours_end');
			$this->db->from('core_shift');
			$this->db->where('core_shift.shift_id', $shift_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertHROEmployeeAttendanceData($data){
			return $this->db->insert('hro_employee_attendance_data',$data);
		}
	}
?>