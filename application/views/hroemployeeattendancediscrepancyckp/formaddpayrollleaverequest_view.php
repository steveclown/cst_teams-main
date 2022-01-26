<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>

<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_leave(){
		document.location = base_url+"hroemployeeadministrationckp/reset_add_leave/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_leave(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministrationckp/function_elements_add_leave');?>",
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
	
	for($i=($year_now); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
			
					


				
<?php 
	echo form_open('hroemployeeattendancediscrepancyckp/processAddPayrollLeaveRequest',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$unique 		= $this->session->userdata('unique');

	$dataleave	= $this->session->userdata('addpayrollleaverequest-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	$dataleave['leave_request_date'] 		= $employee_attendance_date;
?>

<?php 
	echo $this->session->userdata('message_leave');
	$this->session->unset_userdata('message_leave');
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="leave_request_date" id="leave_request_date" value="<?php echo tgltoview($dataleave['leave_request_date'])?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
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
				echo form_dropdown('annual_leave_id', $coreannualleave,set_value('annual_leave_id',$dataleave['annual_leave_id']),'id="annual_leave_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Leave Type</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="leave_request_description" id="leave_request_description" value="<?php echo $dataleave['leave_request_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Description</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset_session" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>"/>
<input type="hidden" name="employee_attendance_date" value="<?php echo $employee_attendance_date; ?>"/>
<input type="hidden" name="employee_attendance_data_id" value="<?php echo $employee_attendance_data_id; ?>"/>
<?php echo form_close(); ?>
						

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th width = "10%">Leave Type</th>
						<th width = "30%">Leave Description</th>
						<th width = "10%">Leave Date</th>
						<th width = "20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollleaverequest)){
						echo "<tr><th colspan='4' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollleaverequest as $key=>$val){
							$leave_request_id = $val['leave_request_id'];
							echo"
								<tr>
									<td>".$val['annual_leave_name']."</td>
									<td>".$val['leave_request_description']."</td>
									<td>".tgltoview($val['leave_request_date'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancyckp/deletePayrollLeaveRequest/'.$val['employee_id']."/".$val['leave_request_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				