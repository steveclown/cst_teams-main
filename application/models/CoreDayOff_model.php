<?php
	class CoreDayOff_model extends CI_Model {
		var $table = "core_dayoff";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDayOff()
		{
			$this->db->select('core_dayoff.dayoff_id, core_dayoff.dayoff_code, core_dayoff.dayoff_name');
			$this->db->from('core_dayoff');
			$this->db->where('core_dayoff.data_state', 0);
			return $this->db->get()->result_array();
			
		}
		
		public function saveNewCoreDayOff($data){
			return $this->db->insert('core_dayoff',$data);
		}
		
		public function getCoreDayOff_Detail($DayOffID){
			$this->db->select('core_dayoff.dayoff_id, core_dayoff.dayoff_code, core_dayoff.dayoff_name');
			$this->db->from('core_dayoff');
			$this->db->where('core_dayoff.dayoff_id',$DayOffID);
			return $this->db->get()->row_array();
		}
	
		public function getDayOffName($dayoff_id){
			$this->db->select('core_dayoff.daypff_name');
			$this->db->from('core_dayoff');
			$result = $this->db->get()->row_array();
			if(!isset($result['dayoff_name'])){
				return '-';
			}else{
				return $result['dayoff_name'];
			}
		}
		
		public function saveEditCoreDayOff($data){
			$this->db->where('dayoff_id',$data['dayoff_id']);
			$query = $this->db->update('core_dayoff', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreDayOff($DayOffID){
			$this->db->where("dayoff_id",$DayOffID);
			$query = $this->db->update('core_dayoff', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>