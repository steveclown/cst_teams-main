<?php
	Class payrollemployeemonthlyadisurya extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeemonthlyadisurya_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeemonthlyadisurya');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->payrollemployeemonthlyadisurya_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['coredepartment']			= create_double($this->payrollemployeemonthlyadisurya_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['coresection']				= create_double($this->payrollemployeemonthlyadisurya_model->getCoreSection(),'section_id','section_name');
			
			$data['main_view']['hroemployeedata']			= create_double($this->payrollemployeemonthlyadisurya_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_monthly']	= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeData_Monthly($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeemonthlyadisurya/listpayrollemployeemonthlyadisurya_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-payrollemployeemonthlyadisurya',$data);
			redirect('payrollemployeemonthlyadisurya');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeemonthlyadisurya');
			$this->session->unset_userdata('filter-payrollemployeemonthlyadisurya');
			redirect('payrollemployeemonthlyadisurya');
		}

		public function reset_session(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	

			$this->session->unset_userdata('addpayrollemployeemonthlyadisurya-'.$unique['unique']);	
			$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeovertime-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeleaverequest-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeedayoff-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeovertimerequest-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique']);
			redirect('payrollemployeemonthlyadisurya/addPayrollEmployeeMonthly/'.$employee_id);
		}
		
		public function addPayrollEmployeeMonthly(){
			$employee_id 						= $this->uri->segment(3);	

			$employee_hire_date 				= $this->payrollemployeemonthlyadisurya_model->getEmployeeHireDate($employee_id);

			$payrollmonthlyperiod 				= $this->payrollemployeemonthlyadisurya_model->getPayrollMonthlyPeriod();

			$year_period 						= date("Y", strtotime($payrollmonthlyperiod['monthly_period_start_date']));
			$monthly_period 					= $payrollmonthlyperiod['monthly_period']; 
			$monthly_period_start_date 			= $payrollmonthlyperiod['monthly_period_start_date'];
			$monthly_period_end_date 			= $payrollmonthlyperiod['monthly_period_end_date'];

			$lengthofservice 					= date_diff(date_create($monthly_period_end_date), date_create($employee_hire_date));
			$length_of_service_month 			= ($lengthofservice->days) / 30;

			/*Length of Service*/
			$payrollemployeelengthservice 		= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeLengthService($employee_id, $length_of_service_month, $year_period);

			$employee_length_service_amount 	= $payrollemployeelengthservice['employee_length_service_amount'];

			/*Payroll Employee Incentive*/
			$employee_incentive_amount 			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeIncentive($employee_id, $year_period);

			/*Payroll Employee Loan*/
			$employee_loan_amount 				= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeLoan($employee_id, $monthly_period);

			$payrollemployeepayment 			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeePayment($employee_id, $year_period);

			/*Leave Calculation*/
			$payrollleaverequest 				= $this->payrollemployeemonthlyadisurya_model->getPayrollLeaveRequest($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$leave_request_days 				= count($payrollleaverequest);

			/*Day Off*/
			$hroemployeeworkingdayoff 			= $this->payrollemployeemonthlyadisurya_model->getHROmployeeWorkingDayOff($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$working_dayoff_days 				= count($hroemployeeworkingdayoff);

			/*Overtime*/
			$payrollovertimerequest 			= $this->payrollemployeemonthlyadisurya_model->getPayrollOvertimeRequest($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			/*Home Early*/
			$hroemployeehomeearlymonthly 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeHomeEarlyMonthly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$payrollemployeeallowance 			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeAllowance($employee_id, $year_period);

			$employee_premi_attendance_amount 	= $this->payrollemployeemonthlyadisurya_model->getEmployeePremiAttendanceAmount($employee_id, $year_period);

			$employee_monthly_saving_amount 	= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeSaving($employee_id, $year_period);

			/*Deduction*/
			$payroll_monthly_deduction_total 	= 0;

			## DEDUCTION EMPLOYEE LATE
			$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);

			$corelate = $this->payrollemployeemonthlyadisurya_model->getCoreLate();
			$total_employee_late_days = 0;

			foreach($corelate as $keyCoreLate => $valCoreLate){
				$deduction_id 		= $valCoreLate['deduction_id'];
				$late_id 			= $valCoreLate['late_id'];
				$employee_late_days = 0;

				$hroemployeelate 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);

				$employee_deduction_amount = 0;

				if (!empty($hroemployeelate)){
					foreach ($hroemployeelate as $keyEmployeeLate => $valEmployeeLate) {
						$employee_late_days++;
					}

					$total_employee_late_days = $total_employee_late_days + $employee_late_days;

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					if ($employee_deduction_amount == 0){
						if(!empty($coredeductionallowance)){
							$employee_deduction_subtotal 		= 0;
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
							$deduction_amount1					= $deduction_amount;
						}else{
							$employee_deduction_subtotal 		= $deduction_amount;
							$deduction_amount1 					= 0;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
						} else {
							$total_premi = 0;
						}

						if ($deduction_premi_attendance_status == 0){
							if ($employee_late_days <= $total_premi){
								$premi_attendance = $employee_late_days;  # Daily	
							} else {
								$premi_attendance = $total_premi;  # Daily	
							}
						} else {
							$premi_attendance = 1;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

							$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
						}						


						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal ;
						}
					}
				}

				if ($employee_late_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_late_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}


			## DEDUCTION EMPLOYEE ABSENCE
			$coreabsence 					= $this->payrollemployeemonthlyadisurya_model->getCoreAbsence();
			$total_employee_absence_days	= 0;

			foreach($coreabsence as $keyCoreAbsence => $valCoreAbsence){
				$deduction_id 			= $valCoreAbsence['deduction_id'];
				$absence_id 			= $valCoreAbsence['absence_id'];
				$employee_absence_days 	= 0;

				$hroemployeeabsence 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

				/*print_r("hroemployeeabsence ");
				print_r($hroemployeeabsence);
				print_r("<BR>");*/

				if (!empty($hroemployeeabsence)){
					foreach ($hroemployeeabsence as $keyEmployeeAbsence => $valEmployeeAbsence) {
						$employee_absence_days++;
					}

					$total_employee_absence_days = $total_employee_absence_days +$employee_absence_days;

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

					/*print_r("payrollemployeededuction ");
					print_r($payrollemployeededuction);
					print_r("<BR>");*/

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					if ($employee_deduction_amount == 0){
						if(!empty($coredeductionallowance)){
							$employee_deduction_subtotal 		= 0;
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
							$deduction_amount1					= $deduction_amount;
						}else{
							$employee_deduction_subtotal 		= $deduction_amount;
							$deduction_amount1 					= 0;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
						} else {
							$total_premi = 0;
						}

						if ($deduction_premi_attendance_status == 0){
							if ($employee_absence_days <= $total_premi){
								$premi_attendance = $employee_absence_days;  # Daily	
							} else {
								$premi_attendance = $total_premi;  # Daily	
							}
						} else {
							$premi_attendance = 1;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

							$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
						}						


						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + $deduction_amount1;
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  ;
						}
					} else {
						$employee_deduction_subtotal 			= $employee_deduction_amount;
					}
				}

				if ($employee_absence_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_absence_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					/*print_r("data_payrollemployeededuction ");
					print_r($data_payrollemployeededuction);
					print_r("<BR>");*/

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}


			/*exit;*/

			## DEDUCTION EMPLOYEE PERMIT
			$corepermit = $this->payrollemployeemonthlyadisurya_model->getCorePermit();
			$total_employee_permit_days = 0;

			foreach($corepermit as $keyCorePermit => $valCorePermit){
				$deduction_id 			= $valCorePermit['deduction_id'];
				$permit_id 				= $valCorePermit['permit_id'];
				$employee_permit_days 	= 0;

				$hroemployeepermit 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);

				/*print_r("hroemployeepermit ");
				print_r($hroemployeepermit);
				print_r("<BR>");*/

				$employee_deduction_amount = 0;
				if (!empty($hroemployeepermit)){

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					foreach ($hroemployeepermit as $keyEmployeePermit => $valEmployeePermit) {
						if ($valCorePermit['permit_status'] == 1){
							$employee_permit_days++;
						}
					}

					$total_employee_permit_days = $total_employee_permit_days + $employee_permit_days;

					/*print_r("employee_id ");
					print_r($employee_id);
					print_r("<BR> ");
					print_r("coredeductionallowance ");
					print_r($coredeductionallowance);
					print_r("<BR> ");
					print_r("payrollemployeededuction ");
					print_r($payrollemployeededuction);
					print_r("<BR> ");

					print_r("employee_deduction_amount ");
					print_r($employee_deduction_amount);
					print_r("<BR> ");

					print_r("deduction_amount ");
					print_r($deduction_amount);
					print_r("<BR> ");*/

					if ($employee_deduction_amount == 0){
						if(!empty($coredeductionallowance)){
							$employee_deduction_subtotal 		= 0;
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);

								/*print_r("deduction_allowance_ratio ");
								print_r($valDeductionAllowance['deduction_allowance_ratio']);
								print_r("<BR> ");

								print_r("employee_allowance_amount ");
								print_r($valDeductionAllowance['employee_allowance_amount']);
								print_r("<BR> ");
								print_r("<BR> ");
								print_r("<BR> ");*/
							}
							$deduction_amount1				= $deduction_amount;
						}else{
							$employee_deduction_subtotal 	= $deduction_amount;
							$deduction_amount1 				= 0;
						}

						/*print_r("employee_deduction_subtotal ");
						print_r($employee_deduction_subtotal);
						print_r("<BR> ");

						print_r("deduction_amount ");
						print_r($deduction_amount1);
						print_r("<BR> ");*/

						if ($deduction_premi_attendance_ratio > 0){
							$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
						} else {
							$total_premi = 0;
						}
						

						/*print_r("total_premi ");
						print_r($total_premi);
						print_r("<BR> ");*/

						if ($deduction_premi_attendance_status == 0){
							if ($employee_permit_days <= $total_premi){
								$premi_attendance = $employee_permit_days;  # Daily	
							} else {
								$premi_attendance = $total_premi;  # Daily	
							}
						} else {
							$premi_attendance = 1;
						}

						/*print_r("employee_premi_attendance_amount awal ");
						print_r($employee_premi_attendance_amount);
						print_r("<BR> ");

						print_r("premi_attendance ");
						print_r($premi_attendance);
						print_r("<BR> ");

						print_r("deduction_premi_attendance_ratio ");
						print_r($deduction_premi_attendance_ratio);
						print_r("<BR> ");*/

						if ($deduction_premi_attendance_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

							$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
						}						

						/*print_r("employee_premi_attendance_amount akhir ");
						print_r($employee_premi_attendance_amount);
						print_r("<BR> ");

						print_r("employee_deduction_subtotal akhir ");
						print_r($employee_deduction_subtotal);
						print_r("<BR> ");

						print_r("deduction_basic_salary_ratio ");
						print_r($deduction_basic_salary_ratio);
						print_r("<BR> ");*/

						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + $deduction_amount1;
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal;
						}

						/*print_r("employee_deduction_subtotal salary ");
						print_r($employee_deduction_subtotal);
						print_r("<BR> ");*/
					} else {
						$employee_deduction_subtotal			= $employee_deduction_amount;
					}
				}

				/*$employee_deduction_subtotal = $employee_deduction_subtotal + $employee_deduction_amount;*/

				/*print_r("employee_deduction_subtotal ");
				print_r($employee_deduction_subtotal);
				print_r("<BR>");
				print_r("<BR>");*/

				if ($employee_permit_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_permit_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
					);

					/*print_r("data_payrollemployeededuction ");
					print_r($data_payrollemployeededuction);
					print_r("<BR>");*/

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}

			/*print_r("employee_permit_days ");
			print_r($employee_permit_days);
			print_r("<BR>");*/
			/*exit;*/

			## DEDUCTION EMPLOYEE HOME EARLY
			$corehomeearly = $this->payrollemployeemonthlyadisurya_model->getCoreHomeEarly();

			$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);

			foreach($corehomeearly as $keyCoreHomeEarly => $valCoreHomeEarly){
				$deduction_id 				= $valCoreHomeEarly['deduction_id'];
				$home_early_id 				= $valCoreHomeEarly['home_early_id'];
				$employee_home_early_days 	= 0;

				$hroemployeehomeearly 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

				$employee_deduction_amount = 0;
				if (!empty($hroemployeehomeearly)){
					
					foreach ($hroemployeehomeearly as $keyEmployeeHomeEarly => $valEmployeeHomeEarly) {
						$employee_home_early_days++;
					}

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);
			
					$employee_deduction_amount = $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];

					$coredeductionallowance 	= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					if(!empty($coredeductionallowance)){
						
						foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
							$deduction_allowance_ratio 	= $valDeductionAllowance['deduction_allowance_ratio'];
							$employee_allowance_amount 	= $valDeductionAllowance['employee_allowance_amount'];
							$employee_deduction_amount 	= $employee_deduction_amount + ($deduction_allowance_ratio * $employee_allowance_amount);
						}
					}else{

					}

					if ($deduction_basic_salary_ratio > 0){
						$employee_deduction_amount = $employee_deduction_amount + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount) + $deduction_amount;
					}else {
						$employee_deduction_amount = $employee_deduction_amount  + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount) + $deduction_amount;
					}
				}

				$employee_deduction_subtotal = $employee_home_early_days * $employee_deduction_amount;

				if ($employee_home_early_days > 0){
					$data_payrollemployeehomeearly = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_home_early_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeehomeearly['deduction_id']] = $data_payrollemployeehomeearly;
					$this->session->set_userdata('addarrayemployeehomeearly-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeehomeearly = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeehomeearly);
				}
			}



			$employee_monthly_working_days = $payrollmonthlyperiod['monthly_period_working_days'] + $working_dayoff_days - $leave_request_days - $total_employee_absence_days - ($employee_home_early_days * 0.5) - $total_employee_permit_days;

			/*print_r("monthly_period_working_days ");
			print_r($payrollmonthlyperiod['monthly_period_working_days']);
			print_r("<BR>");
			print_r("working_dayoff_days ");
			print_r($working_dayoff_days);
			print_r("<BR>");
			print_r("leave_request_days ");
			print_r($leave_request_days);
			print_r("<BR>");
			print_r("employee_absence_days ");
			print_r($employee_absence_days);
			print_r("<BR>");
			print_r("employee_home_early_days ");
			print_r($employee_home_early_days);
			print_r("<BR>");
			print_r("employee_permit_days ");
			print_r($employee_permit_days);
			print_r("<BR>");
			print_r("total_employee_permit_days ");
			print_r($total_employee_permit_days);
			print_r("<BR>");
			print_r("employee_monthly_working_days ");
			print_r($employee_monthly_working_days);
			print_r("<BR>");*/
			/*exit;*/

			$payroll_monthly_allowance_total = 0;

			$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);

			/*print_r("employee_monthly_working_days ");
			print_r($employee_monthly_working_days);
			print_r("<BR>");
			print_r("payrollemployeeallowance ");
			print_r($payrollemployeeallowance);
			print_r("<BR>");*/
			/*exit;*/

			foreach ($payrollemployeeallowance as $keyAllowance=>$valAllowance){
				$employee_allowance_amount 	= $valAllowance['employee_allowance_amount'];
				$allowance_type 			= $valAllowance['allowance_type'];

				switch ($allowance_type) {
				    case 0:
				        $employee_monthly_allowance_days = 1;
						$employee_allowance_subtotal = $employee_allowance_amount;
				        break;
				    case 1:
				        $employee_monthly_allowance_days = $employee_monthly_working_days;
						$employee_allowance_subtotal = $employee_monthly_working_days * $employee_allowance_amount;
				        break;
				    case 2:
				        $employee_monthly_allowance_days = $leave_request_days;
						$employee_allowance_subtotal = $leave_request_days * $employee_allowance_amount;
				        break;
				  	case 3:     
				  		$employee_monthly_allowance_days = $working_dayoff_days;
						$employee_allowance_subtotal = $working_dayoff_days * $employee_allowance_amount;
						break;
				}

				

				$payroll_monthly_allowance_total = $payroll_monthly_allowance_total + $employee_allowance_subtotal;

				$data_payrollemployeeallowance = array(
					'employee_monthly_allowance_id'		=> date("YmdHis"),
					'employee_id' 						=> $valAllowance['employee_id'],
					'allowance_id' 						=> $valAllowance['allowance_id'],
					'employee_allowance_id'				=> $valAllowance['employee_allowance_id'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
					'employee_allowance_amount'			=> $valAllowance['employee_allowance_amount'],
					'employee_monthly_working_days'		=> $employee_monthly_working_days,
					'employee_monthly_allowance_days'	=> $employee_monthly_allowance_days,
					'employee_allowance_subtotal'		=> $employee_allowance_subtotal,
				);

				print_r("data_payrollemployeeallowance ");
				print_r($data_payrollemployeeallowance);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeallowance['allowance_id']] = $data_payrollemployeeallowance;
				$this->session->set_userdata('addarrayemployeeallowance-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeallowance = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeallowance);
			}

			/*exit;*/

			/*Calculate Overtime*/
			$overtime_working_hour_total = 0;
			$overtime_day_off_total = 0;

			$overtime_request_amount = $this->payrollemployeemonthlyadisurya_model->getPaymentBasicOvertime($employee_id, $year_period);

			$coreovertimetype = $this->payrollemployeemonthlyadisurya_model->getCoreOvertimeType();

			/*print_r("payrollovertimerequest ");
			print_r($payrollovertimerequest);
			print_r("<BR>");*/

			$overtime_type_working_day_hour_amount1 = 0;
			$overtime_type_working_day_hour_amount2 = 0;
			$overtime_type_day_off_hour_amount1		= 0;
			$overtime_type_day_off_hour_amount2		= 0;

			foreach($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$overtime_request_date = $valOvertime['overtime_request_date'];

				$day_name = date("D", strtotime($overtime_request_date));

				$dayoff_date = $this->payrollemployeemonthlyadisurya_model->getDayOffDate($overtime_request_date);

				if ($day_name != "Sun" && count($dayoff_date) == 0){
					$overtime_working_hour_total = $valOvertime['overtime_request_duration'];
					$overtime_working_day_remark = 'Lembur Hari Kerja';

					if ($overtime_working_hour_total < $coreovertimetype['overtime_type_working_day_hour1']){
						$overtime_type_working_day_hour_amount1 = $overtime_type_working_day_hour_amount1 + $overtime_working_hour_total * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 	
					}else {
						$overtime_type_working_day_hour_amount1 = $overtime_type_working_day_hour_amount1 + $coreovertimetype['overtime_type_working_day_hour1'] * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 
					}

					if ($overtime_working_hour_total > $coreovertimetype['overtime_type_working_day_hour1']){
						$overtime_type_working_day_hour_amount2 = $overtime_type_working_day_hour_amount2 + ($overtime_working_hour_total - $coreovertimetype['overtime_type_working_day_hour1']) * $coreovertimetype['overtime_type_working_day_ratio2'] * $overtime_request_amount;
					}else{

					}
				} else {
					$overtime_day_off_total = $valOvertime['overtime_request_duration'];
					$overtime_day_off_remark = 'Lembur Hari Libur';

					if ($overtime_day_off_total < $coreovertimetype['overtime_type_day_off_hour1']){
						$overtime_type_day_off_hour_amount1 = $overtime_type_day_off_hour_amount1 + $overtime_day_off_total * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
					}else {
						$overtime_type_day_off_hour_amount1 = $overtime_type_day_off_hour_amount1 + $coreovertimetype['overtime_type_day_off_hour1'] * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
					}

					if ($overtime_day_off_total > $coreovertimetype['overtime_type_day_off_hour1']){
						$overtime_type_day_off_hour_amount2 = $overtime_type_day_off_hour_amount2 + ($overtime_day_off_total - $coreovertimetype['overtime_type_day_off_hour1']) * $coreovertimetype['overtime_type_day_off_ratio2'] * $overtime_request_amount;
					}
				}
			}

			


			/*if ($overtime_working_hour_total < $coreovertimetype['overtime_type_working_day_hour1']){
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
			}*/

			$employee_overtime_amount_total = $overtime_type_working_day_hour_amount1 + $overtime_type_working_day_hour_amount2 + $overtime_type_day_off_hour_amount1 + $overtime_type_day_off_hour_amount2;


			$this->session->unset_userdata('addarrayemployeeovertime-'.$unique['unique']);

			if ($employee_overtime_amount_total > 0){
				$data_payrollemployeeovertime = array(
					'employee_id' 						=> $employee_id,
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
					'employee_basic_overtime'			=> $overtime_request_amount,
					'employee_overtime_monthly_total1'	=> $overtime_type_working_day_hour_amount1,
					'employee_overtime_monthly_total2'	=> $overtime_type_working_day_hour_amount2,
					'employee_overtime_dayoff_total1'	=> $overtime_type_day_off_hour_amount1,
					'employee_overtime_dayoff_total2'	=> $overtime_type_day_off_hour_amount2,
					'employee_overtime_amount_total'	=> $employee_overtime_amount_total,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeovertime['employee_id']] = $data_payrollemployeeovertime;
				$this->session->set_userdata('addarrayemployeeovertime-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeovertime = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);
				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeovertime);
			}

			/*exit;*/
			
			$payrollemployeebpjs			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeBPJS($employee_id);

			$payrollemployeepremiattendance = $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeePremiAttendance($employee_id, $year_period);


			/*## Calculate Assignment Business Trip
			$assignmentbusinesstrip = $this->payrollemployeemonthlyadisurya_model->getAssignmentBusinessTrip($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$employee_monthly_business_trip_amount = 0;
			foreach ($assignmentbusinesstrip as $keyBusinessTrip => $valBusinessTrip) {
				$employee_monthly_business_trip_amount = $employee_monthly_business_trip_amount + $valBusinessTrip['business_trip_amount'];
			}*/


			## CALCULATE SALARY TOTAL
			$data_payrollemployeemonthlyadisuryadeduction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);

			/*print_r("<BR>");
			print_r("data_payrollemployeemonthlyadisuryadeduction");
			print_r($data_payrollemployeemonthlyadisuryadeduction);*/

			$payroll_monthly_deduction_total = 0;

			if (!empty($data_payrollemployeemonthlyadisuryadeduction)){
				foreach ($data_payrollemployeemonthlyadisuryadeduction as $keyMonthlyDeduction => $valMonthlyDeduction) {
					$payroll_monthly_deduction_total = $payroll_monthly_deduction_total + $valMonthlyDeduction['employee_deduction_subtotal'];
				}
			}
			


			$data_payrollemployeemonthlyadisuryahomeearly = $this->session->userdata('addarrayemployeehomeearly-'.$sesi['unique']);

			/*print_r("<BR>");
			print_r("data_payrollemployeemonthlyadisuryahomeearly");
			print_r($data_payrollemployeemonthlyadisuryahomeearly);*/

			$home_early_total_amount = 0;

			if (!empty($data_payrollemployeemonthlyadisuryahomeearly)){
				foreach ($data_payrollemployeemonthlyadisuryahomeearly as $keyMonthlyEarly => $valMonthlyEarly) {
					$home_early_total_amount = $home_early_total_amount + $valMonthlyEarly['employee_deduction_subtotal'];
				}
			}

			$employee_monthly_salary_total = $payrollemployeepayment['payment_basic_salary'] + $payroll_monthly_allowance_total + $employee_overtime_amount_total + $employee_length_service_amount + $employee_premi_attendance_amount + $employee_incentive_amount - $payroll_monthly_deduction_total - $employee_loan_amount - $home_early_total_amount - $payrollemployeebpjs['bpjs_total_amount'] + $employee_monthly_business_trip_amount - $employee_monthly_saving_amount;

			/*print_r("<BR>");
			print_r("payment_basic_salary ");
			print_r($payrollemployeepayment['payment_basic_salary']);
			print_r("<BR>");
			print_r("payroll_monthly_allowance_total ");
			print_r($payroll_monthly_allowance_total);
			print_r("<BR>");
			print_r("employee_overtime_amount_total ");
			print_r($employee_overtime_amount_total);
			print_r("<BR>");
			print_r("employee_length_service_amount ");
			print_r($employee_length_service_amount);*/
			/*print_r("<BR>");
			print_r("employee_premi_attendance_amount ");
			print_r($employee_premi_attendance_amount);
			print_r("<BR>");*/
			/*print_r("employee_incentive_amount ");
			print_r($employee_incentive_amount);
			print_r("<BR>");
			print_r("payroll_monthly_deduction_total ");
			print_r($payroll_monthly_deduction_total);
			print_r("<BR>");
			print_r("employee_loan_amount ");
			print_r($employee_loan_amount);
			print_r("<BR>");
			print_r("home_early_total_amount ");
			print_r($home_early_total_amount);
			print_r("<BR>");
			print_r("employee_monthly_salary_total ");
			print_r($employee_monthly_salary_total);
			print_r("<BR>");
			exit;
*/
			$data_payrollemployeemonthlyadisurya = array(
				'employee_monthly_id'						=> date("YmdHis"),
				'employee_id' 								=> $employee_id,
				'employee_monthly_working_days'				=> $employee_monthly_working_days,
				'length_service_month'						=> $length_of_service_month,
				'employee_length_service_amount'			=> $employee_length_service_amount,
				'employee_premi_attendance_amount'			=> $employee_premi_attendance_amount,
				'employee_monthly_incentive_amount'			=> $employee_incentive_amount,
				'employee_monthly_loan_amount'				=> $employee_loan_amount,
				'employee_monthly_saving_amount'			=> $employee_monthly_saving_amount,
				'employee_monthly_business_trip_amount'		=> $employee_monthly_business_trip_amount,
				'employee_monthly_salary_total'				=> $employee_monthly_salary_total,
				'employee_monthly_bpjs_amount'				=> $payrollemployeebpjs['bpjs_total_amount'],
				'employee_monthly_bpjs_kesehatan_amount'	=> $payrollemployeebpjs['bpjs_kesehatan_amount'],
				'employee_monthly_bpjs_tenagakerja_amount'	=> $payrollemployeebpjs['bpjs_tenagakerja_amount'],
				'employee_monthly_premi_attendance'			=> $payrollemployeepremiattendance['employee_premi_attendance_amount'],
			);

			## PAYROLL EMPLOYEE MONTHLY DETAIL - LEAVE REQUEST 
			$this->session->unset_userdata('addarrayemployeeleaverequest-'.$unique['unique']);
			foreach ($payrollleaverequest as $keyLeaveRequest=>$valLeaveRequest){
				$data_payrollleaverequest = array(
					'leave_request_detail_id' 			=> $valLeaveRequest['leave_request_detail_id'],
					'employee_id' 						=> $valLeaveRequest['employee_id'],
					'annual_leave_id'					=> $valLeaveRequest['annual_leave_id'],
					'leave_request_detail_date'			=> $valLeaveRequest['leave_request_detail_date'],
					'leave_request_description'			=> $valLeaveRequest['leave_request_description'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollleaverequest['leave_request_detail_id']] = $data_payrollleaverequest;

				$this->session->set_userdata('addarrayemployeeleaverequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollleaverequest = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollleaverequest);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - ABSENCE
			$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
			$absence_id = "";
			$hroemployeeabsence 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

			foreach ($hroemployeeabsence as $keyAbsence=>$valAbsence){
				$data_payrollemployeeabsence = array(
					'employee_absence_detail_id'	=> $valAbsence['employee_absence_detail_id'],
					'employee_id' 					=> $valAbsence['employee_id'],
					'absence_id'					=> $valAbsence['absence_id'],
					'employee_absence_description'	=> $valAbsence['employee_absence_description'],
					'employee_absence_detail_date'	=> $valAbsence['employee_absence_detail_date'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeabsence['employee_absence_detail_id']] = $data_payrollemployeeabsence;

				$this->session->set_userdata('addarrayemployeeabsence-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeabsence = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeabsence);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - PERMIT
			$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
			$permit_id = "";
			$hroemployeepermit 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);
			
			foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				$data_payrollemployeepermit = array(
					'employee_permit_detail_id'			=> $valPermit['employee_permit_detail_id'],
					'employee_id' 						=> $valPermit['employee_id'],
					'permit_id'							=> $valPermit['permit_id'],
					'permit_type'						=> $valPermit['permit_type'],
					'deduction_type'					=> $valPermit['deduction_type'],
					'employee_permit_description'		=> $valPermit['employee_permit_description'],
					'employee_permit_detail_date'		=> $valPermit['employee_permit_detail_date'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeepermit['employee_permit_detail_id']] = $data_payrollemployeepermit;

				$this->session->set_userdata('addarrayemployeepermit-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeepermit = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeepermit);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - WORKING DAY OFF
			$this->session->unset_userdata('addarrayemployeedayoff-'.$unique['unique']);

			foreach ($hroemployeeworkingdayoff as $keyDayOff=>$valDayOff){
				$data_payrollemployeedayoff = array(
					'working_dayoff_detail_id'				=> $valDayOff['working_dayoff_detail_id'],
					'employee_id' 							=> $valDayOff['employee_id'],
					'dayoff_id'								=> $valDayOff['dayoff_id'],
					'employee_working_dayoff_description'	=> $valDayOff['employee_working_dayoff_description'],
					'working_dayoff_detail_date'			=> $valDayOff['working_dayoff_detail_date'],
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeedayoff['working_dayoff_detail_id']] = $data_payrollemployeedayoff;

				$this->session->set_userdata('addarrayemployeedayoff-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeedayoff = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeedayoff);
			}
			
			## PAYROLL EMPLOYEE MONTHLY DETAIL - OVERTIME REQUEST
			$this->session->unset_userdata('addarrayemployeeovertimerequest-'.$unique['unique']);

			foreach ($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$data_payrollemployeeovertimerequest = array(
					'overtime_request_id'			=> $valOvertime['overtime_request_id'],
					'employee_id' 					=> $valOvertime['employee_id'],
					'overtime_type_id'				=> $valOvertime['overtime_type_id'],
					'overtime_request_description'	=> $valOvertime['overtime_request_description'],
					'overtime_request_date'			=> $valOvertime['overtime_request_date'],
					'overtime_request_duration'		=> $valOvertime['overtime_request_duration'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeovertimerequest['overtime_request_id']] = $data_payrollemployeeovertimerequest;

				$this->session->set_userdata('addarrayemployeeovertimerequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeovertimerequest = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeovertimerequest);
			}


			## PAYROLL EMPLOYEE MONTHLY DETAIL - LATE
			$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);

			$late_id = "";
			$hroemployeelate 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);
			
			foreach ($hroemployeelate as $keyLate=>$valLate){
				$data_payrollemployeelate = array(
					'employee_late_id'				=> $valLate['employee_late_id'],
					'employee_id' 					=> $valLate['employee_id'],
					'late_id'						=> $valLate['late_id'],
					'employee_late_description'		=> $valLate['employee_late_description'],
					'employee_late_date'			=> $valLate['employee_late_date'],
					'employee_late_duration'		=> $valLate['employee_late_duration'],
					'employee_monthly_period'		=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeelate['employee_late_id']] = $data_payrollemployeelate;

				$this->session->set_userdata('addarrayemployeelate-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeelate = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeelate);
			}


			## PAYROLL EMPLOYEE MONTHLY DETAIL - HOME EARLY
			$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);

			$home_early_id = "";
			$hroemployeehomeearly 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

			foreach ($hroemployeehomeearly as $keyHomeEarly=>$valHomeEarly){
				$data_payrollemployeehomeearlymonthly = array(
					'employee_home_early_monthly_id'			=> $valHomeEarly['employee_home_early_id'],
					'employee_id' 								=> $valHomeEarly['employee_id'],
					'home_early_id' 							=> $valHomeEarly['home_early_id'],
					'employee_home_early_monthly_description'	=> $valHomeEarly['employee_home_early_description'],
					'employee_home_early_monthly_date'			=> $valHomeEarly['employee_home_early_date'],
					'employee_home_early_monthly_hour'			=> $valHomeEarly['employee_home_early_hour'],
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeehomeearlymonthly['employee_home_early_monthly_id']] = $data_payrollemployeehomeearlymonthly;

				$this->session->set_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeehomeearlymonthly = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeehomeearlymonthly);
			}


			/*#ASSIGNMENT BUSINESS TRIP DETAIL
			$this->session->unset_userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique']);
			
			foreach ($assignmentbusinesstrip as $keyBusinessTrip => $valBusinessTrip){
				$data_payrollemployeemonthlyadisuryabusinesstrip = array(
					'business_trip_id'			=> $valBusinessTrip['business_trip_id'],
					'business_trip_date' 		=> $valBusinessTrip['business_trip_date'],
					'overtime_rate_id' 			=> $valBusinessTrip['overtime_rate_id'],
					'overtime_rate_description'	=> $valBusinessTrip['overtime_rate_description'],
					'business_trip_destination'	=> $valBusinessTrip['business_trip_destination'],
					'business_trip_amount'		=> $valBusinessTrip['business_trip_amount'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlyadisuryabusinesstrip['business_trip_id']] = $data_payrollemployeemonthlyadisuryabusinesstrip;

				$this->session->set_userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlyadisuryabusinesstrip = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeemonthlyadisuryabusinesstrip);
			}*/

			/*exit;*/
			$data['main_view']['hroemployeedata']						= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeemonthlyadisurya_data']	= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthly_Data($employee_id);
			
			$data['main_view']['payrollemployeepayment']				= $payrollemployeepayment;
			$data['main_view']['payrollmonthlyperiod']					= $payrollmonthlyperiod;
			$data['main_view']['payrollemployeemonthlyadisurya']				= $data_payrollemployeemonthlyadisurya;

			$data['main_view']['content']								= 'payrollemployeemonthlyadisurya/listaddpayrollemployeemonthlyadisurya_view';
			$this->load->view('mainpage_view',$data);
		}


		public function processCalculatePayrollEmployeeMonthly(){
			$employee_id 								= $this->input->post('employee_id',true);
			$employee_monthly_allowance_other 			= $this->input->post('employee_monthly_allowance_other',true);
			$employee_monthly_allowance_description 	= $this->input->post('employee_monthly_allowance_description',true);
			$employee_monthly_deduction_other 			= $this->input->post('employee_monthly_deduction_other',true);
			$employee_monthly_deduction_description 	= $this->input->post('employee_monthly_deduction_description',true);
			$employee_monthly_date 						= $this->input->post('employee_monthly_date',true);


			$employee_hire_date 				= $this->payrollemployeemonthlyadisurya_model->getEmployeeHireDate($employee_id);

			$payrollmonthlyperiod 				= $this->payrollemployeemonthlyadisurya_model->getPayrollMonthlyPeriod();

			$payrollmonthlyperiod['monthly_period_working_days'] = $this->input->post('employee_monthly_working_days',true);

			$year_period 						= date("Y", strtotime($payrollmonthlyperiod['monthly_period_start_date']));
			$monthly_period 					= $payrollmonthlyperiod['monthly_period']; 
			$monthly_period_start_date 			= $payrollmonthlyperiod['monthly_period_start_date'];
			$monthly_period_end_date 			= $payrollmonthlyperiod['monthly_period_end_date'];

			$lengthofservice 					= date_diff(date_create($monthly_period_end_date), date_create($employee_hire_date));
			$length_of_service_month 			= ($lengthofservice->days) / 30;

			/*Length of Service*/
			$payrollemployeelengthservice 		= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeLengthService($employee_id, $length_of_service_month, $year_period);

			$employee_length_service_amount 	= $payrollemployeelengthservice['employee_length_service_amount'];

			/*Payroll Employee Incentive*/
			$employee_incentive_amount 			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeIncentive($employee_id, $year_period);

			/*Payroll Employee Loan*/
			$employee_loan_amount 				= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeLoan($employee_id, $monthly_period);

			$payrollemployeepayment 			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeePayment($employee_id, $year_period);

			/*Leave Calculation*/
			$payrollleaverequest 				= $this->payrollemployeemonthlyadisurya_model->getPayrollLeaveRequest($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$leave_request_days 				= count($payrollleaverequest);

			/*Day Off*/
			$hroemployeeworkingdayoff 			= $this->payrollemployeemonthlyadisurya_model->getHROmployeeWorkingDayOff($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$working_dayoff_days 				= count($hroemployeeworkingdayoff);

			/*Overtime*/
			$payrollovertimerequest 			= $this->payrollemployeemonthlyadisurya_model->getPayrollOvertimeRequest($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			/*Home Early*/
			$hroemployeehomeearlymonthly 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeHomeEarlyMonthly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$payrollemployeeallowance 			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeAllowance($employee_id, $year_period);

			$employee_premi_attendance_amount 	= $this->payrollemployeemonthlyadisurya_model->getEmployeePremiAttendanceAmount($employee_id, $year_period);

			$employee_monthly_saving_amount 	= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeSaving($employee_id, $year_period);

			/*Deduction*/
			$payroll_monthly_deduction_total 	= 0;

			## DEDUCTION EMPLOYEE LATE
			$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);

			$corelate = $this->payrollemployeemonthlyadisurya_model->getCoreLate();
			$total_employee_late_days = 0;

			foreach($corelate as $keyCoreLate => $valCoreLate){
				$deduction_id 		= $valCoreLate['deduction_id'];
				$late_id 			= $valCoreLate['late_id'];
				$employee_late_days = 0;

				$hroemployeelate 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);

				$employee_deduction_amount = 0;

				if (!empty($hroemployeelate)){
					foreach ($hroemployeelate as $keyEmployeeLate => $valEmployeeLate) {
						$employee_late_days++;
					}

					$total_employee_late_days = $total_employee_late_days + $employee_late_days;

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					if ($employee_deduction_amount == 0){
						if(!empty($coredeductionallowance)){
							$employee_deduction_subtotal 		= 0;
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
							$deduction_amount1					= $deduction_amount;
						}else{
							$employee_deduction_subtotal 		= $deduction_amount;
							$deduction_amount1 					= 0;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
						} else {
							$total_premi = 0;
						}

						if ($deduction_premi_attendance_status == 0){
							if ($employee_late_days <= $total_premi){
								$premi_attendance = $employee_late_days;  # Daily	
							} else {
								$premi_attendance = $total_premi;  # Daily	
							}
						} else {
							$premi_attendance = 1;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

							$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
						}						


						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal ;
						}
					}
				}

				if ($employee_late_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_late_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}


			## DEDUCTION EMPLOYEE ABSENCE
			$coreabsence 					= $this->payrollemployeemonthlyadisurya_model->getCoreAbsence();
			$total_employee_absence_days	= 0;

			foreach($coreabsence as $keyCoreAbsence => $valCoreAbsence){
				$deduction_id 			= $valCoreAbsence['deduction_id'];
				$absence_id 			= $valCoreAbsence['absence_id'];
				$employee_absence_days 	= 0;

				$hroemployeeabsence 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

				/*print_r("hroemployeeabsence ");
				print_r($hroemployeeabsence);
				print_r("<BR>");*/

				if (!empty($hroemployeeabsence)){
					foreach ($hroemployeeabsence as $keyEmployeeAbsence => $valEmployeeAbsence) {
						$employee_absence_days++;
					}

					$total_employee_absence_days = $total_employee_absence_days +$employee_absence_days;

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

					/*print_r("payrollemployeededuction ");
					print_r($payrollemployeededuction);
					print_r("<BR>");*/

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					if ($employee_deduction_amount == 0){
						if(!empty($coredeductionallowance)){
							$employee_deduction_subtotal 		= 0;
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
							$deduction_amount1					= $deduction_amount;
						}else{
							$employee_deduction_subtotal 		= $deduction_amount;
							$deduction_amount1 					= 0;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
						} else {
							$total_premi = 0;
						}

						if ($deduction_premi_attendance_status == 0){
							if ($employee_absence_days <= $total_premi){
								$premi_attendance = $employee_absence_days;  # Daily	
							} else {
								$premi_attendance = $total_premi;  # Daily	
							}
						} else {
							$premi_attendance = 1;
						}

						if ($deduction_premi_attendance_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

							$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
						}						


						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + $deduction_amount1;
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  ;
						}
					} else {
						$employee_deduction_subtotal 			= $employee_deduction_amount;
					}
				}

				if ($employee_absence_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_absence_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					/*print_r("data_payrollemployeededuction ");
					print_r($data_payrollemployeededuction);
					print_r("<BR>");*/

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}


			/*exit;*/

			## DEDUCTION EMPLOYEE PERMIT
			$corepermit = $this->payrollemployeemonthlyadisurya_model->getCorePermit();
			$total_employee_permit_days = 0;

			foreach($corepermit as $keyCorePermit => $valCorePermit){
				$deduction_id 			= $valCorePermit['deduction_id'];
				$permit_id 				= $valCorePermit['permit_id'];
				$employee_permit_days 	= 0;

				$hroemployeepermit 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);

				/*print_r("hroemployeepermit ");
				print_r($hroemployeepermit);
				print_r("<BR>");*/

				$employee_deduction_amount = 0;
				if (!empty($hroemployeepermit)){
					
					foreach ($hroemployeepermit as $keyEmployeePermit => $valEmployeePermit) {
						if ($valCorePermit['permit_status'] == 1){
							$employee_permit_days++;
						}
					}

					$total_employee_permit_days = $total_employee_permit_days + $employee_permit_days;

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					/*print_r("employee_id ");
					print_r($employee_id);
					print_r("<BR> ");
					print_r("coredeductionallowance ");
					print_r($coredeductionallowance);
					print_r("<BR> ");
					print_r("payrollemployeededuction ");
					print_r($payrollemployeededuction);
					print_r("<BR> ");

					print_r("employee_deduction_amount ");
					print_r($employee_deduction_amount);
					print_r("<BR> ");

					print_r("deduction_amount ");
					print_r($deduction_amount);
					print_r("<BR> ");*/

					if ($employee_deduction_amount == 0){
						if(!empty($coredeductionallowance)){
							$employee_deduction_subtotal 		= 0;
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);

								/*print_r("deduction_allowance_ratio ");
								print_r($valDeductionAllowance['deduction_allowance_ratio']);
								print_r("<BR> ");

								print_r("employee_allowance_amount ");
								print_r($valDeductionAllowance['employee_allowance_amount']);
								print_r("<BR> ");
								print_r("<BR> ");
								print_r("<BR> ");*/
							}
							$deduction_amount1				= $deduction_amount;
						}else{
							$employee_deduction_subtotal 	= $deduction_amount;
							$deduction_amount1 				= 0;
						}

						/*print_r("employee_deduction_subtotal ");
						print_r($employee_deduction_subtotal);
						print_r("<BR> ");

						print_r("deduction_amount ");
						print_r($deduction_amount1);
						print_r("<BR> ");*/

						if ($deduction_premi_attendance_ratio > 0){
							$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
						} else {
							$total_premi = 0;
						}
						

						/*print_r("total_premi ");
						print_r($total_premi);
						print_r("<BR> ");*/

						if ($deduction_premi_attendance_status == 0){
							if ($employee_permit_days <= $total_premi){
								$premi_attendance = $employee_permit_days;  # Daily	
							} else {
								$premi_attendance = $total_premi;  # Daily	
							}
						} else {
							$premi_attendance = 1;
						}

						/*print_r("employee_premi_attendance_amount awal ");
						print_r($employee_premi_attendance_amount);
						print_r("<BR> ");

						print_r("premi_attendance ");
						print_r($premi_attendance);
						print_r("<BR> ");

						print_r("deduction_premi_attendance_ratio ");
						print_r($deduction_premi_attendance_ratio);
						print_r("<BR> ");*/

						if ($deduction_premi_attendance_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

							$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
						}						

						/*print_r("employee_premi_attendance_amount akhir ");
						print_r($employee_premi_attendance_amount);
						print_r("<BR> ");

						print_r("employee_deduction_subtotal akhir ");
						print_r($employee_deduction_subtotal);
						print_r("<BR> ");

						print_r("deduction_basic_salary_ratio ");
						print_r($deduction_basic_salary_ratio);
						print_r("<BR> ");*/

						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + $deduction_amount1;
						}else {
							$employee_deduction_subtotal 		= $employee_deduction_subtotal;
						}

						/*print_r("employee_deduction_subtotal salary ");
						print_r($employee_deduction_subtotal);
						print_r("<BR> ");*/
					} else {
						$employee_deduction_subtotal			= $employee_deduction_amount;
					}
				}

				/*$employee_deduction_subtotal = $employee_deduction_subtotal + $employee_deduction_amount;*/

				/*print_r("employee_deduction_subtotal ");
				print_r($employee_deduction_subtotal);
				print_r("<BR>");
				print_r("<BR>");*/

				if ($employee_permit_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_permit_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
					);

					/*print_r("data_payrollemployeededuction ");
					print_r($data_payrollemployeededuction);
					print_r("<BR>");*/

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}

			/*print_r("employee_permit_days ");
			print_r($employee_permit_days);
			print_r("<BR>");*/
			/*exit;*/

			## DEDUCTION EMPLOYEE HOME EARLY
			$corehomeearly = $this->payrollemployeemonthlyadisurya_model->getCoreHomeEarly();

			$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);

			foreach($corehomeearly as $keyCoreHomeEarly => $valCoreHomeEarly){
				$deduction_id 				= $valCoreHomeEarly['deduction_id'];
				$home_early_id 				= $valCoreHomeEarly['home_early_id'];
				$employee_home_early_days 	= 0;

				$hroemployeehomeearly 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

				$employee_deduction_amount = 0;
				if (!empty($hroemployeehomeearly)){
					
					foreach ($hroemployeehomeearly as $keyEmployeeHomeEarly => $valEmployeeHomeEarly) {
						$employee_home_early_days++;
					}

					$payrollemployeededuction = $this->payrollemployeemonthlyadisurya_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);
			
					$employee_deduction_amount = $payrollemployeededuction['employee_deduction_amount'];

					$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];

					$coredeductionallowance 	= $this->payrollemployeemonthlyadisurya_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					if(!empty($coredeductionallowance)){
						
						foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
							$deduction_allowance_ratio 	= $valDeductionAllowance['deduction_allowance_ratio'];
							$employee_allowance_amount 	= $valDeductionAllowance['employee_allowance_amount'];
							$employee_deduction_amount 	= $employee_deduction_amount + ($deduction_allowance_ratio * $employee_allowance_amount);
						}
					}else{

					}

					if ($deduction_basic_salary_ratio > 0){
						$employee_deduction_amount = $employee_deduction_amount + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount) + $deduction_amount;
					}else {
						$employee_deduction_amount = $employee_deduction_amount  + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount) + $deduction_amount;
					}
				}

				$employee_deduction_subtotal = $employee_home_early_days * $employee_deduction_amount;

				if ($employee_home_early_days > 0){
					$data_payrollemployeehomeearly = array(
						'employee_monthly_deduction_id'		=> date("YmdHis"),
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_home_early_days,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeehomeearly['deduction_id']] = $data_payrollemployeehomeearly;
					$this->session->set_userdata('addarrayemployeehomeearly-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeehomeearly = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeehomeearly);
				}
			}



			$employee_monthly_working_days = $payrollmonthlyperiod['monthly_period_working_days'] + $working_dayoff_days - $leave_request_days - $total_employee_absence_days - ($employee_home_early_days * 0.5) - $total_employee_permit_days;

			/*print_r("monthly_period_working_days ");
			print_r($payrollmonthlyperiod['monthly_period_working_days']);
			print_r("<BR>");
			print_r("working_dayoff_days ");
			print_r($working_dayoff_days);
			print_r("<BR>");
			print_r("leave_request_days ");
			print_r($leave_request_days);
			print_r("<BR>");
			print_r("employee_absence_days ");
			print_r($employee_absence_days);
			print_r("<BR>");
			print_r("employee_home_early_days ");
			print_r($employee_home_early_days);
			print_r("<BR>");
			print_r("employee_permit_days ");
			print_r($employee_permit_days);
			print_r("<BR>");
			print_r("total_employee_permit_days ");
			print_r($total_employee_permit_days);
			print_r("<BR>");
			print_r("employee_monthly_working_days ");
			print_r($employee_monthly_working_days);
			print_r("<BR>");*/
			/*exit;*/

			$payroll_monthly_allowance_total = 0;

			$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);

			foreach ($payrollemployeeallowance as $keyAllowance=>$valAllowance){
				$employee_allowance_amount = $valAllowance['employee_allowance_amount'];
				$allowance_type = $valAllowance['allowance_type'];

				switch ($allowance_type) {
				    case 0:
				        $employee_monthly_allowance_days = 1;
						$employee_allowance_subtotal = $employee_allowance_amount;
				        break;
				    case 1:
				        $employee_monthly_allowance_days = $employee_monthly_working_days;
						$employee_allowance_subtotal = $employee_monthly_working_days * $employee_allowance_amount;
				        break;
				    case 2:
				        $employee_monthly_allowance_days = $leave_request_days;
						$employee_allowance_subtotal = $leave_request_days * $employee_allowance_amount;
				        break;
				  	case 3:     
				  		$employee_monthly_allowance_days = $working_dayoff_days;
						$employee_allowance_subtotal = $working_dayoff_days * $employee_allowance_amount;
						break;
				}

				

				$payroll_monthly_allowance_total = $payroll_monthly_allowance_total + $employee_allowance_subtotal;

				$data_payrollemployeeallowance = array(
					'employee_monthly_allowance_id'		=> date("YmdHis"),
					'employee_id' 						=> $valAllowance['employee_id'],
					'allowance_id' 						=> $valAllowance['allowance_id'],
					'employee_allowance_id'				=> $valAllowance['employee_allowance_id'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
					'employee_allowance_amount'			=> $valAllowance['employee_allowance_amount'],
					'employee_monthly_working_days'		=> $employee_monthly_working_days,
					'employee_monthly_allowance_days'	=> $employee_monthly_allowance_days,
					'employee_allowance_subtotal'		=> $employee_allowance_subtotal,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeallowance['allowance_id']] = $data_payrollemployeeallowance;
				$this->session->set_userdata('addarrayemployeeallowance-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeallowance = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeallowance);
			}

			/*Calculate Overtime*/
			$overtime_working_hour_total = 0;
			$overtime_day_off_total = 0;

			$overtime_request_amount = $this->payrollemployeemonthlyadisurya_model->getPaymentBasicOvertime($employee_id, $year_period);

			$coreovertimetype = $this->payrollemployeemonthlyadisurya_model->getCoreOvertimeType();

			/*print_r("payrollovertimerequest ");
			print_r($payrollovertimerequest);
			print_r("<BR>");*/

			$overtime_type_working_day_hour_amount1 = 0;
			$overtime_type_working_day_hour_amount2 = 0;
			$overtime_type_day_off_hour_amount1		= 0;
			$overtime_type_day_off_hour_amount2		= 0;

			foreach($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$overtime_request_date = $valOvertime['overtime_request_date'];

				$day_name = date("D", strtotime($overtime_request_date));

				$dayoff_date = $this->payrollemployeemonthlyadisurya_model->getDayOffDate($overtime_request_date);

				if ($day_name != "Sun" && count($dayoff_date) == 0){
					$overtime_working_hour_total = $valOvertime['overtime_request_duration'];
					$overtime_working_day_remark = 'Lembur Hari Kerja';

					if ($overtime_working_hour_total < $coreovertimetype['overtime_type_working_day_hour1']){
						$overtime_type_working_day_hour_amount1 = $overtime_type_working_day_hour_amount1 + $overtime_working_hour_total * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 	
					}else {
						$overtime_type_working_day_hour_amount1 = $overtime_type_working_day_hour_amount1 + $coreovertimetype['overtime_type_working_day_hour1'] * $coreovertimetype['overtime_type_working_day_ratio1'] * $overtime_request_amount; 
					}

					if ($overtime_working_hour_total > $coreovertimetype['overtime_type_working_day_hour1']){
						$overtime_type_working_day_hour_amount2 = $overtime_type_working_day_hour_amount2 + ($overtime_working_hour_total - $coreovertimetype['overtime_type_working_day_hour1']) * $coreovertimetype['overtime_type_working_day_ratio2'] * $overtime_request_amount;
					}else{

					}
				} else {
					$overtime_day_off_total = $valOvertime['overtime_request_duration'];
					$overtime_day_off_remark = 'Lembur Hari Libur';

					if ($overtime_day_off_total < $coreovertimetype['overtime_type_day_off_hour1']){
						$overtime_type_day_off_hour_amount1 = $overtime_type_day_off_hour_amount1 + $overtime_day_off_total * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
					}else {
						$overtime_type_day_off_hour_amount1 = $overtime_type_day_off_hour_amount1 + $coreovertimetype['overtime_type_day_off_hour1'] * $coreovertimetype['overtime_type_day_off_ratio1'] * $overtime_request_amount;
					}

					if ($overtime_day_off_total > $coreovertimetype['overtime_type_day_off_hour1']){
						$overtime_type_day_off_hour_amount2 = $overtime_type_day_off_hour_amount2 + ($overtime_day_off_total - $coreovertimetype['overtime_type_day_off_hour1']) * $coreovertimetype['overtime_type_day_off_ratio2'] * $overtime_request_amount;
					}
				}
			}

			


			/*if ($overtime_working_hour_total < $coreovertimetype['overtime_type_working_day_hour1']){
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
			}*/

			$employee_overtime_amount_total = $overtime_type_working_day_hour_amount1 + $overtime_type_working_day_hour_amount2 + $overtime_type_day_off_hour_amount1 + $overtime_type_day_off_hour_amount2;


			$this->session->unset_userdata('addarrayemployeeovertime-'.$unique['unique']);

			if ($employee_overtime_amount_total > 0){
				$data_payrollemployeeovertime = array(
					'employee_id' 						=> $employee_id,
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
					'employee_basic_overtime'			=> $overtime_request_amount,
					'employee_overtime_monthly_total1'	=> $overtime_type_working_day_hour_amount1,
					'employee_overtime_monthly_total2'	=> $overtime_type_working_day_hour_amount2,
					'employee_overtime_dayoff_total1'	=> $overtime_type_day_off_hour_amount1,
					'employee_overtime_dayoff_total2'	=> $overtime_type_day_off_hour_amount2,
					'employee_overtime_amount_total'	=> $employee_overtime_amount_total,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeovertime['employee_id']] = $data_payrollemployeeovertime;
				$this->session->set_userdata('addarrayemployeeovertime-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeovertime = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);
				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeovertime);
			}

			/*exit;*/
			
			$payrollemployeebpjs			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeBPJS($employee_id);

			$payrollemployeepremiattendance = $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeePremiAttendance($employee_id, $year_period);


			## Calculate Assignment Business Trip
			$assignmentbusinesstrip = $this->payrollemployeemonthlyadisurya_model->getAssignmentBusinessTrip($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$employee_monthly_business_trip_amount = 0;
			foreach ($assignmentbusinesstrip as $keyBusinessTrip => $valBusinessTrip) {
				$employee_monthly_business_trip_amount = $employee_monthly_business_trip_amount + $valBusinessTrip['business_trip_amount'];
			}


			## CALCULATE SALARY TOTAL
			$data_payrollemployeemonthlyadisuryadeduction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);

			/*print_r("<BR>");
			print_r("data_payrollemployeemonthlyadisuryadeduction");
			print_r($data_payrollemployeemonthlyadisuryadeduction);*/

			$payroll_monthly_deduction_total = 0;

			if (!empty($data_payrollemployeemonthlyadisuryadeduction)){
				foreach ($data_payrollemployeemonthlyadisuryadeduction as $keyMonthlyDeduction => $valMonthlyDeduction) {
					$payroll_monthly_deduction_total = $payroll_monthly_deduction_total + $valMonthlyDeduction['employee_deduction_subtotal'];
				}
			}
			


			$data_payrollemployeemonthlyadisuryahomeearly = $this->session->userdata('addarrayemployeehomeearly-'.$sesi['unique']);

			/*print_r("<BR>");
			print_r("data_payrollemployeemonthlyadisuryahomeearly");
			print_r($data_payrollemployeemonthlyadisuryahomeearly);*/

			$home_early_total_amount = 0;

			if (!empty($data_payrollemployeemonthlyadisuryahomeearly)){
				foreach ($data_payrollemployeemonthlyadisuryahomeearly as $keyMonthlyEarly => $valMonthlyEarly) {
					$home_early_total_amount = $home_early_total_amount + $valMonthlyEarly['employee_deduction_subtotal'];
				}
			}

			$employee_monthly_salary_total = $payrollemployeepayment['payment_basic_salary'] + $payroll_monthly_allowance_total + $employee_overtime_amount_total + $employee_length_service_amount + $employee_premi_attendance_amount + $employee_incentive_amount - $payroll_monthly_deduction_total - $employee_loan_amount - $home_early_total_amount - $payrollemployeebpjs['bpjs_total_amount'] + $employee_monthly_business_trip_amount - $employee_monthly_saving_amount;

			/*print_r("<BR>");
			print_r("payment_basic_salary ");
			print_r($payrollemployeepayment['payment_basic_salary']);
			print_r("<BR>");
			print_r("payroll_monthly_allowance_total ");
			print_r($payroll_monthly_allowance_total);
			print_r("<BR>");
			print_r("employee_overtime_amount_total ");
			print_r($employee_overtime_amount_total);
			print_r("<BR>");
			print_r("employee_length_service_amount ");
			print_r($employee_length_service_amount);*/
			/*print_r("<BR>");
			print_r("employee_premi_attendance_amount ");
			print_r($employee_premi_attendance_amount);
			print_r("<BR>");*/
			/*print_r("employee_incentive_amount ");
			print_r($employee_incentive_amount);
			print_r("<BR>");
			print_r("payroll_monthly_deduction_total ");
			print_r($payroll_monthly_deduction_total);
			print_r("<BR>");
			print_r("employee_loan_amount ");
			print_r($employee_loan_amount);
			print_r("<BR>");
			print_r("home_early_total_amount ");
			print_r($home_early_total_amount);
			print_r("<BR>");
			print_r("employee_monthly_salary_total ");
			print_r($employee_monthly_salary_total);
			print_r("<BR>");
			exit;
*/
			$data_payrollemployeemonthlyadisurya = array(
				'employee_monthly_id'						=> date("YmdHis"),
				'employee_id' 								=> $employee_id,
				'employee_monthly_working_days'				=> $employee_monthly_working_days,
				'length_service_month'						=> $length_of_service_month,
				'employee_length_service_amount'			=> $employee_length_service_amount,
				'employee_premi_attendance_amount'			=> $employee_premi_attendance_amount,
				'employee_monthly_incentive_amount'			=> $employee_incentive_amount,
				'employee_monthly_loan_amount'				=> $employee_loan_amount,
				'employee_monthly_saving_amount'			=> $employee_monthly_saving_amount,
				'employee_monthly_business_trip_amount'		=> $employee_monthly_business_trip_amount,
				'employee_monthly_salary_total'				=> $employee_monthly_salary_total,
				'employee_monthly_bpjs_amount'				=> $payrollemployeebpjs['bpjs_total_amount'],
				'employee_monthly_bpjs_kesehatan_amount'	=> $payrollemployeebpjs['bpjs_kesehatan_amount'],
				'employee_monthly_bpjs_tenagakerja_amount'	=> $payrollemployeebpjs['bpjs_tenagakerja_amount'],
				'employee_monthly_premi_attendance'			=> $payrollemployeepremiattendance['employee_premi_attendance_amount'],
			);

			## PAYROLL EMPLOYEE MONTHLY DETAIL - LEAVE REQUEST 
			$this->session->unset_userdata('addarrayemployeeleaverequest-'.$unique['unique']);
			foreach ($payrollleaverequest as $keyLeaveRequest=>$valLeaveRequest){
				$data_payrollleaverequest = array(
					'leave_request_detail_id' 			=> $valLeaveRequest['leave_request_detail_id'],
					'employee_id' 						=> $valLeaveRequest['employee_id'],
					'annual_leave_id'					=> $valLeaveRequest['annual_leave_id'],
					'leave_request_detail_date'			=> $valLeaveRequest['leave_request_detail_date'],
					'leave_request_description'			=> $valLeaveRequest['leave_request_description'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollleaverequest['leave_request_detail_id']] = $data_payrollleaverequest;

				$this->session->set_userdata('addarrayemployeeleaverequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollleaverequest = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollleaverequest);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - ABSENCE
			$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
			$absence_id = "";
			$hroemployeeabsence 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

			foreach ($hroemployeeabsence as $keyAbsence=>$valAbsence){
				$data_payrollemployeeabsence = array(
					'employee_absence_detail_id'	=> $valAbsence['employee_absence_detail_id'],
					'employee_id' 					=> $valAbsence['employee_id'],
					'absence_id'					=> $valAbsence['absence_id'],
					'employee_absence_description'	=> $valAbsence['employee_absence_description'],
					'employee_absence_detail_date'	=> $valAbsence['employee_absence_detail_date'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeabsence['employee_absence_detail_id']] = $data_payrollemployeeabsence;

				$this->session->set_userdata('addarrayemployeeabsence-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeabsence = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeabsence);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - PERMIT
			$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
			$permit_id = "";
			$hroemployeepermit 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);
			
			foreach ($hroemployeepermit as $keyPermit=>$valPermit){
				$data_payrollemployeepermit = array(
					'employee_permit_detail_id'			=> $valPermit['employee_permit_detail_id'],
					'employee_id' 						=> $valPermit['employee_id'],
					'permit_id'							=> $valPermit['permit_id'],
					'permit_type'						=> $valPermit['permit_type'],
					'deduction_type'					=> $valPermit['deduction_type'],
					'employee_permit_description'		=> $valPermit['employee_permit_description'],
					'employee_permit_detail_date'		=> $valPermit['employee_permit_detail_date'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeepermit['employee_permit_detail_id']] = $data_payrollemployeepermit;

				$this->session->set_userdata('addarrayemployeepermit-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeepermit = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeepermit);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - WORKING DAY OFF
			$this->session->unset_userdata('addarrayemployeedayoff-'.$unique['unique']);

			foreach ($hroemployeeworkingdayoff as $keyDayOff=>$valDayOff){
				$data_payrollemployeedayoff = array(
					'working_dayoff_detail_id'				=> $valDayOff['working_dayoff_detail_id'],
					'employee_id' 							=> $valDayOff['employee_id'],
					'dayoff_id'								=> $valDayOff['dayoff_id'],
					'employee_working_dayoff_description'	=> $valDayOff['employee_working_dayoff_description'],
					'working_dayoff_detail_date'			=> $valDayOff['working_dayoff_detail_date'],
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeedayoff['working_dayoff_detail_id']] = $data_payrollemployeedayoff;

				$this->session->set_userdata('addarrayemployeedayoff-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeedayoff = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeedayoff);
			}
			
			## PAYROLL EMPLOYEE MONTHLY DETAIL - OVERTIME REQUEST
			$this->session->unset_userdata('addarrayemployeeovertimerequest-'.$unique['unique']);

			foreach ($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$data_payrollemployeeovertimerequest = array(
					'overtime_request_id'			=> $valOvertime['overtime_request_id'],
					'employee_id' 					=> $valOvertime['employee_id'],
					'overtime_type_id'				=> $valOvertime['overtime_type_id'],
					'overtime_request_description'	=> $valOvertime['overtime_request_description'],
					'overtime_request_date'			=> $valOvertime['overtime_request_date'],
					'overtime_request_duration'		=> $valOvertime['overtime_request_duration'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeovertimerequest['overtime_request_id']] = $data_payrollemployeeovertimerequest;

				$this->session->set_userdata('addarrayemployeeovertimerequest-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeovertimerequest = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeeovertimerequest);
			}


			## PAYROLL EMPLOYEE MONTHLY DETAIL - LATE
			$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);

			$late_id = "";
			$hroemployeelate 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);
			
			foreach ($hroemployeelate as $keyLate=>$valLate){
				$data_payrollemployeelate = array(
					'employee_late_id'				=> $valLate['employee_late_id'],
					'employee_id' 					=> $valLate['employee_id'],
					'late_id'						=> $valLate['late_id'],
					'employee_late_description'		=> $valLate['employee_late_description'],
					'employee_late_date'			=> $valLate['employee_late_date'],
					'employee_late_duration'		=> $valLate['employee_late_duration'],
					'employee_monthly_period'		=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeelate['employee_late_id']] = $data_payrollemployeelate;

				$this->session->set_userdata('addarrayemployeelate-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeelate = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeelate);
			}


			## PAYROLL EMPLOYEE MONTHLY DETAIL - HOME EARLY
			$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);

			$home_early_id = "";
			$hroemployeehomeearly 		= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

			foreach ($hroemployeehomeearly as $keyHomeEarly=>$valHomeEarly){
				$data_payrollemployeehomeearlymonthly = array(
					'employee_home_early_monthly_id'			=> $valHomeEarly['employee_home_early_id'],
					'employee_id' 								=> $valHomeEarly['employee_id'],
					'home_early_id' 							=> $valHomeEarly['home_early_id'],
					'employee_home_early_monthly_description'	=> $valHomeEarly['employee_home_early_description'],
					'employee_home_early_monthly_date'			=> $valHomeEarly['employee_home_early_date'],
					'employee_home_early_monthly_hour'			=> $valHomeEarly['employee_home_early_hour'],
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeehomeearlymonthly['employee_home_early_monthly_id']] = $data_payrollemployeehomeearlymonthly;

				$this->session->set_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeehomeearlymonthly = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeehomeearlymonthly);
			}


			#ASSIGNMENT BUSINESS TRIP DETAIL
			$this->session->unset_userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique']);
			
			foreach ($assignmentbusinesstrip as $keyBusinessTrip => $valBusinessTrip){
				$data_payrollemployeemonthlyadisuryabusinesstrip = array(
					'business_trip_id'			=> $valBusinessTrip['business_trip_id'],
					'business_trip_date' 		=> $valBusinessTrip['business_trip_date'],
					'overtime_rate_id' 			=> $valBusinessTrip['overtime_rate_id'],
					'overtime_rate_description'	=> $valBusinessTrip['overtime_rate_description'],
					'business_trip_destination'	=> $valBusinessTrip['business_trip_destination'],
					'business_trip_amount'		=> $valBusinessTrip['business_trip_amount'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlyadisuryabusinesstrip['business_trip_id']] = $data_payrollemployeemonthlyadisuryabusinesstrip;

				$this->session->set_userdata('addarrayemployeemonthlybusinesstrip-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlyadisuryabusinesstrip = $this->session->userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthlyadisurya-'.$sesi['unique'],$data_payrollemployeemonthlyadisuryabusinesstrip);
			}

			/*exit;*/
			$data['main_view']['hroemployeedata']						= $this->payrollemployeemonthlyadisurya_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeemonthlyadisurya_data']		= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthly_Data($employee_id);
			
			$data['main_view']['payrollemployeepayment']				= $payrollemployeepayment;
			$data['main_view']['payrollmonthlyperiod']					= $payrollmonthlyperiod;
			$data['main_view']['payrollemployeemonthlyadisurya']				= $data_payrollemployeemonthlyadisurya;

			$data['main_view']['content']								= 'payrollemployeemonthlyadisurya/listaddpayrollemployeemonthlyadisurya_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddPayrollEmployeeMonthly(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'employee_id' 									=> $this->input->post('employee_id',true),
				'bank_id' 										=> $this->input->post('bank_id',true),
				'employee_monthly_period'						=> $this->input->post('employee_monthly_period',true),
				'employee_monthly_bank_acct_name'				=> $this->input->post('employee_monthly_bank_acct_name',true),
				'employee_monthly_bank_acct_no'					=> $this->input->post('employee_monthly_bank_acct_no',true),
				'employee_monthly_date'							=> tgltodb($this->input->post('employee_monthly_date',true)),
				'employee_monthly_start_date'					=> tgltodb($this->input->post('employee_monthly_start_date',true)),
				'employee_monthly_end_date'						=> tgltodb($this->input->post('employee_monthly_end_date',true)),
				'employee_monthly_basic_salary'					=> $this->input->post('employee_monthly_basic_salary',true),
				'employee_monthly_basic_overtime'				=> $this->input->post('employee_monthly_basic_overtime',true),
				'employee_monthly_working_days'					=> $this->input->post('employee_monthly_working_days',true),
				'employee_monthly_allowance_total'				=> $this->input->post('employee_monthly_allowance_total',true),
				'employee_monthly_deduction_total'				=> $this->input->post('employee_monthly_deduction_total',true),
				'employee_monthly_overtime_total'				=> $this->input->post('employee_monthly_overtime_total',true),
				'employee_monthly_early_total'					=> $this->input->post('employee_monthly_home_early_total',true),
				'employee_monthly_bpjs_amount'					=> $this->input->post('employee_monthly_bpjs_amount',true),
				'employee_monthly_length_service_month'			=> $this->input->post('employee_monthly_length_service_month',true),
				'employee_monthly_length_service_amount'		=> $this->input->post('employee_monthly_length_service_amount',true),
				'employee_monthly_premi_attendance_amount'		=> $this->input->post('employee_monthly_premi_attendance_amount',true),
				'employee_monthly_incentive_amount'				=> $this->input->post('employee_monthly_incentive_amount',true),
				'employee_monthly_allowance_other'				=> $this->input->post('employee_monthly_allowance_other',true),
				'employee_monthly_allowance_description'		=> $this->input->post('employee_monthly_allowance_description',true),
				'employee_monthly_deduction_other'				=> $this->input->post('employee_monthly_deduction_other',true),
				'employee_monthly_deduction_description'		=> $this->input->post('employee_monthly_deduction_description',true),
				'employee_monthly_loan_amount'					=> $this->input->post('employee_monthly_loan_amount',true),
				'employee_monthly_salary_total'					=> $this->input->post('employee_monthly_salary_total',true),
				'data_state'									=> 0,
				'created_id'									=> $auth['user_id'],
				'created_on'									=> date("Y-m-d H:i:s"),
			);

			$session_home_early			= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$session_overtime			= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
			$session_deduction			= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
			$session_allowance			= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);

			$session_leaverequest		= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);			
			$session_dayoff				= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);			
			$session_overtimerequest	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);	
			$session_homeearlymonthly	= $this->session->userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);	
			$session_permit				= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
			$session_absence			= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
			$session_late				= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);

			/*print_r("data ");
			print_r($data);
			print_r("<BR>");
			print_r("session_home_early ");
			print_r($session_home_early);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_overtime ");
			print_r($session_overtime);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_deduction ");
			print_r($session_deduction);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_allowance ");
			print_r($session_allowance);
			print_r("<BR>");
			print_r("<BR>");

			print_r("session_leaverequest ");
			print_r($session_leaverequest);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_dayoff ");
			print_r($session_dayoff);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_overtimerequest ");
			print_r($session_overtimerequest);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_homeearlymonthly ");
			print_r($session_homeearlymonthly);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_permit ");
			print_r($session_permit);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_absence ");
			print_r($session_absence);
			print_r("<BR>");
			print_r("<BR>");
			print_r("session_late ");
			print_r($session_late);
			print_r("<BR>");
			print_r("<BR>");
			exit;*/

			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthly($data)){
					$employee_monthly_id = $this->payrollemployeemonthlyadisurya_model->getEmployeeMonthlyID($data['created_on'], $data['created_id']);

					print_r("employee_monthly_id");
					print_r($employee_monthly_id);

					if(!empty($session_home_early)){
						foreach($session_home_early as $key=>$val){
							$data_home_early = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id'						=> $data['employee_id'],
								'employee_monthly_period'			=> $data['employee_monthly_period'],
								'deduction_id'						=> $val['deduction_id'],
								'employee_deduction_id'				=> $val['employee_deduction_id'],
								'employee_deduction_amount'			=> $val['employee_deduction_amount'],
								'employee_monthly_working_days'		=> $val['employee_monthly_working_days'],
								'employee_monthly_deduction_days'	=> $val['employee_monthly_deduction_days'],
								'employee_deduction_subtotal'		=> $val['employee_deduction_subtotal'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyEarly($data_home_early);
						}
					}

					if(!empty($session_overtime)){
						foreach($session_overtime as $key=>$val){
							$data_overtime = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id'						=> $data['employee_id'],
								'employee_monthly_period'			=> $data['employee_monthly_period'],
								'employee_basic_overtime'			=> $val['employee_basic_overtime'],
								'employee_overtime_monthly_total1'	=> $val['employee_overtime_monthly_total1'],
								'employee_overtime_monthly_total2'	=> $val['employee_overtime_monthly_total2'],
								'employee_overtime_dayoff_total1'	=> $val['employee_overtime_dayoff_total1'],
								'employee_overtime_dayoff_total2'	=> $val['employee_overtime_dayoff_total2'],
								'employee_overtime_amount_total'	=> $val['employee_overtime_amount_total'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyOvertime($data_overtime);
						}
					}

					if(!empty($session_deduction)){
						foreach($session_deduction as $key=>$val){
							$data_deduction = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id'						=> $data['employee_id'],
								'employee_monthly_period'			=> $data['employee_monthly_period'],
								'deduction_id'						=> $val['deduction_id'],
								'employee_deduction_id'				=> $val['employee_deduction_id'],
								'employee_deduction_amount'			=> $val['employee_deduction_amount'],
								'employee_monthly_working_days'		=> $val['employee_monthly_working_days'],
								'employee_monthly_deduction_days'	=> $val['employee_monthly_deduction_days'],
								'employee_deduction_subtotal'		=> $val['employee_deduction_subtotal'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyDeduction($data_deduction);
						}
					}

					if(!empty($session_allowance)){
						foreach($session_allowance as $key=>$val){
							$data_allowance = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id'						=> $data['employee_id'],
								'employee_monthly_period'			=> $data['employee_monthly_period'],
								'allowance_id'						=> $val['allowance_id'],
								'employee_allowance_id'				=> $val['employee_allowance_id'],
								'employee_allowance_amount'			=> $val['employee_allowance_amount'],
								'employee_monthly_working_days'		=> $val['employee_monthly_working_days'],
								'employee_monthly_allowance_days'	=> $val['employee_monthly_allowance_days'],
								'employee_allowance_subtotal'		=> $val['employee_allowance_subtotal'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyAllowance($data_allowance);
						}
					}

					if(!empty($session_leaverequest)){
						foreach($session_leaverequest as $key=>$val){
							$data_leaverequest = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id'						=> $data['employee_id'],
								'employee_monthly_period'			=> $data['employee_monthly_period'],
								'annual_leave_id'					=> $val['annual_leave_id'],
								'leave_request_detail_date'			=> $val['leave_request_detail_date'],
								'leave_request_description'			=> $val['leave_request_description'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyLeave($data_leaverequest);
						}
					}

					if(!empty($session_dayoff)){
						foreach($session_dayoff as $key=>$val){
							$data_dayoff = array(
								'employee_monthly_id'					=> $employee_monthly_id,
								'employee_id'							=> $data['employee_id'],
								'employee_monthly_period'				=> $data['employee_monthly_period'],
								'dayoff_id'								=> $val['dayoff_id'],
								'employee_working_dayoff_description'	=> $val['employee_working_dayoff_description'],
								'working_dayoff_detail_date'			=> $val['working_dayoff_detail_date'],
								'data_state'							=> 0,
								'created_id'							=> $data['created_id'],
								'created_on'							=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyDayOff($data_dayoff);
						}
					}	

					if(!empty($session_overtimerequest)){
						foreach($session_overtimerequest as $key=>$val){
							$data_overtimerequest = array(
								'employee_monthly_id'			=> $employee_monthly_id,
								'employee_id'					=> $data['employee_id'],
								'employee_monthly_period'		=> $data['employee_monthly_period'],
								'overtime_type_id'				=> $val['overtime_type_id'],
								'overtime_request_description'	=> $val['overtime_request_description'],
								'overtime_request_date'			=> $val['overtime_request_date'],
								'overtime_request_duration'		=> $val['overtime_request_duration'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyOvertimeRequest($data_overtimerequest);
						}
					}

					if(!empty($session_homeearlymonthly)){
						foreach($session_homeearlymonthly as $key=>$val){
							$data_homeearlymonthly = array(
								'employee_monthly_id'						=> $employee_monthly_id,
								'employee_id'								=> $data['employee_id'],
								'employee_monthly_period'					=> $data['employee_monthly_period'],
								'employee_home_early_monthly_description'	=> $val['employee_home_early_monthly_description'],
								'employee_home_early_monthly_date'			=> $val['employee_home_early_monthly_date'],
								'employee_home_early_monthly_hour'			=> $val['employee_home_early_monthly_hour'],
								'data_state'								=> 0,
								'created_id'								=> $data['created_id'],
								'created_on'								=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyHomeEarly($data_homeearlymonthly);
						}
					}

					if(!empty($session_permit)){
						foreach($session_permit as $key=>$val){
							$data_permit = array(
								'employee_monthly_id'			=> $employee_monthly_id,
								'employee_id'					=> $data['employee_id'],
								'employee_monthly_period'		=> $data['employee_monthly_period'],
								'permit_id'						=> $val['permit_id'],
								'permit_type'					=> $val['permit_type'],
								'deduction_type'				=> $val['deduction_type'],
								'employee_permit_description'	=> $val['employee_home_early_monthly_date'],
								'employee_permit_detail_date'	=> $val['employee_home_early_monthly_hour'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyPermit($data_permit);
						}
					}

					if(!empty($session_absence)){
						foreach($session_absence as $key=>$val){
							$data_absence = array(
								'employee_monthly_id'			=> $employee_monthly_id,
								'employee_id'					=> $data['employee_id'],
								'employee_monthly_period'		=> $data['employee_monthly_period'],
								'absence_id'					=> $val['absence_id'],
								'employee_absence_description'	=> $val['employee_absence_description'],
								'employee_absence_detail_date'	=> $val['employee_absence_detail_date'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyAbsence($data_absence);
						}
					}

					if(!empty($session_late)){
						foreach($session_late as $key=>$val){
							$data_late = array(
								'employee_monthly_id'			=> $employee_monthly_id,
								'employee_id'					=> $data['employee_id'],
								'employee_monthly_period'		=> $data['employee_monthly_period'],
								'late_id'						=> $val['late_id'],
								'employee_late_description'		=> $val['employee_late_description'],
								'employee_late_date'			=> $val['employee_late_date'],
								'data_state'					=> 0,
								'created_id'					=> $data['created_id'],
								'created_on'					=> $data['created_on']
							);
							$this->payrollemployeemonthlyadisurya_model->saveNewPayrollEmployeeMonthlyLate($data_late);
						}
					}

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeMonthly.processAddPayrollEmployeeMonthly',$auth['user_id'],'Add New Employee Monthly');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Employee Monthly Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeemonthlyadisurya');

					$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeovertime-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);

					$this->session->unset_userdata('addarrayemployeeleaverequest-'.$unique['unique']);			
					$this->session->unset_userdata('addarrayemployeedayoff-'.$unique['unique']);			
					$this->session->unset_userdata('addarrayemployeeovertimerequest-'.$unique['unique']);	
					$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);	
					$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);

					$this->session->unset_userdata('Addpayrollemployeemonthlyadisurya');
					redirect('payrollemployeemonthlyadisurya/addPayrollEmployeeMonthly/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Employee Monthly UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeemonthlyadisurya',$data);
					redirect('payrollemployeemonthlyadisurya/addPayrollEmployeeMonthly/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeemonthlyadisurya',$data);
				redirect('payrollemployeemonthlyadisurya/addPayrollEmployeeMonthly/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeMonthly_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_monthly_id  	= $this->uri->segment(4);

			if($this->payrollemployeemonthlyadisurya_model->deletePayrollEmployeeMonthly_Data($employee_monthly_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.payrollEmployeeMonthly.deletePayrollEmployeeMonthly_Data',$employee_monthly_id,'Delete Payroll Employee Monthly');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Employee Monthly Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeemonthlyadisurya/addPayrollEmployeeMonthly/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Employee Monthly UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeemonthlyadisurya/addPayrollEmployeeMonthly/'.$employee_id);
			}
		}

		public function detailPayrollEmployeeMonthly(){
			$employee_monthly_id											= $this->uri->segment(3);

			$data['main_view']['payrollemployeemonthlyadisurya']					= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthly_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryaabsence']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyAbsence_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryaallowance']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyAllowance_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryadayoff']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyDayOff_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryadeduction']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyDeduction_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryaearly']				= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyEarly_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryahomeearly']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyHomeEarly_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryalate']				= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyLate_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryaleave']				= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyLeave_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryaovertime']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyOvertime_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryaovertimerequest']	= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyOvertimeRequest_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyadisuryapermit']			= $this->payrollemployeemonthlyadisurya_model->getPayrollEmployeeMonthlyPermit_Detail($employee_monthly_id);

			$data['main_view']['content']								='payrollemployeemonthlyadisurya/formdetailpayrollemployeemonthlyadisurya_view';
			$this->load->view('mainpage_view',$data);
		} 
	}
?>