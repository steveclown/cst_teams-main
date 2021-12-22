<?php
	class ScheduleDayOff_model extends CI_Model {
		var $table = "schedule_day_off";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getScheduleDayOff()
		{
			$this->db->select('schedule_day_off.day_off_id, schedule_day_off.day_off_name, schedule_day_off.day_off_start_date, schedule_day_off.day_off_end_date');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function insertScheduleDayoff($data){
			return $this->db->insert('schedule_day_off',$data);
		}

		public function getDayOffID($created_id)
		{
			$this->db->select('schedule_day_off.day_off_id');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.created_id', $created_id);
			$this->db->order_by('schedule_day_off.day_off_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['day_off_id'];
		}

		public function insertScheduleDayoffItem($data){
			return $this->db->insert('schedule_day_off_item',$data);
		}
		
		public function getScheduleDayOff_Detail($day_off_id){
			$this->db->select('schedule_day_off.day_off_id, schedule_day_off.day_off_name, schedule_day_off.day_off_start_date, schedule_day_off.day_off_end_date, schedule_day_off.day_off_remark');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.day_off_id',$day_off_id);
			$result = $this->db->get();
			return $result->row_array();
		}
		
		public function updateScheduleDayOff($data){
			$this->db->where('schedule_day_off.day_off_id', $data['day_off_id']);
			$query = $this->db->update('schedule_day_off', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteScheduleDayOffItem($day_off_id){
			$this->db->where('day_off_id', $day_off_id);
			if($this->db->delete('schedule_day_off_item')){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteScheduleDayOff($day_off_id){
			$this->db->where("schedule_day_off.day_off_id",$day_off_id);
			$query = $this->db->update('schedule_day_off', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>