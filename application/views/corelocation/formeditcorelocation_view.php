<script>
	function ulang(){
		document.getElementById("location_code").value = "<?php echo $corelocation['location_code'] ?>";
		document.getElementById("location_name").value = "<?php echo $corelocation['location_name'] ?>";
		document.getElementById("branch_id").value = "<?php echo $corelocation['branch_id'] ?>";
	}
</script>
			
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corelocation">
									Daftar Location
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corelocation/editcorelocation/<?php echo $corelocation['location_id']?>">
									Edit Location
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Location 
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
									<i class="fa fa-reorder"></i>Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>location" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreLocation/processEditcorelocation',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<?php echo form_dropdown('branch_id', $corebranch, $corelocation['branch_id'], 'id ="branch_id", class="form-control select2me"');?>
												<label class="control-label">Nama Cabang
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
												<input type="text" name="location_code" id="location_code" value="<?php echo $corelocation['location_code'];?>" class="form-control">
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Location
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="location_name" id="location_name" value="<?php echo $corelocation['location_name'];?>" class="form-control">
												<label class="control-label">Nama Location
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="location_id" value="<?php echo $corelocation['location_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
