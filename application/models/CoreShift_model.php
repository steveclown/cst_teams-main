<?php
	class CoreShift_model extends CI_Model {
		var $table = "core_shift";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getCoreShift()
		{
			//Build contents query
			$this->db->select('core_shift.shift_id, core_shift.shift_code, core_shift.shift_name, core_shift.start_working_hour, core_shift.end_working_hour, core_shift.start_rest_hour, core_shift.end_rest_hour, core_shift.due_time_late, core_shift.working_hours_start, core_shift.working_hours_end, core_shift.shift_next_day, core_shift.shift_remark');
			$this->db->from('core_shift');
			$this->db->where('core_shift.data_state', 0);
			return $this->db->get()->result_array();
			
		}
		
		public function insertCoreShift($data){
			return $this->db->insert('core_shift',$data);
		}
		
		public function getCoreShift_Detail($shift_id){
			$this->db->select('core_shift.shift_id, core_shift.shift_code, core_shift.shift_name, core_shift.start_working_hour, core_shift.end_working_hour, core_shift.working_hours_start, core_shift.working_hours_end, core_shift.due_time_late, core_shift.shift_next_day, core_shift.shift_remark, core_shift.data_state, core_shift.last_update');
			$this->db->from('core_shift');
			$this->db->where('core_shift.shift_id', $shift_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreShift($data){
			$this->db->where('core_shift.shift_id', $data['shift_id']);
			$query = $this->db->update('core_shift', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreShift($shift_id){
			$this->db->where("core_shift.shift_id", $shift_id);
			$query = $this->db->update('core_shift', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>