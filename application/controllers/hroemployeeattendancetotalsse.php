<?php
	Class hroemployeeattendancetotalsse extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancetotalsse_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeattendancetotalsse');
			if(!is_array($sesi)){
				$sesi['employee_shift_id']			= '';
				$sesi['employee_monthly_period']	= '';
			}

			$data['main_view']['scheduleemployeeshift']		= create_double($this->hroemployeeattendancetotalsse_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['main_view']['payrollmonthlyperiod']		= create_double($this->hroemployeeattendancetotalsse_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['main_view']['hroemployeeattendancetotalsse']	= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceTotal($region_id, $branch_id, $location_id, $sesi['employee_shift_id'], $sesi['employee_monthly_period']);

			$data['main_view']['content']					= 'hroemployeeattendancetotalsse/listhroemployeeattendancetotalsse_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_shift_id'			=> $this->input->post('employee_id',true),	
				'employee_monthly_period'	=> $this->input->post('division_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeattendancetotalsse',$data);
			redirect('hroemployeeattendancetotalsse');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeattendancetotalsse-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeattendancetotalsse-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeattendancetotalsse-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeattendancetotalsse-'.$unique['unique'],$sessions);
		}

		public function reset_search(){
			$this->session->unset_userdata('filter-hroemployeeattendancetotalsse');
			redirect('hroemployeeattendancetotalsse');
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeattendancetotalsse-'.$unique['unique']);	
			$this->session->unset_userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique']);	
			redirect('hroemployeeattendancetotalsse/addHROEmployeeAttendanceTotal');
		}
		
		public function addHROEmployeeAttendanceTotal(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$data['main_view']['scheduleemployeeshift']		= create_double($this->hroemployeeattendancetotalsse_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['main_view']['payrollmonthlyperiod']		= create_double($this->hroemployeeattendancetotalsse_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['main_view']['content']					= 'hroemployeeattendancetotalsse/formaddhroemployeeattendancetotalsse_view';
			$this->load->view('mainpage_view',$data);
		}
/*
		$date1 = new DateTime('2018-01-02');
			$date2 = new DateTime('2018-10-26');

			$diff = $date1->diff($date2);

			echo (($diff->format('%y') * 12) + $diff->format('%m')) . " full months difference";

			$months = (($diff->format('%y') * 12) + $diff->format('%m')) + ($diff->format('%d') / 30);

			
			print_r("diff ");
			print_r($diff);
			print_r("<BR>");

			print_r("months ");
			print_r($months);
			print_r("<BR>");

			print_r("employee_shift_id ");
			print_r($employee_shift_id);
			print_r("<BR>");
			print_r("employee_monthly_period ");
			print_r($employee_monthly_period);
			print_r("<BR>");*/

		public function processCalculateHROEmployeeAttendanceTotal(){
			$auth 							= $this->session->userdata('auth');
			$unique 						= $this->session->userdata('unique');
			$region_id 						= $auth['region_id'];
			$branch_id 						= $auth['branch_id'];
			$location_id 					= $auth['location_id'];
			$employee_shift_id				= $this->input->post('employee_shift_id',true);
			$employee_monthly_period 		= $this->input->post('employee_monthly_period',true);

			$payrollmonthlyperiod 			= $this->hroemployeeattendancetotalsse_model->getPayrollMonthlyPeriod_Detail($employee_monthly_period);

			$scheduleemployeeshiftitem 		= $this->hroemployeeattendancetotalsse_model->getScheduleEmployeeShiftItem_Detail($region_id, $branch_id, $location_id, $employee_shift_id);

			$hroemployeeattendancetotalsse 	= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceTotal_EmployeeShift($employee_shift_id, $employee_monthly_period);	

			$employeeattendancedatestatus 	= $this->configuration->EmployeeAttendanceDateStatus;

			$this->session->unset_userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique']);


			if (empty($hroemployeeattendancetotalsse)){	
				foreach ($scheduleemployeeshiftitem as $key => $val) {
					$employee_hire_date 			= $val['employee_hire_date'];
					$employee_employment_status 	= $val['employee_employment_status'];
					$employee_monthly_start_date 	= $payrollmonthlyperiod['monthly_period_start_date'];
					$employee_monthly_end_date	 	= $payrollmonthlyperiod['monthly_period_end_date'];
					$total_working_days 			= $payrollmonthlyperiod['monthly_period_working_days'];
					$employee_id 					= $val['employee_id'];

					$year_period 					= substr($payrollmonthlyperiod['monthly_period'], 0, 4);

					$date1 							= new DateTime($employee_hire_date);
					$date2 							= new DateTime($employee_monthly_start_date);

					$diff 							= $date1->diff($date2);

					$employee_working_months		= (($diff->format('%y') * 12) + $diff->format('%m')) + ($diff->format('%d') / 30);

					$hroemployeedata 				= $this->hroemployeeattendancetotalsse_model->getHROEmployeeData_Detail($employee_id);

					$hroemployeeatendancedata 		= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceData_Detail($employee_id, $employee_monthly_start_date, $employee_monthly_end_date);

					/*print_r("hroemployeeatendancedata ");
					print_r($hroemployeeatendancedata);
					print_r("<BR> ");
					print_r("<BR> ");
					print_r("<BR> ");*/

					$total_working_payroll_days 			= 0;
					$total_working_off_payroll_days 		= 0;
					$total_default_payroll_days 			= 0;
					$total_permit_with_doctor_days 			= 0;
					$total_permit_with_doctor_payroll_days 	= 0;
					$total_permit_no_doctor_days 			= 0;
					$total_permit_no_doctor_payroll_days 	= 0;
					$total_permit_no_doctor_days 			= 0;
					$total_permit_no_tapping_in 			= 0;
					$total_permit_no_tapping_out 			= 0;
					$total_absence_payroll_days 			= 0;
					$total_cancel_off_payrol_days 			= 0;
					$total_swap_off_payroll_days 			= 0;
					$total_early_days 						= 0;
					$total_early_payroll_less_1_days 		= 0;
					$total_early_payroll_less_5_days 		= 0;
					$total_early_payroll_more_5_days 		= 0;
					$total_early_hours_list 		 		= "";
					$total_late_days 						= 0;
					$total_late_hours 						= 0;
					$total_late_minutes 					= 0;
					$total_overtime_days 					= 0;
					$total_overtime_hours 					= 0;
					$total_overtime_minutes 				= 0;
					$total_overtime_hours_list				= "";

					if (!empty($hroemployeeatendancedata)){
						foreach ($hroemployeeatendancedata as $keyData => $valData) {
							$employee_attendance_date_status = $valData['employee_attendance_date_status'];

							switch ($employee_attendance_date_status) {
							    case 0:
							        $total_working_off_payroll_days ++;
							        break;
							    case 1:
							        $total_working_payroll_days ++;
							        break;
							    case 2:
							        $total_absence_payroll_days ++;
							        break;
							    case 3:
							        $total_permit_with_doctor_days ++;
							        break;
							   	case 4:
							        $total_permit_no_doctor_days ++;
							        break;
							   	case 6:
							        $total_cancel_off_payrol_days ++;
							        break;
							   	case 7:
							        $total_swap_off_payroll_days ++;
							        break;
							   	case 9:
							        $total_default_payroll_days ++;
							        break;
							   	case 10:
							        $total_permit_no_tapping_in ++;
							        break;
							   	case 11:
							        $total_permit_no_tapping_out ++;
							        break;
							}

							if ($valData['employee_attendance_late_status'] == 1){
								$total_late_days 	++;
								$total_late_hours 	+= $valData['employee_attendance_late_hours'];
								$total_late_minutes	+= $valData['employee_attendance_late_minutes'];

								if ($total_late_minutes > 60){
									$total_late_hours ++;
									$total_late_minutes = $total_late_minutes - 60;
								}
							}

							if ($valData['employee_attendance_overtime_status'] == 2){
								$total_overtime_days 	++;

								$total_overtime = $valData['employee_attendance_overtime_hours'] + ($valData['employee_attendance_overtime_minutes'] / 60);

								$total_overtime_hours = $total_overtime_hours + $valData['employee_attendance_overtime_hours'];

								$total_overtime_minutes = $total_overtime_minutes + $valData['employee_attendance_overtime_minutes'];

								$total_overtime = number_format($total_overtime, 2);

								if ($valData['employee_attendance_overtime_dayoff'] == 1){
									$overtime_list 			= $total_overtime."%1";

									$total_overtime_hours_list .= $overtime_list."#";
								} else {
									$overtime_list 			= $total_overtime."%0";

									$total_overtime_hours_list .= $overtime_list."#";
								}
							}

							if ($valData['employee_attendance_homeearly_status'] == 2){
								$total_early_days 	++;

								$total_working_homeearly = $valData['employee_attendance_homeearly_hours'] + ($valData['employee_attendance_homeearly_minutes'] / 60);

								$total_working_homeearly = number_format($total_working_homeearly, 2);

								if ($total_working_homeearly <= 1){
									$total_early_payroll_less_1_days ++;
								} else if (1 < $total_working_homeearly && $total_working_homeearly < 5) {
									$total_early_payroll_less_5_days ++;
									$total_early_hours_list .= $total_working_homeearly."#";
								} else if ($total_working_homeearly >= 5) {
									$total_early_payroll_more_5_days ++;
									$total_early_hours_list .= $total_working_homeearly."#";
								}
							}
						}

						$total_working_payroll_days = $total_working_payroll_days + $total_permit_no_tapping_in + $total_permit_no_tapping_out;

						$data_attendancetotalitem = array (
							'employee_id'							=> $employee_id, 
							'division_id'							=> $hroemployeedata['division_id'],
							'department_id'							=> $hroemployeedata['department_id'],
							'section_id'							=> $hroemployeedata['section_id'],
							'unit_id'								=> $hroemployeedata['unit_id'],
							'job_title_id'							=> $hroemployeedata['job_title_id'],
							'bank_id'								=> $hroemployeedata['bank_id'],
							'employee_bank_acct_no'					=> $hroemployeedata['employee_bank_acct_no'],
							'employee_bank_acct_name'				=> $hroemployeedata['employee_bank_acct_name'],
							'employee_monthly_period'				=> $employee_monthly_period,
							'employee_monthly_start_date'			=> $employee_monthly_start_date,
							'employee_monthly_end_date'				=> $employee_monthly_end_date,
							'employee_employment_status'			=> $hroemployeedata['employee_employment_status'],
							'employee_hire_date'					=> $hroemployeedata['employee_hire_date'],
							'employee_working_months'				=> $employee_working_months,
							'total_working_days'					=> $total_working_days,
							'total_working_payroll_days'			=> $total_working_payroll_days,
		  					'total_working_off_payroll_days'		=> $total_working_off_payroll_days,
							'total_default_payroll_days'			=> $total_default_payroll_days,
							'total_permit_with_doctor_days'			=> $total_permit_with_doctor_days,
							'total_permit_with_doctor_payroll_days'	=> $total_permit_with_doctor_days,
							'total_permit_no_doctor_days'			=> $total_permit_no_doctor_days,
							'total_permit_no_doctor_payroll_days'	=> $total_permit_no_doctor_days,
							'total_permit_no_tapping_in'			=> $total_permit_no_tapping_in,
							'total_permit_no_tapping_out'			=> $total_permit_no_tapping_out,
							'total_absence_payroll_days'			=> $total_absence_payroll_days,
							'total_cancel_off_payrol_days'			=> $total_cancel_off_payrol_days,
							'total_swap_off_payroll_days'			=> $total_swap_off_payroll_days,
							'total_early_days'						=> $total_early_days,
							'total_early_payroll_less_1_days'		=> $total_early_payroll_less_1_days,
							'total_early_payroll_less_5_days'		=> $total_early_payroll_less_5_days,
							'total_early_payroll_more_5_days'		=> $total_early_payroll_more_5_days,
							'total_early_hours_list'				=> $total_early_hours_list,
							'total_late_days'	  					=> $total_late_days,
							'total_late_hours'						=> $total_late_hours,
							'total_late_minutes'					=> $total_late_minutes,
							'total_overtime_days'					=> $total_overtime_days,
							'total_overtime_hours'				  	=> $total_overtime_hours,
							'total_overtime_minutes'				=> $total_overtime_minutes,
							'total_overtime_hours_list'				=> $total_overtime_hours_list,
						);

						$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique']);
						$dataArrayHeader[$data_attendancetotalitem['employee_id']] = $data_attendancetotalitem;

						$this->session->set_userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique'],$dataArrayHeader);
					}
				}
			} else{
				$msg = "<div class='alert alert-danger'>                
							Add Data Employee Attendance Total Fail - Data Already Exist
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeattendancetotalsse/addHROEmployeeAttendanceTotal/');
			}

			$data['main_view']['scheduleemployeeshift']			= create_double($this->hroemployeeattendancetotalsse_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['main_view']['payrollmonthlyperiod']			= create_double($this->hroemployeeattendancetotalsse_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['main_view']['content']						= 'hroemployeeattendancetotalsse/formaddhroemployeeattendancetotalsse_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddHROEmployeeAttendanceTotal(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$session_hroemployeeattendancetotalsse			= $this->session->userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique']);

			foreach ($session_hroemployeeattendancetotalsse as $key => $val) {
				$employee_monthly_start_date 	= $val['employee_monthly_start_date'];
				$employee_monthly_end_date 		= $val['employee_monthly_end_date'];
			}

			$data = array(
				'region_id' 					=> $auth['region_id'],
				'branch_id' 					=> $auth['branch_id'],
				'location_id'					=> $auth['location_id'],
				'employee_shift_id'				=> $this->input->post('employee_shift_id',true),
				'employee_monthly_period'		=> $this->input->post('employee_monthly_period',true),
				'employee_monthly_start_date'	=> tgltodb($employee_monthly_start_date),
				'employee_monthly_end_date'		=> tgltodb($employee_monthly_end_date),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s"),
			);

			$this->form_validation->set_rules('employee_shift_id', 'Employee Shift Code', 'required');
			$this->form_validation->set_rules('employee_monthly_period', 'Monthly Period', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeattendancetotalsse_model->insertHROEmployeeAttendanceTotal($data)){
					$employee_attendance_total_id = $this->hroemployeeattendancetotalsse_model->getEmployeeAttendanceTotalID($data['created_id']);

					if(!empty($session_hroemployeeattendancetotalsse)){
						foreach($session_hroemployeeattendancetotalsse as $key => $val){
							$data_hroemployeeattendancetotalsseitem = array(
								'employee_attendance_total_id'			=> $employee_attendance_total_id, 
								'employee_id'							=> $val['employee_id'], 
								'division_id'							=> $val['division_id'],
								'department_id'							=> $val['department_id'],
								'section_id'							=> $val['section_id'],
								'unit_id'								=> $val['unit_id'],
								'job_title_id'							=> $val['job_title_id'],
								'bank_id'								=> $val['bank_id'],
								'employee_bank_acct_no'					=> $val['employee_bank_acct_no'],
								'employee_bank_acct_name'				=> $val['employee_bank_acct_name'],
								'employee_monthly_period'				=> $val['employee_monthly_period'],
								'employee_monthly_start_date'			=> $val['employee_monthly_start_date'],
								'employee_monthly_end_date'				=> $val['employee_monthly_end_date'],
								'employee_employment_status'			=> $val['employee_employment_status'],
								'employee_hire_date'					=> $val['employee_hire_date'],
								'employee_working_months'				=> $val['employee_working_months'],
								'total_working_days'					=> $val['total_working_days'],
								'total_working_payroll_days'			=> $val['total_working_payroll_days'],
			  					'total_working_off_payroll_days'		=> $val['total_working_off_payroll_days'],
								'total_default_payroll_days'			=> $val['total_default_payroll_days'],
								'total_permit_with_doctor_days'			=> $val['total_permit_with_doctor_days'],
								'total_permit_with_doctor_payroll_days'	=> $val['total_permit_with_doctor_payroll_days'],
								'total_permit_no_doctor_days'			=> $val['total_permit_no_doctor_days'],
								'total_permit_no_doctor_payroll_days'	=> $val['total_permit_no_doctor_payroll_days'],
								'total_permit_no_tapping_in'			=> $val['total_permit_no_tapping_in'],
								'total_permit_no_tapping_out'			=> $val['total_permit_no_tapping_out'],
								'total_absence_payroll_days'			=> $val['total_absence_payroll_days'],
								'total_cancel_off_payrol_days'			=> $val['total_cancel_off_payrol_days'],
								'total_swap_off_payroll_days'			=> $val['total_swap_off_payroll_days'],
								'total_early_days'						=> $val['total_early_days'],
								'total_early_payroll_less_1_days'		=> $val['total_early_payroll_less_1_days'],
								'total_early_payroll_less_5_days'		=> $val['total_early_payroll_less_5_days'],
								'total_early_payroll_more_5_days'		=> $val['total_early_payroll_more_5_days'],
								'total_early_hours_list'				=> $val['total_early_hours_list'],
								'total_late_days'	  					=> $val['total_late_days'],
								'total_late_hours'						=> $val['total_late_hours'],
								'total_late_minutes'					=> $val['total_late_minutes'],
								'total_overtime_days'					=> $val['total_overtime_days'],
								'total_overtime_hours'				  	=> $val['total_overtime_hours'],
								'total_overtime_minutes'				=> $val['total_overtime_minutes'],
								'total_overtime_hours_list'				=> $val['total_overtime_hours_list'],
							);
							$this->hroemployeeattendancetotalsse_model->insertHROEmployeeAttendanceTotalItem($data_hroemployeeattendancetotalsseitem);
						}
					}

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAttendanceTotal.processAddHROEmployeeAttendanceTotal',$auth['user_id'],'Add New HRO Employee Attendance Total');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Attendance Total Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addhroemployeeattendancetotalsse-'.$unique['unique']);
					$this->session->unset_userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique']);
					redirect('hroemployeeattendancetotalsse/addHROEmployeeAttendanceTotal/');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Attendance Total Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeattendancetotalsse/addHROEmployeeAttendanceTotal/');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeattendancetotalsse/addHROEmployeeAttendanceTotal/');
			}
		}

		public function showdetail(){
			$employee_attendance_total_id = $this->uri->segment(3);

			$data['main_view']['hroemployeeattendancetotalsse']		= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceTotal_Detail($employee_attendance_total_id);

			$data['main_view']['hroemployeeattendancetotalsseitem']	= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceTotalItem_Detail($employee_attendance_total_id);
			
			$data['main_view']['content']							= 'hroemployeeattendancetotalsse/formdetailhroemployeeattendancetotalsse_view';

			$this->load->view('mainpage_view',$data);
		}	


		public function exportHROEmployeeAttendanceTotal(){
			$employee_attendance_total_id 		= $this->uri->segment(3);

			$hroemployeeattendancetotalsse			= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceTotal_Detail($employee_attendance_total_id);

			$hroemployeeattendancetotalsseitem		= $this->hroemployeeattendancetotalsse_model->getHROEmployeeAttendanceTotalItem_Detail($employee_attendance_total_id);
			
			if(!empty($hroemployeeattendancetotalsseitem)){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Sukses Sejahtera Energi")
									 ->setLastModifiedBy("PT. Sukses Sejahtera Energi")
									 ->setTitle("Employee Attendance Total")
									 ->setSubject("")
									 ->setDescription("Employee Attendance Total")
									 ->setKeywords("Employee, Attendance, Total")
									 ->setCategory("Employee Attendance Total");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
				$this->excel->getActiveSheet()->getPageMargins()->setTop(0.5);
				$this->excel->getActiveSheet()->getPageMargins()->setLeft(0.1);
				$this->excel->getActiveSheet()->getPageMargins()->setRight(0.1);
				$this->excel->getActiveSheet()->getPageMargins()->setBottom(0.1);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
				
				$this->excel->getActiveSheet()->mergeCells("B1:Y1");
		
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:Y3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:Y3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:Y3')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('B1',"Employee Attendance Total");


				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Kode Group");
				$this->excel->getActiveSheet()->setCellValue('D3',"Nama Karyawan");
				$this->excel->getActiveSheet()->setCellValue('E3',"Nama Divisi");
				$this->excel->getActiveSheet()->setCellValue('F3',"Nama Department");
				$this->excel->getActiveSheet()->setCellValue('G3',"Nama Bagian");	
				$this->excel->getActiveSheet()->setCellValue('H3',"Jabatan");
				$this->excel->getActiveSheet()->setCellValue('I3',"Periode");	
				$this->excel->getActiveSheet()->setCellValue('J3',"Tanggal Awal Periode");
				$this->excel->getActiveSheet()->setCellValue('K3',"Tanggal Akhir Periode");
				$this->excel->getActiveSheet()->setCellValue('L3',"Status Karyawan");
				$this->excel->getActiveSheet()->setCellValue('M3',"Tanggal Masuk");
				$this->excel->getActiveSheet()->setCellValue('N3',"Sudah Bekerja");
				$this->excel->getActiveSheet()->setCellValue('O3',"Total Hari Kerja");
				$this->excel->getActiveSheet()->setCellValue('P3',"Ijin Sakit");
				$this->excel->getActiveSheet()->setCellValue('Q3',"Ijin Biasa");	
				$this->excel->getActiveSheet()->setCellValue('R3',"Ijin Tidak Absen");	
				$this->excel->getActiveSheet()->setCellValue('S3',"Mangkir");
				$this->excel->getActiveSheet()->setCellValue('T3',"Total Lembur");
				/*$this->excel->getActiveSheet()->setCellValue('T3',"Lembur Menit");*/
				/*$this->excel->getActiveSheet()->setCellValue('S3',"Telat ( hari )");
				$this->excel->getActiveSheet()->setCellValue('T3',"Telat ( jam )");*/
				/*$this->excel->getActiveSheet()->setCellValue('U3',"Total Late Minutes");
				$this->excel->getActiveSheet()->setCellValue('V3',"Total Overtime Days");
				
				$this->excel->getActiveSheet()->setCellValue('Y3',"Total Overtime Hours");*/

				
				$m = 0;
				$j=4;
				$no=0;
				
				foreach($hroemployeeattendancetotalsseitem as $key=>$val){
					if(is_numeric($key)){
						$no++;
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':K'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':K'.$j)->getFont()->setSize(12);
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('E'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('F'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('G'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('H'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('I'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('J'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('K'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

						$this->excel->getActiveSheet()->getStyle('L'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('M'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('N'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('O'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('P'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('Q'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('R'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('S'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('T'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('U'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('V'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('W'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('X'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('Y'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

						$total_overtime = ( $val['total_overtime_hours'] * 60 ) + $val['total_overtime_minutes'];

						$total_overtime_hours 	= floor($total_overtime / 60);

						$total_overtime_minutes = $total_overtime % 60;

						$total_overtime_str 	= $total_overtime_hours." Jam ".$total_overtime_minutes." Menit ";

						$total_no_tapping 			= $val['total_permit_no_tapping_in'] + $val['total_permit_no_tapping_out'];

						$total_working_years 	= floor($val['employee_working_months'] / 12);

						$total_working_months	= $val['employee_working_months'] % 12;

						$employee_total_working	= $total_working_years." Tahun ".$total_working_months." Bulan ";

						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $hroemployeeattendancetotalsse['employee_shift_code']);
						$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['employee_name']);
						$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['division_name']);
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['department_name']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['section_name']);
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['job_title_name']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, $val['employee_monthly_period']);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['employee_monthly_start_date']);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, $val['employee_monthly_end_date']);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $this->configuration->EmployeeStatus[$val['employee_employment_status']]);
						$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['employee_hire_date']);
						$this->excel->getActiveSheet()->setCellValue('N'.$j, $employee_total_working);
						$this->excel->getActiveSheet()->setCellValue('O'.$j, $val['total_working_payroll_days']);
						$this->excel->getActiveSheet()->setCellValue('P'.$j, $val['total_permit_with_doctor_days']);
						$this->excel->getActiveSheet()->setCellValue('Q'.$j, $val['total_permit_no_doctor_days']);
						$this->excel->getActiveSheet()->setCellValue('R'.$j, $total_no_tapping);
						$this->excel->getActiveSheet()->setCellValue('S'.$j, $val['total_absence_payroll_days']);
						$this->excel->getActiveSheet()->setCellValue('T'.$j, $total_overtime_str);

						/*$this->excel->getActiveSheet()->setCellValue('S'.$j, $val['total_late_days']);
						$this->excel->getActiveSheet()->setCellValue('T'.$j, $val['total_late_hours']);
						$this->excel->getActiveSheet()->setCellValue('U'.$j, $val['total_late_minutes']);
						$this->excel->getActiveSheet()->setCellValue('V'.$j, $val['total_overtime_days']);
						$this->excel->getActiveSheet()->setCellValue('W'.$j, $val['total_overtime_hours']);
						$this->excel->getActiveSheet()->setCellValue('X'.$j, $val['total_overtime_minutes']);
						$this->excel->getActiveSheet()->setCellValue('Y'.$j, $val['total_overtime_hours_list']);
*/
						$employee_monthly_period = $val['employee_monthly_period'];
						$employee_monthly_start_date = $val['employee_monthly_start_date'];
						$employee_monthly_end_date = $val['employee_monthly_end_date'];
					}else{
						continue;
					}
					
					$j++;
				}

				$filename='Employee_Attendance_Total_'.$hroemployeeattendancetotalsse['employee_shift_code'].'_'.$employee_monthly_period.'_'.$employee_monthly_start_date.'_'.$employee_monthly_end_date.'.xls';

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');
							 
				$objWriter = IOFactory::createWriter($this->excel, 'Excel5');  
				ob_end_clean();
				$objWriter->save('php://output');
			}else{
				echo "No available data !";
			}
		}
	}
?>