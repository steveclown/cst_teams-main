<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeefamily/reset_session";
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
								<a href="<?php echo base_url();?>hroemployeefamilydata">
									Employee Family Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">
									Add Employee Family Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Family - <?php echo $hroemployeedata['employee_name']?> -
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
					Employee Data
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->hroemployeefamily_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->hroemployeefamily_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->hroemployeefamily_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>hroemployeefamily" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeefamily/insertArrayAddHROEmployeeFamily',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhroemployeefamily');
									?>
									
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('family_relation_id', $corefamilyrelation ,set_value('family_relation_id', $data['family_relation_id']),'id="family_relation_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Family Relation
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_name" id="employee_family_name" value="<?php echo $data['employee_family_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Family Name
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
												<textarea rows="3" name="employee_family_address" id="employee_family_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_family_address'];?></textarea>
												<label class="control-label">Address</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_city" id="employee_family_city" value="<?php echo $data['employee_family_city']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">City</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_postal_code" id="employee_family_postal_code" value="<?php echo $data['employee_family_postal_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Postal Code</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_rt" id="employee_family_rt" value="<?php echo $data['employee_family_rt']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">RT</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_rw" id="employee_family_rw" value="<?php echo $data['employee_family_rw']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">RW</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_kelurahan" id="employee_family_kelurahan" value="<?php echo $data['employee_family_kelurahan']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Kelurahan</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_kecamatan" id="employee_family_kecamatan" value="<?php echo $data['employee_family_kecamatan']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Kecamatan</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_home_phone" id="employee_family_home_phone" value="<?php echo $data['employee_family_home_phone']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Home Phone</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_mobile_phone" id="employee_family_mobile_phone" value="<?php echo $data['employee_family_mobile_phone']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Mobile Phone</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_family_gender', $gender ,set_value('employee_family_gender',$data['employee_family_gender']),'id="employee_family_gender", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Gender</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Marital Status</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_family_date_of_birth" id="employee_family_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_family_date_of_birth']);?>"/>
												<label class="control-label">Date Of Birth
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_place_of_birth" id="employee_family_place_of_birth" value="<?php echo $data['employee_family_place_of_birth']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >
												<label class="control-label">Place Of Birth</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_education" id="employee_family_education" value="<?php echo $data['employee_family_education']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Education</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_occupation" id="employee_family_occupation" value="<?php echo $data['employee_family_occupation']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Occupation</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_family_has_coverage_claim', $status ,set_value('employee_family_has_coverage_claim',$data['employee_family_has_coverage_claim']),'id="employee_family_has_coverage_claim", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Has Coverage Claim</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_family_coverage_ratio" id="employee_family_coverage_ratio" value="<?php echo $data['employee_family_coverage_ratio']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Coverage Ratio</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="5" name="employee_family_remark" id="employee_family_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['employee_family_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<div class="form-actions right">
									<button type="submit" class="btn green-jungle"><i class="fa fa-plus"></i> Add</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
