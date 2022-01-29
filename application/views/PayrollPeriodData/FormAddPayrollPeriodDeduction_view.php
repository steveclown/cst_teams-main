<script>
	base_url = '<?php echo base_url(); ?>';
	mappia = "<?php echo site_url('payroll-period-data/add'); ?>";

	function reset_add_deduction() {
		document.location = base_url + "payrollperioddata/reset_add_deduction";
	}

	function function_elements_add_deduction(name, value) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('payrollperioddata/function_elements_add_deduction'); ?>",
			data: {
				'name': name,
				'value': value
			},
			success: function(msg) {}
		});
	}

	function processAddArrayPayrollPeriodDeduction() {
		var deduction_id = document.getElementById("deduction_id").value;
		var period_deduction_working_start = document.getElementById("period_deduction_working_start").value;
		var period_deduction_working_end = document.getElementById("period_deduction_working_end").value;
		var period_deduction_amount_monthly = document.getElementById("period_deduction_amount_monthly").value;
		var period_deduction_amount_daily = document.getElementById("period_deduction_amount_daily").value;
		var period_deduction_description = document.getElementById("period_deduction_description").value;
		var employee_employment_status = document.getElementById("employee_employment_status").value;


		$('#offspinwarehouse').css('display', 'none');
		$('#onspinspinwarehouse').css('display', 'table-row');
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('payrollperioddata/processAddArrayPayrollPeriodDeduction'); ?>",
			data: {
				'deduction_id': deduction_id,
				'period_deduction_working_start': period_deduction_working_start,
				'period_deduction_working_end': period_deduction_working_end,
				'period_deduction_amount_monthly': period_deduction_amount_monthly,
				'period_deduction_amount_daily': period_deduction_amount_daily,
				'period_deduction_description': period_deduction_description,
				'employee_employment_status': employee_employment_status,
				'session_name': "addarraypurchaseorderitem-"
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

for ($i = ($year_now - 1); $i < ($year_now + 2); $i++) {
	$year[$i] = $i;
}
?>

<?php
$unique 				= $this->session->userdata('unique');
$data 					= $this->session->userdata('addpayrollperioddeduction-' . $unique['unique']);
$payrollperioddeduction	= $this->session->userdata('addarraypayrollperioddeduction-' . $unique['unique']);


if (empty($data['deduction_id'])) {
	$data['deduction_id']								= '';
}

if (empty($data['period_deduction_working_start'])) {
	$data['period_deduction_working_start']				= '';
}

if (empty($data['period_deduction_working_end'])) {
	$data['period_deduction_working_end']				= '';
}

if (empty($data['period_deduction_amount_monthly'])) {
	$data['period_deduction_amount_monthly']			= '';
}

if (empty($data['period_deduction_amount_daily'])) {
	$data['period_deduction_amount_daily']				= '';
}

if (empty($data['period_deduction_description'])) {
	$data['period_deduction_description']				= '';
}

if (empty($data['employee_employment_status'])) {
	$data['employee_employment_status']					= '';
}


echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('deduction_id', $corededuction, set_value('deduction_id', $data['deduction_id']), 'id="deduction_id", class="form-control select2me" onChange="function_elements_add_deduction(this.name, this.value);"'); ?>
			<label class="control-label">Nama Potongan
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
			<input type="text" autocomplete="off" class="form-control" id="period_deduction_working_start" name="period_deduction_working_start" onChange="function_elements_add_deduction(this.name, this.value);" value="<?php echo $data['period_deduction_working_start']; ?>">
			<label class="control-label">Mulai Bekerja </label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" class="form-control" id="period_deduction_working_end" name="period_deduction_working_end" onChange="function_elements_add_deduction(this.name, this.value);" value="<?php echo $data['period_deduction_working_end']; ?>">
			<label class="control-label">Selesai Bekerja </label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" name="period_deduction_amount_monthly" id="period_deduction_amount_monthly" value="<?php echo $data['period_deduction_amount_monthly'] ?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Jumlah Potongan bulanan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off" name="period_deduction_amount_daily" id="period_deduction_amount_daily" value="<?php echo $data['period_deduction_amount_daily'] ?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Jumlah Potongan harian
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
			<input type="text" autocomplete="off" name="period_deduction_description" id="period_deduction_description" value="<?php echo $data['period_deduction_description'] ?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Deskripsi</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
			echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status', $data['employee_employment_status']), 'id="employee_employment_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>

			<label for="form_control">Status Karyawan
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayPayrollPeriodDeduction" value="Batal" class="btn red" title="Reset" onClick="reset_add_deduction();">
		<input type="button" name="Add2" id="buttonAddArrayPayrollPeriodDeduction" value="Tambah" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayPayrollPeriodDeduction();">
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
						<th>Nama Potongan</th>
						<th>Mulai Bekerja</th>
						<th>Selesai Bekerja</th>
						<th>Jumlah Potongan Bulanan</th>
						<th>Jumlah Potongan Harian</th>
						<th>Deskripsi</th>
						<th>Status Karyawan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!is_array($payrollperioddeduction)) {
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
					} else {
						foreach ($payrollperioddeduction as $key => $val) {
							echo "
								<tr>
									<td>" . $this->PayrollPeriodData_model->getDeductionName($val['deduction_id']) . "</td>
									<td style='text-align  : right !important;'>" . $val['period_deduction_working_start'] . "</td>
									<td style='text-align  : right !important;'>" . $val['period_deduction_working_end'] . "</td>
									<td style='text-align  : right !important;'>" . nominal($val['period_deduction_amount_monthly']) . "</td>
									<td style='text-align  : right !important;'>" . nominal($val['period_deduction_amount_daily']) . "</td>
									<td>" . $val['period_deduction_description'] . "</td>
									<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
									<td>
										<a href='" . $this->config->item('base_url') . 'payrollperioddata/deleteArrayPayrollPeriodDeduction/' . $val['deduction_id'] . "' onClick='javascript:return confirm(\"Apakah Anda yakin akan menghapus data ini ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
										</a>";
							echo "
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