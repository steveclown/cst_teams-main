<?php
	class shift_model extends CI_Model {
		var $table = "core_shift";
		
		public function shift_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_shift";
			
			//Build contents query
			$this->db->select('shift_id, shift_code, shift_name, start_working_hour, end_working_hour, start_rest_hour, end_rest_hour, due_time_late, shift_remark')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		
		public function saveNewShift($data){
			return $this->db->insert('core_shift',$data);
		}
		
		public function getDetail($id){
			$this->db->select('shift_id, shift_code, shift_name, start_working_hour, end_working_hour, start_rest_hour, end_rest_hour, due_time_late, shift_remark, data_state, last_update')->from($this->table);
			$this->db->where('shift_id',$id);
			return $this->db->get()->row_array();
		}
		
		
		public function saveeditshift($data){
			$this->db->where('shift_id',$data['shift_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("shift_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>