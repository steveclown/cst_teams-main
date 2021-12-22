<script>
	function ulang(){
		document.getElementById("training_provider_id").value = "<?php echo $result['training_provider_id'] ?>";
		document.getElementById("training_provider_code").value = "<?php echo $result['training_provider_code'] ?>";
		document.getElementById("training_provider_name").value = "<?php echo $result['training_provider_name'] ?>";
		document.getElementById("training_provider_address").value = "<?php echo $result['training_provider_address'] ?>";
		document.getElementById("training_provider_city").value = "<?php echo $result['training_provider_city'] ?>";
		document.getElementById("training_provider_home_phone").value = "<?php echo $result['training_provider_home_phone'] ?>";
		document.getElementById("training_provider_mobile_phone").value = "<?php echo $result['training_provider_mobile_phone'] ?>";
		document.getElementById("training_provider_fax_number").value = "<?php echo $result['training_provider_fax_number'] ?>";
		document.getElementById("training_provider_email").value = "<?php echo $result['training_provider_email'] ?>";
		document.getElementById("training_provider_contact_person").value = "<?php echo $result['training_provider_contact_person'] ?>";
		document.getElementById("training_provider_remark").value = "<?php echo $result['training_provider_remark'] ?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('coretrainingprovideritem/function_elements_add');?>",
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
				url : "<?php echo site_url('coretrainingprovideritem/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
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
					<a href="<?php echo base_url();?>coretrainingprovideritem">
						Training Provider List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coretrainingprovideritem/editCoreTrainingProviderItem/<?php echo $coretrainingprovideritem['training_provider_item_id'];?>">
						Edit Training Provider Item
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
		Form Edit Training Provider Item
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
						<a href="<?php echo base_url();?>coretrainingprovideritem" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							//echo form_open('trainingprovider/processEditTrainingProvider',array('id' => 'myform', 'class' => 'form-horizontal')); 
							echo form_open('coretrainingprovideritem/processEditCoreTrainingProviderItem',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('training_provider_id', $coretrainingprovider, $coretrainingprovideritem['training_provider_id'], 'id ="training_provider_id", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
									<label class="control-label ">Training Provider Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
										
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('training_title_id', $coretrainingtitle, $coretrainingprovideritem['training_title_id'], 'id ="traininig_title_id", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
									<label class="control-label">Training Title Name
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
									<input type="text" name="training_provider_item_name" id="training_provider_item_name" value="<?php echo $coretrainingprovideritem['training_provider_item_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Training Provider Item Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="training_provider_item_cost" id="training_provider_item_cost" value="<?php echo $coretrainingprovideritem['training_provider_item_cost'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Training Provider Item Cost
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
									<input type="text" name="training_provider_item_duration" id="training_provider_item_duration" value="<?php echo $coretrainingprovideritem['training_provider_item_duration'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Training Provider Item Duration</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="training_provider_item_remark" id="training_provider_item_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $coretrainingprovideritem['training_provider_item_remark'];?></textarea>
									<label class="control-label">Training Provider Item Remark</label>
								</div>
							</div>
						</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<input type="hidden" name="training_provider_item_id" value="<?php echo $coretrainingprovideritem['training_provider_item_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>					
			</div>
		</div>
	</div>
	
