<script>
	function ulang(){
		document.getElementById("family_relation_id").value = "<?php echo $result['family_relation_id'] ?>";
		document.getElementById("family_relation_code").value = "<?php echo $result['family_relation_code'] ?>";
		document.getElementById("family_relation_name").value = "<?php echo $result['family_relation_name'] ?>";
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
					<a href="<?php echo base_url();?>CoreFamilyRelation/editCoreFamilyRelation/<?php echo $CoreFamilyRelation['family_relation_id']?>">Edit Hubungan Keluarga</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Edit Hubungan Keluarga
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
						<a href="<?php echo base_url();?>CoreFamilyRelation/" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreFamilyRelation/processEditCoreFamilyRelation',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="family_relation_code" id="family_relation_code" value="<?php echo $CoreFamilyRelation['family_relation_code']?>" >
									<label for="form_control">Kode Hubungan Keluarga
										<span class="required">*</span>
									</label>
									<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="family_relation_name" id="family_relation_name" value="<?php echo $CoreFamilyRelation['family_relation_name']?>" >
									<label for="form_control">Nama Hubungan Keluarga
										<span class="required">*</span>
									</label>
									<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
								</div>
							</div>
						</div>
						<input type="hidden" name="family_relation_id" value="<?php echo $CoreFamilyRelation['family_relation_id']; ?>"/>
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
	
