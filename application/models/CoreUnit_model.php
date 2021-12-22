<?php
	class CoreUnit_model extends CI_Model {
		var $table = "core_unit";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreUnit()
		{
			$this->db->select('core_unit.unit_id, core_unit.unit_code, core_unit.unit_name, core_unit.section_id, core_section.section_name');
			$this->db->from('core_unit');
			$this->db->join('core_section', 'core_unit.section_id = core_section.section_id');
			$this->db->where('core_unit.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state',0);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function insertCoreUnit($data){
			return $this->db->insert('core_unit',$data);
		}
		
		public function getCoreUnit_Detail($unit_id){
			$this->db->select('core_unit.unit_id, core_unit.unit_code, core_unit.unit_name, core_unit.section_id, core_section.section_name');
			$this->db->from('core_unit');
			$this->db->join('core_section', 'core_unit.section_id = core_section.section_id');
			$this->db->where('core_unit.unit_id',$unit_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreUnit($data){
			$this->db->where('unit_id',$data['unit_id']);
			$query = $this->db->update('core_unit', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreUnit($unit_id){
			$this->db->where("core_unit.unit_id", $unit_id);
			$query = $this->db->update('core_unit', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>