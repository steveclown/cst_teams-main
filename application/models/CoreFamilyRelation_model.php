<?php
	class CoreFamilyRelation_model extends CI_Model {
		var $table = "core_family_relation";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreFamilyRelation()
		{
			$this->db->select('core_family_relation.family_relation_id, core_family_relation.family_relation_code, core_family_relation.family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreFamilyRelation($data){
			return $this->db->insert('core_family_relation',$data);
		}
		
		public function getCorefamilyRelation_Detail($family_relation_id){
			$this->db->select('core_family_relation.family_relation_id, core_family_relation.family_relation_code, core_family_relation.family_relation_name , core_family_relation.data_state, core_family_relation.last_update');
			$this->db->from('core_family_relation');
			$this->db->where('family_relation_id',$family_relation_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreFamilyRelation($data){
			$this->db->where('family_relation_id',$data['family_relation_id']);
			$query = $this->db->update('core_family_relation', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreFamilyRelation($family_relation_id){
			$this->db->where("family_relation_id",$family_relation_id);
			$query = $this->db->update('core_family_relation', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>