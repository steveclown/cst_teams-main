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
		
		public function getSeparationReasonToken($separation_reason_token)
		{	
			$this->db->select('core_separation_reason.separation_reason_token');
			$this->db->from('core_separation_reason');
			$this->db->where('core_separation_reason.separation_reason_token', $separation_reason_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getSeparationReasonID($created_id){
			$this->db->select('core_separation_reason.separation_reason_id');
			$this->db->from('core_separation_reason');
			$this->db->where('core_separation_reason.created_id', $created_id);
			$this->db->order_by('core_separation_reason.separation_reason_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['separation_reason_id'];
		}

		public function insertCoreSeparationReason($data){
			return $this->db->insert('core_separation_reason',$data);
		}
		
		public function getCoreSeparationReason_Detail($SeparationReasonID){
			$this->db->select('core_separation_reason.separation_reason_id, core_separation_reason.separation_reason_name');
			$this->db->from('core_separation_reason');
			$this->db->where('core_separation_reason.separation_reason_id',$SeparationReasonID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreSeparationReason($data){
			$this->db->where('core_separation_reason.separation_reason_id',$data['separation_reason_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreSeparationReason($data){
			$this->db->where("core_separation_reason.separation_reason_id", $data['separation_reason_id']);
			$query = $this->db->update('core_separation_reason', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>