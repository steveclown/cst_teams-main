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
		
		public function getAnnualLeaveToken($annual_leave_token)
		{	
			$this->db->select('core_annual_leave.annual_leave_token');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.annual_leave_token', $annual_leave_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getAnnualLeaveID($created_id){
			$this->db->select('core_annual_leave.annual_leave_id');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.created_id', $created_id);
			$this->db->order_by('core_annual_leave.annual_leave_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['annual_leave_id'];
		}
		
		public function insertCoreAnnualLeave($data){
			return $this->db->insert('core_annual_leave',$data);
		}
		
		public function getCoreAnnualLeave_Detail($AnnualLeaveID){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_code, core_annual_leave.annual_leave_name, core_annual_leave.annual_leave_days, core_annual_leave.annual_leave_type, core_annual_leave.annual_leave_remark');
			$this->db->from('core_annual_leave');
			$this->db->where('annual_leave_id',$AnnualLeaveID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreAnnualLeave($data){
			$this->db->where('annual_leave_id',$data['annual_leave_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAnnualLeave($data){
			$this->db->where("core_annual_leave.annual_leave_id", $data['annual_leave_id']);
			$query = $this->db->update('core_annual_leave', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>