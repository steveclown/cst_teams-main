<?php
	class CoreOvertimeType_model extends CI_Model {
		var $table = "core_overtime_type";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreOvertimeType()
		{
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_code, core_overtime_type.overtime_type_name, core_overtime_type.overtime_type_working_day_hour1, core_overtime_type.overtime_type_working_day_ratio1, core_overtime_type.overtime_type_working_day_hour2, core_overtime_type.overtime_type_working_day_ratio2, core_overtime_type.overtime_type_day_off_hour1, core_overtime_type.overtime_type_day_off_ratio1, core_overtime_type.overtime_type_day_off_hour2, core_overtime_type.overtime_type_day_off_ratio2');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreOvertimeType($data){
			return $this->db->insert('core_overtime_type',$data);
		}
		
		public function getCoreOvertimeType_Detail($OvertimeTypeID){
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_code, core_overtime_type.overtime_type_name, core_overtime_type.overtime_type_working_day_hour1, core_overtime_type.overtime_type_working_day_ratio1, core_overtime_type.overtime_type_working_day_hour2, core_overtime_type.overtime_type_working_day_ratio2, core_overtime_type.overtime_type_day_off_hour1, core_overtime_type.overtime_type_day_off_ratio1, core_overtime_type.overtime_type_day_off_hour2, core_overtime_type.overtime_type_day_off_ratio2');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.overtime_type_id',$OvertimeTypeID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreOvertimeType($data){
			$this->db->where('overtime_type_id',$data['overtime_type_id']);
			$query = $this->db->update('core_overtime_type', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreOvertimeType($OvertimeTypeID){
			$this->db->where("overtime_type_id",$OvertimeTypeID);
			$query = $this->db->update('core_overtime_type', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>