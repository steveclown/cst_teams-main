<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeleave/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeleave/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeleave/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

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
								<a href="<?php echo base_url();?>hroemployeeeducation">
									Employee Education List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeeducation/AddHROEmployeeEducation/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Education
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Education - <?php echo $hroemployeedata['employee_name'];?> -
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			

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
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->hroemployeeeducation_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->hroemployeeeducation_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->hroemployeeeducation_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeeeducation" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>

							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeeducation/processAddHROEmployeeEducation',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddHroEmployeeEducation');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('education_id', $coreeducation ,set_value('education_id',$data['education_id']),'id="education_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>

												<label class="control-label">Education Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_education_type', $educationtype ,set_value('employee_education_type',$data['employee_education_type']),'id="employee_education_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Education Type
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
												<input type="text" autocomplete="off"  name="employee_education_name" id="employee_education_name" value="<?php echo $data['employee_education_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Education Name</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_education_city" id="employee_education_city" value="<?php echo $data['employee_education_city']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">City</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('education_month_from', $monthlist,set_value('education_month_from',$data['education_month_from']),'id="education_month_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>From Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('education_year_from', $year,set_value('education_year_from',$data['education_year_from']),'id="education_year_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('education_month_to', $monthlist,set_value('education_month_to',$data['education_month_to']),'id="education_month_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>To Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('education_year_to', $year,set_value('education_year_to',$data['education_year_to']),'id="education_year_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_education_duration" id="employee_education_duration" value="<?php echo $data['employee_education_duration']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Duration</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_education_passed', $status ,set_value('employee_education_passed',$data['employee_education_passed']),'id="employee_education_passed", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Passed</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_education_certificate', $status ,set_value('employee_education_certificate',$data['employee_education_certificate']),'id="employee_education_certificate", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Certificate</label>
											</div>
										</div>
									</div>

									<div class = "row">	
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="employee_education_remark" id="employee_education_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['employee_education_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
