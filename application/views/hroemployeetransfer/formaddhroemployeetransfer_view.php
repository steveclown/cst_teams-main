<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeetransfer/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeetransfer/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeetransfer/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeetransfer">
									Employee Transfer List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeetransfer/addHROEmployeeTransfer/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Transfer
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Transfer - <?php echo $hroemployeedata['employee_name']?> -
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
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->hroemployeetransfer_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->hroemployeetransfer_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->hroemployeetransfer_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeetransfer" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeetransfer/processAddHROEmployeeTransfer',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhrolemployeetransfer');
										if ($data['employee_transfer_date']==''){
											$data['employee_transfer_date'] = date('Y-m-d');
										}
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_transfer_date" id="employee_transfer_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_transfer_date']);?>"/>
												<label class="control-label">Transfer Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="region_id_last" id="region_id_last" value="<?php echo $this->hroemployeetransfer_model->getRegionName($hroemployeetransfer_last['region_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Region </label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('region_id', $coreregion, $data['region_id'], 'id ="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Region
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="branch_id_last" id="branch_id_last" value="<?php echo $this->hroemployeetransfer_model->getBranchName($hroemployeetransfer_last['branch_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Branch </label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('branch_id', $corebranch, $data['branch_id'], 'id ="branch_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Branch
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="location_id_last" id="location_id_last" value="<?php echo $this->hroemployeetransfer_model->getLocationName($hroemployeetransfer_last['location_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Region </label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('location_id', $corelocation, $data['location_id'], 'id ="location_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Location
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="division_id_last" id="division_id_last" value="<?php echo $this->hroemployeetransfer_model->getSectionName($hroemployeetransfer_last['division_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Division</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('division_id', $coredivision, $data['division_id'], 'id ="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Division
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="department_id_last" id="department_id_last" value="<?php echo $this->hroemployeetransfer_model->getDepartmentName($hroemployeetransfer_last['department_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Department</label>
											</div>
										</div>		

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('department_id', $coredepartment, $data['department_id'], 'id ="department_id", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Department
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="section_id_last" id="section_id_last" value="<?php echo $this->hroemployeetransfer_model->getSectionName($hroemployeetransfer_last['section_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Section</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('section_id', $coresection, $data['section_id'], 'id ="section_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Section
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="job_title_id_last" id="job_title_id_last" value="<?php echo $this->hroemployeetransfer_model->getJobTitleName($hroemployeetransfer_last['job_title_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Job Title</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('job_title_id', $corejobtitle, $data['job_title_id'], 'id ="job_title_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Job Title
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="grade_id_last" id="grade_id_last" value="<?php echo $this->hroemployeetransfer_model->getGradeName($hroemployeetransfer_last['grade_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Grade</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('grade_id', $coregrade, $data['grade_id'], 'id ="grade_id", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Grade
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="class_id_last" id="class_id_last" value="<?php echo $this->hroemployeetransfer_model->getClassName($hroemployeetransfer_last['class_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Class</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('class_id', $coreclass, $data['class_id'], 'id ="class_id", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
												<label class="col-md-3 control-label">Class
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
												<textarea rows="3" name="employee_transfer_remark" id="employee_transfer_remark" class="form-control"><?php echo $data['employee_transfer_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
