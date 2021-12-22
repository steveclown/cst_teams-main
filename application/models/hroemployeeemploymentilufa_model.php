<?php
	class hroemployeeemploymentilufa_model extends CI_Model {
		var $table = "transaction_employee_late";
		
		public function hroemployeeemploymentilufa_model(){
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

		public function getCoreAward(){
			$this->db->select('core_award.award_id, core_award.award_name');
			$this->db->from('core_award');
			$this->db->where('core_award.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreWarning(){
			$this->db->select('core_warning.warning_id, core_warning.warning_name');
			$this->db->from('core_warning');
			$this->db->where('core_warning.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSuspend(){
			$this->db->select('core_suspend.suspend_id, core_suspend.suspend_name');
			$this->db->from('core_suspend');
			$this->db->where('core_suspend.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreAnnualLeave(){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSeparationReason(){
			$this->db->select('core_separation_reason.separation_reason_id, core_separation_reason.separation_reason_name');
			$this->db->from('core_separation_reason');
			$this->db->where('core_separation_reason.data_state',0);
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

		public function getHROEmployeeData_Employment($region_id, $data_branch, $branch_status, $branch_id, $payroll_employee_level, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.branch_id, core_branch.branch_name, hro_employee_data.location_id, core_location.location_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.employee_hire_date, hro_employee_data.employee_employment_working_status');
			$this->db->from('hro_employee_data');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_status !=', 9);
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


			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAward($employee_id){
			$this->db->select('hro_employee_award.employee_award_id, hro_employee_award.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_award.employee_award_date, hro_employee_award.award_id, core_award.award_name, hro_employee_award.employee_award_description, hro_employee_award.employee_award_remark');
			$this->db->from('hro_employee_award');
			$this->db->join('hro_employee_data', 'hro_employee_award.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_award', 'hro_employee_award.award_id = core_award.award_id');
			$this->db->where('hro_employee_award.data_state', 0);
			$this->db->where('hro_employee_award.employee_id', $employee_id);
			$this->db->order_by('hro_employee_award.employee_award_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeWarning($employee_id){
			$this->db->select('hro_employee_warning.employee_warning_id, hro_employee_warning.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_warning.employee_warning_date, hro_employee_warning.warning_id, core_warning.warning_name, hro_employee_warning.employee_warning_description, hro_employee_warning.employee_warning_remark');
			$this->db->from('hro_employee_warning');
			$this->db->join('hro_employee_data', 'hro_employee_warning.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_warning', 'hro_employee_warning.warning_id = core_warning.warning_id');
			$this->db->where('hro_employee_warning.data_state', 0);
			$this->db->where('hro_employee_warning.employee_id', $employee_id);
			$this->db->order_by('hro_employee_warning.employee_warning_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeSuspend($employee_id){
			$this->db->select('hro_employee_suspend.employee_suspend_id, hro_employee_suspend.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_suspend.employee_suspend_date, hro_employee_suspend.suspend_id, core_suspend.suspend_name, hro_employee_suspend.employee_suspend_description, hro_employee_suspend.employee_suspend_days, hro_employee_suspend.employee_suspend_status, hro_employee_suspend.employee_suspend_status_date, hro_employee_suspend.employee_suspend_remark');
			$this->db->from('hro_employee_suspend');
			$this->db->join('hro_employee_data', 'hro_employee_suspend.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_suspend', 'hro_employee_suspend.suspend_id = core_suspend.suspend_id');
			$this->db->where('hro_employee_suspend.data_state', 0);
			$this->db->where('hro_employee_suspend.employee_id', $employee_id);
			$this->db->order_by('hro_employee_suspend.employee_suspend_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPayrollLeaveRequest($employee_id){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, payroll_leave_request.annual_leave_id, core_annual_leave.annual_leave_name, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_duration, 
				payroll_leave_request.leave_request_start_date, payroll_leave_request.leave_request_end_date, payroll_leave_request.leave_request_reason');
			$this->db->from('payroll_leave_request');
			$this->db->join('core_annual_leave', 'payroll_leave_request.annual_leave_id = core_annual_leave.annual_leave_id');
			$this->db->where('payroll_leave_request.data_state', 0);
			$this->db->where('payroll_leave_request.employee_id', $employee_id);
			$this->db->order_by('payroll_leave_request.leave_request_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeSeparation($employee_id){
			$this->db->select('hro_employee_separation.employee_separation_id, hro_employee_separation.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_separation.employee_separation_date, hro_employee_separation.separation_reason_id, core_separation_reason.separation_reason_name, hro_employee_separation.employee_separation_description, hro_employee_separation.employee_separation_remark');
			$this->db->from('hro_employee_separation');
			$this->db->join('hro_employee_data', 'hro_employee_separation.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_separation_reason', 'hro_employee_separation.separation_reason_id = core_separation_reason.separation_reason_id');
			$this->db->where('hro_employee_separation.data_state', 0);
			$this->db->where('hro_employee_separation.employee_id', $employee_id);
			$this->db->order_by('hro_employee_separation.employee_separation_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertHROEmployeeAward($data){
			return $this->db->insert('hro_employee_award', $data);
		}

		public function deleteHROEmployeeAward($data){
			$this->db->where("hro_employee_award.employee_award_id", $data['employee_award_id']);
			$query = $this->db->update('hro_employee_award', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeWarning($data){
			return $this->db->insert('hro_employee_warning', $data);
		}

		public function deleteHROEmployeeWarning($data){
			$this->db->where("hro_employee_warning.employee_warning_id", $data['employee_warning_id']);
			$query = $this->db->update('hro_employee_warning', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function checkEmployeeSuspendStatus($data){
			$this->db->select('hro_employee_suspend.employee_suspend_id');
			$this->db->from('hro_employee_suspend');
			$this->db->where('hro_employee_suspend.data_state', 0);
			$this->db->where('hro_employee_suspend.employee_id', $data['employee_id']);
			$this->db->where('hro_employee_suspend.employee_suspend_status', 1);
			$result = $this->db->get()->num_rows();
			if ($result > 0) {
				return false;
			} else {
				return true;
			}
		}

		public function insertHROEmployeeSuspend($data){
			return $this->db->insert('hro_employee_suspend', $data);
		}

		public function updateHROEmployeeData($data){
			$this->db->where("hro_employee_data.employee_id", $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeSuspend($data){
			$this->db->where("hro_employee_suspend.employee_suspend_id", $data['employee_suspend_id']);
			$query = $this->db->update('hro_employee_suspend', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function unsuspendHROEmployeeSuspend($data){
			$this->db->where("hro_employee_suspend.employee_suspend_id", $data['employee_suspend_id']);
			$query = $this->db->update('hro_employee_suspend', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertPayrollLeaveRequest($data){
			return $this->db->insert('payroll_leave_request',$data);
		}

		public function getDayOffDate($dayoff_date){
			$this->db->select('schedule_day_off.day_off_id');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.day_off_start_date <=', $dayoff_date);
			$this->db->where('schedule_day_off.day_off_end_date >=', $dayoff_date);
			$this->db->where('schedule_day_off.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function insertPayrollLeaveRequest_Detail($data){
			return $this->db->insert('payroll_leave_request_detail',$data);
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

		public function deletePayrollLeaveRequest($leave_request_id){
			$this->db->where("payroll_leave_request.leave_request_id", $leave_request_id);
			$query = $this->db->update('payroll_leave_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeSeparation($data){
			return $this->db->insert('hro_employee_separation', $data);
		}

		public function deleteHROEmployeeSeparation($data){
			$this->db->where("hro_employee_separation.employee_separation_id", $data['employee_separation_id']);
			$query = $this->db->update('hro_employee_separation', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>