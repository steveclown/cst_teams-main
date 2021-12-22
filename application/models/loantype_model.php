<?php
	class loantype_model extends CI_Model {
		var $table = "core_loan_type";
		
		public function loantype_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_loan_type";
			
			//Build contents query
			$this->db->select('loan_type_id, loan_type_code, loan_type_name')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		
		public function saveNewLoantype($data){
			return $this->db->insert('core_loan_type',$data);
		}
		
		public function getDetail($id){
			$this->db->select('loan_type_id, loan_type_code, loan_type_name , data_state, last_update')->from($this->table);
			$this->db->where('loan_type_id',$id);
			return $this->db->get()->row_array();
		}
				
		public function saveEditLoantype($data){
			$this->db->where('loan_type_id',$data['loan_type_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("loan_type_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>