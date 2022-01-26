<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
$ExperienceStatus = array(0 => "Not Active", 1 => "Active");
?>
<script>
function ulang(){
	document.getElementById("organization_experience_name").value = "";
	document.getElementById("organization_experience_scope").value = "";
	document.getElementById("organization_experience_period").value = "";
	document.getElementById("organization_experience_title").value = "";
	document.getElementById("organization_experience_status").value = "";
}
</script>
<?php 
	echo form_open('addnewapplicant/arrayaddapplicantorganizationexperience',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addapplicantorganizationexperience');
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
					Add Data Applicant Wizard > Organization Experience
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
						<a href="#" class='btn default btn-xs yellow'>
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
									<i class="fa fa-reorder"></i>Organization Experience
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Experience Name</label>
											
												<input type="text" autocomplete="off"  name="organization_experience_name" id="organization_experience_name" value="<?php echo $data['organization_experience_name'];?>" class="form-control" placeholder="Experience Name">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Scope</label>
											
												<input type="text" autocomplete="off"  name="organization_experience_scope" id="organization_experience_scope" value="<?php echo $data['organization_experience_scope'];?>" class="form-control" placeholder="Scope">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Period</label>
											
												<input type="text" autocomplete="off"  name="organization_experience_period" id="organization_experience_period" value="<?php echo $data['organization_experience_period'];?>" class="form-control" placeholder="Period">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Title</label>
											
												<input type="text" autocomplete="off"  name="organization_experience_title" id="organization_experience_title" value="<?php echo $data['organization_experience_title'];?>" class="form-control" placeholder="Title">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Experience Status</label>
											
												<?php echo form_dropdown('organization_experience_status', $ExperienceStatus ,set_value('organization_experience_status',$data['organization_experience_status']),'id="organization_experience_status", class="form-control select2me"');?>
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
<?php $this->load->view('addnewapplicant/arrayapplicantorganizationexperience_view');?>