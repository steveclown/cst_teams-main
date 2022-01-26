<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollleaverequest/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollleaverequest/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollleaverequest/function_state_add');?>",
				data : {'value' : value},
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
								<a href="<?php echo base_url();?>payrollleaverequest">
									Leave Request List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollleaverequest/addPayrollLeaveRequest/<?php echo $hroemployeedata['employee_id']?>">
									Add Leave Request
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Leave Request - <?php echo $hroemployeedata['employee_name']?> -
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
		
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Employee Data
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->payrollleaverequest_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->payrollleaverequest_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->payrollleaverequest_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>payrollleaverequest" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>

							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('payrollleaverequest/processAddPayrollLeaveRequest',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addpayrollleaverequest');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('annual_leave_id', $coreannualleave,set_value('annual_leave_id',$data['annual_leave_id']),'id="annual_leave_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Leave Type</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_date" id="leave_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['leave_request_date']);?>">
												<label class="control-label">Leave Request Date
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
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_start_date" id="leave_request_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['leave_request_start_date']);?>">
												<label class="control-label">Leave Request Start Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_end_date" id="leave_request_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['leave_request_end_date']);?>">
												<label class="control-label">Leave Request End Date
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
												<input type="text" autocomplete="off"  name="leave_request_description" id="leave_request_description" value="<?php echo $data['leave_request_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Description</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="leave_request_duration" id="leave_request_duration" value="<?php echo $data['leave_request_duration']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Duration</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="leave_request_reason" id="leave_request_reason" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['leave_request_reason'];?></textarea>
												<label class="control-label">Reason</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset_session" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
