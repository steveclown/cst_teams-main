<?php
$status = array(0=>"Fancy", 1=>"Not Fancy");
?>
<script>
function ulang(){
	document.getElementById("status").value = "<?php echo $result['status'] ?>";
	document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
	document.getElementById("glasses_coverage_id").value = "<?php echo $result['glasses_coverage_id'] ?>";
	document.getElementById("glasses_claim_date").value = "<?php echo $result['glasses_claim_date'] ?>";
	document.getElementById("glasses_claim_opening_balance").value = "<?php echo $result['glasses_claim_opening_balance'] ?>";
	document.getElementById("glasses_claim_amount").value = "<?php echo $result['glasses_claim_amount'] ?>";
	document.getElementById("glasses_claim_last_balance").value = "<?php echo $result['glasses_claim_last_balance'] ?>";
	document.getElementById("glasses_claim_remark").value = "<?php echo $result['glasses_claim_remark'] ?>";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Transactional Glasses Claim
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalglassesclaim" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalglassesclaim">
							Glasses Claim List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalglassesclaim/edit/<?php echo $result['glasses_claim_id'];?>">
							Edit Transactional Glasses Claim
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
										echo form_open('transactionalglassesclaim/processEdittransactionalglassesclaim',array('id' => 'myform', 'class' => 'form-horizontal')); 
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
											<label class="control-label col-md-3">Glasses Coverage Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('glasses_coverage_id', $glassescoverage, $result['glasses_coverage_id'], 'id ="glasses_coverage_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
										<label class="control-label col-md-3">Claim Date</label>
											<div class="col-md-3">
														<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
															<input type="text" class="form-control" name="glasses_claim_date" value="<?php echo tgltoview($result['glasses_claim_date']);?>" readonly>
															<span class="input-group-btn">
																<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Opening Balance</label>
											<div class="col-md-8">
												<input type="text" name="glasses_claim_opening_balance" id="glasses_claim_opening_balance" value="<?php echo $result['glasses_claim_opening_balance'];?>" class="form-control" placeholder="Opening Balance">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount</label>
											<div class="col-md-8">
												<input type="text" name="glasses_claim_amount" id="glasses_claim_amount" value="<?php echo $result['glasses_claim_amount'];?>" class="form-control" placeholder="Amount">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Last Balance</label>
											<div class="col-md-8">
												<input type="text" name="glasses_claim_last_balance" id="glasses_claim_last_balance" value="<?php echo $result['glasses_claim_last_balance'];?>" class="form-control" placeholder="Last Balance">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="glasses_claim_remark" id="glasses_claim_remark" class="form-control" placeholder="Remark"><?php echo $result['glasses_claim_remark'];?></textarea>
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
				<input type="hidden" name="glasses_claim_id" value="<?php echo $result['glasses_claim_id']; ?>"/>
