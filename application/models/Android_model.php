<?php
	class Android_model extends CI_Model {
		// var $table = "core_bank";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function saveData($data){
			return $this->db->insert('image',$data);
		}
		
		public function getUserProfile($employee_id){
			$this->db->select('hro_employee_data.employee_name,hro_employee_data.employee_mobile_phone,
			hro_employee_data.employee_address,hro_employee_data.employee_city,hro_employee_data.employee_rt,
			hro_employee_data.employee_rw,hro_employee_data.employee.employee_kelurahan,hro_employee_data.employee_kecamatan, 
			hro_employee_data.employee_place_of_birth,hro_employee_data.employee_date_of_birth,hro_employee_data.employee_code');
			$this->db->from('hro_employee_data');			
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('hro_employee_data.data_state', 0);
			return $this->db->get()->result_array();
		}

		
		public function getEmployeeAttendanceHistory($employee_id,$date_now,$date_last){
			$this->db->select('
			schedule_employee_schedule_item.employee_schedule_item_log_in_date,
			schedule_employee_schedule_item.employee_schedule_item_log_out_date,
			schedule_employee_schedule_item.employee_schedule_item_date, 
			schedule_employee_schedule_item.employee_schedule_item_address_in,
			schedule_employee_schedule_item.employee_schedule_item_address_out');
			$this->db->from('schedule_employee_schedule_item');
			$this->db->where('schedule_employee_schedule_item.employee_id',$employee_id);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date <=', $date_now);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date >=', $date_last);
			// $this->db->where('schedule_employee_schedule_item.employee_schedule_item_date > CURRENT_DATE() - interval 7 day');
			// $this->db->group_by('hro_employee_attendance.employee_attendance_date, ');
			$this->db->order_by('schedule_employee_schedule_item.employee_schedule_item_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeAttendanceHistory_2($employee_id){
			$this->db->select('hro_employee_attendance.employee_attendance_in_status, hro_employee_attendance.employee_attendance_date,hro_employee_attendance.employee_attendance_out_status,hro_employee_attendance.employee_attendance_log_in_date,hro_employee_attendance.employee_attendance_log_out_date');
			$this->db->from('hro_employee_attendance');
			$this->db->where('hro_employee_attendance.employee_id',$employee_id);
			$this->db->where('hro_employee_attendance.employee_attendance_date > CURRENT_DATE() - interval 7 day');
			$this->db->group_by('hro_employee_attendance.employee_attendance_date, ');
			$this->db->order_by('hro_employee_attendance.employee_attendance_date', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getUserData($user_id){
			$this->db->select('system_user.avatar, system_user.employee_id, system_user.username, system_user.user_id');
			$this->db->from('system_user');
			$this->db->where('system_user.data_state', 0);
			$this->db->where('system_user.user_id', $user_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getUserAvatar($user_id){
			$this->db->select('system_user.avatar');
			$this->db->from('system_user');
			$this->db->where('system_user.data_state', 0);
			$this->db->where('system_user.user_id', $user_id);
			$result = $this->db->get()->row_array();
			return $result['avatar'];
		}
		public function getUserPass($user_id){
			$this->db->select('system_user.password');
			$this->db->from('system_user');
			$this->db->where('system_user.data_state', 0);
			$this->db->where('system_user.user_id', $user_id);
			$result = $this->db->get()->row_array();
			return $result['password'];
		}

		public function SaveEditUserAvatar($data){
			$this->db->where("user_id", $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateUserPass($data){
			$this->db->where('user_id',$data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>