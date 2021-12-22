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
	function reset_session(){
	 	// alert('asd');
		document.location = base_url+"PayrollEmployeeMonthlyCkp/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollEmployeeMonthlyCkp/function_elements_add');?>",
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
				url : "<?php echo site_url('PayrollEmployeeMonthlyCkp/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addpayrollemployeemonthly-'.$unique['unique']);
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
								<a href="<?php echo base_url();?>PayrollEmployeeMonthlyCkp">
									Daftar Penggajian Karyawan Bulanan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>PayrollEmployeeMonthlyCkp/addPayrollEmployeeMonthly/">
									Tambah Penggajian Karyawan Bulanan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Tambah Penggajian Karyawan Bulanan
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<?php 
	echo form_open('PayrollEmployeeMonthlyCkp/processCalculatePayrollEmployeeMonthly',array('id' => 'myform', 'class' => 'horizontal-form'));

	if (empty($data['employee_shift_id'])) {
	 	$data['employee_shift_id']=9;
	 } 
	 if (empty($data['employee_monthly_period'])) {
	 	$data['employee_monthly_period']=9;
	 } 
?>

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>PayrollEmployeeMonthlyCkp" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">

									
									<!-- <input type="hidden" name="employee_monthly_period" value="<?php echo $payrollmonthlyperiod['monthly_period']; ?>"/>
 -->
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
												<label class="control-label">Periode Bulanan</label>
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
	echo form_open('PayrollEmployeeMonthlyCkp/processAddPayrollEmployeeMonthly',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 					= $this->session->userdata('unique');

	$payrollemployeemonthlyitem	= $this->session->userdata('addarraypayrollemployeemonthlyitem-'.$unique['unique']);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Daftar
				</div>
			</div>
			<div class="portlet-body form">
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
											<th>Nama karyawan</th>
											<th>Nama Satuan</th>
											<th>Nama Pekerjaan</th>
											<th>Status Karyawan</th>
											<th>Bulan kerja </th>
											<th>Tanggal perekrutan</th>
											<th>Hari kerja</th>
											<th>Gaji Pokok</th>
											<th>Jumlah Tunjangan</th>
											<th>Jumlah Kehadiran</th>
											<th>Jumlah Layanan Panjang</th>
											<th>Jumlah Pulang lebih awal</th>
											<th>Jumlah Lembur</th>
											<th>Jumlah BPJS</th>
											<th>Kupon Makan </th>
											<th>Total Meal Coupon Amount</th>
											<th>Jumlah pengiriman</th>
											<th>Tambahan Potongan </th>
											<th>Tambhan Lembur</th>
											<th>Jumlah Gaji</th>
											<th>ID Karyawan</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($payrollemployeemonthlyitem)){
											echo "<tr><th colspan='20' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeemonthlyitem as $key=>$val){
												echo"	
														<td>".$no."</td>
														<td>".$val['employee_monthly_period']."</td>
														<td>".tgltoview($val['employee_monthly_start_date'])."</td>
														<td>".tgltoview($val['employee_monthly_end_date'])."</td>
														<td>".$this->PayrollEmployeeMonthlyCkp_model->getEmployeeName($val['employee_id'])."</td>
														<td>".$this->PayrollEmployeeMonthlyCkp_model->getUnitName($val['unit_id'])."</td>
														<td>".$this->PayrollEmployeeMonthlyCkp_model->getJobTitleName($val['job_title_id'])."</td>
														<td>".$employeestatus[$val['employee_employment_status']]."</td>
														<td style='text-align:right'>".number_format($val['employee_working_months'], 2)."</td>
														<td>".tgltoview($val['employee_hire_date'])."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_working_days'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_basic_salary'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_allowance_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_attendance_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_service_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_early_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_overtime_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_bpjs_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_total_meal_coupon'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_meal_coupon_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_delivery_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_additional_deduction_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_additional_overtime_amount'], 2)."</td>
														<td style='text-align:right'>".number_format($val['employee_monthly_salary_total'], 2)."</td>
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