<?php
	class payrollemployeecommission_model extends CI_Model {
		
		public function payrollemployeecommission_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getPayrollMonthlyPeriod(){
			$this->db->select('payroll_monthly_period.monthly_period');
			$this->db->from('payroll_monthly_period');
			$this->db->where('payroll_monthly_period.data_state',0);
			$this->db->order_by('payroll_monthly_period.monthly_period', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$this->db->where('core_department.division_id', $division_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			$this->db->where('core_section.department_id', $department_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData($division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getPayrollEmployeeCommission($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $employee_id, $employee_commission_period){
			$this->db->select('payroll_employee_commission.employee_commission_id, payroll_employee_commission.employee_commission_period, payroll_employee_commission.employee_commission_start_date, payroll_employee_commission.employee_commission_end_date, payroll_employee_commission_item.division_id, core_division.division_name, payroll_employee_commission_item.department_id, core_department.department_name, payroll_employee_commission_item.section_id, core_section.section_name, payroll_employee_commission_item.employee_id, hro_employee_data.employee_name, payroll_employee_commission_item.job_title_id, core_job_title.job_title_name, payroll_employee_commission_item.employee_commission_omzet_mmc, payroll_employee_commission_item.employee_commission_quantity_mmc, payroll_employee_commission_item.employee_commission_omzet_acc, payroll_employee_commission_item.employee_commission_total_omzet, payroll_employee_commission_item.employee_commission_amount_mmc, payroll_employee_commission_item.employee_commission_amount_acc, payroll_employee_commission_item.employee_commission_total_amount, payroll_employee_commission_item.employee_commission_non_mmc, payroll_employee_commission_item.employee_commission_sales');
			$this->db->from('payroll_employee_commission');
			$this->db->join('payroll_employee_commission_item', 'payroll_employee_commission.employee_commission_id = payroll_employee_commission_item.employee_commission_id');
			$this->db->join('core_division', 'payroll_employee_commission_item.division_id = core_division.division_id');
			$this->db->join('core_department', 'payroll_employee_commission_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'payroll_employee_commission_item.section_id = core_section.section_id');
			$this->db->join('hro_employee_data', 'payroll_employee_commission_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_job_title', 'payroll_employee_commission_item.job_title_id = core_job_title.job_title_id');

			if ($division_id != ''){
				$this->db->where('payroll_employee_commission_item.division_id', $division_id);
			}

			if ($department_id != ''){
				$this->db->where('payroll_employee_commission_item.department_id', $department_id);
			}

			if ($section_id != ''){
				$this->db->where('payroll_employee_commission_item.section_id', $section_id);
			}

			if ($employee_id != ''){
				$this->db->where('payroll_employee_commission_item.employee_id', $employee_id);
			}

			if ($employee_commission_period != ''){
				$this->db->where('payroll_employee_commission.employee_commission_period', $employee_commission_period);
			}

			$result = $this->db->get()->result_array();
			return $result;
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
		
		public function getCoreCommissionMMC($job_title_id, $employee_commission_mmc_omzet){
			$this->db->select('core_commission_mmc.commission_mmc_unit, core_commission_mmc.commission_mmc_status');
			$this->db->from('core_commission_mmc');
			$this->db->where('core_commission_mmc.data_state',0);
			$this->db->where('core_commission_mmc.job_title_id', $job_title_id);
			$this->db->where('core_commission_mmc.commission_mmc_start_omzet <= ', $employee_commission_mmc_omzet);
			$this->db->where('core_commission_mmc.commission_mmc_end_omzet >= ', $employee_commission_mmc_omzet);
			$result = $this->db->get();
			return $result->row_array();
		}
		
		public function insertPayrollEmployeeCommissionMMC($data){
			return $this->db->insert('payroll_employee_commission_mmc',$data);
		}
		
		
		public function getPayrollEmployeeCommissionMMC_Data($employee_id){
			$this->db->select('payroll_employee_commission_mmc.employee_commission_mmc_id, payroll_employee_commission_mmc.employee_id, payroll_employee_commission_mmc.employee_commission_mmc_period, payroll_employee_commission_mmc.employee_commission_mmc_omzet, payroll_employee_commission_mmc.employee_commission_mmc_unit, payroll_employee_commission_mmc.employee_commission_mmc_amount');
			$this->db->from('payroll_employee_commission_mmc');
			$this->db->where('payroll_employee_commission_mmc.data_state',0);
			$this->db->where('payroll_employee_commission_mmc.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_commission_mmc.employee_commission_mmc_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function deletePayrollEmployeeCommissionMMC($employee_id){
			$this->db->where("payroll_employee_commission_mmc.employee_id", $employee_id);
			$query = $this->db->update('payroll_employee_commission_mmc', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollEmployeeCommissionMMC_Data($employee_commission_mmc_id){
			$this->db->where("payroll_employee_commission_mmc.employee_commission_mmc_id", $employee_commission_mmc_id);
			$query = $this->db->update('payroll_employee_commission_mmc', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>