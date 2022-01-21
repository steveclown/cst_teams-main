<?php
	class HroEmployeeStatusAlteration_model extends CI_Model {
		var $table = "transaction_status_alteration";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreRegion(){
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreBranch(){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreBranchDD($region_id){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state', 0);
			$this->db->where('core_branch.region_id', $region_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreCompany(){
			$this->db->select('core_company.company_id, core_company.company_name');
			$this->db->from('core_company');
			$this->db->where('core_company.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
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

		public function getCoreUnit(){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getCoreGrade(){
			$this->db->select('core_grade.grade_id, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreClass(){
			$this->db->select('core_class.class_id, core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreLocation(){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreBank(){
			$this->db->select('core_bank.bank_id, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('*');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getHROEmployeeStatusAlteration($employee_id){
			$this->db->select('*');
			$this->db->from('hro_employee_status_alteration');
			$this->db->where('hro_employee_status_alteration.data_state',0);
			$this->db->where('hro_employee_status_alteration.employee_id', $employee_id);
			$this->db->order_by('hro_employee_status_alteration.status_alteration_id', 'DESC');
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeStatusAlteration_Last($employee_id){
			$this->db->select('*');
			$this->db->from('hro_employee_status_alteration');
			$this->db->where('hro_employee_status_alteration.data_state',0);
			$this->db->where('hro_employee_status_alteration.employee_id', $employee_id);
			$this->db->order_by('hro_employee_status_alteration.status_alteration_id', 'DESC');
			$this->db->limit(1);
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


		public function getHROEmployeeData_StatusAlteration($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('*');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);

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

		public function getRegionName($region_id){
			$this->db->select('core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.region_id', $region_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['region_name'];
		}

		public function getBranchName($branch_id){
			$this->db->select('core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_id', $branch_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['branch_name'];
		}
		
		public function getCompanyName($company_id){
			$this->db->select('core_company.company_name');
			$this->db->from('core_company');
			$this->db->where('core_company.company_id', $company_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['company_name'];
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

		public function getUnitName($unit_id){
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['unit_name'];
		}
		
		public function getJobTitleName($job_title_id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $job_title_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['job_title_name'];
		}
		
		public function getGradeName($grade_id){
			$this->db->select('core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.grade_id', $grade_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['grade_name'];
		}
		
		public function getClassName($class_id){
			$this->db->select('core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.class_id', $class_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['class_name'];
		}
		
		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['location_name'];
		}
		
		public function insertHROEmployeeStatusAlteration($data){
			return $this->db->insert('hro_employee_status_alteration',$data);
		}
		
		public function updateHROEmployeeData($data){
			$this->db->where('employee_id', $data['employee_id']);
			$query = $this->db->update("hro_employee_data", $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateHROEmployeeDataFromDelete($data_update){
			$this->db->where('employee_id', $data_update['employee_id']);
			$query = $this->db->update("hro_employee_data", $data_update);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('status_alteration_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalstatusalterationbyemployee($data){
			// if($this->transaksi($data)==true){
				$this->db->where('status_alteration_id',$data['status_alteration_id']);
				$query = $this->db->update($this->table, $data);
				if($query){
					return true;
				}else{
					return false;
				}
			// }
		}

		public function getemployeestatusname($id){
			$this->db->select('employee_status_name')->from('core_employee_status');
			$this->db->where('employee_status_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_status_name'])){
				return '-';
			}else{
				return $result['employee_status_name'];
			}
		}

		public function delete($id){
			$this->db->where("status_alteration_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
		public function deleteHROEmployeeStatusAlteration($data){
			$this->db->where("status_alteration_id", $data['status_alteration_id']);
			$query = $this->db->update('hro_employee_status_alteration', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>