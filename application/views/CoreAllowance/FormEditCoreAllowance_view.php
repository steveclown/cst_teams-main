
<script>
	function ulang(){
		document.getElementById("allowance_code").value = "<?php echo $CoreAllowance['allowance_code'] ?>";
		document.getElementById("allowance_name").value = "<?php echo $CoreAllowance['allowance_name'] ?>";
		document.getElementById("allowance_amount").value = "<?php echo $CoreAllowance['allowance_amount'] ?>";
		document.getElementById("allowance_type").value = "<?php echo $CoreAllowance['allowance_type'] ?>";
		document.getElementById("allowance_group").value = "<?php echo $CoreAllowance['allowance_group'] ?>";
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
								<a href="<?php echo base_url();?>CoreAllowance">
									Daftar Tunjangan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreAllowance/editCoreAllowance/<?php echo $CoreAllowance['allowance_id']?>">
									Edit Tunjangan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
					Form Edit Tunjangan 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

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
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>allowance" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreAllowance/processEditCoreAllowance',array('id' => 'myform', 'class' => 'horizontal-form')); 

									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="allowance_code" id="allowance_code" value="<?php echo $CoreAllowance['allowance_code'];?>" class="form-control">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
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
												<input type="text" autocomplete="off"  name="allowance_name" id="allowance_name" value="<?php echo $CoreAllowance['allowance_name'];?>" class="form-control" >
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
												<?php echo form_dropdown('allowance_type', $allowancetype, set_value('allowance_type',$CoreAllowance['allowance_type']),'id="allowance_type", class="form-control select2me"');?>
												<label class="control-label">Tipe Tunjangan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('allowance_group', $allowancegroup, set_value('allowance_group',$CoreAllowance['allowance_group']),'id="allowance_group", class="form-control select2me"');?>
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
												<textarea rows="3" name="allowance_remark" id="allowance_remark" class="form-control"><?php echo $CoreAllowance['allowance_remark']?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div> -->
										
									<input type="hidden" name="allowance_id" value="<?php echo $CoreAllowance['allowance_id']; ?>"/>
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
				
