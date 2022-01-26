<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("annual_leave_id").value = "<?php echo $result['annual_leave_id'] ?>";
		document.getElementById("employee_leave_period").value = "<?php echo $result['employee_leave_period'] ?>";
		document.getElementById("employee_leave_days").value = "<?php echo $result['employee_leave_days'] ?>";
		document.getElementById("employee_leave_taken").value = "<?php echo $result['employee_leave_taken'] ?>";
		document.getElementById("employee_leave_last_balance").value = "<?php echo $result['employee_leave_last_balance'] ?>";
		document.getElementById("employee_leave_remark").value = "<?php echo $result['employee_leave_remark'] ?>";
	}
	
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Leave
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeleave" class="btn green yellow-stripe">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
									 Back
								</span>
							</a>
						</div>
					</li>
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Master
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeleave">
							Employee Leave List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeleave/Edit/<?php $result['employee_leave_id'];?>">
							Edit Employee Leave
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Edit
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										date_default_timezone_set('Asia/Jakarta');
										echo form_open('hroemployeeleave/processEditHroEmployeeLeave',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_id', $employee, $result['employee_id'], 'id ="employee_id", class="form-control", class="select2me"');?>
										</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Annual Leave Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('annual_leave_id', $annualleave, $result['annual_leave_id'], 'id ="annual_leave_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Leave Period</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="employee_leave_period" class="form-control" value="<?php echo tgltoview($result['employee_leave_period'])?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<span class="help-block">
													 Select date
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Leave Days
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_leave_days" id="employee_leave_days" value="<?php echo $result['employee_leave_days']?>" class="form-control" placeholder="Employee Leave Days">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Leave Taken
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_leave_taken" id="employee_leave_taken" value="<?php echo $result['employee_leave_taken']?>" class="form-control" placeholder="Employee Leave Taken">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Leave Last Balance
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_leave_last_balance" id="employee_leave_last_balance" value="<?php echo $result['employee_leave_last_balance']?>" class="form-control" placeholder="Employee Leave Last Balance">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_leave_remark" id="employee_leave_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_leave_remark'];?></textarea>
											</div>
										</div>
										<input type="hidden" name="employee_leave_id" value="<?php echo $result['employee_leave_id']; ?>"/>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				
