<?php
	class CoreDocumentBook_model extends CI_Model {
		var $table = "core_document_book";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getCoreDocumentBook()
		{
			//Build contents query
			$this->db->select('document_book_id, document_book_code, document_book_name');
			$this->db->from('core_document_book');
			$this->db->where('data_state', 0);
			
			//Get contents
			return $this->db->get()->result_array();
			
		}
		
		public function getEmployeeDocumentLocation(){
			$this->db->select('company_employee_document_location');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result['company_employee_document_location'];
		}

		public function insertCoreDocumentBook($data){
			return $this->db->insert('core_document_book',$data);
		}
		
		public function getCoreDocumentBook_Detail($document_book_id){
			$this->db->select('document_book_id, document_book_code, document_book_name, data_state, last_update');
			$this->db->from('core_document_book');
			$this->db->where('document_book_id',$document_book_id);
			return $this->db->get()->row_array();
		}
		
		public function deleteCoreDocumentBook($document_book_id){
			$this->db->where("document_book_id",$document_book_id);
			$query = $this->db->update('core_document_book', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>