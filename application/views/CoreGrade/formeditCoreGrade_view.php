<script>
	function ulang(){
		document.getElementById("grade_id").value = "<?php echo $coregrade['grade_id'] ?>";
		document.getElementById("grade_code").value = "<?php echo $coregrade['grade_code'] ?>";
		document.getElementById("grade_name").value = "<?php echo $coregrade['grade_name'] ?>";
		document.getElementById("grade_remark").value = "<?php echo $coregrade['grade_remark'] ?>";
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
								<a href="<?php echo base_url();?>CoreGrade">
									Daftar Mutu
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreGrade/editCoreGrade/<?php echo $coregrade['grade_id']?>">
									Edit Mutu
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Mutu 
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
									<a href="<?php echo base_url();?>grade" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreGrade/processEditCoreGrade',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="grade_code" id="grade_code" value="<?php echo $coregrade['grade_code'];?>" class="form-control" >
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Mutu
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="grade_name" id="grade_name" value="<?php echo $coregrade['grade_name'];?>" class="form-control" >
												
												<label class="control-label">Nama Mutu
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
												<textarea rows="4" name="grade_remark" id="grade_remark" class="form-control"><?php echo $coregrade['grade_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="grade_id" value="<?php echo $coregrade['grade_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>