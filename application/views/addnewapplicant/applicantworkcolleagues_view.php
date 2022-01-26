<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("applicant_work_colleagues_name").value = "";
	document.getElementById("applicant_work_colleagues_section").value = "";
	document.getElementById("applicant_work_colleagues_relatioship").value = "";
}
</script>
<?php 
	echo form_open('addnewapplicant/arrayaddapplicantworkcolleagues',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addapplicantworkcolleagues');
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
					Add Data Applicant Wizard > Work Colleagues
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
						<a href="#" class='btn default btn-xs yellow'>
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
									<i class="fa fa-reorder"></i>Work Colleagues
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Colleague Name</label>
												
												<input type="text" autocomplete="off"  name="applicant_work_colleagues_name" id="applicant_work_colleagues_name" value="<?php echo $data['applicant_work_colleagues_name'];?>" class="form-control" placeholder="Colleague Name">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Section</label>
											
												<input type="text" autocomplete="off"  name="applicant_work_colleagues_section" id="applicant_work_colleagues_section" value="<?php echo $data['applicant_work_colleagues_section'];?>" class="form-control" placeholder="Section">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Relationship</label>
											
												<input type="text" autocomplete="off"  name="applicant_work_colleagues_relatioship" id="applicant_work_colleagues_relatioship" value="<?php echo $data['applicant_work_colleagues_relatioship'];?>" class="form-control" placeholder="Relationship">
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
<?php $this->load->view('addnewapplicant/arrayapplicantworkcolleagues_view');?>