<?php
	class transactionalleaveemergelong_model extends CI_Model {
		var $table = "transaction_leave_emerge_long";
		
		public function transactionalleaveemergelong(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_leave_emerge_long";
			
			//Build contents query
			$this->db->select('leave_emerge_long_id, employee_id, leave_emerge_long_date, leave_emerge_long_start_date, leave_emerge_long_end_date, leave_emerge_long_remark, leave_emerge_long_status')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalleaveemergelong($data){
			return $this->db->insert('transaction_leave_emerge_long',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('leave_emerge_long_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalleaveemergelong($data){
			$this->db->where('leave_emerge_long_id',$data['leave_emerge_long_id']);
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
			$this->db->where("leave_emerge_long_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
		}
		}
	}
?>