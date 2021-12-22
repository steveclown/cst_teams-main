<?php
$status = array(0=>"Fancy", 1=>"Not Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("employee_id").value = "";
	document.getElementById("shift_id").value = "";
	document.getElementById("schedule_shift_start_date").value = "";
	document.getElementById("schedule_shift_end_date").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Schedule Shift
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalscheduleshift" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalscheduleshift">
							Schedule Shift List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Transactional Schedule Shift
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
										echo form_open('transactionalscheduleshift/processaddtransactionalscheduleshift',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('addtransactionalscheduleshift');
	
										if($data['schedule_shift_start_date']==''){
											$data['schedule_shift_start_date'] = date('Y-m-d');
										}
										if($data['schedule_shift_end_date']==''){
											$data['schedule_shift_end_date'] = date('Y-m-d');
										}
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Status
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('status', $status, $data['status'], 'id ="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_id', $employee, $data['employee_id'], 'id ="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-3">Start Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd--mm-yyyy" data-date-viewmode="years">
													<input type="text" class="form-control" name="schedule_shift_start_date" value="<?php echo tgltoview($data['schedule_shift_start_date']);?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-3">End Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" class="form-control" name="schedule_shift_end_date" value="<?php echo tgltoview($data['schedule_shift_end_date']);?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Shift Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('shift_id', $shift, $data['shift_id'], 'id ="shift_id", class="form-control select2me"');?>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
