<script>
	function ulang(){
		document.getElementById("employee_code").value = "";
		document.getElementById("employee_name").value = "";
	}
</script>
<?php
	echo form_open('main/processaddemployee', array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addemployee');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Employee
					</h3>
				</div>
			</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Add Employee
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Region
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('region_id', $region, $data['region_id'], 'id ="region_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Branch
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('branch_id', $branch, $data['branch_id'], 'id ="branch_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Division
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('division_id', $division, $data['division_id'], 'id ="division_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Department
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('department_id', $department, $data['department_id'], 'id ="department_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Section
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('section_id', $section, $data['section_id'], 'id ="section_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Job Title
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('job_title_id', $jobtitle, $data['job_title_id'], 'id ="job_title_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Grade
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('grade_id', $grade, $data['grade_id'], 'id ="grade_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Class
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('class_id', $class, $data['class_id'], 'id ="class_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Location
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('location_id', $location, $data['location_id'], 'id ="location_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Shift
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('shift_id', $shift, $data['shift_id'], 'id ="shift_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Marital Status
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('marital_status_id', $maritalstatus, $data['marital_status_id'], 'id ="marital_status_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group">
											<label class="col-md-3 control-label">Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" class="form-control" value="<?php echo $data[employee_name]; ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>