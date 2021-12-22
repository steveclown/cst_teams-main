<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
$gender = array(0 => "Female", 1 => "Male");
?>
<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result[status]; ?>";
	document.getElementById("family_status_id").value = "<?php echo $result[family_status_id]; ?>";
	document.getElementById("applicant_id").value = "<?php echo $result[applicant_id]; ?>";
	document.getElementById("applicant_family_name").value = "<?php echo $result[applicant_family_name]; ?>";
	document.getElementById("applicant_family_address").value = "<?php echo $result[applicant_family_address]; ?>";
	document.getElementById("applicant_family_city").value = "<?php echo $result[applicant_family_city]; ?>";
	document.getElementById("applicant_family_zip_code").value = "<?php echo $result[applicant_family_zip_code]; ?>";
	document.getElementById("applicant_family_rt").value = "<?php echo $result[applicant_family_rt]; ?>";
	document.getElementById("applicant_family_rw").value = "<?php echo $result[applicant_family_rw]; ?>";
	document.getElementById("applicant_family_kecamatan").value = "<?php echo $result[applicant_family_kecamatan]; ?>";
	document.getElementById("applicant_family_kelurahan").value = "<?php echo $result[applicant_family_kelurahan]; ?>";
	document.getElementById("applicant_family_home_phone").value = "<?php echo $result[applicant_family_home_phone]; ?>";
	document.getElementById("applicant_family_mobile_phone1").value = "<?php echo $result[applicant_family_mobile_phone1]; ?>";
	document.getElementById("applicant_family_mobile_phone2").value = "<?php echo $result[applicant_family_mobile_phone2]; ?>";
	document.getElementById("applicant_family_gender").value = "<?php echo $result[applicant_family_gender]; ?>";
	document.getElementById("applicant_family_date_of_birth").value = "<?php echo $result[applicant_family_date_of_birth]; ?>";
	document.getElementById("applicant_family_place_of_birth").value = "<?php echo $result[applicant_family_place_of_birth]; ?>";
	document.getElementById("applicant_family_education").value = "<?php echo $result[applicant_family_education]; ?>";
	document.getElementById("applicant_family_occupation").value = "<?php echo $result[applicant_family_occupation]; ?>";
	document.getElementById("marital_status_id").value = "<?php echo $result[marital_status_id]; ?>";
	document.getElementById("applicant_family_remark").value = "<?php echo $result[applicant_family_remark]; ?>";

}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Applicant Family
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalapplicantfamily" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalapplicantfamily">
							Applicant Family List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalapplicantfamily/edit/<?php echo $result['applicant_family_id'];?>">
							Edit Transactional Applicant Family
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
							<div class="portlet-body">
								<div class="form-body">
									<?php 
										echo form_open('transactionalapplicantfamily/processEdittransactionalapplicantfamily',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('status', $status ,set_value('status',$result['status']),'id="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Family Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('family_status_id', $familystatus ,set_value('family_status_id',$result['family_status_id']),'id="family_status_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Applicant Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_id', $applicant ,set_value('applicant_id',$result['applicant_id']),'id="applicant_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Applicant Family Name</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_name" id="applicant_family_name" value="<?php echo $result['applicant_family_name'];?>" class="form-control" placeholder="Applicant Family Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">address</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_address" id="applicant_family_address" value="<?php echo $result['applicant_family_address'];?>" class="form-control" placeholder="address">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">City</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_city" id="applicant_family_city" value="<?php echo $result['applicant_family_city'];?>" class="form-control" placeholder="City">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Zip Code</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_zip_code" id="applicant_family_zip_code" value="<?php echo $result['applicant_family_zip_code'];?>" class="form-control" placeholder="Zip Code">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">RT</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_rt" id="applicant_family_rt" value="<?php echo $result['applicant_family_rt'];?>" class="form-control" placeholder="RT">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">RW</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_rw" id="applicant_family_rw" value="<?php echo $result['applicant_family_rw'];?>" class="form-control" placeholder="RW">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Kecamatan</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_kecamatan" id="applicant_family_kecamatan" value="<?php echo $result['applicant_family_kecamatan'];?>" class="form-control" placeholder="Kecamatan">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Kelurahan</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_kelurahan" id="applicant_family_kelurahan" value="<?php echo $result['applicant_family_kelurahan'];?>" class="form-control" placeholder="Kelurahan">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Home Phone</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_home_phone" id="applicant_family_home_phone" value="<?php echo $result['applicant_family_home_phone'];?>" class="form-control" placeholder="Home Phone">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Mobile Phone 1</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_mobile_phone1" id="applicant_family_mobile_phone1" value="<?php echo $result['applicant_family_mobile_phone1'];?>" class="form-control" placeholder="Mobile Phone 1">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Mobile Phone 2</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_mobile_phone2" id="applicant_family_mobile_phone2" value="<?php echo $result['applicant_family_mobile_phone2'];?>" class="form-control" placeholder="Mobile Phone 2">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Gender</label>
											<div class="col-md-3">
												<?php echo form_dropdown('applicant_family_gender', $gender ,set_value('applicant_family_gender',$result['applicant_family_gender']),'id="applicant_family_gender", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Date Of Birth</label>
											<div class="col-md-8">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" name="applicant_family_date_of_birth" class="form-control" value="<?php echo tgltoview($result['applicant_family_date_of_birth'])?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<span class="help-block">
													 Select date
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Place Of Birth</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_place_of_birth" id="applicant_family_place_of_birth" value="<?php echo $result['applicant_family_place_of_birth'];?>" class="form-control" placeholder="Place Of Birth">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Education</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_education" id="applicant_family_education" value="<?php echo $result['applicant_family_education'];?>" class="form-control" placeholder="Education">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Occupation</label>
											<div class="col-md-8">
												<input type="text" name="applicant_family_occupation" id="applicant_family_occupation" value="<?php echo $result['applicant_family_occupation'];?>" class="form-control" placeholder="Occupation">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Marital Status</label>
											<div class="col-md-3">
												<?php echo form_dropdown('marital_status_id', $maritalstatus ,set_value('marital_status_id',$result['marital_status_id']),'id="marital_status_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="applicant_family_remark" id="applicant_family_remark" class="form-control" placeholder="Family Remark"><?php echo $result['applicant_family_remark'];?></textarea>
											</div>
										</div>
								</div>
								<input type="hidden" name="applicant_family_id" value="<?php echo $result['applicant_family_id']; ?>"/>
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
				
