<?php
	class SystemUserGroup_model extends CI_Model {
		var $table = "system_user_group";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getSystemUserGroup() 
		{
			//Build contents query
			$this->db->select('system_user_group.user_group_id, system_user_group.user_group_level, system_user_group.user_group_code, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.data_state', 0);
			//$this->db->where('system_user_group.user_group_id !=', '1');
			//$this->db->where('system_user_group.user_group_id !=', '2');
			return $this->db->get()->result_array();
		}
		
		public function getMenuList($char){
			$hasil = $this->db->query("SELECT id_menu,text,type FROM system_menu Where id_menu like '$char' ORDER BY id_menu ASC ");
			$hasil = $hasil->result_array();
			return $hasil;
		}
		
		public function saveNewSystemUserGroup($data){
			$this->db->set('user_group_id', 'getNewusergroupID()', FALSE);
			$this->db->set('user_group_level', 'getNewusergroupID()', FALSE);
			if($this->db->insert($this->table, $data)){
				return true;
			}else{
				return false;
			}
		}
		
		public function getMenuID($name){
			$this->db->select('user_group_level')->from($this->table);
			$this->db->where('user_group_name',$name);
			$hasil = $this->db->get()->row_array();
			return $hasil['user_group_level'];
		}
		
		public function saveMapping($data){
			return $this->db->insert("system_menu_mapping",$data);
		}
		
		public function deleteMapping($level){
			$this->db->delete('system_menu_mapping', array('user_group_level' => $level)); 
		}
		
		public function getSystemUserGroup_Detail($user_group_id){
			$this->db->select('system_user_group.user_group_id, system_user_group.user_group_level, system_user_group.user_group_code, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.data_state', 0);
			$this->db->where('system_user_group.user_group_id =', $user_group_id);
			return $this->db->get()->row_array();
			return $result;
		}
		
		public function isThisMenuInGroup($level, $id_menu){
			$hasil = $this->db->query("SELECT * FROM system_menu_mapping WHERE user_group_level='$level' AND id_menu='$id_menu'");
			$hasil = $hasil->row_array();
			if(count($hasil)>0){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteSystemUserGroup($user_group_id){
			$this->deleteMapping($id);
			if($this->db->delete('system_user_group', array('user_group_id' => $user_group_id))){
				return true;
			}else{
				return false;
			}
		}
		
		public function getUserGroupName($user_group_name){
			$this->db->select('system_user_group.user_group_id, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.user_group_name', $user_group_name);
			$hasil = $this->db->get()->row_array();
			if(count($hasil)>0){
				return false;
			}else{
				return true;
			}
		}
		
		public function saveEditSystemUserGroup($data){
			$this->db->where('user_group_id', $data['user_group_id']);
			$query = $this->db->update('system_user_group', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>