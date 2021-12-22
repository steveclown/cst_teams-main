<?php
	class CoreApplicantStatus_model extends CI_Model {
		var $table = "core_applicant_status";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreApplicantStatus()
		{
			$this->db->select('core_applicant_status.applicant_status_id, core_applicant_status.applicant_status_code, core_applicant_status.applicant_status_name');
			$this->db->from('core_applicant_status');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreApplicantStatus($data){
			return $this->db->insert('core_applicant_status',$data);
		}
		
		public function getCoreApplicantStatus_Detail($applicant_status_id){
			$this->db->select('core_applicant_status.applicant_status_id, core_applicant_status.applicant_status_code, core_applicant_status.applicant_status_name , core_applicant_status.data_state, core_applicant_status.last_update');
			$this->db->from('core_applicant_status');
			$this->db->where('applicant_status_id',$applicant_status_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreApplicantStatus($data){
			$this->db->where('applicant_status_id',$data['applicant_status_id']);
			$query = $this->db->update('core_applicant_status', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreApplicantStatus($applicant_status_id){
		$this->db->where("applicant_status_id",$applicant_status_id);
		$query = $this->db->update('core_applicant_status', array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>