<?php
	class payrollemployeeloanrequisition_model extends CI_Model {
		var $table = "payroll_employee_loan_requisition";
		
		public function payrollemployeeloanrequisition_model(){
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

		public function getPayrollEmployeeLoanRequisition($division_id, $department_id, $section_id, $status){
			$this->db->select('payroll_employee_loan_requisition.employee_loan_requisition_id, payroll_employee_loan_requisition.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, payroll_employee_loan_requisition.employee_loan_requisition_date, payroll_employee_loan_requisition.employee_loan_requisition_status');
			$this->db->from('payroll_employee_loan_requisition');
			$this->db->join('hro_employee_data','payroll_employee_loan_requisition.employee_id=hro_employee_data.employee_id');
			$this->db->where('payroll_employee_loan_requisition.data_state', 0);
			$this->db->where('payroll_employee_loan_requisition.employee_loan_requisition_status', $status);
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
			return $this->db->get()->result_array();
		}

		public function getHroEmployeeData(){
			$this->db->select('employee_id, employee_name, employee_employment_status');
			$this->db->from('hro_employee_data');
			$this->db->where('data_state',0);
			$this->db->where('employee_employment_status',1);
			return $this->db->get()->result_array();
		}

		public function getHroEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.employee_employment_status');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division','hro_employee_data.division_id=core_division.division_id');
			$this->db->join('core_department','hro_employee_data.department_id=core_department.department_id');
			$this->db->join('core_section','hro_employee_data.section_id=core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			return $this->db->get()->row_array();
		}

		public function getCoreLoanType(){
			$this->db->select('loan_type_id, loan_type_name');
			$this->db->from('core_loan_type');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getEmployeeAllowance($employee_id){
			$this->db->select('payroll_employee_allowance.employee_allowance_id, payroll_employee_allowance.employee_id, payroll_employee_allowance.allowance_id, core_allowance.allowance_type, payroll_employee_allowance.employee_allowance_amount');
			$this->db->from('payroll_employee_allowance');
			$this->db->join('hro_employee_data','payroll_employee_allowance.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_allowance','payroll_employee_allowance.allowance_id = core_allowance.allowance_id');
			$this->db->where('payroll_employee_allowance.data_state',0);
			$this->db->where('payroll_employee_allowance.employee_id', $employee_id);
			// print_r($this->db->last_query());exit;
			return $this->db->get()->result_array();
		}

		// public function getCOUNT($employee_id){
		// 	$this->db->select('payroll_employee_allowance.employee_id, payroll_employee_allowance.allowance_id, core_allowance.allowance_type, payroll_employee_allowance.employee_allowance_amount');
		// 	$this->db->from('payroll_employee_allowance');
		// 	$this->db->join('core_allowance','payroll_employee_allowance.allowance_id=core_allowance.allowance_id');
		// 	$this->db->where('payroll_employee_allowance.data_state',0);
		// 	$this->db->where('payroll_employee_allowance.employee_id', $employee_id);
		// 	$query = $this->db->get();		
		// 	$result = $query->num_rows();
		// 	return $result;
		// }

		public function getPayrollBasicSalary(){
			$this->db->select('basic_salary_total');
			$this->db->from('payroll_basic_salary');
			$this->db->where('data_state',0);
			$this->db->order_by('basic_salary_id', 'DESC');
			$this->db->limit(1);
			return $this->db->get()->row_array();
		}

		public function saveNewPayrollEmployeeLoanRequisition($data){
			return $this->db->insert('payroll_employee_loan_requisition',$data);
		}

		public function getPayrollEmployeeLoanRequisitionData($employee_id){
			$this->db->select('payroll_employee_loan_requisition.employee_loan_requisition_id, payroll_employee_loan_requisition.employee_id,  payroll_employee_loan_requisition.loan_type_id, core_loan_type.loan_type_name, payroll_employee_loan_requisition.employee_loan_requisition_date,  payroll_employee_loan_requisition.employee_total_salary_amount, payroll_employee_loan_requisition.employee_total_period, payroll_employee_loan_requisition.employee_loan_amount_total, payroll_employee_loan_requisition.employee_loan_amount, payroll_employee_loan_requisition.employee_loan_requisition_status');
			$this->db->from('payroll_employee_loan_requisition');
			$this->db->join('core_loan_type','payroll_employee_loan_requisition.loan_type_id=core_loan_type.loan_type_id');
			$this->db->where('payroll_employee_loan_requisition.data_state',0);
			$this->db->where('payroll_employee_loan_requisition.employee_id', $employee_id);
			return $this->db->get()->result_array();
		}

		public function getPayrollEmployeeLoanRequisition_Detail($employee_loan_requisition_id){
			$this->db->select('payroll_employee_loan_requisition.employee_loan_requisition_id, payroll_employee_loan_requisition.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name,  payroll_employee_loan_requisition.loan_type_id, core_loan_type.loan_type_name, payroll_employee_loan_requisition.employee_loan_requisition_date, payroll_employee_loan_requisition.employee_employment_status, payroll_employee_loan_requisition.employee_total_salary_amount, payroll_employee_loan_requisition.employee_total_period, payroll_employee_loan_requisition.employee_loan_amount_total, payroll_employee_loan_requisition.employee_loan_amount');
			$this->db->from('payroll_employee_loan_requisition');
			$this->db->join('hro_employee_data','payroll_employee_loan_requisition.employee_id=hro_employee_data.employee_id');
			$this->db->join('core_division','hro_employee_data.division_id=core_division.division_id');
			$this->db->join('core_department','hro_employee_data.department_id=core_department.department_id');
			$this->db->join('core_section','hro_employee_data.section_id=core_section.section_id');
			$this->db->join('core_loan_type','payroll_employee_loan_requisition.loan_type_id=core_loan_type.loan_type_id');
			$this->db->where('payroll_employee_loan_requisition.data_state',0);
			$this->db->where('payroll_employee_loan_requisition.employee_loan_requisition_id', $employee_loan_requisition_id);
			return $this->db->get()->row_array();
		}

		public function updatePayrollEmployeeLoanRequisition($data){
			$item = array(
				'employee_loan_requisition_status'	=> $data['employee_loan_requisition_status'],
				'approved_id'						=> $data['approved_id'],
				'approved_on'						=> $data['approved_on'],
			);

			$this->db->where('employee_loan_requisition_id', $data['employee_loan_requisition_id']);
			$query = $this->db->update('payroll_employee_loan_requisition', $item);
			if($query){
				return true;
			} else {
				return false;
			}
		}
	}
?>