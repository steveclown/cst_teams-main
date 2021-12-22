<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Employee Schedule</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Shift Assignment List</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Add Employee Schedule</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Add Employee Schedule
</h1>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>scheduleemployeeschedule/searchScheduleShiftAssignment" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php echo form_open('scheduleemployeeschedule/processAddScheduleEmployeeSchedule',array('class' => 'horizontal-form')); ?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="shift_assignment_id" id="shift_assignment_id" value="<?php echo $scheduleshiftassignment['shift_assignment_id']; ?>" class="form-control" readonly>
								<input type="hidden" name="shift_pattern_id" id="shift_pattern_id" value="<?php echo $scheduleshiftassignment['shift_pattern_id']; ?>" class="form-control" readonly>
								<input type="hidden" name="shift_pattern_weekly" id="shift_pattern_weekly" value="<?php echo $scheduleshiftassignment['shift_pattern_weekly']; ?>" class="form-control" readonly>
								<input type="hidden" name="shift_pattern_cycle" id="shift_pattern_cycle" value="<?php echo $scheduleshiftassignment['shift_pattern_cycle']; ?>" class="form-control" readonly>
								<input type="hidden" name="shift_assignment_start_date" id="shift_assignment_start_date" value="<?php echo $scheduleshiftassignment['shift_assignment_start_date']; ?>" class="form-control" readonly>
								<input type="text" name="shift_pattern_name" id="shift_pattern_name" value="<?php echo $scheduleshiftassignment['shift_pattern_name']; ?>" class="form-control" readonly>
								<label for="form_control">Shift Pattern Name</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_start_date" id="shift_assignment_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($scheduleshiftassignment['shift_assignment_start_date']);?>" readonlyl>
								<label for="form_control">Start Date</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" name="shift_pattern_weekly" id="shift_pattern_weekly" value="<?php echo $scheduleshiftassignment['shift_pattern_weekly']; ?>" class="form-control" readonly>
								<label for="form_control">Shift Pattern Weekly</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" name="shift_pattern_cycle" id="shift_pattern_cycle" value="<?php echo $scheduleshiftassignment['shift_pattern_cycle']; ?>" class="form-control" readonly>
								<label for="form_control">Shift Pattern Cycle</label>
							</div>	
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List
		</div>
	</div>
	<div class="portlet-body ">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th style='text-align:center'>Date</th>
								<th style='text-align:center'>Employee Name</th>
								<th style='text-align:center'>Shift Name</th>
								<th style='text-align:center'>Start Working Hour</th> 					
							</tr>
						</thead>
						<tbody>
							<?php
								$i=1;
								$weekly = $scheduleshiftassignment['shift_pattern_weekly'];
								$cycle 	= $scheduleshiftassignment['shift_pattern_cycle'];
								$date 	= $scheduleshiftassignment['shift_assignment_start_date'];
								$startdate = strtotime('-1 day', strtotime($date));
								$startdate = date("Y-m-d", $startdate);
								

								// print_r($scheduleshiftpattern);exit;

								foreach ($scheduleshiftpattern as $key=>$val){
									$employeenamelist=$this->scheduleemployeeschedule_model->getEmployeeList($val['employee_shift_id']);
									if($i % $weekly <> 0){
										for($a=1; $a<=$cycle; $a++){
											$from = mktime(0,0,0,date("m",strtotime($startdate)),date("d",strtotime($startdate))+$a,date("Y",strtotime($startdate)));
											$from=date("Y-m-d", $from);
											$day=date("D", strtotime($from));
											
											foreach ($employeenamelist as $key2 => $val2) {
											echo"
											<tr>
												<td style='text-align:center'>".$from."</td>
												<td>".$val2['employee_name']."</td>
											";
											}
											
										}
										// print_r("atas");
										// print_r($i);
									}
									else{
										for($a=1; $a<=$cycle; $a++){
											$from = mktime(0,0,0,date("m",strtotime($startdate)),date("d",strtotime($startdate))+$a,date("Y",strtotime($startdate)));
											$from=date("Y-m-d", $from);

											foreach ($employeenamelist as $key2 => $val2) {
											echo"
											<tr>
												<td style='text-align:center'>".$from."</td>
												<td>".$val2['employee_name']."</td>
											";
											}
										}	
										// print_r($from);
										// exit;
										$startdate=mktime(0,0,0,date("m",strtotime($from)),date("d",strtotime($from))+2,date("Y",strtotime($from)));
											$startdate=date("Y-m-d", $startdate);
										// print_r($from);
										// exit;
											// print_r("bawah");
											// print_r($i);
									}

									echo "
										<td style='text-align:center'>".$val['shift_name']."</td>
										<td style='text-align:center'>".$val['start_working_hour']."</td>
									</tr>

									";
									$i=$i+1;
								}
							?>
						</tbody>
					</table>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 " style="text-align  : right !important;">
					<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Save</button>	
				</div>
			</div>
			<label></label>	
		</div>
	</div>
</div>
<?php echo form_close(); ?>
