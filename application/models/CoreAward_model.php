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
		
		public function getAwardToken($award_token)
		{	
			$this->db->select('core_award.award_token');
			$this->db->from('core_award');
			$this->db->where('core_award.award_token', $award_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getAwardID($created_id){
			$this->db->select('core_award.award_id');
			$this->db->from('core_award');
			$this->db->where('core_award.created_id', $created_id);
			$this->db->order_by('core_award.award_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['award_id'];
		}

		public function insertCoreAward($data){
			return $this->db->insert('core_award',$data);
		}
		
		public function getCoreAward_Detail($AwardID){
			$this->db->select('core_award.award_id, core_award.award_code, core_award.award_name ,core_award.award_remark, core_award.data_state, core_award.last_update');
			$this->db->from('core_award');
			$this->db->where('core_award.award_id',$AwardID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreAward($data){
			$this->db->where('award_id',$data['award_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAward($data){
			$this->db->where("core_award.award_id", $data['award_id']);
			$query = $this->db->update('core_award', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>