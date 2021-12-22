<?php
	class skorsingstatus_model extends CI_Model {
		var $table = "core_skorsing_status";
		
		public function skorsingstatus_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_skorsing_status";
			
			//Build contents query
			$this->db->select('skorsing_status_id, skorsing_status_code, skorsing_status_name')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		
		public function saveNewSkorsingStatus($data){
			return $this->db->insert('core_skorsing_status',$data);
		}
		
		public function getDetail($id){
			$this->db->select('skorsing_status_id, skorsing_status_code, skorsing_status_name , data_state, last_update')->from($this->table);
			$this->db->where('skorsing_status_id',$id);
			return $this->db->get()->row_array();
		}
		
		
		public function saveEditSkorsingStatus($data){
			$this->db->where('skorsing_status_id',$data['skorsing_status_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("skorsing_status_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>