<?php
	class HroEmployeeMealCoupon_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
			/*$this->db= $this->load->database('db', TRUE);*/
		}

		public function getHROEmployeeData_Detail($employee_rfid_code){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.region_id, hro_employee_data.branch_id, hro_employee_data.location_id, hro_employee_data.division_id, core_division.division_name, hro_employee_data.department_id, core_department.department_name, hro_employee_data.section_id, core_section.section_name, hro_employee_data.unit_id, core_unit.unit_name, hro_employee_data.job_title_id, core_job_title.job_title_name, hro_employee_data.employee_shift_id');
			$this->db->from('hro_employee_data');
			$this->db->join('core_division', 'hro_employee_data.division_id = core_division.division_id');
			$this->db->join('core_department', 'hro_employee_data.department_id = core_department.department_id');
			$this->db->join('core_section', 'hro_employee_data.section_id = core_section.section_id');
			$this->db->join('core_unit', 'hro_employee_data.unit_id = core_unit.unit_id');
			$this->db->join('core_job_title', 'hro_employee_data.job_title_id = core_job_title.job_title_id');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_rfid_code', $employee_rfid_code);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getEmployeeWorkingMinute(){
			$this->db->select('preference_company.employee_working_minute');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_working_minute'])){
				return '-';
			}else{
				return $result['employee_working_minute'];
			}
		}

		public function getScheduleEmployeeScheduleItem($employee_rfid_code, $location_id, $employee_meal_coupon_date){
			$this->db->select('schedule_employee_schedule_item.employee_schedule_item_id, schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.region_id, schedule_employee_schedule_item.branch_id, schedule_employee_schedule_item.location_id, schedule_employee_schedule_item.division_id, schedule_employee_schedule_item.department_id, schedule_employee_schedule_item.section_id, schedule_employee_schedule_item.unit_id, schedule_employee_schedule_item.employee_shift_id, schedule_employee_schedule_item.employee_schedule_item_meal_coupon_status, schedule_employee_schedule_item.employee_schedule_item_log_status, schedule_employee_schedule_item.employee_rfid_code, schedule_employee_schedule_item.employee_schedule_item_date_status, schedule_employee_schedule_item.shift_id');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_rfid_code', $employee_rfid_code);
			$this->db->where('schedule_employee_schedule_item.location_id', $location_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_meal_coupon_date);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_meal_coupon_status', 0);
			$result = $this->db->get()->row_array();
			return $result;
		}


		public function insertHROEmployeeMealCoupon($data){
			return $this->db->insert('hro_employee_meal_coupon', $data);
		}

		public function insertHROEmployeeAttendance($data){
			return $this->db->insert('hro_employee_attendance', $data);
		}

		public function updateScheduleEmployeeScheduleItem_Coupon($data){
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_id', $data['employee_schedule_item_id']);

			$data_update = array(
				'employee_schedule_item_meal_coupon_date' 		=> $data['employee_schedule_item_meal_coupon_date'],
				'employee_schedule_item_meal_coupon_status' 	=> $data['employee_schedule_item_meal_coupon_status'],
			);

			$query = $this->db->update('schedule_employee_schedule_item', $data_update);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>