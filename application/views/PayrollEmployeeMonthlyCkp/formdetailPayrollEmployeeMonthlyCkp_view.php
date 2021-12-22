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
								<a href="<?php echo base_url();?>PayrollEmployeeMonthlyCkp">
									Payroll Employee Monthly List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>PayrollEmployeeMonthlyCkp/showdetail/<?php echo $payrollemployeemonthly['employee_monthly_id']?>">
									Detail Payroll Employee Monthly
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Detail Payroll Employee Monthly
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->






				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Detail
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>PayrollEmployeeMonthlyCkp" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php
										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_shift_code" name="employee_shift_code"  value="<?php echo $payrollemployeemonthly['employee_shift_code'];?>" readonly>
												<label class="control-label">Employee Shift Code</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_period" name="employee_monthly_period"  value="<?php echo $payrollemployeemonthly['employee_monthly_period'];?>" readonly>
												<label class="control-label">Monthly Period</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_start_date" name="employee_monthly_start_date"  value="<?php echo tgltoview($payrollemployeemonthly['employee_monthly_start_date']);?>" readonly>
												<label class="control-label">Monthly Period Start Date</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_end_date" name="employee_monthly_end_date"  value="<?php echo tgltoview($payrollemployeemonthly['employee_monthly_end_date']);?>" readonly>
												<label class="control-label">Monthly Period End Date</label>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				

								

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body ">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
									<thead>
										<tr>
											<th>No</th>
											<th>Monthly Period</th>
											<th>Monthly Start Date</th>
											<th>Monthly End Date</th>
											<th>Employee Name</th>
											<th>Unit Name</th>
											<th>Job Title Name</th>
											<th>Employee Status</th>
											<th>Working Months</th>
											<th>Hire Date</th>
											<th>Working Days</th>
											<th>Basic Salary</th>
											<th>Allowance Amount</th>
											<th>Attendance Amount</th>
											<th>Length Service Amount</th>
											<th>Home Early Amount</th>
											<th>Overtime Amount</th>
											<th>BPJS Amount</th>
											<th>Total Meal Coupon</th>
											<th>Meal Coupon Amount</th>
											<th>Delivery Amount</th>
											<th>Additional Deduction</th>
											<th>Additional Overtime</th>
											<th>Salary Amount</th>
											<th>Employee ID</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($payrollemployeemonthlyitem)){
											echo "<tr><th colspan='16' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeemonthlyitem as $key=>$val){
												// $total_early_days_5 = $val['total_early_payroll_less_5_days'] + $val['total_early_payroll_more_5_days'];
												echo"	
														<td>".$no."</td>
														<td>".$val['employee_monthly_period']."</td>
														<td>".tgltoview($val['employee_monthly_start_date'])."</td>
														<td>".tgltoview($val['employee_monthly_end_date'])."</td>
														<td>".$val['employee_name']."</td>
														<td>".$val['unit_name']."</td>
														<td>".$val['job_title_name']."</td>
														<td>".$employeestatus[$val['employee_employment_status']]."</td>
														<td style='text-align:right'>".number_format($val['employee_working_months'], 2)."</td>
														<td>".tgltoview($val['employee_hire_date'])."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_working_days'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_basic_salary'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_allowance_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_attendance_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_service_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_early_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_overtime_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_bpjs_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_total_meal_coupon'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_meal_coupon_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_delivery_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_additional_deduction_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_additional_overtime_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_salary_total'], 2)."</td>
														<td>".$val['employee_id']."</td>
													</tr>
												";
												$no++;
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<BR>
					<BR>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<div class="form-actions right">
									<a href='javascript:void(window.open("<?php echo base_url(); ?>PayrollEmployeeMonthlyCkp/exportPayrollEmployeeMonthly/<?php echo $payrollemployeemonthly['employee_monthly_id'] ?>","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
                                        <i class="fa fa-file-excel-o"></i> Export Data
                                   	</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

