<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeShift">Shift Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Detail Shift Karyawan
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
					<a href="<?php echo base_url();?>ScheduleEmployeeShift/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_shift_code" id="employee_shift_code" value="<?php echo $ScheduleEmployeeShift['employee_shift_code']; ?>" class="form-control" disabled>
								<label for="form_control">Kode Shift Karyawan</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php $ScheduleEmployeeShiftstatus=$this->configuration->ScheduleEmployeeShiftStatus(); ?> 
								<input type="text" autocomplete="off"  name="employee_shift_status" id="employee_shift_status" value="<?php echo $ScheduleEmployeeShiftstatus[$ScheduleEmployeeShift['employee_shift_status']]; ?>" class="form-control" disabled>
								<label for="form_control">Status</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $ScheduleEmployeeShift['division_name']; ?>" class="form-control" disabled>
								<label for="form_control">Nama devisi</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" autocomplete="off"  name="location_name" id="location_name" value="<?php echo $ScheduleEmployeeShift['location_name']; ?>" class="form-control" disabled>
								<label for="form_control">Nama Lokasi</label>
							</div>	
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
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
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th >No</th>
									<th>Nama Departemen </th>
									<th>Nama Bagian </th>
									<th>Nama Karyawan </th> 					
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
										foreach ($ScheduleEmployeeShiftitem as $key=>$val){
											echo"
												<tr>
													<td style='text-align:center'>$no.</td>
													<td>".$val['department_name']."</td>
													<td>".$val['section_name']."</td>
													<td>".$val['employee_name']."</td>
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

			<label></label>	
		</div>
	</div>
</div>
