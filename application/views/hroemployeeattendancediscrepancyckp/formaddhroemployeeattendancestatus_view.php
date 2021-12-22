<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>

<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_attendance(){
		document.location = base_url+"hroemployeeattendancediscrepancyckp/reset_add_attendance/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_attendance(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_elements_add_attendance');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo form_open('hroemployeeattendancediscrepancyckp/processAddHROEmployeeAttendanceStatus',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');

	$dataattendance	= $this->session->userdata('addemployeeattendancestatus-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	$dataattendance['employee_attendance_date'] 		= $employee_attendance_date;

	$employee_attendance_date_status_old = $this->hroemployeeattendancediscrepancyckp_model->getEmployeeAttendanceDateStatusOld($employee_id, $employee_attendance_date);

?>
			
<?php 
	echo $this->session->userdata('message_attendance');
	$this->session->unset_userdata('message_attendance');
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_attendance_date" name="employee_attendance_date" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo tgltoview($dataattendance['employee_attendance_date']);?>" readonly>
			<label class="control-label">Employee Attendance Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_attendance_date_status_old_view" id="employee_attendance_date_status_old_view" value="<?php echo $this->configuration->EmployeeAttendanceDateStatus[$employee_attendance_date_status_old]; ?>" class="form-control" onChange="function_elements_add_attendance(this.name, this.value);" readonly>
			<input type="hidden" name="employee_attendance_date_status_old" id="employee_attendance_date_status_old" value="<?php echo $employee_attendance_date_status_old ?>" class="form-control" onChange="function_elements_add_attendance(this.name, this.value);" readonly>
			<label class="control-label">Attendance Date Status Old</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_attendance_date_status', $employeeattendancedatestatus, set_value('employee_attendance_date_status', $dataattendance['employee_attendance_date_status']),'id="attendance_type_id" class="form-control select2me" onChange="function_elements_add_attendance(this.name, this.value);"');
			?>
			<label class="control-label">Attendance Date Status</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_attendance_status_description" id="employee_attendance_status_description" value="<?php echo $dataattendance['employee_attendance_status_description']?>" class="form-control" onChange="function_elements_add_attendance(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_attendance();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
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
						<th>Employee Attendance Date</th>
						<th>Employee Attendance Date Status Old</th>
						<th>Employee Attendance Date Status</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeattendancestatus)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeattendancestatus as $key => $val){
							echo"
								<tr>
									<td>".$val['employee_attendance_date']."</td>
									<td>".$this->configuration->EmployeeAttendanceDateStatus[$val['employee_attendance_date_status_old']]."</td>
									<td>".$this->configuration->EmployeeAttendanceDateStatus[$val['employee_attendance_date_status']]."</td>
									<td>".$val['employee_attendance_status_description']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancyckp/deleteHROEmployeeAttendanceStatus/'.$val['employee_id']."/".$val['employee_attendance_status_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>
									</td>";
									echo"
								</tr>
								
							";
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>