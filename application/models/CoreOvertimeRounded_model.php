<?php
	class CoreOvertimeRounded_model extends CI_Model {
		var $table = "core_overtime_rounded";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreOvertimeRounded()
		{
			$this->db->select('core_overtime_rounded.overtime_rounded_id, core_overtime_rounded.overtime_minute_range1, core_overtime_rounded.overtime_minute_range2, core_overtime_rounded.overtime_minute_rounded');
			$this->db->from('core_overtime_rounded');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function saveNewCoreOvertimeRounded($data){
			return $this->db->insert('core_overtime_rounded',$data);
		}
		
		public function getCoreOvertimeRounded_Detail($OvertimeRoundedID){
			$this->db->select('core_overtime_rounded.overtime_rounded_id, core_overtime_rounded.overtime_minute_range1, core_overtime_rounded.overtime_minute_range2, core_overtime_rounded.overtime_minute_rounded, core_overtime_rounded.data_state, core_overtime_rounded.last_update');
			$this->db->from('core_overtime_rounded');
			$this->db->where('core_overtime_rounded.overtime_rounded_id',$OvertimeRoundedID);
			return $this->db->get()->row_array();
		}
		
		
		public function saveEditCoreOvertimeRounded($data){
			$this->db->where('overtime_rounded_id',$data['overtime_rounded_id']);
			$query = $this->db->update('core_overtime_rounded', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreOvertimeRounded($OvertimeRoundedID){
			$this->db->where("overtime_rounded_id",$OvertimeRoundedID);
			$query = $this->db->update('core_overtime_rounded', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>