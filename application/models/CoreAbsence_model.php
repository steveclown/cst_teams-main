<?php
	class CoreAbsence_model extends CI_Model {
		var $table = "core_absence";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreAbsence()
		{
			$this->db->select('core_absence.absence_id, core_absence.absence_code, core_absence.absence_name, core_absence.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_absence');
			$this->db->join('core_deduction','core_absence.deduction_id = core_deduction.deduction_id');
			$this->db->where('core_absence.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDeduction()
		{
			$this->db->select('core_deduction.deduction_id, core_deduction.deduction_name');
			$this->db->from('core_deduction');
			$this->db->where('core_deduction.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getAbsenceToken($absence_token)
		{	
			$this->db->select('core_absence.absence_token');
			$this->db->from('core_absence');
			$this->db->where('core_absence.absence_token', $absence_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getAbsenceID($created_id){
			$this->db->select('core_absence.absence_id');
			$this->db->from('core_absence');
			$this->db->where('core_absence.created_id', $created_id);
			$this->db->order_by('core_absence.absence_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['absence_id'];
		}

		public function insertCoreAbsence($data){
			return $this->db->insert('core_absence',$data);
		}
		
		public function getCoreAbsence_Detail($AbsenceID){
			$this->db->select('core_absence.absence_id, core_absence.absence_code, core_absence.absence_name, core_absence.deduction_id');
			$this->db->from('core_absence');
			$this->db->where('core_absence.absence_id',$AbsenceID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreAbsence($data){
			$this->db->where('absence_id',$data['absence_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAbsence($data){
			$this->db->where("core_absence.absence_id", $data['absence_id']);
			$query = $this->db->update('core_absence', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>