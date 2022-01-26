<script>
	function ulang(){
		document.getElementById("dayoff_code").value = "<?php echo $coredayoff['dayoff_code'] ?>";
		document.getElementById("dayoff_name").value = "<?php echo $coredayoff['dayoff_name'] ?>";
		document.getElementById("dayoff_id").value = "<?php echo $coredayoff['dayoff_id'] ?>";
		document.getElementById("department_id").value = "<?php echo $coredayoff['department_id'] ?>";
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
								<a href="<?php echo base_url();?>coredayoff">
									Daftar libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coredayoff/editcoredayoff/<?php echo $coredayoff['dayoff_id']?>">
									Edit libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit libur
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
									<a href="<?php echo base_url();?>day-off" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coredayoff/processEditcoredayoff',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="dayoff_code" id="dayoff_code" value="<?php echo $coredayoff['dayoff_code']?>" class="form-control" >
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="dayoff_name" id="dayoff_name" value="<?php echo $coredayoff['dayoff_name']?>" class="form-control">
												<label class="control-label">Nama Libur
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
								<input type="hidden" name="dayoff_id" value="<?php echo $coredayoff['dayoff_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>