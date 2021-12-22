<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit(){
	 	/*alert('asd');*/
		document.location = base_url+"CoreCommissionMmc/reset_edit/<?php echo $corecommissionmmc['commission_mmc_id']?>";
	}

    function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreCommissionMmc/function_elements_edit');?>",
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
									Dafta Komisi MMC
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreCommissionMmc/editCoreCommissionMmc/<?php echo $corecommissionmmc['commission_mmc_id'];?>">
									Edit Komisi MMC
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Komisi MMC 
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
						<a href="<?php echo base_url();?>CoreCommissionMmc" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreCommissionMmc/processEditCoreCommissionMmc',array('id' => 'myform', 'class' => 'horizontal-form')); 		
						?>
						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php
										echo form_dropdown('job_title_id', $corejobtitle, set_value('job_title_id',$corecommissionmmc['job_title_id']),'id="job_title_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label>Nama Judul Pekerjaan</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="commission_mmc_start_omzet" id="commission_mmc_start_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_mmc_start_omzet',$corecommissionmmc['commission_mmc_start_omzet']);?>"/>
									<label class="control-label">Omzet Awal<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="commission_mmc_end_omzet" id="commission_mmc_end_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_mmc_end_omzet', $corecommissionmmc['commission_mmc_end_omzet']);?>"/>
									<label class="control-label">Omzet Akhir<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="commission_mmc_unit" id="commission_mmc_unit" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_mmc_unit',$corecommissionmmc['commission_mmc_unit']);?>"/>
									<label class="control-label">Unit<span class="required">*</span></label>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="commission_mmc_id" value="<?php echo $corecommissionmmc['commission_mmc_id']; ?>"/>
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

