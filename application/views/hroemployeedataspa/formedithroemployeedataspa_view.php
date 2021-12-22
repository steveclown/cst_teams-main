<script>
function ulang(){
	document.getElementById("employee_id").value = "<?php echo $hroemployeedata['employee_id'] ?>";
	document.getElementById("employee_code").value = "<?php echo $hroemployeedata['employee_code'] ?>";
	document.getElementById("employee_absence_id").value = "<?php echo $hroemployeedata['employee_absence_id'] ?>";
	document.getElementById("region_id").value = "<?php echo $hroemployeedata['region_id'] ?>";
	document.getElementById("branch_id").value = "<?php echo $hroemployeedata['branch_id'] ?>";
	document.getElementById("division_id").value = "<?php echo $hroemployeedata['division_id'] ?>";
	document.getElementById("department_id").value = "<?php echo $hroemployeedata['department_id'] ?>";
	document.getElementById("section_id").value = "<?php echo $hroemployeedata['section_id'] ?>";
	document.getElementById("job_title_id").value = "<?php echo $hroemployeedata['job_title_id'] ?>";
	document.getElementById("grade_id").value = "<?php echo $hroemployeedata['grade_id'] ?>";
	document.getElementById("class_id").value = "<?php echo $hroemployeedata['class_id'] ?>";
	document.getElementById("location_id").value = "<?php echo $hroemployeedata['location_id'] ?>";
	document.getElementById("employee_name").value = "<?php echo $hroemployeedata['employee_name'] ?>";
	document.getElementById("employee_nick_name").value = "<?php echo $hroemployeedata['employee_nick_name'] ?>";
	document.getElementById("employee_address").value = "<?php echo $hroemployeedata['employee_address'] ?>";
	document.getElementById("employee_city").value = "<?php echo $hroemployeedata['employee_city'] ?>";
	document.getElementById("employee_zip_code").value = "<?php echo $hroemployeedata['employee_zip_code'] ?>";
	document.getElementById("employee_rt").value = "<?php echo $hroemployeedata['employee_rt'] ?>";
	document.getElementById("employee_rw").value = "<?php echo $hroemployeedata['employee_rw'] ?>";
	document.getElementById("employee_kecamatan").value = "<?php echo $hroemployeedata['employee_kecamatan'] ?>";
	document.getElementById("employee_kelurahan").value = "<?php echo $hroemployeedata['employee_kelurahan'] ?>";
	document.getElementById("employee_home_phone").value = "<?php echo $hroemployeedata['employee_home_phone'] ?>";
	document.getElementById("employee_mobile_phone").value = "<?php echo $hroemployeedata['employee_mobile_phone'] ?>";
	document.getElementById("employee_email_address").value = "<?php echo $hroemployeedata['employee_email_address'] ?>";
	document.getElementById("employee_gender").value = "<?php echo $hroemployeedata['employee_gender'] ?>";
	document.getElementById("date_of_birth").value = "<?php echo $hroemployeedata['date_of_birth'] ?>";
	document.getElementById("place_of_birth").value = "<?php echo $hroemployeedata['place_of_birth'] ?>";
	document.getElementById("employee_religion").value = "<?php echo $hroemployeedata['employee_religion'] ?>";
	document.getElementById("employee_id_number").value = "<?php echo $hroemployeedata['employee_id_number'] ?>";
	document.getElementById("employee_residence_address").value = "<?php echo $hroemployeedata['employee_residence_address'] ?>";
	document.getElementById("employee_residence_city").value = "<?php echo $hroemployeedata['employee_residence_city'] ?>";
	document.getElementById("employee_residence_zip_code").value = "<?php echo $hroemployeedata['employee_residence_zip_code'] ?>";
	document.getElementById("employee_residence_rt").value = "<?php echo $hroemployeedata['employee_residence_rt'] ?>";
	document.getElementById("employee_residence_rw").value = "<?php echo $hroemployeedata['employee_residence_rw'] ?>";
	document.getElementById("employee_residence_kecamatan").value = "<?php echo $hroemployeedata['employee_residence_kecamatan'] ?>";
	document.getElementById("employee_residence_kelurahan").value = "<?php echo $hroemployeedata['employee_residence_kelurahan'] ?>";
	document.getElementById("employee_bank_name").value = "<?php echo $hroemployeedata['employee_bank_name'] ?>";
	document.getElementById("employee_bank_acct_no").value = "<?php echo $hroemployeedata['employee_bank_acct_no'] ?>";
	document.getElementById("employee_bank_acct_name").value = "<?php echo $hroemployeedata['employee_bank_acct_name'] ?>";
	document.getElementById("marital_status_id").value = "<?php echo $hroemployeedata['marital_status_id'] ?>";
	document.getElementById("number_of_children").value = "<?php echo $hroemployeedata['number_of_children'] ?>";
	document.getElementById("employee_heir_name").value = "<?php echo $hroemployeedata['employee_heir_name'] ?>";
	document.getElementById("employee_heir_occupation").value = "<?php echo $hroemployeedata['employee_heir_occupation'] ?>";
	document.getElementById("employee_blood_type").value = "<?php echo $hroemployeedata['employee_blood_type'] ?>";
	document.getElementById("employee_driving_licenseA").value = "<?php echo $hroemployeedata['employee_driving_licenseA'] ?>";
	document.getElementById("employee_driving_licenseB").value = "<?php echo $hroemployeedata['employee_driving_licenseB'] ?>";
	document.getElementById("employee_driving_licenseB1").value = "<?php echo $hroemployeedata['employee_driving_licenseB1'] ?>";
	document.getElementById("employee_picture").value = "";
	document.getElementById("employee_probation_date").value = "<?php echo $hroemployeedata['employee_probation_date'] ?>";
	document.getElementById("employee_probation_remark").value = "<?php echo $hroemployeedata['employee_probation_remark'] ?>";
	document.getElementById("employee_effective_date").value = "<?php echo $hroemployeedata['employee_effective_date'] ?>";
	document.getElementById("employee_effective_remark").value = "<?php echo $hroemployeedata['employee_effective_remark'] ?>";
	document.getElementById("employee_status").value = "<?php echo $hroemployeedata['employee_status'] ?>";
	document.getElementById("employee_working_status").value = "<?php echo $hroemployeedata['employee_working_status'] ?>";
	document.getElementById("employee_overtime_status").value = "<?php echo $hroemployeedata['employee_overtime_status'] ?>";
	document.getElementById("has_leave_permission").value = "<?php echo $hroemployeedata['has_leave_permission'] ?>";
	document.getElementById("annual_leave_days").value = "<?php echo $hroemployeedata['annual_leave_days'] ?>";
	document.getElementById("extra_leave_days").value = "<?php echo $hroemployeedata['extra_leave_days'] ?>";
	document.getElementById("leave_due_date").value = "<?php echo $hroemployeedata['leave_due_date'] ?>";
	document.getElementById("vacation_days_balance").value = "<?php echo $hroemployeedata['vacation_days_balance'] ?>";
	document.getElementById("employee_remark").value = "<?php echo $hroemployeedata['employee_remark'] ?>";
}
</script>


					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeedata">
									Employee Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeedata/editHROEmployeeData/<?php echo $hroemployeedata['employee_id']; ?>">
									Edit Employee Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<h1 class="page-title">
						Form Edit Employee Data
					</h1>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										Form Add
									</div>
									
									<div class = "actions">
										<div class="actions">
											<a href="<?php echo base_url();?>hroemployeedata" class="btn btn-default btn-sm">
											<i class="fa fa-angle-left"></i> Back</a>
										</div>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="form-body">
										<?php 
											echo form_open('hroemployeedata/processEditHROEmployeeData',array('id' => 'myform', 'class' => 'horizontal-form')); 
											/*$hroemployeedata = $this->session->userdata('addhroemployeedata');*/
											print_r("HRO Employee Data ".$hroemployeedata);
										?>
				
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('division_id', $coredivision,set_value('division_id',$hroemployeedata['division_id']),'id="division_id" class="form-control select2me" ');
													?>
													<label class="control-label">Division Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('department_id', $coredepartment, set_value('department_id', $hroemployeedata['department_id']),'id="department_id" class="form-control select2me" ');
													?>

													<label class="control-label">Department Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('section_id', $coresection,set_value('section_id',$hroemployeedata['section_id']),'id="section_id" class="form-control select2me" ');
													?>
													<label class="control-label">Section Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$hroemployeedata['job_title_id']),'id="job_title_id" class="form-control select2me" ');
													?>
													<label class="control-label">Job Title Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $hroemployeedata['grade_id']),'id="grade_id" class="form-control select2me" ');
													?>

													<label class="control-label">Grade Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('class_id', $coreclass,set_value('class_id',$hroemployeedata['class_id']),'id="class_id" class="form-control select2me" ');
													?>
													<label class="control-label">Class Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_code" id="employee_code" value="<?php echo $hroemployeedata['employee_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Employee Code
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >

													<label class="control-label">Employee Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-12">
												<div class="form-group form-md-line-input">
													<textarea rows="3" name="employee_address" id="employee_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $hroemployeedata['employee_address'];?></textarea>
													<label class="control-label">Address</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_city" id="employee_city" value="<?php echo $hroemployeedata['employee_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">City</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_postal_code" id="employee_postal_code" value="<?php echo $hroemployeedata['employee_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Postal Code</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rt" id="employee_rt" value="<?php echo $hroemployeedata['employee_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RT</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rw" id="employee_rw" value="<?php echo $hroemployeedata['employee_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RW</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_kelurahan" id="employee_kelurahan" value="<?php echo $hroemployeedata['employee_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kelurahan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_kecamatan" id="employee_kecamatan" value="<?php echo $hroemployeedata['employee_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kecamatan</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_home_phone" id="employee_home_phone" value="<?php echo $hroemployeedata['employee_home_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Home Phone</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $hroemployeedata['employee_mobile_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Mobile Phone</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $hroemployeedata['employee_email_address'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Email Address</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_gender', $gender, set_value('employee_gender',$hroemployeedata['employee_gender']),'id="employee_gender", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Gender</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" hroemployeedata-date-format="dd-mm-yyyy" type="text" name="employee_date_of_birth" id="employee_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_date_of_birth']);?>"/>
													<label class="control-label">Date Of Birth
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_place_of_birth" id="employee_place_of_birth" value="<?php echo $hroemployeedata['employee_place_of_birth'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Place Of Birth</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_id_type', $idtype, set_value('employee_id_type',$hroemployeedata['employee_id_type']),'id="employee_id_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">ID Type</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $hroemployeedata['employee_id_number'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">ID Number</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_religion', $religion, set_value('employee_religion',$hroemployeedata['employee_religion']),'id="employee_religion", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Religion</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_blood_type', $bloodtype, set_value('employee_blood_type',$hroemployeedata['employee_blood_type']),'id="employee_blood_type", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Blood Type</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-12">
												<div class="form-group form-md-line-input">
													<textarea rows="3" name="employee_residential_address" id="employee_residential_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $hroemployeedata['employee_residential_address'];?></textarea>
													<label class="control-label">Residential Address</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_city" id="employee_residential_city" value="<?php echo $hroemployeedata['employee_residential_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential City</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_postal_code" id="employee_residential_postal_code" value="<?php echo $hroemployeedata['employee_residential_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential Postal Code</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rt" id="employee_residential_rt" value="<?php echo $hroemployeedata['employee_residential_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential RT</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rw" id="employee_residential_rw" value="<?php echo $hroemployeedata['employee_residential_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential RW</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kelurahan" id="employee_residential_kelurahan" value="<?php echo $hroemployeedata['employee_residential_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential Kelurahan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kecamatan" id="employee_residential_kecamatan" value="<?php echo $hroemployeedata['employee_residential_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential Kecamatan</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$hroemployeedata['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Marital Status</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $hroemployeedata['employee_heir_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Heir Name</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$hroemployeedata['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Working Status</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$hroemployeedata['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Overtime Status</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_status', $employeestatus ,set_value('employee_employment_status',$hroemployeedata['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Employment Status</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_hire_date']);?>"/>
													<label class="control-label">Hire Date
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_date" id="employee_employment_status_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_employment_status_date']);?>"/>
													<label class="control-label">Employment Status Date
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_employment_status_duedate']);?>"/>
													<label class="control-label">Employement Status Due Date
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-12">
												<div class="form-group form-md-line-input">
													<textarea rows="3" name="employee_remark" id="employee_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $hroemployeedata['employee_remark'];?></textarea>
													<label class="control-label">Employee Remark</label>
												</div>
											</div>
										</div>



										<div class="form-actions right">
											<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
										</div>
										<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
