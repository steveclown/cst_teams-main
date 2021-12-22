<?php
	class workhours_model extends CI_Model {
		var $table = "core_shift";
		
		public function workhours_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_shift";
			
			//Build contents query
			$this->db->select('shift_id, shift_code, shift_name,start_working_hour,end_working_hour, start_rest_hour, end_rest_hour, due_time_late')->from($table_name);
			$this->db->where('data_state', '0');
			
			//Get contents
			return $this->db->get()->result_array();
			
		}
		
		
		public function saveneworkhours($data){
			return $this->db->insert('core_shift',$data);
		}
		
		public function getdetail($id){
			$this->db->select('shift_id, shift_code, shift_name,start_working_hour,end_working_hour, start_rest_hour, end_rest_hour, due_time_late')->from($this->table);
			$this->db->where('shift_id',$id);
			return $this->db->get()->row_array();
		}
		
		
		function cekSettingRegionNameExist($username){
			$this->db->select('division_id, division_code, division_name , data_state, last_update')->from($this->table);
			$this->db->where('division_code',$username);
			$hasil = $this->db->get()->row_array();
			if(count($hasil)>0){
				return false;
			}else{
				return true;
			}
		}
		
		public function updateworkhours($data){
			$this->db->where('shift_id',$data['shift_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
			// if($this->db->delete($this->table,array('division_id'=>$id))){
			if($this->db->delete($this->table,array('shift_id'=>$id))){
				return true;
			}else{
				return false;
			}
		}
	}
?>