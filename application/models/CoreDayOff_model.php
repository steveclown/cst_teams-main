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
		
		public function getDayOffToken($dayoff_token)
		{	
			$this->db->select('core_dayoff.dayoff_token');
			$this->db->from('core_dayoff');
			$this->db->where('core_dayoff.dayoff_token', $dayoff_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getDayOffID($created_id){
			$this->db->select('core_dayoff.dayoff_id');
			$this->db->from('core_dayoff');
			$this->db->where('core_dayoff.created_id', $created_id);
			$this->db->order_by('core_dayoff.dayoff_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['dayoff_id'];
		}

		public function insertCoreDayOff($data){
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
		
		public function updateCoreDayOff($data){
			$this->db->where('dayoff_id',$data['dayoff_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreDayOff($data){
			$this->db->where("core_dayoff.dayoff_id", $data['dayoff_id']);
			$query = $this->db->update('core_dayoff', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>