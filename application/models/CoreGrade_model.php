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

		public function getGradeToken($grade_token)
		{	
			$this->db->select('core_grade.grade_token');
			$this->db->from('core_grade');
			$this->db->where('core_grade.grade_token', $grade_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}
		
		public function insertCoreGrade($data){
			return $this->db->insert('core_grade',$data);
		}

		public function getGradeID($created_id){
			$this->db->select('core_grade.grade_id');
			$this->db->from('core_grade');
			$this->db->where('core_grade.created_id', $created_id);
			$this->db->order_by('core_grade.grade_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['grade_id'];
		}
		
		public function getCoreGrade_Detail($GradeID){
			$this->db->select('core_grade.grade_id, core_grade.grade_code, core_grade.grade_name, core_grade.grade_remark');
			$this->db->from('core_grade');
			$this->db->where('core_grade.grade_id',$GradeID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreGrade($data){
			$this->db->where('core_grade.grade_id', $data['grade_id']);
			$query = $this->db->update('core_grade', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoregrade($data){
			$this->db->where("core_grade.grade_id", $data['grade_id']);
			$query = $this->db->update('core_grade', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>