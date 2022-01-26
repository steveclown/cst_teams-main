<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_overtime(){
		document.location = base_url+"hroemployeeadministration/reset_add_overtime/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_overtime(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministration/function_elements_add_overtime');?>",
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
	echo form_open('hroemployeeadministration/processAddPayrollOvertimeRequest',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');

	$dataovertime	= $this->session->userdata('addpayrollovertimerequest-'.$unique['unique']);

	if (empty($dataovertime)){
		$dataovertime['overtime_request_date'] 		= date("Y-m-d");
	}
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="overtime_request_date" id="overtime_request_date" onChange="function_elements_add_overtime(this.name, this.value);" value="<?php echo tgltoview($dataovertime['overtime_request_date']);?>">
			<label class="control-label">Overtime Request Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('overtime_type_id', $coreovertimetype,set_value('overtime_type_id',$dataovertime['overtime_type_id']),'id="overtime_type_id" class="form-control select2me" onChange="function_elements_add_overtime(this.name, this.value);"');
			?>
			<label class="control-label">Overtime Type</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="overtime_request_description" id="overtime_request_description" value="<?php echo $dataovertime['overtime_request_description']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="overtime_request_duration" id="overtime_request_duration" value="<?php echo $dataovertime['overtime_request_duration']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">
			<label class="control-label">Duration</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="overtime_request_remark" id="overtime_request_remark" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);"><?php echo $dataovertime['overtime_request_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_overtime();"><i class="fa fa-times"></i> Reset</button>
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
						<th>Overtime Date</th>
						<th>Overtime Type</th>
						<th>Overtime Description</th>
						<th>Overtime Duration</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollovertimerequest)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollovertimerequest as $key => $val){
							echo"
								<tr>
									<td>".tgltoview($val['overtime_request_date'])."</td>
									<td>".$val['overtime_type_name']."</td>
									<td>".$val['overtime_request_description']."</td>
									<td>".$val['overtime_request_duration']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeadministration/deletePayrollOvertimeRequest/'.$val['employee_id']."/".$val['overtime_request_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>
									</td>";
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