<script>
	function ulang(){
		document.getElementById("social_security_id").value = "<?php echo $result['social_security_id'] ?>";
		document.getElementById("social_security_name").value = "<?php echo $result['social_security_name'] ?>";
		document.getElementById("social_security_code").value = "<?php echo $result['social_security_code'] ?>";
	}
</script>

	<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Form Edit Social Security
		</h3>
		<ul class="page-breadcrumb breadcrumb">
		<li class="btn-group">
			<div class="actions">
				<a href="<?php echo base_url();?>socialsecurity" class="btn green yellow-stripe">
					<i class="fa fa-angle-left"></i>
					<span class="hidden-480">
						 Back
					</span>
				</a>
			</div>
		</li>
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url();?>">
				Master
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>socialsecurity">
				Social Security List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>socialsecurity/edit/<?php echo $result['social_security_id']; ?>">
				Edit Social Security
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Form Edit
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-body">
						<?php 
							echo form_open('socialsecurity/processEditsocialsecurity',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Period</label>
									
									<input type="text" autocomplete="off"  name="social_security_period" id="social_security_period" class="form-control" value="<?php echo $result['social_security_period']?>" placeholder="Period">
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">JKM</label>
								
									<input type="text" autocomplete="off"  name="social_security_jkm" id="social_security_jkm" class="form-control" value="<?php echo $result['social_security_jkm']?>" placeholder="JKM">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">JKK</label>
								
									<input type="text" autocomplete="off"  name="social_security_jkk" id="social_security_jkk" class="form-control" value="<?php echo $result['social_security_jkk']?>" placeholder="JKK">
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">JHT Employee</label>
								
									<input type="text" autocomplete="off"  name="social_security_jht_employee" id="social_security_jht_employee" class="form-control" value="<?php echo $result['social_security_jht_employee']?>" placeholder="JHT Employee">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">JHT Company</label>
								
									<input type="text" autocomplete="off"  name="social_security_jht_company" id="social_security_jht_company" class="form-control" value="<?php echo $result['social_security_jht_company']?>" placeholder="JHT Company">
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Medical Employee</label>
								
									<input type="text" autocomplete="off"  name="social_security_medical_employee" id="social_security_medical_employee" class="form-control" value="<?php echo $result['social_security_medical_employee']?>" placeholder="Medical Employee">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Medical Company</label>
								
									<input type="text" autocomplete="off"  name="social_security_medical_company" id="social_security_medical_company" class="form-control" value="<?php echo $result['social_security_medical_company']?>" placeholder="Medical Company">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="social_security_id" value="<?php echo $result['social_security_id']; ?>"/>
