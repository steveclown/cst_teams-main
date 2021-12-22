<?php
	class PayrollEmployeeAdditionalCkp_model extends CI_Model {
		var $table = "hro_employee_allowance";
		
		public function __construct(){
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

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name,core_department.department_name, core_section.section_name, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_hire_date');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
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

		public function getHROEmployeeData_Daily($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id){
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
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			// if ($employee_id != ''){
			// 	$this->db->where('hro_employee_data.employee_id', $employee_id);
			// }

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

		public function getCoreDeduction(){
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreOvertimeType(){
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_name');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeDelivery_Detail($employee_id){
			$this->db->select('payroll_employee_delivery.employee_delivery_id, payroll_employee_delivery.employee_id, payroll_employee_delivery.employee_delivery_date, payroll_employee_delivery.employee_delivery_days, payroll_employee_delivery.employee_delivery_status, payroll_employee_delivery.employee_delivery_description');
			$this->db->from('payroll_employee_delivery');
			$this->db->where('payroll_employee_delivery.data_state', 0);
			$this->db->where('payroll_employee_delivery.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_delivery.employee_delivery_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeAdditionalDeduction_Detail($employee_id){
			$this->db->select('payroll_employee_additional_deduction.employee_additional_deduction_id, payroll_employee_additional_deduction.employee_id, payroll_employee_additional_deduction.deduction_id, core_deduction.deduction_name, payroll_employee_additional_deduction.employee_additional_deduction_date, payroll_employee_additional_deduction.employee_additional_deduction_description, payroll_employee_additional_deduction.employee_additional_deduction_amount');
			$this->db->from('payroll_employee_additional_deduction');
			$this->db->join('core_deduction', 'payroll_employee_additional_deduction.deduction_id = core_deduction.deduction_id');
			$this->db->where('payroll_employee_additional_deduction.data_state', 0);
			$this->db->where('payroll_employee_additional_deduction.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_additional_deduction.employee_additional_deduction_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollEmployeeAdditionalOvertime_Detail($employee_id){
			$this->db->select('payroll_employee_additional_overtime.employee_additional_overtime_id, payroll_employee_additional_overtime.employee_id, payroll_employee_additional_overtime.overtime_type_id, core_overtime_type.overtime_type_name, payroll_employee_additional_overtime.employee_additional_overtime_date, payroll_employee_additional_overtime.employee_additional_overtime_description, payroll_employee_additional_overtime.employee_additional_overtime_amount');
			$this->db->from('payroll_employee_additional_overtime');
			$this->db->join('core_overtime_type', 'payroll_employee_additional_overtime.overtime_type_id = core_overtime_type.overtime_type_id');
			$this->db->where('payroll_employee_additional_overtime.data_state', 0);
			$this->db->where('payroll_employee_additional_overtime.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_additional_overtime.employee_additional_overtime_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getJobTitleID($employee_id){
			$this->db->select('hro_employee_data.job_title_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['job_title_id'];
		}

		public function insertPayrollEmployeeDelivery($data){
			return $this->db->insert('payroll_employee_delivery',$data);
		}

		public function deletePayrollEmployeeDelivery($data){
			$this->db->where("payroll_employee_delivery.employee_delivery_id", $data['employee_delivery_id']);
			$query = $this->db->update('payroll_employee_delivery', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function insertPayrollEmployeeAdditionalDeduction($data){
			return $this->db->insert('payroll_employee_additional_deduction',$data);
		}

		public function deletePayrollEmployeeAdditionalDeduction($data){
			$this->db->where("payroll_employee_additional_deduction.employee_additional_deduction_id", $data['employee_additional_deduction_id']);
			$query = $this->db->update('payroll_employee_additional_deduction', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function insertPayrollEmployeeAdditionalOvertime($data){
			return $this->db->insert('payroll_employee_additional_overtime',$data);
		}

		public function deletePayrollEmployeeAdditionalOvertime($data){
			$this->db->where("payroll_employee_additional_overtime.employee_additional_overtime_id", $data['employee_additional_overtime_id']);
			$query = $this->db->update('payroll_employee_additional_overtime', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>