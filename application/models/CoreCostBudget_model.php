<?php
	class CoreCostBudget_model extends CI_Model {
		var $table = "core_allowance";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreCostBudget()
		{
			$this->db->select('core_cost_budget.cost_budget_id, core_cost_budget.cost_budget_code, core_cost_budget.cost_budget_name, core_cost_budget.cost_budget_amount');
			$this->db->from('core_cost_budget');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreCostBudget($data){
			return $this->db->insert('core_cost_budget',$data);
		}
		
		public function getCoreCostBudget_Detail($cost_budget_id){
			$this->db->select('core_cost_budget.cost_budget_id, core_cost_budget.cost_budget_code, core_cost_budget.cost_budget_name, core_cost_budget.cost_budget_amount');
			$this->db->from('core_cost_budget');
			$this->db->where('core_cost_budget.cost_budget_id',$cost_budget_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreCostBudget($data){
			$this->db->where('cost_budget_id',$data['cost_budget_id']);
			$query = $this->db->update('core_cost_budget', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreCostBudget($cost_budget_id){
			$this->db->where("core_cost_budget.cost_budget_id",$cost_budget_id);
			$query = $this->db->update('core_cost_budget', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>