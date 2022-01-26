<script>	
	function ulang(){
		document.getElementById("insurance_premi_code").value = "<?php echo $coreinsurancepremi['insurance_premi_code'] ?>";
		document.getElementById("insurance_premi_amount").value = "<?php echo $coreinsurancepremi['insurance_premi_amount'] ?>";
		document.getElementById("insurance_premi_remark").value = "<?php echo $coreinsurancepremi['insurance_premi_remark'] ?>";
		document.getElementById("insurance_id").value = "<?php echo $coreinsurancepremi['insurance_id'] ?>";
		document.getElementById("insurance_premi_id").value = "<?php echo $coreinsurancepremi['insurance_premi_id'] ?>";
	}
	
</script>

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb ">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreinsurancepremi">
									Insurance Premi List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreinsurancepremi/editCoreInsurancePremi/<?php echo $coreinsurancepremi['insurance_premi_id'];?>">
									Edit Insurance Premi
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Insurance Premi
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
		
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>coreinsurancepremi" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coreinsurancepremi/processEditCoreInsurancePremi',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('insurance_id', $coreinsurance, $coreinsurancepremi['insurance_id'], 'id ="insurance_id", class="form-control select2me"');?>
												<label class="control-label">Insurance Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="insurance_premi_code" id="insurance_premi_code" value="<?php echo $coreinsurancepremi['insurance_premi_code']?>" class="form-control" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Insurance Premi Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="insurance_premi_amount" id="insurance_premi_amount" value="<?php echo $coreinsurancepremi['insurance_premi_amount']?>" class="form-control" >
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Insurance Premi Amount
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="5" name="insurance_premi_remark" id="insurance_premi_remark" class="form-control"><?php echo $coreinsurancepremi['insurance_premi_remark'];?></textarea>
												<label class="control-label">Insurance Premi Remark</label>
											</div>
										</div>
									</div>
										<input type="hidden" name="insurance_premi_id" value="<?php echo $coreinsurancepremi['insurance_premi_id']; ?>"/>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				
