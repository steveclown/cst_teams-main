<?php
	class shiftgroup_model extends CI_Model {
		var $table = "core_shift_group";
		
		public function shiftgroup_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_shift_group";
			
			//Build contents query
			$this->db->select('shift_group_id, shift_group_code, shift_group_name, shift_id')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function getshift(){
			$this->db->select('shift_id, shift_name');
			$this->db->from('core_shift');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getshiftName($shift_id){
			$this->db->select('shift_name');
			$this->db->from('core_shift');
			$this->db->where('shift_id',$shift_id);
			$this->db->where('data_state','0');
			$result=$this->db->get()->row_array();
			return $result['shift_name'];
		}
		
		public function saveNewshiftgroup($data){
			return $this->db->insert('core_shift_group',$data);
		}
		
		public function getDetail($id){
			$this->db->select('shift_group_id, shift_group_code, shift_group_name , shift_id, shift_group_remark, data_state, last_update')->from($this->table);
			$this->db->where('shift_group_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditshiftgroup($data){
			$this->db->where('shift_group_id',$data['shift_group_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("shift_group_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>