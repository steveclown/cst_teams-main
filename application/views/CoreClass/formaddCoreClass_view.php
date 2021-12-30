<script>
	function ulang(){
		document.getElementById("class_code").value = "";
		document.getElementById("class_name").value = "";
		document.getElementById("grade_id").value = "";
		document.getElementById("standard_salary_range1").value = "";
		document.getElementById("standard_salary_range2").value = "";
		document.getElementById("class_remark").value = "";
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
								<a href="<?php echo base_url();?>CoreClass">
									Daftar Kelas
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreClass/addCoreClass">
									Tambah Kelas
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Kelas
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
									<a href="<?php echo base_url();?>CoreClass" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								<?php 
										echo form_open('class/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreClass-'.$unique['unique']);
										$class_token	= $this->session->userdata('CoreClassToken-'.$unique['unique']);

										if(empty($data['class_code'])){
											$data['class_code'] 					= '';
										}

										if(empty($data['class_name'])){
											$data['class_name'] 					= '';
										}
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('grade_id', $coregrade, $data['grade_id'], 'id ="grade_id", class="form-control select2me"');?>
												<label class="control-label">Nama Tingkatan
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
												<input type="text" name="class_code" id="class_code" value="<?php echo $data['class_code'];?>" class="form-control">
												<span class="help-block">
													 Diisi karakter angka dan huruf
												</span>
												<label class="control-label">Kode Kelas
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="class_name" id="class_name" value="<?php echo $data['class_name']?>" class="form-control">
												<label class="control-label">Nama Kelas
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
												<input type="text" name="standard_salary_range1" id="standard_salary_range1" value="<?php echo $data['standard_salary_range1']?>" class="form-control">
												<span class="help-block">
													Diisi angka
												</span>
												<label class="control-label">Gaji Standar 1
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="standard_salary_range2" id="standard_salary_range2" value="<?php echo $data['standard_salary_range2']?>" class="form-control">
												
												<input type="hidden" name="class_token" id="class_token" class="form-control" onChange="function_elements_add(this.name, this.value);" value="<?php echo $class_token?>">
												
												<span class="help-block">
													Diisi angka
												</span>
												<label class="control-label">Gaji Standar 2
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
												<textarea rows="3" name="class_remark" id="class_remark" class="form-control"><?php echo $data['class_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
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
