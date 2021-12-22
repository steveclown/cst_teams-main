<?php
	class CoreSection_model extends CI_Model {
		var $table = "core_section";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_code, core_section.section_name, core_section.department_id');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getSectionToken($department_token)
		{	
			$this->db->select('core_department.department_token');
			$this->db->from('core_department');
			$this->db->where('core_department.department_token', $department_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getSectionID($created_id){
			$this->db->select('core_section.section_id');
			$this->db->from('core_section');
			$this->db->where('core_section.created_id', $created_id);
			$this->db->order_by('core_section.section_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['section_id'];
		}
		
		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDepartmentName($DepartmentID){
			$this->db->select('department_name');
			$this->db->from('core_department');
			$this->db->where('department_id',$DepartmentID);
			$this->db->where('data_state','0');
			$result=$this->db->get()->row_array();
			return $result['department_name'];
		}
		
		public function insertCoreSection($data){
			return $this->db->insert('core_section',$data);
		}
		
		public function getCoreSection_Detail($SectionID){
			$this->db->select('core_section.section_id, core_section.section_code, core_section.section_name, core_section.department_id, core_section.data_state, core_section.last_update');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id',$SectionID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreSection($data){
			$this->db->where('section_id',$data['section_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreSection($data){
			$this->db->where("core_section.section_id", $data['section_id']);
			$query = $this->db->update('core_section', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>