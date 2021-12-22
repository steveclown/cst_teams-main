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
		
		public function saveNewCorePermit($data){
			return $this->db->insert('core_permit',$data);
		}
		
		public function getCorePermit_Detail($permit_id){
			$this->db->select('core_permit.permit_id, core_permit.permit_code, core_permit.permit_name, core_permit.deduction_id');
			$this->db->from('core_permit');
			$this->db->where('core_permit.permit_id',$permit_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCorePermit($data){
			$this->db->where('permit_id',$data['permit_id']);
			$query = $this->db->update('core_permit', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCorePermit($permit_id){
			$this->db->where("permit_id",$permit_id);
			$query = $this->db->update('core_permit', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>