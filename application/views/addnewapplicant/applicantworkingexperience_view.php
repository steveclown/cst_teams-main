<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
$ResignLetter = array(0 => "No", 1 => "Yes");
?>
<script>
function ulang(){
	document.getElementById("working_experience_remark").value = "";
	// document.getElementById("status").value = "";
	// document.getElementById("applicant_id").value = "";
	document.getElementById("company_name").value = "";
	document.getElementById("company_address").value = "";
	document.getElementById("working_experience_job_title").value = "";
	document.getElementById("working_experience_from_period").value = "";
	document.getElementById("working_experience_to_period").value = "";
	document.getElementById("working_experience_last_salary").value = "";
	document.getElementById("working_experience_resign_reason").value = "";
	document.getElementById("working_experience_resign_letter").value = "";
	document.getElementById("applicant_working_experience_id").value = "";
}
</script>
<?php 
	echo form_open('addnewapplicant/arrayaddapplicantworkingexperience',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addapplicantworkingexperience');
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
					Add Data Applicant Wizard > Working Experience
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantdata">
							Personal
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicanteducation">
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
						<a href="#" class='btn default btn-xs yellow'>
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
						<a href="<?php echo base_url();?>addnewapplicant/applicantworkcolleagues">
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
									<i class="fa fa-reorder"></i>Working Experience
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
									<div class="row">
										<div class="col-md-6">	
											<div class="form-group">
												<label class="col-md-3 control-label">Company Name</label>
											
												<input type="text" name="company_name" id="company_name" value="<?php echo $data['company_name'];?>" class="form-control" placeholder="Company Name">
											</div>
										</div>
									</div>
									
									<div class = "row">
										
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label">Company Address</label>
												
												<textarea rows="3" name="company_address" id="company_address" class="form-control" placeholder="Working Experience Remark"><?php echo $data['company_address'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Job Title</label>
											
												<input type="text" name="working_experience_job_title" id="working_experience_job_title" value="<?php echo $data['working_experience_job_title'];?>" class="form-control" placeholder="Job Title">
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">From Period</label>
											
												<input type="text" name="working_experience_from_period" id="working_experience_from_period" value="<?php echo $data['working_experience_from_period'];?>" class="form-control" placeholder="From Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">To Period</label>
											
												<input type="text" name="working_experience_to_period" id="working_experience_to_period" value="<?php echo $data['working_experience_to_period'];?>" class="form-control" placeholder="To Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Last Salary</label>
											
												<input type="text" name="working_experience_last_salary" id="working_experience_last_salary" value="<?php echo $data['working_experience_last_salary'];?>" class="form-control" placeholder="Last Salary">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Resign Letter</label>
											
												<?php echo form_dropdown('working_experience_resign_letter', $ResignLetter ,set_value('working_experience_resign_letter',$data['working_experience_resign_letter']),'id="working_experience_resign_letter", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Resign Reason</label>
												
												<textarea rows="3" name="working_experience_resign_reason" id="working_experience_resign_reason" class="form-control" placeholder="Resign Reason"><?php echo $data['working_experience_resign_reason'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Remark</label>
											
											<textarea rows="3" name="working_experience_remark" id="working_experience_remark" class="form-control" placeholder="Working Experience Remark"><?php echo $data['working_experience_remark'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn blue"></i><i class="fa fa-plus"></i> Add</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="created_by" value="<?php echo $auth['username'];?>">
				<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
<?php echo form_close(); ?>
<?php $this->load->view('addnewapplicant/arrayapplicantworkingexperience_view');?>