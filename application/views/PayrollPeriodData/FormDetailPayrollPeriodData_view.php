<script>
	base_url = '<?php echo base_url() ?>';

	function reset_add() {
		document.location = base_url + "PayrollPeriodData/reset_add/";
	}

	function function_elements_add(name, value) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('PayrollPeriodData/function_elements_add'); ?>",
			data: {
				'name': name,
				'value': value
			},
			success: function(msg) {
				// alert(name);
			}
		});
	}

	function function_state_add(value) {
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('PayrollPeriodData/function_state_add'); ?>",
			data: {
				'value': value
			},
			success: function(msg) {}
		});
	}
</script>

<style>
	th {
		font-size: 14px !important;
		font-weight: bold !important;
		text-align: center !important;
		margin: 0 auto;
		vertical-align: middle !important;
	}

	td {
		font-size: 12px !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align: middle !important;
	}

	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
</style>



<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url(); ?>">
				BEranda
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>PayrollPeriodData">
				Daftar Data Periode Penggajian
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>PayrollPeriodData/showdetail/<?php echo $this->uri->segment(3); ?>">
				Detail Data Periode Penggajian
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Detail Data Periode Penggajian
</h3>
<!-- END PAGE TITLE & BREADCRUMB-->




<?php
$unique 				= $this->session->userdata('unique');
$data 					= $this->session->userdata('addPayrollPeriodData-' . $unique['unique']);

$year_now 	=	date('Y');
// if(!is_array($sesi)){
// 	$sesi['month']			= date('m');
// 	$sesi['year']			= $year_now;
// }

for ($i = ($year_now - 1); $i < ($year_now + 2); $i++) {
	$year[$i] = $i;
}

echo form_open('PayrollPeriodData/processAddPayrollPeriodData', array('id' => 'myform', 'class' => 'horizontal-form'));
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url(); ?>payroll-period-data" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">

					<?php
					echo $this->session->userdata('message');
					$this->session->unset_userdata('message');
					?>
					<h3>Periode Penggajian Payment</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Payment Period</th>
											<th>Nama Pekerjaan</th>
											<th>Mulai Bekerja</th>
											<th>Selesai Bekerja</th>
											<th>Gaji Pokok Bulanan</th>
											<th>Gaji POkok Harian</th>
											<th>dasar Lembur</th>
											<th>Uang Makan Bulanan</th>
											<th>Uang Makan Harian</th>
											<th>Status Karyawan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!is_array($payrollperiodpayment)) {
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
										} else {
											foreach ($payrollperiodpayment as $key => $val) {
												echo "
													<tr>
														<td style='text-align  : right !important;'>" . $val['period_payment_period'] . "</td>
														<td>" . $this->PayrollPeriodData_model->getJobTitleName($val['job_title_id']) . "</td>
														<td style='text-align  : right !important;'>" . $val['period_payment_working_start'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_payment_working_end'] . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['basic_salary_monthly']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['basic_salary_daily']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['basic_overtime']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['meal_subvention_monthly']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['meal_subvention_daily']) . "</td>
														<td style='text-align  : right !important;'>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
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

					<h3>Periode Penggajian Tunjangan</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Periode Penggajian</th>
											<th>Nama Tunjangan</th>
											<th>Mulai Bekerja</th>
											<th>Selesai Bekerja</th>
											<th>Jumlah Tunjangan Bulanan</th>
											<th>Jumlah Tunjangan Harian</th>
											<th>Deskripsi Tunjangan</th>
											<th>Status Karyawan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!is_array($payrollperiodallowance)) {
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
										} else {
											foreach ($payrollperiodallowance as $key => $val) {
												echo "
													<tr>
														<td>" . $val['period_allowance_period'] . "</td>
														<td>" . $val['allowance_name'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_allowance_working_start'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_allowance_working_end'] . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_allowance_amount_monthly']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_allowance_amount_daily']) . "</td>
														<td>" . $val['period_allowance_description'] . "</td>
														<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
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

					<h3>Periode Penggajian Potongan</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Periode Penggajian</th>
											<th>Nama Potongan</th>
											<th>Mulai Bekerja</th>
											<th>Working End</th>
											<th>Jumlah Potongant Bulanan</th>
											<th>Jumlah Potongan Harian</th>
											<th>Deskripsi Potongan</th>
											<th>Status Karyawan</th>
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
														<td>" . $val['period_deduction_period'] . "</td>
														<td>" . $val['deduction_id'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_deduction_working_start'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_deduction_working_end'] . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_deduction_amount_monthly']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_deduction_amount_daily']) . "</td>
														<td>" . $val['period_deduction_description'] . "</td>
														<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
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

					<h3>Periode Penggajian Kehadiran</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Periode Penggajian</th>
											<th>Nama Kehadiran</th>
											<th>Mulai Bekerja</th>
											<th>Working End</th>
											<th>Jumlah Kehadiran Bulanan</th>
											<th>Jumlah Kehadiran Harian</th>
											<th>Deskripsi Kehadiran</th>
											<th>Status Karyawan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!is_array($payrollperiodattendance)) {
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
										} else {
											foreach ($payrollperiodattendance as $key => $val) {
												echo "
													<tr>
														<td>" . $val['period_attendance_period'] . "</td>
														<td>" . $val['premi_attendance_id'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_attendance_working_start'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_attendance_working_end'] . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_attendance_amount_monthly']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_attendance_amount_daily']) . "</td>
														<td>" . $val['period_attendance_description'] . "</td>
														<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
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

					<h3>Periode Penggajian BPJS</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Periode Penggajian</th>
											<th>Mulai Bekerja</th>
											<th>Working End</th>
											<th>Jumlah BPJS Kesehatan</th>
											<th>Jumlah BPJS Tenaga Kerja</th>
											<th>Tenaga Kerja Subvention Bulanan</th>
											<th>Tenaga Kerja Subvention Harian</th>
											<th>Status Karyawan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!is_array($payrollperiodbpjs)) {
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
										} else {
											foreach ($payrollperiodbpjs as $key => $val) {
												echo "
													<tr>
														<td style='text-align  : right !important;'>" . $val['period_bpjs_period'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_bpjs_working_start'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_bpjs_working_end'] . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_bpjs_kesehatan_amount']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['period_bpjs_kesehatan_amount']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['bpjs_tenagakerja_subvention_monthly']) . "</td>
														<td style='text-align  : right !important;'>" . nominal($val['bpjs_tenagakerja_subvention_daily']) . "</td>
														<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
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

					<h3>Periode Penggajian Home Early</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Periode Penggajian </th>
											<th>Home Early Hour Start</th>
											<th>Home Early Hour End</th>
											<th>Incentive Status</th>
											<th>Status Karyawan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!is_array($payrollperiodhomeearly)) {
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
										} else {
											foreach ($payrollperiodhomeearly as $key => $val) {
												echo "
													<tr>
														<td style='text-align  : right !important;'>" . $val['period_home_early_period'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_home_early_hour_start'] . "</td>
														<td style='text-align  : right !important;'>" . $val['period_home_early_hour_end'] . "</td>
														<td style='text-align  : right !important;'>" . $employeeattendanceincentivestatus[$val['employee_attendance_incentive_status']] . "</td>
														<td>" . $employeeemploymentstatus[$val['employee_employment_status']] . "</td>
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
				</div>
			</div>

		</div>
	</div>
</div>