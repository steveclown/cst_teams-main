<?php
	class CoreSeparationReason_model extends CI_Model {
		var $table = "core_separation_reason";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreSeparationReason()
		{
			$this->db->select('core_separation_reason.separation_reason_id, core_separation_reason.separation_reason_name');
			$this->db->from('core_separation_reason');
			$this->db->where('core_separation_reason.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreSeparationReason($data){
			return $this->db->insert('core_separation_reason',$data);
		}
		
		public function getCoreSeparationReason_Detail($SeparationReasonID){
			$this->db->select('core_separation_reason.separation_reason_id, core_separation_reason.separation_reason_name');
			$this->db->from('core_separation_reason');
			$this->db->where('core_separation_reason.separation_reason_id',$SeparationReasonID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreSeparationReason($data){
			$this->db->where('core_separation_reason.separation_reason_id',$data['separation_reason_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreSeparationReason($SeparationReasonID){
			$this->db->where("core_separation_reason.separation_reason_id",$SeparationReasonID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>