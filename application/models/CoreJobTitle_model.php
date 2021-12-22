<?php
	class CoreJobTitle_model extends CI_Model {
		var $table = "core_job_title";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreJobTitle()
		{
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_code, core_job_title.job_title_name, core_job_title.job_title_parent_id');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);fv
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getCoreJobTitle_Parent()
		{
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
	
		public function getJobTitleName($id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['job_title_name'])){
				return '- None -';
			}else{
				return $result['job_title_name'];
			}
		}
		public function getTop($data){
			$this->db->select('core_job_title.job_title_top_parent_id');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $data);
			$result = $this->db->get()->row_array();
			return $result['job_title_top_parent_id'];
		}

		public function getJobTitleToken($jobtitle_token)
		{	
			$this->db->select('core_job_title.job_title_token');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_token', $jobtitle_token);
			$result = $this->db->get()->num_rows();
			return$result;
		}
		
		public function saveNewCoreJobTitle($data){
			$row= $this->getTop($data['job_title_parent_id']);
			if ($row==''){
			$data['job_title_parent_id']= $data['job_title_parent_id'];
			} else {
			$data['job_title_parent_id']= $row;
			}
			$query = $this->db->insert('core_job_title',$data);
			if($query){
				$this->db->where("job_title_id", $data['job_title_parent_id']);
				$this->db->update($this->table,array('job_title_has_child'=>'1'));
				return true;
			}else{
				return false;
			}
		}
		
		public function getCoreJobTitle_Detail($id){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('job_title_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreJobTitle($data){
			$this->db->where('job_title_id',$data['job_title_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getChildStatus($id){
			$this->db->select('core_job_title.job_title_has_child');
			$this->db->from('core_job_title');
			$this->db->where('job_title_id',$id);
			$result = $this->db->get()->row_array();
			return $result['job_title_has_child'];
		}
		
		public function deleteCoreJobTitle($id){
			$this->db->where("job_title_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>