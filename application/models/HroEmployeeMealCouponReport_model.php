<?php
	class HroEmployeeMealCouponReport_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getCoreLocation(){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
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

		public function getCoreUnit($section_id){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.data_state', 0);
			$this->db->where('core_unit.section_id', $section_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeMealCoupon($start_date, $end_date, $location_id, $division_id, $department_id, $section_id, $unit_id){
			$this->db->select('hro_employee_meal_coupon.location_id, core_location.location_name, hro_employee_meal_coupon.employee_id, hro_employee_data.employee_name, hro_employee_data.employee_code, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name');
			$this->db->select('COUNT(*) AS total_meal_coupon');
			$this->db->from('hro_employee_meal_coupon');
			$this->db->join('hro_employee_data', 'hro_employee_meal_coupon.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_location', 'hro_employee_meal_coupon.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date >=', $start_date);
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date <=', $end_date);
			$this->db->where('hro_employee_meal_coupon.location_id', $location_id);

			if ($division_id != ''){
				$this->db->where('hro_employee_meal_coupon.division_id', $division_id);				
			}

			if ($department_id != ''){
				$this->db->where('hro_employee_meal_coupon.department_id', $department_id);				
			}

			if ($section_id != ''){
				$this->db->where('hro_employee_meal_coupon.section_id', $section_id);				
			}

			if ($unit_id != ''){
				$this->db->where('hro_employee_meal_coupon.unit_id', $unit_id);				
			}

			$this->db->group_by('hro_employee_meal_coupon.employee_id');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeCode($employee_id){
			$this->db->select('hro_employee_data.employee_code');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_code'];
		}

		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getDepartmentName($employee_id){
			$this->db->select('core_department.department_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$result = $this->db->get()->row_array();
			return $result['location_name'];
		}

		public function getMealCouponSubvention(){
			$this->db->select('preference_company.employee_meal_coupon_subvention, preference_company.employee_meal_coupon_company_subvention');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeMealCoupon_Export($start_date, $end_date, $location_id, $division_id, $department_id, $section_id, $unit_id){
			$this->db->select('hro_employee_meal_coupon.location_id, core_location.location_name, hro_employee_meal_coupon.employee_id, hro_employee_data.employee_name, hro_employee_data.employee_code, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name');
			$this->db->select('COUNT(*) AS total_meal_coupon');
			$this->db->from('hro_employee_meal_coupon');
			$this->db->join('hro_employee_data', 'hro_employee_meal_coupon.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_location', 'hro_employee_meal_coupon.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date >=', $start_date);
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date <=', $end_date);
			$this->db->where('hro_employee_meal_coupon.location_id', $location_id);

			if ($division_id != ''){
				$this->db->where('hro_employee_meal_coupon.division_id', $division_id);				
			}

			if ($department_id != ''){
				$this->db->where('hro_employee_meal_coupon.department_id', $department_id);				
			}

			if ($section_id != ''){
				$this->db->where('hro_employee_meal_coupon.section_id', $section_id);				
			}

			if ($unit_id != ''){
				$this->db->where('hro_employee_meal_coupon.unit_id', $unit_id);				
			}

			$this->db->group_by('hro_employee_meal_coupon.employee_id');
			$result = $this->db->get()->result_array();
			return $result;
		}

	}
?>