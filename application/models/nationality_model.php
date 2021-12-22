<?php
	class nationality_model extends CI_Model {
		var $table = "core_religion";
		
		public function nationality_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			
			$this->db->select('core_nationality.nationality_id, core_nationality.nationality_code, core_nationality.nationality_name');
			$this->db->from('core_nationality');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		
		public function savenewnationality($data){
			return $this->db->insert('core_nationality',$data);
		}
		
		public function getDetail($id){
			$this->db->select('core_nationality.nationality_id, core_nationality.nationality_code, core_nationality.nationality_name , core_nationality.data_state, core_nationality.last_update');
			$this->db->from('core_nationality');
			$this->db->where('nationality_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveeditnationality($data){
			$this->db->where('nationality_id',$data['nationality_id']);
			$query = $this->db->update('core_nationality', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("nationality_id",$id);
		$query = $this->db->update('core_nationality', array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>