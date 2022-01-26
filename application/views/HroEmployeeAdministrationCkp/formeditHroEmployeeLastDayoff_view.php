<?php
	$employee_id 				= $this->uri->segment(3);	
	$employee_absence_date 		= $this->uri->segment(4);	
	$employee_schedule_item_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit_lastdayoff(){
		document.location = base_url+"HroEmployeeAdministrationCkp/reset_edit_lastdayoff/<?php echo $employee_id; ?>";
	}

	function function_elements_edit_lastdayoff(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAdministrationCkp/function_elements_edit_lastdayoff');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>

					
				
<?php 
	echo form_open('HroEmployeeAdministrationCkp/processEditHROEmployeeData_LastDayOff',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 		= $this->session->userdata('unique');

	$datalastdayoff	= $this->session->userdata('edithroemployeelastdayoff-'.$unique['unique']);

	$employee_id 	= $this->uri->segment(3);	
?>

<?php 
	echo $this->session->userdata('message_absence');
	$this->session->unset_userdata('message_absence');
?>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_last_day_off_old" name="employee_last_day_off_old" onChange="function_elements_edit_lastdayoff(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata_lastdayoff['employee_last_day_off']);?>" readonly>
			<label class="control-label">Libur Terakhir Lama</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_day_off_cycle_old" name="employee_day_off_cycle_old" onChange="function_elements_edit_lastdayoff(this.name, this.value);" value="<?php echo $hroemployeedata_lastdayoff['employee_day_off_cycle'];?>" readonly>
			<label class="control-label">Siklus Libur Lama</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_day_off_status_old" name="employee_day_off_status_old" onChange="function_elements_edit_lastdayoff(this.name, this.value);" value="<?php echo $dayoffstatus[$hroemployeedata_lastdayoff['employee_day_off_status']];?>" readonly>
			<label class="control-label">Status Libur Lama</label>
		</div>	
	</div>
</div>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_last_day_off" id="employee_last_day_off" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($datalastdayoff['employee_last_day_off']);?>"/>
			<label class="control-label">Libur Terakhir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_day_off_cycle" name="employee_day_off_cycle" onChange="function_elements_edit_lastdayoff(this.name, this.value);" value="<?php echo $datalastdayoff['employee_day_off_cycle'];?>" >
			<label class="control-label">Siklus Libur</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_day_off_status', $dayoffstatus, set_value('employee_day_off_status',$datalastdayoff['employee_day_off_status']),'id="employee_day_off_status", class="form-control select2me",  onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Status Libur</label>
		</div>	
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_edit_lastdayoff();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>

<?php echo form_close(); ?>

