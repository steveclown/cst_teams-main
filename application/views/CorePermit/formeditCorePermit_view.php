<script>
	function ulang(){
		document.getElementById("permit_code").value 	= "<?php echo $corepermit['permit_code'] ?>";
		document.getElementById("permit_name").value 	= "<?php echo $corepermit['permit_name'] ?>";
		document.getElementById("permit_id").value 		= "<?php echo $corepermit['permit_id'] ?>";
		document.getElementById("deduction_id").value 	= "<?php echo $corepermit['deduction_id'] ?>";
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
								<a href="<?php echo base_url();?>CorePermit/editCorePermit/<?php echo $corepermit['permit_id']?>">
									Edit izin
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit izin 
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
									<a href="<?php echo base_url();?>permit" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CorePermit/processEditCorePermit',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('deduction_id', $corededuction, $corepermit['deduction_id'], 'id ="deduction_id", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
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
												<input type="text" autocomplete="off"  name="permit_code" id="permit_code" value="<?php echo $corepermit['permit_code']?>" class="form-control" >
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
												<input type="text" autocomplete="off"  name="permit_name" id="permit_name" value="<?php echo $corepermit['permit_name']?>" class="form-control">
												<label class="control-label">Nama Izin
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
								<input type="hidden" name="permit_id" value="<?php echo $corepermit['permit_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>