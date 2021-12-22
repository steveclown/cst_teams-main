<?php
	class CoreContract_model extends CI_Model {
		var $table = "core_contract";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreContract()
		{
			$this->db->select('core_contract.contract_id, core_contract.contract_code, core_contract.contract_name');
			$this->db->from('core_contract');
			$this->db->where('core_contract.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreContract($data){
			return $this->db->insert('core_contract',$data);
		}
		
		public function getCoreContract_Detail($ContractID){
			$this->db->select('core_contract.contract_id, core_contract.contract_code, core_contract.contract_name, core_contract.contract_remark');
			$this->db->from('core_contract');
			$this->db->where('core_contract.contract_id',$ContractID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreContract($data){
			$this->db->where('core_contract.contract_id',$data['contract_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreContract($ContractID){
			$this->db->where("core_contract.contract_id",$ContractID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>