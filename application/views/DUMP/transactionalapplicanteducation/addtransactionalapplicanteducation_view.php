<?php
$EducationType = array(0=>"Formal", 1=>"Non Formal");
$EducationPassed = array(0 => "No", 1 => "Yes");
$EducationCertificate = array(0 => "No", 1 => "Yes");
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	// document.getElementById("status").value = "";
	// document.getElementById("applicant_id").value = "";
	document.getElementById("education_id").value = "";
	document.getElementById("education_type").value = "";
	document.getElementById("applicant_education_name").value = "";
	document.getElementById("applicant_education_city").value = "";
	document.getElementById("applicant_education_from_period").value = "";
	document.getElementById("applicant_education_to_period").value = "";
	document.getElementById("applicant_education_duration").value = "";
	document.getElementById("applicant_education_passed").value = "";
	document.getElementById("applicant_education_certificate").value = "";
	document.getElementById("applicant_education_remark").value = "";
}
</script>
<?php 
	echo form_open('transactionalapplicanteducation/arrayaddtransactionalapplicanteducation',array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addtransactionalapplicanteducation');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Add Data Applicant Wizard > Education
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicanteducation" class="btn green yellow-stripe">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
									 Back
								</span>
							</a>
						</div>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantdata">
							Personal
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#" class='btn default btn-xs yellow'>
							Education
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantfamily">
							Family
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantaccidentexperience">
							Accident
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantworkingexperience">
							Working
						</a>
						<i class="fa fa-angle-right"></i>
					</li>					
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantinterviewexperience">
							Interview
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantlawexperience">
							Law
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantorganizationexperience">
							Organization
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantmedicalrecord">
							Medical Record
						</a>
						<i class="fa fa-angle-right"></i>
					</li>					
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantpersonalityrecord">
							Personality
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantsubjects">
							Subjects
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantcolleagues">
							Colleagues
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantcolleagues">
							Confirm
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
									<i class="fa fa-reorder"></i>Education
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<!--
										<div class="form-group">
											<label class="control-label col-md-3">Status</label>
											<div class="col-md-3">
												<?php // echo form_dropdown('status', $status ,set_value('status',$data['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Applicant Name</label>
											<div class="col-md-3">
												<?php // echo form_dropdown('applicant_id', $applicant ,set_value('applicant_id',$data['applicant_id']),'id="applicant_id", class="form-control select2me"');?>
											</div>
										</div>
										-->
										<div class="form-group">
											<label class="control-label col-md-3">Education</label>
											<div class="col-md-3">
												<?php echo form_dropdown('education_id', $education ,set_value('education_id',$data['education_id']),'id="education_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Type</label>
											<div class="col-md-3">
												<?php echo form_dropdown('education_type', $EducationType ,set_value('education_type',$data['education_type']),'id="education_type", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Name</label>
											<div class="col-md-8">
												<input type="text" name="applicant_education_name" id="applicant_education_name" value="<?php echo $data['applicant_education_name'];?>" class="form-control" placeholder="Applicant Education Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City</label>
											<div class="col-md-8">
												<input type="text" name="applicant_education_city" id="applicant_education_city" value="<?php echo $data['applicant_education_city'];?>" class="form-control" placeholder="City">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">From Period</label>
											<div class="col-md-8">
												<input type="text" name="applicant_education_from_period" id="applicant_education_from_period" value="<?php echo $data['applicant_education_from_period'];?>" class="form-control" placeholder="From Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">To Period</label>
											<div class="col-md-8">
												<input type="text" name="applicant_education_to_period" id="applicant_education_to_period" value="<?php echo $data['applicant_education_to_period'];?>" class="form-control" placeholder="To Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Duration</label>
											<div class="col-md-8">
												<input type="text" name="applicant_education_duration" id="applicant_education_duration" value="<?php echo $data['applicant_education_duration'];?>" class="form-control" placeholder="Duration">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Education Passed</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_education_passed', $EducationPassed ,set_value('applicant_education_passed',$data['applicant_educa']),'id="applicant_education_passed", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Education Certificate</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_education_certificate', $EducationCertificate ,set_value('applicant_education_certificate',$data['applicant_education_certificate']),'id="applicant_education_certificate", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="applicant_education_remark" id="applicant_education_remark" class="form-control" placeholder="Education Remark"><?php echo $data['applicant_education_remark'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"></i><i class="fa fa-plus"></i> Add</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="created_on" value="<?php echo date("Y-m-d");?>">
<?php echo form_close(); ?>
<?php $this->load->view('transactionalapplicanteducation/arraytransactionalapplicanteducation_view');?>