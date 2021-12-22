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
		
		
		public function saveNewCoreLanguage($data){
			return $this->db->insert('core_language',$data);
		}
		
		public function getCoreLanguage_Detail($language_id){
			$this->db->select('language_id, language_code, language_name , data_state, last_update');
			$this->db->from('core_language');
			$this->db->where('language_id',$language_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreLanguage($data){
			$this->db->where('language_id',$data['language_id']);
			$query = $this->db->update('core_language', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLanguage($language_id){
			$this->db->where("language_id",$language_id);
			$query = $this->db->update('core_language', array("data_state"=>'1'));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>