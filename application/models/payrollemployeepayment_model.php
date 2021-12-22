<?php
	class payrollemployeepayment_model extends CI_Model {
		var $table = "hro_employee_data";
		
		public function payrollemployeepayment_model(){
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

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($payroll_employee_level != 9){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Payment($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);

			if ($payroll_employee_level != 9){
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

		public function getCoreBank(){
			$this->db->select('core_bank.bank_id, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getBankName($bank_id){
			$this->db->select('core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.bank_id', $bank_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['bank_name'];
		}
		
		public function checkPaymentBankAcctNo($payment_bank_acct_no){
			$this->db->select('payroll_employee_payment.payment_bank_acct_no');
			$this->db->from('payroll_employee_payment');
			$this->db->where('payroll_employee_payment.payment_bank_acct_no', $payment_bank_acct_no);
			$this->db->where('payroll_employee_payment.data_state', 0);
			$result = $this->db->get()->row_array();
			if(!isset($result['payment_bank_acct_no'])){
				return 0;
			}else{
				return 1;
			}
		}

		public function saveNewPayrollEmployeePayment($data){
			return $this->db->insert('payroll_employee_payment',$data);
		}

		public function getPayrollEmployeePayment_Data($employee_id){
			$this->db->select('payroll_employee_payment.employee_payment_id, payroll_employee_payment.employee_id, payroll_employee_payment.bank_id, payroll_employee_payment.employee_payment_period, payroll_employee_payment.payment_basic_salary, payroll_employee_payment.payment_basic_overtime, payroll_employee_payment.payment_bank_acct_no, payroll_employee_payment.payment_bank_acct_name, payroll_employee_payment.payment_home_early_status, payroll_employee_payment.payment_home_early_amount');
			$this->db->from('payroll_employee_payment');
			$this->db->where('payroll_employee_payment.data_state',0);
			$this->db->where('payroll_employee_payment.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_payment.employee_payment_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function deletePayrollEmployeePayment($employee_id){
			$this->db->where("payroll_employee_payment.employee_id", $employee_id);
			$query = $this->db->update('payroll_employee_payment', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollEmployeePayment_Data($employee_payment_id){
			$this->db->where("payroll_employee_payment.employee_payment_id", $employee_payment_id);
			$query = $this->db->update('payroll_employee_payment', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>