<script>
	function reset_session(){
	 	// alert('asd');
		document.location = base_url+"payrollemployeedaily/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedaily/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedaily/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
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
								<a href="<?php echo base_url();?>payrollemployeemonthlyilufa">
									Payroll Employee Monthly List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Detail Payroll Employee Monthly
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->





<?php 
	echo form_open('payrollemployeedaily/processCalculatePayrollEmployeeDaily',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$data = $this->session->userdata('addpayrollemployeemonthlyilufa');
	$employee_id =  $this->session->userdata('employee_id');

	/*print_r("payrollemployeedaily");
	print_r($payrollemployeedaily);
	print_r("<BR>");
	print_r("")*/
	/*exit;*/
?>

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Recap
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>payrollemployeemonthlyreportckp" class="btn btn-default sm">
							<i class="fa fa-angle-left"></i>
							Back
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div class = "row">
						<div class = "col-md-12">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th>
											Monthly Period
										</th>
										<th width="55%">
											Employee Name
										</th>
										<th>
											Branch Name
										</th>
										<th >
											Section Name
										</th>
										<th >
											Job Title Name
										</th>
										<th >
											Basic Salary
										</th>
										<th >
											Working Days
										</th>
										<th >
											Allowance Total
										</th>
										<th >
											Deduction Total
										</th>
										<th >
											BPJS
										</th>
										<th >
											Length Service
										</th>
										<th >
											Length Saving
										</th>
										<th >
											Premi Attendance
										</th>
										<th >
											Incentive Total
										</th>
										<th >
											Bonus Total
										</th>
										<th >
											Commission Total
										</th>
										<th >
											Lost Item Total
										</th>
										<th >
											Deduction Premi
										</th>
										<th >
											Salary Total
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
										foreach ($payrollemployeemonthly as $key => $val){
											echo "
												<tr>
													<td>".$no."</td>
													<td>".$val['employee_monthly_period']."</td>
													<td>".$val['employee_name']."</td>
													<td>".$val['branch_name']."</td>
													<td>".$val['section_name']."</td>
													<td>".$val['job_title_name']."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_basic_salary_amount'], 2)."</td>
													<td style='text-align:right'>".$val['employee_monthly_working_days']."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_allowance_total_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_deduction_total_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_bpjs_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_length_service_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_length_saving_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_premi_attendance_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_incentive_total_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_bonus_total_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_commission_total_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_lost_item_total_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_deduction_premi_amount'], 2)."</td>
													<td style='text-align:right'>".number_format($val['employee_monthly_salary_total_amount'], 2)."</td>
												</tr>
											";	
											$no++;
										} 

										$employee_monthly_period = $val['employee_monthly_period'];
									?>
								</tbody>
							</table>
						</div>
					</div>
					<br>

					<div class = "row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<a href='javascript:void(window.open("<?php echo base_url(); ?>payrollemployeemonthlyilufa/exportPayrollEmployeeMonthlyPayroll/<?php echo $employee_monthly_period?>","_blank","top=100,left=200,width=300,height=300"));' class="btn green-jungle" title="Export to Excel">
		                        <i class="fa fa-file-excel-o"></i> Export Payroll
		                   	</a>
							<a href='javascript:void(window.open("<?php echo base_url(); ?>payrollemployeemonthlyilufa/exportPayrollEmployeeMonthlyRecap/<?php echo $employee_monthly_period?>","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
		                        <i class="fa fa-file-excel-o"></i> Export Data
		                   	</a>
						</div>
					</div>
					
				</div>
				
				
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>

