<?php
	class assignmentovertimerate_model extends CI_Model {
		var $table = "core_customer";
		
		public function assignmentovertimerate_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getAssignmentOvertimeRate()
		{
			$this->db->select('assignment_overtime_rate.overtime_rate_id, assignment_overtime_rate.zone_id, assignment_overtime_rate.overtime_rate_description, assignment_overtime_rate.overtime_rate_effective_date');
			$this->db->from('assignment_overtime_rate');
			$this->db->where('assignment_overtime_rate.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$this->db->where('core_department.division_id', $division_id);
			$result = $this->db->get();
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			$this->db->where('core_section.department_id', $department_id);
			$result = $this->db->get();
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		public function getCoreZone(){
			$this->db->select('core_zone.zone_id, core_zone.zone_name');
			$this->db->from('core_zone');
			$this->db->where('core_zone.data_state', 0);
			$this->db->order_by('core_zone.zone_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$this->db->order_by('core_division.division_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$this->db->order_by('core_job_title.job_title_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreAllowance(){
			$this->db->select('core_allowance.allowance_id, core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.data_state', 0);
			$this->db->order_by('core_allowance.allowance_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getZoneName($zoneID){
			$this->db->select('core_zone.zone_name');
			$this->db->from('core_zone');
			$this->db->where('core_zone.zone_id', $zoneID);
			$result = $this->db->get()->row_array();
			return $result['zone_name'];
		}

		public function getDivisionName($divisionID){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $divisionID);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getDepartmentName($departmentID){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $departmentID);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($sectionID){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $sectionID);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getJobTitleName($jobTitleID){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $jobTitleID);
			$result = $this->db->get()->row_array();
			return $result['job_title_name'];
		}

		public function getAllowanceName($allowanceID){
			$this->db->select('core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.allowance_id', $allowanceID);
			$result = $this->db->get()->row_array();
			return $result['allowance_name'];
		}
		
		
		public function insertAssignmentOvertimeRate($data){
			return $this->db->insert('assignment_overtime_rate',$data);
		}

		public function getOvertimeRateID(){
			$this->db->select('assignment_overtime_rate.overtime_rate_id');
			$this->db->from('assignment_overtime_rate');
			$this->db->order_by('assignment_overtime_rate.overtime_rate_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['overtime_rate_id'];
		}

		public function insertAssignmentOvertimeRateTitle($data){
			if($this->db->insert('assignment_overtime_rate_title', $data)){
				return true;
			}else{
				return false;
			}
		}
		
		public function getAssignmentOvertimeRate_Detail($overtimeRateID){
			$this->db->select('assignment_overtime_rate.overtime_rate_id, assignment_overtime_rate.zone_id, core_zone.zone_name, assignment_overtime_rate.overtime_rate_description, assignment_overtime_rate.overtime_rate_effective_date');
			$this->db->from('assignment_overtime_rate');
			$this->db->join('core_zone', 'assignment_overtime_rate.zone_id = core_zone.zone_id');
			$this->db->where('assignment_overtime_rate.overtime_rate_id', $overtimeRateID);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getAssignmentOvertimeRateTitle_Detail($overtimeRateID){
			$this->db->select('assignment_overtime_rate_title.overtime_rate_title_id, assignment_overtime_rate_title.overtime_rate_id, assignment_overtime_rate_title.division_id, assignment_overtime_rate_title.department_id, assignment_overtime_rate_title.section_id, assignment_overtime_rate_title.job_title_id, assignment_overtime_rate_title.overtime_rate_amount');
			$this->db->from('assignment_overtime_rate_title');
			$this->db->where('assignment_overtime_rate_title.overtime_rate_id', $overtimeRateID);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function saveEditAssignmentOvertimeRate($data){
			$this->db->where("overtime_rate_id",$data['overtime_rate_id']);
			$query = $this->db->update('assignment_overtime_rate', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		public function deleteAssignmentOvertimeRate($overtimeRateID){
			$this->db->where("overtime_rate_id",$overtimeRateID);
			$query = $this->db->update('assignment_overtime_rate', array("data_state"=>'1'));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

		public function deleteAssignmentOvertimeRateTitle($overtimeRateID){
			$this->db->where("overtime_rate_id", $overtimeRateID);
			$query = $this->db->delete("assignment_overtime_rate_title");
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function saveUpdateAssignmentOvertimeRateTitle($data, $overtime_rate_id){

			$item = array(
				'overtime_rate_id'					=> $overtime_rate_id,
				'division_id'						=> $data['division_id'],	
				'department_id'						=> $data['department_id'],
				'section_id'						=> $data['section_id'],
				'job_title_id'						=> $data['job_title_id'],
				'allowance_id'						=> $data['allowance_id'],
				'overtime_rate_allowance_amount'	=> $data['overtime_rate_allowance_amount'],		
			);
			// print_r($item);exit;
			if($this->db->insert('assignment_overtime_rate_title', $item)){
				return true;
			}else{
				return false;
			}
		}
	}
?>