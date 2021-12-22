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
								<a href="<?php echo base_url();?>hroemployeeexpertise">
									Employee Expertise List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeexpertise/AddHROEmployeeExpertise/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Expertise
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Expertise - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->hroemployeeexpertise_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->hroemployeeexpertise_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->hroemployeeexpertise_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeeexpertise" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>

							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeexpertise/processAddHROEmployeeExpertise',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddHroEmployeeExpertise');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('expertise_id', $coreexpertise ,set_value('expertise_id',$data['expertise_id']),'id="expertise_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>

												<label class="control-label">Expertise Name
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
												<input type="text" name="employee_expertise_name" id="employee_expertise_name" value="<?php echo $data['employee_expertise_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Expertise Name</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_expertise_city" id="employee_expertise_city" value="<?php echo $data['employee_expertise_city']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">City</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('expertise_month_from', $monthlist,set_value('expertise_month_from',$data['expertise_month_from']),'id="expertise_month_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>From Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('expertise_year_from', $year,set_value('expertise_year_from',$data['expertise_year_from']),'id="expertise_year_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('expertise_month_to', $monthlist,set_value('expertise_month_to',$data['expertise_month_to']),'id="expertise_month_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>To Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('expertise_year_to', $year,set_value('expertise_year_to',$data['expertise_year_to']),'id="expertise_year_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_expertise_duration" id="employee_expertise_duration" value="<?php echo $data['employee_expertise_duration']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Duration</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_expertise_passed', $status ,set_value('employee_expertise_passed',$data['employee_expertise_passed']),'id="employee_expertise_passed", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Passed</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('employee_expertise_certificate', $status ,set_value('employee_expertise_certificate',$data['employee_expertise_certificate']),'id="employee_expertise_certificate", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Certificate</label>
											</div>
										</div>
									</div>

									<div class = "row">	
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="employee_expertise_remark" id="employee_expertise_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['employee_expertise_remark'];?></textarea>
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
