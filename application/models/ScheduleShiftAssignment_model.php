<?php
	class ScheduleShiftAssignment_model extends CI_Model {
		var $table = "schedule_shift_pattern";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	 
		public function getScheduleShiftAssignment($region_id, $branch_id, $location_id){
			$this->db->select('schedule_shift_assignment.shift_assignment_id, schedule_shift_assignment.division_id, core_division.division_name, schedule_shift_assignment_item.shift_assignment_item_id, schedule_shift_assignment_item.shift_pattern_id, schedule_shift_pattern.shift_pattern_code, schedule_shift_assignment_item.shift_assignment_start_date, schedule_shift_assignment_item.shift_assignment_cycle');
			$this->db->from('schedule_shift_assignment');

			$this->db->join('schedule_shift_assignment_item', 'schedule_shift_assignment.shift_assignment_id = schedule_shift_assignment_item.shift_assignment_id');
			
			$this->db->join('core_division', 'schedule_shift_assignment.division_id = core_division.division_id');
			
			$this->db->join('schedule_shift_pattern', 'schedule_shift_assignment_item.shift_pattern_id = schedule_shift_pattern.shift_pattern_id');
			
			$this->db->where('schedule_shift_assignment.region_id', $region_id);
			$this->db->where('schedule_shift_assignment.branch_id', $branch_id);
			$this->db->where('schedule_shift_assignment.location_id', $location_id);
			$this->db->order_by('schedule_shift_assignment.shift_assignment_id', 'DESC');
			$this->db->order_by('schedule_shift_assignment_item.shift_assignment_item_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDivision(){
			$this->db->select('division_id, division_name');
			$this->db->from('core_division');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDivisionName($division_id){
			$this->db->select('division_name');
			$this->db->from('core_division');
			$this->db->where('division_id', $division_id);
			$this->db->where('data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getScheduleShiftPattern(){
			$this->db->select('shift_pattern_id, shift_pattern_name');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

		public function getShiftPatternCode($shift_pattern_id){
			$this->db->select('schedule_shift_pattern.shift_pattern_code');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.shift_pattern_id', $shift_pattern_id);
			$this->db->where('data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['shift_pattern_code'];
		}

		public function getShiftPatternName($shift_pattern_id){
			$this->db->select('schedule_shift_pattern.shift_pattern_name');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.shift_pattern_id', $shift_pattern_id);
			$this->db->where('data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['shift_pattern_name'];
		}

		public function getEmployeeWorkingMinute(){
			$this->db->select('preference_company.employee_working_in_start_minute, preference_company.employee_working_in_start_minute, preference_company.employee_working_out_start_minute, preference_company.employee_working_out_end_minute, preference_company.employee_working_in_end_minute');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertScheduleShiftAssignment($data){
			return $this->db->insert('schedule_shift_assignment',$data);
		}

		public function getShiftAssignmentID($created_id)
		{
			$this->db->select('schedule_shift_assignment.shift_assignment_id');
			$this->db->from('schedule_shift_assignment');
			$this->db->where('schedule_shift_assignment.created_id', $created_id);
			$this->db->order_by('schedule_shift_assignment.shift_assignment_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['shift_assignment_id'];
		}

		public function insertScheduleShiftAssignmentItem($data){
			return $this->db->insert('schedule_shift_assignment_item',$data);
		}

		public function insertScheduleEmployeeSchedule($data){
			return $this->db->insert('schedule_employee_schedule',$data);
		}

		public function getEmployeeScheduleID($created_id)
		{
			$this->db->select('schedule_employee_schedule.employee_schedule_id');
			$this->db->from('schedule_employee_schedule');
			$this->db->where('schedule_employee_schedule.created_id', $created_id);
			$this->db->order_by('schedule_employee_schedule.employee_schedule_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_id'];
		}

		public function getScheduleEmployeeShiftItem_Detail($employee_shift_id){
			$this->db->select('schedule_employee_shift_item.employee_shift_id, schedule_employee_shift_item.employee_id, schedule_employee_shift_item.region_id, schedule_employee_shift_item.branch_id, schedule_employee_shift_item.location_id, schedule_employee_shift_item.division_id, schedule_employee_shift_item.department_id, schedule_employee_shift_item.section_id, schedule_employee_shift_item.unit_id, schedule_employee_shift_item.employee_rfid_code,schedule_employee_shift_item.last_update');
			$this->db->from('schedule_employee_shift_item');
			$this->db->where('schedule_employee_shift_item.employee_shift_id', $employee_shift_id);
			return $this->db->get()->result_array();

		}

		public function insertScheduleEmployeeScheduleItem($data){
			return $this->db->insert('schedule_employee_schedule_item', $data);
		}

		public function insertScheduleEmployeeScheduleShift($data){
			return $this->db->insert('schedule_employee_schedule_shift', $data);
		}

		public function getScheduleShiftAssignment_Detail($shift_assignment_id){
			$this->db->select('schedule_shift_assignment.shift_assignment_id, schedule_shift_assignment.division_id, core_division.division_name');
			$this->db->from('schedule_shift_assignment');
			$this->db->join('core_division','schedule_shift_assignment.division_id = core_division.division_id');
			$this->db->where('schedule_shift_assignment.shift_assignment_id',$shift_assignment_id);
			return $this->db->get()->row_array();
		}

		public function getScheduleShiftAssignmentData_Detail($shift_assignment_id){
			$this->db->select('schedule_shift_assignment_item.shift_assignment_id, schedule_shift_assignment_item.shift_assignment_start_date, schedule_shift_assignment_item.shift_assignment_cycle, schedule_shift_assignment_item.shift_pattern_id, schedule_shift_pattern.shift_pattern_code, schedule_shift_pattern.shift_pattern_name ');
			$this->db->from('schedule_shift_assignment_item');
			$this->db->join('schedule_shift_pattern','schedule_shift_assignment_item.shift_pattern_id = schedule_shift_pattern.shift_pattern_id');
			$this->db->where('schedule_shift_assignment_item.shift_assignment_id', $shift_assignment_id);
			return $this->db->get()->result_array();
		}

		public function getScheduleShiftPattern_Detail($shift_pattern_id){
			$this->db->select('schedule_shift_pattern.shift_pattern_id, schedule_shift_pattern.shift_pattern_code, schedule_shift_pattern.shift_pattern_name, schedule_shift_pattern.shift_pattern_weekly, schedule_shift_pattern.shift_pattern_cycle,schedule_shift_pattern.shift_pattern_day');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.shift_pattern_id',$shift_pattern_id);
			return $this->db->get()->row_array();
		}
		
		public function getScheduleShiftPatternItem_Detail($shift_pattern_id){
			$this->db->select('schedule_shift_pattern_item.shift_pattern_item_id, schedule_shift_pattern_item.shift_pattern_id, schedule_shift_pattern_item.shift_id, core_shift.shift_name, core_shift.start_working_hour, core_shift.end_working_hour, schedule_shift_pattern_item.shift_next_day, schedule_shift_pattern_item.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_shift_pattern_item');
			$this->db->join('schedule_shift_pattern','schedule_shift_pattern_item.shift_pattern_id = schedule_shift_pattern.shift_pattern_id');
			$this->db->join('schedule_employee_shift','schedule_shift_pattern_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_shift','schedule_shift_pattern_item.shift_id = core_shift.shift_id');
			$this->db->where('schedule_shift_pattern_item.shift_pattern_id', $shift_pattern_id);
			$this->db->order_by('schedule_shift_pattern_item.shift_pattern_item_id','ASC');
			return $this->db->get()->result_array();
		}

		public function getScheduleShiftPatternItem($shift_pattern_id){
			$this->db->select('*');
			$this->db->from('schedule_shift_pattern_item');
			$this->db->where('schedule_shift_pattern_item.shift_pattern_id',$shift_pattern_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getShiftID($shift_pattern_id){
			$this->db->select('schedule_shift_pattern_item.shift_id');
			$this->db->from('schedule_shift_pattern_item');
			$this->db->where('schedule_shift_pattern_item.shift_pattern_id', $shift_pattern_id);
			$result = $this->db->get()->row_array();
			return $result['shift_id'];
		}

		public function getEmployeeID_Schedule($shift_assignment_id){
			$this->db->select('DISTINCT(schedule_employee_schedule_item.employee_id)');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.shift_assignment_id', $shift_assignment_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getHROEmployeeData_DayOff($employee_id){
			$this->db->select('hro_employee_data.employee_last_day_off, hro_employee_data.employee_day_off_cycle');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getLastEmployeeScheduleItemDate($shift_assignment_id){
			$this->db->select_max('schedule_employee_schedule_item.employee_schedule_item_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.shift_assignment_id', $shift_assignment_id);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_item_date'];
		}

		public function getScheduleEmployeeItemDate($shift_assignment_id, $employee_id, $employee_schedule_item_date, $last_employee_schedule_item_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.shift_assignment_id', $shift_assignment_id);
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_schedule_item_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date <= ', $last_employee_schedule_item_date);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_item_id'];
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

		public function updateHROEmployeeData_DayOff($data){
			$this->db->where('hro_employee_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeData_DayOffStatus(){
			$this->db->select('hro_employee_data.employee_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_day_off_status', 1);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getScheduleDayOffItem(){
			$this->db->select('schedule_day_off_item.day_off_item_date');
			$this->db->from('schedule_day_off_item');
			$this->db->join('schedule_day_off', 'schedule_day_off_item.day_off_id = schedule_day_off.day_off_id');
			$this->db->where('schedule_day_off.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateScheduleEmployeeScheduleItem_DayOff($data){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $data['employee_schedule_item_date']);
			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getEmployeeScheduleItemDate($employee_shift_id){
			$this->db->select_max('schedule_employee_schedule_item.employee_schedule_item_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_shift_id', $employee_shift_id);
			$result = $this->db->get()->row_array();			
			return $result['employee_schedule_item_date'];
		}

		public function updateScheduleEmployeeShift($data){
			$this->db->where('schedule_employee_shift.employee_shift_id', $data['employee_shift_id']);
			$query = $this->db->update('schedule_employee_shift', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getMinID($shift_assignment_id){
			$this->db->select_min('schedule_shift_assignment_item.shift_assignment_item_id');
			$this->db->from('schedule_shift_assignment_item');
			$this->db->where('schedule_shift_assignment_item.shift_assignment_id', $shift_assignment_id);
			$result=$this->db->get()->row_array();
			return $result['shift_assignment_item_id'];
		}
	}
?>