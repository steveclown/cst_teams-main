<?php
	class CoreTrainingProvider_model extends CI_Model {
		var $table = "core_training_provider";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreTrainingProvider()
		{
			$this->db->select('core_training_provider.training_provider_id, core_training_provider.training_provider_code, core_training_provider.training_provider_name, core_training_provider.training_provider_address, core_training_provider.training_provider_city, core_training_provider.training_provider_home_phone, core_training_provider.training_provider_mobile_phone, core_training_provider.training_provider_fax_number, core_training_provider.training_provider_email, core_training_provider.training_provider_contact_person, core_training_provider.training_provider_remark');
			$this->db->from('core_training_provider');
			$this->db->where('data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function saveNewCoreTrainingProvider($data){
			return $this->db->insert('core_training_provider',$data);
		}
		
		public function getCoreTrainingProvider_Detail($training_provider_id){
			$this->db->select('core_training_provider.training_provider_id, core_training_provider.training_provider_code, core_training_provider.training_provider_name, core_training_provider.training_provider_address, core_training_provider.training_provider_city, core_training_provider.training_provider_home_phone, core_training_provider.training_provider_mobile_phone, core_training_provider.training_provider_fax_number, core_training_provider.training_provider_email, core_training_provider.training_provider_contact_person, core_training_provider.training_provider_remark');
			$this->db->from('core_training_provider');
			$this->db->where('core_training_provider.training_provider_id',$training_provider_id);
			return $this->db->get()->row_array();
		}

		public function getCoreProvider(){
			$this->db->select('core_provider.provider_id, core_provider.provider_name');
			$this->db->from('core_provider');
			$this->db->where('core_provider.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getProviderName($provider_id){
			$this->db->select('core_provider.provider_name');
			$this->db->from('core_provider');
			$this->db->where('core_provider.provider_id', $provider_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['provider_name'];
		}		
		
		public function saveEditCoreTrainingProvider($data){
			$this->db->where('core_training_provider.training_provider_id',$data['training_provider_id']);
			$query = $this->db->update('core_training_provider', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreTrainingProvider($training_provider_id){
			$this->db->where("core_training_provider.training_provider_id",$training_provider_id);
			$query = $this->db->update('core_training_provider', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		}
?>