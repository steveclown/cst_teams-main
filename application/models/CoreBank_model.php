<?php
	class CoreBank_model extends CI_Model {
		var $table = "core_bank";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
			
		public function getCoreBank()
		{
			$this->db->select('core_bank.bank_id, core_bank.bank_code, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		
		public function saveNewCoreBank($data){
			return $this->db->insert('core_bank',$data);
		}
		
		public function getCoreBank_Detail($bank_id){
			$this->db->select('core_bank.bank_id, core_bank.bank_code, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.bank_id',$bank_id);
			$result = $this->db->get();
			return $result->row_array();
		}
		
		public function saveEditCoreBank($data){
			$this->db->where('core_bank.bank_id',$data['bank_id']);
			$query = $this->db->update('core_bank', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreBank($bank_id){
			if($this->db->delete('core_bank',array('bank_id'=>$bank_id))){
				return true;
			}else{
				return false;
			}
		}
	}
?>