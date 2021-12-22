<?php
	class hroemployeeattendancedata extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancedata_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 			= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$sesi	= 	$this->session->userdata('filter-hroemployeeattendancedata');
			if(!is_array($sesi)){
				$sesi['monthly_period_id']		= '';
			}

			$data['main_view']['payrollmonthlyperiod']			= create_double($this->hroemployeeattendancedata_model->getPayrollMonthlyPeriod(), 'monthly_period_id', 'monthly_period');

			$data['main_view']['hroemployeeattendancedatalog']	= $this->hroemployeeattendancedata_model->getHROEmployeeAttendanceDataLog($region_id, $branch_id, $location_id, $sesi['monthly_period_id']);

			$data['main_view']['content']						= 'hroemployeeattendancedata/listhroemployeeattendancedata_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'monthly_period_id'		=> $this->input->post('monthly_period_id',true),	
			);
			$this->session->set_userdata('filter-hroemployeeattendancedata',$data);
			redirect('hroemployeeattendancedata');
		}

		public function addHROEmployeeAttendanceData(){
			$data['main_view']['payrollmonthlyperiod']			= create_double($this->hroemployeeattendancedata_model->getPayrollMonthlyPeriod(), 'monthly_period_id', 'monthly_period');

			$data['main_view']['content']						= 'hroemployeeattendancedata/formaddhroemployeeattendancedata_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddArrayHROEmployeeAttendanceData(){
			$auth 				= $this->session->userdata('auth');
			$region_id 			= $auth['region_id'];
			$branch_id 			= $auth['branch_id'];
			$location_id 		= $auth['location_id'];

			$data = array(
				'monthly_period_id'				=> $this->input->post('monthly_period_id', true),
			);

			$data = array(
				'monthly_period_id'				=> 2,
			);




			$this->form_validation->set_rules('monthly_period_id', 'Monthly Period', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);

				$payrollmonthlyperiod 	= $this->hroemployeeattendancedata_model->getPayrollMonthlyPeriod_Detail($data['monthly_period_id']);

				$hroemployeeattendance 	= $this->hroemployeeattendancedata_model->getHROEmployeeAttendance($payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $region_id, $branch_id, $location_id);

				foreach ($hroemployeeattendance as $key => $val) {
					$employee_name 		= $this->hroemployeeattendancedata_model->getEmployeeName($val['employee_id']);
					$region_name 		= $this->hroemployeeattendancedata_model->getRegionName($val['region_id']);
					$branch_name 		= $this->hroemployeeattendancedata_model->getRegionName($val['branch_id']);
					$location_name 		= $this->hroemployeeattendancedata_model->getRegionName($val['location_id']);
					$division_name 		= $this->hroemployeeattendancedata_model->getRegionName($val['division_name']);
					$department_name 	= $this->hroemployeeattendancedata_model->getRegionName($val['department_id']);
					$section_name 		= $this->hroemployeeattendancedata_model->getRegionName($val['section_id']);
					$unit_name 			= $this->hroemployeeattendancedata_model->getRegionName($val['unit_name']);

					$data_hroemployeeattendance = array (
						'region_id'						=> $val['region_id'],
						'region_name'					=> $region_name,
						'branch_id'						=> $val['branch_id'],
						'branch_name'					=> $branch_name,
						'location_id'					=> $val['location_id'],
						'location_name'					=> $location_name,
						'division_id'					=> $val['division_id'],
						'division_name'					=> $division_name,
						'section_id'					=> $val['section_id'],
						'section_name'					=> $section_name,
						'unit_id'						=> $val['unit_id'],
						'unit_name'						=> $unit_name,
						'employee_id'					=> $val['employee_id'],
						'employee_name'					=> $employee_name,
						'monthly_period_start_date' 	=> $sesi['monthly_period_start_date'],
						'monthly_period_end_date' 		=> $sesi['monthly_period_start_date'],
						'employee_attendance_date'		=> $val['employee_attendance_date'],
						'employee_attendance_in_date'	=> $val['employee_attendance_in_date'],
						'employee_attendance_out_date'	=> $val['employee_attendance_out_date'],
					);


					$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeattendancedata-'.$unique['unique']);
					$dataArrayHeader[$data_hroemployeeattendance['employee_id']] = $data_hroemployeeattendance;
				
					$this->session->set_userdata('addarrayhroemployeeattendancedata-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
				}

				$unique 					= $this->session->userdata('unique');
				$hroemployeeattendancedata 	= $this->session->userdata('addarrayhroemployeeattendancedata-'.$unique['unique']);

				print_r(" hroemployeeattendancedata ");
				print_r($hroemployeeattendancedata);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function processAddHROEmployeeAttendanceData(){
			$unique 			= $this->session->userdata('unique');
			$auth 				= $this->session->userdata('auth');
			$region_id 			= $auth['region_id'];
			$branch_id 			= $auth['branch_id'];
			$location_id 		= $auth['location_id'];

			$data = array(
				'monthly_period_id'				=> $this->input->post('monthly_period_id', true),
			);

			/*print_r("data ");
			print_r($data);
			exit;*/

			$this->session->unset_userdata('addarrayhroemployeeattendancedata-'.$unique['unique']);
			$this->form_validation->set_rules('monthly_period_id', 'Monthly Period', 'required');
			if($this->form_validation->run()==true){				
				$payrollmonthlyperiod 	= $this->hroemployeeattendancedata_model->getPayrollMonthlyPeriod_Detail($data['monthly_period_id']);

				if ($this->hroemployeeattendancedata_model->getMonthlyPeriodID($payrollmonthlyperiod['monthly_period_id'])){
					$state = true;
				}
				else {
					if ($this->hroemployeeattendancedata_model->deleteHROEmployeeAttendanceLog($payrollmonthlyperiod['monthly_period_id'])){
						$state = false;
					}
				}

				if ($state == true){
					$hroemployeeattendance 	= $this->hroemployeeattendancedata_model->getHROEmployeeAttendance($payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $region_id, $branch_id, $location_id);

					$data_hroemployeeattendancedatalog = array (
						'monthly_period_id' 			=> $payrollmonthlyperiod['monthly_period_id'],
						'region_id'						=> $region_id,
						'branch_id'						=> $branch_id,
						'location_id'					=> $location_id,
						'monthly_period_start_date'		=> $payrollmonthlyperiod['monthly_period_start_date'],
						'monthly_period_end_date'		=> $payrollmonthlyperiod['monthly_period_end_date'],
						'created_id'					=> $auth['user_id'],
						'created_on'					=> date("Y-m-d H:i:s"),
					);	

					if ($this->hroemployeeattendancedata_model->insertHROEmployeeAttendanceDataLog($data_hroemployeeattendancedatalog)){
						$employee_attendance_data_log_id = $this->hroemployeeattendancedata_model->getEmployeeAttendanceDataLogID($data_hroemployeeattendancedatalog['created_id']);

						foreach ($hroemployeeattendance as $key => $val) {
							$coreshift 					= $this->hroemployeeattendancedata_model->getCoreShift_Detail($val['shift_id']);

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

								$data_hroemployeeattendancedata = array (
									'employee_attendance_data_log_id'			=> $employee_attendance_data_log_id,
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
									'employee_id'								=> $val['employee_id'],
									'monthly_period_id'							=> $payrollmonthlyperiod['monthly_period_id'],
									'employee_rfid_code'						=> $val['employee_rfid_code'],
									'monthly_period_start_date' 				=> $payrollmonthlyperiod['monthly_period_start_date'],
									'monthly_period_end_date' 					=> $payrollmonthlyperiod['monthly_period_end_date'],
									'employee_attendance_date'					=> $val['employee_attendance_date'],
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
									'created_id'								=> $data_hroemployeeattendancedatalog['created_id'],
									'created_on'								=> $data_hroemployeeattendancedatalog['created_on'],
								);

								/*print_r("data_hroemployeeattendancedata ");
								print_r($data_hroemployeeattendancedata);
								exit;*/

								$this->hroemployeeattendancedata_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedata);
							} else {
								$employee_attendance_in_date  		= $val['employee_attendance_out_date'];

								$employee_attendance_date 			= $val['employee_attendance_date'];

								$date 								= date_create($employee_attendance_date);
								date_add($date, date_interval_create_from_date_string("1 days"));
								$employee_attendance_next_date		= date_format($date, "Y-m-d");

								$employee_attendance_out_date		= $this->hroemployeeattendancedata_model->getEmployeeAttendanceOutDate($val['employee_id'], $employee_attendance_next_date);

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
							
								$data_hroemployeeattendancedata = array (
									'employee_attendance_data_log_id'			=> $employee_attendance_data_log_id,
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
									'employee_id'								=> $val['employee_id'],
									'monthly_period_id'							=> $payrollmonthlyperiod['monthly_period_id'],
									'employee_rfid_code'						=> $val['employee_rfid_code'],
									'monthly_period_start_date' 				=> $payrollmonthlyperiod['monthly_period_start_date'],
									'monthly_period_end_date' 					=> $payrollmonthlyperiod['monthly_period_end_date'],
									'employee_attendance_date'					=> $val['employee_attendance_date'],
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
									'created_id'								=> $data_hroemployeeattendancedatalog['created_id'],
									'created_on'								=> $data_hroemployeeattendancedatalog['created_on'],
								);

								$this->hroemployeeattendancedata_model->insertHROEmployeeAttendanceData($data_hroemployeeattendancedata);
							}

							

							/*print_r("data_hroemployeeattendancedata ");
							print_r($data_hroemployeeattendancedata);
							exit;*/

							
						}
					}

					
				} else {

				}

				
				$unique 					= $this->session->userdata('unique');
				$hroemployeeattendancedata 	= $this->session->userdata('addarrayhroemployeeattendancedata-'.$unique['unique']);
				redirect('hroemployeeattendancedata');
			}else{
				$data['password']='';
				$this->session->set_userdata('addcoreunit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('datashift_employeeattendancedate-'.$unique['unique']);
				redirect('hroemployeeattendancedata');
			}
		}
	}
?>