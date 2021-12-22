<?php
	class CoreCommissionAcc_model extends CI_Model {
		var $table = "core_commission_acc";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreCommissionAcc()
		{
			$this->db->select('core_commission_acc.commission_acc_id, core_commission_acc.job_title_id, core_job_title.job_title_name, core_commission_acc.commission_acc_start_omzet, core_commission_acc.commission_acc_end_omzet, core_commission_acc.commission_acc_percentage');
			$this->db->from('core_commission_acc');
			$this->db->join('core_job_title', 'core_commission_acc.job_title_id = core_job_title.job_title_id');
			$this->db->where('core_commission_acc.data_state', 0);
			return $this->db->get()->result_array();
		}

		public function getCoreJobTitle()
		{
			$this->db->select('core_job_title.job_title_id, core_job_title.job_title_name');
			$this->db->from('core_job_title');
			$this->db->where('core_job_title.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function insertCoreCommissionAcc($data){
			return $this->db->insert('core_commission_acc',$data);
		}
		
		public function getCoreCommissionAcc_Detail($commission_acc_id){
			$this->db->select('core_commission_acc.commission_acc_id, core_commission_acc.job_title_id, core_job_title.job_title_name, core_commission_acc.commission_acc_start_omzet, core_commission_acc.commission_acc_end_omzet, core_commission_acc.commission_acc_percentage');
			$this->db->from('core_commission_acc');
			$this->db->join('core_job_title', 'core_commission_acc.job_title_id = core_job_title.job_title_id');
			$this->db->where('core_commission_acc.commission_acc_id', $commission_acc_id);
			return $this->db->get()->row_array();
		}
		
		public function updateCoreCommissionAcc($data){
			$this->db->where('core_commission_acc.commission_acc_id', $data['commission_acc_id']);
			$query = $this->db->update('core_commission_acc', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreCommissionAcc($commission_acc_id){
			$this->db->where("core_commission_acc.commission_acc_id", $commission_acc_id);
			$query = $this->db->update('core_commission_acc', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>