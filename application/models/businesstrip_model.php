<?php
	class businesstrip_model extends CI_Model {
		var $table = "core_expense_business_trip";
		
		public function businesstrip_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list(){
			//Select table name
			$table_name = "core_expense_business_trip";
			
			$this->db->select('expense_business_trip_id, expense_business_trip_name')->from($table_name);
			$this->db->where('data_state', '0');
			
			return $this->db->get()->result_array();
		}
		
		public function insertbusinesstrip($data){
			return $this->db->insert('core_expense_business_trip',$data);
		}
		
		public function getdetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('expense_business_trip_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function updatebusinesstrip($data){
			$this->db->where('expense_business_trip_id',$data['expense_business_trip_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
			$this->db->where("expense_business_trip_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>