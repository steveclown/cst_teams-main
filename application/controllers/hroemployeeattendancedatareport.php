<?php
	class hroemployeeattendancedatareport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeattendancedatareport_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeeattendancedatareport');
			if(!is_array($sesi)){
				$sesi['employee_shift_id']		= '';
				$sesi['employee_id']			= '';
				$sesi['start_date']				= date("Y-m-d");
				$sesi['end_date']				= date("Y-m-d");
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			/*$payrollmonthlyperiod = $this->hroemployeeattendancedatareport_model->getPayrollMonthlyPeriod_Detail($sesi['employee_monthly_period']);

			if (!empty($payrollmonthlyperiod)){
				$start_date 	= $payrollmonthlyperiod['monthly_period_start_date'];
				$end_date 		= $payrollmonthlyperiod['monthly_period_end_date'];
			} else {
				$start_date 	= date("Y-m-d");
				$end_date 		= date("Y-m-d");
			}*/

			/*print_r("payrollmonthlyperiod ");
			print_r($payrollmonthlyperiod);
			print_r("<BR> ");

			print_r("start_date ");
			print_r($start_date);
			print_r("<BR> ");

			print_r("end_date ");
			print_r($end_date);
			print_r("<BR> ");*/

			$data['main_view']['scheduleemployeeshift']			= create_double($this->hroemployeeattendancedatareport_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');
			
			$data['main_view']['payrollmonthlyperiod']			= create_double($this->hroemployeeattendancedatareport_model->getPayrollMonthlyPeriod(), 'monthly_period', 'monthly_period_date');

			$data['main_view']['hroemployeeattendancedata']		= $this->hroemployeeattendancedatareport_model->getHROEmployeeAttendanceData_Detail($start_date, $end_date, $sesi['employee_shift_id'], $sesi['employee_id']);

			$data['main_view']['content']						= 'hroemployeeattendancedatareport/listhroemployeeattendancedatareport_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_shift_id'			=> $this->input->post('employee_shift_id',true),	
				'employee_id'				=> $this->input->post('employee_id',true),
				'start_date'				=> $this->input->post('start_date',true),
				'end_date'					=> $this->input->post('end_date',true),
			);
			$this->session->set_userdata('filter-hroemployeeattendancedatareport',$data);
			redirect('hroemployeeattendancedatareport');
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeattendancedatareport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeattendancedatareport-'.$unique['unique'],$sessions);
		}

		public function getScheduleEmployeeShiftItem(){
			$employee_shift_id = $this->input->post('employee_shift_id');

			$item = $this->hroemployeeattendancedatareport_model->getScheduleEmployeeShiftItem($employee_shift_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeattendancedatareport');
			$this->session->unset_userdata('filter-hroemployeeattendancedatareport');
			redirect('hroemployeeattendancedatareport');
		}

		public function processPrinting(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-hroemployeeattendancedatareport');

			if(!is_array($sesi)){
				$sesi['start_date']				= date('d-m-Y');
				$sesi['end_date']				= date('d-m-Y');
				$sesi['employee_shift_id']		= '0';
			}
			
			$start_date 		= tgltodb($sesi['start_date']);
			$end_date 			= tgltodb($sesi['end_date']);
			$employee_shift_id 	= $sesi['employee_shift_id'];

			$startdate1 		= strtotime('0 day', strtotime($start_date));
			$startdate 			= date("Y-m-d", $startdate1);
			$enddate1 			= strtotime('1 day', strtotime($end_date));
			$enddate 			= date("Y-m-d", $enddate1);

			$query_count = "";

			while ($startdate != $enddate){
				/*print_r("startdate ");
				print_r($startdate);
				print_r("<BR>");*/

				$day_log 		= "day_".date("d", strtotime($startdate));
				$period_log 	= date("Ym", strtotime($startdate));

				$day_status		= "D".date("d", strtotime($startdate));

				$query_count .= "(
					SELECT ".$day_log." FROM hro_employee_attendance_log
					WHERE employee_attendance_log_period = ".$period_log."
					AND schedule_employee_shift_item.employee_id = hro_employee_attendance_log.employee_id
					) AS ".$day_status.",";

				$startdate1			= strtotime('1 day', strtotime($startdate));
				$startdate 			= date("Y-m-d", $startdate1);
			}
				
			$query_count = substr(trim($query_count), 0, strlen($query_count) - 1);

			/*print_r("query_count ");
			print_r($query_count);
			exit;*/

			$hroemployeeattendancelog = $this->hroemployeeattendancedatareport_model->getHROEmployeeAttendanceLog_Print($query_count, $employee_shift_id);

			$employee_shift_code = $this->hroemployeeattendancedatareport_model->getScheduleEmployeeShift_Detail($employee_shift_id);

			require_once('TCPDF/config/tcpdf_config.php');
			require_once('TCPDF/tcpdf.php');
			// create new PDF document
			$pdf = new TCPDF('L', PDF_UNIT, 'F4', true, 'UTF-8', false);

			// set document information
			/*$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('');
			$pdf->SetTitle('');
			$pdf->SetSubject('');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');*/

			// set default header data
			/*$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE);
			$pdf->SetSubHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_STRING);*/

			// set header and footer fonts
			/*$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));*/

			// set default monospaced font
			/*$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);*/

			// set margins
			/*$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);*/

			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);

			$pdf->SetMargins(7, 7, 7, 7); // put space of 10 on top
			/*$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);*/
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

			$pdf->SetFont('helvetica', '', 8);

			// -----------------------------------------------------------------------------

			$tbl = "
			<table cellspacing=\"0\" cellpadding=\"2\" border=\"0\">
				<tr>
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\">ATTENDANCE REPORT</div></td>
			        <td width=\"50%\"><div style=\"text-align: left; font-size:14px\">SHIFT GROUP : ".$employee_shift_code."</div></td>
			    </tr>
			    <tr>
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\"></div></td>
			        <td width=\"50%\"><div style=\"text-align: left; font-size:14px\">PERIODE : ".tgltoview($sesi['start_date'])." - ".tgltoview($sesi['end_date'])."</div></td>
			    </tr>
			</table>";

			$pdf->writeHTML($tbl, true, false, false, false, '');
			
			$tbl1 = "
				<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\" width=\"100%\">
					<tr>
						<td width=\"3%\"><div style=\"text-align: center;\">
							No
						</div></td>";

						if (!empty($hroemployeeattendancelog)){
							$array_key = array_keys($hroemployeeattendancelog[0]);

							$count = count($array_key);

							for($i=0; $i<$count; $i++){
								$index_array = $array_key[$i];

								$length_day = strlen($index_array);

								if ($length_day == 3){
									$tbl2 .="
										<td width=\"2%\"><div style=\"text-align: center;\">
											".$index_array."
										</div></td>";	
								} else {
									if ($index_array == 'Employee Code' || $index_array == 'Job Title'){
										$tbl2 .="
											<td width=\"7%\"><div style=\"text-align: center;\">
												".$index_array."
											</div></td>";		
									} else {
										$tbl2 .="
											<td width=\"13%\"><div style=\"text-align: center;\">
												".$index_array."
											</div></td>";		
									}
									
								}
								
							}
							$tbl2 .= "
								<td width=\"5%\"><div style=\"text-align: center;\">Total Days</div>
								</td>
							</tr>";
						}
				
			/*print_r("tbl2 ");
			print_r($tbl2);
			exit;*/
			$no=1;

			if (!empty($hroemployeeattendancelog)){

				$count_attendance = count($hroemployeeattendancelog);

				$array_key = array_keys($hroemployeeattendancelog[0]);

				$count = count($array_key);				

				for ($j=0; $j<$count_attendance; $j++){
					$total_days = 0;
					$tbl3 .= "
						<tr>			
							<td>".$no."</td>";

					for($i=0; $i<$count; $i++){
						
						$index_array = $array_key[$i];

						
						$schedule_employee_item_status = $hroemployeeattendancelog[$j][$index_array];

						if ($schedule_employee_item_status == "0"){
							$schedule_employee_item_status_str = "Off";
						} else if ($schedule_employee_item_status == "1"){
							$schedule_employee_item_status_str = "O";
						} else if ($schedule_employee_item_status == "2"){
							$schedule_employee_item_status_str = "M";
						} else if ($schedule_employee_item_status == "3"){
							$schedule_employee_item_status_str = "SDR";
						} else if ($schedule_employee_item_status == "5"){
							$schedule_employee_item_status_str = "I";
						} else if ($schedule_employee_item_status == "4"){
							$schedule_employee_item_status_str = "C";
						} else if ($schedule_employee_item_status == ""){
							$schedule_employee_item_status_str = "X";
						} else if ($schedule_employee_item_status == "9"){
							$schedule_employee_item_status_str = "-";
						} else {
							$schedule_employee_item_status_str = $hroemployeeattendancelog[$j][$index_array];
						}

						if ($schedule_employee_item_status == "1"){
							$total_days++;
						}

						$length_day = strlen($index_array);

						if ($length_day == 3){
							$tbl3 .= "	
								<td><div style=\"text-align: center;\">".$schedule_employee_item_status_str."</div></td>
							";
						} else {
							$tbl3 .= "	
								<td>".$schedule_employee_item_status_str."</td>
							";
						}
					}
					$tbl3 .= "	
						<td><div style=\"text-align: center;\">".$total_days."</div></td>
					</tr>";

					$no++;
				}
			}
								
			$tbl4 =	"
				</table>	
				";				
						
			
			

			$pdf->writeHTML($tbl1.$tbl2.$tbl3.$tbl4, true, false, false, false, '');


			



			// -----------------------------------------------------------------------------
			
			//Close and output PDF document
			$filename = 'IST Test '.$testingParticipantData['participant_name'].'.pdf';
			$pdf->Output($filename, 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}

		public function exportHROEmployeeAttendanceData(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeattendancedatareport');
			if(!is_array($sesi)){
				$sesi['employee_shift_id']			= '';
				$sesi['employee_monthly_period']	= '0';
				$sesi['employee_id']				= '';
			}

			$payrollmonthlyperiod = $this->hroemployeeattendancedatareport_model->getPayrollMonthlyPeriod_Detail($sesi['employee_monthly_period']);

			if (!empty($payrollmonthlyperiod)){
				$start_date 	= $payrollmonthlyperiod['monthly_period_start_date'];
				$end_date 		= $payrollmonthlyperiod['monthly_period_end_date'];
			} else {
				$start_date 	= date("Y-m-d");
				$end_date 		= date("Y-m-d");
			}

			$hroemployeeattendancedata		= $this->hroemployeeattendancedatareport_model->getHROEmployeeAttendanceData_Detail($start_date, $end_date, $sesi['employee_shift_id'], $sesi['employee_id']);

			/*print_r("hroemployeeattendancedata ");
			print_r($hroemployeeattendancedata);
			exit;*/
			
			if(!empty($hroemployeeattendancedata)){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Sukses Sejahtera Energi")
									 ->setLastModifiedBy("PT. Sukses Sejahtera Energi")
									 ->setTitle("Employee Attendance Data Report")
									 ->setSubject("")
									 ->setDescription("Employee Attendance Data Report")
									 ->setKeywords("Employee, Attendance, Data")
									 ->setCategory("Employee Attendance Data Report");
									 
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
				$this->excel->getActiveSheet()->setCellValue('B1',"Employee Attendance Data Report");


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
				$this->excel->getActiveSheet()->setCellValue('L3',"Tanggal Masuk Kerja");
				$this->excel->getActiveSheet()->setCellValue('M3',"Tanggal Keluar Kerja");
				$this->excel->getActiveSheet()->setCellValue('N3',"Status Kehadiran");
				$this->excel->getActiveSheet()->setCellValue('O3',"Lembur");
				$this->excel->getActiveSheet()->setCellValue('P3',"Telat");
				/*$this->excel->getActiveSheet()->setCellValue('Q3',"Ijin Biasa");	
				$this->excel->getActiveSheet()->setCellValue('R3',"Ijin Tidak Absen");	
				$this->excel->getActiveSheet()->setCellValue('S3',"Mangkir");
				$this->excel->getActiveSheet()->setCellValue('T3',"Total Lembur");*/
				/*$this->excel->getActiveSheet()->setCellValue('T3',"Lembur Menit");*/
				/*$this->excel->getActiveSheet()->setCellValue('S3',"Telat ( hari )");
				$this->excel->getActiveSheet()->setCellValue('T3',"Telat ( jam )");*/
				/*$this->excel->getActiveSheet()->setCellValue('U3',"Total Late Minutes");
				$this->excel->getActiveSheet()->setCellValue('V3',"Total Overtime Days");
				
				$this->excel->getActiveSheet()->setCellValue('Y3',"Total Overtime Hours");*/

				
				$m = 0;
				$j=4;
				$no=0;
				
				foreach($hroemployeeattendancedata as $key=>$val){
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

						$employee_attendance_overtime 	= $val['employee_attendance_overtime_hours']." Jam ".$val['employee_attendance_overtime_minutes']." Menit";

						$employee_attendance_late 		= $val['employee_attendance_late_hours']." Jam ".$val['employee_attendance_late_minutes']." Menit";

						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['employee_shift_code']);
						$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['employee_name']);
						$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['division_name']);
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['department_name']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['section_name']);
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['job_title_name']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, $sesi['employee_monthly_period']);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $start_date);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, $end_date);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $val['employee_attendance_in_date']);
						$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['employee_attendance_out_date']);
						$this->excel->getActiveSheet()->setCellValue('N'.$j, $this->configuration->EmployeeAttendanceDateStatus[$val['employee_attendance_date_status']]);
						$this->excel->getActiveSheet()->setCellValue('O'.$j, $employee_attendance_overtime);
						$this->excel->getActiveSheet()->setCellValue('P'.$j, $employee_attendance_late);
						/*$this->excel->getActiveSheet()->setCellValue('Q'.$j, $val['total_permit_no_doctor_days']);
						$this->excel->getActiveSheet()->setCellValue('R'.$j, $total_no_tapping);
						$this->excel->getActiveSheet()->setCellValue('S'.$j, $val['total_absence_payroll_days']);
						$this->excel->getActiveSheet()->setCellValue('T'.$j, $total_overtime_str);*/

						/*$this->excel->getActiveSheet()->setCellValue('S'.$j, $val['total_late_days']);
						$this->excel->getActiveSheet()->setCellValue('T'.$j, $val['total_late_hours']);
						$this->excel->getActiveSheet()->setCellValue('U'.$j, $val['total_late_minutes']);
						$this->excel->getActiveSheet()->setCellValue('V'.$j, $val['total_overtime_days']);
						$this->excel->getActiveSheet()->setCellValue('W'.$j, $val['total_overtime_hours']);
						$this->excel->getActiveSheet()->setCellValue('X'.$j, $val['total_overtime_minutes']);
						$this->excel->getActiveSheet()->setCellValue('Y'.$j, $val['total_overtime_hours_list']);
*/
						/*$employee_monthly_period = $val['employee_monthly_period'];
						$employee_monthly_start_date = $val['employee_monthly_start_date'];
						$employee_monthly_end_date = $val['employee_monthly_end_date'];*/
					}else{
						continue;
					}
					
					$j++;
				}

				$filename='Employee_Attendance_Data_Report_'.$val['employee_name'].'_'.$sesi['employee_monthly_period'].'_'.$start_date.'_'.$end_date.'.xls';

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