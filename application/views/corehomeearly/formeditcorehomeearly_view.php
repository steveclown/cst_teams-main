<script>
	function ulang(){
		document.getElementById("home_early_code").value 	= "<?php echo $corehomeearly['home_early_code'] ?>";
		document.getElementById("home_early_name").value 	= "<?php echo $corehomeearly['home_early_name'] ?>";
		document.getElementById("home_early_id").value	 	= "<?php echo $corehomeearly['home_early_id'] ?>";
		document.getElementById("deduction_id").value 		= "<?php echo $corehomeearly['deduction_id'] ?>";
	}
	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corehomeearly/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corehomeearly/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
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
								<a href="<?php echo base_url();?>corehomeearly">
									Home Early List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corehomeearly/editCoreHomeEarly/<?php echo $corehomeearly['home_early_id']?>">
									Edit Home Early
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Home Early 
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
									<a href="<?php echo base_url();?>home-early" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corehomeearly/processEditCoreHomeEarly',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('deduction_id', $corededuction,set_value('deduction_id',$corehomeearly['deduction_id']),'id="deduction_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Deduction Name
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
												<input type="text" autocomplete="off"  name="home_early_code" id="home_early_code" value="<?php echo $corehomeearly['home_early_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Home Early Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="home_early_name" id="home_early_name" value="<?php echo $corehomeearly['home_early_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Home Early Name
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
								<input type="hidden" name="home_early_id" value="<?php echo $corehomeearly['home_early_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>