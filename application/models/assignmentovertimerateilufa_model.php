<?php
	class assignmentovertimerateilufa_model extends CI_Model {
		var $table = "core_customer";
		
		public function assignmentovertimerateilufa_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getAssignmentOvertimeRate()
		{
			$this->db->select('assignment_overtime_rate.overtime_rate_id, assignment_overtime_rate.job_title_id, core_job_title.job_title_name, assignment_overtime_rate.overtime_rate_description, assignment_overtime_rate.overtime_rate_effective_date, assignment_overtime_rate.overtime_rate_amount, assignment_overtime_rate.overtime_rate_trip_amount');
			$this->db->from('assignment_overtime_rate');
			$this->db->join('core_job_title', 'assignment_overtime_rate.job_title_id = core_job_title.job_title_id');
			$this->db->where('assignment_overtime_rate.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$this->db->order_by('core_job_title.job_title_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function insertAssignmentOvertimeRate($data){
			return $this->db->insert('assignment_overtime_rate',$data);
		}
		
		public function getAssignmentOvertimeRate_Detail($overtime_rate_id){
			$this->db->select('assignment_overtime_rate.overtime_rate_id, assignment_overtime_rate.job_title_id, core_job_title.job_title_name, assignment_overtime_rate.overtime_rate_description, assignment_overtime_rate.overtime_rate_effective_date, assignment_overtime_rate.overtime_rate_amount, assignment_overtime_rate.overtime_rate_trip_amount');
			$this->db->from('assignment_overtime_rate');
			$this->db->join('core_job_title', 'assignment_overtime_rate.job_title_id = core_job_title.job_title_id');
			$this->db->where('assignment_overtime_rate.overtime_rate_id', $overtime_rate_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function updateAssignmentOvertimeRate($data){
			$this->db->where("assignment_overtime_rate.overtime_rate_id", $data['overtime_rate_id']);
			$query = $this->db->update('assignment_overtime_rate', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteAssignmentOvertimeRate($overtime_rate_id){
			$this->db->where("assignment_overtime_rate.overtime_rate_id", $overtime_rate_id);
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
	}
?>