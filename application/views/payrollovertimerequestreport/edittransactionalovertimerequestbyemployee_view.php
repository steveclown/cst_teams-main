<?php 
?>
<script>
	function ulang(){
		document.getElementById("branch_id").value = "<?php echo $result['branch_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("overtime_type_id").value = "<?php echo $result['overtime_type_id'] ?>";
		document.getElementById("overtime_request_start_date").value = "<?php echo $result['overtime_request_start_date'] ?>";
		document.getElementById("overtime_request_end_date").value = "<?php echo $result['overtime_request_end_date'] ?>";
		document.getElementById("overtime_request_total").value = "<?php echo $result['overtime_request_total'] ?>";
		document.getElementById("overtime_request_remark").value = "<?php echo $result['overtime_request_remark'] ?>";
	}
	
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Overtime Request
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalovertimerequestbyemployee" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalovertimerequestbyemployee">
							Overtime Request List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalovertimerequestbyemployee/edit/<?php echo $result['overtime_request_id'];?>">
							Edit Overtime Request
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
										echo form_open('transactionalovertimerequestbyemployee/processEdittransactionalovertimerequestbyemployee',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Branch Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('branch_id', $branch ,set_value('branch_id',$result['branch_id']),'id="branch_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Overtime Type</label>
											<div class="col-md-3">
												<?php echo form_dropdown('overtime_type_id', $overtimetype ,set_value('overtime_type_id',$result['overtime_type_id']),'id="overtime_type_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Start Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" name="overtime_request_start_date" id="overtime_request_start_date" value="<?php echo tgltoview($result['overtime_request_start_date'])?>" class="form-control" placeholder="Start Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<input type="text" name="overtime_request_start_hours" id="overtime_request_start_hours" value="<?php echo $result['overtime_request_start_hours']?>" class="form-control timepicker timepicker-24">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">End Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" name="overtime_request_end_date" id="overtime_request_end_date" value="<?php echo tgltoview($result['overtime_request_end_date'])?>" class="form-control" placeholder="End Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<input type="text" name="overtime_request_end_hours" id="overtime_request_end_hours" value="<?php echo $result['overtime_request_end_hours']?>" class="form-control timepicker timepicker-24">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Total</label>
											<div class="col-md-8">
													<input type="text" name="overtime_request_total" id="overtime_request_total" value="<?php echo $result['overtime_request_total']?>" class="form-control" placeholder="Total">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="overtime_request_remark" id="overtime_request_remark" class="form-control" placeholder="Remark"><?php echo $result['overtime_request_remark'];?></textarea>
											</div>
										</div>
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
				<input type="hidden" name="overtime_request_id" value="<?php echo $result['overtime_request_id']; ?>"/>
