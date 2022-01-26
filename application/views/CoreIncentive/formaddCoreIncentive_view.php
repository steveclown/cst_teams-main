<script>
	base_url = '<?php base_url()?>';

	mappia = "	<?php 
					$site_url = 'CoreIncentive/addCoreIncentive/';
					echo site_url($site_url); 
				?>";

	function reset_data(){
	 	/*alert('asd');*/
		document.location = base_url+"reset_data";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreIncentive/function_elements_add');?>",
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
				url : "<?php echo site_url('CoreIncentive/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>

					<div class = "page-bar">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreIncentive">
									Daftar Insentif
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreIncentive/addCoreIncentive">
									Tambah Insentif
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Insentif
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
									<a href="<?php echo base_url();?>CoreIncentive" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreIncentive/processAddCoreIncentive',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addincentive');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="incentive_code" id="incentive_code" class="form-control" value="<?php echo $data['incentive_code']?>" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													 Mohon diisi karakter huruf dan angka.
												</span>
												<label class="control-label">kode Insentif
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="incentive_name" id="incentive_name" class="form-control" value="<?php echo $data['incentive_name']?>" onChange="function_elements_add(this.name, this.value);" >
												<label class="control-label">Nama Insentif</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="incentive_amount" id="incentive_amount" class="form-control" value="<?php echo $data['incentive_amount']?>" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													 mohon hanya diisi dengan angka.
												</span>

												<label class="control-label">Total Insentif</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="incentive_remark" id="incentive_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['incentive_remark']?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
