<?php
	class bloodtype_model extends CI_Model {
		var $table = "core_blood_type";
		
		public function bloodtype_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			$table_name = "core_blood_type";
			$this->db->select('core_blood_type.blood_type_id, core_blood_type.blood_type_code');
			$this->db->from('core_blood_type');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function savenewbloodtype($data){
			return $this->db->insert('core_blood_type',$data);
		}
		
		public function getDetail($id){
			$this->db->select('core_blood_type.blood_type_id, core_blood_type.blood_type_code, core_blood_type.data_state, core_blood_type.last_update');
			$this->db->from('core_blood_type');
			$this->db->where('blood_type_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveeditbloodtype($data){
			$this->db->where('blood_type_id',$data['blood_type_id']);
			$query = $this->db->update('core_blood_type', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
			$this->db->where("blood_type_id",$id);
			$query = $this->db->update('core_blood_type', array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>