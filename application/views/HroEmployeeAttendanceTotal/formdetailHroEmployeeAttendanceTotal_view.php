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
									Daftar Jumlah Kehadiran Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeAttendanceTotal/showdetail/<?php echo $HroEmployeeAttendanceTotal['employee_attendance_total_id']?>">
									Detail Jumlah Kehadiran Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Detail Jumlah Kehadiran Karyawan
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->






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
										$unique 	= $this->session->userdata('unique');
										$data 		= $this->session->userdata('addarrayHroEmployeeAttendanceTotal-'.$unique['unique']);
										
										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>
									<input type="hidden" name="employee_monthly_period" value="<?php echo $data['monthly_period']; ?>"/>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_shift_code" name="employee_shift_code"  value="<?php echo $HroEmployeeAttendanceTotal['employee_shift_code'];?>" readonly>
												<label class="control-label">Kode Shift Karyawan</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_period" name="employee_monthly_period"  value="<?php echo $HroEmployeeAttendanceTotal['employee_monthly_period'];?>" readonly>
												<label class="control-label"> Periode Bulanan</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_start_date" name="employee_monthly_start_date"  value="<?php echo tgltoview($HroEmployeeAttendanceTotal['employee_monthly_start_date']);?>" readonly>
												<label class="control-label">Tanggal Mulai Periode Bulanan</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_end_date" name="employee_monthly_end_date"  value="<?php echo tgltoview($HroEmployeeAttendanceTotal['employee_monthly_end_date']);?>" readonly>
												<label class="control-label">Tanggal Akhir Periode Bulanan</label>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				

								

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
											<th>Tanggal Awal Bulanan</th>
											<th>Tanggal Akhir Bulanan</th>
											<th>nama karyawan</th>
											<th>Nama Satuan</th>
											<th>Nama Pekerjaan</th>
											<th> Status Pekerjaan</th>
											<th>Bulan kerja</th>
											<th>Tanggal perekrutan</th>
											<th>Hari kerja</th>
											<th>Izin SDR</th>
											<th>Izin SDR Daftar Gaji</th>
											<th>No Izin SDR</th>
											<th>No Izin SDR Daftar Gaji</th>
											<th>ketidakhadiran</th>
											<th>Batal Libur</th>
											<th>Swap Off</th>
											<th>Pulang Awal < 1 Hour</th>
											<th>Pulang Awal > 5 Hour</th>
											<th>ID Karyawan</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($HroEmployeeAttendanceTotalitem)){
											echo "<tr><th colspan='16' style='text-align  : center !important;'>Data is Empty</th></tr>";
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
														<td>".$employeestatus[$val['employee_employment_status']]."</td>
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

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<div class="form-actions right">
									<a href='javascript:void(window.open("<?php echo base_url(); ?>HroEmployeeAttendanceTotal/exportHROEmployeeAttendanceTotal/<?php echo $HroEmployeeAttendanceTotal['employee_attendance_total_id'] ?>","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
                                        <i class="fa fa-file-excel-o"></i> Export Data
                                   	</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

