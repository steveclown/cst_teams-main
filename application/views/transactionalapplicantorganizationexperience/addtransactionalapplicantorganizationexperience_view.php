<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
$ExperienceStatus = array(0 => "Not Active", 1 => "Active");
?>
<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("applicant_id").value = "";
	document.getElementById("organization_experience_name").value = "";
	document.getElementById("organization_experience_scope").value = "";
	document.getElementById("organization_experience_period").value = "";
	document.getElementById("organization_experience_title").value = "";
	document.getElementById("organization_experience_status").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Applicant Organization Experience
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantorganizationexperience" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantorganizationexperience">
							Applicant Organization Experience List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Transactional Applicant Organization Experience
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
										echo form_open('transactionalapplicantorganizationexperience/processaddtransactionalapplicantorganizationexperience',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('addtransactionalapplicantorganizationexperience');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('status', $status ,set_value('status',$data['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Applicant Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_id', $applicant ,set_value('applicant_id',$data['applicant_id']),'id="applicant_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Experience Name</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="organization_experience_name" id="organization_experience_name" value="<?php echo $data['organization_experience_name'];?>" class="form-control" placeholder="Experience Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Scope</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="organization_experience_scope" id="organization_experience_scope" value="<?php echo $data['organization_experience_scope'];?>" class="form-control" placeholder="Scope">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="organization_experience_period" id="organization_experience_period" value="<?php echo $data['organization_experience_period'];?>" class="form-control" placeholder="Period">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Title</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="organization_experience_title" id="organization_experience_title" value="<?php echo $data['organization_experience_title'];?>" class="form-control" placeholder="Title">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Experience Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('organization_experience_status', $ExperienceStatus ,set_value('organization_experience_status',$data['organization_experience_status']),'id="organization_experience_status", class="form-control select2me"');?>
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
