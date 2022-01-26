<?php 
?>
<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("leave_paid_long_date").value = "<?php echo $result['leave_paid_long_date'] ?>";
		document.getElementById("leave_paid_long_start_date").value = "<?php echo $result['leave_paid_long_start_date'] ?>";
		document.getElementById("leave_paid_long_end_date").value = "<?php echo $result['leave_paid_long_end_date'] ?>";
		document.getElementById("leave_paid_long_remark").value = "<?php echo $result['leave_paid_long_remark'] ?>";
		document.getElementById("leave_paid_long_status").value = "<?php echo $result['leave_paid_long_status'] ?>";
	}
	
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Leave Paid Long
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalleavepaidlong" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalleavepaidlong">
							Leave Paid Long List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalleavepaidlong/edit/<?php echo $result['overtime_request_id'];?>">
							Edit Leave Paid Long
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
							<div class="portlet-body">
								<div class="form-body">
									<?php 
										echo form_open('transactionalleavepaidlong/processEdittransactionalleavepaidlong',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$data['employee_id']),'id="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Annual Leave Balance</label>
											<div class="col-md-3">
												<input type="text" autocomplete="off"  name="annual_leave_balance" id="annual_leave_balance" value="<?php echo $data['annual_leave_balance']?>" class="form-control" placeholder="Annual Leave Balance">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Total</label>
											<div class="col-md-3">
												<input type="text" autocomplete="off"  name="leave_paid_long_total" id="leave_paid_long_total" value="<?php echo $data['leave_paid_long_total']?>" class="form-control" placeholder="Total">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="leave_paid_long_date" id="leave_paid_long_date" value="<?php echo tgltoview($data['leave_paid_long_date'])?>" class="form-control" placeholder="Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="leave_paid_long_remark" id="leave_paid_long_remark" class="form-control" placeholder="Remark"><?php echo $data['leave_paid_long_remark'];?></textarea>
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
				<input type="hidden" name="leave_paid_long_id" value="<?php echo $result['leave_paid_long_id']; ?>"/>
