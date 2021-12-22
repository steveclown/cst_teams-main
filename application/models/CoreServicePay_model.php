<?php
	class CoreServicePay_model extends CI_Model {
		var $table = "core_service_pay";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreServicePay()
		{
			$this->db->select('core_service_pay.service_pay_id, core_service_pay.service_pay_code, core_service_pay.service_pay_name, core_service_pay.service_pay_range1, core_service_pay.service_pay_range2, core_service_pay.service_pay_ratio, core_service_pay.service_pay_type, core_service_pay.service_pay_remark');
			$this->db->from('core_service_pay');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreServicePay($data){
			return $this->db->insert('core_service_pay',$data);
		}
		
		public function getCoreServicePay_Detail($ServicePayID){
			$this->db->select('core_service_pay.service_pay_id, core_service_pay.service_pay_code, core_service_pay.service_pay_name, core_service_pay.service_pay_range1, core_service_pay.service_pay_range2, core_service_pay.service_pay_ratio, core_service_pay.service_pay_type, core_service_pay.service_pay_remark');
			$this->db->from('core_service_pay');
			$this->db->where('service_pay_id',$ServicePayID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreServicePay($data){
			$this->db->where('core_service_pay.service_pay_id',$data['service_pay_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreServicePay($ServicePayID){
			$this->db->where("service_pay_id",$ServicePayID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>