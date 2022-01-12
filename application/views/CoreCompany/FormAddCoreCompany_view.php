<script>

	base_url = '<?php echo base_url();?>';

	function reset_add(){
		document.location = "<?php echo base_url();?>company/reset-add";
	}

	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('company/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>
	<div class = "page-bar">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
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
				<a href="#">
					Tambah Perusahaan
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h1 class="page-title">
		Form Tambah Perusahaan
	</h1>
	<!-- END PAGE TITLE & BREADCRUMB-->
		

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Tambah
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
							echo form_open('company/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');

							$unique 		= $this->session->userdata('unique');
							$data 			= $this->session->userdata('addCoreCompany-'.$unique['unique']);
							$company_token	= $this->session->userdata('CoreCompanyToken-'.$unique['unique']);

							if(empty($data['company_code'])){
								$data['company_code'] 					= '';
							}

							if(empty($data['company_name'])){
								$data['company_name'] 					= '';
							}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="company_code" id="company_code" class="form-control" value="<?php echo $data['company_code']?>" onChange="function_elements_add(this.name, this.value);">

									<label class="control-label">Kode Perusahaan<span class="required">*</span></label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $data['company_name']?>" onChange="function_elements_add(this.name, this.value);">

									<input type="hidden" name="company_token" id="company_token" class="form-control" value="<?php echo $company_token?>" onChange="function_elements_add(this.name, this.value);">

									<label class="control-label">Nama Perusahaan<span class="required">*</span></label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
