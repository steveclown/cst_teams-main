<?php
	class CoreMaritalStatus_model extends CI_Model {
		var $table = "core_marital_status";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreMaritalStatus()
		{
			$this->db->select('core_marital_status.marital_status_id, core_marital_status.marital_status_code, core_marital_status.marital_status_name');
			$this->db->from('core_marital_status');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function getMaritalStatusToken($marital_status_token)
		{	
			$this->db->select('core_marital_status.marital_status_token');
			$this->db->from('core_marital_status');
			$this->db->where('core_marital_status.marital_status_token', $marital_status_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getMaritalStatusID($created_id){
			$this->db->select('core_marital_status.marital_status_id');
			$this->db->from('core_marital_status');
			$this->db->where('core_marital_status.created_id', $created_id);
			$this->db->order_by('core_marital_status.marital_status_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['marital_status_id'];
		}

		public function insertCoreMaritalStatus($data){
			return $this->db->insert('core_marital_status',$data);
		}
		
		public function getCoreMaritalStatus_Detail($MaritalStatusID){
			$this->db->select('core_marital_status.marital_status_id, core_marital_status.marital_status_code, core_marital_status.marital_status_name, core_marital_status.data_state, core_marital_status.last_update');
			$this->db->from('core_marital_status');
			$this->db->where('marital_status_id',$MaritalStatusID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreMaritalStatus($data){
			$this->db->where('marital_status_id',$data['marital_status_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreMaritalStatus($data){
			$this->db->where("core_marital_status.marital_status_id", $data['marital_status_id']);
			$query = $this->db->update('core_marital_status', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>