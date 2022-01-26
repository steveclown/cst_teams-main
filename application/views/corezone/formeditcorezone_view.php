<script>
	function reset_data(){
		document.getElementById("zone_code").value = "<?php echo $corezone['zone_code'] ?>";
		document.getElementById("zone_name").value = "<?php echo $corezone['zone_name'] ?>";
	}

	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corezone/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
				<div class = "page-bar">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
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
							<a href="<?php echo base_url();?>corezone/editCoreZone/<?php echo $corezone['zone_id'];?>">
								Edit Zone
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Edit Zone
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
									<a href="<?php echo base_url();?>corezone" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corezone/processEditCoreZone',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="zone_code" id="zone_code" value="<?php echo $corezone['zone_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Zone Code<span class="required">*</span></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" autocomplete="off"  name="zone_name" id="zone_name" value="<?php echo $corezone['zone_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Zone Name<span class="required">*</span></label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="zone_id" value="<?php echo $corezone['zone_id']; ?>"/>
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>