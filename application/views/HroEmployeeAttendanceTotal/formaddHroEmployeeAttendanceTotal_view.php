<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
</style>
<script>
	function reset_add(){
		document.location = base_url+"HroEmployeeAttendanceTotal/reset_add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceTotal/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceTotal/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addHroEmployeeAttendanceTotal-'.$unique['unique']);
?>
		
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeAttendanceTotal">
									Daftar Gaji Bulanan Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeAttendanceTotal/addPayrollEmployeeMonthly/">
									Tambah Gaji Bulanan Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Tambah Gaji Bulanan Karyawan
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->



<?php 
	echo form_open('HroEmployeeAttendanceTotal/processCalculateHROEmployeeAttendanceTotal',array('id' => 'myform', 'class' => 'horizontal-form')); 
	if (empty($data['employee_monthly_period'])) {
		$data['employee_monthly_period']=9;
	}
	if (empty($data['employee_shift_id'])) {
		$data['employee_shift_id']=9;
	}
?>

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Detail
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>HroEmployeeAttendanceTotal" class="btn btn-default sm">
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

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_shift_id', $scheduleemployeeshift, set_value('employee_shift_id', $data['employee_shift_id']), 'id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Kode Shift Karyawan</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_monthly_period', $payrollmonthlyperiod, set_value('employee_monthly_period', $data['employee_monthly_period']), 'id="employee_monthly_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label"> Periode Bulanan</label>
											</div>	
										</div>
									</div>
								</div>
								
								<div class="form-actions right">
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Hitung</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>

				

								
<?php 
	echo form_open('HroEmployeeAttendanceTotal/processAddHROEmployeeAttendanceTotal',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 						= $this->session->userdata('unique');

	$HroEmployeeAttendanceTotalitem	= $this->session->userdata('addarrayHroEmployeeAttendanceTotalitem-'.$unique['unique']);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body ">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
									<thead>
										<tr>
											<th>No</th>
											<th>Periode Bulanan</th>
											<th>Tanggal Mulai Bulanan</th>
											<th>Tanggal Akhir Bulanan</th>
											<th>nama karyawan</th>
											<th>Nama Satuan</th>
											<th>Nama Pekerjaan</th>
											<th>Status Karyawan</th>
											<th>Bulan Kerja</th>
											<th>Tanggal Perekrutan</th>
											<th>Hari kerja</th>
											<th>Izin SDR</th>
											<th>Izin SDR Daftar Gaji</th>
											<th>Izin No SDR</th>
											<th>izin No SDR Daftar Gaji</th>
											<th>Absensi</th>
											<th>Batal Libur</th>
											<th>Tukar Libur</th>
											<th>Pulang Awal < 1 Jam</th>
											<th>Pulang Awal > 5 Jam</th>
											<th>ID Karyawan</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($HroEmployeeAttendanceTotalitem)){
											echo "<tr><th colspan='21' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($HroEmployeeAttendanceTotalitem as $key=>$val){
												$total_early_days_5 = $val['total_early_payroll_less_5_days'] + $val['total_early_payroll_more_5_days'];
												echo"	
														<td>".$no."</td>
														<td>".$val['employee_monthly_period']."</td>
														<td>".tgltoview($val['employee_monthly_start_date'])."</td>
														<td>".tgltoview($val['employee_monthly_end_date'])."</td>
														<td>".$this->HroEmployeeAttendanceTotal_model->getEmployeeName($val['employee_id'])."</td>
														<td>".$this->HroEmployeeAttendanceTotal_model->getUnitName($val['unit_id'])."</td>
														<td>".$this->HroEmployeeAttendanceTotal_model->getJobTitleName($val['job_title_id'])."</td>
														<td>".$this->configuration->EmployeeStatus[$val['employee_employment_status']]."</td>
														<td style='text-align:right'>".number_format($val['employee_working_months'], 2)."</td>
														<td>".tgltoview($val['employee_hire_date'])."</td>
														<td style='text-align:right'>".$val['total_working_payroll_days']."</td>
														<td style='text-align:right'>".$val['total_permit_with_doctor_days']."</td>
														<td style='text-align:right'>".$val['total_permit_with_doctor_payroll_days']."</td>
														<td style='text-align:right'>".$val['total_permit_no_doctor_payroll_days']."</td>
														<td style='text-align:right'>".$val['total_permit_no_doctor_days']."</td>
														<td style='text-align:right'>".$val['total_absence_payroll_days']."</td>
														<td style='text-align:right'>".$val['total_cancel_off_payrol_days']."</td>
														<td style='text-align:right'>".$val['total_swap_off_payroll_days']."</td>
														<td style='text-align:right'>".$val['total_early_payroll_less_1_days']."</td>
														<td style='text-align:right'>".$total_early_days_5."</td>
														<td>".$val['employee_id']."</td>
													</tr>
												";
												$no++;
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<BR>
					<BR>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add()"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Simpan</button>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="employee_monthly_period" value="<?php echo $data['employee_monthly_period']; ?>"/>
<input type="hidden" name="employee_shift_id" value="<?php echo $data['employee_shift_id']; ?>"/>
<?php echo form_close(); ?>