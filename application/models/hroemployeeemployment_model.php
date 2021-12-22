<?php
	class hroemployeeemployment_model extends CI_Model {
		var $table = "transaction_employee_late";
		
		public function hroemployeeemployment_model(){
			parent::__construct();
			$this->CI = get_instance();
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

		public function getCoreAppraisal(){
			$this->db->select('core_appraisal.appraisal_id, core_appraisal.appraisal_name');
			$this->db->from('core_appraisal');
			$this->db->where('core_appraisal.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $payroll_employee_level){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$this->db->where('hro_employee_data.payroll_employee_level <= ', $payroll_employee_level);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeData_Employment($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			
			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.location_id', $location_id);
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

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAppraisal($employee_id){
			$this->db->select('hro_employee_appraisal.employee_appraisal_id, hro_employee_appraisal.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_appraisal.employee_appraisal_date, hro_employee_appraisal.employee_appraisal_total_value, hro_employee_appraisal.employee_appraisal_remark');
			$this->db->from('hro_employee_appraisal');
			$this->db->join('hro_employee_data', 'hro_employee_appraisal.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_appraisal.data_state', 0);
			$this->db->where('hro_employee_appraisal.employee_id', $employee_id);
			$this->db->order_by('hro_employee_appraisal.employee_appraisal_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getAppraisalCode($appraisal_value){
			$this->db->select('core_appraisal.appraisal_code');
			$this->db->from('core_appraisal');
			$this->db->where('core_appraisal.data_state', 0);
			$this->db->where('core_appraisal.appraisal_start_value <=', $appraisal_value);
			$this->db->where('core_appraisal.appraisal_end_value >=', $appraisal_value);
			$result = $this->db->get()->row_array();
			return $result['appraisal_code'];
		}

		public function getAppraisalName($appraisal_id){
			$this->db->select('core_appraisal.appraisal_name');
			$this->db->from('core_appraisal');
			$this->db->where('core_appraisal.data_state', 0);
			$this->db->where('core_appraisal.appraisal_id', $appraisal_id);
			$result = $this->db->get()->row_array();
			return $result['appraisal_name'];
		}

		public function insertHROEmployeeAppraisal($data){
			return $this->db->insert('hro_employee_appraisal', $data);
		}

		public function getEmployeeAppraisalID($created_id){
			$this->db->select('hro_employee_appraisal.employee_appraisal_id');
			$this->db->from('hro_employee_appraisal');
			$this->db->where('hro_employee_appraisal.data_state', 0);
			$this->db->where('hro_employee_appraisal.created_id', $created_id);
			$this->db->order_by('hro_employee_appraisal.employee_appraisal_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_appraisal_id'];
		}

		public function insertHROEmployeeAppraisalDetail($data){
			return $this->db->insert('hro_employee_appraisal_detail',$data);
		}

		public function deleteHROEmployeeAppraisal($data){
			$this->db->where("hro_employee_appraisal.employee_appraisal_id", $data['employee_appraisal_id']);
			$query = $this->db->update('hro_employee_appraisal', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		

		
	}
?>