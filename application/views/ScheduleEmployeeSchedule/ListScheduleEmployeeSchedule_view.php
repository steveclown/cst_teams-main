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
	base_url = '<?php echo base_url();?>';

    function reset_search(){
		document.location = base_url+"ScheduleEmployeeSchedule/reset_search";
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
			var division_id 	= $("#division_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('ScheduleEmployeeSchedule/getCoreDepartment');?>",
					data: {division_id: division_id},
					success: function(msg){
					// alert(msg);
					$('#department_id').html(msg);
				}
				});
		});
	});

	$(document).ready(function(){
        $("#department_id").change(function(){
			var department_id 	= $("#department_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('ScheduleEmployeeSchedule/getCoreSection');?>",
					data: {department_id: department_id},
					success: function(msg){
					// alert(msg);
					$('#section_id').html(msg);
				}
				});
		});
	});

	$(document).ready(function(){
        $("#section_id").change(function(){
			var section_id 	= $("#section_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('ScheduleEmployeeSchedule/getCoreUnit');?>",
					data: {section_id: section_id},
					success: function(msg){
					// alert(msg);
					$('#unit_id').html(msg);
				}
				});
		});
	});

	$(document).ready(function(){
        $("#unit_id").change(function(){
			var unit_id 		= $("#unit_id").val();
			var division_id 	= $("#division_id").val();
			var department_id 	= $("#department_id").val();
			var section_id	 	= $("#section_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('ScheduleEmployeeSchedule/getHROEmployeeData');?>",
					data: {division_id: division_id, department_id: department_id, section_id: section_id, unit_id: unit_id},
					success: function(msg){
					$('#employee_id').html(msg);
				}
				});
		});
	});
</script>
<?php 
	$data = $this->session->userdata('filter-ScheduleEmployeeScheduleitem');
	if(!is_array($data)){
		$data['start_date'] 		= date("Y-m-d");
		$data['end_date']			= date("Y-m-d");
		$data['division_id']		= '';
		$data['department_id']		= '';
		$data['section_id']			= '';
		$data['unit_id']			= '';
		$data['employee_shift_id']	= '';
	}
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeSchedule">Jadwal Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Daftar Jadwal Karyawan <small>Kelola Jadwal Karyawan</small>
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		
<?php 
	echo form_open('ScheduleEmployeeSchedule/filter',array('id' => 'myform', 'class' => '')); 
?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter 
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body">
					<div class = "row">
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" value="<?php echo tgltoview($data['start_date']); ?>">
								<label for="form_control">Mulai tanggal</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" value="<?php echo tgltoview($data['end_date']); ?>">
								<label for="form_control">Tanggal Berakhir</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_shift_id', $scheduleemployeeshift, set_value('employee_shift_id', $data['employee_shift_id']), 'id="employee_shift_id" class="form-control select2me" ');
								?>
								<label class="control-label">Kode Shift Karyawan</label>
							</div>	
						</div>
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision, set_value('division_id', $data['division_id']), 'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Nama Devisi</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['division_id'])){
										$coredepartment = create_double($this->ScheduleEmployeeSchedule_model->getCoreDepartment($data['division_id']), 'department_id', 'department_name');

										echo form_dropdown('department_id', $coredepartment,set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me" ');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" >
										<option value="">--Pilih Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Nama Departemen</label>
							</div>
						</div>
					
						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['department_id'])){
										$coresection = create_double($this->ScheduleEmployeeSchedule_model->getCoreSection($data['department_id']),'section_id','section_name');

										echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" class="form-control select2me" ');
									} else {
								?>
									<select name="section_id" id="section_id" class="form-control select2me" >
										<option value="">--Pilih Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Nama Bagian</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['section_id'])){
										$coreunit = create_double($this->ScheduleEmployeeSchedule_model->getCoreUnit($data['section_id']), 'unit_id', 'unit_name');

										echo form_dropdown('unit_id', $coreunit, set_value('unit_id', $data['unit_id']),'id="unit_id" class="form-control select2me" ');
									} else {
								?>
									<select name="unit_id" id="unit_id" class="form-control select2me" >
										<option value="">--Pilih Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Nama Satuan</label>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									$auth 			= $this->session->userdata('auth');
									$region_id 		= $auth['region_id'];
									$branch_id 		= $auth['branch_id'];
									$location_id	= $auth['location_id'];


									if (!empty($data['unit_id'])){
										$hroemployeedata = create_double($this->ScheduleEmployeeSchedule_model->getHROEmployeeData($region_id, $branch_id, $location_id, $data['division_id'], $data['department_id'], $data['section_id'], $data['unit_id']), 'employee_id', 'employee_name');

										echo form_dropdown('employee_id', $hroemployeedata, set_value('employee_id',$data['employee_id']),'id="employee_id" class="form-control select2me" ');
									} else {
								?>
									<select name="employee_id" id="employee_id" class="form-control select2me" >
										<option value="">--Pilih Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="form-action" style="text-align: right !important;">
							<button type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_search();"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Daftar
				</div>
				<!-- <div class="actions">
					<a href="<?php echo base_url();?>ScheduleEmployeeSchedule/searchScheduleShiftAssignment" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Add Employee Schedule</a>
				</div> -->
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Devisi</th>
							<th>Nama Departemen </th>
							<th>Nama Bagian </th>
							<th>Nama Satuan </th>
							<th>Kode Shift</th>
							<th>Tanggal Jadwal</th>
							<th>Nama Shift</th>
							<th>Nama Karyawan </th>
							<th>Kode RFID</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							$ShiftNextDay			= $this->configuration->ShiftNextDay();
							
							foreach ($ScheduleEmployeeScheduleitem as $key=>$val){
								if ($val['shift_next_day'] == 1){
									$ScheduleEmployeeScheduleshift = $this->ScheduleEmployeeSchedule_model->getScheduleEmployeeScheduleShift($val['employee_id'], $val['employee_schedule_item_date']);

									if (isset($ScheduleEmployeeScheduleshift)){
										$shift_next_day = 1;
									} else {
										$shift_next_day = 0;
									}
								} else {
									$shift_next_day = 0;
								}

								echo"
									<tr>	
										<td>".$no."</td>
										<td>".$val['division_name']."</td>
										<td>".$val['department_name']."</td>
										<td>".$val['section_name']."</td>
										<td>".$val['unit_name']."</td>
										<td>".$val['employee_shift_code']."</td>
										<td>".tgltoview($val['employee_schedule_item_date'])."</td>
										<td>".$val['shift_code']." - ".$ShiftNextDay[$shift_next_day]."</td>
										<td>".$val['employee_name']."</td>
										<td>".$val['employee_rfid_code']."</td>
										<td>
											<a href='".$this->config->item('base_url').'ScheduleEmployeeSchedule/editScheduleEmployeeScheduleWorking/'.$val['employee_schedule_item_id']."/".$val['employee_id']."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
										</td>
									</tr>
								";

								/*<a href='".$this->config->item('base_url').'ScheduleEmployeeSchedule/editScheduleEmployeeSchedule/'.$val[employee_schedule_id]."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
											<a href='".$this->config->item('base_url').'ScheduleEmployeeSchedule/deleteScheduleShiftAssignment/'.$val[employee_schedule_id]."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Delete
											</a>*/
								$no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>