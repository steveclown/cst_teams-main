<?php
	class transactionalscheduleshift_model extends CI_Model {
		var $table = "transaction_schedule_shift";
		
		public function transactionalscheduleshift_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_schedule_shift";
			
			//Build contents query
			$this->db->select('schedule_shift_id, status, employee_id, shift_id, schedule_shift_start_date, schedule_shift_end_date, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionalscheduleshift($data){
			$kuery = $this->db->insert('transaction_schedule_shift',$data);
			if($kuery){
				if($this->transaksi($data)==true){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
			
		}
		
		public function transaksi($data){
			$schedule_shift_id = $this->db->select('schedule_shift_id')->from("transaction_schedule_shift")->where('created_on',$data[created_on])->where('created_by',$data[created_by])->get()->row_array();
			
			$dataupdate=array( 'schedule_shift_id' =>$schedule_shift_id[schedule_shift_id] );
			
			$this->db->where('employee_id',$data['employee_id']);
			$query = $this->db->update("hro_employee_data", $dataupdate);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('schedule_shift_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalscheduleshift($data){
			$this->db->where('schedule_shift_id',$data['schedule_shift_id']);
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
		
		public function getshiftname($id){
			$this->db->select('shift_name')->from('core_shift');
			$this->db->where('shift_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['shift_name'])){
				return '-';
			}else{
				return $result['shift_name'];
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
		
		function getshift(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_shift');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function delete($id){
			$this->db->where("schedule_shift_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>