<?php
	class hroemployeeattendancedatadownload extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancedatadownload_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			echo "access is denied index";
		}

		public function processAddHROEmployeeAttendanceDataDownload($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$unique 			= $this->session->userdata('unique');
				$auth 				= $this->session->userdata('auth');
				$date 				= date("Y-m-d");
				$date 				= date("2018-10-19");
				$startdate1			= strtotime('-2 day', strtotime($date));
				$startdate 			= date("Y-m-d", $startdate1);

				$scheduleemployeescheduleitem 		= $this->hroemployeeattendancedatadownload_model->getScheduleEmployeeScheduleItem($startdate);

				$employee_overtime_minimum_minutes 	= $this->hroemployeeattendancedatadownload_model->getEmployeeOvertimeMinimumMinutes();


				foreach ($scheduleemployeescheduleitem as $keyScheduleItem => $valScheduleItem) {
					$employee_id 					= $valScheduleItem['employee_id'];
					$employee_schedule_item_status 	= $valScheduleItem['employee_schedule_item_status'];

					$hroemployeeattendance 	= $this->hroemployeeattendancedatadownload_model->getHROEmployeeAttendance($startdate, $employee_id);

					if (!empty($hroemployeeattendance)){
						foreach ($hroemployeeattendance as $key => $val) {
							$coreshift 	= $this->hroemployeeattendancedatadownload_model->getCoreShift_Detail($val['shift_id']);

							if ($coreshift['shift_next_day'] == 0){
								$employee_attendance_in_date  				= $val['employee_attendance_in_date'];
								$employee_attendance_out_date  				= $val['employee_attendance_out_date'];
								$employee_attendance_date  					= $val['employee_attendance_date'];

								$employee_attendance_working_in_date 		= $employee_attendance_date." ".$coreshift['start_working_hour'];

								$employee_attendance_working_out_date 		= $employee_attendance_date." ".$coreshift['end_working_hour'];

								if ($employee_attendance_in_date > $employee_attendance_working_in_date){
									$employee_attendance_working_in_date = $employee_attendance_in_date;
								}

								$employee_attendance_working_time1 			= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_in_date);

								if ($employee_attendance_working_time1 <= 0){
									$employee_attendance_working_time_hours		= 0;
									$employee_attendance_working_time_minutes 	= 0;
								} else {
									$employee_attendance_working_time_hours		= floor($employee_attendance_working_time1 / 3600);
									$employee_attendance_working_time_minutes 	= floor(($employee_attendance_working_time1 - $employee_attendance_working_time_hours * 3600) / 60);
								}

								
								$employee_attendance_working_total_hours	= $coreshift['total_working_hour'];

								if ($employee_attendance_working_time_hours < 0){
									$employee_attendance_working_time_hours = 0;
								}

								if ($employee_attendance_working_time_minutes < 0){
									$employee_attendance_working_time_minutes = 0;
								}

								$employee_attendance_working_hours = $employee_attendance_working_time_hours + ($employee_attendance_working_time_minutes / 60);

								if ($employee_attendance_working_hours >= $coreshift['working_hours_start'] && $employee_attendance_working_hours <= $coreshift['working_hours_end']){
									$employee_attendance_working_status = 1;
									$employee_attendance_status 		= 1;
								} else if ($employee_attendance_working_hours < $coreshift['working_hours_start']){
									$employee_attendance_working_status = 2;
									$employee_attendance_status 		= 2;
								} else if ($employee_attendance_working_hours > $coreshift['working_hours_end']){
									$employee_attendance_working_status = 3;
									$employee_attendance_status 		= 3;
								}


								/*Calculate Late*/
								$total_working_late1 		= strtotime($employee_attendance_in_date) - strtotime($employee_attendance_working_in_date);

								if ($total_working_late1 <= 0){
									$employee_attendance_late_hours 	= 0;
									$employee_attendance_late_minutes	= 0;

									$employee_attendance_late_status	= 0;
								} else {
									$employee_attendance_late_hours 	= floor($total_working_late1 / 3600);
									$employee_attendance_late_minutes	= floor(($total_working_late1 - $employee_attendance_late_hours * 3600) / 60);	

									$employee_attendance_late_status	= 1;
								}


								/*Calculate Overtime*/
								$date 		= date_create($employee_attendance_working_out_date);
								date_add($date, date_interval_create_from_date_string($employee_overtime_minimum_minutes." minutes"));
								$employee_attendance_working_minimum_overtime	= date_format($date, "Y-m-d H:i:s");

								$total_working_overtime1 	= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_minimum_overtime);

								if ($total_working_overtime1 <= 0){
									$employee_attendance_overtime_hours 	= 0;
									$employee_attendance_overtime_minutes	= 0;

									$employee_attendance_overtime_status	= 0;
								} else {
									$employee_attendance_overtime_hours 	= floor($total_working_overtime1 / 3600);
									$employee_attendance_overtime_minutes	= floor(($total_working_overtime1 - $employee_attendance_overtime_hours * 3600) / 60);	

									$employee_attendance_overtime_status	= 1;
								}



								/*Calculate Home Early*/
								if ($employee_attendance_working_hours < $coreshift['working_hours_start']){
									$employee_attendance_homeearly_hours 	= $employee_attendance_working_time_hours;
									$employee_attendance_homeearly_minutes	= $employee_attendance_working_time_minutes;

									$employee_attendance_homeearly_status	= 1;
								} else {
									$employee_attendance_homeearly_hours 	= 0;
									$employee_attendance_homeearly_minutes	= 0;

									$employee_attendance_homeearly_status	= 0;
								}

								$data_hroemployeeattendancedatadownload = array (
									'region_id'									=> $val['region_id'],
									'branch_id'									=> $val['branch_id'],
									'location_id'								=> $val['location_id'],
									'division_id'								=> $val['division_id'],
									'department_id'								=> $val['department_id'],
									'section_id'								=> $val['section_id'],
									'unit_id'									=> $val['unit_id'],
									'employee_id'								=> $val['employee_id'],
									'shift_id'									=> $val['shift_id'],
									'employee_shift_id'							=> $val['employee_shift_id'],
									'employee_rfid_code'						=> $val['employee_rfid_code'],
									'employee_attendance_date'					=> $val['employee_attendance_date'],
									'employee_attendance_date_status_default'	=> $valScheduleItem['employee_schedule_item_status_default'],
									'employee_attendance_date_status'			=> $valScheduleItem['employee_schedule_item_status'],
									'employee_attendance_in_date'				=> $employee_attendance_in_date,
									'employee_attendance_out_date'				=> $employee_attendance_out_date,
									'employee_attendance_working_in_date'		=> $employee_attendance_working_in_date,
									'employee_attendance_working_out_date'		=> $employee_attendance_working_out_date,
									'employee_attendance_working_time_hours'	=> $employee_attendance_working_time_hours,
									'employee_attendance_working_time_minutes'	=> $employee_attendance_working_time_minutes,
									'employee_attendance_working_total_hours'	=> $employee_attendance_working_total_hours,
									'employee_attendance_working_hours'			=> $employee_attendance_working_hours,
									'employee_attendance_working_status'		=> $employee_attendance_working_status,
									'employee_attendance_status'				=> $employee_attendance_status,
									'employee_attendance_late_status'			=> $employee_attendance_late_status,
									'employee_attendance_late_hours'			=> $employee_attendance_late_hours,
									'employee_attendance_late_minutes'			=> $employee_attendance_late_minutes,
									'employee_attendance_overtime_status'		=> $employee_attendance_overtime_status,
									'employee_attendance_overtime_hours'		=> $employee_attendance_overtime_hours,
									'employee_attendance_overtime_minutes'		=> $employee_attendance_overtime_minutes,
									'employee_attendance_homeearly_status'		=> $employee_attendance_homeearly_status,
									'employee_attendance_homeearly_hours'		=> $employee_attendance_homeearly_hours,
									'employee_attendance_homeearly_minutes'		=> $employee_attendance_homeearly_minutes,
									'created_id'								=> $auth['user_id'],
									'created_on'								=> date("Y-m-d H:i:s"),
								);

								$this->hroemployeeattendancedatadownload_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedatadownload);
							} else {
								$employee_attendance_in_date  		= $val['employee_attendance_out_date'];

								$employee_attendance_date 			= $val['employee_attendance_date'];

								$date 								= date_create($employee_attendance_date);
								date_add($date, date_interval_create_from_date_string("1 days"));
								$employee_attendance_next_date		= date_format($date, "Y-m-d");

								$employee_attendance_out_date		= $this->hroemployeeattendancedatadownload_model->getEmployeeAttendanceOutDate($val['employee_id'], $employee_attendance_next_date);

								$employee_attendance_working_in_date 		= $employee_attendance_date." ".$coreshift['start_working_hour'];

								$employee_attendance_working_time1 			= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_in_date);

								if ($employee_attendance_in_date > $employee_attendance_working_in_date){
									$employee_attendance_working_in_date = $employee_attendance_in_date;
								}

								$employee_attendance_working_time_hours		= floor($employee_attendance_working_time1 / 3600);
								$employee_attendance_working_time_minutes 	= floor(($employee_attendance_working_time1 - $employee_attendance_working_time_hours * 3600) / 60);

								$employee_attendance_working_total_hours	= $coreshift['total_working_hour'];

								if ($employee_attendance_working_time_hours < 0){
									$employee_attendance_working_time_hours = 0;
								}

								if ($employee_attendance_working_time_minutes < 0){
									$employee_attendance_working_time_minutes = 0;
								}

								$employee_attendance_working_hours = $employee_attendance_working_time_hours + ($employee_attendance_working_time_minutes / 60);

								/*Calculate Late*/
								$total_working_late1 		= strtotime($employee_attendance_in_date) - strtotime($employee_attendance_working_in_date);

								if ($total_working_late1 <= 0){
									$employee_attendance_late_hours 	= 0;
									$employee_attendance_late_minutes	= 0;

									$employee_attendance_late_status	= 0;
								} else {
									$employee_attendance_late_hours 	= floor($total_working_late1 / 3600);
									$employee_attendance_late_minutes	= floor(($total_working_late1 - $employee_attendance_late_hours * 3600) / 60);	

									$employee_attendance_late_status	= 1;
								}


								/*Calculate Overtime*/
								$date 		= date_create($employee_attendance_working_out_date);
								date_add($date, date_interval_create_from_date_string($employee_overtime_minimum_minutes." minutes"));
								$employee_attendance_working_minimum_overtime	= date_format($date, "Y-m-d H:i:s");

								$total_working_overtime1 	= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_minimum_overtime);

								if ($total_working_overtime1 <= 0){
									$employee_attendance_overtime_hours 	= 0;
									$employee_attendance_overtime_minutes	= 0;

									$employee_attendance_overtime_status	= 0;
								} else {
									$employee_attendance_overtime_hours 	= floor($total_working_overtime1 / 3600);
									$employee_attendance_overtime_minutes	= floor(($total_working_overtime1 - $employee_attendance_overtime_hours * 3600) / 60);	

									$employee_attendance_overtime_status	= 1;
								}



								/*Calculate Home Early*/
								if ($employee_attendance_working_hours < $coreshift['working_hours_start']){
									$employee_attendance_homeearly_hours 	= $employee_attendance_working_time_hours;
									$employee_attendance_homeearly_minutes	= $employee_attendance_working_time_minutes;

									$employee_attendance_homeearly_status	= 1;
								} else {
									$employee_attendance_homeearly_hours 	= 0;
									$employee_attendance_homeearly_minutes	= 0;

									$employee_attendance_homeearly_status	= 0;
								}
							
								$data_hroemployeeattendancedatadownload = array (
									'region_id'									=> $val['region_id'],
									'branch_id'									=> $val['branch_id'],
									'location_id'								=> $val['location_id'],
									'division_id'								=> $val['division_id'],
									'department_id'								=> $val['department_id'],
									'section_id'								=> $val['section_id'],
									'unit_id'									=> $val['unit_id'],
									'employee_id'								=> $val['employee_id'],
									'shift_id'									=> $val['shift_id'],
									'employee_shift_id'							=> $val['employee_shift_id'],
									'employee_rfid_code'						=> $val['employee_rfid_code'],
									'employee_attendance_date'					=> $val['employee_attendance_date'],
									'employee_attendance_date_status_default'	=> $valScheduleItem['employee_schedule_item_status_default'],
									'employee_attendance_date_status'			=> $valScheduleItem['employee_schedule_item_status'],
									'employee_attendance_in_date'				=> $employee_attendance_in_date,
									'employee_attendance_out_date'				=> $employee_attendance_out_date,
									'employee_attendance_working_in_date'		=> $employee_attendance_working_in_date,
									'employee_attendance_working_out_date'		=> $employee_attendance_working_out_date,
									'employee_attendance_working_time_hours'	=> $employee_attendance_working_time_hours,
									'employee_attendance_working_time_minutes'	=> $employee_attendance_working_time_minutes,
									'employee_attendance_working_total_hours'	=> $employee_attendance_working_total_hours,
									'employee_attendance_working_hours'			=> $employee_attendance_working_hours,
									'employee_attendance_working_status'		=> $employee_attendance_working_status,
									'employee_attendance_status'				=> $employee_attendance_status,
									'employee_attendance_late_status'			=> $employee_attendance_late_status,
									'employee_attendance_late_hours'			=> $employee_attendance_late_hours,
									'employee_attendance_late_minutes'			=> $employee_attendance_late_minutes,
									'employee_attendance_overtime_status'		=> $employee_attendance_overtime_status,
									'employee_attendance_overtime_hours'		=> $employee_attendance_overtime_hours,
									'employee_attendance_overtime_minutes'		=> $employee_attendance_overtime_minutes,
									'employee_attendance_homeearly_status'		=> $employee_attendance_homeearly_status,
									'employee_attendance_homeearly_hours'		=> $employee_attendance_homeearly_hours,
									'employee_attendance_homeearly_minutes'		=> $employee_attendance_homeearly_minutes,
									'created_id'								=> $auth['user_id'],
									'created_on'								=> date("Y-m-d H:i:s"),
								);

								$this->hroemployeeattendancedatadownload_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedatadownload);
							}					
						}
					} else {
						$data_hroemployeeattendancedatadownload = array (
							'region_id'									=> $valScheduleItem['region_id'],
							'branch_id'									=> $valScheduleItem['branch_id'],
							'location_id'								=> $valScheduleItem['location_id'],
							'division_id'								=> $valScheduleItem['division_id'],
							'department_id'								=> $valScheduleItem['department_id'],
							'section_id'								=> $valScheduleItem['section_id'],
							'unit_id'									=> $valScheduleItem['unit_id'],
							'employee_id'								=> $valScheduleItem['employee_id'],
							'shift_id'									=> $valScheduleItem['shift_id'],
							'employee_shift_id'							=> $valScheduleItem['employee_shift_id'],
							'employee_rfid_code'						=> $valScheduleItem['employee_rfid_code'],
							'employee_attendance_date'					=> $valScheduleItem['employee_schedule_item_date'],
							'employee_attendance_date_status_default'	=> $valScheduleItem['employee_schedule_item_status_default'],
							'employee_attendance_date_status'			=> $valScheduleItem['employee_schedule_item_status'],
							'employee_attendance_working_status'		=> 9,
							'employee_attendance_status'				=> 9,
							'created_id'								=> $auth['user_id'],
							'created_on'								=> date("Y-m-d H:i:s"),
						);

						$this->hroemployeeattendancedatadownload_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedatadownload);
					}

				}
			}
		}



		public function processCalculateHROEmployeeAttendanceData($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$unique 			= $this->session->userdata('unique');
				$auth 				= $this->session->userdata('auth');
				$start_date 		= date("2018-06-27");
				$end_date 			= date("2018-06-28");

				$startdate1 		= strtotime('0 day', strtotime($start_date));
				$startdate 			= date("Y-m-d", $startdate1);

				$enddate1 			= strtotime('1 day', strtotime($end_date));
				$enddate 			= date("Y-m-d", $enddate1);

				while($startdate != $enddate){
					$scheduleemployeescheduleitem 		= $this->hroemployeeattendancedatadownload_model->getScheduleEmployeeScheduleItem($startdate);

					$employee_overtime_minimum_minutes 	= $this->hroemployeeattendancedatadownload_model->getEmployeeOvertimeMinimumMinutes();


					foreach ($scheduleemployeescheduleitem as $keyScheduleItem => $valScheduleItem) {
						$employee_id 					= $valScheduleItem['employee_id'];
						$employee_schedule_item_status 	= $valScheduleItem['employee_schedule_item_status'];

						$hroemployeeattendance 	= $this->hroemployeeattendancedatadownload_model->getHROEmployeeAttendance($startdate, $employee_id);

						if (!empty($hroemployeeattendance)){
							foreach ($hroemployeeattendance as $key => $val) {
								$coreshift 	= $this->hroemployeeattendancedatadownload_model->getCoreShift_Detail($val['shift_id']);

								if ($coreshift['shift_next_day'] == 0){
									$employee_attendance_in_date  				= $val['employee_attendance_in_date'];
									$employee_attendance_out_date  				= $val['employee_attendance_out_date'];
									$employee_attendance_date  					= $val['employee_attendance_date'];

									$employee_attendance_working_in_date 		= $employee_attendance_date." ".$coreshift['start_working_hour'];

									$employee_attendance_working_out_date 		= $employee_attendance_date." ".$coreshift['end_working_hour'];

									if ($employee_attendance_in_date > $employee_attendance_working_in_date){
										$employee_attendance_working_in_date = $employee_attendance_in_date;
									}

									$employee_attendance_working_time1 			= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_in_date);

									if ($employee_attendance_working_time1 <= 0){
										$employee_attendance_working_time_hours		= 0;
										$employee_attendance_working_time_minutes 	= 0;
									} else {
										$employee_attendance_working_time_hours		= floor($employee_attendance_working_time1 / 3600);
										$employee_attendance_working_time_minutes 	= floor(($employee_attendance_working_time1 - $employee_attendance_working_time_hours * 3600) / 60);
									}

									
									$employee_attendance_working_total_hours	= $coreshift['total_working_hour'];

									if ($employee_attendance_working_time_hours < 0){
										$employee_attendance_working_time_hours = 0;
									}

									if ($employee_attendance_working_time_minutes < 0){
										$employee_attendance_working_time_minutes = 0;
									}

									$employee_attendance_working_hours = $employee_attendance_working_time_hours + ($employee_attendance_working_time_minutes / 60);

									if ($employee_attendance_working_hours >= $coreshift['working_hours_start'] && $employee_attendance_working_hours <= $coreshift['working_hours_end']){
										$employee_attendance_working_status = 1;
										$employee_attendance_status 		= 1;
									} else if ($employee_attendance_working_hours < $coreshift['working_hours_start']){
										$employee_attendance_working_status = 2;
										$employee_attendance_status 		= 2;
									} else if ($employee_attendance_working_hours > $coreshift['working_hours_end']){
										$employee_attendance_working_status = 3;
										$employee_attendance_status 		= 3;
									}


									/*Calculate Late*/
									$total_working_late1 		= strtotime($employee_attendance_in_date) - strtotime($employee_attendance_working_in_date);

									if ($total_working_late1 <= 0){
										$employee_attendance_late_hours 	= 0;
										$employee_attendance_late_minutes	= 0;

										$employee_attendance_late_status	= 0;
									} else {
										$employee_attendance_late_hours 	= floor($total_working_late1 / 3600);
										$employee_attendance_late_minutes	= floor(($total_working_late1 - $employee_attendance_late_hours * 3600) / 60);	

										$employee_attendance_late_status	= 1;
									}


									/*Calculate Overtime*/
									$date 		= date_create($employee_attendance_working_out_date);
									date_add($date, date_interval_create_from_date_string($employee_overtime_minimum_minutes." minutes"));
									$employee_attendance_working_minimum_overtime	= date_format($date, "Y-m-d H:i:s");

									$total_working_overtime1 	= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_minimum_overtime);

									if ($total_working_overtime1 <= 0){
										$employee_attendance_overtime_hours 	= 0;
										$employee_attendance_overtime_minutes	= 0;

										$employee_attendance_overtime_status	= 0;
									} else {
										$employee_attendance_overtime_hours 	= floor($total_working_overtime1 / 3600);
										$employee_attendance_overtime_minutes	= floor(($total_working_overtime1 - $employee_attendance_overtime_hours * 3600) / 60);	

										$employee_attendance_overtime_status	= 1;
									}



									/*Calculate Home Early*/
									if ($employee_attendance_working_hours < $coreshift['working_hours_start']){
										$employee_attendance_homeearly_hours 	= $employee_attendance_working_time_hours;
										$employee_attendance_homeearly_minutes	= $employee_attendance_working_time_minutes;

										$employee_attendance_homeearly_status	= 1;
									} else {
										$employee_attendance_homeearly_hours 	= 0;
										$employee_attendance_homeearly_minutes	= 0;

										$employee_attendance_homeearly_status	= 0;
									}

									$data_hroemployeeattendancedatadownload = array (
										'region_id'									=> $val['region_id'],
										'branch_id'									=> $val['branch_id'],
										'location_id'								=> $val['location_id'],
										'division_id'								=> $val['division_id'],
										'department_id'								=> $val['department_id'],
										'section_id'								=> $val['section_id'],
										'unit_id'									=> $val['unit_id'],
										'employee_id'								=> $val['employee_id'],
										'shift_id'									=> $val['shift_id'],
										'employee_shift_id'							=> $val['employee_shift_id'],
										'employee_rfid_code'						=> $val['employee_rfid_code'],
										'employee_attendance_date'					=> $val['employee_attendance_date'],
										'employee_attendance_date_status_default'	=> $valScheduleItem['employee_schedule_item_status_default'],
										'employee_attendance_date_status'			=> $valScheduleItem['employee_schedule_item_status'],
										'employee_attendance_in_date'				=> $employee_attendance_in_date,
										'employee_attendance_out_date'				=> $employee_attendance_out_date,
										'employee_attendance_working_in_date'		=> $employee_attendance_working_in_date,
										'employee_attendance_working_out_date'		=> $employee_attendance_working_out_date,
										'employee_attendance_working_time_hours'	=> $employee_attendance_working_time_hours,
										'employee_attendance_working_time_minutes'	=> $employee_attendance_working_time_minutes,
										'employee_attendance_working_total_hours'	=> $employee_attendance_working_total_hours,
										'employee_attendance_working_hours'			=> $employee_attendance_working_hours,
										'employee_attendance_working_status'		=> $employee_attendance_working_status,
										'employee_attendance_status'				=> $employee_attendance_status,
										'employee_attendance_late_status'			=> $employee_attendance_late_status,
										'employee_attendance_late_hours'			=> $employee_attendance_late_hours,
										'employee_attendance_late_minutes'			=> $employee_attendance_late_minutes,
										'employee_attendance_overtime_status'		=> $employee_attendance_overtime_status,
										'employee_attendance_overtime_hours'		=> $employee_attendance_overtime_hours,
										'employee_attendance_overtime_minutes'		=> $employee_attendance_overtime_minutes,
										'employee_attendance_homeearly_status'		=> $employee_attendance_homeearly_status,
										'employee_attendance_homeearly_hours'		=> $employee_attendance_homeearly_hours,
										'employee_attendance_homeearly_minutes'		=> $employee_attendance_homeearly_minutes,
										'created_id'								=> $auth['user_id'],
										'created_on'								=> date("Y-m-d H:i:s"),
									);

									$this->hroemployeeattendancedatadownload_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedatadownload);
								} else {
									$employee_attendance_in_date  		= $val['employee_attendance_out_date'];

									$employee_attendance_date 			= $val['employee_attendance_date'];

									$date 								= date_create($employee_attendance_date);
									date_add($date, date_interval_create_from_date_string("1 days"));
									$employee_attendance_next_date		= date_format($date, "Y-m-d");

									$employee_attendance_out_date		= $this->hroemployeeattendancedatadownload_model->getEmployeeAttendanceOutDate($val['employee_id'], $employee_attendance_next_date);

									$employee_attendance_working_in_date 		= $employee_attendance_date." ".$coreshift['start_working_hour'];

									$employee_attendance_working_time1 			= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_in_date);

									if ($employee_attendance_in_date > $employee_attendance_working_in_date){
										$employee_attendance_working_in_date = $employee_attendance_in_date;
									}

									$employee_attendance_working_time_hours		= floor($employee_attendance_working_time1 / 3600);
									$employee_attendance_working_time_minutes 	= floor(($employee_attendance_working_time1 - $employee_attendance_working_time_hours * 3600) / 60);

									$employee_attendance_working_total_hours	= $coreshift['total_working_hour'];

									if ($employee_attendance_working_time_hours < 0){
										$employee_attendance_working_time_hours = 0;
									}

									if ($employee_attendance_working_time_minutes < 0){
										$employee_attendance_working_time_minutes = 0;
									}

									$employee_attendance_working_hours = $employee_attendance_working_time_hours + ($employee_attendance_working_time_minutes / 60);

									/*Calculate Late*/
									$total_working_late1 		= strtotime($employee_attendance_in_date) - strtotime($employee_attendance_working_in_date);

									if ($total_working_late1 <= 0){
										$employee_attendance_late_hours 	= 0;
										$employee_attendance_late_minutes	= 0;

										$employee_attendance_late_status	= 0;
									} else {
										$employee_attendance_late_hours 	= floor($total_working_late1 / 3600);
										$employee_attendance_late_minutes	= floor(($total_working_late1 - $employee_attendance_late_hours * 3600) / 60);	

										$employee_attendance_late_status	= 1;
									}


									/*Calculate Overtime*/
									$date 		= date_create($employee_attendance_working_out_date);
									date_add($date, date_interval_create_from_date_string($employee_overtime_minimum_minutes." minutes"));
									$employee_attendance_working_minimum_overtime	= date_format($date, "Y-m-d H:i:s");

									$total_working_overtime1 	= strtotime($employee_attendance_out_date) - strtotime($employee_attendance_working_minimum_overtime);

									if ($total_working_overtime1 <= 0){
										$employee_attendance_overtime_hours 	= 0;
										$employee_attendance_overtime_minutes	= 0;

										$employee_attendance_overtime_status	= 0;
									} else {
										$employee_attendance_overtime_hours 	= floor($total_working_overtime1 / 3600);
										$employee_attendance_overtime_minutes	= floor(($total_working_overtime1 - $employee_attendance_overtime_hours * 3600) / 60);	

										$employee_attendance_overtime_status	= 1;
									}



									/*Calculate Home Early*/
									if ($employee_attendance_working_hours < $coreshift['working_hours_start']){
										$employee_attendance_homeearly_hours 	= $employee_attendance_working_time_hours;
										$employee_attendance_homeearly_minutes	= $employee_attendance_working_time_minutes;

										$employee_attendance_homeearly_status	= 1;
									} else {
										$employee_attendance_homeearly_hours 	= 0;
										$employee_attendance_homeearly_minutes	= 0;

										$employee_attendance_homeearly_status	= 0;
									}
								
									$data_hroemployeeattendancedatadownload = array (
										'region_id'									=> $val['region_id'],
										'branch_id'									=> $val['branch_id'],
										'location_id'								=> $val['location_id'],
										'division_id'								=> $val['division_id'],
										'department_id'								=> $val['department_id'],
										'section_id'								=> $val['section_id'],
										'unit_id'									=> $val['unit_id'],
										'employee_id'								=> $val['employee_id'],
										'shift_id'									=> $val['shift_id'],
										'employee_shift_id'							=> $val['employee_shift_id'],
										'employee_rfid_code'						=> $val['employee_rfid_code'],
										'employee_attendance_date'					=> $val['employee_attendance_date'],
										'employee_attendance_date_status_default'	=> $valScheduleItem['employee_schedule_item_status_default'],
										'employee_attendance_date_status'			=> $valScheduleItem['employee_schedule_item_status'],
										'employee_attendance_in_date'				=> $employee_attendance_in_date,
										'employee_attendance_out_date'				=> $employee_attendance_out_date,
										'employee_attendance_working_in_date'		=> $employee_attendance_working_in_date,
										'employee_attendance_working_out_date'		=> $employee_attendance_working_out_date,
										'employee_attendance_working_time_hours'	=> $employee_attendance_working_time_hours,
										'employee_attendance_working_time_minutes'	=> $employee_attendance_working_time_minutes,
										'employee_attendance_working_total_hours'	=> $employee_attendance_working_total_hours,
										'employee_attendance_working_hours'			=> $employee_attendance_working_hours,
										'employee_attendance_working_status'		=> $employee_attendance_working_status,
										'employee_attendance_status'				=> $employee_attendance_status,
										'employee_attendance_late_status'			=> $employee_attendance_late_status,
										'employee_attendance_late_hours'			=> $employee_attendance_late_hours,
										'employee_attendance_late_minutes'			=> $employee_attendance_late_minutes,
										'employee_attendance_overtime_status'		=> $employee_attendance_overtime_status,
										'employee_attendance_overtime_hours'		=> $employee_attendance_overtime_hours,
										'employee_attendance_overtime_minutes'		=> $employee_attendance_overtime_minutes,
										'employee_attendance_homeearly_status'		=> $employee_attendance_homeearly_status,
										'employee_attendance_homeearly_hours'		=> $employee_attendance_homeearly_hours,
										'employee_attendance_homeearly_minutes'		=> $employee_attendance_homeearly_minutes,
										'created_id'								=> $auth['user_id'],
										'created_on'								=> date("Y-m-d H:i:s"),
									);

									$this->hroemployeeattendancedatadownload_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedatadownload);
								}					
							}
						} else {
							$data_hroemployeeattendancedatadownload = array (
								'region_id'									=> $valScheduleItem['region_id'],
								'branch_id'									=> $valScheduleItem['branch_id'],
								'location_id'								=> $valScheduleItem['location_id'],
								'division_id'								=> $valScheduleItem['division_id'],
								'department_id'								=> $valScheduleItem['department_id'],
								'section_id'								=> $valScheduleItem['section_id'],
								'unit_id'									=> $valScheduleItem['unit_id'],
								'employee_id'								=> $valScheduleItem['employee_id'],
								'shift_id'									=> $valScheduleItem['shift_id'],
								'employee_shift_id'							=> $valScheduleItem['employee_shift_id'],
								'employee_rfid_code'						=> $valScheduleItem['employee_rfid_code'],
								'employee_attendance_date'					=> $valScheduleItem['employee_schedule_item_date'],
								'employee_attendance_date_status_default'	=> $valScheduleItem['employee_schedule_item_status_default'],
								'employee_attendance_date_status'			=> $valScheduleItem['employee_schedule_item_status'],
								'employee_attendance_working_status'		=> 9,
								'employee_attendance_status'				=> 9,
								'created_id'								=> $auth['user_id'],
								'created_on'								=> date("Y-m-d H:i:s"),
							);

							$this->hroemployeeattendancedatadownload_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedatadownload);
						}

					}
					$startdate1			= strtotime('1 day', strtotime($startdate));
					$startdate 			= date("Y-m-d", $startdate1);
				}
			}
		}


		public function processCalculateHROEmployeeAttendanceData2($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$unique 			= $this->session->userdata('unique');
				$auth 				= $this->session->userdata('auth');
				$start_date 		= date("2018-04-26");
				$end_date 			= date("2018-05-25");

				$startdate1 		= strtotime('0 day', strtotime($start_date));
				$startdate 			= date("Y-m-d", $startdate1);

				$enddate1 			= strtotime('1 day', strtotime($end_date));
				$enddate 			= date("Y-m-d", $enddate1);

				while($startdate != $enddate){
					print_r("startdate ");
					print_r($startdate);
					print_r("<BR> ");
					
					$startdate1			= strtotime('1 day', strtotime($startdate));
					$startdate 			= date("Y-m-d", $startdate1);
				}
			}
		}

		public function getTestPic(){
			$testpic = $this->hroemployeeattendancedatadownload_model->getTestPic();

			foreach ($testpic as $key => $val) {
				print_r("pic id ");
				print_r($val['pic_id']);
				print_r("<BR>");

				/*print_r("pic name ");
				print_r($val['pic_name']);
				print_r("<BR>");*/

				echo '<img src="data:image/jpeg;base64,'.base64_encode( $val['pic_name'] ).'"/>';
			}
		}
	}
?>