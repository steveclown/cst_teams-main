<script>
function ulang(){
	document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
	document.getElementById("medical_coverage_id").value = "<?php echo $result['medical_coverage_id'] ?>";
	document.getElementById("medical_coverage_period").value = "<?php echo $result['medical_coverage_period'] ?>";
	document.getElementById("medical_coverage_amount").value = "<?php echo $result['medical_coverage_amount'] ?>";
	document.getElementById("medical_coverage_claimed").value = "<?php echo $result['medical_coverage_claimed'] ?>";
	document.getElementById("medical_coverage_last_balance").value = "<?php echo $result['medical_coverage_last_balance'] ?>";
	document.getElementById("medical_coverage_remark").value = "<?php echo $result['medical_coverage_remark'] ?>";
}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Medical Coverage
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeemedicalcoverage" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeemedicalcoverage">
							Medical Coverage List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeemedicalcoverage/edit/<?php $result['employee_medical_coverage_id'];?>">
							Edit Employee Medical Coverage
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
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
										echo form_open('hroemployeemedicalcoverage/processEditHroEmployeeMedicalCoverage',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="medical_coverage_name" id="medical_coverage_name" value="<?php echo $this->hroemployeemedicalcoverage_model->getmedicalcoveragename($result[medical_coverage_id])?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="medical_coverage_id" id="medical_coverage_id" value="<?php echo $result[medical_coverage_id]; ?>" class="form-control" readonly>
												<?php //echo form_dropdown('medical_coverage_id', $medicalcoverage, $result['medical_coverage_id'], 'id ="medical_coverage_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeemedicalcoverage_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Period</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="medical_coverage_period" id="medical_coverage_period" value="<?php echo $result['medical_coverage_period'];?>" class="form-control" placeholder="Coverage Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="medical_coverage_amount" id="medical_coverage_amount" value="<?php echo $result['medical_coverage_amount'];?>" class="form-control" placeholder="Coverage Amount">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Claimed</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="medical_coverage_claimed" id="medical_coverage_claimed" value="<?php echo $result['medical_coverage_claimed'];?>" class="form-control" placeholder="Coverage Claimed">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Last Balance</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="medical_coverage_last_balance" id="medical_coverage_last_balance" value="<?php echo $result['medical_coverage_last_balance'];?>" class="form-control" placeholder="Coverage Last Balance">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="medical_coverage_remark" id="medical_coverage_remark" class="form-control" placeholder="Remark"><?php echo $result['medical_coverage_remark'];?></textarea>
											</div>
										</div>
										<input type="hidden" name="employee_medical_coverage_id" value="<?php echo $result['employee_medical_coverage_id']; ?>"/>
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
				
