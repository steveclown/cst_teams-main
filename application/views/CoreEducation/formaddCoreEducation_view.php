<script>
	function ulang(){
		document.getElementById("education_code").value = "";
		document.getElementById("education_name").value = "";
		document.getElementById("education_type").value = "";
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
					<a href="<?php echo base_url();?>CoreEducation">Pendidikan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreEducation/addCoreEducation">Tambah Pendidikan</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Tambah Pendidikan
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
									<a href="<?php echo base_url();?>CoreEducation/" class="btn btn-default btn-sm">
									<i class="fa fa-angle-left"></i> Kembali</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('CoreEducation/processAddCoreEducation',array('class' => 'horizontal-form'));
									$data = $this->session->userdata('addeducation');
									 ?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="education_code" id="education_code" value="<?php echo $data['education_code']?>" >
												<label for="form_control">Kode Pendidikan
													<span class="required">*</span>
												</label>
												<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
											</div>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="education_name" id="education_name" value="<?php echo $data['education_name']?>" >
												<label for="form_control">Nama Pendidikan
													<span class="required">*</span>
												</label>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input ">
												<?php echo form_dropdown('education_type', $CoreEducationtype, $data['education_type'], 'id ="education_type", class="form-control select2me"');?>
												<label for="form_control">Tipe Pendidikan
													<span class="required">*</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea class="form-control" rows="3 name="education_remark" id="education_remark"></textarea><?php echo set_value('education_remark',$data['education_remark']);?>
												<label for="form_control_1">Keterangan</label>
											</div>
										</div>
									</div>
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
