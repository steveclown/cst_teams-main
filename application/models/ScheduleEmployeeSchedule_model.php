<?php
	class ScheduleEmployeeSchedule_model extends CI_Model {
		var $table = "schedule_employee_shift";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getScheduleEmployeeScheduleItem($start_date, $end_date, $employee_shift_id, $employee_id){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_schedule_id, schedule_employee_schedule_item.shift_assignment_id, schedule_employee_schedule_item.employee_schedule_item_date, schedule_employee_schedule_item.employee_id, hro_employee_data.employee_name, schedule_employee_schedule_item.employee_rfid_code, schedule_employee_schedule_item.division_id, core_division.division_name, schedule_employee_schedule_item.department_id, core_department.department_name, schedule_employee_schedule_item.section_id, core_section.section_name, schedule_employee_schedule_item.unit_id, core_unit.unit_name, schedule_employee_schedule_item.employee_shift_id, schedule_employee_shift.employee_shift_code, schedule_employee_schedule_item.shift_id, core_shift.shift_code, core_shift.shift_next_day');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->join('core_division', 'schedule_employee_schedule_item.division_id = core_division.division_id');
			$this->db->join('core_department', 'schedule_employee_schedule_item.department_id = core_department.department_id');
			$this->db->join('core_section', 'schedule_employee_schedule_item.section_id = core_section.section_id');
			$this->db->join('core_unit', 'schedule_employee_schedule_item.unit_id = core_unit.unit_id');
			$this->db->join('schedule_employee_shift', 'schedule_employee_schedule_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->join('core_shift', 'schedule_employee_schedule_item.shift_id = core_shift.shift_id');
			$this->db->join('hro_employee_data', 'schedule_employee_schedule_item.employee_id = hro_employee_data.employee_id');
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date >=', $start_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date <=', $end_date);

			if ($employee_shift_id != ''){
				$this->db->where('schedule_employee_schedule_item.employee_shift_id', $employee_shift_id);
			}

			if ($employee_id != ''){
				$this->db->where('schedule_employee_schedule_item.employee_id', $employee_id);
			}

			$result = $this->db->get()->result_array();

			return $result;			
		}

		public function getScheduleEmployeeScheduleItem_Detail($employee_schedule_id){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_schedule_id, schedule_employee_schedule_item.employee_shift_id, schedule_employee_shift.employee_shift_code, schedule_employee_schedule_item.employee_id, hro_employee_data.employee_name, schedule_employee_schedule_item.shift_id, core_shift.shift_name, core_shift.start_working_hour, schedule_employee_schedule_item.employee_schedule_item_date, schedule_employee_schedule_item.employee_schedule_item_status');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->join('schedule_employee_schedule','schedule_employee_schedule_item.employee_schedule_id = schedule_employee_schedule.employee_schedule_id');
			$this->db->join('core_shift','schedule_employee_schedule_item.shift_id = core_shift.shift_id');
			$this->db->join('hro_employee_data','schedule_employee_schedule_item.employee_id=hro_employee_data.employee_id');
			$this->db->join('schedule_employee_shift', 'schedule_employee_schedule_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('schedule_employee_schedule_item.employee_schedule_id',$employee_schedule_id);
			$this->db->order_by('schedule_employee_schedule_item.employee_schedule_item_id','ASC');

			return $this->db->get()->result_array();
		}

		public function getScheduleEmployeeShift($region_id, $branch_id, $location_id){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code');
			$this->db->from('schedule_employee_shift');
			$this->db->where('schedule_employee_shift.region_id', $region_id);
			$this->db->where('schedule_employee_shift.branch_id', $branch_id);
			$this->db->where('schedule_employee_shift.location_id', $location_id);
			$this->db->where('schedule_employee_shift.data_state', 0);
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
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}		

		public function getCoreUnit($section_id){
			$this->db->select('core_unit.unit_id, core_unit.unit_name');
			$this->db->from('core_unit');
			$this->db->where('core_unit.section_id', $section_id);
			$this->db->where('core_unit.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $unit_id){
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

		public function getScheduleEmployeeScheduleShift($employee_id, $employee_schedule_shift_date){
			$this->db->select('schedule_employee_schedule_shift.employee_id');
			$this->db->from('schedule_employee_schedule_shift');
			$this->db->where('schedule_employee_schedule_shift.employee_id', $employee_id);
			$this->db->where('schedule_employee_schedule_shift.employee_schedule_shift_date', $employee_schedule_shift_date);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getScheduleEmployeeScheduleItem_DetailWorking($employee_schedule_item_id){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_schedule_id, schedule_employee_schedule_item.employee_shift_id, schedule_employee_shift.employee_shift_code, schedule_employee_schedule_item.employee_id, hro_employee_data.employee_name, schedule_employee_schedule_item.shift_id, core_shift.shift_name, core_shift.start_working_hour, schedule_employee_schedule_item.employee_schedule_item_date, schedule_employee_schedule_item.employee_schedule_item_status, schedule_employee_schedule_item.employee_schedule_item_in_start_date');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->join('core_shift','schedule_employee_schedule_item.shift_id = core_shift.shift_id');
			$this->db->join('hro_employee_data','schedule_employee_schedule_item.employee_id = hro_employee_data.employee_id');
			$this->db->join('schedule_employee_shift', 'schedule_employee_schedule_item.employee_shift_id = schedule_employee_shift.employee_shift_id');
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_id',$employee_schedule_item_id);
			$this->db->order_by('schedule_employee_schedule_item.employee_schedule_item_id','ASC');
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getScheduleEmployeeScheduleWorking($employee_id){
			$this->db->select('schedule_employee_schedule_working.employee_schedule_working_id, schedule_employee_schedule_working.employee_id, schedule_employee_schedule_working.employee_schedule_id, schedule_employee_schedule_working.employee_schedule_item_id, schedule_employee_schedule_working.employee_schedule_item_date, schedule_employee_schedule_working.employee_schedule_item_in_start_date_old, schedule_employee_schedule_working.employee_schedule_item_in_start_date, schedule_employee_schedule_working.employee_schedule_item_in_end_date, schedule_employee_schedule_working.employee_schedule_working_reason');
			$this->db->from('schedule_employee_schedule_working');
			$this->db->where('schedule_employee_schedule_working.employee_id', $employee_id);
			$this->db->order_by('schedule_employee_schedule_working.employee_schedule_working_id', 'DESC');
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function insertScheduleEmployeeScheduleWorking($data){
			return $this->db->insert('schedule_employee_schedule_working',$data);
		}

		public function updateScheduleEmployeeScheduleItem($data){
			$this->db->where("schedule_employee_schedule_item.employee_schedule_item_id", $data['employee_schedule_item_id']);
			$query = $this->db->update('schedule_employee_schedule_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getEmployeeWorkingMinute(){
			$this->db->select('preference_company.employee_working_in_start_minute, preference_company.employee_working_in_start_minute, preference_company.employee_working_out_start_minute, preference_company.employee_working_out_end_minute');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result;
		}


	}
?>
