<?php
	class CoreLanguage_model extends CI_Model {
		var $table = "core_language";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getCoreLanguage()
		{
			//Build contents query
			$this->db->select('language_id, language_code, language_name');
			$this->db->from('core_language');
			$this->db->where('data_state', '0');
			
			//Get contents
			return $this->db->get()->result_array();
			
		}

		public function getLanguageToken($language_token)
		{	
			$this->db->select('core_language.language_token');
			$this->db->from('core_language');
			$this->db->where('core_language.language_token', $language_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getLanguageID($created_id){
			$this->db->select('core_language.language_id');
			$this->db->from('core_language');
			$this->db->where('core_language.created_id', $created_id);
			$this->db->order_by('core_language.language_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['language_id'];
		}

		public function insertCoreLanguage($data){
			return $this->db->insert('core_language',$data);
		}
		
		public function getCoreLanguage_Detail($language_id){
			$this->db->select('language_id, language_code, language_name , data_state, last_update');
			$this->db->from('core_language');
			$this->db->where('language_id',$language_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreLanguage($data){
			$this->db->where('language_id',$data['language_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLanguage($data){
			$this->db->where("core_language.language_id", $data['language_id']);
			$query = $this->db->update('core_language', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>