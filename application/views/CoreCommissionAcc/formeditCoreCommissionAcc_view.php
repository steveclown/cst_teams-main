<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit(){
	 	/*alert('asd');*/
		document.location = base_url+"CoreCommissionAcc/reset_edit/<?php echo $CoreCommissionAcc['commission_acc_id']?>";
	}

    function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreCommissionAcc/function_elements_edit');?>",
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
								<a href="<?php echo base_url();?>CoreCommissionAcc">
									Daftar Aksesori Komisi
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreCommissionAcc/editCoreCommissionAcc/<?php echo $CoreCommissionAcc['commission_acc_id'];?>">
									Edit Aksesori Komisi
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Aksesori Komisi 
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
						<a href="<?php echo base_url();?>CoreCommissionAcc" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreCommissionAcc/processEditCoreCommissionAcc',array('id' => 'myform', 'class' => 'horizontal-form')); 		
						?>
						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php
										echo form_dropdown('job_title_id', $corejobtitle, set_value('job_title_id',$CoreCommissionAcc['job_title_id']),'id="job_title_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label>Nama Pekerjaan</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="commission_acc_start_omzet" id="commission_acc_start_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_acc_start_omzet',$CoreCommissionAcc['commission_acc_start_omzet']);?>"/>
									<label class="control-label">Omset Awal<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="commission_acc_end_omzet" id="commission_acc_end_omzet" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_acc_end_omzet', $CoreCommissionAcc['commission_acc_end_omzet']);?>"/>
									<label class="control-label">Omset Akhir<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="commission_acc_percentage" id="commission_acc_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('commission_acc_percentage',$CoreCommissionAcc['commission_acc_percentage']);?>"/>
									<label class="control-label">Prosentase<span class="required">*</span></label>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="commission_acc_id" value="<?php echo $CoreCommissionAcc['commission_acc_id']; ?>"/>
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

