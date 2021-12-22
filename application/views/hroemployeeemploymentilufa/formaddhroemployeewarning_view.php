<script>
	function reset_add_warning(){
		document.location = base_url+"hroemployeeemploymentilufa/reset_add_warning";
	}

	function function_elements_add_warning(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemploymentilufa/function_elements_add_warning');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}
</script>

<?php 
	echo form_open('hroemployeeemploymentilufa/processAddHROEmployeeWarning',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	
	$datawarning	= $this->session->userdata('addhroemployeewarning-'.$unique['unique']);

	if (empty($datawarning)){
		$datawarning['employee_warning_date']	 		= date("Y-m-d");
	}
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_warning_date" id="employee_warning_date" onChange="function_elements_add_warning(this.name, this.value);" value="<?php echo tgltoview($datawarning['employee_warning_date']);?>"/>
			<label class="control-label">Warning Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('warning_id', $corewarning ,set_value('warning_id',$datawarning['warning_id']),'id="warning_id", class="form-control select2me" onChange="function_elements_add_warning(this.name, this.value);" onChange="function_elements_add_warning(this.name, this.value);"');?>
			<label class="control-label">Warning Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_warning_description" name="employee_warning_description" onChange="function_elements_add_warning(this.name, this.value);" value="<?php echo $datawarning['employee_warning_description'];?>">
			<label class="control-label">Warning Description </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_warning_remark" id="employee_warning_remark" onChange="function_elements_add_warning(this.name, this.value);" class="form-control"><?php echo $datawarning['employee_warning_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_warning();"><i class="fa fa-times"></i> Reset</button>
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
						<th width = "15%">Warning Date</th>
						<th width = "15%">Warning Name</th>
						<th width = "20%">Warning Description</th>
						<th width = "20%">Warning Remark</th>
						<th width = "20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeewarning)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeewarning as $key => $val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_warning_date'])."</td>
									<td>".$val['warning_name']."</td>
									<td>".$val['employee_warning_description']."</td>
									<td>".$val['employee_warning_remark']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeemploymentilufa/deleteHROEmployeeWarning/'.$val['employee_id']."/".$val['employee_warning_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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