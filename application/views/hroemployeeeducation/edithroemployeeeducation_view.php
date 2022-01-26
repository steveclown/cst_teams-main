<?php 
$educationtype = array ('0' => 'Formal', '1' => 'Non Formal');
$educationpassed = array ('0' => 'No', '1' => 'Yes');
$educationcertificate = array ('0' => 'No', '1' => 'Yes');
?>
<script>
	function ulang(){
		document.getElementById("education_id").value = "<?php echo $result['education_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("education_type").value = "<?php echo $result['education_type'] ?>";
		document.getElementById("employee_education_name").value = "<?php echo $result['employee_education_name'] ?>";
		document.getElementById("employee_education_city").value = "<?php echo $result['employee_education_city'] ?>";
		document.getElementById("employee_education_from_period").value = "<?php echo $result['employee_education_from_period'] ?>";
		document.getElementById("employee_education_to_period").value = "<?php echo $result['employee_education_to_period'] ?>";
		document.getElementById("employee_education_duration").value = "<?php echo $result['employee_education_duration'] ?>";
		document.getElementById("employee_education_passed").value = "<?php echo $result['employee_education_passed'] ?>";
		document.getElementById("employee_education_certificate").value = "<?php echo $result['employee_education_certificate'] ?>";
		document.getElementById("employee_education_remark").value = "<?php echo $result['employee_education_remark'] ?>";
	}
	
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Education
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeeducation" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeeeducation">
							Employee Education List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeeducation/edit/<?php echo $result['employee_education_id'];?>">
							Edit Employee Education
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
										echo form_open('hroemployeeeducation/processEditHroEmployeeEducation',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$employee_id =  $this->session->userdata('employee_id');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Education Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('education_id', $education ,set_value('education_id',$result['education_id']),'id="education_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Education Type
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('education_type', $educationtype ,set_value('education_type',$result['education_type']),'id="education_type", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeeducation_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Title</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_education_name" id="employee_education_name" value="<?php echo $result['employee_education_name']?>" class="form-control" placeholder="Title">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_education_city" id="employee_education_city" value="<?php echo $result['employee_education_city']?>" class="form-control" placeholder="City">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">From Period</label>
											<div class="col-md-2">
												<input type="text" autocomplete="off"  name="employee_education_from_period" id="employee_education_from_period" value="<?php echo $result['employee_education_from_period']?>" class="form-control" placeholder="From Period">
											</div>
											<label class="col-md-2 control-label">To Period</label>
											<div class="col-md-2">
												<input type="text" autocomplete="off"  name="employee_education_to_period" id="employee_education_to_period" value="<?php echo $result['employee_education_to_period']?>" class="form-control" placeholder="To Period">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Duration</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_education_duration" id="employee_education_duration" value="<?php echo $result['employee_education_duration']?>" class="form-control" placeholder="Duration">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Passed</label>
											<div class="col-md-2">
												<?php echo form_dropdown('employee_education_passed', $educationpassed ,set_value('employee_education_passed',$result['employee_education_passed']),'id="employee_education_passed", class="form-control select2me"');?>
											</div>
											<label class="control-label col-md-2">Certificate</label>
											<div class="col-md-2">
												<?php echo form_dropdown('employee_education_certificate', $educationcertificate ,set_value('employee_education_certificate',$result['employee_education_certificate']),'id="employee_education_certificate", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_education_remark" id="employee_education_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_education_remark'];?></textarea>
											</div>
										</div>
										<input type="hidden" name="employee_education_id" value="<?php echo $result['employee_education_id']; ?>"/>
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
				
