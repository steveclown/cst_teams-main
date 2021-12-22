<?php
	class payrolldailyperiod_model extends CI_Model {
		var $table = "payroll_daily_period";
		
		public function payrolldailyperiod_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getPayrollDailyPeriod()
		{
			$this->db->select('payroll_daily_period.daily_period_id, payroll_daily_period.daily_period, payroll_daily_period.daily_period_start_date, payroll_daily_period.daily_period_end_date, payroll_daily_period.daily_period_working_days, payroll_daily_period.daily_period_include_bpjs');
			$this->db->from('payroll_daily_period');
			$this->db->where('data_state', 0);
			$this->db->order_by('payroll_daily_period.daily_period_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function saveNewPayrollDailyPeriod($data){
			return $this->db->insert('payroll_daily_period',$data);
		}
		
		public function getPayrollDailyPeriod_Detail($training_job_title_id){
			$this->db->select('payroll_daily_period.daily_period_id, payroll_daily_period.daily_period, payroll_daily_period.daily_period_start_date, payroll_daily_period.daily_period_end_date, payroll_daily_period.daily_period_working_days, payroll_daily_period.daily_period_include_bpjs');
			$this->db->from('payroll_daily_period');
			$this->db->where('payroll_daily_period.daily_period_id',$training_job_title_id);
			return $this->db->get()->row_array();
		}
		
		public function deletePayrollDailyPeriod($daily_period_id){
			$this->db->where("payroll_daily_period.daily_period_id",$daily_period_id);
			$query = $this->db->update('payroll_daily_period', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		}
?>