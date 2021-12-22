<?php
	class CoreInsurancePremi_model extends CI_Model {
		var $table = "core_insurance_premi";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreInsurancePremi()
		{
			$this->db->select('core_insurance_premi.insurance_premi_id, core_insurance_premi.insurance_premi_code, core_insurance_premi.insurance_premi_amount, core_insurance_premi.insurance_premi_remark, core_insurance_premi.insurance_id');
			$this->db->from('core_insurance_premi');
			$this->db->where('core_insurance_premi.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreInsurancePremi($data){
			return $this->db->insert('core_insurance_premi',$data);
		}
		
		public function getCoreInsurancePremi_Detail($InsurancePremiID){
			$this->db->select('core_insurance_premi.insurance_premi_id, core_insurance_premi.insurance_premi_code, core_insurance_premi.insurance_premi_amount, core_insurance_premi.insurance_premi_remark, core_insurance_premi.insurance_id');
			$this->db->from('core_insurance_premi');
			$this->db->where('core_insurance_premi.insurance_premi_id',$InsurancePremiID);
			return $this->db->get()->row_array();
		}
	
		public function getInsuranceName($InsuranceID){
			$this->db->select('core_insurance.insurance_name');
			$this->db->from('core_insurance');
			$this->db->where('core_insurance.insurance_id',$InsuranceID);
			$result = $this->db->get()->row_array();
			if(!isset($result['insurance_name'])){
				return '-';
			}else{
				return $result['insurance_name'];
			}
		}
		
		function getCoreInsurance(){
			$this->db->where('core_insurance.data_state',0);
			$result = $this->db->get('core_insurance');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function saveEditCoreInsurancePremi($data){
			$this->db->where('core_insurance_premi.insurance_premi_id',$data['insurance_premi_id']);
			$query = $this->db->update('core_insurance_premi', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreInsurancePremi($InsurancePremiID){
			$this->db->where("core_insurance_premi.insurance_premi_id",$InsurancePremiID);
			$query = $this->db->update('core_insurance_premi', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>