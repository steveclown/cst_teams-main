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
	echo form_open('addnewapplicant/arrayaddapplicanteducation',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('applicanteducation');
	$auth = $this->session->userdata('auth');
	$sesi 	= $this->session->userdata('unique');
	if($sesi['unique']==''){
		$this->session->set_userdata('unique',array('unique'=>get_unique()));
	}
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Add Data Applicant Wizard > Education
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantdata">
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
						<a href="<?php echo base_url();?>addnewapplicant/applicantfamily">
							Family
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantaccidentexperience">
							Accident
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantworkingexperience">
							Working
						</a>
						<i class="fa fa-angle-right"></i>
					</li>					
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantinterviewexperience">
							Interview
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantlawexperience">
							Law
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantorganizationexperience">
							Organization
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantmedicalrecord">
							Medical Record
						</a>
						<i class="fa fa-angle-right"></i>
					</li>					
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantpersonality">
							Personality
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantsubjects">
							Subjects
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantcolleagues">
							Colleagues
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/confirm">
							Confirm
						</a>
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
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Education</label>
											
												<?php echo form_dropdown('education_id', $education ,set_value('education_id',$data['education_id']),'id="education_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Type</label>
											
												<?php echo form_dropdown('education_type', $EducationType ,set_value('education_type',$data['education_type']),'id="education_type", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Name</label>
											
												<input type="text" name="applicant_education_name" id="applicant_education_name" value="<?php echo $data['applicant_education_name'];?>" class="form-control" placeholder="Applicant Education Name">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">City</label>
											
												<input type="text" name="applicant_education_city" id="applicant_education_city" value="<?php echo $data['applicant_education_city'];?>" class="form-control" placeholder="City">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">From Period</label>
											
												<input type="text" name="applicant_education_from_period" id="applicant_education_from_period" value="<?php echo $data['applicant_education_from_period'];?>" class="form-control" placeholder="From Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">To Period</label>
											
												<input type="text" name="applicant_education_to_period" id="applicant_education_to_period" value="<?php echo $data['applicant_education_to_period'];?>" class="form-control" placeholder="To Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Duration</label>
											
												<input type="text" name="applicant_education_duration" id="applicant_education_duration" value="<?php echo $data['applicant_education_duration'];?>" class="form-control" placeholder="Duration">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Education Passed</label>
											
												<?php echo form_dropdown('applicant_education_passed', $EducationPassed ,set_value('applicant_education_passed',$data['applicant_educa']),'id="applicant_education_passed", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Education Certificate</label>
											
												<?php echo form_dropdown('applicant_education_certificate', $EducationCertificate ,set_value('applicant_education_certificate',$data['applicant_education_certificate']),'id="applicant_education_certificate", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label">Education Remark</label>
											
											<textarea rows="3" name="applicant_education_remark" id="applicant_education_remark" class="form-control" placeholder="Education Remark"><?php echo $data['applicant_education_remark'];?></textarea>
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
				<input type="hidden" name="created_by" value="<?php echo $auth['username'];?>">
				<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
<?php echo form_close(); ?>
<?php $this->load->view('addnewapplicant/arrayapplicanteducation_view');?>