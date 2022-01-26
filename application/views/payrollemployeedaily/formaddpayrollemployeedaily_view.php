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
								<a href="<?php echo base_url();?>hroemployeeallowance">
									Payroll Employee Daily List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeallowance/addPayrollEmployeeAllowance/<?php echo $hroemployeedata['employee_id']?>">
									Add Payroll Employee Daily
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Payroll Employee Daily - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->payrollemployeedaily_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->payrollemployeedaily_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->payrollemployeedaily_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->payrollemployeedaily_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
	echo form_open('payrollemployeedaily/processCalculatePayrollEmployeeDaily',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$data = $this->session->userdata('addhroemployeeallowance');
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
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>payrollemployeedaily" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									
									<input type="hidden" name="employee_daily_period" value="<?php echo $payrolldailyperiod['daily_period']; ?>"/>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_start_date" id="employee_daily_start_date" value="<?php echo tgltoview($payrolldailyperiod['daily_period_start_date'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Start Date
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_end_date" id="employee_daily_end_date" value="<?php echo tgltoview($payrolldailyperiod['daily_period_end_date'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">End Date
												</label>
											</div>
										</div>
									</div>
									
									<input type="hidden" name="bank_id" value="<?php echo $payrollemployeepayment['bank_id']; ?>"/>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="bank_name" id="bank_name" value="<?php echo $this->payrollemployeedaily_model->getBankName($payrollemployeepayment['bank_id'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Bank Name
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_bank_acct_no" id="employee_daily_bank_acct_no" value="<?php echo $payrollemployeepayment['payment_bank_acct_no']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Bank Acct No
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_bank_acct_name" id="employee_daily_bank_acct_name" value="<?php echo $payrollemployeepayment['payment_bank_acct_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Bank Acct Name
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_basic_salary_view" id="employee_daily_basic_salary_view" value="<?php echo nominal($payrollemployeepayment['payment_basic_salary'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_daily_basic_salary" id="employee_daily_basic_salary" value="<?php echo $payrollemployeepayment['payment_basic_salary']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Basic Salary
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_basic_salary_view" id="employee_daily_basic_salary_view" value="<?php echo nominal($payrollemployeepayment['payment_basic_overtime'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_daily_basic_salary" id="employee_daily_basic_salary" value="<?php echo $payrollemployeepayment['payment_basic_overtime']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">Basic Overtime
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_bpjs_amount_view" id="employee_daily_bpjs_amount_view" value="<?php echo nominal($payrollemployeedaily['employee_daily_bpjs_amount'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_daily_bpjs_amount" id="employee_daily_bpjs_amount" value="<?php echo $payrollemployeedaily['employee_daily_bpjs_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">BPJS Amount
												</label>
											</div>
										</div>

										<div class = "col-md-2">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="daily_period_include_bpjs" id="daily_period_include_bpjs" value="<?php echo $this->configuration->IncludeBPJS[$payrolldailyperiod['daily_period_include_bpjs']]?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<label class="control-label">BPJS
												</label>
											</div>
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_daily_date" id="employee_daily_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($payrollemployeedaily['employee_daily_date']);?>"/>
												<label class="control-label">Payroll Daily Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_working_days" id="employee_daily_working_days" value="<?php echo $payrollemployeedaily['employee_daily_working_days']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
												<input type="text" autocomplete="off"  name="length_service_month" id="length_service_month" value="<?php echo $payrollemployeedaily['length_service_month']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Length Service Month
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_length_service_amount" id="employee_length_service_amount" value="<?php echo nominal($payrollemployeedaily['employee_length_service_amount'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Length Service Amount
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_premi_attendance" id="employee_premi_attendance" value="<?php echo $payrollemployeedaily['employee_premi_attendance_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Premi Attendance Amount
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_allowance_other" id="employee_daily_allowance_other" value="<?php echo $payrollemployeedaily['employee_daily_allowance_other']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Allowance Other Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_allowance_description" id="employee_daily_allowance_description" value="<?php echo $payrollemployeedaily['employee_daily_allowance_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Allowance Other Description
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_deduction_other" id="employee_daily_deduction_other" value="<?php echo $payrollemployeedaily['employee_daily_deduction_other']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Deduction Other Amount
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_deduction_description" id="employee_daily_deduction_description" value="<?php echo $payrollemployeedaily['employee_daily_deduction_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Deduction Other Description
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_daily_salary_total_view" id="employee_daily_salary_total_view" value="<?php echo nominal($payrollemployeedaily['employee_daily_salary_total'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
												<input type="hidden" name="employee_daily_salary_total" id="employee_daily_salary_total" value="<?php echo $payrollemployeedaily['employee_daily_salary_total']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
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
					Payroll Employee Daily Calculation
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
										$data_payrollemployeedailyallowance = $this->session->userdata('addarrayemployeeallowance-'.$sesi['unique']);
										$employee_daily_allowance_total = 0;

										/*print_r("data_payrollemployeedailyallowance ");
										print_r($data_payrollemployeedailyallowance );*/

										if(!is_array($data_payrollemployeedailyallowance)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyallowance as $keyDailyAllowance=>$valDailyAllowance){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getAllowanceName($valDailyAllowance['allowance_id'])."</td>
														<td>".$valDailyAllowance['employee_daily_allowance_days']."</td>
														<td>".nominal($valDailyAllowance['employee_allowance_amount'])."</td>
														<td>".nominal($valDailyAllowance['employee_allowance_subtotal'])."</td>";
														echo"
													</tr>
													
												";
												$employee_daily_allowance_total += $valDailyAllowance['employee_allowance_subtotal'];
											}
										}
									?>	
									</tbody>
								</table>
							</div>

							<div class="col-md-6" align="right">
								<input type="text" autocomplete="off"  name="employee_daily_allowance_total" id="employee_daily_allowance_total"  value="<?php echo nominal($employee_daily_allowance_total)?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
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
										$data_payrollemployeedailydeduction = $this->session->userdata('addarrayemployeededuction-'.$sesi['unique']);
										$employee_daily_deduction_total = 0;

										/*print_r("data_payrollemployeedailyallowance ");
										print_r($data_payrollemployeedailyallowance );*/

										if(!is_array($data_payrollemployeedailydeduction)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailydeduction as $keyDailyDeduction=>$valDailyDeduction){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getDeductionName($valDailyDeduction['deduction_id'])."</td>
														<td>".$valDailyDeduction['employee_daily_deduction_days']."</td>
														<td>".nominal($valDailyDeduction['employee_deduction_amount'])."</td>
														<td>".nominal($valDailyDeduction['employee_deduction_subtotal'])."</td>";
														echo"
													</tr>
													
												";
												$employee_daily_deduction_total += $valDailyDeduction['employee_deduction_subtotal'];
											}
										}
									?>	
									</tbody>
								</table>
							</div>
							<div class="col-md-6" align="right">
								<input type="text" autocomplete="off"  name="employee_daily_deduction_total" id="employee_daily_deduction_total"  value="<?php echo nominal($employee_daily_deduction_total)?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
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
										$data_payrollemployeedailyovertime = $this->session->userdata('addarrayemployeeovertime-'.$sesi['unique']);

										if(!is_array($data_payrollemployeedailyovertime)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyovertime as $keyDailyOvertime=>$valDailyOvertime){
												echo"
													<tr>
														<td>".nominal($valDailyOvertime['employee_overtime_daily_total1'])."</td>
														<td>".nominal($valDailyOvertime['employee_overtime_daily_total2'])."</td>
														<td>".nominal($valDailyOvertime['employee_overtime_dayoff_total1'])."</td>
														<td>".nominal($valDailyOvertime['employee_overtime_dayoff_total2'])."</td>
														<td>".nominal($valDailyOvertime['employee_overtime_amount_total'])."</td>";
														echo"
													</tr>
													
												";
												$employee_daily_overtime_total = $valDailyOvertime['employee_overtime_amount_total'];
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
											<th>Home Early Hour</th>
											<th>Home Early Amount</th>
											<th>Home Early Total Amount</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeedailyhomeearly = $this->session->userdata('addarrayemployeehomeearly-'.$sesi['unique']);

										/*print_r("data_payrollemployeedailyhomeearly ");
										print_r($data_payrollemployeedailyhomeearly);*/


										if(!is_array($data_payrollemployeedailyhomeearly)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyhomeearly as $keyDailyHomeEarly=>$valDailyHomeEarly){
												echo"
													<tr>
														<td>".$valDailyHomeEarly['home_early_hour']."</td>
														<td>".nominal($valDailyHomeEarly['home_early_amount'])."</td>
														<td>".nominal($valDailyHomeEarly['home_early_total_amount'])."</td>";
														echo"
													</tr>
													
												";
												$employee_daily_early_total = $valDailyHomeEarly['home_early_total_amount'];
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
					Payroll Employee Daily Detail
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
										$data_payrollemployeedailyleaverequest = $this->session->userdata('addarrayemployeeleaverequest-'.$sesi['unique']);

										if(!is_array($data_payrollemployeedailyleaverequest)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyleaverequest as $keyLeave=>$valLeave){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getAnnualLeaveName($valLeave['annual_leave_id'])."</td>
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
										$data_payrollemployeedailydayoff = $this->session->userdata('addarrayemployeedayoff-'.$sesi['unique']);

										if(!is_array($data_payrollemployeedailydayoff)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailydayoff as $keyDayOff=>$valDayOff){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getDayOffName($valDayOff['dayoff_id'])."</td>
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
										$data_payrollemployeedailyovertimerequest = $this->session->userdata('addarrayemployeeovertimerequest-'.$sesi['unique']);
										
										if(!is_array($data_payrollemployeedailyovertimerequest)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyovertimerequest as $keyOvertime=>$valOvertime){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getOvertimeTypeName($valOvertime['overtime_type_id'])."</td>
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
											<th>Home Early Date</th>
											<th>Home Early Hour</th>
											<th>Home Early Description</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$data_payrollemployeedailyhomeearlydaily = $this->session->userdata('addarrayemployeehomeearlydaily-'.$sesi['unique']);

										if(!is_array($data_payrollemployeedailyhomeearlydaily)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyhomeearlydaily as $keyHomeEarly=>$valHomeEarly){
												echo"
													<tr>
														<td>".tgltoview($valHomeEarly['employee_home_early_daily_date'])."</td>
														<td>".$valHomeEarly['employee_home_early_daily_hour']."</td>
														<td>".$valHomeEarly['employee_home_early_daily_description']."</td>";
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
										$data_payrollemployeedailypermit = $this->session->userdata('addarrayemployeepermit-'.$sesi['unique']);

										if(!is_array($data_payrollemployeedailypermit)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailypermit as $keyPermit=>$valPermit){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getPermitName($valPermit['permit_id'])."</td>
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
										$data_payrollemployeedailyabsence = $this->session->userdata('addarrayemployeeabsence-'.$sesi['unique']);

										if(!is_array($data_payrollemployeedailyabsence)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailyabsence as $keyAbsence=>$valAbsence){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getAbsenceName($valAbsence['absence_id'])."</td>
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
										$data_payrollemployeedailylate = $this->session->userdata('addarrayemployeelate-'.$sesi['unique']);


										if(!is_array($data_payrollemployeedailylate)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($data_payrollemployeedailylate as $keyLate=>$valLate){
												echo"
													<tr>
														<td>".$this->payrollemployeedaily_model->getLateName($valLate['late_id'])."</td>
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
						echo form_open('payrollemployeedaily/processAddPayrollEmployeeDaily',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addhroemployeeallowance');
					?>

					<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
					<input type="hidden" name="bank_id" value="<?php echo $payrollemployeepayment['bank_id']; ?>"/>
					<input type="hidden" name="employee_daily_period" value="<?php echo $payrolldailyperiod['daily_period']; ?>"/>
					<input type="hidden" name="employee_daily_bank_acct_name" value="<?php echo $payrollemployeepayment['payment_bank_acct_name']; ?>"/>
					<input type="hidden" name="employee_daily_bank_acct_no" value="<?php echo $payrollemployeepayment['payment_bank_acct_no']; ?>"/>
					<input type="hidden" name="employee_daily_date" value="<?php echo $payrollemployeedaily['employee_daily_date']; ?>"/>
					<input type="hidden" name="employee_daily_start_date" value="<?php echo $payrolldailyperiod['daily_period_start_date']; ?>"/>
					<input type="hidden" name="employee_daily_end_date" value="<?php echo $payrolldailyperiod['daily_period_end_date']; ?>"/>
					<input type="hidden" name="employee_daily_basic_salary" value="<?php echo $payrollemployeepayment['payment_basic_salary']; ?>"/>
					<input type="hidden" name="employee_daily_basic_overtime" value="<?php echo $payrollemployeepayment['payment_basic_overtime']; ?>"/>
					<input type="hidden" name="employee_daily_working_days" value="<?php echo $payrollemployeedaily['employee_daily_working_days']; ?>"/>
					<input type="hidden" name="employee_daily_length_service_month" value="<?php echo $payrollemployeedaily['length_service_month']; ?>"/>
					<input type="hidden" name="employee_daily_length_service_amount" value="<?php echo $payrollemployeedaily['employee_length_service_amount']; ?>"/>
					<input type="hidden" name="employee_daily_premi_attendance_amount" value="<?php echo $payrollemployeedaily['employee_premi_attendance_amount']; ?>"/>
					<input type="hidden" name="employee_daily_allowance_total" value="<?php echo $employee_daily_allowance_total; ?>"/>
					<input type="hidden" name="employee_daily_deduction_total" value="<?php echo $employee_daily_deduction_total; ?>"/>
					<input type="hidden" name="employee_daily_overtime_total" value="<?php echo $employee_daily_overtime_total; ?>"/>
					<input type="hidden" name="employee_daily_early_total" value="<?php echo $employee_daily_early_total; ?>"/>
					<input type="hidden" name="employee_daily_bpjs_amount" value="<?php echo $payrollemployeedaily['employee_daily_bpjs_amount']; ?>"/>
					<input type="hidden" name="employee_daily_allowance_other" value="<?php echo $payrollemployeedaily['employee_daily_allowance_other']; ?>"/>
					<input type="hidden" name="employee_daily_allowance_description" value="<?php echo $payrollemployeedaily['employee_daily_allowance_description']; ?>"/>
					<input type="hidden" name="employee_daily_deduction_other" value="<?php echo $payrollemployeedaily['employee_daily_deduction_other']; ?>"/>
					<input type="hidden" name="employee_daily_deduction_description" value="<?php echo $payrollemployeedaily['employee_daily_deduction_description']; ?>"/>
					<input type="hidden" name="employee_daily_salary_total" value="<?php echo $payrollemployeedaily['employee_daily_salary_total']; ?>"/>

					<?
						/*print_r("payrollemployeedaily ");
						print_r($payrollemployeedaily);*/
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

