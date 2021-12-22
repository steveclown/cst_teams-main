<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeedata/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedata/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedata/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
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
								<a href="#">
									Add Employee Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Data
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

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
											echo form_open('hroemployeedata/processAddHROEmployeeData',array('id' => 'myform', 'class' => 'horizontal-form')); 
											$data = $this->session->userdata('addhroemployeedata');
										?>
				
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
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
														echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me" ');
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
														echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" class="form-control select2me" ');
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
														echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me" ');
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
														echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $data['grade_id']),'id="grade_id" class="form-control select2me" ');
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
														echo form_dropdown('class_id', $coreclass,set_value('class_id',$data['class_id']),'id="class_id" class="form-control select2me" ');
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
													<input type="text" name="employee_code" id="employee_code" value="<?php echo $data['employee_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
													<input type="text" name="employee_name" id="employee_name" value="<?php echo $data['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >

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
													<textarea rows="3" name="employee_address" id="employee_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_address'];?></textarea>
													<label class="control-label">Address</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_city" id="employee_city" value="<?php echo $data['employee_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">City</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_postal_code" id="employee_postal_code" value="<?php echo $data['employee_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Postal Code</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rt" id="employee_rt" value="<?php echo $data['employee_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RT</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rw" id="employee_rw" value="<?php echo $data['employee_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RW</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_kelurahan" id="employee_kelurahan" value="<?php echo $data['employee_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kelurahan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_kecamatan" id="employee_kecamatan" value="<?php echo $data['employee_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kecamatan</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_home_phone" id="employee_home_phone" value="<?php echo $data['employee_home_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Home Phone</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $data['employee_mobile_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Mobile Phone</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $data['employee_email_address'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Email Address</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_gender', $gender, set_value('employee_gender',$data['employee_gender']),'id="employee_gender", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Gender</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_date_of_birth" id="employee_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_date_of_birth']);?>"/>
													<label class="control-label">Date Of Birth
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_place_of_birth" id="employee_place_of_birth" value="<?php echo $data['employee_place_of_birth'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Place Of Birth</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_id_type', $idtype, set_value('employee_id_type',$data['employee_id_type']),'id="employee_id_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">ID Type</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $data['employee_id_number'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">ID Number</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_religion', $religion, set_value('employee_religion',$data['employee_religion']),'id="employee_religion", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Religion</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_blood_type', $bloodtype, set_value('employee_blood_type',$data['employee_blood_type']),'id="employee_blood_type", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Blood Type</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-12">
												<div class="form-group form-md-line-input">
													<textarea rows="3" name="employee_residential_address" id="employee_residential_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_residential_address'];?></textarea>
													<label class="control-label">Residential Address</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_city" id="employee_residential_city" value="<?php echo $data['employee_residential_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential City</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_postal_code" id="employee_residential_postal_code" value="<?php echo $data['employee_residential_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential Postal Code</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rt" id="employee_residential_rt" value="<?php echo $data['employee_residential_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential RT</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rw" id="employee_residential_rw" value="<?php echo $data['employee_residential_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential RW</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kelurahan" id="employee_residential_kelurahan" value="<?php echo $data['employee_residential_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential Kelurahan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kecamatan" id="employee_residential_kecamatan" value="<?php echo $data['employee_residential_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Residential Kecamatan</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Marital Status</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $data['employee_heir_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Heir Name</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$data['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Working Status</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$data['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Overtime Status</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_status', $employeestatus ,set_value('employee_employment_status',$data['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Employment Status</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_hire_date']);?>"/>
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
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_date" id="employee_employment_status_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_employment_status_date']);?>"/>
													<label class="control-label">Employment Status Date
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_employment_status_duedate']);?>"/>
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
													<textarea rows="3" name="employee_remark" id="employee_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_remark'];?></textarea>
													<label class="control-label">Employee Remark</label>
												</div>
											</div>
										</div>

										<div class="form-actions right">
											<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
