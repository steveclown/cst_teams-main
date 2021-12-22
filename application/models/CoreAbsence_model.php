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
		
		public function saveNewCoreAbsence($data){
			return $this->db->insert('core_absence',$data);
		}
		
		public function getCoreAbsence_Detail($AbsenceID){
			$this->db->select('core_absence.absence_id, core_absence.absence_code, core_absence.absence_name, core_absence.deduction_id');
			$this->db->from('core_absence');
			$this->db->where('core_absence.absence_id',$AbsenceID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreAbsence($data){
			$this->db->where('absence_id',$data['absence_id']);
			$query = $this->db->update('core_absence', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreAbsence($AbsenceID){
			$this->db->where("absence_id",$AbsenceID);
			$query = $this->db->update('core_absence', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>