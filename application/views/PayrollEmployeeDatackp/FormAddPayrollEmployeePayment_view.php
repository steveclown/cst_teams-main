<script>
	base_url 	= '<?php echo base_url();?>';
	
	function reset_add_payment(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollemployeedatackp/reset_add_payment/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add_payment(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedatackp/function_elements_add_payment');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>

<!-- <?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?> -->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				
<?php 
	echo form_open('payrollemployeedatackp/processAddPayrollEmployeePayment',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollemployeepayment-'.$unique['unique']);
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_payment_period', $year,set_value('employee_payment_period',$data['employee_payment_period']),'id="employee_payment_period" class="form-control select2me" onChange="function_elements_add_payment(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="payment_basic_salary" name="payment_basic_salary" onChange="function_elements_add_payment(this.name, this.value);" value="<?php echo $data['payment_basic_salary'];?>">
			<label class="control-label">Basic Salary </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="payment_basic_overtime" name="payment_basic_overtime" onChange="function_elements_add_payment(this.name, this.value);" value="<?php echo $data['payment_basic_overtime'];?>">
			<label class="control-label">Basic Overtime </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('bank_id', $corebank ,set_value('bank_id',$data['bank_id']),'id="bank_id", class="form-control select2me" onChange="function_elements_add_payment(this.name, this.value);" onChange="function_elements_add_payment(this.name, this.value);"');?>
			<label class="control-label">Bank Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="payment_bank_acct_name" name="payment_bank_acct_name" onChange="function_elements_add_payment(this.name, this.value);" value="<?php echo $data['payment_bank_acct_name'];?>">
			<label class="control-label">Bank Account Name </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="payment_bank_acct_no" name="payment_bank_acct_no" onChange="function_elements_add_payment(this.name, this.value);" value="<?php echo $data['payment_bank_acct_no'];?>">
			<label class="control-label">Bank Account No </label>
		</div>	
	</div>
</div>
								
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_payment();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Payment Period</th>
						<th>Basic Salary</th>
						<th>Basic Overtime</th>
						<th>Bank Name</th>
						<th>Bank Acct Name</th>
						<th>Bank Acct No</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeepayment)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeepayment as $key=>$val){
							echo"
								<tr>
									<td>".$val['employee_payment_period']."</td>
									<td>".nominal($val['payment_basic_salary'])."</td>
									<td>".nominal($val['payment_basic_overtime'])."</td>
									<td>".$val['bank_name']."</td>
									<td>".$val['payment_bank_acct_name']."</td>
									<td>".$val['payment_bank_acct_no']."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeedatackp/deletePayrollEmployeePayment/'.$val['employee_id']."/".$val['employee_payment_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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