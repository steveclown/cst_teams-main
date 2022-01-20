<script>
	function ulang(){
		document.getElementById("department_code").value = "<?php echo $coredepartment['department_code'] ?>";
		document.getElementById("department_name").value = "<?php echo $coredepartment['department_name'] ?>";
		document.getElementById("division_id").value = "<?php echo $coredepartment['division_id'] ?>";
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
								<a href="<?php echo base_url();?>coredepartment">
									Daftar Departemen
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coredepartment/editcoredepartment/<?php echo $coredepartment['division_id']?>">
									Edit Departemen
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Departemen 
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
									<a href="<?php echo base_url();?>department" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreDepartment/processEditcoredepartment',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
											<?php echo form_dropdown('division_id', $coredivision, $coredepartment['division_id'], 'id ="division_id", class="form-control select2me"');?>
												<label class="control-label">Nama Devisi
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
												<input type="text" name="department_code" id="department_code" value="<?php echo $coredepartment['department_code'];?>" class="form-control">
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Departemen
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="department_name" id="department_name" value="<?php echo $coredepartment['department_name'];?>" class="form-control">
												<label class="control-label">Nama Departemen
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
								<input type="hidden" name="department_id" value="<?php echo $coredepartment['department_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
