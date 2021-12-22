<?php ob_start(); ?>
<?php
	Class testpdf extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrollemployeemonthlyilufa_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			

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

			$payrollemployeemonthly		= $this->payrollemployeemonthlyilufa_model->getPayrollEmployeeMonthly();

			print_r("payrollemployeemonthly ");
			print_r($payrollemployeemonthly);
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
				"<table cellspacing=\"3\" cellpadding=\"1\" border=\"0\">
				    <tr>
				        <td width=\"400\">
					        <table cellspacing=\"0\" cellpadding=\"5\" border=\"1\">
							    <tr>
							        <td width=\"115\"><div style=\"text-align: center; font-size:14px; font-weight:bold\">Period</div></td>
							        <td width=\"200\"><div style=\"text-align: center; font-size:14px; font-weight:bold\">Employee Name</div></td>
							        <td width=\"65\"><div style=\"text-align: center; font-size:14px; font-weight:bold\">Employee Salary Total</div></td>
							    </tr>";

			$tbl2 = '';
			$total_intellectual = 0;
			foreach($payrollemployeemonthly as $key=>$val){

				$tbl2 .= "<tr>
							<td>".$val['employee_monthly_period']."</td>
							<td>".$val['employee_name']."</td>
							<td ><div style=\"text-align: center\">".$val['employee_monthly_salary_total']."</span></td>
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

		
	}
?>