<?php	
	class Main_model extends CI_Model {
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDivision()
		{
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreDepartment($division_id)
		{
			$this->db->select('core_department.division_id, core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.division_id', $division_id);
			$this->db->where('core_department.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreSection()
		{
			$this->db->select('core_section.department_id, core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			return $this->db->get()->result_array();
		}
	}

?>