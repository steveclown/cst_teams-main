<?php
	$employee_id 				= $this->uri->segment(3);	
	$employee_absence_date 		= $this->uri->segment(4);	
	$employee_schedule_item_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit_rfidcode(){
		document.location = base_url+"hroemployeeadministrationckp/reset_edit_rfidcode/<?php echo $employee_id; ?>";
	}

	function function_elements_edit_rfidcode(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministrationckp/function_elements_edit_rfidcode');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>


					
				
<?php 
	echo form_open('hroemployeeadministrationckp/processAddHROEmployeeChangeRFID',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 		= $this->session->userdata('unique');

	$datarfidcode	= $this->session->userdata('edithroemployeerfidcode-'.$unique['unique']);

	$employee_id 	= $this->uri->segment(3);	
?>

<?php 
	echo $this->session->userdata('message_changerfid');
	$this->session->unset_userdata('message_changerfid');
?>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_rfid_code_old" name="employee_rfid_code_old" onChange="function_elements_edit_rfidcode(this.name, this.value);" value="<?php echo $hroemployeedata_rfidcode['employee_rfid_code'];?>" readonly>
			<label class="control-label">RFID Code Old</label>
		</div>
	</div>
</div>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_change_rfid_reason" name="employee_change_rfid_reason" onChange="function_elements_edit_rfidcode(this.name, this.value);" value="<?php echo $datarfidcode['employee_change_rfid_reason'];?>" autofocus>
			<label class="control-label">Change RFID Reason</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_rfid_code" name="employee_rfid_code" onChange="function_elements_edit_rfidcode(this.name, this.value);" value="<?php echo $datarfidcode['employee_rfid_code'];?>" >
			<label class="control-label">RFID Code
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_edit_rfidcode();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Change RFID Date</th>
						<th>RFID Code Old</th>
						<th>RFID Code</th>
						<th>Change RFID Reason</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeechangerfid)){
						echo "<tr><th colspan='4' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeechangerfid as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_change_rfid_date'])."</td>
									<td>".$val['employee_rfid_code_old']."</td>
									<td>".$val['employee_rfid_code']."</td>
									<td>".$val['employee_change_rfid_reason']."</td>
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