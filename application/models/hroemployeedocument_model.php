<?php
	class hroemployeedocument_model extends CI_Model {
		var $table = "hro_employee_document";
		
		public function hroemployeedocument_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
	
		public function getHroEmployeeDocument($region_id, $branch_id, $location_id, $employee_id){
			$this->db->select('hro_employee_document.employee_document_id, hro_employee_document.employee_id, hro_employee_data.employee_name, hro_employee_document.document_book_id, core_document_book.document_book_code, hro_employee_document.employee_document_receipt_date,  hro_employee_document.employee_document_status, hro_employee_document.employee_document_returned_date, hro_employee_document_item.employee_document_item_name');
			$this->db->from('hro_employee_document');
			$this->db->join('hro_employee_data', 'hro_employee_document.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_document_book', 'hro_employee_document.document_book_id = core_document_book.document_book_id');
			$this->db->join('hro_employee_document_item', 'hro_employee_document.employee_document_id = hro_employee_document_item.employee_document_id');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			if($employee_id != ''){
				$this->db->where('hro_employee_document.employee_id', $employee_id);
			}
			$this->db->where('hro_employee_document.data_state', 0);
			return $this->db->get()->result_array();	
		}
		
		public function getCoreDocumentBook(){
			$this->db->select('document_book_id, document_book_code');
			$this->db->from('core_document_book');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDivision(){
			$this->db->select('division_id, division_name');
			$this->db->from('core_division');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDivisionName($division_id)
		{
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getCoreDepartmentData()
		{
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id)
		{
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartmentName($department_id)
		{
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getCoreSection($department_id)
		{
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.department_id', $department_id);
			$this->db->where('core_section.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSectionName($section_id)
		{
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getHroEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHroEmployeeDataName($employee_id)
		{
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('hro_employee_data.data_state', 0);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getEmployeeDocumentLocation(){
			$this->db->select('company_employee_document_location');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result['company_employee_document_location'];
		}

		public function insertHroEmployeeDocument($data){
			return $this->db->insert('hro_employee_document',$data);
		}
		
		public function getEmployeeDocumentID($created_id)
		{
			$this->db->select('hro_employee_document.employee_document_id');
			$this->db->from('hro_employee_document');
			$this->db->where('hro_employee_document.created_id', $created_id);
			$this->db->order_by('hro_employee_document.employee_document_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_document_id'];
		}

		public function getDocumentBookCode($document_book_id)
		{
			$this->db->select('document_book_code');
			$this->db->from('core_document_book');
			$this->db->where('document_book_id', $document_book_id);
			$result = $this->db->get()->row_array();
			return $result['document_book_code'];
		}

		public function insertHroEmployeeDocumentItem($data){
			return $this->db->insert('hro_employee_document_item',$data);
		}

		public function getHroEmployeeDocumentReturned($region_id, $branch_id, $location_id, $employee_id){
			$this->db->select('hro_employee_document.employee_document_id, hro_employee_document.employee_id, hro_employee_data.employee_name, hro_employee_document.document_book_id, core_document_book.document_book_code, hro_employee_document.employee_document_receipt_date,  hro_employee_document.employee_document_status, hro_employee_document.employee_document_returned_date, hro_employee_document_item.employee_document_item_name');
			$this->db->from('hro_employee_document');
			$this->db->join('hro_employee_data', 'hro_employee_document.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_document_book', 'hro_employee_document.document_book_id = core_document_book.document_book_id');
			$this->db->join('hro_employee_document_item', 'hro_employee_document.employee_document_id = hro_employee_document_item.employee_document_id');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			if($employee_id != ''){
				$this->db->where('hro_employee_document.employee_id', $employee_id);
			}
			$this->db->where('hro_employee_document.data_state', 0);
			$this->db->where('hro_employee_document.employee_document_status', 0);
			return $this->db->get()->result_array();	
		}

		public function getHroEmployeeDocument_Detail($employee_document_id){
			$this->db->select('hro_employee_document.employee_document_id, hro_employee_document.employee_id, hro_employee_data.employee_name, hro_employee_document.employee_document_receipt_date, hro_employee_document.document_book_id, core_document_book.document_book_code');
			$this->db->from('hro_employee_document');
			$this->db->join('hro_employee_data', 'hro_employee_document.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_document_book', 'hro_employee_document.document_book_id = core_document_book.document_book_id');
			$this->db->where('hro_employee_document.employee_document_id', $employee_document_id);
			$this->db->where('hro_employee_document.data_state', 0);
			return $this->db->get()->row_array();	
		}

		public function getHroEmployeeDocumentItem($employee_document_id){
			$this->db->select('hro_employee_document_item.employee_document_item_id, hro_employee_document_item.employee_document_item_name');
			$this->db->from('hro_employee_document_item');
			$this->db->join('hro_employee_document', 'hro_employee_document_item.employee_document_id = hro_employee_document.employee_document_id');
			$this->db->join('core_document_book', 'hro_employee_document.document_book_id = core_document_book.document_book_id');
			$this->db->where('hro_employee_document_item.employee_document_id', $employee_document_id);
			$this->db->where('hro_employee_document.data_state', 0);
			$this->db->where('hro_employee_document.employee_document_status', 0);
			return $this->db->get()->row_array();	
		}
		
		public function updateHroEmployeeDocument($data){
			$update = array(
				'employee_document_returned_date' 	=> $data['employee_document_returned_date'],
				'employee_document_status'			=> 1,
			);
			$this->db->where('employee_document_id', $data['employee_document_id']);
			$query = $this->db->update('hro_employee_document', $update);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}
	}
?>