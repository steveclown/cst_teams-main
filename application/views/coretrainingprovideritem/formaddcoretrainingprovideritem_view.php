<script>
	base_url = '<?php echo base_url();?>';
	
	function reset_all(){
		document.location = base_url+"trainingprovider/reset_provider";
	}
	
	function ulang(){
		document.getElementById("training_provider_id").value = "";
		document.getElementById("training_provider_code").value = "";
		document.getElementById("training_provider_name").value = "";
		document.getElementById("training_provider_address").value = "";
		document.getElementById("training_provider_city").value = "";
		document.getElementById("training_provider_home_phone").value = "";
		document.getElementById("training_provider_mobile_phone").value = "";
		document.getElementById("training_provider_fax_number").value = "";
		document.getElementById("training_provider_email").value = "";
		document.getElementById("training_provider_contact_person").value = "";
		document.getElementById("training_provider_remark").value = "";
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
		echo form_open('coretrainingprovideritem/processAddCoreTrainingProviderItem',array('id' => 'myform', 'class' => 'horizontal-form')); 
		/**echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
		$data = $this->session->userdata('AddTrainingProvider');*/
		$data = $this->session->userdata('addcoretrainingprovideritem');
?>
<?php
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
?>
		
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
					<a href="<?php echo base_url();?>coretrainingprovideritem">
						Training Provider List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coretrainingprovideritem/addCoreTrainingProvider">
						Add Training Provider
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
		Form Add Training Provider 
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
						<a href="<?php echo base_url();?>coretrainingprovideritem" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('training_provider_id', $coretrainingprovider, $data['training_provider_id'], 'id ="training_provider_id", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
									<label class="control-label ">Training Provider Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
										
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('training_title_id', $coretrainingtitle, $data['training_title_id'], 'id ="traininig_title_id", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
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
									<input type="text" name="training_provider_item_name" id="training_provider_item_name" value="<?php echo $data['training_provider_item_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
									<input type="text" name="training_provider_item_cost" id="training_provider_item_cost" value="<?php echo $data['training_provider_item_cost'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
									<input type="text" name="training_provider_item_duration" id="training_provider_item_duration" value="<?php echo $data['training_provider_item_duration'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Training Provider Item Duration</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="training_provider_item_remark" id="training_provider_item_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['training_provider_item_remark'];?></textarea>
									<label class="control-label">Training Provider Item Remark</label>
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
