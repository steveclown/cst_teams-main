<?php
	class transactionalapplicantaccidentexperience_model extends CI_Model {
		var $table = "transaction_applicant_accident_experience";
		
		public function transactionalapplicantaccidentexperience_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_applicant_accident_experience";
			
			//Build contents query
			$this->db->select('applicant_accident_experience_id, status, applicant_id, accident_experience_period, accident_experience_remark, accident_experience_consequence, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalapplicantaccidentexperience($data){
			return $this->db->insert('transaction_applicant_accident_experience',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('applicant_accident_experience_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalapplicantaccidentexperience($data){
			$this->db->where('applicant_accident_experience_id',$data['applicant_accident_experience_id']);
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
			$this->db->where("applicant_accident_experience_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		 }
	}
?>