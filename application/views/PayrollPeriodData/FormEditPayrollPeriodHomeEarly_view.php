<script>
	base_url = '<?php echo base_url(); ?>';


	function reset_edit_home_early() {
		document.location = base_url + "PayrollPeriodData/reset_edit_home_early";
	}

	function function_elements_edit_home_early(name, value) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('PayrollPeriodData/function_elements_edit_home_early'); ?>",
			data: {
				'name': name,
				'value': value
			},
			success: function(msg) {}
		});
	}

	function processEditArrayPayrollPeriodHomeEarly() {
		var period_home_early_hour_start = document.getElementById("period_home_early_hour_start").value;
		var period_home_early_hour_end = document.getElementById("period_home_early_hour_end").value;
		var employee_attendance_incentive_status = document.getElementById("employee_attendance_incentive_status").value;
		var employee_employment_status = document.getElementById("employee_employment_status_early").value;


		$('#offspinwarehouse').css('display', 'none');
		$('#onspinspinwarehouse').css('display', 'table-row');
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('PayrollPeriodData/processEditArrayPayrollPeriodHomeEarly'); ?>",
			data: {
				'period_home_early_hour_start': period_home_early_hour_start,
				'period_home_early_hour_end': period_home_early_hour_end,
				'employee_attendance_incentive_status': employee_attendance_incentive_status,
				'employee_employment_status': employee_employment_status,
				'session_name': "editarraypurchaseorderitem-"
			},
			success: function(msg) {
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
$unique 					= $this->session->userdata('unique');
$data 						= $this->session->userdata('editpayrollperiodhomeearly-' . $unique['unique']);
$payrollperiodhomeearly		= $this->session->userdata('editarraypayrollperiodhomeearly-' . $unique['unique']);

echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
			echo form_dropdown('employee_employment_status_early', $employeeemploymentstatus, set_value('employee_employment_status_early', $data['employee_employment_status_early']), 'id="employee_employment_status_early" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Employee Status
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" class="form-control" id="period_home_early_hour_start" name="period_home_early_hour_start" onChange="function_elements_edit_home_early(this.name, this.value);" value="<?php echo $data['period_home_early_hour_start']; ?>">
			<label class="control-label">Home Early Hour Start</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" class="form-control" id="period_home_early_hour_end" name="period_home_early_hour_end" onChange="function_elements_edit_home_early(this.name, this.value);" value="<?php echo $data['period_home_early_hour_end']; ?>">
			<label class="control-label">Home Early Hour End </label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
			echo form_dropdown('employee_attendance_incentive_status', $employeeattendanceincentivestatus, set_value('employee_attendance_incentive_status', $data['employee_attendance_incentive_status']), 'id="employee_attendance_incentive_status" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Employee Attendance Incentive Status
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonEditArrayPayrollPeriodHomeEarlyReset" value="Reset" class="btn red" title="Reset" onClick="reset_edit_home_early();">
		<input type="button" name="Edit2" id="buttonEditArrayPayrollPeriodHomeEarly" value="Edit" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayPayrollPeriodHomeEarly();">
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
						<th>Home Early Hour Start</th>
						<th>Home Early Hour End</th>
						<th>Incentive Status</th>
						<th>Employee Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!is_array($payrollperiodhomeearly)) {
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollperiodhomeearly as $key => $val) {
							if ($val['item_status'] <> 2) {
								echo "
									<tr>
										<td style='text-align  : right !important;'>" . $val['period_home_early_hour_start'] . "</td>
										<td style='text-align  : right !important;'>" . $val['period_home_early_hour_end'] . "</td>
										<td style='text-align  : right !important;'>" . $employeeattendanceincentivestatus[$val['employee_attendance_incentive_status']] . "</td>
										<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
										<td>
											<a href='" . $this->config->item('base_url') . 'PayrollPeriodData/deleteEditArrayPayrollPeriodHomeEarly/' . $val['record_id'] . "/" . $payrollperiod['payroll_period_id'] . "' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Delete
											</a>";
								echo "
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