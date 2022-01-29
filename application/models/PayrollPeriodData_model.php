<?php
class PayrollPeriodData_model extends CI_Model
{
	var $table = "hro_employee_allowance";

	public function __construct()
	{
		parent::__construct();
		$this->CI = get_instance();
	}

	public function getPayrollPeriod()
	{
		$this->db->select('payroll_period.payroll_period_id, payroll_period.payroll_period');
		$this->db->from('payroll_period');
		$this->db->where('payroll_period.data_state', 0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getCoreJobTitle()
	{
		$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
		$this->db->from('core_job_title');
		$this->db->where('core_job_title.data_state', 0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getCoreAllowance()
	{
		$this->db->select('core_allowance.allowance_id, core_allowance.allowance_name');
		$this->db->from('core_allowance');
		$this->db->where('core_allowance.data_state', 0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getCoreDeduction()
	{
		$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
		$this->db->from('core_deduction');
		$this->db->where('core_deduction.data_state', 0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getCorePremiAttendance()
	{
		$this->db->select('core_premi_attendance.premi_attendance_id, core_premi_attendance.premi_attendance_name');
		$this->db->from('core_premi_attendance');
		$this->db->where('core_premi_attendance.data_state', 0);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getAllowanceName($allowance_id)
	{
		$this->db->select('core_allowance.allowance_name');
		$this->db->from('core_allowance');
		$this->db->where('core_allowance.data_state', 0);
		$this->db->where('core_allowance.allowance_id', $allowance_id);
		$result = $this->db->get()->row_array();
		return $result['allowance_name'];
	}

	public function getDeductionName($deduction_id)
	{
		$this->db->select('core_deduction.deduction_name');
		$this->db->from('core_deduction');
		$this->db->where('core_deduction.data_state', 0);
		$this->db->where('core_deduction.deduction_id', $deduction_id);
		$result = $this->db->get()->row_array();
		return $result['deduction_name'];
	}

	public function getPremiAttendanceName($premi_attendance_id)
	{
		$this->db->select('core_premi_attendance.premi_attendance_name');
		$this->db->from('core_premi_attendance');
		$this->db->where('core_premi_attendance.data_state', 0);
		$this->db->where('core_premi_attendance.premi_attendance_id', $premi_attendance_id);
		$result = $this->db->get()->row_array();
		return $result['premi_attendance_name'];
	}

	public function getJobTitleName($job_title_id)
	{
		$this->db->select('core_job_title.job_title_name');
		$this->db->from('core_job_title');
		$this->db->where('core_job_title.data_state', 0);
		$this->db->where('core_job_title.job_title_id', $job_title_id);
		$result = $this->db->get()->row_array();
		return $result['job_title_name'];
	}

	public function getPayrollPeriod_Period($payroll_period)
	{
		$this->db->select('payroll_period.payroll_period');
		$this->db->from('payroll_period');
		$this->db->where('payroll_period.payroll_period', $payroll_period);
		$result = $this->db->get()->num_rows();
		if ($result > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function insertPayrollPeriod($data)
	{
		return $this->db->insert('payroll_period', $data);
	}

	public function getPayrollPeriodID($created_id)
	{
		$this->db->select('payroll_period.payroll_period_id');
		$this->db->from('payroll_period');
		$this->db->where('payroll_period.created_id', $created_id);
		$this->db->order_by('payroll_period.payroll_period_id', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get()->row_array();
		return $result['payroll_period_id'];
	}

	public function insertPayrollPeriodPayment($data)
	{
		return $this->db->insert('payroll_period_payment', $data);
	}

	public function insertPayrollPeriodAllowance($data)
	{
		return $this->db->insert('payroll_period_allowance', $data);
	}

	public function insertPayrollPeriodDeduction($data)
	{
		return $this->db->insert('payroll_period_deduction', $data);
	}

	public function insertPayrollPeriodAttendance($data)
	{
		return $this->db->insert('payroll_period_attendance', $data);
	}

	public function insertPayrollPeriodBPJS($data)
	{
		return $this->db->insert('payroll_period_bpjs', $data);
	}

	public function insertPayrollPeriodHomeEarly($data)
	{
		return $this->db->insert('payroll_period_home_early', $data);
	}

	public function getPayrollPeriod_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period.payroll_period_id, payroll_period.payroll_period');
		$this->db->from('payroll_period');
		$this->db->where('payroll_period.data_state', 0);
		$this->db->where('payroll_period.payroll_period_id', $payroll_period_id);
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function getPayrollPeriodPayment_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period_payment.period_payment_id, payroll_period_payment.payroll_period_id, payroll_period_payment.job_title_id, payroll_period_payment.period_payment_period, payroll_period_payment.period_payment_working_start, payroll_period_payment.period_payment_working_end, payroll_period_payment.basic_salary_monthly, payroll_period_payment.basic_salary_daily, payroll_period_payment.basic_overtime, payroll_period_payment.meal_subvention_monthly, payroll_period_payment.meal_subvention_daily, payroll_period_payment.employee_employment_status');
		$this->db->from('payroll_period_payment');
		$this->db->where('payroll_period_payment.data_state', 0);
		$this->db->where('payroll_period_payment.payroll_period_id', $payroll_period_id);
		$this->db->order_by('payroll_period_payment.job_title_id', 'DESC');
		$this->db->order_by('payroll_period_payment.period_payment_id', 'DESC');
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getPayrollPeriodAllowance_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period_allowance.period_allowance_id, payroll_period_allowance.payroll_period_id, payroll_period_allowance.allowance_id, core_allowance.allowance_name, payroll_period_allowance.period_allowance_period, payroll_period_allowance.period_allowance_working_start, payroll_period_allowance.period_allowance_working_end, payroll_period_allowance.period_allowance_description, payroll_period_allowance.period_allowance_amount_daily, payroll_period_allowance.period_allowance_amount_monthly, payroll_period_allowance.employee_employment_status');
		$this->db->from('payroll_period_allowance');
		$this->db->join('core_allowance', 'payroll_period_allowance.allowance_id = core_allowance.allowance_id');
		$this->db->where('payroll_period_allowance.data_state', 0);
		$this->db->where('payroll_period_allowance.payroll_period_id', $payroll_period_id);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getPayrollPeriodDeduction_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period_deduction.period_deduction_id, payroll_period_deduction.payroll_period_id, payroll_period_deduction.deduction_id, core_deduction.deduction_name, payroll_period_deduction.period_deduction_period, payroll_period_deduction.period_deduction_working_start, payroll_period_deduction.period_deduction_working_end, payroll_period_deduction.period_deduction_description, payroll_period_deduction.period_deduction_amount_daily, payroll_period_deduction.period_deduction_amount_monthly, payroll_period_deduction.employee_employment_status');
		$this->db->from('payroll_period_deduction');
		$this->db->join('core_deduction', 'payroll_period_deduction.deduction_id = core_deduction.deduction_id');
		$this->db->where('payroll_period_deduction.data_state', 0);
		$this->db->where('payroll_period_deduction.payroll_period_id', $payroll_period_id);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getPayrollPeriodAttendance_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period_attendance.period_attendance_id, payroll_period_attendance.payroll_period_id, payroll_period_attendance.premi_attendance_id, core_premi_attendance.premi_attendance_name, payroll_period_attendance.period_attendance_period, payroll_period_attendance.period_attendance_working_start, payroll_period_attendance.period_attendance_working_end, payroll_period_attendance.period_attendance_description, payroll_period_attendance.period_attendance_amount_daily, payroll_period_attendance.period_attendance_amount_monthly, payroll_period_attendance.employee_employment_status');
		$this->db->from('payroll_period_attendance');
		$this->db->join('core_premi_attendance', 'payroll_period_attendance.premi_attendance_id = core_premi_attendance.premi_attendance_id');
		$this->db->where('payroll_period_attendance.data_state', 0);
		$this->db->where('payroll_period_attendance.payroll_period_id', $payroll_period_id);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getPayrollPeriodBPJS_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period_bpjs.period_bpjs_id, payroll_period_bpjs.payroll_period_id, payroll_period_bpjs.period_bpjs_period, payroll_period_bpjs.period_bpjs_working_start, payroll_period_bpjs.period_bpjs_working_end, payroll_period_bpjs.period_bpjs_kesehatan_amount, payroll_period_bpjs.period_bpjs_tenagakerja_amount, payroll_period_bpjs.bpjs_tenagakerja_subvention_monthly, payroll_period_bpjs.bpjs_tenagakerja_subvention_daily, payroll_period_bpjs.employee_employment_status');
		$this->db->from('payroll_period_bpjs');
		$this->db->where('payroll_period_bpjs.data_state', 0);
		$this->db->where('payroll_period_bpjs.payroll_period_id', $payroll_period_id);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function getPayrollPeriodHomeEarly_Detail($payroll_period_id)
	{
		$this->db->select('payroll_period_home_early.period_home_early_id, payroll_period_home_early.payroll_period_id, payroll_period_home_early.period_home_early_period, payroll_period_home_early.period_home_early_hour_start, payroll_period_home_early.period_home_early_hour_end, payroll_period_home_early.employee_attendance_incentive_status, payroll_period_home_early.employee_employment_status');
		$this->db->from('payroll_period_home_early');
		$this->db->where('payroll_period_home_early.data_state', 0);
		$this->db->where('payroll_period_home_early.payroll_period_id', $payroll_period_id);
		$result = $this->db->get()->result_array();
		return $result;
	}

	public function deletePayrollPeriodPayment($data)
	{
		$this->db->where('payroll_period_payment.period_payment_id', $data['period_payment_id']);
		$query = $this->db->update('payroll_period_payment', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePayrollPeriodAllowance($data)
	{
		$this->db->where('payroll_period_allowance.period_allowance_id', $data['period_allowance_id']);
		$query = $this->db->update('payroll_period_allowance', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePayrollPeriodDeduction($data)
	{
		$this->db->where('payroll_period_deduction.period_deduction_id', $data['period_deduction_id']);
		$query = $this->db->update('payroll_period_deduction', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePayrollPeriodAttendance($data)
	{
		$this->db->where('payroll_period_attendance.period_attendance_id', $data['period_attendance_id']);
		$query = $this->db->update('payroll_period_attendance', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePayrollPeriodBPJS($data)
	{
		$this->db->where('payroll_period_bpjs.period_bpjs_id', $data['period_bpjs_id']);
		$query = $this->db->update('payroll_period_bpjs', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function deletePayrollPeriodHomeEarly($data)
	{
		$this->db->where('payroll_period_home_early.period_home_early_id', $data['period_home_early_id']);
		$query = $this->db->update('payroll_period_home_early', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
}
