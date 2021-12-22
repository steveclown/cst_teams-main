<?php
	Class scheduleshiftassignment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('scheduleshiftassignment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 			= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['coredivision']				= $this->scheduleshiftassignment_model->getCoreDivision();
			$data['main_view']['scheduleshiftpattern']		= $this->scheduleshiftassignment_model->getScheduleShiftPattern();
			$data['main_view']['scheduleshiftassignment']	= $this->scheduleshiftassignment_model->getScheduleShiftAssignment($region_id, $branch_id, $location_id);
			$data['main_view']['content']					= 'scheduleshiftassignment/listscheduleshiftassignment_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addScheduleShiftAssignment(){
			$auth 			= $this->session->userdata('auth');

			$data['main_view']['coredivision']			= create_double($this->scheduleshiftassignment_model->getCoreDivision(), 'division_id', 'division_name');
			$data['main_view']['scheduleshiftpattern']	= create_double($this->scheduleshiftassignment_model->getScheduleShiftPattern(), 'shift_pattern_id', 'shift_pattern_name');
			$data['main_view']['content']				= 'scheduleshiftassignment/formaddscheduleshiftassignment_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addscheduleshiftassignment-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addscheduleshiftassignment-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addscheduleshiftassignment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addscheduleshiftassignment-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$header 	= $this->session->userdata('addscheduleshiftassignment-'.$unique['unique']);
			
			$this->session->unset_userdata('addscheduleshiftassignment-'.$unique['unique']);
			$this->session->unset_userdata('addarrayscheduleshiftassignmentitem-'.$unique['unique']);	
			$this->session->unset_userdata($data['created_on']);
			redirect('scheduleshiftassignment/addScheduleShiftAssignment');
		}

		public function processAddArrayScheduleShiftAssignment(){
			$data_scheduleshiftassignment = array(
				'shift_pattern_id'					=> $this->input->post('shift_pattern_id', true),
			);

			$this->form_validation->set_rules('shift_pattern_id', 'Shift Pattern', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayscheduleshiftassignmentitem-'.$unique['unique']);
				
				$dataArrayHeader[$data_scheduleshiftassignment['shift_pattern_id']] = $data_scheduleshiftassignment;
				
				$this->session->set_userdata('addarrayscheduleshiftassignmentitem-'.$unique['unique'],$dataArrayHeader);

				$data_scheduleshiftassignment = $this->session->userdata('addscheduleshiftassignment-'.$unique['unique']);
				
				$data_scheduleshiftassignment['shift_pattern_id']					= '';

				$this->session->set_userdata('addscheduleshiftassignment-'.$unique['unique'], $data_scheduleshiftassignment);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayScheduleShiftAssignment(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayscheduleshiftassignmentitem-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}

			$this->session->set_userdata('addarrayscheduleshiftassignmentitem-'.$unique['unique'],$arrayBaru);
			
			redirect('scheduleshiftassignment/addScheduleShiftAssignment/');
		}

		public function processAddScheduleShiftAssignment(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'region_id' 					=> $auth['region_id'],
				'branch_id'						=> $auth['branch_id'],
				'location_id'					=> $auth['location_id'],
				'division_id'					=> $this->input->post('division_id',true),
				'shift_assignment_start_date'	=> tgltodb($this->input->post('shift_assignment_start_date',true)),
				'shift_assignment_cycle'		=> $this->input->post('shift_assignment_cycle',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date('Y-m-d H:i:s'),	
			);

			$session_scheduleshiftassignmentitem	= $this->session->userdata('addarrayscheduleshiftassignmentitem-'.$unique['unique']);


			$employee_working_minute 	= $this->scheduleshiftassignment_model->getEmployeeWorkingMinute();

			/*$employee_working_minute 	= "-".$employee_working_minute." minutes";*/

			$employee_late_minute 		= $this->scheduleshiftassignment_model->getEmployeeLateMinute();

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
			
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');

			if($this->form_validation->run()==true){
				if($this->scheduleshiftassignment_model->insertScheduleShiftAssignment($data)){
					$unique 	= $this->session->userdata('unique');
					$auth = $this->session->userdata('auth');

					$shift_assignment_id = $this->scheduleshiftassignment_model->getShiftAssignmentID($data['created_id']);

					foreach ($session_scheduleshiftassignmentitem as $keyShiftAssignmentItem => $valShiftAssignmentItem) {
						$data_scheduleshiftassignmentitem = array (
							'shift_assignment_id'		=> $shift_assignment_id,
							'shift_pattern_id'			=> $valShiftAssignmentItem['shift_pattern_id'],
						);

						$this->scheduleshiftassignment_model->insertScheduleShiftAssignmentItem($data_scheduleshiftassignmentitem);

						$data_scheduleshiftpattern 		= $this->scheduleshiftassignment_model->getScheduleShiftPattern_Detail($valShiftAssignmentItem['shift_pattern_id']);

						$data_scheduleshiftpatternitem	= $this->scheduleshiftassignment_model->getScheduleShiftPatternItem_Detail($valShiftAssignmentItem['shift_pattern_id']);

						$i 						= 1;
						$shift_pattern_weekly 	= $data_scheduleshiftpattern['shift_pattern_weekly'];
						$shift_pattern_cycle 	= $data_scheduleshiftpattern['shift_pattern_cycle'];
						$shift_pattern_day 		= $data_scheduleshiftpattern['shift_pattern_day'];
						$date 					= $data['shift_assignment_start_date'];
						$startdate 				= strtotime('-1 day', strtotime($date));
						$startdate 				= date("Y-m-d", $startdate);
						$shift_cycle 			= 1;

						$data_scheduleemployeeschedule = array(
							'shift_assignment_id'		=> $shift_assignment_id,
							'shift_pattern_id'			=> $valShiftAssignmentItem['shift_pattern_id'],
							'data_state'				=> 0,
							'created_id'				=> $auth['user_id'],
							'created_on'				=> date('Y-m-d- H:i:s'),
						);

						/*print_r("startdate awal ");
						print_r($startdate);

						print_r("date ");
						print_r($date);
						print_r("<BR>");
						print_r("startdate ");
						print_r($startdate);
						exit;*/

						$this->scheduleshiftassignment_model->insertScheduleEmployeeSchedule($data_scheduleemployeeschedule);

						$employee_schedule_id = $this->scheduleshiftassignment_model->getEmployeeScheduleID($data_scheduleemployeeschedule['created_id']);

						$j 			= 1;
						$day_off 	= 0;

						for ($j = 1; $j<=$data['shift_assignment_cycle']; $j++){
							foreach ($data_scheduleshiftpatternitem as $key => $val) {
								$scheduleemployeeshiftitem = $this->scheduleshiftassignment_model->getScheduleEmployeeShiftItem_Detail($val['employee_shift_id']);

								for($a=1; $a<=$shift_pattern_cycle; $a++){
									$from 	= mktime(0,0,0,date("m",strtotime($startdate)),date("d",strtotime($startdate))+$a,date("Y",strtotime($startdate)));

									if ($shift_pattern_day == 0){
										$from 	= date("Y-m-d", $from);
										$day 	= date("D", strtotime($from));

										$employee_schedule_item_date = $from." ".$val['start_working_hour'];

										$employee_schedule_item_start_date1 = strtotime($employee_schedule_item_date) - ($employee_working_minute * 60);

										$employee_schedule_item_end_date1 	= strtotime($employee_schedule_item_date) + ($employee_late_minute * 60);

										$employee_schedule_item_start_date 	= date('Y-m-d H:i:s', $employee_schedule_item_start_date1);

										$employee_schedule_item_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_end_date1);
										
										foreach ($scheduleemployeeshiftitem as $key2 => $val2) {
											$employeedayoff = $this->scheduleshiftassignment_model->getHROEmployeeData_DayOff($val2['employee_id']);

											$employee_last_day_off1 = $employeedayoff['employee_last_day_off'];

											if ($val2['employee_id'] == 10272){
												print_r("employeedayoff ");
												print_r($employeedayoff);
												print_r("<BR>");
												print_r("<BR>");

												print_r("employee_last_day_off1 atas ");
												print_r($employee_last_day_off1);
												print_r("<BR>");
												print_r("<BR>");
											}


											$employee_day_off_cycle	= $employeedayoff['employee_day_off_cycle'];

											$day_off_cycle 			= explode("#", $employee_day_off_cycle);
											$count_day_off 			= count($day_off_cycle);

											$employee_last_day_off2 = date_create($employee_last_day_off1);

											if ($count_day_off == 1){
												date_add($employee_last_day_off2, date_interval_create_from_date_string("".$day_off_cycle[$day_off]." days"));
											}

											$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

											/*print_r("employee_schedule_item_date atas ");
											print_r($employee_schedule_item_date);
											print_r("<BR>");
											print_r("<BR>");*/

											if ($from == $employee_last_day_off){
												$employee_schedule_item_status = 0;

												$data_update_dayoff = array (
													'employee_id'			=> $val2['employee_id'],
													'employee_last_day_off'	=> $employee_last_day_off,
												);

												if ($val2['employee_id'] == 10272){
													print_r("employee_day_off_cycle ");
													print_r($employee_day_off_cycle);
													print_r("<BR>");
													print_r("<BR>");

													print_r("day_off_cycle ");
													print_r($day_off_cycle);
													print_r("<BR>");
													print_r("<BR>");

													print_r("day_off ");
													print_r($day_off);
													print_r("<BR>");
													print_r("<BR>");

													print_r("from ");
													print_r($from);
													print_r("<BR>");
													print_r("<BR>");

													print_r("employee_last_day_off1 ");
													print_r($employee_last_day_off1);
													print_r("<BR>");
													print_r("<BR>");

													print_r("employee_last_day_off2 ");
													print_r($employee_last_day_off2);
													print_r("<BR>");
													print_r("<BR>");

													print_r("employee_last_day_off ");
													print_r($employee_last_day_off);
													print_r("<BR>");
													print_r("<BR>");

													print_r("data_update_dayoff ");
													print_r($data_update_dayoff);
													print_r("<BR>");
													print_r("<BR>");

													exit;
												}

												if ($this->scheduleshiftassignment_model->updateHROEmployeeData_DayOff($data_update_dayoff)){

												} else {
													exit;
												}
											} else {
												$employee_schedule_item_status = 1;
											}

											
											if ($val2['employee_id'] == 10272 && $from == '2018-04-07'){
												print_r("from ");
												print_r($from);
												print_r("<BR>");
												print_r("<BR>");

												print_r("day_off_cycle ");
												print_r($day_off_cycle);
												print_r("<BR>");
												print_r("<BR>");

												print_r("count_day_off ");
												print_r($count_day_off);
												print_r("<BR>");
												print_r("<BR>");

												print_r("employee_last_day_off1 ");
												print_r($employee_last_day_off1);
												print_r("<BR>");
												print_r("<BR>");

												print_r("employee_last_day_off ");
												print_r($employee_last_day_off);
												print_r("<BR>");
												print_r("<BR>");

												exit;
											}

											$data_scheduleemployeescheduleitem = array (
												'employee_schedule_id'				=> $employee_schedule_id,
												'employee_shift_id'					=> $val['employee_shift_id'],
												'shift_id'							=> $val['shift_id'],
												'employee_id'						=> $val2['employee_id'],
												'employee_schedule_item_status'		=> $employee_schedule_item_status,
												'employee_schedule_item_date'		=> $employee_schedule_item_date,
												'employee_schedule_item_start_date'	=> $employee_schedule_item_start_date,
												'employee_schedule_item_end_date'	=> $employee_schedule_item_end_date,
											);
											
											$this->scheduleshiftassignment_model->insertScheduleEmployeeScheduleItem($data_scheduleemployeescheduleitem);
										}
									} else {
										$from 	= date("Y-m-d", $from);
										$day 	= date("l", strtotime($from));

										if ($day == $this->configuration->ShiftPatternDay[$shift_pattern_day]){
											$employee_schedule_item_date = $from." ".$val['start_working_hour'];

											$employee_schedule_item_start_date1 = strtotime($employee_schedule_item_date) - ($employee_working_minute * 60);

											$employee_schedule_item_end_date1 	= strtotime($employee_schedule_item_date) + ($employee_late_minute * 60);

											$employee_schedule_item_start_date 	= date('Y-m-d H:i:s', $employee_schedule_item_start_date1);

											$employee_schedule_item_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_end_date1);
											
											foreach ($scheduleemployeeshiftitem as $key2 => $val2) {
												$employeedayoff = $this->scheduleshiftassignment_model->getHROEmployeeData_DayOff($val2['employee_id']);

												/*print_r("employeedayoff ");
												print_r($employeedayoff);
												print_r("<BR>");
												print_r("<BR>");*/

												$employee_last_day_off1 = $employeedayoff['employee_last_day_off'];

												/*print_r("employee_last_day_off1 atas ");
												print_r($employee_last_day_off1);
												print_r("<BR>");
												print_r("<BR>");*/


												$employee_day_off_cycle	= $employeedayoff['employee_day_off_cycle'];

												$day_off_cycle 			= explode("#", $employee_day_off_cycle);
												$count_day_off 			= count($day_off_cycle);

												$employee_last_day_off2 = date_create($employee_last_day_off1);

												if ($count_day_off == 1){
													date_add($employee_last_day_off2, date_interval_create_from_date_string("".$day_off_cycle[$day_off]." days"));
												}

												$employee_last_day_off 	= date_format($employee_last_day_off2, "Y-m-d");

												/*print_r("employee_schedule_item_date atas ");
												print_r($employee_schedule_item_date);
												print_r("<BR>");
												print_r("<BR>");*/

												if ($from == $employee_last_day_off){
													$employee_schedule_item_status = 0;

													$data_update_dayoff = array (
														'employee_id'			=> $val2['employee_id'],
														'employee_last_day_off'	=> $employee_last_day_off,
													);

													/*print_r("employee_day_off_cycle ");
													print_r($employee_day_off_cycle);
													print_r("<BR>");
													print_r("<BR>");

													print_r("day_off_cycle ");
													print_r($day_off_cycle);
													print_r("<BR>");
													print_r("<BR>");

													print_r("day_off ");
													print_r($day_off);
													print_r("<BR>");
													print_r("<BR>");

													print_r("from ");
													print_r($from);
													print_r("<BR>");
													print_r("<BR>");

													print_r("employee_last_day_off1 ");
													print_r($employee_last_day_off1);
													print_r("<BR>");
													print_r("<BR>");

													print_r("employee_last_day_off2 ");
													print_r($employee_last_day_off2);
													print_r("<BR>");
													print_r("<BR>");

													print_r("employee_last_day_off ");
													print_r($employee_last_day_off);
													print_r("<BR>");
													print_r("<BR>");

													print_r("data_update_dayoff ");
													print_r($data_update_dayoff);
													print_r("<BR>");
													print_r("<BR>");

													exit;*/

													$this->scheduleshiftassignment_model->updateHROEmployeeData_DayOff($data_update_dayoff);
												} else {
													$employee_schedule_item_status = 1;
												}

												$data_scheduleemployeescheduleitem = array (
													'employee_schedule_id'				=> $employee_schedule_id,
													'employee_shift_id'					=> $val['employee_shift_id'],
													'shift_id'							=> $val['shift_id'],
													'employee_id'						=> $val2['employee_id'],
													'employee_schedule_item_status'		=> $employee_schedule_item_status,
													'employee_schedule_item_date'		=> $employee_schedule_item_date,
													'employee_schedule_item_start_date'	=> $employee_schedule_item_start_date,
													'employee_schedule_item_end_date'	=> $employee_schedule_item_end_date,
												);
												
												$this->scheduleshiftassignment_model->insertScheduleEmployeeScheduleItem($data_scheduleemployeescheduleitem);
											}
										}
									}	
								}

								if ($i % $shift_pattern_weekly == 0){
									$shift_cycle++;

									$date 		= date_create($startdate);
									date_add($date, date_interval_create_from_date_string("7 days"));
									$startdate 	= date_format($date, "Y-m-d");

								} else {

								}
								$i=$i+1;
							}
						}
					}

					$this->fungsi->set_log($auth['username'],'1003','Application.coreshift.processaddcoreshift',$auth['username'],'Add New coreshift');
					$msg = "<div class='alert alert-success'>                
								Add Data Shift Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->unset_userdata('addscheduleshiftassignment-'.$unique['unique']);
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addcoreshift');
					redirect('scheduleshiftassignment/addScheduleShiftAssignment');
				}else{
					$msg = "<div class='alert alert-danger'>
								Add Data Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('scheduleshiftassignment/addScheduleShiftAssignment');
				}
			}else{
				$this->session->set_userdata('addcoreshift',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('scheduleshiftassignment/addScheduleShiftAssignment');
			}
		}

		public function showdetail(){
			$shift_assignment_id = $this->uri->segment(3);

			$data['main_view']['scheduleshiftassignment']	= $this->scheduleshiftassignment_model->getScheduleShiftAssignment_Detail($shift_assignment_id);
			$data['main_view']['scheduleshiftassignmentdata']	= $this->scheduleshiftassignment_model->getScheduleShiftAssignmentData_Detail($shift_assignment_id);
			$data['main_view']['content']					= 'scheduleshiftassignment/detailscheduleshiftassignment_view';
			$this->load->view('mainpage_view',$data);
		}

		

		

		public function reset_search(){
			$sesi= $this->session->userdata('filter-scheduleshiftassignment');
			$this->session->unset_userdata('filter-hroemployeelate');
			redirect('scheduleshiftassignment');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addscheduleshiftassignment-'.$sesi['unique']);	
		}





















		
		
		// public function editScheduleShiftPattern(){
		// 	$data['main_view']['scheduleshiftassignment']			= $this->scheduleshiftassignment_model->getScheduleShiftPattern_Detail($this->uri->segment(3));
		// 	$data['main_view']['content']			= 'scheduleshiftassignment/formeditscheduleshiftassignment_view';
		// 	$this->load->view('mainpage_view',$data);
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
		// 		if($this->scheduleshiftassignment_model->saveEditScheduleShiftPattern($data)==true){
		// 			$auth 	= $this->session->userdata('auth');
		// 			$this->fungsi->set_log($auth['username'],'1077','Application.scheduleshiftassignment.edit',$auth['username'],'Edit scheduleshiftassignment');
		// 			$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_id']);
		// 			$msg = "<div class='alert alert-success'>                
		// 						Edit Shift Successfully
		// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('scheduleshiftassignment/editscheduleshiftassignment/'.$data['shift_id']);
		// 		}else{
		// 			$msg = "<div class='alert alert-danger'>                
		// 						Edit Shift UnSuccessful
		// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('scheduleshiftassignment/editscheduleshiftassignment/'.$data['shift_id']);
		// 		}
		// 	}else{
		// 		$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
		// 		$this->session->set_userdata('message',$msg);
		// 		redirect('scheduleshiftassignment/editscheduleshiftassignment/'.$data['shift_id']);
		// 	}
		// }
				
		// public function deletescheduleshiftassignment(){
		// 	if($this->scheduleshiftassignment_model->deleteScheduleShiftPattern($this->uri->segment(3))){
		// 		$auth = $this->session->userdata('auth');
		// 		$this->fungsi->set_log($auth['username'],'1005','Application.scheduleshiftassignment.delete',$auth['username'],'Delete scheduleshiftassignment');
		// 		$msg = "<div class='alert alert-success'>                
		// 					Delete Data Shift Successfully
		// 				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 		$this->session->set_userdata('message',$msg);
		// 		redirect('scheduleshiftassignment');
		// 	}else{
		// 		$msg = "<div class='alert alert-danger'>                
		// 					Delete Data Shift UnSuccessful
		// 				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 		$this->session->set_userdata('message',$msg);
		// 		redirect('scheduleshiftassignment');
		// 	}
		// }
	}
?>