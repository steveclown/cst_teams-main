<script>
	function ulang(){
		document.getElementById("skorsing_status_id").value = "";
		document.getElementById("skorsing_status_name").value = "";
		document.getElementById("skorsing_status_code").value = "";
	}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Suspension Status
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>skorsingstatus" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>skorsingstatus">
							Suspesion Status List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Suspension Status
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
										echo form_open('skorsingstatus/processAddSkorsingStatus',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddSkorsingStatus');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Suspension Status Code
													<span class="required">
														*
													</span>
												</label>
											
												<input type="text" name="skorsing_status_code" id="skorsing_status_code" class="form-control" value="<?php echo $data['skorsing_status_code']?>" placeholder="Skorsing Status Code">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Suspension Status Name</label>
											
												<input type="text" name="skorsing_status_name" id="skorsing_status_name" class="form-control" value="<?php echo $data['skorsing_status_name']?>" placeholder="Skorsing Status Name">
											</div>
										</div>
									</div>
									
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
