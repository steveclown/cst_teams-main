<script>
	function ulang(){
		document.getElementById("family_relation_id").value = "";
		document.getElementById("family_relation_code").value = "";
		document.getElementById("family_relation_name").value = "";
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
					<a href="<?php echo base_url();?>CoreFamilyRelation">Hubungan Keluarga</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreFamilyRelation/addCoreFamilyRelation">Tambah Hubungan Keluarga</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Tambah Hubungan Keluarga
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
									<a href="<?php echo base_url();?>CoreFamilyRelation/" class="btn btn-default btn-sm">
									<i class="fa fa-angle-left"></i> Kembali</a>
								</div>
							</div>
							<div class="portlet-body form ">
								<div class="form-body">
								<!--<form action="CoreFamilyRelation/processAddCoreFamilyRelation" id="form_sample_3" class="horizontal-form" method="post">-->
										<?php 
											echo form_open('CoreFamilyRelation/processAddCoreFamilyRelation',array('id' => 'myform', 'class' => 'horizontal-form')); 
											$data = $this->session->userdata('addfamilyrelation');
										?>
									
										<div class = "row">
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  class="form-control" name="family_relation_code" id="family_relation_code" >
													<label for="form_control">Kode Hubungan Keluarga
														<span class="required">*</span>
													</label>
													<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  class="form-control" name="family_relation_name" id="family_relation_name" >
													<label for="form_control">Nama Hubungan Keluarga
														<span class="required">*</span>
													</label>
												</div>
											</div>
										</div>
										<div class="form-actions right">
											<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				
						
