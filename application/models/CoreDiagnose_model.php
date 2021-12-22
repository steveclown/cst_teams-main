<?php
	class CoreDiagnose_model extends CI_Model {
		var $table = "core_diagnose";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDiagnose()
		{
			$this->db->select('core_diagnose.diagnose_id, core_diagnose.diagnose_code, core_diagnose.diagnose_name');
			$this->db->from('core_diagnose');
			$this->db->where('core_diagnose.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreDiagnose($data){
			return $this->db->insert('core_diagnose',$data);
		}
		
		public function getCoreDiagnose_Detail($DiagnoseID){
			$this->db->select('core_diagnose.diagnose_id, core_diagnose.diagnose_code, core_diagnose.diagnose_name, core_diagnose.diagnose_remark, core_diagnose.data_state, core_diagnose.last_update');
			$this->db->from('core_diagnose');
			$this->db->where('core_diagnose.diagnose_id',$DiagnoseID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreDiagnose($data){
			$this->db->where('core_diagnose.diagnose_id',$data['diagnose_id']);
			$query = $this->db->update('core_diagnose', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreDiagnose($DiagnoseID){
			$this->db->where("core_diagnose.diagnose_id",$DiagnoseID);
			$query = $this->db->update('core_diagnose', array("data_state"=>'1'));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>