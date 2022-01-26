<script>
	function ulang(){
		document.getElementById("machine_code").value = "";
		document.getElementById("machine_name").value = "";
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
							Tambah Mesin
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>			
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>			
		</div>
		<h3 class="page-title">
				Form Tambah Mesin
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
									<i class="fa fa-reorder"></i>Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>Machine" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">

<?php 
	echo form_open('machine/processaddmachine',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$data = $this->session->userdata('addmachine');
?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Kode Mesin
												<span class="required">*</span>
												</label>
											
												<input type="text" autocomplete="off"  name="machine_code" id="machine_code" value="<?php echo $data['machine_code'];?>" class="form-control">
												<span class="help-block">
													 Mohon hanya diisi karakter huruf atau angka.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Nama Mesin
												<span class="required">*</span>
												</label>
											
												<input type="text" autocomplete="off"  name="machine_name" id="machine_name" value="<?php echo $data['machine_name'];?>" class="form-control">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label"> IP Address Mesin
												<span class="required">*</span>
												</label>
											
												<input type="text" autocomplete="off"  name="machine_ip_address" id="machine_ip_address" value="<?php echo $data['machine_ip_address'];?>" class="form-control" >
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Port Mesin
												<span class="required">*</span>
												</label>
											
												<input type="text" autocomplete="off"  name="machine_port" id="machine_port" value="<?php echo $data['machine_port'];?>" class="form-control">
											</div>
										</div>
									</div>
																		
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Keterangan
												</label>
											
												<textarea rows = "3" name="machine_remark" id="machine_remark" class="form-control"><?php echo $data['machine_remark'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions" style="text-align  : right !important;">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Simpan</button>
								</div>

<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>