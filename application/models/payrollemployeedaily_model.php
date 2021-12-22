<?php
	class payrollemployeedaily_model extends CI_Model {
		var $table = "hro_employee_allowance";
		
		public function payrollemployeedaily_model(){
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
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_hire_date');
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

		public function getHROEmployeeData_Daily($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_hire_date');
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

		public function getCoreAllowance(){
			$this->db->select('core_allowance.allowance_id, core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getAllowanceName($allowance_id){
			$this->db->select('core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.allowance_id', $allowance_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['allowance_name'];
		}

		public function getPayrollDailyPeriod(){
			$this->db->select('payroll_daily_period.daily_period_id, payroll_daily_period.daily_period, payroll_daily_period.daily_period_start_date, payroll_daily_period.daily_period_end_date, payroll_daily_period.daily_period_working_days, payroll_daily_period.daily_period_include_bpjs');
			$this->db->from('payroll_daily_period');
			$this->db->order_by('payroll_daily_period.daily_period_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result;
		}

		public function getPayrollEmployeePayment($employee_id){
			$this->db->select('payroll_employee_payment.employee_payment_id, payroll_employee_payment.employee_id, payroll_employee_payment.bank_id, payroll_employee_payment.payment_basic_salary, payroll_employee_payment.payment_basic_overtime, payroll_employee_payment.payment_bank_acct_no, payroll_employee_payment.payment_bank_acct_name, payroll_employee_payment.payment_home_early_status, payroll_employee_payment.payment_home_early_amount');
			$this->db->from('payroll_employee_payment');
			$this->db->where('payroll_employee_payment.data_state',0);
			$this->db->where('payroll_employee_payment.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_payment.employee_payment_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result;
		}

		public function getBankName($bank_id){
			$this->db->select('core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.bank_id', $bank_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['bank_name'];
		}

		public function getPayrollEmployeeBPJS($employee_id){
			$this->db->select('payroll_employee_bpjs.employee_bpjs_id, payroll_employee_bpjs.bpjs_total_amount');
			$this->db->from('payroll_employee_bpjs');
			$this->db->where('payroll_employee_bpjs.data_state',0);
			$this->db->where('payroll_employee_bpjs.bpjs_out_status',1);
			$this->db->where('payroll_employee_bpjs.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_bpjs.employee_bpjs_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result;
		}

		public function getPayrollLeaveRequest($employee_id, $start_date, $end_date){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, payroll_leave_request.annual_leave_id, payroll_leave_request_detail.leave_request_detail_id,  payroll_leave_request_detail.leave_request_detail_date, payroll_leave_request.leave_request_description');
			$this->db->from('payroll_leave_request');
			$this->db->join('payroll_leave_request_detail', 'payroll_leave_request.leave_request_id = payroll_leave_request_detail.leave_request_id');
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->where('payroll_leave_request.leave_request_approved', 1);
			$this->db->where('payroll_leave_request.employee_id', $employee_id);
			$this->db->where('payroll_leave_request_detail.leave_request_detail_date >=', $start_date);
			$this->db->where('payroll_leave_request_detail.leave_request_detail_date <=', $end_date);
			$this->db->order_by('payroll_leave_request.leave_request_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROmployeeWorkingDayOff($employee_id, $start_date, $end_date){
			$this->db->select('hro_employee_working_dayoff.employee_working_dayoff_id, hro_employee_working_dayoff.employee_id, hro_employee_working_dayoff.dayoff_id, hro_employee_working_dayoff.employee_working_dayoff_description, hro_employee_working_dayoff_detail.working_dayoff_detail_date, hro_employee_working_dayoff_detail.working_dayoff_detail_id');
			$this->db->from('hro_employee_working_dayoff');
			$this->db->join('hro_employee_working_dayoff_detail', 'hro_employee_working_dayoff.employee_working_dayoff_id = hro_employee_working_dayoff_detail.employee_working_dayoff_id');
			$this->db->where('hro_employee_working_dayoff.data_state',0);
			$this->db->where('hro_employee_working_dayoff.employee_id', $employee_id);
			$this->db->where('hro_employee_working_dayoff_detail.working_dayoff_detail_date >=', $start_date);
			$this->db->where('hro_employee_working_dayoff_detail.working_dayoff_detail_date <=', $end_date);
			$this->db->order_by('hro_employee_working_dayoff.employee_working_dayoff_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeAbsence($employee_id, $start_date, $end_date){
			$this->db->select('hro_employee_absence.employee_absence_id, hro_employee_absence.absence_id, hro_employee_absence.employee_id, hro_employee_absence.employee_absence_description, hro_employee_absence_detail.employee_absence_detail_id, hro_employee_absence_detail.employee_absence_detail_date');
			$this->db->from('hro_employee_absence');
			$this->db->join('hro_employee_absence_detail', 'hro_employee_absence.employee_absence_id = hro_employee_absence_detail.employee_absence_id');
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->where('hro_employee_absence.employee_id', $employee_id);
			$this->db->where('hro_employee_absence_detail.employee_absence_detail_date >=', $start_date);
			$this->db->where('hro_employee_absence_detail.employee_absence_detail_date <=', $end_date);
			$this->db->order_by('hro_employee_absence.employee_absence_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeePermit($employee_id, $start_date, $end_date){
			$this->db->select('hro_employee_permit.employee_permit_id, hro_employee_permit.permit_id, hro_employee_permit.employee_id, 
				hro_employee_permit.permit_type, hro_employee_permit.deduction_type, hro_employee_permit.employee_permit_description, hro_employee_permit_detail.employee_permit_detail_id, hro_employee_permit_detail.employee_permit_detail_date');
			$this->db->from('hro_employee_permit');
			$this->db->join('hro_employee_permit_detail', 'hro_employee_permit.employee_permit_id = hro_employee_permit_detail.employee_permit_id');
			$this->db->where('hro_employee_permit.data_state',0);
			$this->db->where('hro_employee_permit.employee_id', $employee_id);
			$this->db->where('hro_employee_permit_detail.employee_permit_detail_date >=', $start_date);
			$this->db->where('hro_employee_permit_detail.employee_permit_detail_date <=', $end_date);
			$this->db->order_by('hro_employee_permit.employee_permit_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeLate($employee_id, $start_date, $end_date){
			$this->db->select('hro_employee_late.employee_late_id, hro_employee_late.late_id, hro_employee_late.employee_id, 
				hro_employee_late.employee_late_description, hro_employee_late.employee_late_date, hro_employee_late.employee_late_duration');
			$this->db->from('hro_employee_late');
			$this->db->where('hro_employee_late.data_state',0);
			$this->db->where('hro_employee_late.employee_id', $employee_id);
			$this->db->where('hro_employee_late.employee_late_date >=', $start_date);
			$this->db->where('hro_employee_late.employee_late_date <=', $end_date);
			$this->db->order_by('hro_employee_late.employee_late_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getPayrollOvertimeRequest($employee_id, $start_date, $end_date){
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.overtime_type_id, payroll_overtime_request.employee_id, 
				payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_duration');
			$this->db->from('payroll_overtime_request');
			$this->db->where('payroll_overtime_request.data_state',0);
			$this->db->where('payroll_overtime_request.overtime_request_approved', 1);
			$this->db->where('payroll_overtime_request.employee_id', $employee_id);
			$this->db->where('payroll_overtime_request.overtime_request_date >=', $start_date);
			$this->db->where('payroll_overtime_request.overtime_request_date <=', $end_date);
			$this->db->order_by('payroll_overtime_request.overtime_request_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeHomeEarlyDaily($employee_id, $start_date, $end_date){
			$this->db->select('hro_employee_home_early_daily.employee_home_early_daily_id, hro_employee_home_early_daily.employee_id, 
				hro_employee_home_early_daily.employee_home_early_daily_date, hro_employee_home_early_daily.employee_home_early_daily_hour, hro_employee_home_early_daily.employee_home_early_daily_description');
			$this->db->from('hro_employee_home_early_daily');
			$this->db->where('hro_employee_home_early_daily.data_state',0);
			$this->db->where('hro_employee_home_early_daily.employee_id', $employee_id);
			$this->db->where('hro_employee_home_early_daily.employee_home_early_daily_date >=', $start_date);
			$this->db->where('hro_employee_home_early_daily.employee_home_early_daily_date <=', $end_date);
			$this->db->order_by('hro_employee_home_early_daily.employee_home_early_daily_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}


		public function getPayrollEmployeeAllowance($employee_id, $employee_allowance_period){
			$this->db->select('payroll_employee_allowance.employee_allowance_id, payroll_employee_allowance.employee_id, payroll_employee_allowance.allowance_id, payroll_employee_allowance.employee_allowance_period, payroll_employee_allowance.employee_allowance_amount, core_allowance.allowance_type');
			$this->db->from('payroll_employee_allowance');
			$this->db->join('core_allowance', 'payroll_employee_allowance.allowance_id = core_allowance.allowance_id');
			$this->db->where('payroll_employee_allowance.data_state',0);
			$this->db->where('payroll_employee_allowance.employee_id', $employee_id);
			$this->db->where('payroll_employee_allowance.employee_allowance_period', $employee_allowance_period);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getPayrollEmployeeDeduction($employee_id, $employee_deduction_period){
			$this->db->select('payroll_employee_deduction.employee_deduction_id, payroll_employee_deduction.employee_id, payroll_employee_deduction.deduction_id, payroll_employee_deduction.employee_deduction_period, payroll_employee_deduction.employee_deduction_amount, core_deduction.deduction_type');
			$this->db->from('payroll_employee_deduction');
			$this->db->join('core_deduction', 'payroll_employee_deduction.deduction_id = core_deduction.deduction_id');
			$this->db->where('payroll_employee_deduction.data_state',0);
			$this->db->where('payroll_employee_deduction.employee_id', $employee_id);
			$this->db->where('payroll_employee_deduction.employee_deduction_period', $employee_deduction_period);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getAnnualLeaveName($annual_leave_id){
			$this->db->select('core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.annual_leave_id', $annual_leave_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['annual_leave_name'];
		}

		public function getAbsenceName($absence_id){
			$this->db->select('core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.absence_id', $absence_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['absence_name'];
		}

		public function getPermitName($permit_id){
			$this->db->select('core_permit.permit_name');
			$this->db->from('core_permit');
			$this->db->where('core_permit.permit_id', $permit_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['permit_name'];
		}

		public function getDayOffName($dayoff_id){
			$this->db->select('core_dayoff.dayoff_name');
			$this->db->from('core_dayoff');
			$this->db->where('core_dayoff.dayoff_id', $dayoff_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['dayoff_name'];
		}

		public function getLateName($late_id){
			$this->db->select('core_late.late_name');
			$this->db->from('core_late');
			$this->db->where('core_late.late_id', $late_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['late_name'];
		}

		public function getOvertimeTypeName($overtime_type_id){
			$this->db->select('core_overtime_type.overtime_type_name');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.overtime_type_id', $overtime_type_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['overtime_type_name'];
		}

		public function getDeductionName($deduction_id){
			$this->db->select('core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.deduction_id', $deduction_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['deduction_name'];
		}

		public function getPaymentBasicOvertime($employee_id, $employee_payment_period){
			$this->db->select('payroll_employee_payment.payment_basic_overtime');
			$this->db->from('payroll_employee_payment');
			$this->db->where('payroll_employee_payment.employee_id', $employee_id);
			$this->db->where('payroll_employee_payment.data_state',0);
			$this->db->where('payroll_employee_payment.employee_payment_period', $employee_payment_period);
			$this->db->order_by('payroll_employee_payment.employee_payment_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['payment_basic_overtime'];
		}

		public function getDayOffDate($dayoff_date){
			$this->db->select('schedule_day_off.day_off_id');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.day_off_start_date <=', $dayoff_date);
			$this->db->where('schedule_day_off.day_off_end_date >=', $dayoff_date);
			$this->db->where('schedule_day_off.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreOvertimeType(){
			$this->db->select('core_overtime_type.overtime_type_working_day_hour1, core_overtime_type.overtime_type_working_day_ratio1, core_overtime_type.overtime_type_working_day_hour2, core_overtime_type.overtime_type_working_day_ratio2, core_overtime_type.overtime_type_day_off_hour1, core_overtime_type.overtime_type_day_off_ratio1, core_overtime_type.overtime_type_day_off_hour2, core_overtime_type.overtime_type_day_off_ratio2');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.data_state',0);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getCompanyHomeEarlyMinimumHour(){
			$this->db->select('preference_company.company_home_early_minimum_hour');
			$this->db->from('preference_company');
			$result=$this->db->get()->row_array();
			return $result['company_home_early_minimum_hour'];
		}

		public function getEmployeeDailyID($created_on, $created_id){
			$this->db->select('payroll_employee_daily.employee_daily_id');
			$this->db->from('payroll_employee_daily');
			$this->db->where('payroll_employee_daily.created_on', $created_on);
			$this->db->where('payroll_employee_daily.created_id', $created_id);
			$result = $this->db->get()->row_array();
			return $result['employee_daily_id'];
		}	

		
		public function saveNewPayrollEmployeeDaily($data){
			return $this->db->insert('payroll_employee_daily',$data);
		}

		public function saveNewPayrollEmployeeDailyAllowance($data){
			return $this->db->insert('payroll_employee_daily_allowance',$data);
		}

		public function saveNewPayrollEmployeeDailyDeduction($data){
			return $this->db->insert('payroll_employee_daily_deduction',$data);
		}

		public function saveNewPayrollEmployeeDailyEarly($data){
			return $this->db->insert('payroll_employee_daily_early',$data);
		}

		public function saveNewPayrollEmployeeDailyOvertime($data){
			return $this->db->insert('payroll_employee_daily_overtime',$data);
		}


		public function saveNewPayrollEmployeeDailyLeave($data){
			return $this->db->insert('payroll_employee_daily_leave',$data);
		}

		public function saveNewPayrollEmployeeDailyDayOff($data){
			return $this->db->insert('payroll_employee_daily_dayoff',$data);
		}

		public function saveNewPayrollEmployeeDailyOvertimeRequest($data){
			return $this->db->insert('payroll_employee_daily_overtime_request',$data);
		}

		public function saveNewPayrollEmployeeDailyHomeEarly($data){
			return $this->db->insert('payroll_employee_daily_home_early',$data);
		}

		public function saveNewPayrollEmployeeDailyPermit($data){
			return $this->db->insert('payroll_employee_daily_permit',$data);
		}

		public function saveNewPayrollEmployeeDailyAbsence($data){
			return $this->db->insert('payroll_employee_daily_absence',$data);
		}

		public function saveNewPayrollEmployeeDailyLate($data){
			return $this->db->insert('payroll_employee_daily_late',$data);
		}



		public function getPayrollEmployeeDaily_Data($employee_id){
			$this->db->select('payroll_employee_daily.employee_daily_id, payroll_employee_daily.employee_id, payroll_employee_daily.employee_daily_period, payroll_employee_daily.employee_daily_working_days, payroll_employee_daily.employee_daily_basic_salary, payroll_employee_daily.employee_daily_allowance_total, payroll_employee_daily.employee_daily_deduction_total, payroll_employee_daily.employee_daily_overtime_total, payroll_employee_daily.employee_daily_early_total, payroll_employee_daily.employee_daily_bpjs_amount, payroll_employee_daily.employee_daily_allowance_other, payroll_employee_daily.employee_daily_deduction_other, payroll_employee_daily.employee_daily_salary_total');
			$this->db->from('payroll_employee_daily');
			$this->db->where('payroll_employee_daily.data_state',0);
			$this->db->where('payroll_employee_daily.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_daily.employee_daily_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getEmployeeHireDate($employee_id){
			$this->db->select('hro_employee_data.employee_hire_date');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result=$this->db->get()->row_array();
			return $result['employee_hire_date'];
		}

		public function getPayrollEmployeeLengthService($employee_id, $length_of_service_month, $year_period){
			$this->db->select('payroll_employee_length_service.employee_length_service_id, payroll_employee_length_service.employee_id, payroll_employee_length_service.employee_length_service_amount, payroll_employee_length_service.length_service_id,  core_length_service.length_service_range1, core_length_service.length_service_range2');
			$this->db->from('payroll_employee_length_service');
			$this->db->join('core_length_service', 'payroll_employee_length_service.length_service_id = core_length_service.length_service_id');
			$this->db->where('payroll_employee_length_service.data_state',0);
			$this->db->where('core_length_service.data_state', 0);
			$this->db->where('payroll_employee_length_service.employee_id', $employee_id);
			$this->db->where('core_length_service.length_service_range1 <=', $length_of_service_month);
			$this->db->where('core_length_service.length_service_range2 >=', $length_of_service_month);
			$this->db->where('payroll_employee_length_service.employee_length_service_period', $year_period);
			$this->db->order_by('payroll_employee_length_service.employee_length_service_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getPayrollEmployeePremiAttendance($employee_id, $year_period){
			$this->db->select('payroll_employee_premi_attendance.employee_premi_attendance_id, payroll_employee_premi_attendance.employee_id, payroll_employee_premi_attendance.employee_premi_attendance_amount');
			$this->db->from('payroll_employee_premi_attendance');
			$this->db->where('payroll_employee_premi_attendance.data_state',0);
			$this->db->where('payroll_employee_premi_attendance.employee_id', $employee_id);
			$this->db->where('payroll_employee_premi_attendance.employee_premi_attendance_period', $year_period);
			$this->db->order_by('payroll_employee_premi_attendance.employee_premi_attendance_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function deletePayrollEmployeeDaily_Data($employee_daily_id){
			$this->db->where("payroll_employee_daily.employee_daily_id", $employee_daily_id);
			$query = $this->db->update('payroll_employee_daily', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		/*public function getPayrollEmployeeDaily_Data($employee_id){
			$this->db->select('
				payroll_employee_daily.employee_daily_id, 
				payroll_employee_daily.employee_id, 
				payroll_employee_daily.bank_id, 
				payroll_employee_daily.employee_daily_period, 
				payroll_employee_daily.employee_daily_bank_acct_name, 
				payroll_employee_daily.employee_daily_bank_acct_no, 
				payroll_employee_daily.employee_daily_date, 
				payroll_employee_daily.employee_daily_start_date, 
				payroll_employee_daily.employee_daily_end_data, 
				payroll_employee_daily.employee_daily_basic_salary, 
				payroll_employee_daily.employee_daily_basic_overtime, 
				payroll_employee_daily.employee_daily_working_days, 
				payroll_employee_daily.employee_daily_allowance_total, 
				payroll_employee_daily.employee_daily_deduction_total, 
				payroll_employee_daily.employee_daily_overtime_total, 
				payroll_employee_daily.employee_daily_early_total, 
				payroll_employee_daily.employee_daily_bpjs_amount, 
				payroll_employee_daily.employee_daily_length_service_month, 
				payroll_employee_daily.employee_daily_allowance_other, 
				payroll_employee_daily.employee_daily_deduction_other, 
				payroll_employee_daily.employee_daily_salary_total');
			$this->db->from('payroll_employee_daily');
			$this->db->where('payroll_employee_daily.data_state',0);
			$this->db->where('payroll_employee_daily.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_daily.employee_daily_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}*/
	}
?>