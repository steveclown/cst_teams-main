<?php
	class hroemployeeattendancedownload_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeattendancedownload_model(){
			parent::__construct();
			$this->CI = get_instance();

			$this->db_download_140 = $this->load->database('db_download_140', TRUE);
		}

		public function getCoreMachine(){
			$this->db->select('core_machine.machine_id, core_machine.machine_name, core_machine.machine_database_name, core_machine.machine_type, core_machine.machine_ip_address');
			$this->db->from('core_machine');
			$this->db->where('core_machine.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}		

		public function getHROEmployeeAttendance($machine_database_name){
			$this->$machine_database_name->select('hro_employee_attendance.employee_attendance_id, hro_employee_attendance.region_id, hro_employee_attendance.branch_id, hro_employee_attendance.division_id, hro_employee_attendance.department_id, hro_employee_attendance.section_id, hro_employee_attendance.unit_id, hro_employee_attendance.location_id, hro_employee_attendance.shift_id, hro_employee_attendance.employee_shift_id, hro_employee_attendance.employee_id, hro_employee_attendance.employee_rfid_code, hro_employee_attendance.employee_attendance_status, hro_employee_attendance.employee_attendance_date, hro_employee_attendance.employee_attendance_date_status, hro_employee_attendance.employee_attendance_log_date, hro_employee_attendance.machine_ip_address');
			$this->$machine_database_name->from('hro_employee_attendance');
			$this->$machine_database_name->where('hro_employee_attendance.employee_attendance_downloaded', 0);
			$result = $this->$machine_database_name->get();
			return $result;
		}

		public function getHROEmployeeMealCoupon($machine_database_name){
			$this->$machine_database_name->select('hro_employee_meal_coupon.employee_meal_coupon_id, hro_employee_meal_coupon.region_id, hro_employee_meal_coupon.branch_id, hro_employee_meal_coupon.division_id, hro_employee_meal_coupon.department_id, hro_employee_meal_coupon.section_id, hro_employee_meal_coupon.unit_id, hro_employee_meal_coupon.location_id, hro_employee_meal_coupon.employee_shift_id, hro_employee_meal_coupon.employee_id, hro_employee_meal_coupon.employee_rfid_code, hro_employee_meal_coupon.employee_meal_coupon_date, hro_employee_meal_coupon.employee_meal_coupon_log_date, hro_employee_meal_coupon.machine_ip_address');
			$this->$machine_database_name->from('hro_employee_meal_coupon.');
			$this->$machine_database_name->where('hro_employee_meal_coupon..employee_meal_coupon_downloaded', 0);
			$result = $this->$machine_database_name->get();
			return $result;
		}

		public function insertHROEmployeeAttendance($data){
			return $this->db->insert('hro_employee_attendance', $data);
		}

		public function insertHROEmployeeMealCoupon($data){
			return $this->db->insert('hro_employee_meal_coupon', $data);
		}

		public function updateHROEmployeeAttendance($machine_database_name, $data){
			$this->$machine_database_name->where('hro_employee_attendance.employee_attendance_id', $data['employee_attendance_id']);

			$query = $this->$machine_database_name->update('hro_employee_attendance', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateHROEmployeeMealCoupon($machine_database_name, $data){
			$this->$machine_database_name->where('hro_employee_meal_coupon.employee_meal_coupon_id', $data['employee_meal_coupon_id']);

			$query = $this->$machine_database_name->update('hro_employee_meal_coupon', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function insertHROEmployeeAttendanceDownloadLog($data){
			return $this->db->insert('hro_employee_attendance_download_log', $data);
		}


		public function getCoreMachine($machine_id){
			$this->db->select('core_machine.machine_id, core_machine.machine_name, core_machine.machine_database_name, core_machine.machine_type, core_machine.machine_ip_address');
			$this->db->from('core_machine');
			$this->db->where('core_machine.data_state', 0);
			$this->db->where('core_machine.machine_id', $machine_id);
			$result = $this->db->get()->result_array();
			return $result;
		}	

	}
?>