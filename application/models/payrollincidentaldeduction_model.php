<?php
	class payrollincidentaldeduction_model extends CI_Model {
		var $table = "transaction_leave_request";
		
		public function payrollincidentaldeduction_model(){
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

		public function getHROEmployeeData_IncidentalDeduction($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_status !=', 9);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			
			if ($payroll_employee_level != 9 ){
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

		public function getCoreDeduction(){
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getDeductionName($deduction_id){
			$this->db->select('core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.deduction_id', $deduction_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['deduction_name'];
		}
		
		public function saveNewPayrollIncidentalDeduction($data){
			return $this->db->insert('payroll_incidental_deduction',$data);
		}

		public function getPayrollIncidentalDeduction_Data($employee_id){
			$this->db->select('payroll_incidental_deduction.incidental_deduction_id, payroll_incidental_deduction.employee_id, payroll_incidental_deduction.deduction_id, payroll_incidental_deduction.incidental_deduction_description, payroll_incidental_deduction.incidental_deduction_period, payroll_incidental_deduction.incidental_deduction_amount');
			$this->db->from('payroll_incidental_deduction');
			$this->db->where('payroll_incidental_deduction.data_state',0);
			$this->db->where('payroll_incidental_deduction.employee_id', $employee_id);
			$this->db->order_by('payroll_incidental_deduction.incidental_deduction_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('leave_request_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeesuspend($data){
			$this->db->where('leave_request_id',$data['leave_request_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollIncidentalDeduction($employee_id){
			$this->db->where("payroll_incidental_deduction.employee_id", $employee_id);
			$query = $this->db->update('payroll_incidental_deduction', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollIncidentalDeduction_Data($incidental_deduction_id){
			$this->db->where("payroll_incidental_deduction.incidental_deduction_id", $incidental_deduction_id);
			$query = $this->db->update('payroll_incidental_deduction', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>