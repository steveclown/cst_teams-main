<?php
	class payrollemployeecommission_model extends CI_Model {
		
		public function payrollemployeecommission_model(){
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

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.job_title_id');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
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

		public function getHROEmployeeData_Commission($region_id, $data_branch, $branch_status, $branch_id, $payroll_employee_level, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.employee_status !=', 9);
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.region_id', $region_id);

			if ($payroll_employee_level != 9){
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
		
		public function getCoreCommission($job_title_id, $employee_commission_mmc_omzet){
			$this->db->select('core_commission_mmc.commission_mmc_unit, core_commission_mmc.commission_mmc_status');
			$this->db->from('core_commission_mmc');
			$this->db->where('core_commission_mmc.data_state',0);
			$this->db->where('core_commission_mmc.job_title_id', $job_title_id);
			$this->db->where('core_commission_mmc.commission_mmc_start_omzet <= ', $employee_commission_mmc_omzet);
			$this->db->where('core_commission_mmc.commission_mmc_end_omzet >= ', $employee_commission_mmc_omzet);
			$result = $this->db->get();
			return $result->row_array();
		}
		
		public function insertPayrollEmployeeCommission($data){
			return $this->db->insert('payroll_employee_commission',$data);
		}
		
		
		public function getPayrollEmployeeCommission_Data($employee_id){
			$this->db->select('payroll_employee_commission.employee_commission_id, payroll_employee_commission.employee_id, payroll_employee_commission.employee_commission_period, payroll_employee_commission.employee_commission_omzet_mmc, payroll_employee_commission.employee_commission_quantity_mmc, payroll_employee_commission.employee_commission_omzet_acc, payroll_employee_commission.employee_commission_total_omzet, payroll_employee_commission.employee_commission_amount_mmc, payroll_employee_commission.employee_commission_amount_acc, payroll_employee_commission.employee_commission_total_amount');
			$this->db->from('payroll_employee_commission');
			$this->db->where('payroll_employee_commission.data_state',0);
			$this->db->where('payroll_employee_commission.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_commission.employee_commission_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function deletePayrollEmployeeCommission($employee_id){
			$this->db->where("payroll_employee_commission.employee_id", $employee_id);
			$query = $this->db->update('payroll_employee_commission', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollEmployeeCommission_Data($employee_commission_mmc_id){
			$this->db->where("payroll_employee_commission.employee_commission_id", $employee_commission_mmc_id);
			$query = $this->db->update('payroll_employee_commission', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>