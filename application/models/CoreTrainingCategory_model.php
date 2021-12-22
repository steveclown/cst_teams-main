<?php
	class CoreTrainingCategory_model extends CI_Model {
		var $table = "core_training_category";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreTrainingCategory()
		{
			$this->db->select('core_training_category.training_category_id, core_training_category.training_category_code, core_training_category.training_category_name');
			$this->db->from('core_training_category');
			$this->db->where('core_training_category.data_state', 0);
			return $this->db->get()->result_array();
			
		}
		
		public function saveNewCoreTrainingcategory($data){
			return $this->db->insert('core_training_category',$data);
		}
		
		public function getCoreTrainingCategory_Detail($TrainingCategoryID){
			$this->db->select('core_training_category.training_category_id, core_training_category.training_category_code, core_training_category.training_category_name');
			$this->db->from('core_training_category');
			$this->db->where('core_training_category.training_category_id',$TrainingCategoryID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreTrainingCategory($data){
			$this->db->where('core_training_category.training_category_id',$data['training_category_id']);
			$query = $this->db->update('core_training_category', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreTrainingCategory($TrainingCategoryID){
			$this->db->where("core_training_category.training_category_id",$TrainingCategoryID);
			$query = $this->db->update('core_training_category', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>