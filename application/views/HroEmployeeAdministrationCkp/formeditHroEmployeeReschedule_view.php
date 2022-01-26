<?php
	$employee_id 				= $this->uri->segment(3);	
	$employee_absence_date 		= $this->uri->segment(4);	
	$employee_schedule_item_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_shiftassignment(){
		document.location = base_url+"hroemployeeadministrationckp/reset_add_shiftassignment/<?php echo $employee_id; ?>";
	}

	function function_elements_add_shiftassignment(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministrationckp/function_elements_edit_reschedule');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>					
				
<?php 
	echo form_open('hroemployeeadministrationckp/processAddScheduleShiftAssignment',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 				= $this->session->userdata('unique');

	$datashiftassignment	= $this->session->userdata('addscheduleshiftassignment-'.$unique['unique']);

	$employee_id 			= $this->uri->segment(3);	

?>

<?php 
	echo $this->session->userdata('message_reschedule');
	$this->session->unset_userdata('message_reschedule');
?>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="shift_assignment_cycle" id="shift_assignment_cycle" class="form-control" value="<?php echo $datashiftassignment['shift_assignment_cycle']; ?>" onChange="function_elements_add_shiftassignment(this.name, this.value);">
			<label for="form_control">Siklus Shift Penugasan
				<span class="required">*</span>
			</label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
            	echo form_dropdown('shift_pattern_id', $scheduleshiftpattern ,set_value('shift_pattern_id', $datashiftassignment['shift_pattern_id']),'id="shift_pattern_id", class="form-control select2me" onChange="function_elements_add_shiftassignment(this.name, this.value);"');
            ?>
			<label for="form_control">Pola Shift
				<span class="required">*</span>
			</label>
		</div>	
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
           <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_start_date" id="shift_assignment_start_date" onChange="function_elements_add_shiftassignment(this.name, this.value);" value="<?php echo tgltoview($datashiftassignment['shift_assignment_start_date']);?>">
			<label for="form_control">Tanggal Mulai
				<span class="required">*</span>
			</label>
		</div>	
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_shiftassignment();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>

<?php echo form_close(); ?>

<br>
							
