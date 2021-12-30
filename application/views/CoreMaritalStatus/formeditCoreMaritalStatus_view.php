<script>
	function ulang(){
		document.getElementById("marital_status_code").value = "<?php echo$coremaritalstatus['marital_status_code'] ?>";
		document.getElementById("marital_status_name").value = "<?php echo$coremaritalstatus['marital_status_name'] ?>";
		document.getElementById("marital_status_id").value = "<?php echo$coremaritalstatus['marital_status_id'] ?>";
	}
</script>


		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coremaritalstatus">Status Pernikahan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coremaritalstatus/editcoremaritalstatus/<?php echo $coremaritalstatus['marital_status_id']?>">Edit Status Pernikahan</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Status Pernikahan 
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
						<a href="<?php echo base_url();?>coremaritalstatus" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('coremaritalstatus/processEditcoremaritalstatus',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="marital_status_code" id="marital_status_code" class="form-control" value="<?php echo $coremaritalstatus['marital_status_code']?>" >
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Kode Status Pernikahan
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="marital_status_name" id="marital_status_name" class="form-control" value="<?php echo $coremaritalstatus['marital_status_name']?>">
									<label class="control-label">Nama Status Pernikahan</label>
								</div>
							</div>
						</div>
						<div class="form-actions right">
							<button type="button" class="btn red" onClick="ulang()"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
					<input type="hidden" name="marital_status_id" value="<?php echo $coremaritalstatus['marital_status_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
