<script><input type="text" autocomplete="off" 
	function ulang(){
		document.getElementById("overtime_name").value = "";
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
								<a href="<?php echo base_url();?>coreovertimecategory">
									Overtime Category List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreovertimecategory/addCoreOvertimeCategory">
									Add Overtime Category
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Overtime Category 
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
									<a href="<?php echo base_url();?>coreovertimecategory" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coreovertimecategory/processAddCoreOvertimeCategory',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddOvertimeCategory');
									?>
										<div class = "row">
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off" name="overtime_name" id="overtime_name" value="<?php echo $data['overtime_name']?>" class="form-control" >
													<label class="control-label">Overtime Category Name
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
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
