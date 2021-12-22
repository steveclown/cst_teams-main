<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result[status]; ?>";
	document.getElementById("employee_id").value = "<?php echo $result[employee_id]; ?>";
	document.getElementById("employee_skorsing_date").value = "<?php echo $result[employee_skorsing_value]; ?>";
	document.getElementById("skorsing_status_id").value = "<?php echo $result[skorsing_status_id]; ?>";
	document.getElementById("employee_skorsing_date").value = "<?php echo $result[employee_skorsing_date]; ?>";
	document.getElementById("employee_skorsing_remark").value = "<?php echo $result[employee_skorsing_remark]; ?>";
	document.getElementById("employee_skorsing_status").value = "<?php echo $result[employee_skorsing_status]; ?>";
	document.getElementById("employee_skorsing_status_date").value = "<?php echo $result[employee_skorsing_status_date]; ?>";
	document.getElementById("employee_skorsing_status_remark").value = "<?php echo $result[employee_skorsing_status_remark]; ?>";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Employee Suspend
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalemployeeskorsing" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalemployeeskorsing">
							Employee Suspend List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalemployeeskorsing/edit/<?php echo $result['employee_skorsing_id'];?>">
							Edit Transactional Employee Suspend
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
										echo form_open('transactionalemployeeskorsing/processEdittransactionalemployeeskorsing',array('id' => 'myform', 'class' => 'form-horizontal')); 
	
										$status = array(0 => "Not Fancy", 1 => "Fancy");
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('status', $status ,set_value('status',$result['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>										
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Suspend Status Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('skorsing_status_id', $skorsingstatus ,set_value('skorsing_status_id',$result['skorsing_status_id']),'id="skorsing_status_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Suspend Date</label>
											<div class="col-md-8">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" name="employee_skorsing_date" id="employee_skorsing_date" class="form-control" placeholder="Employee Skorsing Date" value="<?php echo tgltoview($result['employee_skorsing_date']);?>" readonly >
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Salary Percentage</label>
											<div class="col-md-8">
											<input type="text" name="employee_salary_percentage" id="employee_salary_percentage" class="form-control" placeholder="Salary Percentage" value="<?php echo $result['employee_salary_percentage'];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Suspend Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_skorsing_remark" id="employee_skorsing_remark" class="form-control" placeholder="Employee Skorsing Remark"><?php echo $result['employee_skorsing_remark'];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Suspend Status</label>
											<div class="col-md-3">
												<?php 
												$employeeskorsingstatus = array(0 => "Unskorsing", 1 => "Skorsing");
												echo form_dropdown('employee_skorsing_status', $employeeskorsingstatus ,set_value('employee_skorsing_status',$result['employee_skorsing_status']),'id="employee_skorsing_status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Suspend Status Date</label>
											<div class="col-md-8">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" name="employee_skorsing_status_date" id="employee_skorsing_status_date" class="form-control" placeholder="Employee Skorsing Status Date" value="<?php echo $result['employee_skorsing_status_date'];?>" readonly >
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Suspend Status Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_skorsing_status_remark" id="employee_skorsing_status_remark" class="form-control" placeholder="Employee Skorsing Status Remark"><?php echo $result['employee_skorsing_status_remark'];?></textarea>
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
				<input type="hidden" name="employee_skorsing_id" value="<?php echo $result['employee_skorsing_id']; ?>"/>
