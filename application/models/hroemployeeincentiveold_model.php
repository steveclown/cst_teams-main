<?php
	class hroemployeeincentive_model extends CI_Model {
		var $table = "transaction_employee_transfer";
		
		public function hroemployeeincentive_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getCoreRegion(){
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreBranch($region_id){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.region_id', $region_id);
			$this->db->where('core_branch.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreLocation($branch_id){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.branch_id', $branch_id);
			$this->db->where('core_location.data_state', 0);
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

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreGrade(){
			$this->db->select('core_grade.grade_id, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreClass(){
			$this->db->select('core_class.class_id, core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.data_state', 0);
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

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		// public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level){
		// 	$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
		// 	$this->db->from('hro_employee_data');
		// 	$this->db->where('hro_employee_data.data_state',0);
		// 	$this->db->where('hro_employee_data.region_id', $region_id);
		// 	$this->db->where('hro_employee_data.branch_id', $branch_id);
			
		// 	if ($payroll_employee_level != 9){
		// 		$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
		// 	}

		// 	$result = $this->db->get();
		// 	return $result->result_array();
		// }

		public function getHROEmployeeData_Incentive($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);

			if ($payroll_employee_level != 9){
				$this->db->where('hro_employee_data.location_id', $location_id);
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

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

		public function getHROEmployeeIncentive_Data($employee_id){
			$this->db->select('hro_employee_incentive.employee_id, hro_employee_data.employee_name, hro_employee_incentive.region_id, hro_employee_incentive.branch_id, hro_employee_incentive.location_id, hro_employee_incentive.division_id, hro_employee_incentive.department_id, hro_employee_incentive.section_id, hro_employee_incentive.job_title_id, hro_employee_incentive.grade_id, hro_employee_incentive.class_id');
			$this->db->from('hro_employee_incentive');
			$this->db->join('hro_employee_data', 'hro_employee_incentive.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_incentive.data_state',0);
			$this->db->where('hro_employee_incentive.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeIncentive_Last($employee_id){
			$this->db->select('hro_employee_incentive.employee_id, hro_employee_data.employee_name, hro_employee_incentive.region_id, hro_employee_incentive.branch_id, hro_employee_incentive.location_id, hro_employee_incentive.division_id, hro_employee_incentive.department_id, hro_employee_incentive.section_id, hro_employee_incentive.job_title_id, hro_employee_incentive.grade_id, hro_employee_incentive.class_id, hro_employee_incentive.employee_incentive_date, hro_employee_incentive.employee_incentive_remark');
			$this->db->from('hro_employee_incentive');
			$this->db->join('hro_employee_data', 'hro_employee_incentive.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_incentive.data_state',0);
			$this->db->where('hro_employee_incentive.employee_id', $employee_id);
			$this->db->order_by('hro_employee_incentive.employee_id', "DESC");
			$this->db->limit(1);
			$result = $this->db->get();
			return $result->row_array();
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

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['location_name'];
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
		
		public function insertHROEmployeeIncentive($data){
			return $this->db->insert('hro_employee_incentive', $data);
		}
		
		public function updateHROEmployeeIncentive($data){

			$data_employee = array(
				'employee_id' 					=> $data['employee_id'],
				'region_id_incentive' 			=> $data['region_id'],
				'branch_id_incentive' 			=> $data['branch_id'],
				'division_id_incentive' 		=> $data['division_id'],
				'department_id_incentive' 		=> $data['department_id'],
				'section_id_incentive' 			=> $data['section_id'],
				'location_id_incentive' 		=> $data['location_id'],
				'job_title_id_incentive' 		=> $data['job_title_id'],
				'grade_id_incentive' 			=> $data['grade_id'],
				'class_id_incentive' 			=> $data['class_id'],
			);

			print_r("<BR>");
			print_r("<BR>");
			print_r("data_employee ");
			print_r($data_employee);
			$this->db->where('employee_id',$data_employee['employee_id']);
			$query = $this->db->update('hro_employee_data', $data_employee);
			if($query){
				print_r("<BR>");
				print_r("<BR>");
				print_r("Berhasil update");
				return true;
			}else{
				return false;
			}
		}
		
		// public function getDetail($id){
		// 	$this->db->select('*')->from($this->table);
		// 	$this->db->where('employee_transfer_id',$id);
		// 	return $this->db->get()->row_array();
		// }

		// public function saveEdithroemployeetransfer($data){
		// 	// if($this->transaksi($data)==true){
		// 		$this->db->where('employee_transfer_id',$data['employee_transfer_id']);
		// 		$query = $this->db->update($this->table, $data);
		// 		if($query){
		// 			return true;
		// 		}else{
		// 			return false;
		// 		}
		// 	// }
		// }

		public function deleteHROEmployeeIncentive($employee_id){
			$this->db->where("employee_id",$employee_id);
			$query = $this->db->update('hro_employee_transfer', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function deleteHROEmployeeIncentive_Data($employee_transfer_id){
			$this->db->where("employee_transfer_id",$employee_transfer_id);
			$query = $this->db->update('hro_employee_transfer', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>