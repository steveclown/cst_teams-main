<?php
	class CoreCustomer_model extends CI_Model {
		var $table = "core_customer";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreCustomer()
		{
			$this->db->select('core_customer.customer_id, core_customer.customer_code, core_customer.customer_name, core_customer.customer_address, core_customer.customer_city');
			$this->db->from('core_customer');
			$this->db->where('core_customer.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreCustomer($data){
			return $this->db->insert('core_customer',$data);
		}

		public function getCustomerID(){
			$this->db->select('core_customer.customer_id');
			$this->db->from('core_customer');
			$this->db->order_by('core_customer.customer_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['customer_id'];
		}
		
		public function getCoreCustomer_Detail($customerID){
			$this->db->select('core_customer.customer_id, core_customer.customer_code, core_customer.customer_name, core_customer.customer_address, core_customer.customer_city');
			$this->db->from('core_customer');
			$this->db->where('core_customer.customer_id', $customerID);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function saveEditCoreCustomer($data){
			$this->db->where("customer_id",$data['customer_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		public function deleteCoreCustomer($CustomerID){
			$this->db->where("customer_id",$CustomerID);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>