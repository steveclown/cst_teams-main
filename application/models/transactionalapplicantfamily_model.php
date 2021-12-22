<?php
	class transactionalapplicantfamily_model extends CI_Model {
		var $table = "transaction_applicant_family";
		
		public function transactionalapplicantfamily_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_applicant_family";
			
			//Build contents query
			$this->db->select('applicant_family_id, status, family_status_id, applicant_id, applicant_family_name, applicant_family_address, applicant_family_city, applicant_family_zip_code, applicant_family_rt, applicant_family_rw, applicant_family_kecamatan, applicant_family_kelurahan, applicant_family_home_phone, applicant_family_mobile_phone1, applicant_family_mobile_phone2, applicant_family_gender, applicant_family_date_of_birth, applicant_family_place_of_birth, applicant_family_education, applicant_family_occupation, marital_status_id, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalapplicantfamily($data){
			return $this->db->insert('transaction_applicant_family',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('applicant_family_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalapplicantfamily($data){
			$this->db->where('applicant_family_id',$data['applicant_family_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getmaritalstatusname($id){
			$this->db->select('marital_status_name')->from('core_marital_status');
			$this->db->where('marital_status_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['marital_status_name'])){
				return '-';
			}else{
				return $result['marital_status_name'];
			}
		}
		
		public function getfamilystatusname($id){
			$this->db->select('family_status_name')->from('core_family_status');
			$this->db->where('family_status_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['family_status_name'])){
				return '-';
			}else{
				return $result['family_status_name'];
			}
		}
		
		public function getapplicantname($id){
			$this->db->select('applicant_name')->from('transaction_applicant_data');
			$this->db->where('applicant_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['applicant_name'])){
				return '-';
			}else{
				return $result['applicant_name'];
			}
		}
		
		function getmaritalstatus(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_marital_status');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		function getfamilystatus(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_family_status');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		function getapplicant(){
			$this->db->where('data_state','0');
			$result = $this->db->get('transaction_applicant_data');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function delete($id){
			$this->db->where("applicant_family_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		 }
	}
?>