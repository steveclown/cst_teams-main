<?php
	Class ValidationProcessCkp_model extends CI_Model{
		var $table = "system_user";
		
		public function ValidationProcessCkp_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function verifyData($data){
			$this->db->select('system_user.user_id, system_user.username, system_user.password, system_user.user_group_id, system_user.region_id, system_user.branch_id, system_user.location_id, system_user.employee_id, system_user.payroll_employee_level, system_user.employee_shift_id');
			$this->db->from("system_user");
			$this->db->where("system_user.username", $data['username']);
			$this->db->where("system_user.password", $data['password']);
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
		
		function getName($id){
		
		}
	}
?>