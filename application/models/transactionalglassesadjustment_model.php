<?php
	class transactionalglassesadjustment_model extends CI_Model {
		var $table = "transaction_glasses_adjustment";
		
		public function transactionalglassesadjustment_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "transaction_glasses_adjustment";
			
			//Build contents query
			$this->db->select('glasses_adjustment_id, employee_id, employee_glasses_coverage_id, glasses_adjustment_date, glasses_adjustment_amount, glasses_adjustment_remark, data_state, created_by, created_on')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		public function get_listglassescoverage($employee_id){
			$this->db->select('employee_glasses_coverage_id, glasses_coverage_id, employee_id, glasses_coverage_period, glasses_coverage_amount, glasses_coverage_claimed, glasses_coverage_last_balance, glasses_coverage_remark, created_on')->from("hro_employee_glasses_coverage");
			$this->db->where('data_state', '0');
			$this->db->where('employee_id', $employee_id);
			return $this->db->get()->result_array();
		}
		
		public function updatedata($id,$amount){
			$this->db->select('glasses_coverage_amount,glasses_coverage_last_balance')->from("hro_employee_glasses_coverage");
			$this->db->where('employee_glasses_coverage_id',$id);
			$result_glassescoverage = $this->db->get()->row_array();
			
			$data2 = array(
						'glasses_coverage_amount' => $result_glassescoverage[glasses_coverage_amount]+$amount,
						'glasses_coverage_last_balance' => $result_glassescoverage[glasses_coverage_last_balance]+$amount,
			);
			$this->db->where('employee_glasses_coverage_id',$id);
			$query = $this->db->update("hro_employee_glasses_coverage", $data2);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function saveNewtransactionalglassesadjustment($data){
			return $this->db->insert('transaction_glasses_adjustment',$data);
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('glasses_adjustment_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdittransactionalglassesadjustment($data){
			$this->db->where('glasses_adjustment_id',$data['glasses_adjustment_id']);
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
		
		public function getglassescoveragename($id){
			$this->db->select('glasses_coverage_name')->from('core_glasses_coverage');
			$this->db->where('glasses_coverage_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['glasses_coverage_name'])){
				return '-';
			}else{
				return $result['glasses_coverage_name'];
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
		
		// function getglassescoverage(){
			// $this->db->where('data_state','0');
			// $result = $this->db->get('core_glasses_coverage');
			// if ($result->num_rows() > 0 ){
				// return $result->result_array();	
			// }
			// else{
				// return array();	
			// }
		// }
		
		function getglassescoverage($id){
			$this->db->select('c.glasses_coverage_id, c.glasses_coverage_name, h.employee_glasses_coverage_id, h.glasses_coverage_amount, h.glasses_coverage_last_balance')->from('core_glasses_coverage as c');
			$this->db->join('hro_employee_glasses_coverage as h','h.glasses_coverage_id = c.glasses_coverage_id');
			$this->db->where('h.employee_glasses_coverage_id',$id);
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
			$this->db->where("glasses_adjustment_id",$id);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>