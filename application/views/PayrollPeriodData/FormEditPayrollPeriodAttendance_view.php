<script>
	base_url = '<?php echo base_url(); ?>';

	function reset_edit_attendance() {
		document.location = base_url + "PayrollPeriodData/reset_edit_attendance";
	}

	function function_elements_edit_attendance(name, value) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('PayrollPeriodData/function_elements_edit_attendance'); ?>",
			data: {
				'name': name,
				'value': value
			},
			success: function(msg) {}
		});
	}

	function processEditArrayPayrollPeriodAttendance() {
		var premi_attendance_id = document.getElementById("premi_attendance_id").value;
		var period_attendance_working_start = document.getElementById("period_attendance_working_start").value;
		var period_attendance_working_end = document.getElementById("period_attendance_working_end").value;
		var period_attendance_amount_monthly = document.getElementById("period_attendance_amount_monthly").value;
		var period_attendance_amount_daily = document.getElementById("period_attendance_amount_daily").value;
		var period_attendance_description = document.getElementById("period_attendance_description").value;
		var employee_employment_status = document.getElementById("employee_employment_status_attendance").value;


		$('#offspinwarehouse').css('display', 'none');
		$('#onspinspinwarehouse').css('display', 'table-row');
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('PayrollPeriodData/processEditArrayPayrollPeriodAttendance'); ?>",
			data: {
				'premi_attendance_id': premi_attendance_id,
				'period_attendance_working_start': period_attendance_working_start,
				'period_attendance_working_end': period_attendance_working_end,
				'period_attendance_amount_monthly': period_attendance_amount_monthly,
				'period_attendance_amount_daily': period_attendance_amount_daily,
				'period_attendance_description': period_attendance_description,
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
$unique 				= $this->session->userdata('unique');
$data 					= $this->session->userdata('editpayrollperiodattendance-' . $unique['unique']);
$payrollperiodattendance	= $this->session->userdata('editarraypayrollperiodattendance-' . $unique['unique']);

echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('premi_attendance_id', $corepremiattendance, set_value('premi_attendance_id', $data['premi_attendance_id']), 'id="premi_attendance_id", class="form-control select2me" onChange="function_elements_edit_attendance(this.name, this.value);"'); ?>
			<label class="control-label">Attendance Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" class="form-control" id="period_attendance_working_start" name="period_attendance_working_start" onChange="function_elements_edit_attendance(this.name, this.value);" value="<?php echo $data['period_attendance_working_start']; ?>">
			<label class="control-label">Working Start </label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" class="form-control" id="period_attendance_working_end" name="period_attendance_working_end" onChange="function_elements_edit_attendance(this.name, this.value);" value="<?php echo $data['period_attendance_working_end']; ?>">
			<label class="control-label">Working End </label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" name="period_attendance_amount_monthly" id="period_attendance_amount_monthly" value="<?php echo $data['period_attendance_amount_monthly'] ?>" class="form-control" onChange="function_elements_edit_attendance(this.name, this.value);">
			<label class="control-label">Attendance Amount Monthly
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" name="period_attendance_amount_daily" id="period_attendance_amount_daily" value="<?php echo $data['period_attendance_amount_daily'] ?>" class="form-control" onChange="function_elements_edit_attendance(this.name, this.value);">
			<label class="control-label">Attendance Amount Daily
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" name="period_attendance_description" id="period_attendance_description" value="<?php echo $data['period_attendance_description'] ?>" class="form-control" onChange="function_elements_edit_attendance(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
			echo form_dropdown('employee_employment_status_attendance', $employeeemploymentstatus, set_value('employee_employment_status_attendance', $data['employee_employment_status_attendance']), 'id="employee_employment_status_attendance" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Employee Status
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonEditArrayPayrollPeriodAttendance" value="Reset" class="btn red" title="Reset" onClick="reset_edit_attendance();">
		<input type="button" name="Edit2" id="buttonEditArrayPayrollPeriodAttendance" value="Edit" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayPayrollPeriodAttendance();">
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
						<th>Attendance Name</th>
						<th>Working Start</th>
						<th>Working End</th>
						<th>Attendance Amount Monthly</th>
						<th>Attendance Amount Daily</th>
						<th>Attendance Description</th>
						<th>Employee Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!is_array($payrollperiodattendance)) {
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollperiodattendance as $key => $val) {
							if ($val['item_status'] <> 2) {
								echo "
									<tr>
										<td>" . $this->PayrollPeriodData_model->getPremiAttendanceName($val['premi_attendance_id']) . "</td>
										<td style='text-align  : right !important;'>" . $val['period_attendance_working_start'] . "</td>
										<td style='text-align  : right !important;'>" . $val['period_attendance_working_end'] . "</td>
										<td style='text-align  : right !important;'>" . nominal($val['period_attendance_amount_monthly']) . "</td>
										<td style='text-align  : right !important;'>" . nominal($val['period_attendance_amount_daily']) . "</td>
										<td>" . $val['period_attendance_description'] . "</td>
										<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
										<td>
											<a href='" . $this->config->item('base_url') . 'PayrollPeriodData/deleteEditArrayPayrollPeriodAttendance/' . $val['record_id'] . "/" . $payrollperiod['payroll_period_id'] . "' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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