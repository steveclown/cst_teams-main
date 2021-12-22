<?php
	class CoreExtraLeave_model extends CI_Model {
		var $table = "core_extra_leave";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreExtraLeave()
		{
			$this->db->select('core_extra_leave.extra_leave_id, core_extra_leave.extra_leave_code, core_extra_leave.extra_leave_name, core_extra_leave.extra_leave_range1, core_extra_leave.extra_leave_range2, core_extra_leave.extra_leave_days');
			$this->db->from('core_extra_leave');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function saveNewCoreExtraLeave($data){
			return $this->db->insert('core_extra_leave',$data);
		}
		
		public function getCoreExtraLeave_Detail($ExtraLeaveID){
			$this->db->select('core_extra_leave.extra_leave_id, core_extra_leave.extra_leave_code, core_extra_leave.extra_leave_name, core_extra_leave.extra_leave_range1, core_extra_leave.extra_leave_range2, core_extra_leave.extra_leave_days');
			$this->db->from('core_extra_leave');
			$this->db->where('core_extra_leave.extra_leave_id',$ExtraLeaveID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreExtraLeave($data){
			$this->db->where('extra_leave_id',$data['extra_leave_id']);
			$query = $this->db->update('core_extra_leave', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreExtraLeave($ExtraLeaveID){
			$this->db->where("extra_leave_id",$ExtraLeaveID);
			$query = $this->db->update('core_extra_leave', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>