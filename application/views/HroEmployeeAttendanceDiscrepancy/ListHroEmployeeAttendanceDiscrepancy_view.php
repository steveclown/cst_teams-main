<script>
	base_url = '<?php echo base_url();?>';

    function reset_search(){
		document.location = base_url+"HroEmployeeAttendanceDiscrepancy/reset_search";
	}

	 function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceDiscrepancy/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	$(document).ready(function(){
        $("#location_id").change(function(){
			var location_id 	= $("#location_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('HroEmployeeAttendanceDiscrepancy/getScheduleEmployeeShift');?>",
					data: {location_id: location_id},
					success: function(msg){
					// alert(msg);
					$('#employee_shift_id').html(msg);
				}
				});
		});
	});

	$(document).ready(function(){
        $("#employee_shift_id").change(function(){
			var employee_shift_id 	= $("#employee_shift_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('HroEmployeeAttendanceDiscrepancy/getScheduleEmployeeShiftItem');?>",
					data: {employee_shift_id: employee_shift_id},
					success: function(msg){
					// alert(msg);
					$('#employee_id').html(msg);
				}
				});
		});
	});
</script>

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
		margin-bottom: 12px !important;
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
						<a href="HroEmployeeAttendanceDiscrepancy">
							Daftar Perbedaan Kehadiran Karyawan
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Daftar Perbedaan Kehadiran Karyawan
			</h1>

<?php echo form_open('HroEmployeeAttendanceDiscrepancy/filter',array('id' => 'myform', 'class' => '')); ?>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('filter-HroEmployeeAttendanceDiscrepancy');

	if(!is_array($data)){
		$data['start_date'] 	= date("d-m-Y");
		$data['end_date']		= date("d-m-Y");
	}
	if(empty($data['location_id'])){
		$data['location_id']	=9;
	}
	if(empty($data['employee_shift_id'])){
		$data['employee_shift_id']=9;
	}
	if(empty($data['employee_attendance_date_status'])){
		$data['employee_attendance_date_status']=9;
	}
	if(empty($data['employee_attendance_overtime_status'])){
		$data['employee_attendance_overtime_status']=9;
	}
	if(empty($data['employee_attendance_homeearly_status'])){
		$data['employee_attendance_homeearly_status']=9;
	}
	if(empty($data['employee_id'])){
		$data['employee_id']=9;
	}
	if(empty($data['employee_attendance_late_status'])){
		$data['employee_attendance_late_status']=9;
	}
	


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
								<div class="form-body">
									<?php 
										echo form_open('HroEmployeeAttendanceDiscrepancy/processAddHROEmployeeAttendanceData',array('id' => 'myform', 'class' => 'horizontal-form')); 

										
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
				                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value = <?php echo $data['start_date']?>>
												<label for="form_control">Mulai tanggal</label>
											</div>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value = <?php echo $data['end_date']?>>
												<label for="form_control">Tanggal Berakhir</label>
											</div>	
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Nama lokasi</label>
											</div>	
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['location_id'])){
														$scheduleemployeeshift = create_double($this->HroEmployeeAttendanceDiscrepancy_model->getScheduleEmployeeShift_Location($data['location_id']), 'employee_shift_id', 'employee_shift_code');

														echo form_dropdown('employee_shift_id', $scheduleemployeeshift, set_value('employee_shift_id', $data['employee_shift_id']), 'id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?>
													<select name="employee_shift_id" id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Pilih satu--</option>
													</select>
												<?php
													}
												?>	
												<label class="control-label">Kode Shift Karyawan<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_date_status', $employeeattendancedatestatus, set_value('employee_attendance_date_status', $data['employee_attendance_date_status']), 'id="employee_attendance_date_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Status Tanggal</label>
											</div>	
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['employee_shift_id'])){
														$scheduleemployeeshiftitem = create_double($this->HroEmployeeAttendanceDiscrepancy_model->getScheduleEmployeeShiftItem($data['employee_shift_id']), 'employee_id', 'employee_name');

														echo form_dropdown('employee_id', $scheduleemployeeshiftitem, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?>
													<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Pilih satu--</option>
													</select>
												<?php
													}
												?>	
												<label class="control-label">nama karyawan<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_late_status', $employeeattendancelatestatus, set_value('employee_attendance_late_status', $data['employee_attendance_late_status']), 'id="employee_attendance_late_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Status Terlambat</label>
											</div>	
										</div>	

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_overtime_status', $employeeattendanceovertimestatus, set_value('employee_attendance_overtime_status', $data['employee_attendance_overtime_status']), 'id="employee_attendance_overtime_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Status Lembur</label>
											</div>	
										</div>	

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_homeearly_status', $employeeattendancehomeearlystatus, set_value('employee_attendance_homeearly_status', $data['employee_attendance_homeearly_status']), 'id="employee_attendance_homeearly_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Status Pulang awal</label>
											</div>	
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 " style="text-align  : right !important;">
											<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_search()"><i class="fa fa-times"></i> Batal</button>
										<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-search"></i> Cari</button>	
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>

<?php echo form_open('HroEmployeeAttendanceDiscrepancy/filter',array('id' => 'myform', 'class' => '')); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th>
									Kode Shift Karyawan
								</th>
								<th>
									nama karyawan
								</th>
								<th>
									Tanggal Kehadiran
								</th>
								<th>
									Tanggal Masuk
								</th>
								<th>
									Tanggal Keluar
								</th>
								<th>
									Jam kerja
								</th>
								<th>
									Status Tanggal
								</th>
								<th>
									Status Terlambat
								</th>
								<th>
									Status Lembur
								</th>
								<th>
									Status Pulang Awal
								</th>
								<th>
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeeattendancedata as $key => $val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_shift_code']."</td>
											<td>".$val['employee_name']."</td>
											<td>".tgltoview($val['employee_attendance_date'])."</td>
											<td>".$val['employee_attendance_in_date']."</td>
											<td>".$val['employee_attendance_out_date']."</td>
											<td>".$val['employee_attendance_working_time_hours']." m ".$val['employee_attendance_working_time_minutes']."m</td>
											<td>".$employeeattendancedatestatus[$val['employee_attendance_date_status']]."</td>
											<td>".$employeeattendancelatestatus[$val['employee_attendance_late_status']]."</td>
											<td>".$employeeattendanceovertimestatus[$val['employee_attendance_overtime_status']]."</td>
											<td>".$employeeattendancehomeearlystatus[$val['employee_attendance_homeearly_status']]."</td>
											<td>
												<a href='".$this->config->item('base_url').'HroEmployeeAttendanceDiscrepancy/addHROEmployeeAttendanceDiscrepancy/'.$val['employee_id']."/".$val['employee_attendance_date']."/".$val['employee_attendance_data_id']."' class='btn default btn-xs green-jungle'>
													<i class='fa fa-plus'></i> Tambah
												</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>