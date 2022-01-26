<script>
	base_url 	= '<?php echo base_url();?>';


	
	
	function reset_edit_payment(){
		document.location = base_url+"PayrollPeriodData/reset_edit_payment";
	}

	function function_elements_edit_payment(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollPeriodData/function_elements_edit_payment');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processEditArrayPayrollPeriodPayment(){
		
		var period_payment_working_start	= document.getElementById("period_payment_working_start").value;
		var period_payment_working_end		= document.getElementById("period_payment_working_end").value;
		var basic_salary_monthly			= document.getElementById("basic_salary_monthly").value;
		var basic_salary_daily				= document.getElementById("basic_salary_daily").value;
		var basic_overtime					= document.getElementById("basic_overtime").value;
		var meal_subvention_monthly			= document.getElementById("meal_subvention_monthly").value;
		var meal_subvention_daily			= document.getElementById("meal_subvention_daily").value;
		var employee_employment_status		= document.getElementById("employee_employment_status_payment").value;
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('PayrollPeriodData/processEditArrayPayrollPeriodPayment');?>",
			  data: {
					'period_payment_working_start'	: period_payment_working_start,	
					'period_payment_working_end'	: period_payment_working_end,	
					'basic_salary_monthly'			: basic_salary_monthly,	
					'basic_salary_daily'			: basic_salary_daily,	
					'basic_overtime'				: basic_overtime,	
					'meal_subvention_monthly'		: meal_subvention_monthly,	
					'meal_subvention_daily'			: meal_subvention_daily,
					'employee_employment_status'	: employee_employment_status,
					'session_name' 					: "editarraypurchaseorderitem-"
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
	
	for($i = ($year_now-1); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				
<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('editpayrollperiodpayment-'.$unique['unique']);
	$payrollperiodpayment	= $this->session->userdata('editarraypayrollperiodpayment-'.$unique['unique']);

	/*print_r("payrollperiodpayment");
	print_r($payrollperiodpayment);*/
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="period_payment_working_start" name="period_payment_working_start" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['period_payment_working_start'];?>">
			<label class="control-label">Mulai Bekerja </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="period_payment_working_end" name="period_payment_working_end" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['period_payment_working_end'];?>">
			<label class="control-label">Selesai Bekerja </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="basic_salary_monthly" name="basic_salary_monthly" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['basic_salary_monthly'];?>">
			<label class="control-label">Gaji Pokok Bulanan</label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="basic_salary_daily" name="basic_salary_daily" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['basic_salary_daily'];?>">
			<label class="control-label">Gaji Pokok Harian </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="meal_subvention_monthly" name="meal_subvention_monthly" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['meal_subvention_monthly'];?>">
			<label class="control-label">Meal Subvention Bulanan </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="meal_subvention_daily" name="meal_subvention_daily" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['meal_subvention_daily'];?>">
			<label class="control-label">Meal Subvention Harian </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="basic_overtime" name="basic_overtime" onChange="function_elements_edit_payment(this.name, this.value);" value="<?php echo $data['basic_overtime'];?>">
			<label class="control-label">Dasar Lembur</label>
		</div>	
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_employment_status_payment', $employeeemploymentstatus, set_value('employee_employment_status_payment', $data['employee_employment_status_payment']), 'id="employee_employment_status_payment" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Status Karyawan
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>
								
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonEditArrayPayrollPeriodPayment" value="Reset" class="btn red" title="Reset" onClick="reset_edit_payment();">
		<input type="button" name="Edit2" id="buttonEditArrayPayrollPeriodPayment" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayPayrollPeriodPayment();">
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
						<th>Working Start</th>
						<th>Working End</th>
						<th>Gaji Pokok Monthly</th>
						<th>Gaji Pokok Daily</th>
						<th>Basic Overtime</th>
						<th>Meal Subvention Monthly</th>
						<th>Meal Subvention Daily</th>
						<th>Employee Status</th>
						<th>Item Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollperiodpayment)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollperiodpayment as $key=>$val){
							if ($val['item_status'] <> 2){
								echo"
									<tr>
										<td style='text-align  : right !important;'>".$val['period_payment_working_start']."</td>
										<td style='text-align  : right !important;'>".$val['period_payment_working_end']."</td>
										<td style='text-align  : right !important;'>".nominal($val['basic_salary_monthly'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['basic_salary_daily'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['basic_overtime'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['meal_subvention_monthly'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['meal_subvention_daily'])."</td>
										<td style='text-align  : right !important;'>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
										<td style='text-align  : right !important;'>".$val['item_status']."</td>
										<td>
											<a href='".$this->config->item('base_url').'PayrollPeriodData/deleteEditArrayPayrollPeriodPayment/'.$val['record_id']."/".$payrollperiod['payroll_period_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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