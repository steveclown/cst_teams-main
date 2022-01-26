<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_absence(){
		document.location = base_url+"HroEmployeeAttendanceDiscrepancy/reset_add_absence/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_absence(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceDiscrepancy/function_elements_add_absence');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>
<?php 
	$year_now 	=	date('Y');
	// if(!is_array($sesi)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	// for($i=($year_now); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 
?>

					
				
<?php 
	echo form_open('HroEmployeeAttendanceDiscrepancy/processAddHROEmployeeAbsence',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 		= $this->session->userdata('unique');

	$dataabsence	= $this->session->userdata('addhroemployeeabsence-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	$dataabsence['employee_absence_date'] 		= $employee_attendance_date;
	$dataabsence['employee_absence_start_date'] = $employee_attendance_date;
	$dataabsence['employee_absence_end_date'] 	= $employee_attendance_date;

	if(empty($dataabsence['absence_id'])){
		$dataabsence['absence_id']=9;
	}

	if(empty($dataabsence['employee_absence_description'])){
		$dataabsence['employee_absence_description']="";
	}
?>

<?php 
	echo $this->session->userdata('message_absence');
	$this->session->unset_userdata('message_absence');
?>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_absence_date" name="employee_absence_date" onChange="function_elements_add_absence(this.name, this.value);" value="<?php echo tgltoview($dataabsence['employee_absence_date']);?>" readonly>
			<label class="control-label">Absence Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('absence_id', $coreabsence ,set_value('absence_id',$dataabsence['absence_id']),'id="absence_id", class="form-control select2me" onChange="function_elements_add_absence(this.name, this.value);" ');?>
			<label class="control-label">Absence Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_absence_description" name="employee_absence_description" onChange="function_elements_add_absence(this.name, this.value);" value="<?php echo $dataabsence['employee_absence_description'];?>">
			<label class="control-label">Absence Description </label>
		</div>	
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_absence();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
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
						<th>Absence Date</th>
						<th>Absence Name</th>
						<th>Absence Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeabsence)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeabsence as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_absence_date'])."</td>
									<td>".$val['absence_name']."</td>
									<td>".$val['employee_absence_description']."</td>
									<td>
										<a href='".$this->config->item('base_url').'HroEmployeeAttendanceDiscrepancy/deleteHROEmployeeAbsence/'.$val['employee_id']."/".$val['employee_absence_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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