<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result[status]; ?>";
	document.getElementById("applicant_id").value = "<?php echo $result[applicant_id]; ?>";
	document.getElementById("applicant_strength_remark").value = "<?php echo $result[applicant_strength_remark]; ?>";
	document.getElementById("applicant_weakness_remark").value = "<?php echo $result[applicant_weakness_remark]; ?>";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Applicant Personality
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantpersonality" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantpersonality">
							Applicant Personality List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantpersonality/edit/<?php echo $result['applicant_personality_id'];?>">
							Edit Transactional Applicant Personality
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
									<i class="fa fa-reorder"></i>Form Edit
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('transactionalapplicantpersonality/processEdittransactionalapplicantpersonality',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
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
											<label class="col-md-3 control-label">Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="accident_experience_period" id="accident_experience_period" value="<?php echo $result['accident_experience_period'];?>" class="form-control" placeholder="Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Strength Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="applicant_strength_remark" id="applicant_strength_remark" class="form-control" placeholder="Strength Remark"><?php echo $result['applicant_strength_remark'];?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Weakness Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="applicant_weakness_remark" id="applicant_weakness_remark" class="form-control" placeholder="Weakness Remark"><?php echo $result['applicant_weakness_remark'];?></textarea>
											</div>
										</div>
								</div>
								<input type="hidden" name="applicant_personality_id" value="<?php echo $result['applicant_personality_id']; ?>"/>
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
				
