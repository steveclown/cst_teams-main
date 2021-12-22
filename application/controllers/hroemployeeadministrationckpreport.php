<?php
	class hroemployeeadministrationckpreport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeadministrationckpreport_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth 		= $this->session->userdata('auth');
			$sesi		= $this->session->userdata('filter-hroemployeeadministrationckpreport');
			$unique 	= $this->session->userdata('unique');

			if(!is_array($sesi)){
				$sesi['monthly_period_id']		= 0;
				$sesi['employee_shift_id']		= 0;
				$sesi['division_id']			= 0;
				$sesi['department_id']			= 0;
				$sesi['section_id']				= 0;
				$sesi['unit_id']				= 0;
			}

			$payrollmonthlyperiod = $this->hroemployeeadministrationckpreport_model->getPayrollMonthlyPeriod_Detail($sesi['monthly_period_id']);
			
			$start_date 		= $payrollmonthlyperiod['monthly_period_start_date'];
			$end_date 			= $payrollmonthlyperiod['monthly_period_end_date'];

			if (empty($sesi['employee_shift_id'])){
				$sesi['employee_shift_id'] = 0;
			}

			if (empty($sesi['division_id'])){
				$sesi['division_id'] = 0;
			}

			if (empty($sesi['department_id'])){
				$sesi['department_id'] = 0;
			}

			if (empty($sesi['section_id'])){
				$sesi['section_id'] = 0;
			}

			if (empty($sesi['unit_id'])){
				$sesi['unit_id'] = 0;
			}			

			$data['main_view']['payrollmonthlyperiod']		= create_double($this->hroemployeeadministrationckpreport_model->getPayrollMonthlyPeriod(), 'monthly_period_id', 'monthly_period_date');

			$data['main_view']['scheduleemployeeshift']		= create_double($this->hroemployeeadministrationckpreport_model->getScheduleEmployeeShift($auth['location_id']), 'employee_shift_id', 'employee_shift_code');			

			$data['main_view']['coredivision']				= create_double($this->hroemployeeadministrationckpreport_model->getCoreDivision(), 'division_id', 'division_name');			

			$hroemployeeadministrationckp 					= $this->hroemployeeadministrationckpreport_model->getHROEmployeeAdministrationCKP($start_date, $end_date, $sesi['employee_shift_id'], $sesi['division_id'], $sesi['department_id'], $sesi['section_id'], $sesi['unit_id']);
/*
			print_r("hroemployeeadministrationckp ");
			print_r($hroemployeeadministrationckp);
*/
			$this->session->unset_userdata('addArrayEmployeeAdministrationCKP-'.$unique['unique']);
			$this->session->unset_userdata('addArrayEmployeeAdministrationCKP_Week-'.$unique['unique']);
			$this->session->unset_userdata('addArrayEmployeeAdministrationCKP_Period-'.$unique['unique']);

			$week = 0;
			$total_absence_week 	= 0;
			$total_absence_period 	= 0;

			$total_permit_week		= 0;
			$total_permit_period	= 0;

			$total_sick_week		= 0;
			$total_sick_period		= 0;

			$total_off_week 		= 0;
			$total_off_period 		= 0;

			$counter 				= 0;
			$counter_week			= 0;

			$total_employee_week 	= 0;
			$total_employee_period 	= 0;

			$total_attend_week 		= 0;
			$total_attend_period 	= 0;

			foreach ($hroemployeeadministrationckp as $key => $val) {
				$counter++;

				$employee_attendance_date 						= $val['employee_attendance_date'];
				$date_name 										= date('D', strtotime($employee_attendance_date));

				switch ($date_name) {
					case 'Mon':
						$employee_attendance_name 				= "Senin";
						break;
					case 'Tue':
						$employee_attendance_name 				= "Selasa";
						break;
					case 'Wed':
						$employee_attendance_name 				= "Rabu";
						break;
					case 'Thu':
						$employee_attendance_name 				= "Kamis";
						break;
					case 'Fri':
						$employee_attendance_name 				= "Jumat";
						break;
					case 'Sat':
						$employee_attendance_name 				= "Sabtu";
						break;
					case 'Sun':
						$employee_attendance_name 				= "Minggu";
						break;
					default:
						# code...
						break;
				}

				$employee_attendance_total 						= $val['employee_attendance_total'];
				if (empty($employee_attendance_total)){
					$employee_attendance_total 					= 0;
				}
				$total_employee_period 							+= $employee_attendance_total;

				$employee_attend_total 							= $val['employee_attend_total'];
				if (empty($employee_attend_total)){
					$employee_attend_total 						= 0;
				}
				$total_attend_period 							+= $employee_attend_total;

				$employee_absence_total 						= $val['employee_absence_total'];
				if (empty($employee_absence_total)){
					$employee_absence_total 					= 0;
					$employee_absence_total_percentage 			= 0;
				} else {
					$employee_absence_total_percentage 			= ($employee_absence_total / $employee_attend_total) * 100;
				}
				$total_absence_period 							+= $employee_absence_total;

				$employee_permit_total 							= $val['employee_permit_total'];
				if (empty($employee_permit_total)){
					$employee_permit_total 						= 0;
					$employee_permit_total_percentage 			= 0;
				} else {
					$employee_permit_total_percentage 			= ($employee_permit_total / $employee_attend_total) * 100;
				}
				$total_permit_period 							+= $employee_permit_total;

				$employee_sick_total 							= $val['employee_sick_total'];
				if (empty($employee_sick_total)){
					$employee_sick_total 						= 0;
					$employee_sick_total_percentage 			= 0;
				} else {
					$employee_sick_total_percentage 			= ($employee_sick_total / $employee_attend_total) * 100;
				}
				$total_sick_period 								+= $employee_sick_total;
				
				$employee_administration_total 					= $employee_absence_total + $employee_permit_total + $employee_sick_total;
				if (empty($employee_administration_total)){
					$employee_administration_total 				= 0;
					$employee_administration_total_percentage 	= 0;
				} else {
					$employee_administration_total_percentage 	= ($employee_administration_total / $employee_attend_total) * 100;
				}

				$employee_off_total 							= $val['employee_off_total'];
				if (empty($employee_off_total)){
					$employee_off_total 						= 0;
				}
				$total_off_period 								+= $employee_off_total;

				$division_name 									= $this->hroemployeeadministrationckpreport_model->getDivisionName($sesi['division_id']);

				$department_name								= $this->hroemployeeadministrationckpreport_model->getDepartmentName($sesi['department_id']);

				$section_name 									= $this->hroemployeeadministrationckpreport_model->getSectionName($sesi['section_id']);

				$unit_name 										= $this->hroemployeeadministrationckpreport_model->getUnitName($sesi['unit_id']);

				$employeeadministrationckp 	= array(
					'record_id'									=> $key,
					'division_name'								=> $division_name,
					'department_name'							=> $department_name,
					'section_name'								=> $section_name,
					'unit_name'									=> $unit_name,
					'employee_attendance_date'					=> $employee_attendance_date,
					'employee_attendance_name'					=> $employee_attendance_name,
					'employee_attendance_total'					=> $employee_attendance_total,
					'employee_absence_total'					=> $employee_absence_total,
					'employee_absence_total_percentage'			=> $employee_absence_total_percentage,
					'employee_sick_total'						=> $employee_sick_total,
					'employee_sick_total_percentage'			=> $employee_sick_total_percentage,
					'employee_permit_total'						=> $employee_permit_total,
					'employee_permit_total_percentage'			=> $employee_permit_total_percentage,
					'employee_off_total'						=> $employee_off_total,
					'employee_attend_total'						=> $employee_attend_total,
					'employee_administration_total'				=> $employee_administration_total,
					'employee_administration_total_percentage'	=> $employee_administration_total_percentage,
				);


				$dataArrayHeader	= $this->session->userdata('addArrayEmployeeAdministrationCKP-'.$unique['unique']);
				$dataArrayHeader[$employeeadministrationckp['record_id']] = $employeeadministrationckp;
				$this->session->set_userdata('addArrayEmployeeAdministrationCKP-'.$unique['unique'], $dataArrayHeader);

				if ($key == 0){
					$counter_week++;
					$total_absence_week 	+= $employee_absence_total;
					$total_permit_week		+= $employee_permit_total;
					$total_sick_week		+= $employee_sick_total;
					$total_off_week 		+= $employee_off_total;

					$total_attend_week 		+= $employee_attend_total;
					$total_employee_week 	+= $employee_attend_total;

					$employeeadministrationckp_week[$week] 		= array
					(
						'start_date'							=> $employee_attendance_date,
						'end_date'								=> $employee_attendance_date,
						'total_absence_week'					=> $total_absence_week,
						'total_permit_week'						=> $total_permit_week,
						'total_sick_week'						=> $total_sick_week,
						'total_off_week'						=> $total_off_week,
						'counter_week'							=> $counter_week,
						'total_attend_week'						=> $total_attend_week,
						'total_employee_week'					=> $total_employee_week,
					);

					$employeeadministrationckp_period[0] 	= array
					(
						'start_date'							=> $employee_attendance_date,
					);

				} else {
					if ($date_name == 'Mon'){
						$week++;
						$counter_week = 1;
						$total_absence_week = 0;
						$total_permit_week	= 0;
						$total_sick_week	= 0;
						$total_off_week 	= 0;

						$total_absence_week += $employee_absence_total;
						$total_permit_week	+= $employee_permit_total;
						$total_sick_week	+= $employee_sick_total;
						$total_off_week 	+= $employee_off_total;

						$total_attend_week 		= 0;
						$total_employee_week 	= 0;

						$total_attend_week 		+= $employee_attend_total;
						$total_employee_week 	+= $employee_attend_total;

						$employeeadministrationckp_week[$week] 		= array(
							'start_date'							=> $employee_attendance_date,
							'end_date'								=> $employee_attendance_date,
							'total_absence_week'					=> $total_absence_week,
							'total_permit_week'						=> $total_permit_week,
							'total_sick_week'						=> $total_sick_week,
							'total_off_week'						=> $total_off_week,
							'counter_week'							=> $counter_week,
							'total_attend_week'						=> $total_attend_week,
							'total_employee_week'					=> $total_employee_week,
						);
					} else {
						$counter_week++;

						$total_absence_week 	+= $employee_absence_total;
						$total_permit_week		+= $employee_permit_total;
						$total_sick_week		+= $employee_sick_total;
						$total_off_week 		+= $employee_off_total;

						$total_attend_week 		+= $employee_attend_total;
						$total_employee_week 	+= $employee_attend_total;

						$employeeadministrationckp_week[$week]['end_date'] 				= $employee_attendance_date;
						$employeeadministrationckp_week[$week]['total_absence_week'] 	= $total_absence_week;
						$employeeadministrationckp_week[$week]['total_permit_week'] 	= $total_permit_week;
						$employeeadministrationckp_week[$week]['total_sick_week'] 		= $total_sick_week;
						$employeeadministrationckp_week[$week]['total_off_week'] 		= $total_off_week;
						$employeeadministrationckp_week[$week]['counter_week'] 			= $counter_week;
						$employeeadministrationckp_week[$week]['total_attend_week'] 	= $total_attend_week;
						$employeeadministrationckp_week[$week]['total_employee_week'] 	= $total_employee_week;
					}
				}
			}

			if (!empty($employeeadministrationckp_week)){
				foreach ($employeeadministrationckp_week as $keyWeek => $valWeek) {
					$counter_week 					= $valWeek['counter_week'];
					$total_attend_week	 			= $valWeek['total_attend_week'];
					$total_employee_week 			= $valWeek['total_employee_week'];

					$total_employee_week_average 	= $total_employee_week / $counter_week;

					$total_absence_week_percentage	= ($valWeek['total_absence_week'] / $total_attend_week) * 100;
					$total_permit_week_percentage	= ($valWeek['total_permit_week'] / $total_attend_week) * 100;
					$total_sick_week_percentage		= ($valWeek['total_sick_week'] / $total_attend_week) * 100;

					$total_administration_week 		= $valWeek['total_absence_week'] + $valWeek['total_permit_week'] + $valWeek['total_sick_week'];

					$total_administration_week_percentage = ($total_administration_week / $total_attend_week) * 100;

					$employeeadministrationckp_weeklist = array(
						'record_id'									=> $keyWeek,
						'start_date'								=> $valWeek['start_date'],
						'end_date'									=> $valWeek['end_date'],
						'total_absence_week'						=> $valWeek['total_absence_week'],
						'total_absence_week_percentage'				=> $total_absence_week_percentage,
						'total_permit_week'							=> $valWeek['total_permit_week'],
						'total_permit_week_percentage'				=> $total_permit_week_percentage,
						'total_sick_week'							=> $valWeek['total_sick_week'],
						'total_sick_week_percentage'				=> $total_sick_week_percentage,
						'total_off_week'							=> $valWeek['total_off_week'],
						'counter_week'								=> $valWeek['counter_week'],
						'total_attend_week'							=> $valWeek['total_attend_week'],
						'total_attend_week_average'					=> $total_attend_week_average,
						'total_employee_week_average'				=> $total_employee_week_average,
						'total_administration_week'					=> $total_administration_week,
						'total_administration_week_percentage'		=> $total_administration_week_percentage,
					);

					$dataArrayHeader	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Week-'.$unique['unique']);
					$dataArrayHeader[$employeeadministrationckp_weeklist['record_id']] = $employeeadministrationckp_weeklist;
					$this->session->set_userdata('addArrayEmployeeAdministrationCKP_Week-'.$unique['unique'], $dataArrayHeader);
				}

				$total_attend_period_average 				= $total_attend_period / $counter;
				$total_employee_period_average 				= $total_employee_period / $counter;

				$total_absence_period_percentage 			= ($total_absence_period / $total_attend_period) * 100;
				$total_permit_period_percentage 			= ($total_permit_period / $total_attend_period) * 100;
				$total_sick_period_percentage 				= ($total_sick_period / $total_attend_period) * 100;

				$total_administration_period 				= $total_absence_period + $total_permit_period + $total_sick_period;
				$total_administration_period_percentage 	= ($total_administration_period / $total_attend_period) * 100;

				$employeeadministrationckp_period = array(
					'record_id'									=> 0,
					'start_date'								=> $start_date,
					'end_date'									=> $end_date,
					'total_absence_period'		 				=> $total_absence_period,
					'total_absence_period_percentage'			=> $total_absence_period_percentage,
					'total_permit_period' 						=> $total_permit_period,
					'total_permit_period_percentage' 			=> $total_permit_period_percentage,
					'total_sick_period' 						=> $total_sick_period,
					'total_sick_period_percentage'	 			=> $total_sick_period_percentage,
					'total_off_period' 							=> $total_off_period,
					'total_attend_period' 						=> $total_attend_period,
					'total_attend_period_average' 				=> $total_attend_period_average,
					'total_employee_period_average' 			=> $total_employee_period_average,
					'total_administration_period_percentage' 	=> $total_administration_period_percentage,
				);

				$dataArrayHeader	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Period-'.$unique['unique']);
				$dataArrayHeader[$employeeadministrationckp_period['record_id']] = $employeeadministrationckp_period;
				$this->session->set_userdata('addArrayEmployeeAdministrationCKP_Period-'.$unique['unique'], $dataArrayHeader);
			}


			/*Dashboard*/
			/*$payrollmonthlyperiod_dashboard = $this->hroemployeeadministrationckpreport_model->getPayrollMonthlyPeriod_Dashboard($sesi['monthly_period_id']);

			foreach ($payrollmonthlyperiod_dashboard as $keyDashboard => $valDashboard) {
				$start_date = $valDashboard['monthly_period_start_date'];
				$end_date 	= $valDashboard['monthly_period_end_date'];

				$hroemployeeadministrationckp_dashboard		= $this->hroemployeeadministrationckpreport_model->getHROEmployeeAdministrationCKP($start_date, $end_date, $sesi['employee_shift_id'], $sesi['division_id'], $sesi['department_id'], $sesi['section_id'], $sesi['unit_id']);

				print_r("hroemployeeadministrationckp_dashboard ");
				print_r($hroemployeeadministrationckp_dashboard);
				exit;
			}*/


			$data['main_view']['content']									= 'hroemployeeadministrationckpreport/listhroemployeeadministrationckpreport_view';

			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeadministrationckpreport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeadministrationckpreport-'.$unique['unique'],$sessions);
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');

			$item = $this->hroemployeeadministrationckpreport_model->getCoreDepartment($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');

			$item = $this->hroemployeeadministrationckpreport_model->getCoreSection($department_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreUnit(){
			$section_id = $this->input->post('section_id');

			$item = $this->hroemployeeadministrationckpreport_model->getCoreUnit($section_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[unit_id]'>$mp[unit_name]</option>\n";	
			}
			echo $data;
		}		

		public function filter(){
			$data = array (
				'monthly_period_id'		=> $this->input->post('monthly_period_id',true),
				'employee_shift_id'		=> $this->input->post('employee_shift_id',true),
				'division_id'			=> $this->input->post('division_id',true),
				'department_id'			=> $this->input->post('department_id',true),
				'section_id'			=> $this->input->post('section_id',true),
				'unit_id'				=> $this->input->post('unit_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeadministrationckpreport',$data);
			redirect('hroemployeeadministrationckpreport');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeadministrationckpreport');
			$this->session->unset_userdata('filter-hroemployeeadministrationckpreport');
			redirect('hroemployeeadministrationckpreport');
		}

		public function processPrinting(){
			$sesi		= $this->session->userdata('filter-hroemployeeadministrationckpreport');

			if(!is_array($sesi)){
				$sesi['monthly_period_id']		= 0;
				$sesi['employee_shift_id']		= 0;
				$sesi['division_id']			= 0;
				$sesi['department_id']			= 0;
				$sesi['section_id']				= 0;
				$sesi['unit_id']				= 0;
			}

			$payrollmonthlyperiod = $this->hroemployeeadministrationckpreport_model->getPayrollMonthlyPeriod_Detail($sesi['monthly_period_id']);

			$employee_shift_code 	= $this->hroemployeeadministrationckpreport_model->getEmployeeShiftCode($sesi['employee_shift_id']);
			
			$start_date 		= $payrollmonthlyperiod['monthly_period_start_date'];
			$end_date 			= $payrollmonthlyperiod['monthly_period_end_date'];

			$unique 							= $this->session->userdata('unique');
			$employeeadministrationckp 			= $this->session->userdata('addArrayEmployeeAdministrationCKP-'.$unique['unique']);
			$employeeadministrationckp_week 	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Week-'.$unique['unique']);
			$employeeadministrationckp_period 	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Period-'.$unique['unique']);

			require_once('TCPDF/config/tcpdf_config.php');
			require_once('TCPDF/tcpdf.php');
			// create new PDF document
			$pdf = new TCPDF('P', PDF_UNIT, 'F4', true, 'UTF-8', false);

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
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\">IMS REPORT</div></td>
			        <td width=\"50%\"><div style=\"text-align: left; font-size:14px\">SHIFT GROUP : ".$employee_shift_code."</div></td>
			    </tr>
			    <tr>
			        <td width=\"30%\"><div style=\"text-align: left; font-size:14px\"></div></td>
			        <td width=\"50%\"><div style=\"text-align: left; font-size:14px\">PERIODE : ".tgltoview($start_date)." - ".tgltoview($end_date)."</div></td>
			    </tr>
			</table>";

			$pdf->writeHTML($tbl, true, false, false, false, '');
			
			$tbl1 = "
				<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">			
					<tr>
						<td width=\"5%\">
							No
						</td>
						<td width=\"10%\">
							Unit Name
						</td>
						<td width=\"9%\">
							Date
						</td>
						<td width=\"8%\">
							Day Name
						</td>
						<td width=\"10%\">
							Total Employee
						</td>
						<td colspan = \"2\" width=\"10%\">
							Total Absence
						</td>
						<td colspan = \"2\" width=\"10%\">
							Total Permit
						</td>
						<td colspan = \"2\" width=\"10%\">
							Total SDR
						</td>
						<td width=\"10%\">
							Total Off
						</td>
						<td width=\"10%\">
							Total Attendance
						</td>
						<td width=\"8%\">
							IMS
						</td>
					</tr>";
								
									
			$no 	= 1;
			$tbl2 	= '';
			if(empty($employeeadministrationckp)){
				echo "<tr><td style='text-align:center' colspan='14'>Data Empty</td></tr>";
			} else {
				foreach ($employeeadministrationckp as $key => $val){
					$tbl2 .="
						<tr>			
							<td>".$no."</td>						
							<td>".$val['unit_name']."</td>
							<td>".tgltoview($val['employee_attendance_date'])."</td>
							<td>".$val['employee_attendance_name']."</td>
							<td><div style=\"text-align: right;\">".$val['employee_attendance_total']."</div></td>
							<td><div style=\"text-align: right;\">".$val['employee_absence_total']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['employee_absence_total_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['employee_permit_total']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['employee_permit_total_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['employee_sick_total']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['employee_sick_total_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['employee_off_total']."</div></td>
							<td><div style=\"text-align: right;\">".$val['employee_attend_total']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['employee_administration_total_percentage'], 2)."</div></td>
						</tr>
					";
					$no++;
				} 
			}
								
			$tbl3 = "					
				</table>";

			$pdf->writeHTML($tbl1.$tbl2.$tbl3, true, false, false, false, '');

			$tbl1week = "
				<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">			
					<tr>
						<th width=\"5%\">
							No
						</th>
						<th width=\"10%\">
							Start Date
						</th>
						<th width=\"10%\">
							End Date
						</th>
						<th width=\"10%\">
							Avg Total Employee
						</th>
						<th colspan = \"2\" width=\"10%\">
							Total Absence
						</th>
						<th colspan = \"2\" width=\"10%\">
							Total Permit
						</th>
						<th colspan = \"2\" width=\"10%\">
							Total SDR
						</th>
						<th width=\"10%\">
							Total Off
						</th>
						<th width=\"10%\">
							Total Attendance
						</th>
						<th width=\"10%\">
							IMS
						</th>
					</tr>";
								
							
			$no 		= 1;
			$tbl2week 	= '';

			if(empty($employeeadministrationckp_week)){
				echo "<tr><td style='text-align:center' colspan='13'>Data Empty</td></tr>";
			} else {
				foreach ($employeeadministrationckp_week as $key => $val){
					$tbl2week .= "
						<tr>			
							<td>".$no."</td>						
							<td>".tgltoview($val['start_date'])."</td>
							<td>".tgltoview($val['end_date'])."</td>
							<td><div style=\"text-align: right;\">".number_format($val['total_employee_week_average'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_absence_week']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_absence_week_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_permit_week']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_permit_week_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_sick_week']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_sick_week_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_off_week']."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_attend_week']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_administration_week_percentage'], 2)."</div></td>
						</tr>
					";
					$no++;
				} 
			}
								
			$tbl3week = "
				</table>";

			$pdf->writeHTML($tbl1week.$tbl2week.$tbl3week, true, false, false, false, '');	

			$tbl1period = "
				<table cellspacing=\"0\" cellpadding=\"2\" border=\"1\">			
					<tr>
						<th width=\"5%\">
							No
						</th>
						<th width=\"10%\">
							Start Date
						</th>
						<th width=\"10%\">
							End Date
						</th>
						<th width=\"10%\">
							Avg Total Employee
						</th>
						<th colspan = \"2\" width=\"10%\">
							Total Absence
						</th>
						<th colspan = \"2\" width=\"10%\">
							Total Permit
						</th>
						<th colspan = \"2\" width=\"10%\">
							Total SDR
						</th>
						<th width=\"10%\">
							Total Off
						</th>
						<th width=\"10%\">
							Total Attendance
						</th>
						<th width=\"10%\">
							IMS
						</th>
					</tr>";


								
			$no 		= 1;
			$tbl2period = '';

			if(empty($employeeadministrationckp_period)){
				echo "<tr><td style='text-align:center' colspan='13'>Data Empty</td></tr>";
			} else {
				foreach ($employeeadministrationckp_period as $key => $val){
					$tbl2period .= "
						<tr>			
							<td>".$no."</td>						
							<td>".tgltoview($val['start_date'])."</td>
							<td>".tgltoview($val['end_date'])."</td>
							<td><div style=\"text-align: right;\">".number_format($val['total_employee_period_average'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_absence_period']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_absence_period_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_permit_period']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_permit_period_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_sick_period']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_sick_period_percentage'], 2)."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_off_period']."</div></td>
							<td><div style=\"text-align: right;\">".$val['total_attend_period']."</div></td>
							<td><div style=\"text-align: right;\">".number_format($val['total_administration_period_percentage'], 2)."</div></td>
						</tr>
					";
					$no++;
				} 
			}
				
			$tbl3period = "					
				</table>";

			$pdf->writeHTML($tbl1period.$tbl2period.$tbl3period, true, false, false, false, '');	
			// -----------------------------------------------------------------------------
			
			//Close and output PDF document
			$filename = 'IMS Report '.'.pdf';
			$pdf->Output($filename, 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}

		public function exportHROEmployeeAddministrationCKPReport(){
			$sesi		= $this->session->userdata('filter-hroemployeeadministrationckpreport');

			if(!is_array($sesi)){
				$sesi['monthly_period_id']		= 0;
				$sesi['employee_shift_id']		= 0;
				$sesi['division_id']			= 0;
				$sesi['department_id']			= 0;
				$sesi['section_id']				= 0;
				$sesi['unit_id']				= 0;
			}

			$payrollmonthlyperiod = $this->hroemployeeadministrationckpreport_model->getPayrollMonthlyPeriod_Detail($sesi['monthly_period_id']);

			$employee_shift_code 	= $this->hroemployeeadministrationckpreport_model->getEmployeeShiftCode($sesi['employee_shift_id']);
			
			$start_date 		= $payrollmonthlyperiod['monthly_period_start_date'];
			$end_date 			= $payrollmonthlyperiod['monthly_period_end_date'];

			$unique 							= $this->session->userdata('unique');
			$employeeadministrationckp 			= $this->session->userdata('addArrayEmployeeAdministrationCKP-'.$unique['unique']);
			$employeeadministrationckp_week 	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Week-'.$unique['unique']);
			$employeeadministrationckp_period 	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Period-'.$unique['unique']);
			
			if(!empty($employeeadministrationckp)){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("PT. Cahaya Kharisma Plasindo")
									 ->setLastModifiedBy("PT. Cahaya Kharisma Plasindo")
									 ->setTitle("Employee Administration Report")
									 ->setSubject("")
									 ->setDescription("Employee Administration Report")
									 ->setKeywords("Employee, Administration, Report")
									 ->setCategory("Employee Administration Report");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
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
				
				$this->excel->getActiveSheet()->mergeCells("B1:O1");
				$this->excel->getActiveSheet()->mergeCells("B2:O2");
				$this->excel->getActiveSheet()->mergeCells("B4:O4");
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true)->setSize(12);
				$this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true)->setSize(12);
				$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B5:O5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B5:O5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B5:O5')->getFont()->setBold(true);	
				$this->excel->getActiveSheet()->setCellValue('B1',"Employee Administration Report ");	
				$this->excel->getActiveSheet()->setCellValue('B2',$employee_shift_code);	
				$this->excel->getActiveSheet()->setCellValue('B3',"Period ".tgltoview($start_date)." s/d ".tgltoview($end_date));	

				$this->excel->getActiveSheet()->mergeCells("G5:H5");
				$this->excel->getActiveSheet()->mergeCells("I5:J5");
				$this->excel->getActiveSheet()->mergeCells("K5:L5");

				$this->excel->getActiveSheet()->setCellValue('B5',"No");
				$this->excel->getActiveSheet()->setCellValue('C5',"Unit Name");
				$this->excel->getActiveSheet()->setCellValue('D5',"Date");
				$this->excel->getActiveSheet()->setCellValue('E5',"Day Name");
				$this->excel->getActiveSheet()->setCellValue('F5',"Total Employee");
				$this->excel->getActiveSheet()->setCellValue('G5',"Total Absence");
				$this->excel->getActiveSheet()->setCellValue('I5',"Total Permit");
				$this->excel->getActiveSheet()->setCellValue('K5',"Total SDR");
				$this->excel->getActiveSheet()->setCellValue('M5',"Total Off");
				$this->excel->getActiveSheet()->setCellValue('N5',"Total Attendance");
				$this->excel->getActiveSheet()->setCellValue('O5',"IMS");
				
				
				$j = 6;
				$no = 0;
				$grand_total = 0;
				
				foreach($employeeadministrationckp as $key=>$val){
					if(is_numeric($key)){
						
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':O'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('E'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
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
					
						$no++;

						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['unit_name']);
						$this->excel->getActiveSheet()->setCellValue('D'.$j, tgltoview($val['employee_attendance_date']));
						$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['employee_attendance_name']);
						$this->excel->getActiveSheet()->setCellValue('F'.$j, number_format($val['employee_attendance_total'], 2));
						$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['employee_absence_total']);
						$this->excel->getActiveSheet()->setCellValue('H'.$j, number_format($val['employee_absence_total_percentage'], 2));
						$this->excel->getActiveSheet()->setCellValue('I'.$j, $val['employee_permit_total']);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, number_format($val['employee_permit_total_percentage']), 2);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, $val['employee_sick_total']);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, number_format($val['employee_sick_total_percentage']), 2);
						$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['employee_off_total']);
						$this->excel->getActiveSheet()->setCellValue('N'.$j, $val['employee_attend_total']);
						$this->excel->getActiveSheet()->setCellValue('O'.$j, number_format($val['employee_administration_total_percentage'], 2));
							

					}else{
						continue;
					}

					$j++;
				}

				$this->excel->getActiveSheet()->mergeCells("F".$j.":G".$j);
				$this->excel->getActiveSheet()->mergeCells("H".$j.":I".$j);
				$this->excel->getActiveSheet()->mergeCells("J".$j.":K".$j);

				$this->excel->getActiveSheet()->setCellValue('B'.$j,"No");
				$this->excel->getActiveSheet()->setCellValue('C'.$j,"Start Date");
				$this->excel->getActiveSheet()->setCellValue('D'.$j,"End Date");
				$this->excel->getActiveSheet()->setCellValue('E'.$j,"AVG Total Employee");
				$this->excel->getActiveSheet()->setCellValue('F'.$j,"Total Absence");
				$this->excel->getActiveSheet()->setCellValue('H'.$j,"Total Permit");
				$this->excel->getActiveSheet()->setCellValue('J'.$j,"Total SDR");
				$this->excel->getActiveSheet()->setCellValue('L'.$j,"Total Off");
				$this->excel->getActiveSheet()->setCellValue('M'.$j,"Total Attendance");
				$this->excel->getActiveSheet()->setCellValue('N'.$j,"IMS");


				$no = 0;
				$grand_total = 0;
				
				foreach($employeeadministrationckp_week as $key=>$val){
					if(is_numeric($key)){
						
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':N'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
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
						
						$no++;

						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, tgltoview($val['start_date']));
						$this->excel->getActiveSheet()->setCellValue('D'.$j, tgltoview($val['end_date']));
						$this->excel->getActiveSheet()->setCellValue('E'.$j, number_format($val['total_employee_week_average'], 2));
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['total_absence_week']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, number_format($val['total_absence_week_percentage'], 2));
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['total_permit_week']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, number_format($val['total_permit_week_percentage']), 2);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['total_sick_week']);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, number_format($val['total_sick_week_percentage']), 2);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $val['total_off_week']);
						$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['total_attend_week']);
						$this->excel->getActiveSheet()->setCellValue('N'.$j, number_format($val['total_administration_week_percentage'], 2));
							

					}else{
						continue;
					}

					$j++;
				}


				$this->excel->getActiveSheet()->mergeCells("F".$j.":G".$j);
				$this->excel->getActiveSheet()->mergeCells("H".$j.":I".$j);
				$this->excel->getActiveSheet()->mergeCells("J".$j.":K".$j);

				$this->excel->getActiveSheet()->setCellValue('B'.$j,"No");
				$this->excel->getActiveSheet()->setCellValue('C'.$j,"Start Date");
				$this->excel->getActiveSheet()->setCellValue('D'.$j,"End Date");
				$this->excel->getActiveSheet()->setCellValue('E'.$j,"AVG Total Employee");
				$this->excel->getActiveSheet()->setCellValue('F'.$j,"Total Absence");
				$this->excel->getActiveSheet()->setCellValue('H'.$j,"Total Permit");
				$this->excel->getActiveSheet()->setCellValue('J'.$j,"Total SDR");
				$this->excel->getActiveSheet()->setCellValue('L'.$j,"Total Off");
				$this->excel->getActiveSheet()->setCellValue('M'.$j,"Total Attendance");
				$this->excel->getActiveSheet()->setCellValue('N'.$j,"IMS");


				$no = 0;
				$grand_total = 0;
				
				foreach($employeeadministrationckp_period as $key=>$val){
					if(is_numeric($key)){
						
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':N'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
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
						
						$no++;

						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, tgltoview($val['start_date']));
						$this->excel->getActiveSheet()->setCellValue('D'.$j, tgltoview($val['end_date']));
						$this->excel->getActiveSheet()->setCellValue('E'.$j, number_format($val['total_employee_period_average'], 2));
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['total_absence_period']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, number_format($val['total_absence_period_percentage'], 2));
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['total_permit_period']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, number_format($val['total_permit_period_percentage']), 2);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['total_sick_period']);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, number_format($val['total_sick_period_percentage']), 2);
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $val['total_off_period']);
						$this->excel->getActiveSheet()->setCellValue('M'.$j, $val['total_attend_period']);
						$this->excel->getActiveSheet()->setCellValue('N'.$j, number_format($val['total_administration_period_percentage'], 2));
							

					}else{
						continue;
					}

					$j++;
				}


				$filename='Employee Administration Report '.tgltoview($start_date).' - '.tgltoview($end_date).'.xls';
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