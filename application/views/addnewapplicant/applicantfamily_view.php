<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
$gender = array(0 => "Female", 1 => "Male");
?>
<script>
function ulang(){
	// document.getElementById("status").value = "";
	document.getElementById("family_status_id").value = "";
	// document.getElementById("applicant_id").value = "";
	document.getElementById("applicant_family_name").value = "";
	document.getElementById("applicant_family_address").value = "";
	document.getElementById("applicant_family_city").value = "";
	document.getElementById("applicant_family_zip_code").value = "";
	document.getElementById("applicant_family_rt").value = "";
	document.getElementById("applicant_family_rw").value = "";
	document.getElementById("applicant_family_kecamatan").value = "";
	document.getElementById("applicant_family_kelurahan").value = "";
	document.getElementById("applicant_family_home_phone").value = "";
	document.getElementById("applicant_family_mobile_phone1").value = "";
	document.getElementById("applicant_family_mobile_phone2").value = "";
	document.getElementById("applicant_family_gender").value = "";
	document.getElementById("applicant_family_date_of_birth").value = "";
	document.getElementById("applicant_family_place_of_birth").value = "";
	document.getElementById("applicant_family_education").value = "";
	document.getElementById("applicant_family_occupation").value = "";
	document.getElementById("marital_status_id").value = "";
	document.getElementById("applicant_family_remark").value = "";
}
</script>
<?php 
	echo form_open('addnewapplicant/arrayaddapplicantfamily',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addapplicantfamily');
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
					Add Data Applicant Wizard > Family
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
						<a  href="#" class='btn default btn-xs yellow'>
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
									<i class="fa fa-reorder"></i>Family
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									
										<!--
										<div class="form-group">
											<label class="control-label">Status</label>
											<div class="col-md-3">
												<?php // echo form_dropdown('status', $status ,set_value('status',$data['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Applicant Name</label>
											<div class="col-md-3">
												<?php // echo form_dropdown('applicant_id', $applicant ,set_value('applicant_id',$data['applicant_id']),'id="applicant_id", class="form-control select2me"');?>
											</div>
										</div>
										-->
										
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Applicant Family Name</label>
											
												<input type="text" name="applicant_family_name" id="applicant_family_name" value="<?php echo $data['applicant_family_name'];?>" class="form-control" placeholder="Applicant Family Name">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Family Status</label>
											
												<?php echo form_dropdown('family_status_id', $familystatus ,set_value('family_status_id',$data['family_status_id']),'id="family_status_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Address</label>
											
												<textarea rows="3" name="applicant_family_address" id="applicant_family_address" class="form-control" placeholder="Address"><?php echo $data['applicant_family_address'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">City</label>
											
												<input type="text" name="applicant_family_city" id="applicant_family_city" value="<?php echo $data['applicant_family_city'];?>" class="form-control" placeholder="City">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Zip Code</label>
											
												<input type="text" name="applicant_family_zip_code" id="applicant_family_zip_code" value="<?php echo $data['applicant_family_zip_code'];?>" class="form-control" placeholder="Zip Code">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">RT</label>
											
												<input type="text" name="applicant_family_rt" id="applicant_family_rt" value="<?php echo $data['applicant_family_rt'];?>" class="form-control" placeholder="RT">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">RW</label>
											
												<input type="text" name="applicant_family_rw" id="applicant_family_rw" value="<?php echo $data['applicant_family_rw'];?>" class="form-control" placeholder="RW">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Kecamatan</label>
											
												<input type="text" name="applicant_family_kecamatan" id="applicant_family_kecamatan" value="<?php echo $data['applicant_family_kecamatan'];?>" class="form-control" placeholder="Kecamatan">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Kelurahan</label>
											
												<input type="text" name="applicant_family_kelurahan" id="applicant_family_kelurahan" value="<?php echo $data['applicant_family_kelurahan'];?>" class="form-control" placeholder="Kelurahan">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Home Phone</label>
											
												<input type="text" name="applicant_family_home_phone" id="applicant_family_home_phone" value="<?php echo $data['applicant_family_home_phone'];?>" class="form-control" placeholder="Home Phone">
											</div>
										</div>
										
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile Phone 1</label>
											
												<input type="text" name="applicant_family_mobile_phone1" id="applicant_family_mobile_phone1" value="<?php echo $data['applicant_family_mobile_phone1'];?>" class="form-control" placeholder="Mobile Phone 1">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Mobile Phone 2</label>
											
												<input type="text" name="applicant_family_mobile_phone2" id="applicant_family_mobile_phone2" value="<?php echo $data['applicant_family_mobile_phone2'];?>" class="form-control" placeholder="Mobile Phone 2">
											</div>
										</div>
										
										<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Gender</label>
											
												<?php echo form_dropdown('applicant_family_gender', $gender ,set_value('applicant_family_gender',$data['applicant_family_gender']),'id="applicant_family_gender", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Date Of Birth</label>
											
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("Y-m-d");?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
													<input type="text" name="applicant_family_date_of_birth" class="form-control" value="<?php echo $data['applicant_family_date_of_birth']?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<span class="help-block">
													 Select date
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Place Of Birth</label>
											
												<input type="text" name="applicant_family_place_of_birth" id="applicant_family_place_of_birth" value="<?php echo $data['applicant_family_place_of_birth'];?>" class="form-control" placeholder="Place Of Birth">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Education</label>
											
												<input type="text" name="applicant_family_education" id="applicant_family_education" value="<?php echo $data['applicant_family_education'];?>" class="form-control" placeholder="Education">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Occupation</label>
											
												<input type="text" name="applicant_family_occupation" id="applicant_family_occupation" value="<?php echo $data['applicant_family_occupation'];?>" class="form-control" placeholder="Occupation">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Marital Status</label>
											
												<?php echo form_dropdown('marital_status_id', $maritalstatus ,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Applicant Family Remark</label>
												
												<textarea rows="3" name="applicant_family_remark" id="applicant_family_remark" class="form-control" placeholder="Family Remark"><?php echo $data['applicant_family_remark'];?></textarea>
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
<?php $this->load->view('addnewapplicant/arrayapplicantfamily_view');?>