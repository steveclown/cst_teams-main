<?php
	class PayrollEmployeeMonthlyReportCkp_model extends CI_Model {
		var $table = "hro_employee_allowance";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getScheduleEmployeeShift($region_id, $branch_id, $location_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.region_id', $region_id);
			$this->db->where('schedule_employee_shift.branch_id', $branch_id);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			$this->db->order_by('schedule_employee_shift.employee_shift_code', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollMonthlyPeriod(){
			$this->db->select("payroll_monthly_period.monthly_period, CONCAT(payroll_monthly_period.monthly_period_start_date, ' s/d ', payroll_monthly_period.monthly_period_end_date) AS monthly_period_date", FALSE);
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state', 0);
			$this->db->order_by('payroll_monthly_period.monthly_period', 'DESC');
			$result = $this->db->get()->result_array();  
			return $result;
		}

		public function getPayrollEmployeeMonthly($region_id, $branch_id, $location_id, $employee_monthly_period){
			$this->db->distinct();
			$this->db->select('payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date');
			$this->db->from('payroll_employee_monthly');
			$this->db->where('payroll_employee_monthly.data_state', 0);
			$this->db->where('payroll_employee_monthly.region_id', $region_id);
			$this->db->where('payroll_employee_monthly.branch_id', $branch_id);
			$this->db->where('payroll_employee_monthly.location_id', $location_id);

			if ($employee_monthly_period != ''){
				$this->db->where('payroll_employee_monthly.employee_monthly_period', $employee_monthly_period);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPreferenceCompany(){
			$this->db->select('preference_company.job_title_id_payroll, preference_company.basic_salary_deduction, preference_company.working_days_default, preference_company.job_title_id_driver, preference_company.employee_delivery_amount_driver, preference_company.job_title_id_pu, preference_company.employee_delivery_amount_pu');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollEmployeeMonthlyItem_Detail($location_id, $employee_monthly_period){
			$query = $this->db->query("
					SELECT DISTINCT unit_id, 
					(
						SELECT SUM(b.employee_monthly_salary_subtotal) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
							AND employee_monthly_bank_acct_no <> ''
					) AS salary_total_unit_bank, 
					(
						SELECT SUM(b.employee_monthly_salary_subtotal) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
							AND employee_monthly_bpjs_amount > 0
					) AS salary_total_unit_bpjs, 
					(
						SELECT SUM(b.employee_monthly_salary_subtotal) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
							AND employee_monthly_bpjs_amount = 0
					) AS salary_total_unit_no_bpjs,
					(
						SELECT SUM(b.employee_monthly_salary_subtotal) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
							AND employee_monthly_bank_acct_no = ''
					) AS salary_total_unit_cash,
					(
						SELECT SUM(b.employee_monthly_additional_deduction_amount) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
					) AS additional_deduction_unit,
					(
						SELECT SUM(b.employee_monthly_meal_coupon_amount) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
					) AS meal_coupon_unit,
					(
						SELECT SUM(b.employee_monthly_bpjs_amount) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
					) AS bpjs_amount_unit,
					(
						SELECT SUM(b.employee_monthly_salary_total) 
							FROM  payroll_employee_monthly_item b 
							WHERE b.unit_id = payroll_employee_monthly_item.unit_id
					) AS total_salary_unit
					FROM payroll_employee_monthly_item
					WHERE location_id = '".$location_id."'
					AND employee_monthly_period = '".$employee_monthly_period."'
					");
			$result = $query->result_array();
			return $result;
		}

		public function getUnitName($unit_id){
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$result = $this->db->get()->row_array();
			return $result['unit_name'];
		}

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$result = $this->db->get()->row_array();
			return $result['location_name'];
		}

		public function getPayrollEmployeeMonthlyAll_Detail($location_id, $employee_monthly_period, $unit_id){
			$this->db->select('payroll_employee_monthly_item.employee_monthly_id, payroll_employee_monthly_item.employee_id, hro_employee_data.employee_name, hro_employee_data.employee_code, payroll_employee_monthly_item.location_id, core_location.location_name, payroll_employee_monthly_item.division_id, core_division.division_name, payroll_employee_monthly_item.department_id, core_department.department_name, payroll_employee_monthly_item.section_id, core_section.section_name, payroll_employee_monthly_item.unit_id, core_unit.unit_name, payroll_employee_monthly_item.job_title_id, core_job_title.job_title_name, payroll_employee_monthly_item.bank_id, payroll_employee_monthly_item.employee_monthly_period, payroll_employee_monthly_item.employee_monthly_start_date, payroll_employee_monthly_item.employee_monthly_end_date, payroll_employee_monthly_item.employee_employment_status, payroll_employee_monthly_item.employee_hire_date, payroll_employee_monthly_item.employee_working_months, payroll_employee_monthly_item.employee_monthly_bank_acct_name, payroll_employee_monthly_item.employee_monthly_bank_acct_no, payroll_employee_monthly_item.employee_monthly_total_working_days, payroll_employee_monthly_item.employee_basic_salary, payroll_employee_monthly_item.employee_monthly_basic_salary, payroll_employee_monthly_item.employee_monthly_working_days, payroll_employee_monthly_item.employee_monthly_allowance_amount, payroll_employee_monthly_item.employee_monthly_attendance_amount, payroll_employee_monthly_item.employee_monthly_service_amount, payroll_employee_monthly_item.employee_monthly_bpjs_amount, payroll_employee_monthly_item.employee_monthly_early_amount, payroll_employee_monthly_item.employee_monthly_overtime_amount, payroll_employee_monthly_item.employee_monthly_total_meal_coupon, payroll_employee_monthly_item.employee_monthly_meal_coupon_amount, payroll_employee_monthly_item.employee_monthly_delivery_amount, payroll_employee_monthly_item.employee_monthly_additional_deduction_amount,  payroll_employee_monthly_item.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly_item');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_location', 'payroll_employee_monthly_item.location_id = core_location.location_id');
			$this->db->join('core_division', 'payroll_employee_monthly_item.division_id = core_division.division_id');
			$this->db->join('core_department', 'payroll_employee_monthly_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'payroll_employee_monthly_item.section_id = core_section.section_id');
			$this->db->join('core_unit', 'payroll_employee_monthly_item.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'payroll_employee_monthly_item.job_title_id = core_job_title.job_title_id');
			$this->db->where('payroll_employee_monthly_item.location_id', $location_id);
			$this->db->where('payroll_employee_monthly_item.employee_monthly_period', $employee_monthly_period);
			$this->db->where('payroll_employee_monthly_item.unit_id', $unit_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeMonthlyAll_Payroll($location_id, $employee_monthly_period){
			$this->db->select('payroll_employee_monthly_item.employee_monthly_id, payroll_employee_monthly_item.employee_id, hro_employee_data.employee_name, payroll_employee_monthly_item.employee_monthly_bank_acct_no, payroll_employee_monthly_item.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly_item');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('payroll_employee_monthly_item.location_id', $location_id);
			$this->db->where('payroll_employee_monthly_item.employee_monthly_period', $employee_monthly_period);
			$this->db->where('payroll_employee_monthly_item.employee_monthly_bank_acct_no <> ', "");
			$result = $this->db->get()->result_array();
			return $result;
		}
	}
?>