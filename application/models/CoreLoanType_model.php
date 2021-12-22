<?php
	class CoreLoanType_model extends CI_Model {
		var $table = "core_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		public function getCoreLoanType()
		{
			$this->db->select('core_loan_type.loan_type_id, core_loan_type.loan_type_code, core_loan_type.loan_type_name');
			$this->db->from('core_loan_type');
			$this->db->where('core_loan_type.data_state', 0);
			return $this->db->get()->result_array();
		}
			
		public function saveNewCoreLoanType($data){
			return $this->db->insert('core_loan_type',$data);
		}

		public function getLoanTypeID(){
			$this->db->select('core_loan_type.loan_type_id');
			$this->db->from('core_loan_type');
			$this->db->order_by('core_loan_type.loan_type_id', 'DESC');
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['loan_type_id'];
		}
		
		public function getCoreLoanType_Detail($loan_type_id){
			$this->db->select('core_loan_type.loan_type_id, core_loan_type.loan_type_code, core_loan_type.loan_type_name, core_loan_type.last_update');
			$this->db->from('core_loan_type');
			$this->db->where('core_loan_type.loan_type_id',$loan_type_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreLoanType($data){
			$this->db->where('loan_type_id',$data['loan_type_id']);
			$query = $this->db->update('core_loan_type', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLoanType($loan_type_id){
			$this->db->where("loan_type_id", $loan_type_id);
			$query = $this->db->update('core_loan_type', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>