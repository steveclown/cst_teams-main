<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("applicant_id").value = "";
	document.getElementById("accident_experience_period").value = "";
	document.getElementById("accident_experience_remark").value = "";
	document.getElementById("accident_experience_consequence").value = "";
}
</script>
<?php 
	echo form_open('transactionalapplicantaccidentexperience/processaddtransactionalapplicantaccidentexperience',array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addtransactionalapplicantaccidentexperience');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Applicant Accident Experience
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantaccidentexperience" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantaccidentexperience">
							Applicant Accident Experience List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantaccidentexperience/add">
							Add Transactional Applicant Accident Experience
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
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
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
											<label class="col-md-3 control-label">Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="accident_experience_period" id="accident_experience_period" value="<?php echo $data['accident_experience_period'];?>" class="form-control" placeholder="Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="accident_experience_remark" id="accident_experience_remark" class="form-control" placeholder="Accident Experience Remark"><?php echo $data['accident_experience_remark'];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Consequence</label>
											<div class="col-md-8">
											<textarea rows="5" name="accident_experience_consequence" id="accident_experience_consequence" class="form-control" placeholder="Accident Experience Consequence"><?php echo $data['accident_experience_consequence'];?></textarea>
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
<?php echo form_close(); ?>