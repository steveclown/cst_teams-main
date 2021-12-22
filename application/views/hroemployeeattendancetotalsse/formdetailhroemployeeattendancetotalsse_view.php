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
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeattendancetotalsse">
									Employee Attendance Total List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeattendancetotalsse/showdetail/<?php echo $hroemployeeattendancetotalsse['employee_attendance_total_id']?>">
									Detail Employee Attendance Total
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Detail Employee Attendance Total
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
									<input type="hidden" name="employee_monthly_period" value="<?php echo $data['monthly_period']; ?>"/>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_shift_code" name="employee_shift_code"  value="<?php echo $hroemployeeattendancetotalsse['employee_shift_code'];?>" readonly>
												<label class="control-label">Employee Shift Code</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_period" name="employee_monthly_period"  value="<?php echo $hroemployeeattendancetotalsse['employee_monthly_period'];?>" readonly>
												<label class="control-label">Monthly Period</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_start_date" name="employee_monthly_start_date"  value="<?php echo tgltoview($hroemployeeattendancetotalsse['employee_monthly_start_date']);?>" readonly>
												<label class="control-label">Monthly Period Start Date</label>
											</div>	
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_monthly_end_date" name="employee_monthly_end_date"  value="<?php echo tgltoview($hroemployeeattendancetotalsse['employee_monthly_end_date']);?>" readonly>
												<label class="control-label">Monthly Period End Date</label>
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
					List
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
											echo "<tr><th colspan='16' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeattendancetotalsseitem as $key=>$val){
												/*$total_overtime = $val['total_overtime_hours'] + ($val['total_overtime_minutes'] / 60);*/

												$total_overtime = ( $val['total_overtime_hours'] * 60 ) + $val['total_overtime_minutes'];

												$total_overtime_hours 	= floor($total_overtime / 60);

												$total_overtime_minutes = $total_overtime % 60;

												$total_no_tapping = $val['total_permit_no_tapping_in'] + $val['total_permit_no_tapping_out'];

												$total_working_years 	= floor($val['employee_working_months'] / 12);

												$total_working_months	= $val['employee_working_months'] % 12;

												echo"	
														<td>".$no."</td>
														<td>".$hroemployeeattendancetotalsse['employee_shift_code']."</td>
														<td>".$val['employee_name']."</td>
														<td>".$val['division_name']."</td>
														<td>".$val['department_name']."</td>
														<td>".$val['section_name']."</td>
														<td>".$val['job_title_name']."</td>
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

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<div class="form-actions right">
									<a href='javascript:void(window.open("<?php echo base_url(); ?>hroemployeeattendancetotalsse/exportHROEmployeeAttendanceTotal/<?php echo $hroemployeeattendancetotalsse['employee_attendance_total_id'] ?>","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
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

