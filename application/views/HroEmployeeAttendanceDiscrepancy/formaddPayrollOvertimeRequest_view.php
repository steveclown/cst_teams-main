<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>

<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_overtime(){
		document.location = base_url+"HroEmployeeAttendanceDiscrepancy/reset_add_overtime/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_overtime(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceDiscrepancy/function_elements_add_overtime');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo form_open('HroEmployeeAttendanceDiscrepancy/processAddPayrollOvertimeRequest',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');

	$dataovertime	= $this->session->userdata('addpayrollovertimerequest-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	$dataovertime['overtime_request_date'] 		= $employee_attendance_date;

	// $employeeattendance_overtime 				= $this->HroEmployeeAttendanceDiscrepancy_model->getHROEmployeeAttendanceData_Overtime($employee_attendance_data_id);

	// $scheduledayoff								= $this->HroEmployeeAttendanceDiscrepancy_model->getScheduleDayOff($employee_attendance_date);

	if (empty($scheduledayoff)){
		$employee_attendance_overtime_dayoff = 0;
	} else {
		$employee_attendance_overtime_dayoff = 1;
	}
	if(empty($dataovertime['employee_attendance_date_status'])){
		$dataovertime['employee_attendance_date_status']=0;
	}

	if(empty($dataovertime['overtime_type_id'])){
		$dataovertime['overtime_type_id']=9;
	}
	if (empty($dataovertime['employee_attendance_overtime_hours'])) {
		$dataovertime['employee_attendance_overtime_hours']="";
	}
	if (empty($dataovertime['overtime_request_description'])) {
		$dataovertime['overtime_request_description']="";
	}
	if (empty($dataovertime['employee_attendance_overtime_minutes'])) {
		$dataovertime['employee_attendance_overtime_minutes']="";
	}

?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="day_off_date_status" name="day_off_date_status" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $employeeattendanceovertimestatus[$employee_attendance_overtime_dayoff];?>" readonly>

			<input type="hidden" class="form-control" id="employee_attendance_overtime_dayoff" name="employee_attendance_overtime_dayoff" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $employee_attendance_overtime_dayoff; ?>" readonly>

			<label class="control-label">Status Hari Libur
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="working_date_status" name="working_date_status" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $employeeattendanceovertimestatus[$dataovertime['employee_attendance_date_status']];?>" readonly>

			<label class="control-label">Status Tanggal Kerja</label>
		</div>
	</div>
</div>	

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="overtime_request_date" name="overtime_request_date" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo tgltoview($dataovertime['overtime_request_date']);?>" readonly>
			<label class="control-label">Tanggal Permintaan Lembur
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('overtime_type_id', $coreovertimetype,set_value('overtime_type_id',$dataovertime['overtime_type_id']),'id="overtime_type_id" class="form-control select2me" onChange="function_elements_add_overtime(this.name, this.value);"');
			?>
			<label class="control-label">Jemis Lembur </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="overtime_request_hours" id="overtime_request_hours" value="<?php echo $dataovertime['employee_attendance_overtime_hours']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);" >
			<label class="control-label">Jam lembur</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="overtime_request_minutes" id="overtime_request_minutes" value="<?php echo $dataovertime['employee_attendance_overtime_minutes']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);" >
			<label class="control-label">Menit lembur</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" name="overtime_request_description" id="overtime_request_description" value="<?php echo $dataovertime['overtime_request_description']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">
			<label class="control-label">Deskripsi</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_overtime();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>"/>
<input type="hidden" name="employee_attendance_date" value="<?php echo $employee_attendance_date; ?>"/>
<input type="hidden" name="employee_attendance_data_id" value="<?php echo $employee_attendance_data_id; ?>"/>
<?php echo form_close(); ?>
							
<br>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis Lembur</th>
						<th> Deskripsi Lembur</th>
						<th>Tanggal Lembur </th>
						<th>Jam lembur</th>
						<th>Menit Lembur</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if(!is_array($payrollovertimerequest)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollovertimerequest as $key => $val){
							echo"
								<tr>
									<td>".$no."</td>
									<td>".$val['overtime_type_name']."</td>
									<td>".$val['overtime_request_description']."</td>
									<td>".tgltoview($val['overtime_request_date'])."</td>
									<td>".$val['overtime_request_hours']."</td>
									<td>".$val['overtime_request_minutes']."</td>
									<td>
										<a href='".$this->config->item('base_url').'HroEmployeeAttendanceDiscrepancy/deletePayrollOvertimeRequest/'.$val['employee_id']."/".$val['overtime_request_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
										</a>
									</td>";
									echo"
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