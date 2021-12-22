<?php ob_start(); ?>
<?php
	Class hroemployeelatereport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeelatereport_model');
			$this->load->helper('sistem');
			$this->load->library('configuration');
			$this->load->library('fungsi');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}

		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$sesi	= 	$this->session->userdata('filter-hroemployeelatereport');
			if(!is_array($sesi)){
				$sesi['start_date']			= date('d-m-Y');
				$sesi['end_date']			= date('d-m-Y');
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['late_id']			= '';	
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$data['main_view']['coredivision']				= create_double($this->hroemployeelatereport_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeelatereport_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeelatereport_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['corelate']					= create_double($this->hroemployeelatereport_model->getCoreLate(),'late_id','late_name');
			$data['main_view']['hroemployeelate_report']	= $this->hroemployeelatereport_model->getHROEmployeeLate_Report($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id'], $sesi['late_id'], $start_date, $end_date);

			$data['main_view']['content']					= 'hroemployeelatereport/listhroemployeelatereport_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'start_date'		=> $this->input->post('start_date',true),
				'end_date'			=> $this->input->post('end_date',true),
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'late_id'			=> $this->input->post('late_id',true),
			);
			/*print_r($data);exit;*/
			$this->session->set_userdata('filter-hroemployeelatereport',$data);
			redirect('hroemployeelatereport');
		}
		
		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeelatereport');
			$this->session->unset_userdata('filter-hroemployeelatereport');
			redirect('hroemployeelatereport');
		}
		
		public function showdetail(){
			$purchase_return_id 			= $this->uri->segment(3);
			$data['main_view']['detail']	= $this->hroemployeelatereport_model->getdetailgoodsreceiptnote($purchase_return_id);
			$data['main_view']['header']	= $this->hroemployeelatereport_model->getdataheaderreturn($this->uri->segment(3));
			$data['main_view']['content']	= 'hroemployeelatereport/detailhroemployeelatereport_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function printing(){
			$sesi	= 	$this->session->userdata('filter-hroemployeelatereport');
			if(!is_array($sesi)){
				$sesi['start_date']		= date('d-m-Y');
				$sesi['end_date']		= date('d-m-Y');
				$sesi['warehouse_id']	= '';
				$sesi['supplier_id']	= '';
			}
			
			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);
			
			$_this = & get_Instance();
			$url=$_this->uri->segment(1);
			$data['id']			= $this->uri->segment(3);
			$data['hroemployeelatereport']	= $this->hroemployeelatereport_model->getexport($start_date,$end_date,$sesi['warehouse_id'],$sesi['supplier_id']);
			$this->load->view('hroemployeelatereport/showprinthroemployeelatereport_view',$data);
		}
		
		function previewreport(){		
			redirect('hroemployeelatereport/printing/');
		}
		
		public function export(){
			$sesi	= 	$this->session->userdata('filter-hroemployeelatereport');
			if(!is_array($sesi)){
				$sesi['start_date']		= date('d-m-Y');
				$sesi['end_date']		= date('d-m-Y');
				$sesi['warehouse_id']	= '';
				$sesi['supplier_id']	= '';
			}
			
			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);
			$item = $this->hroemployeelatereport_model->getexport($start_date,$end_date,$sesi['warehouse_id'],$sesi['supplier_id']);
			
			if($item->num_rows()!=0){
				$this->load->library('excel');
				
				$this->excel->getProperties()->setCreator("IBS CJDW")
									 ->setLastModifiedBy("IBS CJDW")
									 ->setTitle("Goods Receipt Note Report")
									 ->setSubject("")
									 ->setDescription("Goods Receipt Note Report")
									 ->setKeywords("Purchase, Return, Report")
									 ->setCategory("Goods Receipt Note Report");
									 
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				$this->excel->getActiveSheet()->mergeCells("B1:J1");
				$this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true)->setSize(16);
				$this->excel->getActiveSheet()->getStyle('B3:J3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$this->excel->getActiveSheet()->getStyle('B3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('B3:J3')->getFont()->setBold(true);	
				$this->excel->getActiveSheet()->setCellValue('B1',"Goods Receipt Note Report From ".$sesi['start_date']." To ".$sesi['end_date']);	
				$this->excel->getActiveSheet()->setCellValue('B3',"No");
				$this->excel->getActiveSheet()->setCellValue('C3',"Warehouse");
				$this->excel->getActiveSheet()->setCellValue('D3',"Supplier");
				$this->excel->getActiveSheet()->setCellValue('E3',"Status");
				$this->excel->getActiveSheet()->setCellValue('F3',"Goods Receipt Note No");
				$this->excel->getActiveSheet()->setCellValue('G3',"Date");
				$this->excel->getActiveSheet()->setCellValue('H3',"Remark");
				$this->excel->getActiveSheet()->setCellValue('I3',"Item");
				$this->excel->getActiveSheet()->setCellValue('J3',"Quantity");
				
				$j=4;
				$no=0;
				
				foreach($item->result_array() as $key=>$val){
					if(is_numeric($key)){
						$no++;
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->getStyle('B'.$j.':J'.$j)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				
						$this->excel->getActiveSheet()->getStyle('B'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$this->excel->getActiveSheet()->getStyle('C'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('D'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('E'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('F'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('G'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('H'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('I'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$this->excel->getActiveSheet()->getStyle('J'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						
						$id = $this->hroemployeelatereport_model->getMinID($val['goods_receipt_note_id']);
						$supplier_id = $this->hroemployeelatereport_model->getsupplierID($val['warehouse_id']);
						if($val['goods_receipt_note_item_id']==$id){	
							$this->excel->getActiveSheet()->setCellValue('B'.$j, $no);
							$this->excel->getActiveSheet()->setCellValue('C'.$j, $this->hroemployeelatereport_model->getwarehousename($val['warehouse_id']));
							$this->excel->getActiveSheet()->setCellValue('D'.$j, $this->hroemployeelatereport_model->getsuppliername($supplier_id));
							$this->excel->getActiveSheet()->setCellValue('E'.$j, $this->configuration->GoodsReceivedNoteStatusInvoice[$val['goods_received_note_status_invoice']]);
							$this->excel->getActiveSheet()->setCellValue('F'.$j, $val['goods_received_note_no']);
							$this->excel->getActiveSheet()->setCellValue('G'.$j, tgltoview($val['goods_received_note_date']));
							$this->excel->getActiveSheet()->setCellValue('H'.$j, $val['goods_received_note_remark']);
							$this->excel->getActiveSheet()->setCellValue('I'.$j, $this->hroemployeelatereport_model->getitemname($val['item_id']));
							$this->excel->getActiveSheet()->setCellValue('J'.$j, nominal($val['quantity']));
						}else{
							$this->excel->getActiveSheet()->setCellValue('I'.$j, $this->hroemployeelatereport_model->getitemname($val['item_id']));
							$this->excel->getActiveSheet()->setCellValue('J'.$j, nominal($val['quantity']));
						}
					}else{
						continue;
					}
					$j++;
				}
				
				$filename='Goods Receipt Note Report.xls';
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