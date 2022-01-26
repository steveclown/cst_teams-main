<script>

	base_url = '<?php echo base_url();?>';

	function reset_add(){
		document.location = "<?php echo base_url();?>region/reset-add";
	}

	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('region/elements-add');?>",
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
				<a href="<?php echo base_url();?>region">
					Daftar Wilayah
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Tambah Wilayah
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h1 class="page-title">
		Form Tambah Wilayah
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
						<a href="<?php echo base_url();?>region" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('region/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');

							$unique 		= $this->session->userdata('unique');
							$data 			= $this->session->userdata('addCoreRegion-'.$unique['unique']);
							$region_token	= $this->session->userdata('CoreRegionToken-'.$unique['unique']);

							if(empty($data['region_code'])){
								$data['region_code'] 					= '';
							}

							if(empty($data['region_name'])){
								$data['region_name'] 					= '';
							}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="region_code" id="region_code" class="form-control" value="<?php echo $data['region_code']?>" onChange="function_elements_add(this.name, this.value);">

									<label class="control-label">Kode Wilayah<span class="required">*</span></label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="region_name" id="region_name" class="form-control" value="<?php echo $data['region_name']?>" onChange="function_elements_add(this.name, this.value);">

									<input type="hidden" name="region_token" id="region_token" class="form-control" value="<?php echo $region_token?>" onChange="function_elements_add(this.name, this.value);">

									<label class="control-label">Nama Wilayah<span class="required">*</span></label>
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
