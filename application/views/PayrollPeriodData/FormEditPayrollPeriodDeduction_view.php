<script>
	base_url 	= '<?php echo base_url();?>';
	

	function reset_edit_deduction(){
		document.location = base_url+"PayrollPeriodData/reset_edit_deduction";
	}

	function function_elements_edit_deduction(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollPeriodData/function_elements_edit_deduction');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processEditArrayPayrollPeriodDeduction(){
		var deduction_id						= document.getElementById("deduction_id").value;
		var period_deduction_working_start		= document.getElementById("period_deduction_working_start").value;
		var period_deduction_working_end		= document.getElementById("period_deduction_working_end").value;
		var period_deduction_amount_monthly		= document.getElementById("period_deduction_amount_monthly").value;
		var period_deduction_amount_daily		= document.getElementById("period_deduction_amount_daily").value;
		var period_deduction_description		= document.getElementById("period_deduction_description").value;
		var employee_employment_status			= document.getElementById("employee_employment_status").value;

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('PayrollPeriodData/processEditArrayPayrollPeriodDeduction');?>",
			  data: {
					'deduction_id'			 			: deduction_id,	
					'period_deduction_working_start'	: period_deduction_working_start,	
					'period_deduction_working_end'		: period_deduction_working_end,	
					'period_deduction_amount_monthly'	: period_deduction_amount_monthly,	
					'period_deduction_amount_daily'		: period_deduction_amount_daily,	
					'period_deduction_description'		: period_deduction_description,	
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
	$year_now 	=	date('Y');
	// if(!is_array($sesi)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	// for($i = ($year_now-1); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 
?>
				
<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('editpayrollperioddeduction-'.$unique['unique']);
	$payrollperioddeduction	= $this->session->userdata('editarraypayrollperioddeduction-'.$unique['unique']);

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('deduction_id', $corededuction ,set_value('deduction_id', $data['deduction_id']),'id="deduction_id", class="form-control select2me" onChange="function_elements_edit_deduction(this.name, this.value);"');?>
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
			<input type="text" autocomplete="off"  class="form-control" id="period_deduction_working_start" name="period_deduction_working_start" onChange="function_elements_edit_deduction(this.name, this.value);" value="<?php echo $data['period_deduction_working_start'];?>">
			<label class="control-label">Working Start </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="period_deduction_working_end" name="period_deduction_working_end" onChange="function_elements_edit_deduction(this.name, this.value);" value="<?php echo $data['period_deduction_working_end'];?>">
			<label class="control-label">Working End </label>
		</div>	
	</div>
</div>
	
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="period_deduction_amount_monthly" id="period_deduction_amount_monthly" value="<?php echo $data['period_deduction_amount_monthly']?>" class="form-control" onChange="function_elements_edit_deduction(this.name, this.value);">
			<label class="control-label">Deduction Amount Monthly
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="period_deduction_amount_daily" id="period_deduction_amount_daily" value="<?php echo $data['period_deduction_amount_daily']?>" class="form-control" onChange="function_elements_edit_deduction(this.name, this.value);">
			<label class="control-label">Deduction Amount Daily
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
			<input type="text" autocomplete="off"  name="period_deduction_description" id="period_deduction_description" value="<?php echo $data['period_deduction_description']?>" class="form-control" onChange="function_elements_edit_deduction(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status', $data['employee_employment_status']), 'id="employee_employment_status" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Employee Status
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>
								
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonEditArrayPayrollPeriodDeduction" value="Reset" class="btn red" title="Reset" onClick="reset_edit_deduction();">
		<input type="button" name="Edit2" id="buttonEditArrayPayrollPeriodDeduction" value="Edit" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayPayrollPeriodDeduction();">
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
						<th>Deduction Name</th>
						<th>Working Start</th>
						<th>Working End</th>
						<th>Deduction Amount Monthly</th>
						<th>Deduction Amount Daily</th>
						<th>Deduction Description</th>
						<th>Employee Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollperioddeduction)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollperioddeduction as $key => $val){
							if ($val['item_status'] <> 2){
								echo"
									<tr>
										<td>".$this->PayrollPeriodData_model->getDeductionName($val['deduction_id'])."</td>
										<td style='text-align  : right !important;'>".$val['period_deduction_working_start']."</td>
										<td style='text-align  : right !important;'>".$val['period_deduction_working_end']."</td>
										<td style='text-align  : right !important;'>".nominal($val['period_deduction_amount_monthly'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['period_deduction_amount_daily'])."</td>
										<td>".$val['period_deduction_description']."</td>
										<td>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
										<td>
											<a href='".$this->config->item('base_url').'PayrollPeriodData/deleteEditArrayPayrollPeriodDeduction/'.$val['deduction_id']."/".$payrollperiod['payroll_period_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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