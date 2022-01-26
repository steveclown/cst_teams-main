<?php 
$expertisepassed = array ('0' => 'No', '1' => 'Yes');
$expertisecertificate = array ('0' => 'No', '1' => 'Yes');
?>
<script>
	function ulang(){
		document.getElementById("expertise_id").value = "<?php echo $result['expertise_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_expertise_name").value = "<?php echo $result['employee_expertise_name'] ?>";
		document.getElementById("employee_expertise_city").value = "<?php echo $result['employee_expertise_city'] ?>";
		document.getElementById("employee_expertise_from_period").value = "<?php echo $result['employee_expertise_from_period'] ?>";
		document.getElementById("employee_expertise_to_period").value = "<?php echo $result['employee_expertise_to_period'] ?>";
		document.getElementById("employee_expertise_duration").value = "<?php echo $result['employee_expertise_duration'] ?>";
		document.getElementById("employee_expertise_passed").value = "<?php echo $result['employee_expertise_passed'] ?>";
		document.getElementById("employee_expertise_certificate").value = "<?php echo $result['employee_expertise_certificate'] ?>";
		document.getElementById("employee_expertise_remark").value = "<?php echo $result['employee_expertise_remark'] ?>";
	}
	
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Expertise
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeexpertise" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeeexpertise">
							Employee Expertise List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeexpertise/edit/<?php echo $result['employee_expertise_id'];?>">
							Edit Employee Expertise
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
										echo form_open('hroemployeeexpertise/processEditHroEmployeeExpertise',array('id' => 'myform', 'class' => 'form-horizontal'));
										$employee_id =  $this->session->userdata('employee_id');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Expertise Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('expertise_id', $expertise ,set_value('expertise_id',$result['expertise_id']),'id="expertise_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeexpertise_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Title</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_expertise_name" id="employee_expertise_name" value="<?php echo $result['employee_expertise_name']?>" class="form-control" placeholder="Title">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_expertise_city" id="employee_expertise_city" value="<?php echo $result['employee_expertise_city']?>" class="form-control" placeholder="City">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">From Period</label>
											<div class="col-md-2">
												<input type="text" autocomplete="off"  name="employee_expertise_from_period" id="employee_expertise_from_period" value="<?php echo $result['employee_expertise_from_period']?>" class="form-control" placeholder="From Period">
											</div>
											<label class="col-md-2 control-label">To Period</label>
											<div class="col-md-2">
												<input type="text" autocomplete="off"  name="employee_expertise_to_period" id="employee_expertise_to_period" value="<?php echo $result['employee_expertise_to_period']?>" class="form-control" placeholder="To Period">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Duration</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_expertise_duration" id="employee_expertise_duration" value="<?php echo $result['employee_expertise_duration']?>" class="form-control" placeholder="Duration">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Passed</label>
											<div class="col-md-2">
												<?php echo form_dropdown('employee_expertise_passed', $expertisepassed ,set_value('employee_expertise_passed',$result['employee_expertise_passed']),'id="employee_expertise_passed", class="form-control select2me"');?>
											</div>
											<label class="control-label col-md-2">Certificate</label>
											<div class="col-md-2">
												<?php echo form_dropdown('employee_expertise_certificate', $expertisecertificate ,set_value('employee_expertise_certificate',$result['employee_expertise_certificate']),'id="employee_expertise_certificate", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_expertise_remark" id="employee_expertise_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_expertise_remark'];?></textarea>
											</div>
										</div>
										<input type="hidden" name="employee_expertise_id" value="<?php echo $result['employee_expertise_id']; ?>"/>
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
				
