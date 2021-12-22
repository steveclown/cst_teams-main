<?php
	date_default_timezone_set("Asia/Jakarta");
	$_this = & get_Instance();
	$url=$_this->uri->segment(1);
	$employee_monthly_id = $this->uri->segment(3);
	$sesi = $this->session->userdata('filter-payrollemployeemonthlyreport');
	if(!is_array($sesi)){
		$sesi['monthly_period'] 	= '';			
		$sesi['start_date']			= date('d-m-Y');
		$sesi['end_date']			= date('d-m-Y');
		// $sesi['division_id']		= '';
		// $sesi['department_id']		= '';
		// $sesi['section_id']			= '';
		$sesi['employee_id']		= '';
	}	
	
	
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel=stylesheet href="<?php echo base_url();?>css/isi.css" type=text/css media=screen>
<link rel=stylesheet href="<?php echo base_url();?>css/printt.css" type=text/css media=print>
<style>
	table {
		border-collapse:collapse;
	}
	
	td label {
		margin : 0 0 0 auto;
		font-size: 12px;
	}
	th{
		font-family:Arial  !important;
		letter-spacing:0px !important;
		font-size: 10px !important;
		font-weight: normal !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-family:Arial  !important;
		letter-spacing:0px !important;
		font-size: 10px !important;
		font-weight: normal !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	
	#page-wrap { width: 750px; margin: 0 auto;  border: 1px solid black; padding:5px;}
	
	#terms { text-align: center; margin: 20px 0 0 0; }
	
	#items { clear: both; width: 100%; margin: 30px 10px 0 0; }
	#items th { background: #eee; border: 1px solid black;}
	
	.col1 {		
		float:left;
		width:250px;
		padding:5px;
		margin:0px;
	}
	.col2 {
		align:right;
		float:right;
		width:250px;
		padding:5px;
		margin:0px;
		margin-bottom:10px;
	}
</style>
<script>
	base_url = '<?= base_url() ?>';
	function printNota(){
		alamat=document.getElementById("urlnya").value;
		window.print();
		document.location = base_url+alamat;
	}
</script>
<body>
	<div id="wrapper">
		<div id="page-wrap">
			<table width="100%">
				<tr style="text-align:center;border: 0px solid black;width:25%">
					<td><h1><b><i>Payroll Employee Monthly Report</i></b></h1></td>					
				</tr>				
			</table>
			<input type="hidden" name="urlnya" id="urlnya" value="<?php echo $url; ?>"/>
			<div class='col1'>
				<table border="0" cellpadding="0">
					<tr>
						<td width='150px'>Employee Monthly Period</td>
						<td width='15px'> : </td>
						<td width='65px'><?php echo $this->configuration->Month[substr($sesi['monthly_period'], -2, 2)]." ".substr($sesi['monthly_period'], 0, 4); ?></td>
					</tr>
					<tr>
						<td width='150px'>Employee Monthly Date</td>
						<td width='15px'> : </td>
						<td width='65px'><?php echo tgltoview($sesi['start_date']); ?></td>
						<td width='15px'> - </td>
						<td width='65px'><?php echo tgltoview($sesi['end_date']); ?></td>
					</tr>						
				</table>
			</div>
			<div class='col2'>
				<table border="0" cellpadding="0" align="right"  style="margin-top:17.5px !important;">
					
				</table>
			</div>
			<table id="items" width="100%" cellpadding="2" class="table table-striped table-bordered table-hover table-full-width">
				<tr>
					<th width="5%">No</th>
					<th width="20%">Employee Name</th>
					<th width="20%">Bank Acct Name</th>
					<th width="15%">Period</th>
					<th width="15%">Start Date</th>
					<th width="15%">End Date</th>
					<th width="20%">Basic Salary</th>
					<th width="20%">Allowance Total</th>
					<th width="20%">Deduction Total</th>
					<th width="20%">Overtime Total</th>
					<th width="20%">BPJS Amount</th>
					<th width="20%">Salary Total</th>
				</tr>
				<?php
					$no=1;
					foreach ($payrollemployeemonthlyreport ->result_array() as $key=>$val){									
						// $id = $this->salesordertakingorderreport_model->getMinID($val['sales_order_id']);
						// if($val['sales_order_item_id']==$id){
							echo"
								<tr>
									<td style='text-align:center;'>".$no."</td>
									<td style='text-align:center;'>".$val['employee_name']."</td>
									<td style='text-align:left;'>".$val['employee_monthly_bank_acct_name']."</td>
									<td style='text-align:center;'>".$this->configuration->Month[substr($val['employee_monthly_period'], -2, 2)]." ".substr($val['employee_monthly_period'], 0, 4)."</td>
									<td style='text-align:center;'>".tgltoview($val['employee_monthly_start_date'])."</td>
									<td style='text-align:center;'>".tgltoview($val['employee_monthly_end_date'])."</td>
									<td style='text-align:right;'>".nominal($val['employee_monthly_basic_salary'])."</td>
									<td style='text-align:right;'>".nominal($val['employee_monthly_allowance_total'])."</td>
									<td style='text-align:right;'>".nominal($val['employee_monthly_deduction_total'])."</td>
									<td style='text-align:right;'>".nominal($val['employee_monthly_overtime_total'])."</td>
									<td style='text-align:right;'>".nominal($val['employee_monthly_bpjs_amount'])."</td>
									<td style='text-align:right;'>".nominal($val['employee_monthly_salary_total'])."</td>
								</tr>
							";	
							$no++;	
						// }else{
						// 	echo"
						// 		<tr>
						// 			<td style='text-align:center;'></td>
						// 			<td style='text-align:left;'></td>
						// 			<td style='text-align:left;'></td>
						// 			<td></td>
						// 			<td></td>
						// 			<td></td>
						// 			<td></td>
						// 			<td>(".$this->library_model->getitemcode($val['item_id']).") ".$this->salesordertakingorderreport_model->getitemname($val['item_id'])."</td>
						// 			<td style='text-align:right;'>".nominal($val['quantity'])."</td>
						// 			<td style='text-align:left;'>".$this->salesordertakingorderreport_model->getitemunitname($val['item_unit_id'])."</td>
						// 			<td style='text-align:right;'>".nominal($val['item_unit_price'])."</td>
						// 			<td style='text-align:right;'>".nominal($val['subtotal_child'])."</td>
						// 			<td style='text-align:right;'>".nominal($val['subtotal_after_discount'])."</td>
						// 		</tr>
						// 	";
						// }
					} 
				?>
			</table>
		</div>
	</div>
	<div id="isi">
		<center><p><a href="javascript:printNota()"> <img src="<?php echo base_url();?>img/Device-Printer-icon.png" width="50px" height="50px"></a></p></center>
	</div>
</body>