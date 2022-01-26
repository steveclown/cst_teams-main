<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("status_alteration_date").value = "<?php echo $result['status_alteration_date'] ?>";
		document.getElementById("employee_status_id").value = "<?php echo $result['employee_status_id'] ?>";
		document.getElementById("status_alteration_due_date").value = "<?php echo $result['status_alteration_due_date'] ?>";
		document.getElementById("status_alteration_remark").value = "<?php echo $result['status_alteration_remark'] ?>";
		
	}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Status Alteration
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalstatusalterationbyemployee" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalstatusalterationbyemployee">
							Status Alteration List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalstatusalterationbyemployee/edit/<?php echo $result['status_alteration_id'];?>">
							Edit Status Alteration
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
										echo form_open('transactionalstatusalterationbyemployee/processEdittransactionalstatusalterationbyemployee',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
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
											<label class="col-md-3 control-label">Status Alteration Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="status_alteration_date" id="status_alteration_date" value="<?php echo tgltoview($result['status_alteration_date'])?>" class="form-control" placeholder="Status Alteration Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<!--
										<div class="form-group">
											<label class="control-label col-md-3">Employee Status Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('employee_status_id', $employeestatus ,set_value('employee_status_id',$result['employee_status_id']),'id="employee_status_id", class="form-control select2me"');?>
											</div>
										</div>
										-->
										<div class="form-group">
											<label class="col-md-3 control-label">Status Alteration Due Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="status_alteration_due_date" id="status_alteration_due_date" value="<?php echo tgltoview($result['status_alteration_due_date'])?>" class="form-control" placeholder="Status Alteration Due Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="status_alteration_remark" id="status_alteration_remark" class="form-control" placeholder="Remark"><?php echo $result['status_alteration_remark'];?></textarea>
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
				<input type="hidden" name="status_alteration_id" value="<?php echo $result['status_alteration_id']; ?>"/>
