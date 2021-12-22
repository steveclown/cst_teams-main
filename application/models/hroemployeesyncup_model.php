<?php
	class hroemployeesyncup_model extends CI_Model {
		var $table = "transaction_employee_late";

		public function hroemployeesyncup_model(){
			parent::__construct();
			$this->CI = get_instance();
			$this->db_syncup= $this->load->database('db_syncup', TRUE);
		}

		public function getScheduleEmployeeScheduleItemSync($employee_schedule_item_date){
			$this->db_syncup->select('schedule_employee_schedule_item.employee_id, schedule_employee_schedule_item.employee_schedule_item_date, schedule_employee_schedule_item.employee_schedule_item_status, schedule_employee_schedule_item.employee_schedule_item_log_in_date');
			$this->db_syncup->from('schedule_employee_schedule_item');
			$this->db_syncup->where('schedule_employee_schedule_item.employee_schedule_item_date', $employee_schedule_item_date);
			$this->db_syncup->where('schedule_employee_schedule_item.employee_schedule_item_downloaded', 0);
			$result = $this->db_syncup->get();
			return $result->result_array();
		}

		public function updateScheduleEmployeeScheduleItem($data){
			$this->db->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db->where('schedule_employee_schedule_item.employee_schedule_item_date', $data['employee_schedule_item_date']);

			$data_update = array(
				'employee_schedule_item_status' 	=> $data['employee_schedule_item_status'],
				'employee_schedule_item_log_date' 	=> $data['employee_schedule_item_log_date'],
			);

			$query = $this->db->update('schedule_employee_schedule_item', $data_update);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateScheduleEmployeeScheduleItem_Sync($data){
			$this->db_syncup->where('schedule_employee_schedule_item.employee_id', $data['employee_id']);
			$this->db_syncup->where('schedule_employee_schedule_item.employee_schedule_item_date', $data['employee_schedule_item_date']);

			$data_update = array (
				'employee_schedule_item_downloaded'			=> $data['employee_schedule_item_downloaded'],
				'employee_schedule_item_downloaded_on'		=> $data['employee_schedule_item_downloaded_on'],
			);

			$query = $this->db_syncup->update('schedule_employee_schedule_item', $data_update);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>