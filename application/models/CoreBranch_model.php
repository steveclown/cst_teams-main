<?php
	class CoreBranch_model extends CI_Model {
		var $table = "core_branch";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreBranch()
		{	
			$this->db->select('core_branch.branch_id, core_branch.region_id, core_region.region_code, core_region.region_name, core_branch.branch_code, core_branch.branch_name, core_branch.branch_address, core_branch.branch_contact_person, core_branch.branch_phone1');
			$this->db->from('core_branch');
			$this->db->join('core_region', 'core_branch.region_id = core_region.region_id');
			$this->db->where('core_branch.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreRegion()
		{	
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getBranchToken($branch_token)
		{	
			$this->db->select('core_branch.branch_token');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_token', $branch_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}
		
		public function insertCoreBranch($data){
			return $this->db->insert('core_branch',$data);
		}

		public function getBranchID($created_id){
			$this->db->select('core_branch.branch_id');
			$this->db->from('core_branch');
			$this->db->where('core_branch.created_id', $created_id);
			$this->db->order_by('core_branch.branch_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['branch_id'];
		}
		
		public function getCoreBranch_Detail($branch_id){
			$this->db->select('*');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_id', $branch_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function updateCoreBranch($data){
			$this->db->where('core_branch.branch_id', $data['branch_id']);
			$query = $this->db->update('core_branch', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreBranch($data){
			$this->db->where("core_branch.branch_id", $data['branch_id']);
			$query = $this->db->update('core_branch', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>