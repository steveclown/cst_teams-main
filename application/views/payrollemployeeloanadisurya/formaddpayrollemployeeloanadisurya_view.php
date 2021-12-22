<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollemployeeloanadisurya/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeloanadisurya/function_elements_add');?>",
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
				url : "<?php echo site_url('payrollemployeeloanadisurya/function_state_add');?>",
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
			<a href="<?php echo base_url();?>payrollemployeeloanadisurya">
				Employee Loan Data List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>payrollemployeeloanadisurya/addPayrollEmployeeLoan/<?php echo $$payrollemployeeloanrequisition['employee_id']?>">
				Add Employee Loan Data
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Add Employee Loan Data - <?php echo $payrollemployeeloanrequisition['employee_name'];?> -
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
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $payrollemployeeloanrequisition['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $payrollemployeeloanrequisition['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $payrollemployeeloanrequisition['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $payrollemployeeloanrequisition['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section </label>
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
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeeloanadisurya" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('payrollemployeeloanadisurya/processAddPayrollEmployeeLoanAdisurya',array('id' => 'myform', 'class' => 'horizontal-form')); 
					?>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="loan_type_id" id="loan_type_id" value="<?php echo $payrollemployeeloanrequisition['loan_type_id']?>">
								<input type="text" name="loan_type_name" id="loan_type_name" value="<?php echo $payrollemployeeloanrequisition['loan_type_name']?>" class="form-control" readonly>
								<label class="control-label">Loan Type Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control" type="text" name="employee_loan_date" id="employee_loan_date" value="<?php echo tgltoview($payrollemployeeloanrequisition['employee_loan_requisition_date']);?>" readonly/>
								<label class="control-label">Loan Date
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
								<input type="text" name="employee_loan_description" id="employee_loan_description" value="<?php echo $payrollemployeeloanrequisition['employee_loan_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Description</label>
							</div>
						</div>
					
						<div class="col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('loan_month_start', $monthlist,set_value('loan_month_start',$payrollemployeeloanrequisition['loan_month_start']),'id="loan_month_start" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>Start Period</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('loan_year_start', $year,set_value('loan_year_start',$payrollemployeeloanrequisition['loan_year_start']),'id="loan_year_start" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label></label>
							</div>
						</div>
					</div>
						
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_loan_amount_total" id="employee_loan_amount_total" value="<?php echo $payrollemployeeloanrequisition['employee_loan_amount_total']?>" class="form-control" readonly>
								<label class="control-label">Loan Amount Total
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_total_period" id="employee_total_period" value="<?php echo $payrollemployeeloanrequisition['employee_total_period']?>" class="form-control" readonly>
								<label class="control-label">Total Period
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
								<input type="text" name="employee_loan_amount" id="employee_loan_amount" value="<?php echo $payrollemployeeloanrequisition['employee_loan_amount']?>" class="form-control" readonly>
								<label class="control-label">Loan Amount Per Period
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-actions right">
					<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<input type="hidden" name="employee_loan_requisition_id" id="employee_loan_requisition_id" value="<?php echo $payrollemployeeloanrequisition['employee_loan_requisition_id']?>">
				<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $payrollemployeeloanrequisition['employee_id']?>">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
