<?php
	class CoreAnnualLeave_model extends CI_Model {
		var $table = "core_annual_leave";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreAnnualLeave()
		{
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_code, core_annual_leave.annual_leave_name, core_annual_leave.annual_leave_days, core_annual_leave.annual_leave_type, core_annual_leave.annual_leave_remark');
			$this->db->from('core_annual_leave');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreAnnualleave($data){
			return $this->db->insert('core_annual_leave',$data);
		}
		
		public function getCoreAnnualLeave_Detail($AnnualLeaveID){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_code, core_annual_leave.annual_leave_name, core_annual_leave.annual_leave_days, core_annual_leave.annual_leave_type, core_annual_leave.annual_leave_remark');
			$this->db->from('core_annual_leave');
			$this->db->where('annual_leave_id',$AnnualLeaveID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreAnnualleave($data){
			$this->db->where('annual_leave_id', $data['annual_leave_id']);
			$query = $this->db->update('core_annual_leave', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAnnualLeave($AnnualLeaveID){
			$this->db->where("annual_leave_id",$AnnualLeaveID);
			$query = $this->db->update('core_annual_leave', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>