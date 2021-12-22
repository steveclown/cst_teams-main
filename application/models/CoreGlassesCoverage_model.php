<?php
	class CoreGlassesCoverage_model extends CI_Model {
		var $table = "core_glasses_coverage";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreGlassesCoverage()
		{
			$this->db->select('core_glasses_coverage.glasses_coverage_id, core_glasses_coverage.glasses_coverage_code, core_glasses_coverage.glasses_coverage_name, core_glasses_coverage.glasses_coverage_type, core_glasses_coverage.glasses_coverage_ratio, core_glasses_coverage.glasses_coverage_amount, core_glasses_coverage.glasses_coverage_remark, core_glasses_coverage.grade_id, core_glasses_coverage.job_title_id, core_glasses_coverage.class_id');
			$this->db->from('core_glasses_coverage');
			$this->db->where('core_glasses_coverage.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreGlassesCoverage($data){
			return $this->db->insert('core_glasses_coverage',$data);
		}
		
		public function getCoreGlassesCoverage_Detail($GlassesCoverageID){
			$this->db->select('core_glasses_coverage.glasses_coverage_id, core_glasses_coverage.glasses_coverage_code, core_glasses_coverage.glasses_coverage_name, core_glasses_coverage.glasses_coverage_type, core_glasses_coverage.glasses_coverage_ratio, core_glasses_coverage.glasses_coverage_amount, core_glasses_coverage.glasses_coverage_remark, core_glasses_coverage.grade_id, core_glasses_coverage.job_title_id, core_glasses_coverage.class_id');
			$this->db->from('core_glasses_coverage');
			$this->db->where('core_glasses_coverage.glasses_coverage_id',$GlassesCoverageID);
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

		public function getClassName($ClassID){
			$this->db->select('core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.class_id',$ClassID);
			$result = $this->db->get()->row_array();
			if(!isset($result['class_name'])){
				return '-';
			}else{
				return $result['class_name'];
			}
		}

		public function getJobTitleName($JobTitleID){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id',$JobTitleID);
			$result = $this->db->get()->row_array();
			if(!isset($result['job_title_name'])){
				return '-';
			}else{
				return $result['job_title_name'];
			}
		}
		
		function getCoreGrade(){
			$this->db->where('core_grade.data_state',0);
			$result = $this->db->get('core_grade');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		function getCoreClass(){
			$this->db->where('core_class.data_state',0);
			$result = $this->db->get('core_class');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		function getCoreJobTitle(){
			$this->db->where('core_job_title.data_state',0);
			$result = $this->db->get('core_job_title');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function saveEditCoreGlassesCoverage($data){
			$this->db->where('core_glasses_coverage.glasses_coverage_id',$data['glasses_coverage_id']);
			$query = $this->db->update('core_glasses_coverage', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreGlassesCoverage($GlassesCoverageID){
			$this->db->where("core_glasses_coverage.glasses_coverage_id",$GlassesCoverageID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>