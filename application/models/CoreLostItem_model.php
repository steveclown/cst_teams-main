<?php
	class CoreLostItem_model extends CI_Model {
		var $table = "core_bonus";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreLostItem()
		{
			$this->db->select('core_lost_item.lost_item_id, core_lost_item.lost_item_code, core_lost_item.lost_item_name');
			$this->db->from('core_lost_item');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function insertCoreLostItem($data){
			return $this->db->insert('core_lost_item',$data);
		}
		
		public function getCoreLostItem_Detail($lost_item_id){
			$this->db->select('core_lost_item.lost_item_id, core_lost_item.lost_item_code, core_lost_item.lost_item_name');
			$this->db->from('core_lost_item');
			$this->db->where('core_lost_item.lost_item_id',$lost_item_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreLostItem($data){
			$this->db->where('lost_item_id', $data['lost_item_id']);
			$query = $this->db->update('core_lost_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLostItem($lost_item_id){
			$this->db->where("lost_item_id",$lost_item_id);
			$query = $this->db->update('core_lost_item', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>