<?php
	class assignmentbusinesstripilufa_model extends CI_Model {
		var $table = "transaction_business_trip";
		
		public function assignmentbusinesstripilufa_model(){
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

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.job_title_id, core_job_title.job_title_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
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

		public function getHROEmployeeData_BusinessTrip($region_id, $branch_id, $location_id, $payroll_employee_level, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.job_title_id, core_job_title.job_title_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

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

		public function getAssignmentOvertimeRate($job_title_id){
			$this->db->select('assignment_overtime_rate.overtime_rate_id, assignment_overtime_rate.overtime_rate_amount, assignment_overtime_rate.overtime_rate_trip_amount, assignment_overtime_rate.overtime_rate_days');
			$this->db->from('assignment_overtime_rate');
			$this->db->where('assignment_overtime_rate.data_state', 0);
			$this->db->where('assignment_overtime_rate.job_title_id', $job_title_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getAssignmentBusinessTrip_Data($employee_id){
			$this->db->select('assignment_business_trip_ilufa.business_trip_id, assignment_business_trip_ilufa.employee_id, assignment_business_trip_ilufa.overtime_rate_id, assignment_business_trip_ilufa.job_title_id, assignment_business_trip_ilufa.business_trip_date, assignment_business_trip_ilufa.business_trip_start_date, assignment_business_trip_ilufa.business_trip_end_date, assignment_business_trip_ilufa.business_trip_destination, assignment_business_trip_ilufa.business_trip_amount, assignment_business_trip_ilufa.business_trip_days, assignment_business_trip_ilufa.business_trip_trip_amount, assignment_business_trip_ilufa.business_trip_subtotal_amount, assignment_business_trip_ilufa.business_trip_stay_overnight, assignment_business_trip_ilufa.business_trip_trip_count, assignment_business_trip_ilufa.business_trip_subtotal_trip_amount, assignment_business_trip_ilufa.business_trip_total_amount');
			$this->db->from('assignment_business_trip_ilufa');
			$this->db->where('assignment_business_trip_ilufa.data_state',0);
			$this->db->where('assignment_business_trip_ilufa.employee_id', $employee_id);
			$this->db->order_by('assignment_business_trip_ilufa.business_trip_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getOvertimeRateAmount($overtime_rate_id, $job_title_id){
			$this->db->select('assignment_overtime_rate.overtime_rate_amount');
			$this->db->from('assignment_overtime_rate');
			$this->db->where('assignment_overtime_rate.overtime_rate_id', $overtime_rate_id);
			$this->db->where('assignment_overtime_rate.job_title_id', $job_title_id);
			$result=$this->db->get()->row_array();
			return $result['overtime_rate_amount'];
		}

		public function getAssignmentOvertimeRateTitle($overtime_rate_id){
			$this->db->select('assignment_overtime_rate_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('assignment_overtime_rate_title');
			$this->db->join('core_job_title', 'assignment_overtime_rate_title.job_title_id = core_job_title.job_title_id');
			$this->db->where('assignment_overtime_rate_title.overtime_rate_id', $overtime_rate_id);
			$this->db->group_by('assignment_overtime_rate_title.job_title_id');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment_Detail($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state',0);
			$this->db->where('core_department.division_id', $division_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection_Detail($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state',0);
			$this->db->where('core_section.department_id', $department_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getAssignmentOvertimeRateTitle_Allowance($overtime_rate_id, $job_title_id){
			$this->db->select('assignment_overtime_rate_title.allowance_id, core_allowance.allowance_name');
			$this->db->from('assignment_overtime_rate_title');
			$this->db->join('core_allowance', 'assignment_overtime_rate_title.allowance_id = core_allowance.allowance_id');
			$this->db->where('assignment_overtime_rate_title.overtime_rate_id', $overtime_rate_id);
			$this->db->where('assignment_overtime_rate_title.job_title_id', $job_title_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Detail($data){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $data['region_id']);
			$this->db->where('hro_employee_data.branch_id', $data['branch_id']);
			$this->db->where('hro_employee_data.location_id', $data['location_id']);
			$this->db->where('hro_employee_data.division_id', $data['division_id']);
			$this->db->where('hro_employee_data.department_id', $data['department_id']);
			$this->db->where('hro_employee_data.section_id', $data['section_id']);
			$this->db->where('hro_employee_data.job_title_id', $data['job_title_id']);
			$result = $this->db->get()->result_array();
			return $result;
		}

		

		public function insertAssignmentBusinessTrip($data){
			return $this->db->insert('assignment_business_trip_ilufa',$data);
		}

		public function getBusinessTripID($created_on, $created_id){
			$this->db->select('assignment_business_trip_ilufa.business_trip_id');
			$this->db->from('assignment_business_trip_ilufa');
			$this->db->where('assignment_business_trip_ilufa.created_id', $created_id);
			$this->db->order_by('assignment_business_trip_ilufa.created_on', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['business_trip_id'];
		}

		public function getAssignmentBusinessTrip_Detail($business_trip_id){
			$this->db->select('assignment_business_trip_ilufa.business_trip_id, assignment_business_trip_ilufa.division_id, core_division.division_name, assignment_business_trip_ilufa.department_id, core_department.department_name, assignment_business_trip_ilufa.section_id, core_section.section_name, assignment_business_trip_ilufa.job_title_id, core_job_title.job_title_name, assignment_business_trip_ilufa.employee_id, hro_employee_data.employee_name, assignment_business_trip_ilufa.business_trip_date, assignment_business_trip_ilufa.business_trip_start_date, assignment_business_trip_ilufa.business_trip_end_date, assignment_business_trip_ilufa.business_trip_purpose, assignment_business_trip_ilufa.business_trip_status, assignment_business_trip_ilufa.approved, assignment_business_trip_ilufa.returned, assignment_business_trip_ilufa.overtime_rate_id, assignment_overtime_rate.overtime_rate_description');
			$this->db->from('assignment_business_trip_ilufa');
			$this->db->join('core_division', 'assignment_business_trip_ilufa.division_id = core_division.division_id');
			$this->db->join('core_department', 'assignment_business_trip_ilufa.department_id  = core_department.department_id');
			$this->db->join('core_section', 'assignment_business_trip_ilufa.section_id = core_section.section_id');
			$this->db->join('core_job_title', 'assignment_business_trip_ilufa.job_title_id = core_job_title.job_title_id');
			$this->db->join('hro_employee_data', 'assignment_business_trip_ilufa.employee_id = hro_employee_data.employee_id');
			$this->db->join('assignment_overtime_rate', 'assignment_business_trip_ilufa.overtime_rate_id = assignment_overtime_rate.overtime_rate_id');
			$this->db->where('assignment_business_trip_ilufa.data_state', 0);
			$this->db->where('assignment_business_trip_ilufa.business_trip_id', $business_trip_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		
		
		public function getdetail($id){
			$this->db->select('*')->from('transaction_business_trip');
			$this->db->where('business_trip_id',$id);
			return $this->db->get()->row_array();
		}

		public function approvedAssignmentBusinessTrip($data){
			$this->db->where('business_trip_id', $data['business_trip_id']);
			if($this->db->update('assignment_business_trip_ilufa', $data)){
				return true;
			} else {
				return false;
			}
		}
		
		public function updatetransactionalbusinesstrip($data){
			$this->db->where('business_trip_id',$data['business_trip_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteAssignmentBusinessTrip_Data($business_trip_id){
			$this->db->where("assignment_business_trip_ilufa.business_trip_id", $business_trip_id);
			$query = $this->db->update('assignment_business_trip_ilufa', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>