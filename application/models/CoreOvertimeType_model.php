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
		
		public function getOvertimeTypeToken($overtime_type_token)
		{	
			$this->db->select('core_award.award_token');
			$this->db->from('core_award');
			$this->db->where('core_award.award_token', $overtime_type_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getOvertimeTypeID($created_id){
			$this->db->select('core_overtime_type.overtime_type_id');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.created_id', $created_id);
			$this->db->order_by('core_overtime_type.overtime_type_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['overtime_type_id'];
		}

		public function insertCoreOvertimeType($data){
			return $this->db->insert('core_overtime_type',$data);
		}
		
		public function getCoreOvertimeType_Detail($OvertimeTypeID){
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_code, core_overtime_type.overtime_type_name, core_overtime_type.overtime_type_working_day_hour1, core_overtime_type.overtime_type_working_day_ratio1, core_overtime_type.overtime_type_working_day_hour2, core_overtime_type.overtime_type_working_day_ratio2, core_overtime_type.overtime_type_day_off_hour1, core_overtime_type.overtime_type_day_off_ratio1, core_overtime_type.overtime_type_day_off_hour2, core_overtime_type.overtime_type_day_off_ratio2');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.overtime_type_id',$OvertimeTypeID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreOvertimeType($data){
			$this->db->where('overtime_type_id',$data['overtime_type_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreOvertimeType($data){
			$this->db->where("core_overtime_type.overtime_type_id", $data['overtime_type_id']);
			$query = $this->db->update('core_overtime_type', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>