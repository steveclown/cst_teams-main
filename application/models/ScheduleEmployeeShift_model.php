<?php
	class ScheduleEmployeeShift_model extends CI_Model {
		var $table = "schedule_employee_shift";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getScheduleEmployeeShift($region_id, $branch_id, $location_id/*, $payroll_employee_level*/)
		{
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.location_id, core_location.location_name, schedule_employee_shift.division_id, core_division.division_name, schedule_employee_shift.employee_shift_code,  schedule_employee_shift.employee_shift_status ');
			$this->db->from('schedule_employee_shift');
			$this->db->join('core_location','schedule_employee_shift.location_id = core_location.location_id');
			$this->db->join('core_division','schedule_employee_shift.division_id = core_division.division_id');
			$this->db->where('schedule_employee_shift.data_state', 0);
			if (!empty($region_id)){
					$this->db->where('schedule_employee_shift.region_id', $region_id);
			}
			if (!empty($branch_id)){
				$this->db->where('schedule_employee_shift.branch_id', $branch_id);
			}

			/*if ($payroll_employee_level == 9){*/
				if (!empty($location_id)){
					$this->db->where('schedule_employee_shift.location_id', $location_id);	
				}
			/*} else {
				$this->db->where('schedule_employee_shift.location_id', $location_id);	
			}*/
			
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreLocation()
		{
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;		
		}
		
		public function getCoreDivision()
		{
			$this->db->select('division_id, division_name');
			$this->db->from('core_division');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;		
		}

		public function getCoreDivisionName($division_id)
		{
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getCoreDepartmentData()
		{
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id)
		{
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getDepartmentName($department_id)
		{
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getCoreSection($department_id)
		{
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSectionName($section_id)
		{
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getCoreUnit($section_id)
		{
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.section_id', $section_id);
			$this->db->where('core_unit.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getUnitName($unit_id)
		{
			$this->db->select('core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.unit_id', $unit_id);
			$result = $this->db->get()->row_array();
			return $result['unit_name'];
		}

		public function getHroEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $unit_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$this->db->where('hro_employee_data.unit_id', $unit_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeName($employee_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getCoreShift()
		{
			$this->db->select('shift_id, shift_name');
			$this->db->from('core_shift');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

		public function insertScheduleEmployeeShift($data_scheduleemployeeshift){
			return $this->db->insert('schedule_employee_shift',$data_scheduleemployeeshift);
			print_r('simpan');
		}

		public function getEmployeeShiftID($created_id)
		{
			$this->db->select('schedule_employee_shift.employee_shift_id');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.created_id', $created_id);
			$this->db->order_by('schedule_employee_shift.employee_shift_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_shift_id'];
		}

		public function insertScheduleEmployeeShiftItem($data_scheduleemployeeshiftitem){
			return $this->db->insert('schedule_employee_shift_item',$data_scheduleemployeeshiftitem);
		}

		public function updateHROEmployeeData($data){
			$this->db->where('hro_employee_data.employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getScheduleEmployeeShift_Detail($employee_shift_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.location_id, core_location.location_name, schedule_employee_shift.division_id, core_division.division_name, schedule_employee_shift.employee_shift_code, schedule_employee_shift.employee_shift_status');
			$this->db->from('schedule_employee_shift');
			$this->db->join('core_location', 'schedule_employee_shift.location_id = core_location.location_id');
			$this->db->join('core_division', 'schedule_employee_shift.division_id = core_division.division_id');
			$this->db->where('schedule_employee_shift.employee_shift_id', $employee_shift_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getScheduleEmployeeShiftItem_Detail($employee_shift_id){
			$this->db->select('schedule_employee_shift_item.employee_shift_item_id, schedule_employee_shift_item.employee_shift_id, schedule_employee_shift_item.department_id, schedule_employee_shift_item.branch_id, schedule_employee_shift_item.region_id, schedule_employee_shift_item.division_id, schedule_employee_shift_item.location_id, schedule_employee_shift_item.employee_rfid_code ,core_department.department_name, schedule_employee_shift_item.section_id, core_section.section_name, schedule_employee_shift_item.unit_id, core_unit.unit_name,  schedule_employee_shift_item.employee_id, hro_employee_data.employee_name');
			$this->db->from('schedule_employee_shift_item');
			$this->db->join('schedule_employee_shift','schedule_employee_shift_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_department','schedule_employee_shift_item.department_id = core_department.department_id');
			$this->db->join('core_section','schedule_employee_shift_item.section_id = core_section.section_id');
			$this->db->join('core_unit','schedule_employee_shift_item.unit_id = core_unit.unit_id');
			$this->db->join('hro_employee_data','schedule_employee_shift_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('schedule_employee_shift_item.employee_shift_id',$employee_shift_id);
			$result =  $this->db->get()->result_array();
			return $result;
		}

		public function deleteScheduleEmployeeShiftItem($data){
			$this->db->where("schedule_employee_shift_item.employee_shift_id", $data['employee_shift_id']);
			$this->db->where("schedule_employee_shift_item.employee_id", $data['employee_id']);
			$query = $this->db->delete('schedule_employee_shift_item');
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteScheduleEmployeeScheduleItem($data){
			$this->db->where("schedule_employee_schedule_item.employee_shift_id", $data['employee_shift_id']);
			$this->db->where("schedule_employee_schedule_item.employee_id", $data['employee_id']);
			$this->db->where("schedule_employee_schedule_item.employee_schedule_item_date >=", $data['employee_schedule_item_date']);
			$query = $this->db->delete('schedule_employee_schedule_item');
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeData_Detail($employee_id)
		{
			$this->db->select('hro_employee_data.region_id, hro_employee_data.branch_id, hro_employee_data.location_id, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.unit_id, hro_employee_data.employee_rfid_code');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function deleteScheduleEmployeeShift($employee_shift_id){
			$this->db->where("schedule_employee_shift.employee_shift_id", $employee_shift_id);
			$query = $this->db->update('schedule_employee_shift', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		
	}
?>