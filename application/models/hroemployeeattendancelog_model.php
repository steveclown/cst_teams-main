<?php
	class hroemployeeattendancelog_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeattendancelog_model(){
			parent::__construct();
			$this->CI = get_instance();
		}


		public function getHROEmployeeAttendanceData($employee_attendance_date){
			$this->db->select('hro_employee_attendance_data.region_id, hro_employee_attendance_data.branch_id, hro_employee_attendance_data.location_id, hro_employee_attendance_data.division_id, hro_employee_attendance_data.department_id, hro_employee_attendance_data.section_id, hro_employee_attendance_data.unit_id, hro_employee_attendance_data.shift_id, hro_employee_attendance_data.employee_shift_id, hro_employee_attendance_data.employee_id, employee_rfid_code, hro_employee_attendance_data.employee_attendance_date, hro_employee_attendance_data.employee_attendance_date_status');
			$this->db->from('hro_employee_attendance_data');
			$this->db->where('hro_employee_attendance_data.employee_attendance_date', $employee_attendance_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getMealLogCounter($employee_id, $employee_meal_coupon_date){
			$this->db->select('hro_employee_meal_coupon.employee_meal_coupon_id, hro_employee_meal_coupon.employee_meal_coupon_date, hro_employee_meal_coupon.employee_id');
			$this->db->from('hro_employee_meal_coupon');
			$this->db->where('hro_employee_meal_coupon.employee_id', $employee_id);
			$this->db->where('hro_employee_meal_coupon.employee_meal_coupon_date', $employee_meal_coupon_date);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getHROEmployeeAttendanceLog($employee_id, $employee_attendance_log_period){
			$this->db->select('hro_employee_attendance_log.employee_id');
			$this->db->from('hro_employee_attendance_log');
			$this->db->where('hro_employee_attendance_log.employee_id', $employee_id);
			$this->db->where('hro_employee_attendance_log.employee_attendance_log_period', $employee_attendance_log_period);
			$result = $this->db->get()->row_array();
			if(empty($result)){
				return true;
			}else{
				return false;
			}
		}	

		public function insertHROEmployeeAttendanceLog($data){
			return $this->db->insert('hro_employee_attendance_log',$data);
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

		public function getHROEmployeeAttendanceLog_Period(){
			$this->db->select('employee_id, day_26, day_27, day_28, day_29, day_30');
			$this->db->from('hro_employee_attendance_log');
			$this->db->where('hro_employee_attendance_log.employee_id', '9547');
			$this->db->where('hro_employee_attendance_log.employee_attendance_log_period', '201804');
			
			$query1 = $this->db->get()->result_array();
			
			$this->db->select('employee_id, day_01, day_02, day_03, day_04, day_05, day_06, day_07, day_08, day_09, day_05');
			$this->db->from('hro_employee_attendance_log');
			$this->db->where('hro_employee_attendance_log.employee_id', '9547');
			$this->db->where('hro_employee_attendance_log.employee_attendance_log_period', '201805');
			
			$query2 = $this->db->get()->result_array();
			
			$result = array_merge($query1, $query2);
			return $result; 
		}	
	}
?>