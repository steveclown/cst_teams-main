<?php
	class CoreCompany_model extends CI_Model {
		var $table = "core_company";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreCompany()
		{	
			$this->db->select('core_company.company_id, core_company.company_code, core_company.company_name');
			$this->db->from('core_company');
			$this->db->where('core_company.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCompanyToken($company_token)
		{	
			$this->db->select('core_company.company_token');
			$this->db->from('core_company');
			$this->db->where('core_company.company_token', $company_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}
		
		public function insertCoreCompany($data){
			return $this->db->insert('core_company',$data);
		}

		public function getCompanyID($created_id){
			$this->db->select('core_company.company_id');
			$this->db->from('core_company');
			$this->db->where('core_company.created_id', $created_id);
			$this->db->order_by('core_company.company_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['company_id'];
		}
		
		public function getCoreCompany_Detail($company_id){
			$this->db->select('core_company.company_id, core_company.company_code, core_company.company_name , core_company.data_state, core_company.last_update');
			$this->db->from('core_company');
			$this->db->where('core_company.company_id', $company_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function updateCoreCompany($data){
			$this->db->where('core_company.company_id', $data['company_id']);
			$query = $this->db->update('core_company', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreCompany($data){
			$this->db->where("core_company.company_id", $data['company_id']);
			$query = $this->db->update('core_company', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>