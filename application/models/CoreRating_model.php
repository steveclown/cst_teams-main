<?php
	class CoreRating_model extends CI_Model {
		var $table = "core_rating";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
				
		public function getCoreRating(){
			$this->db->select('core_rating.rating_id, core_rating.rating_code, core_rating.rating_name, core_rating.rating_range1, core_rating.rating_range2, core_rating.rating_value, core_rating.rating_remark');
			$this->db->from('core_rating');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreRating($data){
			return $this->db->insert('core_rating',$data);
		}
		
		public function getCoreRating_Detail($RatingID){
			$this->db->select('core_rating.rating_id, core_rating.rating_code, core_rating.rating_name, core_rating.rating_range1, core_rating.rating_range2, core_rating.rating_value, core_rating.rating_remark, core_rating.data_state, core_rating.last_update');
			$this->db->from('core_rating');
			$this->db->where('core_rating.rating_id',$RatingID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreRating($data){
			$this->db->where('core_rating.rating_id',$data['rating_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreRating($RatingID){
			$this->db->where("rating_id",$RatingID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>