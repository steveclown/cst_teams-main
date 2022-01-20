<script>
	function ulang(){
		document.getElementById("dayoff_code").value = "";
		document.getElementById("dayoff_name").value = "";
		document.getElementById("department_id").value = "";
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
								<a href="<?php echo base_url();?>CoreDayOff">
									Daftar Libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreDayOff/addCoreDayOff">
									Tambah Libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Libur
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
									<a href="<?php echo base_url();?>day-off" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								<?php 
									echo form_open('day-off/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreDayOff-'.$unique['unique']);
										$dayoff_token	= $this->session->userdata('CoreDayOffToken-'.$unique['unique']);

										if(empty($data['dayoff_code']))
										{
											$data['dayoff_code'] 					= '';
										}

										if(empty($data['dayoff_name'])){
										$data['dayoff_name'] 					= '';
									}
								?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="dayoff_code" id="dayoff_code" value="<?php echo $data['dayoff_code']?>" class="form-control">
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="dayoff_name" id="dayoff_name" value="<?php echo $data['dayoff_name']?>" class="form-control">
												
												<input type="hidden" name="dayoff_token" id="dayoff_token" class="form-control" value="<?php echo $dayoff_token?>" onChange="function_elements_add(this.name, this.value);">
												
												<label class="control-label">Nama libur
													<span class="required">
														*
													</span>
												</label>
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