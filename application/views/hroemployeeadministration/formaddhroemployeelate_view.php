<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_late(){
		document.location = base_url+"hroemployeeadministration/reset_add_late/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_late(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministration/function_elements_add_late');?>",
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
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

					

			
<?php 
	echo form_open('hroemployeeadministration/processAddHROEmployeeLate',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');

	$datalate	= $this->session->userdata('addhroemployeelate-'.$unique['unique']);

	if (empty($datalate)){
		$datalate['employee_late_date'] = date("Y-m-d");
	}
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_late_date" id="employee_late_date" onChange="function_elements_add_late(this.name, this.value);" value="<?php echo tgltoview($datalate['employee_late_date']);?>"/>
			<label class="control-label">Late Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('late_id', $corelate ,set_value('late_id',$datalate['late_id']),'id="late_id", class="form-control select2me" onChange="function_elements_add_late(this.name, this.value);" onChange="function_elements_add_late(this.name, this.value);"');?>
			<label class="control-label">Late Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_late_description" name="employee_late_description" onChange="function_elements_add_late(this.name, this.value);" value="<?php echo $datalate['employee_late_description'];?>">
			<label class="control-label">Late Description </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_late_duration" name="employee_late_duration" onChange="function_elements_add_late(this.name, this.value);" value="<?php echo $datalate['employee_late_duration'];?>">
			<label class="control-label">Late Duration </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_late_remark" id="employee_late_remark" onChange="function_elements_add_late(this.name, this.value);" class="form-control"><?php echo $datalate['employee_late_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_late();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>

<br>
<br>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Late Date</th>
						<th>Late Name</th>
						<th>Late Description</th>
						<th>Late Duration</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeelate)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeelate as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_late_date'])."</td>
									<td>".$val['late_name']."</td>
									<td>".$val['employee_late_description']."</td>
									<td>".$val['employee_late_duration']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeadministration/deleteHROEmployeeLate/'.$val['employee_id']."/".$val['employee_late_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				
		