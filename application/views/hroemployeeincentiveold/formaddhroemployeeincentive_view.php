<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeincentive/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeincentive/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeincentive/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id 	= $("#region_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreBranch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id 	= $("#branch_id").val();
 
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });


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
			<a href="<?php echo base_url();?>hroemployeeincentive">
				Employee Incentive List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>hroemployeeincentive/addHROEmployeeIncentive/<?php echo $hroemployeedata['employee_id']?>">
				Add Employee Incentive
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Form Add Employee Incentive - <?php echo $hroemployeedata['employee_name']?> -
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
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id_data" id="division_id_data" value="<?php echo $this->hroemployeeincentive_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id_data" id="department_id_data" value="<?php echo $this->hroemployeeincentive_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id_data" id="section_id_data" value="<?php echo $this->hroemployeeincentive_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeeincentive" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeincentive/processAddHROEmployeeIncentive',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhrolemployeeincentive');
										if ($data['employee_incentive_date']==''){
											$data['employee_incentive_date'] = date('Y-m-d');
										}
										// print_r($hroemployeeincentive_last);
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_incentive_date" id="employee_incentive_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_incentive_date']);?>"/>
												<label class="control-label">Incentive Date
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
												<input type="text" autocomplete="off"  name="region_id_last" id="region_id_last" value="<?php echo $this->hroemployeeincentive_model->getRegionName($hroemployeeincentive_last['region_id'])?>" class="form-control" readonly>
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
												<input type="text" autocomplete="off"  name="branch_id_last" id="branch_id_last" value="<?php echo $this->hroemployeeincentive_model->getBranchName($hroemployeeincentive_last['branch_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Branch </label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="branch_id" id="branch_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
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
												<input type="text" autocomplete="off"  name="location_id_last" id="location_id_last" value="<?php echo $this->hroemployeeincentive_model->getLocationName($hroemployeeincentive_last['location_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Region </label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="location_id" id="location_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
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
												<input type="text" autocomplete="off"  name="division_id_last" id="division_id_last" value="<?php echo $this->hroemployeeincentive_model->getSectionName($hroemployeeincentive_last['division_id'])?>" class="form-control" readonly>
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
												<input type="text" autocomplete="off"  name="department_id_last" id="department_id_last" value="<?php echo $this->hroemployeeincentive_model->getDepartmentName($hroemployeeincentive_last['department_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Department</label>
											</div>
										</div>		

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="department_id" id="department_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
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
												<input type="text" autocomplete="off"  name="section_id_last" id="section_id_last" value="<?php echo $this->hroemployeeincentive_model->getSectionName($hroemployeeincentive_last['section_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Section</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="section_id" id="section_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
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
												<input type="text" autocomplete="off"  name="job_title_id_last" id="job_title_id_last" value="<?php echo $this->hroemployeeincentive_model->getJobTitleName($hroemployeeincentive_last['job_title_id'])?>" class="form-control" readonly>
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
												<input type="text" autocomplete="off"  name="grade_id_last" id="grade_id_last" value="<?php echo $this->hroemployeeincentive_model->getGradeName($hroemployeeincentive_last['grade_id'])?>" class="form-control" readonly>
												<label class="control-label">Last Grade</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('grade_id', $coregrade, $data['grade_id'], 'id ="grade_id_incentive", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
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
												<input type="text" autocomplete="off"  name="class_id_last" id="class_id_last" value="<?php echo $this->hroemployeeincentive_model->getClassName($hroemployeeincentive_last['class_id'])?>" class="form-control" readonly>
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
												<textarea rows="3" name="employee_incentive_remark" id="employee_incentive_remark" class="form-control"><?php echo $data['employee_incentive_remark'];?></textarea>
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
