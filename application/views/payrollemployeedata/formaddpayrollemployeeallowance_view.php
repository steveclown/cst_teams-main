<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add_allowance(){
		document.location = base_url+"payrollemployeedata/reset_add_allowance";
	}

	function function_elements_add_allowance(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedata/function_elements_add_allowance');?>",
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
	echo form_open('payrollemployeedata/processAddPayrollEmployeeAllowance',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollemployeeallowance-'.$unique['unique']);

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_allowance_period', $year,set_value('employee_allowance_period',$data['employee_allowance_period']),'id="employee_allowance_period" class="form-control select2me" onChange="function_elements_add_allowance(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('allowance_id', $coreallowance ,set_value('allowance_id',$data['allowance_id']),'id="allowance_id", class="form-control select2me" onChange="function_elements_add_allowance(this.name, this.value);"');?>
			<label class="control-label">Allowance Name
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
			<input type="text" autocomplete="off"  name="employee_allowance_amount" id="employee_allowance_amount" value="<?php echo $data['employee_allowance_amount']?>" class="form-control" onChange="function_elements_add_allowance(this.name, this.value);">
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
			<input type="text" autocomplete="off"  name="employee_allowance_description" id="employee_allowance_description" value="<?php echo $data['employee_allowance_description']?>" class="form-control" onChange="function_elements_add_allowance(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>
</div>
								
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_allowance();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Allowance Period</th>
						<th>Allowance Name</th>
						<th>Allowance Description</th>
						<th>Allowance Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeeallowance)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeeallowance as $key=>$val){
							echo"
								<tr>
									<td>".$val['employee_allowance_period']."</td>
									<td>".$val['allowance_name']."</td>
									<td>".$val['employee_allowance_description']."</td>
									<td>".nominal($val['employee_allowance_amount'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeedata/deletePayrollEmployeeAllowance/'.$val['employee_id']."/".$val['employee_allowance_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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