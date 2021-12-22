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
		
		public function saveNewCoreWarning($data){
			return $this->db->insert('core_warning',$data);
		}
		
		public function getCoreWarning_Detail($WarningID){
			$this->db->select('core_warning.warning_id, core_warning.warning_code, core_warning.warning_name ,core_warning.warning_remark, core_warning.data_state, core_warning.last_update');
			$this->db->from('core_warning');
			$this->db->where('core_warning.warning_id',$WarningID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreWarning($data){
			$this->db->where('core_warning.warning_id',$data['warning_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreWarning($WarningID){
			$this->db->where("warning_id",$WarningID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>