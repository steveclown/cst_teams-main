<script>
	function ulang(){
		document.getElementById("religion_id").value = "";
		document.getElementById("religion_code").value = "";
		document.getElementById("religion_name").value = "";
	}
</script>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Form Add Religion
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>religion">Religion</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>religion/add">Add Religion</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<a href="<?php echo base_url();?>religion" class="btn blue red-stripe">
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
										echo form_open('religion/processaddreligion',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addreligion');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Religion Code</label>
											
												<input type="text" autocomplete="off"  name="religion_code" id="religion_code" class="form-control" value="<?php echo $data['religion_code']?>" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Religion Name</label>
											
												<input type="text" autocomplete="off"  name="religion_name" id="religion_name" class="form-control" value="<?php echo $data['religion_name']?>" >
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
