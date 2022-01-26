<script>

	function reset_data(){
	 	/*alert('asd');*/
		document.location = base_url+"reset_data";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('coresaving/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
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
								<a href="<?php echo base_url();?>coresaving">
									Saving List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coresaving/addCoreSaving">
									Add saving
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Saving 
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
									<a href="<?php echo base_url();?>coresaving" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								<?php 
									echo form_open('coresaving/processAddCoreSaving',array('id' => 'myform', 'class' => 'horizontal-form')); 
									$data = $this->session->userdata('addsaving');
								
									echo $this->session->userdata('message');
									$this->session->unset_userdata('message');
								?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="saving_code" id="saving_code" value="<?php echo $data['saving_code']?>" onChange="function_elements_add(this.name, this.value);" class="form-control">
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
												<input type="text" autocomplete="off"  name="saving_name" id="saving_name" value="<?php echo $data['saving_name']?>" onChange="function_elements_add(this.name, this.value);" class="form-control">
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
												<input type="text" autocomplete="off"  name="saving_amount" id="saving_amount" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['saving_amount']?>" class="form-control">
												<label class="control-label">Saving Amount
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