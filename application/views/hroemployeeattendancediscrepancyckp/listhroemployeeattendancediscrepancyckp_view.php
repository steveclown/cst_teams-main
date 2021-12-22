<script>
	base_url = '<?php echo base_url();?>';

    function reset_search(){
		document.location = base_url+"hroemployeeattendancediscrepancyckp/reset_search";
	}

	 function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	$(document).ready(function(){
        $("#location_id").change(function(){
			var location_id 	= $("#location_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/getScheduleEmployeeShift');?>",
					data: {location_id: location_id},
					success: function(msg){
					// alert(msg);
					$('#employee_shift_id').html(msg);
				}
				});
		});
	});

	$(document).ready(function(){
        $("#employee_shift_id").change(function(){
			var employee_shift_id 	= $("#employee_shift_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/getScheduleEmployeeShiftItem');?>",
					data: {employee_shift_id: employee_shift_id},
					success: function(msg){
					// alert(msg);
					$('#employee_id').html(msg);
				}
				});
		});
	});

	$(document).ready(function() 
   	{
     	$('#modaldeletehroemployeeattendancedata').on('show.bs.modal', function (e) 
        {

          var employee_attendance_data_id = $(e.relatedTarget).data('id');
                                                                                             
          document.getElementById('employee_attendance_data_id_delete').value = employee_attendance_data_id;
        });
   	});
</script>

<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>
			
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="hroemployeeattendancediscrepancyckp">
							Employee Attendance Discrepancy List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Employee Attendance Data Discrepancy List
			</h1>


<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('filter-hroemployeeattendancediscrepancyckp');

	if(!is_array($data)){
		$data['start_date'] 	= date("d-m-Y");
		$data['end_date']		= date("d-m-Y");
	}

?>
<?php echo form_open('hroemployeeattendancediscrepancyckp/filter',array('id' => 'myformfilter', 'class' => '')); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Filter
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
				                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value = <?php echo $data['start_date']?>>
												<label for="form_control">Start Date</label>
											</div>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value = <?php echo $data['end_date']?>>
												<label for="form_control">End Date</label>
											</div>	
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Location Name</label>
											</div>	
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['location_id'])){
														$scheduleemployeeshift = create_double($this->hroemployeeattendancediscrepancyckp_model->getScheduleEmployeeShift_Location($data['location_id']), 'employee_shift_id', 'employee_shift_code');

														echo form_dropdown('employee_shift_id', $scheduleemployeeshift, set_value('employee_shift_id', $data['employee_shift_id']), 'id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?>
													<select name="employee_shift_id" id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose One--</option>
													</select>
												<?php
													}
												?>	
												<label class="control-label">Employee Shift Code<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('unit_id', $coreunit, set_value('unit_id', $data['unit_id']), 'id="unit_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Unit Name</label>
											</div>	
										</div>

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_date_status', $employeeattendancedatestatus, set_value('employee_attendance_date_status', $data['employee_attendance_date_status']), 'id="employee_attendance_date_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Date Status</label>
											</div>	
										</div>

										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['employee_shift_id'])){
														$scheduleemployeeshiftitem = create_double($this->hroemployeeattendancediscrepancyckp_model->getScheduleEmployeeShiftItem($data['employee_shift_id']), 'employee_id', 'employee_name');

														echo form_dropdown('employee_id', $scheduleemployeeshiftitem, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?>
													<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose One--</option>
													</select>
												<?php
													}
												?>	
												<label class="control-label">Employee Name<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_late_status', $employeeattendancelatestatus, set_value('employee_attendance_late_status', $data['employee_attendance_late_status']), 'id="employee_attendance_late_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Late Status</label>
											</div>	
										</div>	

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_overtime_status', $employeeattendanceovertimestatus, set_value('employee_attendance_overtime_status', $data['employee_attendance_overtime_status']), 'id="employee_attendance_overtime_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Overtime Status</label>
											</div>	
										</div>	

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_attendance_homeearly_status', $employeeattendancehomeearlystatus, set_value('employee_attendance_homeearly_status', $data['employee_attendance_homeearly_status']), 'id="employee_attendance_homeearly_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Home Early Status</label>
											</div>	
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 " style="text-align  : right !important;">
											<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_search()"><i class="fa fa-times"></i> Reset</button>
										<button type="submit" name="find" id="find" class="btn green-jungle" title="Find"><i class="fa fa-check"></i> Find</button>	
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th>
									Employee Shift Code
								</th>
								<th>
									Employee Code
								</th>
								<th>
									Employee Name
								</th>
								<th>
									Unit Name
								</th>
								<th>
									Attendance Date
								</th>
								<th>
									In Date
								</th>
								<th>
									Out Date
								</th>
								<th>
									Working Hours
								</th>
								<th>
									Date Status
								</th>
								<th>
									Late Status
								</th>
								<th>
									Overtime Status
								</th>
								<th>
									Home Early Status
								</th>
								<th>
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeeattendancedata as $key => $val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_shift_code']."</td>
											<td>".$val['employee_code']."</td>
											<td>".$val['employee_name']."</td>
											<td>".$val['unit_name']."</td>
											<td>".tgltoview($val['employee_attendance_date'])."</td>
											<td>".$val['employee_attendance_in_date']."</td>
											<td>".$val['employee_attendance_out_date']."</td>
											<td>".$val['employee_attendance_working_time_hours']." m ".$val['employee_attendance_working_time_minutes']."m</td>
											<td>".$this->configuration->EmployeeAttendanceDateStatus[$val['employee_attendance_date_status']]."</td>
											<td>".$this->configuration->EmployeeAttendanceLateStatus[$val['employee_attendance_late_status']]."</td>
											<td>".$this->configuration->EmployeeAttendanceOvertimeStatus[$val['employee_attendance_overtime_status']]."</td>
											<td>".$this->configuration->EmployeeAttendanceHomeEarlyStatus[$val['employee_attendance_homeearly_status']]."</td>
											<td>
												<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/'.$val['employee_id']."/".$val['employee_attendance_date']."/".$val['employee_attendance_data_id']."' class='btn default btn-xs green-jungle'>
													<i class='fa fa-plus'></i> Add
												</a>

												<a href='#modaldeletehroemployeeattendancedata' class='btn default btn-xs red' data-toggle='modal' data-id='".$val['employee_attendance_data_id']."'><i class='fa fa-trash-o'></i> Delete</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>



<?php 
	echo form_open('hroemployeeattendancediscrepancyckp/deleteHROEmployeeAttendanceData',array('id' => 'myform', 'class' => 'horizontal-form'));
?>
<script>
	$(document).ready(function(){
        $("#save").click(function(){
			var employee_attendance_delete_remark = $("#employee_attendance_delete_remark").val();
			
		  	if(employee_attendance_delete_remark != '' && employee_attendance_delete_remark != ''){
				return true;
			}else{
				alert('Data Not Complete');
				return false;
			}
		});
    });
</script>
	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="modaldeletehroemployeeattendancedata" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Delete HRO Employee Attendance Data</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Remark</label>
							<div class="input-icon right">
								<i class="fa"></i>
								<?php 
									echo form_textarea(array('rows'=>'3','name'=>'employee_attendance_delete_remark','class'=>'form-control','id'=>'employee_attendance_delete_remark'))?>
							</div>	
						</div>	
					</div>
					

					<input type="hidden" class="form-control" name="employee_attendance_data_id_delete" id="employee_attendance_data_id_delete"  value=""/>
					
					<div class="modal-footer">
						<button type="button" class="btn red" data-dismiss="modal">Close</button>
						<button type="submit" id="save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
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