<?php
	class HroEmployeeAttendance_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
 
		public function getHROEmployeeData_Detail($employee_rfid_code){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.region_id, hro_employee_data.branch_id, hro_employee_data.location_id, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name, hro_employee_data.job_title_id, core_job_title.job_title_name, hro_employee_data.employee_shift_id');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_rfid_code', $employee_rfid_code);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getEmployeeWorkingMinute(){
			$this->db->select('preference_company.employee_working_in_start_minute, preference_company.employee_working_in_end_minute, preference_company.employee_working_out_start_minute, preference_company.employee_working_out_end_minute');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_working_minute'])){
				return '-';
			}else{
				return $result['employee_working_minute'];
			}
		}

		public function getScheduleEmployeeScheduleShift($employee_rfid_code, $location_id, $employee_schedule_shift_date){
			$this->db->select('schedule_employee_schedule_shift.employee_schedule_shift_id, schedule_employee_schedule_shift.employee_id, schedule_employee_schedule_shift.employee_schedule_shift_status, schedule_employee_schedule_shift.region_id, schedule_employee_schedule_shift.branch_id, schedule_employee_schedule_shift.location_id, schedule_employee_schedule_shift.division_id, schedule_employee_schedule_shift.department_id, schedule_employee_schedule_shift.section_id, schedule_employee_schedule_shift.unit_id, schedule_employee_schedule_shift.employee_shift_id,  schedule_employee_schedule_shift.employee_rfid_code, schedule_employee_schedule_shift.employee_schedule_shift_date');
			$this->db->from('schedule_employee_schedule_shift');
			$this->db->where('schedule_employee_schedule_shift.employee_rfid_code', $employee_rfid_code);
			$this->db->where('schedule_employee_schedule_shift.location_id', $location_id);
			$this->db->where('schedule_employee_schedule_shift.employee_schedule_shift_date', $employee_schedule_shift_date);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleEmployeeScheduleItem($employee_rfid_code, $location_id, $employee_attendance_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.employee_schedule_item_log_status, schedule_employee_schedule_item.employee_schedule_item_in_start_date, schedule_employee_schedule_item.employee_schedule_item_in_end_date, schedule_employee_schedule_item.employee_schedule_item_out_start_date, schedule_employee_schedule_item.employee_schedule_item_out_end_date, schedule_employee_schedule_item.region_id, schedule_employee_schedule_item.branch_id, schedule_employee_schedule_item.location_id, schedule_employee_schedule_item.division_id, schedule_employee_schedule_item.department_id, schedule_employee_schedule_item.section_id, schedule_employee_schedule_item.unit_id, schedule_employee_schedule_item.shift_id, schedule_employee_schedule_item.employee_shift_id, schedule_employee_schedule_item.employee_schedule_item_date_status, schedule_employee_schedule_item.employee_rfid_code');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_rfid_code', $employee_rfid_code);
			$this->db->where('schedule_employee_schedule_item.location_id', $location_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_attendance_date);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleEmployeeScheduleItem_Shift($employee_id, $employee_attendance_date, $shift_next_day){
			$this->db->select('schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_schedule_item_log_status, schedule_employee_schedule_item.shift_id, core_shift.shift_next_day');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->join('core_shift', 'schedule_employee_schedule_item.shift_id = core_shift.shift_id');
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_attendance_date);
			$this->db->where('core_shift.shift_next_day', $shift_next_day);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function updateScheduleEmployeeScheduleItem($data){
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_id', $data['employee_schedule_item_id']);
			$query = $this->db->update('schedule_employee_schedule_item', $data);			
			if($query){
				return true;
			}else{
				return false;
			}
		}
		public function updateAva($data){
			$this->db->where('system_user.user_id', $data['user_id']);
			$query = $this->db->update('system_user', $data);			
			if($query){
				return true;
			}else{
				return false;
			}
		}
		public function updateScheduleEmployeeScheduleShift($data){
			$this->db->where('schedule_employee_schedule_shift.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_shift.employee_schedule_shift_date', $data['employee_schedule_shift_date']);
			$query = $this->db->update('schedule_employee_schedule_shift', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateHroEmployeeAttendanceLog($data){
			$this->db->where('hro_employee_attendance_log.employee_attendance_log_period', $data['employee_attendance_log_period']);
			$this->db->where('hro_employee_attendance_log.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_attendance_log', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeAttendance($data){
			return $this->db->insert('hro_employee_attendance', $data);
		}

		public function insertHroEmployeeAttendanceLog($data){
			
			return $this->db->insert('hro_employee_attendance_log', $data);
		}

		public function getHroEmployeeAttendanceData($emplyoee_attendance_date){
			$this->db->select('employee_attendance_id, region_id, branch_id, division_id, department_id,
			section_id, unit_id, location_id, shift_id, employee_shift_id, employee_id, employee_rfid_code,
			employee_attendance_status,employee_attendance_date, employee_attendance_date_status, 
			employee_attendance_log_date,employee_attendance_downloaded, machine_ip_address,employee_attendance_out_status,
			employee_attendance_in_status');
			$this->db->from('hro_employee_attendance');
			$this->db->where('employee_attendance_date', $emplyoee_attendance_date);			
			$result = $this->db->get()->result_array();
			return $result;
		}


		public function getEmployeeName($employee_id){
			$this->db->select('employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('employee_id', $employee_id);			
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getHroEmployeeAttendanceLog($employee_id, $employee_attendance_log_period){
			$this->db->select('hro_employee_attendance_log.employee_id');
			$this->db->from('hro_employee_attendance_log');
			$this->db->where('hro_employee_attendance_log.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_log.employee_attendance_log_period', $employee_attendance_log_period);	
			$result = $this->db->get()->row_array();
			if(empty($result)){
				return true;
			}else{
				return false;
			}
		}

		public function getEmployeeRfidCode($employee_id){
			$this->db->select('hro_employee_data.employee_rfid_code');
			$this->db->from("hro_employee_data");
			$this->db->where("hro_employee_data.employee_id", $employee_id);
			$result = $this->db->get()->row_array();		
			return $result;
		}
		public function getEmployeeLocationID($employee_id){
			$this->db->select('hro_employee_data.location_id');
			$this->db->from("hro_employee_data");
			$this->db->where("hro_employee_data.employee_id", $employee_id);
			$result = $this->db->get()->row_array();		
			return $result;
		}

	}
?>