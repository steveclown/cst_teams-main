<?php
	class HroEmployeeAttendanceRfid extends CI_Controller{
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
			$auth = $this->session->userdata('auth');
			$data['Main_view']['content']					= 'HroEmployeeAttendance/formaddHroEmployeeAttendance_view';
			$this->load->view('MainPage_view',$data);
		}

		public function processAddHROEmployeeAttendance(){
			$auth 				= $this->session->userdata('auth');
			$unique 			= $this->session->userdata('unique');
			//$location_id 		= $auth['location_id'];
			$location_id 		= "19";
			$machine_ip_address	= '192.168.1.250';

			$sesi				= $this->session->userdata('datashift_employeeattendancedate-'.$unique['unique']);			

			$employee_rfid_code = $this->input->get('rfid');  //get dari mesin tap rfid
			// if(!empty($employee_rfid_code)){
			// 	$data=array(
			// 		'employee_rfid_code'		=> $employee_rfid_code

			// 	);
			// 	$employee_attendance_date 		= date('Y-m-d');
			// }
			// print($sesi);
			// exit;
			
			if(!is_array($sesi)){
				$data = array(
					//'employee_rfid_code'		=> $this->input->post('employee_rfid_code',true),
					'employee_rfid_code'		=> $employee_rfid_code
				);

				$employee_attendance_date 		= date('Y-m-d');
			} else {
				$employee_attendance_date 		= $sesi['employee_attendance_date'];

				$data = array(
					// 'employee_rfid_code'		=> $sesi['employee_rfid_code'],
					'employee_rfid_code'		=> $employee_rfid_code,
				);								
			}
						
			$this->session->unset_userdata('addarrayHroEmployeeAttendance-'.$unique['unique']);

			$this->form_validation->set_rules('employee_rfid_code', 'Employee RFID Code', 'required');

			// if($this->form_validation->run()==true){	
			if(!empty($data['employee_rfid_code'])){

				$employee_attendance_log 		= date('Y-m-d H:i:s');
				
				$scheduleemployeescheduleitem 	= $this->HroEmployeeAttendance_model->getScheduleEmployeeScheduleItem($data['employee_rfid_code'], $location_id, $employee_attendance_date);
				
				if (!empty($scheduleemployeescheduleitem)){
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
						'employee_attendance_log_date'		=> date("Y-m-d H:i:s"),
						'employee_attendance_status'		=> 1,
						'employee_attendance_date'			=> date('Y-m-d'),
						'machine_ip_address'				=> $machine_ip_address
					);

					$employee_schedule_item_log_status = $scheduleemployeescheduleitem['employee_schedule_item_log_status'];

					//print("scheduleemployeescheduleitem");
					
					if ($employee_schedule_item_log_status == 0){
						$employee_schedule_item_in_start_date 	= $scheduleemployeescheduleitem['employee_schedule_item_in_start_date'];
						$employee_schedule_item_out_end_date 	= $scheduleemployeescheduleitem['employee_schedule_item_out_end_date'];

						/*print_r("employee_schedule_item_in_start_date ");
						print_r($employee_schedule_item_in_start_date);
						print_r("<BR>");
						print_r("<BR>");

						print_r("employee_schedule_item_out_end_date ");
						print_r($employee_schedule_item_out_end_date);
						print_r("<BR>");
						print_r("<BR>");

						print_r("employee_attendance_log ");
						print_r($employee_attendance_log);
						print_r("<BR>");
						print_r("<BR>");

						exit;	*/					

						if ($employee_schedule_item_in_start_date <= $employee_attendance_log && $employee_attendance_log <= $employee_schedule_item_out_end_date){

							if ($this->HroEmployeeAttendance_model->insertHROEmployeeAttendance($data_HroEmployeeAttendance)){
								$employee_schedule_item_log_status = 1;

								$data_scheduleemployeesheduleitem = array (
									'employee_schedule_item_id'				=> $scheduleemployeescheduleitem['employee_schedule_item_id'],
									'employee_schedule_item_status'			=> 1,
									'employee_schedule_item_log_in_date'	=> date('Y-m-d H:i:s'),
									'employee_schedule_item_log_status'		=> $employee_schedule_item_log_status,
								);
								
								$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleItem($data_scheduleemployeesheduleitem);

								$data_scheduleemployeesheduleshift = array (
									'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
									'employee_schedule_shift_status'		=> $employee_schedule_shift_status,
									'employee_schedule_shift_date'			=> $employee_attendance_date,
								);

								$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);								

								$data_scheduleemployeesheduleshift = array (
									'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
									'employee_schedule_shift_status'		=> $employee_schedule_shift_status_yesterday,									
									'employee_schedule_shift_date'			=> $employee_schedule_shift_date,
								);

								$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);								

								$save = 1;
							} else {
								$save = 0;	
							}
						} else {
							$save = 0;
						}
					} else {
						if ($this->HroEmployeeAttendance_model->insertHROEmployeeAttendance($data_HroEmployeeAttendance)){
							$save = 1;

							$data_scheduleemployeesheduleshift = array (
								'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
								'employee_schedule_shift_status'		=> $employee_schedule_shift_status,								
								'employee_schedule_shift_date'			=> $employee_attendance_date,
							);

							$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	

							$data_scheduleemployeesheduleshift = array (
									'employee_id'							=> $scheduleemployeescheduleitem['employee_id'],
									'employee_schedule_shift_status'		=> $employee_schedule_shift_status_yesterday,	
									'employee_schedule_shift_date'			=> $employee_attendance_date,
								);

							$this->HroEmployeeAttendance_model->updateScheduleEmployeeScheduleShift($data_scheduleemployeesheduleshift);	
						}	
					}

					if ($save == 1){
						$hroemployeedata = $this->HroEmployeeAttendance_model->getHROEmployeeData_Detail($data['employee_rfid_code']);

						$data_HroEmployeeAttendance_array = array(
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

						$dataArrayHeader = $this->session->userdata('addarrayHroEmployeeAttendance-'.$unique['unique']);

						$dataArrayHeader = $data_HroEmployeeAttendance_array;
						
						$this->session->set_userdata('addarrayHroEmployeeAttendance-'.$unique['unique'],$dataArrayHeader);

						$msg = "<div class='alert alert-success'>                
									Add Data Employee Attendance Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addcoreunit');
						$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
						//redirect('HroEmployeeAttendance');
					} else {
						$date 							= date_create($employee_attendance_date);
						date_add($date, date_interval_create_from_date_string("-1 days"));
						$employee_schedule_shift_date	= date_format($date, "Y-m-d");

						$scheduleemployeescheduleshift 	= $this->HroEmployeeAttendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

						// print_r("date");
						// print_r($date);
						// print_r("<BR>");
						// print_r("scheduleemployeescheduleshift");
						// print_r($scheduleemployeescheduleshift);
						// print_r("<BR>");
						// print_r("employee_schedule_shift_date");
						// print_r($employee_schedule_shift_date);
						// print_r("<BR>");
						// print_r("data['employee_rfid_code']");
						// print_r($data['employee_rfid_code']);
						// print_r("<BR>");
						// exit;

						if (!empty($scheduleemployeescheduleshift)){
							$data_employeeattendancedate = array (
								'employee_rfid_code'		=> $data['employee_rfid_code'],	
								'employee_attendance_date'	=> $employee_schedule_shift_date,
							);

							//print_r("data_employeeattendancedate");
							//print_r($data_employeeattendancedate);
							//print_r("<BR>");
							/*exit;*/

							$dataArrayDate		= $this->session->userdata('datashift_employeeattendancedate-'.$unique['unique']);

							$dataArrayDate 		= $data_employeeattendancedate;
						
							$this->session->set_userdata('datashift_employeeattendancedate-'.$unique['unique'],$dataArrayDate);

							//print_r("dataArrayDate");
							//print_r($dataArrayDate);
							//print_r("<BR>");

							/*exit;*/
						//	$this->processAddHROEmployeeAttendance();
							/*redirect($this->processAddHROEmployeeAttendance);*/
							/*redirect($this->uri->uri_string());*/
						} else {
							$msg = "<div class='alert alert-danger'>                
										Employee Data Can't Tapping
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->unset_userdata('addcoreunit');
							$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
							//redirect('HroEmployeeAttendance');
						}
					}
					//here
					$employee_name = $this->HroEmployeeAttendance_model->getEmployeeName($data_HroEmployeeAttendance['employee_id']);

					// $ket_status = 1;

					// if ($ket_status == 1){
					// 	$ket = "Selamat Datang";
					// }else{
					// 	$ket = "Selamat Jalan";
					// }
					
					$msg_to_client = array(
						'status' 	=> substr($employee_name,0,14),						
						'ket' 		=> "Absensi berhasil"
					);

					$json_msg_to_client = json_encode($msg_to_client);
					echo $json_msg_to_client;	
						
				} else {
					$date 							= date_create($employee_attendance_date);
					date_add($date, date_interval_create_from_date_string("-1 days"));
					$employee_schedule_shift_date	= date_format($date, "Y-m-d");

					$scheduleemployeescheduleshift 	= $this->HroEmployeeAttendance_model->getScheduleEmployeeScheduleShift($data['employee_rfid_code'], $location_id, $employee_schedule_shift_date);

					$employee_name = $this->HroEmployeeAttendance_model->getEmployeeName($scheduleemployeescheduleshift['employee_id']);

					//print_r("scheduleemployeescheduleshift");
					//print_r($scheduleemployeescheduleshift);
					//print_r("<BR>");

					if (!empty($scheduleemployeescheduleshift)){
						$data_employeeattendancedate = array (
							'employee_rfid_code'		=> $data['employee_rfid_code'],	
							'employee_attendance_date'	=> $employee_schedule_shift_date,
						);

						// $msg_to_client = array(
						// 	'status' 	=> substr($employee_name,0,13),							
						// 	'ket' 		=> "Absensi berhasil"
						// );

						// $json_msg_to_client = json_encode($msg_to_client);
						// echo $json_msg_to_client;	
						
						$dataArrayDate		= $this->session->userdata('datashift_employeeattendancedate-'.$unique['unique']);

						$dataArrayDate 		= $data_employeeattendancedate;
						
						$this->session->set_userdata('datashift_employeeattendancedate-'.$unique['unique'],$dataArrayDate);

						//redirect('HroEmployeeAttendance/processAddHROEmployeeAttendance');
						
					} else {
						$msg = "<div class='alert alert-danger'>                
									Employee Data Can't Tapping
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						
						$msg_to_client = array(
							'status' => "Can't Tapping!",
							'ket'	 => "Belum Terdaftar"
						);

						$json_msg_to_client = json_encode($msg_to_client);
						echo $json_msg_to_client;
						
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addcoreunit');
						$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
						
						//redirect('HroEmployeeAttendance');

					}
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addcoreunit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
				//redirect('HroEmployeeAttendance');
				$msg_to_client = array(
					'status' => "Can't Tapping",
					'ket'	 => "Belum Terdaftar"
				);

				$json_msg_to_client = json_encode($msg_to_client);
				echo $json_msg_to_client;
			}
		}
	}
?>