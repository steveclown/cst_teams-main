<?php
	class CoreExpertise_model extends CI_Model {
		var $table = "core_expertise";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreExpertise()
		{
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_code, core_expertise.expertise_name, core_expertise.expertise_remark');
			$this->db->from('core_expertise');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();			
		}
		
		public function saveNewCoreExpertise($data){
			return $this->db->insert('core_expertise',$data);
		}
		
		public function getCoreExpertise_Detail($ExpertiseID){
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_code, core_expertise.expertise_name, core_expertise.expertise_remark');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_id',$ExpertiseID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreExpertise($data){
			$this->db->where('core_expertise.expertise_id',$data['expertise_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreExpertise($ExpertiseID){
			$this->db->where("expertise_id",$ExpertiseID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>