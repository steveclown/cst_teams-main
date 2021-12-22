<?php
	ini_set('memory_limit', '512M');

	class HroEmployeeAttendanceReport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeAttendanceReport_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-HroEmployeeAttendanceReport');

			if(!is_array($sesi)){
				$sesi['start_date']				= date('d-m-Y');
				$sesi['end_date']				= date('d-m-Y');
				$sesi['employee_shift_id']		= 0;
			}
			
			$start_date 		= tgltodb($sesi['start_date']);
			$end_date 			= tgltodb($sesi['end_date']);

			if (empty($sesi['employee_shift_id'])){
				$employee_shift_id 	= 0;	
			} else {
				$employee_shift_id 	= $sesi['employee_shift_id'];
			}
			

			$startdate1 		= strtotime('0 day', strtotime($start_date));
			$startdate 			= date("Y-m-d", $startdate1);
			$enddate1 			= strtotime('1 day', strtotime($end_date));
			$enddate 			= date("Y-m-d", $enddate1);

			$query_count = "";
			
			while ($startdate != $enddate){
				$day_log 		= "day_".date("d", strtotime($startdate));
				$period_log 	= date("Ym", strtotime($startdate));

				$day_status		= date("M", strtotime($startdate))."_".date("d", strtotime($startdate));

				$query_count .= "(
					SELECT ".$day_log." FROM hro_employee_attendance_log
					WHERE employee_attendance_log_period = ".$period_log."
					AND schedule_employee_shift_item.employee_id = hro_employee_attendance_log.employee_id
					) AS ".$day_status.",";

				$startdate1			= strtotime('1 day', strtotime($startdate));
				$startdate 			= date("Y-m-d", $startdate1);
			}
				
			/*print_r("employee_shift_id ");
			print_r($employee_shift_id);
			exit;*/

			$query_count = substr(trim($query_count), 0, strlen($query_count) - 1);

			// print_r("query_count ");
			// print_r($query_count);
			// exit;			

			$scheduleemployeescheduleitem = $this->HroEmployeeAttendanceReport_model->getHROEmployeeAttendanceLog($query_count, $employee_shift_id);

			$data['Main_view']['scheduleemployeescheduleitem']		= $scheduleemployeescheduleitem;

			$data['Main_view']['corelocation']						= create_double($this->HroEmployeeAttendanceReport_model->getCoreLocation(), 'location_id', 'location_name');
			// $data['Main_view']['corelocation']						= create_double($this->HroEmployeeAttendanceReport_model->getCoreLocation(), 'location_id', 'location_name');

			$data['Main_view']['content']							= 'HroEmployeeAttendanceReport/listHroEmployeeAttendanceReport_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAttendanceReport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeAttendanceReport-'.$unique['unique'],$sessions);
		}

		public function getScheduleEmployeeShift(){
			$location_id = $this->input->post('location_id');
			$item = $this->HroEmployeeAttendanceReport_model->getScheduleEmployeeShift($location_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_shift_id]'>$mp[employee_shift_code]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'start_date'			=> $this->input->post('start_date',true),
				'end_date'				=> $this->input->post('end_date',true),
				'employee_shift_id'		=> $this->input->post('employee_shift_id',true),
				'location_id'			=> $this->input->post('location_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeAttendanceReport',$data);
			redirect('HroEmployeeAttendanceReport');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeAttendanceReport');
			$this->session->unset_userdata('filter-HroEmployeeAttendanceReport');
			redirect('HroEmployeeAttendanceReport');
		}

		public function processPrinting(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-HroEmployeeAttendanceReport');

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

			$hroemployeeattendancelog = $this->HroEmployeeAttendanceReport_model->getHROEmployeeAttendanceLog_Print($query_count, $employee_shift_id);

			$employee_shift_code = $this->HroEmployeeAttendanceReport_model->getScheduleEmployeeShift_Detail($employee_shift_id);

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
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\">Laporan Kehadiran</div></td>
			        <td width=\"50%\"><div style=\"text-align: left; font-size:14px\">SHIFT GROUP	: ".$employee_shift_code."</div></td>
			    </tr>
			    <tr>
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\"></div></td>
			        <td width=\"50%\"><div style=\"text-align: left; font-size:14px\">PERIODE 		: ".tgltoview($sesi['start_date'])." - ".tgltoview($sesi['end_date'])."</div></td>
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
								//$tbl2="";
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
					//$tbl3="";
					$tbl3 .= "
						<tr>			
							<td><div style=\"text-align: center;\">".$no."</div></td>
					";

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
						
			
			

			$pdf->writeHTML($tbl1. $tbl2. $tbl3. $tbl4, true, false, false, false, '');


			



			// -----------------------------------------------------------------------------
			
			//Close and output PDF document
			$filename = 'Employee Attendance Report '.$employee_shift_code.' '.tgltoview($sesi['start_date']).' To '.tgltoview($sesi['end_date']).'.pdf';
			$pdf->Output($filename, 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}

		public function exportHROEmployeeAttendanceReport(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-HroEmployeeAttendanceReport');

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

			$hroemployeeattendancelog = $this->HroEmployeeAttendanceReport_model->getHROEmployeeAttendanceLog_Print($query_count, $employee_shift_id);

			$employee_shift_code = $this->HroEmployeeAttendanceReport_model->getScheduleEmployeeShift_Detail($employee_shift_id);


			
			if(!empty($hroemployeeattendancelog)){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Cahaya Kharisma Plasindo")
									 ->setLastModifiedBy("PT. Cahaya Kharisma Plasindo")
									 ->setTitle("Employee Attendance Report")
									 ->setSubject("")
									 ->setDescription("Employee Attendance Report")
									 ->setKeywords("Employee, Attendance, Report")
									 ->setCategory("Employee Attendance Report");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);

				$column = "B";

				if (!empty($hroemployeeattendancelog)){
					$array_key = array_keys($hroemployeeattendancelog[0]);

					$count = count($array_key);

					for($i=0; $i<$count; $i++){
						$index_array = $array_key[$i];

						$length_day = strlen($index_array);

						$this->excel->getActiveSheet()->getColumnDimension($column.'1')->setWidth(20);

						$column = ++$column;						
					}
				}
		
				$this->excel->getActiveSheet()->mergeCells("B1:".$column.'1');
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getFont()->setBold(true);	
				$this->excel->getActiveSheet()->setCellValue('B1',"Attendance Report ".$employee_shift_code." ".tgltoview($sesi['start_date'])." To ".tgltoview($sesi['end_date']));	

				$counter 	= 3;
				$column 	= "B";

				if (!empty($hroemployeeattendancelog)){
					$array_key = array_keys($hroemployeeattendancelog[0]);

					$count = count($array_key);

					for($i=0; $i<$count; $i++){
						$index_array = $array_key[$i];

						$length_day = strlen($index_array);

						$this->excel->getActiveSheet()->setCellValue($column.'3', $index_array);

						$column = ++$column;						
					}
					/*$this->excel->getActiveSheet()->setCellValue($column.$counter, $index_array);*/
				}
				
				
				$j = 4;
				$no = 1;

				

				if (!empty($hroemployeeattendancelog)){

					$count_attendance = count($hroemployeeattendancelog);

					$array_key = array_keys($hroemployeeattendancelog[0]);

					$count = count($array_key);				
					
					$counter 	= 4;

					for ($j=0; $j<$count_attendance; $j++){
						$total_days = 0;
						$column 	= "B";

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

							$this->excel->setActiveSheetIndex(0);

							$this->excel->getActiveSheet()->setCellValue($column.$counter, $schedule_employee_item_status_str);

							
							$column++;
						}
						/*$tbl3 .= "	
							<td><div style=\"text-align: center;\">".$total_days."</div></td>
						</tr>";*/
						$counter++;
						
					}
				}
				
				$filename='Employee Attendance Report '.$employee_shift_code.' '.tgltoview($sesi['start_date']).' To '.tgltoview($sesi['end_date']).'.xls';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'"');
				header('Cache-Control: max-age=0');
							 
				$objWriter = IOFactory::createWriter($this->excel, 'Excel5');  
				ob_end_clean();
				$objWriter->save('php://output');
			}else{
				echo "Maaf data yang di eksport tidak ada !";
			}
		}

		public function test(){
			$column = "AZ";

			$next_column = ++$column;

			print_r("next_column ");
			print_r($next_column);
		}
	}
?>