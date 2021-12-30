<?php
	class CoreWarning_model extends CI_Model {
		var $table = "core_warning";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreWarning()
		{
			$this->db->select('core_warning.warning_id, core_warning.warning_code, core_warning.warning_name, core_warning.warning_remark');
			$this->db->from('core_warning');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function getWarningToken($warning_token)
		{	
			$this->db->select('core_warning.warning_token');
			$this->db->from('core_warning');
			$this->db->where('core_warning.warning_token', $warning_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getWarningID($created_id){
			$this->db->select('core_warning.warning_id');
			$this->db->from('core_warning');
			$this->db->where('core_warning.created_id', $created_id);
			$this->db->order_by('core_warning.warning_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['warning_id'];
		}

		public function insertCoreWarning($data){
			return $this->db->insert('core_warning',$data);
		}
		
		public function getCoreWarning_Detail($WarningID){
			$this->db->select('core_warning.warning_id, core_warning.warning_code, core_warning.warning_name ,core_warning.warning_remark, core_warning.data_state, core_warning.last_update');
			$this->db->from('core_warning');
			$this->db->where('core_warning.warning_id',$WarningID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreWarning($data){
			$this->db->where('warning_id',$data['warning_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreWarning($data){
			$this->db->where("core_warning.warning_id", $data['warning_id']);
			$query = $this->db->update('core_warning', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>