<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
$ResignLetter = array(0 => "No", 1 => "Yes");
?>
<script>
function ulang(){
	document.getElementById("working_experience_remark").value = "<?php echo $result[working_experience_remark]; ?>";
	document.getElementById("status").value = "<?php echo $result[status]; ?>";
	document.getElementById("applicant_id").value = "<?php echo $result[applicant_id]; ?>";
	document.getElementById("company_name").value = "<?php echo $result[company_name]; ?>";
	document.getElementById("company_address").value = "<?php echo $result[company_address]; ?>";
	document.getElementById("working_experience_job_title").value = "<?php echo $result[working_experience_job_title]; ?>";
	document.getElementById("working_experience_from_period").value = "<?php echo $result[working_experience_from_period]; ?>";
	document.getElementById("working_experience_to_period").value = "<?php echo $result[working_experience_to_period]; ?>";
	document.getElementById("working_experience_last_salary").value = "<?php echo $result[working_experience_last_salary]; ?>";
	document.getElementById("working_experience_resign_reason").value = "<?php echo $result[working_experience_resign_reason]; ?>";
	document.getElementById("working_experience_resign_letter").value = "<?php echo $result[working_experience_resign_letter]; ?>";
	document.getElementById("applicant_working_experience_id").value = "<?php echo $result[applicant_working_experience_id]; ?>";
}
</script>
<?php 
	echo form_open('transactionalapplicantworkingexperience/processEdittransactionalapplicantworkingexperience',array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Applicant Working Experience
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantworkingexperience" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantworkingexperience">
							Applicant Working Experience List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantworkingexperience/edit/<?php echo $result['applicant_working_experience_id'];?>">
							Edit Transactional Applicant Working Experience
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
											<label class="control-label col-md-3">Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('status', $status ,set_value('status',$result['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Applicant Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_id', $applicant ,set_value('applicant_id',$result['applicant_id']),'id="applicant_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Company Name</label>
											<div class="col-md-8">
												<input type="text" name="company_name" id="company_name" value="<?php echo $result['company_name'];?>" class="form-control" placeholder="Company Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Company Address</label>
											<div class="col-md-8">
											<textarea rows="5" name="company_address" id="company_address" class="form-control" placeholder="Working Experience Remark"><?php echo $result['company_address'];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Job Title</label>
											<div class="col-md-8">
												<input type="text" name="working_experience_job_title" id="working_experience_job_title" value="<?php echo $result['working_experience_job_title'];?>" class="form-control" placeholder="Job Title">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">From Period</label>
											<div class="col-md-8">
												<input type="text" name="working_experience_from_period" id="working_experience_from_period" value="<?php echo $result['working_experience_from_period'];?>" class="form-control" placeholder="From Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">To Period</label>
											<div class="col-md-8">
												<input type="text" name="working_experience_to_period" id="working_experience_to_period" value="<?php echo $result['working_experience_to_period'];?>" class="form-control" placeholder="To Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Last Salary</label>
											<div class="col-md-8">
												<input type="text" name="working_experience_last_salary" id="working_experience_last_salary" value="<?php echo $result['working_experience_last_salary'];?>" class="form-control" placeholder="Last Salary">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Resign Reason</label>
											<div class="col-md-8">
											<textarea rows="5" name="working_experience_resign_reason" id="working_experience_resign_reason" class="form-control" placeholder="Resign Reason"><?php echo $result['working_experience_resign_reason'];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Resign Letter</label>
											<div class="col-md-3">
												<?php echo form_dropdown('working_experience_resign_letter', $ResignLetter ,set_value('working_experience_resign_letter',$result['working_experience_resign_letter']),'id="working_experience_resign_letter", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="working_experience_remark" id="working_experience_remark" class="form-control" placeholder="Working Experience Remark"><?php echo $result['working_experience_remark'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="applicant_working_experience_id" value="<?php echo $result['applicant_working_experience_id']; ?>"/>
<?php echo form_close(); ?>