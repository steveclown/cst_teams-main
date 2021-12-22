<?php
	class transactionalselectionemployee_model extends CI_Model {
		var $table = "transaction_applicant_selection";
		
		public function transactionalselectionemployee_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list(){
			$table_name = "transaction_applicant_selection";

			$this->db->select('applicant_selection_id, applicant_selection_date, applicant_selection_interview_date, applicant_selection_status, applicant_selection_remark')->from($table_name);
			$this->db->where('data_state', '0');
			$this->db->order_by('applicant_selection_id', 'desc');

			return $this->db->get()->result_array();
		}
		
		public function get_listrequest()
		{
			$table_name = "transaction_applicant_request";

			$this->db->select('applicant_request_id, applicant_request_date, applicant_request_due_date, applicant_request_title, applicant_request_remark')->from($table_name);
			$this->db->where('data_state', '0');
			$this->db->where('applicant_request_status', '0');

			return $this->db->get()->result_array();
		}
		
		public function get_detailrequest($id){
			$table_name = "transaction_applicant_request_item";
			
			$this->db->select('applicant_id, region_id, branch_id, division_id, department_id, section_id, location_id, job_title_id, grade_id, class_id, applicant_request_status')->from($table_name);
			$this->db->where('applicant_request_id', $id);

			return $this->db->get()->result_array();
		}
		
		public function get_detailselection($id){
			$table_name = "transaction_applicant_selection";
			
			$this->db->select('applicant_selection_id, applicant_request_id, applicant_selection_date, applicant_selection_interview_date, applicant_selection_status, applicant_selection_remark')->from($table_name);
			$this->db->where('applicant_selection_id', $id);

			return $this->db->get()->row_array();
		}		
		
		public function get_detailitem($id){
			$table_name = "transaction_applicant_selection_item";
			
			$this->db->select('applicant_selection_id, applicant_id, region_id, branch_id, division_id, department_id, section_id, location_id, job_title_id, grade_id, class_id, applicant_selection_interview_date, applicant_selection_status, applicant_selection_recruited_date')->from($table_name);
			$this->db->where('applicant_selection_id', $id);

			return $this->db->get()->result_array();
		}

		public function get_detailitemdelete($id){
			$table_name = "transaction_applicant_selection_item";
			
			$this->db->select('applicant_id')->from($table_name);
			$this->db->where('applicant_selection_id', $id);

			return $this->db->get()->result_array();
		}
		
		public function getselectionid($created_on,$created_by){
			$this->db->select('applicant_selection_id')->from('transaction_applicant_selection');
			$this->db->where('created_on',$created_on);
			$this->db->where('created_by',$created_by);
			$result = $this->db->get()->row_array();
			return $result[applicant_selection_id];
		}
		
		function getapplicant($education_id, $working_experience_job_title, $applicant_city, $applicant_application_position){
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
		
		public function getregion(){
		$this->db->select('region_id, region_name')->from('core_region');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
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

		public function getbranch(){
		$this->db->select('branch_id, branch_name')->from('core_branch');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
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

		public function getdivision(){
		$this->db->select('division_id, division_name')->from('core_division');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
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

		public function getdepartment(){
		$this->db->select('department_id, department_name')->from('core_department');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
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

		public function getsection(){
		$this->db->select('section_id, section_name')->from('core_section');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
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
		
		public function getjobtitle(){
		$this->db->select('job_title_id, job_title_name')->from('core_job_title');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}
		
		public function getjobtitlename($id){
			$this->db->select('job_title_name')->from('core_job_title');
			$this->db->where('job_title_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['job_title_name'])){
				return '-';
			}else{
				return $result['job_title_name'];
			}
		}

		public function getgrade(){
		$this->db->select('grade_id, grade_name')->from('core_grade');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}
		
		public function getgradename($id){
			$this->db->select('grade_name')->from('core_grade');
			$this->db->where('grade_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['grade_name'])){
				return '-';
			}else{
				return $result['grade_name'];
			}
		}

		public function getclasss(){
		$this->db->select('class_id, class_name')->from('core_class');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
		}
		
		public function getclassname($id){
			$this->db->select('class_name')->from('core_class');
			$this->db->where('class_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['class_name'])){
				return '-';
			}else{
				return $result['class_name'];
			}
		}

		public function getlocation(){
		$this->db->select('location_id, location_name')->from('core_location');
		$this->db->where('data_state', '0');
		return $this->db->get()->result_array();
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
		
		function saveselection($data){
			return $this->db->insert('transaction_applicant_selection',$data);
		}

		function saveselectionitem($data){
			// print_r($data);exit;
			return $this->db->insert('transaction_applicant_selection_item',$data);
		}

		function updaterequest($data,$request_id){
			$this->db->where('applicant_request_id',$request_id);
			$query = $this->db->update('transaction_applicant_request', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		function updaterequestitem($data,$applicant_id,$request_id){
			$this->db->where('applicant_id',$applicant_id);
			$this->db->where('applicant_request_id',$request_id);
			$query = $this->db->update('transaction_applicant_request_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getDetail($id){
			$this->db->select('transactionalselectionemployee_id, transactionalselectionemployee_code, transactionalselectionemployee_name , data_state, last_update')->from($this->table);
			$this->db->where('transactionalselectionemployee_id',$id);
			return $this->db->get()->row_array();
		}
		
		function revertrequest($applicant_request_id){
			$data = array('applicant_request_status'=>'0');
			$this->db->where('applicant_request_id',$applicant_request_id);
			$query = $this->db->update('transaction_applicant_request', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		function revertrequestitem($applicant_request_id, $applicant_id){
			$data = array('applicant_request_status'=>'0');
			$this->db->where('applicant_request_id',$applicant_request_id);
			$this->db->where('applicant_id',$applicant_id);
			$query = $this->db->update('transaction_applicant_request_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		// public function delete($id){
			// $data = array("data_state"=>'1');
			// $this->db->where("applicant_selection_id",$id);
			// $query = $this->db->update("transaction_applicant_selection", $data);
			// if($query){
				// return true;
			// }else{
				// return false;
			// }
		// }
		
		public function delete($id){
			$query = $this->db->delete("transaction_applicant_selection",array('applicant_selection_id' => $id));
			if($query){
				try{
				$query = $this->db->delete("transaction_applicant_selection_item",array('applicant_selection_id' => $id));
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