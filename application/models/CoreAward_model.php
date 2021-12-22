<?php
	class CoreAward_model extends CI_Model {
		var $table = "core_award";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreAward()
		{
			$this->db->select('core_award.award_id, core_award.award_code, core_award.award_name, core_award.award_remark');
			$this->db->from('core_award');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function saveNewCoreAward($data){
			return $this->db->insert('core_award',$data);
		}
		
		public function getCoreAward_Detail($AwardID){
			$this->db->select('core_award.award_id, core_award.award_code, core_award.award_name ,core_award.award_remark, core_award.data_state, core_award.last_update');
			$this->db->from('core_award');
			$this->db->where('core_award.award_id',$AwardID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreAward($data){
			$this->db->where('award_id',$data['award_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAward($AwardID){
			$this->db->where("award_id",$AwardID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>