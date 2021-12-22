<script>
	base_url 	= '<?php echo base_url();?>';
	

	function reset_edit_allowance(){
		document.location = base_url+"PayrollPeriodData/reset_edit_allowance";
	}

	function function_elements_edit_allowance(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollPeriodData/function_elements_edit_allowance');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processEditArrayPayrollPeriodAllowance(){
		var allowance_id						= document.getElementById("allowance_id").value;
		var period_allowance_working_start		= document.getElementById("period_allowance_working_start").value;
		var period_allowance_working_end		= document.getElementById("period_allowance_working_end").value;
		var period_allowance_amount_monthly		= document.getElementById("period_allowance_amount_monthly").value;
		var period_allowance_amount_daily		= document.getElementById("period_allowance_amount_daily").value;
		var period_allowance_description		= document.getElementById("period_allowance_description").value;
		var employee_employment_status			= document.getElementById("employee_employment_status_allowance").value;
		
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('PayrollPeriodData/processEditArrayPayrollPeriodAllowance');?>",
			  data: {
					'allowance_id'			 			: allowance_id,	
					'period_allowance_working_start'	: period_allowance_working_start,	
					'period_allowance_working_end'		: period_allowance_working_end,	
					'period_allowance_amount_monthly'	: period_allowance_amount_monthly,	
					'period_allowance_amount_daily'		: period_allowance_amount_daily,	
					'period_allowance_description'		: period_allowance_description,	
					'employee_employment_status'		: employee_employment_status,	
					'session_name' 						: "editarraypurchaseorderitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});

	}
</script>

				
<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('editpayrollperiodallowance-'.$unique['unique']);
	$payrollperiodallowance	= $this->session->userdata('editarraypayrollperiodallowance-'.$unique['unique']);

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<?php 
	$year_now 	=	date('Y');
	// if(!is_array($payrollperiodallowance)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	// for($i = ($year_now-1); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 

	if (empty($data['employee_employment_status_allowance'])) {
		$data['employee_employment_status_allowance']=9;
		# code...
	}
	if (empty($data['allowance_id'])) {
		$data['allowance_id']=9;
		# code...
	}
	if (empty($data['period_allowance_working_start'])) {
		$data['period_allowance_working_start']="";
		# code...
	}
	if (empty($data['period_allowance_working_end'])) {
		$data['period_allowance_working_end']="";
		# code...
	}
	if (empty($data['period_allowance_amount_monthly'])) {
		$data['period_allowance_amount_monthly']="";
		# code...
	}
	if (empty($data['period_allowance_amount_daily'])) {
		$data['period_allowance_amount_daily']="";
		# code...
	}
	if (empty($data['period_allowance_description'])) {
		$data['period_allowance_description']="";
		# code...
	}
	if (empty($data['period_allowance_amount_monthly'])) {
		$data['period_allowance_amount_monthly']="";
		# code...
	}

?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('allowance_id', $coreallowance ,set_value('allowance_id', $data['allowance_id']),'id="allowance_id", class="form-control select2me" onChange="function_elements_edit_allowance(this.name, this.value);"');?>
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
			<input type="text" class="form-control" id="period_allowance_working_start" name="period_allowance_working_start" onChange="function_elements_edit_allowance(this.name, this.value);" value="<?php echo $data['period_allowance_working_start'];?>">
			<label class="control-label">Working Start </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="period_allowance_working_end" name="period_allowance_working_end" onChange="function_elements_edit_allowance(this.name, this.value);" value="<?php echo $data['period_allowance_working_end'];?>">
			<label class="control-label">Working End </label>
		</div>	
	</div>
</div>
	
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="period_allowance_amount_monthly" id="period_allowance_amount_monthly" value="<?php echo $data['period_allowance_amount_monthly']?>" class="form-control" onChange="function_elements_edit_allowance(this.name, this.value);">
			<label class="control-label">Allowance Amount Monthly
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="period_allowance_amount_daily" id="period_allowance_amount_daily" value="<?php echo $data['period_allowance_amount_daily']?>" class="form-control" onChange="function_elements_edit_allowance(this.name, this.value);">
			<label class="control-label">Allowance Amount Daily
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
			<input type="text" name="period_allowance_description" id="period_allowance_description" value="<?php echo $data['period_allowance_description']?>" class="form-control" onChange="function_elements_edit_allowance(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_employment_status_allowance', $employeeemploymentstatus, set_value('employee_employment_status_allowance', $data['employee_employment_status_allowance']), 'id="employee_employment_status_allowance" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Employee Status
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>
								
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonEditArrayPayrollPeriodAllowance" value="Reset" class="btn red" title="Reset" onClick="reset_edit_allowance();">
		<input type="button" name="Edit2" id="buttonEditArrayPayrollPeriodAllowance" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayPayrollPeriodAllowance();">
	</div>
</div>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Allowance Name</th>
						<th>Working Start</th>
						<th>Working End</th>
						<th>Allowance Amount Monthly</th>
						<th>Allowance Amount Daily</th>
						<th>Allowance Description</th>
						<th>Employee Status</th>
						<th>Item Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollperiodallowance)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollperiodallowance as $key => $val){
							if ($val['item_status'] <> 2){
								echo"
									<tr>
										<td>".$this->PayrollPeriodData_model->getAllowanceName($val['allowance_id'])."</td>
										<td style='text-align  : right !important;'>".$val['period_allowance_working_start']."</td>
										<td style='text-align  : right !important;'>".$val['period_allowance_working_end']."</td>
										<td style='text-align  : right !important;'>".nominal($val['period_allowance_amount_monthly'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['period_allowance_amount_daily'])."</td>
										<td>".$val['period_allowance_description']."</td>
										<td style='text-align  : right !important;'>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
										<td>".$val['item_status']."</td>
										<td>
											<a href='".$this->config->item('base_url').'PayrollPeriodData/deleteEditArrayPayrollPeriodAllowance/'.$val['record_id']."/".$payrollperiod['payroll_period_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Delete
											</a>";
										echo"
									</tr>
									
								";
							}
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>