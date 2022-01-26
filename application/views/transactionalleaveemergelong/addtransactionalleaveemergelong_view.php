<?php 
?>

<script>
function ulang(){
	document.getElementById("employee_id").value = "";
	document.getElementById("leave_emerge_long_date").value = "";
	document.getElementById("leave_emerge_long_start_date").value = "";
	document.getElementById("leave_emerge_long_end_date").value = "";
	document.getElementById("leave_emerge_long_remark").value = "";
	document.getElementById("leave_emerge_long_status").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Leave Emerge Long
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalleaveemergelong" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalleaveemergelong">
							Leave Emerge Long List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Leave Emerge Long
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
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<?php 
										echo form_open('transactionalleaveemergelong/processaddtransactionalleaveemergelong',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('addtransactionalleaveemergelong');
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
											<label class="control-label col-md-3">Status
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php
												$leaveemergelongstatus = array(0=>'Not Fancy',1=>'Fancy');
												echo form_dropdown('leave_emerge_long_status', $leaveemergelongstatus ,set_value('leave_emerge_long_status',$data['leave_emerge_long_status']),'id="leave_emerge_long_status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Date</label>
											<div class="col-md-3">
												<input type="text" autocomplete="off"  name="leave_emerge_long_date" id="leave_emerge_long_date" value="<?php echo $data['leave_emerge_long_date']?>" class="form-control" placeholder="Date">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Start Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="leave_emerge_long_start_date" id="leave_emerge_long_start_date" value="<?php echo tgltoview($data['leave_emerge_long_start_date'])?>" class="form-control" placeholder="Start Date" readonly>
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
													<input type="text" autocomplete="off"  name="leave_emerge_long_end_date" id="leave_emerge_long_end_date" value="<?php echo tgltoview($data['leave_emerge_long_end_date'])?>" class="form-control" placeholder="End Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="leave_emerge_long_remark" id="leave_emerge_long_remark" class="form-control" placeholder="Remark"><?php echo $data['leave_emerge_long_remark'];?></textarea>
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
