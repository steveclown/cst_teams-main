<?php
	class CorePermit_model extends CI_Model {
		var $table = "core_permit";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getCoreDeduction()
		{
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getCorePermit()
		{
			$this->db->select('core_permit.permit_id, core_permit.permit_code, core_permit.permit_name, core_permit.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_permit');
			$this->db->join('core_deduction', 'core_permit.deduction_id = core_deduction.deduction_id');
			$this->db->where('core_permit.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function getPermitToken($permit_token)
		{	
			$this->db->select('core_permit.permit_token');
			$this->db->from('core_permit');
			$this->db->where('core_permit.permit_token', $permit_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getPermitID($created_id){
			$this->db->select('core_permit.permit_id');
			$this->db->from('core_permit');
			$this->db->where('core_permit.created_id', $created_id);
			$this->db->order_by('core_permit.permit_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['permit_id'];
		}

		public function insertCorePermit($data){
			return $this->db->insert('core_permit',$data);
		}
		
		public function getCorePermit_Detail($permit_id){
			$this->db->select('core_permit.permit_id, core_permit.permit_code, core_permit.permit_name, core_permit.deduction_id');
			$this->db->from('core_permit');
			$this->db->where('core_permit.permit_id',$permit_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCorePermit($data){
			$this->db->where('permit_id',$data['permit_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCorePermit($data){
			$this->db->where("core_permit.permit_id", $data['permit_id']);
			$query = $this->db->update('core_permit', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>