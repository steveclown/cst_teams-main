<?php
	class CoreGrade_model extends CI_Model {
		var $table = "core_grade";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreGrade()
		{
			$this->db->select('core_grade.grade_id, core_grade.grade_code, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreGrade($data){
			return $this->db->insert('core_grade',$data);
		}
		
		public function getCoreGrade_Detail($GradeID){
			$this->db->select('core_grade.grade_id, core_grade.grade_code, core_grade.grade_name, core_grade.grade_remark');
			$this->db->from('core_grade');
			$this->db->where('core_grade.grade_id',$GradeID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreGrade($data){
			$this->db->where('core_grade.grade_id',$data['grade_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreGrade($GradeID){
			$this->db->where("core_grade.grade_id",$GradeID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>