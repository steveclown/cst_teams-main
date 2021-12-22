<?php
	class addnewapplicant_model extends CI_Model {

		public function addnewapplicant_model(){
			parent::__construct();
			$this->CI = get_instance();
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
		

		public function geteducationname($id){
			$this->db->select('education_name')->from('core_education');
			$this->db->where('education_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['education_name'])){
				return '-';
			}else{
				return $result['education_name'];
			}
		}
		
		function geteducation(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_education');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
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

		function getapplicantid($created_by,$created_on){
			$this->db->select('applicant_id')->from('transaction_applicant_data');
			$this->db->where('created_by',$created_by);
			$this->db->where('created_on',$created_on);
			$result = $this->db->get()->row_array();
			if(!isset($result['applicant_id'])){
				return false;
			}else{
				return $result['applicant_id'];
			}
		}
		
		function savepersonaldata($data){
			return $this->db->insert('transaction_applicant_data',$data);
		}

		function saveeducation($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_education',$data);
		}

		function savefamily($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_family',$data);
		}

		function saveaccidentexperience($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_accident_experience',$data);
		}
		
		function saveworkingexperience($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_working_experience',$data);
		}

		function saveinterviewexperience($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_interview_experience',$data);
		}

		function savelawexperience($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_law_experience',$data);
		}

		function saveorganizationexperience($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_organization_experience',$data);
		}

		function savemedicalrecord($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_medical_record',$data);
		}

		function savepersonality($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_personality',$data);
		}

		function savesubjects($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_subjects',$data);
		}

		function saveworkcolleagues($data,$applicant_id){
			// $this->db->set($data);
			$this->db->set('applicant_id', $applicant_id);
			return $this->db->insert('transaction_applicant_work_colleagues',$data);
		}

	}
?>