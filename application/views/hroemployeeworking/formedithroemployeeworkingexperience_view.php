<?php
$ResignLetter =array(0=>"No", 1=>"Yes");
?>
<script>
function ulang(){
	document.getElementById("company_name").value = "<?php echo $result['company_name'] ?>";
	document.getElementById("company_address").value = "<?php echo $result['company_address'] ?>";
	document.getElementById("working_experience_job_title").value = "<?php echo $result['working_experience_job_title'] ?>";
	document.getElementById("working_experience_from_period").value = "<?php echo $result['working_experience_from_period'] ?>";
	document.getElementById("working_experience_to_period").value = "<?php echo $result['working_experience_to_period'] ?>";
	document.getElementById("working_experience_last_salary").value = "<?php echo $result['working_experience_last_salary'] ?>";
	document.getElementById("working_experience_resign_reason").value = "<?php echo $result['working_experience_resign_reason'] ?>";
	document.getElementById("working_experience_resign_letter").value = "<?php echo $result['working_experience_resign_letter'] ?>";
	document.getElementById("working_experience_remark").value = "<?php echo $result['working_experience_remark'] ?>";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Working Experience
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeworkingexperience" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeeworkingexperience">
							Employee Working Experience List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeworkingexperience/edit/<?php echo $result['employee_working_experience_id'];?>">
							Edit Employee Working Experience
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
										echo form_open('hroemployeeworkingexperience/processEdithroemployeeworkingexperience',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeworkingexperience_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Company Name</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="company_name" id="company_name" value="<?php echo $result['company_name']?>" class="form-control" placeholder="Company Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Company address</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="company_address" id="company_address" value="<?php echo $result['company_address']?>" class="form-control" placeholder="Company address">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Job Title</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="working_experience_job_title" id="working_experience_job_title" value="<?php echo $result['working_experience_job_title']?>" class="form-control" placeholder="Job Title">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">From Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="working_experience_from_period" id="working_experience_from_period" value="<?php echo $result['working_experience_from_period']?>" class="form-control" placeholder="From Period"><span class="help-block">
													 Please input only Numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">To Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="working_experience_to_period" id="working_experience_to_period" value="<?php echo $result['working_experience_to_period']?>" class="form-control" placeholder="To Period"><span class="help-block">
													 Please input only Numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Last Salary</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="working_experience_last_salary" id="working_experience_last_salary" value="<?php echo $result['working_experience_last_salary']?>" class="form-control" placeholder="Last Salary"><span class="help-block">
													 Please input only Numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Resign Reason</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="working_experience_resign_reason" id="working_experience_resign_reason" value="<?php echo $result['working_experience_resign_reason']?>" class="form-control" placeholder="Resign Reason">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Resign Letter</label>
											<div class="col-md-8">
												<?php echo form_dropdown('working_experience_resign_letter', $ResignLetter, set_value('working_experience_resign_letter',$result['working_experience_resign_letter']),'id="working_experience_resign_letter", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="working_experience_remark" id="working_experience_remark" class="form-control" placeholder="Remark"><?php echo $result['working_experience_remark'];?></textarea>
											</div>
										</div>
										<input type="hidden" name="employee_working_experience_id" value="<?php echo $result['employee_working_experience_id']; ?>"/>
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
				
