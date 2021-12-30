<?php
	class CoreExpertise_model extends CI_Model {
		var $table = "core_expertise";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreExpertise()
		{
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_code, core_expertise.expertise_name, core_expertise.expertise_remark');
			$this->db->from('core_expertise');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();			
		}
		
		public function getExpertiseToken($expertise_token)
		{	
			$this->db->select('core_expertise.expertise_token');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_token', $expertise_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getExpertiseID($created_id){
			$this->db->select('core_expertise.expertise_id');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.created_id', $created_id);
			$this->db->order_by('core_expertise.expertise_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['expertise_id'];
		}

		public function insertCoreExpertise($data){
			return $this->db->insert('core_expertise',$data);
		}
		
		public function getCoreExpertise_Detail($ExpertiseID){
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_code, core_expertise.expertise_name, core_expertise.expertise_remark');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_id',$ExpertiseID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreExpertise($data){
			$this->db->where('expertise_id',$data['expertise_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreExpertise($data){
			$this->db->where("core_expertise.expertise_id", $data['expertise_id']);
			$query = $this->db->update('core_expertise', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>