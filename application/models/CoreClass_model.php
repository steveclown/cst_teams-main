<?php
	Class CoreClass_model extends CI_Model {
		var $table = "core_class";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreClass()
		{
			$this->db->select('core_class.class_id, core_class.class_code, core_class.class_name, grade_id, core_class.standard_salary_range1, core_class.standard_salary_range2, core_class.class_remark');
			$this->db->from('core_class');
			$this->db->where('core_class.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function getClassToken($class_token)
		{	
			$this->db->select('core_class.class_token');
			$this->db->from('core_class');
			$this->db->where('core_class.class_token', $class_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}
		
		public function insertCoreClass($data){
			return $this->db->insert('core_class',$data);
		}

		public function getClassID($created_id){
			$this->db->select('core_class.class_id');
			$this->db->from('core_class');
			$this->db->where('core_class.created_id', $created_id);
			$this->db->order_by('core_class.class_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['class_id'];
		}
		
		public function getCoreClass_Detail($ClassID){
			$this->db->select('core_class.class_id, core_class.class_code, core_class.class_name, grade_id, core_class.standard_salary_range1, core_class.standard_salary_range2, core_class.class_remark');
			$this->db->from('core_class');
			$this->db->where('core_class.class_id',$ClassID);
			return $this->db->get()->row_array();
		}
	
		public function getGradeName($GradeID){
			$this->db->select('core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.grade_id',$GradeID);
			$result = $this->db->get()->row_array();
			if(!isset($result['grade_name'])){
				return '-';
			}else{
				return $result['grade_name'];
			}
		}
		
		public function getCoreGrade(){
			$this->db->select('core_grade.grade_id, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function updateCoreClass($data){
			$this->db->where('core_class.class_id', $data['class_id']);
			$query = $this->db->update('core_class', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreClass($data){
			$this->db->where("core_class.class_id", $data['class_id']);
			$query = $this->db->update('core_class', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	
	}
?>