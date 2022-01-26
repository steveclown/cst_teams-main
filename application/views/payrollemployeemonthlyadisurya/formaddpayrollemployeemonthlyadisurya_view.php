<script>
	base_url = '<?php echo base_url()?>';

	function reset_session(){
	 	// alert('asd');
		document.location = base_url+"payrollemployeemonthlyadisurya/reset_session/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeemonthlyadisurya/function_elements_add');?>",
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
				url : "<?php echo site_url('payrollemployeemonthlyadisurya/function_state_add');?>",
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

	$sesi 	= $this->session->userdata('unique');
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
								<a href="<?php echo base_url();?>payrollemployeemonthlyadisuryaadisurya">
									Payroll Employee Monthly List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeemonthlyadisuryaadisurya/addPayrollEmployeeMonthly/<?php echo $hroemployeedata['employee_id']?>">
									Add Payroll Employee Monthly
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Payroll Employee Monthly - <?php echo $hroemployeedata['employee_name'];?> -
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->



<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Employee Data
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_hire_date" id="employee_hire_date" value="<?php echo tgltoview($hroemployeedata['employee_hire_date'])?>" class="form-control" readonly>
								<label class="control-label">Hire Date</label>
							</div>	
						</div>
					
						<!-- <div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->payrollemployeemonthlyadisurya_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	echo form_open('payrollemployeemonthlyadisurya/processCalculatePayrollEmployeeMonthly',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$data = $this->session->userdata('addpayrollemployeemonthlyadisuryaadisurya');
	$employee_id =  $this->session->userdata('employee_id');

	/*print_r("payrollemployeemonthlyadisurya");
	print_r($payrollemployeemonthlyadisurya);
	print_r("<BR>");
	print_r("")*/
	/*exit;*/
?>

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>payrollemployeemonthlyadisurya" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									
									<input type="hidden" name="employee_monthly_period" value="<?php echo $payrollmonthlyperiod['monthly_period']; ?>"/>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_start_date" id="employee_monthly_start_date" value="<?php echo tgltoview($payrollmonthlyperiod['monthly_period_start_date'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Start Date
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_end_date" id="employee_monthly_end_date" value="<?php echo tgltoview($payrollmonthlyperiod['monthly_period_end_date'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">End Date
												</label>
											</div>
										</div>
									</div>
									
									<input type="hidden" name="bank_id" value="<?php echo $payrollemployeepayment['bank_id']; ?>"/>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="bank_name" id="bank_name" value="<?php echo $this->payrollemployeemonthlyadisurya_model->getBankName($payrollemployeepayment['bank_id'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Bank Name
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_bank_acct_no" id="employee_monthly_bank_acct_no" value="<?php echo $payrollemployeepayment['payment_bank_acct_no']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Bank Acct No
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_bank_acct_name" id="employee_monthly_bank_acct_name" value="<?php echo $payrollemployeepayment['payment_bank_acct_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Bank Acct Name
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_basic_salary_view" id="employee_monthly_basic_salary_view" value="<?php echo nominal($payrollemployeepayment['payment_basic_salary'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_monthly_basic_salary" id="employee_monthly_basic_salary" value="<?php echo $payrollemployeepayment['payment_basic_salary']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Basic Salary
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_basic_salary_view" id="employee_monthly_basic_salary_view" value="<?php echo nominal($payrollemployeepayment['payment_basic_overtime'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_monthly_basic_salary" id="employee_monthly_basic_salary" value="<?php echo $payrollemployeepayment['payment_basic_overtime']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Basic Overtime
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_bpjs_amount_view" id="employee_monthly_bpjs_amount_view" value="<?php echo nominal($payrollemployeemonthlyadisurya['employee_monthly_bpjs_amount'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_monthly_bpjs_amount" id="employee_monthly_bpjs_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_bpjs_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">BPJS Amount
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_bpjs_kesehatan_amount_view" id="employee_monthly_bpjs_kesehatan_amount_view" value="<?php echo nominal($payrollemployeemonthlyadisurya['employee_monthly_bpjs_kesehatan_amount'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_monthly_bpjs_kesehatan_amount" id="employee_monthly_bpjs_kesehatan_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_bpjs_kesehatan_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">BPJS Kesehatan Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_bpjs_tenagakerja_amount_view" id="employee_monthly_bpjs_tenagakerja_amount_view" value="<?php echo nominal($payrollemployeemonthlyadisurya['employee_monthly_bpjs_tenagakerja_amount'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_monthly_bpjs_tenagakerja_amount" id="employee_monthly_bpjs_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_bpjs_tenagakerja_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">BPJS Tenaga Kerja Amount
												</label>
											</div>
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_monthly_date" id="employee_monthly_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($payrollemployeemonthlyadisurya['employee_monthly_date']);?>"/>
												<label class="control-label">Payroll Monthly Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_working_days" id="employee_monthly_working_days" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_working_days']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Working Days
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="length_service_month" id="length_service_month" value="<?php echo $payrollemployeemonthlyadisurya['length_service_month']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Length Service Month
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_length_service_amount" id="employee_length_service_amount" value="<?php echo nominal($payrollemployeemonthlyadisurya['employee_length_service_amount'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Length Service Amount
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_premi_attendance" id="employee_monthly_premi_attendance" value="<?php echo $payrollemployeemonthlyadisurya['employee_premi_attendance_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Premi Attendance Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_incentive_amount" id="employee_monthly_incentive_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_incentive_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Incentive Amount
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_allowance_other" id="employee_monthly_allowance_other" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_allowance_other']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Allowance Other Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_allowance_description" id="employee_monthly_allowance_description" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_allowance_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Allowance Other Description
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_deduction_other" id="employee_monthly_deduction_other" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_deduction_other']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Deduction Other Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_deduction_description" id="employee_monthly_deduction_description" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_deduction_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Deduction Other Description
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_loan_amount" id="employee_monthly_loan_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_loan_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Loan Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_saving_amount" id="employee_monthly_saving_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_saving_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Saving Amount
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_monthly_salary_total_view" id="employee_monthly_salary_total_view" value="<?php echo nominal($payrollemployeemonthlyadisurya['employee_monthly_salary_total'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_monthly_salary_total" id="employee_monthly_salary_total" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_salary_total']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Total Salary
												</label>
											</div>
										</div>
									</div>
								</div>
								
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<div class="form-actions right">
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Calculate</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php echo form_close(); ?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Payroll Employee Monthly Calculation
				</div>

				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class="row">
						<div class="col-md-6">
							<h4>Allowance </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Allowance Name</th>
											<th>Days</th>
											<th>Amount</th>
											<th>Sub Total</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryaallowance = $this->session->userdata('addarrayemployeeallowance-'.$sesi['unique']);
										$employee_monthly_allowance_total = 0;

										/*print_r("data_payrollemployeemonthlyadisuryaallowance ");
										print_r($data_payrollemployeemonthlyadisuryaallowance );*/

										if(!is_array($data_payrollemployeemonthlyadisuryaallowance)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryaallowance as $keyMonthlyAllowance=>$valMonthlyAllowance){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getAllowanceName($valMonthlyAllowance['allowance_id'])."</td>
														<td>".$valMonthlyAllowance['employee_monthly_allowance_days']."</td>
														<td>".nominal($valMonthlyAllowance['employee_allowance_amount'])."</td>
														<td>".nominal($valMonthlyAllowance['employee_allowance_subtotal'])."</td>";
														echo"
													</tr>
													
												";
												$employee_monthly_allowance_total += $valMonthlyAllowance['employee_allowance_subtotal'];
											}
										}
									?>	
									</tbody>
								</table>
							</div>

							<div class="col-md-6" align="right">
								<input type="text" autocomplete="off"  name="employee_monthly_allowance_total" id="employee_monthly_allowance_total"  value="<?php echo nominal($employee_monthly_allowance_total)?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
							</div>
						</div>


						<div class="col-md-6">
							<h4>Deduction </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Deduction Name</th>
											<th>Days</th>
											<th>Amount</th>
											<th>Sub Total</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryadeduction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);
										$employee_monthly_deduction_total = 0;

										/*print_r("data_payrollemployeemonthlyadisuryadeduction ");
										print_r($data_payrollemployeemonthlyadisuryadeduction );*/

										if(!is_array($data_payrollemployeemonthlyadisuryadeduction)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryadeduction as $keyMonthlyDeduction=>$valMonthlyDeduction){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getDeductionName($valMonthlyDeduction['deduction_id'])."</td>
														<td>".$valMonthlyDeduction['employee_monthly_deduction_days']."</td>
														<td>".nominal($valMonthlyDeduction['employee_deduction_amount'])."</td>
														<td>".nominal($valMonthlyDeduction['employee_deduction_subtotal'])."</td>";
														echo"
													</tr>
													
												";
												$employee_monthly_deduction_total += $valMonthlyDeduction['employee_deduction_subtotal'];
											}
										}
									?>	
									</tbody>
								</table>
							</div>
							<div class="col-md-6" align="right">
								<input type="text" autocomplete="off"  name="employee_monthly_deduction_total" id="employee_monthly_deduction_total"  value="<?php echo nominal($employee_monthly_deduction_total)?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
							</div>
						</div>
					</div>
					<BR>
					<BR>
					<div class="row">
						<div class="col-md-6">
							<h4>Overtime </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Overtime Working Day 1</th>
											<th>Overtime Working Day 2</th>
											<th>Overtime Day Off 1</th>
											<th>Overtime Day Off 2</th>
											<th>Overtime Total</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryaovertime = $this->session->userdata('addarrayemployeeovertime-'.$sesi['unique']);

										/*print_r("data_payrollemployeemonthlyadisuryaovertime ");
										print_r($data_payrollemployeemonthlyadisuryaovertime );*/

										if(!is_array($data_payrollemployeemonthlyadisuryaovertime)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryaovertime as $keyMonthlyOvertime=>$valMonthlyOvertime){
												echo"
													<tr>
														<td>".nominal($valMonthlyOvertime['employee_overtime_monthly_total1'])."</td>
														<td>".nominal($valMonthlyOvertime['employee_overtime_monthly_total2'])."</td>
														<td>".nominal($valMonthlyOvertime['employee_overtime_dayoff_total1'])."</td>
														<td>".nominal($valMonthlyOvertime['employee_overtime_dayoff_total2'])."</td>
														<td>".nominal($valMonthlyOvertime['employee_overtime_amount_total'])."</td>";
														echo"
													</tr>
													
												";
												$employee_monthly_overtime_total = $valMonthlyOvertime['employee_overtime_amount_total'];
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>


						<div class="col-md-6">
							<h4>Home Early </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Home Early Name</th>
											<th>Days</th>
											<th>Amount</th>
											<th>Sub Total</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryahomeearly = $this->session->userdata('addarrayemployeehomeearly-'.$sesi['unique']);

										/*print_r("data_payrollemployeemonthlyadisuryahomeearly ");
										print_r($data_payrollemployeemonthlyadisuryahomeearly);
*/

										if(!is_array($data_payrollemployeemonthlyadisuryahomeearly)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryahomeearly as $keyHomeEarly=>$valHomeEarly){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getDeductionName($valHomeEarly['deduction_id'])."</td>
														<td>".$valHomeEarly['employee_monthly_deduction_days']."</td>
														<td>".nominal($valHomeEarly['employee_deduction_amount'])."</td>
														<td>".nominal($valHomeEarly['employee_deduction_subtotal'])."</td>";
														echo"
													</tr>
												";
												$employee_monthly_home_early_total += $valHomeEarly['employee_deduction_subtotal'];
											}
										}
									?>	
									</tbody>
								</table>
							</div>
							<div class="col-md-6" align="right">
								<input type="text" autocomplete="off"  name="employee_monthly_home_early_total" id="employee_monthly_home_early_total"  value="<?php echo nominal($employee_monthly_home_early_total)?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
							</div>
						</div>
					</div>

					<BR>
					<BR>
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
					Payroll Employee Monthly Detail
				</div>

				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class="col-md-6">
							<h4>Employee Annual Leave </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Annual Leave Name</th>
											<th>Leave Date</th>
											<th>Leave Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryaleaverequest = $this->session->userdata('addarrayemployeeleaverequest-'.$sesi['unique']);

										if(!is_array($data_payrollemployeemonthlyadisuryaleaverequest)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryaleaverequest as $keyLeave=>$valLeave){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getAnnualLeaveName($valLeave['annual_leave_id'])."</td>
														<td>".tgltoview($valLeave['leave_request_detail_date'])."</td>
														<td>".$valLeave['leave_request_description']."</td>";
														echo"
													</tr>
													
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>

						<div class="col-md-6">
							<h4>Employee Working Day Off </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Day Off Name</th>
											<th>Day Off Date</th>
											<th>Day Off Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryadayoff = $this->session->userdata('addarrayemployeedayoff-'.$sesi['unique']);

										if(!is_array($data_payrollemployeemonthlyadisuryadayoff)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryadayoff as $keyDayOff=>$valDayOff){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getDayOffName($valDayOff['dayoff_id'])."</td>
														<td>".tgltoview($valDayOff['working_dayoff_detail_date'])."</td>
														<td>".$valDayOff['employee_working_dayoff_description']."</td>";
														echo"
													</tr>
													
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<h4>Employee Overtime </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Overtime Type Name</th>
											<th>Overtime Date</th>
											<th>Overtime Duration</th>
											<th>Overtime Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryaovertimerequest = $this->session->userdata('addarrayemployeeovertimerequest-'.$sesi['unique']);
										
										if(!is_array($data_payrollemployeemonthlyadisuryaovertimerequest)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryaovertimerequest as $keyOvertime=>$valOvertime){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getOvertimeTypeName($valOvertime['overtime_type_id'])."</td>
														<td>".tgltoview($valOvertime['overtime_request_date'])."</td>
														<td>".$valOvertime['overtime_request_duration']."</td>
														<td>".$valOvertime['overtime_request_description']."</td>";
														echo"
													</tr>
													
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>

						<div class="col-md-6">
							<h4>Employee Home Early </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Home Early Name</th>
											<th>Home Early Date</th>
											<th>Home Early Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryahomeearlymonthly = $this->session->userdata('addarrayemployeehomeearlymonthly-'.$sesi['unique']);

										if(!is_array($data_payrollemployeemonthlyadisuryahomeearlymonthly)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryahomeearlymonthly as $keyHomeEarlyMonthly=>$valHomeEarlyMonthly){
												echo"													
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getHomeEarlyName($valHomeEarlyMonthly['home_early_id'])."</td>
														<td>".tgltoview($valHomeEarlyMonthly['employee_home_early_monthly_date'])."</td>
														<td>".$valHomeEarlyMonthly['employee_home_early_monthly_description']."</td>";
														echo"
													</tr>
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-12">
							<h4>Employee Permit </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Permit Name</th>
											<th>Permit Date</th>
											<th>Permit Type</th>
											<th>Deduction Type</th>
											<th>Permit Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryapermit = $this->session->userdata('addarrayemployeepermit-'.$sesi['unique']);

										if(!is_array($data_payrollemployeemonthlyadisuryapermit)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryapermit as $keyPermit=>$valPermit){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getPermitName($valPermit['permit_id'])."</td>
														<td>".tgltoview($valPermit['employee_permit_detail_date'])."</td>
														<td>".$this->configuration->PermitType[$valPermit['permit_type']]."</td>
														<td>".$this->configuration->DeductionType[$valPermit['deduction_type']]."</td>
														<td>".$valPermit['employee_permit_description']."</td>";
														echo"
													</tr>
													
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<h4>Employee Absence </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Absence Name</th>
											<th>Absence Date</th>
											<th>Absence Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryaabsence = $this->session->userdata('addarrayemployeeabsence-'.$sesi['unique']);

										if(!is_array($data_payrollemployeemonthlyadisuryaabsence)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryaabsence as $keyAbsence=>$valAbsence){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getAbsenceName($valAbsence['absence_id'])."</td>
														<td>".tgltoview($valAbsence['employee_absence_detail_date'])."</td>
														<td>".$valAbsence['employee_absence_description']."</td>";
														echo"
													</tr>
													
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>


						<div class="col-md-6">
							<h4>Employee Late </h4>
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Late Name</th>
											<th>Late Date</th>
											<th>Late Duration</th>
											<th>Late Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeemonthlyadisuryalate = $this->session->userdata('addarrayemployeelate-'.$sesi['unique']);


										if(!is_array($data_payrollemployeemonthlyadisuryalate)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeemonthlyadisuryalate as $keyLate=>$valLate){
												echo"
													<tr>
														<td>".$this->payrollemployeemonthlyadisurya_model->getLateName($valLate['late_id'])."</td>
														<td>".tgltoview($valLate['employee_late_date'])."</td>
														<td>".$valLate['employee_late_duration']."</td>
														<td>".$valLate['employee_late_description']."</td>";
														echo"
													</tr>
													
												";
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

					<?php 
						echo form_open('payrollemployeemonthlyadisurya/processAddPayrollEmployeeMonthly',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addpayrollemployeemonthlyadisuryaadisurya');
					?>

					<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
					<input type="hidden" name="bank_id" value="<?php echo $payrollemployeepayment['bank_id']; ?>"/>
					<input type="hidden" name="employee_monthly_period" value="<?php echo $payrollmonthlyperiod['monthly_period']; ?>"/>
					<input type="hidden" name="employee_monthly_bank_acct_name" value="<?php echo $payrollemployeepayment['payment_bank_acct_name']; ?>"/>
					<input type="hidden" name="employee_monthly_bank_acct_no" value="<?php echo $payrollemployeepayment['payment_bank_acct_no']; ?>"/>
					<input type="hidden" name="employee_monthly_date" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_date']; ?>"/>
					<input type="hidden" name="employee_monthly_start_date" value="<?php echo $payrollmonthlyperiod['monthly_period_start_date']; ?>"/>
					<input type="hidden" name="employee_monthly_end_date" value="<?php echo $payrollmonthlyperiod['monthly_period_end_date']; ?>"/>
					<input type="hidden" name="employee_monthly_basic_salary" value="<?php echo $payrollemployeepayment['payment_basic_salary']; ?>"/>
					<input type="hidden" name="employee_monthly_basic_overtime" value="<?php echo $payrollemployeepayment['payment_basic_overtime']; ?>"/>
					<input type="hidden" name="employee_monthly_working_days" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_working_days']; ?>"/>
					<input type="hidden" name="employee_monthly_length_service_month" value="<?php echo $payrollemployeemonthlyadisurya['length_service_month']; ?>"/>
					<input type="hidden" name="employee_monthly_length_service_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_length_service_amount']; ?>"/>
					<input type="hidden" name="employee_monthly_premi_attendance_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_premi_attendance_amount']; ?>"/>
					<input type="hidden" name="employee_monthly_incentive_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_incentive_amount']; ?>"/>
					<input type="hidden" name="employee_monthly_loan_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_loan_amount']; ?>"/>
					<input type="hidden" name="employee_monthly_allowance_total" value="<?php echo $employee_monthly_allowance_total; ?>"/>
					<input type="hidden" name="employee_monthly_deduction_total" value="<?php echo $employee_monthly_deduction_total; ?>"/>
					<input type="hidden" name="employee_monthly_overtime_total" value="<?php echo $employee_monthly_overtime_total; ?>"/>
					<input type="hidden" name="employee_monthly_home_early_total" value="<?php echo $employee_monthly_home_early_total; ?>"/>
					<input type="hidden" name="employee_monthly_bpjs_amount" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_bpjs_amount']; ?>"/>
					<input type="hidden" name="employee_monthly_allowance_other" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_allowance_other']; ?>"/>
					<input type="hidden" name="employee_monthly_allowance_description" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_allowance_description']; ?>"/>
					<input type="hidden" name="employee_monthly_deduction_other" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_deduction_other']; ?>"/>
					<input type="hidden" name="employee_monthly_deduction_description" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_deduction_description']; ?>"/>
					<input type="hidden" name="employee_monthly_salary_total" value="<?php echo $payrollemployeemonthlyadisurya['employee_monthly_salary_total']; ?>"/>

					<?
						/*print_r("payrollemployeemonthlyadisurya ");
						print_r($payrollemployeemonthlyadisurya);*/
					?>
					<div class="form-actions right">
						<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>

					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

