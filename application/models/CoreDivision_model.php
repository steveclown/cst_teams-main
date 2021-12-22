<?php
	class CoreDivision_model extends CI_Model {
		var $table = "core_division";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDivision()
		{	
			$this->db->select('core_division.division_id, core_division.division_code, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get()->result_array();
			return$result;
		}

		public function getDivisionToken($division_token)
		{	
			$this->db->select('core_division.division_token');
			$this->db->from('core_division');
			$this->db->where('core_division.division_token', $division_token);
			$result = $this->db->get()->num_rows();
			return$result;
		}
		
		public function insertCoreDivision($data){
			return $this->db->insert('core_division',$data);
		}

		public function getDivisionID($created_id){
			$this->db->select('core_division.division_id');
			$this->db->from('core_division');
			$this->db->where('core_division.created_id', $created_id);
			$this->db->order_by('core_division.division_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['division_id'];
		}
		
		public function getCoreDivision_Detail($division_id){
			$this->db->select('core_division.division_id, core_division.division_code, core_division.division_name , core_division.data_state, core_division.last_update');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function updateCoreDivision($data){
			$this->db->where('core_division.division_id', $data['division_id']);
			$query = $this->db->update('core_division', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreDivision($data){
			$this->db->where("core_division.division_id", $data['division_id']);
			$query = $this->db->update('core_division', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>