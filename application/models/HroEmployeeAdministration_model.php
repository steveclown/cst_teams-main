<?php
	class HroEmployeeAdministration_model extends CI_Model {
		var $table = "transaction_employee_late";
		
		public function __construct(){
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

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeData_Administration($region_id, $data_branch, $branch_status, $branch_id, $payroll_employee_level, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name,  hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name');
			$this->db->from('hro_employee_data');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_status !=', 9);
			$this->db->where('hro_employee_data.region_id', $region_id);

			if($payroll_employee_level != 9 ){
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

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeLate($employee_id){
			$this->db->select('hro_employee_late.employee_late_id, hro_employee_late.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_late.late_id, core_late.late_name, hro_employee_late.employee_late_date, hro_employee_late.employee_late_duration, hro_employee_late.employee_late_description, hro_employee_late.employee_late_remark');
			$this->db->from('hro_employee_late');
			$this->db->join('hro_employee_data', 'hro_employee_late.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_late', 'hro_employee_late.late_id = core_late.late_id');
			$this->db->where('hro_employee_late.data_state',0);
			$this->db->where('hro_employee_late.employee_id', $employee_id);
			$this->db->order_by('hro_employee_late.employee_late_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreLate(){
			$this->db->select('core_late.late_id, core_late.late_name');
			$this->db->from('core_late');
			$this->db->where('core_late.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeePermit($employee_id){
			$this->db->select('hro_employee_permit.employee_permit_id, hro_employee_permit.employee_id, hro_employee_data.employee_name, hro_employee_permit.permit_id, core_permit.permit_name, hro_employee_permit.employee_permit_date, hro_employee_permit.employee_permit_start_date, hro_employee_permit.employee_permit_end_date, hro_employee_permit.employee_permit_duration, hro_employee_permit.employee_permit_description, hro_employee_permit.employee_permit_remark');
			$this->db->from('hro_employee_permit');
			$this->db->join('hro_employee_data', 'hro_employee_permit.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_permit', 'hro_employee_permit.permit_id = core_permit.permit_id');
			$this->db->where('hro_employee_permit.data_state',0);
			$this->db->where('hro_employee_permit.employee_id', $employee_id);
			$this->db->order_by('hro_employee_permit.employee_permit_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCorePermit(){
			$this->db->select('core_permit.permit_id, core_permit.permit_name');
			$this->db->from('core_permit');
			$this->db->where('core_permit.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAbsence($employee_id){
			$this->db->select('hro_employee_absence.employee_absence_id, hro_employee_absence.employee_id, hro_employee_data.employee_name, hro_employee_absence.absence_id, core_absence.absence_name, hro_employee_absence.employee_absence_date, hro_employee_absence.employee_absence_start_date, hro_employee_absence.employee_absence_end_date, hro_employee_absence.employee_absence_duration, hro_employee_absence.employee_absence_description, hro_employee_absence.employee_absence_remark');
			$this->db->from('hro_employee_absence');
			$this->db->join('hro_employee_data', 'hro_employee_absence.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_absence', 'hro_employee_absence.absence_id = core_absence.absence_id');
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->where('hro_employee_absence.employee_id', $employee_id);
			$this->db->order_by('hro_employee_absence.employee_absence_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreAbsence(){
			$this->db->select('core_absence.absence_id, core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollOvertimeRequest($employee_id){
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.employee_id, hro_employee_data.employee_name, payroll_overtime_request.overtime_type_id, core_overtime_type.overtime_type_name, payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_remark');
			$this->db->from('payroll_overtime_request');
			$this->db->join('hro_employee_data', 'payroll_overtime_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_overtime_type', 'payroll_overtime_request.overtime_type_id = core_overtime_type.overtime_type_id');
			$this->db->where('payroll_overtime_request.data_state',0);
			$this->db->where('payroll_overtime_request.employee_id', $employee_id);
			$this->db->order_by('payroll_overtime_request.overtime_request_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreOvertimeType(){
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_name');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollLeaveRequest($employee_id){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, hro_employee_data.employee_name, payroll_leave_request.annual_leave_id, core_annual_leave.annual_leave_name, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_start_date, payroll_leave_request.leave_request_end_date, payroll_leave_request.leave_request_duration');
			$this->db->from('payroll_leave_request');
			$this->db->join('hro_employee_data', 'payroll_leave_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_annual_leave', 'payroll_leave_request.annual_leave_id = core_annual_leave.annual_leave_id');
			$this->db->where('payroll_leave_request.data_state', 0);
			$this->db->where('payroll_leave_request.employee_id', $employee_id);
			$this->db->order_by('payroll_leave_request.leave_request_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreAnnualLeave(){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertHROEmployeeLate($data){
			return $this->db->insert('hro_employee_late',$data);
		}

		public function deleteHROEmployeeLate($employee_late_id){
			$this->db->where("hro_employee_late.employee_late_id", $employee_late_id);
			$query = $this->db->update('hro_employee_late', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getPermitType($permit_id){
			$this->db->select('core_permit.permit_type');
			$this->db->from('core_permit');
			$this->db->where('core_permit.permit_id', $permit_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['permit_type'];
		}

		public function insertHROEmployeePermit($data){
			return $this->db->insert('hro_employee_permit',$data);
		}

		public function getEmployeePermitID($created_id){
			$this->db->select('hro_employee_permit.employee_permit_id');
			$this->db->from('hro_employee_permit');
			$this->db->where('hro_employee_permit.created_id', $created_id);
			$this->db->where('hro_employee_permit.data_state',0);
			$this->db->order_by('hro_employee_permit.employee_permit_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['employee_permit_id'];
		}

		public function getDayOffDate($dayoff_date){
			$this->db->select('schedule_day_off.day_off_id');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.day_off_start_date <=', $dayoff_date);
			$this->db->where('schedule_day_off.day_off_end_date >=', $dayoff_date);
			$this->db->where('schedule_day_off.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertHROEmployeePermit_Detail($data){
			return $this->db->insert('hro_employee_permit_detail',$data);
		}

		public function deleteHROEmployeePermit($employee_permit_id){
			$this->db->where("hro_employee_permit.employee_permit_id", $employee_permit_id);
			$query = $this->db->update('hro_employee_permit', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeAbsence($data){
			return $this->db->insert('hro_employee_absence',$data);
		}

		public function getEmployeeAbsenceID($created_id){
			$this->db->select('hro_employee_absence.employee_absence_id');
			$this->db->from('hro_employee_absence');
			$this->db->where('hro_employee_absence.created_id', $created_id);
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->order_by('hro_employee_absence.employee_absence_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['employee_absence_id'];
		}

		public function insertHROEmployeeAbsence_Detail($data){
			return $this->db->insert('hro_employee_absence_detail',$data);
		}

		public function deleteHROEmployeeAbsence($employee_absence_id){
			$this->db->where("hro_employee_absence.employee_absence_id", $employee_absence_id);
			$query = $this->db->update('hro_employee_absence', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertPayrollOvertimeRequest($data){
			return $this->db->insert('payroll_overtime_request',$data);
		}

		public function deletePayrollOvertimeRequest($overtime_request_id){
			$this->db->where("payroll_overtime_request.overtime_request_id", $overtime_request_id);
			$query = $this->db->update('payroll_overtime_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertPayrollLeaveRequest($data){
			return $this->db->insert('payroll_leave_request', $data);
		}

		public function getLeaveRequestID($created_id){
			$this->db->select('payroll_leave_request.leave_request_id');
			$this->db->from('payroll_leave_request');
			$this->db->where('payroll_leave_request.created_id', $created_id);
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->order_by('payroll_leave_request.leave_request_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['leave_request_id'];
		}

		public function insertPayrollLeaveRequest_Detail($data){
			return $this->db->insert('payroll_leave_request_detail',$data);
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

		

		public function getLateName($late_id){
			$this->db->select('core_late.late_name');
			$this->db->from('core_late');
			$this->db->where('core_late.late_id', $late_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['late_name'];
		}
		
		

		
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_late_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEditHroEmployeeAdministration($data){
			$this->db->where('employee_late_id',$data['employee_late_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		
	}
?>