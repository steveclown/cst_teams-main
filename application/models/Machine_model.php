<?php
	class Machine_model extends CI_Model {
		var $table = "core_machine";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_machine";
			
			//Build contents query
			$this->db->select('machine_id, machine_code, machine_name, machine_ip_address, machine_port, machine_remark')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');
			
			return $this->db->get()->result_array();
		}
		
		
		public function savenewmachine($data){
			return $this->db->insert('core_machine',$data);
		}
		
		public function getdetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('machine_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveeditmachine($data){
			$this->db->where('machine_id',$data['machine_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("machine_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>