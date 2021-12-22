<script>
	function ulang(){
		document.getElementById("separation_reason_id").value = "";
		document.getElementById("separation_reason_name").value = "";
	}

	function reset_add(){
		document.location = "<?php echo base_url();?>CoreSeparationReason/reset_add";
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
								<a href="<?php echo base_url();?>CoreSeparationReason">
									Daftar alasan pemisahan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreSeparationReason/addCoreSeparationReason">
									Tambah alasan pemisahan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah alasan pemisahan
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
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>CoreSeparationReason" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreSeparationReason/processAddCoreSeparationReason',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addseparation_reason');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="separation_reason_name" id="separation_reason_name" value="<?php echo $data['separation_reason_name'];?>" class="form-control" >
												<label class="control-label">Nama alasan pemisahan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
										
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>