<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Jadwal Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Detail Jadwal Karyawan
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>scheduleemployeeschedule/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_pattern_name" id="shift_pattern_name" value="<?php echo $scheduleemployeeschedule['shift_pattern_name']; ?>" class="form-control" disabled>
								<label for="form_control">Nama Pola Shift</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_start_date" id="shift_assignment_start_date" value="<?php echo tgltoview($scheduleemployeeschedule['employee_schedule_date']);?>" disabled>
								<label for="form_control">Tanggal</label>
							</div>	
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				List
			</div>
		</div>
		<div class="portlet-body ">
			<div class="form-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th style='text-align:center'>No</th>
									<th style='text-align:center'>Shift</th>
									<th style='text-align:center'>Kode Shift Karyawan</th>
									<th style='text-align:center'>Nama Karyawan</th>
									<th style='text-align:center'>Tanggal</th>
									<th style='text-align:center'>Jam Mulai Kerja</th>
									<th style='text-align: center'>Status</th> 					
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if (empty($scheduleemployeescheduleitem)) {
										echo"<td colspan='6' style='text-align:center'>Data Kosong</td>";
										
									}else{
										foreach ($scheduleemployeescheduleitem as $key=>$val){
											echo"
											<tr>
												<td style='text-align:center'>".$no."</td>
												<td style='text-align:center'>".$val['shift_name']."</td>
												<td style='text-align:center'>".$val['employee_shift_code']."</td>
												<td>".$val['employee_name']."</td>
												<td style='text-align:center'>".$val['employee_schedule_item_date']."</td>
												<td style='text-align:center'>".$val['start_working_hour']."</td>
												<td style='text-align:center'>".$this->configuration->ScheduleEmployeeScheduleItemStatus[$val['employee_schedule_item_status']]."
											</tr>
											";
											$no++;
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
