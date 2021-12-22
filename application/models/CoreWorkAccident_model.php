<?php
	class CoreWorkAccident_model extends CI_Model {
		var $table = "core_work_accident";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreWorkAccident()
		{
			$this->db->select('core_work_accident.work_accident_id, core_work_accident.work_accident_name');
			$this->db->from('core_work_accident');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function insertCoreWorkAccident($data){
			return $this->db->insert('core_work_accident',$data);
		}
		
		public function getCoreWorkAccident_Detail($work_accident_id){
			$this->db->select('core_work_accident.work_accident_id, core_work_accident.work_accident_name');
			$this->db->from('core_work_accident');
			$this->db->where('core_work_accident.work_accident_id', $work_accident_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreWorkAccident($data){
			$this->db->where('core_work_accident.work_accident_id', $data['work_accident_id']);
			$query = $this->db->update('core_work_accident', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreWorkAccident($AnnualLeaveID){
			$this->db->where('core_work_accident.work_accident_id', $data['work_accident_id']);
			$query = $this->db->update('core_work_accident', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>