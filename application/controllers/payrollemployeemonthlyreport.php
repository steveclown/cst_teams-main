<?php
	Class payrollemployeemonthlyreport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeemonthlyreport_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$sesi=$this->session->userdata('filter-payrollemployeemonthlyreport');
			if(!is_array($sesi)){
				$sesi['monthly_period'] 	= '';			
				$sesi['start_date']			= date('d-m-Y');
				$sesi['end_date']			= date('d-m-Y');
				// $sesi['division_id']		= '';
				// $sesi['department_id']		= '';
				// $sesi['section_id']			= '';
				$sesi['employee_id']		= '';
			}
			$start_date 	= tgltodb($sesi['start_date']);
			$end_date 		= tgltodb($sesi['end_date']);

			$data['main_view']['monthlist']			= $this->configuration->Month;
			$data['main_view']['coredivision']		= create_double($this->payrollemployeemonthlyreport_model->getCoreDivision(), 'division_id','division_name');
			$data['main_view']['payrollemployeemonthlyreport'] 	= $this->payrollemployeemonthlyreport_model->getPayrollEmployeeMonthlyReport($sesi['monthly_period'], $start_date, $end_date, $sesi['employee_id']);
			$data['main_view']['content']						= 'payrollemployeemonthlyreport/listpayrollemployeemonthlyreport_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->payrollemployeemonthlyreport_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->payrollemployeemonthlyreport_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHroEmployeeData(){
			$division_id 	= $this->input->post('division_id');
			$department_id	= $this->input->post('department_id');
			$section_id		= $this->input->post('section_id');
			
			$item = $this->payrollemployeemonthlyreport_model->getHroEmployeeData($division_id, $department_id, $section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function filter_payrollemployeemonthlyreport(){
			$month_period 	= $this->input->post('month_period',true);
			$year_period 	= $this->input->post('year_period',true);

			$monthly_period = $year_period.$month_period;

			$data = array (
				'monthly_period'		=> $monthly_period,
				'start_date'			=> $this->input->post('start_date',true),
				'end_date'				=> $this->input->post('end_date',true),
				// 'division_id'			=> $this->input->post('division_id',true),
				// 'department_id'			=> $this->input->post('department_id',true),
				// 'section_id'			=> $this->input->post('section_id', true),
				'employee_id'			=> $this->input->post('employee_id',true),
				
			);

			// print_r($data); exit;
			$this->session->set_userdata('filter-payrollemployeemonthlyreport',$data);
			redirect('payrollemployeemonthlyreport');
		}

		public function showdetail(){
			$employee_monthly_id 				= $this->uri->segment(3);
			$data['main_view']['payrollemployeemonthlyreport']		= $this->payrollemployeemonthlyreport_model->getPayrollEmployeeMonthlyReport_Detail($employee_monthly_id);
			$data['main_view']['content']	= 'payrollemployeemonthlyreport/detailpayrollemployeemonthlyreport_view';
			$this->load->view('mainpage_view',$data);
		}

		public function previewreport(){		
			redirect('payrollemployeemonthlyreport/printing/');
		}

		public function printing(){
			$sesi	= 	$this->session->userdata('filter-payrollemployeemonthlyreport');
			if(!is_array($sesi)){
				$sesi['monthly_period'] 	= '';			
				$sesi['start_date']			= date('d-m-Y');
				$sesi['end_date']			= date('d-m-Y');
				// $sesi['division_id']		= '';
				// $sesi['department_id']		= '';
				// $sesi['section_id']			= '';
				$sesi['employee_id']		= '';
			}
			$start_date 	= tgltodb($sesi['start_date']);
			$end_date 		= tgltodb($sesi['end_date']);
			
			$_this = & get_Instance();
			$url=$_this->uri->segment(1);
			$data['employee_monthly_id']			= $this->uri->segment(3);
			
			$data['payrollemployeemonthlyreport']			= $this->payrollemployeemonthlyreport_model->getExportPayrollEmployeeMonthlyReport($sesi['monthly_period'], $start_date, $end_date, $sesi['employee_id']);
			$this->load->view('payrollemployeemonthlyreport/showprintpayrollemployeemonthlyreport_view',$data);
		}

		public function export(){
			$sesi	= 	$this->session->userdata('filter-payrollemployeemonthlyreport');
			if(!is_array($sesi)){
				$sesi['monthly_period'] 	= '';			
				$sesi['start_date']			= date('d-m-Y');
				$sesi['end_date']			= date('d-m-Y');
				// $sesi['division_id']		= '';
				// $sesi['department_id']		= '';
				// $sesi['section_id']			= '';
				$sesi['employee_id']		= '';
			}
			
			$start_date = tgltodb($sesi['start_date']);
			$end_date = tgltodb($sesi['end_date']);
			
			$item = $this->payrollemployeemonthlyreport_model->getExportPayrollEmployeeMonthlyReport($sesi['monthly_period'], $start_date, $end_date, $sesi['employee_id']);


			
			if($item->num_rows()!=0){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("RMS Teams")
									 ->setLastModifiedBy("RMS Teams")
									 ->setTitle("Payroll Employee Monthly Report")
									 ->setSubject("")
									 ->setDescription("Payroll Employee Monthly Report")
									 ->setKeywords("Payroll, Employee, Monthly, Report")
									 ->setCategory("Payroll Employee Monthly Report");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);				
				$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);			
				$this->excel->getActiveSheet()->mergeCells("B1:M1");
				$this->excel->getActiveSheet()->getStyle('B3:M3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:M3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:M1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:M1')->getFont()->setBold(true);	
				$this->excel->getActiveSheet()->setCellValue('B1',"Payroll Employee Monthly Report ".$start_date." To ".$end_date);	
				
				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Employee Name");
				$this->excel->getActiveSheet()->setCellValue('D3',"Bank Account Name");
				$this->excel->getActiveSheet()->setCellValue('E3',"Period");
				$this->excel->getActiveSheet()->setCellValue('F3',"Start Date");
				$this->excel->getActiveSheet()->setCellValue('G3',"End Date");
				$this->excel->getActiveSheet()->setCellValue('H3',"Basic Salary");
				$this->excel->getActiveSheet()->setCellValue('I3',"Allowance Total");
				$this->excel->getActiveSheet()->setCellValue('J3',"Deduction Total");
				$this->excel->getActiveSheet()->setCellValue('K3',"Overtime Total");
				$this->excel->getActiveSheet()->setCellValue('L3',"BPJS Amount");
				$this->excel->getActiveSheet()->setCellValue('M3',"Salary Total");

				
				$j=4;
				$no=0;
				
				foreach($item->result_array() as $key=>$val){
					if(is_numeric($key)){
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':M'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('E'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('F'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('G'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('H'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('I'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('J'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('K'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('L'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$this->excel->getActiveSheet()->getStyle('M'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						
							$no++;
							$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
							$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['employee_name']);
							$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['employee_monthly_bank_acct_name']);
							$this->excel->getActiveSheet()->setCellValue('E'.$j, $this->configuration->Month[substr($val['employee_monthly_period'], -2, 2)]." ".substr($val['employee_monthly_period'], 0, 4));
							$this->excel->getActiveSheet()->setCellValue('F'.$j, tgltoview($val['employee_monthly_start_date']));
							$this->excel->getActiveSheet()->setCellValue('G'.$j, tgltoview($val['employee_monthly_end_date']));
							$this->excel->getActiveSheet()->setCellValue('H'.$j, nominal($val['employee_monthly_basic_salary']));
							$this->excel->getActiveSheet()->setCellValue('I'.$j, nominal($val['employee_monthly_allowance_total']));	
							$this->excel->getActiveSheet()->setCellValue('J'.$j, nominal($val['employee_monthly_deduction_total']));	
							$this->excel->getActiveSheet()->setCellValue('K'.$j, nominal($val['employee_monthly_overtime_total']));
							$this->excel->getActiveSheet()->setCellValue('L'.$j, nominal($val['employee_monthly_bpjs_amount']));			
							$this->excel->getActiveSheet()->setCellValue('M'.$j, nominal($val['employee_monthly_salary_total']));
					}else{
						continue;
					}
					$j++;
				}
				$filename='Payroll Employee Monthly Report.xls';
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