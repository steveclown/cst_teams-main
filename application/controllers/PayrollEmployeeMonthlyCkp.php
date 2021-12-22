<?php ob_start(); ?>
<?php
	set_time_limit(0);
	ini_set('memory_limit', '384M');

	require_once('TCPDF/config/tcpdf_config.php');
	require_once('TCPDF/tcpdf.php');
	/**
	 * Extend TCPDF to work with multiple columns
	 */
	class MC_TCPDF extends TCPDF {

	    /**
	     * Print chapter
	     * @param $num (int) chapter number
	     * @param $title (string) chapter title
	     * @param $file (string) name of the file containing the chapter body
	     * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
	     * @public
	     */
	    public function PrintChapter($num, $title, $file, $mode=false) {
	        // add a new page
	        $this->AddPage();
	        // disable existing columns
	        $this->resetColumns();
	        // print chapter title
	        /*$this->ChapterTitle($num, $title);*/
	        // set columns
	        $this->setEqualColumns(2, 150);
	        // print chapter body
	        $this->ChapterBody($file, $mode);
	    }

	    /**
	     * Set chapter title
	     * @param $num (int) chapter number
	     * @param $title (string) chapter title
	     * @public
	     */
	    public function ChapterTitle($num, $title) {
	        $this->SetFont('helvetica', '', 14);
	        $this->SetFillColor(200, 220, 255);
	        $this->Cell(180, 6, 'Chapter '.$num.' : '.$title, 0, 1, '', 1);
	        $this->Ln(4);
	    }

	    /**
	     * Print chapter body
	     * @param $file (string) name of the file containing the chapter body
	     * @param $mode (boolean) if true the chapter body is in HTML, otherwise in simple text.
	     * @public
	     */
	    public function ChapterBody($file, $mode=false) {
	        $this->selectColumn();
	        // get esternal file content
	        /*$content = file_get_contents($file, false);*/
	        $content = $file;

	        // set font
	        $this->SetFont('helvetica', '', 8);
	        /*$this->SetTextColor(50, 50, 50);*/
	        // print content
	        if ($mode) {
	            // ------ HTML MODE ------
	            $this->writeHTML($content, true, false, false, false, ' ');
	        } else {
	            // ------ TEXT MODE ------
	            $this->Write(0, $content, '', 0, 'J', true, 0, false, true, 0);
	        }
	        /*$this->Ln();*/
	    }
	}

	Class PayrollEmployeeMonthlyCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('PayrollEmployeeMonthlyCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeemonthly');
			if(!is_array($sesi)){
				$sesi['employee_shift_id']			= '';
				$sesi['employee_monthly_period']	= '';
			}

			$data['Main_view']['scheduleemployeeshift']		= create_double($this->PayrollEmployeeMonthlyCkp_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['Main_view']['payrollmonthlyperiod']		= create_double($this->PayrollEmployeeMonthlyCkp_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['Main_view']['payrollemployeemonthly']	= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthly($region_id, $branch_id, $location_id, $sesi['employee_shift_id'], $sesi['employee_monthly_period']);

			$data['Main_view']['content']					= 'PayrollEmployeeMonthlyCkp/listPayrollEmployeeMonthlyCkp_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_shift_id'			=> $this->input->post('employee_shift_id',true),	
				'employee_monthly_period'	=> $this->input->post('employee_monthly_period',true),
			);
			$this->session->set_userdata('filter-payrollemployeemonthly',$data);
			redirect('PayrollEmployeeMonthlyCkp');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeemonthly-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollemployeemonthly-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollemployeemonthly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollemployeemonthly-'.$unique['unique'],$sessions);
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeemonthly');
			$this->session->unset_userdata('filter-payrollemployeemonthly');
			redirect('PayrollEmployeeMonthlyCkp');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeemonthly-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayemployeeallowance-'.$sesi['unique']);
			redirect('PayrollEmployeeMonthlyCkp');
		}
		
		public function addPayrollEmployeeMonthly(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$data['Main_view']['scheduleemployeeshift']		= create_double($this->PayrollEmployeeMonthlyCkp_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['Main_view']['payrollmonthlyperiod']		= create_double($this->PayrollEmployeeMonthlyCkp_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['Main_view']['content']					= 'PayrollEmployeeMonthlyCkp/formaddPayrollEmployeeMonthlyCkp_view';
			$this->load->view('MainPage_view',$data);
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

		public function processCalculatePayrollEmployeeMonthly(){
			$auth 								= $this->session->userdata('auth');
			$unique 							= $this->session->userdata('unique');
			$region_id 							= $auth['region_id'];
			$branch_id 							= $auth['branch_id'];
			$location_id 						= $auth['location_id'];
			$employee_shift_id					= $this->input->post('employee_shift_id',true);
			$employee_monthly_period 			= $this->input->post('employee_monthly_period',true);

			$hroemployeeattendancetotal			= $this->PayrollEmployeeMonthlyCkp_model->getHROEmployeeAttendanceTotal_Monthly($region_id, $branch_id, $location_id, $employee_shift_id, $employee_monthly_period);

			/*print_r("hroemployeeattendancetotal ");
			print_r($hroemployeeattendancetotal);
			print_r("<BR>");
			print_r("employee_shift_id ");
			print_r($employee_shift_id);
			print_r("<BR>");
			exit;*/

			$preferencecompany					= $this->PayrollEmployeeMonthlyCkp_model->getPreferenceCompany();

			$job_title_id_payroll 				= $preferencecompany['job_title_id_payroll'];

			$basic_salary_deduction				= $preferencecompany['basic_salary_deduction'];		

			$job_title_id_driver				= $preferencecompany['job_title_id_driver'];		

			$employee_delivery_amount_driver	= $preferencecompany['employee_delivery_amount_driver'];		

			$job_title_id_pu					= $preferencecompany['job_title_id_pu'];		

			$employee_delivery_amount_pu		= $preferencecompany['employee_delivery_amount_pu'];		

			$employee_meal_coupon_subvention	= $preferencecompany['employee_meal_coupon_subvention'];

			$payrollemployeemonthly 			= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthly_Attendance($employee_shift_id, $employee_monthly_period);

			/*print_r("payrollemployeemonthly ");
			print_r($payrollemployeemonthly);
			print_r("<BR> ");

			exit;*/

			/*print_r("branch_id ");
			print_r($branch_id);
			print_r("<BR> ");	*/		

			$this->session->unset_userdata('addarraypayrollemployeemonthlyitem-'.$unique['unique']);

			$this->session->unset_userdata('addarraypayrollemployeemonthlyadditionaldeduction-'.$unique['unique']);

			$this->session->unset_userdata('addarraypayrollemployeemonthlydelivery-'.$unique['unique']);

			$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);

			/*print_r("region_id ");
			print_r($region_id);
			print_r("<BR> ");

			print_r("branch_id ");
			print_r($branch_id);
			print_r("<BR> ");

			print_r("location_id ");
			print_r($location_id);
			print_r("<BR> ");

			print_r("employee_shift_id ");
			print_r($employee_shift_id);
			print_r("<BR> ");

			print_r("employee_monthly_period ");
			print_r($employee_monthly_period);
			print_r("<BR> ");

			print_r("hroemployeeattendancetotal ");
			print_r($hroemployeeattendancetotal);
			print_r("<BR> ");
			print_r("<BR> ");
			print_r("<BR> ");
			exit;*/

			if (empty($payrollemployeemonthly)){
				foreach ($hroemployeeattendancetotal as $key => $val) {
					$job_title_id 						= $val['job_title_id'];
					$employee_hire_date 				= $val['employee_hire_date'];
					$employee_employment_status 		= $val['employee_employment_status'];
					$employee_monthly_start_date 		= $val['employee_monthly_start_date'];
					$employee_monthly_end_date	 		= $val['employee_monthly_end_date'];

					$year_period 						= substr($val['employee_monthly_period'], 0, 4);

					$date1 								= new DateTime($employee_hire_date);
					$date2 								= new DateTime($employee_monthly_start_date);

					$diff 								= $date1->diff($date2);

					$employee_months 					= (($diff->format('%y') * 12) + $diff->format('%m')) + ($diff->format('%d') / 30);

					$payrollperiodpayment				= $this->PayrollEmployeeMonthlyCkp_model->getPayrollPeriodPayment($employee_months, $employee_employment_status);

					$payrollperiodattendance			= $this->PayrollEmployeeMonthlyCkp_model->getPayrollPeriodAttendance($employee_months, $employee_employment_status);

					$payrollperiodallowance				= $this->PayrollEmployeeMonthlyCkp_model->getPayrollPeriodAllowance($employee_months, $employee_employment_status);

					$payrollemployeeallowance			= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeAllowance($val['employee_id'], $year_period);

					$payrollperiodservice				= $this->PayrollEmployeeMonthlyCkp_model->getPayrollPeriodService($employee_months, $employee_employment_status);

					$payrollemployeebpjs				= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeBPJS($val['employee_id'], $year_period);

					$payrollemployeedelivery 			= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeDelivery($val['employee_id'], $employee_monthly_start_date, $employee_monthly_end_date);

					$payrollemployeeadditionaldeduction	= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeAdditionalDeduction($val['employee_id'], $employee_monthly_start_date, $employee_monthly_end_date);

					$payrollemployeeadditionalovertime	= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeAdditionalOvertime($val['employee_id'], $employee_monthly_start_date, $employee_monthly_end_date);

					$hroemployeemealcoupon				= $this->PayrollEmployeeMonthlyCkp_model->getHROEmployeeMealCoupon($val['employee_id'], $employee_monthly_start_date, $employee_monthly_end_date);

					/*if ($val['employee_id'] == 10674){
						print_r("hroemployeemealcoupon ");
						print_r($hroemployeemealcoupon);
						exit;
					}*/


					/*CALCULATE WORKING DAYS*/
					$employee_monthly_working_days 	= $val['total_working_payroll_days'] - $val['total_permit_with_doctor_payroll_days'] - $val['total_permit_no_doctor_payroll_days'] - $val['total_absence_payroll_days'] + $val['total_cancel_off_payrol_days'] + $val['total_swap_off_payroll_days'] + $val['total_early_payroll_less_1_days'];

					$employee_monthly_no_working_days	= $val['total_permit_with_doctor_payroll_days'] + $val['total_permit_no_doctor_payroll_days'] + $val['total_absence_payroll_days'] + $val['total_early_payroll_less_1_days'];

					$basic_salary_daily 				= $payrollperiodpayment['basic_salary_daily'];

					if (is_null($basic_salary_daily)){
						$basic_salary_daily = 0;
					}

					if ($job_title_id == $job_title_id_payroll){
						$basic_salary_daily = $basic_salary_daily - $preferencecompany['basic_salary_deduction'];
					}

					$basic_salary_hourly 				= $basic_salary_daily / $preferencecompany['working_days_default'];			
					
					/*CALCULATE BASIC SALARY*/
					$employee_monthly_basic_salary 		= $employee_monthly_working_days * $basic_salary_daily;

					/*CALCULATE ALLOWANCE PER EMPLOYEE*/
					$employee_monthly_allowance_amount = 0;
					if (!empty($payrollemployeeallowance)){
						foreach ($payrollemployeeallowance as $keyAllowance => $valAllowance){
							$employee_allowance_amount 	= $valAllowance['employee_allowance_amount'];
							$allowance_type 			= $valAllowance['allowance_type'];

							switch ($allowance_type) {
							    case 0:
							        $employee_monthly_allowance_days = 1;
									$employee_allowance_subtotal = $employee_allowance_amount;
							        break;
							    case 1:
							    	$employee_monthly_allowance_days = 1;
									$employee_allowance_subtotal = $employee_monthly_working_days * $employee_allowance_amount;
							        break;
							}

							$employee_monthly_allowance_amount = $employee_monthly_allowance_amount + $employee_allowance_subtotal;

							$payroll_monthly_allowance_total = $payroll_monthly_allowance_total + $employee_allowance_subtotal;

							$data_payrollemployeeallowance = array(
								'employee_monthly_allowance_id'		=> date("YmdHis").$valAllowance['employee_allowance_id'],
								'employee_id' 						=> $valAllowance['employee_id'],
								'allowance_id' 						=> $valAllowance['allowance_id'],
								'employee_allowance_id'				=> $valAllowance['employee_allowance_id'],
								'employee_monthly_period'			=> $employee_monthly_period,
								'employee_allowance_amount'			=> $valAllowance['employee_allowance_amount'],
								'employee_monthly_working_days'		=> $employee_monthly_working_days,
								'employee_monthly_allowance_days'	=> $employee_monthly_allowance_days,
								'employee_allowance_subtotal'		=> $employee_allowance_subtotal,
							);

							$unique 			= $this->session->userdata('unique');
							$dataArrayHeader	= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);
							$dataArrayHeader[$data_payrollemployeeallowance['employee_monthly_allowance_id']] = $data_payrollemployeeallowance;
							$this->session->set_userdata('addarrayemployeeallowance-'.$unique['unique'],$dataArrayHeader);
						}
					}

					/*CALCULATE ATTENDANCE*/
					$employee_monthly_attendance_amount = 0;
					if (!empty($payrollperiodattendance)){
						if ($employee_monthly_working_days == $val['total_working_days']){
							$employee_monthly_attendance_amount = $employee_monthly_working_days * $payrollperiodattendance['period_attendance_amount_daily'];
						} else if ($employee_monthly_no_working_days == 1){
							$employee_monthly_attendance_amount = $employee_monthly_working_days * $payrollperiodattendance['period_attendance_amount_daily1'];
						} else if ($employee_monthly_no_working_days == 2){
							$employee_monthly_attendance_amount = 0;
						}
					}

					/*CALCULATE LENGTH SERVICE*/
					$employee_monthly_service_amount = 0;
					if (!empty($payrollperiodservice)){
						$employee_monthly_service_amount = $employee_monthly_working_days * $payrollperiodservice['period_service_amount_daily'];
					}

					/*CALCULATE BPJS*/
					$employee_monthly_bpjs_amount = 0;
					if (!empty($payrollemployeebpjs)){
						$employee_monthly_bpjs_amount = $payrollemployeebpjs['bpjs_total_amount'];
					}


					/*CALCULATE HOME EARLY*/
					$total_early_hours_list = $val['total_early_hours_list'];
					$early_hours_array 		= explode('#', $total_early_hours_list);
					$early_hours_count 		= count($early_hours_array);

					$employee_monthly_early_amount = 0;
					for($i = 0; $i < $early_hours_count; $i++){
						$home_early_hour 				= $early_hours_array[$i];
						$home_early_amount 				= $home_early_hour * $basic_salary_hourly;
						$employee_monthly_early_amount 	= $employee_monthly_early_amount + $home_early_amount;
					}

					/*CALCULATE OVERTIME*/
					$total_overtime_hours_list 	= $val['total_overtime_hours_list'];
					$overtime_hours_array	 		= explode('#', $total_overtime_hours_list);
					$overtime_hours_count 			= count($early_hours_array);

					$employee_monthly_overtime_amount = 0;
					for($i = 0; $i < $overtime_hours_count; $i++){
						$overtime_hour 					= $overtime_hours_array[$i];
						$overtime_array 				= explode("%", $overtime_hour);

						if ($overtime_array[1] == 1){
							$overtime_amount 				= $overtime_array[0] * $basic_salary_hourly * 2;	
						} else {
							$overtime_amount 				= $overtime_array[0] * $basic_salary_hourly;
						}
						
						$employee_monthly_overtime_amount 	= $employee_monthly_overtime_amount + $overtime_amount;
					}


					/*CALCULATE DELIVERY*/
					$employee_monthly_delivery_amount = 0;
					if (!empty($payrollemployeedelivery)){
						/*print_r("payrollemployeedelivery ");
						print_r($payrollemployeedelivery);
						print_r("<BR> ");
						print_r("<BR> ");*/

						foreach ($payrollemployeedelivery as $keyDelivery => $valDelivery){
							$employee_monthly_delivery_subtotal = 0;

							if ($valDelivery['employee_delivery_status'] == 0){
								/*Tidak Menginap*/

								if ($valDelivery['job_title_id'] == $job_title_id_driver){
									$employee_monthly_delivery_subtotal	= ($basic_salary_daily + $employee_delivery_amount_driver) / 2;
								} else if ($valDelivery['job_title_id'] == $job_title_id_pu) {
									$employee_monthly_delivery_subtotal	= ($basic_salary_daily + $employee_delivery_amount_pu) / 2;
								}
							} else {
								if ($valDelivery['job_title_id'] == $job_title_id_driver){
									$employee_monthly_delivery_subtotal	= ($basic_salary_daily * $valDelivery['employee_delivery_days']) + $employee_delivery_amount_driver;
								} else if ($valDelivery['job_title_id'] == $job_title_id_pu) {
									$employee_monthly_delivery_subtotal	= ($basic_salary_daily * $valDelivery['employee_delivery_days']) + $employee_delivery_amount_pu;
								}
							}

							/*print_r("employee_delivery_status ");
							print_r($valDelivery['employee_delivery_status']);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("job_title_id ");
							print_r($valDelivery['job_title_id']);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("job_title_id_driver ");
							print_r($job_title_id_driver);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("employee_delivery_amount_driver ");
							print_r($employee_delivery_amount_driver);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("employee_monthly_delivery_subtotal ");
							print_r($employee_monthly_delivery_subtotal);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("job_title_id_pu ");
							print_r($job_title_id_pu);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("employee_delivery_amount_pu ");
							print_r($employee_delivery_amount_pu);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("employee_delivery_days ");
							print_r($valDelivery['employee_delivery_days']);
							print_r("<BR> ");
							print_r("<BR> ");

							print_r("basic_salary_daily ");
							print_r($basic_salary_daily);
							print_r("<BR> ");
							print_r("<BR> ");*/

							$employee_monthly_delivery_amount = $employee_monthly_delivery_amount + $employee_monthly_delivery_subtotal;

							$data_payrollemployeedelivery = array(
								'employee_monthly_delivery_id'			=> date("YmdHis").$valDelivery['employee_delivery_id'],
								'employee_id' 							=> $val['employee_id'],
								'job_title_id' 							=> $valDelivery['job_title_id'],
								'employee_monthly_period'				=> $employee_monthly_period,
								'employee_monthly_delivery_date' 		=> $valDelivery['employee_delivery_date'],
								'employee_monthly_delivery_days' 		=> $valDelivery['employee_delivery_days'],
								'employee_monthly_delivery_status'		=> $valDelivery['employee_delivery_status'],
								'employee_monthly_basic_salary_daily'	=> $basic_salary_daily,
								'employee_monthly_delivery_subtotal'	=> $employee_monthly_delivery_subtotal,
							);

							$unique 			= $this->session->userdata('unique');
							$dataArrayHeader	= $this->session->userdata('addarraypayrollemployeemonthlydelivery-'.$unique['unique']);
							$dataArrayHeader[$data_payrollemployeedelivery['employee_monthly_delivery_id']] = $data_payrollemployeedelivery;
							$this->session->set_userdata('addarraypayrollemployeemonthlydelivery-'.$unique['unique'], $dataArrayHeader);
						}
					}

					/*if ($val['employee_id'] == 10674){
						$data_payrollemployeedelivery	= $this->session->userdata('addarraypayrollemployeemonthlydelivery-'.$unique['unique']);

						print_r("payrollemployeedelivery ");
						print_r($payrollemployeedelivery);
						print_r("<BR> ");
						print_r("<BR> ");

						print_r("data_payrollemployeedelivery ");
						print_r($data_payrollemployeedelivery);
						print_r("<BR> ");
						print_r("<BR> ");
						exit;
					}*/
					
					/*CALCULATE ADDITIONAL DEDUCTION*/
					$employee_monthly_additional_deduction_amount = 0;
					if (!empty($payrollemployeeadditionaldeduction)){
						foreach ($payrollemployeeadditionaldeduction as $keyAdditionalDeduction => $valAdditionalDeduction){
							$employee_monthly_additional_deduction_amount = $$employee_monthly_additional_deduction_amount + $valAdditionalDeduction['employee_additional_deduction_amount'];

							$data_payrollemployeeadditionaldeduction = array(
								'employee_monthly_additional_deduction_id'			=> date("YmdHis").$val['employee_additional_deduction_id'],
								'employee_id' 										=> $val['employee_id'],
								'deduction_id' 										=> $valAdditionalDeduction['deduction_id'],
								'employee_monthly_period'							=> $employee_monthly_period,
								'employee_monthly_additional_deduction_date' 		=> $valAdditionalDeduction['employee_additional_deduction_date'],
								'employee_monthly_additional_deduction_description' => $valAdditionalDeduction['employee_additional_deduction_description'],
								'employee_monthly_additional_deduction_subtotal'	=> $valAdditionalDeduction['employee_additional_deduction_amount'],
							);

							$unique 			= $this->session->userdata('unique');
							$dataArrayHeader	= $this->session->userdata('addarraypayrollemployeemonthlyadditionaldeduction-'.$unique['unique']);
							$dataArrayHeader[$data_payrollemployeeadditionaldeduction['employee_monthly_additional_deduction_id']] = $data_payrollemployeeadditionaldeduction;
							$this->session->set_userdata('addarraypayrollemployeemonthlyadditionaldeduction-'.$unique['unique'], $dataArrayHeader);
						}
					}


					/*CALCULATE ADDITIONAL OVERTIME*/
					$employee_monthly_additional_overtime_amount = 0;
					if (!empty($payrollemployeeadditionalovertime)){
						foreach ($payrollemployeeadditionalovertime as $keyAdditionalOvertime => $valAdditionalOvertime){
							$employee_monthly_additional_overtime_amount = $$employee_monthly_additional_overtime_amount + $valAdditionalOvertime['employee_additional_overtime_amount'];

							$data_payrollemployeeadditionalovertime = array(
								'employee_monthly_additional_overtime_id'			=> date("YmdHis").$val['employee_additional_overtime_id'],
								'employee_id' 										=> $val['employee_id'],
								'overtime_type_id'									=> $valAdditionalOvertime['overtime_type_id'],
								'employee_monthly_period'							=> $employee_monthly_period,
								'employee_monthly_additional_overtime_date' 		=> $valAdditionalOvertime['employee_additional_overtime_date'],
								'employee_monthly_additional_overtime_description' => $valAdditionalOvertime['employee_additional_overtime_description'],
								'employee_monthly_additional_overtime_subtotal'		=> $valAdditionalOvertime['employee_additional_overtime_amount'],
							);

							$unique 			= $this->session->userdata('unique');
							$dataArrayHeader	= $this->session->userdata('addarraypayrollemployeemonthlyadditionalovertime-'.$unique['unique']);
							$dataArrayHeader[$data_payrollemployeeadditionalovertime['employee_monthly_additional_overtime_id']] = $data_payrollemployeeadditionalovertime;
							$this->session->set_userdata('addarraypayrollemployeemonthlyadditionalovertime-'.$unique['unique'], $dataArrayHeader);
						}
					}

					/*CALCULATE MEAL COUPON*/
					$employee_monthly_meal_coupon_amount 	= $hroemployeemealcoupon['total_meal_coupon'] * $employee_meal_coupon_subvention;

					$employee_monthly_salary_subtotal		= $employee_monthly_basic_salary + $employee_monthly_allowance_amount + $employee_monthly_attendance_amount + $employee_monthly_service_amount + $employee_monthly_early_amount + $employee_monthly_overtime_amount + $employee_monthly_delivery_amount + $employee_monthly_meal_coupon_amount;

					$employee_monthly_salary_total 			= $employee_monthly_basic_salary + $employee_monthly_allowance_amount + $employee_monthly_attendance_amount + $employee_monthly_service_amount + $employee_monthly_early_amount + $employee_monthly_overtime_amount - $employee_monthly_bpjs_amount + $employee_monthly_delivery_amount - $employee_monthly_additional_deduction_amount + $employee_monthly_additional_overtime_amount + $employee_monthly_meal_coupon_amount;

					$data_payrollemployeemonthlyitem = array (
						'employee_id'									=> $val['employee_id'],
						'division_id'									=> $val['division_id'],
						'department_id'									=> $val['department_id'],
						'section_id'									=> $val['section_id'],
						'unit_id'										=> $val['unit_id'],
						'job_title_id'									=> $val['job_title_id'],
						'bank_id'										=> $val['bank_id'],
						'employee_monthly_period'						=> $employee_monthly_period,
						'employee_monthly_start_date'					=> $val['employee_monthly_start_date'],
						'employee_monthly_end_date'						=> $val['employee_monthly_end_date'],
						'employee_employment_status'					=> $val['employee_employment_status'],
						'employee_hire_date'							=> $val['employee_hire_date'],
						'employee_working_months'						=> $val['employee_working_months'],
						'employee_monthly_bank_acct_no'					=> $val['employee_bank_acct_no'],
						'employee_monthly_bank_acct_name'				=> $val['employee_bank_acct_name'],
						'employee_monthly_total_working_days'			=> $val['total_working_days'],
						'employee_basic_salary'							=> $basic_salary_daily,
						'employee_monthly_basic_salary'					=> $employee_monthly_basic_salary,
						'employee_monthly_working_days'					=> $employee_monthly_working_days,
						'employee_monthly_allowance_amount'				=> $employee_monthly_allowance_amount,
						'employee_monthly_attendance_amount'			=> $employee_monthly_attendance_amount,
						'employee_monthly_service_amount'				=> $employee_monthly_service_amount,
						'employee_monthly_bpjs_amount'					=> $employee_monthly_bpjs_amount,
						'employee_monthly_early_amount'					=> $employee_monthly_early_amount,
						'employee_monthly_overtime_amount'				=> $employee_monthly_overtime_amount,
						'employee_monthly_total_meal_coupon'			=> $hroemployeemealcoupon['total_meal_coupon'],
						'employee_monthly_meal_coupon_amount'			=> $employee_monthly_meal_coupon_amount,
						'employee_monthly_delivery_amount'				=> $employee_monthly_delivery_amount,
						'employee_monthly_additional_deduction_amount'	=> $employee_monthly_additional_deduction_amount,
						'employee_monthly_additional_overtime_amount'	=> $employee_monthly_additional_overtime_amount,
						'employee_monthly_salary_subtotal'				=> $employee_monthly_salary_subtotal,
						'employee_monthly_salary_total'					=> $employee_monthly_salary_total,
					);

					/*if ($val['employee_id'] == 9548){
						print_r("data_payrollemployeemonthlyitem ");
						print_r($data_payrollemployeemonthlyitem);
						print_r("<BR> ");

						print_r("employee_monthly_working_days ");
						print_r($employee_monthly_working_days);
						print_r("<BR> ");

						print_r("basic_salary_daily ");
						print_r($basic_salary_daily);
						print_r("<BR> ");

						exit;
					}*/

					$dataArrayHeader	= $this->session->userdata('addarraypayrollemployeemonthlyitem-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeemonthlyitem['employee_id']] = $data_payrollemployeemonthlyitem;

					$this->session->set_userdata('addarraypayrollemployeemonthlyitem-'.$unique['unique'],$dataArrayHeader);

					/*print_r("payrollmonthlyperiod ");
					print_r($payrollmonthlyperiod);
					print_r("<BR> ");

					print_r("year_period ");
					print_r($year_period);
					print_r("<BR> ");

					print_r("employee_id ");
					print_r($val['employee_id']);
					print_r("<BR> ");

					print_r("payrollperiodpayment ");
					print_r($payrollperiodpayment);
					print_r("<BR> ");

					print_r("payrollperiodattendance ");
					print_r($payrollperiodattendance);
					print_r("<BR> ");

					print_r("payrollperiodallowance ");
					print_r($payrollperiodallowance);
					print_r("<BR> ");

					print_r("payrollemployeeallowance ");
					print_r($payrollemployeeallowance);
					print_r("<BR> ");

					print_r("payrollemployeebpjs ");
					print_r($payrollemployeebpjs);
					print_r("<BR> ");

					print_r("data_payrollemployeemonthlyitem ");
					print_r($data_payrollemployeemonthlyitem);
					print_r("<BR> ");
					exit;*/
				}
			} else {
				$msg = "<div class='alert alert-danger'>                
							Process Payroll Employee Monthly Fail - Data Already Exist
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('PayrollEmployeeMonthlyCkp/addPayrollEmployeeMonthly/');
			}

			$data['Main_view']['scheduleemployeeshift']		= create_double($this->PayrollEmployeeMonthlyCkp_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['Main_view']['payrollmonthlyperiod']		= create_double($this->PayrollEmployeeMonthlyCkp_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['Main_view']['content']					= 'PayrollEmployeeMonthlyCkp/formaddPayrollEmployeeMonthlyCkp_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddPayrollEmployeeMonthly(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$session_payrollemployeemonthly						= $this->session->userdata('addarraypayrollemployeemonthlyitem-'.$unique['unique']);

			$session_payrollemployeemonthlydelivery				= $this->session->userdata('addarraypayrollemployeemonthlydelivery-'.$unique['unique']);

			$session_payrollemployeemonthlyadditionaldeduction	= $this->session->userdata('addarraypayrollemployeemonthlyadditionaldeduction-'.$unique['unique']);

			$session_payrollemployeemonthlyadditionalovertime	= $this->session->userdata('addarraypayrollemployeemonthlyadditionalovertime-'.$unique['unique']);

			$session_payrollemployeemonthlyallowance			= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);

			foreach ($session_payrollemployeemonthly as $key => $val) {
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
				if($this->PayrollEmployeeMonthlyCkp_model->insertPayrollEmployeeMonthly($data)){
					$employee_monthly_id = $this->PayrollEmployeeMonthlyCkp_model->getEmployeeMonthlyID($data['created_id']);

					if(!empty($session_payrollemployeemonthly)){
						foreach($session_payrollemployeemonthly as $key=>$val){
							$data_payrollemployeemonthlyitem = array(
								'employee_monthly_id'							=> $employee_monthly_id,
								'region_id' 									=> $auth['region_id'],
								'branch_id' 									=> $auth['branch_id'],
								'location_id'									=> $auth['location_id'],
								'employee_id'									=> $val['employee_id'],
								'division_id'									=> $val['division_id'],
								'department_id'									=> $val['department_id'],
								'section_id'									=> $val['section_id'],
								'unit_id'										=> $val['unit_id'],
								'job_title_id'									=> $val['job_title_id'],
								'bank_id'										=> $val['bank_id'],
								'employee_monthly_period'						=> $val['employee_monthly_period'],
								'employee_monthly_start_date'					=> $val['employee_monthly_start_date'],
								'employee_monthly_end_date'						=> $val['employee_monthly_end_date'],
								'employee_employment_status'					=> $val['employee_employment_status'],
								'employee_hire_date'							=> $val['employee_hire_date'],
								'employee_working_months'						=> $val['employee_working_months'],
								'employee_monthly_bank_acct_no'					=> $val['employee_monthly_bank_acct_no'],
								'employee_monthly_bank_acct_name'				=> $val['employee_monthly_bank_acct_name'],
								'employee_monthly_total_working_days'			=> $val['employee_monthly_total_working_days'],
								'employee_basic_salary'							=> $val['employee_basic_salary'],
								'employee_monthly_basic_salary'					=> $val['employee_monthly_basic_salary'],
								'employee_monthly_working_days'					=> $val['employee_monthly_working_days'],
								'employee_monthly_allowance_amount'				=> $val['employee_monthly_allowance_amount'],
								'employee_monthly_attendance_amount'			=> $val['employee_monthly_attendance_amount'],
								'employee_monthly_service_amount'				=> $val['employee_monthly_service_amount'],
								'employee_monthly_bpjs_amount'					=> $val['employee_monthly_bpjs_amount'],
								'employee_monthly_early_amount'					=> $val['employee_monthly_early_amount'],
								'employee_monthly_overtime_amount'				=> $val['employee_monthly_overtime_amount'],
								'employee_monthly_delivery_amount'				=> $val['employee_monthly_delivery_amount'],
								'employee_monthly_total_meal_coupon'			=> $val['employee_monthly_total_meal_coupon'],
								'employee_monthly_meal_coupon_amount'			=> $val['employee_monthly_meal_coupon_amount'],
								'employee_monthly_additional_deduction_amount'	=> $val['employee_monthly_additional_deduction_amount'],
								'employee_monthly_additional_overtime_amount'	=> $val['employee_monthly_additional_overtime_amount'],
								'employee_monthly_salary_subtotal'				=> $val['employee_monthly_salary_subtotal'],
								'employee_monthly_salary_total'					=> $val['employee_monthly_salary_total'],
								'data_state'									=> 0,
								'created_id'									=> $auth['user_id'],
								'created_on'									=> date("Y-m-d H:i:s"),
							);
							$this->PayrollEmployeeMonthlyCkp_model->insertPayrollEmployeeMonthlyItem($data_payrollemployeemonthlyitem);
						}
					}


					if(!empty($session_payrollemployeemonthlydelivery)){
						foreach($session_payrollemployeemonthlydelivery as $key => $val){
							$data_payrollemployeedelivery = array(
								'employee_monthly_id'					=> $employee_monthly_id,
								'employee_id' 							=> $val['employee_id'],
								'job_title_id' 							=> $val['job_title_id'],
								'employee_monthly_period'				=> $val['employee_monthly_period'],
								'employee_monthly_delivery_date' 		=> $val['employee_monthly_delivery_date'],
								'employee_monthly_delivery_days' 		=> $val['employee_monthly_delivery_days'],
								'employee_monthly_delivery_status'		=> $val['employee_monthly_delivery_status'],
								'employee_monthly_basic_salary_daily'	=> $val['employee_monthly_basic_salary_daily'],
								'employee_monthly_delivery_subtotal'	=> $val['employee_monthly_delivery_subtotal'],
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s"),
							);
							$this->PayrollEmployeeMonthlyCkp_model->insertPayrollEmployeeMonthlyDelivery($data_payrollemployeedelivery);
						}
					}

					if(!empty($session_payrollemployeemonthlyadditionaldeduction)){
						foreach($session_payrollemployeemonthlyadditionaldeduction as $key => $val){
							$data_payrollemployeeadditionaldeduction = array(
								'employee_monthly_id'								=> $employee_monthly_id,
								'employee_id' 										=> $val['employee_id'],
								'deduction_id' 										=> $val['deduction_id'],
								'employee_monthly_period'							=> $val['employee_monthly_period'],
								'employee_monthly_additional_deduction_date' 		=> $val['employee_monthly_additional_deduction_date'],
								'employee_monthly_additional_deduction_description' => $val['employee_monthly_additional_deduction_description'],
								'employee_monthly_additional_deduction_subtotal'	=> $val['employee_monthly_additional_deduction_subtotal'],
								'data_state'										=> 0,
								'created_id'										=> $auth['user_id'],
								'created_on'										=> date("Y-m-d H:i:s"),
							);
							$this->PayrollEmployeeMonthlyCkp_model->insertPayrollEmployeeMonthlyAdditionalDeduction($data_payrollemployeeadditionaldeduction);
						}
					}

					if(!empty($session_payrollemployeemonthlyadditionalovertime)){
						foreach($session_payrollemployeemonthlyadditionalovertime as $key => $val){
							$data_payrollemployeeadditionalovertime = array(
								'employee_monthly_id'								=> $employee_monthly_id,
								'employee_id' 										=> $val['employee_id'],
								'overtime_type_id'									=> $val['overtime_type_id'],
								'employee_monthly_period'							=> $val['employee_monthly_period'],
								'employee_monthly_additional_overtime_date' 		=> $val['employee_monthly_additional_overtime_date'],
								'employee_monthly_additional_overtime_description' => $val['employee_monthly_additional_overtime_description'],
								'employee_monthly_additional_overtime_subtotal'	=> $val['employee_monthly_additional_overtime_subtotal'],
								'data_state'										=> 0,
								'created_id'										=> $auth['user_id'],
								'created_on'										=> date("Y-m-d H:i:s"),
							);
							$this->PayrollEmployeeMonthlyCkp_model->insertPayrollEmployeeMonthlyAdditionalOvertime($data_payrollemployeeadditionalovertime);
						}
					}


					if(!empty($session_payrollemployeemonthlyallowance)){
						foreach($session_payrollemployeemonthlyallowance as $key => $val){
							$data_payrollemployeeallowance = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id' 						=> $val['employee_id'],
								'allowance_id' 						=> $val['allowance_id'],
								'employee_allowance_id'				=> $val['employee_allowance_id'],
								'employee_monthly_period'			=> $val['employee_monthly_period'],
								'employee_allowance_amount'			=> $val['employee_allowance_amount'],
								'employee_monthly_working_days'		=> $val['employee_monthly_working_days'],
								'employee_monthly_allowance_days'	=> $val['employee_monthly_allowance_days'],
								'employee_allowance_subtotal'		=> $val['employee_allowance_subtotal'],
								'data_state'						=> 0,
								'created_id'						=> $auth['user_id'],
								'created_on'						=> date("Y-m-d H:i:s"),
							);
							$this->PayrollEmployeeMonthlyCkp_model->insertPayrollEmployeeMonthlyAllowance($data_payrollemployeeallowance);
						}
					}


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeMonthly.processAddPayrollEmployeeMonthly',$auth['user_id'],'Add New Employee Monthly');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Employee Monthly Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addarraypayrollemployeemonthlyitem-'.$unique['unique']);
					$this->session->unset_userdata('addpayrollemployeemonthly-'.$unique['unique']);
					redirect('PayrollEmployeeMonthlyCkp/addPayrollEmployeeMonthly/');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Employee Monthly Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeemonthly',$data);
					redirect('PayrollEmployeeMonthlyCkp/addPayrollEmployeeMonthly/');
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeemonthly',$data);
				redirect('PayrollEmployeeMonthlyCkp/addPayrollEmployeeMonthly/');			}
		}

		public function showdetail(){
			$employee_monthly_id = $this->uri->segment(3);

			$data['Main_view']['payrollemployeemonthly']		= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthly_Detail($employee_monthly_id);

			$data['Main_view']['payrollemployeemonthlyitem']	= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthlyItem_Detail($employee_monthly_id);

			$data['Main_view']['employeestatus']				= $this->configuration->EmployeeStatus();
			
			$data['Main_view']['content']						= 'PayrollEmployeeMonthlyCkp/formdetailPayrollEmployeeMonthlyCkp_view';

			$this->load->view('MainPage_view',$data);
		}	


		public function exportPayrollEmployeeMonthly(){
			$employee_monthly_id = $this->uri->segment(3);

			$payrollemployeemonthly		= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthly_Detail($employee_monthly_id);

			$payrollemployeemonthlyitem	= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthlyItem_Detail($employee_monthly_id);
			
			if(!empty($payrollemployeemonthlyitem)){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Cahaya Kharisma Plasindo")
									 ->setLastModifiedBy("PT. Cahaya Kharisma Plasindo")
									 ->setTitle("Employee Monthly Total")
									 ->setSubject("")
									 ->setDescription("Employee Monthly Total")
									 ->setKeywords("Employee, Monthly, Total")
									 ->setCategory("Employee Monthly Total");
									 
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
				$this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('AG')->setWidth(20);

				$this->excel->getActiveSheet()->mergeCells("B1:AG1");
		
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:AG3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:AG3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:AG3')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('B1',"Employee Monthly Total");

				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Employee Shift Code");
				$this->excel->getActiveSheet()->setCellValue('D3',"Employee Name");
				$this->excel->getActiveSheet()->setCellValue('E3',"Division Name");
				$this->excel->getActiveSheet()->setCellValue('F3',"Department Name");
				$this->excel->getActiveSheet()->setCellValue('G3',"Section Name");	
				$this->excel->getActiveSheet()->setCellValue('H3',"Unit Name");
				$this->excel->getActiveSheet()->setCellValue('I3',"Job Title Name");
				$this->excel->getActiveSheet()->setCellValue('J3',"Bank Name");
				$this->excel->getActiveSheet()->setCellValue('K3',"Monthly Period");	
				$this->excel->getActiveSheet()->setCellValue('L3',"Monthly Period Start Date");
				$this->excel->getActiveSheet()->setCellValue('M3',"Monthly Period End Date");
				$this->excel->getActiveSheet()->setCellValue('N3',"Employee Status");
				$this->excel->getActiveSheet()->setCellValue('O3',"Employee Hire Date");
				$this->excel->getActiveSheet()->setCellValue('P3',"Employee Working Months");
				$this->excel->getActiveSheet()->setCellValue('Q3',"Bank Acct No");
				$this->excel->getActiveSheet()->setCellValue('R3',"Bank Acct Name");
				$this->excel->getActiveSheet()->setCellValue('S3',"Total Working Days");
				$this->excel->getActiveSheet()->setCellValue('T3',"Basic Salary");
				$this->excel->getActiveSheet()->setCellValue('U3',"Working Days");
				$this->excel->getActiveSheet()->setCellValue('V3',"Allowance Amount");
				$this->excel->getActiveSheet()->setCellValue('W3',"Attendance Amount");
				$this->excel->getActiveSheet()->setCellValue('X3',"Length Service Amount");	
				$this->excel->getActiveSheet()->setCellValue('Y3',"Home Early Amount");
				$this->excel->getActiveSheet()->setCellValue('Z3',"Overtime Amount");
				$this->excel->getActiveSheet()->setCellValue('AA3',"BPJS Amount");	
				$this->excel->getActiveSheet()->setCellValue('AB3',"Total Meal Coupon");	
				$this->excel->getActiveSheet()->setCellValue('AC3',"Meal Coupon Amount");	
				$this->excel->getActiveSheet()->setCellValue('AD3',"Delivery Amount");	
				$this->excel->getActiveSheet()->setCellValue('AE3',"Additional Deduction");	
				$this->excel->getActiveSheet()->setCellValue('AF3',"Additional Overtime");	
				$this->excel->getActiveSheet()->setCellValue('AG3',"Total Salary");

				
				$m = 0;
				$j=4;
				$no=0;
				
				foreach($payrollemployeemonthlyitem as $key=>$val){
					if(is_numeric($key)){
						$no++;
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':AG'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':AG'.$j)->getFont()->setSize(12);
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
						$this->excel->getActiveSheet()->getStyle('Z'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('AA'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('AB'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('AC'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('AD'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('AE'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('AF'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

						$this->excel->getActiveSheet()->getStyle('AG'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $payrollemployeemonthly['employee_shift_code']);
						$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['employee_name']);
						$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['division_name']);
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['department_name']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['section_name']);
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['unit_name']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, $val['job_title_name']);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['bank_name']);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, $val['employee_monthly_period']);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $val['employee_monthly_start_date']);
						$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['employee_monthly_end_date']);
						$this->excel->getActiveSheet()->setCellValue('N'.$j, $this->configuration->EmployeeStatus[$val['employee_employment_status']]);
						$this->excel->getActiveSheet()->setCellValue('O'.$j, $val['employee_hire_date']);
						$this->excel->getActiveSheet()->setCellValue('P'.$j, number_format($val['employee_working_months'], 2));
						$this->excel->getActiveSheet()->setCellValue('Q'.$j, $val['employee_monthly_bank_acct_no']);
						$this->excel->getActiveSheet()->setCellValue('R'.$j, $val['employee_monthly_bank_acct_name']);
						$this->excel->getActiveSheet()->setCellValue('S'.$j, $val['employee_monthly_total_working_days']);
						$this->excel->getActiveSheet()->setCellValue('T'.$j, number_format($val['employee_monthly_basic_salary'], 2));
						$this->excel->getActiveSheet()->setCellValue('U'.$j, number_format($val['employee_monthly_working_days'], 2));
						$this->excel->getActiveSheet()->setCellValue('V'.$j, number_format($val['employee_monthly_allowance_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('W'.$j, number_format($val['employee_monthly_attendance_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('X'.$j, number_format($val['employee_monthly_service_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('Y'.$j, number_format($val['employee_monthly_early_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('Z'.$j, number_format($val['employee_monthly_overtime_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('AA'.$j, number_format($val['employee_monthly_bpjs_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('AB'.$j, number_format($val['employee_monthly_total_meal_coupon'], 2));
						$this->excel->getActiveSheet()->setCellValue('AC'.$j, number_format($val['employee_monthly_meal_coupon_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('AD'.$j, number_format($val['employee_monthly_delivery_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('AE'.$j, number_format($val['employee_monthly_additional_deduction_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('AF'.$j, number_format($val['employee_monthly_additional_overtime_amount'], 2));
						$this->excel->getActiveSheet()->setCellValue('AG'.$j, number_format($val['employee_monthly_salary_total'], 2));


						$employee_monthly_period = $val['employee_monthly_period'];
						$employee_monthly_start_date = $val['employee_monthly_start_date'];
						$employee_monthly_end_date = $val['employee_monthly_end_date'];
					}else{
						continue;
					}
					
					$j++;
				}

				$filename='Payroll_Employee_Monthly'.$payrollemployeemonthly['employee_shift_code'].'_'.$employee_monthly_period.'_'.$employee_monthly_start_date.'_'.$employee_monthly_end_date.'.xls';

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

		public function printSalaryReceipt(){
			$employee_monthly_id				= $this->uri->segment(3);

			// Include the main TCPDF library (search for installation path).
			require_once('TCPDF/config/tcpdf_config.php');
			require_once('TCPDF/tcpdf.php');
			// create new PDF document
			$pdf = new MC_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			/*$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);*/

			// set auto page breaks
			/*$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);*/

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('helvetica', 'B', 20);

			// add a page
			/*$pdf->AddPage();*/

			/*$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);*/

			$pdf->SetFont('helvetica', '', 10);

			// ---------------------------------------------------------

			$payrollemployeemonthly		= $this->PayrollEmployeeMonthlyCkp_model->getPayrollEmployeeMonthlyAll_Detail($employee_monthly_id);

			/*print_r("payrollemployeemonthly ");
			print_r($payrollemployeemonthly);
			exit;*/

			

			// -----------------------------------------------------------------------------

			/*$tbl = 
			"<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\">
			    <tr style=\"background-color:#632523;color:#FFFFFF;\">
			        <td><div style=\"text-align: center; font-size:18px; font-weight:bold\">KECERDASAN INTELEKTUAL</div></td>
			    </tr>
			</table>";
			

			$pdf->writeHTML($tbl, true, false, false, false, '');*/

			$tbl2 = '';
			$total_intellectual = 0;
			foreach($payrollemployeemonthly as $key=>$val){
				$tbl2 .= 
					"<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
			        	<tr>
					        <td width=\"465\" colspan = \"7\"><div style=\"text-align: center; font-size:12px; font-weight:bold\">PT. CAHAYA KHARISMA PLASINDO</div></td>
					    </tr>
					    <tr>
					         <td width=\"465\" colspan = \"7\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
					    </tr>
					    <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Nama Karyawan</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['employee_name']."</div></td>
					        <td width=\"65\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Periode</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"120\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".tgltoview($val['employee_monthly_start_date'])." - ".tgltoview($val['employee_monthly_end_date'])."</div></td>
					    </tr>
					     <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Pabrik</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['location_name']."</div></td>
					        <td width=\"65\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Jabatan</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"120\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['job_title_name']."</div></td>
					    </tr>
					    <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Bagian</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['section_name']."</div></td>
					        <td width=\"65\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Sistem</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"120\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Payroll</div></td>
					    </tr>
					    <tr>
					        <td width=\"465\" colspan = \"7\"><div style=\"text-align: center; font-size:12px; font-weight:bold\">".$val['employee_id']."</div></td>
					    </tr>
					    <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$basic_salary_text."</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\">".$employee_monthly_basic_salary."</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".$basic_salary_operator."</div></td>
					        <td width=\"50\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".$employee_monthly_working_days."</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
					        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_basic_salary_amount'])."</div></td>
					    </tr>";

					    if ($val['employee_monthly_length_service_amount'] > 0){
					    	$tbl2 .=  "<tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Tunj. Masa Kerja</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_length_service_amount'])."</div></td>
						    </tr>";
						}

						if ($val['employee_monthly_premi_attendance_amount'] > 0){
							$tbl2 .= "<tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Premi Kehadiran</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_premi_attendance_amount'])."</div></td>
						    </tr>";
						}
					    
						if ($val['employee_monthly_incentive_total_amount'] > 0){
							$tbl2 .=  "<tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Insentif</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_incentive_total_amount'])."</div></td>
						    </tr>";
						}
					
						if ($val['employee_monthly_commission_total_amount'] > 0){
							$tbl2 .= "<tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Komisi</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_commission_total_amount'])."</div></td>
						    </tr>";
						}

						if ($val['employee_monthly_bonus_total_amount'] > 0){
							$tbl2 .= " <tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Bonus</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_bonus_total_amount'])."</div></td>
						    </tr>";
						}

						/*$payrollemployeemonthlyallowance = $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyAllowance_Detail($val['employee_id'], $employee_monthly_period);

						if (isset($payrollemployeemonthlyallowance)){
							foreach ($payrollemployeemonthlyallowance as $keyAllowance => $valAllowance) {
								$tbl2 .= " <tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$valAllowance['allowance_name']."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($valAllowance['employee_allowance_amount'])."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">X</div></td>
							        <td width=\"50\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".$valAllowance['employee_monthly_allowance_days']."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($valAllowance['employee_allowance_subtotal'])."</div></td>
							    </tr>";
							}
						}


						$payrollemployeemonthlydeduction = $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyDeduction_Detail($val['employee_id'], $employee_monthly_period);

						if (isset($payrollemployeemonthlydeduction)){
							foreach ($payrollemployeemonthlydeduction as $keyDeduction => $valDeduction) {
								$tbl2 .= " <tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$valDeduction['deduction_name']."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($valDeduction['employee_deduction_amount'])."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">X</div></td>
							        <td width=\"50\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".$valDeduction['employee_monthly_deduction_days']."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($valDeduction['employee_deduction_subtotal'])."</div></td>
							    </tr>";
							}
						}*/

						if ($val['employee_monthly_lost_item_total_amount'] > 0){
							$tbl2 .= "<tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Potongan Barang Hilang</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_lost_item_total_amount'])."</div></td>
						    </tr>";
						}

					$tbl2 .= " <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Take Home Pay</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">X</div></td>
					        <td width=\"50\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
					        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_salary_total_amount'])."</div></td>
					    </tr>";

					$tbl2 .= " </table>
					<br>
					<br>
					<br>
				";
			}	
			
			$tbl3 = 
				"</table>";
			// ---------------------------------------------------------
			/*$pdf->writeHTML($tbl1.$tbl2.$tbl3, true, false, false, false, '');*/

			$all_table = $tbl2;

			/*print_r("all_table ");
			print_r($all_table);
			exit;*/

			$pdf->PrintChapter(2, '', $all_table, true);
			//Close and output PDF document
			ob_clean();
			$filename = 'IST Test '.$testingParticipantData['participant_name'].'.pdf';
			$pdf->Output($filename, 'I');
		}
	}
?>