<script>
	base_url 	= '<?php echo base_url();?>';

	function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreAppraisal/function_elements_edit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}


	function reset_edit(){
		document.location = base_url+"CoreAppraisal/reset_edit/<?php echo $coreappraisal['appraisal_id']?>";
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
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
								<a href="<?php echo base_url();?>CoreAppraisal/editCoreAppraisal/<?php echo $coreappraisal['appraisal_id'];?>">
									Edit Penilaian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Penilaian 
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
						<a href="<?php echo base_url();?>CoreAppraisal" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreAppraisal/processEditCoreAppraisal',array('id' => 'myform', 'class' => 'horizontal-form')); 		
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="appraisal_code" id="appraisal_code" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $coreappraisal['appraisal_code'];?>" class="form-control" >
									<span class="help-block">
										Mohon diisi karakter huruf dan angka
									</span>
									<label class="control-label">Kode Penilaian<span class="required">*</span></label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="appraisal_name" id="appraisal_name" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $coreappraisal['appraisal_name'];?>" class="form-control" >
									<label class="control-label">Nama Penilaian<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="appraisal_start_value" id="appraisal_start_value" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $coreappraisal['appraisal_start_value'];?>" class="form-control" >
									<label class="control-label">Nilai Penilaian Awal<span class="required">*</span></label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="appraisal_end_value" id="appraisal_end_value" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $coreappraisal['appraisal_end_value'];?>" class="form-control" >
									<label class="control-label">Nilai Penilaian Akhir<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php
										echo form_dropdown('appraisal_type', $appraisaltype, set_value('appraisal_type', $coreappraisal['appraisal_type']),'id="appraisal_type" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
									?>
									<label>Tipe Organisasi</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="appraisal_remark" id="appraisal_remark" class="form-control" onChange="function_elements_edit(this.name, this.value);"><?php echo $coreappraisal['appraisal_remark'];?></textarea>		
									<label class="control-label">Keterangan<span class="required">*</span></label>
								</div>
							</div>
						</div>
						<input type="hidden" name="appraisal_id" value="<?php echo $coreappraisal['appraisal_id']; ?>"/>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" id="Save" name="Save" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

