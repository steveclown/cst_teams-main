<script>
	function ulang(){
		document.getElementById("nationality_id").value = "";
		document.getElementById("nationality_code").value = "";
		document.getElementById("nationality_name").value = "";
	}
</script>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Form Add Nationality
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>nationality">Nationality</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>nationality/add">Add Nationality</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<a href="<?php echo base_url();?>nationality" class="btn blue red-stripe">
						<i class="fa fa-angle-left"></i> Back		
					</a>
				</div>
			</div>
		</div>
		<!-- END PAGE TITLE & BREADCRUMB-->		
	</div>
</div>
<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box red-flamingo">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('nationality/processaddnationality',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addnationality');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nationality Code</label>
											
												<input type="text" autocomplete="off"  name="nationality_code" id="nationality_code" class="form-control" value="<?php echo $data['nationality_code']?>" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nationality Name</label>
											
												<input type="text" autocomplete="off"  name="nationality_name" id="nationality_name" class="form-control" value="<?php echo $data['nationality_name']?>" >
											</div>
										</div>
									</div>
									<div class="form-actions right">
										<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
										<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
