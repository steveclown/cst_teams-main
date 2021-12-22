<script>
	function ulang(){
		document.getElementById("rating_code").value = "<?php echo $CoreRating['rating_code'] ?>";
		document.getElementById("rating_name").value = "<?php echo $CoreRating['rating_name'] ?>";
		document.getElementById("rating_id").value = "<?php echo $CoreRating['rating_id'] ?>";
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
					<a href="<?php echo base_url();?>CoreRating">
						Daftar Peringkat
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreRating/editCoreRating/<?php echo $CoreRating['rating_id'];?>">
						Edit Peringkat
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Peringkat 
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
					<a href="<?php echo base_url();?>CoreRating" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php
						echo form_open('CoreRating/processEditCoreRating',array('id' => 'myform', 'class' => 'horizontal-form')); 
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="rating_code" id="rating_code" value="<?php echo $CoreRating['rating_code'];?>" class="form-control" >
								<span class="help-block">
									Mohon hanya diisi karakter huruf dan angka.
								</span>
								<label class="control-label">Kode peringkat<span class="required">*</span></label>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="rating_name" id="rating_name" value="<?php echo $CoreRating['rating_name'];?>" class="form-control" >
								<label class="control-label">Nama peringkat<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="rating_range1" id="rating_range1" value="<?php echo $CoreRating['rating_range1'];?>" class="form-control">
								<span class="help-block">
									Mohon hanya diisi angka.
								</span>
								<label class="control-label">Range Peringkat 1<span class="required">*</span></label>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="rating_range2" id="rating_range2" value="<?php echo $CoreRating['rating_range2'];?>" class="form-control">
								<span class="help-block">
									Mohon hanya diisi angka.
								</span>
								<label class="control-label">Range Peringkat 2<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="rating_value" id="rating_value" value="<?php echo $CoreRating['rating_value'];?>" class="form-control">
								<span class="help-block">
									Mohon hanya diisi angka.
								</span>
								<label class="control-label">Nilai Peringkat<span class="required">*</span></label>
							</div>
						</div>
					</div>
						
					<div class = "row">
						<div class="col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="rating_remark" id="rating_remark" class="form-control" ><?php echo $CoreRating['rating_remark'];?></textarea>		
								<label class="control-label">Keterangan</label>
							</div>
						</div>
					</div>
					<input type="hidden" name="rating_id" value="<?php echo $CoreRating['rating_id']; ?>"/>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
