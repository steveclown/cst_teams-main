<?php
	class CoreSaving_model extends CI_Model {
		var $table = "core_saving";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreSaving()
		{
			$this->db->select('core_saving.saving_id, core_saving.saving_code, core_saving.saving_name, core_saving.saving_amount');
			$this->db->from('core_saving');
			$this->db->where('core_saving.data_state', 0);
			return $this->db->get()->result_array();
			
		}
		
		public function insertCoreSaving($data){
			return $this->db->insert('core_saving',$data);
		}
		
		public function getCoreSaving_Detail($SavingID){
			$this->db->select('core_saving.saving_id, core_saving.saving_code, core_saving.saving_name, core_saving.saving_amount');
			$this->db->from('core_saving');
			$this->db->where('core_saving.saving_id',$SavingID);
			return $this->db->get()->row_array();
		}
	
		public function updateCoreSaving($data){
			$this->db->where('saving_id',$data['saving_id']);
			$query = $this->db->update('core_saving', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreSaving($saving_id){
			$this->db->where("saving_id",$saving_id);
			$query = $this->db->update('core_saving', array("data_state" => 1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>