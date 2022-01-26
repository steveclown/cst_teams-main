<script>
	function reset_add_suspend(){
		document.location = base_url+"hroemployeeemploymentilufa/reset_add_suspend";
	}

	function function_elements_add_suspend(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemploymentilufa/function_elements_add_suspend');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function() 
   	{
     	$('#modalhroemployeesuspend').on('show.bs.modal', function (e) 
        {

          var employee_suspend_id = $(e.relatedTarget).data('id');
                                                                                             
          document.getElementById('employee_suspend_id_status').value = employee_suspend_id;
        });
   	});
</script>

<?php 
	echo form_open('hroemployeeemploymentilufa/processAddHROEmployeeSuspend',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');

	$datasuspend	= $this->session->userdata('addhroemployeesuspend-'.$unique['unique']);

	if (empty($datasuspend)){
		$datasuspend['employee_suspend_date']	 		= date("Y-m-d");
	}
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_suspend_date" id="employee_suspend_date" onChange="function_elements_add_suspend(this.name, this.value);" value="<?php echo tgltoview($datasuspend['employee_suspend_date']);?>"/>
			<label class="control-label">Suspend Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('suspend_id', $coresuspend, set_value('suspend_id', $datasuspend['suspend_id']), 'id="suspend_id" class="form-control select2me" onChange="function_elements_add_suspend(this.name, this.value);"');
			?>
			<label>Suspend</label>
		</div>
	</div>	
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_suspend_description" id="employee_suspend_description" class="form-control" onChange="function_elements_add_suspend(this.name, this.value);" value="<?php echo $datasuspend['employee_suspend_description'];?>">
			<label class="control-label">Suspend Description</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_suspend_days" id="employee_suspend_days" class="form-control" onChange="function_elements_add_suspend(this.name, this.value);" value="<?php echo $datasuspend['employee_suspend_days'];?>">
			<label class="control-label">Suspend Days</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_suspend_salary_percentage" id="employee_suspend_salary_percentage" class="form-control" onChange="function_elements_add_suspend(this.name, this.value);" value="<?php echo $datasuspend['employee_suspend_salary_percentage'];?>">
			<label class="control-label">Salary Percentage</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_suspend_remark" id="employee_suspend_remark" class="form-control" onChange="function_elements_add_suspend(this.name, this.value);"><?php echo $datasuspend['employee_suspend_remark'];?></textarea>
			<label class="control-label">Employee Suspend Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_suspend();"><i class="fa fa-times"></i> Reset</button>
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
						<th width = "15%">Suspend Date</th>
						<th width = "20%">Suspend Name</th>
						<th width = "15%">Suspend Description</th>
						<th width = "10%">Suspend Days</th>
						<th width = "15%">Suspend Status Date</th>
						<th width = "10%">Suspend Status</th>
						<th width = "15%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeesuspend)){
						echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeesuspend as $key => $val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_suspend_date'])."</td>
									<td>".$val['suspend_name']."</td>
									<td>".$val['employee_suspend_description']."</td>
									<td>".$val['employee_suspend_days']."</td>
									<td>".$val['employee_suspend_status_date']."</td>
									<td>".$this->configuration->SuspendStatus[$val['employee_suspend_status']]."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeemploymentilufa/deleteHROEmployeeSuspend/'.$val['employee_id']."/".$val['employee_suspend_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>";

										if ($val['employee_suspend_status'] == 1){
											echo "<a href='#modalhroemployeesuspend' class='btn default btn-xs green' data-toggle='modal' data-id='".$val['employee_suspend_id']."'><i class='fa fa-bars'></i> Unsuspend</a>";
										}
									echo "</td>
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

<?php echo form_open('hroemployeeemploymentilufa/processUnsuspendHROEmployeeSuspend',array('id' => 'myform', 'class' => 'horizontal-form'));
?>
<script>
	$(document).ready(function(){
        $("#save").click(function(){
			var employee_suspend_status_remark = $("#employee_suspend_status_remark").val();
						
		  	if(employee_suspend_status_remark != '' && employee_suspend_status_remark != ''){
				return true;
			}else{
				alert('Data Not Complete');
				return false;
			}
		});
    });
</script>
	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="modalhroemployeesuspend" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">HRO Employee Unsuspend</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Remark</label>
							<div class="input-icon right">
								<i class="fa"></i>
								<textarea rows="3" name="employee_suspend_status_remark" id="employee_suspend_status_remark" class="form-control" onChange="function_elements_add_suspend(this.name, this.value);"><?php echo $datasuspend['employee_suspend_status_remark'];?></textarea>
							</div>	
						</div>	
					</div>
					

					<input type="hidden" class="form-control" name="employee_suspend_id_status" id="employee_suspend_id_status"  value=""/>

					<input type="hidden" class="form-control" name="employee_id_status" id="employee_id_status"  value="<?php echo $hroemployeedata['employee_id']?>"/>
					
					<div class="modal-footer">
						<button type="button" class="btn red" data-dismiss="modal">Close</button>
						<button type="submit" id="save" class="btn green"><i class="fa fa-check"></i> Save</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
	<!-- /.modal -->
<?php
echo form_close(); 
?>