<?php
	class CoreHomeEarly_model extends CI_Model {
		var $table = "core_homeearly";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreHomeEarly()
		{
			$this->db->select('core_home_early.home_early_id, core_home_early.home_early_code, core_home_early.home_early_name, core_home_early.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_home_early');
			$this->db->join('core_deduction','core_home_early.deduction_id = core_deduction.deduction_id');
			$this->db->where('core_home_early.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDeduction()
		{
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function saveNewCoreHomeEarly($data){
			return $this->db->insert('core_home_early',$data);
		}
		
		public function getCoreHomeEarly_Detail($home_early_id){
			$this->db->select('core_home_early.home_early_id, core_home_early.home_early_code, core_home_early.home_early_name, core_home_early.deduction_id');
			$this->db->from('core_home_early');
			$this->db->where('core_home_early.home_early_id',$home_early_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreHomeEarly($data){
			$this->db->where('home_early_id',$data['home_early_id']);
			$query = $this->db->update('core_home_early', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreHomeEarly($home_early_id){
			$this->db->where("home_early_id",$home_early_id);
			$query = $this->db->update('core_home_early', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>