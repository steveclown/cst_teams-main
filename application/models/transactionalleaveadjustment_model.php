<?php
	class transactionalleaveadjustment_model extends CI_Model {
		var $table = "transaction_leave_adjustment";
		
		public function transactionalleaveadjustment(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_leave_adjustment";
			
			//Build contents query
			$this->db->select('leave_adjustment_id, employee_id, leave_adjustment_date, leave_adjustment_annual_days, leave_adjustment_extra_days, leave_adjustment_remark')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalleaveadjustment($data){
			return $this->db->insert('transaction_leave_adjustment',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('leave_adjustment_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalleaveadjustment($data){
			$this->db->where('leave_adjustment_id',$data['leave_adjustment_id']);
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
			$this->db->where("leave_adjustment_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
		}
		}
	}
?>