<script>
	function reset_edit(){
		document.location = "<?php echo base_url();?>company/reset-edit/<?php echo $corecompany['company_id']?>";
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
				<a href="<?php echo base_url();?>company">
					Daftar Perusahaan
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>company/edit/<?php echo $corecompany['company_id']?>">
					Edit Perusahaan
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h1 class="page-title">
		Form Edit Perusahaan 
	</h1>
	<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>company" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('company/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); 

							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="company_code" id="company_code" class="form-control" value="<?php echo $corecompany['company_code']?>">
									
									<label class="control-label">Kode Perusahaan<span class="required">*</span></label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="company_name" id="company_name" class="form-control" value="<?php echo $corecompany['company_name']?>">
									<label class="control-label">Nama Perusahaan<span class="required">*</span></label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="company_id" value="<?php echo $corecompany['company_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>