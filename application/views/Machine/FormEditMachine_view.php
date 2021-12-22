<script>
	function ulang(){
		document.getElementById("machine_code").value = "<?php echo $result['machine_code'] ?>";
		document.getElementById("machine_name").value = "<?php echo $result['machine_name'] ?>";
		document.getElementById("machine_id").value = "<?php echo $result['machine_id'] ?>";
	}
</script>
<div class="row">
			<div class="page-bar">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Beranda
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>machine">
							Daftar Mesin
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Edit Mesin
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>			
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>			
		</div>
		<h3 class="page-title">
				Form Edit Mesin
		</h3>

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
								<div class="actions">
									<a href="<?php echo base_url();?>Machine" class="btn btn-default btn-sm">
									<i class="fa fa-angle-left"></i>
									 Kembali
									</a>
							</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
<?php 
echo form_open('Machine/processeditMachine',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Machine Code
												<span class="required">*</span>
												</label>
											
												<input type="text" name="machine_code" id="machine_code" value="<?php echo $result['machine_code'];?>" class="form-control" placeholder="Machine Code">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Machine Name
												<span class="required">*</span>
												</label>
											
												<input type="text" name="machine_name" id="machine_name" value="<?php echo $result['machine_name'];?>" class="form-control" placeholder="Machine Name">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Machine IP Address
												<span class="required">*</span>
												</label>
											
												<input type="text" name="machine_ip_address" id="machine_ip_address" value="<?php echo $result['machine_ip_address'];?>" class="form-control" placeholder="Ip Address">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class=" control-label">Machine Port
												<span class="required">*</span>
												</label>
											
												<input type="text" name="machine_port" id="machine_port" value="<?php echo $result['machine_port'];?>" class="form-control" placeholder="Port">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Remark
												</label>
											
												<textarea rows="3" name="machine_remark" id="machine_remark" class="form-control"><?php echo $result['machine_remark'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions" style="text-align  : right !important;">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
								</div>
							
							<input type="hidden" name="machine_id" value="<?php echo $result['machine_id']; ?>"/>
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>