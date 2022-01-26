<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("accident_experience_period").value = "";
	document.getElementById("accident_experience_remark").value = "";
	document.getElementById("accident_experience_consequence").value = "";
}
</script>
<?php 
	echo form_open('addnewapplicant/arrayaddapplicantaccidentexperience',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addapplicantaccidentexperience');
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
					Add Data Applicant Wizard > Accident Experience
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
						<a href="#" class='btn default btn-xs yellow'>
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
									<i class="fa fa-reorder"></i>Accident Experience
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								
									<!--
										<div class="form-group">
											<label class="control-label col-md-3">Status</label>
											<div class="col-md-3">
												<?php //echo form_dropdown('status', $status ,set_value('status',$data['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Applicant Name</label>
											<div class="col-md-3">
												<?php //echo form_dropdown('applicant_id', $applicant ,set_value('applicant_id',$data['applicant_id']),'id="applicant_id", class="form-control select2me"');?>
											</div>
										</div>
									-->
										<div class = "row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-3 control-label">Period</label>
												
													<input type="text" autocomplete="off"  name="accident_experience_period" id="accident_experience_period" value="<?php echo $data['accident_experience_period'];?>" class="form-control" placeholder="Period">
													<span class="help-block">
														 Please input only numbers.
													</span>
												</div>
											</div>
										</div>
										
										<div class = "row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Accident Experience Remark</label>
													
													<textarea rows="3" name="accident_experience_remark" id="accident_experience_remark" class="form-control" placeholder="Accident Experience Remark"><?php echo $data['accident_experience_remark'];?></textarea>
												</div>
											</div>
										
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Consequence</label>
													
													<textarea rows="3" name="accident_experience_consequence" id="accident_experience_consequence" class="form-control" placeholder="Accident Experience Consequence"><?php echo $data['accident_experience_consequence'];?></textarea>
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
<?php $this->load->view('addnewapplicant/arrayapplicantaccidentexperience_view');?>