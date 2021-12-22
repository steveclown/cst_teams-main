<?php
	class hroemployeeattendancediscrepancyckp_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeattendancediscrepancyckp_model(){
			parent::__construct();
			$this->CI = get_instance();
		}	

		public function getCoreLocation(){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getCoreUnit(){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getScheduleEmployeeShift_Location($location_id)
		{
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getScheduleEmployeeShiftItem($employee_shift_id)
		{
			$this->db->select('schedule_employee_shift_item.employee_id, hro_employee_data.employee_name');
			$this->db->from('schedule_employee_shift_item');
			$this->db->join('hro_employee_data', 'schedule_employee_shift_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('schedule_employee_shift_item.employee_shift_id', $employee_shift_id);
			$result = $this->db->get()->result_array();
			return $result;
		}


		public function getHROEmployeeAttendanceData($region_id, $branch_id, $location_id, $start_date, $end_date, $employee_shift_id, $employee_id, $unit_id, $employee_attendance_date_status, $employee_attendance_late_status, $employee_attendance_overtime_status, $employee_attendance_homeearly_status){
			$this->db->select('hro_employee_attendance_data.employee_attendance_data_id, hro_employee_attendance_data.region_id, hro_employee_attendance_data.branch_id, hro_employee_attendance_data.location_id, hro_employee_attendance_data.employee_shift_id, schedule_employee_shift.employee_shift_code, hro_employee_attendance_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_attendance_data.unit_id, core_unit.unit_name, hro_employee_attendance_data.employee_attendance_date, hro_employee_attendance_data.employee_attendance_in_date, hro_employee_attendance_data.employee_attendance_out_date, hro_employee_attendance_data.employee_attendance_working_time_hours, hro_employee_attendance_data.employee_attendance_working_time_minutes, hro_employee_attendance_data.employee_attendance_date_status, hro_employee_attendance_data.employee_attendance_working_status, hro_employee_attendance_data.employee_attendance_late_status, hro_employee_attendance_data.employee_attendance_overtime_status, hro_employee_attendance_data.employee_attendance_homeearly_status ');
			$this->db->from('hro_employee_attendance_data');
			$this->db->join('hro_employee_data', 'hro_employee_attendance_data.employee_id = hro_employee_data.employee_id');
			$this->db->join('schedule_employee_shift', 'hro_employee_attendance_data.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_unit', 'hro_employee_attendance_data.unit_id = core_unit.unit_id');
			$this->db->where('hro_employee_attendance_data.region_id', $region_id);
			$this->db->where('hro_employee_attendance_data.branch_id', $branch_id);
			$this->db->where('hro_employee_attendance_data.location_id', $location_id);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date >=', $start_date);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date <=', $end_date);
			$this->db->where('hro_employee_attendance_data.employee_shift_id', $employee_shift_id);
			$this->db->where('hro_employee_attendance_data.data_state', 0);

			if ($unit_id != ''){
				$this->db->where('hro_employee_attendance_data.unit_id', $unit_id);				
			}

			if ($employee_id != ''){
				$this->db->where('hro_employee_attendance_data.employee_id', $employee_id);				
			}

			if ($employee_attendance_date_status != 8){
				$this->db->where('hro_employee_attendance_data.employee_attendance_date_status', $employee_attendance_date_status);		
			}

			if ($employee_attendance_late_status != 9){
				$this->db->where('hro_employee_attendance_data.employee_attendance_late_status', $employee_attendance_late_status);		
			}

			if ($employee_attendance_overtime_status != 9){
				$this->db->where('hro_employee_attendance_data.employee_attendance_overtime_status', $employee_attendance_overtime_status);		
			}

			if ($employee_attendance_homeearly_status != 9){
				$this->db->where('hro_employee_attendance_data.employee_attendance_homeearly_status', $employee_attendance_homeearly_status);		
			}

			$this->db->order_by('hro_employee_attendance_data.employee_id');
			$this->db->order_by('hro_employee_attendance_data.employee_attendance_date');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name, hro_employee_data.job_title_id, core_job_title.job_title_name, hro_employee_data.region_id, hro_employee_data.branch_id, hro_employee_data.location_id');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
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
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.employee_id, hro_employee_data.employee_name, payroll_overtime_request.overtime_type_id, core_overtime_type.overtime_type_name, payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_hours, payroll_overtime_request.overtime_request_minutes, payroll_overtime_request.overtime_request_remark');
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

		public function getEmployeeAttendanceDateStatus($employee_attendance_data_id){
			$this->db->select('hro_employee_attendance_data.employee_attendance_date_status');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_attendance_data_id', $employee_attendance_data_id);
			$result=$this->db->get()->row_array();
			return $result['employee_attendance_date_status'];
		}

		public function getCorePermit_Detail($permit_id){
			$this->db->select('core_permit.permit_type, core_permit.permit_status');
			$this->db->from('core_permit');
			$this->db->where('core_permit.permit_id', $permit_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result;
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

		public function deleteHROEmployeePermit($data){
			$this->db->where("hro_employee_permit.employee_permit_id", $data['employee_permit_id']);
			$query = $this->db->update('hro_employee_permit', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeePermit_Detail($employee_permit_id){
			$this->db->select('hro_employee_permit.employee_permit_date, hro_employee_permit.employee_attendance_data_id, hro_employee_permit.employee_attendance_date_status');
			$this->db->from('hro_employee_permit');
			$this->db->where('hro_employee_permit.employee_permit_id', $employee_permit_id);
			$result=$this->db->get()->row_array();
			return $result;
		}

		public function getEmployeeAttendanceDateStatusDefault($employee_attendance_data_id){
			$this->db->select('hro_employee_attendance_data.employee_attendance_date_status_default');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_attendance_data_id', $employee_attendance_data_id);
			$result=$this->db->get()->row_array();
			return $result['employee_attendance_date_status_default'];
		}

		public function updateHROEmployeeAttendanceData_Status($data){
			$this->db->where('hro_employee_attendance_data.employee_attendance_data_id', $data['employee_attendance_data_id']);
			$this->db->where('hro_employee_attendance_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_attendance_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateHROEmployeeAttendanceLog($data){
			$this->db->where('hro_employee_attendance_log.employee_id', $data['employee_id']);
			$this->db->where('hro_employee_attendance_log.employee_attendance_log_period', $data['employee_attendance_log_period']);
			$query = $this->db->update('hro_employee_attendance_log', $data);
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

		public function getHROEmployeeAbsence_Detail($employee_absence_id){
			$this->db->select('hro_employee_absence.employee_absence_date, hro_employee_absence.employee_attendance_data_id, hro_employee_absence.employee_attendance_date_status');
			$this->db->from('hro_employee_absence');
			$this->db->where('hro_employee_absence.employee_absence_id', $employee_absence_id);
			$result=$this->db->get()->row_array();
			return $result;
		}

		public function deleteHROEmployeeAbsence($data){
			$this->db->where("hro_employee_absence.employee_absence_id", $data['employee_absence_id']);
			$query = $this->db->update('hro_employee_absence', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertPayrollOvertimeRequest($data){
			return $this->db->insert('payroll_overtime_request',$data);
		}

		public function deletePayrollOvertimeRequest($data){
			$this->db->where("payroll_overtime_request.overtime_request_id", $data['overtime_request_id']);
			$query = $this->db->update('payroll_overtime_request', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeHomeEarly($employee_id){
			$this->db->select('hro_employee_home_early.employee_home_early_id, hro_employee_home_early.employee_id, hro_employee_data.employee_name, hro_employee_home_early.home_early_id, core_home_early.home_early_name, hro_employee_home_early.employee_home_early_date, hro_employee_home_early.employee_home_early_hours, hro_employee_home_early.employee_home_early_minutes, hro_employee_home_early.employee_home_early_description');
			$this->db->from('hro_employee_home_early');
			$this->db->join('hro_employee_data', 'hro_employee_home_early.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_home_early', 'hro_employee_home_early.home_early_id = core_home_early.home_early_id');
			$this->db->where('hro_employee_home_early.data_state', 0);
			$this->db->where('hro_employee_home_early.employee_id', $employee_id);
			$this->db->order_by('hro_employee_home_early.employee_home_early_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreHomeEarly(){
			$this->db->select('core_home_early.home_early_id, core_home_early.home_early_name');
			$this->db->from('core_home_early');
			$this->db->where('core_home_early.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeAttendanceData_HomeEarly($employee_attendance_data_id){
			$this->db->select('hro_employee_attendance_data.employee_attendance_homeearly_hours, hro_employee_attendance_data.employee_attendance_homeearly_minutes');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_attendance_data_id', $employee_attendance_data_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertHROEmployeeHomeEarly($data){
			return $this->db->insert('hro_employee_home_early',$data);
		}

		public function getHROEmployeeHomeEarly_Detail($employee_home_early_id){
			$this->db->select('hro_employee_home_early.employee_home_early_date, hro_employee_home_early.employee_attendance_data_id, hro_employee_home_early.employee_attendance_date_status');
			$this->db->from('hro_employee_home_early');
			$this->db->where('hro_employee_home_early.employee_home_early_id', $employee_home_early_id);
			$result=$this->db->get()->row_array();
			return $result;
		}

		public function deleteHROEmployeeHomeEarly($data){
			$this->db->where("hro_employee_home_early.employee_home_early_id", $data['employee_home_early_id']);
			$query = $this->db->update('hro_employee_home_early', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeAttendanceData_Overtime($employee_attendance_data_id){
			$this->db->select('hro_employee_attendance_data.employee_attendance_overtime_hours, hro_employee_attendance_data.employee_attendance_overtime_minutes, hro_employee_attendance_data.employee_attendance_date_status_default');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_attendance_data_id', $employee_attendance_data_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleDayOff($day_off_date){
			$this->db->select('schedule_day_off.day_off_id');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.day_off_start_date <=', $day_off_date);
			$this->db->where('schedule_day_off.day_off_end_date >=', $day_off_date);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeCancelOff($employee_id){
			$this->db->select('hro_employee_cancel_off.employee_cancel_off_id, hro_employee_cancel_off.employee_id, hro_employee_data.employee_name, hro_employee_cancel_off.employee_cancel_off_date,  hro_employee_cancel_off.employee_cancel_off_description, hro_employee_cancel_off.employee_cancel_off_remark');
			$this->db->from('hro_employee_cancel_off');
			$this->db->join('hro_employee_data', 'hro_employee_cancel_off.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_cancel_off.data_state', 0);
			$this->db->where('hro_employee_cancel_off.employee_id', $employee_id);
			$this->db->order_by('hro_employee_cancel_off.employee_cancel_off_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertHROEmployeeCancelOff($data){
			return $this->db->insert('hro_employee_cancel_off',$data);
		}

		public function getHROEmployeeCancelOff_Detail($employee_cancel_off_id){
			$this->db->select('hro_employee_cancel_off.employee_cancel_off_date, hro_employee_cancel_off.employee_attendance_data_id, hro_employee_cancel_off.employee_attendance_date_status');
			$this->db->from('hro_employee_cancel_off');
			$this->db->where('hro_employee_cancel_off.employee_cancel_off_id', $employee_cancel_off_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function deleteHROEmployeeCancelOff($data){
			$this->db->where("hro_employee_cancel_off.employee_cancel_off_id", $data['employee_cancel_off_id']);
			$query = $this->db->update('hro_employee_cancel_off', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeSwapOff($employee_id){
			$this->db->select('hro_employee_swap_off.employee_swap_off_id, hro_employee_swap_off.employee_id, hro_employee_data.employee_name, hro_employee_swap_off.employee_swap_off_date, hro_employee_swap_off.employee_swap_off_to_date, hro_employee_swap_off.employee_swap_off_description, hro_employee_swap_off.employee_swap_off_remark');
			$this->db->from('hro_employee_swap_off');
			$this->db->join('hro_employee_data', 'hro_employee_swap_off.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_swap_off.data_state', 0);
			$this->db->where('hro_employee_swap_off.employee_id', $employee_id);
			$this->db->order_by('hro_employee_swap_off.employee_swap_off_id', DESC);
			$result = $this->db->get()->result_array();
			return $result;
		}



		public function getEmployeeAttendanceDateStatus_ToDate($employee_id, $employee_attendance_date){
			$this->db->select('hro_employee_attendance_data.employee_attendance_data_id, hro_employee_attendance_data.employee_attendance_date_status');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date', $employee_attendance_date);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertHROEmployeeSwapOff($data){
			return $this->db->insert('hro_employee_swap_off',$data);
		}

		public function getHROEmployeeSwapOff_Detail($employee_swap_off_id){
			$this->db->select('hro_employee_swap_off.employee_swap_off_id, hro_employee_swap_off.employee_swap_off_date, hro_employee_swap_off.employee_swap_off_to_date, hro_employee_swap_off.employee_attendance_data_id, hro_employee_swap_off.employee_attendance_data_id_todate, hro_employee_swap_off.employee_attendance_date_status, hro_employee_swap_off.employee_attendance_date_status_todate');
			$this->db->from('hro_employee_swap_off');
			$this->db->where('hro_employee_swap_off.employee_swap_off_id', $employee_swap_off_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function deleteHROEmployeeSwapOff($data){
			$this->db->where("hro_employee_swap_off.employee_swap_off_id", $data['employee_swap_off_id']);
			$query = $this->db->update('hro_employee_swap_off', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getEmployeeAttendanceDateStatusOld($employee_id, $employee_attendance_date){
			$this->db->select('hro_employee_attendance_data.employee_attendance_date_status');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_data.employee_attendance_date', $employee_attendance_date);
			$result = $this->db->get()->row_array();
			return $result['employee_attendance_date_status'];
		}

		public function getHROEmployeeAttendanceStatus($employee_id){
			$this->db->select('hro_employee_attendance_status.employee_attendance_status_id, hro_employee_attendance_status.employee_id, hro_employee_attendance_status.employee_attendance_data_id, hro_employee_attendance_status.employee_attendance_date, hro_employee_attendance_status.employee_attendance_date_status_old, hro_employee_attendance_status.employee_attendance_date_status, hro_employee_attendance_status.employee_attendance_status_description');
			$this->db->from('hro_employee_attendance_status');
			$this->db->where('hro_employee_attendance_status.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_status.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertHROEmployeeAttendanceStatus($data){
			return $this->db->insert('hro_employee_attendance_status',$data);
		}

		public function getHROEmployeeAttendanceStatus_Detail($employee_id){
			$this->db->select('hro_employee_attendance_status.employee_attendance_status_id, hro_employee_attendance_status.employee_id, hro_employee_attendance_status.employee_attendance_data_id, hro_employee_attendance_status.employee_attendance_date, hro_employee_attendance_status.employee_attendance_date_status_old, hro_employee_attendance_status.employee_attendance_date_status, hro_employee_attendance_status.employee_attendance_status_description, hro_employee_attendance_status.employee_attendance_data_id');
			$this->db->from('hro_employee_attendance_status');
			$this->db->where('hro_employee_attendance_status.employee_attendance_status_id', $employee_attendance_status_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function deleteHROEmployeeAttendanceStatus($data){
			$this->db->where("hro_employee_attendance_status.employee_attendance_status_id", $data['employee_attendance_status_id']);
			$query = $this->db->update('hro_employee_attendance_status', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeAttendanceData($data){
			$this->db->where("hro_employee_attendance_data.employee_attendance_data_id", $data['employee_attendance_data_id']);
			$query = $this->db->update('hro_employee_attendance_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>