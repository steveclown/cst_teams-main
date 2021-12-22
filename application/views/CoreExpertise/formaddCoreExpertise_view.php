<script>
	function ulang(){
		document.getElementById("expertise_code").value = "";
		document.getElementById("expertise_name").value = "";
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
								<a href="<?php echo base_url();?>CoreExpertise">
									Daftar Keahlian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreExpertise/addCoreExpertise">
									Tambah Keahlian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Keahlian
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
									<a href="<?php echo base_url();?>CoreExpertise" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreExpertise/processAddCoreExpertise',array('class' => 'horizontal-form'));
									$data = $this->session->userdata('addexpertise');
									 ?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="expertise_code" id="expertise_code" value="<?php echo set_value('expertise_code',$data['expertise_code']);?>"/>
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Keahlian
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="expertise_name" id="expertise_name" value="<?php echo set_value('expertise_name',$data['expertise_name']);?>"/>
												<label class="control-label">Nama Keahlian
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" class="form-control" name="expertise_remark" id="expertise_remark"> <?php echo set_value('expertise_remark',$data['expertise_remark']);?> </textarea>
												<label class="control-label">Keterangan
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
