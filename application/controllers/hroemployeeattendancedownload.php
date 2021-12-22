<?php
	class hroemployeeattendancedownload extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancedownload_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			echo "access is denied index";
		}

		public function processDownloadHROEmployeeAttendance($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$unique 			= $this->session->userdata('unique');
				$auth 				= $this->session->userdata('auth');

				$coremachine 		= $this->hroemployeeattendancedownload_model->getCoreMachine();

				foreach ($coremachine as $key => $val) {
					$machine_type			= $val['machine_type'];
					$machine_database_name	= $val['machine_database_name'];
					$machine_ip_address 	= $val['machine_ip_address'];

					$db_obj = $this->load->database($machine_database_name, TRUE);

					if ($db_obj->initialize()){
						if ($machine_type == 1){
							$hroemployeeattendance = $this->hroemployeeattendancedownload_model->getHROEmployeeAttendance($machine_database_name);

							$attendance_download_log_start_total = $hroemployeeattendance->num_rows();

							if (!empty($hroemployeeattendance)){
								$attendance_download_log_end_total = 0; 

								foreach ($hroemployeeattendance ->result_array() as $keyAttendance => $valAttendance) {
									$employee_attendance_id = $valAttendance['employee_attendance_id'];

			  						$dataattendance = array (
			  							'region_id' 						=> $valAttendance['region_id'],
			  							'branch_id' 						=> $valAttendance['branch_id'],
			  							'division_id' 						=> $valAttendance['division_id'],
			  							'department_id' 					=> $valAttendance['department_id'],
			  							'section_id' 						=> $valAttendance['section_id'],
			  							'unit_id' 							=> $valAttendance['unit_id'],
			  							'location_id' 						=> $valAttendance['location_id'],
			  							'shift_id'	 						=> $valAttendance['shift_id'],
			  							'employee_shift_id'					=> $valAttendance['employee_shift_id'],
			  							'employee_id' 						=> $valAttendance['employee_id'],
			  							'employee_rfid_code' 				=> $valAttendance['employee_rfid_code'],
			  							'employee_attendance_status' 		=> $valAttendance['employee_attendance_status'],
			  							'employee_attendance_date' 			=> $valAttendance['employee_attendance_date'],
			  							'employee_attendance_date_status' 	=> $valAttendance['employee_attendance_date_status'],
			  							'employee_attendance_log_date' 		=> $valAttendance['employee_attendance_log_date'],
			  							'employee_attendance_log_date' 		=> $valAttendance['employee_attendance_log_date'],
			  							'machine_ip_address'				=> $valAttendance['machine_ip_address'],
			  						);

			  						if ($this->hroemployeeattendancedownload_model->insertHROEmployeeAttendance($dataattendance)){
			  							$dataupdate = array(
			  								'employee_attendance_id' 			=> $valAttendance['employee_attendance_id'],
			  								'employee_attendance_downloaded'	=> 1
			  							);

			  							$this->hroemployeeattendancedownload_model->updateHROEmployeeAttendance($machine_database_name, $dataupdate);

			  							$attendance_download_log_end_total++;
			  						}

								}
							}

							$data_downloadlog = array (
		  						'attendance_download_log_date'			=> date("Y-m-d"),
		  						'machine_ip_address'					=> $machine_ip_address,
		  						'employee_attendance_status'			=> 1,
		  						'attendance_download_log_start_total'	=> $attendance_download_log_start_total,
		  						'attendance_download_log_end_total'		=> $attendance_download_log_end_total,
		  						'attendance_download_log_status'		=> 1,
		  					);

		  					$this->hroemployeeattendancedownload_model->insertHROEmployeeAttendanceDownloadLog($data_downloadlog);
						} 

						if ($machine_type == 0){
							$hroemployeemealcoupon = $this->hroemployeeattendancedownload_model->getHROEmployeeMealCoupon($machine_database_name);

							$attendance_download_log_start_total = $hroemployeemealcoupon->num_rows();

							if (!empty($hroemployeemealcoupon)){
								$attendance_download_log_end_total = 0; 

								foreach ($hroemployeemealcoupon ->result_array() as $keyMealCoupon => $valMealCoupon) {
									$employee_meal_coupon_id = $valMealCoupon['employee_meal_coupon_id'];

			  						$datamealcoupon = array (
			  							'region_id' 						=> $valMealCoupon['region_id'],
			  							'branch_id' 						=> $valMealCoupon['branch_id'],
			  							'division_id' 						=> $valMealCoupon['division_id'],
			  							'department_id' 					=> $valMealCoupon['department_id'],
			  							'section_id' 						=> $valMealCoupon['section_id'],
			  							'unit_id' 							=> $valMealCoupon['unit_id'],
			  							'location_id' 						=> $valMealCoupon['location_id'],
			  							'employee_shift_id'					=> $valMealCoupon['employee_shift_id'],
			  							'employee_id' 						=> $valMealCoupon['employee_id'],
			  							'employee_rfid_code' 				=> $valMealCoupon['employee_rfid_code'],
			  							'employee_meal_coupon_date' 		=> $valMealCoupon['employee_meal_coupon_date'],
			  							'employee_meal_coupon_log_date' 	=> $valMealCoupon['employee_meal_coupon_log_date'],
			  							'machine_ip_address'				=> $machine_ip_address

			  						);

			  						if ($this->hroemployeeattendancedownload_model->insertHROEmployeeMealCoupon($datamealcoupon)){
			  							$dataupdate = array(
			  								'employee_meal_coupon_id' 			=> $valMealCoupon['employee_meal_coupon_id'],
			  								'employee_meal_coupon_downloaded'	=> 1
			  							);

			  							$this->hroemployeeattendancedownload_model->updateHROEmployeeMealCoupon($machine_database_name, $dataupdate);

			  							$attendance_download_log_end_total++;
			  						}
								}
							}

							$data_downloadlog = array (
		  						'attendance_download_log_date'			=> date("Y-m-d"),
		  						'machine_ip_address'					=> $machine_ip_address,
		  						'employee_attendance_status'			=> 0,
		  						'attendance_download_log_start_total'	=> $attendance_download_log_start_total,
		  						'attendance_download_log_end_total'		=> $attendance_download_log_end_total,
		  						'attendance_download_log_status'		=> 1,
		  					);

		  					$this->hroemployeeattendancedownload_model->insertHROEmployeeAttendanceDownloadLog($data_downloadlog);
						}
					} else {
						$data_downloadlog = array (
	  						'attendance_download_log_date'			=> date("Y-m-d"),
	  						'machine_ip_address'					=> $machine_ip_address,
	  						'employee_attendance_status'			=> 0,
	  						'attendance_download_log_start_total'	=> 0,
	  						'attendance_download_log_end_total'		=> 0,
	  						'attendance_download_log_status'		=> 0,
	  					);

	  					$this->hroemployeeattendancedownload_model->insertHROEmployeeAttendanceDownloadLog($data_downloadlog);
					}

				}				
			}
		}

		public function processDownloadHROEmployeeAttendance($password){
			if($password!="CKP99999"){
				echo "access is denied";
			}else{
				$unique 			= $this->session->userdata('unique');
				$auth 				= $this->session->userdata('auth');

				/*2018-11-09 until now
				192.168.1.141	= 6
				192.168.1.98	= 2

				2018-11-08 until now
				192.168.1.115	= 4
				192.168.1.132	= 3

				2018-10-26 until now
				192.168.1.142	= 7

				$machine_id 		= 1;*/

				$coremachine 		= $this->hroemployeeattendancedownload_model->getCoreMachine_Detail($machine_id);

				foreach ($coremachine as $key => $val) {
					$machine_type			= $val['machine_type'];
					$machine_database_name	= $val['machine_database_name'];
					$machine_ip_address 	= $val['machine_ip_address'];

					$db_obj = $this->load->database($machine_database_name, TRUE);

					if ($db_obj->initialize()){
						if ($machine_type == 1){
							$hroemployeeattendance = $this->hroemployeeattendancedownload_model->getHROEmployeeAttendance($machine_database_name);

							$attendance_download_log_start_total = $hroemployeeattendance->num_rows();

							if (!empty($hroemployeeattendance)){
								$attendance_download_log_end_total = 0; 

								foreach ($hroemployeeattendance ->result_array() as $keyAttendance => $valAttendance) {
									$employee_attendance_id = $valAttendance['employee_attendance_id'];

			  						$dataattendance = array (
			  							'region_id' 						=> $valAttendance['region_id'],
			  							'branch_id' 						=> $valAttendance['branch_id'],
			  							'division_id' 						=> $valAttendance['division_id'],
			  							'department_id' 					=> $valAttendance['department_id'],
			  							'section_id' 						=> $valAttendance['section_id'],
			  							'unit_id' 							=> $valAttendance['unit_id'],
			  							'location_id' 						=> $valAttendance['location_id'],
			  							'shift_id'	 						=> $valAttendance['shift_id'],
			  							'employee_shift_id'					=> $valAttendance['employee_shift_id'],
			  							'employee_id' 						=> $valAttendance['employee_id'],
			  							'employee_rfid_code' 				=> $valAttendance['employee_rfid_code'],
			  							'employee_attendance_status' 		=> $valAttendance['employee_attendance_status'],
			  							'employee_attendance_date' 			=> $valAttendance['employee_attendance_date'],
			  							'employee_attendance_date_status' 	=> $valAttendance['employee_attendance_date_status'],
			  							'employee_attendance_log_date' 		=> $valAttendance['employee_attendance_log_date'],
			  							'employee_attendance_log_date' 		=> $valAttendance['employee_attendance_log_date'],
			  							'machine_ip_address'				=> $valAttendance['machine_ip_address'],
			  						);

			  						if ($this->hroemployeeattendancedownload_model->insertHROEmployeeAttendance($dataattendance)){
			  							$dataupdate = array(
			  								'employee_attendance_id' 			=> $valAttendance['employee_attendance_id'],
			  								'employee_attendance_downloaded'	=> 1
			  							);

			  							$this->hroemployeeattendancedownload_model->updateHROEmployeeAttendance($machine_database_name, $dataupdate);

			  							$attendance_download_log_end_total++;
			  						}

								}
							}

							$data_downloadlog = array (
		  						'attendance_download_log_date'			=> date("Y-m-d"),
		  						'machine_ip_address'					=> $machine_ip_address,
		  						'employee_attendance_status'			=> 1,
		  						'attendance_download_log_start_total'	=> $attendance_download_log_start_total,
		  						'attendance_download_log_end_total'		=> $attendance_download_log_end_total,
		  						'attendance_download_log_status'		=> 1,
		  					);

		  					$this->hroemployeeattendancedownload_model->insertHROEmployeeAttendanceDownloadLog($data_downloadlog);
						} 

						if ($machine_type == 0){
							$hroemployeemealcoupon = $this->hroemployeeattendancedownload_model->getHROEmployeeMealCoupon($machine_database_name);

							$attendance_download_log_start_total = $hroemployeemealcoupon->num_rows();

							if (!empty($hroemployeemealcoupon)){
								$attendance_download_log_end_total = 0; 

								foreach ($hroemployeemealcoupon ->result_array() as $keyMealCoupon => $valMealCoupon) {
									$employee_meal_coupon_id = $valMealCoupon['employee_meal_coupon_id'];

			  						$datamealcoupon = array (
			  							'region_id' 						=> $valMealCoupon['region_id'],
			  							'branch_id' 						=> $valMealCoupon['branch_id'],
			  							'division_id' 						=> $valMealCoupon['division_id'],
			  							'department_id' 					=> $valMealCoupon['department_id'],
			  							'section_id' 						=> $valMealCoupon['section_id'],
			  							'unit_id' 							=> $valMealCoupon['unit_id'],
			  							'location_id' 						=> $valMealCoupon['location_id'],
			  							'employee_shift_id'					=> $valMealCoupon['employee_shift_id'],
			  							'employee_id' 						=> $valMealCoupon['employee_id'],
			  							'employee_rfid_code' 				=> $valMealCoupon['employee_rfid_code'],
			  							'employee_meal_coupon_date' 		=> $valMealCoupon['employee_meal_coupon_date'],
			  							'employee_meal_coupon_log_date' 	=> $valMealCoupon['employee_meal_coupon_log_date'],
			  							'machine_ip_address'				=> $machine_ip_address

			  						);

			  						if ($this->hroemployeeattendancedownload_model->insertHROEmployeeMealCoupon($datamealcoupon)){
			  							$dataupdate = array(
			  								'employee_meal_coupon_id' 			=> $valMealCoupon['employee_meal_coupon_id'],
			  								'employee_meal_coupon_downloaded'	=> 1
			  							);

			  							$this->hroemployeeattendancedownload_model->updateHROEmployeeMealCoupon($machine_database_name, $dataupdate);

			  							$attendance_download_log_end_total++;
			  						}
								}
							}

							$data_downloadlog = array (
		  						'attendance_download_log_date'			=> date("Y-m-d"),
		  						'machine_ip_address'					=> $machine_ip_address,
		  						'employee_attendance_status'			=> 0,
		  						'attendance_download_log_start_total'	=> $attendance_download_log_start_total,
		  						'attendance_download_log_end_total'		=> $attendance_download_log_end_total,
		  						'attendance_download_log_status'		=> 1,
		  					);

		  					$this->hroemployeeattendancedownload_model->insertHROEmployeeAttendanceDownloadLog($data_downloadlog);
						}
					} else {
						$data_downloadlog = array (
	  						'attendance_download_log_date'			=> date("Y-m-d"),
	  						'machine_ip_address'					=> $machine_ip_address,
	  						'employee_attendance_status'			=> 0,
	  						'attendance_download_log_start_total'	=> 0,
	  						'attendance_download_log_end_total'		=> 0,
	  						'attendance_download_log_status'		=> 0,
	  					);

	  					$this->hroemployeeattendancedownload_model->insertHROEmployeeAttendanceDownloadLog($data_downloadlog);
					}

				}				
			}
		}

		
	}
?>