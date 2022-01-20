<script>
	function ulang(){
		document.getElementById("section_code").value = "<?php echo $coresection['section_code'] ?>";
		document.getElementById("section_name").value = "<?php echo $coresection['section_name'] ?>";
		document.getElementById("section_id").value = "<?php echo $coresection['section_id'] ?>";
		document.getElementById("department_id").value = "<?php echo $coresection['department_id'] ?>";
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
								<a href="<?php echo base_url();?>CoreSection">
									Daftar Bagian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreSection/editCoreSection/<?php echo $coresection['section_id']?>">
									Edit Bagian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Bagian 
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
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>section" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreSection/processEditCoreSection',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('department_id', $coredepartment, $coresection['department_id'], 'id ="department_id", class="form-control select2me"');?>
												<label class="control-label">Nama Departemen
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
												<input type="text" name="section_code" id="section_code" value="<?php echo $coresection['section_code']?>" class="form-control" >
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Bagian
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="section_name" id="section_name" value="<?php echo $coresection['section_name']?>" class="form-control">
												<label class="control-label">Nama Bagian
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
								<input type="hidden" name="section_id" value="<?php echo $coresection['section_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>