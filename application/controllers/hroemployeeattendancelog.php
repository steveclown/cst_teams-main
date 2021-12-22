<?php
	class hroemployeeattendancelog extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancelog_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			echo "access is denied index";
		}

		public function processAddHROEmployeeAttendanceLog($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$unique 			= $this->session->userdata('unique');
				$auth 				= $this->session->userdata('auth');
				$date 				= date("Y-m-d");
				/*$date 			= date("2019-01-30");*/
				/*$employee_id 		= 10557;*/
				$startdate1			= strtotime('-2 day', strtotime($date));
				$startdate 			= date("Y-m-d", $startdate1);
				$startdate 			= $date;

				$employee_attendance_log_period	= date("Ym", strtotime($startdate));
				$day_log 						= "day_".date("d", strtotime($startdate));
				$meal_log 						= "meal_".date("d", strtotime($startdate));

				$hroemployeeattendancedata = $this->hroemployeeattendancelog_model->getHROEmployeeAttendanceData($startdate);

				foreach ($hroemployeeattendancedata as $keyAttendanceData => $valAttendanceDate) {
					$employee_id 					= $valAttendanceDate['employee_id'];

					$meal_log_counter 				= $this->hroemployeeattendancelog_model->getMealLogCounter($employee_id, $startdate);

					if ($this->hroemployeeattendancelog_model->getHROEmployeeAttendanceLog($employee_id, $employee_attendance_log_period)){
						$datainsert_hroemployeeattendancelog = array (
							'region_id'							=> $valAttendanceDate['region_id'],
							'branch_id'							=> $valAttendanceDate['branch_id'],
							'location_id'						=> $valAttendanceDate['location_id'],
							'division_id'						=> $valAttendanceDate['division_id'],
							'department_id'						=> $valAttendanceDate['department_id'],
							'section_id'						=> $valAttendanceDate['section_id'],
							'unit_id'							=> $valAttendanceDate['unit_id'],
							'shift_id'							=> $valAttendanceDate['shift_id'],
							'employee_shift_id'					=> $valAttendanceDate['employee_shift_id'],
							'employee_id'						=> $valAttendanceDate['employee_id'],
							'employee_rfid_code'				=> $valAttendanceDate['employee_rfid_code'],
							'employee_attendance_log_period'	=> $employee_attendance_log_period,
							$day_log							=> $valAttendanceDate['employee_attendance_date_status'],
							$meal_log							=> $meal_log_counter,
							'created_id'						=> $auth['user_id'],
							'created_on'						=> date("Y-m-d H:i:s"),
						);

						$this->hroemployeeattendancelog_model->insertHROEmployeeAttendanceLog($datainsert_hroemployeeattendancelog);
					} else {
						$dataupdate_hroemployeeattendancelog = array (
							'employee_id'						=> $valAttendanceDate['employee_id'],
							'employee_attendance_log_period'	=> $employee_attendance_log_period,
							$day_log							=> $valAttendanceDate['employee_attendance_date_status'],
							$meal_log							=> $meal_log_counter,
						);	

						$this->hroemployeeattendancelog_model->updateHROEmployeeAttendanceLog($dataupdate_hroemployeeattendancelog);		
					}
				}
			}
		}


		public function processCalculateHROEmployeeAttendanceLog($password){
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
					$employee_attendance_log_period	= date("Ym", strtotime($startdate));
					$day_log 						= "day_".date("d", strtotime($startdate));

					$hroemployeeattendancedata = $this->hroemployeeattendancelog_model->getHROEmployeeAttendanceData($startdate);

					foreach ($hroemployeeattendancedata as $keyAttendanceData => $valAttendanceDate) {
						$employee_id 					= $valAttendanceDate['employee_id'];

						if ($this->hroemployeeattendancelog_model->getHROEmployeeAttendanceLog($employee_id, $employee_attendance_log_period)){
							$datainsert_hroemployeeattendancelog = array (
								'region_id'							=> $valAttendanceDate['region_id'],
								'branch_id'							=> $valAttendanceDate['branch_id'],
								'location_id'						=> $valAttendanceDate['location_id'],
								'division_id'						=> $valAttendanceDate['division_id'],
								'department_id'						=> $valAttendanceDate['department_id'],
								'section_id'						=> $valAttendanceDate['section_id'],
								'unit_id'							=> $valAttendanceDate['unit_id'],
								'shift_id'							=> $valAttendanceDate['shift_id'],
								'employee_shift_id'					=> $valAttendanceDate['employee_shift_id'],
								'employee_id'						=> $valAttendanceDate['employee_id'],
								'employee_rfid_code'				=> $valAttendanceDate['employee_rfid_code'],
								'employee_attendance_log_period'	=> $employee_attendance_log_period,
								$day_log							=> $valAttendanceDate['employee_attendance_date_status'],
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);

							$this->hroemployeeattendancelog_model->insertHROEmployeeAttendanceLog($datainsert_hroemployeeattendancelog);
						} else {
							$dataupdate_hroemployeeattendancelog = array (
								'employee_id'						=> $valAttendanceDate['employee_id'],
								'employee_attendance_log_period'	=> $employee_attendance_log_period,
								$day_log							=> $valAttendanceDate['employee_attendance_date_status'],
							);	

							$this->hroemployeeattendancelog_model->updateHROEmployeeAttendanceLog($dataupdate_hroemployeeattendancelog);		
						}
					}
					

					$startdate1			= strtotime('1 day', strtotime($startdate));
					$startdate 			= date("Y-m-d", $startdate1);
				}
			}
		}

		public function processCalculateHROEmployeeAttendanceLog2($password){
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

		public function trialReport(){
			$data = $this->hroemployeeattendancelog_model->getHROEmployeeAttendanceLog_Period();

			print_r("data  ");
			print_r($data);

		}
	}
?>