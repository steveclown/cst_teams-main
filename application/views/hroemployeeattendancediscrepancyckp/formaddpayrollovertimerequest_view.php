<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>

<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_overtime(){
		document.location = base_url+"hroemployeeattendancediscrepancyckp/reset_add_overtime/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_overtime(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_elements_add_overtime');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo form_open('hroemployeeattendancediscrepancyckp/processAddPayrollOvertimeRequest',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');

	$dataovertime	= $this->session->userdata('addpayrollovertimerequest-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	$dataovertime['overtime_request_date'] 		= $employee_attendance_date;

	$employeeattendance_overtime 				= $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAttendanceData_Overtime($employee_attendance_data_id);

	$scheduledayoff								= $this->hroemployeeattendancediscrepancyckp_model->getScheduleDayOff($employee_attendance_date);

	if (empty($scheduledayoff)){
		$employee_attendance_overtime_dayoff = 0;
	} else {
		$employee_attendance_overtime_dayoff = 1;
	}
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="day_off_date_status" name="day_off_date_status" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $this->configuration->EmployeeAttendanceOvertimeDayOff[$employee_attendance_overtime_dayoff];?>" readonly>

			<input type="hidden" class="form-control" id="employee_attendance_overtime_dayoff" name="employee_attendance_overtime_dayoff" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $employee_attendance_overtime_dayoff; ?>" readonly>

			<label class="control-label">Day Off Status
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="working_date_status" name="working_date_status" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $this->configuration->EmployeeAttendanceDateStatus[$employeeattendance_overtime['employee_attendance_date_status']];?>" readonly>

			<label class="control-label">Working Date Status</label>
		</div>
	</div>
</div>	

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="overtime_request_date" name="overtime_request_date" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo tgltoview($dataovertime['overtime_request_date']);?>" readonly>
			<label class="control-label">Overtime Request Date
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
			<label class="control-label">Overtime Type</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="overtime_request_hours" id="overtime_request_hours" value="<?php echo $employeeattendance_overtime['employee_attendance_overtime_hours']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);" >
			<label class="control-label">Overtime Hours</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="overtime_request_minutes" id="overtime_request_minutes" value="<?php echo $employeeattendance_overtime['employee_attendance_overtime_minutes']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);" >
			<label class="control-label">Overtime Minutes</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="overtime_request_description" id="overtime_request_description" value="<?php echo $dataovertime['overtime_request_description']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_overtime();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Overtime Type</th>
						<th>Overtime Description</th>
						<th>Overtime Date</th>
						<th>Overtime Hours</th>
						<th>Overtime Minutes</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollovertimerequest)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollovertimerequest as $key => $val){
							echo"
								<tr>
									<td>".$val['overtime_type_name']."</td>
									<td>".$val['overtime_request_description']."</td>
									<td>".tgltoview($val['overtime_request_date'])."</td>
									<td>".$val['overtime_request_hours']."</td>
									<td>".$val['overtime_request_minutes']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancyckp/deletePayrollOvertimeRequest/'.$val['employee_id']."/".$val['overtime_request_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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