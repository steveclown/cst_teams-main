<script>
	function reset_add_loan(){
		document.location = base_url+"payrollemployeedata/reset_add_loan/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add_loan(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedata/function_elements_add_loan');?>",
				data : {'name' : name, 'value' : value},
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
	
	for($i = $year_now-1; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

<?php 
	echo form_open('payrollemployeedata/processAddPayrollEmployeeLoan',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollemployeeloan-'.$unique['unique']);
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('loan_type_id', $coreloantype ,set_value('loan_type_id',$data['loan_type_id']),'id="loan_type_id", class="form-control select2me" onChange="function_elements_add_loan(this.name, this.value);"');?>
			<label class="control-label">Loan Type Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_loan_date" id="employee_loan_date" onChange="function_elements_add_loan(this.name, this.value);" value="<?php echo tgltoview($data['employee_loan_date']);?>"/>
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
			<input type="text" autocomplete="off"  name="employee_loan_description" id="employee_loan_description" value="<?php echo $data['employee_loan_description']?>" class="form-control" onChange="function_elements_add_loan(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('loan_month_start', $monthlist,set_value('loan_month_start',$data['loan_month_start']),'id="loan_month_start" class="form-control select2me" onChange="function_elements_add_loan(this.name, this.value);"');
			?>
			<label>Start Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('loan_year_start', $year,set_value('loan_year_start',$data['loan_year_start']),'id="loan_year_start" class="form-control select2me" onChange="function_elements_add_loan(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>
	
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_loan_amount_total" id="employee_loan_amount_total" value="<?php echo $data['employee_loan_amount_total']?>" class="form-control" onChange="function_elements_add_loan(this.name, this.value);">
			<label class="control-label">Loan Amount Total
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_loan_amount" id="employee_loan_amount" value="<?php echo $data['employee_loan_amount']?>" class="form-control" onChange="function_elements_add_loan(this.name, this.value);">
			<label class="control-label">Loan Amount Per Period
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>
								

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_loan();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Loan Type Name</th>
						<th>Loan Date</th>
						<th>Loan Description</th>
						<th>Loan Start Period</th>
						<th>Loan Amount Total</th>
						<th>Loan Amount</th>
						<th>Loan Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeeloan)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeeloan as $key=>$val){
							echo"
								<tr>
									<td>".$val['loan_type_name']."</td>
									<td>".tgltoview($val['employee_loan_date'])."</td>
									<td>".$val['employee_loan_description']."</td>
									<td>".$val['employee_loan_start_period']."</td>
									<td>".nominal($val['employee_loan_amount_total'])."</td>
									<td>".nominal($val['employee_loan_amount'])."</td>
									<td>".$this->configuration->EmployeeLoanStatus[$val['employee_loan_status']]."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeedata/deletePayrollEmployeeLoan/'.$val['employee_id']."/".$val['employee_loan_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>";
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