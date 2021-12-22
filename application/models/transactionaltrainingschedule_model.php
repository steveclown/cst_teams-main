<?php
	class transactionaltrainingschedule_model extends CI_Model {
		var $table = "transaction_training_schedule";
		
		public function transactionaltrainingschedule_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_training_schedule";
			
			//Build contents query
			$this->db->select('training_schedule_id, training_job_title_id, training_title_id, training_provider_id, training_provider_item_id, training_schedule_start_date, training_schedule_end_date, training_schedule_name, training_schedule_capacity, training_schedule_duration, training_schedule_location, training_schedule_remark, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function saveNewtransactionaltrainingschedule($data){
			return $this->db->insert('transaction_training_schedule',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('training_schedule_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionaltrainingschedule($data){
			//print_r($data['training_schedule_id']);exit;
			$this->db->where('training_schedule_id',$data['training_schedule_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function gettrainingjobtitlename($id){
			$this->db->select('training_job_title_code')->from('core_training_job_title');
			$this->db->where('training_job_title_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['training_job_title_code'])){
				return '-';
			}else{
				return $result['training_job_title_code'];
			}
		}
		
		function gettrainingjobtitle(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_training_job_title');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		function gettrainingtitle(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_training_title');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		function gettrainingprovider(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_training_provider');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		function gettrainingprovideritem(){
			$this->db->where('data_state','0');
			$result = $this->db->get('core_training_provider_item');
			if ($result->num_rows() > 0 ){
				return $result->result_array();	
			}
			else{
				return array();	
			}
		}
		
		public function getjobtitlename($id){
			$this->db->select('training_job_title_name')->from('core_training_job_title');
			$this->db->where('training_job_title_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['training_job_title_name'])){
				return '-';
			}else{
				return $result['training_job_title_name'];
			}
		}
		
		public function gettitlename($id){
			$this->db->select('training_title_name')->from('core_training_title');
			$this->db->where('training_title_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['training_title_name'])){
				return '-';
			}else{
				return $result['training_title_name'];
			}
		}
		
		public function getprovidername($id){
			$this->db->select('training_provider_name')->from('core_training_provider');
			$this->db->where('training_provider_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['training_provider_name'])){
				return '-';
			}else{
				return $result['training_provider_name'];
			}
		}
		
		public function getprovideritemname($id){
			$this->db->select('training_provider_item_name')->from('core_training_provider_item');
			$this->db->where('training_provider_item_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['training_provider_name'])){
				return '-';
			}else{
				return $result['training_provider_name'];
			}
		}
		
		public function delete($id){
			$this->db->where("training_schedule_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>