<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>payrollemployeemonthlyreport">Payroll Employee Monthly</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Detail Payroll Employee Monthly
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeemonthlyreport/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $payrollemployeemonthlyreport['employee_name']; ?>" class="form-control" readonly>
								<label for="form_control">Employee Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_bank_acct_name" id="employee_monthly_bank_acct_name" class="form-control" value="<?php echo $payrollemployeemonthlyreport['employee_monthly_bank_acct_name']; ?>" readonly>
								<label for="form_control">Bank Account Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_period" id="employee_monthly_period" class="form-control" value="<?php echo $this->configuration->Month[substr($payrollemployeemonthlyreport['employee_monthly_period'], -2, 2)]." ".substr($payrollemployeemonthlyreport['employee_monthly_period'], 0, 4) ?>" readonly>
								<label for="form_control">Employee Monthly Period
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_start_date" id="employee_monthly_start_date" class="form-control" value="<?php echo tgltoview($payrollemployeemonthlyreport['employee_monthly_start_date']); ?>" readonly>
								<label for="form_control">Employee Monthly Period Start Date
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_start_date" id="employee_monthly_start_date" class="form-control" value="<?php echo tgltoview($payrollemployeemonthlyreport['employee_monthly_start_date']); ?>" readonly>
								<label for="form_control">Employee Monthly Period End Date
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_basic_salary" id="employee_monthly_basic_salary" class="form-control" value="<?php echo nominal($payrollemployeemonthlyreport['employee_monthly_basic_salary']); ?>" readonly>
								<label for="form_control">Basic Salary
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_allowance_total" id="employee_monthly_allowance_total" class="form-control" value="<?php echo nominal($payrollemployeemonthlyreport['employee_monthly_allowance_total']); ?>" readonly>
								<label for="form_control">Allowance Total
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_deduction_total" id="employee_monthly_deduction_total" class="form-control" value="<?php echo nominal($payrollemployeemonthlyreport['employee_monthly_deduction_total']); ?>" readonly>
								<label for="form_control">Deduction Total
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_overtime_total" id="employee_monthly_overtime_total" class="form-control" value="<?php echo nominal($payrollemployeemonthlyreport['employee_monthly_overtime_total']); ?>" readonly>
								<label for="form_control">Overtime Total</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_bpjs_amount" id="employee_monthly_bpjs_amount" class="form-control" value="<?php echo nominal($payrollemployeemonthlyreport['employee_monthly_bpjs_amount']); ?>" readonly>
								<label for="form_control">BPJS Total</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_monthly_salary_total" id="employee_monthly_salary_total" class="form-control" value="<?php echo nominal($payrollemployeemonthlyreport['employee_monthly_salary_total']); ?>" readonly>
								<label for="form_control">Employee Monthly Period Start Date</label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>