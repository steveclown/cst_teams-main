<?php
$status = array(0=>"Fancy", 1=>"Not Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result['status'] ?>";
	document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
	document.getElementById("hospital_coverage_id").value = "<?php echo $result['hospital_coverage_id'] ?>";
	document.getElementById("hospital_claim_date").value = "<?php echo $result['hospital_claim_date'] ?>";
	document.getElementById("hospital_claim_opening_balance").value = "<?php echo $result['hospital_claim_opening_balance'] ?>";
	document.getElementById("hospital_claim_amount").value = "<?php echo $result['hospital_claim_amount'] ?>";
	document.getElementById("hospital_claim_last_balance").value = "<?php echo $result['hospital_claim_last_balance'] ?>";
	document.getElementById("hospital_claim_remark").value = "<?php echo $result['hospital_claim_remark'] ?>";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Hospital Claim
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalhospitalclaim" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalhospitalclaim">
							Hospital Claim List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalhospitalclaim/edit/<?php echo $result['hospital_claim_id'];?>">
							Edit Transactional Hospital Claim
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
										echo form_open('transactionalhospitalclaim/processEdittransactionalhospitalclaim',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
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
											<label class="control-label col-md-3">Hospital Coverage Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('hospital_coverage_id', $hospitalcoverage, $result['hospital_coverage_id'], 'id ="hospital_coverage_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-3">Claim Date</label>
											<div class="col-md-3">
														<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
															<input type="text" autocomplete="off"  class="form-control" name="hospital_claim_date" value="<?php echo tgltoview($result['hospital_claim_date']);?>" readonly>
															<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Opening Balance</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="hospital_claim_opening_balance" id="hospital_claim_opening_balance" value="<?php echo $result['hospital_claim_opening_balance'];?>" class="form-control" placeholder="Opening Balance">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="hospital_claim_amount" id="hospital_claim_amount" value="<?php echo $result['hospital_claim_amount'];?>" class="form-control" placeholder="Amount">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Last Balance</label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="hospital_claim_last_balance" id="hospital_claim_last_balance" value="<?php echo $result['hospital_claim_last_balance'];?>" class="form-control" placeholder="Last Balance">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="hospital_claim_remark" id="hospital_claim_remark" class="form-control" placeholder="Remark"><?php echo $result['hospital_claim_remark'];?></textarea>
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
				<input type="hidden" name="hospital_claim_id" value="<?php echo $result['hospital_claim_id']; ?>"/>
