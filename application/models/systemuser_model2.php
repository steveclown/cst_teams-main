<?php
	class systemuser_model extends CI_Model {
		var $table = "system_user";
		
		public function systemuser_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getHROEmployeeData_Detail($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.employee_name, hro_employee_data.employee_mobile_phone, hro_employee_data.employee_photo, hro_employee_data.region_id, core_region.region_code, hro_employee_data.branch_id, core_branch.branch_code, hro_employee_data.location_id, core_location.location_code');
			$this->db->from('hro_employee_data');
			$this->db->join('core_region', 'hro_employee_data.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getSystemUser_Detail($user_id){
			$this->db->select('system_user.user_id, system_user.username');
			$this->db->from('system_user');
			$this->db->where('system_user.user_id', $user_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getUsername($data){
			$this->db->select('system_user.username');
			$this->db->from('system_user');
			$this->db->where('username', $data['username']);
			$result = $this->db->get()->row_array();
			if(count($result)>0){
				return false;
			}else{
				return true;
			}
		}

		public function editSystemUser($data){
			$this->db->where("user_id", $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function editHROEmployeeData($data){
			$this->db->where("employee_id", $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getCheckUsername($data){
			$this->db->select('system_user.username');
			$this->db->from('system_user');
			$this->db->where('system_user.user_id', $data['user_id']);
			$this->db->where('system_user.password', md5($data['current_password']));
			$result = $this->db->get()->row_array();
			if(count($result)>0){
				return true;
			}else{
				return false;
			}
		}

		public function changeUserPassword($data){
			$data_password = array (
					'user_id'		=> $data['user_id'],
					'password'		=> $data['new_password'],
				);


			$this->db->where("user_id", $data_password['user_id']);
			$query = $this->db->update('system_user', $data_password);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getEmployeeLocation($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_code, hro_employee_data.region_id, core_region.region_code, hro_employee_data.branch_id, core_branch.branch_code, hro_employee_data.location_id, core_location.location_code');
			$this->db->from('hro_employee_data');
			$this->db->join('core_region', 'hro_employee_data.region_id = core_region.region_id');
			$this->db->join('core_branch', 'hro_employee_data.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'hro_employee_data.location_id = core_location.location_id');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function changeEmployeePhoto($data){
			$this->db->where("employee_id", $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		/*public function editHROEmployeeData($data,$id){
			if($data[username]=="administrator" || $data[username]=="Administrator"){
				$data[user_group_id]=="1";
			}
			$this->db->where("username",$id);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}*/

		public function getSystemUser($region_id, $branch_id, $location_id, $user_group_id)
		{
			$this->db->select('system_user.user_id, system_user.user_group_id, system_user.employee_id, system_user.username, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('system_user');
			$this->db->join('hro_employee_data', 'system_user.employee_id = hro_employee_data.employee_id');
			$this->db->where('system_user.data_state', 0);
			$this->db->where('system_user.region_id', $region_id);
			$this->db->where('system_user.branch_id', $branch_id);
			$this->db->where('system_user.location_id', $location_id);

			if ($user_group_id <> 1){
				$this->db->where('system_user.user_group_id !=', 1);
			}
			return $this->db->get()->result_array();
		}
		
		public function getSystemGroupName($user_group_id){
			$this->db->select('system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.user_group_id', $user_group_id);
			$result = $this->db->get()->row_array();
			return $result['user_group_name'];
		}

		public function getEmployeeName($employee_id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get()->row_array();
			return $result['employee_name'];
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$result = $this->db->get()->row_array();
			return $result['division_name'];
		}

		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$result = $this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$result = $this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getSystemUserGroup(){
			$this->db->select('system_user_group.user_group_id, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.user_group_level !=','1');
			$this->db->where('system_user_group.user_group_level !=','2');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreRegion(){
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreBranch($region_id){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state', 0);
			$this->db->where('core_branch.region_id', $region_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreLocation($branch_id){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			$this->db->where('core_location.branch_id', $branch_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$this->db->where('core_department.division_id', $division_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			$this->db->where('core_section.department_id', $department_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHROEmployeeData($region_id, $branch_id, $section_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$this->db->where('hro_employee_data.division_id', $division_id);
			$this->db->where('hro_employee_data.department_id', $department_id);
			$this->db->where('hro_employee_data.section_id', $section_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function saveSystemUser($data){
			return $this->db->insert('system_user',$data);
		}
		
		public function getSystemUser_DetailEdit($user_id){
			$this->db->select('system_user.user_id, system_user.employee_id, system_user.region_id, system_user.branch_id, system_user.location_id, system_user.division_id, system_user.department_id, system_user.section_id, system_user.username, system_user.password, system_user.user_group_id, system_user.employee_employment_working_status, system_user.user_status');
			$this->db->from('system_user');
			$this->db->where('system_user.user_id', $user_id);
			return $this->db->get()->row_array();
		}

		public function getRegionName($region_id){
			$this->db->select('core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.region_id', $region_id);
			$result = $this->db->get()->row_array();
			return $result['region_name'];
		}

		public function getBranchName($branch_id){
			$this->db->select('core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_id', $branch_id);
			$result = $this->db->get()->row_array();
			return $result['branch_name'];
		}

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$result = $this->db->get()->row_array();
			return $result['location_name'];
		}

		public function saveEditSystemUser($data){
			$this->db->where("user_id", $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getUserGroupName($user_group_id){
			$this->db->select('system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.user_group_id', $user_group_id);
			$result = $this->db->get()->row_array();
			return $result['user_group_name'];
		}

		public function saveEditResetPasswordSystemUser($data){
			$this->db->where('user_id', $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function saveNewResetPasswordSystemUser($data){
			return $this->db->insert('system_user_reset_password',$data);
		}



		
		function cekuserNameExist($username){
			$this->db->select('username, password, user_group_id, log_stat')->from($this->table);
			$this->db->where('username',$username);
			$hasil = $this->db->get()->row_array();
			if(count($hasil)>0){
				return false;
			}else{
				return true;
			}
		}
		
		
		
		public function delete($id){
			// $this->db->where("username",$id);
			// $query = $this->db->update($this->table, array('data_state'=>'1', 'log_stat'=>'off'));
			// if($query){
				// return true;
			// }else{
				// return false;
			// }
			return $this->db->delete('system_user',array('username'=>$id));
		}
	}
?>