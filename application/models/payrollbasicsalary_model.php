<?php
	class payrollbasicsalary_model extends CI_Model {
		var $table = "hro_employee_family";
		
		public function payrollbasicsalary_model(){
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

		public function getPayrollBasicSalary($region_id, $branch_id, $location_id, $basic_salary_period){
			/*print_r("basic_salary_period ");
			print_r($basic_salary_period);
			exit;*/
			$this->db->select('payroll_basic_salary.basic_salary_id, payroll_basic_salary.basic_salary_period, payroll_basic_salary.basic_salary_total, payroll_basic_salary.basic_salary_amount, payroll_basic_salary.meal_allowance_amount, payroll_basic_salary.transport_allowance_amount');
			$this->db->from('payroll_basic_salary');
			$this->db->where('payroll_basic_salary.data_state',0);
			$this->db->where('payroll_basic_salary.region_id', $region_id);
			$this->db->where('payroll_basic_salary.branch_id', $branch_id);
			$this->db->where('payroll_basic_salary.location_id', $location_id);

			if ($basic_salary_period != ''){
				$this->db->where('payroll_basic_salary.basic_salary_period', $basic_salary_period);
			}

			$result = $this->db->get();
			return $result->result_array();
		}

		public function saveNewPayrollBasicSalary($data){
			return $this->db->insert('payroll_basic_salary',$data);
		}
		
		public function saveEditPayrollBasicSalary($data){
			$this->db->where('payroll_basic_salary.basic_salary_id',$data['basic_salary_id']);
			$query = $this->db->update('payroll_basic_salary', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deletePayrollBasicSalary($basic_salary_id){
			$this->db->where("payroll_basic_salary.basic_salary_id",$basic_salary_id);
			$query = $this->db->update('payroll_basic_salary', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
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


		public function getPayrollBasicSalary_Data($basic_salary_id){
			$this->db->select('payroll_basic_salary.basic_salary_id, payroll_basic_salary.basic_salary_period, payroll_basic_salary.basic_salary_total, payroll_basic_salary.basic_salary_amount, payroll_basic_salary.meal_allowance_amount, payroll_basic_salary.transport_allowance_amount');
			$this->db->from('payroll_basic_salary');
			$this->db->where('payroll_basic_salary.data_state',0);
			$this->db->where('payroll_basic_salary.basic_salary_id', $basic_salary_id);

			$result = $this->db->get();
			return $result->row_array();
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

	}
?>