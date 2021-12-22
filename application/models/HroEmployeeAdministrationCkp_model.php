<?php
	class HroEmployeeAdministrationCkp_model extends CI_Model {
		var $table = "transaction_employee_late";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getScheduleEmployeeShift($region_id, $branch_id, $location_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.region_id', $region_id);
			$this->db->where('schedule_employee_shift.branch_id', $branch_id);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getScheduleEmployeeShiftItem($location_id, $employee_shift_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code, schedule_employee_shift_item.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, schedule_employee_shift_item.department_id, core_department.department_name, schedule_employee_shift_item.section_id, core_section.section_name, schedule_employee_shift_item.unit_id, core_location.location_id, core_unit.unit_name, core_division.division_name');
			$this->db->from('schedule_employee_shift');
			$this->db->join('schedule_employee_shift_item', 'schedule_employee_shift.employee_shift_id = schedule_employee_shift_item.employee_shift_id');
			$this->db->join('hro_employee_data', 'schedule_employee_shift_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_department', 'schedule_employee_shift_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'schedule_employee_shift_item.section_id = core_section.section_id');
			$this->db->join('core_unit', 'schedule_employee_shift_item.unit_id = core_unit.unit_id');
			$this->db->join('core_division', 'schedule_employee_shift_item.division_id = core_division.division_id');
			$this->db->join('core_location','schedule_employee_shift_item.location_id = core_location.location_id' );
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			$this->db->where('schedule_employee_shift.employee_shift_id', $employee_shift_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreLocation(){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getScheduleEmployeeShift_Location($location_id)
		{
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			return $this->db->get()->result_array();
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
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.region_id,core_division.division_name, hro_employee_data.branch_id, hro_employee_data.location_id');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getScheduleEmployeeScheduleItem($employee_id, $start_date, $end_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.employee_schedule_item_date, schedule_employee_schedule_item.employee_schedule_item_status');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date >=', $start_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date <=', $end_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_log_status', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeePermit($employee_id){
			$this->db->select('hro_employee_permit.employee_permit_id, hro_employee_permit.employee_id, hro_employee_data.employee_name, hro_employee_permit.permit_id, core_permit.permit_name, hro_employee_permit.employee_permit_date, hro_employee_permit.employee_permit_start_date, hro_employee_permit.employee_permit_end_date, hro_employee_permit.employee_permit_duration, hro_employee_permit.employee_permit_description, hro_employee_permit.employee_permit_remark');
			$this->db->from('hro_employee_permit');
			$this->db->join('hro_employee_data', 'hro_employee_permit.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_permit', 'hro_employee_permit.permit_id = core_permit.permit_id');
			$this->db->where('hro_employee_permit.data_state',0);
			$this->db->where('hro_employee_permit.employee_id', $employee_id);
			$this->db->order_by('hro_employee_permit.employee_permit_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCorePermit(){
			$this->db->select('core_permit.permit_id, core_permit.permit_name');
			$this->db->from('core_permit');
			$this->db->where('core_permit.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeAbsence($employee_id){
			$this->db->select('hro_employee_absence.employee_absence_id, hro_employee_absence.employee_id, hro_employee_data.employee_name, hro_employee_absence.absence_id, core_absence.absence_name, hro_employee_absence.employee_absence_date, hro_employee_absence.employee_absence_start_date, hro_employee_absence.employee_absence_end_date, hro_employee_absence.employee_absence_duration, hro_employee_absence.employee_absence_description, hro_employee_absence.employee_absence_remark');
			$this->db->from('hro_employee_absence');
			$this->db->join('hro_employee_data', 'hro_employee_absence.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_absence', 'hro_employee_absence.absence_id = core_absence.absence_id');
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->where('hro_employee_absence.employee_id', $employee_id);
			$this->db->order_by('hro_employee_absence.employee_absence_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreAbsence(){
			$this->db->select('core_absence.absence_id, core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getPayrollOvertimeRequest($employee_id){
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.employee_id, hro_employee_data.employee_name, payroll_overtime_request.overtime_type_id, core_overtime_type.overtime_type_name, payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_duration, payroll_overtime_request.overtime_request_remark');
			$this->db->from('payroll_overtime_request');
			$this->db->join('hro_employee_data', 'payroll_overtime_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_overtime_type', 'payroll_overtime_request.overtime_type_id = core_overtime_type.overtime_type_id');
			$this->db->where('payroll_overtime_request.data_state',0);
			$this->db->where('payroll_overtime_request.employee_id', $employee_id);
			$this->db->order_by('payroll_overtime_request.overtime_request_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreOvertimeType(){
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_name');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getPayrollLeaveRequest($employee_id){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, hro_employee_data.employee_name, payroll_leave_request.annual_leave_id, core_annual_leave.annual_leave_name, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_duration');
			$this->db->from('payroll_leave_request');
			$this->db->join('hro_employee_data', 'payroll_leave_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_annual_leave', 'payroll_leave_request.annual_leave_id = core_annual_leave.annual_leave_id');
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->where('payroll_leave_request.employee_id', $employee_id);
			$this->db->order_by('payroll_leave_request.annual_leave_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreAnnualLeave(){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
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
			$result = $this->db->get();
			return $result->result_array();
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

		public function getEmployeeScheduleItemStatusDefault($employee_schedule_item_id){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_status_default');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_id', $employee_schedule_item_id);
			$result=$this->db->get()->row_array();
			return $result['employee_schedule_item_status_default'];
		}

		public function updateScheduleEmployeeScheduleItem_Status($data){
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_id', $data['employee_schedule_item_id']);
			$query = $this->db->update('schedule_employee_schedule_item', $data);
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

		public function insertPayrollLeaveRequest($data){
			return $this->db->insert('payroll_leave_request',$data);
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

		public function deletePayrollLeaveRequest($leave_request_id){
			$this->db->where("payroll_leave_request.leave_request_id", $leave_request_id);
			$query = $this->db->update('payroll_leave_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeCancelOff($employee_id){
			$this->db->select('hro_employee_cancel_off.employee_cancel_off_id, hro_employee_cancel_off.employee_id, hro_employee_data.employee_name, hro_employee_cancel_off.employee_cancel_off_date,  hro_employee_cancel_off.employee_cancel_off_description, hro_employee_cancel_off.employee_cancel_off_remark');
			$this->db->from('hro_employee_cancel_off');
			$this->db->join('hro_employee_data', 'hro_employee_cancel_off.employee_id = hro_employee_data.employee_id');
			$this->db->where('hro_employee_cancel_off.data_state', 0);
			$this->db->where('hro_employee_cancel_off.employee_id', $employee_id);
			$this->db->order_by('hro_employee_cancel_off.employee_cancel_off_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function insertHROEmployeeCancelOff($data){
			return $this->db->insert('hro_employee_cancel_off',$data);
		}

		public function deleteHROEmployeeCancelOff($employee_cancel_off_id){
			$this->db->where("hro_employee_cancel_off.employee_cancel_off_id", $employee_cancel_off_id);
			$query = $this->db->update('hro_employee_cancel_off', array("data_state"=>1));
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
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getEmployeeScheduleItemStatus_ToDate($employee_id, $employee_schedule_item_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_schedule_item_status');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_schedule_item_date);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertHROEmployeeSwapOff($data){
			return $this->db->insert('hro_employee_swap_off',$data);
		}

		public function deleteHROEmployeeSwapOff($employee_swap_off_id){
			$this->db->where("hro_employee_swap_off.employee_swap_off_id", $employee_swap_off_id);
			$query = $this->db->update('hro_employee_swap_off', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeData_LastDayOff($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_last_day_off, hro_employee_data.employee_day_off_cycle, hro_employee_data.employee_day_off_status');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function updateHROEmployeeData_LastDayOff($data){
			$this->db->where('hro_employee_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeData_RFIDCode($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_rfid_code');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeChangeRFID($employee_id){
			$this->db->select('hro_employee_change_rfid.employee_id, hro_employee_change_rfid.employee_change_rfid_date, hro_employee_change_rfid.employee_rfid_code_old, hro_employee_change_rfid.employee_rfid_code, hro_employee_change_rfid.employee_change_rfid_reason');
			$this->db->from('hro_employee_change_rfid');
			$this->db->where('hro_employee_change_rfid.data_state', 0);
			$this->db->where('hro_employee_change_rfid.employee_id', $employee_id);
			$this->db->order_by('hro_employee_change_rfid.employee_change_rfid_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeUpdateDayOff($employee_id){
			$this->db->select('hro_employee_update_dayoff.employee_update_dayoff_id, hro_employee_update_dayoff.employee_id, hro_employee_update_dayoff.employee_update_dayoff_date, hro_employee_update_dayoff.employee_last_day_off, hro_employee_update_dayoff.employee_day_off_cycle, hro_employee_update_dayoff.employee_update_dayoff_reason');
			$this->db->from('hro_employee_update_dayoff');
			$this->db->where('hro_employee_update_dayoff.data_state', 0);
			$this->db->where('hro_employee_update_dayoff.employee_id', $employee_id);
			$this->db->order_by('hro_employee_update_dayoff.employee_update_dayoff_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertHROEmployeeChangeRFID($data){
			return $this->db->insert('hro_employee_change_rfid',$data);
		}

		public function updateHROEmployeeData_RFIDCode($data){
			$this->db->where('hro_employee_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateScheduleEmployeScheduleItem_RFIDCode($data, $employee_schedule_item_date){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date >=', $employee_schedule_item_date);
			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateScheduleEmployeeShiftItem_RFIDCode($data){
			$this->db->where('schedule_employee_shift_item.employee_id', $data['employee_id']);
			$query = $this->db->update('schedule_employee_shift_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeData_ShiftGroup($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.location_id, core_location.location_name, hro_employee_data.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('hro_employee_data');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->join('schedule_employee_shift', 'hro_employee_data.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getHROEmployeeChangeGroup($employee_id){
			$this->db->select('hro_employee_change_group.employee_id, hro_employee_change_group.location_id_old, hro_employee_change_group.employee_shift_id_old, hro_employee_change_group.location_id, core_location.location_name, hro_employee_change_group.employee_shift_id, schedule_employee_shift.employee_shift_code, hro_employee_change_group.employee_change_group_date, hro_employee_change_group.employee_change_group_reason');
			$this->db->from('hro_employee_change_group');
			$this->db->join('core_location', 'hro_employee_change_group.location_id = core_location.location_id');
			$this->db->join('schedule_employee_shift', 'hro_employee_change_group.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('hro_employee_change_group.data_state', 0);
			$this->db->where('hro_employee_change_group.employee_id', $employee_id);
			$this->db->order_by('hro_employee_change_group.employee_change_group_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
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

		public function updateScheduleEmployeeScheduleItem($data){
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_id', $data['employee_schedule_item_id']);
			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeChangeGroup($data){
			return $this->db->insert('hro_employee_change_group',$data);
		}

		public function updateHROEmployeeData_ShiftGroup($data){
			$this->db->where('hro_employee_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		/*public function updateScheduleEmployeScheduleItem_RFIDCode($data, $employee_schedule_item_date){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date >=', $employee_schedule_item_date);
			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}*/

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			$this->db->where('core_location.location_id', $location_id);
			$result = $this->db->get()->row_array();
			return $result['location_name'];
		}

		public function getEmployeeShiftCode($employee_shift_id){
			$this->db->select('schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.data_state', 0);
			$this->db->where('schedule_employee_shift.employee_shift_id', $employee_shift_id);
			$result = $this->db->get()->row_array();
			return $result['employee_shift_code'];
		}

		public function getScheduleShiftPattern(){
			$this->db->select('schedule_shift_pattern.shift_pattern_id, schedule_shift_pattern.shift_pattern_name');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeWorkingMinute(){
			$this->db->select('preference_company.employee_working_in_start_minute, preference_company.employee_working_in_start_minute, preference_company.employee_working_out_start_minute, preference_company.employee_working_out_end_minute');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertScheduleShiftAssignment($data){
			return $this->db->insert('schedule_shift_assignment',$data);
		}

		public function getShiftAssignmentID($created_id)
		{
			$this->db->select('schedule_shift_assignment.shift_assignment_id');
			$this->db->from('schedule_shift_assignment');
			$this->db->where('schedule_shift_assignment.created_id', $created_id);
			$this->db->order_by('schedule_shift_assignment.shift_assignment_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['shift_assignment_id'];
		}

		public function insertScheduleShiftAssignmentItem($data){
			return $this->db->insert('schedule_shift_assignment_item',$data);
		}

		public function insertScheduleEmployeeSchedule($data){
			return $this->db->insert('schedule_employee_schedule',$data);
		}

		public function getEmployeeScheduleID($created_id)
		{
			$this->db->select('schedule_employee_schedule.employee_schedule_id');
			$this->db->from('schedule_employee_schedule');
			$this->db->where('schedule_employee_schedule.created_id', $created_id);
			$this->db->order_by('schedule_employee_schedule.employee_schedule_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_id'];
		}

		public function getScheduleShiftPattern_Detail($shift_pattern_id){
			$this->db->select('schedule_shift_pattern.shift_pattern_id, schedule_shift_pattern.shift_pattern_code, schedule_shift_pattern.shift_pattern_name, schedule_shift_pattern.shift_pattern_weekly, schedule_shift_pattern.shift_pattern_cycle,schedule_shift_pattern.shift_pattern_day');
			$this->db->from('schedule_shift_pattern');
			$this->db->where('schedule_shift_pattern.shift_pattern_id',$shift_pattern_id);
			return $this->db->get()->row_array();
		}
		
		public function getScheduleShiftPatternItem_Detail($shift_pattern_id){
			$this->db->select('schedule_shift_pattern_item.shift_pattern_item_id, schedule_shift_pattern_item.shift_pattern_id, schedule_shift_pattern_item.shift_id, core_shift.shift_name, core_shift.start_working_hour, core_shift.end_working_hour, schedule_shift_pattern_item.shift_next_day, schedule_shift_pattern_item.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_shift_pattern_item');
			$this->db->join('schedule_shift_pattern','schedule_shift_pattern_item.shift_pattern_id = schedule_shift_pattern.shift_pattern_id');
			$this->db->join('schedule_employee_shift','schedule_shift_pattern_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_shift','schedule_shift_pattern_item.shift_id = core_shift.shift_id');
			$this->db->where('schedule_shift_pattern_item.shift_pattern_id', $shift_pattern_id);
			$this->db->order_by('schedule_shift_pattern_item.shift_pattern_item_id','ASC');
			return $this->db->get()->result_array();
		}

		public function getScheduleEmployeeShiftItem_Detail($employee_shift_id, $employee_id){
			$this->db->select('schedule_employee_shift_item.employee_shift_id, schedule_employee_shift_item.employee_id, schedule_employee_shift_item.region_id, schedule_employee_shift_item.branch_id, schedule_employee_shift_item.location_id, schedule_employee_shift_item.division_id, schedule_employee_shift_item.department_id, schedule_employee_shift_item.section_id, schedule_employee_shift_item.unit_id, schedule_employee_shift_item.employee_rfid_code');
			$this->db->from('schedule_employee_shift_item');
			$this->db->where('schedule_employee_shift_item.employee_shift_id', $employee_shift_id);
			$this->db->where('schedule_employee_shift_item.employee_id', $employee_id);
			return $this->db->get()->result_array();

		}

		public function insertScheduleEmployeeScheduleItem($data){
			return $this->db->insert('schedule_employee_schedule_item',$data);
		}

		public function insertScheduleEmployeeScheduleShift($data){
			return $this->db->insert('schedule_employee_schedule_shift', $data);
		}

		public function getEmployeeID_Schedule($shift_assignment_id, $employee_id){
			$this->db->select('schedule_employee_schedule_item.employee_id');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.shift_assignment_id', $shift_assignment_id);
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getHROEmployeeData_DayOff($employee_id){
			$this->db->select('hro_employee_data.employee_last_day_off, hro_employee_data.employee_day_off_cycle');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getLastEmployeeScheduleItemDate($shift_assignment_id){
			$this->db->select_max('schedule_employee_schedule_item.employee_schedule_item_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.shift_assignment_id', $shift_assignment_id);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_item_date'];
		}

		public function getScheduleEmployeeItemDate($shift_assignment_id, $employee_id, $employee_schedule_item_date, $last_employee_schedule_item_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.shift_assignment_id', $shift_assignment_id);
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_schedule_item_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date <= ', $last_employee_schedule_item_date);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_item_id'];
		}

		public function updateHROEmployeeData_DayOff($data){
			$this->db->where('hro_employee_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeData_DayOffStatus($employee_id){
			$this->db->select('hro_employee_data.employee_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_day_off_status', 1);
			$this->db->where('hro_employee_data.employee_id', 1);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getScheduleDayOffItem(){
			$this->db->select('schedule_day_off_item.day_off_item_date');
			$this->db->from('schedule_day_off_item');
			$this->db->join('schedule_day_off', 'schedule_day_off_item.day_off_id = schedule_day_off.day_off_id');
			$this->db->where('schedule_day_off.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateScheduleEmployeeScheduleItem_DayOff($data){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $data['employee_schedule_item_date']);

			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeUpdateDayOff($data){
			return $this->db->insert('hro_employee_update_dayoff',$data);
		}

		public function updateScheduleEmployeeScheduleItem_UpdateDayOff($data){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date >=', $data['employee_schedule_item_date']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_status_default', 0);

			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateScheduleEmployeeScheduleItem_UpdateDayOffEdit($data){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $data['employee_schedule_item_date']);

			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getLastEmployeeScheduleItemDate_Employee($employee_id){
			$this->db->select_max('schedule_employee_schedule_item.employee_schedule_item_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_schedule_item_date'];
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

		public function saveEdithroemployeeadministrationckp($data){
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