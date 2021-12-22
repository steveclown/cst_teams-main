<script>
	
	base_url = '<?php echo base_url();?>';

	function reset_add(){
	document.location = "<?php echo base_url();?>branch/reset-add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('branch/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	function ulang(){
		document.getElementById("branch_code").value = "";
		document.getElementById("branch_name").value = "";
		document.getElementById("region_name").value = "";
		document.getElementById("branch_address").value = "";
		document.getElementById("branch_contact_person").value = "";
		document.getElementById("branch_phone1").value = "";
		document.getElementById("branch_phone2").value = "";
		document.getElementById("branch_email").value = "";
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
							<a href="<?php echo base_url();?>CoreBranch">
								Daftar Cabang
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>CoreBranch/addCoreBranch">
								Tambah Cabang
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Tambah Cabang
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
									<a href="<?php echo base_url();?>branch" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('branch/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreBranch-'.$unique['unique']);
										$branch_token	= $this->session->userdata('CoreBranchToken-'.$unique['unique']);

										if(empty($data['branch_code'])){
											$data['branch_code'] 					= '';
										}

										if(empty($data['branch_name'])){
											$data['branch_name'] 					= '';
										}

										if(empty($data['branch_address'])){
											$data['branch_address'] 					= '';
										}

										if(empty($data['branch_address'])){
											$data['branch_address'] 					= '';
										}

										if(empty($data['branch_contact_person'])){
											$data['branch_contact_person'] 					= '';
										}

										if(empty($data['branch_phone1'])){
											$data['branch_phone1'] 					= '';
										}

										if(empty($data['branch_phone2'])){
											$data['branch_phone2'] 					= '';
										}

										if(empty($data['branch_email'])){
											$data['branch_email'] 					= '';
										}
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('region_id', $coreregion, $data['region_id'], 'id ="region_id", class="form-control select2me"');?>
												<label class="control-label">Nama Wilayah<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">	
											<div class="form-group form-md-line-input">
												<input type="text" name="branch_code" id="branch_code" value="<?php echo $data['branch_code']?>" class="form-control" autocomplete="off" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Kode Cabang<span class="required">*</span></label>
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka saja.
												</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="branch_name" id="branch_name" value="<?php echo $data['branch_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Cabang<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="branch_address" id="branch_address" class="form-control"onChange="function_elements_add(this.name, this.value);"><?php echo $data['branch_address'];?></textarea>
												<label>Alamat Cabang</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="branch_contact_person" id="branch_contact_person" value="<?php echo $data['branch_contact_person']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Contact Person<span class="required">*</span></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">										
												<input type="text" name="branch_phone1" id="branch_phone1" value="<?php echo $data['branch_phone1']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">No Hp Cabang 1<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="branch_phone2" id="branch_phone2" value="<?php echo $data['branch_phone2']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">No Hp Cabang 2</label>		
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">										
												<input type="text" name="branch_email" id="branch_email" value="<?php echo $data['branch_email']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">

												<input type="hidden" name="branch_token" id="branch_token" class="form-control" onChange="function_elements_add(this.name, this.value);" value="<?php echo $branch_token?>">

												<label class="control-label">Email Cabang<span class="required">*</span></label>
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