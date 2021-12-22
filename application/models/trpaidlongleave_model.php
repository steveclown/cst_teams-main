<?php
	class trpaidlongleave_model extends CI_Model {
		var $table = "transaction_paid_long_leave";
		
		public function trpaidlongleave(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_paid_long_leave";
			
			//Build contents query
			$this->db->select('paid_long_leave_id, employee_id, annual_leave_balance, paid_long_leave_total, paid_long_leave_date, paid_long_leave_remark')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtrpaidlongleave($data){
			return $this->db->insert('transaction_paid_long_leave',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('paid_long_leave_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittrpaidlongleave($data){
			$this->db->where('paid_long_leave_id',$data['paid_long_leave_id']);
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

		public function delete($id){
			$this->db->where("paid_long_leave_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
		}
		}
	}
?>