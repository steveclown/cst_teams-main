<?php
	class CoreTrainingTitle_model extends CI_Model {
		var $table = "core_training_title";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreTrainingTitle()
		{
			$this->db->select('core_training_title.training_title_id, core_training_title.training_title_code, core_training_title.training_category_id, core_training_title.training_title_name, core_training_title.training_title_remark');
			$this->db->from('core_training_title');
			$this->db->where('core_training_title.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		
		/*public function get_child($id)
		{
			$data = array();
			$this->db->from('core_training_title');
			$this->db->where('training_title_parent',$id);
			$result = $this->db->get();
			//print_r($result); exit;
			foreach($result->result() as $row)
			{
				$data[$row->training_title_id] = $row->training_title_name;
			}
			return $data;
		}*/

		public function getCoreTrainingCategory(){
			$this->db->select('core_training_category.training_category_id, core_training_category.training_category_name');
			$this->db->from('core_training_category');
			$this->db->where('core_training_category.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getTrainingCategoryName($training_category_id){
			$this->db->select('core_training_category.training_category_name');
			$this->db->from('core_training_category');
			$this->db->where('core_training_category.training_category_id', $training_category_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['training_category_name'];
		}

		public function getTrainingTitleName($training_title_name){
			$this->db->select('core_training_title.training_title_name');
			$this->db->from('core_training_title');
			$this->db->where('core_training_title.training_title_id', $training_title_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['training_title_name'];
		}
		
		public function getTop($data){
			$this->db->select('training_title_top_parent')->from('core_training_title');
			$this->db->where('training_title_id',$data);
			$result = $this->db->get()->row_array();
			return $result['training_title_top_parent'];
		}
		
		/*public function saveNewtrainingtitle($data){
			$row= $this->getTop($data['training_title_parent']);
			if ($row==''){
			$data['training_title_top_parent']= $data['training_title_parent'];
			} else {
			$data['training_title_top_parent']= $row;
			}
			$query = $this->db->insert('core_training_title',$data);
			if($query){
				$this->db->where("training_title_id",$data['training_title_parent']);
				$this->db->update($this->table,array('training_title_has_chiled'=>'1'));
				return true;
			}else{
				return false;
			}
		}*/
		
		public function saveNewCoreTrainingTitle($data){
			return $this->db->insert('core_training_title',$data);
		}
		
		public function getCoreTrainingTitle_Detail($training_title_id){
			$this->db->select('core_training_title.training_title_id, core_training_title.training_title_code, core_training_title.training_category_id, core_training_title.training_title_name, core_training_title.training_title_remark');
			$this->db->from('core_training_title');
			$this->db->where('core_training_title.training_title_id',$training_title_id);
			$result = $this->db->get();
			return $result->row_array();
		}
		
		public function saveEditCoreTrainingTitle($data){
			$this->db->where('core_training_title.training_title_id', $data['training_title_id']);
			$query = $this->db->update('core_training_title', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreTrainingTitle($training_title_id){
			$this->db->where("core_training_title.training_title_id",$training_title_id);
			$query = $this->db->update('core_training_title', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		/*function getChildstatus($id){
			$this->db->select('training_title_has_chiled')->from('core_training_title');
			$this->db->where('training_title_id',$id);
			$result = $this->db->get()->row_array();
			return $result['training_title_has_chiled'];
		}
		
		
		public function delete($id){
		$this->db->where("training_title_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
		if($query){
		return true;
		}else{
		return false;
		}
		}*/

	}
?>