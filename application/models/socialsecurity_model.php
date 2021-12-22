<?php
	class socialsecurity_model extends CI_Model {
		var $table = "core_social_security";
		
		public function socialsecurity_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_social_security";
			
			//Build contents query
			$this->db->select('social_security_id, social_security_period, social_security_jkm, social_security_jkk, social_security_jht_employee, social_security_jht_company, social_security_medical_employee, social_security_medical_company')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		
		public function saveNewsocialsecurity($data){
			return $this->db->insert('core_social_security',$data);
		}
		
		public function getDetail($id){
			$this->db->select('social_security_id, social_security_period, social_security_jkm, social_security_jkk, social_security_jht_employee, social_security_jht_company, social_security_medical_employee, social_security_medical_company, data_state, last_update')->from($this->table);
			$this->db->where('social_security_id',$id);
			return $this->db->get()->row_array();
		}
		
		
		public function saveEditsocialsecurity($data){
			$this->db->where('social_security_id',$data['social_security_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("social_security_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>