<script>

	base_url = '<?php echo base_url();?>';

	function reset_add(){
		document.location = "<?php echo base_url();?>division/reset-add";
	}


	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('division/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function ulang(){
		document.getElementById("division_code").value = "";
		document.getElementById("division_name").value = "";
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
							<a href="<?php echo base_url();?>CoreDivision">
								Daftar Devisi
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>CoreDivision/addCoreDivision">
								Tambah Devisi
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Tambah Devisi
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
									<a href="<?php echo base_url();?>division" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali</span>
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('division/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreDivision-'.$unique['unique']);
										$division_token	= $this->session->userdata('CoreDivisionToken-'.$unique['unique']);

										if(empty($data['division_code'])){
											$data['division_code'] 					= '';
										}

										if(empty($data['division_name'])){
											$data['division_name'] 					= '';
										}
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="division_code" id="division_code" value="<?php echo $data['division_code'];?>" class="form-control" >
												<label class="control-label">Kode Devisi
													<span class="required">
													*
													</span>
												</label>
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $data['division_name'];?>" class="form-control" >
									
												<input type="hidden" name="division_token" id="division_token" class="form-control" value="<?php echo $division_token?>" onChange="function_elements_add(this.name, this.value);">
												
												<label class="control-label">Nama Devisi
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
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>