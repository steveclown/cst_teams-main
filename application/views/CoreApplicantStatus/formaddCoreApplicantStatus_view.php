<script>
	function ulang(){
		document.getElementById("applicant_status_id").value = "";
		document.getElementById("applicant_status_name").value = "";
		document.getElementById("applicant_status_code").value = "";
	}

	function reset_add(){
		document.location = "<?php echo base_url();?>CoreApplicantStatus/reset_add";
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
					<a href="<?php echo base_url();?>CoreApplicantStatus/addCoreApplicantStatus">Tambah Status Lamaran</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Tambah Status Lamaran 
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
											echo form_open('CoreApplicantStatus/processAddCoreApplicantStatus',array('id' => 'myform', 'class' => 'horizontal-form')); 
											$data = $this->session->userdata('addCoreApplicantStatus');
										?>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control" name="applicant_status_code" id="applicant_status_code" value="<?php echo $data['applicant_status_code']?>" >
                                                    <label for="form_control">Kode Status Lamaran
                                                        <span class="required">*</span>
                                                    </label>
                                                    <span class="help-block">Diisi karakter huruf dan angka..</span>
                                                </div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" class="form-control" name="applicant_status_name" id="applicant_status_name" class="form-control" value="<?php echo $data['applicant_status_name']?>" >
													<label class="form_control">Nama Status Lamaran</label>
												</div>
											</div>
										</div>
										<div class="form-actions right">
											<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
									<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
