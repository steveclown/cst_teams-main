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
				Beranda
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
			<a href="<?php echo base_url(); ?>PayrollPeriodData/addPayrollPeriodData">
				Tambah Data Periode Penggajian
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Tambah Data Periode Penggajian
</h3>
<!-- END PAGE TITLE & BREADCRUMB-->




<?php
$unique 				= $this->session->userdata('unique');
$data 					= $this->session->userdata('addpayrollperioddata-' . $unique['unique']);

// if(empty($data['payroll_period'])){
// 	$data['payroll_period'] 		= date('Y');
// }

$year_now 	=	date('Y');
// if(!is_array($sesi)){
// 	$sesi['month']			= date('m');
// 	$sesi['year']			= $year_now;
// }

for ($i = ($year_now - 1); $i < ($year_now + 2); $i++) {
	$year[$i] = $i;
}

echo $this->session->userdata('message');
$this->session->unset_userdata('message');

echo form_open('PayrollPeriodData/processAddPayrollPeriodData', array('id' => 'myform', 'class' => 'horizontal-form'));
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Tambah
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
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
								echo form_dropdown('payroll_period', $year, set_value('payroll_period', $data['payroll_period']), 'id="payroll_period" class="form-control select2me"');
								?>
								<label>Periode</label>
							</div>
						</div>
					</div>

					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
							if ($data['active_tab'] == "" || $data['active_tab'] == "payrollpayment") {
								$tabpayrollpayment = "<li class='active'><a href='#tabpayrollpayment' name='payrollpayment' data-toggle='tab' onClick='function_state_add(this.name);'><b>Payment</b></a></li>";
							} else {
								$tabpayrollpayment = "<li><a href='#tabpayrollpayment' data-toggle='tab' name='payrollpayment' onClick='function_state_add(this.name);'><b>Payment</b></a></li>";
							}

							if ($data['active_tab'] == "payrollallowance") {
								$tabpayrollallowance = "<li class='active'><a href='#tabpayrollallowance' name='payrollallowance' data-toggle='tab' onClick='function_state_add(this.name)'><b>Tunjangan</b></a></li>";
							} else {
								$tabpayrollallowance = "<li><a href='#tabpayrollallowance' data-toggle='tab' name='payrollallowance' onClick='function_state_add(this.name)'><b>Tunjangan</b></a></li>";
							}

							if ($data['active_tab'] == "payrolldeduction") {
								$tabpayrolldeduction = "<li class='active'><a href='#tabpayrolldeduction' name='payrolldeduction' data-toggle='tab' onClick='function_state_add(this.name)'><b>Potongan</b></a></li>";
							} else {
								$tabpayrolldeduction = "<li><a href='#tabpayrolldeduction' data-toggle='tab' name='payrolldeduction' onClick='function_state_add(this.name)'><b>Potongan</b></a></li>";
							}

							if ($data['active_tab'] == "payrollattendance") {
								$tabpayrollattendance = "<li class='active'><a href='#tabpayrollattendance' name='payrollattendance' data-toggle='tab' onClick='function_state_add(this.name)'><b>Kehadiran</b></a></li>";
							} else {
								$tabpayrollattendance = "<li><a href='#tabpayrollattendance' name='payrollattendance' data-toggle='tab' onClick='function_state_add(this.name)'><b>Kehadiran</b></a></li>";
							}

							if ($data['active_tab'] == "payrollbpjs") {
								$tabpayrollbpjs = "<li class='active'><a href='#tabpayrollbpjs' name='payrollbpjs' data-toggle='tab' onClick='function_state_add(this.name)'><b>BPJS</b></a></li>";
							} else {
								$tabpayrollbpjs = "<li><a href='#tabpayrollbpjs' name='payrollbpjs' data-toggle='tab' onClick='function_state_add(this.name)'><b>BPJS</b></a></li>";
							}

							if ($data['active_tab'] == "payrollhomeearly") {
								$tabpayrollhomeearly = "<li class='active'><a href='#tabpayrollhomeearly' name='payrollhomeearly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pulang Awal</b></a></li>";
							} else {
								$tabpayrollhomeearly = "<li><a href='#tabpayrollhomeearly' name='payrollhomeearly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pulang Awal</b></a></li>";
							}

							echo $tabpayrollpayment;
							echo $tabpayrollallowance;
							echo $tabpayrolldeduction;
							echo $tabpayrollattendance;
							echo $tabpayrollbpjs;
							echo $tabpayrollhomeearly;
							?>
						</ul>
						<div class="tab-content">
							<?php
							if ($data['active_tab'] == "" || $data['active_tab'] == "payrollpayment") {
								$statpayrollpayment = "active";
							} else {
								$statpayrollpayment = "";
							}

							if ($data['active_tab'] == "payrollallowance") {
								$statpayrollallowance = "active";
							} else {
								$statpayrollallowance = "";
							}

							if ($data['active_tab'] == "payrolldeduction") {
								$statpayrolldeduction = "active";
							} else {
								$statpayrolldeduction = "";
							}

							if ($data['active_tab'] == "payrollattendance") {
								$statpayrollattendance = "active";
							} else {
								$statpayrollattendance = "";
							}

							if ($data['active_tab'] == "payrollbpjs") {
								$statpayrollbpjs = "active";
							} else {
								$statpayrollbpjs = "";
							}

							if ($data['active_tab'] == "payrollhomeearly") {
								$statpayrollhomeearly = "active";
							} else {
								$statpayrollhomeearly = "";
							}

							echo "<div class='tab-pane " . $statpayrollpayment . "' id='tabpayrollpayment'>";
							$this->load->view("PayrollPeriodData/formaddpayrollperiodpayment_view");
							echo "</div>";

							echo "<div class='tab-pane " . $statpayrollallowance . "' id='tabpayrollallowance'>";
							$this->load->view("PayrollPeriodData/formaddpayrollperiodallowance_view");
							echo "</div>";

							echo "<div class='tab-pane " . $statpayrolldeduction . "' id='tabpayrolldeduction'>";
							$this->load->view("PayrollPeriodData/formaddpayrollperioddeduction_view");
							echo "</div>";

							echo "<div class='tab-pane " . $statpayrollattendance . "' id='tabpayrollattendance'>";
							$this->load->view("PayrollPeriodData/formaddpayrollperiodattendance_view");
							echo "</div>";

							echo "<div class='tab-pane " . $statpayrollbpjs . "' id='tabpayrollbpjs'>";
							$this->load->view("PayrollPeriodData/formaddpayrollperiodbpjs_view");
							echo "</div>";

							echo "<div class='tab-pane " . $statpayrollhomeearly . "' id='tabpayrollhomeearly'>";
							$this->load->view("PayrollPeriodData/formaddpayrollperiodhomeearly_view");
							echo "</div>";
							?>
						</div>
					</div>
					<BR>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add()"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>