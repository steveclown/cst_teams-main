<?php
	class payrollmedicalclaim_model extends CI_Model {
		var $table = "transaction_medical_claim";
		
		public function payrollmedicalclaim_model(){
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

		public function getHROEmployeeData_MedicalClaim($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
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

		public function getPayrollMedicalClaim_Data($employee_id){
			$this->db->select('payroll_medical_claim.medical_claim_id, payroll_medical_claim.employee_id, payroll_medical_claim.employee_medical_coverage_id, payroll_medical_claim.medical_coverage_id, payroll_medical_claim.medical_claim_date, payroll_medical_claim.medical_claim_description, payroll_medical_claim.medical_claim_opening_balance, payroll_medical_claim.medical_claim_amount, payroll_medical_claim.medical_claim_last_balance');
			$this->db->from('payroll_medical_claim');
			$this->db->where('payroll_medical_claim.data_state',0);
			$this->db->where('payroll_medical_claim.employee_id', $employee_id);
			$this->db->order_by('payroll_medical_claim.medical_claim_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getMedicalCoverageLastBalance($employee_medical_coverage_id){
			$this->db->select('hro_employee_medical_coverage.medical_coverage_last_balance');
			$this->db->from('hro_employee_medical_coverage');
			$this->db->where('hro_employee_medical_coverage.employee_medical_coverage_id',$employee_medical_coverage_id);
			$result=$this->db->get()->row_array();
			return $result['medical_coverage_last_balance'];
		}

		public function getMedicalCoverageID($employee_medical_coverage_id){
			$this->db->select('hro_employee_medical_coverage.medical_coverage_id');
			$this->db->from('hro_employee_medical_coverage');
			$this->db->where('hro_employee_medical_coverage.employee_medical_coverage_id', $employee_medical_coverage_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['medical_coverage_id'];
		}

		public function getCompanyCurrentPeriod(){
			$this->db->select('preference_company.company_current_period');
			$this->db->from('preference_company');
			$result=$this->db->get()->row_array();
			return $result['company_current_period'];
		}
		
		public function saveNewPayrollMedicalClaim($data){
			return $this->db->insert('payroll_medical_claim',$data);
		}

		public function updateNewHROEmployeeMedicalCoverage($data, $employee_medical_coverage_id){
			$this->db->select('hro_employee_medical_coverage.medical_coverage_claimed');
			$this->db->from("hro_employee_medical_coverage");
			$this->db->where('hro_employee_medical_coverage.employee_medical_coverage_id', $employee_medical_coverage_id);

			$result_medicalcoverage = $this->db->get()->row_array();
			$data2 = array(
						'medical_coverage_claimed' 		=> $result_medicalcoverage[medical_coverage_claimed] + $data[medical_claim_amount],
						'medical_coverage_last_balance' => $data[medical_claim_last_balance],
			);

			$this->db->where('employee_medical_coverage_id', $employee_medical_coverage_id);
			$query = $this->db->update("hro_employee_medical_coverage", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updatevoid($medical_claim_id){
			$this->db->select('*')->from("transaction_medical_claim");
			$this->db->where('medical_claim_id',$medical_claim_id);
			$result_medicalclaim = $this->db->get()->row_array();

			$this->db->select('*')->from("hro_employee_medical_coverage");
			$this->db->where('employee_medical_coverage_id',$result_medicalclaim[employee_medical_coverage_id]);
			$result_medicalcoverage = $this->db->get()->row_array();
			
			$data_update = array(
									'medical_coverage_claimed' => $result_medicalcoverage[medical_coverage_claimed]-$result_medicalclaim[medical_claim_amount],
									'medical_coverage_last_balance' => $result_medicalcoverage[medical_coverage_last_balance]+$result_medicalclaim[medical_claim_amount]
			);
			
			$this->db->where('employee_medical_coverage_id',$result_medicalclaim[employee_medical_coverage_id]);
			$query = $this->db->update("hro_employee_medical_coverage", $data_update);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('medical_claim_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEditpayrollmedicalclaim($data){
			$this->db->where('medical_claim_id',$data['medical_claim_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getMedicalCoverageName($medical_coverage_id){
			$this->db->select('core_medical_coverage.medical_coverage_name');
			$this->db->from('core_medical_coverage');
			$this->db->where('core_medical_coverage.medical_coverage_id', $medical_coverage_id);
			$result = $this->db->get()->row_array();
			if(!isset($result['medical_coverage_name'])){
				return '-';
			}else{
				return $result['medical_coverage_name'];
			}
		}

		public function getHROEmployeeMedicalCoverage($employee_id){
			$this->db->select('hro_employee_medical_coverage.employee_medical_coverage_id, core_medical_coverage.medical_coverage_name');
			$this->db->from('hro_employee_medical_coverage');
			$this->db->join('core_medical_coverage','hro_employee_medical_coverage.medical_coverage_id = core_medical_coverage.medical_coverage_id');
			$this->db->where('hro_employee_medical_coverage.employee_id',$employee_id);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function deletePayrollMedicalClaim_Data($medical_claim_id){
			$this->db->where("payroll_medical_claim.medical_claim_id", $medical_claim_id);
			$query = $this->db->update('payroll_medical_claim', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getEmployeeMedicalCoverageID($medical_claim_id){
			$this->db->select('payroll_medical_claim.employee_medical_coverage_id');
			$this->db->from('payroll_medical_claim');
			$this->db->where('payroll_medical_claim.medical_claim_id', $medical_claim_id);
			$result=$this->db->get()->row_array();
			return $result['employee_medical_coverage_id'];
		}

		public function getMedicalClaimAmount($medical_claim_id){
			$this->db->select('payroll_medical_claim.medical_claim_amount');
			$this->db->from('payroll_medical_claim');
			$this->db->where('payroll_medical_claim.medical_claim_id', $medical_claim_id);
			$result=$this->db->get()->row_array();
			return $result['medical_claim_amount'];
		}


		public function updateDeleteHROEmployeeMedicalCoverage($medical_claim_id){
			$employee_medical_coverage_id = $this->getEmployeeMedicalCoverageID($medical_claim_id);
			$medical_claim_amount = $this->getMedicalClaimAmount($medical_claim_id);

			$this->db->select('hro_employee_medical_coverage.medical_coverage_claimed, hro_employee_medical_coverage.medical_coverage_last_balance');
			$this->db->from("hro_employee_medical_coverage");
			$this->db->where('hro_employee_medical_coverage.employee_medical_coverage_id', $employee_medical_coverage_id);

			$result_medicalcoverage = $this->db->get()->row_array();

			$data2 = array(
						'medical_coverage_claimed' 		=> $result_medicalcoverage[medical_coverage_claimed] - $medical_claim_amount,
						'medical_coverage_last_balance' => $result_medicalcoverage[medical_coverage_last_balance] + $medical_claim_amount,
			);

			$this->db->where('employee_medical_coverage_id', $employee_medical_coverage_id);
			$query = $this->db->update("hro_employee_medical_coverage", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>