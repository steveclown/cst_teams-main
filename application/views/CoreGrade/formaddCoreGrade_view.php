<script>
	function ulang(){
		document.getElementById("grade_id").value = "";
		document.getElementById("grade_code").value = "";
		document.getElementById("grade_name").value = "";
		document.getElementById("grade_remark").value = "";
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
								<a href="<?php echo base_url();?>CoreGrade/addCoreGrade">
									Tambah Mutu
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Mutu
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
									<a href="<?php echo base_url();?>CoreGrade" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('grade/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreGrade-'.$unique['unique']);
										$grade_token	= $this->session->userdata('CoreGradeToken-'.$unique['unique']);

										if(empty($data['grade_code'])){
											$data['grade_code'] 					= '';
										}

										if(empty($data['grade_name'])){
											$data['grade_name'] 					= '';
										}
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="grade_code" id="grade_code" value="<?php echo $data['grade_code'];?>" class="form-control">
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
												<input type="text" name="grade_name" id="grade_name" value="<?php echo $data['grade_name'];?>" class="form-control" >
												
												<input type="hidden" name="grade_token" id="grade_token" class="form-control" value="<?php echo $grade_token?>" onChange="function_elements_add(this.name, this.value);">
												
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
												<textarea rows="3" name="grade_remark" id="grade_remark" class="form-control"><?php echo $data['grade_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
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