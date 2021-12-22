<?php
	class transactionalovertimerequestbybranch_model extends CI_Model {
		var $table = "transaction_overtime_request";
		
		public function transactionalovertimerequestbybranch(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_overtime_request";
			
			//Build contents query
			$this->db->select('overtime_request_id, status, branch_id, employee_id, overtime_type_id, overtime_request_start_date, overtime_request_end_date, overtime_request_total, overtime_request_remark')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalovertimerequestbybranch($data){
			return $this->db->insert('transaction_overtime_request',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('overtime_request_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalovertimerequestbybranch($data){
			$this->db->where('overtime_request_id',$data['overtime_request_id']);
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

		public function getovertimetypename($id){
			$this->db->select('overtime_type_name')->from('core_overtime_type');
			$this->db->where('overtime_type_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['overtime_type_name'])){
				return '-';
			}else{
				return $result['overtime_type_name'];
			}
		}

		public function getbranchname($id){
			$this->db->select('branch_name')->from('core_branch');
			$this->db->where('branch_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['branch_name'])){
				return '-';
			}else{
				return $result['branch_name'];
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

		function getovertimetype(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_overtime_type');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		function getbranch(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_branch');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}

		public function delete($id){
			$this->db->where("overtime_request_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>