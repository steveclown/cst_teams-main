<script>
	function ulang(){
		document.getElementById("absence_code").value 	= "<?php echo $coreabsence['absence_code'] ?>";
		document.getElementById("absence_name").value 	= "<?php echo $coreabsence['absence_name'] ?>";
		document.getElementById("absence_id").value	 	= "<?php echo $coreabsence['absence_id'] ?>";
		document.getElementById("deduction_id").value 	= "<?php echo $coreabsence['deduction_id'] ?>";
	}
	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreAbsence/function_elements_add');?>",
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
				url : "<?php echo site_url('CoreAbsence/function_state_add');?>",
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
								<a href="<?php echo base_url();?>CoreAbsence">
									Daftar Absensi
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreAbsence/editCoreAbsence/<?php echo $coreabsence['absence_id']?>">
									Edit Absensi
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Absensi 
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
									<a href="<?php echo base_url();?>absence" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreAbsence/processEditCoreAbsence',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('deduction_id', $corededuction,set_value('deduction_id',$coreabsence['deduction_id']),'id="deduction_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<span class="help-block">
													 Please input only alpha-numerical characters.
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
												<input type="text" name="absence_code" id="absence_code" value="<?php echo $coreabsence['absence_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Absensi
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="absence_name" id="absence_name" value="<?php echo $coreabsence['absence_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Absensi
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
								<input type="hidden" name="absence_id" value="<?php echo $coreabsence['absence_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>