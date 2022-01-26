<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_canceloff(){
		document.location = base_url+"hroemployeeattendancediscrepancyckp/reset_add_canceloff/<?php echo $employee_id; ?>/<?php echo $employee_absence_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_permit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_elements_add_canceloff');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

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
	echo form_open('hroemployeeattendancediscrepancyckp/processAddHROEmployeeCancelOff',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');

	$datacanceloff	= $this->session->userdata('addhroemployeecanceloff-'.$unique['unique']);

	if (empty($datacanceloff)){
		$datacanceloff['employee_cancel_off_date'] 		= $employee_attendance_date;
	}

?>

<?php 
	echo $this->session->userdata('message_canceloff');
	$this->session->unset_userdata('message_canceloff');
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_cancel_off_date" name="employee_cancel_off_date" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo tgltoview($datacanceloff['employee_cancel_off_date']);?>" readonly>
			<label class="control-label">Cancel Off Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_cancel_off_description" name="employee_cancel_off_description" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $datacanceloff['employee_cancel_off_description'];?>">
			<label class="control-label">Cancel Off Description </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_cancel_off_remark" id="employee_cancel_off_remark" onChange="function_elements_add_permit(this.name, this.value);" class="form-control"><?php echo $datacanceloff['employee_cancel_off_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_canceloff();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Cancel Off Date</th>
						<th>Cancel Off Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeecanceloff)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeecanceloff as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_cancel_off_date'])."</td>
									<td>".$val['employee_cancel_off_description']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancyckp/deleteHROEmployeeCancelOff/'.$val['employee_id']."/".$val['employee_cancel_off_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				


