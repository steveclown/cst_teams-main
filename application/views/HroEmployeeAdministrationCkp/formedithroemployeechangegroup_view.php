<?php
	$employee_id 				= $this->uri->segment(3);	
	$employee_absence_date 		= $this->uri->segment(4);	
	$employee_schedule_item_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit_changegroup(){
		document.location = base_url+"hroemployeeadministrationckp/reset_edit_changegroup/<?php echo $employee_id; ?>";
	}

	function function_elements_edit_changegroup(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministrationckp/function_elements_edit_changegroup');?>",
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
					url : "<?php echo site_url('hroemployeeadministrationckp/getScheduleEmployeeShift');?>",
					data: {location_id: location_id},
					success: function(msg){
					// alert(msg);
					$('#employee_shift_id').html(msg);
				}
				});
		});
	});
</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

					
				
<?php 
	echo form_open('hroemployeeadministrationckp/processAddHROEmployeeChangeGroup',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 			= $this->session->userdata('unique');

	$datachangegroup	= $this->session->userdata('edithroemployeechangegroup-'.$unique['unique']);

	$employee_id 		= $this->uri->segment(3);	

?>

<?php 
	echo $this->session->userdata('message_changegroup');
	$this->session->unset_userdata('message_changegroup');
?>

<div class = "row">	
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="location_name_old" name="location_name_old" onChange="function_elements_edit_changegroup(this.name, this.value);" value="<?php echo $hroemployeedata_shiftgroup['location_name'];?>" readonly>

			<input type="hidden" class="form-control" id="location_id_old" name="location_id_old" onChange="function_elements_edit_changegroup(this.name, this.value);" value="<?php echo $hroemployeedata_shiftgroup['location_id'];?>" readonly>
			<label class="control-label">Location Name Old
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_shift_code_old" name="employee_shift_code_old" onChange="function_elements_edit_changegroup(this.name, this.value);" value="<?php echo $hroemployeedata_shiftgroup['employee_shift_code'];?>" readonly>

			<input type="hidden" class="form-control" id="employee_shift_id_old" name="employee_shift_id_old" onChange="function_elements_edit_changegroup(this.name, this.value);" value="<?php echo $hroemployeedata_shiftgroup['employee_shift_id'];?>" readonly>
			<label class="control-label">Employee Shift Group Old
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
			<?php
				echo form_dropdown('location_id', $corelocation, set_value('location_id', $datachangegroup['location_id']),'id="location_id" class="form-control select2me" onChange="function_elements_edit_changegroup(this.name, this.value);"');
			?>
			<label class="control-label">Location Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<select name="employee_shift_id" id="employee_shift_id" class="form-control select2me" onChange="function_elements_edit_changegroup(this.name, this.value);">
				<option value="">--Choose One--</option>
			</select>
			<label class="control-label">Employee Shift Code
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
			<input type="text" autocomplete="off"  class="form-control" id="employee_change_group_reason" name="employee_change_group_reason" onChange="function_elements_edit_changegroup(this.name, this.value);" value="<?php echo $datachangegroup['employee_change_group_reason'];?>" >
			<label class="control-label">Change Group Reason
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_edit_changegroup();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>

<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>

<?php echo form_close(); ?>

<br>
							
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Change Group Date</th>
						<th>Location Name Old</th>
						<th>Employee Shift Code Old</th>
						<th>Location Name</th>
						<th>Employee Shift Code</th>
						<th>Change RFID Reason</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeechangegroup)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeechangegroup as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_change_group_date'])."</td>
									<td>".$this->hroemployeeadministrationckp_model->getLocationName($val['location_id_old'])."</td>
									<td>".$this->hroemployeeadministrationckp_model->getEmployeeShiftCode($val['employee_shift_id_old'])."</td>
									<td>".$val['location_name']."</td>
									<td>".$val['employee_shift_code']."</td>
									<td>".$val['employee_change_group_reason']."</td>
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