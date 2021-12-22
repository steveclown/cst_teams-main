<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"PayrollEmployeeMonthlyReportCkp/reset_search";
	}
</script>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>PayrollEmployeeMonthlyReportCkp">
							Payroll Employee Monthly List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Payroll Employee Monthly Recap 
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Recap
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>PayrollEmployeeMonthlyReportCkp" class="btn btn-default sm">
							<i class="fa fa-angle-left"></i>
							Back
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div class = "row">
						<div class = "col-md-12">
							<table class="table table-bordered table-advance table-hover">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th>
											Unit Name
										</th>
										<th>
											Total Bank
										</th>
										<th>
											With BPJS
										</th>
										<th >
											No BPJS
										</th>
										<th >
											Cash
										</th>
										<th >
											Salary Subtotal 
										</th>
										<th >
											Deduction
										</th>
										<th >
											Meal Coupon
										</th>
										<th >
											BPJS
										</th>
										<th >
											Salary Total
										</th>
										<th >
											Receipt
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
										$salary_total_unit_bank_total 		= 0;
										$salary_total_unit_bpjs_total 		= 0;
										$salary_total_unit_no_bpjs_total 	= 0;
										$salary_total_unit_cash_total 		= 0;
										$subtotal_salary_unit_total 		= 0;
										$additional_deduction_unit_total 	= 0;
										$meal_coupon_unit_total 			= 0;
										$bpjs_amount_unit_total 			= 0;
										$total_salary_unit_total 			= 0;
										foreach ($payrollemployeemonthlyrecap as $key => $val){
											$salary_total_unit_bank_total 		+= $val['salary_total_unit_bank'];
											$salary_total_unit_bpjs_total 		+= $val['salary_total_unit_bpjs'];
											$salary_total_unit_no_bpjs_total	+= $val['salary_total_unit_no_bpjs'];
											$salary_total_unit_cash_total 		+= $val['salary_total_unit_cash'];
											$subtotal_salary_unit_total 		+= $val['subtotal_salary_unit'];
											$additional_deduction_unit_total 	+= $val['additional_deduction_unit'];
											$meal_coupon_unit_total 			+= $val['meal_coupon_unit'];
											$bpjs_amount_unit_total 			+= $val['bpjs_amount_unit'];
											$total_salary_unit_total 			+= $val['total_salary_unit'];

											echo"
												<tr>			
													<td>".$no."</td>						
													<td>".$val['unit_name']."</td>
													<td style='text-align:right'>".nominal($val['salary_total_unit_bank'])."</td>
													<td style='text-align:right'>".nominal($val['salary_total_unit_bpjs'])."</td>
													<td style='text-align:right'>".nominal($val['salary_total_unit_no_bpjs'])."</td>
													<td style='text-align:right'>".nominal($val['salary_total_unit_cash'])."</td>
													<td style='text-align:right'>".nominal($val['subtotal_salary_unit'])."</td>
													<td style='text-align:right'>".nominal($val['additional_deduction_unit'])."</td>
													<td style='text-align:right'>".nominal($val['meal_coupon_unit'])."</td>
													<td style='text-align:right'>".nominal($val['bpjs_amount_unit'])."</td>
													<td style='text-align:right'>".nominal($val['total_salary_unit'])."</td>
													<td>
														<a href='".$this->config->item('base_url').'PayrollEmployeeMonthlyReportCkp/printSalaryReceipt/'.$datapayroll['location_id']."/".$datapayroll['employee_monthly_period']."/".$val['unit_id']."' class='btn default btn-xs green-jungle'>
															<i class='fa fa-print'></i> Print
														</a>
													</td>
												</tr>
											";
											$no++;
										} 

										echo"
											<tr>			
												<td></td>						
												<td>TOTAL</td>
												<td style='text-align:right'>".nominal($salary_total_unit_bank_total)."</td>
												<td style='text-align:right'>".nominal($salary_total_unit_bpjs_total)."</td>
												<td style='text-align:right'>".nominal($salary_total_unit_no_bpjs_total)."</td>
												<td style='text-align:right'>".nominal($salary_total_unit_cash_total)."</td>
												<td style='text-align:right'>".nominal($subtotal_salary_unit_total)."</td>
												<td style='text-align:right'>".nominal($additional_deduction_unit_total)."</td>
												<td style='text-align:right'>".nominal($meal_coupon_unit_total)."</td>
												<td style='text-align:right'>".nominal($bpjs_amount_unit_total)."</td>
												<td style='text-align:right'>".nominal($total_salary_unit_total)."</td>
											</tr>
										";
									?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class = "row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<a href='javascript:void(window.open("<?php echo base_url(); ?>PayrollEmployeeMonthlyReportCkp/exportPayrollEmployeeMonthlyPayroll/<?php echo $datapayroll['location_id']; ?>/<?php echo $datapayroll['employee_monthly_period']?>","_blank","top=100,left=200,width=300,height=300"));' class="btn green-jungle" title="Export to Excel">
		                        <i class="fa fa-file-excel-o"></i> Export Payroll
		                   	</a>
							<a href='javascript:void(window.open("<?php echo base_url(); ?>PayrollEmployeeMonthlyReportCkp/exportPayrollEmployeeMonthlyRecap/<?php echo $datapayroll['location_id']; ?>/<?php echo $datapayroll['employee_monthly_period']?>","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
		                        <i class="fa fa-file-excel-o"></i> Export Data
		                   	</a>
						</div>
					</div>
				</div>
				<input type="hidden" name="location_id" value="<?php echo $datapayroll['location_id']; ?>"/>
				<input type="hidden" name="employee_monthly_period" value="<?php echo $datapayroll['employee_monthly_period']; ?>"/>

				
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>

