<?php
	class CoreTrainingProviderItem_model extends CI_Model {
		var $table = "core_training_provider";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreTrainingProviderItem()
		{
			$this->db->select('core_training_provider_item.training_provider_item_id, core_training_provider_item.training_provider_id, core_training_provider_item.training_title_id, core_training_provider_item.training_provider_item_name, core_training_provider_item.training_provider_item_cost, core_training_provider_item.training_provider_item_duration, core_training_provider_item.training_provider_item_remark');
			$this->db->from('core_training_provider_item');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function saveNewCoreTrainingProviderItem($data){
			return $this->db->insert('core_training_provider_item',$data);
		}
		
		public function getCoreTrainingProviderItem_Detail($training_provider_item_id){
			$this->db->select('core_training_provider_item.training_provider_item_id, core_training_provider_item.training_provider_id, core_training_provider_item.training_title_id, core_training_provider_item.training_provider_item_name, core_training_provider_item.training_provider_item_cost, core_training_provider_item.training_provider_item_duration, core_training_provider_item.training_provider_item_remark');
			$this->db->from('core_training_provider_item');
			$this->db->where('core_training_provider_item.training_provider_item_id',$training_provider_item_id);
			return $this->db->get()->row_array();
		}

		public function getCoreTrainingProvider(){
			$this->db->select('core_training_provider.training_provider_id, core_training_provider.training_provider_name');
			$this->db->from('core_training_provider');
			$this->db->where('core_training_provider.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getTrainingProviderName($training_provider_id){
			$this->db->select('core_training_provider.training_provider_name');
			$this->db->from('core_training_provider');
			$this->db->where('core_training_provider.training_provider_id', $training_provider_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['training_provider_name'];
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
		
		public function saveEditCoreTrainingProviderItem($data){
			$this->db->where('core_training_provider_item.training_provider_item_id',$data['training_provider_item_id']);
			$query = $this->db->update('core_training_provider_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreTrainingProviderItem($training_provider_item_id){
			$this->db->where("core_training_provider_item.training_provider_item_id",$training_provider_item_id);
			$query = $this->db->update('core_training_provider_item', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		}
?>