<?php
	class incentiverealizationdistribution_model extends CI_Model {
		var $table = "transaction_employee_absence";
		
		public function incentiverealizationdistribution_model(){
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

		public function getCoreJobTitle(){
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDepartment($division_id){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state', 0);
			$this->db->where('core_department.division_id', $division_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection($department_id){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state', 0);
			$this->db->where('core_section.department_id', $department_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getIncentiveOmzetTarget(){
			$this->db->select('incentive_omzet_target.omzet_target_id, incentive_omzet_target.omzet_target_period');
			$this->db->from('incentive_omzet_target');
			$this->db->where('incentive_omzet_target.data_state', 0);
			$this->db->order_by('incentive_omzet_target.omzet_target_period', 'DESC');
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($branch_id, $location_id, $division_id, $department_id, $section_id, $job_title_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state', 0);
			$this->db->where('hro_employee_data.branch_id_incentive', $branch_id);
			$this->db->where('hro_employee_data.location_id_incentive', $location_id);
			$this->db->where('hro_employee_data.division_id_incentive', $division_id);
			$this->db->where('hro_employee_data.department_id_incentive', $department_id);
			$this->db->where('hro_employee_data.section_id_incentive', $section_id);
			$this->db->where('hro_employee_data.job_title_id_incentive', $job_title_id);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getIncentiveRealizationDistribution($region_id, $branch_id, $location_id, $realization_distribution_period){
			$this->db->select('incentive_realization_distribution.realization_distribution_id, incentive_realization_distribution.region_id, core_region.region_name, incentive_realization_distribution.branch_id, core_branch.branch_name, incentive_realization_distribution.location_id, core_location.location_name,  incentive_realization_distribution.realization_distribution_period, incentive_realization_distribution.realization_distribution_branch_percentage, incentive_realization_distribution.realization_distribution_group_percentage, incentive_realization_distribution.realization_distribution_individual_percentage, incentive_realization_distribution.realization_distribution_branch_amount, incentive_realization_distribution.realization_distribution_group_amount, incentive_realization_distribution.realization_distribution_individual_amount');
			$this->db->from('incentive_realization_distribution');
			$this->db->join('core_region', 'incentive_realization_distribution.region_id = core_region.region_id');
			$this->db->join('core_branch', 'incentive_realization_distribution.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'incentive_realization_distribution.location_id = core_location.location_id');
			$this->db->where('incentive_realization_distribution.data_state', 0);
			$this->db->where('incentive_realization_distribution.region_id', $region_id);

			if($branch_id != '' ){
				$this->db->where('incentive_realization_distribution.branch_id', $branch_id);
			}

			if($location_id != '' ){
				$this->db->where('incentive_realization_distribution.location_id', $location_id);
			}
		
			if($realization_distribution_period != '' ){
				$this->db->where('incentive_realization_distribution.realization_distribution_period', $realization_distribution_period);
			}
			$this->db->order_by('incentive_realization_distribution.realization_distribution_id', 'DESC');
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

		public function getJobTitleName($job_title_id){
			$this->db->select('core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.job_title_id', $job_title_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['job_title_name'];
		}

		public function getOmzetIncentiveShareAmount($omzet_target_id, $branch_id, $location_id){
			$this->db->select('incentive_omzet_target_item.omzet_incentive_share_amount');
			$this->db->from('incentive_omzet_target_item');
			$this->db->where('incentive_omzet_target_item.omzet_target_id', $omzet_target_id);
			$this->db->where('incentive_omzet_target_item.branch_id', $branch_id);
			$this->db->where('incentive_omzet_target_item.location_id', $location_id);
			$result=$this->db->get()->row_array();
			return $result['omzet_incentive_share_amount'];
		}

		public function insertIncentiveRealizationDistribution($data){
			return $this->db->insert('incentive_realization_distribution',$data);
		}

		public function getRealizationDistributionID($created_id){
			$this->db->select('incentive_realization_distribution.realization_distribution_id');
			$this->db->from('incentive_realization_distribution');
			$this->db->where('incentive_realization_distribution.created_id', $created_id);
			$this->db->where('data_state', 0);
			$this->db->order_by('incentive_realization_distribution.realization_distribution_id', 'DESC');
			$this->db->limit(1);
			$result=$this->db->get()->row_array();
			return $result['realization_distribution_id'];
		}



		public function insertIncentiveTitleDistribution($data){
			return $this->db->insert('incentive_title_distribution',$data);
		}

		public function insertIncentiveEmployeeOmzet($data){
			return $this->db->insert('incentive_employee_omzet',$data);
		}

		public function getIncentiveRealizationDistribution_Detail($realization_distribution_id){
			$this->db->select('incentive_realization_distribution.omzet_target_id, incentive_realization_distribution.realization_distribution_id, incentive_realization_distribution.region_id, incentive_realization_distribution.branch_id, core_branch.branch_name, incentive_realization_distribution.location_id, core_location.location_name, incentive_realization_distribution.realization_distribution_period, incentive_realization_distribution.realization_distribution_branch_percentage, incentive_realization_distribution.realization_distribution_group_percentage, incentive_realization_distribution.realization_distribution_individual_percentage, incentive_realization_distribution.realization_distribution_branch_amount, incentive_realization_distribution.realization_distribution_group_amount, incentive_realization_distribution.realization_distribution_individual_amount');
			$this->db->from('incentive_realization_distribution');
			$this->db->join('core_branch', 'incentive_realization_distribution.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'incentive_realization_distribution.location_id = core_location.location_id');
			$this->db->where('incentive_realization_distribution.data_state',0);
			$this->db->where('incentive_realization_distribution.realization_distribution_id', $realization_distribution_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getIncentiveTitleDistribution_Detail($realization_distribution_id){
			$this->db->select('incentive_title_distribution.title_distribution_id, incentive_title_distribution.realization_distribution_id, incentive_title_distribution.branch_id, core_branch.branch_name, incentive_title_distribution.location_id, core_location.location_name, incentive_title_distribution.job_title_id, core_job_title.job_title_name, incentive_title_distribution.title_distribution_period, incentive_title_distribution.title_distribution_branch_percentage, incentive_title_distribution.title_distribution_group_percentage, incentive_title_distribution.title_distribution_individual_percentage, incentive_title_distribution.title_distribution_branch_amount, incentive_title_distribution.title_distribution_group_amount, incentive_title_distribution.title_distribution_individual_amount');
			$this->db->from('incentive_title_distribution');
			$this->db->join('core_branch', 'incentive_title_distribution.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'incentive_title_distribution.location_id = core_location.location_id');
			$this->db->join('core_job_title', 'incentive_title_distribution.job_title_id = core_job_title.job_title_id');
			$this->db->where('incentive_title_distribution.realization_distribution_id', $realization_distribution_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getIncentiveEmployeeOmzet_Detail($realization_distribution_id){
			$this->db->select('incentive_employee_omzet.employee_omzet_id, incentive_employee_omzet.realization_distribution_id, incentive_employee_omzet.branch_id, core_branch.branch_name, incentive_employee_omzet.location_id, core_location.location_name, incentive_employee_omzet.division_id, core_division.division_name, incentive_employee_omzet.department_id, core_department.department_name, incentive_employee_omzet.section_id, core_section.section_name,  incentive_employee_omzet.job_title_id, core_job_title.job_title_name, incentive_employee_omzet.employee_id, hro_employee_data.employee_name, incentive_employee_omzet.employee_omzet_period, incentive_employee_omzet.employee_omzet_target, incentive_employee_omzet.employee_omzet_achievement, incentive_employee_omzet.employee_omzet_branch_amount, incentive_employee_omzet.employee_omzet_group_amount, incentive_employee_omzet.employee_omzet_individual_amount, incentive_employee_omzet.employee_omzet_total_amount');
			$this->db->from('incentive_employee_omzet');
			$this->db->join('core_branch', 'incentive_employee_omzet.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'incentive_employee_omzet.location_id = core_location.location_id');
			$this->db->join('core_division', 'incentive_employee_omzet.division_id = core_division.division_id');
			$this->db->join('core_department', 'incentive_employee_omzet.department_id = core_department.department_id');
			$this->db->join('core_section', 'incentive_employee_omzet.section_id = core_section.section_id');
			$this->db->join('core_job_title', 'incentive_employee_omzet.job_title_id = core_job_title.job_title_id');
			$this->db->join('hro_employee_data', 'incentive_employee_omzet.employee_id = hro_employee_data.employee_id');
			$this->db->where('incentive_employee_omzet.realization_distribution_id', $realization_distribution_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
























		public function getIncentiveRealizationDistributionItem_Detail($omzet_target_id){
			$this->db->select('incentive_realization_distribution_item.omzet_target_item_id, incentive_realization_distribution_item.omzet_target_id, incentive_realization_distribution_item.branch_id, core_branch.branch_name, incentive_realization_distribution_item.location_id, core_location.location_name, incentive_realization_distribution_item.omzet_target_amount');
			$this->db->from('incentive_realization_distribution_item');
			$this->db->join('core_branch', 'incentive_realization_distribution_item.branch_id = core_branch.branch_id');
			$this->db->join('core_location', 'incentive_realization_distribution_item.location_id = core_location.location_id');
			$this->db->where('incentive_realization_distribution_item.omzet_target_id', $omzet_target_id);
			$result = $this->db->get()->result_array();
			return $result;
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
		
		public function saveNewIncentiveRealizationDistribution($data){
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

		

		public function getIncentiveRealizationDistribution_Data($employee_id){
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

		public function saveEditincentiverealizationdistribution($data){
			$this->db->where('employee_absence_id',$data['employee_absence_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteIncentiveRealizationDistribution($employee_id){
			$this->db->where("hro_employee_absence.employee_id", $employee_id);
			$query = $this->db->update('hro_employee_absence', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteIncentiveRealizationDistribution_Data($employee_absence_id){
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