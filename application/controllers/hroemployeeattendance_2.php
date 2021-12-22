<?php
	class hroemployeeattendance extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendance_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$data['main_view']['content']					= 'hroemployeeattendance/formaddhroemployeeattendance_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddHROEmployeeAttendance(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');
			$location_id 	= $auth['location_id'];

			$employee_attendance_date = $this->uri->segment(3);

			print_r("employee_attendance_date ");
			print_r($employee_attendance_date);
			print_r("<BR>");
			/*exit;*/

			/*$this->session->unset_userdata('datashift_employeeattendancedate');*/
			$sesi			= $this->session->userdata('datashift_employeeattendancedate-'.$unique['unique']);

			

			if(!is_array($sesi)){
				$data = array(
					'employee_rfid_code'		=> $this->input->post('employee_rfid_code',true),
				);

				$employee_attendance_date 		= date('Y-m-d');
			} else {
				$employee_attendance_date 		= $sesi['employee_attendance_date'];

				$data = array(
					'employee_rfid_code'		=> $sesi['employee_rfid_code'],
				);	

				print_r("sesi ");
				print_r($sesi);			
			}

			print_r("data ");
			print_r($data);
			print_r("<BR>");
			print_r("employee_attendance_date ");
			print_r($employee_attendance_date);
			print_r("<BR>");
			print_r("sesi ");
			print_r($sesi);
			print_r("<BR>");
			/*exit;*/

			$unique 			= $this->session->userdata('unique');

			$this->session->unset_userdata('addarrayhroemployeeattendance-'.$unique['unique']);

			

			$this->form_validation->set_rules('employee_rfid_code', 'Employee RFID Code', 'required');

			/*$employee_working_minute = $this->hroemployeeattendance_model->getEmployeeWorkingMinute();

			$employee_working_minute = "-".$employee_working_minute." minutes";

			$employee_attendance_date1 	= strtotime($employee_working_minute);
			$employee_attendance_date 	= date('Y-m-d H:i:s', $employee_attendance_date1);*/

			if($this->form_validation->run()==true){				


				$employee_attendance_log 		= date('Y-m-d H:i:s');

				/*$date 							= date_create($employee_attendance_date);
				date_add($date, date_interval_create_from_date_string("-1 days"));
				$employee_schedule_shift_date	= date_format($date, "Y-m-d");

				print_r("employee_attendance_date atas");
				print_r($employee_attendance_date);
				print_r("<BR>");
				print_r("employee_schedule_shift_date atas");
				print_r($employee_schedule_shift_date);
				print_r("<BR>");

				$scheduleemployeescheduleshift 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_attendance_date);

				print_r("scheduleemployeescheduleshift atas");
				print_r($scheduleemployeescheduleshift);
				print_r("<BR>");

				if (empty($scheduleemployeescheduleshift)){
					$employee_attendance_date = $employee_attendance_date;

					$scheduleemployeescheduleshift_yesterday 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

					print_r("scheduleemployeescheduleshift_yesterday");
					print_r($scheduleemployeescheduleshift_yesterday);
					print_r("<BR>");

					$employee_attendance_date 					= $employee_schedule_shift_date;
					$employee_schedule_shift_status 			= 1;
					$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang
				} else {
					if ($scheduleemployeescheduleshift['employee_schedule_shift_status'] == 0){
						$scheduleemployeescheduleshift_yesterday 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

						print_r("scheduleemployeescheduleshift_yesterday");
						print_r($scheduleemployeescheduleshift_yesterday);
						print_r("<BR>");

						if ($scheduleemployeescheduleshift_yesterday['employee_schedule_shift_status'] == 2){
							$employee_attendance_date 					= $employee_schedule_shift_date;
							$employee_schedule_shift_status 			= 1;
							$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang

							print_r("3");
							print_r("<BR>");
						} else if ($scheduleemployeescheduleshift_yesterday['employee_schedule_shift_status'] == 1){
							$employee_attendance_date 					= $employee_schedule_shift_date;
							$employee_schedule_shift_status 			= 1;
							$employee_schedule_shift_status_yesterday 	= 2; ## Sudah Pulang
							print_r("1");
							print_r("<BR>");
						} else {
							$employee_attendance_date 					= $employee_attendance_date;
							$employee_schedule_shift_status 			= 1;
							$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang
							print_r("2");
							print_r("<BR>");
						}
					} else if ($scheduleemployeescheduleshift['employee_schedule_shift_status'] == 1){

						$scheduleemployeescheduleshift_yesterday 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

						if (empty($scheduleemployeescheduleshift_yesterday)){
							$employee_attendance_date 					= $employee_attendance_date;
							$employee_schedule_shift_status 			= 2;
							$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang
						} else {
							if ($scheduleemployeescheduleshift_yesterday['employee_schedule_shift_status'] == 2){
								$employee_attendance_date 					= $employee_schedule_shift_date;
								$employee_schedule_shift_status 			= 2;
								$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang
							} else {
								if ($scheduleemployeescheduleshift_yesterday['employee_schedule_shift_status'] == 3){
									$employee_attendance_date 					= $employee_schedule_shift_date;
									$employee_schedule_shift_status 			= 1;
									$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang
								} else {
									$employee_attendance_date 					= $employee_attendance_date;
									$employee_schedule_shift_status 			= 1;
									$employee_schedule_shift_status_yesterday 	= 2; ## Sudah Pulang
								}
							}
						}
					}
	
				}*/ /*else if ($scheduleemployeescheduleshift['employee_schedule_shift_status'] == 2){

					$scheduleemployeescheduleshift_yesterday 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

					if ($scheduleemployeescheduleshift_yesterday['employee_schedule_shift_status'] == 2){
						$employee_attendance_date 					= $employee_schedule_shift_date;
						$employee_schedule_shift_status 			= 2;
						$employee_schedule_shift_status_yesterday 	= 3; ## Sudah Pulang
					} else {
						if ($scheduleemployeescheduleshift_yesterday['employee_schedule_shift_status'] == 3){
							$employee_attendance_date 					= $employee_schedule_shift_date;
							$employee_schedule_shift_status 			= 1;
							$employee_schedule_shift_status_yesterday 	= 2; ## Sudah Pulang
						} else {
							$employee_attendance_date 					= $employee_attendance_date;
							$employee_schedule_shift_status 			= 1;
							$employee_schedule_shift_status_yesterday 	= 2; ## Sudah Pulang
						}
					}	
				}*/



				/*exit;*/


















				/*$scheduleemployeescheduleshift 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);		 

				if (empty($scheduleemployeescheduleshift)){
					$employee_attendance_date 					= $employee_attendance_date;
					$employee_schedule_shift_status 			= 1;
					$employee_schedule_shift_status_yesterday 	= 2;
				} else {
					print_r("employee_schedule_shift_status ");
					print_r($scheduleemployeescheduleshift['employee_schedule_shift_status']);
					print_r("<BR>");					
					if ($scheduleemployeescheduleshift['employee_schedule_shift_status'] == 3){
						## Sudah Pulang - Ambil Data Hari Ini
						$scheduleemployeescheduleshift 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_attendance_date);		 				

						if (empty($scheduleemployeescheduleshift)){
							$employee_attendance_date 						= $employee_attendance_date;
						} else {
							if ($scheduleemployeescheduleshift['employee_schedule_shift_status'] == 0){
								## Belum Absen
								$employee_attendance_date 					= $employee_attendance_date;
								$employee_schedule_shift_status 			= $employee_schedule_shift_status;
								$employee_schedule_shift_status_yesterday 	= $employee_schedule_shift_status_yesterday; ## Sudah Pulang
							} else {
								
							}
						}
					} else  {
						$employee_schedule_shift_status 			= 1;
						$employee_schedule_shift_status_yesterday 	= 2; 
						$employee_attendance_date 					= $employee_schedule_shift_date;	
					}
				}*/

				$scheduleemployeescheduleitem 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleItem($data['employee_rfid_code'], $location_id, $employee_attendance_date);

				print_r("employee_attendance_date");
				print_r($employee_attendance_date);
				print_r("<BR>");
				print_r("employee_attendance_log");
				print_r($employee_attendance_log);
				print_r("<BR>");
				print_r("scheduleemployeescheduleshift");
				print_r($scheduleemployeescheduleshift['employee_schedule_shift_status']);
				print_r("<BR>");
				print_r("employee_schedule_shift_date");
				print_r($employee_schedule_shift_date);
				print_r("<BR>");
				print_r("scheduleemployeescheduleshift");
				print_r($scheduleemployeescheduleshift);
				print_r("<BR>");
				print_r("scheduleemployeescheduleitem");
				print_r($scheduleemployeescheduleitem);
				print_r("<BR>");
				/*exit;*/

				if (!empty($scheduleemployeescheduleitem)){
					$data_hroemployeeattendance = array(
						'region_id'							=> $scheduleemployeescheduleitem['region_id'],
						'branch_id'							=> $scheduleemployeescheduleitem['branch_id'],
						'location_id'						=> $scheduleemployeescheduleitem['location_id'],
						'division_id'						=> $scheduleemployeescheduleitem['division_id'],
						'department_id'						=> $scheduleemployeescheduleitem['department_id'],
						'section_id'						=> $scheduleemployeescheduleitem['section_id'],
						'unit_id'							=> $scheduleemployeescheduleitem['unit_id'],
						'employee_shift_id'					=> $scheduleemployeescheduleitem['employee_shift_id'],
						'employee_id'						=> $scheduleemployeescheduleitem['employee_id'],
						'employee_rfid_code'				=> $scheduleemployeescheduleitem['employee_rfid_code'],
						'employee_attendance_date_status'	=> $scheduleemployeescheduleitem['employee_attendance_date_status'],
						'employee_attendance_status'		=> 1,
						'employee_attendance_date'			=> date('Y-m-d'),
					);

					$employee_schedule_item_log_status = $scheduleemployeescheduleitem['employee_schedule_item_log_status'];

					print_r("employee_schedule_item_log_status");
					print_r($employee_schedule_item_log_status);
					print_r("<BR>");
					/*exit;*/

					if ($employee_schedule_item_log_status == 0){
						$employee_schedule_item_in_start_date 	= $scheduleemployeescheduleitem['employee_schedule_item_in_start_date'];
						$employee_schedule_item_out_end_date 	= $scheduleemployeescheduleitem['employee_schedule_item_out_end_date'];

						print_r("employee_schedule_item_in_start_date");
						print_r($employee_schedule_item_in_start_date);
						print_r("<BR>");
						print_r("employee_schedule_item_out_end_date");
						print_r($employee_schedule_item_out_end_date);
						/*exit;*/


						if ($employee_schedule_item_in_start_date <= $employee_attendance_log && $employee_attendance_log <= $employee_schedule_item_out_end_date){

							print_r("<BR>");
							print_r("masuk");
							/*print_r($employee_schedule_item_out_end_date);*/
							/*exit;*/

							if ($this->hroemployeeattendance_model->insertHROEmployeeAttendance($data_hroemployeeattendance)){
								$employee_schedule_item_log_status = 1;

								$data_scheduleemployeesheduleitem = array (
									'employee_schedule_item_id'				=> $scheduleemployeescheduleitem['employee_schedule_item_id'],
									'employee_schedule_item_status'			=> 1,
									'employee_schedule_item_log_in_date'	=> date('Y-m-d H:i:s'),
									'employee_schedule_item_log_status'		=> $employee_schedule_item_log_status,
								);

								$this->hroemployeeattendance_model->updateScheduleEmployeeScheduleItem($data_scheduleemployeesheduleitem);

								$data_scheduleemployeesheduleshift = array (
									'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
									'employee_schedule_shift_status'		=> $employee_schedule_shift_status,
									'employee_schedule_shift_date'			=> $employee_attendance_date,
								);

								$this->hroemployeeattendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);								

								$data_scheduleemployeesheduleshift = array (
									'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
									'employee_schedule_shift_status'		=> $employee_schedule_shift_status_yesterday,
									'employee_schedule_shift_date'			=> $employee_schedule_shift_date,
								);

								$this->hroemployeeattendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);								

								$save = 1;
							} else {
								$save = 0;	
							}
						} else {
							$save = 0;
						}
					} else {
						if ($this->hroemployeeattendance_model->insertHROEmployeeAttendance($data_hroemployeeattendance)){
							$save = 1;

							$data_scheduleemployeesheduleshift = array (
								'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
								'employee_schedule_shift_status'		=> $employee_schedule_shift_status,
								'employee_schedule_shift_date'			=> $employee_attendance_date,
							);

							$this->hroemployeeattendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	

							$data_scheduleemployeesheduleshift = array (
									'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
									'employee_schedule_shift_status'		=> $employee_schedule_shift_status_yesterday,
									'employee_schedule_shift_date'			=> $employee_schedule_shift_date,
								);

							$this->hroemployeeattendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	
						}	
					}

					/*print_r("save ");
					print_r($save);
					exit;*/
					if ($save == 1){
						$hroemployeedata = $this->hroemployeeattendance_model->getHROEmployeeData_Detail($data['employee_rfid_code']);

						$data_hroemployeeattendance_array = array(
							'region_id'			=> $hroemployeedata['region_id'],
							'branch_id'			=> $hroemployeedata['branch_id'],
							'location_id'		=> $hroemployeedata['location_id'],
							'division_id'		=> $hroemployeedata['division_id'],
							'division_name'		=> $hroemployeedata['division_name'],
							'department_id'		=> $hroemployeedata['department_id'],
							'department_name'	=> $hroemployeedata['department_name'],
							'section_id'		=> $hroemployeedata['section_id'],
							'section_name'		=> $hroemployeedata['section_name'],
							'unit_id'			=> $hroemployeedata['unit_id'],
							'unit_name'			=> $hroemployeedata['unit_name'],
							'job_title_id'		=> $hroemployeedata['job_title_id'],
							'job_title_name'	=> $hroemployeedata['job_title_name'],
							'employee_shift_id'	=> $hroemployeedata['employee_shift_id'],
							'employee_id'		=> $hroemployeedata['employee_id'],
							'employee_code'		=> $hroemployeedata['employee_code'],
							'employee_name'		=> $hroemployeedata['employee_name'],
						);

						$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeattendance-'.$unique['unique']);

						$dataArrayHeader = $data_hroemployeeattendance_array;
						
						$this->session->set_userdata('addarrayhroemployeeattendance-'.$unique['unique'],$dataArrayHeader);

						$msg = "<div class='alert alert-success'>                
									Add Data Employee Attendance Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addcoreunit');
						$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
						redirect('hroemployeeattendance');
					} else {
						$date 							= date_create($employee_attendance_date);
						date_add($date, date_interval_create_from_date_string("-1 days"));
						$employee_schedule_shift_date	= date_format($date, "Y-m-d");

						$scheduleemployeescheduleshift 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);


						print_r("scheduleemployeescheduleshift");
						print_r($scheduleemployeescheduleshift);
						print_r("<BR>");
						/*exit;*/

						if (!empty($scheduleemployeescheduleshift)){
							$data_employeeattendancedate = array (
								'employee_rfid_code'		=> $data['employee_rfid_code'],	
								'employee_attendance_date'	=> $employee_schedule_shift_date,
							);

							print_r("data_employeeattendancedate");
							print_r($data_employeeattendancedate);
							print_r("<BR>");
							/*exit;*/

							$dataArrayDate		= $this->session->userdata('datashift_employeeattendancedate-'.$unique['unique']);

							$dataArrayDate 		= $data_employeeattendancedate;
						
							$this->session->set_userdata('datashift_employeeattendancedate-'.$unique['unique'],$dataArrayDate);

							print_r("dataArrayDate");
							print_r($dataArrayDate);
							print_r("<BR>");

							/*exit;*/
							/*$this->processAddHROEmployeeAttendance;*/
							redirect('hroemployeeattendance/processAddHROEmployeeAttendance');
							/*redirect($this->uri->uri_string());*/
						} else {
							$msg = "<div class='alert alert-danger'>                
										Employee Data Can't Tapping
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->unset_userdata('addcoreunit');
							$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
							redirect('hroemployeeattendance');
						}
					}
				} else {
					$date 							= date_create($employee_attendance_date);
					date_add($date, date_interval_create_from_date_string("-1 days"));
					$employee_schedule_shift_date	= date_format($date, "Y-m-d");

					$scheduleemployeescheduleshift 	= $this->hroemployeeattendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

					print_r("scheduleemployeescheduleshift");
					print_r($scheduleemployeescheduleshift);
					print_r("<BR>");

					if (!empty($scheduleemployeescheduleshift)){
						$data_employeeattendancedate = array (
							'employee_rfid_code'		=> $data['employee_rfid_code'],	
							'employee_attendance_date'	=> $employee_schedule_shift_date,
						);

						$dataArrayDate		= $this->session->userdata('datashift_employeeattendancedate-'.$unique['unique']);

						$dataArrayDate 		= $data_employeeattendancedate;
						
						$this->session->set_userdata('datashift_employeeattendancedate-'.$unique['unique'],$dataArrayDate);

						redirect('hroemployeeattendance/processAddHROEmployeeAttendance');
					} else {
						$msg = "<div class='alert alert-danger'>                
									Employee Data Can't Tapping
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addcoreunit');
						$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
						redirect('hroemployeeattendance');
					}
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addcoreunit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
				redirect('hroemployeeattendance');
			}
		}
	}
?>