<?php
	class HroEmployeeMealCouponReport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeMealCouponReport_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');

			$sesi	= 	$this->session->userdata('filter-HroEmployeeMealCouponReport');

			if(!is_array($sesi)){
				$sesi['start_date']		= date("Y-m-d");
				$sesi['end_date']		= date("Y-m-d");
				$sesi['location_id']	= '';
				$sesi['division_id']	= '';
				$sesi['department_id']	= '';
				$sesi['section_id']		= '';
				$sesi['unit_id']		= '';
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$data['Main_view']['corelocation']			= create_double($this->HroEmployeeMealCouponReport_model->getCoreLocation(), 'location_id', 'location_name');

			$data['Main_view']['coredivision']			= create_double($this->HroEmployeeMealCouponReport_model->getCoreDivision(), 'division_id', 'division_name');

			$data['Main_view']['hroemployeemealcoupon']	= $this->HroEmployeeMealCouponReport_model->getHROEmployeeMealCoupon($start_date, $end_date, $sesi['location_id'], $sesi['division_id'], $sesi['department_id'], $sesi['section_id'], $sesi['unit_id']);

			$data['Main_view']['mealcouponsubvention']	= $this->HroEmployeeMealCouponReport_model->getMealCouponSubvention();

			$data['Main_view']['content']				= 'HroEmployeeMealCouponReport/listHroEmployeeMealCouponReport_view';

			$this->load->view('MainPage_view',$data);
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->HroEmployeeMealCouponReport_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->HroEmployeeMealCouponReport_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreUnit(){
			$section_id = $this->input->post('section_id');
			
			$item = $this->HroEmployeeMealCouponReport_model->getCoreUnit($section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[unit_id]'>$mp[unit_name]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'start_date'			=> $this->input->post('start_date',true),
				'end_date'				=> $this->input->post('end_date',true),
				'location_id'			=> $this->input->post('location_id',true),
				'division_id'			=> $this->input->post('division_id',true),
				'department_id'			=> $this->input->post('department_id',true),
				'section_id'			=> $this->input->post('section_id',true),
				'unit_id'				=> $this->input->post('unit_id',true),

			);

			$this->session->set_userdata('filter-HroEmployeeMealCouponReport',$data);
			redirect('HroEmployeeMealCouponReport');
		}

		public function reset_filter(){
			$this->session->unset_userdata('filter-HroEmployeeMealCouponReport');
			redirect('HroEmployeeMealCouponReport');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeMealCouponReport-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeMealCouponReport-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeMealCouponReport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeMealCouponReport-'.$unique['unique'],$sessions);
		}

		public function exportHROEmployeeMealCouponReport(){
			$sesi	= 	$this->session->userdata('filter-HroEmployeeMealCouponReport');
			if(!is_array($sesi)){
				$sesi['start_date']			= date('d-m-Y');
				$sesi['end_date']			= date('d-m-Y');
				$sesi['location_id']		= '';
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['unit_id']			= '';
			}
			
			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);
			
			$hroemployeemealcoupon = $this->HroEmployeeMealCouponReport_model->getHROEmployeeMealCoupon_Export($start_date, $end_date, $sesi['location_id'], $sesi['division_id'], $sesi['department_id'], $sesi['section_id'], $sesi['unit_id']);

			$mealcouponsubvention	= $this->HroEmployeeMealCouponReport_model->getMealCouponSubvention();
			
			if(!empty($hroemployeemealcoupon)){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("IBS CJDW")
									 ->setLastModifiedBy("IBS CJDW")
									 ->setTitle("Rekapitulasi Pemakaian Kupon Makan")
									 ->setSubject("")
									 ->setDescription("Rekapitulasi Pemakaian Kupon Makan")
									 ->setKeywords("Meal, Coupon, Meal Coupon, Report")
									 ->setCategory("Rekapitulasi Pemakaian Kupon Makan");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
				$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(40);

		
				$this->excel->getActiveSheet()->mergeCells("B1:L1");
				$this->excel->getActiveSheet()->getStyle('B3:L3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:L1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:L1')->getFont()->setBold(true);	
				$this->excel->getActiveSheet()->setCellValue('B1',"Rekapitulasi Pemakaian Kupon Makan");
				$this->excel->getActiveSheet()->setCellValue('B2',"Dari Tanggal ".$start_date." s/d ".$end_date);
				
				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Cabang");
				$this->excel->getActiveSheet()->setCellValue('D3',"NIK");
				$this->excel->getActiveSheet()->setCellValue('E3',"Nama");
				$this->excel->getActiveSheet()->setCellValue('F3',"Divisi");
				$this->excel->getActiveSheet()->setCellValue('G3',"Department");
				$this->excel->getActiveSheet()->setCellValue('H3',"Bagian");
				$this->excel->getActiveSheet()->setCellValue('I3',"Unit");
				$this->excel->getActiveSheet()->setCellValue('J3',"Pemakaian");
				$this->excel->getActiveSheet()->setCellValue('K3',"Nominal Pemakaian");
				$this->excel->getActiveSheet()->setCellValue('L3',"Nominal Subsidi");
				
				$j 	= 4;
				$no = 1;
				
				foreach($hroemployeemealcoupon as $key=>$val){
					if(is_numeric($key)){
						$employee_meal_coupon_subvention = $val['total_meal_coupon'] * $mealcouponsubvention['employee_meal_coupon_subvention'];

						$employee_meal_coupon_company_subvention = $val['total_meal_coupon'] * $mealcouponsubvention['employee_meal_coupon_company_subvention'];

						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':L'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('E'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('F'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('G'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('H'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('I'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('J'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('K'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('L'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						
						
						$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
						$this->excel->getActiveSheet()->setCellValue('C'.$j, $val['location_name']);
						$this->excel->getActiveSheet()->setCellValue('D'.$j, $val['employee_code']);
						$this->excel->getActiveSheet()->setCellValue('E'.$j, $val['employee_name']);
						$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['division_name']);
						$this->excel->getActiveSheet()->setCellValue('G'.$j, $val['department_name']);
						$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['section_name']);
						$this->excel->getActiveSheet()->setCellValue('I'.$j, $val['unit_name']);
						$this->excel->getActiveSheet()->setCellValue('J'.$j, $val['total_meal_coupon']);
						$this->excel->getActiveSheet()->setCellValue('K'.$j, $employee_meal_coupon_subvention);	
						$this->excel->getActiveSheet()->setCellValue('L'.$j, $employee_meal_coupon_company_subvention);

						$no++;

					}else{
						continue;
					}
					$j++;
				}
				
				$filename='rekapitulasi_pemakaian_kupon_makan.xls';
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