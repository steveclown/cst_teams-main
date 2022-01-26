<script>
	base_url = '<?php base_url()?>';

	function reset_data(){
	 	/*alert('asd');*/
		document.location = base_url+"reset_data";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreLate/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreLate/function_state_add');?>",
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
								<a href="<?php echo base_url();?>CoreLate">
									Daftar terlambat
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreLate/addCoreLate">
									Tambah Terlambat
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah terlambat
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
									<a href="<?php echo base_url();?>late" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('late/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

											echo $this->session->userdata('message');
											$this->session->unset_userdata('message');

											$unique 		= $this->session->userdata('unique');
											$data 			= $this->session->userdata('addCoreLate-'.$unique['unique']);
											$late_token	= $this->session->userdata('CoreLateToken-'.$unique['unique']);

											if(empty($data['late_code']))
											{
												$data['late_code'] 					= '';
											}

											if(empty($data['late_name'])){
											$data['late_name'] 					= '';
										}
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('deduction_id', $corededuction,set_value('deduction_id',$data['deduction_id']),'id="deduction_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Nama Deduksi
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
												<input type="text" autocomplete="off"  name="late_code" id="late_code" value="<?php echo $data['late_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Terlambat
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="late_name" id="late_name" value="<?php echo $data['late_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												
												<input type="hidden" name="late_token" id="late_token" class="form-control" value="<?php echo $late_token?>" onChange="function_elements_add(this.name, this.value);">
												
												<label class="control-label">Nama Terlambat
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