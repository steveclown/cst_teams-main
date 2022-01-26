<script>	
	base_url 	= '<?php echo base_url();?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreAppraisal/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}


	function reset_add(){
		document.location = base_url+"CoreAppraisal/reset_add";
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
					<a href="<?php echo base_url();?>CoreAppraisal">
						Daftar Penilaian
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreAppraisal/addCoreAppraisal">
						Tambah Penilaian
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Penilaian
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
					<a href="<?php echo base_url();?>CoreAppraisal" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('CoreAppraisal/processAddCoreAppraisal',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$unique 	= $this->session->userdata('unique');
						$data 		= $this->session->userdata('addCoreAppraisal-'.$unique['unique']);	
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="appraisal_code" id="appraisal_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('appraisal_code', $data['appraisal_code']);?>"/>
								<span class="help-block">
									 Mohon hanya diisi karakter huruf dan angka
								</span>
								<label class="control-label">Kode Penilaian <span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="appraisal_name" id="appraisal_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('appraisal_name',$data['appraisal_name']);?>"/>
								<label class="control-label">Nama Penilaian<span class="required">*</span></label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="appraisal_start_value" id="appraisal_start_value" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('appraisal_start_value',$data['appraisal_start_value']);?>"/>
								<label class="control-label">Nilai Penilaian Awal <span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="appraisal_end_value" id="appraisal_end_value" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('appraisal_end_value',$data['appraisal_end_value']);?>"/>
								<label class="control-label">Nilai Penilaian Akhir<span class="required">*</span></label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('appraisal_type', $appraisaltype, set_value('appraisal_type',$data['appraisal_type']),'id="appraisal_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>Tipe Organisasi</label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">					
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="appraisal_remark" id="appraisal_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['appraisal_remark'];?></textarea>	
								<label class="control-label">Keterangan</label>								
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal </button>
					<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>