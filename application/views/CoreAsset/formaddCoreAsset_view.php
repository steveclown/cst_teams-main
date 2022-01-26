<script>
	function ulang(){
		document.getElementById("asset_code").value = "";
		document.getElementById("asset_name").value = "";
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
								<a href="<?php echo base_url();?>CoreAsset">
									Daftar Asset
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreAsset/addCoreAsset">
									Tambah Asset
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Asset 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
				
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addasset');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>CoreAsset" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php
									echo form_open('CoreAsset/processAddCoreAsset',array('class' => 'horizontal-form'));
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" name="asset_code" id="asset_code"  value="<?php echo set_value('asset_code',$data['asset_code']);?>"/>
												<span class="help-block">
													Diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Asset
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" name="asset_name" id="asset_name" value="<?php echo set_value('asset_name',$data['asset_name']);?>"/>
												<label class="control-label">Nama Asset
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
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
