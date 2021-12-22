<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_leave(){
		document.location = base_url+"hroemployeeemploymentilufa/reset_add_leave/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_leave(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemploymentilufa/function_elements_add_leave');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

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
	echo form_open('hroemployeeemploymentilufa/processAddPayrollLeaveRequest',array('id' => 'myform', 'class' => 'horizontal-form'));

	$unique 	= $this->session->userdata('unique');
	
	$dataleave	= $this->session->userdata('addpayrollleaverequest-'.$unique['unique']);

	if (empty($dataleave)){
		$dataleave['leave_request_date']	 		= date("Y-m-d");
		$dataleave['leave_request_start_date'] 		= date("Y-m-d");
		$dataleave['leave_request_end_date'] 		= date("Y-m-d");
	}
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_date" id="leave_request_date" onChange="function_elements_add_leave(this.name, this.value);" value="<?php echo tgltoview($dataleave['leave_request_date']);?>">
			<label class="control-label">Leave Request Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
	
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('annual_leave_id', $coreannualleave,set_value('annual_leave_id',$dataleave['annual_leave_id']),'id="annual_leave_id" class="form-control select2me" onChange="function_elements_add_leave(this.name, this.value);"');
			?>
			<label class="control-label">Leave Type</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_start_date" id="leave_request_start_date" onChange="function_elements_add_leave(this.name, this.value);" value="<?php echo tgltoview($dataleave['leave_request_start_date']);?>">
			<label class="control-label">Leave Request Start Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_end_date" id="leave_request_end_date" onChange="function_elements_add_leave(this.name, this.value);" value="<?php echo tgltoview($dataleave['leave_request_end_date']);?>">
			<label class="control-label">Leave Request End Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>


<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="leave_request_description" id="leave_request_description" value="<?php echo $dataleave['leave_request_description']?>" class="form-control" onChange="function_elements_add_leave(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="leave_request_duration" id="leave_request_duration" value="<?php echo $dataleave['leave_request_duration']?>" class="form-control" onChange="function_elements_add_leave(this.name, this.value);">
			<label class="control-label">Duration</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="leave_request_reason" id="leave_request_reason" class="form-control" onChange="function_elements_add_leave(this.name, this.value);"><?php echo $dataleave['leave_request_reason'];?></textarea>
			<label class="control-label">Reason</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_leave();"><i class="fa fa-times"></i> Reset</button>
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
						<th width = "15%">Leave Date</th>
						<th width = "15%">Leave Type</th>
						<th width = "20%">Leave Description</th>
						<th width = "10%">Start Date</th>
						<th width = "10%">End Date</th>
						<th width = "10%">Leave Duration</th>
						<th width = "20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollleaverequest)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollleaverequest as $key=>$val){
							$leave_request_id = $val['leave_request_id'];
							echo"
								<tr>
									<td>".tgltoview($val['leave_request_date'])."</td>
									<td>".$val['annual_leave_name']."</td>
									<td>".$val['leave_request_description']."</td>
									<td>".tgltoview($val['leave_request_start_date'])."</td>
									<td>".tgltoview($val['leave_request_end_date'])."</td>
									<td>".$val['leave_request_duration']."</td>
									<td>
										<a class='btn default btn-xs yellow' data-toggle='modal' href='#myModal' data-target='#detail-modal".$val['leave_request_id']."' id='".$val['leave_request_id']."'><i class='fa fa-pencil'></i> Detail
										</a>
										<a href='".$this->config->item('base_url').'payrollleaverequest/deletePayrollLeaveRequest_Data/'.$val['employee_id']."/".$val['leave_request_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				
