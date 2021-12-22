<?php ob_start(); ?>
<?php
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

	Class payrollemployeemonthlyilufa extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeemonthlyilufa_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$user_id 					= $auth['user_id'];
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];
			$branch_status 				= $auth['branch_status'];

			$sesi	= 	$this->session->userdata('filter-payrollemployeemonthly');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['branch_id']			= '';
			}

			$systemuserbranch								= $this->payrollemployeemonthlyilufa_model->getSystemUserBranch($user_id);

			$data['main_view']['corebranch']				= create_double($this->payrollemployeemonthlyilufa_model->getCoreBranch($branch_status, $systemuserbranch), 'branch_id', 'branch_name');

			$data['main_view']['coredivision']				= create_double($this->payrollemployeemonthlyilufa_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_monthly']	= $this->payrollemployeemonthlyilufa_model->getHROEmployeeData_Monthly($region_id, $systemuserbranch, $branch_status, $sesi['branch_id'], $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'payrollemployeemonthlyilufa/listpayrollemployeemonthly_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),	
			);
			$this->session->set_userdata('filter-payrollemployeemonthly',$data);
			redirect('payrollemployeemonthlyilufa');
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
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-payrollemployeemonthly');
			$this->session->unset_userdata('filter-payrollemployeemonthly');
			redirect('payrollemployeemonthlyilufa');
		}

		public function reset_add(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 	= $this->uri->segment(3);	
			$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeovertime-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeloan-'.$unique['unique']);

			$this->session->unset_userdata('addarrayemployeeleaverequest-'.$unique['unique']);			
			$this->session->unset_userdata('addarrayemployeedayoff-'.$unique['unique']);			
			$this->session->unset_userdata('addarrayemployeeovertimerequest-'.$unique['unique']);	
			$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);	
			$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
			$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);
			redirect('payrollemployeemonthlyilufa/addPayrollEmployeeMonthly/'.$employee_id);
		}

		public function processCalculatePayrollEmployeeMonthly(){
			$employee_id 					= $this->input->post('employee_id',true);
			$monthly_period_working_days	= $this->input->post('employee_monthly_working_days',true);

			redirect('payrollemployeemonthlyilufa/addPayrollEmployeeMonthly/'.$employee_id.'/'.$monthly_period_working_days);
		}
		
		public function addPayrollEmployeeMonthly(){
			$unique 		= $this->session->userdata('unique');
			$employee_id 							= $this->uri->segment(3);	
			$monthly_period_working_days_calculate 	= $this->uri->segment(4);	

			

			/*print_r("employee_id");
			print_r($employee_id);
			exit;*/

			$employee_hire_date 		= $this->payrollemployeemonthlyilufa_model->getEmployeeHireDate($employee_id);

			$working_status 			= $this->payrollemployeemonthlyilufa_model->getEmployeeWorkingStatus($employee_id);

			$employee_employment_status	= $this->payrollemployeemonthlyilufa_model->getEmployeeEmploymentStatus($employee_id);

			$payrollmonthlyperiod 		= $this->payrollemployeemonthlyilufa_model->getPayrollMonthlyPeriod();

			$year_period 				= date("Y", strtotime($payrollmonthlyperiod['monthly_period_start_date']));
			$monthly_period 			= $payrollmonthlyperiod['monthly_period']; 
			$monthly_period_end_date 	= $payrollmonthlyperiod['monthly_period_end_date'];

			
			/*Calculate Employee Late Days*/
			$corelate 				= $this->payrollemployeemonthlyilufa_model->getCoreLate();
			$employee_late_days 	= 0;
			$late_id 				= "";
			
			$hroemployeelate 	= $this->payrollemployeemonthlyilufa_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);

			if (!empty($hroemployeelate)){
				foreach ($hroemployeelate as $keyEmployeeLate => $valEmployeeLate) {
					$employee_late_days++;
				}
			}
			

			/*Calculate Employee Absence Days*/
			$coreabsence 				= $this->payrollemployeemonthlyilufa_model->getCoreAbsence();
			$employee_absence_days 		= 0;
			$absence_id 				= "";

			$hroemployeeabsence 	= $this->payrollemployeemonthlyilufa_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

			/*print_r("hroemployeeabsence ");
			print_r($hroemployeeabsence);
			print_r("<BR> ");*/
			

			if (!empty($hroemployeeabsence)){
				foreach ($hroemployeeabsence as $keyEmployeeAbsence => $valEmployeeAbsence) {
					$employee_absence_days++;
				}
			}

			/*print_r("employee_absence_days ");
			print_r($employee_absence_days);
			print_r("<BR> ");
			exit;*/

			/*Calculate Employee Permit Days*/
			$corepermit 				= $this->payrollemployeemonthlyilufa_model->getCorePermit();
			$employee_permit_days 		= 0;
			$permit_id 					= "";

			$hroemployeepermit 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);

			if (!empty($hroemployeepermit)){
				foreach ($hroemployeepermit as $keyEmployeePermit => $valEmployeePermit) {
					$employee_permit_days++;
				}
			}

			/*Calculate Employee Leave Days*/
			$coreannualleave			= $this->payrollemployeemonthlyilufa_model->getCoreAnnualLeave();
			$employee_leave_days 		= 0;
			$annual_leave_id 			= "";

			$payrollleaverequest 		= $this->payrollemployeemonthlyilufa_model->getPayrollLeaveRequest($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $annual_leave_id);

			/*print_r("payrollleaverequest ");
			print_r($payrollleaverequest);
			print_r("<BR> ");*/
			

			if (!empty($payrollleaverequest)){

				foreach ($payrollleaverequest as $keyEmployeeLeave => $valEmployeeLeave) {
					$employee_leave_days++;
				}
			}

			/*print_r("employee_leave_days ");
			print_r($employee_leave_days);
			print_r("<BR> ");
			exit;*/
			if ($employee_employment_status == 3){
				$premi_attendance_days 		= $employee_late_days + $employee_absence_days + $employee_permit_days;
			} else {
				$premi_attendance_days 		= $employee_late_days + $employee_absence_days;
			}

			/*Calculate Home Early Days*/
			/*$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$corehomeearly 	= $this->payrollemployeemonthlyilufa_model->getCoreHomeEarly();
			$home_early_id 	= "";

			$hroemployeehomeearly 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

			if (!empty($hroemployeehomeearly)){
				
				foreach ($hroemployeehomeearly as $keyEmployeeHomeEarly => $valEmployeeHomeEarly) {
					$employee_home_early_days++;
				}
			}*/

			/*Calculate Working Days*/
			if (empty($monthly_period_working_days_calculate) || ($monthly_period_working_days_calculate == 0)){
				$monthly_period_working_days	= $payrollmonthlyperiod['monthly_period_working_days'];
			} else {
				$monthly_period_working_days	= $monthly_period_working_days_calculate;
			}

			$default_working_days 			= $payrollmonthlyperiod['monthly_period_working_days'];

			/*print_r("monthly_period_working_days ");
			print_r($monthly_period_working_days);
			print_r("<BR> ");

			print_r("leave_request_days ");
			print_r($leave_request_days);
			print_r("<BR> ");

			print_r("employee_absence_days ");
			print_r($employee_absence_days);
			print_r("<BR> ");

			print_r("employee_permit_days ");
			print_r($employee_permit_days);
			print_r("<BR> ");

			exit;*/

			$employee_monthly_working_days = $monthly_period_working_days - $leave_request_days - $employee_absence_days - ($employee_home_early_days * 0.5) - $employee_permit_days - $employee_leave_days;

			
			/*Calculate Length of Service */
			$lengthofservice 			= date_diff(date_create($monthly_period_end_date), date_create($employee_hire_date));
			$month 	= $lengthofservice->m;
			$year 	= $lengthofservice->y;

			$length_of_service_month = ($year * 12) + $month;

			/*print_r("lengthofservice ");
			print_r($lengthofservice);
			print_r("<BR> ");

			print_r("length_of_service_month ");
			print_r($length_of_service_month);
			print_r("<BR> ");
			exit;*/
			
			$payrollemployeelengthservice = $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeLengthService($employee_id, $year_period);

			$corelengthservice 			= $this->payrollemployeemonthlyilufa_model->getCoreLengthService();
			
			$length_service_amount_multiply = $corelengthservice['length_service_amount_multiply'];
			$length_service_min_saving 		= $corelengthservice['length_service_min_saving'];

			if (empty($length_service_amount_multiply)){
				$length_service_amount_multiply = 0;
			}

			if (empty($length_service_min_saving)){
				$length_service_min_saving = 0;
			}
			
			$length_service_monthly	 		= floor($length_of_service_month / 12);

			$length_service_amount 			= $length_service_amount_multiply * $length_service_monthly;

			$employee_length_service_amount	= $length_service_amount % $length_service_min_saving;

			/*print_r("<BR>");
			print_r("employee_length_service_amount atas");
			print_r($employee_length_service_amount);*/

			if ($length_service_amount <= $length_service_amount_multiply){
				$employee_length_service_amount = 0;
			}

			$employee_length_saving_amount	= $length_service_amount - $employee_length_service_amount;
			
			
			/*print_r("<BR>");
			print_r("length_service_amount_multiply ");
			print_r($length_service_amount_multiply);			

			print_r("<BR>");
			print_r("length_service_min_saving ");
			print_r($length_service_min_saving);

			print_r("<BR>");
			print_r("length_service_amount ");
			print_r($length_service_amount);

			print_r("<BR>");
			print_r("employee_length_saving_amount ");
			print_r($employee_length_saving_amount);

			print_r("<BR>");
			print_r("employee_length_service_amount ");
			print_r($employee_length_service_amount);

			exit;*/

			/*print_r("payrollemployeelengthservice ");
			print_r($payrollemployeelengthservice);

			print_r("<BR>");
			print_r("length_service_amount_multiply ");
			print_r($length_service_amount_multiply);

			print_r("<BR>");
			print_r("length_service_min_saving ");
			print_r($length_service_min_saving);

			print_r("<BR>");
			print_r("length_service_monthly ");
			print_r($length_service_monthly);

			print_r("<BR>");
			print_r("employee_length_service_amount ");
			print_r($employee_length_service_amount);

			print_r("<BR>");
			print_r("length_service_amount ");
			print_r($length_service_amount);

			print_r("<BR>");
			print_r("employee_length_saving_amount ");
			print_r($employee_length_saving_amount);

			exit;*/

			/*Calculate BPJS*/
			$payrollemployeebpjs			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeBPJS($employee_id);

			/*print_r("<BR>");
			print_r("payrollemployeebpjs ");
			print_r($payrollemployeebpjs);

			exit;*/

			$payrollemployeepremiattendance = $this->payrollemployeemonthlyilufa_model->getPayrollEmployeePremiAttendance($employee_id, $year_period);

			/*print_r("<BR>");
			print_r("payrollemployeepremiattendance ");
			print_r($payrollemployeepremiattendance);
			print_r("<BR>");
			print_r("<BR>");*/
			/*exit;*/


			/*PAYROLL EMPLOYEE BONUS*/
			$this->session->unset_userdata('addarrayemployeebonus-'.$unique['unique']);
			$payrollemployeebonus 		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeBonus($employee_id, $monthly_period);

			$employee_monthly_bonus_amount = 0;

			foreach ($payrollemployeebonus as $keyBonus => $valBonus) {
				$data_payrollemployeemonthlybonus = array(
					'employee_id' 							=> $employee_id,
					'bonus_id' 								=> $valBonus['bonus_id'],
					'employee_monthly_period'				=> $payrollmonthlyperiod['monthly_period'],
					'employee_monthly_bonus_amount'			=> $valBonus['employee_bonus_amount'],
					'employee_monthly_bonus_description'	=> $valBonus['employee_bonus_description'],
					);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeebonus-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlybonus['bonus_id']] = $data_payrollemployeemonthlybonus;
				$this->session->set_userdata('addarrayemployeebonus-'.$unique['unique'], $dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlybonus = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'], $data_payrollemployeemonthlybonus);

				$employee_monthly_bonus_amount += $valBonus['employee_bonus_amount'];
			}

			/*PAYROLL EMPLOYEE LOST ITEM*/
			$this->session->unset_userdata('addarrayemployeelostitem-'.$unique['unique']);
			$payrollemployeelostitem 		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeLostItem($employee_id, $monthly_period);

			$employee_monthly_lost_item_amount = 0;

			foreach ($payrollemployeelostitem as $keyLostItem => $valLostItem) {
				$data_payrollemployeemonthlylostitem = array(
					'employee_id' 								=> $employee_id,
					'lost_item_id'								=> $valLostItem['lost_item_id'],
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
					'employee_monthly_lost_item_period'			=> $valLostItem['employee_lost_item_period'],
					'employee_monthly_lost_item_amount'			=> $valLostItem['employee_lost_item_amount'],
					'employee_monthly_lost_item_description'	=> $valLostItem['employee_lost_item_description'],
					);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeelostitem-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlylostitem['lost_item_id']] = $data_payrollemployeemonthlylostitem;
				$this->session->set_userdata('addarrayemployeelostitem-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlylostitem = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeemonthlylostitem);

				$employee_monthly_lost_item_amount += $valLostItem['employee_lost_item_amount'];
			}


			/*PAYROLL EMPLOYEE COMMISSION*/
			$this->session->unset_userdata('addarrayemployeecommission-'.$unique['unique']);
			$payrollemployeecommission 		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeCommission($employee_id, $monthly_period);

			/*print_r("payrollemployeecommission ");
			print_r($payrollemployeecommission);
			exit;*/

			$employee_monthly_commission_amount = 0;

			foreach ($payrollemployeecommission as $keyCommission => $valCommission) {
				$data_payrollemployeemonthlycommission = array(
					'employee_id'			 					=> $employee_id,
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
					'employee_monthly_commission_omzet_mmc'		=> $valCommission['employee_commission_omzet_mmc'],
					'employee_monthly_commission_quantity_mmc'	=> $valCommission['employee_commission_quantity_mmc'],
					'employee_monthly_commission_omzet_acc'		=> $valCommission['employee_commission_omzet_acc'],
					'employee_monthly_commission_total_omzet'	=> $valCommission['employee_commission_total_omzet'],
					'employee_monthly_commission_amount_mmc'	=> $valCommission['employee_commission_amount_mmc'],
					'employee_monthly_commission_amount_acc'	=> $valCommission['employee_commission_amount_acc'],
					'employee_monthly_commission_total_amount'	=> $valCommission['employee_commission_total_amount'],
					);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeecommission-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlycommission['employee_id']] = $data_payrollemployeemonthlycommission;
				$this->session->set_userdata('addarrayemployeecommission-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlycommission = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeemonthlycommission);

				$employee_monthly_commission_amount += $valCommission['employee_commission_total_amount'];
			}

			/*PAYROLL EMPLOYEE INCENTIVE*/
			$this->session->unset_userdata('addarrayemployeeincentive-'.$unique['unique']);
			$payrollemployeeincentive 		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeIncentive($employee_id, $monthly_period);

			/*print_r("payrollemployeeincentive ");
			print_r($payrollemployeeincentive);
			exit;*/

			$employee_monthly_incentive_total_amount = 0;

			foreach ($payrollemployeeincentive as $keyIncentive => $valIncentive) {
				$data_payrollemployeemonthlyincentive = array(
					'employee_id'			 					=> $employee_id,
					'incentive_id'								=> $valIncentive['incentive_id'],
					'incentive_name'							=> $valIncentive['incentive_name'],
					'employee_monthly_period'					=> $payrollmonthlyperiod['monthly_period'],
					'employee_monthly_incentive_total_amount'	=> $valIncentive['employee_incentive_amount'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeincentive-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlyincentive['employee_id']] = $data_payrollemployeemonthlyincentive;
				$this->session->set_userdata('addarrayemployeeincentive-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlyincentive = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeemonthlyincentive);

				$employee_monthly_incentive_total_amount += $valIncentive['employee_incentive_amount'];
			}

			/*PAYROLL EMPLOYEE DEDUCTION PREMI*/
			$this->session->unset_userdata('addarrayemployeedeductionpremi-'.$unique['unique']);
			$payrollemployeedeductionpremi 		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeDeductionPremi($employee_id, $monthly_period);

			$employee_monthly_deduction_premi_amount = 0;

			foreach ($payrollemployeedeductionpremi as $keyDeductionPremi => $valDeductionPremi) {
				$data_payrollemployeemonthlydeductionpremi = array(
					'employee_id' 										=> $employee_id,
					'premi_attendance_id'								=> $valDeductionPremi['premi_attendance_id'],
					'employee_monthly_period'							=> $payrollmonthlyperiod['monthly_period'],
					'employee_monthly_deduction_premi_period'			=> $valDeductionPremi['employee_deduction_premi_period'],
					'employee_monthly_deduction_premi_amount'			=> $valDeductionPremi['employee_deduction_premi_amount'],
					'employee_monthly_deduction_premi_description'		=> $valDeductionPremi['employee_deduction_premi_description'],
					);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeedeductionpremi-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeemonthlydeductionpremi['premi_attendance_id']] = $data_payrollemployeemonthlydeductionpremi;
				$this->session->set_userdata('addarrayemployeedeductionpremi-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeemonthlydeductionpremi = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeemonthlydeductionpremi);

				$employee_monthly_deduction_premi_amount += $valDeductionPremi['employee_deduction_premi_amount'];
			}


			/*PAYROLL EMPLOYEE LOAN*/
			$this->session->unset_userdata('addarrayemployeeloan-'.$unique['unique']);
			$payrollemployeeloan 		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeLoan($employee_id, $monthly_period);

			$employee_loan_amount = 0;

			foreach ($payrollemployeeloan as $keyLoan => $valLoan) {
				$data_payrollemployeeloan = array(
					'employee_id' 						=> $employee_id,
					'loan_type_id' 						=> $valLoan['loan_type_id'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
					'employee_loan_item_amount'			=> $valLoan['employee_loan_item_amount'],
					'employee_loan_item_period'			=> $valLoan['employee_loan_item_period'],
					);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeeloan-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeeloan['loan_type_id']] = $data_payrollemployeeloan;
				$this->session->set_userdata('addarrayemployeeloan-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeeloan = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeeloan);

				$employee_loan_amount += $valLoan['employee_loan_item_amount'];
			}

			/*print_r("<BR>");
			print_r("payrollemployeeloan ");
			print_r($payrollemployeeloan);
			print_r("<BR>");
			print_r("employee_loan_amount ");
			print_r($employee_loan_amount);
			print_r("<BR>");

			exit;*/



			$payrollemployeepayment 	= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeePayment($employee_id);

			$payment_basic_salary 		= $payrollemployeepayment['payment_basic_salary'];

			/*Calculate Payroll Basic Salary*/

			if ($employee_employment_status == 3){
				$payment_basic_salary_monthly = $payment_basic_salary;
			} else if ($employee_employment_status == 4) {
				$payment_basic_salary_monthly = ($employee_monthly_working_days / $default_working_days) * $payment_basic_salary;
			} else if ($employee_employment_status == 2) {
				$payment_basic_salary_monthly = $employee_monthly_working_days * $payment_basic_salary;
			} else {
				$payment_basic_salary_monthly = $payment_basic_salary;
			}

			/*array (1 => 'Permanent', 2 => 'Probation', 3 => 'Contract 1', 4 => 'Contract 2'); */

			/*print_r("employee_employment_status ");
			print_r($employee_employment_status);
			print_r("<BR>");

			print_r("payment_basic_salary ");
			print_r($payment_basic_salary);
			print_r("<BR>");

			print_r("payment_basic_salary_monthly ");
			print_r($payment_basic_salary_monthly);
			print_r("<BR>");

			print_r("employee_monthly_working_days ");
			print_r($employee_monthly_working_days);
			print_r("<BR>");
			exit;*/

			/*Overtime*/
			$payrollovertimerequest 			= $this->payrollemployeemonthlyilufa_model->getPayrollOvertimeRequest($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			/*Home Early*/
			$hroemployeehomeearlymonthly 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeHomeEarlyMonthly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date']);

			$payrollemployeeallowance 			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeAllowance($employee_id, $year_period);

			$payrollemployeededuction_detail 	= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeDeduction_Detail($employee_id, $year_period);


			/*Deduction*/
			$payroll_monthly_deduction_total = 0;
			$premi_attendance_total_days = 0;
			$no = 0;

			## DEDUCTION EMPLOYEE LATE
			$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);

			$corelate 					= $this->payrollemployeemonthlyilufa_model->getCoreLate();
			foreach($corelate as $keyCoreLate => $valCoreLate){
				$deduction_id 				= $valCoreLate['deduction_id'];
				$late_id 					= $valCoreLate['late_id'];
				$employee_late_days 		= 0;
				$employee_late_duration 	= 0;
				$employee_deduction_amount 	= 0;
				$no++;

				$hroemployeelate 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);

				if (!empty($hroemployeelate)){
					foreach ($hroemployeelate as $keyEmployeeLate => $valEmployeeLate) {
						$employee_late_duration = $employee_late_duration + $valEmployeeLate['employee_late_duration'];
					}

					$corededuction_detail 				= $this->payrollemployeemonthlyilufa_model->getCoreDeduction_Detail($deduction_id);

					/*print_r("corededuction_detail ");
					print_r($corededuction_detail);
					print_r("<BR> ");*/

					if ($corededuction_detail['deduction_type'] == 4){			
						$deduction_amount					= $corededuction_detail['deduction_amount'];

						$deduction_basic_salary_ratio 		= $corededuction_detail['deduction_basic_salary_ratio'];
						$deduction_premi_attendance_ratio 	= $corededuction_detail['deduction_premi_attendance_ratio'];
						$deduction_premi_attendance_status 	= $corededuction_detail['deduction_premi_attendance_status'];

						$coredeductionallowance 			= $this->payrollemployeemonthlyilufa_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

						$employee_premi_attendance_amount 	= $this->payrollemployeemonthlyilufa_model->getEmployeePremiAttendanceAmount($employee_id, $year_period);

						if(!empty($coredeductionallowance)){
							
							
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 	= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 	= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_amount 	= $employee_deduction_amount + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
						}else{
							$employee_deduction_amount 		= $deduction_amount;	
						}

						if ($deduction_premi_attendance_status == 0){
							/*DAILY*/
							if ($deduction_basic_salary_ratio > 0){
								$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio) + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
							}else {
								$employee_deduction_amount = $employee_deduction_amount + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
							}
						} else {
							if ($deduction_basic_salary_ratio > 0){
								$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio);
							}else {
								$employee_deduction_amount = $employee_deduction_amount + 0;
							}

							if ($deduction_premi_attendance_ratio > 0){
								$premi_attendance_total_days = $premi_attendance_total_days + 1;
							}
						}
					}
				}
				
				$employee_deduction_subtotal = $employee_late_duration * $employee_deduction_amount;



				/*print_r("employee_deduction_amount ");
				print_r($employee_deduction_amount);
				print_r("<BR> ");

				print_r("deduction_amount ");
				print_r($deduction_amount);
				print_r("<BR> ");*/

				if ($employee_late_duration > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis").$no,
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_late_days,
						'employee_monthly_late_duration'	=> $employee_late_duration,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
					);

					/*print_r("data_payrollemployeededuction ");
					print_r($data_payrollemployeededuction);*/
					/*exit;*/

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['employee_monthly_deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}


			## DEDUCTION EMPLOYEE ABSENCE
			$coreabsence 				= $this->payrollemployeemonthlyilufa_model->getCoreAbsence();
			

			foreach($coreabsence as $keyCoreAbsence => $valCoreAbsence){
				$deduction_id 				= $valCoreAbsence['deduction_id'];
				$absence_id 				= $valCoreAbsence['absence_id'];
				$employee_absence_days 		= 0;
				$employee_deduction_amount 	= 0;

				$no++;
				

				$hroemployeeabsence 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

				/*print_r("hroemployeeabsence ");
				print_r($hroemployeeabsence);
				print_r("<BR> ");*/

				if (!empty($hroemployeeabsence)){
					foreach ($hroemployeeabsence as $keyEmployeeAbsence => $valEmployeeAbsence) {
						$employee_absence_days++;
					}

					/*print_r("employee_absence_days ");
					print_r($employee_absence_days);
					print_r("<BR> ");*/

					$corededuction_detail 				= $this->payrollemployeemonthlyilufa_model->getCoreDeduction_Detail($deduction_id);

					/*print_r("corededuction_detail ");
					print_r($corededuction_detail);
					exit;*/

					if ($corededuction_detail['deduction_type'] == 1){
						$deduction_amount					= $corededuction_detail['deduction_amount'];

						$deduction_basic_salary_ratio 		= $corededuction_detail['deduction_basic_salary_ratio'];
						$deduction_premi_attendance_ratio 	= $corededuction_detail['deduction_premi_attendance_ratio'];
						$deduction_premi_attendance_status 	= $corededuction_detail['deduction_premi_attendance_status'];

						$coredeductionallowance 			= $this->payrollemployeemonthlyilufa_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);



						$employee_premi_attendance_amount 	= $this->payrollemployeemonthlyilufa_model->getEmployeePremiAttendanceAmount($employee_id, $year_period);

						if(!empty($coredeductionallowance)){
							
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 	= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 	= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_amount 	= $employee_deduction_amount + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
						}else{

						}

						/*print_r("deduction_allowance_ratio ");
						print_r($deduction_allowance_ratio);
						print_r("<BR>");

						print_r("employee_allowance_amount ");
						print_r($employee_allowance_amount);
						print_r("<BR>");

						print_r("employee_deduction_amount ");
						print_r($employee_deduction_amount);
						print_r("<BR>");

						print_r("payment_basic_salary_monthly ");
						print_r($payment_basic_salary_monthly);
						print_r("<BR>");

						print_r("deduction_premi_attendance_ratio ");
						print_r($deduction_premi_attendance_ratio);
						print_r("<BR>");

						print_r("employee_premi_attendance_amount ");
						print_r($employee_premi_attendance_amount);
						print_r("<BR>");

						print_r("employee_deduction_amount ");
						print_r($employee_deduction_amount);
						print_r("<BR>");*/


						if ($deduction_premi_attendance_status == 0){
							if ($deduction_basic_salary_ratio > 0){
								$employee_deduction_amount = ($payment_basic_salary_monthly / $deduction_basic_salary_ratio) + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount) + $employee_deduction_amount;
							}else {
								$employee_deduction_amount = ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount) + $employee_deduction_amount;
							}
						} else{
							if ($deduction_basic_salary_ratio > 0){
								$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio);
							}else {
								$employee_deduction_amount = $employee_deduction_amount + 0;
							}

							if($deduction_premi_attendance_ratio > 0){
								$premi_attendance_total_days = $premi_attendance_total_days + 1;
							}
						}

						if ($employee_employment_status == 4){
							$employee_deduction_amount = $this->payrollemployeemonthlyilufa_model->getEmployeeDeductionAmount($employee_id, $year_period, $deduction_id);
						}
					}

					/*print_r("deduction_basic_salary_ratio ");
					print_r($deduction_basic_salary_ratio);
					print_r("<BR>");


					print_r("employee_deduction_amount ");
					print_r($employee_deduction_amount);
					print_r("<BR>");

					exit;*/

				}

				$employee_deduction_subtotal = $employee_absence_days * $employee_deduction_amount;

				if ($employee_absence_days > 0){
					$data_payrollemployeededuction = array(
						'employee_monthly_deduction_id'		=> date("YmdHis").$no,
						'employee_id' 						=> $employee_id,
						'deduction_id' 						=> $deduction_id,
						'deduction_type' 					=> $valCoreDeduction['deduction_type'],
						'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
						'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
						'employee_deduction_amount'			=> $employee_deduction_amount,
						'employee_monthly_working_days'		=> $employee_monthly_working_days,
						'employee_monthly_deduction_days'	=> $employee_absence_days,
						'employee_monthly_late_duration'	=> 0,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
					);

					/*print_r(" data_payrollemployeededuction absence ");
					print_r($data_payrollemployeededuction);
					print_r(" <BR> ");*/

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeededuction['employee_monthly_deduction_id']] = $data_payrollemployeededuction;
					$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeededuction);
				}
			}

			$data_payrollemployeededuction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);

			/*print_r("data_payrollemployeededuction absence ");
			print_r($data_payrollemployeededuction);
			print_r("<BR> ");*/



			## DEDUCTION EMPLOYEE PERMIT
			$corepermit = $this->payrollemployeemonthlyilufa_model->getCorePermit();

			/*print_r("corepermit ");
			print_r($corepermit);
			print_r("<BR>");*/
			


			foreach($corepermit as $keyCorePermit => $valCorePermit){
				/*print_r("AWAL ");
				print_r("<BR>");
				print_r("<BR>");*/

				$deduction_id 				= $valCorePermit['deduction_id'];
				$permit_id 					= $valCorePermit['permit_id'];
				$employee_permit_days 		= 0;
				$employee_deduction_amount 	= 0;
				$no++;

				$hroemployeepermit 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);

				/*print_r("hroemployeepermit ");
				print_r($hroemployeepermit);
				print_r("<BR>");*/

				
				if (!empty($hroemployeepermit)){
					
					foreach ($hroemployeepermit as $keyEmployeePermit => $valEmployeePermit) {
						$employee_permit_days++;
					}
					/*print_r("<BR>");
					print_r("employee_permit_days ");
					print_r($employee_permit_days);
					print_r("<BR>");	
					print_r("<BR>");*/

					$corededuction_detail 				= $this->payrollemployeemonthlyilufa_model->getCoreDeduction_Detail($deduction_id);

					/*print_r("<BR>");
					print_r("corededuction_detail ");
					print_r($corededuction_detail);
					print_r("<BR>");	
					print_r("<BR>");
					exit;*/

					if ($corededuction_detail['deduction_type'] == 1 || $corededuction_detail['deduction_type'] == 0){
						$deduction_amount					= $corededuction_detail['deduction_amount'];

						$deduction_basic_salary_ratio 		= $corededuction_detail['deduction_basic_salary_ratio'];
						$deduction_premi_attendance_ratio 	= $corededuction_detail['deduction_premi_attendance_ratio'];
						$deduction_premi_attendance_status 	= $corededuction_detail['deduction_premi_attendance_status'];

						$coredeductionallowance 			= $this->payrollemployeemonthlyilufa_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

						$employee_premi_attendance_amount 	= $this->payrollemployeemonthlyilufa_model->getEmployeePremiAttendanceAmount($employee_id, $year_period);

						if(!empty($coredeductionallowance)){
							
							foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
								$deduction_allowance_ratio 	= $valDeductionAllowance['deduction_allowance_ratio'];
								$employee_allowance_amount 	= $valDeductionAllowance['employee_allowance_amount'];
								$employee_deduction_amount 	= $employee_deduction_amount + ($deduction_allowance_ratio * $employee_allowance_amount);
							}
						}else{

						}

						/*print_r("deduction_premi_attendance_status ");
						print_r($deduction_premi_attendance_status);
						print_r("<BR>");
						print_r("deduction_basic_salary_ratio ");
						print_r($deduction_basic_salary_ratio);
						print_r("<BR>");
						exit;*/

						if ($deduction_premi_attendance_status == 0){
							if ($deduction_basic_salary_ratio > 0){
								$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio) + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
							}else {
								$employee_deduction_amount = $employee_deduction_amount  + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
							}
						} else {
							if ($deduction_basic_salary_ratio > 0){
								$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio) ;
							}else {
								$employee_deduction_amount = $employee_deduction_amount + 0;
							}

							if ($deduction_premi_attendance_ratio > 0){
								$premi_attendance_total_days = $premi_attendance_total_days + 1;
							}
						}
					}

					if ($employee_employment_status == 4){
						$employee_deduction_amount = $this->payrollemployeemonthlyilufa_model->getEmployeeDeductionAmount($employee_id, $year_period, $deduction_id);
					}

					$employee_deduction_subtotal = $employee_permit_days * $employee_deduction_amount;

					/*print_r("employee_deduction_amount");
					print_r($employee_deduction_amount);*/

					if ($employee_permit_days > 0){
						$data_payrollemployeededuction = array(
							'employee_monthly_deduction_id'		=> date("YmdHis").$no,
							'employee_id' 						=> $employee_id,
							'deduction_id' 						=> $deduction_id,
							'deduction_type' 					=> $corededuction_detail['deduction_type'],
							'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
							'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
							'employee_deduction_amount'			=> $employee_deduction_amount,
							'employee_monthly_working_days'		=> $employee_monthly_working_days,
							'employee_monthly_deduction_days'	=> $employee_permit_days,
							'employee_monthly_late_duration'	=> 0,
							'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

						/*print_r("<BR>");
						print_r("data_payrollemployeededuction ");
						print_r($data_payrollemployeededuction);
						print_r("<BR>");	
						print_r("<BR>");*/

						$unique 			= $this->session->userdata('unique');
						$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
						$dataArrayHeader[$data_payrollemployeededuction['employee_monthly_deduction_id']] = $data_payrollemployeededuction;
						$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
						$sesi 	= $this->session->userdata('unique');
						$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

						$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeededuction);
					}
				}
				$no++;
			}

			$data_payrollemployeededuction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);

			/*print_r("data_payrollemployeededuction permit ");
			print_r($data_payrollemployeededuction);
			print_r("<BR> ");*/
			/*exit;*/
			/*exit;*/


			## DEDUCTION EMPLOYEE HOME EARLY
			$corehomeearly = $this->payrollemployeemonthlyilufa_model->getCoreHomeEarly();

			$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);

			foreach($corehomeearly as $keyCoreHomeEarly => $valCoreHomeEarly){
				$deduction_id 				= $valCoreHomeEarly['deduction_id'];
				$home_early_id 				= $valCoreHomeEarly['home_early_id'];
				$employee_home_early_days 	= 0;

				$hroemployeehomeearly 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

				$employee_deduction_amount = 0;
				if (!empty($hroemployeehomeearly)){
					
					foreach ($hroemployeehomeearly as $keyEmployeeHomeEarly => $valEmployeeHomeEarly) {
						$employee_home_early_days++;
					}

					$payrollemployeededuction 			= $this->payrollemployeemonthlyilufa_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);
			
					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

					$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];
					$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
					$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
					$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

					$coredeductionallowance 			= $this->payrollemployeemonthlyilufa_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);

					$employee_premi_attendance_amount 	= $this->payrollemployeemonthlyilufa_model->getEmployeePremiAttendanceAmount($employee_id, $year_period);

					if(!empty($coredeductionallowance)){
						
						foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
							$deduction_allowance_ratio 	= $valDeductionAllowance['deduction_allowance_ratio'];
							$employee_allowance_amount 	= $valDeductionAllowance['employee_allowance_amount'];
							$employee_deduction_amount 	= $employee_deduction_amount + ($deduction_allowance_ratio * $employee_allowance_amount);
						}
					}else{

					}

					if ($deduction_premi_attendance_status == 0){
						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio) + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}else {
							$employee_deduction_amount = $employee_deduction_amount  + ($deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
						}
					} else {
						if ($deduction_basic_salary_ratio > 0){
							$employee_deduction_amount = $employee_deduction_amount + ($payment_basic_salary_monthly / $deduction_basic_salary_ratio) ;
						}else {
							$employee_deduction_amount = $employee_deduction_amount;
						}
					}

					if ($employee_employment_status == 4){
						$employee_deduction_amount = $this->payrollemployeemonthlyilufa_model->getEmployeeDeductionAmount($employee_id, $year_period, $deduction_id);
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
						'employee_monthly_late_duration'	=> 0,
						'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
						);

					$unique 			= $this->session->userdata('unique');
					$dataArrayHeader	= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
					$dataArrayHeader[$data_payrollemployeehomeearly['deduction_id']] = $data_payrollemployeehomeearly;
					$this->session->set_userdata('addarrayemployeehomeearly-'.$unique['unique'],$dataArrayHeader);
					$sesi 	= $this->session->userdata('unique');
					$data_payrollemployeehomeearly = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

					$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeehomeearly);
				}
			}

			/*FIXED DEDUCTION*/

			/*print_r("payrollemployeededuction_detail ");
			print_r($payrollemployeededuction_detail);
			exit;*/

			foreach ($payrollemployeededuction_detail as $keyDeduction => $valDeduction){
				$employee_deduction_amount 	= $valDeduction['employee_deduction_amount'];
				$deduction_type 			= $valDeduction['deduction_type'];
				$no++;

				switch ($deduction_type) {
				    case 0:
				        $employee_monthly_deduction_days 	= 1;
						$employee_deduction_subtotal 		= $employee_deduction_amount;
				        break;
				    
				}

				$data_payrollemployeedeductionfixed = array(
					'employee_monthly_deduction_id'		=> date("YmdHis").$no,
					'employee_id' 						=> $valDeduction['employee_id'],
					'deduction_id' 						=> $valDeduction['deduction_id'],
					'employee_deduction_id'				=> $valDeduction['employee_deduction_id'],
					'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
					'employee_deduction_amount'			=> $employee_deduction_amount,
					'employee_monthly_working_days'		=> $employee_monthly_working_days,
					'employee_monthly_deduction_days'	=> $employee_monthly_deduction_days,
					'employee_monthly_late_duration'	=> 0,
					'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
				);

				$unique 			= $this->session->userdata('unique');
				$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
				$dataArrayHeader[$data_payrollemployeedeductionfixed['employee_monthly_deduction_id']] = $data_payrollemployeedeductionfixed;
				$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_payrollemployeedeductionfixed = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeedeductionfixed);
			}


			$data_payrollemployeededuction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);

			/*print_r("data_payrollemployeededuction fixed ");
			print_r($data_payrollemployeededuction);
			print_r("<BR> ");*/
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
				$data_payrollemployeeallowance = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeeallowance);
			}

			/*Calculate Overtime*/
			$overtime_working_hour_total = 0;
			$overtime_day_off_total = 0;
			foreach($payrollovertimerequest as $keyOvertime=>$valOvertime){
				$overtime_request_date = $valOvertime['overtime_request_date'];

				$day_name = date("D", strtotime($overtime_request_date));

				$dayoff_date = $this->payrollemployeemonthlyilufa_model->getDayOffDate($overtime_request_date);

				if ($day_name != "Sun" && count($dayoff_date) == 0){
					$overtime_working_hour_total = $overtime_working_hour_total + $valOvertime['overtime_request_duration'];
					$overtime_working_day_remark = 'Lembur Hari Kerja';
				} else {
					$overtime_day_off_total = $overtime_day_off_total + $valOvertime['overtime_request_duration'];
					$overtime_day_off_remark = 'Lembur Hari Libur';
				}
			}

			$overtime_request_amount = $this->payrollemployeemonthlyilufa_model->getPaymentBasicOvertime($employee_id, $year_period);

			$coreovertimetype = $this->payrollemployeemonthlyilufa_model->getCoreOvertimeType();


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
				$data_payrollemployeeovertime = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);
				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeeovertime);
			}
			
			


			## CALCULATE SALARY TOTAL
			$data_payrollemployeemonthlydeduction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);

			/*print_r("<BR>");
			print_r("data_payrollemployeemonthlydeduction");
			print_r($data_payrollemployeemonthlydeduction);*/

			$payroll_monthly_deduction_total = 0;

			if (!empty($data_payrollemployeemonthlydeduction)){
				foreach ($data_payrollemployeemonthlydeduction as $keyMonthlyDeduction => $valMonthlyDeduction) {
					$payroll_monthly_deduction_total = $payroll_monthly_deduction_total + $valMonthlyDeduction['employee_deduction_subtotal'];
				}
			}
			


			$data_payrollemployeemonthlyhomeearly = $this->session->userdata('addarrayemployeehomeearly-'.$sesi['unique']);

			/*print_r("<BR>");
			print_r("data_payrollemployeemonthlyhomeearly");
			print_r($data_payrollemployeemonthlyhomeearly);*/

			$home_early_total_amount = 0;

			if (!empty($data_payrollemployeemonthlyhomeearly)){
				foreach ($data_payrollemployeemonthlyhomeearly as $keyMonthlyEarly => $valMonthlyEarly) {
					$home_early_total_amount = $home_early_total_amount + $valMonthlyEarly['employee_deduction_subtotal'];
				}
			}

			if ($payrollemployeebpjs['bpjs_status'] == 1){
				$bpjs_total_amount = 0;
			} else {
				$bpjs_total_amount = $payrollemployeebpjs['bpjs_total_amount'];
			}


			if ($premi_attendance_days > 0){
				$employee_premi_attendance_amount = 0;
			} else {
				$employee_premi_attendance_amount = $payrollemployeepremiattendance['employee_premi_attendance_amount'];
			}

			if ($premi_attendance_total_days > 0){
				$employee_premi_attendance_amount 		= 0;
				$employee_premi_attendance_deduction 	= $payrollemployeepremiattendance['employee_premi_attendance_amount'];
			}

			if ($employee_employment_status == 4){
				if ($employee_monthly_working_days < $default_working_days){
					$employee_premi_attendance_amount = 0;
				}
			}

			/*print_r("premi_attendance_days ");
			print_r($premi_attendance_days);
			print_r("<BR> ");

			print_r("premi_attendance_total_days ");
			print_r($premi_attendance_total_days);
			print_r("<BR> ");

			print_r("employee_employment_status ");
			print_r($employee_employment_status);
			print_r("<BR> ");

			print_r("employee_monthly_working_days ");
			print_r($employee_monthly_working_days);
			print_r("<BR> ");

			print_r("default_working_days ");
			print_r($default_working_days);
			print_r("<BR> ");

			print_r("employee_premi_attendance_amount ");
			print_r($employee_premi_attendance_amount);
			print_r("<BR> ");

			exit;*/

			$employee_monthly_salary_total = $payment_basic_salary_monthly + $payroll_monthly_allowance_total + $employee_overtime_amount_total + $employee_length_service_amount + $employee_premi_attendance_amount - $payroll_monthly_deduction_total - $employee_loan_amount - $home_early_total_amount - $bpjs_total_amount + $employee_monthly_bonus_amount + $employee_monthly_commission_amount - $employee_monthly_lost_item_amount + $employee_monthly_incentive_total_amount - $employee_monthly_deduction_premi_amount;

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
			print_r($employee_length_service_amount);
			print_r("<BR>");
			print_r("employee_premi_attendance_amount ");
			print_r($employee_premi_attendance_amount);
			print_r("<BR>");
			print_r("employee_incentive_amount ");
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
			exit;*/

			

			/*print_r("<BR>");
			print_r("employee_premi_attendance_amount ");
			print_r($payrollemployeepremiattendance['employee_premi_attendance_amount']);
			print_r("<BR>");*/

			$data_payrollemployeemonthly = array(
				'employee_monthly_id'						=> date("YmdHis"),
				'employee_id' 								=> $employee_id,
				'employee_monthly_working_days'				=> $employee_monthly_working_days,
				'length_service_month'						=> $length_of_service_month,
				'employee_length_service_amount'			=> $employee_length_service_amount,
				'employee_length_saving_amount'				=> $employee_length_saving_amount,
				'employee_premi_attendance_amount'			=> $employee_premi_attendance_amount,
				'employee_premi_attendance_deduction'		=> $employee_premi_attendance_deduction,
				'employee_monthly_loan_total_amount'		=> $employee_loan_amount,
				'employee_monthly_salary_total_amount'		=> $employee_monthly_salary_total,
				'employee_monthly_bpjs_status'				=> $payrollemployeebpjs['bpjs_status'],
				'employee_monthly_bpjs_amount'				=> $payrollemployeebpjs['bpjs_total_amount'],
				'employee_monthly_bpjs_kesehatan_amount'	=> $payrollemployeebpjs['bpjs_kesehatan_amount'],
				'employee_monthly_bpjs_tenagakerja_amount'	=> $payrollemployeebpjs['bpjs_tenagakerja_amount'],
				'employee_monthly_premi_attendance'			=> $employee_premi_attendance_amount,
				'employee_monthly_bonus_total_amount'		=> $employee_monthly_bonus_amount,
				'employee_monthly_lost_item_total_amount'	=> $employee_monthly_lost_item_amount,
				'employee_monthly_commission_total_amount'	=> $employee_monthly_commission_amount,
				'employee_monthly_incentive_total_amount'	=> $employee_monthly_incentive_total_amount,
				'employee_monthly_deduction_premi_amount'	=> $employee_monthly_deduction_premi_amount,
				'payment_basic_salary_monthly'				=> $payment_basic_salary_monthly,
				'employee_employment_status'				=> $employee_employment_status,
			);

			/*print_r("data_payrollemployeemonthly ");
			print_r($data_payrollemployeemonthly);
			exit;*/

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
				$data_payrollleaverequest = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollleaverequest);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - ABSENCE
			$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
			$absence_id = "";
			$hroemployeeabsence 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeAbsence($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $absence_id);

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
				$data_payrollemployeeabsence = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeeabsence);
			}

			## PAYROLL EMPLOYEE MONTHLY DETAIL - PERMIT
			$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
			$permit_id = "";
			$hroemployeepermit 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);
			
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
				$data_payrollemployeepermit = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeepermit);
			}

			/*## PAYROLL EMPLOYEE MONTHLY DETAIL - WORKING DAY OFF
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
				$data_payrollemployeedayoff = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeedayoff);
			}*/
			
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
				$data_payrollemployeeovertimerequest = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeeovertimerequest);
			}


			## PAYROLL EMPLOYEE MONTHLY DETAIL - LATE
			$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);

			$late_id = "";
			$hroemployeelate 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeLate($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $late_id);
			
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
				$data_payrollemployeelate = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeelate);
			}


			## PAYROLL EMPLOYEE MONTHLY DETAIL - HOME EARLY
			$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);

			$home_early_id = "";
			$hroemployeehomeearly 		= $this->payrollemployeemonthlyilufa_model->getHROEmployeeHomeEarly($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $home_early_id);

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
				$data_payrollemployeehomeearlymonthly = $this->session->userdata('addpayrollemployeemonthly-'.$sesi['unique']);

				$this->session->set_userdata('addpayrollemployeemonthly-'.$sesi['unique'],$data_payrollemployeehomeearlymonthly);
			}

			$data['main_view']['hroemployeedata']				= $this->payrollemployeemonthlyilufa_model->getHROEmployeeData($employee_id);
			$data['main_view']['payrollemployeemonthly_data']	= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly_Data($employee_id);
			
			$data['main_view']['payrollemployeepayment']		= $payrollemployeepayment;

			$data['main_view']['payrollmonthlyperiod']			= $payrollmonthlyperiod;
			$data['main_view']['payrollemployeemonthly']		= $data_payrollemployeemonthly;
			$data['main_view']['payrollemployeeloan']			= $payrollemployeeloan;


			$data['main_view']['content']						= 'payrollemployeemonthlyilufa/listaddpayrollemployeemonthly_view';
			$this->load->view('mainpage_view',$data);
		}


		
		
		public function processAddPayrollEmployeeMonthly(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$employee_monthly_basic_salary					= $this->input->post('employee_monthly_basic_salary',true);



			$data = array(
				'employee_id' 								=> $this->input->post('employee_id',true),
				'bank_id' 									=> $this->input->post('bank_id',true),
				'region_id' 								=> $auth['region_id'],
				'branch_id' 								=> $auth['branch_id'],
				'location_id' 								=> $auth['location_id'],
				'payroll_employee_level' 					=> $auth['payroll_employee_level'],
				'employee_monthly_period'					=> $this->input->post('employee_monthly_period',true),
				'employee_monthly_bank_acct_name'			=> $this->input->post('employee_monthly_bank_acct_name',true),
				'employee_monthly_bank_acct_no'				=> $this->input->post('employee_monthly_bank_acct_no',true),
				'employee_monthly_date'						=> tgltodb($this->input->post('employee_monthly_date',true)),
				'employee_monthly_start_date'				=> tgltodb($this->input->post('employee_monthly_start_date',true)),
				'employee_monthly_end_date'					=> tgltodb($this->input->post('employee_monthly_end_date',true)),
				'employee_employment_status'				=> $this->input->post('employee_employment_status',true),
				'employee_monthly_basic_salary'				=> $this->input->post('employee_monthly_basic_salary',true),
				'employee_monthly_basic_salary_amount'		=> $this->input->post('employee_monthly_basic_salary_amount',true),
				'employee_monthly_basic_daily_salary'		=> $this->input->post('employee_monthly_basic_daily_salary',true),
				'employee_monthly_basic_overtime'			=> $this->input->post('employee_monthly_basic_overtime',true),
				'employee_monthly_working_days'				=> $this->input->post('employee_monthly_working_days',true),
				'employee_monthly_allowance_total_amount'	=> $this->input->post('employee_monthly_allowance_total_amount',true),
				'employee_monthly_deduction_total_amount'	=> $this->input->post('employee_monthly_deduction_total_amount',true),
				'employee_monthly_overtime_total_amount'	=> $this->input->post('employee_monthly_overtime_total_amount',true),
				'employee_monthly_home_early_total_amount'	=> $this->input->post('employee_monthly_home_early_total_amount',true),
				'employee_monthly_bpjs_amount'				=> $this->input->post('employee_monthly_bpjs_amount',true),
				'employee_monthly_bpjs_status'				=> $this->input->post('employee_monthly_bpjs_status',true),
				'employee_monthly_length_service_month'		=> $this->input->post('employee_monthly_length_service_month',true),
				'employee_monthly_length_service_amount'	=> $this->input->post('employee_monthly_length_service_amount',true),
				'employee_monthly_length_saving_amount'		=> $this->input->post('employee_monthly_length_saving_amount',true),
				'employee_monthly_premi_attendance_amount'	=> $this->input->post('employee_monthly_premi_attendance_amount',true),
				'employee_monthly_allowance_other'			=> $this->input->post('employee_monthly_allowance_other',true),
				'employee_monthly_allowance_description'	=> $this->input->post('employee_monthly_allowance_description',true),
				'employee_monthly_deduction_other'			=> $this->input->post('employee_monthly_deduction_other',true),
				'employee_monthly_deduction_description'	=> $this->input->post('employee_monthly_deduction_description',true),
				'employee_monthly_loan_total_amount'		=> $this->input->post('employee_monthly_loan_total_amount',true),
				'employee_monthly_bonus_total_amount'		=> $this->input->post('employee_monthly_bonus_total_amount',true),
				'employee_monthly_incentive_total_amount'	=> $this->input->post('employee_monthly_incentive_total_amount',true),
				'employee_monthly_lost_item_total_amount'	=> $this->input->post('employee_monthly_lost_item_total_amount',true),
				'employee_monthly_commission_total_amount'	=> $this->input->post('employee_monthly_commission_total_amount',true),
				'employee_monthly_deduction_premi_amount'	=> $this->input->post('employee_monthly_deduction_premi_amount',true),
				'employee_monthly_salary_total_amount'		=> $this->input->post('employee_monthly_salary_total_amount',true),
				'data_state'								=> 0,
				'created_id'								=> $auth['user_id'],
				'created_on'								=> date("Y-m-d H:i:s"),
			);

			$session_home_early			= $this->session->userdata('addarrayemployeehomeearly-'.$unique['unique']);
			$session_overtime			= $this->session->userdata('addarrayemployeeovertime-'.$unique['unique']);
			$session_deduction			= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
			$session_allowance			= $this->session->userdata('addarrayemployeeallowance-'.$unique['unique']);
			$session_loan				= $this->session->userdata('addarrayemployeeloan-'.$unique['unique']);

			$session_leaverequest		= $this->session->userdata('addarrayemployeeleaverequest-'.$unique['unique']);			
			$session_dayoff				= $this->session->userdata('addarrayemployeedayoff-'.$unique['unique']);			
			$session_overtimerequest	= $this->session->userdata('addarrayemployeeovertimerequest-'.$unique['unique']);	
			$session_homeearlymonthly	= $this->session->userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);	
			$session_permit				= $this->session->userdata('addarrayemployeepermit-'.$unique['unique']);
			$session_absence			= $this->session->userdata('addarrayemployeeabsence-'.$unique['unique']);
			$session_late				= $this->session->userdata('addarrayemployeelate-'.$unique['unique']);

			$session_bonus				= $this->session->userdata('addarrayemployeebonus-'.$unique['unique']);
			$session_commission			= $this->session->userdata('addarrayemployeecommission-'.$unique['unique']);
			$session_incentive			= $this->session->userdata('addarrayemployeeincentive-'.$unique['unique']);
			$session_lostitem			= $this->session->userdata('addarrayemployeelostitem-'.$unique['unique']);
			$session_deductionpremi		= $this->session->userdata('addarrayemployeedeductionpremi-'.$unique['unique']);

			/*print_r("data ");
			print_r($data);
			print_r("<BR>");
			exit;*/

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
			print_r("session_loan ");
			print_r($session_loan);
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
				if($this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthly($data)){
					$employee_monthly_id = $this->payrollemployeemonthlyilufa_model->getEmployeeMonthlyID($data['created_on'], $data['created_id']);

					print_r("employee_monthly_id");
					print_r($employee_monthly_id);
					$data_monthly_saving = array(
						'employee_monthly_id'					=> $employee_monthly_id,
						'employee_id'							=> $data['employee_id'],
						'employee_monthly_period'				=> $data['employee_monthly_period'],
						'employee_monthly_length_saving_amount'	=> $data['employee_monthly_length_saving_amount'],
						'data_state'							=> 0,
						'created_id'							=> $data['created_id'],
						'created_on'							=> $data['created_on']
					);
					$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlySaving($data_monthly_saving);
					 

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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyEarly($data_home_early);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyOvertime($data_overtime);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyDeduction($data_deduction);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyAllowance($data_allowance);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyLeave($data_leaverequest);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyDayOff($data_dayoff);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyOvertimeRequest($data_overtimerequest);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyHomeEarly($data_homeearlymonthly);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyPermit($data_permit);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyAbsence($data_absence);
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
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyLate($data_late);
						}
					}

					if(!empty($session_loan)){
						foreach($session_loan as $key=>$val){
							$data_loan = array(
								'employee_monthly_id'				=> $employee_monthly_id,
								'employee_id'						=> $data['employee_id'],
								'employee_monthly_period'			=> $data['employee_monthly_period'],
								'loan_type_id'						=> $val['loan_type_id'],
								'employee_loan_item_amount'			=> $val['employee_loan_item_amount'],
								'employee_loan_item_period'			=> $val['employee_loan_item_period'],
								'data_state'						=> 0,
								'created_id'						=> $data['created_id'],
								'created_on'						=> $data['created_on']
							);
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyLoan($data_loan);
						}
					}

					if(!empty($session_bonus)){
						foreach($session_bonus as $key=>$val){
							$data_bonus = array(
								'employee_monthly_id'					=> $employee_monthly_id,
								'employee_id'							=> $data['employee_id'],
								'bonus_id'								=> $val['bonus_id'],
								'employee_monthly_period'				=> $data['employee_monthly_period'],
								'employee_monthly_bonus_amount'			=> $val['employee_monthly_bonus_amount'],
								'employee_monthly_bonus_description'	=> $val['employee_monthly_bonus_description'],
								'data_state'							=> 0,
								'created_id'							=> $data['created_id'],
								'created_on'							=> $data['created_on']
							);
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyBonus($data_bonus);
						}
					}

					if(!empty($session_lostitem)){
						foreach($session_lostitem as $key=>$val){
							$data_lostitem = array(
								'employee_monthly_id'						=> $employee_monthly_id,
								'employee_id'								=> $data['employee_id'],
								'lost_item_id'								=> $val['lost_item_id'],
								'employee_monthly_period'					=> $data['employee_monthly_period'],
								'employee_monthly_lost_item_amount'			=> $val['employee_monthly_lost_item_amount'],
								'employee_monthly_lost_item_description'	=> $val['employee_monthly_lost_item_description'],
								'data_state'								=> 0,
								'created_id'								=> $data['created_id'],
								'created_on'								=> $data['created_on']
							);
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyLostItem($data_lostitem);
						}
					}

					if(!empty($session_incentive)){
						foreach($session_incentive as $key=>$val){
							$data_incentive = array(
								'employee_monthly_id'						=> $employee_monthly_id,
								'employee_id'								=> $data['employee_id'],
								'incentive_id'								=> $data['incentive_id'],
								'employee_monthly_period'					=> $data['employee_monthly_period'],
								'employee_monthly_omzet_target'				=> $val['employee_omzet_target'],
								'employee_monthly_omzet_achievement'		=> $val['employee_omzet_achievement'],
								'employee_monthly_omzet_branch_amount'		=> $val['employee_omzet_branch_amount'],
								'employee_monthly_omzet_group_amount'		=> $val['employee_omzet_group_amount'],
								'employee_monthly_omzet_individual_amount'	=> $val['employee_omzet_individual_amount'],
								'employee_monthly_omzet_total_amount'		=> $val['employee_omzet_total_amount'],
								'data_state'								=> 0,
								'created_id'								=> $data['created_id'],
								'created_on'								=> $data['created_on']
							);
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyIncentive($data_incentive);
						}
					}


					if(!empty($session_commission)){
						foreach($session_commission as $key=>$val){
							$data_commission = array(
								'employee_monthly_id'						=> $employee_monthly_id,
								'employee_id'								=> $data['employee_id'],
								'employee_monthly_period'					=> $data['employee_monthly_period'],
								'employee_monthly_commission_omzet_mmc'		=> $val['employee_commission_omzet_mmc'],
								'employee_monthly_commission_quantity_mmc'	=> $val['employee_commission_quantity_mmc'],
								'employee_monthly_commission_omzet_acc'		=> $val['employee_commission_omzet_acc'],
								'employee_monthly_commission_total_omzet'	=> $val['employee_commission_total_omzet'],
								'employee_monthly_commission_amount_mmc'	=> $val['employee_commission_amount_mmc'],
								'employee_monthly_commission_amount_acc'	=> $val['employee_commission_amount_acc'],
								'employee_monthly_commission_total_amount'	=> $val['employee_commission_total_amount'],
								'data_state'								=> 0,
								'created_id'								=> $data['created_id'],
								'created_on'								=> $data['created_on']
							);
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyCommission($data_commission);
						}
					}

					if(!empty($session_deductionpremi)){
						foreach($session_deductionpremi as $key=>$val){
							$data_deductionpremi = array(
								'employee_monthly_id'							=> $employee_monthly_id,
								'employee_id'									=> $data['employee_id'],
								'premi_attendance_id'							=> $val['premi_attendance_id'],
								'employee_monthly_period'						=> $data['employee_monthly_period'],
								'employee_monthly_deduction_premi_amount'		=> $val['employee_monthly_deduction_premi_amount'],
								'employee_monthly_deduction_premi_description'	=> $val['employee_monthly_deduction_premi_description'],
								'data_state'									=> 0,
								'created_id'									=> $data['created_id'],
								'created_on'									=> $data['created_on']
							);
							$this->payrollemployeemonthlyilufa_model->saveNewPayrollEmployeeMonthlyDeductionPremi($data_deductionpremi);
						}
					}



					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollEmployeeMonthly.processAddPayrollEmployeeMonthly',$auth['user_id'],'Add New Employee Monthly');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Employee Monthly Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addpayrollemployeemonthly');

					$this->session->unset_userdata('addarrayemployeehomeearly-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeovertime-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeededuction-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeallowance-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeloan-'.$unique['unique']);

					$this->session->unset_userdata('addarrayemployeeleaverequest-'.$unique['unique']);			
					$this->session->unset_userdata('addarrayemployeedayoff-'.$unique['unique']);			
					$this->session->unset_userdata('addarrayemployeeovertimerequest-'.$unique['unique']);	
					$this->session->unset_userdata('addarrayemployeehomeearlymonthly-'.$unique['unique']);	
					$this->session->unset_userdata('addarrayemployeepermit-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeeabsence-'.$unique['unique']);
					$this->session->unset_userdata('addarrayemployeelate-'.$unique['unique']);

					$this->session->unset_userdata('Addpayrollemployeemonthly');
					redirect('payrollemployeemonthlyilufa/addPayrollEmployeeMonthly/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Employee Monthly UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addpayrollemployeemonthly',$data);
					redirect('payrollemployeemonthlyilufa/addPayrollEmployeeMonthly/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addpayrollemployeemonthly',$data);
				redirect('payrollemployeemonthlyilufa/addPayrollEmployeeMonthly/'.$data['employee_id']);
			}
		}

		public function deletePayrollEmployeeMonthly_Data(){
			$employee_id 			= $this->uri->segment(3);
			$employee_monthly_id  	= $this->uri->segment(4);

			if($this->payrollemployeemonthlyilufa_model->deletePayrollEmployeeMonthly_Data($employee_monthly_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.payrollEmployeeMonthly.deletePayrollEmployeeMonthly_Data',$employee_monthly_id,'Delete Payroll Employee Monthly');
				$msg = "<div class='alert alert-success'>                
							Delete Data Payroll Employee Monthly Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeemonthly/addPayrollEmployeeMonthly/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Payroll Employee Monthly UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollemployeemonthlyilufa/addPayrollEmployeeMonthly/'.$employee_id);
			}
		}

		public function detailPayrollEmployeeMonthly(){
			$employee_monthly_id											= $this->uri->segment(3);

			$data['main_view']['payrollemployeemonthly']					= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyabsence']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyAbsence_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyallowance']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyAllowance_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlydayoff']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyDayOff_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlydeduction']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyDeduction_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyearly']				= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyEarly_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyhomeearly']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyHomeEarly_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlylate']				= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyLate_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyleave']				= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyLeave_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyovertime']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyOvertime_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlyovertimerequest']	= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyOvertimeRequest_Detail($employee_monthly_id);

			$data['main_view']['payrollemployeemonthlypermit']			= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyPermit_Detail($employee_monthly_id);

			$data['main_view']['content']								='payrollemployeemonthlyilufa/formdetailpayrollemployeemonthly_view';
			$this->load->view('mainpage_view',$data);
		} 

		public function receiptPayrollEmployeeMonthly(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$data['main_view']['payrollemployeemonthlyperiod']	= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyPeriod($region_id, $branch_id, $location_id, $payroll_employee_level);

			$data['main_view']['content']						= 'payrollemployeemonthlyilufa/listpayrollemployeemonthlyperiod_view';

			$this->load->view('mainpage_view',$data);
		} 

		public function printSalaryReceipt(){
			$employee_monthly_period				= $this->uri->segment(3);

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

			$payrollemployeemonthly		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly($employee_monthly_period);

			/*print_r("payrollemployeemonthly ");
			print_r($payrollemployeemonthly);*/
			/*exit;*/

			

			// -----------------------------------------------------------------------------

			/*$tbl = 
			"<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\">
			    <tr style=\"background-color:#632523;color:#FFFFFF;\">
			        <td><div style=\"text-align: center; font-size:18px; font-weight:bold\">KECERDASAN INTELEKTUAL</div></td>
			    </tr>
			</table>";
			

			$pdf->writeHTML($tbl, true, false, false, false, '');*/

			$tbl1 = 
				"<table cellspacing=\"3\" cellpadding=\"1\" border=\"0\">";

			$tbl2 = '';
			$total_intellectual = 0;
			foreach($payrollemployeemonthly as $key=>$val){
				if ($val['employee_employment_status'] == 1){
					$basic_salary_text 				= "Gaji Pokok";
					$basic_salary_operator 			= "";
					$employee_monthly_working_days 	= "";
					$employee_monthly_basic_salary 	= "";
				} else if ($val['employee_employment_status'] == 2){
					$basic_salary_text 				= "Gaji Harian";
					$basic_salary_operator 			= "X";
					$employee_monthly_working_days 	= $val['employee_monthly_working_days'];
					$employee_monthly_basic_salary 	= nominal($val['employee_monthly_basic_salary']);
				} else if ($val['employee_employment_status'] == 3){
					$basic_salary_text 				= "Gaji Pokok";
					$basic_salary_operator 			= "";
					$employee_monthly_working_days 	= "";
					$employee_monthly_basic_salary 	= "";
				} else if ($val['employee_employment_status'] == 4){
					$basic_salary_text 				= "Gaji Pokok";
					$basic_salary_operator 			= "";
					$employee_monthly_working_days 	= "";
					$employee_monthly_basic_salary 	= "";
				}

				$tbl2 .= 
					"		<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
					        	<tr>
							        <td width=\"465\" colspan = \"7\"><div style=\"text-align: center; font-size:12px; font-weight:bold\">iLuFA DISTRIBUSINDO</div></td>
							    </tr>
							    <tr>
							         <td width=\"465\" colspan = \"7\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">Jl. Siwalan 45 Kerten Laweyan Solo, Telp. 0271-7463271</div></td>
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
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Cabang</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['branch_name']."</div></td>
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

								$payrollemployeemonthlyallowance = $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthlyAllowance_Detail($val['employee_id'], $employee_monthly_period);

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
								}

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
			$filename = 'IST Test '.$testingParticipantData['participant_name'].'.pdf';
			$pdf->Output($filename, 'I');
		}


		public function printSalaryReceipt2(){
			$employee_monthly_period				= $this->uri->segment(3);

			// Include the main TCPDF library (search for installation path).
			require_once('TCPDF/config/tcpdf_config.php');
			require_once('TCPDF/tcpdf.php');
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
			$pdf->AddPage();

			/*$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);*/

			$pdf->SetFont('helvetica', '', 10);

			// ---------------------------------------------------------

			$payrollemployeemonthly		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly($employee_monthly_period);

			print_r("payrollemployeemonthly ");
			print_r($payrollemployeemonthly);
			exit;

			

			// -----------------------------------------------------------------------------

			/*$tbl = 
			"<table cellspacing=\"0\" cellpadding=\"3\" border=\"0\">
			    <tr style=\"background-color:#632523;color:#FFFFFF;\">
			        <td><div style=\"text-align: center; font-size:18px; font-weight:bold\">KECERDASAN INTELEKTUAL</div></td>
			    </tr>
			</table>";
			

			$pdf->writeHTML($tbl, true, false, false, false, '');*/

			$tbl1 = 
				"<table cellspacing=\"3\" cellpadding=\"1\" border=\"0\">";

			$tbl2 = '';
			$total_intellectual = 0;
			foreach($payrollemployeemonthly as $key => $val){
				



				$tbl2 .= 
					"<tr>
						<td width=\"480\">
					        <table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
					        	<tr>
							        <td width=\"465\" colspan = \"6\"><div style=\"text-align: center; font-size:12px; font-weight:bold\">iLuFA DISTRIBUSINDO</div></td>
							    </tr>
							    <tr>
							         <td width=\"465\" colspan = \"6\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">Jl. Gatot Subroto 123 Singosaren-Solo, Telp. 0271-624168</div></td>
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
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Cabang</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['branch_name']."</div></td>
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
							        <td width=\"465\" colspan = \"6\"><div style=\"text-align: center; font-size:12px; font-weight:bold\"></div></td>
							    </tr>
							    <tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$basic_salary_text."</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_basic_salary'])."</div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_basic_salary'])."</div></td>
							    </tr>
							    <tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Gaji Pokok</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_basic_salary'])."</div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_basic_salary'])."</div></td>
							    </tr>
							</table>
							<br>
						</td>
						<td width=\"480\">
					        <table cellspacing=\"0\" cellpadding=\"5\" border=\"1\">
							    <tr>
							        <td width=\"200\"><div style=\"text-align: center; font-size:14px; font-weight:bold\">Period</div></td>
							        <td width=\"100\"><div style=\"text-align: center; font-size:14px; font-weight:bold\">Employee Name</div></td>
							        <td width=\"105\"><div style=\"text-align: center; font-size:14px; font-weight:bold\">Employee Salary Total</div></td>
							    </tr>
								<tr>
									<td>".$val['employee_monthly_id']."</td>
									<td>".$val['employee_name']."</td>
									<td ><div style=\"text-align: center\">".$val['employee_monthly_salary_total']."</span></td>
								</tr>
							</table>
						</td>
					</tr>";
			}	
			
			$tbl3 = 
				"</table>";
			// ---------------------------------------------------------
			$pdf->writeHTML($tbl1.$tbl2.$tbl3, true, false, false, false, '');
			//Close and output PDF document
			$filename = 'IST Test '.$testingParticipantData['participant_name'].'.pdf';
			$pdf->Output($filename, 'I');
		}

		public function showdetail(){
			$auth 											= $this->session->userdata('auth');
			$user_id 										= $auth['user_id'];
			$region_id 										= $auth['region_id'];
			$branch_id 										= $auth['branch_id'];
			$location_id 									= $auth['location_id'];
			$payroll_employee_level 						= $auth['payroll_employee_level'];
			$branch_status 									= $auth['branch_status'];

			$systemuserbranch								= $this->payrollemployeemonthlyilufa_model->getSystemUserBranch($user_id);

			$employee_monthly_period						= $this->uri->segment(3);

			$data['main_view']['payrollemployeemonthly']	= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly($region_id, $systemuserbranch, $branch_status, $auth['branch_id'], $payroll_employee_level, $employee_monthly_period);

			$data['main_view']['content']					= 'payrollemployeemonthlyilufa/formdetailperiodpayrollemployeemonthly_view';
			$this->load->view('mainpage_view',$data);
		}

		public function exportPayrollEmployeeMonthlyRecap(){
			$auth 											= $this->session->userdata('auth');
			$user_id 										= $auth['user_id'];
			$region_id 										= $auth['region_id'];
			$branch_id 										= $auth['branch_id'];
			$location_id 									= $auth['location_id'];
			$payroll_employee_level 						= $auth['payroll_employee_level'];
			$branch_status 									= $auth['branch_status'];

			$systemuserbranch								= $this->payrollemployeemonthlyilufa_model->getSystemUserBranch($user_id);

			$employee_monthly_period						= $this->uri->segment(3);

			$payrollemployeemonthly							= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly($region_id, $systemuserbranch, $branch_status, $auth['branch_id'], $payroll_employee_level, $employee_monthly_period);
			
			if(!empty($payrollemployeemonthly)){
				ob_end_clean();
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("iLuFA")
									 ->setLastModifiedBy("iLuFA")
									 ->setTitle("Payroll Employee Monthly Total")
									 ->setSubject("")
									 ->setDescription("Payroll Employee Monthly Total")
									 ->setKeywords("Payroll, Employee, Monthly, Total")
									 ->setCategory("Payroll Employee Monthly Total");
									 
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

				$this->excel->getActiveSheet()->mergeCells("B1:U1");
		
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:U3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:U3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:U3')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('B1',"Payroll Employee Monthly Total Period ".$employee_monthly_period);

				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Monthly Period");
				$this->excel->getActiveSheet()->setCellValue('D3',"Employee Name");
				$this->excel->getActiveSheet()->setCellValue('E3',"Branch Name");
				$this->excel->getActiveSheet()->setCellValue('F3',"Section Name");
				$this->excel->getActiveSheet()->setCellValue('G3',"Job Title Name");	
				$this->excel->getActiveSheet()->setCellValue('H3',"Basic Salary");
				$this->excel->getActiveSheet()->setCellValue('I3',"Working Days");
				$this->excel->getActiveSheet()->setCellValue('J3',"Allowance Total");
				$this->excel->getActiveSheet()->setCellValue('K3',"Deduction Total");	
				$this->excel->getActiveSheet()->setCellValue('L3',"BPJS");
				$this->excel->getActiveSheet()->setCellValue('M3',"Length Service");
				$this->excel->getActiveSheet()->setCellValue('N3',"Length Saving");
				$this->excel->getActiveSheet()->setCellValue('O3',"Premi Attendance");
				$this->excel->getActiveSheet()->setCellValue('P3',"Incentive Total");
				$this->excel->getActiveSheet()->setCellValue('Q3',"Bonus Total");
				$this->excel->getActiveSheet()->setCellValue('R3',"Commission Total");
				$this->excel->getActiveSheet()->setCellValue('S3',"Lost Item Total");
				$this->excel->getActiveSheet()->setCellValue('T3',"Deduction Premi");
				$this->excel->getActiveSheet()->setCellValue('U3',"Salary Total");

				$this->excel->getActiveSheet()->setCellValue('B4',"No");
				
				
				$m = 0;
				$j=4;
				$no=0;

				/*print_r("payrollemployeemonthly ");
				print_r($payrollemployeemonthly);
				exit;*/
				
				foreach($payrollemployeemonthly as $key=>$val){
					/*print_r("val ");
					print_r($val);
					print_r("<BR>");*/
					
					$no++;
					$this->excel->setActiveSheetIndex(0);
					$this->excel->getActiveSheet()->getStyle('B'.$j.':U'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$this->excel->getActiveSheet()->getStyle('B'.$j.':U'.$j)->getFont()->setSize(12);
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


					$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
					/*$this->excel->getActiveSheet()->setCellValue('B4',"No");*/
					$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['employee_monthly_period']);
					$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['employee_name']);
					$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['branch_name']);
					$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['section_name']);
					$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['job_title_name']);
					$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['employee_monthly_basic_salary_amount']);
					$this->excel->getActiveSheet()->setCellValue('I'.$j, $val['employee_monthly_working_days']);
					$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['employee_monthly_allowance_total_amount']);
					$this->excel->getActiveSheet()->setCellValue('K'.$j, $val['employee_monthly_deduction_total_amount']);
					$this->excel->getActiveSheet()->setCellValue('L'.$j, $val['employee_monthly_bpjs_amount']);
					$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['employee_monthly_length_service_amount']);
					$this->excel->getActiveSheet()->setCellValue('N'.$j, $val['employee_monthly_length_saving_amount']);
					$this->excel->getActiveSheet()->setCellValue('O'.$j, $val['employee_monthly_premi_attendance_amount']);
					$this->excel->getActiveSheet()->setCellValue('P'.$j, $val['employee_monthly_incentive_total_amount']);
					$this->excel->getActiveSheet()->setCellValue('Q'.$j, $val['employee_monthly_bonus_total_amount']);
					$this->excel->getActiveSheet()->setCellValue('R'.$j, $val['employee_monthly_commission_total_amount']);
					$this->excel->getActiveSheet()->setCellValue('S'.$j, $val['employee_monthly_lost_item_total_amount']);
					$this->excel->getActiveSheet()->setCellValue('T'.$j, $val['employee_monthly_deduction_premi_amount']);
					$this->excel->getActiveSheet()->setCellValue('U'.$j, $val['employee_monthly_salary_total_amount']);
					
					
					$j++;
				}


				/*exit;*/
				$filename='Payroll_Employee_Monthly_Recap_Period.xls';

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

		public function exportPayrollEmployeeMonthlyPayroll(){
			$auth 											= $this->session->userdata('auth');
			$user_id 										= $auth['user_id'];
			$region_id 										= $auth['region_id'];
			$branch_id 										= $auth['branch_id'];
			$location_id 									= $auth['location_id'];
			$payroll_employee_level 						= $auth['payroll_employee_level'];
			$branch_status 									= $auth['branch_status'];

			$systemuserbranch								= $this->payrollemployeemonthlyilufa_model->getSystemUserBranch($user_id);

			$employee_monthly_period						= $this->uri->segment(3);

			$payrollemployeemonthly							= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly($region_id, $systemuserbranch, $branch_status, $auth['branch_id'], $payroll_employee_level, $employee_monthly_period);
			
			if(!empty($payrollemployeemonthly)){

				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("iLuFA")
									 ->setLastModifiedBy("iLuFA")
									 ->setTitle("Payroll Employee Monthly Bank")
									 ->setSubject("")
									 ->setDescription("Payroll Employee Monthly Bank")
									 ->setKeywords("Payroll, Employee, Monthly, Bank")
									 ->setCategory("Payroll Employee Monthly Bank");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
				$this->excel->getActiveSheet()->getPageMargins()->setTop(0.5);
				$this->excel->getActiveSheet()->getPageMargins()->setLeft(0.1);
				$this->excel->getActiveSheet()->getPageMargins()->setRight(0.1);
				$this->excel->getActiveSheet()->getPageMargins()->setBottom(0.1);
				$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);

				
				$m = 0;
				$j =1;
				$no =0;
				
				foreach($payrollemployeemonthly as $key=>$val){
					if(is_numeric($key)){
						$no++;
						$this->excel->setActiveSheetIndex(0);
						
						$this->excel->getActiveSheet()->setCellValue('A'.$j, $val['employee_name']);
						$this->excel->getActiveSheet()->setCellValue('B'.$j, $val['employee_monthly_bank_acct_no']);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['employee_monthly_salary_total_amount']);
					}else{
						continue;
					}
					
					$j++;
				}

				$filename='Payroll_Employee_Monthly_Bank_Period_'.$employee_monthly_period.'.xls';

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