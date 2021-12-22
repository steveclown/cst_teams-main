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
								<a href="<?php echo base_url();?>assignmentbusinesstrip">
									Business Trip List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>assignmentbusinesstrip/unApprovedAssignmentBusinessTrip">
									UnApproved Business Trip List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>assignmentbusinesstrip/approvalAssignmentBusinessTrip/<?php echo $assignmentbusinesstrip['business_trip_id']?>">
									Approval Business Trip
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Approval Business Trip
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Approval
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>assignmentbusinesstrip" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_name" id="employee_name" value="<?php echo $assignmentbusinesstrip['employee_name']?>" class="form-control" readonly>
												<label class="control-label">Employee Name</label>
											</div>
										</div>
									
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="division_id_detail" id="division_id_detail" value="<?php echo $assignmentbusinesstrip['division_name']?>" class="form-control" readonly>
												<label class="control-label">Division</label>
											</div>	
										</div>
									</div>
									<div class = "row">
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="department_id_detail" id="department_id_detail" value="<?php echo $assignmentbusinesstrip['department_name']?>" class="form-control" readonly>
												<label class="control-label">Department</label>
											</div>	
										</div>
									
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="section_id_detail" id="section_id_detail" value="<?php echo $assignmentbusinesstrip['section_name']?>" class="form-control" readonly>
												<label class="control-label">Section </label>
											</div>	
										</div>
									</div>
									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="business_trip_date" id="business_trip_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($assignmentbusinesstrip['business_trip_date']);?>" readonly/>
												<label class="control-label">Business Trip Date
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
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="business_trip_start_date" id="business_trip_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($assignmentbusinesstrip['business_trip_start_date']);?>" readonly/>
												<label class="control-label">Business Trip Start Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="business_trip_end_date" id="business_trip_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($assignmentbusinesstrip['business_trip_end_date']);?>" readonly/>
												<label class="control-label">Business Trip End Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="business_trip_purpose" name="business_trip_purpose" onChange="function_elements_add(this.name, this.value);" value="<?php echo $assignmentbusinesstrip['business_trip_purpose'];?>" readonly>
												<label class="control-label">Business Trip Purpose </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="overtime_rate_description" name="overtime_rate_description" onChange="function_elements_add(this.name, this.value);" value="<?php echo $assignmentbusinesstrip['overtime_rate_description'];?>" readonly>
												<label class="control-label">Overtime Rate Description </label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="business_trip_remark" id="business_trip_remark" onChange="function_elements_add(this.name, this.value);" class="form-control" disabled><?php echo $assignmentbusinesstrip['business_trip_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>

									<br>
									<h4>Business Trip Attendance </h4>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-bordered table-advance table-hover">
													<thead>
														<tr>
															<th>No.</th>
															<th>Division Name</th>
															<th>Department Name</th>
															<th>Section Name</th>
															<th>Job Title Name</th>
															<th>Employee Name</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$no = 1;
														if(!empty($assignmentbusinesstripemployee)){
															foreach($assignmentbusinesstripemployee as $key=>$val){
																echo"
																	<tr class='odd gradeX'>
																		<td style='text-align:center'>$no.</td>
																		<td>".$$val['division_name']."</td>
																		<td>".$val['department_name']."</td>
																		<td>".$val['section_name']."</td>
																		<td>".$val['job_title_name']."</td>
																		<td>".$val['employee_name']."</td>
																	</tr>
																";
																$no++;
															}
														}else{
															echo"
																<tr class='odd gradeX'>
																	<td colspan='11' style='text-align:center;'>
																		<b>No Data</b>
																	</td>
																</tr>
															";
														}
													?>		
													<tbody>
												</table>
											</div>
										</div>
									</div>

									<br>
									<h4>Business Trip Cost </h4>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-bordered table-advance table-hover">
													<thead>
														<tr>
															<th>No.</th>
															<th>Job Title Name</th>
															<th>Allowance Name</th>
															<th>Allowance Amount</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$no = 1;
														if(!empty($assignmentbusinesstripallowance)){
															foreach($assignmentbusinesstripallowance as $key=>$val){
																echo"
																	<tr class='odd gradeX'>
																		<td style='text-align:center'>$no.</td>
																		<td>".$val['job_title_name']."</td>
																		<td>".$val['allowance_name']."</td>
																		<td>".nominal($val['business_trip_allowance_amount'])."</td
																	</tr>
																";
																$no++;
															}
														}else{
															echo"
																<tr class='odd gradeX'>
																	<td colspan='11' style='text-align:center;'>
																		<b>No Data</b>
																	</td>
																</tr>
															";
														}
													?>		
													<tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="submit" class="btn red" data-toggle="modal" href="#modalrejectedbusinesstrip"><i class="fa fa-times"></i> Rejected</button>
									<button type="submit" class="btn green-jungle" data-toggle="modal" href="#modalapprovedbusinesstrip"><i class="fa fa-check"></i> Approved</button>
								</div>

								<div class="form-actions right">
									<a class="btn blue" data-toggle="modal" href="#modalapprovedbusinesstrip"><i class="fa fa-pencil"></i> Void</a>
								</div>
							</div>
						</div>
					</div>
				</div>

<!-- BEGIN FORM-->
<?php echo form_open('assignmentbusinesstrip/processApprovedAssignmentBusinessTrip',array('id' => 'myform', 'class' => 'horizontal-form'));?>
<!-- /.modal -->
<script>
	$(document).ready(function(){
        $("#Save").click(function(){
			var approved_remark = $("#approved_remark").val();
			
		  	if(approved_remark!=''){
				return true;
			}else{
				alert('Please insert remark');
				return false;
			}
		});
    });
</script>
<div class="modal fade bs-modal-lg" id="modalapprovedbusinesstrip" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Approved Business Trip</h4>
			</div>
			<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Remark</label>
							<div class="input-icon right">
								<i class="fa"></i>
								<?php echo form_textarea(array('rows'=>'3','name'=>'approved_remark','class'=>'form-control','id'=>'approved_remark','value'=>set_value('approved_remark',$header['approved_remark'])))?>
							</div>	
						</div>	
					</div>
					
					<input type="hidden" class="form-control" name="business_trip_id" id="business_trip_id"  value="<?php echo set_value('business_trip_id',$assignmentbusinesstrip['business_trip_id']);?>"/>
					<input type="hidden" class="form-control" name="approved" id="approved"  value="<?php echo 1;?>"/>
					<div class="modal-footer">
						<button type="button" class="btn red" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button type="submit" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
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

<?php echo form_open('assignmentbusinesstrip/processApprovedAssignmentBusinessTrip',array('id' => 'myform', 'class' => 'horizontal-form'));?>
<div class="modal fade bs-modal-lg" id="modalrejectedbusinesstrip" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Rejected Business Trip</h4>
			</div>
			<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Remark</label>
							<div class="input-icon right">
								<i class="fa"></i>
								<?php echo form_textarea(array('rows'=>'3','name'=>'approved_remark','class'=>'form-control','id'=>'approved_remark','value'=>set_value('approved_remark',$header['approved_remark'])))?>
							</div>	
						</div>	
					</div>
					
					<input type="hidden" class="form-control" name="business_trip_id" id="business_trip_id"  value="<?php echo set_value('business_trip_id',$assignmentbusinesstrip['business_trip_id']);?>"/>
					<input type="hidden" class="form-control" name="approved" id="approved"  value="<?php echo 2;?>"/>
					<div class="modal-footer">
						<button type="button" class="btn red" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<button type="submit" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
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