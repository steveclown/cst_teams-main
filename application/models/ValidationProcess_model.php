<?php
	Class ValidationProcess_model extends CI_Model{
		var $table = "system_user";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function verifyData($data){
			$this->db->select('system_user.user_id, system_user.username, system_user.password, system_user.avatar, system_user.user_group_id, system_user.region_id, system_user.branch_id, system_user.location_id, system_user.employee_id, system_user.payroll_employee_level, system_user.employee_shift_id');
			$this->db->from("system_user");
			$this->db->where("system_user.username", $data['username']);
			$this->db->where("system_user.password", $data['password']);
			$result = $this->db->get()->row_array();
		
			return $result;
		}

		public function cekEmployee($employee_id){
			$this->db->select('data_state');
			$this->db->from("hro_employee_data");
			
			$this->db->where("employee_id", $employee_id);
			$result = $this->db->get()->row_array();		
			return $result['data_state'];
		}
		
		public function getEmployeeRfidCode($employee_id){
			$this->db->select('hro_employee_data.employee_rfid_code');
			$this->db->from("hro_employee_data");
			$this->db->where("hro_employee_data.employee_id", $employee_id);
			$result = $this->db->get()->row_array();		
			return $result;
		}

		function getLogin($data){
			$hasil = $this->db->query("UPDATE system_user SET log_stat='on' WHERE username='$data[username]' AND password='$data[password]'");
			if($hasil){
				return true;
			}else{
				return false;
			}
		}
		
		function getLogout($data){
			$hasil = $this->db->query("UPDATE system_user SET log_stat='off' WHERE username='$data[username]' AND password='$data[password]'");
			if($hasil){
				return true;
			}else{
				return false;
			}
		}
		
		public function getUserProfile($employee_id){
			$this->db->select('hro_employee_data.division_id, hro_employee_data.employee_email_address, hro_employee_data.employee_address, hro_employee_data.employee_rt,hro_employee_data.employee_rw,hro_employee_data.employee_kelurahan,hro_employee_data.employee_kecamatan,hro_employee_data.employee_city,hro_employee_data.employee_gender,hro_employee_data.employee_employment_status,hro_employee_data.employee_name,hro_employee_data.employee_mobile_phone,hro_employee_data.employee_address,hro_employee_data.employee_place_of_birth,hro_employee_data.employee_date_of_birth,hro_employee_data.employee_code');
			$this->db->from('hro_employee_data');			
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->row_array();		
			return $result;
		}
	}
?>