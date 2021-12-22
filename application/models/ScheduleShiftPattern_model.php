<?php
	class ScheduleShiftPattern_model extends CI_Model {
		var $table = "schedule_shift_pattern";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getScheduleShiftPattern()
		{
			$this->db->select('schedule_shift_pattern.shift_pattern_id, schedule_shift_pattern.shift_pattern_code, schedule_shift_pattern.shift_pattern_name, schedule_shift_pattern.shift_pattern_cycle, schedule_shift_pattern.shift_pattern_weekly, schedule_shift_pattern.shift_pattern_day');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getScheduleEmployeeShift(){
			$this->db->select('employee_shift_id, employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('data_state',0);
			return $this->db->get()->result_array();
		}

		public function getEmployeeShiftCode($employee_shift_id){
			$this->db->select('employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('employee_shift_id',$employee_shift_id);
			$this->db->where('data_state',0);
			$result = $this->db->get()->row_array();
			return $result['employee_shift_code'];
		}

		public function getCoreShift(){
			$this->db->select('shift_id, shift_name');
			$this->db->from('core_shift');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreShiftName($shift_id){
			$this->db->select('shift_name');
			$this->db->from('core_shift');
			$this->db->where('shift_id', $shift_id);
			$this->db->where('data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['shift_name'];
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

		public function insertScheduleShiftPattern($data_scheduleshiftpattern){
			return $this->db->insert('schedule_shift_pattern',$data_scheduleshiftpattern);
		}

		public function getShiftPatternID($created_id)
		{
			$this->db->select('schedule_shift_pattern.shift_pattern_id');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.created_id', $created_id);
			$this->db->order_by('schedule_shift_pattern.shift_pattern_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['shift_pattern_id'];
		}

		public function getShiftNextDay($shift_id){
			$this->db->select('core_shift.shift_next_day');
			$this->db->from('core_shift');
			$this->db->where('core_shift.shift_id', $shift_id);
			$this->db->where('core_shift.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['shift_next_day'];
		}

		public function insertScheduleShiftPatternItem($data_scheduleshiftpatternitem){
			return $this->db->insert('schedule_shift_pattern_item',$data_scheduleshiftpatternitem);
		}

		public function getScheduleShiftPattern_Detail($shift_pattern_id){
			$this->db->select('schedule_shift_pattern.shift_pattern_id, schedule_shift_pattern.shift_pattern_code, schedule_shift_pattern.shift_pattern_name, schedule_shift_pattern.shift_pattern_day,schedule_shift_pattern.shift_pattern_weekly, schedule_shift_pattern.shift_pattern_cycle');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.shift_pattern_id', $shift_pattern_id);
			return $this->db->get()->row_array();
		}
		
		public function getScheduleShiftPatternItem_Detail($shift_pattern_id){
			$this->db->select('schedule_shift_pattern_item.shift_pattern_item_id, schedule_shift_pattern_item.shift_pattern_id, schedule_shift_pattern_item.shift_id, core_shift.shift_name, schedule_shift_pattern_item.employee_shift_id, schedule_employee_shift.employee_shift_code, schedule_shift_pattern_item.shift_next_day');
			$this->db->from('schedule_shift_pattern_item');
			$this->db->join('schedule_shift_pattern','schedule_shift_pattern_item.shift_pattern_id=schedule_shift_pattern.shift_pattern_id');
			$this->db->join('schedule_employee_shift','schedule_shift_pattern_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_shift','schedule_shift_pattern_item.shift_id=core_shift.shift_id');
			$this->db->where('schedule_shift_pattern_item.shift_pattern_id',$shift_pattern_id);
			$this->db->order_by('schedule_shift_pattern_item.shift_pattern_item_id','ASC');
			return $this->db->get()->result_array();
		}

		public function deleteScheduleShiftPatternItem($shift_pattern_id){
			$this->db->where("schedule_shift_pattern_item.shift_pattern_id", $shift_pattern_id);
			$query = $this->db->delete('schedule_shift_pattern_item');
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteScheduleShiftPattern($shift_pattern_id){
			$this->db->where("schedule_shift_pattern.shift_pattern_id", $shift_pattern_id);
			$query = $this->db->update('schedule_shift_pattern', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>