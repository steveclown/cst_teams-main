<?php
	class CoreLocation_model extends CI_Model {
		var $table = "core_location";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreLocation(){
			$this->db->select('core_location.location_id, core_location.location_code, core_location.location_name, core_location.branch_id');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getLocationToken($location_token)
		{	
			$this->db->select('core_location.location_token');
			$this->db->from('core_location');
			$this->db->where('core_location.location_token', $location_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getLocationID($created_id){
			$this->db->select('core_location.location_id');
			$this->db->from('core_location');
			$this->db->where('core_location.created_id', $created_id);
			$this->db->order_by('core_location.location_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['location_id'];
		}
		
		public function getCoreBranch(){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getBranchName($BranchID){
			$this->db->select('branch_name');
			$this->db->from('core_branch');
			$this->db->where('branch_id',$BranchID);
			$this->db->where('data_state','0');
			$result=$this->db->get()->row_array();
			return $result['branch_name'];
		}
		
		public function insertCoreLocation($data){
			return $this->db->insert('core_location',$data);
		}
		
		public function getCoreLocation_Detail($LocationID){
			$this->db->select('core_location.location_id, core_location.location_code, core_location.location_name, core_location.branch_id, core_location.data_state, core_location.last_update');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id',$LocationID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreLocation($data){
			$this->db->where('location_id',$data['location_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLocation($data){
			$this->db->where("core_location.location_id", $data['location_id']);
			$query = $this->db->update('core_location', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>