<?php
	class hroemployeeprobationextending_model extends CI_Model {
		var $table = "transaction_probation_extending";
		
		public function hroemployeeprobationextending_model(){
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
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_employment_status, hro_employee_data.employee_employment_status_duedate');
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
			$this->db->where('hro_employee_data.employee_employment_status = 2');
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_ProbationExtending($region_id, $branch_id, $location_id, $employee_id, $division_id, $department_id, $section_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id, hro_employee_data.employee_employment_status');
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

			$this->db->where('hro_employee_data.employee_employment_status = 2');

			$result = $this->db->get();
			return $result->result_array();
		}

		public function getEmployeeName($id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
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

		public function getCoreProbation(){
			$this->db->select('core_probation.probation_id, core_probation.probation_name');
			$this->db->from('core_probation');
			$this->db->where('core_probation.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getProbationName($probation_id){
			$this->db->select('core_probation.probation_name');
			$this->db->from('core_probation');
			$this->db->where('core_probation.probation_id', $probation_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['probation_name'];
		}
		
		public function saveNewHROEmployeeProbationExtending($data){
			return $this->db->insert('hro_employee_probation_extending',$data);
		}
		
		public function updateNewHROEmployeeProbationExtending($data){
			$dataupdate	=	array( 
								'employee_employment_status_date' 		=> $data[probation_extending_date],
								'employee_employment_status_duedate' 	=> $data[probation_extending_next_date],
								);
			
			$this->db->where('employee_id',$data['employee_id']);
			$query = $this->db->update("hro_employee_data", $dataupdate);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getHROEmployeeProbationExtending_Data($employee_id){
			$this->db->select('hro_employee_probation_extending.probation_extending_id, hro_employee_probation_extending.employee_id, hro_employee_probation_extending.probation_id, hro_employee_probation_extending.probation_extending_description, hro_employee_probation_extending.probation_extending_date, hro_employee_probation_extending.probation_extending_last_date, hro_employee_probation_extending.probation_extending_next_date');
			$this->db->from('hro_employee_probation_extending');
			$this->db->where('hro_employee_probation_extending.data_state',0);
			$this->db->where('hro_employee_probation_extending.employee_id', $employee_id);
			$this->db->order_by('hro_employee_probation_extending.probation_extending_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('probation_extending_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEdithroemployeeprobationextending($data){
			$this->db->where('probation_extending_id',$data['probation_extending_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getProbationExtendingLastDate($probation_extending_id){
			$this->db->select('hro_employee_probation_extending.probation_extending_last_date');
			$this->db->from('hro_employee_probation_extending');
			$this->db->where('hro_employee_probation_extending.probation_extending_id', $probation_extending_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['probation_extending_last_date'];
		}

		public function updateHROEmployeeProbationExtendingDate($data){
			$this->db->where('employee_id', $data['employee_id']);
			$query = $this->db->update('hro_employee_data', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		} 

		public function deleteHROEmployeeProbationExtending_Data($probation_extending_id, $employee_id){
			$probation_extending_last_date = $this->getProbationExtendingLastDate($probation_extending_id);

			$data_array = array (
									'employee_id'							=> $employee_id,
									'employee_employment_status_duedate' 	=> $probation_extending_last_date,
								);


			if ($this->updateHROEmployeeProbationExtendingDate($data_array)){
				$this->db->where("probation_extending_id", $probation_extending_id);
				$query = $this->db->update('hro_employee_probation_extending', array("data_state"=> 1 ));
				if($query){
					return true;
				}else{
					return false;
				}
			}
		}
	}
?>