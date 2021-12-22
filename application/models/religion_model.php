<?php
	class religion_model extends CI_Model {
		var $table = "core_religion";
		
		public function religion_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			$table_name = "core_religion";
			$this->db->select('core_religion.religion_id, core_religion.religion_code, core_religion.religion_name');
			$this->db->from('core_religion');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function savenewreligion($data){
			return $this->db->insert('core_religion',$data);
		}
		
		public function getDetail($id){
			$this->db->select('core_religion.religion_id, core_religion.religion_code, core_religion.religion_name , core_religion.data_state, core_religion.last_update');
			$this->db->from('core_religion');
			$this->db->where('religion_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveeditreligion($data){
			$this->db->where('religion_id',$data['religion_id']);
			$query = $this->db->update('core_religion', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("religion_id",$id);
		$query = $this->db->update('core_religion', array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>