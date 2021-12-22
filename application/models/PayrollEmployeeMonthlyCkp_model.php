<?php
	class PayrollEmployeeMonthlyCkp_model extends CI_Model {
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
			$this->db->limit(3);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeMonthly($region_id, $branch_id, $location_id, $employee_shift_id, $employee_monthly_period){
			$this->db->select('payroll_employee_monthly.employee_monthly_id, payroll_employee_monthly.employee_shift_id, schedule_employee_shift.employee_shift_code, payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date');
			$this->db->from('payroll_employee_monthly');
			$this->db->join('schedule_employee_shift', 'payroll_employee_monthly.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('payroll_employee_monthly.data_state', 0);
			$this->db->where('payroll_employee_monthly.region_id', $region_id);
			$this->db->where('payroll_employee_monthly.branch_id', $branch_id);
			$this->db->where('payroll_employee_monthly.location_id', $location_id);

			if ($employee_shift_id != ''){
				$this->db->where('payroll_employee_monthly.employee_shift_id', $employee_shift_id);
			}

			if ($employee_monthly_period != ''){
				$this->db->where('payroll_employee_monthly.employee_monthly_period', $employee_monthly_period);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPreferenceCompany(){
			$this->db->select('preference_company.job_title_id_payroll, preference_company.basic_salary_deduction, preference_company.working_days_default, preference_company.job_title_id_driver, preference_company.employee_delivery_amount_driver, preference_company.job_title_id_pu, preference_company.employee_delivery_amount_pu, preference_company.employee_meal_coupon_subvention');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollEmployeeMonthly_Attendance($employee_shift_id, $employee_monthly_period){
			$this->db->select('payroll_employee_monthly.employee_monthly_id');
			$this->db->from('payroll_employee_monthly');
			
			if ($employee_shift_id != ''){
				$this->db->where('payroll_employee_monthly.employee_shift_id', $employee_shift_id);
			}
			$this->db->where('payroll_employee_monthly.employee_monthly_period', $employee_monthly_period);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeAttendanceTotal_Monthly($region_id, $branch_id, $location_id, $employee_shift_id, $employee_monthly_period){
			$this->db->select('hro_employee_attendance_total.employee_attendance_total_id, hro_employee_attendance_total.employee_shift_id, hro_employee_attendance_total_item.employee_id, hro_employee_attendance_total_item.division_id, hro_employee_attendance_total_item.department_id,  hro_employee_attendance_total_item.section_id, hro_employee_attendance_total_item.unit_id, hro_employee_attendance_total_item.job_title_id, hro_employee_attendance_total_item.bank_id, hro_employee_attendance_total_item.employee_bank_acct_no, hro_employee_attendance_total_item.employee_bank_acct_name, hro_employee_attendance_total_item.employee_monthly_period, hro_employee_attendance_total_item.employee_monthly_start_date, hro_employee_attendance_total_item.employee_monthly_end_date, hro_employee_attendance_total_item.employee_employment_status, hro_employee_attendance_total_item.employee_hire_date, hro_employee_attendance_total_item.employee_working_months, hro_employee_attendance_total_item.total_working_days, hro_employee_attendance_total_item.total_working_payroll_days, hro_employee_attendance_total_item.total_working_off_payroll_days, hro_employee_attendance_total_item.total_default_payroll_days, hro_employee_attendance_total_item.total_permit_with_doctor_days, hro_employee_attendance_total_item.total_permit_with_doctor_payroll_days, hro_employee_attendance_total_item.total_permit_no_doctor_days, hro_employee_attendance_total_item.total_permit_no_doctor_payroll_days, hro_employee_attendance_total_item.total_absence_payroll_days, hro_employee_attendance_total_item.total_cancel_off_payrol_days, hro_employee_attendance_total_item.total_swap_off_payroll_days, hro_employee_attendance_total_item.total_early_days, hro_employee_attendance_total_item.total_early_payroll_less_1_days, hro_employee_attendance_total_item.total_early_payroll_less_5_days, hro_employee_attendance_total_item.total_early_payroll_more_5_days, hro_employee_attendance_total_item.total_early_hours_list, hro_employee_attendance_total_item.total_late_days, hro_employee_attendance_total_item.total_late_hours, hro_employee_attendance_total_item.total_late_minutes, hro_employee_attendance_total_item.total_overtime_days, hro_employee_attendance_total_item.total_overtime_hours, hro_employee_attendance_total_item.total_overtime_minutes, hro_employee_attendance_total_item.total_overtime_hours_list');
			$this->db->from('hro_employee_attendance_total');
			$this->db->join('hro_employee_attendance_total_item', 'hro_employee_attendance_total.employee_attendance_total_id = hro_employee_attendance_total_item.employee_attendance_total_id');
			$this->db->join('hro_employee_data', 'hro_employee_attendance_total_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_attendance_total.region_id', $region_id);
			$this->db->where('hro_employee_attendance_total.branch_id', $branch_id);
			$this->db->where('hro_employee_attendance_total.location_id', $location_id);

			if ($employee_shift_id != ''){
				$this->db->where('hro_employee_attendance_total.employee_shift_id', $employee_shift_id);
			}

			$this->db->where('hro_employee_attendance_total.employee_monthly_period', $employee_monthly_period);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollPeriodPayment($employee_months, $employee_employment_status){
			$this->db->select('payroll_period_payment.period_payment_period, payroll_period_payment.period_payment_working_start, payroll_period_payment.period_payment_working_end, payroll_period_payment.basic_salary_monthly, payroll_period_payment.basic_salary_daily, payroll_period_payment.basic_overtime, payroll_period_payment.employee_employment_status');
			$this->db->from('payroll_period_payment');
			$this->db->where('payroll_period_payment.period_payment_working_start <=', $employee_months);
			$this->db->where('payroll_period_payment.period_payment_working_end >=', $employee_months);
			$this->db->where('payroll_period_payment.employee_employment_status', $employee_employment_status);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollPeriodAttendance($employee_months, $employee_employment_status){
			$this->db->select('payroll_period_attendance.period_attendance_period, payroll_period_attendance.period_attendance_working_start, payroll_period_attendance.period_attendance_working_end, payroll_period_attendance.period_attendance_amount_monthly, payroll_period_attendance.period_attendance_amount_daily, payroll_period_attendance.employee_employment_status, payroll_period_attendance.period_attendance_amount_monthly1, payroll_period_attendance.period_attendance_amount_daily1');
			$this->db->from('payroll_period_attendance');
			$this->db->where('payroll_period_attendance.period_attendance_working_start <=', $employee_months);
			$this->db->where('payroll_period_attendance.period_attendance_working_end >=', $employee_months);
			$this->db->where('payroll_period_attendance.employee_employment_status', $employee_employment_status);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollPeriodAllowance($employee_months, $employee_employment_status){
			$this->db->select('payroll_period_allowance.period_allowance_period, payroll_period_allowance.period_allowance_working_start, payroll_period_allowance.period_allowance_working_end, payroll_period_allowance.period_allowance_amount_monthly, payroll_period_allowance.period_allowance_amount_daily, payroll_period_allowance.employee_employment_status');
			$this->db->from('payroll_period_allowance');
			$this->db->where('payroll_period_allowance.period_allowance_working_start <=', $employee_months);
			$this->db->where('payroll_period_allowance.period_allowance_working_end >=', $employee_months);
			$this->db->where('payroll_period_allowance.employee_employment_status', $employee_employment_status);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollEmployeeAllowance($employee_id, $employee_allowance_period){
			$this->db->select('payroll_employee_allowance.employee_allowance_id, payroll_employee_allowance.employee_id, payroll_employee_allowance.employee_allowance_period, payroll_employee_allowance.allowance_id, core_allowance.allowance_type, payroll_employee_allowance.employee_allowance_amount');
			$this->db->from('payroll_employee_allowance');
			$this->db->join('core_allowance', 'payroll_employee_allowance.allowance_id = core_allowance.allowance_id');
			$this->db->where('payroll_employee_allowance.employee_id', $employee_id);
			$this->db->where('payroll_employee_allowance.employee_allowance_period', $employee_allowance_period);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeBPJS($employee_id, $employee_bpjs_period){
			$this->db->select('payroll_employee_bpjs.employee_id, payroll_employee_bpjs.employee_bpjs_period, payroll_employee_bpjs.bpjs_total_amount');
			$this->db->from('payroll_employee_bpjs');
			$this->db->where('payroll_employee_bpjs.employee_id', $employee_id);
			$this->db->where('payroll_employee_bpjs.employee_bpjs_period', $employee_bpjs_period);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollEmployeeDelivery($employee_id, $start_date, $end_date){
			$this->db->select('payroll_employee_delivery.employee_delivery_id, payroll_employee_delivery.job_title_id, payroll_employee_delivery.employee_delivery_date, payroll_employee_delivery.employee_delivery_days, payroll_employee_delivery.employee_delivery_status');
			$this->db->from('payroll_employee_delivery');
			$this->db->where('payroll_employee_delivery.employee_id', $employee_id);
			$this->db->where('payroll_employee_delivery.employee_delivery_date >=', $start_date);
			$this->db->where('payroll_employee_delivery.employee_delivery_date <=', $end_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeAdditionalDeduction($employee_id, $start_date, $end_date){
			$this->db->select('payroll_employee_additional_deduction.employee_additional_deduction_id, payroll_employee_additional_deduction.employee_id, payroll_employee_additional_deduction.deduction_id, payroll_employee_additional_deduction.employee_additional_deduction_date, payroll_employee_additional_deduction.employee_additional_deduction_description, payroll_employee_additional_deduction.employee_additional_deduction_amount');
			$this->db->from('payroll_employee_additional_deduction');
			$this->db->where('payroll_employee_additional_deduction.employee_id', $employee_id);
			$this->db->where('payroll_employee_additional_deduction.employee_additional_deduction_date >=', $start_date);
			$this->db->where('payroll_employee_additional_deduction.employee_additional_deduction_date <=', $end_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeAdditionalOvertime($employee_id, $start_date, $end_date){
			$this->db->select('payroll_employee_additional_overtime.employee_additional_overtime_id, payroll_employee_additional_overtime.employee_id, payroll_employee_additional_overtime.overtime_type_id, payroll_employee_additional_overtime.employee_additional_overtime_date, payroll_employee_additional_overtime.employee_additional_overtime_description, payroll_employee_additional_overtime.employee_additional_overtime_amount');
			$this->db->from('payroll_employee_additional_overtime');
			$this->db->where('payroll_employee_additional_overtime.employee_id', $employee_id);
			$this->db->where('payroll_employee_additional_overtime.employee_additional_overtime_date >=', $start_date);
			$this->db->where('payroll_employee_additional_overtime.employee_additional_overtime_date <=', $end_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeMealCoupon($employee_id, $start_date, $end_date){
			$this->db->select('COUNT(*) AS total_meal_coupon');
			$this->db->from('hro_employee_meal_coupon');
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date >=', $start_date);
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date <=', $end_date);
			$this->db->where('hro_employee_meal_coupon.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollPeriodService($employee_months, $employee_employment_status){
			$this->db->select('payroll_period_service.period_service_period, payroll_period_service.period_service_working_start, payroll_period_service.period_service_working_end, payroll_period_service.period_service_amount_monthly, payroll_period_service.period_service_amount_daily, payroll_period_service.employee_employment_status');
			$this->db->from('payroll_period_service');
			$this->db->where('payroll_period_service.period_service_working_start <=', $employee_months);
			$this->db->where('payroll_period_service.period_service_working_end >=', $employee_months);
			$this->db->where('payroll_period_service.employee_employment_status', $employee_employment_status);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getUnitName($unit_id){
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$result = $this->db->get()->row_array();
			return $result['unit_name'];
		}

		public function getJobTitleName($job_title_id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $job_title_id);
			$result = $this->db->get()->row_array();
			return $result['job_title_name'];
		}	

		public function insertPayrollEmployeeMonthly($data){
			return $this->db->insert('payroll_employee_monthly',$data);
		}	

		public function getEmployeeMonthlyID($created_id){
			$this->db->select('payroll_employee_monthly.employee_monthly_id');
			$this->db->from('payroll_employee_monthly');
			$this->db->where('payroll_employee_monthly.created_id', $created_id);
			$this->db->order_by('payroll_employee_monthly.employee_monthly_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_monthly_id'];
		}	

		public function insertPayrollEmployeeMonthlyItem($data){
			return $this->db->insert('payroll_employee_monthly_item',$data);
		}

		public function insertPayrollEmployeeMonthlyDelivery($data){
			return $this->db->insert('payroll_employee_monthly_delivery',$data);
		}

		public function insertPayrollEmployeeMonthlyAdditionalDeduction($data){
			return $this->db->insert('payroll_employee_monthly_additional_deduction',$data);
		}

		public function insertPayrollEmployeeMonthlyAdditionalOvertime($data){
			return $this->db->insert('payroll_employee_monthly_additional_overtime',$data);
		}

		public function insertPayrollEmployeeMonthlyAllowance($data){
			return $this->db->insert('payroll_employee_monthly_allowance',$data);
		}

		public function getPayrollEmployeeMonthly_Detail($employee_monthly_id){
			$this->db->select('payroll_employee_monthly.employee_monthly_id, payroll_employee_monthly.region_id, payroll_employee_monthly.branch_id, payroll_employee_monthly.location_id, payroll_employee_monthly.employee_shift_id, schedule_employee_shift.employee_shift_code, payroll_employee_monthly.employee_monthly_period, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date');
			$this->db->from('payroll_employee_monthly');
			$this->db->join('schedule_employee_shift', 'payroll_employee_monthly.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('payroll_employee_monthly.employee_monthly_id', $employee_monthly_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPayrollEmployeeMonthlyItem_Detail($employee_monthly_id){
			$this->db->select('payroll_employee_monthly_item.employee_monthly_id, payroll_employee_monthly_item.employee_id, hro_employee_data.employee_name, payroll_employee_monthly_item.division_id, core_division.division_name, payroll_employee_monthly_item.department_id, core_department.department_name, payroll_employee_monthly_item.section_id, core_section.section_name, payroll_employee_monthly_item.unit_id, core_unit.unit_name, payroll_employee_monthly_item.job_title_id, core_job_title.job_title_name, payroll_employee_monthly_item.bank_id, core_bank.bank_name, payroll_employee_monthly_item.employee_monthly_period, payroll_employee_monthly_item.employee_monthly_start_date, payroll_employee_monthly_item.employee_monthly_end_date, payroll_employee_monthly_item.employee_employment_status, payroll_employee_monthly_item.employee_hire_date, payroll_employee_monthly_item.employee_working_months, payroll_employee_monthly_item.employee_monthly_bank_acct_name, payroll_employee_monthly_item.employee_monthly_bank_acct_no, payroll_employee_monthly_item.employee_monthly_total_working_days, payroll_employee_monthly_item.employee_monthly_basic_salary, payroll_employee_monthly_item.employee_monthly_working_days, payroll_employee_monthly_item.employee_monthly_allowance_amount, payroll_employee_monthly_item.employee_monthly_attendance_amount, payroll_employee_monthly_item.employee_monthly_service_amount, payroll_employee_monthly_item.employee_monthly_bpjs_amount, payroll_employee_monthly_item.employee_monthly_early_amount, payroll_employee_monthly_item.employee_monthly_overtime_amount, payroll_employee_monthly_item.employee_monthly_total_meal_coupon, payroll_employee_monthly_item.employee_monthly_meal_coupon_amount, payroll_employee_monthly_item.employee_monthly_delivery_amount, payroll_employee_monthly_item.employee_monthly_additional_deduction_amount, payroll_employee_monthly_item.employee_monthly_additional_overtime_amount,    payroll_employee_monthly_item.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly_item');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_division', 'payroll_employee_monthly_item.division_id = core_division.division_id');
			$this->db->join('core_department', 'payroll_employee_monthly_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'payroll_employee_monthly_item.section_id = core_section.section_id');
			$this->db->join('core_unit', 'payroll_employee_monthly_item.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'payroll_employee_monthly_item.job_title_id = core_job_title.job_title_id');
			$this->db->join('core_bank', 'payroll_employee_monthly_item.bank_id = core_bank.bank_id');
			$this->db->where('payroll_employee_monthly_item.employee_monthly_id', $employee_monthly_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeMonthlyAll_Detail($employee_monthly_id){
			$this->db->select('payroll_employee_monthly.employee_monthly_id, payroll_employee_monthly.employee_shift_id, schedule_employee_shift.employee_shift_code, payroll_employee_monthly.location_id, core_location.location_name, payroll_employee_monthly.employee_monthly_start_date, payroll_employee_monthly.employee_monthly_end_date, payroll_employee_monthly_item.employee_id, hro_employee_data.employee_name, payroll_employee_monthly_item.division_id, core_division.division_name, payroll_employee_monthly_item.department_id, core_department.department_name, payroll_employee_monthly_item.section_id, core_section.section_name, payroll_employee_monthly_item.unit_id, core_unit.unit_name, payroll_employee_monthly_item.job_title_id, core_job_title.job_title_name, payroll_employee_monthly_item.bank_id, core_bank.bank_name, payroll_employee_monthly_item.employee_monthly_period, payroll_employee_monthly_item.employee_monthly_start_date, payroll_employee_monthly_item.employee_monthly_end_date, payroll_employee_monthly_item.employee_employment_status, payroll_employee_monthly_item.employee_hire_date, payroll_employee_monthly_item.employee_working_months, payroll_employee_monthly_item.employee_monthly_bank_acct_name, payroll_employee_monthly_item.employee_monthly_bank_acct_no, payroll_employee_monthly_item.employee_monthly_total_working_days, payroll_employee_monthly_item.employee_monthly_basic_salary, payroll_employee_monthly_item.employee_monthly_working_days, payroll_employee_monthly_item.employee_monthly_allowance_amount, payroll_employee_monthly_item.employee_monthly_attendance_amount, payroll_employee_monthly_item.employee_monthly_service_amount, payroll_employee_monthly_item.employee_monthly_bpjs_amount, payroll_employee_monthly_item.employee_monthly_early_amount, payroll_employee_monthly_item.employee_monthly_overtime_amount, payroll_employee_monthly_item.employee_monthly_delivery_amount, payroll_employee_monthly_item.employee_monthly_additional_deduction_amount,  payroll_employee_monthly_item.employee_monthly_salary_total');
			$this->db->from('payroll_employee_monthly');
			$this->db->join('payroll_employee_monthly_item', 'payroll_employee_monthly.employee_monthly_id = payroll_employee_monthly.employee_monthly_id');
			$this->db->join('schedule_employee_shift', 'payroll_employee_monthly.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_location', 'payroll_employee_monthly.location_id = core_location.location_id');
			$this->db->join('hro_employee_data', 'payroll_employee_monthly_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_division', 'payroll_employee_monthly_item.division_id = core_division.division_id');
			$this->db->join('core_department', 'payroll_employee_monthly_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'payroll_employee_monthly_item.section_id = core_section.section_id');
			$this->db->join('core_unit', 'payroll_employee_monthly_item.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'payroll_employee_monthly_item.job_title_id = core_job_title.job_title_id');
			$this->db->join('core_bank', 'payroll_employee_monthly_item.bank_id = core_bank.bank_id');
			$this->db->where('payroll_employee_monthly_item.employee_monthly_id', $employee_monthly_id);
			/*$this->db->limit(100);*/
			$result = $this->db->get()->result_array();
			return $result;
		}
	}
?>