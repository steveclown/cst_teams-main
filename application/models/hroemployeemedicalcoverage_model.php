<?php
	class hroemployeemedicalcoverage_model extends CI_Model {
		var $table = "hro_employee_medical_coverage";
		
		public function hroemployeemedicalcoverage_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_MedicalCoverage($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($employee_id != ''){
				$this->db->where('hro_employee_data.employee_id', $employee_id);
			}

			if ($division_id != ''){
				$this->db->where('hro_employee_data.division_id', $division_id);
			}

			if ($department_id != ''){
				$this->db->where('hro_employee_data.department_id', $department_id);
			}

			if ($section_id != ''){
				$this->db->where('hro_employee_data.section_id', $section_id);
			}


			$result = $this->db->get();
			return $result->result_array();
		}

		public function getEmployeeName($id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
			}
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}


		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getHROEmployeeMedicalCoverage_Data($employee_id){
			$this->db->select('hro_employee_medical_coverage.employee_medical_coverage_id, hro_employee_medical_coverage.employee_id, hro_employee_medical_coverage.medical_coverage_id, hro_employee_medical_coverage.medical_coverage_period, hro_employee_medical_coverage.medical_coverage_amount, hro_employee_medical_coverage.medical_coverage_claimed, hro_employee_medical_coverage.medical_coverage_remark');
			$this->db->from('hro_employee_medical_coverage');
			$this->db->where('hro_employee_medical_coverage.data_state',0);
			$this->db->where('hro_employee_medical_coverage.employee_id', $employee_id);
			$this->db->order_by('hro_employee_medical_coverage.employee_medical_coverage_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_CoreMedical($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.grade_id, hro_employee_data.class_id, hro_employee_data.job_title_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getCoreMedicalCoverage($employee_id){
			$hroemployeedata_coremedical = $this->getHROEmployeeData_CoreMedical($employee_id);

			$this->db->select('core_medical_coverage.medical_coverage_id, core_medical_coverage.medical_coverage_name');
			$this->db->from('core_medical_coverage');
			$this->db->where('core_medical_coverage.grade_id', $hroemployeedata_coremedical['grade_id']);
			$this->db->where('core_medical_coverage.class_id', $hroemployeedata_coremedical['class_id']);
			$this->db->where('core_medical_coverage.job_title_id', $hroemployeedata_coremedical['job_title_id']);
			$this->db->where('core_medical_coverage.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCompanyCurrentPeriod(){
			$this->db->select('preference_company.company_current_period');
			$this->db->from('preference_company');
			$result=$this->db->get()->row_array();
			return $result['company_current_period'];
		}

		public function getMedicalCoverageName($medical_coverage_id){
			$this->db->select('core_medical_coverage.medical_coverage_name');
			$this->db->from('core_medical_coverage');
			$this->db->where('core_medical_coverage.medical_coverage_id',$medical_coverage_id);
			$result = $this->db->get()->row_array();
			if(!isset($result['medical_coverage_name'])){
				return '-';
			}else{
				return $result['medical_coverage_name'];
			}
		}

		public function getCoverageAmount($id){
			$this->db->select('core_medical_coverage.medical_coverage_amount');
			$this->db->from('core_medical_coverage');
			$this->db->where('core_medical_coverage.medical_coverage_id',$id);
			$result=$this->db->get()->row_array();
			return $result['medical_coverage_amount'];
		}
		
		public function saveNewHROEmployeeMedicalCoverage($data){
			return $this->db->insert('hro_employee_medical_coverage',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_medical_coverage_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeemedicalcoverage($data){
			$this->db->where('employee_medical_coverage_id',$data['employee_medical_coverage_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteHROEmployeeMedicalCoverage($employee_id){
			$this->db->where("hro_employee_medical_coverage.employee_id",$employee_id);
			$query = $this->db->update('hro_employee_medical_coverage', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeMedicalCoverage_Data($employee_medical_coverage_id){
			$this->db->where("hro_employee_medical_coverage.employee_medical_coverage_id",$employee_medical_coverage_id);
			$query = $this->db->update('hro_employee_medical_coverage', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>