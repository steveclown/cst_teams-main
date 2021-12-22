<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add_deduction(){
		document.location = base_url+"payrollemployeedata/reset_add_deduction/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add_deduction(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedata/function_elements_add_deduction');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
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
	echo form_open('payrollemployeedata/processAddPayrollEmployeeDeduction',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollemployeededuction-'.$unique['unique']);
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_deduction_period', $year,set_value('employee_deduction_period',$data['employee_deduction_period']),'id="employee_deduction_period" class="form-control select2me" onChange="function_elements_add_deduction(this.name, this.value);" ');
			?>
			<label>Period</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('deduction_id', $corededuction ,set_value('deduction_id',$data['deduction_id']),'id="deduction_id", class="form-control select2me" onChange="function_elements_add_deduction(this.name, this.value);"');?>
			<label class="control-label">Deduction Name
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
			<input type="text" name="employee_deduction_amount" id="employee_deduction_amount" value="<?php echo $data['employee_deduction_amount']?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Amount
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_deduction_description" id="employee_deduction_description" value="<?php echo $data['employee_deduction_description']?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>
</div>
								
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_deduction();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Deduction Period</th>
						<th>Deduction Name</th>
						<th>Deduction Description</th>
						<th>Deduction Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeededuction)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeededuction as $key=>$val){
							echo"
								<tr>
									<td>".$val['employee_deduction_period']."</td>
									<td>".$val['deduction_name']."</td>
									<td>".$val['employee_deduction_description']."</td>
									<td>".nominal($val['employee_deduction_amount'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeedata/deletePayrollEmployeeDeduction/'.$val['employee_id']."/".$val['employee_deduction_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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