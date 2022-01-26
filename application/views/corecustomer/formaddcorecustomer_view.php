<script>
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corecustomer/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function reset_data(){
		document.location = "<?php echo base_url();?>corecustomer/reset_data";
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
							<a href="<?php echo base_url();?>corecustomer">
								Customer List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>corecustomer/addCoreCustomer">
								Add Customer
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Add Customer 
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
									<a href="<?php echo base_url();?>corecustomer" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corecustomer/processAddCoreCustomer',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addcorecustomer');
									?>
									<div class="row">
										<div class="col-md-6">	
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="customer_code" id="customer_code" value="<?php echo $data['customer_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Customer Code<span class="required">*</span></label>
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="customer_name" id="customer_name" value="<?php echo $data['customer_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Customer Name<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="customer_address" id="customer_address" class="form-control" onChange="function_elements_add(this.name, this.value)" ><?php echo $data['customer_address'];?></textarea>
												<label>Customer Address</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="customer_city" id="customer_city" value="<?php echo $data['customer_city']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Customer City<span class="required">*</span></label>
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