<?php
	class CoreHospitalCoverage_model extends CI_Model {
		var $table = "core_hospital_coverage";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreHospitalCoverage()
		{
			$this->db->select('core_hospital_coverage.hospital_coverage_id, core_hospital_coverage.hospital_coverage_code, core_hospital_coverage.hospital_coverage_name, core_hospital_coverage.hospital_coverage_medicine_ratio, core_hospital_coverage.hospital_coverage_medicine_amount, core_hospital_coverage.hospital_coverage_room_ratio, core_hospital_coverage.hospital_coverage_room_amount, core_hospital_coverage.hospital_coverage_remark, core_hospital_coverage.grade_id, core_hospital_coverage.job_title_id, core_hospital_coverage.class_id');
			$this->db->from('core_hospital_coverage');
			$this->db->where('core_hospital_coverage.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreHospitalCoverage($data){
			return $this->db->insert('core_hospital_coverage',$data);
		}
		
		public function getCoreHospitalCoverage_Detail($HospitalCoverageID){
			$this->db->select('core_hospital_coverage.hospital_coverage_id, core_hospital_coverage.hospital_coverage_code, core_hospital_coverage.hospital_coverage_name, core_hospital_coverage.hospital_coverage_medicine_ratio, core_hospital_coverage.hospital_coverage_medicine_amount, core_hospital_coverage.hospital_coverage_room_ratio, core_hospital_coverage.hospital_coverage_room_amount, core_hospital_coverage.hospital_coverage_remark, core_hospital_coverage.grade_id, core_hospital_coverage.job_title_id, core_hospital_coverage.class_id');
			$this->db->from('core_hospital_coverage');
			$this->db->where('core_hospital_coverage.hospital_coverage_id',$HospitalCoverageID);
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

		public function getClassName($id){
			$this->db->select('core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.class_id',$id);
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
			$this->db->where('core_class.data_state','0');
			$result = $this->db->get('core_class');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		function getCoreJobTitle(){
			$this->db->where('core_job_title.data_state','0');
			$result = $this->db->get('core_job_title');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function saveEditCoreHospitalCoverage($data){
			$this->db->where('core_hospital_coverage.hospital_coverage_id',$data['hospital_coverage_id']);
			$query = $this->db->update('core_hospital_coverage', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreHospitalCoverage($HospitalCoverageID){
			$this->db->where("core_hospital_coverage.hospital_coverage_id",$HospitalCoverageID);
			$query = $this->db->update('core_hospital_coverage', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>