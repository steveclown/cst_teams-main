<?php 
?>
<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("blank_long_leave_total").value = "<?php echo $result['blank_long_leave_total'] ?>";
		document.getElementById("blank_long_leave_date").value = "<?php echo $result['blank_long_leave_date'] ?>";
		document.getElementById("blank_long_leave_remark").value = "<?php echo $result['blank_long_leave_remark'] ?>";
	}
	
</script>
<?php 
	echo form_open('trblanklongleave/processEdittrblanklongleave',array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Blank Long Leave
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>trblanklongleave" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>trblanklongleave">
							Blank Long Leave List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>trblanklongleave/edit/<?php echo $result['blank_long_leave_id'];?>">
							Edit Blank Long Leave
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
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
									<div class="row">
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Total</label>
											<div class="col-md-8">
												<input type="text" name="blank_long_leave_total" id="blank_long_leave_total" value="<?php echo $result['blank_long_leave_total']?>" class="form-control" placeholder="Total">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Date</label>
											<div class="col-md-8">
												<input type="text" name="blank_long_leave_date" id="blank_long_leave_date" value="<?php echo $result['blank_long_leave_date']?>" class="form-control" placeholder="Date">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="blank_long_leave_remark" id="blank_long_leave_remark" class="form-control" placeholder="Remark"><?php echo $result['blank_long_leave_remark'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="blank_long_leave_id" value="<?php echo $result['blank_long_leave_id']; ?>"/>
<?php echo form_close(); ?>