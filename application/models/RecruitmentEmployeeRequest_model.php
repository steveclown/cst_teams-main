<?php
	class RecruitmentEmployeeRequest_model extends CI_Model {
		var $table = "transaction_employee_request";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getRecruitmentEmployeeRequest()
		{
			$this->db->select('recruitment_employee_request.employee_request_id, recruitment_employee_request.user_id, recruitment_employee_request.employee_id, recruitment_employee_request.employee_request_date, recruitment_employee_request.employee_request_due_date, recruitment_employee_request.employee_request_title, recruitment_employee_request.created_id ,recruitment_employee_request.employee_request_remark');
			$this->db->from('recruitment_employee_request');
			$this->db->where('recruitment_employee_request.data_state', 0);
			$this->db->order_by('recruitment_employee_request.employee_request_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getCoreRegion(){
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreBranch(){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreLocation(){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreGrade(){
			$this->db->select('core_grade.grade_id, core_grade.grade_name');
			$this->db->from('core_grade');
			$this->db->where('core_grade.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreClass(){
			$this->db->select('core_class.class_id, core_class.class_name');
			$this->db->from('core_class');
			$this->db->where('core_class.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreEducation(){
			$this->db->select('core_education.education_id, core_education.education_name');
			$this->db->from('core_education');
			$this->db->where('core_education.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreExpertise(){
			$this->db->select('core_expertise.expertise_id, core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getRegionName($region_id){
			$this->db->select('core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.region_id', $region_id);
			$result = $this->db->get()->row_array();
			return $result['region_name'];
		}

				
		public function getBranchName($branch_id){
			$this->db->select('core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_id', $branch_id);
			$result = $this->db->get()->row_array();
			return $result['branch_name'];
		}

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$result = $this->db->get()->row_array();
			return $result['location_name'];
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}
		
		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}
		
		public function getJobTitleName($job_title_id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $job_title_id);
			$result = $this->db->get()->row_array();
			return $result['job_title_name'];
		}

		public function getEducationName($education_id){
			$this->db->select('core_education.education_name');
			$this->db->from('core_education');
			$this->db->where('core_education.education_id', $education_id);
			$result = $this->db->get()->row_array();
			return $result['education_name'];
		}

		public function getExpertiseName($expertise_id){
			$this->db->select('core_expertise.expertise_name');
			$this->db->from('core_expertise');
			$this->db->where('core_expertise.expertise_id', $expertise_id);
			$result = $this->db->get()->row_array();
			return $result['expertise_name'];
		}

		public function saveRecruitmentEmployeeRequest($data){
			return $this->db->insert('recruitment_employee_request', $data);
		}

		public function getEmployeeRequestID($created_id){
			$this->db->select('recruitment_employee_request.employee_request_id');
			$this->db->from('recruitment_employee_request');
			$this->db->where('recruitment_employee_request.created_id', $created_id);
			$this->db->order_by('recruitment_employee_request.employee_request_id','DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['employee_request_id'];
		}

		public function saveRecruitmentEmployeeRequestItem($data){
			return $this->db->insert('recruitment_employee_request_item',$data);
		}

		public function getRecruitmentEmployeeRequest_Detail($employee_request_id){			
			$this->db->select('recruitment_employee_request.employee_request_id, recruitment_employee_request.employee_request_date, recruitment_employee_request.employee_request_due_date, recruitment_employee_request.employee_request_title, recruitment_employee_request.employee_request_status, recruitment_employee_request.employee_request_status_remark, recruitment_employee_request.employee_request_remark');
			$this->db->from('recruitment_employee_request');
			$this->db->where('recruitment_employee_request.employee_request_id', $employee_request_id);
			return $this->db->get()->row_array();
		}		
		
		public function getRecruitmentEmployeeRequestItem_Detail($employee_request_id){
			$this->db->select('recruitment_employee_request_item.employee_request_item_id, recruitment_employee_request_item.region_id,recruitment_employee_request_item.branch_id, recruitment_employee_request_item.division_id, recruitment_employee_request_item.department_id, recruitment_employee_request_item.section_id, recruitment_employee_request_item.location_id, recruitment_employee_request_item.job_title_id, recruitment_employee_request_item.education_id, recruitment_employee_request_item.expertise_id, recruitment_employee_request_item.employee_request_item_status, recruitment_employee_request_item.employee_request_item_description, recruitment_employee_request_item.employee_request_item_status, recruitment_employee_request_item.employee_request_item_total, ');
			$this->db->from('recruitment_employee_request_item');
			$this->db->where('employee_request_id', $employee_request_id);
			return $this->db->get()->result_array();
		}

		public function getRecruitmentEmployeeRequest_Approval(){			
			$this->db->select('recruitment_employee_request.employee_request_id, recruitment_employee_request.employee_id, recruitment_employee_request.employee_request_date, recruitment_employee_request.employee_request_due_date, recruitment_employee_request.employee_request_title, recruitment_employee_request.employee_request_status, recruitment_employee_request.employee_request_status_remark, recruitment_employee_request.employee_request_remark, recruitment_employee_request.approved');
			$this->db->from('recruitment_employee_request');
			$this->db->where('recruitment_employee_request.data_state',0);
			return $this->db->get()->result_array();
		}	
		
		function getemployee($education_id, $working_experience_job_title, $employee_city, $employee_application_position){
			if($education_id=="" && $working_experience_job_title=="" && $employee_city=="" && $employee_application_position==""){
				$this->db->select('employeedata.employee_id, employeedata.employee_name, employeedata.employee_city')->from("transaction_employee_data"." as employeedata");
				$this->db->where('employeedata.data_state','0');
				$result = $this->db->get()->result_array();
				return $result;
			}else{
				$this->db->select('employeedata.employee_id, employeedata.employee_name, employeedata.employee_city')->from("transaction_employee_data"." as employeedata");
				if($education_id != ''){
					$this->db->join('transaction_employee_education as employeeeducation', 'employeeeducation.employee_id=employeedata.employee_id');
					$this->db->where('employeeeducation.education_id =',$education_id);
				}
				if($working_experience_job_title != ''){
					$this->db->join('transaction_employee_working_experience as employeeworkingexperience', 'employeeworkingexperience.employee_id=employeedata.employee_id');
					$this->db->like('employeeworkingexperience.working_experience_job_title', $working_experience_job_title, 'both'); 
				}
				if($employee_city != ''){
					$this->db->like('employeedata.employee_city', $employee_city, 'both'); 
				}
				if($employee_application_position != ''){
					$this->db->like('employeedata.employee_application_position', $employee_application_position, 'both'); 
				}
				$this->db->where('employeedata.data_state','0');
				$this->db->group_by('employeedata.employee_id');
				$result = $this->db->get()->result_array();
				// print_r($result);exit;
				return $result;
			}
		}
		
		public function approvedRecruitmentEmployeeRequest($data){
			$this->db->where('employee_request_id', $data['employee_request_id']);
			if($this->db->update('recruitment_employee_request', $data)){
				return true;
			} else {
				return false;
			}
		}
		
		
		public function getDetail($id){
			$this->db->select('recruitmentemployeerequest_id, recruitmentemployeerequest_code, recruitmentemployeerequest_name , data_state, last_update')->from($this->table);
			$this->db->where('recruitmentemployeerequest_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditrecruitmentemployeerequest($data){
			$this->db->where('recruitmentemployeerequest_id',$data['recruitmentemployeerequest_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		// public function delete($id){
			// $data = array("data_state"=>'1');
			// $this->db->where("employee_request_id",$id);
			// $query = $this->db->update("transaction_employee_request", $data);
			// if($query){
				// return true;
			// }else{
				// return false;
			// }
		// }
		
		public function delete($id){
			$query = $this->db->delete("transaction_employee_request",array('employee_request_id' => $id));
			if($query){
				try{
				$query = $this->db->delete("transaction_employee_request_item",array('employee_request_id' => $id));
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