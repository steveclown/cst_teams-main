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
			<a href="<?php echo base_url();?>payrollemployeeloanrequisition/addPayrollEmployeeLoanRequisition">Approve Employee Loan Requisition</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Add Employee Loan Requisition - <?php echo $payrollemployeeloanrequisition['employee_name'];?> -
</h1>
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
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="employee_loan_requisition_id" id="employee_loan_requisition_id" value="<?php echo $payrollemployeeloanrequisition['employee_loan_requisition_id']?>">
								<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $payrollemployeeloanrequisition['employee_id']?>">
                                <input type="text" class="form-control" name="employee_name" id="employee_name" value="<?php echo $payrollemployeeloanrequisition['employee_name']?>" readonly>
								<label for="form_control">Employee Name
									<span class="required">*</span>
								</label>
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

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_employment_status" id="employee_employment_status" value="<?php echo $employeestatus[$payrollemployeeloanrequisition['employee_employment_status']] ?>" readonly>
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
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeeloanrequisition" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class = "row">						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="loan_type_id" id="loan_type_id" value="<?php echo $payrollemployeeloanrequisition['loan_type_name'] ?>" readonly>
								<label for="form_control">Loan Type
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control" type="text" name="employee_loan_requisition_date" id="employee_loan_requisition_date" value="<?php echo tgltoview($payrollemployeeloanrequisition['employee_loan_requisition_date']);?>" readonly>
								<label for="form_control">Loan Requisition Date
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_total_salary_amount" id="employee_total_salary_amount" value="<?php echo $payrollemployeeloanrequisition['employee_total_salary_amount']; ?>" readonly>
								<label for="form_control">Salary Amount
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_loan_amount_total" id="employee_loan_amount_total" value="<?php echo $payrollemployeeloanrequisition['employee_loan_amount_total']?>" readonly>
								<label for="form_control">Employee Loan Amount Total</label>
							</div>	
						</div>
						
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="employee_total_period" id="employee_total_period" value="<?php echo $payrollemployeeloanrequisition['employee_total_period']?>" readonly>
								<label for="form_control">Total Period
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="employee_loan_amount" id="employee_loan_amount" value="<?php echo $payrollemployeeloanrequisition['employee_loan_amount']?>" readonly>
								<label for="form_control">Employee Loan Amount</label>
							</div>	
						</div>
					</div>

				</div>
				<div class="form-actions right">
					<a class="btn red" data-toggle="modal" href="#modalreject"> <i class="fa fa-times"></i> Reject</a>
					<a class="btn green-jungle" data-toggle="modal" href="#modalapproved"> <i class="fa fa-check"></i> Approve</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo form_open('payrollemployeeloanrequisition/processApprovedPayrollEmployeeLoanRequisition',array('class' => 'horizontal-form')); ?>
<div class="modal fade bs-modal-lg" id="modalapproved" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Employee Loan Requisition</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label class="control-label">Remark</label>
						<div class="input-icon right">
							<i class="fa"></i>
							<textarea rows="3" name="approved_remark" id="approved_remark" class="form-control" ></textarea>
							<input type="hidden" name="employee_loan_requisition_id" id="employee_loan_requisition_id" value="<?php echo $payrollemployeeloanrequisition['employee_loan_requisition_id']?>">
							<input type="hidden" value="<?php echo 1; ?>" name="employee_loan_requisition_status" id="employee_loan_requisition_status">
						</div>	
					</div>	
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn green-jungle">Save</button>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<?php echo form_open('payrollemployeeloanrequisition/processApprovedPayrollEmployeeLoanRequisition',array('class' => 'horizontal-form')); ?>
<div class="modal fade bs-modal-lg" id="modalreject" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Employee Loan Requisition</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label class="control-label">Remark</label>
						<div class="input-icon right">
							<i class="fa"></i>
							<textarea rows="3" name="approved_remark" id="approved_remark" class="form-control"></textarea>
							<input type="hidden" name="employee_loan_requisition_id" id="employee_loan_requisition_id" value="<?php echo $payrollemployeeloanrequisition['employee_loan_requisition_id']?>">
							<input type="hidden" value="<?php echo 2; ?>" name="employee_loan_requisition_status" id="employee_loan_requisition_status">
						</div>	
					</div>	
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn green-jungle">Save</button>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>