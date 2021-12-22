<?php
	class payrollemployeeinsurance_model extends CI_Model {
		var $table = "hro_employee_insurance";
		
		public function payrollemployeeinsurance_model(){
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

		public function getHROEmployeeData_Insurance($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
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
		
		public function getCoreInsurance(){
			$this->db->select('core_insurance.insurance_id, core_insurance.insurance_name');
			$this->db->from('core_insurance');
			$this->db->where('core_insurance.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreInsurancePremi(){
			$this->db->select('core_insurance_premi.insurance_premi_id, core_insurance_premi.insurance_premi_code');
			$this->db->from('core_insurance_premi');
			$this->db->where('core_insurance_premi.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getInsuranceName($insurance_id){
			$this->db->select('core_insurance.insurance_name');
			$this->db->from('core_insurance');
			$this->db->where('core_insurance.insurance_id', $insurance_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['insurance_name'];
		}

		public function getInsurancePremiCode($insurance_premi_id){
			$this->db->select('core_insurance_premi.insurance_premi_code');
			$this->db->from('core_insurance_premi');
			$this->db->where('core_insurance_premi.insurance_premi_id', $insurance_premi_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['insurance_premi_code'];
		}
		
		
		public function saveNewPayrollEmployeeInsurance($data){
			return $this->db->insert('payroll_employee_insurance',$data);
		}
		
		
		public function getPayrollEmployeeInsurance_Data($employee_id){
			$this->db->select('payroll_employee_insurance.employee_insurance_id, payroll_employee_insurance.employee_id, payroll_employee_insurance.insurance_id, payroll_employee_insurance.insurance_premi_id, payroll_employee_insurance.employee_insurance_period, payroll_employee_insurance.employee_insurance_description, payroll_employee_insurance.employee_insurance_amount');
			$this->db->from('payroll_employee_insurance');
			$this->db->where('payroll_employee_insurance.data_state',0);
			$this->db->where('payroll_employee_insurance.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_insurance.employee_insurance_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function deletePayrollEmployeeInsurance($employee_id){
			$this->db->where("payroll_employee_insurance.employee_id", $employee_id);
			$query = $this->db->update('payroll_employee_insurance', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollEmployeeInsurance_Data($employee_insurance_id){
			$this->db->where("payroll_employee_insurance.employee_insurance_id", $employee_insurance_id);
			$query = $this->db->update('payroll_employee_insurance', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>