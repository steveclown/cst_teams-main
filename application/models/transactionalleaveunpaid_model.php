<?php
	class transactionalleaveunpaid_model extends CI_Model {
		var $table = "transaction_leave_unpaid";
		
		public function transactionalleaveunpaid(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_leave_unpaid";
			
			//Build contents query
			$this->db->select('leave_unpaid_id, employee_id, annual_leave_id, leave_unpaid_start_date, leave_unpaid_end_date, leave_unpaid_reason')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalleaveunpaid($data){
			return $this->db->insert('transaction_leave_unpaid',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('leave_unpaid_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalleaveunpaid($data){
			$this->db->where('leave_unpaid_id',$data['leave_unpaid_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getemployeename($id){
			$this->db->select('employee_name')->from('hro_employee_data');
			$this->db->where('employee_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
			}
		}

		public function getannualleavename($id){
			$this->db->select('annual_leave_name')->from('core_annual_leave');
			$this->db->where('annual_leave_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['annual_leave_name'])){
				return '-';
			}else{
				return $result['annual_leave_name'];
			}
		}
		
		
		
		function getemployee(){
			$this->db->where('data_state','0');
			$result = $this->db->get('hro_employee_data');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		function getannualleave(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_annual_leave');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		public function delete($id){
			$this->db->where("leave_unpaid_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
		}
		}
	}
?>