<?php
	class transactionalselectionemployee_model extends CI_Model {
		
		public function transactionalselectionemployee_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_listvoid(){
			$table_name = "transaction_applicant_selection";
			
			$this->db->select('applicant_selection_id, region_id, branch_id, division_id, department_id, section_id, location_id, applicant_selection_date, applicant_selection_interview_date	, applicant_selection_remark')->from($table_name);
			$this->db->where('data_state', '0');

			return $this->db->get()->result_array();
		}
		
		public function get_detailselection($id){
			$table_name = "transaction_applicant_selection";
			
			$this->db->select('applicant_selection_id, region_id, branch_id, division_id, department_id, section_id, location_id, applicant_selection_date, applicant_selection_interview_date, applicant_selection_remark')->from($table_name);
			$this->db->where('applicant_selection_id', $id);

			return $this->db->get()->row_array();
		}		
		
		public function get_list(){
			$table_name = "transaction_applicant_request";
			
			$this->db->select('applicant_request_id, region_id, branch_id, division_id, department_id, section_id, location_id, applicant_request_date, applicant_request_due_date, applicant_request_title')->from($table_name);
			$this->db->where('data_state', '0');
			$this->db->where('request_status', '0');

			return $this->db->get()->result_array();
		}
		
		
		public function get_detail($id){
			$table_name = "transaction_applicant_request";
			
			$this->db->select('applicant_request_id, region_id, branch_id, division_id, department_id, section_id, location_id, applicant_request_date, applicant_request_due_date, applicant_request_title')->from($table_name);
			$this->db->where('applicant_request_id', $id);

			return $this->db->get()->row_array();
		}		
		
		public function get_detailitem($id){
			$this->db->select('tasi.applicant_id, ad.applicant_name, tasi.applicant_selection_interview_date, tasi.applicant_selection_status, tasi.applicant_selection_recruited_date')->from("transaction_applicant_selection_item as tasi");
			$this->db->join('transaction_applicant_data as ad','tasi.applicant_id = ad.applicant_id');
			$this->db->where('tasi.applicant_selection_id', $id);

			// print_r( $this->db->get()->result_array());exit;
			return $this->db->get()->result_array();
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
			$result = $this->db->get()->row_array();
			if(!isset($result['department_name'])){
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
		
		function saveselectionemployee($data){
			return $this->db->insert('transaction_applicant_selection',$data);
		}

		function saveselectionemployeeitem($data){
			return $this->db->insert('transaction_applicant_selection_item',$data);
		}

		function updaterequest($data){
			// print_r($data);exit;
			$data2 = array( "applicant_request_status" => $data[applicant_request_status] );
			$this->db->where("applicant_request_id",$data[applicant_request_id]);
			$this->db->where("applicant_id",$data[applicant_id]);
			$query = $this->db->update("transaction_applicant_request_item", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		function updaterequest2($data){
			// print_r($data);exit;
			$data2 = array( "request_status" => '1' );
			$this->db->where("applicant_request_id",$data);
			$query = $this->db->update("transaction_applicant_request", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
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
		
		
		public function getselectionid($created_on,$created_by){
		$this->db->select('applicant_selection_id')->from('transaction_applicant_selection');
		$this->db->where('created_on',$created_on);
		$this->db->where('created_by',$created_by);
		$result = $this->db->get()->row_array();
		return $result[applicant_selection_id];
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