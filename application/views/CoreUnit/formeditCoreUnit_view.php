<script>
	function ulang(){
		document.getElementById("unit_code").value = "<?php echo $CoreUnit['unit_code'] ?>";
		document.getElementById("unit_name").value = "<?php echo $CoreUnit['unit_name'] ?>";
		document.getElementById("division_id").value = "<?php echo $CoreUnit['division_id'] ?>";
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
								<a href="<?php echo base_url();?>CoreUnit">
									Daftar Satuan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreUnit/editCoreUnit/<?php echo $CoreUnit['unit_id']?>">
									Edit Satuan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Satuan 
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
									<a href="<?php echo base_url();?>unit" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreUnit/processEditCoreUnit',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('section_id', $coresection, $coreunit['section_id'], 'id ="division_id", class="form-control select2me"');?>
												<label class="control-label">Nama Bagian
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
												<input type="text" name="unit_code" id="unit_code" value="<?php echo $coreunit['unit_code'];?>" class="form-control">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Satuan
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="unit_name" id="unit_name" value="<?php echo $coreunit['unit_name'];?>" class="form-control">
												<label class="control-label">Nama Satuan
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
								<input type="hidden" name="unit_id" value="<?php echo $coreunit['unit_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
