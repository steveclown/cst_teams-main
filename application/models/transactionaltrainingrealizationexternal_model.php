<?php
	class transactionaltrainingrealizationexternal_model extends CI_Model {
		var $table = "transaction_training_realization";
		
		public function transactionaltrainingrealizationexternal_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_training_realization";
			
			//Build contents query
			$this->db->select('realization_training_id, training_selection_id, realization_training_date, realization_training_remark, data_state, created_by, created_on')->from($table_name);
			$this->db->where('status', '1');
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function inserttrainingrealization($data){
			return $this->db->insert('transaction_training_realization',$data);
		}
		
		public function updatetrainingrealization($data){
			$this->db->where('realization_training_id',$data['realization_training_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getdetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('realization_training_id',$id);
			return $this->db->get()->row_array();
		}
		
		public function delete($id){
			$this->db->where("realization_training_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
		
		
		public function getselection(){
			/**$result = $this->db->query('SELECT a.training_selection_id, a.employee_id, b.employee_name FROM transaction_training_selection as a
										JOIN hro_employee_data as b ON a.employee_id=b.employee_id WHERE a.data_state="0"');
			//print($result->result_array());exit;
			return $result->result_array();*/
			
			$this->db->select('a.training_selection_id, a.employee_id, b.employee_name')->from('transaction_training_selection as a');
			$this->db->join('hro_employee_data as b', 'a.employee_id=b.employee_id');
			$this->db->where('a.data_state', '0');
			$this->db->group_by('a.employee_id');
			$result = $this->db->get()->result_array();
			//print($result);exit;
			return $result;
		}
		
		public function getemployeeid($id){
			$this->db->select('employee_id')->from('transaction_training_selection');
			$this->db->where('training_selection_id', $id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_id'])){
				return '-';
			}else{
				return $result['employee_id'];
			}
		}
		
		public function getemployeename($id){
			$this->db->select('employee_name')->from('hro_employee_data');
			$this->db->where('employee_id', $id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
			}
		}
	}
?>