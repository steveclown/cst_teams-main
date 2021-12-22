<?php
	class CoreCommissionMmc_model extends CI_Model {
		var $table = "core_commission_mmc";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreCommissionMmc()
		{
			$this->db->select('core_commission_mmc.commission_mmc_id, core_commission_mmc.job_title_id, core_job_title.job_title_name, core_commission_mmc.commission_mmc_start_omzet, core_commission_mmc.commission_mmc_end_omzet, core_commission_mmc.commission_mmc_unit');
			$this->db->from('core_commission_mmc');
			$this->db->join('core_job_title', 'core_commission_mmc.job_title_id = core_job_title.job_title_id');
			$this->db->where('core_commission_mmc.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreJobTitle()
		{
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function insertCoreCommissionMmc($data){
			return $this->db->insert('core_commission_mmc',$data);
		}
		
		public function getCoreCommissionMmc_Detail($commission_mmc_id){
			$this->db->select('core_commission_mmc.commission_mmc_id, core_commission_mmc.job_title_id, core_job_title.job_title_name, core_commission_mmc.commission_mmc_start_omzet, core_commission_mmc.commission_mmc_end_omzet, core_commission_mmc.commission_mmc_unit');
			$this->db->from('core_commission_mmc');
			$this->db->join('core_job_title', 'core_commission_mmc.job_title_id = core_job_title.job_title_id');
			$this->db->where('core_commission_mmc.commission_mmc_id', $commission_mmc_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreCommissionMmc($data){
			$this->db->where('core_commission_mmc.commission_mmc_id', $data['commission_mmc_id']);
			$query = $this->db->update('core_commission_mmc', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreCommissionMmc($commission_mmc_id){
			$this->db->where("core_commission_mmc.commission_mmc_id", $commission_mmc_id);
			$query = $this->db->update('core_commission_mmc', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>