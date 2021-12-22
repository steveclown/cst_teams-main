<?php
	class transactionalapplicantmedicalrecord_model extends CI_Model {
		var $table = "transaction_applicant_medical_record";
		
		public function transactionalapplicantmedicalrecord_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_applicant_medical_record";
			
			//Build contents query
			$this->db->select('applicant_medical_record_id, status, applicant_id, family_status_id, applicant_medical_disease, applicant_medical_name, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalapplicantmedicalrecord($data){
			return $this->db->insert('transaction_applicant_medical_record',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('applicant_medical_record_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalapplicantmedicalrecord($data){
			$this->db->where('applicant_medical_record_id',$data['applicant_medical_record_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
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
		
		public function delete($id){
			$this->db->where("applicant_medical_record_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		 }
	}
?>