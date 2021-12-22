<?php
	class CoreIncentive_model extends CI_Model {
		var $table = "core_incentive";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreIncentive()
		{
			$this->db->select('core_incentive.incentive_id, core_incentive.incentive_code, core_incentive.incentive_name, core_incentive.incentive_amount, core_incentive.incentive_remark');
			$this->db->from('core_incentive');
			$this->db->where('core_incentive.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreIncentive($data){
			return $this->db->insert('core_incentive',$data);
		}
		
		public function getCoreIncentive_Detail($IncentiveID){
			$this->db->select('core_incentive.incentive_id, core_incentive.incentive_code, core_incentive.incentive_name, core_incentive.incentive_amount, core_incentive.incentive_remark');
			$this->db->from('core_incentive');
			$this->db->where('core_incentive.incentive_id',$IncentiveID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreIncentive($data){
			$this->db->where('core_incentive.incentive_id',$data['incentive_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreIncentive($IncentiveID){
			$this->db->where("core_incentive.incentive_id",$IncentiveID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>