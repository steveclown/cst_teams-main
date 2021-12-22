<?php
	class hroemployeefamily_model extends CI_Model {
		var $table = "hro_employee_family";
		
		public function hroemployeefamily_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "hro_employee_family";
			
			//Build contents query
			$this->db->select('*')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getHROEmployeeData_Family($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($employee_id != ''){
				$this->db->where('hro_employee_data.employee_id', $employee_id);
			}

			if ($division_id != ''){
				$this->db->where('hro_employee_data.division_id', $division_id);
			}

			if ($department_id != ''){
				$this->db->where('hro_employee_data.department_id', $department_id);
			}

			if ($section_id != ''){
				$this->db->where('hro_employee_data.section_id', $section_id);
			}


			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getCoreFamilyRelation(){
			$this->db->select('core_family_relation.family_relation_id, core_family_relation.family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getFamilyRelationName($family_relation_id){
			$this->db->select('core_family_relation.family_relation_name');
			$this->db->from('core_family_relation');
			$this->db->where('core_family_relation.family_relation_id', $family_relation_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['family_relation_name'];
		}
		
		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getCoreMaritalStatus(){
			$this->db->select('core_marital_status.marital_status_id, core_marital_status.marital_status_name');
			$this->db->from('core_marital_status');
			$this->db->where('data_state','0');
			$result = $this->db->get();
			return $result->result_array();
		}

		public function saveNewHROEmployeeFamily($data){
			$data_family = array(
				'family_relation_id' 					=> $data['family_relation_id'],
				'employee_id' 							=> $data['employee_id'],
				'marital_status_id' 					=> $data['marital_status_id'],
				'employee_family_name' 					=> $data['employee_family_name'],
				'employee_family_address' 				=> $data['employee_family_address'],
				'employee_family_city' 					=> $data['employee_family_city'],
				'employee_family_postal_code' 			=> $data['employee_family_postal_code'],
				'employee_family_rt' 					=> $data['employee_family_rt'],
				'employee_family_rw' 					=> $data['employee_family_rw'],
				'employee_family_kecamatan' 			=> $data['employee_family_kecamatan'],
				'employee_family_kelurahan' 			=> $data['employee_family_kelurahan'],
				'employee_family_home_phone' 			=> $data['employee_family_home_phone'],
				'employee_family_mobile_phone' 			=> $data['employee_family_mobile_phone'],
				'employee_family_gender' 				=> $data['employee_family_gender'],
				'employee_family_date_of_birth' 		=> tgltodb($data['employee_family_date_of_birth']),
				'employee_family_place_of_birth' 		=> $data['employee_family_place_of_birth'],
				'employee_family_education' 			=> $data['employee_family_education'],
				'employee_family_occupation' 			=> $data['employee_family_occupation'],
				'employee_family_has_coverage_claim'	=> $data['employee_family_has_coverage_claim'],
				'employee_family_coverage_ratio' 		=> $data['employee_family_coverage_ratio'],
				'employee_family_remark' 				=> $data['employee_family_remark'],
				'data_state'							=> $data['data_state'],
				'created_id'							=> $data['created_id'],
				'created_on'							=> $data['created_on']
			);


			return $this->db->insert('hro_employee_family',$data_family);
		}
		
		public function getHROEmployeeFamily_Detail($employee_family_id){
			$this->db->select('hro_employee_family.employee_family_id, hro_employee_family.employee_id, hro_employee_family.family_relation_id, hro_employee_family.marital_status_id, hro_employee_family.employee_family_name, hro_employee_family.employee_family_address, hro_employee_family.employee_family_rt, hro_employee_family.employee_family_rw, hro_employee_family.employee_family_city, hro_employee_family.employee_family_postal_code, hro_employee_family.employee_family_kelurahan, hro_employee_family.employee_family_kecamatan, hro_employee_family.employee_family_home_phone, hro_employee_family.employee_family_mobile_phone, hro_employee_family.employee_family_date_of_birth, hro_employee_family.employee_family_place_of_birth, hro_employee_family.employee_family_education, hro_employee_family.employee_family_occupation, hro_employee_family.employee_family_has_coverage_claim, hro_employee_family.employee_family_coverage_ratio, hro_employee_family.employee_family_remark');
			$this->db->from('hro_employee_family');
			$this->db->where('hro_employee_family.employee_family_id',$employee_family_id);
			return $this->db->get()->row_array();
		}
		
		
		public function saveEditHROEmployeeFamily($data){
			$this->db->where('hro_employee_family.employee_family_id',$data['employee_family_id']);
			$query = $this->db->update('hro_employee_family', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteHROEmployeeFamily($employee_family_id){
			$this->db->where("hro_employee_family.employee_family_id",$employee_family_id);
			$query = $this->db->update('hro_employee_family', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}


		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['section_name'];
		}

		public function get_unique(){
			return gethostbyname($_SERVER['HTTP_HOST']);
		}

	}
?>