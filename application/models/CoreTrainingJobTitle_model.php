<?php
	class CoreTrainingJobTitle_model extends CI_Model {
		var $table = "core_training_job_title";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreTrainingJobTitle()
		{
			$this->db->select('core_training_job_title.training_job_title_id, core_training_job_title.training_job_title_code, core_training_job_title.training_title_id, core_training_job_title.job_title_id, core_training_job_title.training_job_title_name, core_training_job_title.training_job_title_remark');
			$this->db->from('core_training_job_title');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function saveNewCoreTrainingJobTitle($data){
			return $this->db->insert('core_training_job_title',$data);
		}
		
		public function getCoreTrainingJobTitle_Detail($training_job_title_id){
			$this->db->select('core_training_job_title.training_job_title_id, core_training_job_title.training_job_title_code, core_training_job_title.training_title_id, core_training_job_title.job_title_id, core_training_job_title.training_job_title_name, core_training_job_title.training_job_title_remark');
			$this->db->from('core_training_job_title');
			$this->db->where('core_training_job_title.training_job_title_id',$training_job_title_id);
			return $this->db->get()->row_array();
		}

		public function getCoreTrainingTitle(){
			$this->db->select('core_training_title.training_title_id, core_training_title.training_title_name');
			$this->db->from('core_training_title');
			$this->db->where('core_training_title.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getTrainingTitleName($training_title_id){
			$this->db->select('core_training_title.training_title_name');
			$this->db->from('core_training_title');
			$this->db->where('core_training_title.training_title_id', $training_title_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['training_title_name'];
		}

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getJobTitleName($job_title_id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $job_title_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['job_title_name'];
		}		
		
		public function saveEditCoreTrainingJobTitle($data){
			$this->db->where('core_training_job_title.training_job_title_id',$data['training_job_title_id']);
			$query = $this->db->update('core_training_job_title', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreTrainingJobTitle($training_job_title_id){
			$this->db->where("core_training_job_title.training_job_title_id",$training_job_title_id);
			$query = $this->db->update('core_training_job_title', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		}
?>