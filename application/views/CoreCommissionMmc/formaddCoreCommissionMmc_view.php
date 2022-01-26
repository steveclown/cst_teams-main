<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
	 	/*alert('asd');*/
		document.location = base_url+"CoreCommissionMmc/reset_add";
	}

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreCommissionMmc/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
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
					<a href="<?php echo base_url();?>CoreCommissionMmc">
						Daftar Komisi MMC
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreCommissionMmc/addCoreCommissionMmc">
						Tambah Komisi MMC
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Komisi MMC 
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
					<a href="<?php echo base_url();?>CoreCommissionMmc" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('CoreCommissionMmc/processAddCoreCommissionMmc',array('id' => 'myform', 'class' => 'horizontal-form')); 

						$unique	= $this->session->userdata('unique');
						$data 	= $this->session->userdata('addCoreCommissionMmc-'.$unique['unique']);	
					?>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('job_title_id', $corejobtitle, set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>Nama Judul pekerjaan</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="commission_mmc_start_omzet" id="commission_mmc_start_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_mmc_start_omzet',$data['commission_mmc_start_omzet']);?>"/>
								<label class="control-label">Omzet Awal<span class="required">*</span></label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="commission_mmc_end_omzet" id="commission_mmc_end_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_mmc_end_omzet', $data['commission_mmc_end_omzet']);?>"/>
								<label class="control-label">Omzet Akhir<span class="required">*</span></label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="commission_mmc_unit" id="commission_mmc_unit" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_mmc_unit',$data['commission_mmc_unit']);?>"/>
								<label class="control-label">Unit<span class="required">*</span></label>
							</div>
						</div>
					</div>
				</div>

				<div class="form-actions right">
					<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>