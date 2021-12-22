<?php
	class CoreAllowance_model extends CI_Model {
		var $table = "core_allowance";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreAllowance()
		{
			$this->db->select('core_allowance.allowance_id, core_allowance.allowance_code, core_allowance.allowance_name,  core_allowance.allowance_type, core_allowance.allowance_group');
			$this->db->from('core_allowance');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function insertCoreAllowance($data){
			return $this->db->insert('core_allowance',$data);
		}

		public function insertCoreAllowanceAmount($data){
			return $this->db->insert('core_allowance_amount',$data);
		}
		
		public function getCoreAllowance_Detail($allowance_id){
			$this->db->select('core_allowance.allowance_id, core_allowance.allowance_code, core_allowance.allowance_name, core_allowance.allowance_type, core_allowance.allowance_group');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.allowance_id',$allowance_id);
			return $this->db->get()->row_array();
		}
		
		public function getCondition($id){
			$this->db->select('allowance_condition')->from($this->table);
			$this->db->where('allowance_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function getAllowanceType($allowance_id){
			$this->db->select('core_allowance.allowance_type');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.allowance_id',$allowance_id);
			if($query['allowance_type']=0){
				return true;
			}else if ($query['allowance_type']=1) {
				return false;
			}
		}
		public function updateCoreAllowance($data){
			$this->db->where('allowance_id', $data['allowance_id']);
			$query = $this->db->update('core_allowance', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAllowance($allowance_id){
			$this->db->where("core_allowance.allowance_id",$allowance_id);
			$query = $this->db->update('core_allowance', array("data_state" => 1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreAllowanceAmount($allowance_amount_id){
			$this->db->where("core_allowance_amount.allowance_amount_id",$allowance_amount_id);
			$query = $this->db->update('core_allowance_amount', array("data_state" => 1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>