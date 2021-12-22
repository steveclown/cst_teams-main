<?php
	class PayrollMonthlyPeriod_model extends CI_Model {
		var $table = "payroll_monthly_period";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getPayrollMonthlyPeriod()
		{
			$this->db->select('payroll_monthly_period.monthly_period_id, payroll_monthly_period.monthly_period, payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date, payroll_monthly_period.monthly_period_working_days');
			$this->db->from('payroll_monthly_period');
			$this->db->where('data_state', 0);
			$this->db->order_by('payroll_monthly_period.monthly_period_id', 'DESC');
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function saveNewPayrollMonthlyPeriod($data){
			return $this->db->insert('payroll_monthly_period',$data);
		}
		
		public function getPayrollMonthlyPeriod_Detail($training_job_title_id){
			$this->db->select('payroll_monthly_period.monthly_period_id, payroll_monthly_period.monthly_period, payroll_monthly_period.monthly_period_start_date, payroll_monthly_period.monthly_period_end_date, payroll_monthly_period.monthly_period_working_days');
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.monthly_period_id',$training_job_title_id);
			return $this->db->get()->row_array();
		}
		
		public function deletePayrollMonthlyPeriod($monthly_period_id){
			$this->db->where("payroll_monthly_period.monthly_period_id",$monthly_period_id);
			$query = $this->db->update('payroll_monthly_period', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		}
?>