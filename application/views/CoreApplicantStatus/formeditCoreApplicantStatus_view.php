<script>
	function ulang(){
		document.getElementById("applicant_status_id").value = "<?php echo $result['applicant_status_id'] ?>";
		document.getElementById("applicant_status_name").value = "<?php echo $result['applicant_status_name'] ?>";
		document.getElementById("applicant_status_code").value = "<?php echo $result['applicant_status_code'] ?>";
	}

	function reset_edit(){
		document.location = "<?php echo base_url();?>CoreApplicantStatus/reset_edit/<?php echo $CoreApplicantStatus['applicant_status_id']?>";
	}
</script>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreApplicantStatus">Status Lamaran</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreApplicantStatus/editCoreApplicantStatus/<?php echo $CoreApplicantStatus['applicant_status_id']?>">Edit Status Lamaran</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Edit Status Lamaran 
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
									
									<div class = "actions">
										<div class="actions">
											<a href="<?php echo base_url();?>CoreApplicantStatus" class="btn btn-default btn-sm">
											<i class="fa fa-angle-left"></i> Kembali</a>
										</div>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="form-body">
										<?php 
											echo form_open('CoreApplicantStatus/processEditCoreApplicantStatus',array('id' => 'myform', 'class' => 'horizontal-form')); 
										?>
										
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control" name="applicant_status_code" id="applicant_status_code" value="<?php echo $CoreApplicantStatus['applicant_status_code']?>" >
                                                    <label for="form_control">Kode Status Lamaran
                                                        <span class="required">*</span>
                                                    </label>
                                                    <span class="help-block">Diisi karakter huruf dan angka..</span>
                                                </div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" class="form-control" name="applicant_status_name" id="applicant_status_name" class="form-control" value="<?php echo $CoreApplicantStatus['applicant_status_name']?>" >
													<label class="form_control">Nama Status Lamaran</label>
												</div>
											</div>
										</div>
						
										<input type="hidden" name="applicant_status_id" value="<?php echo $CoreApplicantStatus['applicant_status_id']; ?>"/>
										<div class="form-actions right">
											<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
					
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
	
