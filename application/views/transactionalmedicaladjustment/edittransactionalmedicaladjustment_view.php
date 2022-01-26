<?php
$status = array(0=>"Fancy", 1=>"Not Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result['status'] ?>";
	document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
	document.getElementById("medical_coverage_id").value = "<?php echo $result['medical_coverage_id'] ?>";
	document.getElementById("medical_adjustment_date").value = "<?php echo $result['medical_adjustment_date'] ?>";
	document.getElementById("medical_adjustment_opening_balance").value = "<?php echo $result['medical_adjustment_opening_balance'] ?>";
	document.getElementById("medical_adjustment_amount").value = "<?php echo $result['medical_adjustment_amount'] ?>";
	document.getElementById("medical_adjustment_last_balance").value = "<?php echo $result['medical_adjustment_last_balance'] ?>";
	document.getElementById("medical_adjustment_remark").value = "<?php echo $result['medical_adjustment_remark'] ?>";
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
					Form Edit Transactional Medical Adjustment
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalmedicaladjustment" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalmedicaladjustment">
							Medical Adjustment List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalmedicaladjustment/edit/<?php echo $result['medical_adjustment_id'];?>">
							Edit Transactional Medical Adjustment
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
										echo form_open('transactionalmedicaladjustment/processEdittransactionalmedicaladjustment',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Status
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('status', $status, $result['status'], 'id ="status", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_id', $employee, $result['employee_id'], 'id ="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Medical Coverage Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('medical_coverage_id', $medicalcoverage, $result['medical_coverage_id'], 'id ="medical_coverage_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-3">Adjustment Date</label>
											<div class="col-md-3">
														<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
															<input type="text" autocomplete="off"  class="form-control" name="medical_adjustment_date" value="<?php echo tgltoview($result['medical_adjustment_date']);?>" readonly>
															<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="medical_adjustment_amount" id="medical_adjustment_amount" value="<?php echo $result['medical_adjustment_amount'];?>" class="form-control" placeholder="Amount">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="medical_adjustment_remark" id="medical_adjustment_remark" class="form-control" placeholder="Remark"><?php echo $result['medical_adjustment_remark'];?></textarea>
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
				<input type="hidden" name="medical_adjustment_id" value="<?php echo $result['medical_adjustment_id']; ?>"/>
