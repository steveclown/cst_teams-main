<?php
	Class payrollemployeedaily extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeedaily_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeedaily');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeedaily_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->payrollemployeedaily_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->payrollemployeedaily_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeedaily_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_daily']	= $this->payrollemployeedaily_model->getHROEmployeeData_Daily($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeedaily/listpayrollemployeedaily_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeedaily',$data);
			redirect('payrollemployeedaily');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeedaily-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeedaily-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeedaily-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeedaily-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeedaily');
			$this->session->unset_userdata('filter-payrollemployeedaily');
			redirect('payrollemployeedaily');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeedaily-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayemployeeallowance-'.$sesi['unique']);
			redirect('payrollemployeedaily');
		}
		
		public function addPayrollEmployeeDaily(){
			$employee_id = $this->uri->segment(3);	

			$employee_hire_date = $this->payrollemployeedaily_model->getEmployeeHireDate($employee_id);

			$payrolldailyperiod 	= $this->payrollemployeedaily_model->getPayrollDailyPeriod();
			$year_period = date("Y", strtotime($payrolldailyperiod['daily_period_start_date']));
			$daily_period_end_date = $payrolldailyperiod['daily_period_end_date'];

			$lengthofservice = date_diff(date_create($daily_period_end_date), date_create($employee_hire_date));
			$length_of_service_month = ($lengthofservice->days) / 30;

			$payrollemployeelengthservice = $this->payrollemployeedaily_model->getPayrollEmployeeLengthService($employee_id, $length_of_service_month, $year_period);

			$employee_length_service_amount = $payrollemployeelengthservice['employee_length_service_amount'];

			$payrollemployeepayment = $this->payrollemployeedaily_model->getPayrollEmployeePayment($employee_id);

			/*Leave Calculation*/
			$payrollleaverequest 	= $this->payrollemployeedaily_model->getPayrollLeaveRequest($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$leave_request_days 	= count($payrollleaverequest);

			/*Day Off*/
			$hroemployeeworkingdayoff 	= $this->payrollemployeedaily_model->getHROmployeeWorkingDayOff($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$working_dayoff_days 	= count($hroemployeeworkingdayoff);


			/*Overtime*/
			$payrollovertimerequest 	= $this->payrollemployeedaily_model->getPayrollOvertimeRequest($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);


			/*Home Early*/
			$hroemployeehomeearlydaily 	= $this->payrollemployeedaily_model->getHROEmployeeHomeEarlyDaily($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);


			$payrollemployeeallowance = $this->payrollemployeedaily_model->getPayrollEmployeeAllowance($employee_id, $year_period);


			/*Deduction*/
			/*Absence*/
			$hroemployeeabsence 	= $this->payrollemployeedaily_model->getHROEmployeeAbsence($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$employee_absence_days 	= count($hroemployeeabsence);


			/*Permit*/
			$hroemployeepermit 		= $this->payrollemployeedaily_model->getHROEmployeePermit($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$employee_permit_days 	= count($hroemployeepermit);

			/*Late*/
			$hroemployeelate 		= $this->payrollemployeedaily_model->getHROEmployeeLate($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$employee_late_days 	= count($hroemployeelate);

			
			$payrollemployeededuction = $this->payrollemployeedaily_model->getPayrollEmployeeDeduction($employee_id, $year_period);


			/*Calculate Home Early*/

			if ($payrollemployeepayment['payment_home_early_status'] == 0){
				$home_early_hour = 0;
				$home_early_day = 0;
				foreach ($hroemployeehomeearlydaily as $keyHomeEarlyDaily=>$valHomeEarlyDaily){
					$home_early_hour = $home_early_hour + $valHomeEarlyDaily['employee_home_early_daily_hour'];				
				}

				$home_early_amount = $payrollemployeepayment['payment_home_early_amount'];
				$home_early_total_amount = $home_early_amount * $home_early_hour;	
			}else {
				$company_home_early_minimum_hour = $this->payrollemployeedaily_model->getCompanyHomeEarlyMinimumHour();

				$home_early_hour = 0;
				$home_early_day = 0;
				foreach ($hroemployeehomeearlydaily as $keyHomeEarlyDaily => $valHomeEarlyDaily) {
					$employee_home_early_daily_hour = $valHomeEarlyDaily['employee_home_early_daily_hour'];					
					if ($employee_home_early_daily_hour >= $company_home_early_minimum_hour){
						$home_early_hour++;
						$home_early_day++;
					}
				}

				$home_early_amount = $payrollemployeepayment['payment_home_early_amount'];
				$home_early_total_amount = $home_early_amount * $home_early_hour;	
			}

			
			$employee_daily_working_days = $payrolldailyperiod['daily_period_working_days'] + $working_dayoff_days - $leave_request_days - $employee_absence_days - ($home_early_day * 0.5) - $employee_permit_days;

			$payroll_daily_allowance_total = 0;

			foreach ($payrollemployeeallowance as $keyAllowance=>$valAllowance){
				$employee_allowance_amount = $valAllowance['employee_allowance_amount'];
				$allowance_type = $valAllowance['allowance_type'];

				switch ($allowance_type) {
				    case 0:
				        $employee_daily_allowance_days = 1;
						$employee_allowance_subtotal = $employee_allowance_amount;
				        break;
				    case 1:
				        $employee_daily_allowance_days = $employee_daily_working_days;
						$employee_allowance_subtotal = $employee_daily_working_days * $employee_allowance_amount;
				        break;
				    case 2:
				        $employee_daily_allowance_days = $leave_request_days;
						$employee_allowance_subtotal = $leave_request_days * $employee_allowance_amount;
				        break;
				  	case 3:     
				  		$employee_daily_allowance_days = $working_dayoff_days;
						$employee_allowance_subtotal = $working_dayoff_days * $employee_allowance_amount;
						break;
				}


				$payroll_daily_allowance_total = $payroll_daily_allowance_total + $employee_allowance_subtotal;

				$data_payrollemployeeallowance = array(
					'employee_daily_allowance_id'		=> date("YmdHis"),
					'employee_id' 						=> $valAllowance['employee_id'],
					'allowance_id' 						=> $valAllowance['allowance_id'],
					'employee_allowance_id'				=> $valAllowance['employee_allowance_id'],
					'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
					'employee_allowance_amount'			=> $valAllowance['employee_allowance_amount'],
					'employee_daily_working_days'		=> $employee_daily_working_days,
					'employee_daily_allowance_days'		=> $employee_daily_allowance_days,
					'employee_allowance_subtotal'		=> $employee_allowance_subtotal,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeallowance['allowance_id']] = $data_payrollemployeeallowance;
				$this->session->set_userdata('addarrayemployeeallowance-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeallowance = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeallowance);
			}

			$payroll_daily_deduction_total = 0;
			foreach ($payrollemployeededuction as $keyDeduction=>$valDeduction){
				$employee_deduction_amount = $valDeduction['employee_deduction_amount'];
				$deduction_type = $valDeduction['deduction_type'];

				switch ($deduction_type) {
				    case 0:
				        $employee_daily_deduction_days = 1;
						$employee_deduction_subtotal = $employee_deduction_amount;
				        break;
				    case 1:
				        $employee_daily_deduction_days = $employee_absence_days;
						$employee_deduction_subtotal = $employee_absence_days * $employee_deduction_amount;
				        break;
				    case 2:
				    	$employeee_permit_days = 0;
				    	foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				    		$deduction_type_permit = $valPermit['deduction_type'];
				    		if ($deduction_type_permit == 2){
				    			$employeee_permit_days++;
				    		}
				    	}
				        $employee_daily_deduction_days = $employeee_permit_days;
						$employee_deduction_subtotal = $employeee_permit_days * $employee_deduction_amount;
				        break;
				  	case 3:     
				  		$employeee_sick_days = 0;
				    	foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				    		$deduction_type_permit = $valPermit['deduction_type'];
				    		if ($deduction_type_permit == 3){
				    			$employeee_sick_days++;
				    		}
				    	}
				  		$employee_daily_deduction_days = $employeee_sick_days;
						$employee_deduction_subtotal = $employeee_sick_days * $employee_deduction_amount;
						break;
					case 5:     
				  		$employee_daily_deduction_days = $employee_late_days;
						$employee_deduction_subtotal = $employee_late_days * $employee_deduction_amount;
						break;
					case 6:     
						$employee_nowork_days = 0;
				    	foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				    		$deduction_type_permit = $valPermit['deduction_type'];
				    		if ($deduction_type_permit == 6){
				    			$employee_nowork_days++;
				    		}
				    	}
				  		$employee_daily_deduction_days = $employee_nowork_days;
						$employee_deduction_subtotal = $employee_nowork_days * $employee_deduction_amount;
						break;
				}

				$payroll_daily_deduction_total = $payroll_daily_deduction_total + $employee_deduction_subtotal;

				$data_payrollemployeededuction = array(
					'employee_daily_deduction_id'		=> date("YmdHis"),
					'employee_id' 						=> $valDeduction['employee_id'],
					'deduction_id' 						=> $valDeduction['deduction_id'],
					'deduction_type' 					=> $deduction_type,
					'employee_deduction_id'				=> $valDeduction['employee_deduction_id'],
					'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
					'employee_deduction_amount'			=> $valDeduction['employee_deduction_amount'],
					'employee_daily_working_days'		=> $employee_daily_working_days,
					'employee_daily_deduction_days'		=> $employee_daily_deduction_days,
					'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
				$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeededuction);
			}

			/*Calculate Overtime*/
			$overtime_working_hour_total = 0;
			$overtime_day_off_total = 0;
			foreach($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$overtime_request_date = $valOvertime['overtime_request_date'];

				$day_name = date("D", strtotime($overtime_request_date));

				$dayoff_date = $this->payrollemployeedaily_model->getDayOffDate($overtime_request_date);

				if ($day_name != "Sun" && count($dayoff_date) == 0){
					$overtime_working_hour_total = $overtime_working_hour_total + $valOvertime['overtime_request_duration'];
					$overtime_working_day_remark = 'Lembur Hari Kerja';
				} else {
					$overtime_day_off_total = $overtime_day_off_total + $valOvertime['overtime_request_duration'];
					$overtime_day_off_remark = 'Lembur Hari Libur';
				}
			}

			$overtime_request_amount = $this->payrollemployeedaily_model->getPaymentBasicOvertime($employee_id, $year_period);

			$coreovertimetype = $this->payrollemployeedaily_model->getCoreOvertimeType();


			if ($overtime_working_hour_total < $coreovertimetype['overtime_type_working_day_hour1']){
				$overtime_type_working_day_hour_amount1 = $overtime_working_hour_total * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 	
			}else {
				$overtime_type_working_day_hour_amount1 = $coreovertimetype['overtime_type_working_day_hour1'] * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 
			}

			if ($overtime_working_hour_total > $coreovertimetype['overtime_type_working_day_hour1']){
				$overtime_type_working_day_hour_amount2 = ($overtime_working_hour_total - $coreovertimetype['overtime_type_working_day_hour1']) * $coreovertimetype['overtime_type_working_day_ratio2'] * $overtime_request_amount;
			}else{

			}

			if ($overtime_day_off_total < $coreovertimetype['overtime_type_day_off_hour1']){
				$overtime_type_day_off_hour_amount1 = $overtime_day_off_total * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
			}else {
				$overtime_type_day_off_hour_amount1 = $coreovertimetype['overtime_type_day_off_hour1'] * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
			}

			if ($overtime_day_off_total > $coreovertimetype['overtime_type_day_off_hour1']){
				$overtime_type_day_off_hour_amount2 = ($overtime_day_off_total - $coreovertimetype['overtime_type_day_off_hour1']) * $coreovertimetype['overtime_type_day_off_ratio2'] * $overtime_request_amount;
			}

			$employee_overtime_amount_total = $overtime_type_working_day_hour_amount1 + $overtime_type_working_day_hour_amount2 + $overtime_type_day_off_hour_amount1 + $overtime_type_day_off_hour_amount2;

			$this->session->unset_userdata('addarrayemployeeovertime-'.$sesi['unique']);

			$data_payrollemployeeovertime = array(
				'employee_id' 						=> $employee_id,
				'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
				'employee_basic_overtime'			=> $overtime_request_amount,
				'employee_overtime_daily_total1'	=> $overtime_type_working_day_hour_amount1,
				'employee_overtime_daily_total2'	=> $overtime_type_working_day_hour_amount2,
				'employee_overtime_dayoff_total1'	=> $overtime_type_day_off_hour_amount1,
				'employee_overtime_dayoff_total2'	=> $overtime_type_day_off_hour_amount2,
				'employee_overtime_amount_total'	=> $employee_overtime_amount_total,
			);

			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
			$dataArrayHeader[$data_payrollemployeeovertime['employee_id']] = $data_payrollemployeeovertime;
			$this->session->set_userdata('addarrayemployeeovertime-'.$unique['unique'],$dataArrayHeader);
			$sesi 	= $this->session->userdata('unique');
			$data_payrollemployeeovertime = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);
			$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeovertime);

			$this->session->unset_userdata('addarrayemployeehomeearly-'.$sesi['unique']);

			$data_payrollemployeedailyearly = array(
				'employee_id' 					=> $employee_id,
				'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				'home_early_hour'				=> $home_early_hour,
				'home_early_amount'				=> $home_early_amount,
				'home_early_total_amount'		=> $home_early_total_amount,
			);

			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$dataArrayHeader[$data_payrollemployeedailyearly['employee_id']] = $data_payrollemployeedailyearly;
			$this->session->set_userdata('addarrayemployeehomeearly-'.$unique['unique'],$dataArrayHeader);
			$sesi 	= $this->session->userdata('unique');
			$data_payrollemployeedailyearly = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);
			$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeedailyearly);

			$payrollemployeebpjs			= $this->payrollemployeedaily_model->getPayrollEmployeeBPJS($employee_id);

			if ($payrolldailyperiod['daily_period_working_days'] == $employee_daily_working_days){
				$payrollemployeepremiattendance = $this->payrollemployeedaily_model->getPayrollEmployeePremiAttendance($employee_id, $year_period);

				$employee_premi_attendance_amount = $payrollemployeepremiattendance['employee_premi_attendance_amount'];
			}else {
				$employee_premi_attendance_amount = 0;
			}

			if ($payrolldailyperiod['daily_period_include_bpjs'] == 1){
				$employee_daily_salary_total = $payrollemployeepayment['payment_basic_salary'] + $payroll_daily_allowance_total + $payroll_daily_deduction_total + $employee_overtime_amount_total + $home_early_total_amount + $payrollemployeebpjs['bpjs_total_amount'] + $employee_length_service_amount + $employee_premi_attendance_amount;
			}else{
				$employee_daily_salary_total = $payrollemployeepayment['payment_basic_salary'] + $payroll_daily_allowance_total + $payroll_daily_deduction_total + $employee_overtime_amount_total + $home_early_total_amount + $employee_length_service_amount + $employee_premi_attendance_amount;
			}

			$data_payrollemployeedaily = array(
				'employee_daily_id'					=> date("YmdHis"),
				'employee_id' 						=> $employee_id,
				'employee_daily_working_days'		=> $employee_daily_working_days,
				'length_service_month'				=> $length_of_service_month,
				'employee_length_service_amount'	=> $employee_length_service_amount,
				'employee_premi_attendance_amount'	=> $employee_premi_attendance_amount,
				'employee_daily_salary_total'		=> $employee_daily_salary_total,
				'employee_daily_bpjs_amount'		=> $payrollemployeebpjs['bpjs_total_amount'],
			);

			foreach ($payrollleaverequest as $keyLeaveRequest=>$valLeaveRequest){
				$data_payrollleaverequest = array(
					'leave_request_detail_id' 			=> $valLeaveRequest['leave_request_detail_id'],
					'employee_id' 						=> $valLeaveRequest['employee_id'],
					'annual_leave_id'					=> $valLeaveRequest['annual_leave_id'],
					'leave_request_detail_date'			=> $valLeaveRequest['leave_request_detail_date'],
					'leave_request_description'			=> $valLeaveRequest['leave_request_description'],
					'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollleaverequest['leave_request_detail_id']] = $data_payrollleaverequest;

				$this->session->set_userdata('addarrayemployeeleaverequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollleaverequest = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollleaverequest);
			}

			foreach ($hroemployeeabsence as $keyAbsence=>$valAbsence){
				$data_payrollemployeeabsence = array(
					'employee_absence_detail_id'	=> $valAbsence['employee_absence_detail_id'],
					'employee_id' 					=> $valAbsence['employee_id'],
					'absence_id'					=> $valAbsence['absence_id'],
					'employee_absence_description'	=> $valAbsence['employee_absence_description'],
					'employee_absence_detail_date'	=> $valAbsence['employee_absence_detail_date'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeabsence['employee_absence_detail_id']] = $data_payrollemployeeabsence;

				$this->session->set_userdata('addarrayemployeeabsence-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeabsence = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeabsence);
			}
			
			foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				$data_payrollemployeepermit = array(
					'employee_permit_detail_id'		=> $valPermit['employee_permit_detail_id'],
					'employee_id' 					=> $valPermit['employee_id'],
					'permit_id'						=> $valPermit['permit_id'],
					'permit_type'					=> $valPermit['permit_type'],
					'deduction_type'				=> $valPermit['deduction_type'],
					'employee_permit_description'	=> $valPermit['employee_permit_description'],
					'employee_permit_detail_date'	=> $valPermit['employee_permit_detail_date'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeepermit['employee_permit_detail_id']] = $data_payrollemployeepermit;

				$this->session->set_userdata('addarrayemployeepermit-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeepermit = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeepermit);
			}

			foreach ($hroemployeeworkingdayoff as $keyDayOff=>$valDayOff){
				$data_payrollemployeedayoff = array(
					'working_dayoff_detail_id'				=> $valDayOff['working_dayoff_detail_id'],
					'employee_id' 							=> $valDayOff['employee_id'],
					'dayoff_id'								=> $valDayOff['dayoff_id'],
					'employee_working_dayoff_description'	=> $valDayOff['employee_working_dayoff_description'],
					'working_dayoff_detail_date'			=> $valDayOff['working_dayoff_detail_date'],
					'employee_daily_period'					=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeedayoff['working_dayoff_detail_id']] = $data_payrollemployeedayoff;

				$this->session->set_userdata('addarrayemployeedayoff-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeedayoff = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeedayoff);
			}
			
			$data_payrollemployeedayoff = $this->session->userdata('addarrayemployeedayoff-'.$sesi['unique']);

			foreach ($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$data_payrollemployeeovertimerequest = array(
					'overtime_request_id'			=> $valOvertime['overtime_request_id'],
					'employee_id' 					=> $valOvertime['employee_id'],
					'overtime_type_id'				=> $valOvertime['overtime_type_id'],
					'overtime_request_description'	=> $valOvertime['overtime_request_description'],
					'overtime_request_date'			=> $valOvertime['overtime_request_date'],
					'overtime_request_duration'		=> $valOvertime['overtime_request_duration'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeovertimerequest['overtime_request_id']] = $data_payrollemployeeovertimerequest;

				$this->session->set_userdata('addarrayemployeeovertimerequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeovertimerequest = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeovertimerequest);
			}
			
			foreach ($hroemployeelate as $keyLate=>$valLate){
				$data_payrollemployeelate = array(
					'employee_late_id'				=> $valLate['employee_late_id'],
					'employee_id' 					=> $valLate['employee_id'],
					'late_id'						=> $valLate['late_id'],
					'employee_late_description'		=> $valLate['employee_late_description'],
					'employee_late_date'			=> $valLate['employee_late_date'],
					'employee_late_duration'		=> $valLate['employee_late_duration'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeelate['employee_late_id']] = $data_payrollemployeelate;

				$this->session->set_userdata('addarrayemployeelate-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeelate = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeelate);
			}
			
			foreach ($hroemployeehomeearlydaily as $keyHomeEarly=>$valHomeEarly){
				$data_payrollemployeehomeearlydaily = array(
					'employee_home_early_daily_id'				=> $valHomeEarly['employee_home_early_daily_id'],
					'employee_id' 								=> $valHomeEarly['employee_id'],
					'employee_home_early_daily_description'		=> $valHomeEarly['employee_home_early_daily_description'],
					'employee_home_early_daily_date'			=> $valHomeEarly['employee_home_early_daily_date'],
					'employee_home_early_daily_hour'			=> $valHomeEarly['employee_home_early_daily_hour'],
					'employee_daily_period'						=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearlydaily-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeehomeearlydaily['employee_home_early_daily_id']] = $data_payrollemployeehomeearlydaily;

				$this->session->set_userdata('addarrayemployeehomeearlydaily-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeehomeearlydaily = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeehomeearlydaily);
			}

			$data['main_view']['hroemployeedata']				= $this->payrollemployeedaily_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeedaily_data']		= $this->payrollemployeedaily_model->getPayrollEmployeeDaily_Data($employee_id);
			
			$data['main_view']['payrollemployeepayment']		= $payrollemployeepayment;
			$data['main_view']['payrolldailyperiod']			= $payrolldailyperiod;
			$data['main_view']['payrollemployeedaily']			= $data_payrollemployeedaily;

			$data['main_view']['content']						= 'payrollemployeedaily/listaddpayrollemployeedaily_view';
			$this->load->view('mainpage_view',$data);
		}


		public function processCalculatePayrollEmployeeDaily(){
			$employee_id 							= $this->input->post('employee_id',true);
			$employee_daily_allowance_other 		= $this->input->post('employee_daily_allowance_other',true);
			$employee_daily_allowance_description 	= $this->input->post('employee_daily_allowance_description',true);
			$employee_daily_deduction_other 		= $this->input->post('employee_daily_deduction_other',true);
			$employee_daily_deduction_description 	= $this->input->post('employee_daily_deduction_description',true);
			$employee_daily_date 					= $this->input->post('employee_daily_date',true);

			$payrolldailyperiod 	= $this->payrollemployeedaily_model->getPayrollDailyPeriod();
			$year_period = date("Y", strtotime($payrolldailyperiod['daily_period_start_date']));

			$employee_hire_date = $this->payrollemployeedaily_model->getEmployeeHireDate($employee_id);

			$payrolldailyperiod 	= $this->payrollemployeedaily_model->getPayrollDailyPeriod();
			$year_period = date("Y", strtotime($payrolldailyperiod['daily_period_start_date']));
			$daily_period_end_date = $payrolldailyperiod['daily_period_end_date'];

			$lengthofservice = date_diff(date_create($daily_period_end_date), date_create($employee_hire_date));
			$length_of_service_month = ($lengthofservice->days) / 30;

			$payrollemployeelengthservice = $this->payrollemployeedaily_model->getPayrollEmployeeLengthService($employee_id, $length_of_service_month, $year_period);

			$employee_length_service_amount = $payrollemployeelengthservice['employee_length_service_amount'];


			$payrollemployeepayment = $this->payrollemployeedaily_model->getPayrollEmployeePayment($employee_id);

			/*Leave Calculation*/
			$payrollleaverequest 	= $this->payrollemployeedaily_model->getPayrollLeaveRequest($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$leave_request_days 	= count($payrollleaverequest);

			/*Day Off*/
			$hroemployeeworkingdayoff 	= $this->payrollemployeedaily_model->getHROmployeeWorkingDayOff($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$working_dayoff_days 	= count($hroemployeeworkingdayoff);


			/*Overtime*/
			$payrollovertimerequest 	= $this->payrollemployeedaily_model->getPayrollOvertimeRequest($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);


			/*Home Early*/
			$hroemployeehomeearlydaily 	= $this->payrollemployeedaily_model->getHROEmployeeHomeEarlyDaily($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$payrollemployeeallowance = $this->payrollemployeedaily_model->getPayrollEmployeeAllowance($employee_id, $year_period);


			/*Deduction*/
			/*Absence*/
			$hroemployeeabsence 	= $this->payrollemployeedaily_model->getHROEmployeeAbsence($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$employee_absence_days 	= count($hroemployeeabsence);


			/*Permit*/
			$hroemployeepermit 		= $this->payrollemployeedaily_model->getHROEmployeePermit($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$employee_permit_days 	= count($hroemployeepermit);

			/*Late*/
			$hroemployeelate 		= $this->payrollemployeedaily_model->getHROEmployeeLate($employee_id, $payrolldailyperiod['daily_period_start_date'], $payrolldailyperiod['daily_period_end_date']);

			$employee_late_days 	= count($hroemployeelate);

			
			$payrollemployeededuction = $this->payrollemployeedaily_model->getPayrollEmployeeDeduction($employee_id, $year_period);


			/*Calculate Home Early*/

			if ($payrollemployeepayment['payment_home_early_status'] == 0){
				$home_early_hour = 0;
				$home_early_day = 0;
				foreach ($hroemployeehomeearlydaily as $keyHomeEarlyDaily=>$valHomeEarlyDaily){
					$home_early_hour = $home_early_hour + $valHomeEarlyDaily['employee_home_early_daily_hour'];				
				}

				$home_early_amount = $payrollemployeepayment['payment_home_early_amount'];
				$home_early_total_amount = $home_early_amount * $home_early_hour;	
			}else {
				$company_home_early_minimum_hour = $this->payrollemployeedaily_model->getCompanyHomeEarlyMinimumHour();

				$home_early_hour = 0;
				$home_early_day = 0;
				foreach ($hroemployeehomeearlydaily as $keyHomeEarlyDaily => $valHomeEarlyDaily) {
					$employee_home_early_daily_hour = $valHomeEarlyDaily['employee_home_early_daily_hour'];					
					if ($employee_home_early_daily_hour >= $company_home_early_minimum_hour){
						$home_early_hour++;
						$home_early_day++;
					}
				}

				$home_early_amount = $payrollemployeepayment['payment_home_early_amount'];
				$home_early_total_amount = $home_early_amount * $home_early_hour;	
			}

			
			$employee_daily_working_days = $payrolldailyperiod['daily_period_working_days'] + $working_dayoff_days - $leave_request_days - $employee_absence_days - ($home_early_day * 0.5) - $employee_permit_days;

			$payroll_daily_allowance_total = 0;

			foreach ($payrollemployeeallowance as $keyAllowance=>$valAllowance){
				$employee_allowance_amount = $valAllowance['employee_allowance_amount'];
				$allowance_type = $valAllowance['allowance_type'];

				switch ($allowance_type) {
				    case 0:
				        $employee_daily_allowance_days = 1;
						$employee_allowance_subtotal = $employee_allowance_amount;
				        break;
				    case 1:
				        $employee_daily_allowance_days = $employee_daily_working_days;
						$employee_allowance_subtotal = $employee_daily_working_days * $employee_allowance_amount;
				        break;
				    case 2:
				        $employee_daily_allowance_days = $leave_request_days;
						$employee_allowance_subtotal = $leave_request_days * $employee_allowance_amount;
				        break;
				  	case 3:     
				  		$employee_daily_allowance_days = $working_dayoff_days;
						$employee_allowance_subtotal = $working_dayoff_days * $employee_allowance_amount;
						break;
				}


				$payroll_daily_allowance_total = $payroll_daily_allowance_total + $employee_allowance_subtotal;

				$data_payrollemployeeallowance = array(
					'employee_daily_allowance_id'		=> date("YmdHis"),
					'employee_id' 						=> $valAllowance['employee_id'],
					'allowance_id' 						=> $valAllowance['allowance_id'],
					'employee_allowance_id'				=> $valAllowance['employee_allowance_id'],
					'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
					'employee_allowance_amount'			=> $valAllowance['employee_allowance_amount'],
					'employee_daily_working_days'		=> $employee_daily_working_days,
					'employee_daily_allowance_days'		=> $employee_daily_allowance_days,
					'employee_allowance_subtotal'		=> $employee_allowance_subtotal,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeallowance['allowance_id']] = $data_payrollemployeeallowance;
				$this->session->set_userdata('addarrayemployeeallowance-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeallowance = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeallowance);
			}

			$payroll_daily_deduction_total = 0;
			foreach ($payrollemployeededuction as $keyDeduction=>$valDeduction){
				$employee_deduction_amount = $valDeduction['employee_deduction_amount'];
				$deduction_type = $valDeduction['deduction_type'];

				switch ($deduction_type) {
				    case 0:
				        $employee_daily_deduction_days = 1;
						$employee_deduction_subtotal = $employee_deduction_amount;
				        break;
				    case 1:
				        $employee_daily_deduction_days = $employee_absence_days;
						$employee_deduction_subtotal = $employee_absence_days * $employee_deduction_amount;
				        break;
				    case 2:
				    	$employeee_permit_days = 0;
				    	foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				    		$deduction_type_permit = $valPermit['deduction_type'];
				    		if ($deduction_type_permit == 2){
				    			$employeee_permit_days++;
				    		}
				    	}
				        $employee_daily_deduction_days = $employeee_permit_days;
						$employee_deduction_subtotal = $employeee_permit_days * $employee_deduction_amount;
				        break;
				  	case 3:     
				  		$employeee_sick_days = 0;
				    	foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				    		$deduction_type_permit = $valPermit['deduction_type'];
				    		if ($deduction_type_permit == 3){
				    			$employeee_sick_days++;
				    		}
				    	}
				  		$employee_daily_deduction_days = $employeee_sick_days;
						$employee_deduction_subtotal = $employeee_sick_days * $employee_deduction_amount;
						break;
					case 5:     
				  		$employee_daily_deduction_days = $employee_late_days;
						$employee_deduction_subtotal = $employee_late_days * $employee_deduction_amount;
						break;
					case 6:     
						$employee_nowork_days = 0;
				    	foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				    		$deduction_type_permit = $valPermit['deduction_type'];
				    		if ($deduction_type_permit == 6){
				    			$employee_nowork_days++;
				    		}
				    	}
				  		$employee_daily_deduction_days = $employee_nowork_days;
						$employee_deduction_subtotal = $employee_nowork_days * $employee_deduction_amount;
						break;
				}

				$payroll_daily_deduction_total = $payroll_daily_deduction_total + $employee_deduction_subtotal;

				$data_payrollemployeededuction = array(
					'employee_daily_deduction_id'		=> date("YmdHis"),
					'employee_id' 						=> $valDeduction['employee_id'],
					'deduction_id' 						=> $valDeduction['deduction_id'],
					'deduction_type' 					=> $deduction_type,
					'employee_deduction_id'				=> $valDeduction['employee_deduction_id'],
					'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
					'employee_deduction_amount'			=> $valDeduction['employee_deduction_amount'],
					'employee_daily_working_days'		=> $employee_daily_working_days,
					'employee_daily_deduction_days'		=> $employee_daily_deduction_days,
					'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
				$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeededuction);
			}

			/*Calculate Overtime*/
			$overtime_working_hour_total = 0;
			$overtime_day_off_total = 0;
			foreach($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$overtime_request_date = $valOvertime['overtime_request_date'];

				$day_name = date("D", strtotime($overtime_request_date));

				$dayoff_date = $this->payrollemployeedaily_model->getDayOffDate($overtime_request_date);

				if ($day_name != "Sun" && count($dayoff_date) == 0){
					$overtime_working_hour_total = $overtime_working_hour_total + $valOvertime['overtime_request_duration'];
					$overtime_working_day_remark = 'Lembur Hari Kerja';
				} else {
					$overtime_day_off_total = $overtime_day_off_total + $valOvertime['overtime_request_duration'];
					$overtime_day_off_remark = 'Lembur Hari Libur';
				}
			}

			$overtime_request_amount = $this->payrollemployeedaily_model->getPaymentBasicOvertime($employee_id, $year_period);

			$coreovertimetype = $this->payrollemployeedaily_model->getCoreOvertimeType();


			if ($overtime_working_hour_total < $coreovertimetype['overtime_type_working_day_hour1']){
				$overtime_type_working_day_hour_amount1 = $overtime_working_hour_total * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 	
			}else {
				$overtime_type_working_day_hour_amount1 = $coreovertimetype['overtime_type_working_day_hour1'] * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 
			}

			if ($overtime_working_hour_total > $coreovertimetype['overtime_type_working_day_hour1']){
				$overtime_type_working_day_hour_amount2 = ($overtime_working_hour_total - $coreovertimetype['overtime_type_working_day_hour1']) * $coreovertimetype['overtime_type_working_day_ratio2'] * $overtime_request_amount;
			}else{

			}

			if ($overtime_day_off_total < $coreovertimetype['overtime_type_day_off_hour1']){
				$overtime_type_day_off_hour_amount1 = $overtime_day_off_total * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
			}else {
				$overtime_type_day_off_hour_amount1 = $coreovertimetype['overtime_type_day_off_hour1'] * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
			}

			if ($overtime_day_off_total > $coreovertimetype['overtime_type_day_off_hour1']){
				$overtime_type_day_off_hour_amount2 = ($overtime_day_off_total - $coreovertimetype['overtime_type_day_off_hour1']) * $coreovertimetype['overtime_type_day_off_ratio2'] * $overtime_request_amount;
			}

			$employee_overtime_amount_total = $overtime_type_working_day_hour_amount1 + $overtime_type_working_day_hour_amount2 + $overtime_type_day_off_hour_amount1 + $overtime_type_day_off_hour_amount2;

			$this->session->unset_userdata('addarrayemployeeovertime-'.$sesi['unique']);

			$data_payrollemployeeovertime = array(
				'employee_id' 						=> $employee_id,
				'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
				'employee_basic_overtime'			=> $overtime_request_amount,
				'employee_overtime_daily_total1'	=> $overtime_type_working_day_hour_amount1,
				'employee_overtime_daily_total2'	=> $overtime_type_working_day_hour_amount2,
				'employee_overtime_dayoff_total1'	=> $overtime_type_day_off_hour_amount1,
				'employee_overtime_dayoff_total2'	=> $overtime_type_day_off_hour_amount2,
				'employee_overtime_amount_total'	=> $employee_overtime_amount_total,
			);

			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
			$dataArrayHeader[$data_payrollemployeeovertime['employee_id']] = $data_payrollemployeeovertime;
			$this->session->set_userdata('addarrayemployeeovertime-'.$unique['unique'],$dataArrayHeader);
			$sesi 	= $this->session->userdata('unique');
			$data_payrollemployeeovertime = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);
			$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeovertime);

			$this->session->unset_userdata('addarrayemployeehomeearly-'.$sesi['unique']);

			$data_payrollemployeedailyearly = array(
				'employee_id' 					=> $employee_id,
				'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				'home_early_hour'				=> $home_early_hour,
				'home_early_amount'				=> $home_early_amount,
				'home_early_total_amount'		=> $home_early_total_amount,
			);

			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$dataArrayHeader[$data_payrollemployeedailyearly['employee_id']] = $data_payrollemployeedailyearly;
			$this->session->set_userdata('addarrayemployeehomeearly-'.$unique['unique'],$dataArrayHeader);
			$sesi 	= $this->session->userdata('unique');
			$data_payrollemployeedailyearly = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);
			$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeedailyearly);

			$payrollemployeebpjs			= $this->payrollemployeedaily_model->getPayrollEmployeeBPJS($employee_id);


			if ($payrolldailyperiod['daily_period_working_days'] == $employee_daily_working_days){
				$payrollemployeepremiattendance = $this->payrollemployeedaily_model->getPayrollEmployeePremiAttendance($employee_id, $year_period);

				$employee_premi_attendance_amount = $payrollemployeepremiattendance['employee_premi_attendance_amount'];
			}else {
				$employee_premi_attendance_amount = 0;
			}


			if ($payrolldailyperiod['daily_period_include_bpjs'] == 1){
				$employee_daily_salary_total = $payrollemployeepayment['payment_basic_salary'] + $payroll_daily_allowance_total + $payroll_daily_deduction_total + $employee_overtime_amount_total + $home_early_total_amount + $payrollemployeebpjs['bpjs_total_amount'] + $employee_daily_allowance_other - $employee_daily_deduction_other + $employee_length_service_amount + $employee_premi_attendance_amount;
			}else{
				$employee_daily_salary_total = $payrollemployeepayment['payment_basic_salary'] + $payroll_daily_allowance_total + $payroll_daily_deduction_total + $employee_overtime_amount_total + $home_early_total_amount + $employee_daily_allowance_other - $employee_daily_deduction_other + $employee_length_service_amount + $employee_premi_attendance_amount;
			}		

			$data_payrollemployeedaily = array(
				'employee_daily_id'						=> date("YmdHis"),
				'employee_id' 							=> $employee_id,
				'employee_daily_working_days'			=> $employee_daily_working_days,
				'length_service_month'					=> $length_of_service_month,
				'employee_length_service_amount'		=> $employee_length_service_amount,
				'employee_premi_attendance_amount'		=> $employee_premi_attendance_amount,
				'payroll_daily_allowance_total'			=> $payroll_daily_allowance_total,
				'payroll_daily_deduction_total'			=> $payroll_daily_deduction_total,
				'employee_overtime_amount_total'		=> $employee_overtime_amount_total,
				'home_early_total_amount'				=> $home_early_total_amount,
				'employee_daily_bpjs_amount'			=> $payrollemployeebpjs['bpjs_total_amount'],
				'employee_daily_allowance_other'		=> $employee_daily_allowance_other,
				'employee_daily_allowance_description'	=> $employee_daily_allowance_description,
				'employee_daily_deduction_other'		=> $employee_daily_deduction_other,
				'employee_daily_deduction_description'	=> $employee_daily_deduction_description,
				'employee_daily_salary_total'			=> $employee_daily_salary_total,
				'employee_daily_date'					=> $employee_daily_date,
			);

			foreach ($payrollleaverequest as $keyLeaveRequest=>$valLeaveRequest){
				$data_payrollleaverequest = array(
					'leave_request_detail_id' 			=> $valLeaveRequest['leave_request_detail_id'],
					'employee_id' 						=> $valLeaveRequest['employee_id'],
					'annual_leave_id'					=> $valLeaveRequest['annual_leave_id'],
					'leave_request_detail_date'			=> $valLeaveRequest['leave_request_detail_date'],
					'leave_request_description'			=> $valLeaveRequest['leave_request_description'],
					'employee_daily_period'				=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollleaverequest['leave_request_detail_id']] = $data_payrollleaverequest;

				$this->session->set_userdata('addarrayemployeeleaverequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollleaverequest = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollleaverequest);
			}

			foreach ($hroemployeeabsence as $keyAbsence=>$valAbsence){
				$data_payrollemployeeabsence = array(
					'employee_absence_detail_id'	=> $valAbsence['employee_absence_detail_id'],
					'employee_id' 					=> $valAbsence['employee_id'],
					'absence_id'					=> $valAbsence['absence_id'],
					'employee_absence_description'	=> $valAbsence['employee_absence_description'],
					'employee_absence_detail_date'	=> $valAbsence['employee_absence_detail_date'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeabsence['employee_absence_detail_id']] = $data_payrollemployeeabsence;

				$this->session->set_userdata('addarrayemployeeabsence-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeabsence = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeabsence);
			}
			
			foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				$data_payrollemployeepermit = array(
					'employee_permit_detail_id'		=> $valPermit['employee_permit_detail_id'],
					'employee_id' 					=> $valPermit['employee_id'],
					'permit_id'						=> $valPermit['permit_id'],
					'permit_type'					=> $valPermit['permit_type'],
					'deduction_type'				=> $valPermit['deduction_type'],
					'employee_permit_description'	=> $valPermit['employee_permit_description'],
					'employee_permit_detail_date'	=> $valPermit['employee_permit_detail_date'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeepermit['employee_permit_detail_id']] = $data_payrollemployeepermit;

				$this->session->set_userdata('addarrayemployeepermit-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeepermit = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeepermit);
			}
			
			$data_payrollemployeepermit = $this->session->userdata('addarrayemployeepermit-'.$sesi['unique']);

			foreach ($hroemployeeworkingdayoff as $keyDayOff=>$valDayOff){
				$data_payrollemployeedayoff = array(
					'working_dayoff_detail_id'				=> $valDayOff['working_dayoff_detail_id'],
					'employee_id' 							=> $valDayOff['employee_id'],
					'dayoff_id'								=> $valDayOff['dayoff_id'],
					'employee_working_dayoff_description'	=> $valDayOff['employee_working_dayoff_description'],
					'working_dayoff_detail_date'			=> $valDayOff['working_dayoff_detail_date'],
					'employee_daily_period'					=> $payrolldailyperiod['daily_period'],
				);

					$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeedayoff['working_dayoff_detail_id']] = $data_payrollemployeedayoff;

				$this->session->set_userdata('addarrayemployeedayoff-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeedayoff = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeedayoff);
			}
			
			$data_payrollemployeedayoff = $this->session->userdata('addarrayemployeedayoff-'.$sesi['unique']);

			foreach ($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$data_payrollemployeeovertimerequest = array(
					'overtime_request_id'			=> $valOvertime['overtime_request_id'],
					'employee_id' 					=> $valOvertime['employee_id'],
					'overtime_type_id'				=> $valOvertime['overtime_type_id'],
					'overtime_request_description'	=> $valOvertime['overtime_request_description'],
					'overtime_request_date'			=> $valOvertime['overtime_request_date'],
					'overtime_request_duration'		=> $valOvertime['overtime_request_duration'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeovertimerequest['overtime_request_id']] = $data_payrollemployeeovertimerequest;

				$this->session->set_userdata('addarrayemployeeovertimerequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeovertimerequest = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeeovertimerequest);
			}
			
			foreach ($hroemployeelate as $keyLate=>$valLate){
				$data_payrollemployeelate = array(
					'employee_late_id'				=> $valLate['employee_late_id'],
					'employee_id' 					=> $valLate['employee_id'],
					'late_id'						=> $valLate['late_id'],
					'employee_late_description'		=> $valLate['employee_late_description'],
					'employee_late_date'			=> $valLate['employee_late_date'],
					'employee_late_duration'		=> $valLate['employee_late_duration'],
					'employee_daily_period'			=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeelate['employee_late_id']] = $data_payrollemployeelate;

				$this->session->set_userdata('addarrayemployeelate-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeelate = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeelate);
			}
			
			foreach ($hroemployeehomeearlydaily as $keyHomeEarly=>$valHomeEarly){
				$data_payrollemployeehomeearlydaily = array(
					'employee_home_early_daily_id'				=> $valHomeEarly['employee_home_early_daily_id'],
					'employee_id' 								=> $valHomeEarly['employee_id'],
					'employee_home_early_daily_description'		=> $valHomeEarly['employee_home_early_daily_description'],
					'employee_home_early_daily_date'			=> $valHomeEarly['employee_home_early_daily_date'],
					'employee_home_early_daily_hour'			=> $valHomeEarly['employee_home_early_daily_hour'],
					'employee_daily_period'						=> $payrolldailyperiod['daily_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearlydaily-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeehomeearlydaily['employee_home_early_daily_id']] = $data_payrollemployeehomeearlydaily;

				$this->session->set_userdata('addarrayemployeehomeearlydaily-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeehomeearlydaily = $this->session->userdata('addpayrollemployeedaily-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeedaily-'.$sesi['unique'],$data_payrollemployeehomeearlydaily);
			}

			$data['main_view']['hroemployeedata']				= $this->payrollemployeedaily_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeedaily_data']		= $this->payrollemployeedaily_model->getPayrollEmployeeDaily_Data($employee_id);
			
			$data['main_view']['payrollemployeepayment']		= $payrollemployeepayment;
			$data['main_view']['payrolldailyperiod']			= $payrolldailyperiod;
			$data['main_view']['payrollemployeedaily']			= $data_payrollemployeedaily;
			$data['main_view']['content']						= 'payrollemployeedaily/listaddpayrollemployeedaily_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeDaily(){
			$auth = $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 								=> $this->input->post('employee_id',true),
				'bank_id' 									=> $this->input->post('bank_id',true),
				'employee_daily_period'						=> $this->input->post('employee_daily_period',true),
				'employee_daily_bank_acct_name'				=> $this->input->post('employee_daily_bank_acct_name',true),
				'employee_daily_bank_acct_no'				=> $this->input->post('employee_daily_bank_acct_no',true),
				'employee_daily_date'						=> tgltodb($this->input->post('employee_daily_date',true)),
				'employee_daily_start_date'					=> tgltodb($this->input->post('employee_daily_start_date',true)),
				'employee_daily_end_date'					=> tgltodb($this->input->post('employee_daily_end_date',true)),
				'employee_daily_basic_salary'				=> $this->input->post('employee_daily_basic_salary',true),
				'employee_daily_basic_overtime'				=> $this->input->post('employee_daily_basic_overtime',true),
				'employee_daily_working_days'				=> $this->input->post('employee_daily_working_days',true),
				'employee_daily_allowance_total'			=> $this->input->post('employee_daily_allowance_total',true),
				'employee_daily_deduction_total'			=> $this->input->post('employee_daily_deduction_total',true),
				'employee_daily_overtime_total'				=> $this->input->post('employee_daily_overtime_total',true),
				'employee_daily_early_total'				=> $this->input->post('employee_daily_early_total',true),
				'employee_daily_bpjs_amount'				=> $this->input->post('employee_daily_bpjs_amount',true),
				'employee_daily_length_service_month'		=> $this->input->post('employee_daily_length_service_month',true),
				'employee_daily_length_service_amount'		=> $this->input->post('employee_daily_length_service_amount',true),
				'employee_daily_premi_attendance_amount'	=> $this->input->post('employee_daily_premi_attendance_amount',true),
				'employee_daily_allowance_other'			=> $this->input->post('employee_daily_allowance_other',true),
				'employee_daily_allowance_description'		=> $this->input->post('employee_daily_allowance_description',true),
				'employee_daily_deduction_other'			=> $this->input->post('employee_daily_deduction_other',true),
				'employee_daily_deduction_description'		=> $this->input->post('employee_daily_deduction_description',true),
				'employee_daily_salary_total'				=> $this->input->post('employee_daily_salary_total',true),
				'data_state'								=> 0,
				'created_id'								=> $auth['user_id'],
				'created_on'								=> date("Y-m-d H:i:s"),
			);

			$session_home_early			= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$session_overtime			= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
			$session_deduction			= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
			$session_allowance			= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);

			$session_leaverequest		= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);			
			$session_dayoff				= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);			
			$session_overtimerequest	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);	
			$session_homeearlydaily		= $this->session->userdata('addarrayemployeehomeearlydaily-'.$unique['unique']);	
			$session_permit				= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
			$session_absence			= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
			$session_late				= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeedaily_model->saveNewPayrollEmployeeDaily($data)){
					$employee_daily_id = $this->payrollemployeedaily_model->getEmployeeDailyID($data['created_on'], $data['created_id']);

					if(!empty($session_home_early)){
						foreach($session_home_early as $key=>$val){
							$data_home_early = array(
								'employee_daily_id'			=> $employee_daily_id,
								'employee_id'				=> $data['employee_id'],
								'employee_daily_period'		=> $data['employee_daily_period'],
								'home_early_hour'			=> $val['home_early_hour'],
								'home_early_amount'			=> $val['home_early_amount'],
								'home_early_total_amount'	=> $val['home_early_total_amount'],
								'data_state'				=> 0,
								'created_id'				=> $data['created_id'],
								'created_on'				=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyEarly($data_home_early);
						}
					}

					if(!empty($session_overtime)){
						foreach($session_overtime as $key=>$val){
							$data_overtime = array(
								'employee_daily_id'					=> $employee_daily_id,
								'employee_id'						=> $data['employee_id'],
								'employee_daily_period'				=> $data['employee_daily_period'],
								'employee_basic_overtime'			=> $val['employee_basic_overtime'],
								'employee_overtime_daily_total1'	=> $val['employee_overtime_daily_total1'],
								'employee_overtime_daily_total2'	=> $val['employee_overtime_daily_total2'],
								'employee_overtime_dayoff_total1'	=> $val['employee_overtime_dayoff_total1'],
								'employee_overtime_dayoff_total2'	=> $val['employee_overtime_dayoff_total2'],
								'employee_overtime_amount_total'	=> $val['employee_overtime_amount_total'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyOvertime($data_overtime);
						}
					}

					if(!empty($session_deduction)){
						foreach($session_deduction as $key=>$val){
							$data_deduction = array(
								'employee_daily_id'					=> $employee_daily_id,
								'employee_id'						=> $data['employee_id'],
								'employee_daily_period'				=> $data['employee_daily_period'],
								'deduction_id'						=> $val['deduction_id'],
								'employee_deduction_id'				=> $val['employee_deduction_id'],
								'employee_deduction_amount'			=> $val['employee_deduction_amount'],
								'employee_daily_working_days'		=> $val['employee_daily_working_days'],
								'employee_daily_deduction_days'		=> $val['employee_daily_deduction_days'],
								'employee_deduction_subtotal'		=> $val['employee_deduction_subtotal'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyDeduction($data_deduction);
						}
					}

					if(!empty($session_allowance)){
						foreach($session_allowance as $key=>$val){
							$data_allowance = array(
								'employee_daily_id'					=> $employee_daily_id,
								'employee_id'						=> $data['employee_id'],
								'employee_daily_period'				=> $data['employee_daily_period'],
								'allowance_id'						=> $val['allowance_id'],
								'employee_allowance_id'				=> $val['employee_allowance_id'],
								'employee_allowance_amount'			=> $val['employee_allowance_amount'],
								'employee_daily_working_days'		=> $val['employee_daily_working_days'],
								'employee_daily_allowance_days'		=> $val['employee_daily_allowance_days'],
								'employee_allowance_subtotal'		=> $val['employee_allowance_subtotal'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyAllowance($data_allowance);
						}
					}

					

					if(!empty($session_leaverequest)){
						foreach($session_leaverequest as $key=>$val){
							$data_leaverequest = array(
								'employee_daily_id'					=> $employee_daily_id,
								'employee_id'						=> $data['employee_id'],
								'employee_daily_period'				=> $data['employee_daily_period'],
								'annual_leave_id'					=> $val['annual_leave_id'],
								'leave_request_detail_date'			=> $val['leave_request_detail_date'],
								'leave_request_description'			=> $val['leave_request_description'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyLeave($data_leaverequest);
						}
					}

					if(!empty($session_dayoff)){
						foreach($session_dayoff as $key=>$val){
							$data_dayoff = array(
								'employee_daily_id'						=> $employee_daily_id,
								'employee_id'							=> $data['employee_id'],
								'employee_daily_period'					=> $data['employee_daily_period'],
								'dayoff_id'								=> $val['dayoff_id'],
								'employee_working_dayoff_description'	=> $val['employee_working_dayoff_description'],
								'working_dayoff_detail_date'			=> $val['working_dayoff_detail_date'],
								'data_state'							=> 0,
								'created_id'							=> $data['created_id'],
								'created_on'							=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyDayOff($data_dayoff);
						}
					}	

					if(!empty($session_overtimerequest)){
						foreach($session_overtimerequest as $key=>$val){
							$data_overtimerequest = array(
								'employee_daily_id'				=> $employee_daily_id,
								'employee_id'					=> $data['employee_id'],
								'employee_daily_period'			=> $data['employee_daily_period'],
								'overtime_type_id'				=> $val['overtime_type_id'],
								'overtime_request_description'	=> $val['overtime_request_description'],
								'overtime_request_date'			=> $val['overtime_request_date'],
								'overtime_request_duration'		=> $val['overtime_request_duration'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyOvertimeRequest($data_overtimerequest);
						}
					}

					if(!empty($session_homeearlydaily)){
						foreach($session_homeearlydaily as $key=>$val){
							$data_homeearlydaily = array(
								'employee_daily_id'						=> $employee_daily_id,
								'employee_id'							=> $data['employee_id'],
								'employee_daily_period'					=> $data['employee_daily_period'],
								'employee_home_early_daily_description'	=> $val['employee_home_early_daily_description'],
								'employee_home_early_daily_date'		=> $val['employee_home_early_daily_date'],
								'employee_home_early_daily_hour'		=> $val['employee_home_early_daily_hour'],
								'data_state'							=> 0,
								'created_id'							=> $data['created_id'],
								'created_on'							=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyHomeEarly($data_homeearlydaily);
						}
					}

					if(!empty($session_permit)){
						foreach($session_permit as $key=>$val){
							$data_permit = array(
								'employee_daily_id'				=> $employee_daily_id,
								'employee_id'					=> $data['employee_id'],
								'employee_daily_period'			=> $data['employee_daily_period'],
								'permit_id'						=> $val['permit_id'],
								'permit_type'					=> $val['permit_type'],
								'deduction_type'				=> $val['deduction_type'],
								'employee_permit_description'	=> $val['employee_home_early_daily_date'],
								'employee_permit_detail_date'	=> $val['employee_home_early_daily_hour'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyPermit($data_permit);
						}
					}

					if(!empty($session_absence)){
						foreach($session_absence as $key=>$val){
							$data_absence = array(
								'employee_daily_id'				=> $employee_daily_id,
								'employee_id'					=> $data['employee_id'],
								'employee_daily_period'			=> $data['employee_daily_period'],
								'absence_id'					=> $val['absence_id'],
								'employee_absence_description'	=> $val['employee_absence_description'],
								'employee_absence_detail_date'	=> $val['employee_absence_detail_date'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyAbsence($data_absence);
						}
					}

					if(!empty($session_late)){
						foreach($session_late as $key=>$val){
							$data_late = array(
								'employee_daily_id'				=> $employee_daily_id,
								'employee_id'					=> $data['employee_id'],
								'employee_daily_period'			=> $data['employee_daily_period'],
								'late_id'						=> $val['late_id'],
								'employee_late_description'		=> $val['employee_late_description'],
								'employee_late_date'			=> $val['employee_late_date'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeedaily_model->saveNewPayrollEmployeeDailyLate($data_late);
						}
					}





					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeDaily.processAddPayrollEmployeeDaily',$auth['user_id'],'Add New Employee Daily');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Employee Daily Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeedaily');
					redirect('payrollemployeedaily/addPayrollEmployeeDaily/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Employee Daily UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeedaily',$data);
					redirect('payrollemployeedaily/addPayrollEmployeeDaily/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeedaily',$data);
				redirect('payrollemployeedaily/addPayrollEmployeeDaily/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeDaily_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_daily_id  	= $this->uri->segment(4);

			if($this->payrollemployeedaily_model->deletePayrollEmployeeDaily_Data($employee_daily_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.payrollEmployeeDaily.deletePayrollEmployeeDaily_Data',$employee_daily_id,'Delete Payroll Employee Daily');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Employee Daily Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedaily/addPayrollEmployeeDaily/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Employee Daily UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeedaily/addPayrollEmployeeDaily/'.$employee_id);
			}
		}

		public function detailPayrollEmployeeDaily(){
			$employee_daily_id											= $this->uri->segment(3);

			$data['main_view']['payrollemployeedaily']					= $this->payrollemployeedaily_model->getPayrollEmployeeDaily_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyabsence']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyAbsence_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyallowance']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyAllowance_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailydayoff']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyDayOff_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailydeduction']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyDeduction_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyearly']				= $this->payrollemployeedaily_model->getPayrollEmployeeDailyEarly_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyhomeearly']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyHomeEarly_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailylate']				= $this->payrollemployeedaily_model->getPayrollEmployeeDailyLate_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyleave']				= $this->payrollemployeedaily_model->getPayrollEmployeeDailyLeave_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyovertime']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyOvertime_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailyovertimerequest']	= $this->payrollemployeedaily_model->getPayrollEmployeeDailyOvertimeRequest_Detail($employee_daily_id);

			$data['main_view']['payrollemployeedailypermit']			= $this->payrollemployeedaily_model->getPayrollEmployeeDailyPermit_Detail($employee_daily_id);

			$data['main_view']['content']								='payrollemployeedaily/formdetailpayrollemployeedaily_view';
			$this->load->view('mainpage_view',$data);
		} 
	}
?>