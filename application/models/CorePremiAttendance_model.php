<?php
	class CorePremiAttendance_model extends CI_Model {
		var $table = "core_premi_attendance";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCorePremiAttendance()
		{
			$this->db->select('core_premi_attendance.premi_attendance_id, core_premi_attendance.premi_attendance_code, core_premi_attendance.premi_attendance_name, core_premi_attendance.premi_attendance_range1, core_premi_attendance.premi_attendance_range2, core_premi_attendance.premi_attendance_amount, core_premi_attendance.premi_attendance_remark');
			$this->db->from('core_premi_attendance');
			$this->db->where('core_premi_attendance.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function saveNewCorePremiAttendance($data){
			return $this->db->insert('core_premi_attendance',$data);
		}
		
		public function getCorePremiAttendance_Detail($PremiAttendanceID){
			$this->db->select('core_premi_attendance.premi_attendance_id, core_premi_attendance.premi_attendance_code, core_premi_attendance.premi_attendance_name, core_premi_attendance.premi_attendance_range1, core_premi_attendance.premi_attendance_range2, core_premi_attendance.premi_attendance_amount, core_premi_attendance.premi_attendance_remark');
			$this->db->from('core_premi_attendance');
			$this->db->where('core_premi_attendance.premi_attendance_id',$PremiAttendanceID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCorePremiAttendance($data){
			$this->db->where('core_premi_attendance.premi_attendance_id',$data['premi_attendance_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCorePremiAttendance($PremiAttendanceID){
			$this->db->where("core_premi_attendance.premi_attendance_id",$PremiAttendanceID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>