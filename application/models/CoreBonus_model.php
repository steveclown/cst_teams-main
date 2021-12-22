<?php
	class CoreBonus_model extends CI_Model {
		var $table = "core_bonus";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreBonus(){
			$this->db->select('core_bonus.bonus_id, core_bonus.bonus_code, core_bonus.bonus_name');
			$this->db->from('core_bonus');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function insertCoreBonus($data){
			return $this->db->insert('core_bonus',$data);
		}
		
		public function getCoreBonus_Detail($bonus_id){
			$this->db->select('core_bonus.bonus_id, core_bonus.bonus_code, core_bonus.bonus_name');
			$this->db->from('core_bonus');
			$this->db->where('core_bonus.bonus_id',$bonus_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreBonus($data){
			$this->db->where('bonus_id', $data['bonus_id']);
			$query = $this->db->update('core_bonus', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreBonus($bonus_id){
			$this->db->where("bonus_id",$bonus_id);
			$query = $this->db->update('core_bonus', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>