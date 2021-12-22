<?php
	class transactionalhospitaladjustment_model extends CI_Model {
		var $table = "transaction_hospital_adjustment";
		
		public function transactionalhospitaladjustment_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_hospital_adjustment";
			
			//Build contents query
			$this->db->select('hospital_adjustment_id, employee_id, employee_hospital_coverage_id, hospital_adjustment_date, hospital_adjustment_amount, hospital_adjustment_remark, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function get_listhospitalcoverage($employee_id){
			$this->db->select('employee_hospital_coverage_id, hospital_coverage_id, employee_id, hospital_coverage_period, hospital_coverage_amount, hospital_coverage_claimed, hospital_coverage_last_balance, hospital_coverage_remark, created_on')->from("hro_employee_hospital_coverage");
			$this->db->where('data_state', '0');
			$this->db->where('employee_id', $employee_id);
			return $this->db->get()->result_array();
		}
		
		public function updatedata($id,$amount){
			$this->db->select('hospital_coverage_amount,hospital_coverage_last_balance')->from("hro_employee_hospital_coverage");
			$this->db->where('employee_hospital_coverage_id',$id);
			$result_hospitalcoverage = $this->db->get()->row_array();
			
			$data2 = array(
						'hospital_coverage_amount' => $result_hospitalcoverage[hospital_coverage_amount]+$amount,
						'hospital_coverage_last_balance' => $result_hospitalcoverage[hospital_coverage_last_balance]+$amount,
			);
			$this->db->where('employee_hospital_coverage_id',$id);
			$query = $this->db->update("hro_employee_hospital_coverage", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function saveNewtransactionalhospitaladjustment($data){
			return $this->db->insert('transaction_hospital_adjustment',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('hospital_adjustment_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalhospitaladjustment($data){
			$this->db->where('hospital_adjustment_id',$data['hospital_adjustment_id']);
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
		
		public function gethospitalcoveragename($id){
			$this->db->select('hospital_coverage_name')->from('core_hospital_coverage');
			$this->db->where('hospital_coverage_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['hospital_coverage_name'])){
				return '-';
			}else{
				return $result['hospital_coverage_name'];
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
		
		// function gethospitalcoverage(){
			// $this->db->where('data_state','0');
			// $result = $this->db->get('core_hospital_coverage');
			// if ($result->num_rows() > 0 ){
				// return $result->result_array();	
			// }
			// else{
				// return array();	
			// }
		// }
		
		function gethospitalcoverage($id){
			$this->db->select('c.hospital_coverage_id, c.hospital_coverage_name, h.employee_hospital_coverage_id, h.hospital_coverage_amount, h.hospital_coverage_last_balance')->from('core_hospital_coverage as c');
			$this->db->join('hro_employee_hospital_coverage as h','h.hospital_coverage_id = c.hospital_coverage_id');
			$this->db->where('h.employee_hospital_coverage_id',$id);
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
			$this->db->where("hospital_adjustment_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>