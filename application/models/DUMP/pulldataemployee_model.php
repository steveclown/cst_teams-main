<?php
	class pulldataemployee_model extends CI_Model {
		var $table = "attendance_employee";
		
		public function pulldataemployee_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "attendance_employee";
			
			//Build contents query
			$this->db->select('pulldataemployee_id, pulldataemployee_code, pulldataemployee_name')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');
			
			return $this->db->get()->result_array();
		}
		
		
		public function savenewpulldataemployee($data){
			return $this->db->insert('attendance_employee',$data);
		}
		
		public function getdetail($id){
			$this->db->select('pulldataemployee_id, pulldataemployee_code, pulldataemployee_name , data_state, last_update')->from($this->table);
			$this->db->where('pulldataemployee_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveeditpulldataemployee($data){
			$this->db->where('pulldataemployee_id',$data['pulldataemployee_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("pulldataemployee_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>