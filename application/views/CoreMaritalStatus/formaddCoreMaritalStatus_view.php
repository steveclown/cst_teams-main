<script>
	function ulang(){
		document.getElementById("marital_status_id").value = "";
		document.getElementById("marital_status_name").value = "";
		document.getElementById("marital_status_code").value = "";
	}
</script>
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreMaritalStatus">Status Pernikahan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreMaritalStatus/addCoreMaritalStatus">Tambah Status Pernikahan</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Status Pernikahan
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
									<a href="<?php echo base_url();?>marital-status" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								<?php 
									echo form_open('marital-status/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreMaritalStatus-'.$unique['unique']);
										$marital_status_token	= $this->session->userdata('CoreMaritalStatusToken-'.$unique['unique']);

										if(empty($data['marital_status_code']))
										{
											$data['marital_status_code'] 					= '';
										}

										if(empty($data['marital_status_name'])){
										$data['marital_status_name'] 					= '';
									}
								?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="marital_status_code" id="marital_status_code" class="form-control" value="<?php echo $data['marital_status_code']?>" >
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Status Pernikahan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="marital_status_name" id="marital_status_name" class="form-control" value="<?php echo $data['marital_status_name']?>" >
												
												<input type="hidden" name="marital_status_token" id="marital_status_token" class="form-control" value="<?php echo $marital_status_token?>" onChange="function_elements_add(this.name, this.value);">
												
												<label class="control-label">Nama Status Pernikahan</label>
											</div>
										</div>
									</div>
									<div class="form-actions right">
										<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
										<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
