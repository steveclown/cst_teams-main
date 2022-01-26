<script>
	base_url = '<?php echo base_url()?>';
	
	function reset_add_separation(){
		document.location = base_url+"hroemployeeemploymentilufa/reset_add_separation";
	}

	function function_elements_add_separation(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemploymentilufa/function_elements_add_separation');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}
</script>

<?php 
	echo form_open('hroemployeeemploymentilufa/processAddHROEmployeeSeparation',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	
	$dataseparation	= $this->session->userdata('addhroemployeeseparation-'.$unique['unique']);

	if (empty($dataseparation)){
		$dataseparation['employee_separation_date']	 		= date("Y-m-d");
	}
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_separation_date" id="employee_separation_date" onChange="function_elements_add_separation(this.name, this.value);" value="<?php echo tgltoview($dataseparation['employee_separation_date']);?>"/>
			<label class="control-label">Separation Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('separation_reason_id', $coreseparationreason ,set_value('separation_reason_id', $dataseparation['separation_reason_id']), 'id="separation_reason_id", class="form-control select2me" onChange="function_elements_add_separation(this.name, this.value);" onChange="function_elements_add_separation(this.name, this.value);"');?>
			<label class="control-label">Separation Reason Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_separation_description" name="employee_separation_description" onChange="function_elements_add_separation(this.name, this.value);" value="<?php echo $dataseparation['employee_separation_description'];?>">
			<label class="control-label">Separation Description </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_separation_remark" id="employee_separation_remark" onChange="function_elements_add_separation(this.name, this.value);" class="form-control"><?php echo $dataseparation['employee_separation_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>
							

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th width = "15%">Separation Date</th>
						<th width = "15%">Separation Reason Name</th>
						<th width = "20%">Separation Description</th>
						<th width = "20%">Separation Remark</th>
						<th width = "20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeseparation)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeseparation as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_separation_date'])."</td>
									<td>".$val['separation_reason_name']."</td>
									<td>".$val['employee_separation_description']."</td>
									<td>".$val['employee_separation_remark']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeemploymentilufa/deleteHROEmployeeSeparation/'.$val['employee_id']."/".$val['employee_separation_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>
									</td>
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