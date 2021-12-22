<?php
	class incentiverealizationpercentage_model extends CI_Model {
		var $table = "core_asset";
		
		public function incentiverealizationpercentage_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getIncentiveRealizationPercentage()
		{
			$this->db->select('incentive_realization_percentage.realization_percentage_id, incentive_realization_percentage.realization_percentage_min, incentive_realization_percentage.realization_percentage_max, incentive_realization_percentage.realization_percentage_omzet, incentive_realization_percentage.realization_percentage_share');
			$this->db->from('incentive_realization_percentage');
			$this->db->where('incentive_realization_percentage.data_state', 0);
			return $this->db->get()->result_array();
		}
			
		public function insertIncentiveRealizationPercentage($data){
			return $this->db->insert('incentive_realization_percentage',$data);
		}
		
		public function getIncentiveRealizationPercentage_Detail($realization_percentage_id){
			$this->db->select('incentive_realization_percentage.realization_percentage_id, incentive_realization_percentage.realization_percentage_min, incentive_realization_percentage.realization_percentage_max, incentive_realization_percentage.realization_percentage_omzet, incentive_realization_percentage.realization_percentage_share');
			$this->db->from('incentive_realization_percentage');
			$this->db->where('incentive_realization_percentage.realization_percentage_id',$realization_percentage_id);
			return $this->db->get()->row_array();
		}
		
		public function updateIncentiveRealizationPercentage($data){
			$this->db->where('realization_percentage_id', $data['realization_percentage_id']);
			$query = $this->db->update('incentive_realization_percentage', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteIncentiveRealizationPercentage($realization_percentage_id){
			$this->db->where("realization_percentage_id",$realization_percentage_id);
			$query = $this->db->update('incentive_realization_percentage', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>