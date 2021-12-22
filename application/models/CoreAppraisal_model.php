<?php
	class CoreAppraisal_model extends CI_Model {
		var $table = "core_appraisal";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreAppraisal()
		{
			$this->db->select('core_appraisal.appraisal_id, core_appraisal.appraisal_code, core_appraisal.appraisal_name, core_appraisal.appraisal_start_value, core_appraisal.appraisal_end_value, core_appraisal.appraisal_type, core_appraisal.appraisal_remark');
			$this->db->from('core_appraisal');
			$this->db->where('core_appraisal.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function insertCoreAppraisal($data){
			return $this->db->insert('core_appraisal',$data);
		}
		
		public function getCoreAppraisal_Detail($appraisal_id){
			$this->db->select('core_appraisal.appraisal_id, core_appraisal.appraisal_code, core_appraisal.appraisal_name, core_appraisal.appraisal_start_value, core_appraisal.appraisal_end_value, core_appraisal.appraisal_type, ,core_appraisal.appraisal_remark');
			$this->db->from('core_appraisal');
			$this->db->where('core_appraisal.appraisal_id', $appraisal_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreAppraisal($data){
			$this->db->where('core_appraisal.appraisal_id', $data['appraisal_id']);
			$query = $this->db->update('core_appraisal', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAppraisal($data){
			$this->db->where("core_appraisal.appraisal_id", $data['appraisal_id']);
			$query = $this->db->update('core_appraisal', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>