<?php
	Class hroemployeesyncup extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeesyncup_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			echo "access is denied index";
		}

		public function UpdateHROEmployeeSyncUp($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$employee_schedule_item_date 		= date("Y-m-d");

				$scheduleemployeescheduleitem_sync 	= $this->hroemployeesyncup_model->getScheduleEmployeeScheduleItemSync($employee_schedule_item_date);

				foreach ($scheduleemployeescheduleitem_sync as $keySync => $valSync) {
					$data_updatescheduleemployeescheduleitem = array(
						'employee_id'							=> $valSync['employee_id'],
						'employee_schedule_item_date'			=> $valSync['employee_schedule_item_date'],
						'employee_schedule_item_status'			=> $valSync['employee_schedule_item_status'],
						'employee_schedule_item_log_in_date'	=> $valSync['employee_schedule_item_log_in_date'],
					);

					if ($this->hroemployeesyncup_model->updateScheduleEmployeeScheduleItem($data_updatescheduleemployeescheduleitem)){
						$data_updatesync = array(
							'employee_id'							=> $valSync['employee_id'],
							'employee_schedule_item_date'			=> $valSync['employee_schedule_item_date'],
							'employee_schedule_item_downloaded'		=> 1,
							'employee_schedule_item_downloaded_on'	=> date("Y-m-d H:i:s"),
						);

						$this->hroemployeesyncup_model->updateScheduleEmployeeScheduleItem_Sync($data_updatesync);
					}
				}
			}
		}

	}
?>