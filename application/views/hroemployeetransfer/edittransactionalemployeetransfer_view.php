<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_transfer_date").value = "<?php echo $result['employee_transfer_date'] ?>";
		document.getElementById("employee_transfer_remark").value = "<?php echo $result['employee_transfer_remark'] ?>";
		document.getElementById("region_id").value = "<?php echo $result['region_id'] ?>";
		document.getElementById("branch_id").value = "<?php echo $result['branch_id'] ?>";
		document.getElementById("division_id").value = "<?php echo $result['division_id'] ?>";
		document.getElementById("department_id").value = "<?php echo $result['department_id'] ?>";
		document.getElementById("section_id").value = "<?php echo $result['section_id'] ?>";
		document.getElementById("location_id").value = "<?php echo $result['location_id'] ?>";
		document.getElementById("job_title_id").value = "<?php echo $result['job_title_id'] ?>";
		document.getElementById("grade_id").value = "<?php echo $result['grade_id'] ?>";
		document.getElementById("class_id").value = "<?php echo $result['class_id'] ?>";
	}
function getdata(value) {
	$.ajax({
	   type : "POST",
	   url  : "<?php echo base_url(); ?>transactionalemployeetransfer/getdata",
	   data : "employee_id=" + value,
	   dataType: "json",
	   success: function(data){
			$("#region_id").val(data['region_id']);
			$("#branch_id").val(data['branch_id']);
			$("#division_id").val(data['division_id']);
			$("#department_id").val(data['department_id']);
			$("#section_id").val(data['section_id']);
			$("#location_id").val(data['location_id']);
			$("#job_title_id").val(data['job_title_id']);
			$("#grade_id").val(data['grade_id']);
			$("#class_id").val(data['class_id']);
		   }
		});
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Transfer
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalemployeetransfer" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalemployeetransfer">
							Employee Transfer List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalemployeetransfer/edit/<?php echo $result['employee_transfer_id'];?>">
							Edit Employee Transfer
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
										echo form_open('transactionalemployeetransfer/processEdittransactionalemployeetransfer',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me", onchange="getdata(this.value)"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Transfer Date</label>
											<div class="col-md-3">
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  name="employee_transfer_date" id="employee_transfer_date" value="<?php echo tgltoview($result['employee_transfer_date'])?>" class="form-control" placeholder="Transfer Date" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Region
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('region_id', $region, $result['region_id'], 'id ="region_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Branch
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('branch_id', $branch, $result['branch_id'], 'id ="branch_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Division
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('division_id', $division, $result['division_id'], 'id ="division_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Department
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('department_id', $department, $result['department_id'], 'id ="department_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Section
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('section_id', $section, $result['section_id'], 'id ="section_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Location
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('location_id', $location, $result['location_id'], 'id ="location_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Job Title
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('job_title_id', $jobtitle, $result['job_title_id'], 'id ="job_title_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Grade
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('grade_id', $grade, $result['grade_id'], 'id ="grade_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Class
											<span class="required">
											*
											</span></label>
											<div class="col-md-3">
												<?php echo form_dropdown('class_id', $class, $result['class_id'], 'id ="class_id", class="form-control "');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_transfer_remark" id="employee_transfer_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_transfer_remark'];?></textarea>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="employee_transfer_id" value="<?php echo $result['employee_transfer_id']; ?>"/>
