<script>
	function ulang(){
		document.getElementById("saving_code").value = "<?php echo $coresaving['saving_code'] ?>";
		document.getElementById("saving_name").value = "<?php echo $coresaving['saving_name'] ?>";
		document.getElementById("saving_id").value = "<?php echo $coresaving['saving_id'] ?>";
		document.getElementById("department_id").value = "<?php echo $coresaving['department_id'] ?>";
	}
	
</script>
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
								<a href="<?php echo base_url();?>coresaving">
									Saving List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coresaving/editCoreSaving/<?php echo $coresaving['saving_id']?>">
									Edit Saving
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Saving 
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
									<a href="<?php echo base_url();?>coresaving" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coresaving/processEditCoreSaving',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="saving_code" id="saving_code" value="<?php echo $coresaving['saving_code']?>" class="form-control" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Saving Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="saving_name" id="saving_name" value="<?php echo $coresaving['saving_name']?>" class="form-control">
												<label class="control-label">Saving Name
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
												<input type="text" autocomplete="off"  name="saving_amount" id="saving_amount" value="<?php echo $coresaving['saving_amount']?>" class="form-control">
												<label class="control-label">Saving Name
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
								<input type="hidden" name="saving_id" value="<?php echo $coresaving['saving_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>