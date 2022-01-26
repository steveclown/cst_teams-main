<script>
	function ulang(){
		document.getElementById("separation_reason_id").value = "<?php echo $coreseparationreason['separation_reason_id'] ?>";
		document.getElementById("separation_reason_name").value = "<?php echo $coreseparationreason['separation_reason_name'] ?>";
	}

	function reset_edit(){
		document.location = "<?php echo base_url();?>CoreSeparationReason/reset_edit/<?php echo $coreseparationreason['separation_reason_id']?>";
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
								<a href="<?php echo base_url();?>CoreSeparationReason">
									Daftar alasan pemisahan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreSeparationReason/editCoreSeparationReason/<?php echo $coreseparationreason['separation_reason_id']?>">
									Edit alasan pemisahan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit alasan pemisahan
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
									<a href="<?php echo base_url();?>separation-reason" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreSeparationReason/processEditCoreSeparationReason',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="separation_reason_name" id="separation_reason_name" value="<?php echo $coreseparationreason['separation_reason_name'];?>" class="form-control" >
												
												<label class="control-label">Nama alasan pemisahan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="separation_reason_id" value="<?php echo $coreseparationreason['separation_reason_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>