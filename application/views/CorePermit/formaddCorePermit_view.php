<script>
	base_url = '<?php base_url()?>';

	function reset_data(){
	 	/*alert('asd');*/
		document.location = base_url+"reset_data";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CorePermit/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CorePermit/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
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
								<a href="<?php echo base_url();?>CorePermit">
									Daftar Izin
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CorePermit/addCorePermit">
									Tambah Izin
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Izin 
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
									<a href="<?php echo base_url();?>permit" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								<?php 
									echo form_open('permit/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCorePermit-'.$unique['unique']);
										$permit_token	= $this->session->userdata('CorePermitToken-'.$unique['unique']);

										if(empty($data['permit_code']))
										{
											$data['permit_code'] 					= '';
										}

										if(empty($data['permit_name'])){
										$data['permit_name'] 					= '';
									}
								?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('deduction_id', $corededuction, $data['deduction_id'], 'id ="deduction_id", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label ">Nama Deduksi
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
												<input type="text" name="permit_code" id="permit_code" value="<?php echo $data['permit_code']?>" class="form-control">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Izin
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="permit_name" id="permit_name" value="<?php echo $data['permit_name']?>" class="form-control">
												
												<input type="hidden" name="permit_token" id="permit_token" class="form-control" value="<?php echo $permit_token?>" onChange="function_elements_add(this.name, this.value);">
												
												<label class="control-label">Nama Izin
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>