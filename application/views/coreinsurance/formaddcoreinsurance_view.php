<script>
	function ulang(){
		document.getElementById("insurance_code").value = "";
		document.getElementById("insurance_name").value = "";
		document.getElementById("insurance_address").value = "";
		document.getElementById("insurance_city").value = "";
		document.getElementById("insurance_home_phone").value = "";
		document.getElementById("insurance_mobile_phone").value = "";
		document.getElementById("insurance_contact_person").value = "";
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
								<a href="<?php echo base_url();?>coreinsurance">
									Insurance List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreinsurance/addCoreInsurance">
									Add Insurance
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Insurance
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
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>coreinsurance" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coreinsurance/processAddCoreInsurance',array('id' => 'myform', 'class' => 'horizontal-form'));
										$data = $this->session->userdata('AddInsurance');
									?>
									<div class = "row">
										<div class="col-md-6">
										<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="insurance_code" id="insurance_code" value="<?php echo $data['insurance_code']?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Insurance Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="insurance_name" id="insurance_name" value="<?php echo $data['insurance_name']?>" class="form-control" >
												<label class="control-label">Insurance Name
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
												<textarea rows="3" name="insurance_address" id="insurance_address" class="form-control"><?php echo $data['insurance_address']?></textarea>
												<label class="control-label">Insurance Address
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
												<input type="text" autocomplete="off"  name="insurance_city" id="insurance_city" value="<?php echo $data['insurance_city']?>" class="form-control" >
												<label class="control-label">Insurance City
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="insurance_contact_person" id="insurance_contact_person" value="<?php echo $data['insurance_contact_person']?>" class="form-control">
												<label class="control-label">Insurance Contact Person
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
												<input type="text" autocomplete="off"  name="insurance_home_phone" id="insurance_home_phone" value="<?php echo $data['insurance_home_phone']?>" class="form-control" >
												<label class="control-label">Insurance Home Phone
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="insurance_mobile_phone" id="insurance_mobile_phone" value="<?php echo $data['insurance_mobile_phone']?>" class="form-control" >
												<label class="control-label">Insurance Mobile Phone
													<span class="required">
														*
													</span>
												</label>
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
