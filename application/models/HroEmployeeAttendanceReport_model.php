<?php
	class HroEmployeeAttendanceReport_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getEmployeeAttendanceDate($start_date, $end_date, $employee_shift_id){
			$this->db->select('DISTINCT(hro_employee_attendance.employee_attendance_date)');
			$this->db->from('hro_employee_attendance');
			$this->db->where('hro_employee_attendance.employee_attendance_date >=', $start_date);
			$this->db->where('hro_employee_attendance.employee_attendance_date <=', $end_date);
			$this->db->where('hro_employee_attendance.employee_shift_id', $employee_shift_id);			
			$this->db->order_by('hro_employee_attendance.employee_attendance_date');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreLocation()
		{
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getScheduleEmployeeShift($location_id)
		{
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			return $this->db->get()->result_array();
		}

		public function getScheduleEmployeeShiftItem_Detail($employee_shift_id){
			$this->db->select('schedule_employee_shift_item.employee_id');
			$this->db->from('schedule_employee_shift_item');
			$this->db->where('schedule_employee_shift_item.employee_shift_id', $employee_shift_id);			
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAttendanceLog($query_count, $employee_shift_id){
			$query = $this->db->query("SELECT DISTINCT hro_employee_data.employee_name AS 'Employee Name', hro_employee_data.employee_code AS 'Employee Code', core_job_title.job_title_name AS 'Job Title', core_section.section_name AS 'Section Name', core_unit.unit_name AS 'Unit Name', schedule_employee_shift.employee_shift_code AS 'Employee Shift Code', ".$query_count." 
				FROM schedule_employee_shift_item, hro_employee_data, core_section, core_unit, schedule_employee_shift, core_job_title
			WHERE schedule_employee_shift.employee_shift_id = schedule_employee_shift_item.employee_shift_id
			AND schedule_employee_shift_item.employee_id = hro_employee_data.employee_id
			AND hro_employee_data.section_id = core_section.section_id
			AND hro_employee_data.unit_id = core_unit.unit_id
			AND hro_employee_data.job_title_id = core_job_title.job_title_id
			AND schedule_employee_shift.employee_shift_id = ".$employee_shift_id." ");
			
			$result = $query->result_array();

			if(!empty($result)){
				return $result;
			}else{
				return false;
			}
		}

		public function getScheduleEmployeeShift_Detail($employee_shift_id){
			$this->db->select('schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.employee_shift_id', $employee_shift_id);			
			$result = $this->db->get()->row_array();
			return $result['employee_shift_code'];
		}

		public function getHROEmployeeAttendanceLog_Print($query_count, $employee_shift_id){
			$query = $this->db->query("SELECT DISTINCT hro_employee_data.employee_name AS 'Employee Name', hro_employee_data.employee_code AS 'Employee Code', core_job_title.job_title_name AS 'Job Title', ".$query_count." 
				FROM schedule_employee_shift_item, hro_employee_data, schedule_employee_shift, core_job_title
			WHERE schedule_employee_shift.employee_shift_id = schedule_employee_shift_item.employee_shift_id
			AND schedule_employee_shift_item.employee_id = hro_employee_data.employee_id
			AND hro_employee_data.job_title_id = core_job_title.job_title_id
			AND schedule_employee_shift.employee_shift_id = ".$employee_shift_id." ");
			$result = $query->result_array();

			if(!empty($result)){
				return $result;
			}else{
				return false;
			}
		}
	}
?>