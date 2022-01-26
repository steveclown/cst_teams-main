<?php 
?>
<script>
	function ulang(){
		document.getElementById("branch_id").value = "<?php echo $result['branch_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("annual_leave_id").value = "<?php echo $result['annual_leave_id'] ?>";
		document.getElementById("leave_request_start_date").value = "<?php echo $result['leave_request_start_date'] ?>";
		document.getElementById("leave_request_end_date").value = "<?php echo $result['leave_request_end_date'] ?>";
		document.getElementById("leave_request_reason").value = "<?php echo $result['leave_request_reason'] ?>";
		document.getElementById("leave_request_status").value = "<?php echo $result['leave_request_status'] ?>";
	}
	
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Leave Request
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalleaverequestbyemployee" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalleaverequestbyemployee">
							Leave Request List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalleaverequestbyemployee/edit/<?php echo $result['leave_request_id'];?>">
							Edit Leave Request
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
										echo form_open('transactionalleaverequestbyemployee/processEdittransactionalleaverequestbyemployee',array('id' => 'myform', 'class' => 'form-horizontal')); 
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
											<label class="col-md-3 control-label">Annual Leave Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('annual_leave_id', $annualleave ,set_value('annual_leave_id',$result['annual_leave_id']),'id="annual_leave_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Start Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="leave_request_start_date" id="leave_request_start_date" value="<?php echo tgltoview($result['leave_request_start_date'])?>" class="form-control" placeholder="Start Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">End Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="leave_request_end_date" id="leave_request_end_date" value="<?php echo tgltoview($result['leave_request_end_date'])?>" class="form-control" placeholder="End Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Reason</label>
											<div class="col-md-8">
											<textarea rows="5" name="leave_request_reason" id="leave_request_reason" class="form-control" placeholder="Reason"><?php echo $result['leave_request_reason'];?></textarea>
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
				<input type="hidden" name="leave_request_id" value="<?php echo $result['leave_request_id']; ?>"/>
