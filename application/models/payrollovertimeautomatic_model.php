<?php
	class payrollovertimeautomatic_model extends CI_Model {
		var $table = "hro_employee_family";
		
		public function payrollovertimeautomatic_model(){
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

		public function getPayrollOvertimeAutomatic($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id){
			$this->db->select('payroll_overtime_automatic.overtime_automatic_id, payroll_overtime_automatic.division_id, payroll_overtime_automatic.department_id, payroll_overtime_automatic.section_id, payroll_overtime_automatic.overtime_automatic_start_date, payroll_overtime_automatic.overtime_automatic_end_date, payroll_overtime_automatic.overtime_automatic_duration, payroll_overtime_automatic.overtime_automatic_daily_name');
			$this->db->from('payroll_overtime_automatic');
			$this->db->where('payroll_overtime_automatic.data_state',0);
			$this->db->where('payroll_overtime_automatic.region_id', $region_id);
			$this->db->where('payroll_overtime_automatic.branch_id', $branch_id);
			$this->db->where('payroll_overtime_automatic.location_id', $location_id);

			if ($division_id != ''){
				$this->db->where('payroll_overtime_automatic.division_id', $division_id);
			}

			if ($department_id != ''){
				$this->db->where('payroll_overtime_automatic.department_id', $department_id);
			}

			if ($section_id != ''){
				$this->db->where('payroll_overtime_automatic.section_id', $section_id);
			}


			$result = $this->db->get();
			return $result->result_array();
		}

		public function saveNewPayrollOvertimeAutomatic($data){
			$data = array(
				'region_id' 						=> $data['region_id'],
				'branch_id' 						=> $data['branch_id'],
				'location_id' 						=> $data['location_id'],
				'division_id' 						=> $data['division_id'],
				'department_id' 					=> $data['department_id'],
				'section_id' 						=> $data['section_id'],
				'overtime_automatic_start_date' 	=> $data['overtime_automatic_start_date'],
				'overtime_automatic_end_date' 		=> $data['overtime_automatic_end_date'],
				'overtime_automatic_duration' 		=> $data['overtime_automatic_duration'],
				'overtime_automatic_daily_name' 	=> $data['overtime_automatic_daily_name'],
				'data_state'						=> $data['data_state'],
				'created_id'						=> $data['created_id'],
				'created_on'						=> $data['created_on']
			);


			return $this->db->insert('payroll_overtime_automatic',$data);
		}
		
		public function saveEditPayrollOvertimeAutomatic($data){
			$this->db->where('payroll_overtime_automatic.overtime_automatic_id',$data['overtime_automatic_id']);
			$query = $this->db->update('payroll_overtime_automatic', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deletePayrollOvertimeAutomatic($overtime_automatic_id){
			$this->db->where("payroll_overtime_automatic.overtime_automatic_id",$overtime_automatic_id);
			$query = $this->db->update('payroll_overtime_automatic', array("data_state"=>1));
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


		public function getPayrollOvertimeAutomatic_Data($overtime_automatic_id){
			$this->db->select('payroll_overtime_automatic.overtime_automatic_id, payroll_overtime_automatic.division_id, payroll_overtime_automatic.department_id, payroll_overtime_automatic.section_id, payroll_overtime_automatic.overtime_automatic_start_date, payroll_overtime_automatic.overtime_automatic_end_date, payroll_overtime_automatic.overtime_automatic_duration, payroll_overtime_automatic.overtime_automatic_daily_name');
			$this->db->from('payroll_overtime_automatic');
			$this->db->where('payroll_overtime_automatic.data_state',0);
			$this->db->where('payroll_overtime_automatic.overtime_automatic_id', $overtime_automatic_id);

			$result = $this->db->get();
			return $result->row_array();
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

	}
?>