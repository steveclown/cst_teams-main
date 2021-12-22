<?php
	class CoreMedicalCoverage_model extends CI_Model {
		var $table = "core_medical_coverage";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreMedicalCoverage()
		{
			$this->db->select('core_medical_coverage.medical_coverage_id, core_medical_coverage.medical_coverage_code, core_medical_coverage.medical_coverage_name, core_medical_coverage.medical_coverage_ratio, core_medical_coverage.medical_coverage_amount, core_medical_coverage.medical_coverage_remark, core_medical_coverage.grade_id, core_medical_coverage.job_title_id, core_medical_coverage.class_id');
			$this->db->from('core_medical_coverage');
			$this->db->where('core_medical_coverage.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreMedicalCoverage($data){
			return $this->db->insert('core_medical_coverage',$data);
		}
		
		public function getCoreMedicalCoverage_Detail($MedicalCoverageID){
			$this->db->select('core_medical_coverage.medical_coverage_id, core_medical_coverage.medical_coverage_code, core_medical_coverage.medical_coverage_name, core_medical_coverage.medical_coverage_ratio, core_medical_coverage.medical_coverage_amount, core_medical_coverage.medical_coverage_remark, core_medical_coverage.grade_id, core_medical_coverage.job_title_id, core_medical_coverage.class_id');
			$this->db->from('core_medical_coverage');
			$this->db->where('core_medical_coverage.medical_coverage_id',$MedicalCoverageID);
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
			$this->db->where('data_state',0);
			$result = $this->db->get('core_grade');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		function getCoreClass(){
		$this->db->where('data_state',0);
		$result = $this->db->get('core_class');
		if ($result->num_rows() > 0 ){
			return $result->result_array();	
		}
		else{
			return array();	
			}
		}

		function getCoreJobTitle(){
		$this->db->where('data_state',0);
		$result = $this->db->get('core_job_title');
		if ($result->num_rows() > 0 ){
			return $result->result_array();	
		}
		else{
			return array();	
			}
		}
		
		public function saveEditCoreMedicalCoverage($data){
			$this->db->where('medical_coverage_id',$data['medical_coverage_id']);
			$query = $this->db->update('core_medical_coverage', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreMedicalCoverage($MedicalCoverageID){
			$this->db->where("medical_coverage_id",$MedicalCoverageID);
			$query = $this->db->update('core_medical_coverage', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>