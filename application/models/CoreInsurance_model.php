<?php
	class CoreInsurance_model extends CI_Model {
		var $table = "core_insurance";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreInsurance()
		{
			$this->db->select('core_insurance.insurance_id, core_insurance.insurance_code, core_insurance.insurance_name, core_insurance.insurance_address, core_insurance.insurance_city, core_insurance.insurance_home_phone, core_insurance.insurance_mobile_phone, core_insurance.insurance_contact_person');
			$this->db->from('core_insurance');
			$this->db->where('core_insurance.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreInsurance($data){
			return $this->db->insert('core_insurance',$data);
		}
		
		public function getCoreInsurance_Detail($InsuranceID){
			$this->db->select('core_insurance.insurance_id, core_insurance.insurance_code, core_insurance.insurance_name, core_insurance.insurance_address, core_insurance.insurance_city, core_insurance.insurance_home_phone, core_insurance.insurance_mobile_phone, core_insurance.insurance_contact_person');
			$this->db->from('core_insurance');
			$this->db->where('core_insurance.insurance_id',$InsuranceID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreInsurance($data){
			$this->db->where('core_insurance.insurance_id',$data['insurance_id']);
			$query = $this->db->update('core_insurance', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreInsurance($InsuranceID){
			$this->db->where("core_insurance.insurance_id",$InsuranceID);
			$query = $this->db->update('core_insurance', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
}
?>