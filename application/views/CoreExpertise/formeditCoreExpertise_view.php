<script>
	function ulang(){
		document.getElementById("expertise_code").value = "<?php echo $coreexpertise['expertise_code'] ?>";
		document.getElementById("expertise_name").value = "<?php echo $coreexpertise['expertise_name'] ?>";
		document.getElementById("expertise_id").value = "<?php echo $coreexpertise['expertise_id'] ?>";
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
								<a href="<?php echo base_url();?>CoreExpertise">
									Daftar Keahlian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreExpertise/editCoreExpertise/<?php $coreexpertise['expertise_id']?>">
									Edit Keahlian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Keahlian 
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
						<a href="<?php echo base_url();?>expertise" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
						echo form_open('CoreExpertise/processEditCoreExpertise',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="expertise_code" id="expertise_code" value="<?php echo set_value('expertise_code',$coreexpertise['expertise_code']);?>"/>
									<span class="help-block">
										Mohon hanya diisi karakter huruf dan angka.
									</span>
									<label class="control-label">Kode Keahlian
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="expertise_name" id="expertise_name" value="<?php echo set_value('expertise_name',$coreexpertise['expertise_name']);?>"/>
									<label class="control-label">Nama Keahlian
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" class="form-control" name="expertise_remark" id="expertise_remark"> <?php echo set_value('expertise_remark',$coreexpertise['expertise_remark']);?> </textarea>
									<label class="control-label">Keterangan
									</label>	
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="expertise_id" value="<?php echo $coreexpertise['expertise_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>