<?php
$EducationType = array(0 => "Non Formal", 1 => "Formal");
$EducationPassed = array(0 => "No", 1 => "Yes");
$EducationCertificate = array(0 => "No", 1 => "Yes");
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result[status]; ?>";
	document.getElementById("education_status_id").value = "<?php echo $result[education_status_id]; ?>";
	document.getElementById("applicant_id").value = "<?php echo $result[applicant_id]; ?>";
	document.getElementById("applicant_education_name").value = "<?php echo $result[applicant_education_name]; ?>";
	document.getElementById("applicant_education_address").value = "<?php echo $result[applicant_education_address]; ?>";
	document.getElementById("applicant_education_city").value = "<?php echo $result[applicant_education_city]; ?>";
	document.getElementById("applicant_education_zip_code").value = "<?php echo $result[applicant_education_zip_code]; ?>";
	document.getElementById("applicant_education_rt").value = "<?php echo $result[applicant_education_rt]; ?>";
	document.getElementById("applicant_education_rw").value = "<?php echo $result[applicant_education_rw]; ?>";
	document.getElementById("applicant_education_kecamatan").value = "<?php echo $result[applicant_education_kecamatan]; ?>";
	document.getElementById("applicant_education_kelurahan").value = "<?php echo $result[applicant_education_kelurahan]; ?>";
	document.getElementById("applicant_education_home_phone").value = "<?php echo $result[applicant_education_home_phone]; ?>";
	document.getElementById("applicant_education_mobile_phone1").value = "<?php echo $result[applicant_education_mobile_phone1]; ?>";
	document.getElementById("applicant_education_mobile_phone2").value = "<?php echo $result[applicant_education_mobile_phone2]; ?>";
	document.getElementById("applicant_education_gender").value = "<?php echo $result[applicant_education_gender]; ?>";
	document.getElementById("applicant_education_date_of_birth").value = "<?php echo $result[applicant_education_date_of_birth]; ?>";
	document.getElementById("applicant_education_place_of_birth").value = "<?php echo $result[applicant_education_place_of_birth]; ?>";
	document.getElementById("applicant_education_education").value = "<?php echo $result[applicant_education_education]; ?>";
	document.getElementById("applicant_education_occupation").value = "<?php echo $result[applicant_education_occupation]; ?>";
	document.getElementById("marital_status_id").value = "<?php echo $result[marital_status_id]; ?>";
	document.getElementById("applicant_education_remark").value = "<?php echo $result[applicant_education_remark]; ?>";

}
</script>
<?php 
	echo form_open('transactionalapplicanteducation/processEdittransactionalapplicanteducation',array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Applicant Education
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
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Master
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicanteducation">
							Applicant Education List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicanteducation/edit/<?php echo $result['applicant_education_id'];?>">
							Edit Transactional Applicant Education
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
											<label class="control-label col-md-3">Education Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('education_id', $education ,set_value('education_id',$result['education_id']),'id="education_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Education Type</label>
											<div class="col-md-3">
												<?php echo form_dropdown('education_type', $EducationType ,set_value('education_type',$result['education_type']),'id="education_type", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Applicant Education Name</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_education_name" id="applicant_education_name" value="<?php echo $result['applicant_education_name'];?>" class="form-control" placeholder="Applicant Education Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_education_city" id="applicant_education_city" value="<?php echo $result['applicant_education_city'];?>" class="form-control" placeholder="City">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">From Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_education_from_period" id="applicant_education_from_period" value="<?php echo $result['applicant_education_from_period'];?>" class="form-control" placeholder="From Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">To Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_education_to_period" id="applicant_education_to_period" value="<?php echo $result['applicant_education_to_period'];?>" class="form-control" placeholder="To Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Duration</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_education_duration" id="applicant_education_duration" value="<?php echo $result['applicant_education_duration'];?>" class="form-control" placeholder="Duration">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Education Passed</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_education_passed', $EducationPassed ,set_value('applicant_education_passed',$result['applicant_education_passed']),'id="applicant_education_passed", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Education Certificate</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_education_certificate', $EducationCertificate ,set_value('applicant_education_certificate',$result['applicant_education_certificate']),'id="applicant_education_certificate", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="applicant_education_remark" id="applicant_education_remark" class="form-control" placeholder="Education Remark"><?php echo $result['applicant_education_remark'];?></textarea>
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
				<input type="hidden" name="applicant_education_id" value="<?php echo $result['applicant_education_id']; ?>"/>
<?php echo form_close(); ?>