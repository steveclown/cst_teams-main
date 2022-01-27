<?php
	class payrollemployeedata_model extends CI_Model {
		var $table = "hro_employee_allowance";
		
		public function payrollemployeedata_model(){
			parent::__construct();
			$this->CI = get_instance();
		}


		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getSystemUserBranch($user_id){
			$this->db->select('system_user_branch.branch_id');
			$this->db->from('system_user_branch');
			$this->db->where('system_user_branch.user_id', $user_id);
			$result = $this->db->get()->result_array();
			return array_column($result, 'branch_id');
		}

		public function getCoreBranch($branch_status, $data){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state', 0);

			if ($branch_status != 9){
				$this->db->where_in('core_branch.branch_id', $data);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_hire_date');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Daily($region_id, $data_branch, $branch_status, $branch_id, $payroll_employee_level, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.employee_hire_date');
			$this->db->from('hro_employee_data');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_status !=', 9);
			$this->db->where('hro_employee_data.region_id', $region_id);

			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			if($branch_status != 9 ){
				if ($branch_id == ''){
					$this->db->where_in('hro_employee_data.branch_id', $data_branch);
				} else {
					$this->db->where('hro_employee_data.branch_id', $branch_id);
				}
			} else {
				if ($branch_id != ''){
					$this->db->where('hro_employee_data.branch_id', $branch_id);
				}
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


			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreBank(){
			$this->db->select('core_bank.bank_id, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreAllowance(){
			$this->db->select('core_allowance.allowance_id, core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDeduction(){
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCorePremiAttendance(){
			$this->db->select('core_premi_attendance.premi_attendance_id, core_premi_attendance.premi_attendance_name');
			$this->db->from('core_premi_attendance');
			$this->db->where('core_premi_attendance.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreLoanType(){
			$this->db->select('core_loan_type.loan_type_id, core_loan_type.loan_type_name');
			$this->db->from('core_loan_type');
			$this->db->where('core_loan_type.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeePayment_Detail($employee_id){
			$this->db->select('payroll_employee_payment.employee_payment_id, payroll_employee_payment.employee_id,  payroll_employee_payment.bank_id, core_bank.bank_name, payroll_employee_payment.employee_payment_period, payroll_employee_payment.payment_basic_salary, payroll_employee_payment.payment_basic_overtime, payroll_employee_payment.payment_bank_acct_no, payroll_employee_payment.payment_bank_acct_name, payroll_employee_payment.payment_home_early_status, payroll_employee_payment.payment_home_early_amount');
			$this->db->from('payroll_employee_payment');
			$this->db->join('core_bank', 'payroll_employee_payment.bank_id = core_bank.bank_id');
			$this->db->where('payroll_employee_payment.data_state', 0);
			$this->db->where('payroll_employee_payment.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_payment.employee_payment_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeAllowance_Detail($employee_id){
			$this->db->select('payroll_employee_allowance.employee_allowance_id, payroll_employee_allowance.employee_id, payroll_employee_allowance.allowance_id, core_allowance.allowance_name, payroll_employee_allowance.employee_allowance_period, payroll_employee_allowance.employee_allowance_description, payroll_employee_allowance.employee_allowance_amount');
			$this->db->from('payroll_employee_allowance');
			$this->db->join('core_allowance', 'payroll_employee_allowance.allowance_id = core_allowance.allowance_id');
			$this->db->where('payroll_employee_allowance.data_state', 0);
			$this->db->where('payroll_employee_allowance.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_allowance.employee_allowance_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeDeduction_Detail($employee_id){
			$this->db->select('payroll_employee_deduction.employee_deduction_id, payroll_employee_deduction.employee_id, payroll_employee_deduction.deduction_id, core_deduction.deduction_name, payroll_employee_deduction.employee_deduction_period, payroll_employee_deduction.employee_deduction_description, payroll_employee_deduction.employee_deduction_amount');
			$this->db->from('payroll_employee_deduction');
			$this->db->join('core_deduction', 'payroll_employee_deduction.deduction_id = core_deduction.deduction_id');
			$this->db->where('payroll_employee_deduction.data_state', 0);
			$this->db->where('payroll_employee_deduction.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_deduction.employee_deduction_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeePremiAttendance_Detail($employee_id){
			$this->db->select('payroll_employee_premi_attendance.employee_premi_attendance_id, payroll_employee_premi_attendance.employee_id, payroll_employee_premi_attendance.premi_attendance_id, core_premi_attendance.premi_attendance_name, payroll_employee_premi_attendance.employee_premi_attendance_period, payroll_employee_premi_attendance.employee_premi_attendance_description, payroll_employee_premi_attendance.employee_premi_attendance_amount');
			$this->db->from('payroll_employee_premi_attendance');
			$this->db->join('core_premi_attendance', 'payroll_employee_premi_attendance.premi_attendance_id = core_premi_attendance.premi_attendance_id');
			$this->db->where('payroll_employee_premi_attendance.data_state',0);
			$this->db->where('payroll_employee_premi_attendance.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_premi_attendance.employee_premi_attendance_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeBPJS_Detail($employee_id){
			$this->db->select('payroll_employee_bpjs.employee_bpjs_id, payroll_employee_bpjs.employee_id, payroll_employee_bpjs.bpjs_in_date, payroll_employee_bpjs.bpjs_reported_salary, payroll_employee_bpjs.bpjs_total_amount, payroll_employee_bpjs.bpjs_kesehatan_status, payroll_employee_bpjs.bpjs_kesehatan_no, payroll_employee_bpjs.bpjs_kesehatan_percentage, payroll_employee_bpjs.bpjs_kesehatan_amount, payroll_employee_bpjs.bpjs_tenagakerja_status, payroll_employee_bpjs.bpjs_tenagakerja_no, payroll_employee_bpjs.bpjs_tenagakerja_percentage, payroll_employee_bpjs.bpjs_tenagakerja_amount, payroll_employee_bpjs.bpjs_remark, payroll_employee_bpjs.bpjs_out_status, payroll_employee_bpjs.bpjs_out_date');
			$this->db->from('payroll_employee_bpjs');
			$this->db->where('payroll_employee_bpjs.data_state', 0);
			$this->db->where('payroll_employee_bpjs.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_bpjs.employee_bpjs_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeLoan_Detail($employee_id){
			$this->db->select('payroll_employee_loan.employee_loan_id, payroll_employee_loan.employee_id, payroll_employee_loan.loan_type_id, core_loan_type.loan_type_name, payroll_employee_loan.employee_loan_date, payroll_employee_loan.employee_loan_description, payroll_employee_loan.employee_loan_start_period, payroll_employee_loan.employee_loan_amount, payroll_employee_loan.employee_loan_amount_total, payroll_employee_loan.employee_loan_status');
			$this->db->from('payroll_employee_loan');
			$this->db->join('core_loan_type', 'payroll_employee_loan.loan_type_id = core_loan_type.loan_type_id');
			$this->db->where('payroll_employee_loan.data_state', 0);
			$this->db->where('payroll_employee_loan.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_loan.employee_loan_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function checkPaymentBankAcctNo($payment_bank_acct_no){
			$this->db->select('payroll_employee_payment.payment_bank_acct_no');
			$this->db->from('payroll_employee_payment');
			$this->db->where('payroll_employee_payment.payment_bank_acct_no', $payment_bank_acct_no);
			$this->db->where('payroll_employee_payment.data_state', 0);
			$result = $this->db->get()->row_array();
			if(!isset($result['payment_bank_acct_no'])){
				return true;
			}else{
				return false;
			}
		}

		public function insertPayrollEmployeePayment($data){
			return $this->db->insert('payroll_employee_payment',$data);
		}

		public function deletePayrollEmployeePayment($data){
			$this->db->where("payroll_employee_payment.employee_payment_id", $data['employee_payment_id']);
			$query = $this->db->update('payroll_employee_payment', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertPayrollEmployeeAllowance($data){
			return $this->db->insert('payroll_employee_allowance',$data);
		}

		public function deletePayrollEmployeeAllowance($data){
			$this->db->where("payroll_employee_allowance.employee_allowance_id", $data['employee_allowance_id']);
			$query = $this->db->update('payroll_employee_allowance', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function insertPayrollEmployeeDeduction($data){
			return $this->db->insert('payroll_employee_deduction',$data);
		}

		public function deletePayrollEmployeeDeduction($data){
			$this->db->where("payroll_employee_deduction.employee_deduction_id", $data['employee_deduction_id']);
			$query = $this->db->update('payroll_employee_deduction', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function insertPayrollEmployeePremiAttendance($data){
			return $this->db->insert('payroll_employee_premi_attendance',$data);
		}

		public function deletePayrollEmployeePremiAttendance($data){
			$this->db->where("payroll_employee_premi_attendance.employee_premi_attendance_id", $data['employee_premi_attendance_id']);
			$query = $this->db->update('payroll_employee_premi_attendance', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function insertPayrollEmployeeBPJS($data){
			return $this->db->insert('payroll_employee_bpjs',$data);
		}
		
		public function deletePayrollEmployeeBPJS($data){
			$this->db->where("payroll_employee_bpjs.employee_bpjs_id", $data['employee_bpjs_id']);
			$query = $this->db->update('payroll_employee_bpjs', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function insertPayrollEmployeeLoan($data){
			return $this->db->insert('payroll_employee_loan',$data);
		}

		public function getEmployeeLoanID($created_id){
			$this->db->select('payroll_employee_loan.employee_loan_id');
			$this->db->from('payroll_employee_loan');
			$this->db->where('payroll_employee_loan.created_id', $created_id);
			$this->db->order_by('payroll_employee_loan.employee_loan_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_loan_id'];
		}

		public function insertPayrollEmployeeLoanItem($data){
			return $this->db->insert('payroll_employee_loan_item',$data);
		}

		public function deletePayrollEmployeeLoan($data){
			$this->db->where("payroll_employee_loan.employee_loan_id", $data['employee_loan_id']);
			$query = $this->db->update('payroll_employee_loan', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>