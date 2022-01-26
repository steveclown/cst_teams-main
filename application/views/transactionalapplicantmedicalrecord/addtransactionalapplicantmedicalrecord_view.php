<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("applicant_id").value = "";
	document.getElementById("family_status_id").value = "";
	document.getElementById("applicant_medical_disease").value = "";
	document.getElementById("applicant_medical_name").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Applicant Medical Record
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantmedicalrecord" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantmedicalrecord">
							Applicant Medical Record List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Transactional Applicant Medical Record
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
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body">
							<?php 
								echo form_open('transactionalapplicantmedicalrecord/processaddtransactionalapplicantmedicalrecord',array('id' => 'myform', 'class' => 'form-horizontal')); 
								$data = $this->session->userdata('addtransactionalapplicantmedicalrecord');
							?>
								<div class="form-body">
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
											<label class="control-label col-md-3">Family Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('family_status_id', $familystatus ,set_value('family_status_id',$data['family_status_id']),'id="family_status_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Medical Disease</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_medical_disease" id="applicant_medical_disease" value="<?php echo $data['applicant_medical_disease'];?>" class="form-control" placeholder="Medical Disease">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Medical Name</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_medical_name" id="applicant_medical_name" value="<?php echo $data['applicant_medical_name'];?>" class="form-control" placeholder="Medical Name">
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
