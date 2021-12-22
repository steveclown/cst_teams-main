<script>
	function ulang(){
		document.getElementById("language_code").value = "<?php echo $CoreLanguage['language_code'] ?>";
		document.getElementById("language_name").value = "<?php echo $CoreLanguage['language_name'] ?>";
		document.getElementById("language_id").value = "<?php echo $CoreLanguage['language_id'] ?>";
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
					<a href="<?php echo base_url();?>CoreLanguage">Bahasa</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreLanguage/editCoreLanguage/<?php echo $CoreLanguage['language_id']?>">Edit Bahasa</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Edit Bahasa
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
						<a href="<?php echo base_url();?>CoreLanguage/" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php
						echo form_open('CoreLanguage/processEditCoreLanguage',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="language_code" id="language_code" value="<?php echo $CoreLanguage['language_code'];?>">
									<label for="form_control">Kode Bahasa
										<span class="required">*</span>
									</label>
									<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
								</div>											
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="language_name" id="language_name" value="<?php echo $CoreLanguage['language_name'];?>">
									<label for="form_control">Nama Bahasa
										<span class="required">*</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="language_id" value="<?php echo $CoreLanguage['language_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>