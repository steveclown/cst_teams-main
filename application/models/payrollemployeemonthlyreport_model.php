<?php
	class payrollemployeemonthlyreport_model extends CI_Model {
		var $table = "core_shift";
		
		public function payrollemployeemonthlyreport_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getPayrollEmployeeMonthlyReport($monthly_period, $start_date, $end_date, $employee_id)
		{
			$this->db->select('payroll_employee_monthly.employee_monthly_id, payroll_employee_monthly.employee_id, hro_employee_data.employee_name, payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date, payroll_employee_monthly.employee_monthly_bank_acct_name, payroll_employee_monthly.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly.employee_id = hro_employee_data.employee_id');
			$this->db->where('payroll_employee_monthly.employee_monthly_period', $monthly_period);
			$this->db->where('payroll_employee_monthly.employee_monthly_start_date >=', $start_date);
			$this->db->where('payroll_employee_monthly.employee_monthly_end_date <=', $end_date);


			if($employee_id != ''){
				$this->db->where('payroll_employee_monthly.employee_id', $employee_id);
			}

			$this->db->where('payroll_employee_monthly.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
			
		}
		
		public function getCoreDivision(){
			$this->db->select('division_id, division_name');
			$this->db->from('core_division');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id){
			$this->db->select('department_id, department_name');
			$this->db->from('core_department');
			$this->db->where('data_state', 0);
			$this->db->where('division_id', $division_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('section_id, section_name');
			$this->db->from('core_section');
			$this->db->where('data_state', 0);
			$this->db->where('department_id', $department_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHroEmployeeData($division_id, $department_id, $section_id){
			$this->db->select('employee_id, employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('data_state', 0);
			$this->db->where('division_id', $division_id);
			$this->db->where('department_id', $department_id);
			$this->db->where('section_id', $section_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeMonthlyReport_Detail($employee_monthly_id){
			$this->db->select('payroll_employee_monthly.employee_id, hro_employee_data.employee_name, payroll_employee_monthly.employee_monthly_bank_acct_name, payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date, payroll_employee_monthly.employee_monthly_basic_salary, payroll_employee_monthly.employee_monthly_allowance_total, payroll_employee_monthly.employee_monthly_deduction_total, payroll_employee_monthly.employee_monthly_overtime_total, payroll_employee_monthly.employee_monthly_bpjs_amount, payroll_employee_monthly.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly.employee_id = hro_employee_data.employee_id');
			$this->db->where('payroll_employee_monthly.employee_monthly_id', $employee_monthly_id);
			return $this->db->get()->row_array();
		}

		public function getExportPayrollEmployeeMonthlyReport($monthly_period, $start_date, $end_date, $employee_id){
			$this->db->select('payroll_employee_monthly.employee_id, hro_employee_data.employee_name, payroll_employee_monthly.employee_monthly_bank_acct_name, payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date, payroll_employee_monthly.employee_monthly_basic_salary, payroll_employee_monthly.employee_monthly_allowance_total, payroll_employee_monthly.employee_monthly_deduction_total, payroll_employee_monthly.employee_monthly_overtime_total, payroll_employee_monthly.employee_monthly_bpjs_amount, payroll_employee_monthly.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly.employee_id = hro_employee_data.employee_id');
			$this->db->where('payroll_employee_monthly.employee_monthly_period', $monthly_period);
			$this->db->where('payroll_employee_monthly.employee_monthly_start_date >=', $start_date);
			$this->db->where('payroll_employee_monthly.employee_monthly_end_date <=', $end_date);


			if($employee_id != ''){
				$this->db->where('payroll_employee_monthly.employee_id', $employee_id);
			}

			$this->db->where('payroll_employee_monthly.data_state', 0);
			$result = $this->db->get();
			return $result;
		}
	}
?>