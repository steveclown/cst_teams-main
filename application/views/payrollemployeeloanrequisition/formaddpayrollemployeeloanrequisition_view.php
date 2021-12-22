<script>
	$(document).on('change','#employee_total_period',function(event){	
		employee_total_period 				= $('#employee_total_period')[0].value;
		
		if (isNaN(employee_total_period)){
			alert('Please input only numbers!');
			$('#employee_total_period').val('');
			document.getElementById('employee_total_period').focus();
		}else if(employee_total_period > 6 ){
			alert('Period exceeds the limit!');
			$('#employee_total_period').val('');
			document.getElementById('employee_total_period').focus();
		}else{
			if(employee_total_period != ''){
				$('#employee_total_period').val(employee_total_period);  
			}
		}
	});
	$(document).on('change','#employee_loan_amount_total',function(event){
		var salary = document.getElementById('employee_total_salary_amount').value;
		var max_loan = 3 * parseInt(salary);	
		employee_loan_amount_total 		= $('#employee_loan_amount_total')[0].value;
		
		
		if (isNaN(employee_loan_amount_total)){
			alert('Please input only numbers!');
			$('#employee_loan_amount_total').val('');
			document.getElementById('employee_loan_amount_total').focus();
		}else if(employee_loan_amount_total > max_loan ){
			alert('Loan amount total exceeds the limit!');
			$('#employee_loan_amount_total').val('');
			document.getElementById('employee_loan_amount_total').focus();
		}else{
			if(employee_loan_amount_total != ''){
				$('#employee_loan_amount_total').val(employee_loan_amount_total);  
			}
		}
	});
	function hit() {
      var employee_loan_amount_total = document.getElementById('employee_loan_amount_total').value;
      var employee_total_period = document.getElementById('employee_total_period').value;
      var employee_loan_amount = parseInt(employee_loan_amount_total) / parseInt(employee_total_period);
	      if (!isNaN(employee_loan_amount)) {
	         document.getElementById('employee_loan_amount').value = employee_loan_amount;
	      }
	}
</script>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>payrollemployeeloanrequisition">Employee Loan Requisition</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>payrollemployeeloanrequisition/addPayrollEmployeeLoanRequisition">Add Employee Loan Requisition</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Add Employee Loan Requisition - <?php echo $hroemployeedata['employee_name'];?> -
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->		
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<?php echo form_open('payrollemployeeloanrequisition/processAddPayrollEmployeeLoanRequisition',array('class' => 'horizontal-form')); ?>
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
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $hroemployeedata['employee_id']?>">
								<input type="hidden" class="form-control" name="employee_employment_status" id="employee_employment_status" value="<?php echo $hroemployeedata['employee_employment_status'] ?>" readonly>
                                <input type="text" class="form-control" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" readonly>
								<label for="form_control">Employee Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_employment_status2" id="employee_employment_status2" value="<?php echo $employeestatus[$hroemployeedata['employee_employment_status']] ?>" readonly>
								<label for="form_control">Employment Status
									<span class="required">*</span>
								</label>
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
					<a href="<?php echo base_url();?>payrollemployeeloanrequisition/searchHroEmployeeData" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class = "row">						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('loan_type_id', $coreloantype ,set_value('loan_type_id', $data['loan_type_id']),'id="loan_type_id", class="form-control select2me"');
								?>
								<label for="form_control">Loan Type
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_loan_requisition_date" id="employee_loan_requisition_date" value="<?php echo tgltoview($data['employee_loan_requisition_date']);?>">
								<label for="form_control">Loan Requisition Date
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
								$allowance = 0;
								// print_r($employeeallowance);
								// 	print_r("<br>");
								foreach ($employeeallowance as $key => $val) {
									
									$salary = $this->payrollemployeeloanrequisition_model->getPayrollBasicSalary();
									// print_r($salary);
									// print_r("<br>");	
										if($val['allowance_type'] == 0){
											$allowance2 = $val['employee_allowance_amount']*1;
										}
										else if($val['allowance_type'] == 1){
											$allowance2 = $val['employee_allowance_amount']*25;
										}
										else {
											$allowance2 = 0;
										}
										$allowance = $allowance + $allowance2;
										// print_r("allowance ");
										// print_r($allowance);									
								}
								$salaryamount = $salary['basic_salary_total']+$allowance;
								// print_r($salaryamount);
								?>
                                <input type="text" class="form-control" name="employee_total_salary_amount" id="employee_total_salary_amount" value="<?php echo $salaryamount; ?>" readonly>
								<label for="form_control">Salary Amount
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_loan_amount_total" id="employee_loan_amount_total" value="" >
								<label for="form_control">Employee Loan Amount Total</label>
							</div>	
						</div>
						
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="employee_total_period" id="employee_total_period" onchange="hit()">
								<label for="form_control">Total Period
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_loan_amount" id="employee_loan_amount" readonly>
								<label for="form_control">Employee Loan Amount</label>
							</div>	
						</div>
					</div>

				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>