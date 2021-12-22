<script>
	function reset_session(){
		document.getElementById("realization_percentage_min").value = "<?php echo $incentiverealizationpercentage['realization_percentage_min'] ?>";
		document.getElementById("realization_percentage_max").value = "<?php echo $incentiverealizationpercentage['realization_percentage_max'] ?>";
		document.getElementById("realization_percentage_omzet").value = "<?php echo $incentiverealizationpercentage['realization_percentage_omzet'] ?>";
		document.getElementById("realization_percentage_share").value = "<?php echo $incentiverealizationpercentage['realization_percentage_share'] ?>";
		document.getElementById("realization_percentage_id").value = "<?php echo $incentiverealizationpercentage['realization_percentage_id'] ?>";
	}

	base_url = '<?= base_url()?>';	

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"incentiverealizationpercentage/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('incentiverealizationpercentage/function_elements_add');?>",
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
				url : "<?php echo site_url('incentiverealizationpercentage/function_state_add');?>",
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
									Master
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>incentiverealizationpercentage">
									Realization Percentage List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>incentiverealizationpercentage/editIncentiveRealizationPercentage/<?php echo $incentiverealizationpercentage['asset_id']?>">
									Edit Realization Percentage
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Realization Percentage 
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
									<a href="<?php echo base_url();?>incentiverealizationpercentage" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('incentiverealizationpercentage/processEditIncentiveRealizationPercentage',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="realization_percentage_min" id="realization_percentage_min" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('realization_percentage_min',$incentiverealizationpercentage['realization_percentage_min']);?>"/>
												<label class="control-label">Realization Percentage Min
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="realization_percentage_max" id="realization_percentage_max" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('realization_percentage_max',$incentiverealizationpercentage['realization_percentage_max']);?>"/>
												<label class="control-label">Realization Percentage Max
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
												<input type="text" class="form-control" name="realization_percentage_omzet" id="realization_percentage_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('realization_percentage_omzet',$incentiverealizationpercentage['realization_percentage_omzet']);?>"/>
												<label class="control-label">Realization Percentage Omzet
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="realization_percentage_share" id="realization_percentage_share" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('realization_percentage_share',$incentiverealizationpercentage['realization_percentage_share']);?>"/>
												<label class="control-label">Realization Percentage Share
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>

								<input type="hidden" name="realization_percentage_id" value="<?php echo $incentiverealizationpercentage['realization_percentage_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>