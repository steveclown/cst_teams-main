<?php
	class payrollemployeeloanadisurya_model extends CI_Model {
		var $table = "hro_employee_loan";
		
		public function payrollemployeeloanadisurya_model(){
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

		public function getPayrollEmployeeLoanRequisition($employee_id, $division_id, $department_id, $section_id){
			$this->db->select('payroll_employee_loan_requisition.employee_loan_requisition_id, payroll_employee_loan_requisition.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, payroll_employee_loan_requisition.employee_loan_requisition_status');
			$this->db->from('payroll_employee_loan_requisition');
			$this->db->join('hro_employee_data','payroll_employee_loan_requisition.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_division','hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department','hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section','hro_employee_data.section_id = core_section.section_id');
			$this->db->where('payroll_employee_loan_requisition.data_state', 0);
			$this->db->where('payroll_employee_loan_requisition.employee_loan_requisition_status', 1);
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

		public function getPayrollEmployeeLoanRequisition_Detail($employee_loan_requisition_id){
			$this->db->select('payroll_employee_loan_requisition.employee_loan_requisition_id, payroll_employee_loan_requisition.employee_id, hro_employee_data.employee_name, payroll_employee_loan_requisition.loan_type_id, core_loan_type.loan_type_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, payroll_employee_loan_requisition.employee_employment_status, payroll_employee_loan_requisition.employee_loan_requisition_status, payroll_employee_loan_requisition.employee_loan_requisition_date, payroll_employee_loan_requisition.employee_total_period, payroll_employee_loan_requisition.employee_loan_amount_total, payroll_employee_loan_requisition.employee_loan_amount');
			$this->db->from('payroll_employee_loan_requisition');
			$this->db->join('hro_employee_data','payroll_employee_loan_requisition.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_loan_type','payroll_employee_loan_requisition.loan_type_id = core_loan_type.loan_type_id');
			$this->db->join('core_division','hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department','hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section','hro_employee_data.section_id = core_section.section_id');
			$this->db->where('payroll_employee_loan_requisition.data_state', 0);
			$this->db->where('payroll_employee_loan_requisition.employee_loan_requisition_id', $employee_loan_requisition_id);
			$result = $this->db->get();
			return $result->row_array();
		}























		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
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

		// public function getHROEmployeeData_Loan($region_id, $branch_id, $location_id,$payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
		// 	$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
		// 	$this->db->from('hro_employee_data');
		// 	$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
		// 	$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
		// 	$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
		// 	$this->db->where('hro_employee_data.data_state',0);
		// 	$this->db->where('hro_employee_data.region_id', $region_id);
		// 	$this->db->where('hro_employee_data.branch_id', $branch_id);
		// 	$this->db->where('hro_employee_data.location_id', $location_id);

		// 	if ($payroll_employee_level != 9){
		// 		$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
		// 	}

		// 	if ($employee_id != ''){
		// 		$this->db->where('hro_employee_data.employee_id', $employee_id);
		// 	}

		// 	if ($division_id != ''){
		// 		$this->db->where('hro_employee_data.division_id', $division_id);
		// 	}

		// 	if ($department_id != ''){
		// 		$this->db->where('hro_employee_data.department_id', $department_id);
		// 	}

		// 	if ($section_id != ''){
		// 		$this->db->where('hro_employee_data.section_id', $section_id);
		// 	}


		// 	$result = $this->db->get();
		// 	return $result->result_array();
		// }

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
		
		public function getCoreLoanType(){
			$this->db->select('core_loan_type.loan_type_id, core_loan_type.loan_type_name');
			$this->db->from('core_loan_type');
			$this->db->where('core_loan_type.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getLoanTypeName($loan_type_id){
			$this->db->select('core_loan_type.loan_type_name');
			$this->db->from('core_loan_type');
			$this->db->where('core_loan_type.loan_type_id', $loan_type_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['loan_type_name'];
		}
		
		public function saveNewPayrollEmployeeLoan($data){
			return $this->db->insert('payroll_employee_loan',$data);
		}

		public function getEmployeeLoanID($created_id){
			$this->db->select('payroll_employee_loan.employee_loan_id');
			$this->db->from('payroll_employee_loan');
			$this->db->where('payroll_employee_loan.created_id', $created_id);
			$this->db->order_by('payroll_employee_loan.employee_loan_id', 'DESC');
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['employee_loan_id'];
		}

		public function saveNewPayrollEmployeeLoanItem($data){
			return $this->db->insert('payroll_employee_loan_item',$data);
		}

		public function getPayrollEmployeeLoan_Data($employee_id){
			$this->db->select('payroll_employee_loan.employee_loan_id, payroll_employee_loan.employee_id, payroll_employee_loan.loan_type_id, core_loan_type.loan_type_name, payroll_employee_loan.employee_loan_description, payroll_employee_loan.employee_loan_start_period, payroll_employee_loan.employee_loan_amount, payroll_employee_loan.employee_loan_amount_total');
			$this->db->from('payroll_employee_loan');
			$this->db->join('core_loan_type', 'payroll_employee_loan.loan_type_id = core_loan_type.loan_type_id');
			$this->db->where('payroll_employee_loan.data_state',0);
			$this->db->where('payroll_employee_loan.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_loan.employee_loan_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function deletePayrollEmployeeAllowance($employee_id){
			$this->db->where("payroll_employee_allowance.employee_id", $employee_id);
			$query = $this->db->update('payroll_employee_allowance', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollEmployeeAllowance_Data($employee_allowance_id){
			$this->db->where("payroll_employee_allowance.employee_allowance_id", $employee_allowance_id);
			$query = $this->db->update('payroll_employee_allowance', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}





		
		public function addemployeeloanitem($data){
			$item = array(
				'period'				=> $data['period'],
				'installment_payment'	=> $data['installment_payment'],
				'employee_loan_amount'	=> $data['employee_loan_amount'],
				'employee_loan_payment'	=> $data['employee_loan_payment'],
				'employee_loan_balance' => $data['employee_loan_balance'],
				'payment_date'			=> $data['payment_date'],
			);
			
			if($this->db->insert('hro_employee_loan_item', $item)){
				return true;
			}else{
				return false;
			}
		}
		
		public function getdetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_loan_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function delete($id){
			$this->db->where("employee_loan_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getemployee(){
			$this->db->select('employee_id, employee_name')->from('hro_employee_data');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}	
		
		public function getemployeecode(){
			$this->db->select('employee_code, employee_code')->from('hro_employee_data');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function getloanitem($id){
			$this->db->select('employee_loan_id, period, installment_payment, employee_loan_amount, employee_loan_payment, employee_loan_balance, payment_date')->from('hro_employee_loan_item');
			$this->db->where('employee_loan_id', $id);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function updateemployeeloanitem($data){
			$data_item = array(
				'period'				=> $data['period'],
				'installment_payment'	=> $data['installment_payment'],
				'employee_loan_amount'	=> $data['employee_loan_amount'],
				'employee_loan_payment'	=> $data['employee_loan_payment'],
				'employee_loan_balance' => $data['employee_loan_balance'],
				'payment_date'			=> $data['payment_date'],
			);
			
			if($this->db->insert('hro_employee_loan_item', $data_item)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
?>