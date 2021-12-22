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
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeeattendancedatareport/reset_search";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancedatareport/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	$(document).ready(function(){
        $("#employee_shift_id").change(function(){
			var employee_shift_id 	= $("#employee_shift_id").val();


			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('hroemployeeattendancedatareport/getScheduleEmployeeShiftItem');?>",
					data: {employee_shift_id: employee_shift_id},
					success: function(msg){
					// alert(msg);
					$('#employee_id').html(msg);
				}
				});
		});
	});

</script>


			
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
						<a href="hroemployeeattendancedatareport">
							Employee Attendance Data Report List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Employee Attendance Data Report List
			</h1>

<?php 
	echo form_open('hroemployeeattendancedatareport/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-hroemployeeattendancedatareport');
	if(!is_array($data)){
		$data['employee_shift_id']		= "";
		$data['employee_id']			= "";
		$data['start_date']				= date("Y-m-d");
		$data['end_date']				= date("Y-m-d");
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label">Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">End Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>
					<div class = "row">
						<?php
							/*print_r("data ");
							print_r($data);*/
						?>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_shift_id', $scheduleemployeeshift, set_value('employee_shift_id', $data['employee_shift_id']), 'id="employee_shift_id" class="form-control select2me" ');
								?>
								<label class="control-label">Employee Shift Code</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									if ($data['employee_shift_id'] != ''){
										$scheduleemployeescheduleitem = create_double($this->hroemployeeattendancedatareport_model->getScheduleEmployeeShiftItem($data['employee_shift_id']), 'employee_id', 'employee_name');

										echo form_dropdown('employee_id', $scheduleemployeescheduleitem, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" ');
									} else {
								?>
									<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Choose One--</option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Employee Name</label>
							</div>	
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<?php
	echo form_open('hroemployeeattendancedatareport/processPrinting'); 
?>
<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-body form">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
									<thead>
										<tr>
											<th>No</th>
											<th>Shift Group</th>
											<th>Division Name</th>
											<th>Department Name</th>
											<th>Section Name</th>
											<th>Employee Code</th>
											<th>Employee Name</th>
											<th>Attendance In Date </th>
											<th>Attendance Out Date </th>
											<th>Attendance Status</th>
											<th>Overtime Hours</th>
											<th>Late Hours</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no=1;
											if(!is_array($hroemployeeattendancedata)){
												echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
											} else {
												foreach ($hroemployeeattendancedata as $key=>$val){
													echo"
														<tr>	
															<td>".$no."</td>	
															<td>".$val['employee_shift_code']."</td>	
															<td>".$val['division_name']."</td>	
															<td>".$val['department_name']."</td>
															<td>".$val['section_name']."</td>		
															<td>".$val['employee_code']."</td>
															<td>".$val['employee_name']."</td>
															<td>".$val['employee_attendance_in_date']."</td>	
															<td>".$val['employee_attendance_out_date']."</td>	
															<td>".$this->configuration->EmployeeAttendanceDateStatus[$val['employee_attendance_date_status']]."</td>	
															<td>".$val['employee_attendance_overtime_hours']." Jam ".$val['employee_attendance_overtime_minutes']." Menit</td>	
															<td>".$val['employee_attendance_late_hours']." Jam ".$val['employee_attendance_late_minutes']." Menit</td>	
														</tr>
													";
													$no++;
												} 
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<br>
						<br>
						<div class = "row">
							<div class = "col-md-12">
								<div class="form-group form-md-line-input">
									<div class="form-actions right">
										<a href='javascript:void(window.open("<?php echo base_url(); ?>hroemployeeattendancedatareport/exportHROEmployeeAttendanceData/","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
	                                        <i class="fa fa-file-excel-o"></i> Export Data
	                                   	</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>