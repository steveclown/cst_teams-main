<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("applicant_id").value = "";
	document.getElementById("applicant_law_experience_period").value = "";
	document.getElementById("applicant_law_location").value = "";
	document.getElementById("applicant_law_remark").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Applicant Law Experience
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantlawexperience" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantlawexperience">
							Applicant Law Experience List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantlawexperience/add">
							Add Transactional Applicant Law Experience
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
										echo form_open('transactionalapplicantlawexperience/processaddtransactionalapplicantlawexperience',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('addtransactionalapplicantlawexperience');
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
											<label class="col-md-3 control-label">Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_law_experience_period" id="applicant_law_experience_period" value="<?php echo $data['applicant_law_experience_period'];?>" class="form-control" placeholder="Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Location</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="applicant_law_location" id="applicant_law_location" value="<?php echo $data['applicant_law_location'];?>" class="form-control" placeholder="Location">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="applicant_law_remark" id="applicant_law_remark" class="form-control" placeholder="Law Experience Remark"><?php echo $data['applicant_law_remark'];?></textarea>
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
