<script>
	function ulang(){
		document.getElementById("late_code").value 		= "<?php echo $corelate['late_code'] ?>";
		document.getElementById("late_name").value 		= "<?php echo $corelate['late_name'] ?>";
		document.getElementById("late_id").value 		= "<?php echo $corelate['late_id'] ?>";
		document.getElementById("deduction_id").value 	= "<?php echo $corelate['deduction_id'] ?>";
	}
	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreLate/function_elements_add');?>",
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
								<a href="<?php echo base_url();?>CoreLate/editCoreLate/<?php echo $corelate['late_id']?>">
									Edit Terlambat
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Terlambat 
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
									<a href="<?php echo base_url();?>late" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreLate/processEditCoreLate',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('deduction_id', $corededuction,set_value('deduction_id',$corelate['deduction_id']),'id="deduction_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
												<input type="text" name="late_code" id="late_code" value="<?php echo $corelate['late_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label"> Kode Terlambat
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="late_name" id="late_name" value="<?php echo $corelate['late_name']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Terlambat
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
								<input type="hidden" name="late_id" value="<?php echo $corelate['late_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>