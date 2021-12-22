<?php
	class transactionalrequestemployee_model extends CI_Model {
		
		public function transactionalrequestemployee_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_listvoid(){
			$table_name = "transaction_applicant_request";
			
			$this->db->select('applicant_request_id, applicant_request_date, applicant_request_due_date, applicant_request_title, applicant_request_remark')->from($table_name);
			$this->db->where('data_state', '0');

			return $this->db->get()->result_array();
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

		public function getregionname($id){
			$this->db->select('region_name')->from('core_region');
			$this->db->where('region_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['region_name'])){
				return '-';
			}else{
				return $result['region_name'];
			}
		}

		public function getbranchname($id){
			$this->db->select('branch_name')->from('core_branch');
			$this->db->where('branch_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['branch_name'])){
				return '-';
			}else{
				return $result['branch_name'];
			}
		}

		public function getdivisionname($id){
			$this->db->select('division_name')->from('core_division');
			$this->db->where('division_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['division_name'])){
				return '-';
			}else{
				return $result['division_name'];
			}
		}

		public function getdepartmentname($id){
			$this->db->select('department_name')->from('core_department');
			$this->db->where('department_id',$id);
			$result = $this->db->get()->row_array();if(!isset($result['department_name'])){
				return '-';
			}else{
				return $result['department_name'];
			}
		}

		public function getsectionname($id){
			$this->db->select('section_name')->from('core_section');
			$this->db->where('section_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['section_name'])){
				return '-';
			}else{
				return $result['section_name'];
			}
		}

		public function getlocationname($id){
			$this->db->select('location_name')->from('core_location');
			$this->db->where('location_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['location_name'])){
				return '-';
			}else{
				return $result['location_name'];
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

		public function getapplicantcity($id){
			$this->db->select('applicant_city')->from('transaction_applicant_data');
			$this->db->where('applicant_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['applicant_city'])){
				return '-';
			}else{
				return $result['applicant_city'];
			}
		}

		function get_list($education_id, $working_experience_job_title, $applicant_city, $applicant_application_position){
			if($education_id=="" && $working_experience_job_title=="" && $applicant_city=="" && $applicant_application_position==""){
				$this->db->select('applicantdata.applicant_id, applicantdata.applicant_name, applicantdata.applicant_city')->from("transaction_applicant_data"." as applicantdata");
				$this->db->where('applicantdata.data_state','0');
				$result = $this->db->get()->result_array();
				return $result;
			}else{
				$this->db->select('applicantdata.applicant_id, applicantdata.applicant_name, applicantdata.applicant_city')->from("transaction_applicant_data"." as applicantdata");
				if($education_id != ''){
					$this->db->join('transaction_applicant_education as applicanteducation', 'applicanteducation.applicant_id=applicantdata.applicant_id');
					$this->db->where('applicanteducation.education_id =',$education_id);
				}
				if($working_experience_job_title != ''){
					$this->db->join('transaction_applicant_working_experience as applicantworkingexperience', 'applicantworkingexperience.applicant_id=applicantdata.applicant_id');
					$this->db->like('applicantworkingexperience.working_experience_job_title', $working_experience_job_title, 'both'); 
				}
				if($applicant_city != ''){
					$this->db->like('applicantdata.applicant_city', $applicant_city, 'both'); 
				}
				if($applicant_application_position != ''){
					$this->db->like('applicantdata.applicant_application_position', $applicant_application_position, 'both'); 
				}
				$this->db->where('applicantdata.data_state','0');
				$this->db->group_by('applicantdata.applicant_id');
				$result = $this->db->get()->result_array();
				// print_r($result);exit;
				return $result;
			}
		}
		
		public function getregion(){
		$this->db->select('region_id, region_name')->from('core_region');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getbranch(){
		$this->db->select('branch_id, branch_name')->from('core_branch');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getdivision(){
		$this->db->select('division_id, division_name')->from('core_division');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getdepartment(){
		$this->db->select('department_id, department_name')->from('core_department');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getsection(){
		$this->db->select('section_id, section_name')->from('core_section');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getjobtitle(){
		$this->db->select('job_title_id, job_title_name')->from('core_job_title');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getgrades(){
		$this->db->select('grade_id, grade_name')->from('core_grade');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getclasss(){
		$this->db->select('class_id, class_name')->from('core_class');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}

		public function getlocation(){
		$this->db->select('location_id, location_name')->from('core_location');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}



		function saverequestemployee($data){
			return $this->db->insert('transaction_applicant_request',$data);
		}

		function saverequestemployeeitem($data){
			return $this->db->insert('transaction_applicant_request_item',$data);
		}
		
		// public function delete($id){
			// $data = array("data_state"=>'1');
			// $this->db->where("applicant_request_id",$id);
			// $query = $this->db->update("transaction_applicant_request", $data);
			// if($query){
				// return true;
			// }else{
				// return false;
			// }
		// }
		
		public function delete($id){
			$query = $this->db->delete("transaction_applicant_request",array('applicant_request_id' => $id));
			if($query){
				try{
				$query = $this->db->delete("transaction_applicant_request_item",array('applicant_request_id' => $id));
					if($query){
						return true;
					}
				}
				catch(Exception $e){
					return true;
				}
			}else{
				return false;
			}
		}
		
}
?>