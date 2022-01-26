<?php
$status = array(0=>"Fancy", 1=>"Not Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "";
	document.getElementById("employee_id").value = "";
	document.getElementById("hospital_coverage_id").value = "";
	document.getElementById("hospital_adjustment_date").value = "";
	document.getElementById("hospital_adjustment_opening_balance").value = "";
	document.getElementById("hospital_adjustment_amount").value = "";
	document.getElementById("hospital_adjustment_last_balance").value = "";
	document.getElementById("hospital_adjustment_remark").value = "";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Hospital Adjustment
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalhospitaladjustment" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalhospitaladjustment">
							Hospital Adjustment List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Transactional Hospital Adjustment
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
										echo form_open('transactionalhospitaladjustment/processAddtransactionalhospitaladjustment',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('Addtransactionalhospitaladjustment');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_id', $employee, $data['employee_id'], 'id ="employee_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Hospital Coverage Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('hospital_coverage_id', $hospitalcoverage, $data['hospital_coverage_id'], 'id ="hospital_coverage_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-3">Adjustment Date</label>
											<div class="col-md-3">
														<div class="input-group input-medium date date-picker" data-date="<?php date("Y-m-d")?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
															<input type="text" autocomplete="off"  class="form-control" name="hospital_adjustment_date" value="<?php echo date('Y-m-d');?>" readonly>
															<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="hospital_adjustment_amount" id="hospital_adjustment_amount" value="<?php echo $data['hospital_adjustment_amount'];?>" class="form-control" placeholder="Amount">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="hospital_adjustment_remark" id="hospital_adjustment_remark" class="form-control" placeholder="Remark"><?php echo $data['hospital_adjustment_remark'];?></textarea>
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
