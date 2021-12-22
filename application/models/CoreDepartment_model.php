<?php
	class CoreDepartment_model extends CI_Model {
		var $table = "core_department";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_code, core_department.department_name, core_department.division_id');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getDepartmentToken($department_token)
		{	
			$this->db->select('core_department.department_token');
			$this->db->from('core_department');
			$this->db->where('core_department.department_token', $department_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getDepartmentID($created_id){
			$this->db->select('core_department.department_id');
			$this->db->from('core_department');
			$this->db->where('core_department.created_id', $created_id);
			$this->db->order_by('core_department.department_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['department_id'];
		}
		
		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDivisionName($DivisionID){
			$this->db->select('division_name');
			$this->db->from('core_division');
			$this->db->where('division_id',$DivisionID);
			$this->db->where('data_state','0');
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}
		
		public function insertCoreDepartment($data){
			return $this->db->insert('core_department',$data);
		}
		
		public function getCoreDepartment_Detail($DepartmentID){
			$this->db->select('core_department.department_id, core_department.department_code, core_department.department_name, core_department.division_id, core_department.data_state, core_department.last_update');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id',$DepartmentID);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreDepartment($data){
			$this->db->where('department_id',$data['department_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreDepartment($data){
			$this->db->where("core_department.department_id", $data['department_id']);
			$query = $this->db->update('core_department', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>