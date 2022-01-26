<script>
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corezone/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function reset_data(){
		document.location = "<?php echo base_url();?>corezone/reset_data";
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
							<a href="<?php echo base_url();?>corezone">
								Zone List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>corezone/addCoreZone">
								Add Zone
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Add Zone 
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
									<a href="<?php echo base_url();?>corezone" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>

							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corezone/processAddCoreZone',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addcorezone');
									?>
									<div class="row">
										<div class="col-md-6">	
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="zone_code" id="zone_code" value="<?php echo $data['zone_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Zone Code<span class="required">*</span></label>
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="zone_name" id="zone_name" value="<?php echo $data['zone_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value)">
												<label class="control-label">Zone Name<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="form-actions right">
										<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Reset</button>
										<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
									</div>
								</div>
							<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>