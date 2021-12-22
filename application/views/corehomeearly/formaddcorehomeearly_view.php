<script>
	base_url = '<?php base_url()?>';

	function reset_data(){
	 	/*alert('asd');*/
		document.location = base_url+"reset_data";
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
								<a href="<?php echo base_url();?>corehomeearly/addCoreHomeEarly">
									Add Home Early
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Home Early 
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
									<a href="<?php echo base_url();?>corehomeearly" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								<?php 
									echo form_open('corehomeearly/processAddCoreHomeEarly',array('id' => 'myform', 'class' => 'horizontal-form')); 
									$data = $this->session->userdata('addcorehomeearly');
								?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('deduction_id', $corededuction,set_value('deduction_id',$data['deduction_id']),'id="deduction_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
												<input type="text" name="home_early_code" id="home_early_code" value="<?php echo $data['home_early_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
												<input type="text" name="home_early_name" id="home_early_name" value="<?php echo $data['home_early_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Home Early Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>