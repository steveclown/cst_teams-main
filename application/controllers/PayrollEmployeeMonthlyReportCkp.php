<?php ob_start(); ?>
<?php
	set_time_limit(0);
	ini_set('memory_limit', '512M');

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

	Class PayrollEmployeeMonthlyReportCkp extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('PayrollEmployeeMonthlyReportCkp_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-payrollemployeemonthly');
			if(!is_array($sesi)){
				$sesi['employee_shift_id']			= '';
				$sesi['employee_monthly_period']	= '';
			}

			$data['Main_view']['scheduleemployeeshift']		= create_double($this->PayrollEmployeeMonthlyReportCkp_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
 
			$data['Main_view']['payrollmonthlyperiod']		= create_double($this->PayrollEmployeeMonthlyReportCkp_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['Main_view']['payrollemployeemonthly']	= $this->PayrollEmployeeMonthlyReportCkp_model->getPayrollEmployeeMonthly($region_id, $branch_id, $location_id, $sesi['employee_shift_id'], $sesi['employee_monthly_period']);

			$data['Main_view']['content']					= 'PayrollEmployeeMonthlyReportCkp/listPayrollEmployeeMonthlyReport_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_shift_id'			=> $this->input->post('employee_shift_id',true),	
				'employee_monthly_period'	=> $this->input->post('employee_monthly_period',true),
			);
			$this->session->set_userdata('filter-payrollemployeemonthly',$data);
			redirect('PayrollEmployeeMonthlyReportCkp');
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
			redirect('PayrollEmployeeMonthlyReportCkp');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollemployeemonthly-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayemployeeallowance-'.$sesi['unique']);
			redirect('PayrollEmployeeMonthlyReportCkp');
		}

		public function showPayrollEmployeeMonthlyRecap(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$employee_monthly_period 	= $this->uri->segment(3);

			$datapayroll = array (
				'location_id'				=> $location_id, 
				'employee_monthly_period'	=> $employee_monthly_period
			);

			$payrollemployeemonthlyitem	= $this->PayrollEmployeeMonthlyReportCkp_model->getPayrollEmployeeMonthlyItem_Detail($location_id, $employee_monthly_period); 

			/*print_r("payrollemployeemonthlyitem");
			print_r($payrollemployeemonthlyitem);
			print_r("<BR>");*/

			if (!empty($payrollemployeemonthlyitem)){
				foreach ($payrollemployeemonthlyitem as $keyItem => $valItem) {
					$unit_name = $this->PayrollEmployeeMonthlyReportCkp_model->getUnitName($valItem['unit_id']);

					$salary_total_unit_bank 	= $valItem['salary_total_unit_bank'];

					if (is_null($salary_total_unit_bank)){
						$salary_total_unit_bank = 0;						
					}

					$salary_total_unit_bpjs 	= $valItem['salary_total_unit_bpjs'];	

					if (is_null($salary_total_unit_bpjs)){
						$salary_total_unit_bpjs = 0;						
					}

					$salary_total_unit_no_bpjs 	= $valItem['salary_total_unit_no_bpjs'];

					if (is_null($salary_total_unit_no_bpjs)){
						$salary_total_unit_no_bpjs = 0;						
					}

					$salary_total_unit_cash 	= $valItem['salary_total_unit_cash'];

					if (is_null($salary_total_unit_cash)){
						$salary_total_unit_cash = 0;						
					}

					$additional_deduction_unit 	= $valItem['additional_deduction_unit'];

					if (is_null($additional_deduction_unit)){
						$additional_deduction_unit = 0;						
					}

					$meal_coupon_unit 			= $valItem['meal_coupon_unit'];

					if (is_null($meal_coupon_unit)){
						$meal_coupon_unit = 0;						
					}

					$bpjs_amount_unit 			= $valItem['bpjs_amount_unit'];

					if (is_null($bpjs_amount_unit)){
						$bpjs_amount_unit = 0;						
					}

					$total_salary_unit 			= $valItem['total_salary_unit'];

					if (is_null($total_salary_unit)){
						$total_salary_unit = 0;						
					}

					$subtotal_salary_unit = $salary_total_unit_bank + $salary_total_unit_bpjs + $salary_total_unit_no_bpjs + $salary_total_unit_cash;

					$data_recap[$keyItem] = array (
						'unit_id'					=> $valItem['unit_id'],
						'unit_name'					=> $unit_name,
						'salary_total_unit_bank'	=> $salary_total_unit_bank,
						'salary_total_unit_bpjs'	=> $salary_total_unit_bpjs,
						'salary_total_unit_no_bpjs'	=> $salary_total_unit_no_bpjs,
						'salary_total_unit_cash'	=> $salary_total_unit_cash,
						'subtotal_salary_unit'		=> $subtotal_salary_unit,
						'additional_deduction_unit'	=> $additional_deduction_unit,
						'meal_coupon_unit'			=> $meal_coupon_unit,
						'bpjs_amount_unit'			=> $bpjs_amount_unit,
						'total_salary_unit'			=> $total_salary_unit,
					);

					/*print_r("data_recap");
					print_r($data_recap);*/
				}
			}

			/*print_r("data_recap");
			print_r($data_recap);
			exit;*/

			$data['Main_view']['payrollemployeemonthlyrecap']	= $data_recap;

			$data['Main_view']['datapayroll']					= $datapayroll;
			
			$data['Main_view']['content']						= 'PayrollEmployeeMonthlyReportCkp/formrecapPayrollEmployeeMonthly_view';

			$this->load->view('MainPage_view',$data);
		}	


		public function exportPayrollEmployeeMonthlyRecap(){
			$location_id 				= $this->uri->segment(3);
			$employee_monthly_period 	= $this->uri->segment(4);
			$location_name 				= $this->PayrollEmployeeMonthlyReportCkp_model->getLocationName($location_id); 
			

			$payrollemployeemonthlyitem	= $this->PayrollEmployeeMonthlyReportCkp_model->getPayrollEmployeeMonthlyItem_Detail($location_id, $employee_monthly_period); 
			
			if(!empty($payrollemployeemonthlyitem)){
				foreach ($payrollemployeemonthlyitem as $keyItem => $valItem) {
					$unit_name = $this->PayrollEmployeeMonthlyReportCkp_model->getUnitName($valItem['unit_id']);

					$salary_total_unit_bank 	= $valItem['salary_total_unit_bank'];

					if (is_null($salary_total_unit_bank)){
						$salary_total_unit_bank = 0;						
					}

					$salary_total_unit_bpjs 	= $valItem['salary_total_unit_bpjs'];	

					if (is_null($salary_total_unit_bpjs)){
						$salary_total_unit_bpjs = 0;						
					}

					$salary_total_unit_no_bpjs 	= $valItem['salary_total_unit_no_bpjs'];

					if (is_null($salary_total_unit_no_bpjs)){
						$salary_total_unit_no_bpjs = 0;						
					}

					$salary_total_unit_cash 	= $valItem['salary_total_unit_cash'];

					if (is_null($salary_total_unit_cash)){
						$salary_total_unit_cash = 0;						
					}

					$additional_deduction_unit 	= $valItem['additional_deduction_unit'];

					if (is_null($additional_deduction_unit)){
						$additional_deduction_unit = 0;						
					}

					$meal_coupon_unit 			= $valItem['meal_coupon_unit'];

					if (is_null($meal_coupon_unit)){
						$meal_coupon_unit = 0;						
					}

					$bpjs_amount_unit 			= $valItem['bpjs_amount_unit'];

					if (is_null($bpjs_amount_unit)){
						$bpjs_amount_unit = 0;						
					}

					$total_salary_unit 			= $valItem['total_salary_unit'];

					if (is_null($total_salary_unit)){
						$total_salary_unit = 0;						
					}

					$subtotal_salary_unit = $salary_total_unit_bank + $salary_total_unit_bpjs + $salary_total_unit_no_bpjs + $salary_total_unit_cash;

					$data_recap[$keyItem] = array (
						'unit_id'					=> $valItem['unit_id'],
						'unit_name'					=> $unit_name,
						'salary_total_unit_bank'	=> $salary_total_unit_bank,
						'salary_total_unit_bpjs'	=> $salary_total_unit_bpjs,
						'salary_total_unit_no_bpjs'	=> $salary_total_unit_no_bpjs,
						'salary_total_unit_cash'	=> $salary_total_unit_cash,
						'subtotal_salary_unit'		=> $subtotal_salary_unit,
						'additional_deduction_unit'	=> $additional_deduction_unit,
						'meal_coupon_unit'			=> $meal_coupon_unit,
						'bpjs_amount_unit'			=> $bpjs_amount_unit,
						'total_salary_unit'			=> $total_salary_unit,
					);

					/*print_r("data_recap");
					print_r($data_recap);*/
				}

				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Cahaya Kharisma Plasindo")
									 ->setLastModifiedBy("PT. Cahaya Kharisma Plasindo")
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

				$this->excel->getActiveSheet()->mergeCells("B1:L1");
		
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:L3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:L3')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('B1',"Payroll Employee Monthly Total Period ".$employee_monthly_period);

				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Unit Name");
				$this->excel->getActiveSheet()->setCellValue('D3',"Total Bank");
				$this->excel->getActiveSheet()->setCellValue('E3',"With BPJS");
				$this->excel->getActiveSheet()->setCellValue('F3',"No BPJS");
				$this->excel->getActiveSheet()->setCellValue('G3',"Cash");	
				$this->excel->getActiveSheet()->setCellValue('H3',"Salary Subtotal");
				$this->excel->getActiveSheet()->setCellValue('I3',"Deduction");
				$this->excel->getActiveSheet()->setCellValue('J3',"Meal Coupon");
				$this->excel->getActiveSheet()->setCellValue('K3',"BPJS");	
				$this->excel->getActiveSheet()->setCellValue('L3',"Salary Total");

				
				$m = 0;
				$j=4;
				$no=0;
				
				foreach($data_recap as $key=>$val){
					if(is_numeric($key)){
						$no++;
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':L'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':L'.$j)->getFont()->setSize(12);
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

						$salary_total_unit_bank_total 		+= $val['salary_total_unit_bank'];
						$salary_total_unit_bpjs_total 		+= $val['salary_total_unit_bpjs'];
						$salary_total_unit_no_bpjs_total	+= $val['salary_total_unit_no_bpjs'];
						$salary_total_unit_cash_total 		+= $val['salary_total_unit_cash'];
						$subtotal_salary_unit_total 		+= $val['subtotal_salary_unit'];
						$additional_deduction_unit_total 	+= $val['additional_deduction_unit'];
						$meal_coupon_unit_total 			+= $val['meal_coupon_unit'];
						$bpjs_amount_unit_total 			+= $val['bpjs_amount_unit'];
						$total_salary_unit_total 			+= $val['total_salary_unit'];

						
						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['unit_name']);
						$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['salary_total_unit_bank']);
						$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['salary_total_unit_bpjs']);
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['salary_total_unit_no_bpjs']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['salary_total_unit_cash']);
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['subtotal_salary_unit']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, $val['additional_deduction_unit']);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['meal_coupon_unit']);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, $val['bpjs_amount_unit']);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $val['total_salary_unit']);
					}else{
						continue;
					}
					
					$j++;
				}

				$this->excel->getActiveSheet()->setCellValue('B'.$j, "");
				$this->excel->getActiveSheet()->setCellValue('C'.$j, "TOTAL");
				$this->excel->getActiveSheet()->setCellValue('D'.$j, $salary_total_unit_bank_total);
				$this->excel->getActiveSheet()->setCellValue('E'.$j, $salary_total_unit_bpjs_total);
				$this->excel->getActiveSheet()->setCellValue('F'.$j, $salary_total_unit_no_bpjs_total);
				$this->excel->getActiveSheet()->setCellValue('G'.$j, $salary_total_unit_cash_total);
				$this->excel->getActiveSheet()->setCellValue('H'.$j, $subtotal_salary_unit_total);
				$this->excel->getActiveSheet()->setCellValue('I'.$j, $additional_deduction_unit_total);
				$this->excel->getActiveSheet()->setCellValue('J'.$j, $meal_coupon_unit_total);
				$this->excel->getActiveSheet()->setCellValue('K'.$j, $bpjs_amount_unit_total);
				$this->excel->getActiveSheet()->setCellValue('L'.$j, $total_salary_unit_total);

				$filename='Payroll_Employee_Monthly_Recap_Period'.'_'.$location_name.'_'.$employee_monthly_period.'.xls';

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
			$location_id				= $this->uri->segment(3);
			$employee_monthly_period	= $this->uri->segment(4);
			$unit_id					= $this->uri->segment(5);

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

			$payrollemployeemonthly		= $this->PayrollEmployeeMonthlyReportCkp_model->getPayrollEmployeeMonthlyAll_Detail($location_id, $employee_monthly_period, $unit_id);

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
				$salary_daily 		= $val['employee_basic_salary'] + $val['employee_monthly_service_amount'];
				$salary_daily_total = $val['employee_monthly_working_days'] * $salary_daily;

				$tbl2 .= 
					"<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">
			        	<tr>
					        <td width=\"465\" colspan = \"7\"><div style=\"text-align: center; font-size:12px; font-weight:bold\">PT. CAHAYA KHARISMA PLASINDO</div></td>
					    </tr>
					    <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Kode Karyawan</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['employee_code']."</div></td>
					        <td width=\"65\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Periode</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"120\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".tgltoview($val['employee_monthly_start_date'])." - ".tgltoview($val['employee_monthly_end_date'])."</div></td>
					    </tr>
					    <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Nama Karyawan</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['employee_name']."</div></td>
					        <td width=\"65\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">No Rek.</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"120\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['employee_monthly_bank_acct_no']."</div></td>
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
					        <td width=\"65\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Unit</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"120\" colspan = \"2\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">".$val['unit_name']."</div></td>
					    </tr>
					    <tr>
					        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Gaji Harian</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
					        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($salary_daily)."</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">x</div></td>
					        <td width=\"50\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".$val['employee_monthly_working_days']."</div></td>
					        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
					        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($salary_daily_total)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
					    </tr>";

					    if ($val['employee_monthly_allowance_amount'] == 0 || is_null($val['employee_monthly_allowance_amount'])){

					    	$tbl2 .= 
						    	"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
						} else {
							$tbl2 .= 
						    	"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Tunjangan</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_allowance_amount'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
							    </tr>";
						}

						if ($val['employee_monthly_attendance_amount'] == 0 || is_null($val['employee_monthly_attendance_amount'])){

							$tbl2 .=   
							    "<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
						} else {
							$tbl2 .=   
							    "<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Premi Kehadiran</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_attendance_amount'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
							    </tr>";
						}

						if ($val['employee_monthly_overtime_amount'] == 0 || is_null($val['employee_monthly_overtime_amount'])){
							$tbl2 .= "
							    <tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
						} else {
							$tbl2 .= "
							    <tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Lembur</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_overtime_amount'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
							    </tr>";
						}
						
					    if ($val['employee_monthly_delivery_amount'] == 0 || is_null($val['employee_monthly_delivery_amount'])){
					    	$tbl2 .= 
					    		"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
					    } else{
					    	$tbl2 .= 
					    		"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Pengiriman</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
					    }
					    
					    if ($val['employee_monthly_bpjs_amount'] == 0 || is_null($val['employee_monthly_bpjs_amount'])){
					    	$tbl2 .= 
						    	"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
					    } else {
					    	$tbl2 .= 
						    	"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">BPJS</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
					    }
					    
					    if ($val['employee_monthly_additional_deduction_amount'] == 0 || is_null($val['employee_monthly_additional_deduction_amount'])){
					    	$tbl2 .= 
						    	"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
					    } else {
					    	$tbl2 .= 
						    	"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Potongan</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_additional_deduction_amount'])."</div></td>
							    </tr>";
					    }
					    
					    if ($val['employee_monthly_meal_coupon_amount'] == 0 || is_null($val['employee_monthly_meal_coupon_amount'])){
					    	$tbl2 .= 
					    		"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							    </tr>";
					    } else {
					    	$tbl2 .= 
					    		"<tr>
							        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Kupon Makan</div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
							        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
							        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
							        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_meal_coupon_amount'])."</div></td>
							    </tr>";
					    }
					    
					    $tbl2 .= 
						    "<tr>
						        <td width=\"100\"><div style=\"text-align: left; font-size:10px; font-weight:bold\">Total Gaji</div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">:</div></td>
						        <td width=\"150\" ><div style=\"text-align: right; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"15\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">=</div></td>
						        <td width=\"120\"><div style=\"text-align: right; font-size:10px; font-weight:bold\">".nominal($val['employee_monthly_salary_total'])."</div></td>
						    </tr>
						    <tr>
						        <td width=\"265\" colspan=\"3\" height=\"50\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						        <td width=\"200\" colspan=\"4\"><div style=\"text-align: left; font-size:10px; font-weight:bold\"></div></td>
						    </tr>
						    <tr>
						        <td width=\"265\" colspan=\"3\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">KEUANGAN</div></td>
						        <td width=\"200\" colspan=\"4\"><div style=\"text-align: center; font-size:10px; font-weight:bold\">".$val['employee_name']."</div></td>
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

		public function exportPayrollEmployeeMonthlyPayroll(){
			$location_id 				= $this->uri->segment(3);
			$employee_monthly_period 	= $this->uri->segment(4);

			$location_name 				= $this->PayrollEmployeeMonthlyReportCkp_model->getLocationName($location_id); 
			

			$payrollemployeemonthlyitem	= $this->PayrollEmployeeMonthlyReportCkp_model->getPayrollEmployeeMonthlyAll_Payroll($location_id, $employee_monthly_period); 
			
			if(!empty($payrollemployeemonthlyitem)){

				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Cahaya Kharisma Plasindo")
									 ->setLastModifiedBy("PT. Cahaya Kharisma Plasindo")
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
				
				foreach($payrollemployeemonthlyitem as $key=>$val){
					if(is_numeric($key)){
						$no++;
						$this->excel->setActiveSheetIndex(0);
						
						$this->excel->getActiveSheet()->setCellValue('A'.$j, $val['employee_name']);
						$this->excel->getActiveSheet()->setCellValue('B'.$j, $val['employee_monthly_bank_acct_no']);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['employee_monthly_salary_total']);
					}else{
						continue;
					}
					
					$j++;
				}

				$filename='Payroll_Employee_Monthly_Bank_Period'.'_'.$location_name.'_'.$employee_monthly_period.'.xls';

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