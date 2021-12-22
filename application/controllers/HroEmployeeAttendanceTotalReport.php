<?php
	class HroEmployeeAttendanceTotalReport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');			
			$this->load->model('HroEmployeeAttendanceTotalReport_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-HroEmployeeAttendanceTotalReport');

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
				

			$query_count = substr(trim($query_count), 0, strlen($query_count) - 1);

			// print_r('query_count')
			// print_r($query_count);exit;

			$scheduleemployeescheduleitem = $this->HroEmployeeAttendanceTotalReport_model->getHROEmployeeAttendanceLog($query_count, $employee_shift_id);

			$data['Main_view']['scheduleemployeescheduleitem']		= $scheduleemployeescheduleitem;

			$data['Main_view']['corelocation']						= create_double($this->HroEmployeeAttendanceTotalReport_model->getCoreLocation(), 'location_id', 'location_name');

			$data['Main_view']['content']							= 'HroEmployeeAttendanceTotalReport/listHroEmployeeAttendanceTotalReport_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAttendanceTotalReport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeAttendanceTotalReport-'.$unique['unique'],$sessions);
		}

		public function getScheduleEmployeeShift(){
			$location_id = $this->input->post('location_id');
			$item = $this->HroEmployeeAttendanceTotalReport_model->getScheduleEmployeeShift($location_id);
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
			);
			$this->session->set_userdata('filter-HroEmployeeAttendanceTotalReport',$data);
			redirect('HroEmployeeAttendanceTotalReport');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeAttendanceTotalReport');
			$this->session->unset_userdata('filter-HroEmployeeAttendanceTotalReport');
			redirect('HroEmployeeAttendanceTotalReport');
		}

		public function processPrinting(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-HroEmployeeAttendanceTotalReport');

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

			$hroemployeeattendancelog = $this->HroEmployeeAttendanceTotalReport_model->getHROEmployeeAttendanceLog_Print($query_count, $employee_shift_id);

			//print_r($hroemployeeattendancelog);exit;

			$employee_shift_code = $this->HroEmployeeAttendanceTotalReport_model->getScheduleEmployeeShift_Detail($employee_shift_id);

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
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\">ATTENDANCE TOTAL REPORT</div></td>
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

								if ($length_day > 3){
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
								<td width=\"8%\"><div style=\"text-align: center;\">Total Days</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Off</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Permit SDR</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Permit No SDR</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Absence</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Leave</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Default</div></td>
								<td width=\"8%\"><div style=\"text-align: center;\">Total Empty</div></td>
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
					$total_days 		= 0;
					$total_off 			= 0;
					$total_absence 		= 0;
					$total_permit_with 	= 0;
					$total_permit_no 	= 0;
					$total_leave 		= 0;
					$total_default 		= 0;
					$total_empty 		= 0;

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

						if ($schedule_employee_item_status == "0"){
							$total_off++;
						}

						if ($schedule_employee_item_status == "1"){
							$total_days++;
						}

						if ($schedule_employee_item_status == "2"){
							$total_absence++;
						}

						if ($schedule_employee_item_status == "3"){
							$total_permit_with++;
						}

						if ($schedule_employee_item_status == "4"){
							$total_leave++;
						}

						if ($schedule_employee_item_status == "5"){
							$total_permit_no++;
						}

						if ($schedule_employee_item_status == "9"){
							$total_default++;
						}

						if ($schedule_employee_item_status == ""){
							$total_empty++;
						}

						$length_day = strlen($index_array);

						if ($length_day > 3){
							$tbl3 .= "	
								<td>".$schedule_employee_item_status_str."</td>
							";
						}
					}


					$tbl3 .= "	
						<td><div style=\"text-align: center;\">".$total_days."</div></td>
						<td><div style=\"text-align: center;\">".$total_off."</div></td>
						<td><div style=\"text-align: center;\">".$total_permit_with."</div></td>
						<td><div style=\"text-align: center;\">".$total_permit_no."</div></td>
						<td><div style=\"text-align: center;\">".$total_absence."</div></td>
						<td><div style=\"text-align: center;\">".$total_leave."</div></td>
						<td><div style=\"text-align: center;\">".$total_default."</div></td>
						<td><div style=\"text-align: center;\">".$total_empty."</div></td>
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

		public function exportHROEmployeeAttendanceTotalReport(){
			$auth 	= $this->session->userdata('auth');
			$sesi	= $this->session->userdata('filter-hroemployeeattendancereport');

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

			$hroemployeeattendancelog = $this->HroEmployeeAttendanceTotalReport_model->getHROEmployeeAttendanceLog_Print($query_count, $employee_shift_id);

			$employee_shift_code = $this->HroEmployeeAttendanceTotalReport_model->getScheduleEmployeeShift_Detail($employee_shift_id);


			
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

					$count = 10;

					for($i=0; $i<$count; $i++){
						$this->excel->getActiveSheet()->getColumnDimension($column.'1')->setWidth(20);
						$column++;
					}
				}

				$column--;
				/*print_r("column ");
				print_r($column);
				exit;*/
		
				$this->excel->getActiveSheet()->mergeCells("B1:".$column.'1');
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("B1:".$column.'1')->getFont()->setBold(true);	
				$this->excel->getActiveSheet()->setCellValue('B1',"Attendance Report ".$employee_shift_code." ".tgltoview($sesi['start_date'])." To ".tgltoview($sesi['end_date']));	

				$column = "B";

				if (!empty($hroemployeeattendancelog)){
					$array_key = array_keys($hroemployeeattendancelog[0]);

					$count = count($array_key);

					for($i=0; $i<$count; $i++){
						$index_array = $array_key[$i];

						$length_day = strlen($index_array);

						if ($length_day > 3){
							$this->excel->getActiveSheet()->setCellValue($column.'3', $index_array);

							$column++;	
						}
					}

					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Days");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Off");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Permit SDR");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Permit No SDR");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Absence");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Leave");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Default");
					$this->excel->getActiveSheet()->setCellValue($column++.'3',"Total Empty");
				}
				
				if (!empty($hroemployeeattendancelog)){

					$count_attendance = count($hroemployeeattendancelog);

					$array_key = array_keys($hroemployeeattendancelog[0]);

					$count = count($array_key);	

					$counter 	= 4;			

					for ($j=0; $j<$count_attendance; $j++){
						$total_days 		= 0;
						$total_off 			= 0;
						$total_absence 		= 0;
						$total_permit_with 	= 0;
						$total_permit_no 	= 0;
						$total_leave 		= 0;
						$total_default 		= 0;
						$total_empty 		= 0;
						$column 			= "B";

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

							if ($schedule_employee_item_status == "0"){
								$total_off++;
							}

							if ($schedule_employee_item_status == "1"){
								$total_days++;
							}

							if ($schedule_employee_item_status == "2"){
								$total_absence++;
							}

							if ($schedule_employee_item_status == "3"){
								$total_permit_with++;
							}

							if ($schedule_employee_item_status == "4"){
								$total_leave++;
							}

							if ($schedule_employee_item_status == "5"){
								$total_permit_no++;
							}

							if ($schedule_employee_item_status == "9"){
								$total_default++;
							}

							if ($schedule_employee_item_status == ""){
								$total_empty++;
							}

							$length_day = strlen($index_array);

							if ($length_day > 3){
								$this->excel->setActiveSheetIndex(0);

								$this->excel->getActiveSheet()->setCellValue($column.$counter, $schedule_employee_item_status_str);

								
								$column++;
							}
						}

						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_days);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_off);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_permit_with);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_permit_no);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_absence);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_leave);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_default);
						$this->excel->getActiveSheet()->setCellValue($column++.$counter,$total_empty);

						$counter++;
					}
				}
				
				$filename='Employee Attendance Total Report '.$employee_shift_code.' '.tgltoview($sesi['start_date']).' To '.tgltoview($sesi['end_date']).'.xls';
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
	}
?>