<?php
	class transactionaltrainingselection_model extends CI_Model {
		var $table = "transaction_training_selection";
		
		public function transactionaltrainingselection_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_training_selection";
			
			//Build contents query
			$this->db->select('training_selection_id, training_schedule_id, employee_id, training_selection_period, training_selection_date, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function inserttrainingselection($data){
			return $this->db->insert('transaction_training_selection',$data);
		}
		
		public function updatetrainingselection($data){
			$this->db->where('training_selection_id',$data['training_selection_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getdetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('training_selection_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function delete($id){
			$this->db->where("training_selection_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
		
		function getschedule(){
			$this->db->where('data_state','0');
			$result = $this->db->get('transaction_training_schedule');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		/**function getemployee(){
			$this->db->where('data_state','0');
			$result = $this->db->get('hro_employee_data');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}*/
		
		
		function getemployee(){
			$result = $this->db->query('SELECT a.employee_id, b.training_job_title_id, c.employee_name FROM transaction_training_registration AS a 
								JOIN transaction_training_schedule AS b ON a.training_schedule_id=b.training_schedule_id 
								JOIN hro_employee_data AS c ON c.employee_id=a.employee_id 
								WHERE b.training_job_title_id=c.job_title_id');
			return $result->result_array();
		}
		
		public function getschedulename($id){
			$this->db->select('training_schedule_name')->from('transaction_training_schedule');
			$this->db->where('training_schedule_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['training_schedule_name'])){
				return '-';
			}else{
				return $result['training_schedule_name'];
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
	}
?>