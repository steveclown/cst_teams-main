<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_homeearly(){
		document.location = base_url+"hroemployeeattendancediscrepancyckp/reset_add_homeearly/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_homeearly(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_elements_add_homeearly');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
</script>

<?php 
	echo form_open('hroemployeeattendancediscrepancyckp/processAddHROEmployeeHomeEarly',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$unique 	= $this->session->userdata('unique');

	$datahomeearly	= $this->session->userdata('addhroemployeehomeearly-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	if (empty($datahomeearly)){
		$datahomeearly['employee_home_early_date'] 		= $employee_attendance_date;
	}

	$employeeattendance_homeearly = $this->hroemployeeattendancediscrepancyckp_model->getHROEmployeeAttendanceData_HomeEarly($employee_attendance_data_id);
?>
					
				
									
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_date" name="employee_home_early_date" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo tgltoview($datahomeearly['employee_home_early_date']);?>" readonly>
			<label class="control-label">Home Early Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('home_early_id', $corehomeearly,set_value('home_early_id',$data['home_early_id']),'id="home_early_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Home Early Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_hours" name="employee_home_early_hours" onChange="function_elements_add(this.name, this.value);" value="<?php echo $employeeattendance_homeearly['employee_attendance_homeearly_hours'];?>" readonly>
			<label class="control-label">Home Early Hours </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_minutes" name="employee_home_early_minutes" onChange="function_elements_add(this.name, this.value);" value="<?php echo $employeeattendance_homeearly['employee_attendance_homeearly_minutes'];?>" readonly>
			<label class="control-label">Home Early Minutes </label>
		</div>	
	</div>
</div>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_attendance_date_status', $employeeattendancedatestatus, set_value('employee_attendance_date_status', $data['employee_attendance_date_status']), 'id="employee_attendance_date_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Employee Attendance Date Status
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_description" name="employee_home_early_description" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_home_early_description'];?>">
			<label class="control-label">Home Early Description </label>
		</div>	
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_homeearly();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Home Early Name</th>
						<th>Home Early Date</th>
						<th>Home Early Hours</th>
						<th>Home Early Minutes</th>
						<th>Home Early Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeehomeearly)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeehomeearly as $key=>$val){
							echo"
								<tr>
									<td>".$val['home_early_name']."</td>
									<td>".tgltoview($val['employee_home_early_date'])."</td>
									<td>".$val['employee_home_early_hours']."</td>
									<td>".$val['employee_home_early_minutes']."</td>
									<td>".$val['employee_home_early_description']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancyckp/deleteHROEmployeeHomeEarly/'.$val['employee_id']."/".$val['employee_home_early_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>";
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