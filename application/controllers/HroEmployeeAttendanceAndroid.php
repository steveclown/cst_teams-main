<?php
	class HroEmployeeAttendanceAndroid extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeAttendance_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		

		public function index(){					
			$date 				= date("Y-m-d");
			$startdate 			= $date;
			$day_log 			= "day_".date("d", strtotime($startdate));
			
			$image 				= $_POST['image'];
			$type_absen 		= $_POST['type_absen'];			
			$employee_id 		= $_POST['employee_id']; 
			$user_id			= $_POST['user_id'];
			$latitude			= $_POST['lat'];
			$longitude			= $_POST['long'];
			$address			= $_POST['address'];
			$machine_ip_address	= $_POST['dev'];
			$datetime			= date('YmdHi');

			// $image 				= 'image';			
			// $type_absen 		= "in";			
			// $employee_id 		= "11657"; 
			// $user_id			= "15";
			// $latitude			= "2";
			// $longitude			= "1";
			// $machine_ip_address	= "123";

			$realImage = base64_decode($image);
		
			// file_put_contents($pathname, $realImage);
		
			$employee_rfid_code = $this->HroEmployeeAttendance_model->getEmployeeRfidCode($employee_id);
			$location_id 		= $this->HroEmployeeAttendance_model->getEmployeeLocationID($employee_id);

			$employee_attendance_date 		= date('Y-m-d');

			/* start photo absen preference*/		
		
			
			$photoname 		= $datetime.$employee_id.$user_id.$type_absen.".jpg";

			$uploads_dir 	= get_root_path()."/img/absensi_photo/";

					

			/* end photo absen preference*/
			
			if(!empty($employee_rfid_code)){
				$data=array(					
					'employee_photo'            => $realImage,
					'employee_rfid_code'		=> $employee_rfid_code['employee_rfid_code'],
					'location_id'				=> $location_id['location_id'],
				);							
			}
			
			if(!empty($data['employee_rfid_code'])){

				$employee_attendance_log 		= date('Y-m-d H:i:s');				
				$scheduleemployeescheduleitem 	= $this->HroEmployeeAttendance_model->getScheduleEmployeeScheduleItem($data['employee_rfid_code'], $data['location_id'], $employee_attendance_date);
					
				if (!empty($scheduleemployeescheduleitem)){	
					if($type_absen == "in"){

						$data_HroEmployeeAttendance = array(
							'region_id'							=> $scheduleemployeescheduleitem['region_id'],
							'branch_id'							=> $scheduleemployeescheduleitem['branch_id'],
							'location_id'						=> $scheduleemployeescheduleitem['location_id'],
							'division_id'						=> $scheduleemployeescheduleitem['division_id'],
							'department_id'						=> $scheduleemployeescheduleitem['department_id'],
							'section_id'						=> $scheduleemployeescheduleitem['section_id'],
							'unit_id'							=> $scheduleemployeescheduleitem['unit_id'],
							'shift_id'							=> $scheduleemployeescheduleitem['shift_id'],
							'employee_shift_id'					=> $scheduleemployeescheduleitem['employee_shift_id'],
							'employee_id'						=> $scheduleemployeescheduleitem['employee_id'],
							'employee_rfid_code'				=> $scheduleemployeescheduleitem['employee_rfid_code'],
							'employee_attendance_date_status'	=> $scheduleemployeescheduleitem['employee_schedule_item_date_status'],							
							'employee_attendance_log_in_date'	=> date("Y-m-d H:i:s"),
							'employee_attendance_in_status'		=> 1,
							'employee_attendance_date'			=> date('Y-m-d'),
							'machine_ip_address'				=> $machine_ip_address,
							'employee_attendance_location_in'	=> $latitude.', '.$longitude
							
						);
	
						$employee_schedule_item_log_status = $scheduleemployeescheduleitem['employee_schedule_item_log_status'];					

						if ($employee_schedule_item_log_status == 0){
							$employee_schedule_item_in_start_date 	= $scheduleemployeescheduleitem['employee_schedule_item_in_start_date'];
							$employee_schedule_item_out_end_date 	= $scheduleemployeescheduleitem['employee_schedule_item_out_end_date'];
	
							if ($employee_schedule_item_in_start_date <= $employee_attendance_log && $employee_attendance_log <= $employee_schedule_item_out_end_date){
	
								if ($this->HroEmployeeAttendance_model->insertHROEmployeeAttendance($data_HroEmployeeAttendance)){
									$employee_schedule_item_log_status = 1;	
									
									$data_scheduleemployeesheduleitem = array (
										'employee_schedule_item_id'					=> $scheduleemployeescheduleitem['employee_schedule_item_id'],
										'employee_schedule_item_status'				=> 1,
										'employee_schedule_item_log_in_date'		=> date('Y-m-d H:i:s'),
										'employee_schedule_item_log_status'			=> $employee_schedule_item_log_status,
										'employee_schedule_item_photo_in'			=> $photoname,
										'employee_schedule_item_location_lat_in'	=> $latitude,
										'employee_schedule_item_location_long_in'	=> $longitude,
										'employee_schedule_item_address_in'			=> $address,
									);
									//if(!empty($data_scheduleemployeesheduleitem)){
									$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleItem($data_scheduleemployeesheduleitem);
									file_put_contents($uploads_dir.$photoname, $realImage);	
											
									
									//}
									$save = 1;

									$HroEmployeeAttendanceData = $this->HroEmployeeAttendance_model->getHroEmployeeAttendanceData($startdate);	
								
									foreach ($HroEmployeeAttendanceData as $keyEmployeeAttendance => $valEmployeeAttendance) {
										$employee_id 			= $valEmployeeAttendance['employee_id'];
										$employee_attendance_id = $valEmployeeAttendance['employee_attendance_id'];
										$employee_attendance_log_period	= date("Ym", strtotime($startdate));
	
										if ($this->HroEmployeeAttendance_model->getHroEmployeeAttendanceLog($employee_id, $employee_attendance_log_period)){
											$data_employeeattendancelog = array (
												'region_id'							=> $valEmployeeAttendance['region_id'],
												'branch_id'							=> $valEmployeeAttendance['branch_id'],
												'location_id'						=> $valEmployeeAttendance['location_id'],
												'division_id'						=> $valEmployeeAttendance['division_id'],
												'department_id'						=> $valEmployeeAttendance['department_id'],
												'section_id'						=> $valEmployeeAttendance['section_id'],
												'unit_id'							=> $valEmployeeAttendance['unit_id'],
												'shift_id'							=> $valEmployeeAttendance['shift_id'],
												'employee_shift_id'					=> $valEmployeeAttendance['employee_shift_id'],
												'employee_id'						=> $valEmployeeAttendance['employee_id'],
												'employee_rfid_code'				=> $valEmployeeAttendance['employee_rfid_code'],
												'employee_attendance_log_period'	=> $employee_attendance_log_period,
												$day_log							=> $valEmployeeAttendance['employee_attendance_in_status'],
												'created_on'						=> date('Y-m-d H:i:s'),
												'created_id'						=> $user_id,
												//'data_state'						=> 0
											);											

											//if(!empty($data_employeeattendancelog)){
												$this->HroEmployeeAttendance_model->insertHroEmployeeAttendanceLog($data_employeeattendancelog);
											//}
	
										}else{
											$employee_attendance_log_period = date("Ym", strtotime($valEmployeeAttendance['employee_attendance_date']));
											$day_log 						= "day_".date("d", strtotime($valEmployeeAttendance['employee_attendance_date']));
	
											$dataupdate_employeeattendancelog = array (											
												'employee_id'						=> $valEmployeeAttendance['employee_id'],
												'employee_attendance_log_period'	=> $employee_attendance_log_period,
												$day_log							=> $valEmployeeAttendance['employee_attendance_in_status'],
	
											);	

											//if(!empty($dataupdate_employeeattendancelog)){
												$this->HroEmployeeAttendance_model->updateHroEmployeeAttendanceLog($dataupdate_employeeattendancelog);
											//}
											$save=1;								
										}	
									}
										
								} else {
									$save = 0;	
								}
								
							} else {
								$save = 9;
							}
							
						} else {
							
							if ($this->HroEmployeeAttendance_model->insertHROEmployeeAttendance($data_HroEmployeeAttendance)){
								$save = 3;
	
								// $data_scheduleemployeesheduleshift = array (
								// 	'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
								// 	'employee_schedule_shift_status'		=> $employee_schedule_shift_status,								
								// 	'employee_schedule_shift_date'			=> $employee_attendance_date,
								// );
	
								// $this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	
	
								// $data_scheduleemployeesheduleshift = array (
								// 		'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
								// 		'employee_schedule_shift_status'		=> $employee_schedule_shift_status_yesterday,	
								// 		'employee_schedule_shift_date'			=> $employee_attendance_date,
								// 	);
	
								// $this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	
							}	
						}

					}else if($type_absen == "out"){
						$employee_schedule_item_log_status = $scheduleemployeescheduleitem['employee_schedule_item_log_status'];					
						// echo $employee_schedule_item_log_status;
						// exit;
						$data_HroEmployeeAttendance = array(
							'region_id'							=> $scheduleemployeescheduleitem['region_id'],
							'branch_id'							=> $scheduleemployeescheduleitem['branch_id'],
							'location_id'						=> $scheduleemployeescheduleitem['location_id'],
							'division_id'						=> $scheduleemployeescheduleitem['division_id'],
							'department_id'						=> $scheduleemployeescheduleitem['department_id'],
							'section_id'						=> $scheduleemployeescheduleitem['section_id'],
							'unit_id'							=> $scheduleemployeescheduleitem['unit_id'],
							'shift_id'							=> $scheduleemployeescheduleitem['shift_id'],
							'employee_shift_id'					=> $scheduleemployeescheduleitem['employee_shift_id'],
							'employee_id'						=> $scheduleemployeescheduleitem['employee_id'],
							'employee_rfid_code'				=> $scheduleemployeescheduleitem['employee_rfid_code'],
							'employee_attendance_date_status'	=> $scheduleemployeescheduleitem['employee_schedule_item_date_status'],							
							'employee_attendance_log_out_date'	=> date("Y-m-d H:i:s"),
							'employee_attendance_out_status'	=> 1,							
							'employee_attendance_date'			=> date('Y-m-d'),
							'machine_ip_address'				=> $machine_ip_address,
							'employee_attendance_location_out'	=> $latitude.', '.$longitude
						);

						if ($employee_schedule_item_log_status == 1){
							$employee_schedule_item_in_end_date 	= $scheduleemployeescheduleitem['employee_schedule_item_in_end_date'];
							$employee_schedule_item_out_start_date 	= $scheduleemployeescheduleitem['employee_schedule_item_out_start_date'];
							$employee_schedule_item_out_end_date 	= $scheduleemployeescheduleitem['employee_schedule_item_out_end_date'];
	
							if ($employee_schedule_item_out_start_date <= $employee_attendance_log && $employee_attendance_log <= $employee_schedule_item_out_end_date ){
	
								if ($this->HroEmployeeAttendance_model->insertHROEmployeeAttendance($data_HroEmployeeAttendance)){
									$employee_schedule_item_log_status = 2;	
									
									$data_scheduleemployeesheduleitem = array (
										'employee_schedule_item_id'					=> $scheduleemployeescheduleitem['employee_schedule_item_id'],
										'employee_schedule_item_status'				=> 2,
										'employee_schedule_item_log_out_date'		=> date('Y-m-d H:i:s'),
										'employee_schedule_item_log_status'			=> $employee_schedule_item_log_status,
										'employee_schedule_item_photo_out'			=> $photoname,
										'employee_schedule_item_location_lat_out'	=> $latitude,
										'employee_schedule_item_location_long_out'	=> $longitude,
										'employee_schedule_item_address_out'		=> $address,
									);
									
									//if(!empty($data_scheduleemployeesheduleitem)){
										// $this->HroEmployeeAttendance_model->updateAva($data_avatar);										$save = 2;
										$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleItem($data_scheduleemployeesheduleitem);										$save = 2;
									//}
									
									file_put_contents($uploads_dir.$photoname, $realImage);	

									$save = 2;
	
									$HroEmployeeAttendanceData = $this->HroEmployeeAttendance_model->getHroEmployeeAttendanceData($startdate);	
		
									foreach ($HroEmployeeAttendanceData as $keyEmployeeAttendance => $valEmployeeAttendance) {
										$employee_id 			= $valEmployeeAttendance['employee_id'];
										$employee_attendance_id = $valEmployeeAttendance['employee_attendance_id'];
										$employee_attendance_log_period	= date("Ym", strtotime($startdate));
	
										if ($this->HroEmployeeAttendance_model->getHroEmployeeAttendanceLog($employee_id, $employee_attendance_log_period)){
											$data_employeeattendancelog = array (
												'region_id'							=> $valEmployeeAttendance['region_id'],
												'branch_id'							=> $valEmployeeAttendance['branch_id'],
												'location_id'						=> $valEmployeeAttendance['location_id'],
												'division_id'						=> $valEmployeeAttendance['division_id'],
												'department_id'						=> $valEmployeeAttendance['department_id'],
												'section_id'						=> $valEmployeeAttendance['section_id'],
												'unit_id'							=> $valEmployeeAttendance['unit_id'],
												'shift_id'							=> $valEmployeeAttendance['shift_id'],
												'employee_shift_id'					=> $valEmployeeAttendance['employee_shift_id'],
												'employee_id'						=> $valEmployeeAttendance['employee_id'],
												'employee_rfid_code'				=> $valEmployeeAttendance['employee_rfid_code'],
												'employee_attendance_log_period'	=> $employee_attendance_log_period,
												$day_log							=> $valEmployeeAttendance['employee_attendance_out_status'],
												'created_on'						=> date('Y-m-d H:i:s'),
												'created_id'						=> $user_id,
												//'data_state'						=> 0
											);

											//if(!empty($data_employeeattendancelog)){
												$this->HroEmployeeAttendance_model->insertHroEmployeeAttendanceLog($data_employeeattendancelog);
											//}

											$save=2;
										}else{
											$employee_attendance_log_period  = date("Ym", strtotime($valEmployeeAttendance['employee_attendance_date']));
											$day_log 						= "day_".date("d", strtotime($valEmployeeAttendance['employee_attendance_date']));
	
											$dataupdate_employeeattendancelog = array (
												//'student_attendance_data_id'		=> $valEmployeeAttendance['student_attendance_data_id'],
												'employee_id'						=> $valEmployeeAttendance['employee_id'],
												'employee_attendance_log_period'	=> $employee_attendance_log_period,
												$day_log							=> $valEmployeeAttendance['employee_attendance_out_status'],
	
											);	
											//if(!empty($dataupdate_employeeattendancelog)){
												$this->HroEmployeeAttendance_model->updateHroEmployeeAttendanceLog($dataupdate_employeeattendancelog);
											//}
	
											$save=2;								
										}
	
									}
	
								} else {
									$save = 0;	
								}
								
							} else {
								$save = 9;
							}
							
						} else if($employee_schedule_item_log_status == 0){
							$save = 6;
						}else {							
							if ($this->HroEmployeeAttendance_model->insertHROEmployeeAttendance($data_HroEmployeeAttendance)){
								$save = 4;
	
								// $data_scheduleemployeesheduleshift = array (
								// 	'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
								// 	'employee_schedule_shift_status'		=> $employee_schedule_shift_status,								
								// 	'employee_schedule_shift_date'			=> $employee_attendance_date,
								// );
	
								// $this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	
	
								// $data_scheduleemployeesheduleshift = array (
								// 		'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
								// 		'employee_schedule_shift_status'		=> $employee_schedule_shift_status_yesterday,	
								// 		'employee_schedule_shift_date'			=> $employee_attendance_date,
								// 	);
	
								// $this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	
							}	
						}

					}else{
						echo "type absen undefined";
					}					
					
					$employee_name = $this->HroEmployeeAttendance_model->getEmployeeName($data_HroEmployeeAttendance['employee_id']);
					if($save==1){
						echo "Absensi Masuk berhasil";
					}else if($save==2){
						echo "Absensi Keluar berhasil";
					}else if($save==3){
						echo "Anda sudah absen masuk";
					}else if($save==4){
						echo "Anda sudah absen keluar";
					}else if($save==6){
							echo "Anda belum absen masuk";
					}else if($save==9){
						echo "Diluar Jam Absensi";
					}else if($save==0){
						
						echo "Absensi gagal";	
					}
						
				} else {
					$date 							= date_create($employee_attendance_date);
					date_add($date, date_interval_create_from_date_string("-1 days"));
					$employee_schedule_shift_date	= date_format($date, "Y-m-d");

					$scheduleemployeescheduleshift 	= $this->HroEmployeeAttendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

					$employee_name = $this->HroEmployeeAttendance_model->getEmployeeName($scheduleemployeescheduleshift['employee_id']);

					if (!empty($scheduleemployeescheduleshift)){
						$data_employeeattendancedate = array (
							'employee_rfid_code'		=> $data['employee_rfid_code'],	
							'employee_attendance_date'	=> $employee_schedule_shift_date,
						);
					} else {				
												
						echo "absen gagal";

					}
				}
			}else{				
								
				echo "Anda belum terdaftar";
			}
		}

		
	}
?>