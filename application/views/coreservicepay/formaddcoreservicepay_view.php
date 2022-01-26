<script>
function ulang(){
	document.getElementById("service_pay_id").value = "";
	document.getElementById("service_pay_code").value = "";
	document.getElementById("service_pay_name").value = "";
	document.getElementById("service_pay_range1").value = "";
	document.getElementById("service_pay_range2").value = "";
	document.getElementById("service_pay_ratio").value = "";
	document.getElementById("service_pay_type").value = "";
	document.getElementById("service_pay_remark").value = "";
}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
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
								<a href="<?php echo base_url();?>coreservicepay">
									Service Pay List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreservicepay/addCoreServicePay">
									Add Service Pay
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Service Pay 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
	
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
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
										echo form_open('coreservicepay/processAddCoreServicePay',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addservicepay');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="service_pay_code" id="service_pay_code" class="form-control" value="<?php echo $data['service_pay_code']?>">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Service Pay Code
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="service_pay_name" id="service_pay_name" class="form-control" value="<?php echo $data['service_pay_name']?>">
												<label class="control-label">Service Pay Name</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="service_pay_range1" id="service_pay_range1" class="form-control" value="<?php echo $data['service_pay_range1']?>" >
												<label class="control-label">Service Pay Range 1</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="service_pay_range2" id="service_pay_range2" class="form-control" value="<?php echo $data['service_pay_range2']?>" >
												<label class="control-label">Service Pay Range 2</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="service_pay_ratio" id="="service_pay_ratio" class="form-control" value="<?php echo $data['="service_pay_ratio']?>" >
												<label class="control-label">Service Pay Ratio</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('service_pay_type', $servicepaytype,set_value('service_pay_type',$data['service_pay_type']),'id="service_pay_type" class="form-control select2me"');
												?>
												<label class="control-label">Service Pay Type</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
										<div class="form-group form-md-line-input">
											<textarea rows="3" name="service_pay_remark" id="service_pay_remark" class="form-control"><?php echo $data['service_pay_remark']?></textarea>
											<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
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
