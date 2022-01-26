<?php

?>
<script>
	function ulang(){
		document.getElementById("allowance_code").value = "";
		document.getElementById("allowance_name").value = "";
		document.getElementById("allowance_amount").value = "";
		document.getElementById("allowance_type").value = "";
		document.getElementById("allowance_group").value = "";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeallowance/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>


<!-- <?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?> -->
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
								<a href="<?php echo base_url();?>CoreAllowance">
									Daftar Tunjangan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreAllowance/addCoreAllowance">
									Tambah Tunjangan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Tunjangan
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
									<a href="<?php echo base_url();?>CoreAllowance" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreAllowance/processAddCoreAllowance',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddAllowance');

									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="allowance_code" id="allowance_code" value="<?php echo $data['allowance_code'];?>" class="form-control"  onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Tunjangan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="allowance_name" id="allowance_name" value="<?php echo $data['allowance_name'];?>" class="form-control"  onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Tunjangan
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
												<?php echo form_dropdown('allowance_type', $allowancetype, set_value('allowance_type',$data['allowance_type']),'id="allowance_type", class="form-control select2me",  onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Tipe Tunjangan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('allowance_group', $allowancegroup, set_value('allowance_group',$data['allowance_group']),'id="allowance_group", class="form-control select2me",  onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Kelompok Tunjangan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<!-- <div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="allowance_remark" id="allowance_remark" class="form-control"><?php echo $data['allowance_remark']?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div> -->
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
