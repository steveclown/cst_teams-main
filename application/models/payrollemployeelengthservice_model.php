<?php
	class payrollemployeelengthservice_model extends CI_Model {
		var $table = "hro_employee_lengthservice";
		
		public function payrollemployeelengthservice_model(){
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

		public function getHROEmployeeData_LengthService($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
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

		public function getCoreLengthService(){
			$this->db->select('core_length_service.length_service_id, core_length_service.length_service_name');
			$this->db->from('core_length_service');
			$this->db->where('core_length_service.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getLengthServiceName($length_service_id){
			$this->db->select('core_length_service.length_service_name');
			$this->db->from('core_length_service');
			$this->db->where('core_length_service.length_service_id', $length_service_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['length_service_name'];
		}
		
		public function saveNewPayrollEmployeeLengthService($data){
			return $this->db->insert('payroll_employee_length_service',$data);
		}

		public function getPayrollEmployeeLengthService_Data($employee_id){
			$this->db->select('payroll_employee_length_service.employee_length_service_id, payroll_employee_length_service.employee_id, payroll_employee_length_service.length_service_id, payroll_employee_length_service.employee_length_service_period, payroll_employee_length_service.employee_length_service_description, payroll_employee_length_service.employee_length_service_amount');
			$this->db->from('payroll_employee_length_service');
			$this->db->where('payroll_employee_length_service.data_state',0);
			$this->db->where('payroll_employee_length_service.employee_id', $employee_id);
			$this->db->order_by('payroll_employee_length_service.employee_length_service_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function deletePayrollEmployeeLengthService($employee_id){
			$this->db->where("payroll_employee_length_service.employee_id", $employee_id);
			$query = $this->db->update('payroll_employee_length_service', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollEmployeeLengthService_Data($employee_length_service_id){
			$this->db->where("payroll_employee_length_service.employee_length_service_id", $employee_length_service_id);
			$query = $this->db->update('payroll_employee_length_service', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>