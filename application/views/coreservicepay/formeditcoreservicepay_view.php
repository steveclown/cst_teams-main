<script>
	function ulang(){
		document.getElementById("service_pay_id").value = "<?php echo $coreservicepay['service_pay_id'] ?>";
		document.getElementById("service_pay_code").value = "<?php echo $coreservicepay['service_pay_code'] ?>";
		document.getElementById("service_pay_name").value = "<?php echo $coreservicepay['service_pay_name'] ?>";
		document.getElementById("service_pay_range1").value = "<?php echo $coreservicepay['service_pay_range1'] ?>";
		document.getElementById("service_pay_range2").value = "<?php echo $coreservicepay['service_pay_range2'] ?>";
		document.getElementById("service_pay_amount").value = "<?php echo $coreservicepay['service_pay_amount'] ?>";
		document.getElementById("service_pay_remark").value = "<?php echo $coreservicepay['service_pay_remark'] ?>";
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">
						Home
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coreservicepay">
						Service Pay List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coreservicepay/editCoreServicePay/<?php echo $coreservicepay['service_pay_id']; ?>">
						Edit Service Pay
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Service Pay 
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>coreservicepay" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('coreservicepay/processEditCoreServicePay',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="service_pay_code" id="service_pay_code" class="form-control" value="<?php echo $coreservicepay['service_pay_code']?>">
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Service Pay Code</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="service_pay_name" id="service_pay_name" class="form-control" value="<?php echo $coreservicepay['service_pay_name']?>" >
									<label class="control-label">Service Pay Name</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="service_pay_range1" id="service_pay_range1" class="form-control" value="<?php echo $coreservicepay['service_pay_range1']?>">
									<label class="control-label">Service Pay Range 1</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="service_pay_range2" id="service_pay_range2" class="form-control" value="<?php echo $coreservicepay['service_pay_range2']?>" >
									<label class="control-label">Service Pay Range 2</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="service_pay_ratio" id="service_pay_ratio" class="form-control" value="<?php echo $coreservicepay['service_pay_ratio']?>" >
									<label class="control-label">Service Pay Ratio</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php
										echo form_dropdown('service_pay_type', $servicepaytype,set_value('service_pay_type',$coreservicepay['service_pay_type']),'id="service_pay_type" class="form-control select2me"');
									?>
									<label class="control-label">Service Pay Type</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="service_pay_remark" id="service_pay_remark" class="form-control"><?php echo $coreservicepay['service_pay_remark']?></textarea>
									<label class="control-label">Remark</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<input type="hidden" name="service_pay_id" value="<?php echo $coreservicepay['service_pay_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	
