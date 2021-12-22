<?php
	class CoreProbation_model extends CI_Model {
		var $table = "core_probation";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreProbation()
		{
			$this->db->select('core_probation.probation_id, core_probation.probation_code, core_probation.probation_name');
			$this->db->from('core_probation');
			$this->db->where('core_probation.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreProbation($data){
			return $this->db->insert('core_probation',$data);
		}
		
		public function getCoreProbation_Detail($ProbationID){
			$this->db->select('core_probation.probation_id, core_probation.probation_code, core_probation.probation_name, core_probation.probation_remark');
			$this->db->from('core_probation');
			$this->db->where('core_probation.probation_id',$ProbationID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreProbation($data){
			$this->db->where('core_probation.probation_id',$data['probation_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreProbation($ProbationID){
			$this->db->where("core_probation.probation_id",$ProbationID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>