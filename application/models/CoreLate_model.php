<?php
	class CoreLate_model extends CI_Model {
		var $table = "core_late";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getCoreDeduction()
		{
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getCoreLate()
		{
			$this->db->select('core_late.late_id, core_late.late_code, core_late.late_name, core_late.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_late');
			$this->db->join('core_deduction', 'core_late.deduction_id = core_deduction.deduction_id');
			$this->db->where('core_late.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function getLateToken($late_token)
		{	
			$this->db->select('core_late.late_token');
			$this->db->from('core_late');
			$this->db->where('core_late.late_token', $late_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getLateID($created_id){
			$this->db->select('core_late.late_id');
			$this->db->from('core_late');
			$this->db->where('core_late.created_id', $created_id);
			$this->db->order_by('core_late.late_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['late_id'];
		}

		public function insertCoreLate($data){
			return $this->db->insert('core_late',$data);
		}
		
		public function getCoreLate_Detail($late_id){
			$this->db->select('core_late.late_id, core_late.late_code, core_late.late_name, core_late.deduction_id');
			$this->db->from('core_late');
			$this->db->where('core_late.late_id',$late_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreLate($data){
			$this->db->where('late_id',$data['late_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreLate($data){
			$this->db->where("core_late.late_id", $data['late_id']);
			$query = $this->db->update('core_late', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>