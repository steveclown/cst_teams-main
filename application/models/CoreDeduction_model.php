<?php
	class CoreDeduction_model extends CI_Model {
		var $table = "core_deduction";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDeduction(){
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_code, core_deduction.deduction_name, core_deduction.deduction_amount, core_deduction.deduction_type');
			$this->db->from('core_deduction');
			$this->db->where('data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;	
		}

		public function getCoreAllowance()
		{
			$this->db->select('core_allowance.allowance_id, core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getAllowanceName($allowance_id){
			$this->db->select('core_allowance.allowance_name');
			$this->db->from('core_allowance');
			$this->db->where('core_allowance.allowance_id', $allowance_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['allowance_name'];
		}
		
		public function insertCoreDeduction($data){
			$data_deduction = array(
				'deduction_code'					=> $data['deduction_code'],
				'deduction_name'					=> $data['deduction_name'],
				'deduction_type'					=> $data['deduction_type'],
				'deduction_amount'					=> $data['deduction_amount'],
				'deduction_premi_attendance_ratio'	=> $data['deduction_premi_attendance_ratio'],
				'deduction_basic_salary_ratio'		=> $data['deduction_basic_salary_ratio'],
				'deduction_late_start_duration'		=> $data['deduction_late_start_duration'],
				'deduction_late_end_duration'		=> $data['deduction_late_end_duration'],
				'deduction_remark'					=> $data['deduction_remark'],
				'data_state'						=> $data['data_state'],
			);

			return $this->db->insert('core_deduction',$data_deduction);
		}

		public function getDeductionID(){
			$this->db->select('core_deduction.deduction_id');
			$this->db->from('core_deduction');
			$this->db->order_by('core_deduction.deduction_id', 'DESC');
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['deduction_id'];
		}

		public function insertCoreDeductionAllowance($data){
			return $this->db->insert('core_deduction_allowance',$data);
		}
		
		public function getCoreDeduction_Detail($deduction_id){
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_code, core_deduction.deduction_name, core_deduction.deduction_amount, core_deduction.deduction_type, core_deduction.deduction_premi_attendance_ratio, core_deduction.deduction_basic_salary_ratio, core_deduction.deduction_late_start_duration, core_deduction.deduction_late_end_duration');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.deduction_id',$deduction_id);
			return $this->db->get()->row_array();
		}

		public function getCoreDeductionAllowance_Detail($deduction_id){
			$this->db->select('core_deduction_allowance.deduction_allowance_id, core_deduction_allowance.deduction_id, core_deduction_allowance.allowance_id, core_deduction_allowance.deduction_allowance_ratio');
			$this->db->from('core_deduction_allowance');
			$this->db->where('core_deduction_allowance.deduction_id',$deduction_id);
			return $this->db->get()->result_array();
		}
		
		public function updateCoreDeduction($data){
			$this->db->where('deduction_id',$data['deduction_id']);
			$query = $this->db->update('core_deduction', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreDeductionAllowance($deduction_id){
			$this->db->where("deduction_id", $deduction_id);
			$query = $this->db->delete("core_deduction_allowance");
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function saveUpdateCoreDeductionAllowance($data, $deduction_id){

			$item = array(
				'deduction_id'					=> $deduction_id,
				'allowance_id'					=> $data['allowance_id'],	
				'deduction_allowance_ratio'		=> $data['deduction_allowance_ratio'],
			);
			// print_r($item);exit;
			if($this->db->insert('core_deduction_allowance', $item)){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreDeduction($deduction_id){
			$this->db->where("core_deduction.deduction_id",$deduction_id);
			$query = $this->db->update('core_deduction', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

		public function getPayrollEmployeeAllowance($employee_id)
		{
			$this->db->select('payroll_employee_allowance.employee_allowance_id, core_allowance.allowance_name');
			$this->db->from('payroll_employee_allowance');
			$this->db->join('core_allowance', 'payroll_employee_allowance.allowance_id = core_allowance.allowance_id');
			$this->db->where('payroll_employee_allowance.data_state', 0);
			$this->db->where('payroll_employee_allowance.employee_id', $employee_id);
			return $this->db->get()->result_array();
		}

	}
?>