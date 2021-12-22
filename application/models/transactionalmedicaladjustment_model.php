<?php
	class transactionalmedicaladjustment_model extends CI_Model {
		var $table = "transaction_medical_adjustment";
		
		public function transactionalmedicaladjustment_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_medical_adjustment";
			
			//Build contents query
			$this->db->select('medical_adjustment_id, employee_id, employee_medical_coverage_id, medical_adjustment_date, medical_adjustment_amount, medical_adjustment_remark, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function get_listmedicalcoverage($employee_id){
			$this->db->select('employee_medical_coverage_id, medical_coverage_id, employee_id, medical_coverage_period, medical_coverage_amount, medical_coverage_claimed, medical_coverage_last_balance, medical_coverage_remark, created_on')->from("hro_employee_medical_coverage");
			$this->db->where('data_state', '0');
			$this->db->where('employee_id', $employee_id);
			return $this->db->get()->result_array();
		}
		
		public function updatedata($id,$amount){
			$this->db->select('medical_coverage_amount,medical_coverage_last_balance')->from("hro_employee_medical_coverage");
			$this->db->where('employee_medical_coverage_id',$id);
			$result_medicalcoverage = $this->db->get()->row_array();
			
			$data2 = array(
						'medical_coverage_amount' => $result_medicalcoverage[medical_coverage_amount]+$amount,
						'medical_coverage_last_balance' => $result_medicalcoverage[medical_coverage_last_balance]+$amount,
			);
			$this->db->where('employee_medical_coverage_id',$id);
			$query = $this->db->update("hro_employee_medical_coverage", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function saveNewtransactionalmedicaladjustment($data){
			return $this->db->insert('transaction_medical_adjustment',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('medical_adjustment_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalmedicaladjustment($data){
			$this->db->where('medical_adjustment_id',$data['medical_adjustment_id']);
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
		
		public function getmedicalcoveragename($id){
			$this->db->select('medical_coverage_name')->from('core_medical_coverage');
			$this->db->where('medical_coverage_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['medical_coverage_name'])){
				return '-';
			}else{
				return $result['medical_coverage_name'];
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
		
		// function getmedicalcoverage(){
			// $this->db->where('data_state','0');
			// $result = $this->db->get('core_medical_coverage');
			// if ($result->num_rows() > 0 ){
				// return $result->result_array();	
			// }
			// else{
				// return array();	
			// }
		// }
		
		function getmedicalcoverage($id){
			$this->db->select('c.medical_coverage_id, c.medical_coverage_name, h.employee_medical_coverage_id, h.medical_coverage_amount, h.medical_coverage_last_balance')->from('core_medical_coverage as c');
			$this->db->join('hro_employee_medical_coverage as h','h.medical_coverage_id = c.medical_coverage_id');
			$this->db->where('h.employee_medical_coverage_id',$id);
			$result=$this->db->get();
			// print_r($result->row_array());exit;
			if ($result->num_rows() > 0 ){
				return $result->row_array();	
			}
			else{
				return array();	
			}
		}
		
		public function delete($id){
			$this->db->where("medical_adjustment_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>