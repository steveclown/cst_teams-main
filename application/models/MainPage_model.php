<?php
	Class MainPage_model extends CI_Model{
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function grabDatabase(){
			return $this->db->database;
		}

		public function getMenuMapping($user_group_level, $id){
			$this->db->select('system_menu_mapping.id_menu');
			$this->db->from('system_menu_mapping');
			$this->db->join('system_menu', 'system_menu_mapping.id_menu = system_menu.id_menu');
			$this->db->where('system_menu_mapping.user_group_level', $user_group_level);
			$this->db->where('system_menu.id', $id);
			$this->db->limit(1);
			return $this->db->get()->row_array();
		}
		
		public function getEmployee(){
			$this->db->select('employee_id, employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			return $result->result_array();
		}
		public function getMenu($level){
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu as m');
			$this->db->join('system_menu_mapping as mm', 'mm.id_menu=m.id_menu');
			$this->db->where('mm.user_group_level',$level);
			$this->db->order_by('m.id_menu','asc');
			$result = $this->db->get()->result_array();
			return $result;
		}
		public function getSubMenu2($level){
			$hasil = $this->db->query("select id_menu from system_menu where id_menu like '$level%'");
			$hasil = $hasil->result_array();
			return $hasil;
		}

		public function getSubMenu3($level){
			$hasil = $this->db->query("select id_menu from system_menu where id_menu like '$level%'");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		// public function getSubMenu2($level){
			// $this->db->select('m.id_menu')->from('system_menu as m');
			// $this->db->like('m.id_menu',$level);
			// $result = $this->db->get()->result_array();
			// return $result;
		// }
		
		public function getFolder($id){
			$this->db->select('m.id_menu,m.id,m.type,m.text,m.image')->from('system_menu as m');
			$this->db->where('m.id_menu',$id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getSameFolder($level,$index){
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,2) as detect from system_menu_mapping where user_group_level='$level' And id_menu like '$index%'");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getDataParentmenu($id){
			$hasil = $this->db->query("select * from system_menu WHERE id_menu='$id'");
			$hasil = $hasil->row_array();
			return $hasil;
		}
		
		
		public function getParentMenu($level){
			$hasil = $this->db->query("SELECT distinct(SUBSTR(id_menu,1,1)) as detect from system_menu_mapping where user_group_level='$level'");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getParentSubMenu($level, $index){
			$hasil = $this->db->query("SELECT b.* from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%'");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getParentSubMenu3($level, $index){
			$hasil = $this->db->query("select DISTINCT(substr(t.id_menu,1,3)) as id_menu from (SELECT b.id_menu, b.id, b.type, b.text, b.image from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%') as t");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getParentSubMenu2($level, $index){
			$hasil = $this->db->query("select DISTINCT(substr(t.id_menu,1,2)) as id_menu from (SELECT b.id_menu, b.id, b.type, b.text, b.image from system_menu_mapping as a, system_menu as b where user_group_level='$level' and a.id_menu=b.id_menu and a.id_menu like '$index%') as t");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getSameFolder2($level,$index){
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,3) as detect from system_menu_mapping where user_group_level='$level' And id_menu like '$index%'");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function getActive($class){
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,1) as detect from system_menu where id like '".$class."%'");
			$hasil = $hasil->num_rows();
			if($hasil > 0){	
				return $hasil['detect'];
			}else{
				return 0;
			}
		}
		
		public function getActive2($class){
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,2) as detect from system_menu where id like '".$class."%'");
			$hasil = $hasil->num_rows();
			if($hasil > 0){	
				return $hasil['detect'];
			}else{
				return 0;
			}
		}
		public function getActive3($class){
			$hasil = $this->db->query("SELECT SUBSTR(id_menu,1,3) as detect from system_menu where id='".$class."'");
			$hasil = $hasil->num_rows();
			if($hasil > 0){	
				return $hasil['detect'];
			}else{
				return 0;
			}
		}
		public function getLastActivity($user){
			$hasil = $this->db->query("SELECT log_time from system_log_user where username='$user' And id_previllage='1002' Order By log_time DESC LIMIT 0,1");
			$hasil = $hasil->row_array();
			if(count($hasil)>0){
				return $hasil['log_time'];
			}else{
				return '0000-00-00 00:00:00';
			}
		}
		
		public function getAva($username){
			$this->db->select('avatar')->from('system_user');
			$this->db->where('username',$username);
			$result = $this->db->get()->row_array();
			return $result['avatar'];
		}

		public function getScheduleEmployeeShiftLast($date){
			$this->db->select('schedule_employee_shift.employee_shift_id, schedule_employee_shift.employee_shift_code, schedule_employee_shift.location_id, core_location.location_name, schedule_employee_shift.division_id, core_division.division_name, schedule_employee_shift.employee_shift_last_schedule_date');
			$this->db->from('schedule_employee_shift');
			$this->db->join('core_location', 'schedule_employee_shift.location_id = core_location.location_id');
			$this->db->join('core_division', 'schedule_employee_shift.division_id = core_division.division_id');
			$this->db->where('schedule_employee_shift.employee_shift_last_schedule_date <=', $date);
			$result = $this->db->get();
			return $result;
		}
	}
?>