<?php
class ScheduleShiftAssignment extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$menu = 'schedule-shift-assignment';

		$this->cekLogin();
		$this->accessMenu($menu);

		$this->load->model('MainPage_model');
		$this->load->model('ScheduleShiftAssignment_model');
		$this->load->helper('sistem');
		$this->load->library('fungsi');
		$this->load->library('configuration');
		$this->load->database('default');
	}

	public function index()
	{
		$auth 						= $this->session->userdata('auth');
		$region_id 					= $auth['region_id'];
		$branch_id 					= $auth['branch_id'];
		$location_id 				= $auth['location_id'];
		$payroll_employee_level 	= $auth['payroll_employee_level'];
		$data['main_view']['ShiftNextDay']				= $this->configuration->ShiftNextDay();
		$data['main_view']['coredivision']				= $this->ScheduleShiftAssignment_model->getCoreDivision();

		$data['main_view']['scheduleshiftpattern']		= $this->ScheduleShiftAssignment_model->getScheduleShiftPattern();

		$data['main_view']['ScheduleShiftAssignment']	= $this->ScheduleShiftAssignment_model->getScheduleShiftAssignment($region_id, $branch_id, $location_id, $payroll_employee_level);

		$data['main_view']['content']					= 'ScheduleShiftAssignment/ListScheduleShiftAssignment_view';
		$this->load->view('MainPage_view', $data);
	}

	public function addScheduleShiftAssignment()
	{
		$auth 			= $this->session->userdata('auth');

		$data['main_view']['coredivision']			= create_double($this->ScheduleShiftAssignment_model->getCoreDivision(), 'division_id', 'division_name');
		$data['main_view']['scheduleshiftpattern']	= create_double($this->ScheduleShiftAssignment_model->getScheduleShiftPattern(), 'shift_pattern_id', 'shift_pattern_name');
		$data['main_view']['content']				= 'ScheduleShiftAssignment/FormAddScheduleShiftAssignment_view';
		$this->load->view('MainPage_view', $data);
	}

	public function function_state_add()
	{
		$unique 	= $this->session->userdata('unique');
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('addScheduleShiftAssignment-' . $unique['unique']);
		$sessions['active_tab'] = $value;
		$this->session->set_userdata('addScheduleShiftAssignment-' . $unique['unique'], $sessions);
	}

	public function function_elements_add()
	{
		$unique 	= $this->session->userdata('unique');
		$name 		= $this->input->post('name', true);
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('addScheduleShiftAssignment-' . $unique['unique']);
		$sessions[$name] = $value;
		$this->session->set_userdata('addScheduleShiftAssignment-' . $unique['unique'], $sessions);
		// echo $name;
	}

	public function reset_add()
	{
		$unique 	= $this->session->userdata('unique');
		$header 	= $this->session->userdata('addScheduleShiftAssignment-' . $unique['unique']);

		$this->session->unset_userdata('addScheduleShiftAssignment-' . $unique['unique']);
		$this->session->unset_userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique']);
		$this->session->unset_userdata($data['created_on']);
		redirect('ScheduleShiftAssignment/addScheduleShiftAssignment');
	}

	public function processAddArrayScheduleShiftAssignment()
	{
		$data_ScheduleShiftAssignment = array(
			'shift_pattern_id'					=> $this->input->post('shift_pattern_id', true),
			'shift_assignment_start_date'		=> $this->input->post('shift_assignment_start_date', true),
			'shift_assignment_cycle'			=> $this->input->post('shift_assignment_cycle', true),
		);

		$this->form_validation->set_rules('shift_pattern_id', 'Shift Pattern', 'required');

		if ($this->form_validation->run() == true) {
			$unique 			= $this->session->userdata('unique');
			$session_name 		= $this->input->post('session_name', true);
			$dataArrayHeader	= $this->session->userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique']);

			$dataArrayHeader[$data_ScheduleShiftAssignment['shift_pattern_id']] = $data_ScheduleShiftAssignment;

			$this->session->set_userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique'], $dataArrayHeader);

			$data_ScheduleShiftAssignment = $this->session->userdata('addScheduleShiftAssignment-' . $unique['unique']);

			$data_ScheduleShiftAssignment['shift_pattern_id']					= '';
			$data_ScheduleShiftAssignment['shift_assignment_cycle']				= '';

			$this->session->set_userdata('addScheduleShiftAssignment-' . $unique['unique'], $data_ScheduleShiftAssignment);
		} else {
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
			$this->session->set_userdata('message', $msg);
		}
	}

	public function deleteArrayScheduleShiftAssignment()
	{
		$arrayBaru			= array();
		$var_to 			= $this->uri->segment(3);
		$session_name		= "addarrayScheduleShiftAssignmentitem-";
		$unique 			= $this->session->userdata('unique');
		$dataArrayHeader	= $this->session->userdata($session_name . $unique['unique']);
		$unique 			= $this->session->userdata('unique');

		foreach ($dataArrayHeader as $key => $val) {
			if ($key != $var_to) {
				$arrayBaru[$key] = $val;
			}
		}

		$this->session->set_userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique'], $arrayBaru);

		redirect('ScheduleShiftAssignment/addScheduleShiftAssignment/');
	}

	public function processAddScheduleShiftAssignment()
	{
		$this->load->model('ScheduleShiftAssignment_model');

		$auth 		= $this->session->userdata('auth');
		$unique 	= $this->session->userdata('unique');

		$data = array(
			'region_id' 					=> $auth['region_id'],
			'branch_id'						=> $auth['branch_id'],
			'location_id'					=> $auth['location_id'],
			'division_id'					=> $this->input->post('division_id', true),
			'data_state'					=> 0,
			'created_id'					=> $auth['user_id'],
			'created_on'					=> date('Y-m-d H:i:s'),
		);

		$session_ScheduleShiftAssignmentitem	= $this->session->userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique']);

		$employeeworkingminute 	= $this->ScheduleShiftAssignment_model->getEmployeeWorkingMinute();

		// print_r("minute :");
		// print($employeeworkingminute);

		/*$employee_late_minute 		= $employee_late_minute." minutes";*/

		/*$date = date("Y-m-d H:i:s");
			$time = strtotime($date);
			$time = $time - (15 * 60);
			$date = date("Y-m-d H:i:s", $time);*/

		/*print_r("created_on ");
			print_r($data['created_on']);
			print_r("<BR>");
			print_r("employee_meal_coupon_date1 ");
			print_r($employee_meal_coupon_date1);
			print_r("<BR>");
			print_r("employee_meal_coupon_date2 ");
			print_r($employee_meal_coupon_date2);
			print_r("<BR>");
			print_r("employee_meal_coupon_date ");
			print_r($employee_meal_coupon_date);
			print_r("<BR>");
			print_r("startdate ");
			print_r($startdate);
			exit;*/

		/*print_r("session_ScheduleShiftAssignmentitem ");
			print_r($session_ScheduleShiftAssignmentitem);
			print_r("<BR>");
			exit;*/

		$this->form_validation->set_rules('division_id', 'Division Name', 'required');

		$last_date 	= date("2042-06-01");
		$now_date 	= date("Y-m-d");

		if ($this->form_validation->run() == true) {
			if ($now_date >= $last_date) {
				$msg = "<div class='alert alert-danger'>          
								UNAUTHORIZED INPUT !!!
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";


				$this->session->unset_userdata('addScheduleShiftAssignment-' . $unique['unique']);
				$this->session->unset_userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique']);
				$this->session->set_userdata('message', $msg);
				$this->session->unset_userdata('addcoreshift');
				redirect('ScheduleShiftAssignment/addScheduleShiftAssignment');
			} else {
				if ($this->ScheduleShiftAssignment_model->insertScheduleShiftAssignment($data)) {
					$unique 	= $this->session->userdata('unique');
					$auth = $this->session->userdata('auth');

					$shift_assignment_id = $this->ScheduleShiftAssignment_model->getShiftAssignmentID($data['created_id']);

					foreach ($session_ScheduleShiftAssignmentitem as $keyShiftAssignmentItem => $valShiftAssignmentItem) {
						$data_ScheduleShiftAssignmentitem = array(
							'shift_assignment_id'			=> $shift_assignment_id,
							'shift_pattern_id'				=> $valShiftAssignmentItem['shift_pattern_id'],
							'shift_assignment_start_date'	=> tgltodb($valShiftAssignmentItem['shift_assignment_start_date']),
							'shift_assignment_cycle'		=> $valShiftAssignmentItem['shift_assignment_cycle'],
						);

						$this->ScheduleShiftAssignment_model->insertScheduleShiftAssignmentItem($data_ScheduleShiftAssignmentitem);

						$data_scheduleshiftpattern 		= $this->ScheduleShiftAssignment_model->getScheduleShiftPattern_Detail($valShiftAssignmentItem['shift_pattern_id']);

						$data_scheduleshiftpatternitem	= $this->ScheduleShiftAssignment_model->getScheduleShiftPatternItem_Detail($valShiftAssignmentItem['shift_pattern_id']);

						/*print_r("data_scheduleshiftpatternitem ");
							print_r($data_scheduleshiftpatternitem);
							exit;*/

						$i 						= 1;
						$shift_pattern_weekly 	= $data_scheduleshiftpattern['shift_pattern_weekly'];
						$shift_pattern_cycle 	= $data_scheduleshiftpattern['shift_pattern_cycle'];
						$shift_pattern_day 		= $data_scheduleshiftpattern['shift_pattern_day'];
						$date 					= $valShiftAssignmentItem['shift_assignment_start_date'];
						$startdate 				= strtotime('-1 day', strtotime($date));
						$startdate 				= date("Y-m-d", $startdate);
						$shift_cycle 			= 1;

						$schedule_day 			= $this->configuration->ShiftPatternDayShift($shift_pattern_day);

						$data_scheduleemployeeschedule = array(
							'shift_assignment_id'		=> $shift_assignment_id,
							'shift_pattern_id'			=> $valShiftAssignmentItem['shift_pattern_id'],
							'data_state'				=> 0,
							'created_id'				=> $auth['user_id'],
							'created_on'				=> date('Y-m-d H:i:s'),
						);

						/*print_r("startdate awal ");
							print_r($startdate);

							print_r("date ");
							print_r($date);
							print_r("<BR>");
							print_r("startdate ");
							print_r($startdate);
							exit;*/

						$this->ScheduleShiftAssignment_model->insertScheduleEmployeeSchedule($data_scheduleemployeeschedule);

						$employee_schedule_id = $this->ScheduleShiftAssignment_model->getEmployeeScheduleID($data_scheduleemployeeschedule['created_id']);

						$j 			= 1;
						$day_off 	= 0;

						for ($j = 1; $j <= $valShiftAssignmentItem['shift_assignment_cycle']; $j++) {
							foreach ($data_scheduleshiftpatternitem as $key => $val) {
								$scheduleemployeeshiftitem = $this->ScheduleShiftAssignment_model->getScheduleEmployeeShiftItem_Detail($val['employee_shift_id']);
								//print("data");
								//print_r($scheduleemployeeshiftitem);
								// exit;
								for ($a = 1; $a <= $shift_pattern_cycle; $a++) {
									$from 	= mktime(0, 0, 0, date("m", strtotime($startdate)), date("d", strtotime($startdate)) + $a, date("Y", strtotime($startdate)));

									$from 	= date("Y-m-d", $from);
									$day 	= date("D", strtotime($from));

									if ($shift_pattern_day == 0) {
										## Start Working 
										$employee_schedule_item_date = $from . " " . $val['start_working_hour'];

										$employee_schedule_item_in_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

										$employee_schedule_item_in_end_date1 	= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

										$employee_schedule_item_in_start_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_start_date1);

										$employee_schedule_item_in_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_end_date1);

										## End Working

										if ($val['shift_next_day'] == 0) {
											$employee_schedule_item_date = $from . " " . $val['end_working_hour'];
										} else {
											$date 		= date_create($from);
											date_add($date, date_interval_create_from_date_string("1 days"));
											$start_from	= date_format($date, "Y-m-d");

											$employee_schedule_item_date = $start_from . " " . $val['end_working_hour'];
										}


										$employee_schedule_item_out_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

										$employee_schedule_item_out_end_date1 		= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

										$employee_schedule_item_out_start_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_start_date1);

										$employee_schedule_item_out_end_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_end_date1);

										foreach ($scheduleemployeeshiftitem as $key2 => $val2) {
											$data_scheduleemployeescheduleitem = array(
												'employee_schedule_id'						=> $employee_schedule_id,
												'shift_assignment_id'						=> $shift_assignment_id,
												'employee_shift_id'							=> $val['employee_shift_id'],
												'shift_id'									=> $val['shift_id'],
												'region_id'									=> $val2['region_id'],
												'branch_id'									=> $val2['branch_id'],
												'location_id'								=> $val2['location_id'],
												'division_id'								=> $val2['division_id'],
												'department_id'								=> $val2['department_id'],
												'section_id'								=> $val2['section_id'],
												'unit_id'									=> $val2['unit_id'],
												'employee_id'								=> $val2['employee_id'],
												'employee_rfid_code'						=> $val2['employee_rfid_code'],
												'employee_schedule_item_date'				=> $from,
												'employee_schedule_item_in_start_date'		=> $employee_schedule_item_in_start_date,
												'employee_schedule_item_in_end_date'		=> $employee_schedule_item_in_end_date,
												'employee_schedule_item_out_start_date'		=> $employee_schedule_item_out_start_date,
												'employee_schedule_item_out_end_date'		=> $employee_schedule_item_out_end_date,
												'employee_schedule_item_status'				=> 9,
												'employee_schedule_item_status_default'		=> 9,
											);

											$this->ScheduleShiftAssignment_model->insertScheduleEmployeeScheduleItem($data_scheduleemployeescheduleitem);

											if ($val['shift_next_day'] == 1) {
												$data_scheduleemployeescheduleshift = array(
													'employee_schedule_id'						=> $employee_schedule_id,
													'shift_assignment_id'						=> $shift_assignment_id,
													'employee_shift_id'							=> $val['employee_shift_id'],
													'shift_id'									=> $val['shift_id'],
													'region_id'									=> $val2['region_id'],
													'branch_id'									=> $val2['branch_id'],
													'location_id'								=> $val2['location_id'],
													'division_id'								=> $val2['division_id'],
													'department_id'								=> $val2['department_id'],
													'section_id'								=> $val2['section_id'],
													'unit_id'									=> $val2['unit_id'],
													'employee_id'								=> $val2['employee_id'],
													'employee_rfid_code'						=> $val2['employee_rfid_code'],
													'employee_schedule_shift_date'				=> $from,
												);

												$this->ScheduleShiftAssignment_model->insertScheduleEmployeeScheduleShift($data_scheduleemployeescheduleshift);
											}
										}
									} else {
										if ($schedule_day == $day) {
											## Start Working 
											$employee_schedule_item_date = $from . " " . $val['start_working_hour'];

											$employee_schedule_item_in_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

											$employee_schedule_item_in_end_date1 	= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

											$employee_schedule_item_in_start_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_start_date1);

											$employee_schedule_item_in_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_end_date1);

											## End Working

											if ($val['shift_next_day'] == 0) {
												$employee_schedule_item_date = $from . " " . $val['end_working_hour'];
											} else {
												$date 		= date_create($from);
												date_add($date, date_interval_create_from_date_string("1 days"));
												$start_from	= date_format($date, "Y-m-d");

												$employee_schedule_item_date = $start_from . " " . $val['end_working_hour'];
											}


											$employee_schedule_item_out_start_date1 	= strtotime($employee_schedule_item_date) - ($employeeworkingminute['employee_working_in_start_minute'] * 60);

											$employee_schedule_item_out_end_date1 		= strtotime($employee_schedule_item_date) + ($employeeworkingminute['employee_working_in_end_minute'] * 60);

											$employee_schedule_item_out_start_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_start_date1);

											$employee_schedule_item_out_end_date 		= date('Y-m-d H:i:s', $employee_schedule_item_out_end_date1);

											foreach ($scheduleemployeeshiftitem as $key2 => $val2) {
												$data_scheduleemployeescheduleitem = array(
													'employee_schedule_id'						=> $employee_schedule_id,
													'shift_assignment_id'						=> $shift_assignment_id,
													'employee_shift_id'							=> $val['employee_shift_id'],
													'shift_id'									=> $val['shift_id'],
													'region_id'									=> $val2['region_id'],
													'branch_id'									=> $val2['branch_id'],
													'location_id'								=> $val2['location_id'],
													'division_id'								=> $val2['division_id'],
													'department_id'								=> $val2['department_id'],
													'section_id'								=> $val2['section_id'],
													'unit_id'									=> $val2['unit_id'],
													'employee_id'								=> $val2['employee_id'],
													'employee_rfid_code'						=> $val2['employee_rfid_code'],
													'employee_schedule_item_date'				=> $from,
													'employee_schedule_item_in_start_date'		=> $employee_schedule_item_in_start_date,
													'employee_schedule_item_in_end_date'		=> $employee_schedule_item_in_end_date,
													'employee_schedule_item_out_start_date'		=> $employee_schedule_item_out_start_date,
													'employee_schedule_item_out_end_date'		=> $employee_schedule_item_out_end_date,
													'employee_schedule_item_status'				=> 9,
													'employee_schedule_item_status_default'		=> 9,
												);

												$this->ScheduleShiftAssignment_model->insertScheduleEmployeeScheduleItem($data_scheduleemployeescheduleitem);

												if ($val['shift_next_day'] == 1) {
													$data_scheduleemployeescheduleshift = array(
														'employee_schedule_id'						=> $employee_schedule_id,
														'shift_assignment_id'						=> $shift_assignment_id,
														'employee_shift_id'							=> $val['employee_shift_id'],
														'shift_id'									=> $val['shift_id'],
														'region_id'									=> $val2['region_id'],
														'branch_id'									=> $val2['branch_id'],
														'location_id'								=> $val2['location_id'],
														'division_id'								=> $val2['division_id'],
														'department_id'								=> $val2['department_id'],
														'section_id'								=> $val2['section_id'],
														'unit_id'									=> $val2['unit_id'],
														'employee_id'								=> $val2['employee_id'],
														'employee_rfid_code'						=> $val2['employee_rfid_code'],
														'employee_schedule_shift_date'				=> $from,
													);

													$this->ScheduleShiftAssignment_model->insertScheduleEmployeeScheduleShift($data_scheduleemployeescheduleshift);
												}
											}
										}
									}
								}

								if ($i % $shift_pattern_weekly == 0) {
									$shift_cycle++;

									$date 		= date_create($startdate);
									date_add($date, date_interval_create_from_date_string("7 days"));
									$startdate 	= date_format($date, "Y-m-d");
								} else {
								}
								$i++;
							}
						}
					}
					foreach ($data_scheduleshiftpatternitem as $key => $val) {
						$employee_shift_last_schedule_date = $this->ScheduleShiftAssignment_model->getEmployeeScheduleItemDate($val['employee_shift_id']);

						$data_update = array(
							'employee_shift_id'						=> $val['employee_shift_id'],
							'employee_shift_last_schedule_date'		=> $employee_shift_last_schedule_date
						);

						$this->ScheduleShiftAssignment_model->updateScheduleEmployeeShift($data_update);
					}

					## UPDATE DAY OFF

					$data_employeeid_schedule = $this->ScheduleShiftAssignment_model->getEmployeeID_Schedule($shift_assignment_id);

					$last_employee_schedule_item_date = date("Y-m-d", strtotime($this->ScheduleShiftAssignment_model->getLastEmployeeScheduleItemDate($shift_assignment_id)));

					foreach ($data_employeeid_schedule as $keyEmployeeSchedule => $valEmployeeSchedule) {
						$employee_id 	= $valEmployeeSchedule['employee_id'];

						$status_dayoff 	= true;
						$day_off 		= 0;

						while ($status_dayoff == true) {
							$data_employee_dayoff = $this->ScheduleShiftAssignment_model->getHROEmployeeData_DayOff($employee_id);

							$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

							if ($employee_day_off_cycle > 0) {
								$employee_last_day_off1 = $data_employee_dayoff['employee_last_day_off'];

								$employee_schedule_item_id = $this->ScheduleShiftAssignment_model->getScheduleEmployeeItemDate($shift_assignment_id, $employee_id, tgltodb($employee_last_day_off1), tgltodb($last_employee_schedule_item_date));



								if (!empty($employee_schedule_item_id)) {
									$data_update_schedule_item = array(
										'employee_schedule_item_id'				=> $employee_schedule_item_id,
										'employee_schedule_item_status' 		=> 0,
										'employee_schedule_item_status_default' => 0
									);

									$this->ScheduleShiftAssignment_model->updateScheduleEmployeeScheduleItem($data_update_schedule_item);

									$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];


									$day_off_cycle 			= explode("#", $employee_day_off_cycle);
									$count_day_off 			= count($day_off_cycle);

									$employee_last_day_off2 = date_create($employee_last_day_off1);

									if ($count_day_off == 1) {
										date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));
									} else {
										date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));

										$day_off++;

										$last_day_off = $count_day_off - 1;

										if ($day_off == $last_day_off) {
											$day_off = 0;
										} else {
										}
									}

									$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

									$data_update_hro_employee_data = array(
										'employee_id'			=> $employee_id,
										'employee_last_day_off'	=> $employee_last_day_off,
									);

									$this->ScheduleShiftAssignment_model->updateHROEmployeeData_DayOff($data_update_hro_employee_data);
								} else {
									$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

									$day_off_cycle 			= explode("#", $employee_day_off_cycle);
									$count_day_off 			= count($day_off_cycle);

									$employee_last_day_off2 = date_create($employee_last_day_off1);

									if ($count_day_off == 1) {
										date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));
									} else {
										date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));

										$day_off++;

										$last_day_off = $count_day_off - 1;

										if ($day_off == $last_day_off) {
											$day_off = 0;
										} else {
										}
									}

									$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

									$data_update_hro_employee_data = array(
										'employee_id'			=> $employee_id,
										'employee_last_day_off'	=> $employee_last_day_off
									);

									$this->ScheduleShiftAssignment_model->updateHROEmployeeData_DayOff($data_update_hro_employee_data);

									$data_update_schedule_item = array(
										'employee_schedule_item_id'				=> $employee_schedule_item_id,
										'employee_schedule_item_status_default' => 0,
										'employee_schedule_item_status' 		=> 0
									);

									$this->ScheduleShiftAssignment_model->updateScheduleEmployeeScheduleItem($data_update_schedule_item);
								}

								if ($employee_last_day_off > $last_employee_schedule_item_date) {
									$status_dayoff = false;
								}
							} else {
								$status_dayoff = false;
							}
						}
					}

					## UPDATE DAY OFF FROM SCHEDULE DAY OFF
					$data_employeeid_status = $this->ScheduleShiftAssignment_model->getHROEmployeeData_DayOffStatus();

					$scheduledayoffitem 	= $this->ScheduleShiftAssignment_model->getScheduleDayOffItem();

					foreach ($data_employeeid_status as $keyDayOffStatus => $valDayOffStatus) {
						$employee_id 	= $valDayOffStatus['employee_id'];

						foreach ($scheduledayoffitem as $keyDayOffItem => $valDayOffItem) {
							$data_updatedayoff = array(
								'employee_id'					=> $employee_id,
								'employee_schedule_item_date'	=> tgltodb($valDayOffItem['day_off_item_date']),
								'employee_schedule_item_status'	=> 0
							);

							$this->ScheduleShiftAssignment_model->updateScheduleEmployeeScheduleItem_DayOff($data_updatedayoff);
						}
					}

					$this->fungsi->set_log($auth['username'], '1003', 'Application.coreshift.processaddcoreshift', $auth['username'], 'Add New coreshift');
					$msg = "<div class='alert alert-success'>                
									Add Data Shift Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";


					$this->session->unset_userdata('addScheduleShiftAssignment-' . $unique['unique']);
					$this->session->unset_userdata('addarrayScheduleShiftAssignmentitem-' . $unique['unique']);
					$this->session->set_userdata('message', $msg);
					$this->session->unset_userdata('addcoreshift');
					redirect('ScheduleShiftAssignment/addScheduleShiftAssignment');
				} else {
					$msg = "<div class='alert alert-danger'>
									Add Data Shift UnSuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message', $msg);
					redirect('ScheduleShiftAssignment/addScheduleShiftAssignment');
				}
			}
		} else {
			$this->session->set_userdata('addcoreshift', $data);
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
			$this->session->set_userdata('message', $msg);
			redirect('ScheduleShiftAssignment/addScheduleShiftAssignment');
		}
	}

	public function updateDayOff()
	{
		$shift_assignment_id 	= 68;
		$shift_assignment_cycle = 5;
		$shift_pattern_cycle 	= 6;

		$data_employeeid_schedule = $this->ScheduleShiftAssignment_model->getEmployeeID_Schedule($shift_assignment_id);

		$last_employee_schedule_item_date = date("Y-m-d", strtotime($this->ScheduleShiftAssignment_model->getLastEmployeeScheduleItemDate($shift_assignment_id)));

		foreach ($data_employeeid_schedule as $keyEmployeeSchedule => $valEmployeeSchedule) {
			$employee_id 	= $valEmployeeSchedule['employee_id'];

			$status_dayoff 	= true;
			$day_off 		= 0;

			while ($status_dayoff == true) {
				$data_employee_dayoff = $this->ScheduleShiftAssignment_model->getHROEmployeeData_DayOff($employee_id);

				$employee_last_day_off1 = $data_employee_dayoff['employee_last_day_off'];

				$employee_schedule_item_id = $this->ScheduleShiftAssignment_model->getScheduleEmployeeItemDate($shift_assignment_id, $employee_id, tgltodb($employee_last_day_off1), tgltodb($last_employee_schedule_item_date));

				if ($employee_id == 10272) {
					print_r("employee_schedule_item_id ");
					print_r($employee_schedule_item_id);
					/*exit;*/
				}

				if (!empty($employee_schedule_item_id)) {
					$data_update_schedule_item = array(
						'employee_schedule_item_id'		=> $employee_schedule_item_id,
						'employee_schedule_item_status' => 0
					);

					$this->ScheduleShiftAssignment_model->updateScheduleEmployeeScheduleItem($data_update_schedule_item);

					$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

					$day_off_cycle 			= explode("#", $employee_day_off_cycle);
					$count_day_off 			= count($day_off_cycle);

					$employee_last_day_off2 = date_create($employee_last_day_off1);

					if ($count_day_off == 1) {
						date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));
					} else {
						date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));

						$day_off++;

						$last_day_off = $count_day_off - 1;

						if ($day_off == $last_day_off) {
							$day_off = 0;
						} else {
						}
					}

					$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

					$data_update_hro_employee_data = array(
						'employee_id'			=> $employee_id,
						'employee_last_day_off'	=> $employee_last_day_off,
					);

					$this->ScheduleShiftAssignment_model->updateHROEmployeeData_DayOff($data_update_hro_employee_data);
				} else {
					$employee_day_off_cycle	= $data_employee_dayoff['employee_day_off_cycle'];

					$day_off_cycle 			= explode("#", $employee_day_off_cycle);
					$count_day_off 			= count($day_off_cycle);

					$employee_last_day_off2 = date_create($employee_last_day_off1);

					if ($count_day_off == 1) {
						date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));
					} else {
						date_add($employee_last_day_off2, date_interval_create_from_date_string("" . $day_off_cycle[$day_off] . " days"));

						$day_off++;

						$last_day_off = $count_day_off - 1;

						if ($day_off == $last_day_off) {
							$day_off = 0;
						} else {
						}
					}

					$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

					$data_update_hro_employee_data = array(
						'employee_id'			=> $employee_id,
						'employee_last_day_off'	=> $employee_last_day_off
					);

					$this->ScheduleShiftAssignment_model->updateHROEmployeeData_DayOff($data_update_hro_employee_data);

					$data_update_schedule_item = array(
						'employee_schedule_item_id'		=> $employee_schedule_item_id,
						'employee_schedule_item_status' => 0
					);

					$this->ScheduleShiftAssignment_model->updateScheduleEmployeeScheduleItem($data_update_schedule_item);
				}

				if ($employee_last_day_off > $last_employee_schedule_item_date) {
					$status_dayoff = false;
				}
			}
		}

		/*print_r("data_employeeid_schedule ");
			print_r($data_employeeid_schedule);
			exit;*/
	}

	public function showdetail()
	{
		$shift_assignment_id = $this->uri->segment(3);

		$data['main_view']['ScheduleShiftAssignment']		= $this->ScheduleShiftAssignment_model->getScheduleShiftAssignment_Detail($shift_assignment_id);
		$data['main_view']['ScheduleShiftAssignmentitem']	= $this->ScheduleShiftAssignment_model->getScheduleShiftAssignmentData_Detail($shift_assignment_id);
		$data['main_view']['content']						= 'ScheduleShiftAssignment/detailScheduleShiftAssignment_view';
		$this->load->view('MainPage_view', $data);
	}

	public function deleteScheduleShiftAssignment()
	{
		$shift_assignment_id = $this->uri->segment(3);

		$data['main_view']['ScheduleShiftAssignment']		= $this->ScheduleShiftAssignment_model->getScheduleShiftAssignment_Detail($shift_assignment_id);

		$data['main_view']['ScheduleShiftAssignmentitem']	= $this->ScheduleShiftAssignment_model->getScheduleShiftAssignmentData_Detail($shift_assignment_id);

		$data['main_view']['content']						= 'ScheduleShiftAssignment/FormDeleteScheduleShiftAssignment_view';

		$this->load->view('MainPage_view', $data);
	}

	public function deleteCoreOvertimeType()
	{
		if ($this->coreovertimetype_model->deleteCoreOvertimeType($this->uri->segment(3))) {
			$auth = $this->session->userdata('auth');
			$this->fungsi->set_log($auth['username'], '1005', 'Application.CoreOvertimeType.delete', $auth['username'], 'Delete Overtime Type');
			$msg = "<div class='alert alert-success'>                
							Delete Data Overtime Type Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message', $msg);
			redirect('coreovertimetype');
		} else {
			$msg = "<div class='alert alert-danger'>                
							Delete Data Overtime Type UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message', $msg);
			redirect('coreovertimetype');
		}
	}

	public function reset_search()
	{
		$sesi = $this->session->userdata('filter-ScheduleShiftAssignment');
		$this->session->unset_userdata('filter-hroemployeelate');
		redirect('ScheduleShiftAssignment');
	}

	public function reset_session()
	{
		$sesi 	= $this->session->userdata('unique');
		$this->session->unset_userdata('addScheduleShiftAssignment-' . $sesi['unique']);
	}























	// public function editScheduleShiftPattern(){
	// 	$data['main_view']['ScheduleShiftAssignment']			= $this->ScheduleShiftAssignment_model->getScheduleShiftPattern_Detail($this->uri->segment(3));
	// 	$data['main_view']['content']			= 'ScheduleShiftAssignment/formeditScheduleShiftAssignment_view';
	// 	$this->load->view('MainPage_view',$data);
	// }

	// public function processEditScheduleShiftPattern(){

	// 	$data = array(
	// 		'shift_id' 				=> $this->input->post('shift_id',true),
	// 		'shift_code' 			=> $this->input->post('shift_code',true),
	// 		'shift_name' 			=> $this->input->post('shift_name',true),
	// 		'start_working_hour'	=> $this->input->post('start_working_hour',true),
	// 		'end_working_hour'		=> $this->input->post('end_working_hour',true),
	// 		'start_rest_hour'		=> $this->input->post('start_rest_hour',true),
	// 		'end_rest_hour'			=> $this->input->post('end_rest_hour',true),
	// 		'due_time_late'			=> $this->input->post('due_time_late',true),
	// 		'shift_remark'			=> $this->input->post('shift_remark',true),
	// 		'data_state'			=> 0
	// 	);

	// 	$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
	// 	$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');

	// 	if($this->form_validation->run()==true){
	// 		if($this->ScheduleShiftAssignment_model->saveEditScheduleShiftPattern($data)==true){
	// 			$auth 	= $this->session->userdata('auth');
	// 			$this->fungsi->set_log($auth['username'],'1077','Application.ScheduleShiftAssignment.edit',$auth['username'],'Edit ScheduleShiftAssignment');
	// 			$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_id']);
	// 			$msg = "<div class='alert alert-success'>                
	// 						Edit Shift Successfully
	// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
	// 			$this->session->set_userdata('message',$msg);
	// 			redirect('ScheduleShiftAssignment/editScheduleShiftAssignment/'.$data['shift_id']);
	// 		}else{
	// 			$msg = "<div class='alert alert-danger'>                
	// 						Edit Shift UnSuccessful
	// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
	// 			$this->session->set_userdata('message',$msg);
	// 			redirect('ScheduleShiftAssignment/editScheduleShiftAssignment/'.$data['shift_id']);
	// 		}
	// 	}else{
	// 		$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
	// 		$this->session->set_userdata('message',$msg);
	// 		redirect('ScheduleShiftAssignment/editScheduleShiftAssignment/'.$data['shift_id']);
	// 	}
	// }

	// public function deleteScheduleShiftAssignment(){
	// 	if($this->ScheduleShiftAssignment_model->deleteScheduleShiftPattern($this->uri->segment(3))){
	// 		$auth = $this->session->userdata('auth');
	// 		$this->fungsi->set_log($auth['username'],'1005','Application.ScheduleShiftAssignment.delete',$auth['username'],'Delete ScheduleShiftAssignment');
	// 		$msg = "<div class='alert alert-success'>                
	// 					Delete Data Shift Successfully
	// 				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
	// 		$this->session->set_userdata('message',$msg);
	// 		redirect('ScheduleShiftAssignment');
	// 	}else{
	// 		$msg = "<div class='alert alert-danger'>                
	// 					Delete Data Shift UnSuccessful
	// 				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
	// 		$this->session->set_userdata('message',$msg);
	// 		redirect('ScheduleShiftAssignment');
	// 	}
	// }
}
