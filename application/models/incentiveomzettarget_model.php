<?php
	class incentiveomzettarget_model extends CI_Model {
		var $table = "transaction_employee_absence";
		
		public function incentiveomzettarget_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreBranch(){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreLocation($branch_id){
			$this->db->select('core_location.location_id, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			$this->db->where('core_location.branch_id', $branch_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getIncentiveOmzetTarget($region_id, $omzet_target_period){
			$this->db->select('incentive_omzet_target.omzet_target_id, incentive_omzet_target.region_id, incentive_omzet_target.omzet_target_period');
			$this->db->from('incentive_omzet_target');
			$this->db->where('incentive_omzet_target.data_state',0);
			$this->db->where('incentive_omzet_target.region_id', $region_id);
		
			if($omzet_target_period != '' ){
				$this->db->where('incentive_omzet_target.omzet_target_period', $omzet_target_period);
			}
			$this->db->order_by('incentive_omzet_target.omzet_target_period', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getBranchName($branch_id){
			$this->db->select('core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_id', $branch_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['branch_name'];
		}

		public function getLocationName($location_id){
			$this->db->select('core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id', $location_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['location_name'];
		}

		public function insertIncentiveOmzetTarget($data){
			return $this->db->insert('incentive_omzet_target',$data);
		}

		public function getOmzetTargetID($created_id){
			$this->db->select('incentive_omzet_target.omzet_target_id');
			$this->db->from('incentive_omzet_target');
			$this->db->where('incentive_omzet_target.created_id', $created_id);
			$this->db->where('incentive_omzet_target.data_state',0);
			$this->db->order_by('incentive_omzet_target.created_id', 'DESC');
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['omzet_target_id'];
		}

		public function getIncentiveRealizationPercentage($realization_percentage){
			$this->db->select('incentive_realization_percentage.realization_percentage_omzet, incentive_realization_percentage.realization_percentage_share');
			$this->db->from('incentive_realization_percentage');
			$this->db->where('incentive_realization_percentage.realization_percentage_min <= ', $realization_percentage);
			$this->db->where('incentive_realization_percentage.realization_percentage_max >= ', $realization_percentage);
			$this->db->where('incentive_realization_percentage.data_state',0);
			$result=$this->db->get()->row_array();
			return $result;
		}


		public function insertIncentiveOmzetTargetItem($data){
			return $this->db->insert('incentive_omzet_target_item',$data);
		}

		public function getIncentiveOmzetTarget_Detail($omzet_target_id){
			$this->db->select('incentive_omzet_target.omzet_target_id, incentive_omzet_target.region_id, incentive_omzet_target.omzet_target_period');
			$this->db->from('incentive_omzet_target');
			$this->db->where('incentive_omzet_target.data_state',0);
			$this->db->where('incentive_omzet_target.omzet_target_id', $omzet_target_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getIncentiveOmzetTargetItem_Detail($omzet_target_id){
			$this->db->select('incentive_omzet_target_item.omzet_target_item_id, incentive_omzet_target_item.omzet_target_id, incentive_omzet_target_item.branch_id, core_branch.branch_name, incentive_omzet_target_item.location_id, core_location.location_name, incentive_omzet_target_item.omzet_target_amount, incentive_omzet_target_item.omzet_achievement_amount, incentive_omzet_target_item.omzet_achievement_percentage, incentive_omzet_target_item.omzet_incentive_percentage, incentive_omzet_target_item.omzet_incentive_amount, incentive_omzet_target_item.omzet_incentive_share_amount, incentive_omzet_target_item.omzet_incentive_pending_amount');
			$this->db->from('incentive_omzet_target_item');
			$this->db->join('core_branch', 'incentive_omzet_target_item.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'incentive_omzet_target_item.location_id = core_location.location_id');
			$this->db->where('incentive_omzet_target_item.omzet_target_id', $omzet_target_id);
			$result = $this->db->get()->result_array();
			return $result;
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

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);
			
			if($payroll_employee_level != 9 ){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}

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

		public function getCoreAbsence(){
			$this->db->select('core_absence.absence_id, core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getAbsenceName($absence_id){
			$this->db->select('core_absence.absence_name');
			$this->db->from('core_absence');
			$this->db->where('core_absence.absence_id', $absence_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['absence_name'];
		}
		
		public function saveNewIncentiveOmzetTarget($data){
			return $this->db->insert('hro_employee_absence',$data);
		}

		public function getEmployeeAbsenceID($created_id){
			$this->db->select('hro_employee_absence.employee_absence_id');
			$this->db->from('hro_employee_absence');
			$this->db->where('hro_employee_absence.created_id', $created_id);
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->order_by('hro_employee_absence.employee_absence_id', DESC);
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['employee_absence_id'];
		}

		public function getDayOffDate($dayoff_date){
			$this->db->select('schedule_day_off.day_off_id');
			$this->db->from('schedule_day_off');
			$this->db->where('schedule_day_off.day_off_start_date <=', $dayoff_date);
			$this->db->where('schedule_day_off.day_off_end_date >=', $dayoff_date);
			$this->db->where('schedule_day_off.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function saveNewIncentiveOmzetTarget_Detail($data){
			return $this->db->insert('hro_employee_absence_detail',$data);
		}

		public function getIncentiveOmzetTarget_Data($employee_id){
			$this->db->select('hro_employee_absence.employee_absence_id, hro_employee_absence.employee_id, hro_employee_absence.absence_id, hro_employee_absence.employee_absence_date, hro_employee_absence.employee_absence_start_date, hro_employee_absence.employee_absence_end_date, hro_employee_absence.employee_absence_duration, hro_employee_absence.employee_absence_description, hro_employee_absence.employee_absence_remark');
			$this->db->from('hro_employee_absence');
			$this->db->where('hro_employee_absence.data_state',0);
			$this->db->where('hro_employee_absence.employee_id', $employee_id);
			$this->db->order_by('hro_employee_absence.employee_absence_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('employee_absence_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEditincentiveomzettarget($data){
			$this->db->where('employee_absence_id',$data['employee_absence_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteIncentiveOmzetTarget($employee_id){
			$this->db->where("hro_employee_absence.employee_id", $employee_id);
			$query = $this->db->update('hro_employee_absence', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteIncentiveOmzetTarget_Data($employee_absence_id){
			$this->db->where("hro_employee_absence.employee_absence_id", $employee_absence_id);
			$query = $this->db->update('hro_employee_absence', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>