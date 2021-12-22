<?php
	class hroemployeeasset_model extends CI_Model {
		var $table = "hro_employee_asset";
		
		public function hroemployeeasset_model(){
			parent::__construct();
			$this->CI = get_instance();
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

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
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

		public function getHROEmployeeData_Asset($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
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

		public function getCoreAsset(){
			$this->db->select('core_asset.asset_id, core_asset.asset_name');
			$this->db->from('core_asset');
			$this->db->where('core_asset.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getAssetName($asset_id){
			$this->db->select('core_asset.asset_name');
			$this->db->from('core_asset');
			$this->db->where('core_asset.asset_id',$asset_id);
			$result = $this->db->get()->row_array();
			return $result['asset_name'];
		}


		public function getCoreSubAsset(){
			$this->db->select('core_sub_asset.sub_asset_id, core_sub_asset.sub_asset_name');
			$this->db->from('core_sub_asset');
			$this->db->where('core_sub_asset.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getSubAssetName($sub_asset_id){
			$this->db->select('core_sub_asset.sub_asset_name');
			$this->db->from('core_sub_asset');
			$this->db->where('core_sub_asset.sub_asset_id',$sub_asset_id);
			$result = $this->db->get()->row_array();
			return $result['sub_asset_name'];
		}

		public function saveNewHROEmployeeAsset($data){
			return $this->db->insert('hro_employee_asset',$data);
		}

		public function getHROEmployeeAsset_Data($employee_id){
			$this->db->select('hro_employee_asset.employee_asset_id, hro_employee_asset.employee_id, hro_employee_asset.asset_id, hro_employee_asset.sub_asset_id, hro_employee_asset.employee_asset_receipt_date, hro_employee_asset.employee_asset_description, hro_employee_asset.employee_asset_returned_date, hro_employee_asset.employee_asset_status, hro_employee_asset.employee_asset_remark');
			$this->db->from('hro_employee_asset');
			$this->db->where('hro_employee_asset.data_state',0);
			$this->db->where('hro_employee_asset.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->result_array();
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
		
		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['employee_name'];
		}
		

		public function saveEdithroemployeeasset($data){
			$this->db->where('employee_asset_id',$data['employee_asset_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteHROEmployeeAsset($employee_id){
			$this->db->where("hro_employee_asset.employee_id",$employee_id);
			$query = $this->db->update('hro_employee_asset', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteHROEmployeeAsset_Data($employee_asset_id){
			$this->db->where("hro_employee_asset.employee_asset_id",$employee_asset_id);
			$query = $this->db->update('hro_employee_asset', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>