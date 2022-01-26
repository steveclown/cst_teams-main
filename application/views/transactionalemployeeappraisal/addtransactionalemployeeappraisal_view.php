<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("employee_id").value = "";
	document.getElementById("employee_appraisal_value").value = "";
	document.getElementById("employee_appraisal_date").value = "";
	document.getElementById("employee_appraisal_remark").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Employee Appraisal
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalemployeeappraisal" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalemployeeappraisal">
							Employee Appraisal List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Transactional Employee Appraisal
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
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<?php 
										echo form_open('transactionalemployeeappraisal/processAddtransactionalemployeeappraisal',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('Addtransactionalemployeeappraisal');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name</label>
											<div class="col-md-3">
												<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$data['employee_id']),'id="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Appraisal Value</label>
											<div class="col-md-8">
											<input type="text" autocomplete="off"  name="employee_appraisal_value" id="employee_appraisal_value" class="form-control" placeholder="Appraisal Value" value="<?php echo $data['employee_appraisal_value'];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Appraisal Date</label>
											<div class="col-md-8">
											<input type="text" autocomplete="off"  name="employee_appraisal_date" id="employee_appraisal_date" class="form-control" placeholder="Appraisal Date" value="<?php echo $data['employee_appraisal_date'];?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Appraisal Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_appraisal_remark" id="employee_appraisal_remark" class="form-control" placeholder="Appraisal Remark"><?php echo $data['employee_appraisal_remark'];?></textarea>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
