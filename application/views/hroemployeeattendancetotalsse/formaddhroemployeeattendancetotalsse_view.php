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
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"hroemployeeattendancetotalsse/reset_add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancetotalsse/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeattendancetotalsse/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addhroemployeeattendancetotalsse-'.$unique['unique']);
?>
		
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeattendancetotalsse">
									Payroll Employee Monthly List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeattendancetotalsse/addPayrollEmployeeMonthly/">
									Add Payroll Employee Monthly
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Employee Attendance Total
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->



<?php 
	echo form_open('hroemployeeattendancetotalsse/processCalculateHROEmployeeAttendanceTotal',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Detail
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>hroemployeeattendancetotalsse" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
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
												<label class="control-label">Employee Shift Code</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_monthly_period', $payrollmonthlyperiod, set_value('employee_monthly_period', $data['employee_monthly_period']), 'id="employee_monthly_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Monthly Period</label>
											</div>	
										</div>
									</div>
								</div>
								
								<div class="form-actions right">
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Calculate</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>

				

								
<?php 
	echo form_open('hroemployeeattendancetotalsse/processAddHROEmployeeAttendanceTotal',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 						= $this->session->userdata('unique');

	$hroemployeeattendancetotalsseitem	= $this->session->userdata('addarrayhroemployeeattendancetotalsseitem-'.$unique['unique']);
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
											<th>Kode Grup</th>
											<th>Nama Karyawan</th>
											<th>Divisi</th>
											<th>Department</th>
											<th>Bagian</th>
											<th>Jabatan</th>
											<th>Periode</th>
											<th>Tanggal Awal</th>
											<th>Tanggal Akhir</th>
											<th>Status Karyawan</th>
											<th>Sudah Bekerja</th>
											<th>Tanggal Masuk</th>
											<th>Hari Kerja</th>
											<th>Ijin Sakit</th>
											<th>Ijin Biasa</th>
											<th>Ijin Tidak Absen</th>
											<th>Mangkir</th>
											<th>Lembur</th>
											<th>Employee ID</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($hroemployeeattendancetotalsseitem)){
											echo "<tr><th colspan='21' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeattendancetotalsseitem as $key=>$val){
												$total_overtime = ( $val['total_overtime_hours'] * 60 ) + $val['total_overtime_minutes'];

												$total_overtime_hours 	= floor($total_overtime / 60);

												$total_overtime_minutes = $total_overtime % 60;

												$total_no_tapping = $val['total_permit_no_tapping_in'] + $val['total_permit_no_tapping_out'];

												$total_working_years 	= floor($val['employee_working_months'] / 12);

												$total_working_months	= $val['employee_working_months'] % 12;

												echo"	
														<td>".$no."</td>
														<td>".$this->hroemployeeattendancetotalsse_model->getEmployeeShiftCode($val['employee_shift_id'])."</td>
														<td>".$this->hroemployeeattendancetotalsse_model->getEmployeeName($val['employee_id'])."</td>
														<td>".$this->hroemployeeattendancetotalsse_model->getDivisionName($val['division_id'])."</td>
														<td>".$this->hroemployeeattendancetotalsse_model->getDepartmentName($val['department_id'])."</td>
														<td>".$this->hroemployeeattendancetotalsse_model->getSectionName($val['section_id'])."</td>
														<td>".$this->hroemployeeattendancetotalsse_model->getJobTitleName($val['job_title_id'])."</td>
														<td>".$val['employee_monthly_period']."</td>
														<td>".tgltoview($val['employee_monthly_start_date'])."</td>
														<td>".tgltoview($val['employee_monthly_end_date'])."</td>
														<td>".$this->configuration->EmployeeStatus[$val['employee_employment_status']]."</td>
														<td style='text-align:right'>".$total_working_years." Tahun ".$total_working_months." Bulan</td>
														<td>".tgltoview($val['employee_hire_date'])."</td>
														<td style='text-align:right'>".$val['total_working_payroll_days']."</td>
														<td style='text-align:right'>".$val['total_permit_with_doctor_days']."</td>
														<td style='text-align:right'>".$val['total_permit_no_doctor_days']."</td>
														<td style='text-align:right'>".$total_no_tapping."</td>
														<td style='text-align:right'>".$val['total_absence_payroll_days']."</td>
														<td style='text-align:right'>".$total_overtime_hours." Jam ".$total_overtime_minutes." Menit</td>
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
							<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add()"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Save</button>	
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