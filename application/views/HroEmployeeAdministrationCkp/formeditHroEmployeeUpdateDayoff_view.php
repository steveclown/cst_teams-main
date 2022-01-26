<?php
	$employee_id 				= $this->uri->segment(3);	
	$employee_absence_date 		= $this->uri->segment(4);	
	$employee_schedule_item_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit_updatedayoff(){
		document.location = base_url+"HroEmployeeAdministrationCkp/reset_edit_updatedayoff/<?php echo $employee_id; ?>";
	}

	function function_elements_edit_updatedayoff(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAdministrationCkp/function_elements_edit_updatedayoff');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>

					
				
<?php 
	echo form_open('HroEmployeeAdministrationCkp/processEditHROEmployeeData_UpdateDayOff',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 		= $this->session->userdata('unique');

	$dataupdatedayoff	= $this->session->userdata('edithroemployeeupdatedayoff-'.$unique['unique']);

	if (empty($dataupdatedayoff['employee_last_day_off'])){
		$dataupdatedayoff['employee_last_day_off'] = date("Y-m-d");
	}
	if(empty($dataupdatedayoff['employee_update_dayoff_reason'])){
		$dataupdatedayoff['employee_update_dayoff_reason']="";
	}
	if(empty($dataupdatedayoff['employee_day_off_cycle'])){
		$dataupdatedayoff['employee_day_off_cycle']="";
	}


	$employee_id 	= $this->uri->segment(3);	
?>

<?php 
	echo $this->session->userdata('message_updatedayoff');
	$this->session->unset_userdata('message_updatedayoff');
?>

<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_last_day_off" id="employee_last_day_off" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($dataupdatedayoff['employee_last_day_off']);?>"/>
			<label class="control-label">Libur Terakhir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_day_off_cycle" name="employee_day_off_cycle" onChange="function_elements_edit_updatedayoff(this.name, this.value);" value="<?php echo $dataupdatedayoff['employee_day_off_cycle'];?>" >
			<label class="control-label">Siklus Libur</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_update_dayoff_reason" name="employee_update_dayoff_reason" onChange="function_elements_edit_updatedayoff(this.name, this.value);" value="<?php echo $dataupdatedayoff['employee_update_dayoff_reason'];?>" >
			<label class="control-label">Alasan Perbaruan Hari Libur</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_edit_updatedayoff();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
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
						<th>Tanggal Pembaruan Libur</th>
						<th>Libur Terakhir</th>
						<th>Siklus Libur</th>
						<th>Alasan Pembaruan Libur</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeupdatedayoff)){
						echo "<tr><th colspan='4' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeupdatedayoff as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_update_dayoff_date'])."</td>
									<td>".tgltoview($val['employee_last_day_off'])."</td>
									<td>".$val['employee_day_off_cycle']."</td>
									<td>".$val['employee_update_dayoff_reason']."</td>
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



