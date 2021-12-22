<?php
	class department_model extends CI_Model {
		var $table = "core_department";
		
		public function department_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_department";
			
			//Build contents query
			$this->db->select('department_id, department_code, department_name, division_id')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function getDivision(){
			$this->db->select('division_id, division_name');
			$this->db->from('core_division');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDivisionName($division_id){
			$this->db->select('division_name');
			$this->db->from('core_division');
			$this->db->where('division_id',$division_id);
			$this->db->where('data_state','0');
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}
		
		public function saveNewdepartment($data){
			return $this->db->insert('core_department',$data);
		}
		
		public function getDetail($id){
			$this->db->select('department_id, department_code, department_name , division_id, data_state, last_update')->from($this->table);
			$this->db->where('department_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditdepartment($data){
			$this->db->where('department_id',$data['department_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("department_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
		
	}
?>